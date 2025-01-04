<link rel="stylesheet" href="<?= base_url('assets/css/userEdit.css') ?>">
</head>
<body>

<div class="container">
    <div class="form-container">
        <h3>Edit User</h3>
        <form action="<?= base_url('users/edit/'.$user['id']); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= $user['username']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div>
                    <a href="<?= base_url('login/reset'); ?>" class="btn btn-warning" style="color: white;">Reset Password</a>
                    <small class="form-text text-muted" style="margin-left: 10px;">
                        Click to reset your password.
                    </small>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $user['email']; ?>">
            </div>
            <div class="form-group">
                <label for="fullname" class="form-label">Fullname</label>
                <input type="text" name="fullname" id="fullname" class="form-control" value="<?= $user['fullname']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-control">
                    <option value="Admin" <?= $user['role'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="Student" <?= $user['role'] == 'Student' ? 'selected' : ''; ?>>Student</option>
                    <option value="Associate" <?= $user['role'] == 'Associate' ? 'selected' : ''; ?>>Associate</option>
                </select>
            </div>
            <div class="form-group d-flex justify-content-between">
                <a href="<?= base_url('users/view/'.$user['id']); ?>" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
