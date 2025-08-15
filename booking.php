<?php include_once 'header.php'; ?>
<?php include_once 'nav.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php
if (isset($_GET['car'])) {
    $carid = (int) mysqli_real_escape_string($con, $_GET['car']);
    $userid = (int) $_SESSION['ID'];

    $sql = $con->prepare("SELECT c.carid, c.cartitle, c.carbrand, c.serial, c.carprice, c.carduties, u.name, u.email  
                          FROM `cars` AS c, `users` AS u 
                          WHERE c.carid = ? AND u.id = ?");
    $sql->bind_param("ii", $carid, $userid);

    if ($sql->execute()) {
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }

        $sql->close();
    } else {
        $sql->close();
    }
}
?>

<?php
if (isset($_SESSION['MSG']) && isset($_SESSION['COLOR'])) { ?>
    <div class="row" style="margin-top: 200px;">
        <div class="alert alert-<?php echo htmlspecialchars($_SESSION['COLOR']) ?>">
            <div class="text-center"><?php echo htmlspecialchars($_SESSION['MSG']) ?></div>
        </div>
    </div>
<?php
    unset($_SESSION['MSG']);
    unset($_SESSION['COLOR']);
}
?>

<?php
$check = mysqli_query($con, "SELECT `carid` FROM `bookings` WHERE `carid` = '$carid'");
if ($check && mysqli_num_rows($check) == 0) { ?>

    <form action="php/booking-server.php" enctype="multipart/form-data" method="POST">
        <div class="container-fluid py-4">

            <div class="row mt-5 row-cols-1 row-cols-md-2 g-4">

                <!-- Buyer Details -->
                <div class="col">
                    <div class="card p-3 shadow">
                        <h5 class="card-title">Buyer Details</h5>
                        <div class="card-body">
                            <div class="mb-2">
                                <label class="form-label">Buyer's Name</label>
                                <input type="text" class="form-control" name="name" readonly value="<?php echo htmlspecialchars($row['name']) ?>">
                            </div>
                            <div class="mb-2">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" readonly value="<?php echo htmlspecialchars($row['email']) ?>">
                            </div>
                            <div class="mb-2">
                                <label>Contact</label>
                                <input type="tel" class="form-control" name="contact">
                            </div>
                            <div class="mb-2">
                                <label>Passport Sized Image</label>
                                <input type="file" class="form-control" name="img">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car Details -->
                <div class="col">
                    <div class="card p-3 shadow">
                        <h5 class="card-title">Car Details</h5>
                        <div class="card-body">
                            <div class="mb-2">
                                <label>Car Serial #</label>
                                <input type="text" class="form-control" readonly name="serial" value="<?php echo htmlspecialchars($row['serial']) ?>">
                            </div>
                            <div class="mb-2">
                                <label>Car Name</label>
                                <input type="text" class="form-control" readonly name="title" value="<?php echo htmlspecialchars($row['cartitle']) ?>">
                            </div>
                            <div class="mb-2">
                                <label>Brand</label>
                                <input type="text" class="form-control" readonly name="brand" value="<?php echo htmlspecialchars($row['carbrand']) ?>">
                            </div>
                            <input type="hidden" name="carid" value="<?php echo htmlspecialchars($row['carid']) ?>">
                            <div class="mb-2">
                                <label>Total Price</label>
                                <input type="number" class="form-control" readonly name="price" value="<?php echo htmlspecialchars($row['carprice'] + $row['carduties']) ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delivery Details -->
                <div class="col">
                    <div class="card p-3 shadow">
                        <h5 class="card-title">Delivery Details</h5>
                        <div class="card-body">
                            <div>
                                <p><small style="color: orange; ">Note: The delivery Charges varies according to selected city.</small></p>
                            </div>
                            <div class="mb-2">
                                <label>City of Delivery</label>
                                <select class="form-select" name="city">
                                    <option value="Lahore">Lahore</option>
                                    <option value="Karachi">Karachi</option>
                                    <option value="Islamabad">Islamabad</option>
                                    <option value="Faisalabad">Faisalabad</option>
                                    <option value="Peshawar">Peshawar</option>
                                    <option value="Multan">Multan</option>
                                    <option value="Quetta">Quetta</option>
                                    <option value="Sialkot">Sialkot</option>
                                    <option value="Gujranwala">Gujranwala</option>
                                    <option value="Hyderabad">Hyderabad</option>
                                    <option value="Sukkur">Sukkur</option>
                                    <option value="Bahawalpur">Bahawalpur</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label>Address</label>
                                <textarea class="form-control" rows="2" name="address"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="col">
                    <div class="card p-3 shadow">
                        <h5 class="card-title">Payment Details</h5>
                        <div class="card-body">
                            <div class="mb-2">
                                <label>Payment Plan</label>
                                <select class="form-select" id="paymentPlan" name="plan">
                                    <option value="Full Payment">Full Payment</option>
                                    <option value="Installment">Installment</option>
                                </select>
                            </div>

                            <div class="mb-2" id="installmentsWrapper" style="display: none;">
                                <label>Installments</label>
                                <select class="form-select" id="installments" name="installment">
                                    <option value="4 Installments">4 Installments</option>
                                    <option value="6 Installments">6 Installments</option>
                                    <option value="8 Installments">8 Installments</option>
                                    <option value="1 Year (12 Installments)">1 Year (12 Installments)</option>
                                </select>
                            </div>

                            <label class="form-label">Payment Type</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="paymentType" value="Cash Payment" checked>
                                <label class="form-check-label">Cash Payment</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="paymentType" value="Cash On Delivery">
                                <label class="form-check-label">Cash On Delivery</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="paymentType" value="Check Payment">
                                <label class="form-check-label">Check Payment</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="paymentType" value="Online Payment">
                                <label class="form-check-label">Online Payment</label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="container mt-4 text-center">
                    <button type="submit" class="btn btn-success" style="width: 30%;" name="btn-book">Confirm Booking</button>
                </div>

            </div>
        </div>
    </form>



    <script>
        document.getElementById('paymentPlan').addEventListener('change', function() {
            let wrapper = document.getElementById('installmentsWrapper');
            wrapper.style.display = (this.value === 'Installment') ? 'block' : 'none';
        });
    </script>
<?php } else { ?>
    <div class="container">
        <div class="row" style="border-radius: 5px; padding: 15px; background-color: #D0F0C0;">
            <div class="col-md-12 text-dark text-center">
                <h4 class="text-center text-dark">You Booking Has Been Made</h4>
            </div>
        </div>
    </div>
<?php }
?>




<?php include_once 'footer.php'; ?>