<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Staff</h1>
        <br><br>

        <?php 
         //1. get the ID of selected Staff
         $id = $_GET['id'];

         //2. create SQL query to get the details
         $sql = "SELECT * FROM staff WHERE id=$id";

         //execute the query
         $res = mysqli_query($conn, $sql);

         //check whether the query is executed or not
         if($res == TRUE)
         {
            //check whether the data is available or not
            $count = mysqli_num_rows($res);

            //check whether we have staff data or not
            if($count == 1)
            {
                //get the details
                // echo "Admin Available";
                $row = mysqli_fetch_assoc($res);

                $name = $row['name'];
                $designation = $row['designation'];
                $salary = $row['salary'];

            }

            else{
                //redirect to manage staff page
                header('location:'.SITEURL.'admin/manage-staff.php');
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
                    <td>Designation:</td>
                    <td>
                        <input type="text" name="designation" value="<?php echo $designation;?>">
                    </td>
                </tr>

                <tr>
                    <td>Salary:</td>
                    <td>
                        <input type="number" name="salary" value="<?php echo $salary;?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="update Staff" class="btn-secondary">
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
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);

    //create sql query to update admin
    $sql = "UPDATE staff SET

    name = '$name',
    designation = '$designation',
    salary = '$salary'
    WHERE id = '$id'
    ";

    //execute query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed or not
    if($res == TRUE)
    {
        //updated
        $_SESSION['update'] = "<div class='success'>Staff updated successfully.</div>";
        //redirect to manage-admin page
        header('location:'.SITEURL.'admin/manage-staff.php');
    }

    else{
        //not updated
        $_SESSION['update'] = "<div class='error'>Failed to update.</div>";
        //redirect to manage-admin page
        header('location:'.SITEURL.'admin/manage-staff.php');
    }

}
?>

<?php include('partials/footer.php'); ?>
