<?php require 'requires/header.php'; 
//necessary ums file
require 'user/simpleusers/su.inc.php'; 

// $region = $_POST['region'];

?>
    <title>New Institution | NinjaTraffic</title>



  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title">NinjaTraffic</a>
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
         
    
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
      
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add New Institution <small></small></h2>
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

<p>Step 2: Please enter the institution's particulars..</p>






                    <br />
                    <form class="form-horizontal form-label-left" action="new_institution_process.php" method="POST" enctype="multipart/form-data">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Institution Name:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="e.g Given Edward" name = "names">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile Number:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="e.g 0658 295950" name = "mobile_number">
                        </div>
                      </div>

                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Type:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                         <select class='form-control' name = "category">
                            
                            <?php 
                            

                                  //fetch regions
                            
                            $categories_query = "SELECT * from categories";
                            $categories_res = mysqli_query($conn, $categories_query);

                                  //get region name and id
                            while ($category_row = $categories_res->fetch_assoc()){
                              $category_name = $category_row['name'];
                              $code = $category_row['id'];

                              echo "<option value = '$code' >".$category_name."</option>";
                             
                            }

                

                            ?>
                          </select>
                        </div>
                      </div>
          <!--             <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Experience (in years):</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="e.g 2" name = "experience">
                        </div>
                      </div> -->

                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Region</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class='form-control' name = "region">
                            
                            <?php 
                            

                                  //fetch regions
                            
                            $regions_query = "SELECT * from regions";
                            $regions_res = mysqli_query($conn, $regions_query);

                                  //get region name and id
                            while ($region_row = $regions_res->fetch_assoc()){
                              $region_name = $region_row['name'];
                              $code = $region_row['id'];

                              echo "<option value = '$code' >".$region_name."</option>";
                             
                            }

                

                            ?>
                          </select>
                        </div>
                      </div>

<div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Description/Bio</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea class="resizable_textarea form-control" placeholder="A brief description of yourself" name="description"></textarea>
                    </div>
                  </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload the Institution's Logoo</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="file" name="institutionPhoto" id="fileToUpload">
                        </div>
                      </div>


    <div class="form-group"  style="visibility: hidden;display:none;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Region</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="region" value = "<?php echo $region; ?>"></input> 
                           
                        </div>
                      </div>

 

             <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <input type="submit" class="btn btn-success"></input>
                        </div>
                      </div>
 <div class="ln_solid"></div>
                    </form>


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
            NinjaTraffic App
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
  </body>
</html>