<link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
</head>
<body>
    
<?php if(session()->has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 start-50 translate-middle-x mt-3" role="alert" style="z-index: 1050;">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session()->has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show position-absolute top-0 start-50 translate-middle-x mt-3" role="alert" style="z-index: 1050;">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container" id="container">
        <div class="form-container sign-in">
            <form action="<?= base_url('index/login'); ?>" method="post">
                <h1>Sign In</h1>
                <input type="text" name="username" id="username" class="form-control form-control-lg bg-light fs-6" placeholder="Username">
                <input type="password" name="password" id="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                <a href="<?= base_url('login/reset'); ?>">Forgot Your Password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                <div class="image-container">
                    <img src='<?= base_url()?>assets/img/TechSeal.png' alt="Centered Image" class="centered-image">
                </div>
                    <p>Welcome to ITSO Office</p>
                </div>
            </div>
        </div>
    </div>