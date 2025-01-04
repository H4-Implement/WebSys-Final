    <style>
        body {
            background-color: #012901;
            font-family: 'Arial', sans-serif;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h3 {
            color: #e8b00c;
        }

        .card {
            background-color: #045e04;
            border-radius: 15px;
            overflow: hidden;
            color: #fff;
        }
        .card-title{
            text-align: center;
        }

        .btn {
            background: #024d02;
            border: none;
            color: white;
        }

        .btn:hover {
            background: #012901;
            color: #d4d4d4;
        }

        .btn-danger {
            background: #a30303;
            color: white;
        }

        .btn-danger:hover {
            background: #660101;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            background-color: #fff;
            color: grey;
        }

        .form-control:focus {
            border-color: #e8b00c;
            box-shadow: 0 0 5px rgba(232, 176, 12, 0.5);
        }

        .form-control, 
        .form-control-file, 
        .btn {
            border-radius: 5px;
        }

        .form-control {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .form-control-file {
            border: 1px dashed #012901;
            padding: 10px;
            width: 100%;
        }

        .form-control:focus,
        .form-control-file:focus {
            border-color: #024d02;
            outline: none;
        }

        select.form-control {
            background: #ffffff;
            padding: 10px;
        }

        .form-group label {
            color: #e8b00c;
        }

        .alert {
            border-radius: 8px;
        }

        .alert-success {
            background-color: #024d02;
            border: 1px solid #00c853;
            color: #e8b00c;
        }

        .alert-danger {
            background-color: #a30303;
            border: 1px solid #660101;
            color: white;
        }

        .container {
            margin-top: 50px;
        }

        @media (max-width: 768px) {
            .btn {
                font-size: 0.9rem;
                padding: 10px 15px;
            }
        }
    </style>

    <?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show position-absolute top-0 start-50 translate-middle-x mt-3" role="alert" style="z-index: 1050;">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 start-50 translate-middle-x mt-3" role="alert" style="z-index: 1050;">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="add-container container"> 
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Add Product Item</h3>
                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6">
                        <form action="<?= base_url('item/add') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="genre">Category</label>
                                <select class="form-control" id="genre" name="genre" required onchange="toggleCategoryDropdown()">
                                    <option value="">Select Category</option>
                                    <option value="Equipments">Equipments</option>
                                    <option value="Gadgets">Gadgets</option>
                                </select>
                            </div>
                            <br>

                            <div class="form-group" id="EquipmentDropdown" style="display: none;">
                                <label for="equipment">Select Equipment</label>
                                <select class="form-control" id="equipment" name="CATEGORY">
                                    <option value="Extension">Extension Cord</option>
                                    <option value="VGA">VGA Cable</option>
                                    <option value="HDMI">HDMI Cable</option>
                                    <option value="Power">Power Cable</option>
                                    <option value="Remote">DLP Remote Control</option>
                                    <option value="Peripherals">Keyboard and Mouse (With Lightning Cable)</option>
                                    <option value="Crimp">Cable Crimping Tools</option>
                                    <option value="CableTester">Cable Testers</option>
                                    <option value="Keys">Laboratory Room Keys</option>
                                </select>
                            </div>

                            <div class="form-group" id="DeviceDropdown" style="display: none;">
                                <label for="device">Select Device</label>
                                <select class="form-control" id="device" name="CATEGORY">
                                    <option value="Laptop">Laptop (With Charger)</option>
                                    <option value="Tablets">Drawing Tablets (With Stylus)</option>
                                    <option value="Speaker">Speaker Sets</option>
                                    <option value="Webcam">Webcam</option>
                                </select>
                            </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NAME">Item Name</label>
                            <input type="text" name="NAME" class="form-control" required>
                        </div>

                        <br><br>

                        <div class="form-group">
                            <label for="IMAGE">Upload Image</label>
                            <input type="file" name="IMAGE" class="form-control-file" required accept="image/*">
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary">Add Item</button>
                        </form>

                        <a href="<?= base_url('item'); ?>" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleCategoryDropdown() {
            var genreSelect = document.getElementById("genre");
            var equipmentDropdown = document.getElementById("EquipmentDropdown");
            var deviceDropdown = document.getElementById("DeviceDropdown");

            equipmentDropdown.style.display = "none";
            deviceDropdown.style.display = "none";

            document.getElementById("equipment").disabled = true;
            document.getElementById("device").disabled = true;

            if (genreSelect.value === "Equipments") {
                equipmentDropdown.style.display = "block";
                document.getElementById("equipment").disabled = false;
            } else if (genreSelect.value === "Gadgets") {
                deviceDropdown.style.display = "block";
                document.getElementById("device").disabled = false;
            }
        }

        // Optionally, you can call the function on page load to set the initial state
        document.addEventListener("DOMContentLoaded", function() {
            toggleCategoryDropdown(); // Ensure the correct dropdown is shown based on the default selected value
        });
    </script>
