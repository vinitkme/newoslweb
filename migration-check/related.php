<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "d8_migration_new";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$RelatedScore = 0;
for($i = 1;$i<=45624;$i++)
{
	$sql = "SELECT ID,ReleaseType,Version FROM version WHERE ModuleID = ".$i;
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {	
    	while($row = $result->fetch_assoc()) {
        	if(substr($row['Version'],0,1) == '8')
        	{
			
        		if($row['ReleaseType'] == NULL)
        			$RelatedScore = 0;
        		elseif (substr($row['ReleaseType'],0,1) == 'r')
        			$RelatedScore = 1;
        		elseif (substr($row['ReleaseType'],0,1) == 'b')
        			$RelatedScore = 4;
        		elseif (substr($row['ReleaseType'],0,1) == 'a')
        			$RelatedScore = 6;
        		elseif (substr($row['ReleaseType'],0,1) == 'd')
        			$RelatedScore = 8;
			
	      	}
	      	else
	      	{
	      		$RelatedScore = 9;
	      	}	
        $sql2 = "UPDATE version SET RelatedScore = ".$RelatedScore." WHERE ID = ".$row['ID'];
        if($conn->query($sql2) === TRUE)
		echo "Updated";
	    else
		echo $conn->error;
        }
	} 
$RelatedScore = 0;	
}

?>
