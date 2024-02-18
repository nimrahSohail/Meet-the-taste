<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>
            Login - Meet The Taste
        </title>
        <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }


            ?>
            <br><br>


            <!-- login form starts here -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter username"> <br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter password"> <br><br>

                <input type="submit" name="submit" value="login" class="btn-primary">
                <br><br>
            </form>
            
            <!-- login form ends here -->

            <p class="text-center">Created By <a href="#">NIMRAH</a></p>
        </div>
    </body>
</html>

<?php
//checked whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //1. get the data from login form
    // $username = $_POST['username'];
    // $password = md5($_POST['password']);

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $raw_password = md5($_POST['password']);
    $password =mysqli_real_escape_string($conn , $raw_password);



    //2. SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password' ";

    //3. execute the query
    $res = mysqli_query($conn, $sql);

    //4 connect rows to check whether the user exist or not
    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        //user available login success
        $_SESSION['login'] = "<div class='success'>LOGIN SUCCESFULL</div>";
        $_SESSION['user'] = $username;  //to check whether the user is logged in or not and logout will unset;

        //redirect
        header('location:'.SITEURL.'admin/');
    }
    else{
        $_SESSION['login'] = "<div class='text-center error'>FAILED TO LOGIN.</div>";

        //redirect
        header('location:'.SITEURL.'admin/login.php');
}}
?>