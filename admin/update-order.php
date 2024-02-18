<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br><br>

        <?php
        //check whether id is set or not
        if(isset($_GET['id']))
        {
            //get the order details
            $id = $_GET['id'];

            //get all other details based on this id
            $sql = "SELECT * FROM order_order WHERE id=$id";
            // $sql = "SELECT * FROM customer INNER JOIN order_order ON customer.c_id = order_order.c_id";
            //execute the query
            $res = mysqli_query($conn,$sql);
            //count rows
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //detail available
                $row = mysqli_fetch_assoc($res);

                $menutype = $row['menutype'];
                // $price = $row['price'];
                // $no_of_serving = $row['no_of_serving'];
                $status = $row['status'];
                // $customer_name = $row['customer_name'];
                // $customer_contact = $row['customer_contact'];
                // $customer_email = $row['customer_email'];
                // $customer_address = $row['customer_address'];
            }
            else
            {
                //detail not available
                //redirect to manage order
                // header('location:'.SITEURL.'admin/manage-order.php');
            }
        }
        else
        {
            //redirect to manage order page
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        ?>


        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Menutype Name:</td>
                <td><b><?php echo $menutype; ?></b></td>
            </tr>

            <!--<tr>
                <td>Price:</td>
                <td><?php echo $price; ?></td>
            </tr> -->

            <!-- <tr>
                <td>No_of_serving:</td>
                <td><input type="number" name="no_of_serving" value=""></td>
            </tr> -->

            <tr>
                <td>Status</td>
                <td>
                    <select name="status">
                        <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                        <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>
<!-- 
            <tr>
                <td>Customer Name:</td>
                <td><input type="text" name="customer_name" value=""></td>
            </tr>

            <tr>
                <td>Customer Contact:</td>
                <td><input type="text" name="customer_contact" value=""></td>
            </tr>

            <tr>
                <td>Customer Email:</td>
                <td><input type="text" name="customer_email" value=""></td>
            </tr>

            <tr>
                <td>Customer Address:</td>
                <td><textarea name="customer_address" cols="30" rows="05"></textarea></td>
            </tr> -->

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" class="btn-secondary" name="submit" value="Update Order">
                </td>
            </tr>
        </table>

        </form>

        <?php
        //check whether update status is cliicked or not
        if(isset($_POST['submit']))
        {
            $id = $_POST['id'];
            $status = $_POST['status'];

            $sql2= "UPDATE order_order SET
            status = '$status'
            WHERE id=$id
            ";

            //execute
            $res2 = mysqli_query($conn, $sql2);

            //check whether update or not
            if($res2 ==true)
            {
                //updated
                $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
            else
            {
                //failed
                $_SESSION['update'] = "<div class='error'>Failed to update order.</div>";
                header('locatioin:'.SITEURL.'admin/manage-order.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>