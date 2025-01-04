<style>
    @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap');
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    
    body {
        font-family: "Merriweather", serif;
        background-color: #012901;
        color: #333;
        margin: 0;
        padding: 0;
        display: flex;
        background-color: #f4f7fa;
        color: #024d02;
        background-image: url('<?= base_url('assets/img/usersBG.png'); ?>');
        background-size: cover;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    h3 {
        text-align: center;
        margin: 20px 0;
        color: #FFF;
    }

    .container {
        padding: 3% 2%;
        background: #f4f7fa;
        min-height: 100vh;
        background-color: transparent;
    }

    .search-bar {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 20px;
        background-color: #024d02;
        padding: 10px 15px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .search-bar input {
        width: 80%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .search-bar button {
        background-color: #012601;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .search-bar button:hover {
        background-color: #023b02;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
    }

    th {
        background-color: #024d02;
        color: white;
    }

    tr {
        background-color: #f9f9f9;
        color: #024d02;
    }

    tr:hover {
        background-color: #e8b00c;
        color: #024d02;
        cursor: pointer;
    }

    .btn {
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        color: white;
        font-weight: bold;
    }

    .btn-warning {
        background-color: #e8b00c;
    }

    .btn-warning:hover {
        background-color: #bf9004;
    }

    .btn-danger {
        background-color: #ad0329;
    }

    .btn-info {
        background-color: #4b8204;
    }

    /* Cards for smaller screens */
    .card-list {
        display: none;
    }

    .card {
        background: #fff;
        padding: 20px;
        margin-bottom: 15px;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card h4 {
        margin: 0 0 10px;
    }

    .pagination-wrapper {
        margin-top: 20px;
        text-align: right;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .pagination-wrapper a {
        color: #024d02;
        padding: 10px 15px;
        margin: 0 5px;
        border-radius: 8px;
        text-decoration: none;
        background-color: #ffffff;
        border: 1px solid #024d02;
        transition: all 0.3s;
    }

    .pagination-wrapper a:hover {
        background-color: #e8b00c;
        color: #024d02;
    }

    .btn-success {
        background-color: #024d02;
        color: #fff;
        padding: 12px 24px;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        display: inline-block;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #e8b00c;
    }

    /* Responsive behavior */
    @media (max-width: 768px) {
        table {
            display: none;
        }

        .card-list {
            display: block;
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
    <div class="container">
        <h3>List of Reservations</h3>

        <!-- Search Form -->
        <form action="<?= base_url('equipments/index'); ?>" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Search by item name or category..." value="<?= esc($search); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Table for larger screens -->
        <table>
            <thead>
                <tr>
                    <th>ID</th> 
                    <th>Item Name</th>
                    <th>Reserved By</th>
                    <th>Reservation Date</th>
                    <th>Reservation End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $item): ?>
                <tr>
                    <td><?= $item['UNIQUEID']; ?></td>
                    <td><?= $item['NAME']; ?></td>
                    <td><?= $item['RESERVEDBY'] ?? 'N/A'; ?></td>
                    <td><?= $item['DATE_RESERVED'] ?? 'N/A'; ?></td>
                    <td><?= $item['DATE_RESERVED_END'] ?? 'N/A'; ?></td>
                    <td><?= $item['STATUS']; ?></td>
                    <td>
                        <?php if ($item['STATUS'] == 'Available'): ?>
                            <a href="<?= base_url('item/reserve/' . $item['UNIQUEID']); ?>" class="btn btn-info">Reserve</a>
                        <?php elseif ($item['STATUS'] == 'Reserved'): ?>
                            <a href="<?= base_url('item/reschedule/' . $item['UNIQUEID']); ?>" class="btn btn-warning">Reschedule</a>
                            <a href="<?= base_url('item/cancel/' . $item['UNIQUEID']); ?>" class="btn btn-danger">Cancel</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Cards for smaller screens -->
        <div class="card-list">
            <?php foreach($items as $item): ?>
            <div class="card">
                <h4><?= $item['NAME']; ?></h4>
                <p><strong>Category:</strong> <?= $item['CATEGORY']; ?></p>
                <p><strong>Status:</strong> <?= $item['STATUS']; ?></p>
                <div class="actions">
                    <a href="<?= base_url('item/reserve/' . $item['UNIQUEID']); ?>" class="btn btn-info">Reserve</a>
                    <a href="<?= base_url('item/reschedule/' . $item['UNIQUEID']); ?>" class="btn btn-warning">Reschedule</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Add button and pagination -->
        <div class="button-pagination-wrapper">
            <div class="pagination-wrapper">
            <?= $pager->links(); ?>
            </div>
        </div>
    </div>
</body>
