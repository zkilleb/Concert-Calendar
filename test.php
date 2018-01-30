<!DOCTYPE html>

<html>
    <head>
        <title>Concert Calendar</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <div>
            <h1>Concert Calendar</h1>
        </div>

        <div>
            <form action = "search.php"  id = "form" method = "POST">
                Enter Query: <br>
                <textarea name="Search" form="form" rows="4" cols="50"></textarea> <br>
                <input type="submit" value="Submit">

            </form>


        </div>




        <?php
        $link = mysqli_connect("host", "user", "password", "database");

        $search = "";
//$table = "";
        $out = "";
        $count = "";
        $i = "0";


        $search = isset($_POST['Search']) ? $_POST['Search'] : '';
        $search = !empty($_POST['Search']) ? $_POST['Search'] : '';


        if (!$link) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }


        $result = mysqli_query($link, $search);
        if ($result && mysqli_num_rows($result) > 0) {
            // echo 'Found';
            echo "<br />";

            while ($fieldinfo = mysqli_fetch_field($result)) {
                $count++;
                printf("%s\n", $fieldinfo->name);
            }

            while ($row = $result->fetch_array()) {
                echo "<br />";
                while ($i < $count) {
                    echo $row[$i] . " ";
                    $out = $out + $row[$i] . " ";
                    $i++;
                }
                $i = 0;
                echo "<br />";
            }
        } else {
        }

        mysqli_close($link);
        ?>


    </body>
</html>
