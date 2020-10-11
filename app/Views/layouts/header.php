<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="<?= base_url('home') ?>" class="navbar-brand">E-<b>Arsip</b></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="<?= ($title == "Home") ? 'active' : '' ?>"><a href="<?= base_url('/') ?>">Home <span class="sr-only">(current)</span></a></li>
                    <li class="<?= ($title == "Kategori") ? 'active' : '' ?>"><a href="<?= base_url('kategori') ?>">Kategori</a></li>
                    <li class="<?= ($title == "Departemen") ? 'active' : '' ?>"><a href="<?= base_url('dep') ?>">Departemen</a></li>
                    <li class="<?= ($title == "Arsip") ? 'active' : '' ?>"><a href="<?= base_url('arsip') ?>">Arsip</a></li>
                    <li class="<?= ($title == "User") ? 'active' : '' ?>"><a href="<?= base_url('user') ?>">User</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="<?= base_url('foto/' . session()->get('foto')) ?>" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><?= session()->get('nama_user') ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="<?= base_url('foto/' . session()->get('foto')) ?>" class="img-circle" alt="User Image">

                                <p>
                                    <?= session()->get('nama_user') ?> -
                                    <?= (session()->get('level') == 1) ? 'Admin' : 'User' ?>
                                    <small><?= session()->get('email') ?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-default btn-flat">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>