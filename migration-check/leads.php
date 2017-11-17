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
$sql = "SELECT email,website FROM leads";


$result = $conn->query($sql);

echo "<table class='table'><th>Email</th><th>Website Name</th><th>Report Link</th>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	echo "<tr>";
    	echo "<td>".$row['email']."</td>";
    	echo "<td>".$row['website']."</td>";
    	echo "<td><a href='http://opensenselabs.com/migration-report/".$row['website']."'>Report</a></td>";
    	echo "</tr>";
    
    }
echo "</table>";
} 
?>
</body>
</html>
