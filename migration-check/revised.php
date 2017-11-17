<?php

//This file contains database connection info.
include 'db_connect2.php';


//Accepting JSON File Upload from File.php,Validated and Moved to Uploads Folder.
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$jsonFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if json file is a actual json or fake
if(isset($_POST["submit"])) {
    if($jsonFileType != 'json')
    {
    	$uploadOk = 0;
        echo "Please upload JSON File Only";
         echo '<script type="text/javascript">
           window.location = "http://opensenselabs.com/migration-check/file.php"
      		</script>';
        die();
    }
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    echo '<script type="text/javascript">
           window.location = "http://opensenselabs.com/migration-check/file.php"
      		</script>';
    die();
  // if everything is ok, try to upload file
}
else
{
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       $file = $target_file;
    }
    else {

        echo "Sorry, there was an error uploading your file.";
               echo '<script type="text/javascript">
           window.location = "http://opensenselabs.com/migration-check/file.php"
      </script>';
        die();
    }
}

$email = $_POST['email'];
$mobile = $_POST['mobile'];
$admin = $_POST['admin'];
$websitename = $_POST['websitename'];
$url = $_POST['url'];

$websitename = trim($websitename);
$websitename = strtolower($websitename);
$websitename = str_replace(" ","",$websitename);

//Reading file and Decoding JSON.
$str = file_get_contents($file);
$json = json_decode($str,true);


//Fetching Information from JSON.

$data = $json['data'];


$modules = $data['modules'];
$themes = $data['themes'];
$viewsdata = $data['viewsdata'];
$files_managed = $data['files_managed'];

$newtable1 = array();
$newtable2 = array();
$newtable3 = array();
$core = array();
$custom = array();
$contrib = array();
$features = array();
$themes_info = array();
$views_info = array();
$removed = array('blog','dashboard','number');
$graph = array();
$features['min_hour'] = 0;
$features['max_hour'] = 0;
$contrib['min_hour'] = 0;
$contrib['max_hour'] = 0;
$custom['min_hour'] = 0;
$custom['max_hour'] = 0;
$themes_info['min_hour'] = 0;
$themes_info['max_hour'] = 0;
$views_info['min_hour'] = 0;
$views_info['max_hour'] = 0;




foreach ($modules as $key => $value) {

    $modulename = $value['name'];
    $type = $value['type'];
    $score = 1;

    if($type == 'Custom')
    {
        $info = '<i class="fa fa-times" aria-hidden="true"></i>';
        $score = 0;
        $version = "NA";
        $custom['number_of_modules']++;

    }
    elseif($type == 'Feature')
    {
        $info = '<i class="fa fa-times" aria-hidden="true"></i>';
        $score = 0;
        $version = "NA";
        $features['number_of_modules']++;
    }
    elseif($type == 'Core')
    {
        if(in_array($value['name'],$removed))
        {
            $score = 0;
            $info = '<i class="fa fa-times" aria-hidden="true"></i>';
            $version = "Not Available";
            $core['number_of_modules']++;

        }
        else
        {
            $info = '<i class="fa fa-check" aria-hidden="true"></i>';
            $score = 1;
            $version = "Available";
            $core['number_of_modules']++;
            $core['number_of_portable']++;
        }
    }
    else
    {
        $latest = get_latest_version($modulename);
        if(strpos($latest,'7.x') !== FALSE || strpos($latest,'Not') !== FALSE || strpos($latest,'dev') || strpos($latest,'Dev'))
        {
            $info = '<i class="fa fa-times" aria-hidden="true"></i>';
            $score = 0;
            $contrib['number_of_modules']++;
        }
        else
        {
            $info = '<i class="fa fa-check" aria-hidden="true"></i>';
            $contrib['number_of_modules']++;
            $contrib['number_of_portable']++;

        }
        $version = $latest;
    }


    if($score == 0)
        $graph[$type]['red']++;
    else
        $graph[$type]['green']++;

}

if($graph['Core']['green'] == NULL)
    $graph['Core']['green'] = 0;

if($graph['Core']['red'] == NULL)
    $graph['Core']['red'] = 0;

if($graph['Contrib']['green'] == NULL)
    $graph['Contrib']['green'] = 0;

if($graph['Contrib']['red'] == NULL)
    $graph['Contrib']['red'] = 0;

if($graph['Custom']['green'] == NULL)
    $graph['Custom']['green'] = 0;

if($graph['Custom']['red'] == NULL)
    $graph['Custom']['red'] = 0;

if($graph['Feature']['red'] == NULL)
    $graph['Feature']['red'] = 0;

if($graph['Feature']['green'] == NULL)
    $graph['Feature']['green'] = 0;

$themes_info['number_of_themes'] = 0;
foreach ($themes as $key => $value) {
	$themes_info['number_of_themes']++;
}
$views_info['number_of_views'] = 0;
foreach ($viewsdata as $key => $value) {
	$views_info['number_of_views']++;
}

$upgrade_path_y = 0;
$upgrade_path_n = 0;


foreach ($modules as $key => $value)
{
  $name = $value['name'];
  $type = $value['type'];
  if((get_latest_version_complexity($value['name'])==9 || get_latest_version_complexity($value['name'])==8))
  	$available = "No";
  else
  	$available = "Yes";

  $upgrade=array('node','path','search','shortcut','simpletest','syslog','system','menu','taxonomy','tracker','user','aggregator','block','comment','contact','field','file','filter','forum','image','locale');

  if(in_array($value['Name'],$upgrade))
  {
    $upgrade_path = "Yes";
    $upgrade_path_y++;

  }
  else
  {
    $upgrade_path = "No";
    $upgrade_path_n++;
  }

  $version = get_latest_version($value['name']);

  if($available == "Yes")
  	$required_to_port = "No";
  else
  	$required_to_port = "Yes";

  $min_hour = 0;
  $max_hour = 0;

  if($required_to_port == "Yes")
  {
  foreach ($value['files'] as $key2 => $value2)
  {
	if (strpos($key2, '.inc') !== false)
	{

	    $min_hour += round($value2/120,0);
	    $max_hour += round($value2/80,0);
	}
	elseif (strpos($key2, '.module') !== false)
	{
	    $min_hour += round($value2/120,0);
	    $max_hour += round($value2/80,0);
	}
    elseif (strpos($key2, '.js') !== false)
    {
	    $min_hour += round($value2/120,0);
	    $max_hour += round($value2/80,0);
	}
	elseif (strpos($key2, '.php') !== false)
	{
	    $min_hour += round($value2/140,0);
	    $max_hour += round($value2/100,0);
	}
	elseif (strpos($key2, '.css') !== false)
	{
	    $min_hour += round($value2/200,0);
	    $max_hour += round($value2/150,0);
	}
  }
  }


	$Issue = get_issue($name);
    if($Issue == NULL || $Issue === NULL)
        $Link = "";
    else
       $Link = "<a href = 'https://www.drupal.org".$Issue."'>Issue</a>";

$newtable2[$key+1] = array('Name' => $name, 'Type' => $type, 'Available' => $available , 'UpgradePath' => $upgrade_path , 'Version' => $version , 'RequiredToPort' => $required_to_port , 'MinTime' => $min_hour , 'MaxTime' => $max_hour , 'MinCost' => $min_hour*35 , 'MaxCost' => $max_hour*35 , 'Link' => $Link);

	if($type == "Custom")
	{
		$custom['min_hour'] += $min_hour;
		$custom['max_hour'] += $max_hour;

	}
	elseif ($type == "Contrib")
	{
		$contrib['min_hour'] += $min_hour;
		$contrib['max_hour'] += $max_hour;
	}
  elseif($type == "Feature")
  {
    $features['min_hour'] += $min_hour;
    $features['max_hour'] += $max_hour;
  }
}
$i = $key + 1;

