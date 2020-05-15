<?php 

//lining up our ducks in a good row; 

//header file
require 'requires/header.php';

//necessary ums file
require 'user/simpleusers/su.inc.php'; 


//'time ago' function
function humanTiming ($time)
{

    $time = time() - strtotime($time); // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}


function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


?>

    <title>ALU Student's Manager Admin</title>

   
<?php

//======================if user is logged in {}

    $SimpleUsers = new SimpleUsers();

    if($SimpleUsers->logged_in){

//Get number of Categories
	$subj_counter = "SELECT * from categories";
	$subj_result = mysqli_query($conn, $subj_counter);
	$subjcount = mysqli_num_rows($subj_result);


//Get number of clubs
	      $qn_counter = "SELECT * from clubs";
  $qn_result = mysqli_query($conn, $qn_counter);
  $events = mysqli_num_rows($qn_result);


//Get number of active/future events
	      $ans_counter = "SELECT * from events WHERE status ='Active'";
  $ans_result = mysqli_query($conn, $ans_counter);
  $answers = mysqli_num_rows($ans_result);
  $answers = $answers;
	



  //14012019144646
//Get number of events today
$tod_counter = "SELECT * FROM events WHERE date >= CURDATE()";
$tod_result = mysqli_query($conn, $tod_counter);
$today = mysqli_num_rows($tod_result);
$today = $today;





//number of users
      $users_counter = "SELECT * from students";
  $usr_result = mysqli_query($conn, $users_counter);
  $users = mysqli_num_rows($usr_result);


	?>

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="admin.php" class="site_title"><span>ALUSM Admin</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome, </span>
                <h2><?php echo $_SESSION['firstname'];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php require 'requires/sidebar.php' ?>
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
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="user/logout.php">
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
                    <img src="images/nobs.jpeg" style = 'width:50px;height:50px;' alt=""><?php echo $_SESSION['firstname'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    
                    <li><a href="user/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count"><?php echo $users?></div>
                  <h3>Users</h3>
                  <p>Registered</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count"><?php echo $events; ?></div>
                  <h3>Clubs</h3>
                  <p>Registered</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count"><?php echo $today?></div>
                  <h3>Events</h3>
                  <p>Created </p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count"><?php echo $answers; ?></div>
                  <h3>Active</h3>
                  <p>Events</p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
      
                  <div class="x_content">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                     <div>
                <div class="x_title">
                  <h2>Latest Events <small>All Types</small></h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">


 <?php



//get the lastest reports


$lastest_qns = "SELECT * FROM events ORDER BY id DESC LIMIT 5";
$latest_qns_result = mysqli_query($conn, $lastest_qns);


if ($latest_qns_result->num_rows > 0) {

    while($row = $latest_qns_result->fetch_assoc()) {

  $event = $row['id'];
  $status = $row['status'];
  $admin_id = $row['admin_id'];
  $event_title = $row['event_title'];
  $event_date = $row['event_date'];
  $club_id = $row['club_id'];
  $created = $row['date'];
  $location = $row['location'];
  $description = $row['description'];

$time = strtotime($event_date);







//get club details
    $user_details_query = "SELECT * from clubs WHERE id='$club_id'";
    $user_details_result = mysqli_query($conn, $user_details_query);


      while($row = $user_details_result->fetch_assoc()){


        $id = $row['id'];
        $names = $row['names'];
        $city = 'Rwanda';
        // $location = $row['district'];

      }
          ?>            


                    <li>
                      <a>
                        <div class="image">
                          <img src="images/ALU.png" alt="img" />
                        </div>
                        <span>
                          <span><strong><?php  "</strong><span style = 'color:#1d80d1; font-weight:700;'>,</span>"; ?></span>
                          <span class="time"><?php echo humanTiming($created)." ago"; ?></span>
                        </span>
                        <span class="message">
                          <p> Event Title: <?php echo $event_title; ?></p>
                          <p> Location: <?php echo $location; ?></p>
                          <p> Date: <?php echo $event_date; ?></p>
                        </span>
                      </a>
                    </li>
<?php

  } }

  ?>



                  </ul>
                </div>
              </div>
            </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="x_title">
                          <h2>Latest Users</h2>

                          <div class="clearfix"></div>
                        </div>
                        <ul class="list-unstyled top_profiles scroll-view">

                          
<?php
                  //get user details
                    $user_latest_query = "SELECT * from students ORDER BY user_id DESC LIMIT 6";
                      $user_latest_result = mysqli_query($conn, $user_latest_query);


                      while($row = $user_latest_result->fetch_assoc()){


                        $uid = $row['user_id'];
                        $names = $row['full_name'];
                        $student_year = $row['year'];
                        $reg_date = $row['created_date'];
                        $cohort = $row['cohort'];
                        $course = $row['course_id'];

                      

//get course details
                    $course_details_query = "SELECT * from courses WHERE id='$course'";
                      $course_details_result = mysqli_query($conn, $course_details_query);


                      while($row = $course_details_result->fetch_assoc()){


                        $course_tbl_id = $row['id'];
                        $course_name = $row['name'];
                        //$city = 'Rwanda';
                        // $location = $row['district'];

                      }






                        $datetime = new DateTime($reg_date);

                        $date = $datetime->format('y-M-d');
                        $time = $datetime->format('H:i');
                     
                      //creating string text from time

                        $datetext = explode('-', $date);


                        $year = $datetext[0];
                        $month   = $datetext[1];
                        $day  = $datetext[2];

?>


                          <li class="media event">
                            <a class="pull-left border-aero profile_thumb">
                              <i class="fa fa-user aero"></i>
                            </a>
                            <div class="media-body">
                              <a class="title" href="#"><?php echo $names; ?></a>
                              <p><strong><?php echo "Year $student_year"; ?> </strong> <?php echo $course_name; ?> </p>
                              <p> <small><?php echo $day." ".$month." ".$year;?> </small>
                              </p>
                            </div>
                          </li>

                <?php

              } 

              ?>
                          
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
<?php
if ($_SESSION['userid']!= "14"){


?>
          <!--   <div class="row">
              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Top 5 Subjects</h2>
                  



                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

]

                    <article class="media event">
                      <a class="pull-left date">
                        <h4><?php //echo $namba ?></h4>
                        <p class="month">qns</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#"><?php //echo $somo ?></a>
                       
                      </div>
                    </article>


                    <?php

                //   }
                // }

                  ?>
                    </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Top Grades <small>All subjects</small></h2>
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


                    <?php
//get the leading subjects


$leading_grades = "SELECT `kidato`, COUNT(`kidato`) AS `value_occurrence` FROM `events` where relevance = '1' and reviewed = 'yes' GROUP BY `kidato` ORDER BY `value_occurrence` DESC LIMIT 5;";
$leading_grades_result = mysqli_query($conn, $leading_grades);
$leading_grades_count = mysqli_num_rows($leading_grades_result);

  if ($leading_grades_result->num_rows > 0) {

     while($row = $leading_grades_result->fetch_assoc()) {

    $kidato = $row['kidato'];
    $namba = $row['value_occurrence'];


?>

                    <article class="media event">
                      <a class="pull-left date">
                        <h4><?php echo $namba; ?></h3>
                        <p class="month">qns</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">Form <?php echo $kidato; ?></a>
                      </div>
                    </article>
                    

        <?php

        }

          }
?>                  </div>
                </div>
              </div> -->
              <?php

            }

            ?>
            </div>
          </div>
        <footer>
          <div class="pull-right">
            ALUSM 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <?php require 'requires/scripts.php'; ?>
    <!-- Flot -->
    <script>
      $(document).ready(function() {
        //define chart clolors ( you maybe add more colors if you want or flot will add it automatic )
        var chartColours = ['#96CA59', '#3F97EB', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'];

        //generate random number for charts
        randNum = function() {
          return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
        };

        var d1 = [];
        //var d2 = [];

        //here we generate data for chart
        for (var i = 0; i < 30; i++) {
          d1.push([new Date(Date.today().add(i).days()).getTime(), randNum() + i + i + 10]);
          //    d2.push([new Date(Date.today().add(i).days()).getTime(), randNum()]);
        }

        var chartMinDate = d1[0][0]; //first day
        var chartMaxDate = d1[20][0]; //last day

        var tickSize = [1, "day"];
        var tformat = "%d/%m/%y";

        //graph options
        var options = {
          grid: {
            show: true,
            aboveData: true,
            color: "#3f3f3f",
            labelMargin: 10,
            axisMargin: 0,
            borderWidth: 0,
            borderColor: null,
            minBorderMargin: 5,
            clickable: true,
            hoverable: true,
            autoHighlight: true,
            mouseActiveRadius: 100
          },
          series: {
            lines: {
              show: true,
              fill: true,
              lineWidth: 2,
              steps: false
            },
            points: {
              show: true,
              radius: 4.5,
              symbol: "circle",
              lineWidth: 3.0
            }
          },
          legend: {
            position: "ne",
            margin: [0, -25],
            noColumns: 0,
            labelBoxBorderColor: null,
            labelFormatter: function(label, series) {
              // just add some space to labes
              return label + '&nbsp;&nbsp;';
            },
            width: 40,
            height: 1
          },
          colors: chartColours,
          shadowSize: 0,
          tooltip: true, //activate tooltip
          tooltipOpts: {
            content: "%s: %y.0",
            xDateFormat: "%d/%m",
            shifts: {
              x: -30,
              y: -50
            },
            defaultTheme: false
          },
          yaxis: {
            min: 0
          },
          xaxis: {
            mode: "time",
            minTickSize: tickSize,
            timeformat: tformat,
            min: chartMinDate,
            max: chartMaxDate
          }
        };
        var plot = $.plot($("#placeholder33x"), [{
          label: "Email Sent",
          data: d1,
          lines: {
            fillColor: "rgba(150, 202, 89, 0.12)"
          }, //#96CA59 rgba(150, 202, 89, 0.42)
          points: {
            fillColor: "#fff"
          }
        }], options);
      });
    </script>
    <!-- /Flot -->

    <!-- jQuery Sparklines -->
    <script>
      $(document).ready(function() {
        $(".sparkline_one").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 4, 5, 6, 3, 5, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
          type: 'bar',
          height: '125',
          barWidth: 13,
          colorMap: {
            '7': '#a1a1a1'
          },
          barSpacing: 2,
          barColor: '#26B99A'
        });

        $(".sparkline11").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3], {
          type: 'bar',
          height: '40',
          barWidth: 8,
          colorMap: {
            '7': '#a1a1a1'
          },
          barSpacing: 2,
          barColor: '#26B99A'
        });

        $(".sparkline22").sparkline([2, 4, 3, 4, 7, 5, 4, 3, 5, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6], {
          type: 'line',
          height: '40',
          width: '200',
          lineColor: '#26B99A',
          fillColor: '#ffffff',
          lineWidth: 3,
          spotColor: '#34495E',
          minSpotColor: '#34495E'
        });
      });
    </script>
    <!-- /jQuery Sparklines -->

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function() {
        var canvasDoughnut,
            options = {
              legend: false,
              responsive: false
            };

        new Chart(document.getElementById("canvas1i"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Symbian",
              "Blackberry",
              "Other",
              "Android",
              "IOS"
            ],
            datasets: [{
              data: [15, 20, 30, 10, 30],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]

            }]
          },
          options: options
        });

        new Chart(document.getElementById("canvas1i2"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Symbian",
              "Blackberry",
              "Other",
              "Android",
              "IOS"
            ],
            datasets: [{
              data: [15, 20, 30, 10, 30],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]

            }]
          },
          options: options
        });

        new Chart(document.getElementById("canvas1i3"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Symbian",
              "Blackberry",
              "Other",
              "Android",
              "IOS"
            ],
            datasets: [{
              data: [15, 20, 30, 10, 30],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]

            }]
          },
          options: options
        });
      });
    </script>
    <!-- /Doughnut Chart -->

    <!-- bootstrap-daterangepicker -->
    <script type="text/javascript">
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->
  </body>

