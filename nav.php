<header class="header-area header-sticky bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">

                    <a href="index.php" class="logo">Giga<em> Wheels</em></a>
                    <ul class="nav">
                        <li><a href="index.php" class="active">Home</a></li>
                        <?php
                        if (isset($_SESSION['ID'])) {
                            $id = $_SESSION['ID'];
                            $check = mysqli_query($con, "SELECT `userid` FROM `bookings` WHERE `userid` = '$id'");
                            if ($check && mysqli_num_rows($check) > 0) { ?>
                                <li><a href="bookcart.php">Your Bookings</a></li>
                                <li><a href="delivery.php">Delivery Status</a></li>
                        <?php }
                        } ?>


                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php if (isset($_SESSION['ID']) && isset($_SESSION['NAME'])) {
                                                                                                                                                    echo htmlspecialchars($_SESSION['NAME']);
                                                                                                                                                } else {
                                                                                                                                                    echo "Account";
                                                                                                                                                } ?></a>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php if (isset($_SESSION['ID']) && isset($_SESSION['NAME'])) {
                                                                    echo htmlspecialchars("php/logout-server.php");
                                                                } else {
                                                                    echo "account.php";
                                                                } ?>"><?php if (isset($_SESSION['ID']) && isset($_SESSION['NAME'])) {
                                                                            echo "Logout";
                                                                        } else {
                                                                            echo "Login/Register";
                                                                        } ?></a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>