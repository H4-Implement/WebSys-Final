<div class="view-container container">
    <style>
        body{
            background-color: #012901;
        }

        .view-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #012901;
            padding: 20px;
        }

        .card {
            max-width: 700px;
            width: 100%;
            height: 45em;
            margin: 20px auto;
            background: #024d02;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .card-body {
            padding: 20px;
            text-align: center;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .card-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #e8b00c;
        }

        .card img {
            width: 60%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        /* Status Styles */
        .card p {
            font-size: 1.3rem;
            margin-bottom: 20px;
            font-weight: bold;
            color: #e8b00c;
        }

        /* Button Styles */
        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            background-color: #dc3545;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .card-title {
                font-size: 1.25rem;
            }

            .btn {
                font-size: 0.9rem;
                padding: 8px 16px;
            }
        }
    </style>
    <div class="card">
        <div class="card-body text-center">
            <h3 class="card-title"><?php echo $item['NAME']; ?></h3>
            <img src="<?php echo base_url('assets/img/' . $item['NAME'] . '.png'); ?>" class="img-fluid mx-auto d-block" alt="<?php echo $item['NAME']; ?>">
            <p>CATEGORY: <?php echo $item['CATEGORY']; ?></p>
            <p>STATUS: <?php echo $item['STATUS']; ?></p>
            <a href="<?= base_url('item'); ?>" class="btn btn-danger">Back to items</a>
        </div>
    </div>
</div>