foreach ($themes as $key => $value) {

$name = $value['name'];
$type = "Theme";
$available = "No";
$upgrade_path = "No";
$version = "7.x-1.x";
$required_to_port = "Yes";

$min_hour = 0;
$max_hour = 0;

  foreach ($value['files'] as $key2 => $value2)
  {
	if (strpos($key2, '.inc') !== false)
	{

	    $min_hour += round($value2/120,0);
	    $max_hour += round($value2/80,0);
	}
	elseif (strpos($key2, '.module') !== false)
	{
	    $min_hour += round($value2/120,0);
	    $max_hour += round($value2/80,0);
	}
    elseif (strpos($key2, '.js') !== false)
    {
	    $min_hour += round($value2/120,0);
	    $max_hour += round($value2/80,0);
	}
	elseif (strpos($key2, '.php') !== false)
	{
	    $min_hour += round($value2/140,0);
	    $max_hour += round($value2/100,0);
	}
	elseif (strpos($key2, '.css') !== false)
	{
	    $min_hour += round($value2/200,0);
	    $max_hour += round($value2/150,0);
	}
  }


  $themes_info['min_hour'] += $min_hour;
  $themes_info['max_hour'] += $max_hour;

  $newtable2[$i] = array('Name' => $name, 'Type' => $type, 'Available' => $available , 'UpgradePath' => $upgrade_path , 'Version' => $version , 'RequiredToPort' => $required_to_port , 'MinTime' => $min_hour , 'MaxTime' => $max_hour , 'MinCost' => $min_hour*35 , 'MaxCost' => $max_hour*35 , 'Link' => $Link);

$i++;
}

foreach ($viewsdata as $key => $value) {
   $name = $value['view'];
   $type = "View";
   $description = $value['description'];
   $displays = $value['displays'];
   $views_min_man_hrs =  (8+(($value['displays']-1)*2));
   $views_max_man_hrs =  (16+(($value['displays']-1)*4));
   $views_info['min_hour'] += $views_min_man_hrs;
   $views_info['max_hour'] += $views_max_man_hrs;
   $newtable3[$key+1] = array('Name'=>$name , 'Type' => $type , 'Description' => $description , 'Displays' => $displays , 'MinHour' => $views_min_man_hrs , 'MaxHour' => $views_max_man_hrs , 'MinCost' => $views_min_man_hrs*35 , 'MaxCost' => $views_max_man_hrs*35);

}

$total_man_hours_max_website = $custom['max_hour'] + $contrib['max_hour'] + $features['max_hour'] + $themes_info['max_hour'] + $views_info['max_hour'];
$total_man_hours_modules_man_hrs_max = $contrib['max_hour'] + $custom['max_hour'];
$total_man_hours_modules_man_hrs_min = $custom['min_hour'] + $contrib['min_hour'];

$modules_features_max = $contrib['max_hour'] + $custom['max_hour'] + $features['max_hour'];
$modules_features_min = $contrib['min_hour'] + $custom['min_hour'] + $features['min_hour'];


$compatibility_max = ($total_man_hours_max_website - ($total_man_hours_modules_man_hrs_max + $total_man_hours_modules_man_hrs_min)/2)/$total_man_hours_max_website * 100;
$compatibility_max = round($compatibility_max,0);

$man_days_min = ($custom['min_hour'] + $contrib['min_hour'] +$features['min_hour'] + $themes_info['min_hour'] + $views_info['min_hour'])/8;
$man_days_max = ($custom['max_hour'] + $contrib['max_hour'] +$features['max_hour'] + $themes_info['max_hour'] + $views_info['max_hour'])/8;

$man_time_min = ($custom['min_hour'] + $contrib['min_hour'] +$features['min_hour'] + $themes_info['min_hour'] + $views_info['min_hour']);
$man_time_max = ($custom['max_hour'] + $contrib['max_hour'] +$features['max_hour'] + $themes_info['max_hour'] + $views_info['max_hour']);

$contrib_time_p = ($contrib['min_hour'] + $contrib['max_hour'])/($man_time_min + $man_time_max) * 100;
$custom_time_p = ($custom['min_hour'] + $custom['max_hour'])/($man_time_min + $man_time_max) * 100;
$features_time_p = ($features['min_hour'] + $features['max_hour'])/($man_time_min + $man_time_max) * 100;
$themes_time_p = ($themes_info['min_hour'] + $themes_info['max_hour'])/($man_time_min + $man_time_max) * 100;
$views_time_p = ($views_info['min_hour'] + $views['max_hour'])/($man_time_min + $man_time_max) * 100;


$mailmessage = "NAME : ".$admin."\nMobile : ".$mobile."\nEmail : ".$email." \nWebsiteName : ".$websitename."\nURL : ".$url."\nStatus : Score Checked by Uploading JSON";

mail('vid@opensenselabs.com','Score Checked by '.$websitename,$mailmessage);

//Populating Website Table with Name of Website who is checking score.
$sql0 = "INSERT INTO website (Name,URL,Admin,Email,Phone,JSONFile) VALUES ('".$websitename."','".$url."','".$admin."','".$email."','".$mobile."','".$file."')";
if ($conn->query($sql0) === TRUE)
{
    $last_id = $conn->insert_id;
}
else
{
    echo $conn->error;
    $last_id = 0;
    die();
}




