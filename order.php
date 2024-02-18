<?php include('partials-front/menu.php')?>

<?php

//check whether menutype id is set or  not
if(isset($_GET['menutype_id']))
{
    //get the menutype_id details of the selected menutype
    $menutype_id = $_GET['menutype_id'];

    //get the details of the slected menutype
    $sql = "SELECT * FROM menu_type WHERE id=$menutype_id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //count the rows
    $count = mysqli_num_rows($res);

    //check whether the data is available or not
    if($count==1)
    {
        //we have data
        //get the data from database
        $row = mysqli_fetch_assoc($res);

        $type_name = $row['type_name'];
        $price = $row['price'];
        $imagename = $row['imagename'];
    }
    else{
        //food not available
        //redirect to homepage
        header('location:'.SITEURL);
    }
}
else
{
    //redirect to homepage
    header('location:'.SITEURL);
}
?>


        <!-- fOOD sEARCH Section Starts Here -->
        <section class="food-search">
            <div class="container">
                
                <h1 class="text-center text-brown">Fill this form to confirm your order.</h1>
    
                <form action="" method="POST" class="order">
                    <fieldset>
                        <legend>Selected Food</legend>
    
                        <div class="food-menu-img">

                            <?php
                            //check whether the image i available or not
                            if($imagename=="")
                            {
                                //image not available
                                echo "<div class='error'>Image not added.</div>";
                            }
                            else
                            {
                                //image is available
                                ?>
                                <img src="<?php echo SITEURL;?>images/menu_type/<?php echo $imagename; ?>" class="img-responsive img-curve">
                                <?php
                            }
                            ?>

                        </div>
        
                        <div class="food-menu-desc">
                            <h3 class="text-brown"><?php echo $type_name; ?></h3>
                            <input type="hidden" name="type_name" value= "<?php echo $type_name; ?>">

                            <p class="food-price"><?php echo '$'.$price; ?></p>
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
    
                            <div class="order-label">Quantity</div>
                            <input type="number" name="qty" class="input-responsive" value="1" required>
                            
                        </div>
    
                    </fieldset>
                    <br> 
                    <fieldset>
                        <legend>Delivery Details</legend>
                        <div class="order-label">Full Name</div>
                        <input type="text" name="full-name" placeholder="E.g. Safa Rizwan" class="input-responsive" required>
    
                        <div class="order-label">Phone Number</div>
                        <input type="tel" name="contact" placeholder="Eg. 03xxxxxxxx" class="input-responsive" required>
    
                        <div class="order-label">Email</div>
                        <input type="email" name="email" placeholder="Eg. abc@gmail.com" class="input-responsive" required>
    
                        <div class="order-label">Address</div>
                        <textarea name="address" rows="10" placeholder="Eg. Street, City, Country" class="input-responsive" required></textarea>
    
                        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary text-brown btn-bg" >
                    </fieldset>
    
                </form>

                <?php
                
                //check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all the details from the form
                    $type_name = $_POST['type_name'];
                    $price = $_POST['price'];
                    $no_of_serving = $_POST['qty'];

                    $total = $price * $no_of_serving; //toal = price * quantity

                    $order_date = date("Y-m-d h:i:sa"); //order date

                    $status = "ordered"; //ordered, on delivery, delivered, canceled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    $sql2 ="INSERT INTO customer(customer_name, customer_contact, customer_email,customer_address) VALUES('$customer_name','$customer_contact','$customer_email','$customer_address')";
                    $res2 = mysqli_query($conn, $sql2);
                    
                    if($res2)
                    {
                        $c_id = mysqli_insert_id($conn);
                        $sql3 = "INSERT INTO order_order(menutype,price,order_date,status,no_of_serving,total,c_id) VALUES ('$type_name','$price','$order_date','$status','$no_of_serving','$total','$c_id')";
                        $res3= mysqli_query($conn, $sql3);
                    }
                    

                    //check whether query executed or not
                    if($res2 ==true)
                    {
                        //query excuted and order saved
                        $_SESSION['order'] = "<div class='success text-center'>Ordered Successfully.</div>";
                        // header('location:'.SITEURL.'categories.php');
                    }

                    else{
                        //failed to save order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order food.</div> ";
                        header('location:'.SITEURL);
                    }
                }
                ?>

    
            </div>
        </section>
        <!-- fOOD sEARCH Section Ends Here -->



<?php include('partials-front/footer.php'); ?>