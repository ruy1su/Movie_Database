<?php
  $db = new mysqli('localhost', 'cs143', '', 'CS143');
  if($db->connect_errno > 0){
      die('Unable to connect to database [' . $db->connect_error . ']');
  }

  $sql = $db->query("SELECT title, year FROM Movie");
  if(mysqli_num_rows($sql)) {
    $select = '<select class="form-control" name="title">';
    while($rs = mysqli_fetch_array($sql)) {
          $select.='<option value="'.$rs['title'].'">'.$rs['title'].'   ['.$rs['year'].']'.'</option>';
      }
  }
  $select.='</select>';
  echo $select;

?>
