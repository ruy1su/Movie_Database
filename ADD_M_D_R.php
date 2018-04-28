<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add new Relationship between Movie/Director</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Add New Movie Director Relation</title>
    <link href="css/all.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontAwesome/css/font-awesome.css" rel="stylesheet">

  <body>
    <?php include("navigation.php"); ?>

    <div class="main_container">
    <h3>Add new Relationship between Movie/Director</h3>

    <form method="GET" action="#">
        <div class="form-group">
          <label for="title">Movie Title:</label>
              <?php include("_movie_list.php") ?>
        </div>
        <div class="form-group">
          <label for="director">Director</label>
              <?php
                $db = new mysqli('localhost', 'cs143', '', 'CS143');
                if($db->connect_errno > 0){
                    die('Unable to connect to database [' . $db->connect_error . ']');
                }

                $sql = $db->query("SELECT first, last, dob FROM Director");
                if(mysqli_num_rows($sql)) {
                $select = '<select class="form-control" name="director">';
                while($rs = mysqli_fetch_array($sql)){
                      $select.='<option value="'.$rs['first'].' '.$rs['last'].'">'.$rs['first'].' '.$rs['last'].'  ['.$rs['dob'].']'.'</option>';
                  }
                }
                $select.='</select>';
                echo $select;

                $db->close();
                ?>
        </div>
        <button type="submit" name="add" class="btn btn-default">Add!</button>
    </form>

    <?php
    	$db = new mysqli('localhost', 'cs143', '', 'CS143');
      if($db->connect_errno > 0){
          die('Unable to connect to database [' . $db->connect_error . ']');
      }

  		$title = $_GET["title"];
  		$director = $_GET["director"];

      if (isset($title, $director)) {
        //get the Movie id number
        $rowSQL = $db->query("SELECT id as mid FROM Movie WHERE title = '$title';");
        $row = mysqli_fetch_array($rowSQL);
        $pieces = explode(" ", $director);
        $didSQL = $db->query("SELECT id as did FROM Director WHERE first = '$pieces[0]' and last = '$pieces[1]' ;");
        $didRow = mysqli_fetch_array($didSQL);
        // echo $row[1];
        $mid = $row["mid"];
        $did = $didRow["did"];
        // echo $mid, "mid   ";
        // echo $did, "did   ";

        $query = "INSERT INTO MovieDirector(mid,did)
                  VALUES ($mid, $did);
                  ";
        mysqli_query($db, $query);
        print "add success: $title, $director ";
      }


      $db->close();
    ?>
  </div>


</body>
</html>
