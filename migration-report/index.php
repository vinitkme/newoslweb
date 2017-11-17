<?php
include 'db_connect2.php';

//Reading file and Decoding JSON.
$url = "";
$requesturi = $_SERVER['REQUEST_URI'];
$web = substr($requesturi,strripos($requesturi,'/')+1);

$web = trim($web);
$web = strtolower($web);
$web = str_replace(" ","",$web);


$sql = "SELECT * FROM website WHERE Name = '".$web."' ORDER BY ID DESC LIMIT 1";


$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $file = $row['JSONFile'];
       $url = $row['URL'];

    }
} else {
    print_r("You havent checked score yet");
    die();
}



$str = file_get_contents('/var/www/html/opensense/migration-check/'.$file);
$json = json_decode($str,true);


if(isset($_POST["priceph"]))
  $priceph = $_POST['priceph'];
else
  $priceph = 35;


$mailmessage = $web."Viewed Report";
mail('vid@opensenselabs.com','Score Checked for '.$web,$mailmessage);

//Fetching Information from JSON.

$data = $json['data'];


$modules = $data['modules'];
$themes = $data['themes'];
$viewsdata = $data['viewsdata'];
$files_managed = $data['files_managed'];

$newtable1 = array();
$newtable2 = array();
$newtable3 = array();
$default_theme = array();
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
$features['number_of_modules'] = 0;
$contrib['number_of_modules'] = 0;
$custom['number_of_modules']= 0;




