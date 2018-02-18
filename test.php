<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <title>Concert Scraper</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

</head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link"><img src="image/logo.png" alt="Zach Killebrew Logo" height="22" width="22"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle font-weight-bold text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Projects</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="projects.html">All Projects</a>
                <a class="dropdown-item font-weight-bold" href="concert.html">Concert Scraper</a>
                <a class="dropdown-item" href="twitter.html">Twitter Cleaner</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
          </ul>
          <ul class="navbar-nav navbar-right">
            <li class="nav-item">
              <a class="nav-link" href="https://github.com/zkilleb"><img src="image/GitHub-Mark-Light-120px-plus.png" alt="Git Hub" height="22" width="22"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://www.linkedin.com/in/zachary-killebrew-22336a156/"><img src="image/In-White-128px-R.png" alt="LinkedIn" height="22" width="22"></a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container">
        <h1></h1>
        <h1 class="display-3">Concert Scraper</h1>
        <div class="jumbotron">

        <p>As mentioned in the overview, this project is still ongoing. The purpose of the application is to collect all the information about upcoming concerts in one place.
           On the back-end, I used Python and <a href="https://www.crummy.com/software/BeautifulSoup/">Beautiful Soup</a> to scrape the relevant information from different sites
           and place it into an SQL database. From there, I intend to create a front-end where all of this data can be pulled and displayed on the web. The source code can be found
           <a href="https://github.com/zkilleb/Concert-Calendar">here</a>.</p>

           <h2>Languages and Technologies Used:</h2>
                      <p>
                        <div class="row">
                          <div class="col-sm-4">Python</div>
                          <div class="col-sm-4">MySQL</div>
                          <div class="col-sm-4">BeautifulSoup</div>
                          <div class="col-sm-4">HTML</div>
                          <div class="col-sm-4">Bootstrap</div>
                          <div class="col-sm-4">JavaScript</div>
                        </div>
                      </p>



        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <?php
        $servername = "server";
        $username = "user";
        $password = "password";
        $dbname = "database";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT Headliner, dates, Venue FROM concert ORDER BY dateInt";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "HEADLINER: " . $row["Headliner"]. "   DATE: " . $row["dates"]. "  VENUE: " . $row["Venue"]. "<br>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>

        </body>

        </html>
