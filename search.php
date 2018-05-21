
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Show Actor Information</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontAwesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">

  <body>
    <?php include("navigation.php"); ?>

    <div class="main_container">

    <h3>Search Actor and Movie Info</h3>
    <form method="GET" action="#">
        <div class="form-group">
          <input type="text" class="form-control" name="search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
    </form>

    <?php
      include "tables.inc";
      // echo "<h2>PHP is Fun!</h2>";
      $db = new mysqli('localhost', 'cs143', '', 'CS143');
      if($db->connect_errno > 0){
          die('Unable to connect to database [' . $db->connect_error . ']');
      }

      // mysql_select_db("CS143", $db);
      if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $search = $_GET["search"];
        $id = $_GET["id"];
        // echo $search;

        if(isset($search)) {
          $keywords = explode(" ", mysqli_real_escape_string($db, $search));

          // Actors

          switch(count($keywords)) {
            case 0:
            case 1:
              $query = "SELECT id, concat(last,' ',first) as 'Actor Name', sex, dob as 'Birthday', dod as 'Pass Away' from Actor
                        WHERE (first LIKE '%$search%') OR (last LIKE '%$search%')";
              break;

            case 2:
              $keyword1 = $keywords[0];
              $keyword2 = $keywords[1];
              $query = "SELECT id, concat(last,' ',first) as 'Actor Name', sex, dob as 'Birthday', dod as 'Pass Away' from Actor
                        WHERE (first LIKE '%$keyword1%') AND (last LIKE '%$keyword2%') OR
                              (last LIKE '%$keyword1%') AND (first LIKE '%$keyword2%')";
              break;

            default:
              $query = "SELECT id FROM Actor WHERE FALSE";
          }
          // echo $query;

          $result = $db->query($query);
          // echo mysqli_num_fields($result);

          $table = new Table($result, 1, "Matching Actors:");

          // Movies
          $query = "SELECT * FROM Movie WHERE title LIKE '%$keywords[0]%'";
          for($i = 1; $i < count($keywords); $i++) {
            $query .= "AND title LIKE '%$keywords[$i]%'";
          }

          $result = $db->query($query);
          $table = new Table($result, 2, "Matching Movies:");
        }
      }
      

      

      $db->close();
      ?>

</div>
</body>
</html>
