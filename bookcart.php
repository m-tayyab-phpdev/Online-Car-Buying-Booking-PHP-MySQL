<?php include_once 'header.php'; ?>
<?php include_once 'nav.php'; ?>
<?php
if(isset($_GET['car'])){
$carid = mysqli_real_escape_string($con, $_GET['car']);
$del = mysqli_query($con, "DELETE FROM `bookings` WHERE `carid` = '$carid'");
if($del){
    echo "<script>window.location.replace('bookcart.php);</script>";
}
}
?>
<div class="container">
<div class="row" style="margin-top: 100px;">
<table class="table table-bordered">
    <thead>
        <tr>
        <th>SR #</th>
        <th>Car Name</th>
        <th>Amount</th>
        <th style="width: 30%;">Picture</th>
        <th>Cancel Booking</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $id = $_SESSION['ID'];
    $sql = mysqli_query($con, "SELECT * FROM bookings AS b, cars as c WHERE b.userid = '$id' AND b.carid = c.carid");
    if($sql && mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){ ?>
        <tr>
            <td><?php echo htmlspecialchars($row['serial'])?></td>
            <td><?php echo htmlspecialchars($row['cartitle'])?></td>
            <td><?php echo htmlspecialchars($row['amount'])?></td>
            <td style="width: 30%;"><img src="admin/php/<?php echo htmlspecialchars($row['carimage'])?>" style="width: 30%"></td>
            <td><a href="bookcart.php?car=<?php echo htmlspecialchars($row['carid'])?>" class="btn btn-danger">Cancel Booking</a></td>
        </tr>
        <?php }
    }
    ?>
    </tbody>
</table>
</div>
</div>
<?php include_once 'footer.php'; ?>