<?php

}
else if (!$SimpleUsers->logged_in && !empty($_POST['username']) && !empty($_POST['password']) ){


$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);


 $passUser = new SimpleUsers(); 

    $res = $passUser->loginUser($username, $password); 
     
    if( $res ) 
    { 

$_SESSION['userid'] = $res;
$userid = $res;


    	//get info and set them for session


    $getdata = new SimpleUsers(); 

    // Get stored information for the user with userId provided in the third parameter. 
    // This is useful for administrators when wanting to retrieve stored information about a user 
    $first_name = $getdata->getInfo("firstname"); 
    $club_id = $getdata->getInfo("club"); 

$_SESSION['firstname'] = $first_name;
$_SESSION['club_id'] = $club_id;
echo "<meta http-equiv='refresh' content=0;admin.php />";
    }     
    else 
    { 
        echo "You passed the wrong credentials."; 
    } 

}
// //If they have not logged in and are trying to log in..



// //check that they have filled the username and password boxes
// elseif(!empty($_POST['username']) && !empty($_POST['password']))
// {



// //try log them in using the username and password if submitted
//     $username = mysqli_real_escape_string($conn, $_POST['username']);
//     $password = mysqli_real_escape_string($conn, $_POST['password']);
    
//     $sql = "SELECT * FROM admin_users WHERE username = '".$username."' AND password = '".$password."'";
//  $checklogin = $conn->query($sql);

