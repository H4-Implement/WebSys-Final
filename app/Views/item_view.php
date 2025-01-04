<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styling for the user information container */
        .user-info-container {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .card-header {
            background-color: #343a40; /* Dark background color */
            color: #ffffff; /* White text color */
            font-weight: bold;
            font-size: 2.1rem;
            text-align: center;
        }

        .card-body {
            background-color: #f8f9fa; /* Light grey background */
        }

        .card-body h3 {
            font-size: 1.8rem;
            text-align: center;
        }

        .card-title {
            font-weight: bold;
            color: #333333; /* Darker text color for readability */
        }

        .card-text {
            font-size: 1.1rem;
            color: #555555; /* Medium text color */
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-danger:hover {
            background-color: #c82333; /* Darker shade of red on hover */
        }
    </style>
</head>
<body>
    <div class="d-flex align-items-center justify-content-center user-info-container">
        <div class="col col-md-6">
            <div class="card">
                <div class="card-header">
                    Product Information
                </div>
                <div class="card-body">
                <h3 class="card-title"><?= esc($item['ID']); ?></h3>
                    <div class="mb-3">
                        <h5 class="card-title">NAME</h5>
                        <p class="card-text"><?= esc($item['NAME']); ?></p>
                    </div>
                    <div class="mb-3">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text"><?= esc($item['CATEGORY']); ?></p>
                    </div>
                    <a href="<?= base_url('products'); ?>" class="btn btn-danger">Go Back</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
