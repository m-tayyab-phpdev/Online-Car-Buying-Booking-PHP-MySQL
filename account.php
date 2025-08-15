<?php include_once 'header.php'; ?>
<?php include_once 'nav.php'; ?>
<div class="container-fluid d-flex justify-content-center align-items-center vh-100">
    <div class="row w-75">
        <?php
        if (isset($_SESSION['MSG']) && isset($_SESSION['COLOR'])) { ?>
            <div class="alert alert-<?php echo htmlspecialchars($_SESSION['COLOR']) ?>">
                <div class="text-center"><?php echo htmlspecialchars($_SESSION['MSG']) ?></div>
            </div>
        <?php
            unset($_SESSION['MSG']);
            unset($_SESSION['COLOR']);
        }
        ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-dark text-white">
                    <h3>Register</h3>
                </div>
                <div class="card-body">
                    <form action="php/account-server.php" method="POST">
                        <div class="mb-3">
                            <label for="regName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="regName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="regEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="regEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="regPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="regPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="regPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="regPassword" name="cpassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="btn-register">Register</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Login Form -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-dark text-white">
                    <h3>Login</h3>
                </div>
                <div style="padding: 5px 5px 5px 5px;">
                </div>
                <div class="card-body">
                    <form action="php/account-server.php" method="POST">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="loginEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="btn-login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>