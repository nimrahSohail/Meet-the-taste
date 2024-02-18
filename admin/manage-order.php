<?php  include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br> 

        <?php
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>
        <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.No</th>
                        <th>Menutype</th>
                        <th>Price</th>
                        <th>No_of_serving</th>
                        <th>Total</th>
                        <th>Order_Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    $sql = "SELECT * FROM customer INNER JOIN order_order ON customer.c_id = order_order.c_id ORDER BY id DESC";
                    //execute the query
                    $res = mysqli_query($conn, $sql);
                    //count the rows
                    $count = mysqli_num_rows($res);

                    $sn = 1; //create a serial number and set initial value a one

                    if($count>0)
                    {
                        //order available
                        while($row= mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $menutype = $row['menutype'];
                            $price = $row['price'];
                            $no_of_serving = $row['no_of_serving'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];

                            ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $menutype; ?></td>
                                    <td><?php echo '$'.$price; ?></td>
                                    <td><?php echo $no_of_serving; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>

                                    <td>
                                        <?php 
                                        //ordered,on delivery, delivered, cancelled
                                        if($status=="Ordered")
                                        {
                                            echo "<label>$status</label>";
                                        }
                                        elseif($status=="On Delivery")
                                        {
                                            echo "<label style='color: orange;'>$status</label>";
                                        }
                                        elseif($status=="Delivered")
                                        {
                                            echo "<label style='color: green;'>$status</label>";
                                        }
                                        elseif($status=="Cancelled")
                                        {
                                            echo "<label style='color: red;'>$status</label>";
                                        }
                                        ?>
                                    </td>

                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">UpdateOrder</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else
                    {
                        //order not available
                        echo "<tr><td colspan='12' class='error'>Orders not available.</td></tr>";
                    }
                    ?>

                    
                </table>
    </div>
</div>

<?php  include('partials/footer.php') ?>