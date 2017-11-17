<?php
include 'db_connect2.php';
include_once('simple_html_dom.php');
$html = new simple_html_dom();


$sql = "SELECT ID,MachineName FROM module WHERE Complexity != 0 AND Complexity != -2 AND Flag != 2";

$result = $conn->query($sql);
$i = 0;
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc())
	{
		$html->load_file('https://www.drupal.org/project/'.$row['MachineName']);
		foreach($html->find('td[class="views-field views-field-field-release-version"]') as $link)
		{
			$versions[$i] = trim($link->plaintext);
			if($link->find('img'))
				$secure[$i] = 1;
			$i++;				
		}
		$i = 0;
		foreach($html->find('td[class="views-field views-field-timestamp"]') as $link)
		{
			$dates[$i] = $link->plaintext;
			$i++;
		}
		$security = 0;
		$releaseType = "";
		for($s = 0;$s<$i;$s++)
		{
			if(isset(explode('-',$versions[$s])[2]))
				$releaseType = explode('-',$versions[$s])[2];
        	else
				$releaseType = "";

			if(array_key_exists($s,$secure))
				$security = 1;
			else
			$security = 0;

			$sql = "INSERT INTO new_version (ModuleID,Version,ReleaseType,LastUpdate,Security) VALUES(".$row['ID'].",'".$versions[$s]."','".$releaseType."','".$dates[$s]."',".$security.")";
			if ($conn->query($sql) === TRUE) {
    			echo "";
			} 
			else 
			{
    		echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
}

?>