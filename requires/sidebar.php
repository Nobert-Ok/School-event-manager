<?php require 'requires/header.php';  ?>

<?php

if ($_SESSION['userid']!= "14"){

  ?>


  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                </br>
                </br>
                </br>
                <ul class="nav side-menu">
                  <li><a href="admin.php"><i class="fa fa-home"></i> Home</a>
                  </li>
                   <li><a href="categories.php"><i class="fa fa-book"></i> Categories</a></li>
                   <li><a href="clubs.php"><i class="fa fa-user"></i> Clubs</a></li>
                  <li><a href="users.php"><i class="fa fa-users"></i> Users</a></li>
                  <li><a href="events.php"><i class="fa fa-check"></i> Schedules</a></li>
                  <li><a href="courses.php"><i class="fa fa-book"></i> Courses</a></li>
                  <li><a href="new_user.php"><i class="fa fa-plus"></i> Add System User</a></li>
                  <li><a href="new_event.php"><i class="fa fa-plus"></i> Add Event</a></li>
                   
              </div>
              

            </div>
<?php
}

else 

if ($_SESSION['userid'] = "14"){
            ?>


             <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="admin.php"><i class="fa fa-home"></i> Home</a>
                  </li>
                </ul>
 
              </div>
              

            </div>


            <?php
          }
          ?>