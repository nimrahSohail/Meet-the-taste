<?php 

//include constants.php file here
include('../config/constants.php');

//1. get the ID of Admin to be deleted
echo $id = $_GET['id'];

//2. create SQL query to delete Admin
$sql = "DELETE FROM staff WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

//check whether the query executed successfully or not
if($res == TRUE)
{
    //query executed successfully and Admin deleted
    // echo "Admin deleted"; ye next page par print karraha hai message

    //create ession variable to display message
    $_SESSION['delete'] = "<div class='success'>Staff Deleted Successfully.</div>";

    //redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-staff.php');
}

else{
    //failed to delete admin
    // echo "Admin not deleted";

    $_SESION['delete'] = "<div class='error'>Failed to delete staff. Try again</div>";
    header('location:'.SITEURL.'admin/manage-staff.php');  // redirect to manage Admin page with message (success/error)

}
?>