foreach ($modules as $key => $value) {

    $modulename = $value['name'];
    $type = $value['type'];

    if($modulename == 'link')
      $type = "Contrib";

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

  if($name == 'link')
    $type = "Contrib";

  if((get_latest_version_complexity($value['name'])==9 || get_latest_version_complexity($value['name'])==8))
    $available = "No";
  else
    $available = "Yes";

  if($type == "Custom" || $type == "Feature")
    $available = "No";

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

if($type == "Contrib")
  $version = get_latest_version($value['name']);
else if($type == "Core")
  $version = "Available";
else
  $version = "Not Available";

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

  if($type == "Contrib")
  {
    $Issue = get_issue($name);

    if($Issue == NULL || $Issue === NULL)
        $Link = "";
    else
       $Link = "<a href = 'https://www.drupal.org".$Issue."'>Issue</a>";
  }
  elseif($type == "Feature" || $type == "Custom" || $type == "Theme" || $type == "Core")
  {
    $Issue == NULL;
    $Link = "";
  }



$newtable2[$key+1] = array('Name' => $name, 'Type' => $type, 'Available' => $available , 'UpgradePath' => $upgrade_path , 'Version' => $version , 'RequiredToPort' => $required_to_port , 'MinTime' => $min_hour , 'MaxTime' => $max_hour , 'MinCost' => $min_hour*$priceph , 'MaxCost' => $max_hour*$priceph , 'Link' => $Link);

$Link = "";
$Issue = NULL;

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

$type = "Theme";
if($value['type'] == "Default")
{
  $name = $value['name']."(".$value['type'].")";
  $type = "Default-Theme";
}
else
{
  $name = $value['name'];
  $type = "Theme";
}

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

  $newtable2[$i] = array('Name' => $name, 'Type' => $type, 'Available' => $available , 'UpgradePath' => $upgrade_path , 'Version' => $version , 'RequiredToPort' => $required_to_port , 'MinTime' => $min_hour , 'MaxTime' => $max_hour , 'MinCost' => $min_hour*$priceph , 'MaxCost' => $max_hour*$priceph , 'Link' => $Link);


 if($value['type'] == "Default")
{
  $default_theme['min_hour'] = $min_hour;
  $default_theme['max_hour'] = $max_hour;
}


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
   $newtable3[$key+1] = array('Name'=>$name , 'Type' => $type , 'Description' => $description , 'Displays' => $displays , 'MinHour' => $views_min_man_hrs , 'MaxHour' => $views_max_man_hrs , 'MinCost' => $views_min_man_hrs*$priceph , 'MaxCost' => $views_max_man_hrs*$priceph);

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
$themes_time_p = (($themes_info['min_hour'] - $default_theme['min_hour']) + ($themes_info['max_hour'] - $default_theme['max_hour']))/($man_time_min + $man_time_max) * 100;
$views_time_p = ($views_info['min_hour'] + $views['max_hour'])/($man_time_min + $man_time_max) * 100;
$default_theme_time_p = ($default_theme['min_hour'] + $default_theme['max_hour'])/($man_time_min + $man_time_max) * 100;

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
                  if($row4['ParentComplexity'] == 0)
                    return "Moved to Core";
                  elseif($row4['ParentComplexity'] == -2)
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

                    if($row4['ParentComplexity'] == 0)
                      return 0;
                    if($row4['ParentComplexity'] == -2)
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

  <link rel="shortcut icon" href="http://opensenselabs.com/core/misc/favicon.ico" type="image/vnd.microsoft.icon" />
  <link rel="stylesheet" href="http://opensenselabs.com/themes/zurb_foundation/css/foundation.min.css" media="all" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" media="all" />
  <link rel="stylesheet" href="http://opensenselabs.com/themes/opensenselabs/css/styles.css" media="all" />
  <link rel="stylesheet" href="http://opensenselabs.com/themes/opensenselabs/css/custom_style.css" media="all" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

  <style type="text/css">
  h1{
  font-family: 'Montserrat', sans-serif;
font-weight: 700;
}
h1, h2, h3, h4, h5, h6 {
    font-family: 'Montserrat', sans-serif;
}
body{
font-family: 'Roboto Condensed', sans-serif;
font-weight: 300;
font-size: 16px;
}
.success {
  color: #3adb76 ;
}
.button:hover {
  color: #fff !important;
}
.button:focus{
  outline: 0;
}
  .migration-page {
    /* Akira */ }
    .migration-page .input {
      position: relative;
      z-index: 1;
      display: inline-block;
      margin: 1em 1em 1.5em;
      width: calc(100% - 2em);
      vertical-align: top; }
    .migration-page .input__field {
      position: relative;
      display: block;
      float: right;
      padding: 0.8em;
      width: 60%;
      border: none;
      border-radius: 0;
      -webkit-appearance: none;
      /* for box shadows to show on iOS */ }
      .migration-page .input__fieldfocus {
        outline: none; }
    .migration-page .input__label {
      display: inline-block;
      float: right;
      padding: 0 1em;
      width: 40%;
      font-size: 0.833rem;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      -webkit-touch-callout: none;
      -webkit-user-select: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none; }
    .migration-page .input__label-content {
      position: relative;
      display: block;
      width: 100%; }
    .migration-page .input__field--akira {
      position: absolute;
      top: 0;
      left: 0;
      z-index: 10;
      display: block;
      padding: 0 1em;
      width: 100%;
      height: 100%;
      background: transparent;
      text-align: center;
      box-shadow: 0 0 0;
      border-bottom: 1px solid #000;
      height: 45px; }
    .migration-page .input__label--akira {
      padding: 0;
      width: 100%;
      cursor: text; }
    .migration-page .input__label--akira::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      -webkit-transform: scale3d(0.97, 0.85, 1);
      transform: scale3d(0.97, 0.85, 1);
      -webkit-transition: -webkit-transform 0.3s;
      transition: transform 0.3s; }
    .migration-page .input__label-content--akira {
      -webkit-transition: -webkit-transform 0.3s;
      transition: transform 0.3s; }
    .migration-page .input__field--akira:focus + .input__label--akira::before,
    .migration-page .input--filled .input__label--akira::before {
      -webkit-transform: scale3d(0.99, 0.95, 1);
      transform: scale3d(0.99, 0.95, 1); }
    .migration-page .input__field--akira:focus + .input__label--akira,
    .migration-page .input--filled .input__label--akira {
      cursor: default;
      pointer-events: none; }
    .migration-page .input__field--akira:focus + .input__label--akira .input__label-content--akira,
    .migration-page .input--filled .input__label-content--akira {
      -webkit-transform: translate3d(0, -2em, 0);
      transform: translate3d(0, -2em, 0);
      color: #0071a5; }
    .migration-page .upload-json {
      margin-bottom: 1em; }
    .migration-page .file-icon {
      background: url(../images/file-icon.png) left center no-repeat;
      display: inline-block;
      padding: 0 45px;
      cursor: pointer; }

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
  .flex-row-custom {
    display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
align-items: center;
  }
  .flex-row-custom input {
    margin-bottom: 0;
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
        text-align: center;
      }
      .mig-value li {
        padding-right: 100px;
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
.price-change-container {
  justify-content: space-between;
}
.fixed {
  position: fixed;
  bottom: 250px;
  right: -160px;
  transition: all 0.2s;
  -webkit-transition: all 0.2s;
  -moz-transition: all 0.2s;
  box-shadow: -1px 1px 7px 0px rgba(0,0,0,.4);
}
.fixed-custom {
  position: fixed;
  bottom: 20px;
  right: 20px;
}
.change-price-btn {
  width: 130px !important;
font-size: 15px;
height: 39px;
background-color: #000;
color: #fff;
border: 0;
}
.price-change {
  margin-top: 10px;
}
.fixed:hover {
  margin-right: 160px;
}
  .main-block-title {
        margin-top: 30px;
        margin-bottom: 75px;
}
table.fixed {
  right: 0;
    left: 0;
    width: 1150px;
    margin: auto;
    top: 0 !important;
    bottom: auto;
}
table.fixed:hover {
  margin: auto;
}
table.fixed tbody {
  display: none;
}
table.fixed th {
  padding: 12px 10px !im;
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
.migration-label li {
  font-size: 22px;
  margin-bottom: 48px;
  text-align: right;
  font-weight: 600;
  color: #616161;
}
.migration-value li {
  font-size: 44px;
font-weight: 700;
line-height: 1;
padding-bottom: 35px;
}

.migration-label ul.menu {
  margin-right: 25px;
padding-right: 25px;
border-right: 1px solid #444;
}
.url {
  font-size: 26px;
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
position: relative;
z-index: 1;
}
.migration_details_block_new {
  position: relative;
}
.launch img{
  width: 250px;
  position: absolute;
  bottom: -30px;
  left: -20px;
}

.all-set .submit-btn {

  border-radius: 30px;

}
.all-set .submit-btn:hover {
  color: #fff;
  background-color: #fff;
}
.url-link {
  margin: 0px 145px;
background: #f9f9f9;
padding: 0 31px;
}
.docs-code-copy {
    position: absolute;
    top: 0;
    right: 0;
    background: #1779ba;
    color: white;
    font-size: 0.8rem;
    padding: 0.75rem 1rem;
    z-index: 1;
}
.docs-code, pre {
  position: relative;
  margin-bottom: 20px;
}
.docs-code code, pre code {
    display: block;
    overflow-x: auto;
    padding: 1rem;
    background: #f9f9f9;
    margin-bottom: 1.5rem;
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
<body class="migration-report" ng-app="myApp">
<div class="row header-section columns">

    <!-- TOPBAR SECTION -->
    <nav class="top-bar important-class" data-topbar="">

      <!-- TITLE AREA & LOGO -->
      <div class="title-area float-left">
        <h1 class="logo">
          <a href="/"><img src="http://opensenselabs.com/themes/opensenselabs/images/logo-black.png" alt="Home"></a>
        </h1>
      </div>
      <!-- END TITLE AREA & LOGO -->

      <!-- MENU ITEMS -->
      <!-- END MENU ITEMS -->
      <section class="top-bar-section float-right">
        <div class="price-change">
        <!--<form action="<?php echo '/migration-report/'.$web; ?>" method="post" class="flex-row-custom">
          <span style="margin-right:10px;">Price($/hr): </span><input type="number" name="priceph" value="<?php echo $priceph; ?>">
        <input class="change-price-btn" type="submit" value="Change Price">
      </form>-->
    </div>
      </section>
    </nav>

    <!-- END TOPBAR SECTION -->
  </div>
  <h1 class="text-center">Drupal 7 to Drupal 8 Upgrade compatibility check</h1>
  <div class="main-block-title">
    <div class="row row-custom">
        <div class="migration_details_block_new columns">
          <div class="medium-3 columns launch"><img src="http://opensenselabs.com/migration-check/8launch.png" alt="Update from Drupal 7 to 8"/></div>
          <div class="medium-9 columns">
            <div class="flex-row price-change-container">
          <div class="url-link">
            <span class="url"><?php echo $url; ?></span>
          </div>

    </div>

          <div class="flex-row" style="margin-top:30px">
            <div class="migration-label">
                <ul class="menu vertical">
                  <li>Migration compatibility Status</li>
                  <li>Estimated Effort</li>
                  <!--<li>Estimated Cost</li>-->
                </ul>
            </div>
            <div class="migration-value">
                <ul class="menu vertical">
                  <li><span class="compat"><?php echo $compatibility_max; ?>%</span></li>
                  <li><span class="effort" id = "main_time"><?php echo round($man_days_min,0)." to ".round($man_days_max,0)." Days"; ?></span></li>
                 <!-- <li><span class="effort" id = "main_cost"><?php echo round($man_time_min*$priceph,0)." to ".round($man_time_max*$priceph,0)." $"; ?></span></li>-->
                </ul>
            </div>
            <!-- <ul class="menu mig-value">
              <li><span class="value-block compat"><?php echo $compatibility_max; ?>%</span><span class="value-label">Migration compatibility Status</span></li>
              <li><span class="value-block effort" id = "main_time"><?php echo round($man_days_min,0)." to ".round($man_days_max,0)." Days"; ?></span><span class="value-label">Estimated Effort</span></li>
              <li><span class="value-block effort" id = "main_cost"><?php echo round($man_time_min*$priceph,0)." to ".round($man_time_max*$priceph,0)." $"; ?></span><span class="value-label">Estimated Cost</span></li>
            </ul> -->
          </div>
        </div>
        </div>
      </div>
  </div>

<div class="row flex-row top40" >
<div class="medium-6 columns">
<h5>Website Analysis</h5>
<p>
  This lists down the number of modules that your current web property has and the number of modules that will need porting due to unavailability in Drupal 8.This also gives an approximate cost and time required against each other.<br>
Please note that this is an estimation made using advanced algorithms to help you understand the upgrade dynamics better. The appropriate estimate for execution may
vary per drupal website and a manual audit is recommended for budgeting.

</p>
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
  <!--<h5>Cost Estimation based on different types (Average)</h5>-->
  </div>
  <!--<div id="piechart-two" style="height:400px">

  </div>-->
  </div>
</div>


<div class="row flex-row top40">

<div class="medium-12 columns">
<div class="report-table">
<div class="table-header">
<table id="myTable">
  <thead><tr><th>Select</th><th>Type</th><th>Count</th><th>D8 Version Available</th><th>Time Required for Porting/Migrating(Hours)</th><!--<th>Estimated Cost($)</th>--></tr></thead>
  <tbody>
  <tr>
    <td><input type="checkbox" checked id='Core' onclick='calc1("Core")'></td>
    <td>Core</td>
    <td><?php echo $core['number_of_modules']; ?></td>
    <td><?php echo $core['number_of_portable']; ?></td>
    <td id="Core_time">0 to 1</td>
    <!--<td id="Core_cost">0 to 40</td>-->
 </tr>
 <tr>
   <td><input type="checkbox" checked id='Custom' onclick='calc1("Custom")'></td>
   <td>Custom</td>
   <td><?php echo $custom['number_of_modules']; ?></td>
   <td>0</td>
   <td id="Custom_time"><?php echo $custom['min_hour']." to ".$custom['max_hour']; ?></td>
   <!--<td id="Custom_cost"><?php echo ($custom['min_hour']*$priceph)." to ".($custom['max_hour']*$priceph); ?></td>-->
 </tr>
 <tr>
   <td><input type="checkbox" checked id='Contrib' onclick='calc1("Contrib")'></td>
   <td>Contributed</td>
   <td><?php echo $contrib['number_of_modules']; ?></td>
   <td><?php echo $contrib['number_of_portable']; ?></td>
   <td id="Contrib_time"><?php echo $contrib['min_hour']." to ".$contrib['max_hour']; ?></td>
   <!--<td id="Contrib_cost"><?php echo ($contrib['min_hour']*$priceph)." to ".($contrib['max_hour']*$priceph); ?></td>-->
 </tr>
  <tr>
   <td><input type="checkbox" checked id='Feature' onclick='calc1("Feature")'></td>
   <td>Features</td>
   <td><?php echo $features['number_of_modules']; ?></td>
   <td>0</td>
   <td id="Feature_time"><?php echo $features['min_hour']." to ".$features['max_hour']; ?></td>
   <!--<td id="Feature_cost"><?php echo ($features['min_hour']*$priceph)." to ".($features['max_hour']*$priceph); ?></td>-->
 </tr>
 <tr>
   <td><input type="checkbox" checked id='Theme' onclick='calc1("Theme")'></td>
   <td>Enable Themes</td>
   <td><?php echo ($themes_info['number_of_themes'] -1); ?></td>
   <td>0</td>
   <td id="Theme_time"><?php echo ($themes_info['min_hour'] - $default_theme['min_hour'])." to ".($themes_info['max_hour'] - $default_theme['max_hour']); ?></td>
   <!--<td id="Theme_cost"><?php echo (($themes_info['min_hour']- $default_theme['min_hour'])*$priceph)." to ".(($themes_info['max_hour']- $default_theme['max_hour'])*$priceph); ?></td>-->
 </tr>
 <tr>
   <td><input type="checkbox" checked id='Default-Theme' onclick='calc1("Default-Theme")'></td>
   <td>Default Theme</td>
   <td>1</td>
   <td>0</td>
   <td id="Default-Theme_time"><?php echo $default_theme['min_hour']." to ".$default_theme['max_hour']; ?></td>
   <!--<td id="Default-Theme_cost"><?php echo ($default_theme['min_hour']*$priceph)." to ".($default_theme['max_hour']*$priceph); ?></td>-->
 </tr>
  <tr>
   <td><input type="checkbox" checked id='View' onclick='calc1("View")'></td>
   <td>Views</td>
   <td><?php echo $views_info['number_of_views']; ?></td>
   <td>0</td>
   <td id="View_time"><?php echo $views_info['min_hour']." to ".$views_info['max_hour']; ?></td>
   <!--<td id="View_cost"><?php echo ($views_info['min_hour']*$priceph)." to ".($views_info['max_hour']*$priceph); ?></td>-->
 </tr>
 </tbody>
</table>
</div>
<div class="estimation-block panel">
<ul class="menu">
<li><h4><i class="fa fa-clock-o" aria-hidden="true"></i> Time(Hours) : <span><span id='total_time_min'><?php echo round($man_time_min+0,0);  ?></span> to <span id='total_time_max'><?php echo round($man_time_max+1,0); ?></span></span></h4></li>
<!--<li><h4><i class="fa fa-usd" aria-hidden="true"></i> Cost : <span><span id='total_cost_min'><?php echo round($man_time_min*$priceph,0);  ?></span> to <span id='total_cost_max'><?php echo round($man_time_max*$priceph+40,0);  ?></span></span></h4></li>-->
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
<div >
            <table border="1" data-sticky-container>
                  <thead data-sticky data-options="marginTop:0;" style="width:100%" data-top-anchor="1" data-btm-anchor="content:bottom">
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
                       <td>Migration environment setup</td>
                       <td>The Drupal 7 site to be upgraded is deployed into our development environment and verified.  Drupal 8 Vanilla is installed when the migration is to be executed.
</td>
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
                       <td>Upgrade path for migration to be written for those contrib modules which are present without an upgrade path.<br>
                         Manual Audit is required to classify such modules into two categories. <br>
1. Need an upgrade path<br>
2. Re-Cofigure in Drupal 8 without upgrade path.</td>
                       <td>This cannot be estimated with manual audit<!--<?php echo $upgrade_path_n*6; ?>--></td>
                       <td>This cannot be estimated without manual audit<!--<?php echo $upgrade_path_n*8; ?>--></td>
                   </tr>
                   <tr>
                       <td>4</td>
                       <td>Run Migration</td>
                       <td>The migrate upgrade module is executed here. This usually takes a few attempts to resolve issues that persist before successful migration. The Nodes, terms, users and other entities are migrated to the Drupal 8 site .<br>
                       The estimated time is directly proportional to the complex nature of the site.</td>
                       <td>16</td>
                       <td>60</td>
                   </tr>
                   <tr>
                       <td>5</td>
                       <td>Rebuild views</td>
                       <td>Views are not automatically upgraded to Drupal 8. All the views are re-built.</td>
                       <td><?php echo $views_info['min_hour']; ?></td>
                       <td><?php echo $views_info['max_hour']; ?></td>
                   </tr>
                   <tr>
                       <td>6</td>
                       <td>Re-build features</td>
                       <td>Features loose support after an automated upgrade. We need to re-package the features and build/configure the missing dependencies.</td>
                       <td><?php echo $features['min_hour']; ?></td>
                       <td><?php echo $features['max_hour']; ?></td>
                   </tr>
                   <tr>
                       <td>7</td>
                       <td>Site Rebuilding.</td>
                       <td>ll the configuration and site rebuilding is done for missing items. For example: Rules, display suits, panel pages etc.</td>
                       <td>THIS CANNOT BE ESTIMATED WITHOUT MANUAL AUDIT</td>
                       <td>THIS CANNOT BE ESTIMATED WITHOUT MANUAL AUDIT</td>
                   </tr>
                   <tr>
                       <td>8</td>
                       <td>Theme Building</td>
                       <td>Drupal 8 uses an entirely new templating engine Twig. The theme needs to be re-developed. Chunks of code from the present website can be reused. The exact extent of re-use can be figured only after a manual audit.</td>
                       <td><?php echo $themes_info['min_hour']; ?></td>
                       <td><?php echo $themes_info['max_hour']; ?></td>
                   </tr>
                   <tr>
                       <td>9</td>
                       <td>File Systems</td>
                       <td>The public files are handled mostly by the automated migration above. The private files need to be migrated separately.<br>
Also the validation is executed at this stage to ensure 100% successful migration of files.
</td>
                       <td>8 </td>
                       <td>16 </td>
                   </tr>
                   <tr>
                       <td>10</td>
                       <td>Data Validation</td>
                       <td>A validation process is executed to monitor and verify data consistency from the source Drupal 7 site and the post-migration Drupal 8 Site.<br>
Deployment- The migrated Drupal 8 site is deployed to staging and production.
</td>
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
                       <td><strong>Total(Hours)</strong></td>
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
  <div>
<table id="myTable2" data-sticky-container>
<thead><tr><th>S.No</th><th>Select</th><th>Module</th><th>Type</th><th>D8 Availablity</th><th>Upgrade Path</th><th>Version</th><th>Required to Port</th><th>Min Time</th><th>Max Time</th><!--<th>Min Cost(In $)</th><th>Max Cost(In $)</th>--><th>Link</th></tr></thead><tbody>
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
 // echo "<td id='t2minc$key'>".($value['MinTime']*$priceph)."</td>";
 // echo "<td id='t2maxc$key'>".($value['MaxTime']*$priceph)."</td>";
  echo "<td>".$value['Link']."</td>";
  echo "</tr>";
}
?>
</tbody>
</table>
</div>
</div>
<div class="estimation-block panel">
  <ul class="menu">
<li><h4><i class="fa fa-clock-o" aria-hidden="true"></i> Time(Hours) : <span><span id='time_min_checkbox'><?php echo round($modules_features_min+$themes_info['min_hour'],0)  ?></span> to <span id='time_max_checkbox'><?php echo round($modules_features_max+$themes_info['max_hour'],0) ?></span></span></h4>
<!--<li><h4><i class="fa fa-usd" aria-hidden="true"></i> Cost : <span><span id='cost_min_checkbox'><?php echo round(($modules_features_min+$themes_info['min_hour'])*$priceph,0)  ?></span> to <span id='cost_max_checkbox'><?php echo round(($modules_features_max+$themes_info['max_hour'])*$priceph,0)  ?></span></span></h4>-->
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
  <thead><tr><th>S.NO</th><th>Select</th><th>Name</th><th>Type</th><th>Descriptions</th><th>Displays</th><th>Min Time</th><th>Max Time</th><!--<th>Min Cost(In $)</th><th>Max Cost(In $)</th>--></tr></thead><tbody>
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
    //echo "<td id='v2minc$key'>".($value['MinHour']*$priceph)."</td>";
    //echo "<td id='v2maxc$key'>".($value['MaxHour']*$priceph)."</td>";
    }
   ?>
   </tbody>
</table>
</div>
<div class="estimation-block panel">
  <ul class="menu">
<li><h4><i class="fa fa-clock-o" aria-hidden="true"></i> Time(Hours) : <span><span id="view_time_min_checkbox"><?php echo $views_info['min_hour']; ?></span> to <span id="view_time_max_checkbox"><?php echo $views_info['max_hour']; ?></span></span></h4>
<!--<li><h4><i class="fa fa-usd" aria-hidden="true"></i> Cost : <span><span id="view_cost_min_checkbox"><?php echo $views_info['min_hour']*$priceph; ?></span> to <span id="view_cost_max_checkbox"><?php echo $views_info['max_hour']*$priceph; ?></span></span></h4>-->
</ul>
</div>

</div>
</div>
</div>
<hr>
<!-- Will be available throughout report -->
<div class="panel fixed">
<p>Time: <span id="main_time_2"><?php echo round($man_days_min,0)." to ".round($man_days_max,0)." Days"; ?></span></p><br>
<!--<p>Cost: USD <span id="main_cost_2"><?php echo round($man_time_min*$priceph,0)." to ".round($man_time_max*$priceph,0)." $"; ?></span></p>-->
</div>
<div class="row flex-row top40 columns" ng-controller="myCtrl">
<div class="report-table email-mig-wrap">
<div class="medium-7 columns email-mig">

<h3>Share Report</h3>
<div class="docs-code" data-docs-code="">
<button class="docs-code-copy" id="copyButton">Copy</button>
<pre><code class="html" id="copyTarget"><?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?></code></pre>
</div>



<h3>All Set to Migrate</h3>
<p>Get in Touch with our drupal experts and we will setup a call to understand your needs better.<br> drop in your email below.</p>
</div>
<div class="medium-5 columns email-mig" style="float:none;">
  <p class="success">{{message}}</p>
<form class="all-set migration-page">
 <span class="input input--akira">
          <input class="input-txt input__field input__field--akira"  type="email" name="email" value="<?php echo $email; ?>" ng-model="email">
					<label class="input__label input__label--akira">
						<span class="input__label-content input__label-content--akira">Email ID</span>
					</label>
				</span>
        <br>
        <br>
<input ng-show="submitButton" style="height: 50px;" class="button submit-btn orange" type="submit" value="Submit" ng-click="submit()"><br>
</form>
</div>
</div>
</div>
<a class="button orange fixed-custom" href="http://opensenselabs.com/migration-check/">Get your Report</a>
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

    //  var cost_min = Number(document.getElementById('cost_min_checkbox').innerHTML);
    //  var cost_max = Number(document.getElementById('cost_max_checkbox').innerHTML);
    //  var reduce_min_c = Number(document.getElementById('t2minc'+id).innerHTML);
    //  var reduce_max_c = Number(document.getElementById('t2maxc'+id).innerHTML);

      document.getElementById('time_min_checkbox').innerHTML = time_min + reduce_min;
      document.getElementById('time_max_checkbox').innerHTML = time_max + reduce_max;
    //  document.getElementById('cost_min_checkbox').innerHTML = cost_min + reduce_min_c;
    //  document.getElementById('cost_max_checkbox').innerHTML = cost_max + reduce_max_c;

      update_banner_increase(reduce_min,reduce_max,reduce_min_c,reduce_max_c);

    }
    else {
      var time_min = Number(document.getElementById('time_min_checkbox').innerHTML);
      var time_max = Number(document.getElementById('time_max_checkbox').innerHTML);
      var reduce_min = Number(document.getElementById('t2mint'+id).innerHTML);
      var reduce_max = Number(document.getElementById('t2maxt'+id).innerHTML);

      // var cost_min = Number(document.getElementById('cost_min_checkbox').innerHTML);
      // var cost_max = Number(document.getElementById('cost_max_checkbox').innerHTML);
      // var reduce_min_c = Number(document.getElementById('t2minc'+id).innerHTML);
      // var reduce_max_c = Number(document.getElementById('t2maxc'+id).innerHTML);

      document.getElementById('time_min_checkbox').innerHTML = time_min - reduce_min;
      document.getElementById('time_max_checkbox').innerHTML = time_max - reduce_max;
     // document.getElementById('cost_min_checkbox').innerHTML = cost_min - reduce_min_c;
     // document.getElementById('cost_max_checkbox').innerHTML = cost_max - reduce_max_c;

     update_banner_decrease(reduce_min,reduce_max,reduce_min_c,reduce_max_c);
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

      // var cost_min = Number(document.getElementById('view_cost_min_checkbox').innerHTML);
      // var cost_max = Number(document.getElementById('view_cost_max_checkbox').innerHTML);
      // var reduce_min_c = Number(document.getElementById('v2minc'+id).innerHTML);
      // var reduce_max_c = Number(document.getElementById('v2maxc'+id).innerHTML);

    //  document.getElementById('view_cost_min_checkbox').innerHTML = cost_min + reduce_min_c;
    //  document.getElementById('view_cost_max_checkbox').innerHTML = cost_max + reduce_max_c;

      document.getElementById('view_time_min_checkbox').innerHTML = time_min + reduce_min;
      document.getElementById('view_time_max_checkbox').innerHTML = time_max + reduce_max;

      update_banner_increase(reduce_min,reduce_max,reduce_min_c,reduce_max_c);


    }
    else {
      var time_min = Number(document.getElementById('view_time_min_checkbox').innerHTML);
      var time_max = Number(document.getElementById('view_time_max_checkbox').innerHTML);
      var reduce_min = Number(document.getElementById('v2mint'+id).innerHTML);
      var reduce_max = Number(document.getElementById('v2maxt'+id).innerHTML);

      // var cost_min = Number(document.getElementById('view_cost_min_checkbox').innerHTML);
      // var cost_max = Number(document.getElementById('view_cost_max_checkbox').innerHTML);
      // var reduce_min_c = Number(document.getElementById('v2minc'+id).innerHTML);
      // var reduce_max_c = Number(document.getElementById('v2maxc'+id).innerHTML);

    //  document.getElementById('view_cost_min_checkbox').innerHTML = cost_min - reduce_min_c;
    //  document.getElementById('view_cost_max_checkbox').innerHTML = cost_max - reduce_max_c;

      document.getElementById('view_time_min_checkbox').innerHTML = time_min - reduce_min;
      document.getElementById('view_time_max_checkbox').innerHTML = time_max - reduce_max;

      update_banner_decrease(reduce_min,reduce_max,reduce_min_c,reduce_max_c);
    }
  }

  function calc1(ty)
  {
    if(document.getElementById(ty).checked)
    {
      var tdid = ty+'_time';
    //  var cdid = ty+'_cost';
      var time = document.getElementById(tdid).innerHTML;
   //   var cost = document.getElementById(cdid).innerHTML;
      var time_min = Number(time.substr(0,time.indexOf('t')-1));
      var time_max = Number(time.slice(time.indexOf('o')+1));

     // var cost_min = Number(cost.substr(0,cost.indexOf('t')-1));
     // var cost_max = Number(cost.slice(cost.indexOf('o')+1));

      var total_time_max = Number(document.getElementById('total_time_max').innerHTML);
      var total_time_min = Number(document.getElementById('total_time_min').innerHTML);

     // var total_cost_max = Number(document.getElementById('total_cost_max').innerHTML);
    //  var total_cost_min = Number(document.getElementById('total_cost_min').innerHTML);

      document.getElementById('total_time_max').innerHTML = total_time_max + time_max;
      document.getElementById('total_time_min').innerHTML = total_time_min + time_min;

     // document.getElementById('total_cost_max').innerHTML = total_cost_max + cost_max;
    //  document.getElementById('total_cost_min').innerHTML = total_cost_min + cost_min;

     // update_banner_increase(time_min,time_max,cost_min,cost_max);



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
     // var cdid = ty+'_cost';
      var time = document.getElementById(tdid).innerHTML;
    //  var cost = document.getElementById(cdid).innerHTML;

      var time_min = Number(time.substr(0,time.indexOf('t')-1));
      var time_max = Number(time.slice(time.indexOf('o')+1));

    //  var cost_min = Number(cost.substr(0,cost.indexOf('t')-1));
    //  var cost_max = Number(cost.slice(cost.indexOf('o')+1));

      var total_time_max = Number(document.getElementById('total_time_max').innerHTML);
      var total_time_min = Number(document.getElementById('total_time_min').innerHTML);

    //  var total_cost_max = Number(document.getElementById('total_cost_max').innerHTML);
    //  var total_cost_min = Number(document.getElementById('total_cost_min').innerHTML);

      document.getElementById('total_time_max').innerHTML = total_time_max - time_max;
      document.getElementById('total_time_min').innerHTML = total_time_min - time_min;

     // document.getElementById('total_cost_max').innerHTML = total_cost_max - cost_max;
     // document.getElementById('total_cost_min').innerHTML = total_cost_min - cost_min;

     // update_banner_decrease(time_min,time_max,cost_min,cost_max);

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

  function update_banner_increase(reduce_min,reduce_max,reduce_min_c,reduce_max_c)
  {


    var time = document.getElementById('main_time').innerHTML;
//    var cost = document.getElementById('main_cost').innerHTML;



    var time_min = Number(time.substr(0,time.indexOf('t')-1));
    var time_max = Number(time.slice(time.indexOf('o')+2,time.indexOf('D')-1));
 //   var cost_min = Number(cost.substr(0,cost.indexOf('t')-1));
 //   var cost_max = Number(cost.slice(cost.indexOf('o')+2,cost.indexOf('$')-1));


    var t1 = Math.round((time_min*8 + reduce_min)/8);
    var t2 = Math.round((time_max*8 + reduce_max)/8);
//    var c1 = cost_min + reduce_min_c;
//    var c2 = cost_max + reduce_max_c;

    var banner_t_text = t1+" to "+t2+" Days";
//    var banner_c_text = c1+" to "+c2+" $";



    document.getElementById('main_time').innerHTML = banner_t_text;
  //  document.getElementById('main_cost').innerHTML = banner_c_text;

    document.getElementById('main_time_2').innerHTML = banner_t_text;
  //  document.getElementById('main_cost_2').innerHTML = banner_c_text;
  }


  function update_banner_decrease(reduce_min,reduce_max,reduce_min_c,reduce_max_c)
  {



    var time = document.getElementById('main_time').innerHTML;
  //  var cost = document.getElementById('main_cost').innerHTML;



    var time_min = Number(time.substr(0,time.indexOf('t')-1));
    var time_max = Number(time.slice(time.indexOf('o')+2,time.indexOf('D')-1));
//    var cost_min = Number(cost.substr(0,cost.indexOf('t')-1));
//    var cost_max = Number(cost.slice(cost.indexOf('o')+2,cost.indexOf('$')-1));



      var t1 = Math.round((time_min*8 - reduce_min)/8);
      var t2 = Math.round((time_max*8 - reduce_max)/8);
 //     var c1 = cost_min - reduce_min_c;
  //    var c2 = cost_max - reduce_max_c;

      if(t1<0)
        t1=0;
      if(t2<0)
        t2=0;
      if(c1<0)
        c1=0;
      if(c2<0)
        c2=0;
      if(t1>t2)
        t2=t1;


      var banner_t_text = t1+" to "+t2+" Days";
   //   var banner_c_text = c1+" to "+c2+" $";


      document.getElementById('main_time').innerHTML = banner_t_text;
  //    document.getElementById('main_cost').innerHTML = banner_c_text;

      document.getElementById('main_time_2').innerHTML = banner_t_text;
 //     document.getElementById('main_cost_2').innerHTML = banner_c_text;
  }


</script>
<script type="text/javascript">
  document.getElementById("copyButton").addEventListener("click", function() {
    copyToClipboard(document.getElementById("copyTarget"));
});
$('#copyButton').click(function(){
  $(this).text('Copied!');
});

//fixed table header
   $.fn.fixMe = function() {
      return this.each(function() {
         var $this = $(this),
            $t_fixed;
         function init() {
            $this.wrap('<div class="container" />');
            $t_fixed = $this.clone();
            $t_fixed.find("tbody").remove().end().addClass("fixed").insertBefore($this);
            resizeFixed();
         }
         function resizeFixed() {
            $t_fixed.find("th").each(function(index) {
               $(this).css("width",$this.find("th").eq(index).outerWidth()+"px");
            });
         }
         function scrollFixed() {
            var offset = $(this).scrollTop(),
            tableOffsetTop = $this.offset().top,
            tableOffsetBottom = tableOffsetTop + $this.height() - $this.find("thead").height();
            if(offset < tableOffsetTop || offset > tableOffsetBottom)
               $t_fixed.hide();
            else if(offset >= tableOffsetTop && offset <= tableOffsetBottom && $t_fixed.is(":hidden"))
               $t_fixed.show();
         }
         $(window).resize(resizeFixed);
         $(window).scroll(scrollFixed);
         init();
      });
   };

$(document).ready(function(){
   $("table").fixMe();
   $(".up").click(function() {
      $('html, body').animate({
      scrollTop: 0
   }, 2000);
 });
});

function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }

    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
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
                pointFormat: '<b>{point.percentage:.1f}%</b>'
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
              showInLegend: true,
                name: '',
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
                    name: 'Other Enabled Themes',
                    y: <?php echo $themes_time_p; ?> },{
                    name: 'View',
                    y: <?php echo $views_time_p; ?> },{
                    name: 'Default Theme',
                    y: <?php echo $default_theme_time_p; ?>},]
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
                pointFormat: '<b>{point.percentage:.1f}%</b>'
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
              showInLegend: true,
                name: '',
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
                    name: 'Other Enabled Themes',
                    y: <?php echo $themes_time_p; ?> },{
                    name: 'View',
                    y: <?php echo $views_time_p; ?> },{
                    name: 'Default Theme',
                    y: <?php echo $default_theme_time_p; ?>},]
            }]
        });



</script>

<script type="text/javascript">
  var app = angular.module('myApp', []);
  app.controller('myCtrl', function($scope,$http) {
    $scope.submitButton = true;
   // $scope.messageBox = false;
    $scope.submit = function(){
      $http({
        url: "https://opensenselabs.com/migration-check/sendmail.php",
        method: "post",
        data: {"Email" : $scope.email , "Website" : "<?php echo $web; ?>"}
      }).then(function successCallback(response){
        $scope.message = response.data;
       // $scope.messageBox = true;
        $scope.submitButton = false;
      }, function errorCallback(response){
        $scope.message = "Please Try Again";
      });
    }
  });
</script>
<script>
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-87116324-1', 'auto');
 ga('send', 'pageview');

</script>

</html>