function get_latest_version($key)
{
    include 'db_connect2.php';
    $version = "Not Available";
    $sql = "SELECT ID,Complexity FROM module WHERE MachineName = '".$key."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            if($row['Complexity'] == 0)
              return "Moved to Core";
            elseif($row['Complexity'] == -2)
              return "Alternate Module Available";
            else
              return $version = latest_version($row['ID']);
        }
    }
    else
    {
        $sql4 = "SELECT ParentID,ParentComplexity FROM submodule WHERE MachineName = '".$key."'";
        $result4 = $conn->query($sql4);

            if ($result4->num_rows > 0) {
                while($row4 = $result4->fetch_assoc()) {
                  if($row['ParentComplexity'] == 0)
                    return "Moved to Core";
                  elseif($row['ParentComplexity'] == -2)
                    return "Alternate Module Available";
                  else
                    return $version =  latest_version($row4['ParentID']);
                }
            }
    }
    return $version;
}

function latest_version($ID)
{
    include 'db_connect2.php';
    $v = "Not Available";
    $nsql = "SELECT Version FROM version WHERE ModuleID = ".$ID." ORDER BY RelatedScore ASC LIMIT 1";
    $result = $conn->query($nsql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           $v =  $row['Version'];
        }
    }
    return $v;
}

function get_issue($key)
{
    include 'db_connect2.php';
    $sql = "SELECT ID FROM module WHERE MachineName = '".$key."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            return get_issue_info($row['ID']);
        }
    }
}

function get_issue_info($ID)
{
    include 'db_connect2.php';
    $sql = "SELECT IssueID FROM module_extra WHERE ID = ".$ID;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            return $row['IssueID'];
        }
    }
}

function get_latest_version_complexity($key)
{
   include 'db_connect2.php';
    $sql = "SELECT ID,Complexity FROM module WHERE MachineName = '".$key."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

            if($row['Complexity'] == 0)
              return 0;
            if($row['Complexity'] == -2)
              return 0;

            $version = latest_version_complexity($row['ID']);
            return $version;

        }
    }
    else
    {

        $sql4 = "SELECT ParentID,ParentComplexity FROM submodule WHERE MachineName = '".$key."'";

        $result4 = $conn->query($sql4);

            if ($result4->num_rows > 0) {
                while($row4 = $result4->fetch_assoc()) {

                    if($row['ParentComplexity'] == 0)
                      return 0;
                    if($row['ParentComplexity'] == -2)
                      return 0;


                    $version =  latest_version_complexity($row4['ParentID']);
                   // echo $version;
                    return $version;

                }

            }

    }
    return 9;

}



function latest_version_complexity($ID)

{
    $relatedscore = 9;
    include 'db_connect2.php';

    $nsql = "SELECT Version,RelatedScore FROM version WHERE ModuleID = ".$ID." ORDER BY RelatedScore ASC LIMIT 1";

    $result = $conn->query($nsql);


    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

           $v =  $row['Version'];
           $relatedscore = $row['RelatedScore'];
        }

    }
    return $relatedscore;
}


?>
<!DOCTYPE Html>
<html>
<head>
  <title>D8 Upgradation Estimate</title>
  <link rel="stylesheet" href="http://opensenselabs.com/themes/contrib/zurb_foundation/css/foundation.min.css" media="all" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" media="all" />
  <link rel="stylesheet" href="http://opensenselabs.com/themes/contrib/opensense/css/style.css" media="all" />
  <link rel="stylesheet" href="http://opensenselabs.com/themes/contrib/opensense/css/custom_style.css" media="all" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
  <style type="text/css">
  body {
    font-family: 'Roboto Condensed', sans-serif;
    font-weight: 400;
  }
  h1, h2, h3, h4, h5, h6 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
  }
.row-table {
    margin: auto;
}
.progress {
       margin-bottom: 10px;
    margin-top: 5px;
}
.sticky.is-stuck {

}
.migration {
        max-width: 960px;
    margin: -4em auto 0;
    padding: 0 100px;
    background: #fff;
    padding-top: 30px;
}
.checklist-wrapper table tbody {
background-color: #f6f6f6;
}
.checklist-wrapper table tbody tr:nth-child(even) {
    background-color: transparent;
}
@media print, screen and (min-width: 960px) {
  .flex-row {
            display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-flow: row wrap;
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
      }
  }
