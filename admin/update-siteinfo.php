<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Siteinfo</h1>
        <br><br>

        <?php 
         //1. get the ID of selectedsite
         $id = $_GET['id'];

         //2. create SQL query to get the details
         $sql = "SELECT * FROM site_information WHERE id=$id";

         //execute the query
         $res = mysqli_query($conn, $sql);

         //check whether the query is executed or not
         if($res == TRUE)
         {
            //check whether the data is available or not
            $count = mysqli_num_rows($res);

            //check whether we havesite data or not
            if($count == 1)
            {
                //get the details
                // echo "Available";
                $row = mysqli_fetch_assoc($res);

                $contact_info = $row['contact_info'];
                $location = $row['location'];
                $description = $row['description'];
            }

            else{
                //redirect to manage Admin page
                header('location:'.SITEURL.'admin/manage-siteinfo.php');
            }
         }
         ?>

        <form action="" method="POST">
            <table class="tbl-30">
                
                <tr>
                    <td>Contact_info:</td>
                    <td>
                        <input type="text" name="contact_info" value="<?php echo $contact_info;?>">
                    </td>
                </tr>

                <tr>
                    <td>Location:</td>
                    <td>
                        <input type="text" name="location" value="<?php echo $location;?>">
                    </td>
                </tr>

                <tr>
                    <td>About Us:</td>
                    <td>
                        <input type="text" name="description" value="<?php echo $description;?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Contact_info" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
//checked whether the submit button i clicked or not
if(isset($_POST['submit']))
{
    // echo "Button clicked";

    //get all the values from form for update
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    //create sql query to update site
    $sql = "UPDATE site_information SET

    contact_info = '$contact_info',
    location = '$location',
    description = '$description'
    WHERE id = '$id'
    ";

    //execute query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed or not
    if($res == TRUE)
    {
        //updated
        $_SESSION['update'] = "<div class='success'>Updated successfully.</div>";
        //redirect to manage-admin page
        header('location:'.SITEURL.'admin/manage-siteinfo.php');
    }

    else{
        //not updated
        $_SESSION['update'] = "<div class='error'>Failed to update.</div>";
        //redirect to manage-admin page
        header('location:'.SITEURL.'admin/manage-siteinfo.php');
    }

}
?>

<?php include('partials/footer.php'); ?>