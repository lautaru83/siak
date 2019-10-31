<header class="main-header">
    <a href="<?= site_url('dashboard') ?>" class="logo">
        <span class="logo-mini"><b>SI</b>A</span>
        <span class="logo-lg"><b>Siak</b>SM</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?= $this->session->userdata('nama_user'); ?> </span>
                        <img src="<?= base_url('assets/') ?>dist/img/<?= $this->session->userdata('image'); ?>" class="user-image" alt="User Image">
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?= base_url('assets/') ?>dist/img/<?= $this->session->userdata('image'); ?>" class="img-circle" alt="User Image">
                            <p>
                                <?= $this->session->userdata('nama_user'); ?>
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" id="btn-profile" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= site_url('auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>