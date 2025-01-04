<div class="add-container container">
    <style>
        body {
            background-color: #012901;
        }

        /* General Container Styles */
        .add-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #012901;
            padding: 20px;
        }

        /* Card Styling */
        .card {
            max-width: 800px;
            width: 100%;
            margin: 20px auto;
            background: #045e04;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e8b00c;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form Group Styling */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            color: #e8b00c;
            margin-bottom: 5px;
            display: block;
        }

        .form-control,
        .form-control-file,
        .btn {
            border-radius: 5px;
        }

        .form-control {
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f8f9fa;
        }

        .form-control[readonly] {
            background-color: #e9ecef;
            color: #495057;
            cursor: not-allowed;
        }

        .form-control-file {
            background-color: white;
            border: 1px dashed #012901;
            padding: 10px;
            width: 100%;
        }

        .form-control:focus,
        .form-control-file:focus {
            border-color: #024d02;
            outline: none;
        }

        /* Button Styling */
        .btn {
            margin-right: 10px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary {
            background-color: #024d02;
            border: none;
        }

        .btn-primary:hover {
            background-color: #012901;
            transform: scale(1.05);
        }

        .btn-danger {
            background-color: #a30303;
            border: none;
        }

        .btn-danger:hover {
            background-color: #660101;
            transform: scale(1.05);
        }

        .btn-warning {
            background-color: #e8b00c;
            color: #000;
        }

        .btn-warning:hover {
            background-color: #c6a009;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .btn {
                font-size: 0.9rem;
                padding: 8px 16px;
            }
        }

        .form-actions {
            text-align: center;
            margin-top: 20px;
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


    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Edit Item</h3>
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

            <form action="<?= base_url('item/edit/' . $item['UNIQUEID']) ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="NAME">Item Name</label>
                    <input type="text" name="NAME" class="form-control" id="NAME" required value="<?= esc($item['NAME']); ?>">
                </div>

                <div class="form-group">
                    <label for="IMAGE">Upload Image</label>
                    <input type="file" name="IMAGE" class="form-control-file" id="IMAGE" accept="image/*">
                </div>

                <div class="form-group d-flex align-items-center" style="gap: 15px;">
                    <label for="status" class="form-label">Status</label>
                    <div style="flex: 1;">
                        <input type="text" id="status" class="form-control" readonly value="<?= ucfirst($item['STATUS']); ?>">
                    </div>
                    <?php if (strtolower($item['STATUS']) === 'deactivated'): ?>
                        <button type="button" class="btn btn-success" onclick="toggleItemStatus('activate')">Activate</button>
                    <?php else: ?>
                        <button type="button" class="btn btn-warning" onclick="toggleItemStatus('deactivate')">Deactivate</button>
                    <?php endif; ?>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="<?= base_url('item'); ?>" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleItemStatus(action) {
        const message = action === 'activate' 
            ? "Are you sure you want to activate this item?" 
            : "Are you sure you want to deactivate this item?";

        if (confirm(message)) {
            const url = action === 'activate'
                ? "<?= base_url('item/activate/' . $item['UNIQUEID']) ?>"
                : "<?= base_url('item/deactivate/' . $item['UNIQUEID']) ?>";

            window.location.href = url;
        }
    }
</script>