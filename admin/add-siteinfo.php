<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Siteinfo</h1>

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
                <td>Contact-info:</td>
                <td>
                    <input type="text" name="contact_info">
                </td>
            </tr>

            <tr>
                <td>Location:</td>
                <td>
                    <input type="text" name="location">
                </td>
            </tr>

            <tr>
                <td>About us:</td>
                <td>
                    <input type="text" name="description">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Siteinfo" class="btn-secondary">
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
    
    $contact_info = mysqli_real_escape_string($conn,$_POST['contact_info']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

//2.  SQL query to save the data in the database
$sql = "INSERT INTO site_information SET
    
    contact_info = '$contact_info',
    location = '$location',
    description = '$description'
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
    $_SESSION['add'] = "<div class='success'>Site Added Successfully.</div>";
    // redirect  page TO MANAGE ADMIN
    header("location:".SITEURL.'admin/manage-siteinfo.php');
}

else
{
    // echo "not";
    //failed to insert data
    // create a session variable to display message
    $_SESSION['add'] = "<div class='error'>Failed to Add Site.</div>";
    // redirect  page TO MANAGE ADMIN
    header("location:".SITEURL.'admin/add-siteinfo.php');
}
}

?>
