<?php include('partials/menu.php') ?>
        
        <!-- MAIN SECTION END -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Site-information</h1>
                <br>

                <?php 
                   if(isset($_SESSION['add']))
                   {
                    echo $_SESSION['add'];  //display session message
                    unset($_SESSION['add']); //removing sessioin mesage
                   }

                   if(isset($_SESSION['update']))
                   {
                    echo $_SESSION['update'];  //display session message
                    unset($_SESSION['update']); //removing sessioin mesage
                   }

                   if(isset($_SESSION['delete']))
                   {
                    echo $_SESSION['delete'];  //display session message
                    unset($_SESSION['delete']); //removing sessioin mesage
                   }
                ?>
<br><br><br>
                <!-- Button to add admin -->
                <a href="add-siteinfo.php" class="btn-primary">Add Site-info</a>
                <br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.No</th>
                        <th>Contact_info</th>
                        <th>Location</th>
                        <th>About</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //query to get all admin
                    $sql = 'SELECT * FROM site_information';
                    //execute the query
                    $res = mysqli_query($conn,$sql);

                    //check whether the query is executed or not
                    if($res == TRUE)
                    {
                        //count rows to check whether we have data in database or not
                        $count = mysqli_num_rows($res); //function to get all the rows in db

                        $sn = 1;  //create a variable and assign a value

                        //check the num of rows
                        if($count>0)
                        {
                            //we have data in db
                            while($rows = mysqli_fetch_assoc($res))
                            {
                                //using whilw loop to get all the data from database
                                //and while loop will run as long as we have data in database

                                //get individual data
                                $id = $rows['id'];
                                $contact_info = $rows['contact_info'];
                                $location = $rows['location'];
                                $description = $rows['description'];

                                //display the values in our table
                                ?>
                                
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $contact_info;?></td>
                                    <td><?php echo $location; ?></td>
                                    <td><?php echo $description; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-siteinfo.php?id=<?php echo $id; ?>" class="btn-secondary">Update SiteInfo</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-siteinfo.php?id=<?php echo $id; ?>" class="btn-danger">Delete SiteInfo</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else{
                            //we donot have data in db
                        }
                    }

                    ?>

                </table>
            </div>
        </div>
        <!-- MAIN SECTION END -->

<?php include('partials/footer.php') ?>