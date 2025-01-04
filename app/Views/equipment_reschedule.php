<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Reservation</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
            text-align: center;
            padding: 20px;
        }

        .card-header h3 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .btn {
            background: #024d02;
            border: none;
            color: white;
            transition: all 0.3s ease;
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
</head>
<body>
    <div class="container mt-5">
        <!-- Card for Reservation -->
        <div class="card shadow-lg border-0">
            <div class="card-header">
                <h3 class="mb-0">Reschedule Item: <?= $item['NAME']; ?></h3>
            </div>
            <div class="card-body p-4">
                <!-- Reservation Form -->
                <form action="<?= base_url('item/reschedule/' . $item['UNIQUEID']); ?>" method="post">
                    <div class="mb-4">
                        <label for="RESERVEDBY" class="form-label">Reserved By</label>
                        <input type="text" class="form-control" id="RESERVEDBY" name="RESERVEDBY" placeholder="Enter Student Number" value="<?= $item['RESERVEDBY']; ?>" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="DATE_RESERVED" class="form-label">Reservation Date</label>
                        <input type="date" class="form-control" id="DATE_RESERVED" name="DATE_RESERVED" required value="<?= $item['DATE_RESERVED']; ?>">
                    </div>
                    <div class="mb-4">
                        <label for="DATE_RESERVED_END" class="form-label">End Reservation Date</label>
                        <input type="date" class="form-control" id="DATE_RESERVED_END" name="DATE_RESERVED_END" required value="<?= $item['DATE_RESERVED_END']; ?>">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-warning btn-lg px-5 me-3">
                            <i class="bi bi-calendar-check"></i> Reschedule
                        </button>
                        <a href="<?= base_url('reserve'); ?>" class="btn btn-outline-danger btn-lg px-5">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