// //check that there is nothing wrong with the query
//      if (!$checklogin){
//      	echo "Something is wrong with the query on index.php line 43";
//      }

//      //however if username and password have matched and a row is found in the database..
//     if(mysqli_num_rows($checklogin) == 1)
//     {
//     	//fetch the entire row

//         $row = mysqli_fetch_array($checklogin);

//         //save email 
//         $email = $row['email'];
//         $firstname = $row['firstname'];
//         $lastname = $row['lastname'];
        
//         //start a session where you store username, email and the status of whether logged in or not 
//         $_SESSION['username'] = $username;
//         $_SESSION['email'] = $email;
//         $_SESSION['LoggedIn'] = 1;
//         $_SESSION['firstname'] = $firstname;
//         $_SESSION['lastname'] = $lastname;
         
//         echo "<h1>Success</h1>";
//         echo "<p>We are now redirecting you to the member area.</p>";
//         echo "<meta http-equiv='refresh' content=0;admin.php />";


   
    


    //if could not log in






//===================================================================//
//======================== NOT LOGGED IN BODY BEGIN ======================//


else {

?>
<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
              <h1>Sign in</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required name="username" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required name = "password"/>
                    
              </div>
              <div class="float-left">

                <input type="submit" class="btn btn-default submit"></a>
                <!--
                <a class="reset_pass" href="#">Lost your password?</a>
                !-->
              </div>
          

              <div class="clearfix"></div>
              	
              <div class="separator">
                <p class="change_link">New to site?
                  <a href="login.php" class="to_register"> Create Account </a>
                </p>
                <div>
                  <h1><i class="fa fa-copyright"></i> </h1>
                  <p>©2019 All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>
</form>
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Alu stUdent's Manager</h1>
                  <p>©2019 All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            
          </section>
        </div>
      </div>
    </div>
  </body>
  <?php
}
?>

</html>
