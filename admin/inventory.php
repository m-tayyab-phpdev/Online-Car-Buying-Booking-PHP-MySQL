<?php include_once 'header.php' ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Inventory</h6>
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
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Serial #</th>
                            <th>Car Title</th>
                            <th style="width: 60px;" colspan="2">Status</th>
                            <th style="width: 350px;">Photo</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = mysqli_query($con, "SELECT * FROM `cars` ORDER BY `carid` DESC");
                        if ($sql && mysqli_num_rows($sql) > 0) {
                            while ($row = mysqli_fetch_assoc($sql)) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['serial']) ?></td>
                                    <td><?php echo htmlspecialchars($row['cartitle']) ?></td>
                                    <td><?php
                                        if ($row['status'] == "1") { ?>
                                            Available
                                        <?php } else { ?>
                                            Not Available
                                        <?php }
                                        ?></td>
                                        <td>
                                        <?php
                                        if ($row['status'] == "1") { ?>
                                            <a href="php/cars-server.php?status=n/a&car=<?php echo htmlspecialchars($row['carid'])?>" class="btn btn-dark">Change to Not-Available</a>
                                        <?php } else { ?>
                                            <a href="php/cars-server.php?status=a&car=<?php echo htmlspecialchars($row['carid'])?>" class="btn btn-primary">Change to Available</a>
                                        <?php }
                                        ?> 
                                        </td>
                                    <td><img src="<?php echo "php/" . htmlspecialchars($row['carimage']) ?>" alt="Unable to load" style="width: 30%;"></td>
                                    <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#carid=<?php echo htmlspecialchars($row['carid']) ?>">
                                            Update
                                        </button></td>
                                    <td><a href="php/cars-server.php?id=<?php echo htmlspecialchars($row['carid'])?>" class="btn btn-danger">Delete</a></td>
                                </tr>


                                <div class="modal fade" id="carid=<?php echo htmlspecialchars($row['carid']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo htmlspecialchars($row['serial'])?> - <?php echo htmlspecialchars($row['cartitle'])?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="php/cars-server.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="card shadow-sm p-4">
                                                        <h4 class="text-center mb-4">Vehicle Specs</h4>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label"><i class="fa-solid fa-car"></i> Title</label>
                                                                <input type="text" class="form-control" placeholder="Enter Vehicle Title" required="" name="title" value="<?php echo htmlspecialchars($row['cartitle']) ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"><i class="fa-solid fa-industry"></i> Brand</label>
                                                                <select class="form-control" required="" name="brand">
                                                                    <option value="" selected disabled>Select Brand</option>
                                                                    <option value="Toyota" <?php if ($row['carbrand'] == "Toyota") {
                                                                                                echo "selected";
                                                                                            } ?>>Toyota</option>
                                                                    <option value="Honda" <?php if ($row['carbrand'] == "Honda") {
                                                                                                echo "selected";
                                                                                            } ?>>Honda</option>
                                                                    <option value="Suzuki" <?php if ($row['carbrand'] == "Suzuki") {
                                                                                                echo "selected";
                                                                                            } ?>>Suzuki</option>
                                                                    <option value="Kia" <?php if ($row['carbrand'] == "Kia") {
                                                                                            echo "selected";
                                                                                        } ?>>Kia</option>
                                                                    <option value="Hyundai" <?php if ($row['carbrand'] == "Hyundai") {
                                                                                                echo "selected";
                                                                                            } ?>>Hyundai</option>
                                                                    <option value="Nissan" <?php if ($row['carbrand'] == "Nissan") {
                                                                                                echo "selected";
                                                                                            } ?>>Nissan</option>
                                                                    <option value="Daihatsu" <?php if ($row['carbrand'] == "Daihatsu") {
                                                                                                    echo "selected";
                                                                                                } ?>>Daihatsu</option>
                                                                    <option value="Changan" <?php if ($row['carbrand'] == "Changan") {
                                                                                                echo "selected";
                                                                                            } ?>>Changan</option>
                                                                    <option value="Proton" <?php if ($row['carbrand'] == "Proton") {
                                                                                                echo "selected";
                                                                                            } ?>>Proton</option>
                                                                    <option value="Haval" <?php if ($row['carbrand'] == "Haval") {
                                                                                                echo "selected";
                                                                                            } ?>>Haval</option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label"><i class="fa-solid fa-car-side"></i> Model</label>
                                                                <input type="text" class="form-control" placeholder="Enter Model" required="" name="modal" value="<?php echo htmlspecialchars($row['carmodal']) ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"><i class="fa-solid fa-calendar"></i> Modal Year</label>
                                                                <input type="text" class="form-control" placeholder="YYYY" required="" name="year" value="<?php echo htmlspecialchars($row['carmodalyear']) ?>">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label"><i class="fa-solid fa-tachometer-alt"></i> Mileage</label>
                                                                <input type="text" class="form-control" placeholder="Enter Mileage" required="" name="mileage" value="<?php echo htmlspecialchars($row['carmileage']) ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"><i class="fa-solid fa-gas-pump"></i> Fuel</label>
                                                                <input type="text" class="form-control" placeholder="Fuel Type" required="" name="fuel" value="<?php echo htmlspecialchars($row['carfuel']) ?>">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label"><i class="fa-solid fa-cogs"></i> Gearbox</label>
                                                                <select class="form-control" required="" name="gearbox">
                                                                    <option value="" selected disabled>Select Gearbox</option>
                                                                    <option value="Manual" <?php if ($row['cargears'] == "Manual") {
                                                                                                echo "selected";
                                                                                            } ?>>Manual</option>
                                                                    <option value="Automatic" <?php if ($row['cargears'] == "Automatic") {
                                                                                                    echo "selected";
                                                                                                } ?>>Automatic</option>
                                                                    <option value="CVT" <?php if ($row['cargears'] == "CVT") {
                                                                                            echo "selected";
                                                                                        } ?>>CVT</option>
                                                                    <option value="Semi-Automatic" <?php if ($row['cargears'] == "Semi-Automatic") {
                                                                                                        echo "selected";
                                                                                                    } ?>>Semi-Automatic</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"><i class="fa-solid fa-horse"></i> Horsepower</label>
                                                                <select class="form-control" required="" name="power">
                                                                    <option value="" selected disabled>Select Horsepower</option>
                                                                    <option value="Under 50 HP" <?php if ($row['carpower'] == "Under 50 HP") {
                                                                                                    echo "selected";
                                                                                                } ?>>Under 50 HP</option>
                                                                    <option value="50-100 HP" <?php if ($row['carpower'] == "50-100 HP") {
                                                                                                    echo "selected";
                                                                                                } ?>>50-100 HP</option>
                                                                    <option value="100-150 HP" <?php if ($row['carpower'] == "100-150 HP") {
                                                                                                    echo "selected";
                                                                                                } ?>>100-150 HP</option>
                                                                    <option value="150-200 HP" <?php if ($row['carpower'] == "150-200 HP") {
                                                                                                    echo "selected";
                                                                                                } ?>>150-200 HP</option>
                                                                    <option value="200+ HP" <?php if ($row['carpower'] == "200+ HP") {
                                                                                                echo "selected";
                                                                                            } ?>>200+ HP</option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label"><i class="fa-solid fa-door-closed"></i> Doors</label>
                                                                <select class="form-control" required="" name="doors">
                                                                    <option value="" selected disabled>Select Doors</option>
                                                                    <option value="2" <?php if ($row['cardoors'] == "2") {
                                                                                            echo "selected";
                                                                                        } ?>>2</option>
                                                                    <option value="3" <?php if ($row['cardoors'] == "3") {
                                                                                            echo "selected";
                                                                                        } ?>>3</option>
                                                                    <option value="4" <?php if ($row['cardoors'] == "4") {
                                                                                            echo "selected";
                                                                                        } ?>>4</option>
                                                                    <option value="5" <?php if ($row['cardoors'] == "5") {
                                                                                            echo "selected";
                                                                                        } ?>>5</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"><i class="fa-solid fa-chair"></i> Number of Seats</label>
                                                                <select class="form-control" required="" name="seats">
                                                                    <option value="" selected disabled>Select Seats</option>
                                                                    <option value="2" <?php if ($row['carseats'] == "2") {
                                                                                            echo "selected";
                                                                                        } ?>>2</option>
                                                                    <option value="4" <?php if ($row['carseats'] == "4") {
                                                                                            echo "selected";
                                                                                        } ?>>4</option>
                                                                    <option value="5" <?php if ($row['carseats'] == "5") {
                                                                                            echo "selected";
                                                                                        } ?>>5</option>
                                                                    <option value="7" <?php if ($row['carseats'] == "7") {
                                                                                            echo "selected";
                                                                                        } ?>>7</option>
                                                                    <option value="8+" <?php if ($row['carseats'] == "8+") {
                                                                                            echo "selected";
                                                                                        } ?>>8+</option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label"><i class="fa-solid fa-palette"></i> Color</label>
                                                                <input type="text" class="form-control" placeholder="Enter Color" required="" name="color" value="<?php echo htmlspecialchars($row['carcolor']) ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"><i class="fa-solid fa-image"></i> Feature Image</label>
                                                                <input type="file" class="form-control" required="" name="image">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label"><i class="fa-solid fa-file-alt"></i> Description / Details</label>
                                                            <textarea id="description" class="form-control" rows="5" placeholder="Enter Vehicle Details" name="details">value="<?php echo $row['cardetails'] ?>"</textarea>
                                                        </div>

                                                        <input type="text" hidden name="carid" value="<?php echo htmlspecialchars($row['carid']) ?>">

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="btn-update"><i class="fa-solid fa-paper-plane"></i> Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="6">No Record Found</td>
                            </tr>
                        <?php }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php' ?>