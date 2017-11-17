<!--For the time being this is the HTML Markup. Later a D8 module will be created. --> 
<html>
<head>
<title></title>
<link rel="stylesheet" href="http://www.techtud.com/sites/all/themes/techtud/css/mig/foundation.min.css?oi9rjq" media="all" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" media="all" />
<link rel="stylesheet" href="http://www.techtud.com/sites/all/themes/techtud/css/mig/style.css?oi9rjq" media="all" />
<link rel="stylesheet" href="http://www.techtud.com/sites/all/themes/techtud/css/mig/custom_style.css?oi9rjq" media="all" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>


<style type="text/css">
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
    border-style: solid;
    border-width: 1px;
    border-color: #d8d8d8;
    margin-bottom: 1.11111rem;
    padding: 1.11111rem;
    background: #f2f2f2;
    color: #333333;
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
        background: #66b1e2;
    padding: 12px 10px;
    line-height: 1;
    color: #fff;
    font-size: 14px;
    border: 1px solid #fff;

      }
      .table table thead {
        opacity: 0;
      }
      .table-header table tbody th, .table-header table tbody td {
        font-size: 14px;
        color: #333;
        border: 1px solid #f1f1f1;
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
}
.migration_details_block_new {
    font-size: 18px;
    padding: 66px 0px;
    background: #f5f5f5;
    border: 1px solid #eee;
   
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
@media print {
    body {
        background-color: red;
    }
    .main-block-title h1 {
        font-size: 27px;
    margin-bottom: 24px;
    margin-top: 24px;
    color: #f00 !important;
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

        <div class="row main-block-title">
        <h1 class="text-center">Drupal 7 to Drupal 8 Upgrade compatibility check</h1>
        <div class="migration_details_block_new columns">

        <div class="flex-row justify-center">
          <ul class="menu vertical border-right mig-label">
	          <li>URL</li>
            <li>Migration compatibility Status</li>
            <li>Estimated Effort</li>
            <!-- <li>Estimated Cost</li> -->
          </ul>
          <ul class="menu vertical mig-value">
	    <li id="site-url">yourwebsite.com</li>
            <li id="compatiblity"></li>
            <li id='man_days'>346 - 400 man days</li>
            <!-- <li>$35000 - $50000</li> -->
          </ul>
        </div>
      </div>
        </div>
<?php

//Accepting JSON File Upload from File.php,Validated and Moved to Uploads Folder.
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$jsonFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
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



//This file contains database connection info.
include 'db_connect.php';

//Reading file and Decoding JSON.
$str = file_get_contents($file);
$json = json_decode($str,true);


//Fetching Information from JSON.

$data = $json['data'];


$modules = $data['modules'];
$themes = $data['themes'];
$viewsdata = $data['viewsdata'];
$files_managed = $data['files_managed'];


/*$module = $json['posts'][0]['modules'];
$module_lines = $json['posts'][0]['module_lines'];
$theme = $json['posts'][0]['theme_data'];
$theme_lines = $json['posts'][0]['theme_lines'];
$site_name = $json['posts'][0]['site_name'];
$module_version = $json['posts'][0]['module_version'];

$baseurl = $json['posts'][0]['url'];
$contrib = $json['posts'][0]['contrib'];
$features = $json['posts'][0]['features'];
$custom_lines = $json['posts'][0]['customLines'];
$theme_dataLines = $json['posts'][0]['theme_dataLines'];
$viewsdata = $json['posts'][0]['viewsdata'];
$files_managed = $json['posts'][0]['files_managed'];
$custom = $json['posts'][0]['custom'];
$custom_data = $json['posts'][0]['customData'];
$feature_data = $json['posts'][0]['featureData'];
$feature_description = $json['posts'][0]['features_description']; */

$mailmessage = "NAME : ".$admin."\nMobile : ".$mobile."\nEmail : ".$email." \nWebsiteName : ".$websitename."\nURL : ".$url."\nStatus : Score Checked by Uploading JSON";

mail('gaurav.k@opensenselabs.com','Score Checked by '.$websitename,$mailmessage);

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



/*$module_list = $module;
$module_lines_list = $module_lines;
$theme_list = $theme;
$theme_lines_list = $theme_lines;
$module_version_list = $module_version; */ 

/*$submodule_list = array();
$complexity_list = array();
$complexity_list_theme = array(); */

$newtable1 = array();
$core = array();
$custom = array();
$contrib = array();
$features = array();
$themes = array();
$views = array();

$total_man_hours = array();
$mc = array();
$graph = array();

echo '<div class="row flex-row top40" id="tableone">
      <div class="medium-6 columns">
        <div class="report-table">
        <h5>Compatibility Report</h5>
	<p>This report is status analysis of all Core, Contrib., Custom modules and Features. Please find below enlisted module and availability status and version for Drupal 8.</p>
            <div class="table-header"><table><thead><th>Module</th><th>Type</th><th>Available</th><th>Version</th><th>Issue</th></thead>';

$removed = array('blog','dashboard','number');
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



    $Issue = get_issue($modulename);
    if($Issue == NULL || $Issue === NULL)
        $Link = "";
    else 
       $Link = "<a href = 'https://www.drupal.org".$Issue."'>Issue</a>";

    //echo "<tr><td>".$key."</td><td>".$type."</td><td>".$info."</td><td>".$Issue."</td></tr>";
    echo "<tr><td>".$modulename."</td><td>".$type."</td><td>".$info."</td><td>".$version."</td><td>".$Link."</td></tr>";
    $Link = "";
    
    
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


echo '</table></div></div></div>
<div class="medium-6 columns" data-sticky-container>
      <div class="report-table sticky" data-sticky data-top-anchor="tableone:top" data-btm-anchor="tableone:bottom">
      <h5>Module Compatibility Report Comparison</h5>
        <div id="graph-one" style="height:400px"></div>
      </div>
      </div>
</div>';


?>
<h5>New Style Table 1</h5>



<div class="row flex-row top40">
      <div class="medium-7 columns">
        <div class="report-table varheight">
        <h5>Module porting effort estimation</h5>
	<p>This report estimated the effort required to port all custom modules and Contrib modules which are not available for Drupal 8.</p>
            <div class="table-header">
<table>
    <thead>
    <tr>
        <th>S.no</th>
        <th width="200">Module</th>
        <!-- <th>Complexity</th> -->
        <th>Percentage</th>
        <th>Min (Work-hours) </th>
        <th>Max(work- hours)</th>
    </tr>
    </thead>
    <?php
                      $module_complexity = array();
                      $module_complexity_sum=0;
                      $man_hours=10;
                      $final_modules = array();
                      $i=0;
                        foreach ($modules as $key => $value)
                        {
                            //$displays[$key] = $row['displays'];
                           
                            if($value['type']=="Custom" || ($value['type']=='Contrib' && (get_latest_version_complexity($value['name'])==9|| get_latest_version_complexity($value['name'])==8)))
                            {
                                $final_modules[$i]=$value;
                                $total_module_compl=0;
                                $min_hour = 0;
                                $max_hour = 0;
                               
                                foreach ($value['files'] as $key2 => $value2) {
                                     if (strpos($key2, '.inc') !== false) {
                                            $total_module_compl+=$value2;
                                            $min_hour += round($value2/120,0);
                                            $max_hour += round($value2/80,0);

                                        }
                                        if (strpos($key2, '.module') !== false) {
                                            $total_module_compl+=$value2;
                                            $min_hour += round($value2/120,0);
                                            $max_hour += round($value2/80,0);
                                        }
                                        if (strpos($key2, '.js') !== false) {
                                            $total_module_compl+=$value2;
                                            $min_hour += round($value2/120,0);
                                            $max_hour += round($value2/80,0);
                                        }
                                        if (strpos($key2, '.php') !== false) {
                                            $total_module_compl+=$value2/2;
                                            $min_hour += round($value2/140,0);
                                            $max_hour += round($value2/100,0);
                                        }
                                        if (strpos($key2, '.css') !== false) {
                                            $total_module_compl+=$value2/2;
                                            $min_hour += round($value2/200,0);
                                            $max_hour += round($value2/150,0);
                                        }
                                }   
                                $final_modules[$i]['complexity'] = $total_module_compl;
                                $final_modules[$i]['max_hour'] = $max_hour;
                                $final_modules[$i]['min_hour'] = $min_hour;
                                $module_complexity_sum+=$total_module_compl;
                                //$complexity[$i] = $total;
                                $i++;
                            }
                                if($value['type'] == 'Custom')
                                {
                                  $custom['max_time'] += $max_hour;
                                  $custom['min_time'] += $min_hour; 
                                }
                                if($value['type'] == 'Contrib')
                                {
                                  $contrib['max_time'] += $max_hour;
                                  $contrib['min_time'] += $min_hour; 
                                }
                        }
                        //array_multisort($complexity, SORT_DESC, $final_modules);
                        
                        //$max_rank=count($final_modules);  
              

     ?>
                <tbody> 

                    <?php 
                    $modules_man_hrs=0;

                    foreach ($final_modules as $key => $value) {
                                    
                                echo '<tr>
                                      <td>'.++$key.'</td>
                                       <td class="view">'.$value['name'].'</td>';
                                    /*  <td class="description">'.$value['complexity'].'</td>';*/
                                     $percentage=(($value['complexity'])/$module_complexity_sum)*100;
                                        $percentage=number_format($percentage, 2, '.', '');                          
                                     
                                    echo '<td class="percentage">'.$percentage.'%</td>
                                         <td class="man_hours">'.round($value['min_hour']).'</td><td>'.(int)($value['max_hour']).'</td>
                                </tr>';
                             //   $modules_man_hrs+=(int)($value['complexity']/$man_hours);
                                  $modules_man_hrs_max += round($value['max_hour']);
                                  $modules_man_hrs_min += round($value['min_hour']);
                    }
                    $total_man_hours['modules_man_hrs_max']=$modules_man_hrs_max;
                    $total_man_hours['modules_man_hrs_min']=$modules_man_hrs_min;
                    ?>
                </tbody>
            </table>
            <div>The max and min hours are estimated keeping in consideration the uncertainty factor but this can be exactly estimated with manual audit.</div>
	    </div>
            </div>
            </div>
            <div class="medium-5 columns">
      <div class="report-table height-auto-wrap">
      <h5>Module porting effort comparison</h5>
        <div id="graph-two" class="height300"></div>
      </div>
      </div>
            </div>
            <hr>

            <div class="row flex-row top40">

      <div class="medium-7 columns">
        <div class="report-table varheightone">
        <h5>Feature Rebuild effort estimation</h5>
	<p>The following report estimates the effort required to port the features in Drupal 8. Features are not automatically upgradable. They need to be rebuilt</p>
          <div class="table-header">

                      <table border="1" style="width=100%">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Features</th>
                        <!-- <th>Complexity</th> -->
                        <th>Percentage</th>
                        <th>Min (Work-hours) </th>
                        <th>Max(work- hours)</th>
                    </tr>
                </thead>
                <?php
                    $final_features=array();
                      $complexity_feature_sum = 0;
                        $i=0;
                        foreach ($modules as $key => $value)
                        {
                            //$displays[$key] = $row['displays'];
                            
                                if($value['type']=='Feature')
                                {
                                    $final_features[$i]=$value;
                                    $total_feature_compl=0;
                                    $max_hour = 0;
                                    $min_hour = 0;  
                                     foreach ($value['files'] as $key2 => $value2) {
                                         if (strpos($key2, '.inc') !== false) {
                                                $total_feature_compl+=$value2;
                                                $min_hour += round($value2/120,0);
                                                $max_hour += round($value2/80,0);
                                            }
                                            if (strpos($key2, '.module') !== false) {
                                                $total_feature_compl+=$value2;
                                                $min_hour += round($value2/120,0);
                                                $max_hour += round($value2/80,0);
                                            }
                                            if (strpos($key2, '.js') !== false) {
                                                $total_feature_compl+=$value2;
                                                $min_hour += round($value2/120,0);
                                                $max_hour += round($value2/80,0);
                                            }
                                            if (strpos($key2, '.php') !== false) {
                                                $total_feature_compl+=$value2/2;
                                                $min_hour += round($value2/140,0);
                                                $max_hour += round($value2/100,0);
                                            }
                                            if (strpos($key2, '.css') !== false) {
                                                $total_feature_compl+=$value2/2;
                                                $min_hour += round($value2/200,0);
                                                $max_hour += round($value2/150,0);
                                            }
                                    } 
                                    $features['max_hour'] += $max_hour;         
                                    $features['min_hour'] += $min_hour;           
                                    $final_features[$i]['complexity'] = $total_feature_compl;
                                    $final_features[$i]['max_hour'] = $max_hour;
                                    $final_features[$i]['min_hour'] = $min_hour;   
                                    $complexity_feature_sum+=$total_feature_compl;

                                     $i++;
                            
                                }
                        }
                        //var_dump($final_themes);exit();
                       //array_multisort($feature_complexity, SORT_DESC, $final_features);
                        
                        //$max_rank=count($final_features); 
                 ?>
                <tbody>

                    <?php 
                    $features_man_hrs=0;
                    foreach ($final_features as $key => $value) {
                                    
                                echo '<tr>
                                      <td>'.++$key.'</td>
                                       <td class="features">'.$value['name'].'</td>';
                                     /*<td class="description">'.$value['complexity'].'</td>';*/
                                       $percentage=(($value['complexity'])/$complexity_feature_sum)*100;
                                        $percentage=number_format($percentage, 2, '.', ''); 


                                        echo '<td class="percentage">'.$percentage.'%</td>
                                         <td class="man_hours">'.round($value['min_hour']).'</td><td>'.round($value['max_hour']).'</td>
                                </tr>';                          

                             //   $features_man_hrs+=(int)($value['complexity']/$man_hours);
                             //     $features_man_hrs = 500;
                             $features_man_hrs_max += round($value['max_hour']);
                             $features_man_hrs_min += round($value['min_hour']);   
                    }
                             $total_man_hours['features_man_hrs_max']=$features_man_hrs_max;
                              $total_man_hours['features_man_hrs_min']=$features_man_hrs_min;
                    ?>
                                </tbody>
            </table>
            <p>The max and min hours are estimated keeping in consideration the uncertainty factor but this can be exactly estimated with manual audit</p>
	  </div>
            </div>
            </div>
            <div class="medium-5 columns">
            <div class="report-table height-auto-wrapone">
      <h5>Feature Rebuild effort comparison</h5>
        <div id="graph-three" class="height300"></div>
      </div>
            </div>
            </div>
            <hr>
                <div class="row flex-row top40">
      <div class="medium-7 columns">
        <div class="report-table varheighttwo">
        <h5>Theme rebuild effort estimation</h5>
	<p>Drupal 8 uses a completely new templating engine Twig. All themes needs to re-developed. Chunks and pieces of code can be reused. The exact extent of re-use can be figured only after manual audit.</p>
          <div class="table-header">
            <table>
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Theme</th>
                        <!-- <th>Complexity</th> -->
                        <th>Percentage</th>
                        <th>Min (Work-hours) </th>
                        <th>Max(work- hours)</th>
                    </tr>
                </thead>
                <?php 
                    $theme_complexity_sum =0;
                     
                        foreach ($themes as $key => $value)
                        {
                            //$displays[$key] = $row['displays'];
                            
                                
                                $total_theme_compl=0;
                                $max_hour = 0;
                                $min_hour = 0;
                                foreach ($value['files'] as $key2 => $value2) {
                                     if (strpos($key2, '.inc') !== false) {
                                            $total_theme_compl+=$value2;
                                            $min_hour += round($value2/120,0);
                                            $max_hour += round($value2/80,0);

                                        }
                                        if (strpos($key2, '.module') !== false) {
                                            $total_theme_compl+=$value2;
                                            $min_hour += round($value2/120,0);
                                            $max_hour += round($value2/80,0);
                                        }
                                        if (strpos($key2, '.js') !== false) {
                                            $total_theme_compl+=$value2;
                                            $min_hour += round($value2/120,0);
                                            $max_hour += round($value2/80,0);
                                        }
                                        if (strpos($key2, '.php') !== false) {
                                            $total_theme_compl+=$value2/2;
                                            $min_hour += round($value2/140,0);
                                            $max_hour += round($value2/100,0);
                                        }
                                        if (strpos($key2, '.css') !== false) {
                                            $total_theme_compl+=$value2/2;
                                            $min_hour += round($value2/200,0);
                                            $max_hour += round($value2/150,0);

                                        }
                                }   
                                $themes[$key]['complexity'] = $total_theme_compl;
                                $theme_complexity_sum+=$total_theme_compl;
                                $themes[$key]['max_hour'] = $max_hour;
                                $themes[$key]['min_hour'] = $min_hour; 
                                
                            
                        }
                        
                ?>
                <tbody>

                    <?php 
                    $themes['themes'] = 0;
                    $themes_man_hrs=0;
                    foreach ($themes as $key => $value) {
                      $themes['themes']++;
                                    
                                echo '<tr>
                                      <td>'.++$key.'</td>
                                       <td class="themes">'.$value['name'].'</td>';
                                     /*<td class="description">'.$value['complexity'].'</td>';*/
                                         $percentage=(($value['complexity'])/$theme_complexity_sum)*100;
                                        $percentage=number_format($percentage, 2, '.', '');             
                                     
                                    echo '<td class="percentage">'.$percentage.'%</td>
                                         <td class="man_hours">'.round($value['min_hour']).'</td><td>'.round($value['max_hour']).'</td>
                                </tr>';
                               // $themes_man_hrs+=(int)($value['complexity']/$man_hours);
                               //   $themes_man_hrs = 500;
                             $themes_man_hrs_max += round($value['max_hour']);
                             $themes_man_hrs_min += round($value['min_hour']);

                    }
                     $total_man_hours['themes_man_hrs_max']=$themes_man_hrs_max;
                     $total_man_hours['themes_man_hrs_min']=$themes_man_hrs_min;
                    ?>
                </tbody>
            </table>
	    <p>The max and min hours are estimated keeping in consideration the uncertainty factor but this can be exactly estimated with manual audit.  
We assume all enabled themes needs to be ported but that is not the case all the time</p>
            </div>
            </div>
            </div>
            <div class="medium-5 columns">
            <div class="report-table height-auto-wraptwo">
      <h5>Theme rebuild effort comparison</h5>
        <div id="graph-four" class="height300"></div>
      </div>
            </div>
            </div>
            <hr>
            <div class="row flex-row top40">
      <div class="medium-8 columns">
        <div class="report-table">
        <h5>Views rebuild effort estimation</h5>
	<p>Views are not automatically upgraded to Drupal 8. All the views are to be rebuilt</p>
          <div class="table-header">
            <table>
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>View</th>
                        <th>Description</th>
                        <th>Displays</th>
                        <th>Percentage</th>
                        <th>Min(Work-hours)</th>
                        <th>Max(work- hours)</th>
                    </tr>
                </thead>
                <?php 
                    $viewsdata_sum = 0;
                        foreach ($viewsdata as $key => $row)
                        {
                            $row['complexity']=$row['displays'];
                            $viewsdata_sum+=$row['displays'];
                        }
                                     
                ?>
                <tbody>
                    <?php 
                        $total_man_hours['views_max_man_hrs']=0;
                        $total_man_hours['views_min_man_hrs']=0;
                        $views['views'] = 0;
                        foreach ($viewsdata as $key => $value) {
                          $views['views']++;
                        echo '<tr>
                                  <td>'.++$key.'</td>
                                   <td class="view">'.$value['view'].'</td>
                                 <td class="description">'.$value['description'].'</td>
                                 <td class="displays">'.$value['displays'].'</td> ';                
                                 
                                    $percentage=(($value['displays'])/$viewsdata_sum)*100;
                                    $percentage=number_format($percentage, 2, '.', ''); 
                                    $views_min_man_hrs =  (8+(($value['displays']-1)*2));
                                    $views_max_man_hrs =  (16+(($value['displays']-1)*4));
                                    $total_man_hours['views_min_man_hrs']+= $views_min_man_hrs;
                                    $total_man_hours['views_max_man_hrs']+= $views_max_man_hrs;

                                echo '<td class="percentile">'.$percentage.'%</td><td>'.$views_min_man_hrs.'</td><td>'.$views_max_man_hrs.'</td>  
                            </tr>';
                            
                    }
                    ?>
                </tbody>
            </table>
	    <p>The max and min hours are estimated keeping in consideration the uncertainty factor but this can be exactly estimated with manual audit</p>
            </div>
            </div>
            </div>
            
            </div>

            <hr>
            <div class="row flex-row top40" id="piegraph">
                <div class="medium-6 columns">
        <div class="report-table">
        <h5>Upgrade path analysis for Data migration</h5>
	<p>Upgrade path for migration to be written for those contrib modules which are availble but do not have a upgrade path. 
Manual Audit is required to classify such modules in 2 categories</p>
	  <ol>
	    <li>Need an upgrade path</li>
	    <li>Re-Cofigure in Drupal 8 without upgrade path.</li>
	  </ol>
          <div class="table-header">
            <table border="1">
                  <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Module Name</th>
                        <th>Upgrade Path</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $upgrade=array('node','path','search','shortcut','simpletest','syslog','system','menu','taxonomy','tracker','user','aggregator','block','comment','contact','field','file','filter','forum','image','locale');
                    $upgrade_path_yn = array();
                    $yes=0;
                    $no=0;
                    foreach ($modules as $key => $value) 
                    {
                        if($value['type']=='Core' || $value['type']=='Contrib' )
                        {
                            echo  '<tr>
                              <td>'.++$key.'</td>
                               <td class="view">'.$value['name'].'</td>';
                            
                             if(in_array($value['name'], $upgrade))
                             {
                                echo '<td><i class="fa fa-check" aria-hidden="true"></i></td>';
                                $yes++;
                             }
                             else
                             {
                                echo '<td><i class="fa fa-times" aria-hidden="true"></i></td>';
                                $no++;
                             }
                            echo '</tr>';
                        }
                    }
                    $upgrade_path_yn['yes']=$yes;
                    $upgrade_path_yn['no']=$no;
                    ?>
                </tbody>
            </table>
          <p>The max and min hours are estimated keeping in consideration the uncertainty factor but this can be exactly estimated with manual audit. </p>  
	  </div>
            </div>
            </div>
            <div class="medium-6 columns" data-sticky-container>
            <div class="report-table sticky" data-sticky data-anchor="piegraph">
            <h5></h5>
              <div id="piechart" style="400px"></div>
            </div>
            </div>
            </div>
            <hr>
            <div class="row flex-row top40">
      <!-- <div class="medium-6 columns">
        <div class="report-table">
        <h5>CODE COMPLEXITY</h5>
          <div class="table-header">
            <table border="1">
                  <thead>
                    <tr>
                        <th></th>
                        <th>Modules</th>
                        <th>Themes</th>
                        <th>Features</th>
                    </tr>
                </thead>
                <tbody>
                   <tr>
                       <td>Min (Work-hours) </td>
                       <td><?php echo $total_man_hours['modules_man_hrs_min'];?></td>
                       <td><?php echo $total_man_hours['themes_man_hrs_min'];?></td>
                       <td><?php echo $total_man_hours['features_man_hrs_min'];?></td>
                   </tr>
                    <tr>
                       <td>Max(work- hours)</td>
                       <td><?php echo $total_man_hours['modules_man_hrs_max'];?></td>
                       <td><?php echo $total_man_hours['themes_man_hrs_max'];?></td>
                       <td><?php echo $total_man_hours['features_man_hrs_max'];?></td>
                   </tr>
                </tbody>
            </table>
            </div>
            </div>
            </div> -->
            <div class="medium-12 columns">
        <div class="report-table">
        <h5>SUMMARY</h5>
          <div class="table-header">
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
                <?php 
                    $total_code_man_min_hrs=0;
                    $total_code_man_max_hrs=0;
                ?>
                   <tr>
                       <td>1</td>
                       <td>Migration Enviornment Setup</td>
                       <td>The Drupal 7 site to be upgraded is deployment on development enviornment and verified. Also, D8 Vanila Install of Drupal 8 is deployed where the migration will be done.</td>
                       <td>4 <?php  $total_code_man_min_hrs+=4;?> </td>
                       <td>16 <?php  $total_code_man_max_hrs+=4;?> </td>
                   </tr>
                    <tr>
                       <td>2</td>
                       <td>Module Rewrite</td>
                       <td>1. Custom modules are re-written for Drupal 8<br>
2. All contrib modules which are not available for D8 are re-written if needed. The manual audit is required to find alternative ways of implementing same features in Drupal 8 to save time.</td>
                       <td><?php echo $total_man_hours['modules_man_hrs_min'];$total_code_man_min_hrs+=$total_man_hours['modules_man_hrs_min'];?></td>
                       <td><?php echo $total_man_hours['modules_man_hrs_max'];$total_code_man_max_hrs+=$total_man_hours['modules_man_hrs_max'];?></td>
                   </tr>
                   <tr>
                       <td>3</td>
                       <td>Prepare Upgrade path</td>
                       <td>Upgrade path for migration to be written for those contrib modules which are availble but do not have a upgrade path. <br>
Manual Audit is required to classify such modules in 2 categories. <br>
1. Need an upgrade path<br>
2. Re-Cofigure in Drupal 8 without upgrade path.</td>
                       <td><?php echo ($upgrade_path_yn['no']*6);$total_code_man_min_hrs+=($upgrade_path_yn['no']*6);?></td>
                       <td><?php echo ($upgrade_path_yn['no']*8);$total_code_man_max_hrs+=($upgrade_path_yn['no']*8);?></td>
                   </tr>
                   <tr>
                       <td>4</td>
                       <td>Run Migration</td>
                       <td>The migrate upgrade module is executed here. This usually takes few attempts to resolve issues faced before a successfull migration is done. The Nodes, Terms, USers are other entities are migrated to Drupal 8 site here. <br>
The time estimate a very directly proportional to complexity of site.</td>
                       <td>16 <?php $total_code_man_min_hrs+=16;?> </td>
                       <td>60 <?php $total_code_man_max_hrs+=60;?> </td>
                   </tr>
                   <tr>
                       <td>5</td>
                       <td>Re-Build Views</td>
                       <td>Views are not automatically upgraded to Drupal 8. All the views are rebuilt.</td>
                       <td><?php echo $total_man_hours['views_min_man_hrs'];$total_code_man_min_hrs+=$total_man_hours['views_min_man_hrs'];?></td>
                       <td><?php echo $total_man_hours['views_max_man_hrs'];$total_code_man_max_hrs+=$total_man_hours['views_max_man_hrs'];?></td>
                   </tr>
                   <tr>
                       <td>6</td>
                       <td>Rebuild Features</td>
                       <td>Features are not supported my automated upgrade. We need to re-package the features and build/configure the missing dependencies.</td>
                       <td><?php echo $total_man_hours['features_man_hrs_min'];$total_code_man_min_hrs+=$total_man_hours['features_man_hrs_min'];?></td>
                       <td><?php echo $total_man_hours['features_man_hrs_max'];$total_code_man_max_hrs+=$total_man_hours['features_man_hrs_max'];?></td>
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
                       <td><?php echo $total_man_hours['themes_man_hrs_min'];$total_code_man_min_hrs+=$total_man_hours['themes_man_hrs_min'];?></td>
                       <td><?php echo $total_man_hours['themes_man_hrs_max'];$total_code_man_max_hrs+=$total_man_hours['themes_man_hrs_max'];?></td>
                   </tr>
                   <tr>
                       <td>9</td>
                       <td>File Systems</td>
                       <td>The public files are handled mostly by the automated migration above. The private files needs to mugrated in seperate way. <br>  
Also the validation is executed here to verify 100% successful igration of files.</td>
                       <td>8 <?php $total_code_man_min_hrs+=8;?></td>
                       <td>16 <?php $total_code_man_max_hrs+=16;?></td>
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
                       <?php 
                           $qa_min_hrs = $total_code_man_min_hrs;
                           $qa_max_hrs =  $total_code_man_max_hrs;
                           $qa_min_hrs= (round(($qa_min_hrs*20)/100));
                           $total_code_man_min_hrs+=$qa_min_hrs;
                           $qa_max_hrs = (round(($qa_max_hrs*20)/100));
                           $total_code_man_max_hrs+=$qa_maxs_hrs;
                       ?>
                       <td><?php echo $qa_min_hrs;?></td>
                       <td><?php echo $qa_max_hrs;?></td>
                   </tr>
                   <tr>
                       <td>12</td>
                       <td> Deployment</td>
                       <td>The migrated Drupal 8 site is migrated to production and staging infrastructure.</td>
                       <td>8 <?php $total_code_man_min_hrs+=8;?></td>
                       <td>16 <?php $total_code_man_max_hrs+=16;?></td>
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
                       <td><?php echo $total_code_man_min_hrs;?>*</td>
                       <td><?php echo $total_code_man_max_hrs;?>*</td>
                   </tr>   
                </tbody>
            </table>
          </div>

          </div>
          <div class="">(*) Total Man hours calculated hours does not include additional Site Building efforts (#7 above ) which needs to be estimated by manual audit.</div><br/> 
	 <div class=""><b>Disclaimer:</b><br/> 
Above estimation is made using an advanced algorithm to help the decision making of Drupal 8 upgrade easy but exact estimation for execution may vary per site basis and a manual audit is recommended for cost and budgeting.</div>
         </div>

            </div>
            <div class="image1 text-center">
            <img src="http://opensenselabs.com/themes/contrib/opensense/images/Drupal-7-Vs-Drupal-8-feature-difference.jpg">
            <br>
            <br>
            <br>
            <br>
            <img src="http://opensenselabs.com/themes/contrib/opensense/images/Drupal-8-new-features..png">
            </div>
           
            <!-- <div class="checklist-wrapper">
            <h5 class="text-center title-secondary">Quick Price Checklist</h5>
            <div class="row flex-row top40">
      <div class="medium-6 columns">
        <div class="report-table">
        
            <div class="table-header">
              <table>
                    <thead>
                      <tr>
                          <th>S.no</th>
                          <th>Items</th>
                          <th>Est. Effort(hours)</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                          $s_no=0;
                          $sum_man_hrs=0;
                        foreach ($final_modules as $key => $value) {
                                    
                                echo '<tr>
                                        <td>'.++$s_no.'</td>
                                        <td class="view">'.$value['name'].'</td>
                                        
                                        <td class="hour">'.(int)($value['complexity']/$man_hours).'</td>
                                        <td><input type="checkbox" class="clickable check_box"></td>
                                       </tr>';
                                $sum_man_hrs+=(int)($value['complexity']/$man_hours);        
                          }
                          $s_no = 0;
                          echo '<tr>
                          <th>S.no</th>
                          <th>Views</th>
                          <th>Est. Effort(hours)</th>
                          <th></th>
                      </tr>';  
                           foreach ($viewsdata as $key => $value) {
                              echo '<tr>
                                        <td>'.++$s_no.'</td>
                                         <td class="view">'.$value['view'].'</td>
                                        <td class="hour">'.(int)(16 + ($value['displays'] -1)*4).'</td>
                                        <td><input type="checkbox" class="clickable check_box"></td>
                                  </tr>';
                                $sum_man_hrs+=(int)($value['displays']/$man_hours);
                            }
                            $s_no = 0;
                            echo '<tr>
                          <th>S.no</th>
                          <th>Themes</th>
                          <th>Est. Effort(hours)</th>
                          <th></th>
                      </tr>';  
                            foreach ($themes as $key => $value) {   
                                echo '<tr>
                                      <td>'.++$s_no.'</td>
                                      <td class="themes">'.$value['name'].'</td>
                                    <td class="hour">'.(int)($value['complexity']/$man_hours).'</td>
                                     <td><input type="checkbox" class="clickable check_box"></td>
                                </tr>';
                                $sum_man_hrs+=(int)($value['complexity']/$man_hours);
                        
                            }
                            $s_no = 0;
                          echo '<tr>
                          <th>S.no</th>
                          <th>Features</th>
                          <th>Est. Effort(hours)</th>
                          <th></th>
                      </tr>';                              
                             foreach ($final_features as $key => $value) {
                                    
                                echo '<tr>
                                      <td>'.++$s_no.'</td>
                                       <td class="features">'.$value['name'].'</td>
                                        <td class="hour">'.(int)($value['complexity']/$man_hours).'</td>
                                         <td><input type="checkbox" class="clickable check_box"></td>
                                </tr>';
                                $sum_man_hrs+=(int)($value['complexity']/$man_hours);
                        
                              }                                  
                    ?>             
                  </tbody>
              </table>
              
            </div></div></div>
            <div class="medium-6 columns">
        <div class="report-table">
     
        <ul class="pricing-table">
  <li class="title">Standard</li>
  <li class="price">Total Hours : <span id="total_hours"><?php echo $sum_man_hrs;?></span></li>
  <li class="price">Price : $24657</li>
  <li class="cta-button"><a class="button" href="http://opensenselabs.com/contact-us">Contact Now</a></li>
</ul>
</div></div></div>
</div> -->
<?php
/*

//Iterating Through the data received from JSON.
$RelatedScore = 9;
foreach ($module_list as $key) {
	$sql = "SELECT ID,Name,Complexity FROM module WHERE MachineName = '".$key."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
			
    	while($row = $result->fetch_assoc()) {
        	if($row['Complexity'] == NULL)
        	{
        		
        		$RelatedScore = get_version($row['ID']);
        		$LineScore = line_score($key,$module_list,$module_lines_list);   
        		$Complexity = $RelatedScore * $LineScore;
                $CurrentVersion = current_version($key,$module_list,$module_version_list);

        		$sql3 = "UPDATE module SET Complexity = ".$Complexity." WHERE ID = ".$row['ID'];
        		$conn->query($sql3);
        		if($LineScore != 0)
                	display_list($last_id,$row['Name'],$CurrentVersion,$RelatedScore);         
        		array_push($complexity_list,$Complexity);
        	}
        	else
        	{
        		$Complexity = $row['Complexity'];
                $version = get_version($row['ID']);
                $CurrentVersion = current_version($key,$module_list,$module_version_list);
                $LineScore = line_score($key,$module_list,$module_lines_list);
                if($LineScore != 0)
                	display_list($last_id,$row['Name'],$CurrentVersion,$version);
        		array_push($complexity_list,$Complexity);
        	}
        }
	} 
	else
	{
    	$sql4 = "SELECT ParentID FROM submodule WHERE MachineName = '".$key."'";
        $result4 = $conn->query($sql4);

        if ($result4->num_rows > 0) {
            while($row4 = $result4->fetch_assoc()) {
                    
                $Complexity = parent_complexity($row4['ParentID']);
                
                array_push($complexity_list,$Complexity);
                array_push($submodule_list,$key);        
            }
        }   
        else
        {
           $Complexity = 9 * line_score($key,$module_list,$module_lines_list);
           display_list($last_id,$key,'7.x',9);
    	   array_push($complexity_list,$Complexity);
	    }
    }
$RelatedScore = 9;
}

//Calculating Scoring for themes.
$RelatedScore = 9;
foreach ($theme_list as $key) {
    $sql5 = "SELECT ID,Name,Complexity FROM theme WHERE MachineName = '".$key."'";
    $result5 = $conn->query($sql5);

    if ($result5->num_rows > 0) {     
        while($row5 = $result5->fetch_assoc()) {
            if($row5['Complexity'] == NULL)
            {
            	$RelatedScore = get_version_theme($row5['ID']);
        		$LineScore = line_score($key,$theme_list,$theme_lines_list);   
        		$Complexity = $RelatedScore * $LineScore;
                $CurrentVersion = '7.x-1.x';

        		$sql3 = "UPDATE theme SET Complexity = ".$Complexity." WHERE ID = ".$row5['ID'];
        		$conn->query($sql3);
        		if($LineScore != 0)
                	display_list($last_id,$row5['Name'],$CurrentVersion,$RelatedScore);         
        		array_push($complexity_list,$Complexity);

            }
            else
            {
            	$CurrentVersion = "7.x-1.x";
                $Complexity = $row5['Complexity'];
                $version = get_version_theme($row5['ID']);
               	$LineScore = line_score($key,$theme_list,$theme_lines_list);
                if($LineScore != 0)
                	display_list($last_id,$row5['Name'],$CurrentVersion,$version);
                array_push($complexity_list_theme,$Complexity);
            }
        }
    }
    else
    {
        $RelatedScore = 9;
        $Complexity = $RelatedScore * line_score($key,$theme_list,$theme_lines_list);
        display_list($last_id,$key,'7.x-1.x',9);
        array_push($complexity_list_theme,$Complexity);
    }
$RelatedScore = 9;
}


for($i = 0;$i<count($module_list);$i++)
{	
	//echo $module_list[$i]."Complexity = ".$complexity_list[$i]."<br>";
	$sum += $complexity_list[$i];

}
for($j = 0;$j<count($theme_list);$j++)
{   
   // echo $theme_list[$j]."Complexity = ".$complexity_list_theme[$j]."<br>";
    $sum2 += $complexity_list[$j];

}
//echo "<h1>Total Complexity = ".($sum+$sum2)."</h1>";

$max = ($i+$j)*9*6;
//echo "<h1>Maximum Complexity = ".$max."</h1>";

$TotalComplexity = $sum + $sum2;

$score = ($max - $TotalComplexity)/($max) * 100;

$score = number_format((float)$score, 2, '.', '');

$sql11 = "UPDATE website SET TotalComplexity = ".$TotalComplexity." , Maximum = ".$max." WHERE ID = ".$last_id;
$conn->query($sql11);
*/

function get_latest_version($key)
{   
    include 'db_connect.php';
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
    include 'db_connect.php';
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
    include 'db_connect.php';
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
    include 'db_connect.php';
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
   include 'db_connect.php';
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
    include 'db_connect.php';

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


//Calculates related score of module or theme on basis of number of lines.
function line_score($key,$module_list,$module_lines_list)
{
    $index = array_search($key,$module_list);
    $lines = $module_lines_list[$index];
    if($lines == 0)
        return 0;
    elseif($lines >= 0 && $lines <= 2500)
        return 1;
    elseif($lines > 2500 && $lines <= 5000)
        return 2;
    elseif($lines > 5000 && $lines <= 7500)
        return 3;
    elseif($lines > 7500 && $lines <= 10000)
        return 4;
    elseif($lines > 10000 && $lines <= 12500)
        return 5;
    else
        return 6;

}

//Returns current version of module used by user.
function current_version($key,$module_list,$module_version_list)
{
    $index = array_search($key,$module_list);
    $version = $module_version_list[$index];
    $va = str_split($version);
    if($va[0] != 7)
        $va[0] = 7;
    if($va[2] == 0)
        $va[2] = 1;
    if($va[3] == NULL)
        $va[3] = 0;
    $sv = $va[0].".x"."-".$va[2].".".$va[3];
    return $sv;

}
//Returns latest version of module released
function get_version($ID)
{
    include 'db_connect.php';
    $RelatedScore = 9;
    $sql2 = "SELECT MIN(RelatedScore) FROM version WHERE ModuleID = ".$ID;
    $result2 = $conn->query($sql2);
    if($result2->num_rows > 0)
    {

        while($row2 = $result2->fetch_assoc())
        {   
            $RelatedScore = $row2['MIN(RelatedScore)'];   
        }
    }
    else
    {   
        $RelatedScore = 9;   
    }   
    
    if($RelatedScore != NULL) 
        return $RelatedScore;
    else
        return 9; 
}
//Returns latest version of theme released
function get_version_theme($ID)
{
    include 'db_connect.php';
    $RelatedScore = 9;
    $sql2 = "SELECT MIN(RelatedScore) FROM theme_version WHERE ModuleID = ".$ID;
    $result2 = $conn->query($sql2);
    if($result2->num_rows > 0)
    {

        while($row2 = $result2->fetch_assoc())
        {   
            $RelatedScore = $row2['MIN(RelatedScore)'];   
        }
    }
    else
    {   
        $RelatedScore = 9;   
    }   
    
    if($RelatedScore != NULL) 
        return $RelatedScore;
    else
        return 9; 
}


//Stores all the themes/modules being used by user.
function display_list($last_id,$moduleName,$va,$version)
{
    include 'db_connect.php';

    $sql10 = "INSERT INTO report VALUES(".$last_id.",'".$moduleName."','".$va."',".$version.")";
    //$sql10 = "INSERT INTO report VALUES(".$last_id.",'".$moduleName."','"..$version.")";
    $conn->query($sql10);    


    //If we go for JSON 
    /*static $n = 0;
    $module[$n] = array('title'=>$moduleName,'version'=>$version);
    $n++;
    $response['posts'] = $posts;
    $fp = fopen('results.json', 'a');
    fwrite($fp, json_encode($response));
    fclose($fp); */
}

//Returns complexity of parent in case of submodule.
function parent_complexity($ID)
{
    include 'db_connect.php';
    $sql8 = "SELECT Complexity FROM module WHERE ID = ".$ID;
    $result8 = $conn->query($sql8);

    if ($result8->num_rows > 0) {     
        while($row8 = $result8->fetch_assoc()) {
            if($row8['Complexity'] == NULL)
                return 9;
            else
            {    
                
                return $row8['Complexity']; 

            }
    }
}
    else
    {
        return 9;
    }

}

//Prints report on basis of latest version of module/theme released.
function related_version($version)
{
    $version_set = array();
    array_push($version_set,"NO");
    array_push($version_set,"NO");
    array_push($version_set,"NO");
    array_push($version_set,"NO");
    array_push($version_set,"NO");
   

    switch ($version)
    {
        case 0:
            $version_set[0] = "YES";
            break;
        case 1:
            $version_set[1] = "YES";
            break;
        case 4:
            $version_set[2] = "YES";
            break;
        case 6:
            $version_set[3] = "YES";
            break;
        case 8:
            $version_set[4] = "YES";
            break;
        
    }
    return $version_set;
}



?>		



<script src="http://opensenselabs.com/core/assets/vendor/jquery/jquery.min.js?v=2.2.3"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="http://opensenselabs.com/themes/contrib/zurb_foundation/js/foundation.min.js?v=8.2.0-rc1"></script>
<script type="text/javascript">
  $(document).ready(function(){
      $('.check_box').prop('checked',true);
       $('.clickable').on('click',function()
       {
          var final_hours;
          if($(this).prop('checked'))
          { 
            final_hours =parseInt($('#total_hours').text())+parseInt($(this).closest('tr').children('td.hour').text());   
          }
          else
          {            
            final_hours =parseInt($('#total_hours').text())-parseInt($(this).closest('tr').children('td.hour').text());
          }
            $('#total_hours').text(final_hours);  
        });
    });
</script>
<script>
    // (function ($) {
    //   $(document).foundation();
    // })(jQuery);
  </script>
<script type="text/javascript">
       console.log("in");
           var x = document.querySelectorAll(".version");
           console.log(x);
           for(i=0;i<x.length;i++)
           {
               console.log(x[i]);
               if(x[i].innerHTML == 'YES')
                   x[i].className = "green";
               else
                   x[i].className = "red";
           }

        // $(window).load(function() {
        //     if($('table td').innerHTML('yes') {
        //         alert('yes');

        //     } 

        // });
        jQuery(function () {

         
        var customHeight = $('.varheight').height();
        var customHeightOne = $('.varheightone').height();
        var customHeightTwo = $('.varheighttwo').height();
        $('.height-auto-wrap').css('height', customHeight);
        $('.height-auto-wrapone').css('height', customHeightOne);
        $('.height-auto-wraptwo').css('height', customHeightTwo);



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

    var chart2 = Highcharts.chart('graph-two', {
      credits: {
 enabled: false
},


        chart: {
            type: 'bar'
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
            categories: [<?php foreach ($final_modules as $key => $value) {
                echo "'".$value['name']."',";
            } ?>],
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
            name: 'Module Complexity',
            data: [<?php foreach ($final_modules as $key => $value) {
                echo $value['complexity'].",";
            } ?>]
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
//chart three
    var chart3 = Highcharts.chart('graph-three', {
      credits: {
 enabled: false
},


        chart: {
            type: 'bar'
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
            categories: [<?php foreach ($final_features as $key => $value) {
                echo "'".$value['name']."',";
            } ?>],
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
            name: 'Feature Complexity',
            data: [<?php foreach ($final_features as $key => $value) {
                echo $value['complexity'].",";
            } ?>]
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

        var chart4 = Highcharts.chart('graph-four', {
      credits: {
 enabled: false
},


        chart: {
            type: 'bar'
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
            categories: [<?php foreach ($themes as $key => $value) {
                echo "'".$value['name']."',";
            } ?>],
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
            name: 'Module Complexity',
            data: [<?php foreach ($themes as $key => $value) {
                echo $value['complexity'].",";
            } ?>]
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
        // Build the chart
        Highcharts.chart('piechart', {
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
                    name: 'Migration Path Available',
                    y: <?php echo $upgrade_path_yn['yes']; ?> }, {
                showInLegend: false,
                    name: 'Not Available',
                    y: <?php echo $upgrade_path_yn['no']; ?>,
                    sliced: true,
                    selected: true
                }]
            }]
        });
    });    
       </script>
       <script type="text/javascript">
       <?php
        $days_min =  ($total_man_hours['modules_man_hrs_min'] + $total_man_hours['themes_man_hrs_min'] + $total_man_hours['features_man_hrs_min'])/8; 
        $days_min = round($days_min,0);
        $days_max =  ($total_man_hours['modules_man_hrs_max'] + $total_man_hours['themes_man_hrs_max'] + $total_man_hours['features_man_hrs_max'])/8; 
        $days_max = round($days_max,0);       
        ?>
           document.getElementById("man_days").innerHTML = <?php echo '"'.$days_min.' to '.$days_max.' Man Days"'; ?>;
          document.getElementById("site-url").innerHTML = <?php echo '"'.$url.'"'; ?>;

          <?php
             $total_man_hours_max_website = ($total_man_hours['modules_man_hrs_max'] + $total_man_hours['themes_man_hrs_max'] + $total_man_hours['features_man_hrs_max']);
             $total_man_hours_min_website = ($total_man_hours['modules_man_hrs_min'] + $total_man_hours['themes_man_hrs_min'] + $total_man_hours['features_man_hrs_min']);

             $complatibility_min = ($total_man_hours_min_website - ($total_man_hours['modules_man_hrs_max']+ $total_man_hours['modules_man_hrs_min'])/2)/$total_man_hours_min_website * 100;
             $complatibility_min = round($complatibility_min,0);

             $complatibility_max = ($total_man_hours_max_website - ($total_man_hours['modules_man_hrs_max']+ $total_man_hours['modules_man_hrs_min'])/2)/$total_man_hours_max_website * 100;
             $complatibility_max = round($complatibility_max,0);
	     
//	     $complatibility_max= ($total_man_hours_min_website+$total_man_hours_max_website-$total_man_hours['modules_man_hrs_min']-$total_man_hours['modules_man_hrs_max'])*100/($total_man_hours_min_website+$total_man_hours_max_website);

         ?>

         //document.getElementById("compatiblity").innerHTML = <?php echo '"'.$complatibility_min.'% to '.$complatibility_max.' %"'; ?>;  
	  document.getElementById("compatiblity").innerHTML = <?php echo '"'.$complatibility_max.' %"'; ?>;
       </script>
      
<h5>New Table 1</h5>
<table id="#myTable">
  <tr><th>Type</th><th>Number of Modules</th><th>Number of Portable Module</th><th>Time Required for Porting</th><th>Estimated Cost</th></tr>
  <tr>
    <td>Core</td>
    <td><?php echo $core['number_of_modules']; ?></td>
    <td><?php echo $core['number_of_portable']; ?></td>
    <td><?php echo ($core['number_of_modules'] - $core['number_of_portable']); ?></td>
    <td>$0</td>
 </tr>
 <tr>
   <td>Custom</td>
   <td><?php echo $custom['number_of_modules']; ?></td>
   <td>0</td>
   <td><?php echo $custom['min_time']." to ".$custom['max_time']; ?></td>
   <td>$2450 to $3450</td>
 </tr>
 <tr>
   <td>Contributed</td>
   <td><?php echo $contrib['number_of_modules']; ?></td>
   <td><?php echo $contrib['number_of_portable']; ?></td>
   <td><?php echo $contrib['min_time']." to ".$contrib['max_time']; ?></td>
   <td>$2450 to $3450</td>
 </tr>
  <tr>
   <td>Features</td>
   <td><?php echo $features['number_of_modules']; ?></td>
   <td>0</td>
   <td><?php echo $features_man_hrs_min." to ".$features_man_hrs_max; ?></td>
   <td>$2450 to $3450</td>
 </tr>
  <tr>
   <td>Themes</td>
   <td><?php echo $themes['themes']; ?></td>
   <td>0</td>
   <td><?php echo $total_man_hours['themes_man_hrs_min']." to ".$total_man_hours['themes_man_hrs_max']; ?></td>
   <td>$2450 to $3450</td>
 </tr>
  <tr>
   <td>Views</td>
   <td><?php echo $views['views']; ?></td>
   <td>0</td>
   <td><?php echo $total_man_hours['views_min_man_hrs']." to ".$total_man_hours['views_max_man_hrs']; ?></td>
   <td>$2450 to $3450</td>
 </tr>   
</table>
<script type="text/javascript">
        $(document).ready(function(){
          $('#myTable').DataTable();
        });
      </script>
</body>
</html>
