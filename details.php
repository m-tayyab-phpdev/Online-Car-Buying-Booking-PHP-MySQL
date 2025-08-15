<?php include_once 'header.php'; ?>
<?php include_once 'nav.php'; ?>
<?php
if (isset($_GET['ref'])) {
  $carid = (int) mysqli_real_escape_string($con, $_GET['ref']);
  $stmt = $con->prepare("SELECT * FROM `cars` WHERE `carid` = ?");
  $stmt->bind_param("i", $carid);
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    }
  } else {
    $stmt->close();
  }
}
?>
<!-- ***** Call to Action Start ***** -->
<section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <div class="cta-content">
          <br>
          <br>
          <h2><em><?php echo htmlspecialchars($row['cartitle']) ?></em></h2>
          <p><?php echo htmlspecialchars($row['carbrand']) ?></p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ***** Call to Action End ***** -->

<!-- ***** Fleet Starts ***** -->
<section class="section" id="trainers">
  <div class="container">
    <br>
    <br>

    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <img src="admin/php/<?php echo htmlspecialchars($row['carimage']) ?>"
          style="width: 60%; border-radius: 5px;">
      </div>
    </div>

    <br>
    <br>

    <div class="row" id="tabs">
      <div class="col-lg-4">
        <ul>
          <li><a href='#tabs-1'><i class="fa fa-cog"></i> Vehicle Specs</a></li>
          <li><a href='#tabs-2'><i class="fa fa-info-circle"></i> Vehicle Description</a></li>
          <li><a href='#tabs-4'><i class="fa fa-phone"></i> Book Now</a></li>
        </ul>
      </div>
      <div class="col-lg-8">
        <section class='tabs-content' style="width: 100%;">
          <article id='tabs-1'>

            <div class="row">
              <div class="col-sm-6">
                <label>Car Serial No</label>

                <p><?php echo htmlspecialchars($row['serial']) ?></p>
              </div>

              <div class="col-sm-6">
                <label>Car Name</label>

                <p><?php echo htmlspecialchars($row['cartitle']) ?></p>
              </div>

              <div class="col-sm-6">
                <label>Manufacturar Brand</label>

                <p><?php echo htmlspecialchars($row['carbrand']) ?></p>
              </div>

              <div class="col-sm-6">
                <label>Car Modal - Year</label>

                <p><?php echo htmlspecialchars($row['carmodal']) ?> - <?php echo htmlspecialchars($row['carmodalyear']) ?></p>
              </div>

              <div class="col-sm-6">
                <label>Mileage</label>

                <p><?php echo htmlspecialchars($row['carmileage']) ?></p>
              </div>

              <div class="col-sm-6">
                <label>Fuel</label>

                <p><?php echo htmlspecialchars($row['carfuel']) ?></p>
              </div>

              <div class="col-sm-6">
                <label>Engine size</label>

                <p><?php echo htmlspecialchars($row['carpower']) ?></p>
              </div>

              <div class="col-sm-6">
                <label>Color</label>

                <p><?php echo htmlspecialchars($row['carcolor']) ?></p>
              </div>


              <div class="col-sm-6">
                <label>Gearbox</label>

                <p><?php echo htmlspecialchars($row['cargears']) ?></p>
              </div>

              <div class="col-sm-6">
                <label>Number of seats</label>

                <p><?php echo htmlspecialchars($row['carseats']) ?> <strong>seats</strong></p>
              </div>

              <div class="col-sm-6">
                <label>Doors</label>

                <p><?php echo htmlspecialchars($row['cardoors']) ?></p>
              </div>

            </div>
          </article>
          <article id='tabs-2'>
            <?php echo ($row['cardetails']) ?>
          </article>
          <article id='tabs-4'>
            <div class="container py-5">
              <div class="row justify-content-center">
                <!-- Cart Item -->
                <div class="col-lg-6 mb-4">
                  <div class="card h-100">
                    <div class="row g-0 align-items-center">
                      <div class="col-md-12">
                        <img src="admin/php/<?php echo htmlspecialchars($row['carimage']) ?>" class="img-fluid rounded-start" alt="Product">
                      </div>
                      <div class="col-md-12">
                        <div class="card-body">
                          <h5 class="card-title mb-1"><?php echo htmlspecialchars($row['cartitle']) ?></h5>
                          <span class="card-text"><strong>Rs</strong>.<?php echo htmlspecialchars($row['carprice']) ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Summary Card -->
                <div class="col-lg-6 mb-4">
                  <div class="card h-100 p-3 shadow-sm">
                    <h5 class="card-title">Summary</h5>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                      <span>Serial No</span>
                      <span><?php echo htmlspecialchars($row['serial']) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                      <span>Price</span>
                      <span><strong>Rs</strong>.<?php echo htmlspecialchars($row['carprice']) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                      <span>Duties</span>
                      <span><strong>Rs</strong>.<?php echo htmlspecialchars($row['carduties']) ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold mb-3">
                      <span>Total</span>
                      <span>Rs.<?php echo htmlspecialchars($row['carprice'] + $row['carduties']) ?></span>
                    </div>
                    <?php
                    if (isset($_SESSION['ID'])) { ?>
                      <?php
                      $check = mysqli_query($con, "SELECT `carid` FROM `bookings` WHERE `carid` = '$carid'");
                      if ($check && mysqli_num_rows($check) == 0) { ?>
                        <a class="btn btn-primary w-100" href="booking.php?car=<?php echo htmlspecialchars($row['carid']) ?>">Proceed Booking</a>
                      <?php }else{ ?>
                        <div class="row pt-5">
                        <h6 class="text-center text-success">Already Booked</h6>
                      </div>
                      <?php }
                      ?>

                    <?php } else { ?>
                      <div class="row pt-5">
                        <h6 class="text-center text-danger">Login to Proceed</h6>
                      </div>
                    <?php }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </article>

        </section>
      </div>
    </div>
  </div>
</section>
<!-- ***** Fleet Ends ***** -->

<?php include_once 'footer.php'; ?>