.checklist-wrapper .flex-row {
        margin-top: -35px;
    background: #fff;
    padding-top: 40px
}
      .panel {

    margin-bottom: 1.11111rem;
    padding: 1.11111rem;
    background: #f0f0f0;
    color: #333333;
}
     .panel-custom {
    border-style: solid;
    margin-bottom: 1.11111rem;
    padding: 1.11111rem;
    border:0 !important;
    color: #333333;
}
.estimation-block {
  margin-top: 1em;
}
.estimation-block li {
  padding-right: 30px;
}
.estimation-block h4 {
  font-size: 20px;
}
.estimation-block h4 span {
  font-weight: normal;
}
.title-secondary {
    background: #1c1c1e;
    color: #f26660;
    height: 150px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: normal;
    font-family: 'gothamnarrow-book';
    text-transform: uppercase;
    font-size: 18px;
}
      .table {
    margin-top: -44px;
      }
    .custom-margin {
      margin-top: -68px;
    }

      .table-header thead th {
        background: #000;
    padding: 12px 10px;
    color: #fff;
    font-size: 14px;
    border-right: 1px solid #666;
    margin: 0;

      }
      .table table thead {
        opacity: 0;
      }
      .table-header table tbody th, .table-header table tbody td {
        font-size: 14px;
        color: #333;
        border: 1px solid #f1f1f1;
        word-break: break-all;
      }
     /* .height300 {
        height: 300px;
      }*/
      .top40 {
        margin-top: 50px;
        margin-bottom: 40px;
      }
      .header-section {
        z-index: 9;
      }
      .border-right {
        border-right: 1px solid #ccc;
        padding-right: 15px;
        margin-right: 15px;
      }
      .table table thead th {
        padding: 0;
      }
      .report-table .fa-check {
        color: #47b25b;
      }
      .report-table .fa-times {
        color: #cf1515;
      }
      hr {
        border-color: #eee;
      }
      [type='file'], [type='checkbox'], [type='radio'] {
        margin: 0;
      }
      .report-table {
        padding-left: 10px;
        padding-right: 10px;
        position: relative;
      }
      .justify-center {
        justify-content: center;
      }
      .migration_details_block {
    font-size: 18px;
      }
      .mig-value {
        font-weight: bold;
        /*    color: #fff;*/
        letter-spacing: 0.5px;
        text-align: left;
      }
      .mig-value li {
        padding-right: 50px;
      }
      .mig-label {
          text-align: right;
    /*color: #faaa44;*/
    letter-spacing: 0.5px
      }
      .report-table h5 {
    font-size: 16px;
    font-weight: bold;
    letter-spacing: 0.5px;
    color: #444;
    text-transform: uppercase;
      }
      .pricing-table .title {
    background-color: #333333;
    color: #EEEEEE;
    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif !important;
    font-size: 0.88889rem;
    font-weight: normal;
    padding: 0.83333rem 1.11111rem;
    text-align: center;
}
.pricing-table {
    border: solid 1px #DDDDDD;
    margin-left: 0;
    margin-bottom: 1.11111rem;
}
.pricing-table .price {
    background-color: #F6F6F6;
    color: #333333;
    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif !important;
    font-size: 1.77778rem;
    font-weight: normal;
    padding: 0.83333rem 1.11111rem;
    text-align: center;
}
.pricing-table * {
    list-style: none;
    line-height: 1;
}
.main-block-title {
        margin-top: 30px;
        margin-bottom: 75px;
}
.url-circle .fa-link {
  width: 50px;
    height: 50px;
    background: #444;
    color: #fff;
    text-align: center;
    border-radius: 50%;
    font-size: 23px;
    padding-top: 13px;
    margin-right: 12px;
}
.pricing-table .cta-button {
    background-color: #FFFFFF;
    padding: 1.11111rem 1.11111rem 0;
    text-align: center;
}
.height-auto-wrap  {
    position: relative;
    height: 80%;
}
.height300 {
    position: absolute;
    width: 100%;
    height: 100%;
}
.main-block-title h1 {
        font-size: 27px;
    margin-bottom: 24px;
    margin-top: 24px;
}
.migration-report .header-section {
    position: static;
}
.value-block {
  width: 110px;
height: 110px;
display: inline-block;
background-color: #db8518;
border-radius: 50%;
text-align: center;
font-size: 24px;
margin-right: 18px;
color: #fff;
}
.compat {
  padding-top: 40px;
}
.compat + span {
  position: relative;
top: -5px;
font-size: 20px;
}
.url {
  font-size: 26px;
}
.effort + span {
  position: relative;
top: -13px;
font-size: 20px;
}
.effort {
  padding-top: 39px;
line-height: 1;
font-size: 19px;
}
.email-mig-wrap {
  width: 100%;
text-align: center;
}
.email-mig {
  float: none;
margin: auto;
}
h1 {
  font-size: 34px;
      margin: 40px 0 40px;
}
.main-block-title {
  background: #f1f1f1;
padding: 30px 0;
}
.migration_details_block_new {
  position: relative;
}
.launch img{
  width: 205px;
  position: absolute;
  top: -53px;
}
.all-set .input-txt {
  height: 50px;
border: 0;
box-shadow: 0 0;
background: #f0f0f0;
text-align: center;
font-size: 24px;
}
.all-set .submit-btn {
  height: 50px;
  padding: 0 70px;
  border-radius: 30px;
  background-color: #000;
  border: 2px solid #000;
}
.all-set .submit-btn:hover {
  color: #fff;
  background-color: #fff;
}
@media print {
    body {
        background-color: red;
    }

.table-header thead th {
    background: #66b1e2 !important;
    padding: 12px 10px !important;
    line-height: 1;
    color: #fff !important;
    font-size: 14px !important;
    border: 1px solid #fff !important;
}
.migration_details_block_new {
    font-size: 18px;
    padding: 66px 0px;
    background: #f5f5f5 !important;
    border: 1px solid #eee;
}
}
</style>
</head>
<body class="migration-report">
<div class="row header-section columns">

    <!-- TOPBAR SECTION -->
    <nav class="top-bar important-class" data-topbar="">

      <!-- TITLE AREA & LOGO -->
      <div class="title-area float-left">
        <h1 class="logo">
          <a href="#"><img src="http://opensenselabs.com/themes/contrib/opensense/images/logo.png" alt="Home"></a>
        </h1>
      </div>
      <!-- END TITLE AREA & LOGO -->

      <!-- MENU ITEMS -->
      <!-- END MENU ITEMS -->
      <section class="top-bar-section float-right">
        <ul class="right menu">
          <!-- <li class="hide-for-small-only"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i>+91 11 41060224</a></li> -->
          <li class="hide-for-small-only"><a href="http://www.opensenselabs.com/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i>www.opensenselabs.com</a></li>

        </ul>
      </section>
    </nav>

    <!-- END TOPBAR SECTION -->
  </div>
  <h1 class="text-center">Drupal 7 to Drupal 8 Upgrade compatibility check</h1>
  <div class="main-block-title">
    <div class="row row-custom">
        <div class="migration_details_block_new columns">
          <div class="medium-3 columns launch"><img src="8launch.png"/></div>
          <div class="medium-9 columns">
          <div><span class="url-circle"><i class="fa fa-link" aria-hidden="true"></i></span><span class="url"><?php echo $url; ?></span></div>

          <div class="flex-row" style="margin-top:30px">
            <ul class="menu mig-value">
              <li><span class="value-block compat"><?php echo $compatibility_max; ?>%</span><span class="value-label">Migration compatibility Status</span></li>
              <li><span class="value-block effort"><?php echo round($man_days_min,0)." to ".round($man_days_max,0)." Days"; ?></span><span class="value-label">Estimated Effort</span></li>
            </ul>
          </div>
        </div>
        </div>
      </div>
  </div>

<div class="row flex-row top40" >
<div class="medium-6 columns">
<h5>Website Analysis</h5>
<p>This lists down number of modules that your current web property has and number of modules that will need porting due to unavailblity in Drupal 8.This also gives approximate cost and time required against each other.<br>
Please note that this is an estimation made using advanced algorithm to help the decesion making of Drupal upgrade easy but exact estimation for execution may very per site and manual audit is recommended for cost and budgeting.</p>
</div>
<div class="medium-6 columns">
<div id="graph-one" style="height:400px">

