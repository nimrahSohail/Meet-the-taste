<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Menu</h1>

        <br><br>

        <?php

        //check whether the id is set or not
        if(isset($_GET['id']))
        {
            //get the id and all other details
            // echo "Getting the data";
            $id = $_GET['id'];
            //create sql query to get all other details
            $sql = "SELECT * FROM menu WHERE id=$id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //count the data to check whether the id is valid or not
            $count =  mysqli_num_rows($res);

            if($count == 1)
            {
                //get all the data
                $row = mysqli_fetch_assoc($res);
                $main_course = $row['main_course'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            }
            else{
                //redirect to manage category page
                $_SESSION['no-menu-found']= "<div class='error'>Menu not found.</div>";
                header('location:'.SITEURL.'admin/manage-menu.php');
            }
        }

        else{
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-menu.php');
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

            <tr>
                <td>Main_course:</td>
                <td>
                    <input type="text" name="main_course" value="<?php echo $main_course; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                    <?php
                    if($current_image !="")
                    {
                        //display the image
                        ?>
                        <img src="<?php echo SITEURL;?>images/menu/<?php echo $current_image; ?>" width="150px">
                        <?php
                    }
                    else{
                        //display the message
                        echo "<div class='error'>Image not added</div>";
                    }
                    ?>
                </td>
            </tr>

            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="yes"){echo "checked";}?> type="radio" name="featured" value="yes">Yes
                    <input <?php if($featured=="no"){echo "checked";}?> type="radio" name="featured" value="no">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="yes"){echo "checked";}?> type="radio" name="active" value="yes">Yes
                    <input <?php if($active=="no"){echo "checked";}?> type="radio" name="active" value="no">No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Menu" class="btn-secondary">
                </td>
            </tr>

        </table>

        </form>

        <?php

        if(isset($_POST['submit'])) //post b/c we are passing the value using form
        {
            // echo "clicked";

            //1. get all values from our form
            $id = $_POST['id'];
            $main_course = mysqli_real_escape_string($conn, $_POST['main_course']);
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. updating new image if selected 
            //check whether the image is selected or not
            if(isset($_FILES['image']['name']))
            {
                //get the image details
                $image_name = $_FILES['image']['name'];

                //check whether the image is available or not
                if($image_name !="")
                {
                    //image available
                    //A.   upload the new image
                
                    //auto rename our image
                    //get the extension of our image(jpg, png, gif, etc) e.g "specialfood1.jpg" 
                $ext = end(explode('.', $image_name));

                //rename the image
                $image_name = "Food-Menu-".rand(000,999).'.'.$ext;  //e.g Food-Menu-834.jpg


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
                    header('location:'.SITEURL.'admin/manage-menu.php');

                    //stop the process
                    die();
                }

                    //B.   remove the current image if available
                    if($current_image!="")
                    {
                        $remove_path = "../images/menu/".$current_image;
                        $remove = unlink($remove_path);

                        //checked whether the image is removed or not
                        //if failed to remove then display the message and stop the process
                        if($remove == false)
                        {
                            //failed to remove message
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                            header('location:'.SITEURL.'admin/manage-menu.php');
                            die(); //stop the process
                        }
                    }
                    
                }

                else{
                    $image_name = $current_image;
                }
            }
            else
            {
                $image_name = $current_image;
            }

            //3.  update the database
            $sql2 = "UPDATE menu SET
            main_course = '$main_course',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id = '$id'
            ";

$res2 = mysqli_query($conn, $sql2);
            
            if($res2==true)
            {
                //category updated
                $_SESSION['update'] = "<div class='success'>Updated successfully.</div>";
     //execute the query
            //4. redirect to manage category with message
            header('location:'.SITEURL.'admin/manage-menu.php');
            //check whether query executed or not           header('location:'.SITEURL.'admin/manage-category.php');
            }
            else{
                //failed to update
                $_SESSION['update'] = "<div class='error'>Failed to update.</div>";
                header('location:'.SITEURL.'admin/manage-menu.php');
            }

        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>