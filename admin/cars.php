<?php include_once 'header.php' ?>
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-4">
                <h4 class="text-center mb-4">Vehicle Specs</h4>
                <form action="php/cars-server.php" method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-car"></i> Title</label>
                            <input type="text" class="form-control" placeholder="Enter Vehicle Title" required="" name="title">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-industry"></i> Brand</label>
                            <select class="form-control" required="" name="brand">
                                <option value="" selected disabled>Select Brand</option>
                                <option value="Toyota">Toyota</option>
                                <option value="Honda">Honda</option>
                                <option value="Suzuki">Suzuki</option>
                                <option value="Kia">Kia</option>
                                <option value="Hyundai">Hyundai</option>
                                <option value="Nissan">Nissan</option>
                                <option value="Daihatsu">Daihatsu</option>
                                <option value="Changan">Changan</option>
                                <option value="Proton">Proton</option>
                                <option value="Haval">Haval</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-car-side"></i> Model</label>
                            <input type="text" class="form-control" placeholder="Enter Model" required="" name="modal">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-calendar"></i> Modal Year</label>
                            <input type="text" class="form-control" placeholder="YYYY" required="" name="year">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-tachometer-alt"></i> Mileage</label>
                            <input type="text" class="form-control" placeholder="Enter Mileage" required="" name="mileage">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-gas-pump"></i> Fuel</label>
                            <input type="text" class="form-control" placeholder="Fuel Type" required="" name="fuel">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-cogs"></i> Gearbox</label>
                            <select class="form-control" required="" name="gearbox">
                                <option value="" selected disabled>Select Gearbox</option>
                                <option value="Manual">Manual</option>
                                <option value="Automatic">Automatic</option>
                                <option value="CVT">CVT</option>
                                <option value="Semi-Automatic">Semi-Automatic</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-horse"></i> Horsepower</label>
                            <select class="form-control" required="" name="power">
                                <option value="" selected disabled>Select Horsepower</option>
                                <option value="Under 50 HP">Under 50 HP</option>
                                <option value="50-100 HP">50-100 HP</option>
                                <option value="100-150 HP">100-150 HP</option>
                                <option value="150-200 HP">150-200 HP</option>
                                <option value="200+ HP">200+ HP</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-door-closed"></i> Doors</label>
                            <select class="form-control" required="" name="doors">
                                <option value="" selected disabled>Select Doors</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-chair"></i> Number of Seats</label>
                            <select class="form-control" required="" name="seats">
                                <option value="" selected disabled>Select Seats</option>
                                <option value="2">2</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="7">7</option>
                                <option value="8+">8+</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-palette"></i> Color</label>
                            <input type="text" class="form-control" placeholder="Enter Color" required="" name="color">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-image"></i> Feature Image</label>
                            <input type="file" class="form-control" required="" name="image">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-tag"></i> Car Price</label>
                            <input type="number" class="form-control" placeholder="Enter Car Price" required name="price">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-file-invoice-dollar"></i> Registration/Duties Fee</label>
                            <input type="number" class="form-control" placeholder="Enter Registration/Duties Fee" required name="duties">
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label"><i class="fa-solid fa-file-alt"></i> Description / Details</label>
                        <textarea id="description" class="form-control" rows="5" placeholder="Enter Vehicle Details" name="details"></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="btn-upload"><i class="fa-solid fa-paper-plane"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php include_once 'footer.php' ?>