</div>
</div>
</div>
<hr>
<div class="row flex-row top40" >
  <div class="medium-6 columns">
  <div class="report-table text-center">
  <h5>Time Estimation based on different types (Average)</h5>
  </div>
  <div id="piechart-one" style="height:400px">

  </div>
  </div>
  <div class="medium-6 columns">
  <div class="report-table text-center">
  <h5>Cost Estimation based on different types (Average)</h5>
  </div>
  <div id="piechart-two" style="height:400px">

  </div>
  </div>
</div>


<div class="row flex-row top40">

<div class="medium-12 columns">
<div class="report-table">
<div class="table-header">
<table id="myTable">
  <thead><tr><th>Select</th><th>Type</th><th>Number of Modules</th><th>Number of Portable Module</th><th>Time Required for Porting</th><th>Estimated Cost($)</th></tr></thead>
  <tbody>
  <tr>
    <td><input type="checkbox" checked id='Core' onclick='calc1("Core")'></td>
    <td>Core</td>
    <td><?php echo $core['number_of_modules']; ?></td>
    <td><?php echo $core['number_of_portable']; ?></td>
    <td id="Core_time">0 to <?php echo ($core['number_of_modules'] - $core['number_of_portable']); ?></td>
    <td id="Core_cost">$0</td>
 </tr>
 <tr>
   <td><input type="checkbox" checked id='Custom' onclick='calc1("Custom")'></td>
   <td>Custom</td>
   <td><?php echo $custom['number_of_modules']; ?></td>
   <td>0</td>
   <td id="Custom_time"><?php echo $custom['min_hour']." to ".$custom['max_hour']; ?></td>
   <td id="Custom_cost"><?php echo ($custom['min_hour']*35)." to ".($custom['max_hour']*35); ?></td>
 </tr>
 <tr>
   <td><input type="checkbox" checked id='Contrib' onclick='calc1("Contrib")'></td>
   <td>Contributed</td>
   <td><?php echo $contrib['number_of_modules']; ?></td>
   <td><?php echo $contrib['number_of_portable']; ?></td>
   <td id="Contrib_time"><?php echo $contrib['min_hour']." to ".$contrib['max_hour']; ?></td>
   <td id="Contrib_cost"><?php echo ($contrib['min_hour']*35)." to ".($contrib['max_hour']*35); ?></td>
 </tr>
  <tr>
   <td><input type="checkbox" checked id='Feature' onclick='calc1("Feature")'></td>
   <td>Features</td>
   <td><?php echo $features['number_of_modules']; ?></td>
   <td>0</td>
   <td id="Feature_time"><?php echo $features['min_hour']." to ".$features['max_hour']; ?></td>
   <td id="Feature_cost"><?php echo ($features['min_hour']*35)." to ".($features['max_hour']*35); ?></td>
 </tr>
  <tr>
   <td><input type="checkbox" checked id='Theme' onclick='calc1("Theme")'></td>
   <td>Themes</td>
   <td><?php echo $themes_info['number_of_themes']; ?></td>
   <td>0</td>
   <td id="Theme_time"><?php echo $themes_info['min_hour']." to ".$themes_info['max_hour']; ?></td>
   <td id="Theme_cost"><?php echo ($themes_info['min_hour']*35)." to ".($themes_info['max_hour']*35); ?></td>
 </tr>
  <tr>
   <td><input type="checkbox" checked id='View' onclick='calc1("View")'></td>
   <td>Views</td>
   <td><?php echo $views_info['number_of_views']; ?></td>
   <td>0</td>
   <td id="View_time"><?php echo $views_info['min_hour']." to ".$views_info['max_hour']; ?></td>
   <td id="View_cost"><?php echo ($views_info['min_hour']*35)." to ".($views_info['max_hour']*35); ?></td>
 </tr>
 </tbody>
</table>
</div>
<div class="estimation-block panel">
<ul class="menu">
<li><h4><i class="fa fa-clock-o" aria-hidden="true"></i> Time : <span><span id='total_time_min'><?php echo round($man_time_min,0);  ?></span> to <span id='total_time_max'><?php echo round($man_time_max,0); ?></span></span></h4></li>
<li><h4><i class="fa fa-usd" aria-hidden="true"></i> Cost : <span><span id='total_cost_min'><?php echo round($man_time_min*35,0);  ?></span> to <span id='total_cost_max'><?php echo round($man_time_max*35,0);  ?></span></span></h4></li>
</ul>
</div>

</div>
</div>
</div>
<hr>
<div class="row flex-row top40">

<div class="medium-12 columns">
<div class="report-table text-center">
<h4>How will your web  property be upgraded to Drupal8</h4>
  </div>
<div class="report-table">
<div class="table-header">
<h5>SUMMARY</h5>
            <table border="1">
                  <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Item</th>
                        <th width="400">Description</th>
                        <th>Min Hours</th>
                        <th>Max Hours</th>
                    </tr>
                </thead>
                <tbody>
                   <tr>
                       <td>1</td>
                       <td>Migration Enviornment Setup</td>
                       <td>The Drupal 7 site to be upgraded is deployment on development enviornment and verified. Also, D8 Vanila Install of Drupal 8 is deployed where the migration will be done.</td>
                       <td>4</td>
                       <td>16</td>
                   </tr>
                    <tr>
                       <td>2</td>
                       <td>Module Rewrite</td>
                       <td>1. Custom modules are re-written for Drupal 8<br>
2. All contrib modules which are not available for D8 are re-written if needed. The manual audit is required to find alternative ways of implementing same features in Drupal 8 to save time.</td>
                       <td><?php echo $modules_features_min; ?></td>
                       <td><?php echo $modules_features_max ?></td>
                   </tr>
                   <tr>
                       <td>3</td>
                       <td>Prepare Upgrade path</td>
                       <td>Upgrade path for migration to be written for those contrib modules which are availble but do not have a upgrade path. <br>
Manual Audit is required to classify such modules in 2 categories. <br>
1. Need an upgrade path<br>
2. Re-Cofigure in Drupal 8 without upgrade path.</td>
                       <td><?php echo $upgrade_path_n*6; ?></td>
                       <td><?php echo $upgrade_path_n*8; ?></td>
                   </tr>
                   <tr>
                       <td>4</td>
                       <td>Run Migration</td>
                       <td>The migrate upgrade module is executed here. This usually takes few attempts to resolve issues faced before a successfull migration is done. The Nodes, Terms, USers are other entities are migrated to Drupal 8 site here. <br>
