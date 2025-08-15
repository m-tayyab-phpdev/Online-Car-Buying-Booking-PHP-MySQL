<?php
include_once 'header.php';

if (isset($_GET['status']) && isset($_GET['bookid'])) {
    $status = intval($_GET['status']);
    $bookid = intval($_GET['bookid']);

    mysqli_query($con, "UPDATE deliveries SET status = '$status' WHERE bookid = '$bookid'");
}
?>

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
                    <th>City</th>
                    <th>Address</th>
                    <th>Delivery Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = mysqli_query($con, "SELECT * FROM bookings AS b, cars AS c, users AS u, deliveries AS d WHERE b.userid = u.id AND b.carid = c.carid AND b.bookid = d.bookid ORDER BY b.bookid DESC");
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
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['usercontact']) ?></td>
                            <td style="width: 10%;"><img src="php/uploads/<?= htmlspecialchars($row['userimage']) ?>" style="width:60%"></td>
                            <td><?= htmlspecialchars($row['cartitle']) ?></td>
                            <td style="width: 10%;"><img src="php/<?= htmlspecialchars($row['carimage']) ?>" style="width:60%"></td>
                            <td><?= htmlspecialchars($row['city']) ?></td>
                            <td><?= htmlspecialchars($row['address']) ?></td>
                            <td><?= $statusText ?></td>
                            <td>
                                <a href="?status=1&bookid=<?= $row['bookid'] ?>" class="btn btn-primary btn-sm">On Way</a>
                                <a href="?status=2&bookid=<?= $row['bookid'] ?>" class="btn btn-success btn-sm">Delivered</a>
                                <a href="?status=3&bookid=<?= $row['bookid'] ?>" class="btn btn-danger btn-sm">Canceled</a>
                            </td>
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
