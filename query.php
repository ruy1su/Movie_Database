<html>
<head><title>CS143 Project 1B</title></head>
<style type="text/css">
	body {
		position: relative;
		left: 20%;
		top: 100px;
		width: 60%;
		text-align: center;
		margin: 0;
		/*border: 1px solid red;*/
	}
	textarea {
		margin: 10px;
	}
	input {
		font-size: 200%;
	}
	table {
    	border-collapse: collapse;
	}
	table, th {
	    border: 1px solid black;
	}
	th {
		padding: 5px;
	}
	tr:hover {
		background-color: #ABEBC6;
	}
</style>
<body>

input your query here
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<textarea name="query" cols="80" rows="10"></textarea><br />
	<input type="submit" value="Submit" />
</form>

<?php
	$db = mysql_connect("localhost", "cs143", "");
	if(!$db) {
		$errmsg = mysql_error($db);
		print "Connection failed: $errmsg <br>";
		exit(1);
	}

	mysql_select_db("CS143", $db);

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$query = $_POST['query'];
		$result = mysql_query($query, $db);
     		
        print "<table>";
   
        print "<tr>";
        for($i = 0; $i < mysql_num_fields($result); $i++) {
            $field_info = mysql_fetch_field($result, $i);
            echo "<th>{$field_info->name}</th>";
        }
        print "</tr>";

		while($row = mysql_fetch_row($result)) {
			print "<tr>";
			for($i = 0; $i < count($row); $i++) {
				print "<th>$row[$i]</th>";
			}
			print "</tr>";
		}
		print "</table>";
	}

	mysql_close($db)
?>

</body>
</html>