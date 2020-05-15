<!DOCTYPE html>

<html>

<?php require 'requires/header.php'; 

$role = $_GET['role'];

//get the topics
$subjects_sql = "SELECT * FROM clubs";

$subjects_query = mysqli_query($conn, $subjects_sql);



if(!$subjects_query){
  echo mysqli_error($conn);

}



?>


                          


      


<?php


          while($row = mysqli_fetch_array($subjects_query)){







                        $name = $row['names'];

                        $code = $row['id'];

                              echo "<option value ='$code'>".$name."</option>";

                    

}

                        ?>



                    
                      
        


