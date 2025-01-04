<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .sidebar {
        height: 100%;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #024d02;
        padding-top: 20px;
        transition: 0.3s;
        z-index: 1000;
    }

    .sidebar.collapsed {
        width: 80px;
    }

    .sidebar a {
        padding: 15px 8px 15px 16px;
        text-decoration: none;
        font-size: 18px;
        color: white;
        display: block;
        transition: 0.3s;
    }

    .sidebar.collapsed a {
        text-align: center;
        padding: 15px 0;
    }

    .sidebar a:hover {
        background-color: #012601;
        color: #e8b00c;
    }

    .sidebar img {
        width: 50%;
        height: auto;
        display: block;
        margin: 0 auto 20px;
    }

    .sidebar .logout-btn {
        position: absolute;
        bottom: 20px;
        width: 90%;
        left: 5%;
    }

    .sidebar.collapsed .logout-btn {
        width: 60px;
        left: 10px;
    }

    .main-content {
        margin-left: 250px;
        padding: 20px;
        transition: margin-left 0.3s ease-in-out;
    }

    .main-content.collapsed {
        margin-left: 80px;
    }

    .collapse-btn {
        z-index: 1000;
        position: absolute;
        top: 20px;
        left: 260px;
        background-color: #094324;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        transition: left 0.3s;
    }

    .sidebar.collapsed + .collapse-btn {
        left: 90px;
    }

    .link-text {
        display: inline;
    }

    .sidebar.collapsed .link-text {
        display: none;
    }

    .logout-btn {
        background-color: #962926;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s ease;
        text-decoration: none;
    }

    #logout-link {
        background-color: #962926;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s ease;
        text-decoration: none;
    }

    #logout-link:hover {
        background-color: #690603;
        color: #e8b00c;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 0;
            overflow: hidden;
        }

        .sidebar.show {
            width: 250px;
        }

        .main-content {
            margin-left: 0;
        }

        .main-content.show {
            margin-left: 250px;
        }

        .collapse-btn {
            left: 10px;
            background-color: #024d02;
        }

        .sidebar.collapsed + .collapse-btn {
            left: 10px;
        }
    }

    .burger-btn {
        z-index: 999;
        position: absolute;
        top: 20px;
        left: 10px;
        background-color: #024d02;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        display: none;
    }

    @media (max-width: 768px) {
        .burger-btn {
            display: block;
        }
    }

    .close-btn {
        z-index: 999;
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: #024d02;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        display: none;
    }

    .sidebar.show + .close-btn {
        display: block;
    }
</style>

<div class="sidebar collapsed" id="sidebar">
    <img src="<?= base_url('assets/img/TechSeal.png') ?>" alt="logo">
    <a href="<?= base_url('index') ?>"><i class="bi bi-house"></i> <span class="link-text">Home</span></a>
    <a href="<?= base_url('about'); ?>"><i class="bi bi-info-circle"></i> <span class="link-text">About</span></a>
    <a href="<?= base_url('item') ?>"><i class="bi bi-box-seam"></i> <span class="link-text">Equipments</span></a>
    <a href="<?= base_url('borrow'); ?>"><i class="bi bi-arrow-down-circle"></i> <span class="link-text">Borrowing</span></a>
    <a href="<?= base_url('reserve'); ?>"><i class="bi bi-calendar-check"></i> <span class="link-text">Reservation</span></a>
    <a href="<?= base_url('report'); ?>"><i class="bi bi-file-earmark-text"></i> <span class="link-text">Equipment Report</span></a>
    <a href="<?= base_url('users'); ?>"><i class="bi bi-people"></i> <span class="link-text">Users</span></a>
    <a href="<?= base_url('logout'); ?>" id="logout-link" class="logout-btn">
        <i class="bi bi-box-arrow-right"></i> <span class="link-text">Logout</span>
    </a>
</div>

<button class="collapse-btn" id="collapse-btn"><i class="bi bi-arrow-left-right"></i></button>
<button class="burger-btn" id="burger-btn"><i class="bi bi-list"></i></button>
<button class="close-btn" id="close-btn"><i class="bi bi-x"></i></button>

<script>
    document.getElementById('collapse-btn').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        var mainContent = document.getElementById('main-content');
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');
    });

    document.getElementById('burger-btn').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        var closeBtn = document.getElementById('close-btn');
        sidebar.classList.toggle('show');
        closeBtn.style.display = sidebar.classList.contains('show') ? 'block' : 'none';
    });

    document.getElementById('close-btn').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        var closeBtn = document.getElementById('close-btn');
        sidebar.classList.remove('show');
        closeBtn.style.display = 'none';
    });

    window.addEventListener('resize', function() {
        var sidebar = document.getElementById('sidebar');
        var collapseBtn = document.getElementById('collapse-btn');
        var burgerBtn = document.getElementById('burger-btn');
        var closeBtn = document.getElementById('close-btn');

        if (window.innerWidth <= 768) {
            collapseBtn.style.display = 'none';
            burgerBtn.style.display = 'block';
            closeBtn.style.display = sidebar.classList.contains('show') ? 'block' : 'none';
            sidebar.classList.remove('collapsed');
        } else {
            collapseBtn.style.display = 'block';
            burgerBtn.style.display = 'none';
            closeBtn.style.display = 'none';
            sidebar.classList.remove('show');
        }
    });

    if (window.innerWidth <= 768) {
        document.getElementById('collapse-btn').style.display = 'none';
        document.getElementById('burger-btn').style.display = 'block';
    }

    // Ensure correct sidebar state on page load
    window.addEventListener('load', function() {
        var sidebar = document.getElementById('sidebar');
        var collapseBtn = document.getElementById('collapse-btn');
        var burgerBtn = document.getElementById('burger-btn');
        var closeBtn = document.getElementById('close-btn');

        if (window.innerWidth <= 768) {
            collapseBtn.style.display = 'none';
            burgerBtn.style.display = 'block';
            closeBtn.style.display = sidebar.classList.contains('show') ? 'block' : 'none';
            sidebar.classList.remove('collapsed');
        } else {
            collapseBtn.style.display = 'block';
            burgerBtn.style.display = 'none';
            closeBtn.style.display = 'none';
            sidebar.classList.remove('show');
        }
    });

</script>
