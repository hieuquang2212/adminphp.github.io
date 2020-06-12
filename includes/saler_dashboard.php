<nav class="navbar navbar-light bg-dark">
    <a class="navbar-brand text-white-50" href="#">Saler Dashboard</a>
    <div class="dropdown float-right">
        <button class="btn dropdown-toggle text-white-50" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Chào
            <?php 
                        if (isset($_SESSION['saler_name']))
                        echo $_SESSION['saler_name'];
                ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#"><i class="fas fa-user-circle"></i> Hồ sơ cá nhân</a>
            <a class="dropdown-item" href="logout.php">Đăng xuất</a>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <?php
        include('admin/bill.php');
    ?>
</div>
