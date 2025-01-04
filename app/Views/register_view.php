<style>
    @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap');

    body {
        margin: 0;
        padding: 0;
        height: 100%;
        background-color: #fffaef;
        font-family: "Merriweather", serif;
        font-weight: 500;
        background-image: url('<?= base_url()?>assets/img/BACKG2.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        background-color: #FAF9F6;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
    }

    h3 {
        font-weight: 900;
        font-size: 28px;
        color: #3d290f;
        margin-bottom: 20px;
        text-align: center;
    }

    label {
        font-weight: bold;
        color: #3d290f;
    }

    .form-control {
        padding: 12px;
        border-radius: 5px;
        border: 1px solid #ddd;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .form-control:focus {
        border-color: #9fbeae;
        outline: none;
        box-shadow: 0 0 5px rgba(159, 190, 174, 0.4);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn {
        padding: 12px 20px;
        font-size: 16px;
        font-weight: bold;
        color: white;
        border-radius: 5px;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-success {
        background-color: #9fbeae;
        margin-right: 10px;
    }

    .btn-success:hover {
        background-color: #6a9e80;
    }

    .btn-danger {
        background-color: #d9534f;
    }

    .btn-danger:hover {
        background-color: #c9302c;
    }

    a {
        text-decoration: none;
        color: white;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 20px;
        }

        h3 {
            font-size: 24px;
        }

        .btn {
            padding: 10px 15px;
        }

        .form-control {
            padding: 10px;
        }
    }
</style>

<?php if(validation_errors() != null): ?>
    <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 start-50 translate-middle-x mt-3" role="alert" style="z-index: 1050;">
        <?= validation_list_errors(); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container" style="margin-top: <?= validation_errors() != null ? '60px' : '0'; ?>;">
    <div class="form-container">
        <h3>Sign Up</h3>
        <form action="<?= base_url('users/register'); ?>" method="post">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" >
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" >
            </div>
            <div class="form-group">
                <label for="confpassword" class="form-label">Confirm Password</label>
                <input type="password" name="confpassword" id="confpassword" class="form-control">
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="fullname" class="form-label">Fullname</label>
                <input type="text" name="fullname" id="fullname" class="form-control">
            </div>
            <div class="form-group d-flex justify-content-between">
                <a href="<?= base_url('index/login'); ?>" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-success">Sign Up</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
