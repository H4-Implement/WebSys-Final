<link rel="stylesheet" href="<?= base_url('assets/css/userview.css') ?>">
</head>
<body>
    
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
    <h3>List of Users</h3>
    <!-- Search Form -->
    <form action="<?= base_url('users'); ?>" method="GET" class="search-bar">
        <input type="text" name="search" placeholder="Search by username, email, or fullname..." value="<?= esc($search) ?>" />
        <button type="submit"><i class="fas fa-search"></i> Search</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Fullname</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($users) : ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['id']; ?></td>
                        <td><?= $user['username']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['fullname']; ?></td>
                        <td><?= $user['active'] == 1 ? 'Active' : 'Inactive'; ?></td>
                        <td><a href="<?= base_url('users/view/' . $user['id']); ?>" class="btn-warning"><i class="fas fa-eye"></i> View</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="5" style="text-align:center;">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Cards for smaller screens -->
    <div class="card-list">
        <?php if ($users) : ?>
            <?php foreach ($users as $user) : ?>
                <div class="card">
                    <h4><?= $user['username']; ?></h4>
                    <p><strong>ID:</strong> <?= $user['id']; ?></p>
                    <p><strong>Email:</strong> <?= $user['email']; ?></p>
                    <p><strong>Fullname:</strong> <?= $user['fullname']; ?></p>
                    <div class="actions">
                        <a href="<?= base_url('users/view/' . $user['id']); ?>" class="btn-warning"><i class="fas fa-eye"></i> View</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p style="text-align:center;">No users found.</p>
        <?php endif; ?>
    </div>

    <!-- Add Button and Pagination aligned horizontally -->
    <div class="button-pagination-wrapper">
        <a href="<?= base_url('users/add'); ?>" class="btn-success"><i class="fas fa-plus"></i> Add User</a>
        <div class="pagination-wrapper">
            <?= $pager->links(); ?>
        </div>
    </div>
</div>
