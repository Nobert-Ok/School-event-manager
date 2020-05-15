<?php require 'requires/header.php'; 
//necessary ums file
require 'user/simpleusers/su.inc.php'; 

?>
    <title>User Processing | ALUSM</title>
  </head>

  <body class="nav-md">


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
         
    
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
      
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Login Details<small></small></h2>
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



                    <br />
                    
 <?php
if (isset($_POST['firstname'])){

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$role = $_POST['role'];

//generate strong password..
function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

$password = random_password(8);

if (isset($_POST['kisomo'])){
$kisomo = $_POST['kisomo'];
$kisomo = mysqli_real_escape_string($conn, $kisomo);

}


//clean input
$firstname = mysqli_real_escape_string($conn, $firstname);
$lastname = mysqli_real_escape_string($conn, $lastname);
$email = mysqli_real_escape_string($conn, $email);
$role = mysqli_real_escape_string($conn, $role);



//Generate Username..
$firstLetter = substr($firstname, 0,1);
$restpart = substr($lastname, 0, 4);
$num = rand(100, 900);

$username = $firstLetter.$restpart.$num;

// $username = 'givenality';


$registerUser = new SimpleUsers(); 
     
    $res = $registerUser->createUser("$username", "$password"); 
    if( $res ) {
      $id = $res;
       
      echo "<div class = 'alert alert-success'>User added successfully with the following credentials: - 
      </br></br><div class = 'alert alert-danger'>
      <strong> Username: </strong>".$username ." </br>
      <strong> Password: </strong>".$password. "</br>
      </div>";
      echo "<p>Use the following credentials to access the application</p>
      <p><a href = 'admin.php'>Click Here</a> to log into the application</p>";

      $registerUser->setInfo("email", "$email", $id);
      $registerUser->setInfo("firstname", "$firstname", $id);
      $registerUser->setInfo("lastname", "$lastname", $id);
      $registerUser->setInfo("role", "$role", $id);
      

      if (isset($kisomo)){
      $registerUser->setInfo("club", "$kisomo", $id);

      }

              }
    else {
        $error = mysqli_error("Error is:");
        echo $error;
        echo "The username was already taken."; 
        }


}


                    ?>


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
            ALUSM
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