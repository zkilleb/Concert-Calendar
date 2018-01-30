#imports
import bs4 as bs
import urllib.request
import MySQLdb

#setting up website to be scraped from
sauce = urllib.request.urlopen('https://www.firebirdstl.com/listing/').read()
firebird = bs.BeautifulSoup(sauce, 'lxml')

#variables for iteration
i = 0
j = 0
k = 0
l = 1

#connect to database
db = MySQLdb.connect(host='host',
                     user='user',
                     password='password',
                     db= 'database')

#cursor
cursor=db.cursor()

#delete all data when compiled to update and avoid duplicates
cursor.execute("DELETE FROM concert")

#discover number of concerts
for artist in firebird.find_all('h1', {"class": "headliners summary"}):
    i += 1

#populate database with headliner names and ID_Nums
for artist in firebird.find_all('h1', {"class": "headliners summary"}):
    cursor.execute("INSERT INTO concert(Headliner, ID_Num) VALUES (%s, %s)", ([artist.text], j))
    j += 1

#delete repeat of data from banner at top of site and add dates to database
for date in firebird.find_all('h2', {"class": "dates"}):
    cursor.execute("DELETE FROM concert WHERE ID_NUM = (%s)", '0')
    cursor.execute("UPDATE concert SET dates = (%s) WHERE ID_NUM = (%s)", ([date.text], k))
    k += 1

#needs if to account for shows that don't have support
#for support in firebird.find_all('h2', {"class": "supports description"}):
#    if .find('supports description'):
#        cursor.execute("UPDATE concert SET Support = (%s) WHERE ID_NUM = (%s)", ([support.text], l))
#    l += 1

#commit to and close database
db.commit()
db.close()
