<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Menu_type</h1>

        <br><br>

        <?php
        if(isset($_SESSION['upload'])) //checking whether the session is set or not
        {
            echo $_SESSION['upload']; //display session message if set
            unset($_SESSION['upload']); //remove session message
        }
        ?>


        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

        <tr>
            <td>Type_name:</td>
            <td>
                <input type="text" name="type_name" placeholder="Enter menutype">
            </td>
        </tr>

        <tr>
            <td>Description:</td>
            <td>
                <textarea name="description" placeholder="description of the menutype" cols="30" rows="5"></textarea>
            </td>
        </tr>

        <tr>
            <td>Price:</td>
            <td>
                <input type="number" name="price">
            </td>
        </tr>

        <tr>
            <td>Select Image:</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>Menu</td>
            <td>
                <select name="menu">

                <?php
                //create php code to display menu from db
                //1. create sql query to get all active menu from db
                $sql = "SELECT * FROM menu WHERE active='Yes'";

                //executing query
                $res = mysqli_query($conn, $sql);
                
                //count rows to check whether we have menu or not
                $count = mysqli_num_rows($res);

                //if count is greater than zero, we have menu else we donot have menu
                if($count>0)
                {
                    //we have menu
                    while($row =mysqli_fetch_assoc($res))
                    {
                        //get the details of menu
                        $id = $row['id'];
                        $main_course = $row['main_course'];

                        ?>
                        <option value="<?php echo $id;?>"><?php echo $main_course; ?></option>
                        <?php
                    }
                }
                else
                {
                    //we donot have categories
                    ?>
                    <option value="0">No Menu found</option>
                    <?php
                }

                ?>

                </select>
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
                <input type="submit" name="submit" value="Add Menutype" class="btn-secondary">
            </td>
        </tr>

        </table>

        </form>

        <?php

        //check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            //add the food in db
            // echo "clicked";

            //1. get the data from form
            $type_name = mysqli_real_escape_string($conn, $_POST['type_name']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $menu = mysqli_real_escape_string($conn, $_POST['menu']);

            //check whether radio button for featured and active are checked or not
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }

            else{
                $featured = "No"; //selecting the default value
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }

            else{
                $active = "No"; //selecting the default value
            }

            //2. upload the image if selected
            //check whether the select image is clicked or not and upload the image only if the image is selected
            if(isset($_FILES['image']['name']))
            {
                //get the details of the selected image
                $imagename = $_FILES['image']['name'];

                //cehck whether the image is selected or not  then upload
                if($imagename!="")
                {
                    //image is selected
                    //A. rename the image
                    //get the extension of selected image(jpg, png, gif, etc)
                    $ext = end(explode('.',$imagename));

                    //create the new name for image
                    $imagename = "Food-Menutype-Name-".rand(0000,9999).".".$ext; //new image name may be "Food-Menutype-Name-232.jpg"

                    //upload the image
                    //get the src path and destination path

                    //source path  is the current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    //destination path for the image to be uploaded
                    $dest = "../images/menu_type/".$imagename;

                    //finally upload the image
                    $upload = move_uploaded_file($src, $dest);

                    //checked whether the imsage uploaded or not
                    if($upload == false)
                    {
                        //failed o upload the image
                        //redirect to add food pae with error message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload</div>";
                        header('location:'.SITEURL.'admin/add-menutype.php');
                        //stop the process
                        die();
                    }
                }
            }
            else{
                $imagename =""; //setting default value or blank
            }

            //3. insert into db

            //create a sql query to save or add food
            //for numerical value no need to pass quotes whereas for string value yes
            $sql2 = "INSERT INTO menu_type SET
            type_name = '$type_name',
            description = '$description',
            price = '$price',
            imagename = '$imagename',
            menu_id = '$menu',
            featured = '$featured',
            active = '$active'
            ";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //check whether data inserted or not
             //4. redirect with message to manage food page
            if($res2 == true)
            {
                $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                header('location:'.SITEURL.'admin/manage-menutype.php');
            }
            else{
                $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                header('location:'.SITEURL.'admin/manage-menutype.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>