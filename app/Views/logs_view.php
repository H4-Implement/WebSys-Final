<style>
    @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap');
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    
    body {
        font-family: 'Merriweather', serif;
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
        border-radius: 8px;
        width: 90%;
        max-width: 1200px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
        background-color: #f9f9f9;
        color: #024d02;
    }

    tr:hover {
        background-color: #e8b00c;
        color: #024d02;
        cursor: pointer;
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

<!-- Logs Table -->
<div class="container">
    <h3>Activity Logs</h3>
    <table style="margin-bottom: 20px; color: #FFF; font-size: 18px; width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Action</th>
                <th>User</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($logs)): ?>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?= esc($log['id']); ?></td>
                        <td><?= esc($log['action']); ?></td>
                        <td><?= esc($log['user']); ?></td>
                        <td><?= esc($log['timestamp']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">No logs available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Add button and pagination -->
    <div class="button-pagination-wrapper" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
            <div class="pagination-wrapper">
            <?= $pager->links(); ?>
            </div>
        </div>
</div>
