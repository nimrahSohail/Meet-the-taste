<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Menutype</h1>

        <br><br>
   
<?php 
//check whether id i set or not
if(isset($_GET['id']))
{
    //get all the details
    $id = $_GET['id'];

    //sql query to get the selected food
    $sql2 = "SELECT * FROM menu_type WHERE id = $id";
    //execute the query
    $res2 = mysqli_query($conn, $sql2);

    //get the individual values of selected food
    $row2 = mysqli_fetch_assoc($res2);

    //get the individual values of selected food
    
    $type_name = $row2['type_name'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['imagename'];
    $current_menu = $row2['menu_id'];
    $featured =$row2['featured'];
    $active = $row2['active'];
}
else{
    //redirect to manage food
    header('location:'.SITEURL.'admin/manage-menutype.php');
}

?>

<form action="" method="POST" enctype="multipart'form-data">

<table class="tbl-30">

<tr>
    <td>Type_name:</td>
    <td>
        <input type="text" name="type_name" value="<?php echo $type_name;?>">
    </td>
</tr>

<tr>
    <td>Description:</td>
    <td>
        <textarea name="description"  cols="30" rows="5"><?php echo $description;?></textarea>
    </td>
</tr>

<tr>
    <td>Price</td>
    <td>
        <input type="number" name="price" value="<?php echo $price;?>">
    </td>
</tr>

<tr>
    <td>Current image:</td>
    <td>
        <?php
        if($current_image =="")
        {
            //image not available
            echo "<div class='error'>Image not available.</div>";
        }
        else{
            //image aailable
            ?>
            <img src="<?php echo SITEURL;?>images/menu_type/<?php echo $current_image;?>"  width ="150px">

            <?php
        }
        ?>
    </td>
</tr>

<tr>
    <td>Select new image</td>
    <td>
        <input type="file" name="image">
    </td>
</tr>

<tr>
    <td>Menu</td>
    <td>
        <select name="menu" >

        <?php
        //query to get active categories
        $sql = "SELECT * FROM menu WHERE active= 'yes'";

        //execute the query
        $res = mysqli_query($conn , $sql);
        //count rows
        $count = mysqli_num_rows($res);
        
        //check whether category available or not
        if($count>0)
        {
            //categories availabole
            while($row = mysqli_fetch_assoc($res))
            {
                $menu_title = $row['main_course'];
                $menu_id = $row['id'];

                ?>

                <option <?php if($current_menu == $menu_id){echo "selected";}?> value="<?php echo $menu_id;?>"><?php echo $menu_title;?></option>

                <?php
            }
        }

        else
        {
            //cetegory not avail
            echo "<option value='0'>Menutype not available.</option>";
        }
        ?>

        </select>
    </td>
</tr>


<tr>
    <td>Featured:</td>
    <td>
        <input  <?php if($featured=="yes"){echo "checked";}?> type="radio" name="featured" value="yes">Yes
        <input  <?php if($featured=="no"){echo "checked";}?> type="radio" name="featured" value="no">No
    </td>
</tr>

<tr>
    <td>Active:</td>
    <td>
        <input  <?php if($active=="yes"){echo "checked";}?> type="radio" name="active" value="yes">Yes
        <input  <?php if($active=="no"){echo "checked";}?> type="radio" name="active" value="no">No
    </td>
</tr>

<tr>
    <td>
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
        <input type="submit" name="submit" value="Update Menutype" class="btn-secondary">
    </td>
</tr>

</table>
</form>

<?php

if(isset($_POST['submit']))
{
    // echo "clicked";

    //get all the details from the form
    $id = $_POST['id'];
    $type_name = $_POST['type_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $menu = $_POST['menu'];

    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //2. update the image if selectede

    //check whether upload button is clicked or not
    if(isset($_FILES['image']['name']))
    {
        //clicked
        $imagename = $_FILES['image']['name'];  //new img name
        
        //check whether the file is avail or not
        if($imagename !="")
        {
            // img availble

            //rename the img
            $ext = end(explode('.',$imagename)); //get the extension of img

            $imagename = "Food-Name-".rand(0000,9999).'.'.$ext; //this will be rename img


            $src_path = $_FILES['image']['tmp_name'];

            $dest_path = "../images/food/".$imagename;
                //upload the image
            $upload  = move_uploaded_file($src_path, $dest_path);

                //check whether the image is uploaded or not
                //if not uploaded then we will stop the process and redirect with error message
                if($upload == false)
                {
                    //set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";

                    //redirect
                    header('location:'.SITEURL.'admin/manage-menutype.php');

                    //stop the process
                    die();
                }

                //3. remove the img if new selected or current image exists
                //B.   remove the current image if available
                if($current_image!="")
                {
                    $remove_path = "../images/menu_type/".$current_image;
                    $remove = unlink($remove_path);

                    //checked whether the image is removed or not
                       //if failed to remove then display the message and stop the process
                       if($remove == false)
                       {
                           //failed to remove message
                           $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                           header('location:'.SITEURL.'admin/manage-menutype.php');
                           die(); //stop the process
                       }
                   }
        }
        else{
            $imagename = $current_image; //default img when img is not selected
        }
    }
    else{
        $imagename = $current_image;  //default img when button is not clicked
    }
    

    //4. update food in db
    $sql3 = "UPDATE menu_type SET
    type_name = '$type_name',
    description = '$description',
    price = $price,
    imagename = '$imagename',
    menu_id = '$menu',
    featured = '$featured',
    active = '$active'
    WHERE id='$id'
    ";

    //execute the query

    $res3=mysqli_query($conn, $sql3);

    if($res3==true)
    {
        //query executed 
        $_SESSION['update'] = "<div class ='success' >Food updated successfully.</div>";
        header('location:'.SITEURL.'admin/manage-menutype.php');

    }
    else{
        //feailed to upload
        $_SESSION['update'] = "<div class='error'>Failed to update.</div>";
        header('location:'.SITEURL.'admin/manage-menutype.php');
    }
    
}

?>

</div>
</div>
<?php include('partials/footer.php')?>


