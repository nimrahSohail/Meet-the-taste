<?php 

//include constants.php file here
include('../config/constants.php');

//1. get the ID of  to be deleted
echo $id = $_GET['id'];

//2. create SQL query to delete 
$sql = "DELETE FROM site_information WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

//check whether the query executed successfully or not
if($res == TRUE)
{
    //query executed successfully and  deleted
    // echo " deleted"; ye next page par print karraha hai message

    //create ession variable to display message
    $_SESSION['delete'] = "<div class='success'> Deleted Successfully.</div>";

    //redirect to manage  page
    header('location:'.SITEURL.'admin/manage-siteinfo.php');
}

else{
    //failed to delete 
    // echo " not deleted";

    $_SESION['delete'] = "<div class='error'>Failed to delete admin. Try again</div>";
    header('location:'.SITEURL.'admin/manage-siteinfo.php');  // redirect to manage page with message (success/error)

}
?>