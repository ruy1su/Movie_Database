<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>CS143 Project 1c</title>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Add new Actor/Director</title>
    <link href="css/all.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontAwesome/css/font-awesome.css" rel="stylesheet">

    <body>
      <?php include("navigation.php"); ?>

      <div class="main_container">
        <h3>Add new Actor/Director</h3>

        <form method = "GET" action="add.php">
          <label for="a/d">Add:</label>
          <select name="a/d">
            <option value="Actor">Actor</option>
            <option value="Director">Director</option>
          </select>

          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" placeholder="First Name"  name="fname"/>
          </div>
          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" placeholder="Last Name" name="lname"/>
          </div>

          <label for="gender">Gender</label>
          <select name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>

          <div class="form-group">
            <label for="DOB">Date of Birth</label>
            <input type="text" class="form-control" placeholder="1997-05-05" name="dateb"><br>
          </div>
          <div class="form-group">
            <label for="DOD">Date of Die</label>
            <input type="text" class="form-control" placeholder="1997-05-05" name="dated">(leave blank if alive now)<br>
          </div>
          <button type="submit" class="btn btn-default">Add!</button>
        </form>

        <?php
        $db = new mysqli('localhost', 'cs143', '', 'CS143');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        // mysql_select_db("CS143", $db);
        $type = $_GET["a/d"];

        $fname = $_GET["fname"];
        $lname = $_GET["lname"];
        $gender = $_GET["gender"];
        $dateb = $_GET["dateb"];

        $dateb = str_replace('-', '', $dateb);
        if(!isset($dateb) || trim($dateb) == ''){
          $dateb = 'NULL';
        }
        $dated = $_GET["dated"]; 
        $dated = str_replace('-', '', $dated);
        if(!isset($dated) || $dated == ''){
          $dated = "NULL";
        }

        //get the largest id number
        $rowSQL = $db->query("SELECT MAX(id) AS max FROM MaxPersonID;");
        $row = mysqli_fetch_array($rowSQL);
        $largestNumber = $row["max"];

        if ($type == "Actor") {
          $query = "INSERT INTO Actor
          VALUES ($largestNumber+1, '{$lname}', '{$fname}', '{$gender}', '{$dateb}', $dated);
          ";
        } else {
          $query = "INSERT INTO Director
          VALUES ($largestNumber+1, '{$lname}', '{$fname}', '{$dateb}', $dated);
          ";
        }

        $query2 = "UPDATE MaxPersonID SET id = $largestNumber+1;";


        // echo $type;
        // echo "$query";
        // $res = $db->query($query);
        mysqli_query($db, $query);
        mysqli_query($db, $query2);

        if($fname != NULL) {
          print "add success: $fname $lname $gender $dateb $dated";
        }

        $db->close();
        ?>
