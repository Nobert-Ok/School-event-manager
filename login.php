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
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
         
    
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
      
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Sign in <small></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">



                    <?php
if (isset($_POST['firstname'])){

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$role = $_POST['role'];
$password = $_POST['password'];


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


$registerUser = new SimpleUsers(); 
     
    $res = $registerUser->createUser("$username", "$password"); 
    if( $res ) {
        echo "User was created with username: ".$username; 
      echo "<div class = 'alert alert-success'>User added successfully. <a href ='system_users.php' class = 'btn btn-danger'>View Users</a></div>";
              }
    else {
        $error = mysqli_error("Error is:");
        echo $error;
        echo "The username was already taken."; 
        }


}

                    ?>




                    <br />
                    <form class="form-horizontal form-label-left" action="login_processing.php" method="POST">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Nobert" name = "firstname" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Chukwuebuka" name = "lastname" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="nobert@yahoo.com" name = "email" required>
                        </div>
                      </div>              
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Role:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class='form-control' name ='role' id ='role' onchange="pickSubject(this.value)">
                             <option value="null">Please select:</option>
                             <option value="admin">Admin</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group" id="kisomo_container" style="display: none">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Club:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class='form-control' name ='kisomo' id ='kisomo'>
                          </select>
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
      </div>
    </div>

<?php require 'requires/scripts.php'; ?>