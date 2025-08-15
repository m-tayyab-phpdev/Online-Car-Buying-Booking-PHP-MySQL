<?php include_once 'header.php'; ?>
<div class="container-fluid">


   
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label>Car Brand</label>
            <select name="brand" class="form-control">
                <option value="">All Brands</option>
                <?php
                $brands = ['Toyota', 'Honda', 'Suzuki', 'Kia', 'Hyundai', 'Nissan', 'Daihatsu', 'Changan', 'Proton', 'Haval'];
                foreach ($brands as $brand) {
                    $selected = (isset($_GET['brand']) && $_GET['brand'] == $brand) ? 'selected' : '';
                    echo "<option value='$brand' $selected>$brand</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <label>Payment Method</label>
            <select name="plan" class="form-control">
                <option value="">All Methods</option>
                <option value="Full Payment" <?= (isset($_GET['plan']) && $_GET['plan'] == 'Full Payment') ? 'selected' : '' ?>>Full Payment</option>
                <option value="Installments" <?= (isset($_GET['plan']) && $_GET['plan'] == 'Installments') ? 'selected' : '' ?>>Installments</option>
            </select>
        </div>
        <div class="col-md-3">
            <label>Payment Type</label>
            <select name="type" class="form-control">
                <option value="">All Types</option>
                <option value="Cash Payment" <?= (isset($_GET['type']) && $_GET['type'] == 'Cash Payment') ? 'selected' : '' ?>>Cash Payment</option>
                <option value="Cash On Delivery" <?= (isset($_GET['type']) && $_GET['type'] == 'Cash On Delivery') ? 'selected' : '' ?>>Cash On Delivery</option>
                <option value="Check Payment" <?= (isset($_GET['type']) && $_GET['type'] == 'Check Payment') ? 'selected' : '' ?>>Check Payment</option>
                <option value="Online Payment" <?= (isset($_GET['type']) && $_GET['type'] == 'Online Payment') ? 'selected' : '' ?>>Online Payment</option>
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <!-- Data Table -->
    <div class="row">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Picture</th>
                    <th>Car</th>
                    <th>Car Image</th>
                    <th>Amount</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Payment Plan</th>
                </tr>
            </thead>
            <tbody>
                <?php
               
                $filter_brand = isset($_GET['brand']) ? $_GET['brand'] : '';
                $filter_plan  = isset($_GET['plan']) ? $_GET['plan'] : '';
                $filter_type  = isset($_GET['type']) ? $_GET['type'] : '';

                $conditions = [];
                if (!empty($filter_brand)) $conditions[] = "c.carbrand = '" . mysqli_real_escape_string($con, $filter_brand) . "'";
                if (!empty($filter_plan))  $conditions[] = "b.plan = '" . mysqli_real_escape_string($con, $filter_plan) . "'";
                if (!empty($filter_type))  $conditions[] = "b.type = '" . mysqli_real_escape_string($con, $filter_type) . "'";

                $whereClause = count($conditions) > 0 ? " AND " . implode(" AND ", $conditions) : "";

                $sql = mysqli_query($con, "SELECT * FROM bookings AS b 
                                            JOIN cars AS c ON b.carid = c.carid 
                                            JOIN users AS u ON b.userid = u.id 
                                            WHERE 1=1 $whereClause 
                                            ORDER BY b.bookid DESC");

                if ($sql && mysqli_num_rows($sql) > 0) {
                    while ($row = mysqli_fetch_assoc($sql)) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['usercontact']) ?></td>
                            <td style="width: 10%;"><img src="php/uploads/<?= htmlspecialchars($row['userimage']) ?>" style="width: 60%;"></td>
                            <td><?= htmlspecialchars($row['cartitle']) ?></td>
                            <td style="width: 10%;"><img src="php/<?= htmlspecialchars($row['carimage']) ?>" style="width: 60%;"></td>
                            <td><?= htmlspecialchars($row['amount']) ?></td>
                            <td><?= htmlspecialchars($row['city']) ?></td>
                            <td><?= htmlspecialchars($row['address']) ?></td>
                            <td><?= htmlspecialchars($row['plan']) ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="11" class="text-center text-danger">No Booking Found</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once 'footer.php'; ?>
