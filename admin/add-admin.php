<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

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
                <td>Username:</td>
                <td>
                    <input type="text" name="username" placeholder="Enter username">
                </td>
            </tr>

            <tr>
                <td>Email-address:</td>
                <td>
                    <input type="email" name="email_address" placeholder="Enter email-address">
                </td>
            </tr>

            <tr>
                <td>Contact-no:</td>
                <td>
                    <!-- <input type="tel" name="contact_no" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required> -->
                    <input type="tel" name="contact_no" placeholder="12345678">
                </td>
            </tr>

            <tr>
                <td>password:</td>
                <td>
                    <input type="password" name="password" placeholder="Enter password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
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
    
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
    $password = md5($_POST['password']);  //pwd encryption with md5

//2.  SQL query to save the data in the database
$sql = "INSERT INTO admin SET
    
    name = '$name',
    username = '$username',
    email_address = '$email_address',
    contact_no = '$contact_no',
    password = '$password'

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
    $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
    // redirect  page TO MANAGE ADMIN
    header("location:".SITEURL.'admin/manage-admin.php');
}

else
{
    // echo "not";
    //failed to insert data
    // create a session variable to display message
    $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
    // redirect  page TO MANAGE ADMIN
    header("location:".SITEURL.'admin/add-admin.php');
}
}

?>
