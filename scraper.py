import bs4 as bs
import urllib.request
import MySQLdb

sauce = urllib.request.urlopen('https://www.firebirdstl.com/listing/').read()
firebird = bs.BeautifulSoup(sauce, 'lxml')

sauce2 = urllib.request.urlopen('https://www.thereadyroom.com/listing/').read()
readyRoom = bs.BeautifulSoup(sauce2, 'lxml')

i = 0
j = 0
k = 0

#connect to database
db = MySQLdb.connect(host='host',
                     user='user',
                     password='password',
                     db= 'database')

cursor=db.cursor()

#remove all information from dB to avoid duplicates
cursor.execute("DELETE FROM concert")

#add headliners, ID and Venue for Firebird
for artist in firebird.find_all('h1', {"class": "headliners summary"}):
    cursor.execute("INSERT INTO concert(Headliner, ID_Num, Venue) VALUES (%s, %s, 'Firebird')", ([artist.text], j))
    j += 1

#add dates, remove duplicate and format    
for date in firebird.find_all('h2', {"class": "dates"}):
    cursor.execute("DELETE FROM concert WHERE ID_NUM = (%s) AND Venue = 'Firebird'", '0')
    cursor.execute("UPDATE concert SET dates = (%s) WHERE ID_NUM = (%s)", ([date.text], k))
    k += 1

#commit and close dB    
db.commit()
db.close()

#connect to database using utf-8
db = MySQLdb.connect(host='host',
                     user='user',
                     password='password',
                     db= 'database',
                     use_unicode=True, charset="utf8")

cursor=db.cursor()

#add headliners and other info for ready room
for artist in readyRoom.find_all('h1', {"class": "headliners summary"}):
    cursor.execute("INSERT INTO concert(Headliner, ID_Num, Venue) VALUES (%s, %s, 'The Ready Room')", ([artist.text], j))
    j += 1

#add dates and format
for date in readyRoom.find_all('h2', {"class": "dates"}):
    cursor.execute("UPDATE concert SET dates = (%s) WHERE ID_NUM = (%s)", ([date.text], k))
    cursor.execute("UPDATE concert SET dates = SUBSTRING(dates, LENGTH(dates) - 4)")
    cursor.execute("UPDATE concert SET dates = REPLACE(dates, '/', '.')")
    k += 1

#remove extra zero from dates    
cursor.execute("UPDATE concert SET dates = REPLACE(LTRIM(REPLACE(dates, '0', ' ')), ' ', '0') WHERE dates like '0%'")

#copy to column with datatype decimal to sort by
cursor.execute("UPDATE concert SET dateInt=dates")

#close Db
db.commit()
db.close()

