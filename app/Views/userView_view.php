<link rel="stylesheet" href="<?= base_url('assets/css/viewView.css') ?>">
</head>
<body>

<?php if(session()->has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show position-absolute top-0 start-50 translate-middle-x mt-3" role="alert" style="z-index: 1050;">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container">
    <div class="view-container">
        <h3>User Details</h3>
        <div class="user-info">
            <label for="username">Username:</label>
            <p><?= $user['username']; ?></p>

            <label for="email">Email:</label>
            <p><?= $user['email']; ?></p>

            <label for="password">Password:</label>
            <p>********</p>

            <label for="fullname">Fullname:</label>
            <p><?= $user['fullname']; ?></p>

            <label for="datecreated">Date Created:</label>
            <p><?= $user['datecreated']; ?></p>

            <label for="role">Role:</label>
            <p><?= $user['role']; ?></p>

            <label for="active">Status:</label>
            <p><?= $user['active'] == 1 ? 'Active' : 'Inactive'; ?></p>
        </div>

        <div class="btn-container">
            <a href="<?= base_url('users'); ?>" class="btn btn-back" style="background-color: transparent; border: 2px solid #024d02; color: #024d02;">Back to Users List</a>
            
            <!-- Deactivate/Activate button logic -->
            <?php if ($user['active'] == 1): ?>
                <a href="<?= base_url('users/deactivate/' . $user['id']); ?>" class="btn btn-deactivate">Deactivate User</a>
            <?php else: ?>
                <a href="<?= base_url('users/reactivate/' . $user['id']); ?>" class="btn btn-activate">Activate User</a>
            <?php endif; ?>
            
            <a href="<?= base_url('users/edit/' . $user['id']); ?>" class="btn btn-edit">Edit User</a>
            <a href="<?= base_url('users/delete/' . $user['id']); ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete User</a>
        </div>
    </div>
</div>
