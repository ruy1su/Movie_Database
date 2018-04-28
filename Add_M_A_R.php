<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add new Relationship between Movie/Actor</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Add New Movie Actor Relation</title>
    <link href="css/all.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontAwesome/css/font-awesome.css" rel="stylesheet">

  <body>
    <?php include("navigation.php"); ?>

    <div class="main_container">
    <h3>Add new Relationship between Movie/Actor</h3>

    <form method="GET" action="#">
        <div class="form-group">
          <label for="title">Movie Title:</label>
              <?php include("_movie_list.php") ?>
        </div>
        <div class="form-group">
          <label for="actor">Actor</label>
              <?php
                $db = new mysqli('localhost', 'cs143', '', 'CS143');
                if($db->connect_errno > 0){
                    die('Unable to connect to database [' . $db->connect_error . ']');
                }

                $sql = $db->query("SELECT first, last, dob FROM Actor");
                if(mysqli_num_rows($sql)) {
                $select = '<select class="form-control" name="actor">';
                while($rs = mysqli_fetch_array($sql)){
                      $select.='<option value="'.$rs['first'].' '.$rs['last'].'">'.$rs['first'].' '.$rs['last'].'  ['.$rs['dob'].']'.'</option>';
                  }
                }
                $select.='</select>';
                echo $select;

                $db->close();
              ?>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <input type="text" class="form-control" name="role">
        </div>
        <button type="submit" name="add" class="btn btn-default">Add!</button>
    </form>

    <?php
    	$db = new mysqli('localhost', 'cs143', '', 'CS143');
      if($db->connect_errno > 0){
          die('Unable to connect to database [' . $db->connect_error . ']');
      }

      $title = $_GET["title"];
      $actor = $_GET["actor"];
      $role = $_GET["role"];

      if (isset($title, $actor, $role)) {
        // mysql_select_db("CS143", $db);

        //get the Movie id number
        $rowSQL = $db->query("SELECT id as mid FROM Movie WHERE title = '$title';");
        $row = mysqli_fetch_array($rowSQL);

        $pieces = explode(" ", $actor);
        $aidSQL = $db->query("SELECT id as aid FROM Actor WHERE first = '$pieces[0]' and last = '$pieces[1]' ;");
        $aidRow = mysqli_fetch_array($aidSQL);

        $mid = $row["mid"];
        $aid = $aidRow["aid"];

        $query = "INSERT INTO MovieActor(mid,aid,role)
                  VALUES ($mid, $aid, '$role');";
        // echo $query;
        mysqli_query($db, $query);

        echo "add success $title $actor $role";

        $db->close();
      }
    ?>

  </div>


</body>
</html>
