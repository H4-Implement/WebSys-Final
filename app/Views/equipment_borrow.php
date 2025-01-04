<!DOCTYPE html>
<html lang="en">
<>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Item</title>
    <style> 
        /* Internal CSS for aesthetics and responsiveness */
        body {
            background-color: #012901;
            font-family: 'Arial', sans-serif;
        }

        .card {
            background-color: #045e04;
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header {
            background-color: #024d02;
            color: #e8b00c;
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

        .btn-outline-danger {
            margin-right: 20px;
            border: 2px solid #660101;
            background: #a30303;
            color: #fff;
        }

        .btn-outline-danger:hover {
            border: 2px solid #660101;
            background-color: #660101;
            color: #d4d4d4;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }

        .form-label {
            color: #e8b00c;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding-top: 50px;
        }

        @media (max-width: 768px) {
            .btn-lg {
                font-size: 0.9rem;
                padding: 10px 20px;
            }

            .container {
                padding: 20px;
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

<body>
    <div class="container mt-5">
        <!-- Card for reservation -->
        <div class="card shadow-lg border-0">
            <div class="card-header text-white text-center py-3">
                <h3 class="mb-0">Borrow Item: <?= $item['NAME']; ?></h3>
            </div>
            <div class="card-body p-4">
                <!-- Borrow Form -->
                <form action="<?= base_url('item/borrow/' . $item['UNIQUEID']); ?>" method="post">
                    <div class="mb-4">
                        <label for="USEDBY" class="form-label">To be used by:</label>
                        <input type="text" class="form-control form-control-lg" id="USEDBY" name="USEDBY" placeholder="Enter Student Number" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg px-5 me-3">
                            <i class="bi bi-calendar-check"></i> Borrow Item
                        </button>
                        <a href="<?= base_url('borrow'); ?>" class="btn btn-outline-danger btn-lg px-5">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
