<?php  include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Menu</h1>
        <br>
        
        <?php
        if(isset($_SESSION['add'])) //checking whether the session is set or not
        {
            echo $_SESSION['add']; //display session message if set
            unset($_SESSION['add']); //remove session message
        }

        if(isset($_SESSION['remove'])) //checking whether the session is set or not
        {
            echo $_SESSION['remove']; //display session message if set
            unset($_SESSION['remove']); //remove session message
        }

        if(isset($_SESSION['delete'])) //checking whether the session is set or not
        {
            echo $_SESSION['delete']; //display session message if set
            unset($_SESSION['delete']); //remove session message
        }

        if(isset($_SESSION['no-menu-found'])) //checking whether the session is set or not
        {
            echo $_SESSION['no-menu-found']; //display session message if set
            unset($_SESSION['no-menu-found']); //remove session message
        }

        if(isset($_SESSION['update'])) //checking whether the session is set or not
        {
            echo $_SESSION['update']; //display session message if set
            unset($_SESSION['update']); //remove session message
        }

        if(isset($_SESSION['upload'])) //checking whether the session is set or not
        {
            echo $_SESSION['upload']; //display session message if set
            unset($_SESSION['upload']); //remove session message
        }

        if(isset($_SESSION['failed-remove'])) //checking whether the session is set or not
        {
            echo $_SESSION['failed-remove']; //display session message if set
            unset($_SESSION['failed-remove']); //remove session message
        }
        ?>

        <br><br>
        <!-- Button to add admin -->
        <a href="<?php echo SITEURL;?>admin/add-menu.php" class="btn-primary">Add Menu</a>
        <br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.No</th>
                        <th>Main_course</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //query to get all categories from database
                    $sql = "SELECT * FROM menu";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows
                    $count = mysqli_num_rows($res);

                    //create serial no. variable and assign the value as 1
                    $sn = 1;


                    //check whether we have data in database or not
                    if($count>0)
                    {
                        //we have data in db
                        //get the data and display
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $main_course = $row['main_course'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $main_course;?></td>
                                
                                <td>
                                    <?php 
                                        //check whether image name is available or not
                                        if($image_name != "")
                                        {
                                            //display the image
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/menu/<?php echo $image_name;?>" width="100px">
                                            <?php
                                        }
                                        else{
                                            //display the message
                                            echo "<div class='error'>Image not added.</div>";
                                        }
                                    ?>
                                </td>

                                 <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-menu.php?id=<?php echo $id;?>" class="btn-secondary">Update menu</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-menu.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete menu</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }

                    else{
                        //we don't have data in db
                        //we will display the message inside the table
                        ?>

                        <tr>
                            <td colspan='6'><div class="error">No Menu Added.</div></td>
                        </tr>

                        <?php
                    }
                    ?>

                </table>
    </div>
</div>

<?php  include('partials/footer.php') ?>