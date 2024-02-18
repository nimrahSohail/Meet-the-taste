<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Menu</h1>

        <br><br>

        <?php
        if(isset($_SESSION['add'])) //checking whether the session is set or not
        {
            echo $_SESSION['add']; //display session message if set
            unset($_SESSION['add']); //remove session message
        }

        if(isset($_SESSION['upload'])) //checking whether the session is set or not
        {
            echo $_SESSION['upload']; //display session message if set
            unset($_SESSION['upload']); //remove session message
        }
        ?>

        <br>

        <!-- Add Category form starts -->
        <form action="" method="POST" enctype= "multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Main_course:</td>
                <td>
                    <input type="text" name="main_course" placeholder="Add menu name">
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="yes">Yes
                    <input type="radio" name="featured" value="no">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="yes">Yes
                    <input type="radio" name="active" value="no">No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Menu" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
        <!-- Add Category form ends-->

        <?php

        //check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            // echo "clicked";

            //1. get value from category form
            $main_course = $_POST['main_course'];

            //for radio input, we checked whether the button is selected or not
            if(isset($_POST['featured']))
            {
                //get the value from form
                $featured = $_POST['featured'];
            }

            else{
                //set the default value
                $featured = "no";
            }

            if(isset($_POST['active']))
            {
                //get the value from form
                $active = $_POST['active'];
            }

            else{
                //set the default value
                $active = "no";
            }

            //check whether the image is selected or not and set the value for image name accordingly
            // print_r($_FILES['image']);

            //die(); //break the code here

            if(isset($_FILES['image']['name']))
            {
                //upload the image
                //to upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];

                //upload the image only if image is selected
                if($image_name != "")
                {

                //auto rename our image
                //get the extension of our image(jpg, png, gif, etc) e.g "specialfood1.jpg" 
                $ext = end(explode('.', $image_name));

                //rename the image
                $image_name = "Food-Menu-".rand(000,999).'.'.$ext;  //e.g food-menu-834.jpg


                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/menu/".$image_name;


                //upload the image
                $upload  = move_uploaded_file($source_path, $destination_path);

                //check whether the image is uploaded or not
                //if not uploaded then we will stop the process and redirect with error message

                if($upload == false)
                {
                    //set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";

                    //redirect
                    header('location:'.SITEURL.'admin/add-menu.php');

                    //stop the process
                    die();
                }
            }
            }

            else{
                //don't upload image and set the image_name value as blank
                $image_name = "";
            }

            //2. sql query to insert the category into database
            $sql = "INSERT INTO menu SET
            main_course = '$main_course',
            image_name ='$image_name',
            featured = '$featured',
            active = '$active'
            ";

            //3. execute the query and sasve in db
            $res = mysqli_query($conn, $sql);

            //4. check whether the (query is executed) data is inserted or not and display appropiate message
if($res == true)
{
    //data inserted
    // echo "inserted";

    // create a session variable to display message
    $_SESSION['add'] = "<div class='success'>Menu Added Successfully.</div>";
    // redirect  page TO MANAGE CATEGORY
    header("location:".SITEURL.'admin/manage-menu.php');
}

else
{
    // echo "not";
    //failed to insert category
    // create a session variable to display message
    $_SESSION['add'] = "<div class='error'>Failed to Add Menu.</div>";
    // redirect  page TO MANAGE CATEGORY
    header("location:".SITEURL.'admin/add-menu.php');
}
        }
        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>