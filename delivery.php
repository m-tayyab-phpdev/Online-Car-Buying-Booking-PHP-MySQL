<?php include_once 'header.php'; ?>
<?php include_once 'nav.php'; ?>
<div class="container">
    <div class="row" style="margin-top: 100px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Car</th>
                    <th>Picture</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Delivery Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $myid = $_SESSION['ID'];
                $sql = mysqli_query($con, "SELECT * FROM bookings AS b, cars AS c, deliveries AS d WHERE b.userid = $myid AND b.carid = c.carid AND b.bookid = d.bookid ORDER BY b.bookid DESC");
                if ($sql && mysqli_num_rows($sql) > 0) {
                    while ($row = mysqli_fetch_assoc($sql)) {
                    
                        $statusText = '';
                        switch ($row['status']) {
                            case 1:
                                $statusText = 'On Way';
                                break;
                            case 2:
                                $statusText = 'Delivered';
                                break;
                            case 3:
                                $statusText = 'Canceled';
                                break;
                            default:
                                $statusText = 'Pending';
                        }
                ?>
                        <tr>
                            <td><?= htmlspecialchars($row['cartitle']) ?></td>
                            <td style="width: 10%;"><img src="admin/php/<?= htmlspecialchars($row['carimage']) ?>" style="width:60%"></td>
                            <td><?= htmlspecialchars($row['city']) ?></td>
                            <td><?= htmlspecialchars($row['address']) ?></td>
                            <td><?= $statusText ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="10" class="text-center text-danger">No Booking Found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once 'footer.php'; ?>