The time estimate a very directly proportional to complexity of site.</td>
                       <td>16</td>
                       <td>60</td>
                   </tr>
                   <tr>
                       <td>5</td>
                       <td>Re-Build Views</td>
                       <td>Views are not automatically upgraded to Drupal 8. All the views are rebuilt.</td>
                       <td><?php echo $views_info['min_hour']; ?></td>
                       <td><?php echo $views_info['max_hour']; ?></td>
                   </tr>
                   <tr>
                       <td>6</td>
                       <td>Rebuild Features</td>
                       <td>Features are not supported my automated upgrade. We need to re-package the features and build/configure the missing dependencies.</td>
                       <td><?php echo $features['min_hour']; ?></td>
                       <td><?php echo $features['max_hour']; ?></td>
                   </tr>
                   <tr>
                       <td>7</td>
                       <td>Site Rebuilding.</td>
                       <td>All the configuration and site rebuilding is done for missing items. Examples, Rules, Display Suits, Panel Pages etc.</td>
                       <td>THIS CANNOT BE ESTIMATED WITHOUT MANUAL AUDIT</td>
                       <td>THIS CANNOT BE ESTIMATED WITHOUT MANUAL AUDIT</td>
                   </tr>
                   <tr>
                       <td>8</td>
                       <td>Theme Building</td>
                       <td>Drupal 8 uses a completly new templating engine Twig. The theme needs to re developed. Chunks and pieces of code can be reused. The exact extent of re-use can be figured only after manual audit.</td>
                       <td><?php echo $themes_info['min_hour']; ?></td>
                       <td><?php echo $themes_info['max_hour']; ?></td>
                   </tr>
                   <tr>
                       <td>9</td>
                       <td>File Systems</td>
                       <td>The public files are handled mostly by the automated migration above. The private files needs to mugrated in seperate way. <br>
Also the validation is executed here to verify 100% successful igration of files.</td>
                       <td>8 </td>
                       <td>16 </td>
                   </tr>
                   <tr>
                       <td>10</td>
                       <td>Data Validation</td>
                       <td>A validation is executed to varify data consitency from source Drupal 7 site and migrated Drupal 8 Site.</td>
                       <td>8 <?php $total_code_man_min_hrs+=8;?></td>
                       <td>16  <?php $total_code_man_max_hrs+=16;?></td>
                   </tr>
                   <tr>
                       <td>11</td>
                       <td>QA</td>
                       <td>A standard QA process ensures UAT.</td>
                       <td>10</td>
                       <td>20</td>
                   </tr>
                   <tr>
                       <td>12</td>
                       <td> Deployment</td>
                       <td>The migrated Drupal 8 site is migrated to production and staging infrastructure.</td>
                       <td>8 </td>
                       <td>16 </td>
                   </tr>
                   <tr>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                   </tr>
                   <tr style="background-color: #ddd">
                       <td></td>
                       <td><strong>Total</strong></td>
                       <td></td>
                       <td><?php echo ($man_time_min + $upgrade_path_n*6 + 54); ?>*</td>
                       <td><?php echo ($man_time_max + $upgrade_path_n*8 + 144);?>*</td>
                   </tr>
                </tbody>
            </table>
                        </div>
            </div>
            </div>
            </div>

<hr>

<div class="row flex-row top40">
<div class="medium-12 columns">
<div class="report-table">
<div class="panel-custom">
<h5>Modules Porting Effort Estimation</h5>
<p>This is a detailed analysis for all Core Modules, Custom Modules, Contrib Modules, Features and Themes. You can select/de-select as per your requirement and see final estimation in the calculator.</p>
</div>
<div class="table-header">
<table id="myTable2">
<thead><tr><th>S.No</th><th>Select</th><th>Module</th><th>Type</th><th>Available</th><th>Upgrade Path</th><th>Version</th><th>Required to Port</th><th>Min Time</th><th>Max Time</th><th>Min Cost(In $)</th><th>Max Cost(In $)</th><th>Link</th></tr></thead><tbody>
<?php
foreach ($newtable2 as $key => $value) {
  echo "<tr>";
  echo "<td>".$key."</td>";
  echo "<td>"."<input type='checkbox' checked id='t2c$key' onclick='calc($key)' class = '".$value['Type']."'></td>";
  echo "<td>".$value['Name']."</td>";
  echo "<td>".$value['Type']."</td>";
  echo "<td>".$value['Available']."</td>";
  echo "<td>".$value['UpgradePath']."</td>";
  echo "<td>".$value['Version']."</td>";
  echo "<td>".$value['RequiredToPort']."</td>";
  echo "<td id='t2mint$key'>".$value['MinTime']."</td>";
  echo "<td id='t2maxt$key'>".$value['MaxTime']."</td>";
  echo "<td id='t2minc$key'>".($value['MinTime']*35)."</td>";
  echo "<td id='t2maxc$key'>".($value['MaxTime']*35)."</td>";
  echo "<td>".$value['Link']."</td>";
  echo "</tr>";
}
?>
</tbody>
</table>
</div>
<div class="estimation-block panel">
  <ul class="menu">
<li><h4><i class="fa fa-clock-o" aria-hidden="true"></i> Time : <span><span id='time_min_checkbox'><?php echo round($modules_features_min,0)  ?></span> to <span id='time_max_checkbox'><?php echo round($modules_features_max,0) ?></span></span></h4>
<li><h4><i class="fa fa-usd" aria-hidden="true"></i> Cost : <span><span id='cost_min_checkbox'><?php echo round($modules_features_min*35,0)  ?></span> to <span id='cost_max_checkbox'><?php echo round($modules_features_max*35,0)  ?></span></span></h4>
</ul>
</div>
</div>
</div>
</div>
<hr>
<div class="row flex-row top40">

<div class="medium-12 columns">
<div class="report-table">
<div class="panel-custom">
<h5>Views Porting Effort Estimation</h5>
<p>Since views are not automatically upgraded to Drupal 8. All the views will be rebuilt. The below is analysis on the estimation required to build them.</p>
</div>
<div class="table-header">
<table id="myTable3">
  <thead><tr><th>S.NO</th><th>Select</th><th>Name</th><th>Type</th><th>Descriptions</th><th>Displays</th><th>Min Time</th><th>Max Time</th><th>Min Cost(In $)</th><th>Max Cost(In $)</th></tr></thead><tbody>
  <?php
    foreach ($newtable3 as $key => $value)
    {
    echo "<tr>";
    echo "<td>$key</td>";
    echo "<td><input type='checkbox' class='View' checked id='v2c$key' onclick='vcalc($key)'></td>";
    echo "<td>".$value['Name']."</td>";
    echo "<td>".$value['Type']."</td>";
    echo "<td>".$value['Descriptions']."</td>";
    echo "<td>".$value['Displays']."</td>";
    echo "<td id='v2mint$key'>".$value['MinHour']."</td>";
    echo "<td id='v2maxt$key'>".$value['MaxHour']."</td>";
    echo "<td id='v2minc$key'>".($value['MinHour']*35)."</td>";
    echo "<td id='v2maxc$key'>".($value['MaxHour']*35)."</td>";
    }
   ?>
   </tbody>
