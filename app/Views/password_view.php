<link rel="stylesheet" href="<?= base_url('assets/css/passwordView.css') ?>">
</head>
<body>

<div class="container">
    <div class="form-container">
        <h3>Reset Your Password</h3>
        <form action="<?= base_url('login/reset'); ?>" method="post">
            <?php if (!session()->get('code_sent')): ?>
            <!-- Step 1: Request Reset Code -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter your Username" value="<?= old('username') ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Send Reset Code</button>
                <a href="<?= base_url('login'); ?>" class="btn btn-danger">Back to Login</a>
            </div>
            <?php else: ?>
            <!-- Step 2: Enter Reset Code and Passwords -->
            <div class="form-group">
                <label for="code">Reset Code</label>
                <input type="text" name="code" id="code" class="form-control" placeholder="Enter Reset Code" value="<?= old('code') ?>" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
            </div>
            <div class="form-group">
                <label for="retype_password">Retype Password</label>
                <input type="password" name="retype_password" id="retype_password" class="form-control" placeholder="Retype Password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Reset Password</button>
                <a href="<?= base_url('login/reset_cancel'); ?>" class="btn btn-danger">Back to Login</a>
            </div>
            <?php endif; ?>
            <div id="password-error" style="color: red; display: none;"></div>
        </form>
    </div>
</div>

    <script>
        function validatePasswords() {
            var newPassword = document.getElementById('new_password').value;
            var retypePassword = document.getElementById('retype_password').value;
            var errorMessage = document.getElementById('password-error');

            if (newPassword !== retypePassword) {
                errorMessage.style.display = 'block';
                errorMessage.innerHTML = 'Passwords do not match!';
                return false;
            } else {
                errorMessage.style.display = 'none';
                return true;
            }
        }

        // Bind validation function to form submission
        document.querySelector('form').addEventListener('submit', function(event) {
            if (document.getElementById('code').value && document.getElementById('new_password').value && document.getElementById('retype_password').value) {
                if (!validatePasswords()) {
                    event.preventDefault(); 
                }
            }
        });
    </script>
</body>
</html>
