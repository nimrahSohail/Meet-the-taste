<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Staff</h1>

        <br><br>

        <?php
        if(isset($_SESSION['add'])) //checking whether the session is set or not
        {
            echo $_SESSION['add']; //display session message if set
            unset($_SESSION['add']); //remove session message
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">

            <tr>
                <td>Name:</td>
                <td>
                    <input type="text" name="name" placeholder="Enter name">
                </td>
            </tr>

            <tr>
                <td>Designation:</td>
                <td>
                    <input type="text" name="designation" placeholder="Enter designation">
                </td>
            </tr>

            <tr>
                <td>Salary:</td>
                <td>
                    <input type="number" name="salary" placeholder="Enter salary">
                </td>
            </tr>

            <!-- <tr>
                <td>password:</td>
                <td>
                    <input type="password" name="password" placeholder="Enter password">
                </td>
            </tr> -->

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Staff" class="btn-secondary">
                </td>
            </tr>
            </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php"); ?>

<!-- ======================================================================================================================================= -->
<?php 
//   process the value from form and save it in database
// isset check whether the button is clicked or not

if(isset($_POST['submit']))
{
//button clicked
// echo"Button clicked";

//1. get the data from form
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    
    //$password = md5($_POST['password']);  //pwd encryption with md5

//2.  SQL query to save the data in the database
$sql = "INSERT INTO staff SET
    
    name = '$name',
    designation = '$designation',
    salary = '$salary'

    -- left side walay column names hain database kay
";

//3. Executing query and saving data into database

// $res is a result is sahi then true and viceversa
$res = mysqli_query($conn, $sql) or die(mysqli_error());
// we use mysqli instead of mysql

//4. check whether the (query is executed) data is inserted or not and display appropiate message
if($res == True)
{
    //data inserted
    // echo "inserted";

    // create a session variable to display message
    $_SESSION['add'] = "<div class='success'>Staff Added Successfully.</div>";
    // redirect  page TO MANAGE ADMIN
    header("location:".SITEURL.'admin/manage-staff.php');
}

else
{
    // echo "not";
    //failed to insert data
    // create a session variable to display message
    $_SESSION['add'] = "<div class='error'>Failed to Add Staff.</div>";
    // redirect  page TO MANAGE ADMIN
    header("location:".SITEURL.'admin/add-staff.php');
}
}

?>