</table>
</div>
<div class="estimation-block panel">
  <ul class="menu">
<li><h4><i class="fa fa-clock-o" aria-hidden="true"></i> Time : <span><span id="view_time_min_checkbox"><?php echo $views_info['min_hour']; ?></span> to <span id="view_time_max_checkbox"><?php echo $views_info['max_hour']; ?></span></span></h4>
<li><h4><i class="fa fa-usd" aria-hidden="true"></i> Cost : <span><span id="view_cost_min_checkbox"><?php echo $views_info['min_hour']*35; ?></span> to <span id="view_cost_max_checkbox"><?php echo $views_info['max_hour']*35; ?></span></span></h4>
</ul>
</div>

</div>
</div>
</div>
<hr>
<div class="row flex-row top40 columns">
<div class="report-table email-mig-wrap">
<div class="medium-7 columns email-mig">

<h3>All Set to Migrate</h3>
<p>Get in Touch with our drupal experts and we will setup a call to understand your needs better.<br> drop in your email below.</p>
<form action="sendmail.php" method="post" class="all-set">
 <input class="input-txt" style="height: 50px;"  placeholder="Email" type="email" name="email" value="<?php echo $email; ?>">
<input style="height: 50px;" class="button submit-btn" type="submit" value="Submit">
</form>
</div>
</div>
</div>
</body>
<script type="text/javascript">

  function calc(id)
  {
    if (document.getElementById('t2c'+id).checked)
    {
      var time_min = Number(document.getElementById('time_min_checkbox').innerHTML);
      var time_max = Number(document.getElementById('time_max_checkbox').innerHTML);
      var reduce_min = Number(document.getElementById('t2mint'+id).innerHTML);
      var reduce_max = Number(document.getElementById('t2maxt'+id).innerHTML);

      var cost_min = Number(document.getElementById('cost_min_checkbox').innerHTML);
      var cost_max = Number(document.getElementById('cost_max_checkbox').innerHTML);
      var reduce_min_c = Number(document.getElementById('t2minc'+id).innerHTML);
      var reduce_max_c = Number(document.getElementById('t2maxc'+id).innerHTML);

      document.getElementById('time_min_checkbox').innerHTML = time_min + reduce_min;
      document.getElementById('time_max_checkbox').innerHTML = time_max + reduce_max;
      document.getElementById('cost_min_checkbox').innerHTML = cost_min + reduce_min_c;
      document.getElementById('cost_max_checkbox').innerHTML = cost_max + reduce_max_c;
    }
    else {
      var time_min = Number(document.getElementById('time_min_checkbox').innerHTML);
      var time_max = Number(document.getElementById('time_max_checkbox').innerHTML);
      var reduce_min = Number(document.getElementById('t2mint'+id).innerHTML);
      var reduce_max = Number(document.getElementById('t2maxt'+id).innerHTML);

      var cost_min = Number(document.getElementById('cost_min_checkbox').innerHTML);
      var cost_max = Number(document.getElementById('cost_max_checkbox').innerHTML);
      var reduce_min_c = Number(document.getElementById('t2minc'+id).innerHTML);
      var reduce_max_c = Number(document.getElementById('t2maxc'+id).innerHTML);

      document.getElementById('time_min_checkbox').innerHTML = time_min - reduce_min;
      document.getElementById('time_max_checkbox').innerHTML = time_max - reduce_max;
      document.getElementById('cost_min_checkbox').innerHTML = cost_min - reduce_min_c;
      document.getElementById('cost_max_checkbox').innerHTML = cost_max - reduce_max_c;
    }
  }

  function vcalc(id)
  {
    if (document.getElementById('v2c'+id).checked)
    {
      var time_min = Number(document.getElementById('view_time_min_checkbox').innerHTML);
      var time_max = Number(document.getElementById('view_time_max_checkbox').innerHTML);
      var reduce_min = Number(document.getElementById('v2mint'+id).innerHTML);
      var reduce_max = Number(document.getElementById('v2maxt'+id).innerHTML);

      var cost_min = Number(document.getElementById('view_cost_min_checkbox').innerHTML);
      var cost_max = Number(document.getElementById('view_cost_max_checkbox').innerHTML);
      var reduce_min_c = Number(document.getElementById('v2minc'+id).innerHTML);
      var reduce_max_c = Number(document.getElementById('v2maxc'+id).innerHTML);

      document.getElementById('view_cost_min_checkbox').innerHTML = cost_min + reduce_min_c;
      document.getElementById('view_cost_max_checkbox').innerHTML = cost_max + reduce_max_c;

      document.getElementById('view_time_min_checkbox').innerHTML = time_min + reduce_min;
      document.getElementById('view_time_max_checkbox').innerHTML = time_max + reduce_max;
    }
    else {
      var time_min = Number(document.getElementById('view_time_min_checkbox').innerHTML);
      var time_max = Number(document.getElementById('view_time_max_checkbox').innerHTML);
      var reduce_min = Number(document.getElementById('v2mint'+id).innerHTML);
      var reduce_max = Number(document.getElementById('v2maxt'+id).innerHTML);

      var cost_min = Number(document.getElementById('view_cost_min_checkbox').innerHTML);
      var cost_max = Number(document.getElementById('view_cost_max_checkbox').innerHTML);
      var reduce_min_c = Number(document.getElementById('v2minc'+id).innerHTML);
      var reduce_max_c = Number(document.getElementById('v2maxc'+id).innerHTML);

      document.getElementById('view_cost_min_checkbox').innerHTML = cost_min - reduce_min_c;
      document.getElementById('view_cost_max_checkbox').innerHTML = cost_max - reduce_max_c;

      document.getElementById('view_time_min_checkbox').innerHTML = time_min - reduce_min;
      document.getElementById('view_time_max_checkbox').innerHTML = time_max - reduce_max;
    }
  }

  function calc1(ty)
  {
    if(document.getElementById(ty).checked)
    {
      var tdid = ty+'_time';
      var cdid = ty+'_cost';
      var time = document.getElementById(tdid).innerHTML;
      var cost = document.getElementById(cdid).innerHTML;
      var time_min = Number(time.substr(0,time.indexOf('t')-1));
      var time_max = Number(time.slice(time.indexOf('o')+1));

      var cost_min = Number(cost.substr(0,cost.indexOf('t')-1));
      var cost_max = Number(cost.slice(cost.indexOf('o')+1));

      var total_time_max = Number(document.getElementById('total_time_max').innerHTML);
      var total_time_min = Number(document.getElementById('total_time_min').innerHTML);

      var total_cost_max = Number(document.getElementById('total_cost_max').innerHTML);
      var total_cost_min = Number(document.getElementById('total_cost_min').innerHTML);

      document.getElementById('total_time_max').innerHTML = total_time_max + time_max;
      document.getElementById('total_time_min').innerHTML = total_time_min + time_min;

      document.getElementById('total_cost_max').innerHTML = total_cost_max + cost_max;
      document.getElementById('total_cost_min').innerHTML = total_cost_min + cost_min;



      if(ty == "View")
      {
        var ele = document.getElementsByClassName(ty)
        for(var i = 0;i<ele.length;i++)
        {
          var item = ele[i];
          item.checked = true;
          vcalc(item.id.substr(3));
        }
      }
      else
      {
        var ele = document.getElementsByClassName(ty)
        for(var i = 0;i<ele.length;i++)
        {
          var item = ele[i];
          item.checked = true;
          calc(item.id.substr(3));
        }
      }

    }
    else
    {
      var tdid = ty+'_time';
      var cdid = ty+'_cost';
      var time = document.getElementById(tdid).innerHTML;
      var cost = document.getElementById(cdid).innerHTML;

      var time_min = Number(time.substr(0,time.indexOf('t')-1));
      var time_max = Number(time.slice(time.indexOf('o')+1));

      var cost_min = Number(cost.substr(0,cost.indexOf('t')-1));
      var cost_max = Number(cost.slice(cost.indexOf('o')+1));

      var total_time_max = Number(document.getElementById('total_time_max').innerHTML);
      var total_time_min = Number(document.getElementById('total_time_min').innerHTML);

      var total_cost_max = Number(document.getElementById('total_cost_max').innerHTML);
      var total_cost_min = Number(document.getElementById('total_cost_min').innerHTML);

      document.getElementById('total_time_max').innerHTML = total_time_max - time_max;
      document.getElementById('total_time_min').innerHTML = total_time_min - time_min;

      document.getElementById('total_cost_max').innerHTML = total_cost_max - cost_max;
      document.getElementById('total_cost_min').innerHTML = total_cost_min - cost_min;

      if(ty == "View")
      {
        var ele = document.getElementsByClassName(ty)
        for(var i = 0;i<ele.length;i++)
        {
          var item = ele[i];
          item.checked = false;
          vcalc(item.id.substr(3));
        }
      }
      else
      {
        var ele = document.getElementsByClassName(ty)
        for(var i = 0;i<ele.length;i++)
        {
          var item = ele[i];
          item.checked = false;
          calc(item.id.substr(3));
        }
      }
    }
  }
