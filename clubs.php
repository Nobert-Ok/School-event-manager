<?php require 'requires/header.php';

//necessary ums file
require 'user/simpleusers/su.inc.php'; 


 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 



//get vars from url

//$uid = $_GET['uid'];

?>
    <title>Clubs | ALUSM</title>

  </head>



<?php

//======================if user is logged in {}

    $SimpleUsers = new SimpleUsers();

    if($SimpleUsers->logged_in){

      $users_counter = "SELECT * from clubs";
  $usr_result = mysqli_query($conn, $users_counter);
  $clubsnum = mysqli_num_rows($usr_result);


?>




  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="admin.php" class="site_title">ALUSM Admin</a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
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
              <a data-toggle="tooltip" data-placement="top" title="Logout">
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


            <!-- user data view -->
             <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count"><?php echo $clubsnum?></div>
                  <h3>Clubs</h3>
                  <p>Currently in the system.</p>
                </div>
              </div>
              
      
            </div>


            <div class="page-title">
              <div class="title_left">
                <h3>ALUSM Clubs</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
 
                <!-- SUBJECTS LIST !-->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <a type="button" class="btn btn-primary" href = "new_club.php">Add</a>
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
                    <p class="text-muted font-13 m-b-30">
                      Browse the list of clubs currently registered in ALUSM.
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>

                     
                        <tr>
                          <th>Names</th>
                          <th>Admin Email</th>
                          <th>Category</th>
                          <th>Registration Date</th>
                          <th>Events</th>
                          

                        </tr>
                      </thead>


                      <tbody>
<?php
if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;

      

        $total_pages_sql = "SELECT COUNT(*) FROM clubs";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM clubs LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($res_data)){


                        $id = $row['id'];
                        $names = $row['names'];
                        $cat = $row['cat'];
                        $admin_email = $row['admin_email'];
                        $reg_date = $row['created_date'];
                        
                         //Get club category name
                           $sql4 = "SELECT * FROM categories WHERE id = '$cat'";
                          $res4_data = mysqli_query($conn,$sql4);

                        
                          while($row = mysqli_fetch_array($res4_data)){

                          $cat_name = $row['name'];
                              
                              }
                       //events counter
                        $events_counter = "SELECT * from events where club_id = '$id'";
                        $usr3_result = mysqli_query($conn, $events_counter);
                        $eventsnum = mysqli_num_rows($usr3_result);  

                        //ratings avg counter
                        $avg_counter = "SELECT AVG(rating) AS avg from events where club_id = '$id'";
                        $usr4_result = mysqli_query($conn, $avg_counter);
                        while($row4 = mysqli_fetch_array($usr4_result)){
                        $doctoravg = $row4['avg'];
                      }

                    
?>
                       <tr>
                          <td><a href = "profile.php?uid=<?php echo $id ?>"><?php echo $names ?></a></td>
                          <td><?php echo $admin_email ?></td>
                          <td><?php echo $cat_name ?></td>
                          <td><?php echo $reg_date ?></td>
                          <td><?php echo $eventsnum ?></td>
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

        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            ALUSM</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

<?php require 'requires/scripts.php'; ?>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->

    <?php

  }

else {

  echo "<meta http-equiv='refresh' content=0;admin.php />";
}
  ?>
  </body>
</html>