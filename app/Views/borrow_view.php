<style>
    @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap');
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    
    body {
        font-family: "Merriweather", serif;
        background-color: #012901;
        color: #FFF;
        font-family: "Merriweather", serif;
        background-color: #f4f7fa;
        color: #024d02;
        background-image: url('<?= base_url('assets/img/usersBG.png'); ?>');
        background-size: cover;
        margin: 0;
        padding: 0;
        display: flex;
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
        background-color: #f4f7fa;
        border-radius: 8px;
        width: 90%;
        max-width: 1200px;
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
        background-color: #f4f7fa;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        color: #024d02;
    }

    th {
        background-color: #024d02;
        color: white;
    }

    tr {
        background-color: #ffffff;
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
        border: none;
        cursor: pointer;
    }

    .btn-success {
        background-color: #024d02;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #e8b00c;
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

    .pagination-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: center;
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
        transition: all 0.3s ease;
    }

    .pagination-wrapper a:hover {
        background-color: #e8b00c;
        color: #024d02;
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

<div class="container">
    <h3>List of Available Products</h3>

    <!-- Search Form -->
    <form action="<?= base_url('equipments/index'); ?>" method="GET" class="search-bar">
        <input type="text" name="search" placeholder="Search by item name or category..." value="<?= esc($search); ?>">
        <button type="submit">Search</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Image Preview</th>
                <th>ID</th>
                <th>Item Name</th>
                <th>Item Category</th>
                <th>Item Status</th>
                <th>Borrower</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <?php if (in_array($item['STATUS'], ['Available', 'In-Use'])): ?>
                    <tr>
                        <td>
                            <img src="<?= base_url('assets/img/' . $item['NAME'] . '.png'); ?>" class="img-fluid" alt="<?= htmlspecialchars($item['NAME']); ?>" style="width: 50px; height: auto;">
                        </td>
                        <td><?= htmlspecialchars($item['ID']); ?></td>
                        <td><?= htmlspecialchars($item['NAME']); ?></td>
                        <td><?= htmlspecialchars($item['CATEGORY']); ?></td>
                        <td><?= htmlspecialchars($item['STATUS']); ?></td>
                        <td><?= $item['USEDBY'] ? htmlspecialchars($item['USEDBY']) : 'N/A'; ?></td>
                        <td>
                            <?php if ($item['STATUS'] === 'Available'): ?>
                                <a href="<?= base_url('item/borrow/' . $item['UNIQUEID']); ?>" class="btn btn-success">Borrow</a>
                            <?php elseif ($item['STATUS'] === 'In-Use'): ?>
                                <a href="<?= base_url('item/return/' . $item['UNIQUEID']); ?>" class="btn btn-warning">Return</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination-wrapper">
        <?= $pager->links(); ?>
    </div>
</div>
