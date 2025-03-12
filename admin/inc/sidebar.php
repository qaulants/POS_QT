<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.php" class="app-brand-link">
            
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Point of Sales</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <!-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Layouts</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="layouts-without-menu.html" class="menu-link">
                        <div data-i18n="Without menu">Without menu</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-without-navbar.html" class="menu-link">
                        <div data-i18n="Without navbar">Without navbar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-container.html" class="menu-link">
                        <div data-i18n="Container">Container</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-fluid.html" class="menu-link">
                        <div data-i18n="Fluid">Fluid</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-blank.html" class="menu-link">
                        <div data-i18n="Blank">Blank</div>
                    </a>
                </li>
            </ul>
        </li> -->

        <?php if ($_SESSION['id_level'] == 1) :  ?>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Master Data</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="user.php" class="menu-link">
                            <div data-i18n="Account">Data User</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="level.php" class="menu-link">
                            <div data-i18n="Account">Level</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="kategori.php" class="menu-link">
                            <div data-i18n="Notifications">Kategori</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="produk.php" class="menu-link">
                            <div data-i18n="Account">Produk</div>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif ?>

        <?php if ($_SESSION['id_level'] == 2) :  ?>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                    <div data-i18n="Authentications">Transaksi</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="kasir.php" class="menu-link">
                            <div data-i18n="Basic">Kasir</div>
                        </a>
                    </li>
                </ul>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="stok-produk.php" class="menu-link">
                            <div data-i18n="Basic">Stok Produk</div>
                        </a>
                    </li>
                </ul>

            </li>
        <?php endif ?>


        <?php if ($_SESSION['id_level'] == 3) :  ?>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                    <div data-i18n="Authentications">Data Penjualan</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="pimpinan.php" class="menu-link">
                            <div data-i18n="Basic">Laporan Penjualan</div>
                        </a>
                    </li>
                </ul>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="stok-produk.php" class="menu-link">
                            <div data-i18n="Basic">Stok Produk</div>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif ?>
        <!-- Components -->


    </ul>
</aside>