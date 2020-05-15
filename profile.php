<?php require 'requires/header.php';

//necessary ums file
require 'user/simpleusers/su.inc.php'; 

 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 



// //PHP time formats
//     Required. Specifies the format of the outputted date string. The following characters can be used:
// d - The day of the month (from 01 to 31)
// D - A textual representation of a day (three letters)
// j - The day of the month without leading zeros (1 to 31)
// l (lowercase 'L') - A full textual representation of a day
// N - The ISO-8601 numeric representation of a day (1 for Monday, 7 for Sunday)
// S - The English ordinal suffix for the day of the month (2 characters st, nd, rd or th. Works well with j)
// w - A numeric representation of the day (0 for Sunday, 6 for Saturday)
// z - The day of the year (from 0 through 365)
// W - The ISO-8601 week number of year (weeks starting on Monday)
// F - A full textual representation of a month (January through December)
// m - A numeric representation of a month (from 01 to 12)
// M - A short textual representation of a month (three letters)
// n - A numeric representation of a month, without leading zeros (1 to 12)
// t - The number of days in the given month
// L - Whether it's a leap year (1 if it is a leap year, 0 otherwise)
// o - The ISO-8601 year number
// Y - A four digit representation of a year
// y - A two digit representation of a year
// a - Lowercase am or pm
// A - Uppercase AM or PM
// B - Swatch Internet time (000 to 999)
// g - 12-hour format of an hour (1 to 12)
// G - 24-hour format of an hour (0 to 23)
// h - 12-hour format of an hour (01 to 12)
// H - 24-hour format of an hour (00 to 23)
// i - Minutes with leading zeros (00 to 59)
// s - Seconds, with leading zeros (00 to 59)
// u - Microseconds (added in PHP 5.2.2)
// e - The timezone identifier (Examples: UTC, GMT, Atlantic/Azores)
// I (capital i) - Whether the date is in daylights savings time (1 if Daylight Savings Time, 0 otherwise)
// O - Difference to Greenwich time (GMT) in hours (Example: +0100)
// P - Difference to Greenwich time (GMT) in hours:minutes (added in PHP 5.1.3)
// T - Timezone abbreviations (Examples: EST, MDT)
// Z - Timezone offset in seconds. The offset for timezones west of UTC is negative (-43200 to 50400)
// c - The ISO-8601 date (e.g. 2013-05-05T16:34:42+00:00)
// r - The RFC 2822 formatted date (e.g. Fri, 12 Apr 2013 12:01:05 +0200)
// U - The seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)
// and the following predefined constants can also be used (available since PHP 5.1.0):

// DATE_ATOM - Atom (example: 2013-04-12T15:52:01+00:00)
// DATE_COOKIE - HTTP Cookies (example: Friday, 12-Apr-13 15:52:01 UTC)
// DATE_ISO8601 - ISO-8601 (example: 2013-04-12T15:52:01+0000)
// DATE_RFC822 - RFC 822 (example: Fri, 12 Apr 13 15:52:01 +0000)
// DATE_RFC850 - RFC 850 (example: Friday, 12-Apr-13 15:52:01 UTC)
// DATE_RFC1036 - RFC 1036 (example: Fri, 12 Apr 13 15:52:01 +0000)
// DATE_RFC1123 - RFC 1123 (example: Fri, 12 Apr 2013 15:52:01 +0000)
// DATE_RFC2822 - RFC 2822 (Fri, 12 Apr 2013 15:52:01 +0000)
// DATE_RFC3339 - Same as DATE_ATOM (since PHP 5.1.3)
// DATE_RSS - RSS (Fri, 12 Aug 2013 15:52:01 +0000)
// DATE_W3C - World Wide Web Consortium (example: 2013-04-12T15:52:01+00:00)
//get vars from url

$uid = $_GET['uid'];


$query = "SELECT * from doctors WHERE id='$uid'";
                      $result = mysqli_query($conn, $query);


                      while($row = $result->fetch_assoc()){


                          $id = $row['id'];
                        $names = $row['names'];
                        $mobile = $row['mobile_number'];
                        $region = $row['city'];
                        $district = $row['district'];
                        $cat = $row['cat'];
                        $experience = $row['experience'];
                        $reg_date = $row['created_date'];
                        $photo = $row['photo'];
                        $bio = $row['bio'];

                        //Get doctor category name
                           $sql4 = "SELECT * FROM categories WHERE id = '$cat'";
                          $res4_data = mysqli_query($conn,$sql4);
                          while($row = mysqli_fetch_array($res4_data)){

                          $cat_name = $row['name'];
                              
                              }
                       //events counter
                        $events_counter = "SELECT * from events where doctor_id = '$id'";
                        $usr3_result = mysqli_query($conn, $events_counter);
                        $eventsnum = mysqli_num_rows($usr3_result);  

                        //ratings avg counter
                        $avg_counter = "SELECT AVG(rating) AS avg from events where doctor_id = '$id'";
                        $usr4_result = mysqli_query($conn, $avg_counter);
                        while($row4 = mysqli_fetch_array($usr4_result)){
                        $doctoravg = $row4['avg'];
                      }

                        //Get City Name
                        $cityq = "SELECT * from regions where id = '$region'";
                        $cityqres = mysqli_query($conn, $cityq);
                        while($row5 = mysqli_fetch_array($cityqres)){
                        $city_name = $row5['name'];
                      }


                                   //events counter
                        $events_counter = "SELECT * from events where doctor_id = '$id'";
                        $usr3_result = mysqli_query($conn, $events_counter);
                        $eventsnum = mysqli_num_rows($usr3_result);  

                      }

