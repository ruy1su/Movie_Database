
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Show Movie Information</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontAwesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">

  <body>
    <?php include("navigation.php"); ?>

    <div class="main_container">

    <h3>Show Movie Information</h3>
    <form method="GET" action="#">
        <div class="form-group">
          <input type="text" class="form-control" name="search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
    </form>

    <?php
      include "tables.inc";

      function fetch_first_row($result) {
        $row = mysqli_fetch_assoc($result);
        mysqli_data_seek($result, 0);
        return $row;
      }

      $db = new mysqli('localhost', 'cs143', '', 'CS143');
      if($db->connect_errno > 0){
          die('Unable to connect to database [' . $db->connect_error . ']');
      }

      $search = $_GET["search"];
      $id = $_GET["id"];

      if (isset($id)) {                   // display actor information
        $subQr_movie_info = "SELECT concat(title, '(',year,')') as 'Title', company as 'Producer', concat(d.first, ' ', d.Last) as 'Director', mg.genre as 'Genre', Movie.rating as 'MPAA Rating' from Movie left join MovieDirector md on Movie.id = md.mid left join Director d on d.id = md.did left join MovieGenre mg on mg.mid = Movie.id where Movie.id = {$id}";
        $result_movie_info = $db->query($subQr_movie_info); 
        $table = new Table($result_movie_info, 0, "Movie's Information:");

        $query = "SELECT title from Movie where Movie.id = {$id}";
        $result = $db->query($query); 
        $title = (mysqli_fetch_array($result))["title"];
        // echo $title;
        // $table = new Table($result, 0, "Movie's Information:");

        $query2 = "SELECT a.id, concat(a.first, ' ', a.last) as 'Actor Name', ma.role
                   FROM MovieActor ma, Actor a
                   WHERE ma.mid = '{$id}' AND a.id = ma.aid";
        $result2 = $db->query($query2);
        $table2 = new Table($result2, 1, "Actors in this Movies and Role:");

        $query3 = "SELECT name, time, rating, comment from Review where mid = '{$id}'";
        $result3 = $db->query($query3);
        $table3 = new Table($result3, 0, "User Review:");

        $query4 = $db->query("SELECT AVG(rating) as rating from Review where mid = '{$id}'");
        $row = mysqli_fetch_array($query4 );
        $avgRate = $row["rating"];

        if(mysqli_num_rows($result3)) {
          print "The Average Rating for this Movie is: {$avgRate}. <br>";
          print "<a href='addReview.php?value_key=$id&title=$title'>Add another review</a>";
        } else {
          print "No one has reviewed this movie yet. <br>";
          print "<a href='addReview.php?value_key=$id&title=$title'>Be the first to add a review!</a>";
        }

      } else if(isset($search)) {           // show search result
        $keywords = explode(" ", mysqli_real_escape_string($db, $search));
        // echo $keywords;
        $query = "SELECT * FROM Movie WHERE title LIKE '$keywords[0]'";
        // echo $query;
        for($i = 1; $i < count($keywords); $i++) {
          $query = "AND title LIKE '$keywords[$i]'";
        }

        $result = $db->query($query);

        $table = new Table($result, 2, "Matching Movies:");
      }

      $db->close();
    ?>


</div>
</body>
</html>
