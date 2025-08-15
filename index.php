<?php include_once 'header.php'; ?>
<?php include_once 'nav.php'; ?>
<div class="main-banner" id="top">
    <video autoplay muted loop id="bg-video">
        <source src="assets/images/video.mp4" type="video/mp4" />
    </video>

    <div class="video-overlay header-text">
        <div class="caption">
            <h2>Best <em>car dealer</em> in town!</h2>
        </div>
    </div>
</div>

<section class="section" id="trainers">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Featured <em>Cars</em></h2>
                    <img src="assets/images/line-dec.png" alt="">
                    <p>"Experience Innovation & Power – Discover Our Featured Cars!"</p>
                </div>
            </div>
        </div>

        <!-- Flexbox row for dropdown alignment -->
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter by Brand
                    </button>
                    <ul class="dropdown-menu bg-dark">
                        <li><a class="dropdown-item" href="index.php?filter=Toyota">Toyota</a></li>
                        <li><a class="dropdown-item" href="index.php?filter=Honda">Honda</a></li>
                        <li><a class="dropdown-item" href="index.php?filter=Suzuki">Suzuki</a></li>
                        <li><a class="dropdown-item" href="index.php?filter=Kia">Kia</a></li>
                        <li><a class="dropdown-item" href="index.php?filter=Hyundai">Hyundai</a></li>
                        <li><a class="dropdown-item" href="index.php?filter=Nissan">Nissan</a></li>
                        <li><a class="dropdown-item" href="index.php?filter=Daihatsu">Daihatsu</a></li>
                        <li><a class="dropdown-item" href="index.php?filter=Changan">Changan</a></li>
                        <li><a class="dropdown-item" href="index.php?filter=Proton">Proton</a></li>
                        <li><a class="dropdown-item" href="index.php?filter=Haval">Haval</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            if (isset($_GET['filter'])) {
                $filter = mysqli_real_escape_string($con, $_GET['filter']);
                $sql = mysqli_query($con, "SELECT * FROM `cars` WHERE `status` = '1' AND `carbrand` = '$filter' ORDER BY `carid` DESC");
            } else {
                $sql = mysqli_query($con, "SELECT * FROM `cars` WHERE `status` = '1' ORDER BY `carid` DESC");
            }
            if ($sql && mysqli_num_rows($sql) > 0) {
                while ($row = mysqli_fetch_assoc($sql)) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow-lg border-0 rounded-3">
                            <img src="<?php echo "admin/php/" . htmlspecialchars($row['carimage']) ?>" class="card-img-top img-fluid rounded-top" alt="Car Image">
                            <div class="card-body">
                                <h5 class="card-title text-primary fw-bold"><?php echo htmlspecialchars($row['cartitle']) ?></h5>
                                <p class="card-text text-muted">
                                    <span class="d-flex justify-content-between gap-3">
                                        <span><i class="fa fa-dashboard"></i> <?php echo htmlspecialchars($row['carmileage']) ?> km</span>
                                        <span><i class="fa fa-cube"></i> <?php echo htmlspecialchars($row['carpower']) ?> HP</span>
                                    </span>
                                    <span class="d-flex justify-content-between gap-3">
                                        <span><i class="fa fa-cog"></i> <?php echo htmlspecialchars($row['cargears']) ?></span>
                                        <span><i class="fa fa-car"></i> <?php echo htmlspecialchars($row['cardoors']) ?> Doors</span> <!-- Example extra detail -->
                                    </span>
                                </p>

                                <a href="details.php?ref=<?php echo htmlspecialchars($row['carid'])?>" class="btn btn-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>
            <?php }
            } else {
                echo "<p class='text-center' style='color:#F9735B;'>No cars available.</p>";
            }
            ?>
        </div>


        <br>

    </div>
</section>
<!-- ***** Cars Ends ***** -->

<section class="section section-bg" id="schedule" style="background-image: url(assets/images/about-fullscreen-1-1920x700.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading dark-bg">
                    <h2>Read <em>About Us</em></h2>
                    <img src="assets/images/line-dec.png" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="cta-content text-center">
                    <p>At Giga Wheels, we are passionate about delivering excellence in every aspect of our work. With a commitment to innovation and quality, we strive to provide exceptional products and services that exceed expectations. Our team is driven by a shared vision to create value, build lasting relationships, and make a difference in the industry.</p>

                    <p>With years of experience and a customer-centric approach, we continue to evolve, embracing new challenges and opportunities. Whether it's cutting-edge solutions or unparalleled customer service, we take pride in our dedication to excellence. Join us on our journey as we shape the future together.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once 'footer.php'; ?>