?>
    <title><?php echo $names."'s Profile | ALUSM";?> </title>

    


<?php

//======================if user is logged in {}

    $SimpleUsers = new SimpleUsers();

    if($SimpleUsers->logged_in){

      $users_counter = "SELECT * from doctors";
  $usr_result = mysqli_query($conn, $users_counter);
  $users = mysqli_num_rows($usr_result);


?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Ninja Traffic</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['firstname'];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
             <?php require 'requires/sidebar.php'; ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

                <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""><?php echo $_SESSION['firstname'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <l
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Doctor Profile</h3>
              </div>

            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detailed Report <small>Activities Overview</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="uploads/<?php echo $photo;?>" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3><?php echo $names; ?></h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <b>Speciality:</b> <?php echo $cat_name; ?>
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <b>Location:</b> <?php echo $city_name; ?>
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-phone user-profile-icon"></i> <b>Mobile:</b> <?php echo $mobile; ?>
                        </li>

                          <li class="m-top-xs">
                          <i class="fa fa-calendar user-profile-icon"></i> <b>events:</b> <?php echo $eventsnum; ?>
                        </li>
                          <li class="m-top-xs">
                          <i class="fa fa-check user-profile-icon"></i> <b>Ratings:</b> <?php echo $doctoravg; ?>
                        </li>
                      </ul>

        <!--               <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a> -->
                      <br />

                      <!-- start skills -->
                      

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <!-- end of user-activity-graph -->

                      <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      Here are doctor <?php echo $names. "'s";?> latest activities
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>

                     
                        <tr>
                        
                          <th>Requester</th>
                          <th>Location</th>
                          <th>Doctor</th>
                          <th>category</th>
                          <th>Status</th>
                        </tr>
                      </thead>


                      <tbody>

<?php
//pagination 140120191111

 if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;

      

        $total_pages_sql = "SELECT COUNT(*) FROM events";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM events LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($res_data)){



                        $id = $row['id'];
                        $user = $row['user_id'];

//Get user name
                           $sql2 = "SELECT * FROM member WHERE user_id = '$user'";
                          $res2_data = mysqli_query($conn,$sql2);
                          while($row2 = mysqli_fetch_array($res2_data))
                                {
                          $user_names = $row2['full_name'];
                                }

                                  //continue...
                        $region = $row['city'];
                        $doctor_id = $row['doctor_id'];
                        $status = $row['status'];
                        // $somo = $row['somo'];

                                //Get doctor id and category
                           $sql3 = "SELECT * FROM doctors WHERE id = '$doctor_id'";
                          $res3_data = mysqli_query($conn,$sql3);
                          while($row = mysqli_fetch_array($res3_data))
                                {
                          $doctor_name = $row['names'];
                          $doctor_city = $row['city'];   
                          $doctor_cat = $row['cat'];   
                                }


                                //Get doctor category name
                           $sql4 = "SELECT * FROM categories WHERE id = '$doctor_cat'";
                          $res4_data = mysqli_query($conn,$sql4);
                          while($row = mysqli_fetch_array($res4_data)){

                          $cat_name = $row['name'];
                              

                                }

                        $category_name = $cat_name;
                        $city = $row['city'];
?>
                       <tr>
                         
                          <td><?php echo $user_names ?></td>
                          <td><?php echo $region ?></td>
                          <td><?php echo $doctor_name ?></td>
                          <td><?php echo $cat_name ?></td>
                          <td><?php echo $status ?></td>
                       
                          <?php
                        }
                         ?> 
                        </tr>
                        <tr>
             
                      </tbody>
                    </table>


                    <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
                  </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            ALUSM 2018
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>


<?php require 'requires/scripts.php'; ?>


    <?php

  }

else {

echo "<meta http-equiv='refresh' content=0;admin.php />";
}
  ?>
  </body>
</html>