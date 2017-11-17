<!DOCTYPE html>
<html lang="en">
<head>
  <title>D8 Migration Check</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php 
include 'db_connect2.php';
$sql = "SELECT DISTINCT(Name) , URL , Admin , Email , Date FROM website ORDER BY ID DESC";


$result = $conn->query($sql);

echo "<table class='table'><th>Website Name</th><th>URL</th><th>Administrator Name</th><th>Email</th><th>Report Link</th><th>Date-Time</th>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	echo "<tr>";
    	echo "<td>".$row['Name']."</td>";
    	echo "<td><a href='".$row['URL']."'>URL</a></td>";
    	echo "<td>".$row['Admin']."</td>";
    	echo "<td>".$row['Email']."</td>";
    	echo "<td><a href='http://opensenselabs.com/migration-report/".$row['Name']."'>Report</a></td>";
    	echo "<td>".$row['Date']."</td>";
        echo "</tr>";
    
    }
echo "</table>";
} 
?>
</body>
</html>
