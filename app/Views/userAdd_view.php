<link rel="stylesheet" href="<?= base_url('assets/css/useradd.css') ?>">
</head>
<body>

<?php if(validation_errors() != null): ?>
    <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 start-50 translate-middle-x mt-3" role="alert" style="z-index: 1050;">
        <?= validation_list_errors(); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container">
    <div class="form-container">
        <h3>Sign Up</h3>
        <form action="<?= base_url('users/add'); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= set_value('username'); ?>">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="confpassword" class="form-label">Confirm Password</label>
                <input type="password" name="confpassword" id="confpassword" class="form-control">
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= set_value('email'); ?>">
            </div>
            <div class="form-group">
                <label for="fullname" class="form-label">Fullname</label>
                <input type="text" name="fullname" id="fullname" class="form-control" value="<?= set_value('fullname'); ?>">
            </div>
            <div class="form-group">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-control">
                    <option value="Admin" <?= set_select('role', 'Admin'); ?>>Admin</option>
                    <option value="Associate" <?= set_select('role', 'Associate'); ?>>Associate</option>
                    <option value="Student" <?= set_select('role', 'Student'); ?>>Student</option>
                </select>
            </div>
            <div class="form-group d-flex justify-content-between">
                <a href="<?= base_url('users'); ?>" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-success">Sign Up</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
