<?php  include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Rating</h1>
        <br> 

        <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Score out of 10</th>
                        <th>Remarks</th>
                    </tr>

                    <?php
                    $sql = "SELECT * FROM rating";
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
                            $customer_name = $row['customer_name'];
                            $score = $row['score'];
                            $remarks = $row['remarks'];
                            ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $score; ?></td>
                                    <td><?php echo $remarks; ?></td>
                                </tr>
                            <?php
                        }
                    }
                    else
                    {
                        //order not available
                        echo "<tr><td colspan='12' class='error'>Reviews not available.</td></tr>";
                    }
                    ?>

                    
                </table>
    </div>
</div>

<?php  include('partials/footer.php') ?>