<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Add Reviews</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontAwesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">

  <body>
    <?php include("navigation.php"); ?>

    <div class="main_container">
     <?php
       include "tables.inc";

       $name = $_GET["name"];
       $rate = $_GET["rate"];
       $comment = $_GET["comment"];
       $title = $_GET["title"];

       if (isset($_GET["id"])) {
         $id = $_GET["id"];
         $title = $_GET["title"];
       } else {
         $id = $_GET["value_key"];
       }

       print "<h3>Add New Comments for <b>'$title'</b></h3>";

       if (isset($name)) {
        // echo "hellp";
         $db = new mysqli('localhost', 'cs143', '', 'CS143');
         if($db->connect_errno > 0){
             die('Unable to connect to database [' . $db->connect_error . ']');
         }

         $rowSQL = $db->query("SELECT title as 'Title' from Movie where id = {$id}");
         // $result = $db->query($query);
         $row = mysqli_fetch_array($rowSQL);
         $title = $row['Title'];
         echo "$title";
         $time = date('Y-m-d H:i:s');
         echo "$time";
         $query = "INSERT INTO Review
                   VALUES('$name', '$time', $id, $rate, '$comment')";
         mysqli_query($db, $query);
         // $result = $db->query($query);

         $db->close();
      }



print "
      <form method='GET' action='#'>
        <div class='form-group'>
          <label for='Name'>Your Name</label>
          <input type='text' class='form-control' name='name'>
        </div>
        <div class='form-group'>
            <label for='Rating'>Your Rating</label>
            <select class='form-control' name='rate'>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>
            </select>
        </div>
        <div class='form-froup'>
          <label for='TextArea'>Your Comments</label>
          <textarea class='form-control' name='comment' rows='5'  placeholder='no more than 500 characters' ></textarea><br>
          <textarea class='secret' name='id' rows='5'  placeholder='no more than 500 characters' >$id</textarea><br>
          <textarea class='secret' name='title' rows='5'  placeholder='no more than 500 characters' >$title</textarea><br>
       </div>
       <button type='submit' name = 'bt' class='btn btn-default'>Add!</button>
      </form>
      ";

      if (isset($name)) {
        print "your comment is saved!<br>
               you can add more comment or <a href='show_M.php?id=$id'>see your comment</a>";
      }
    ?>




  </div>
  </body>
  </html>
