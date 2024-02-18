<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
         //1. get the ID of selected Admin
         $id = $_GET['id'];

         //2. create SQL query to get the details
         $sql = "SELECT * FROM admin WHERE id=$id";

         //execute the query
         $res = mysqli_query($conn, $sql);

         //check whether the query is executed or not
         if($res == TRUE)
         {
            //check whether the data is available or not
            $count = mysqli_num_rows($res);

            //check whether we have admin data or not
            if($count == 1)
            {
                //get the details
                // echo "Admin Available";
                $row = mysqli_fetch_assoc($res);

                $name = $row['name'];
                $username = $row['username'];
                $email_address = $row['email_address'];
                $contact_no = $row['contact_no'];

            }

            else{
                //redirect to manage Admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
         }
         ?>

        <form action="" method="POST">
            <table class="tbl-30">
                
                <tr>
                    <td>Name:</td>
                    <td>
                        <input type="text" name="name" value="<?php echo $name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>

                <tr>
                    <td>Email-address:</td>
                    <td>
                        <input type="email" name="email_address" value="<?php echo $email_address;?>">
                    </td>
                </tr>

                <tr>
                    <td>Contact-no:</td>
                    <td>
                        <input type="tel" name="contact_no" value="<?php echo $contact_no;?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="update Admin" class="btn-secondary">
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
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);

    //create sql query to update admin
    $sql = "UPDATE admin SET

    name = '$name',
    username = '$username',
    email_address = '$email_address',
    contact_no = '$contact_no'
    WHERE id = '$id'
    ";

    //execute query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed or not
    if($res == TRUE)
    {
        //updated
        $_SESSION['update'] = "<div class='success'>Admin updated successfully.</div>";
        //redirect to manage-admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    else{
        //not updated
        $_SESSION['update'] = "<div class='error'>Failed to update.</div>";
        //redirect to manage-admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

}
?>

<?php include('partials/footer.php'); ?>
