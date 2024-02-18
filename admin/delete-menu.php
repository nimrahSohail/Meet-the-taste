<?php

//include constants file
include('../config/constants.php');

//check whether the id and image name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //get the value and delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the physical image is available
    if($image_name!="")
    {
        //image is available so remove it
        $path = "../images/menu/".$image_name;

        //remove the image
        $remove = unlink($path);

        //if failed to remove image then add an error message and stop the process
        if($remove ==false)
        {
            //set the session message
            $_SESSION['remove'] ="<div class='error'>Failed to remove menu image.</div>";
            //redirect to manage category page
            header('locatiion:'.SITEURL.'admin/manage-menu.php');
            //stop the process
            die();
        }
    }

    //delete data from database
    //sql query delete data from database
    $sql = "DELETE FROM menu WHERE id = '$id'";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the data is delete from db or not
    if($res == true)
    {
        //set the session message
        $_SESSION['remove'] ="<div class='success'>Menu deleted successfully.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-menu.php');
        
    }
    else{
        //set the session message
        $_SESSION['remove'] ="<div class='error'>Failed to delete menu.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-menu.php');
    }
}

else{
    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage-menu.php');
}
?>