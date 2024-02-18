<?php  include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Menu-type</h1>
        
        <br>

        <?php
        if(isset($_SESSION['add'])) //checking whether the session is set or not
        {
            echo $_SESSION['add']; //display session message if set
            unset($_SESSION['add']); //remove session message
        }

        if(isset($_SESSION['delete'])) //checking whether the session is set or not
        {
            echo $_SESSION['delete']; //display session message if set
            unset($_SESSION['delete']); //remove session message
        }

        if(isset($_SESSION['upload'])) //checking whether the session is set or not
        {
            echo $_SESSION['upload']; //display session message if set
            unset($_SESSION['upload']); //remove session message
        }

        if(isset($_SESSION['unauthorize'])) //checking whether the session is set or not
        {
            echo $_SESSION['unauthorize']; //display session message if set
            unset($_SESSION['unauthorize']); //remove session message
        }

        if(isset($_SESSION['update'])) //checking whether the session is set or not
        {
            echo $_SESSION['update']; //display session message if set
            unset($_SESSION['update']); //remove session message
        }

        
        ?>
        
        <br><br>
         <!-- Button to add admin -->
         <a href="<?php echo SITEURL;?>admin/add-menutype.php" class="btn-primary">Add Menu-type</a>
        
        <br><br>


                <table class="tbl-full">
                    <tr>
                        <th>S.No</th>
                        <th>Type_name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //sql query to get all the food
                    $sql = "SELECT * FROM menu_type";

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
                            $type_name = $row['type_name'];
                            $price = $row['price'];
                            $imagename = $row['imagename'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                        ?>
                    
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $type_name;?></td>
                                <td><?php echo '$'.$price;?></td>
                                <td>
                                    <?php
                                    //check whether image name is available or not
                                    if($imagename != "")
                                    {
                                        //display the image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/menu_type/<?php echo $imagename;?>" width="100px">
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
                                    <a href="<?php echo SITEURL;?>admin/update-menutype.php?id=<?php echo $id; ?>&imagename=<?php echo $imagename; ?>" class="btn-secondary">Update Menu_Type</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-menutype.php?id=<?php echo $id; ?>&imagename=<?php echo $imagename; ?>" class="btn-danger">Delete Menu_Type</a>
                                </td>
                           </tr>
                        <?php
                }
            }

                    else{
                        //we don't have data in db
                        //we will display the message inside the table
                        //food not added in db
                        echo "<tr> <td colspan = '7' class='error' >Menutype not Added Yet.</td> </tr>";  
                    }
                    ?>

                </table>
    </div>
</div>

<?php  include('partials/footer.php') ?>