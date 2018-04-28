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
<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<textarea name="query" cols="80" rows="10"></textarea><br />
	<input type="submit" value="Submit" />
</form>

<?php
	$db = new mysqli('localhost', 'cs143', '', 'CS143');
	if($db->connect_errno > 0){
	    die('Unable to connect to database [' . $db->connect_error . ']');
	}

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$query = $_GET['query'];
		if (!empty($query)) {
			$sanitized_name = $db->real_escape_string($name);
			$query_to_issue = sprintf($query, $sanitized_name);

			if (!($rs = $db->query($query_to_issue))) {
			    $errmsg = $db->error;
			    print "Query failed: $errmsg <br />";
			    exit(1);
			}

			$all_field = array();

			print "<table>";

			// meta data row
	      	print "<tr>";
	      	for($i = 0; $i < mysqli_num_fields($rs); $i++) {
	          $field_info = mysqli_fetch_field_direct($rs, $i);
	          $field_name = $field_info->name;
	          echo "<th>{$field_name}</th>";
	          array_push($all_field, $field_name);
	      	}
	      	print "</tr>";

	      	// content rows
			while($row = $rs->fetch_assoc()) {
				print "<tr>";
				foreach($all_field as $f) {
					print "<th>$row[$f]</th>";
				}
				print "</tr>";
			}

			print "</table>";
			$rs->free();
		}
	}

	$db->close();
?>

</body>
</html>