</script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#myTable').dataTable({
      "paging":   false,
      "info": false,
    });
    $('#myTable2').dataTable({
      "paging":   false,
      "info": false,
    });
    $('#myTable3').dataTable({
      "paging":   false,
      "info": false,
    });

});
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">

var chart = Highcharts.chart('graph-one', {
      credits: {
 enabled: false
},


chart: {
        type: 'column'
      },

title: {
          text: ''
      },

legend: {
            align: 'right',
            verticalAlign: 'middle',
            layout: 'vertical'
        },

xAxis: {
          categories: ['Core', 'Contrib', 'Custom', 'Feature'],
          labels: {
          x: -10
        }
      },

yAxis: {
        allowDecimals: false,
        title: {
                text: 'Complexity'
            }
        },

        series: [{
            showInLegend: false,
            name: 'Ported',
            data: [<?php echo $graph['Core']['green'].",".$graph['Contrib']['green'].",".$graph['Custom']['green'].",".$graph['Feature']['green']; ?>]
        }, {
          showInLegend: false,
            name: 'Not Ported',
            data: [<?php echo $graph['Core']['red'].",".$graph['Contrib']['red'].",".$graph['Custom']['red'].",".$graph['Feature']['red']; ?>]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        align: 'center',
                        verticalAlign: 'bottom',
                        layout: 'horizontal'
                    },
                    yAxis: {
                        labels: {
                            align: 'left',
                            x: 0,
                            y: -5
                        },
                        title: {
                            text: null
                        }
                    },
                    subtitle: {
                        text: null
                    },
                    credits: {
                        enabled: false
                    }
                }
            }]
        }
    });

Highcharts.chart('piechart-one', {
        credits: {
 enabled: false
},
exporting: {
  enabled: false
},

            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
              showInLegend: false,
                name: 'Automated Migration',
                colorByPoint: true,
                data: [{
                    name: 'Core',
                    y: 1 }, {
                showInLegend: false,
                    name: 'Contrib',
                    y: <?php echo $contrib_time_p; ?>,
                },{
                    name: 'Custom',
                    y: <?php echo $custom_time_p; ?> },{
                    name: 'Feature',
                    y: <?php echo $features_time_p; ?> },{
                    name: 'Theme',
                    y: <?php echo $themes_time_p; ?> },{
                    name: 'View',
                    y: <?php echo $views_time_p; ?> },]
            }]
        });

Highcharts.chart('piechart-two', {
        credits: {
 enabled: false
},
exporting: {
  enabled: false
},

            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
              showInLegend: false,
                name: 'Automated Migration',
                colorByPoint: true,
                data: [{
                    name: 'Core',
                    y: 1 }, {
                showInLegend: false,
                    name: 'Contrib',
                    y: <?php echo $contrib_time_p; ?>,
                },{
                    name: 'Custom',
                    y: <?php echo $custom_time_p; ?> },{
                    name: 'Feature',
                    y: <?php echo $features_time_p; ?> },{
                    name: 'Theme',
                    y: <?php echo $themes_time_p; ?> },{
                    name: 'View',
                    y: <?php echo $views_time_p; ?> },]
            }]
        });


</script>
</html>
