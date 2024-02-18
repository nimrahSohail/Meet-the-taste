<?php
//include constants file
include('../config/constants.php');

//check whether the id and image name value is set or not
if(isset($_GET['id']) && isset($_GET['imagename']))
{

    //get the value and delete
    $id = $_GET['id'];
    $imagename = $_GET['imagename'];

//remove the physical image is available
if($imagename!="")
{
    //image is available so remove it
    $path = "../images/menu_type/".$imagename;

    //remove the image
    $remove = unlink($path);

    //if failed to remove image then add an error message and stop the process
    if($remove ==false)
    {
        //set the session message
        $_SESSION['upload'] ="<div class='error'>Failed to remove image file.</div>";
        //redirect to manage category page
        header('locatiion:'.SITEURL.'admin/manage-menutype.php');
        //stop the process
        die();
    }
}

//delete data from database
    //sql query delete data from database
    $sql = "DELETE FROM menu_type WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the data is delete from db or not
    if($res == true)
    {
        //set the session message
        $_SESSION['delete'] ="<div class='success'>Food deleted successfully.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-menutype.php');
        
    }

    else{
        //set the session message
        $_SESSION['delete'] ="<div class='error'>Failed to delete food.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-menutype.php');
    }

}

else{
    //redirect to manage category page
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-menutype.php');
}

?>