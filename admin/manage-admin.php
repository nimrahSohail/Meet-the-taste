<?php include('partials/menu.php') ?>
        
        <!-- MAIN SECTION END -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br>

                <?php 
                   if(isset($_SESSION['add']))
                   {
                    echo $_SESSION['add'];  //display session message
                    unset($_SESSION['add']); //removing sessioin mesage
                   }

                   if(isset($_SESSION['delete']))
                   {
                    echo $_SESSION['delete'];  //display session message
                    unset($_SESSION['delete']); //removing sessioin mesage
                   }

                   if(isset($_SESSION['update']))
                   {
                    echo $_SESSION['update'];  //display session message
                    unset($_SESSION['update']); //removing sessioin mesage
                   }
                ?>
<br><br><br>
                <!-- Button to add admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email_address</th>
                        <th>Contact_no</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //query to get all admin
                    $sql = 'SELECT * FROM admin';
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
                                $name = $rows['name'];
                                $username = $rows['username'];
                                $email_address = $rows['email_address'];
                                $contact_no = $rows['contact_no'];

                                //display the values in our table
                                ?>
                                
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $username; ?></td>
                                    <td><?php echo $email_address; ?></td>
                                    <td><?php echo $contact_no;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
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