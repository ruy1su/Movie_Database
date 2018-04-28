<?php
class Table {
   var $data;
   var $type;
   /*
    0: normal table (no link)
    1: actor table
    2: movie table
   */

   function __construct($data, $type=0, $title="This is a table") {
       $this->data = $data;
       $this->type = $type;
       $this->title = $title;
       $this->create();
   }

   function create() {
     $result = $this->data;
     $type = $this->type;
     $title = $this->title;

     print "<h3>$title</h3>";
     print "<table>";

     print "<tr>";
     for($i = 0; $i < mysqli_num_fields($result); $i++) {
         $field_info = mysqli_fetch_field($result);
         echo "<th>{$field_info->name}</th>";
     }
     print "</tr>";

     while($row = mysqli_fetch_row($result)) {
       print "<tr>";
       $id = $row[0];
       for($i = 0; $i < count($row); $i++) {
         switch($type) {
           case 0:
             print "<th>$row[$i]</th>"; break;
           case 1:
             print "<th><a href='Show_A.php?id={$id}'>$row[$i]</a></th>"; break;
           case 2:
             print "<th><a href='Show_M.php?id={$id}'>$row[$i]</a></th>"; break;
           default:
             print "table type error!"; break;
         }
       }
       print "</tr>";
     }
     print "</table>";
     print "<br>";
   }

}
?>
