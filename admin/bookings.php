<?php include_once 'header.php' ?>
<div class="container-fluid">

    <div class="row">
        <table class="table table-bordered">
    <thead>
        <tr>
            <th>Customer</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Picture</th>
            <th>Car</th>
            <th>Picture</th>
            <th>Amount</th>
            <th>City</th>
            <th>Address</th>
            <th>Payment Plan</th>
            <th>Installment</th>
        </tr>
    </thead>

    <?php
    $sql = mysqli_query($con, "SELECT * FROM bookings AS b, cars AS c, users AS u WHERE b.userid = u.id AND b.carid = c.carid ORDER BY b.bookid DESC");
    if($sql && mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){ ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name'])?></td>
                <td><?php echo htmlspecialchars($row['email'])?></td>
                <td><?php echo htmlspecialchars($row['usercontact'])?></td>
                <td style="width: 10%;"><img src="php/uploads/<?php echo htmlspecialchars($row['userimage'])?>" style="width:60%"></td>
                <td><?php echo htmlspecialchars($row['cartitle'])?></td>
                <td style="width: 10%;"><img src="php/<?php echo htmlspecialchars($row['carimage'])?>" style="width:60%"></td>
                <td><?php echo htmlspecialchars($row['amount'])?></td>
                <td><?php echo htmlspecialchars($row['city'])?></td>
                <td><?php echo htmlspecialchars($row['address'])?></td>
                <td><?php echo htmlspecialchars($row['plan'])?></td>
                <td><?php echo htmlspecialchars($row['installment'])?></td>
            </tr>
       <?php }
    }else{ ?>
        <tbody>
            <tr>
                <td colspan="11" class="text-center text-danger">No Booking Found</td>
            </tr>
        </tbody>
   <?php }
    ?>
        </table>
    </div>
</div>
<?php include_once 'footer.php' ?>