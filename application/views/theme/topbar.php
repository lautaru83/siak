<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
  </ul>

  <!-- SEARCH FORM -->
  <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link text-reset dropdown-toggle" data-toggle="dropdown">
        <img src="<?= base_url('assets/') ?>dist/img/<?= $this->session->userdata('image'); ?>" class="user-image img-circle elevation-1" alt="User Image">
        <span class="d-none d-md-inline"><?= $this->session->userdata('nama_user'); ?></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-info">
          <img src="<?= base_url('assets/') ?>dist/img/<?= $this->session->userdata('image'); ?>" class="img-circle elevation-1" alt="User Image">

          <p>
            <?= $this->session->userdata('nama_user'); ?>
            <small>Member since Nov. 2012</small>
          </p>
        </li>
        <!-- Menu Body -->
        <!--           <li class="user-body">
            <div class="row">
              <div class="col-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Friends</a>
              </div>
            </div>
          </li> -->
        <!-- Menu Footer-->
        <li class="user-footer">
          <a href="#" class="btn btn-default btn-flat">Profile</a>
          <a href="<?= site_url('auth/logout'); ?>" class="btn btn-default btn-flat float-right">Sign out</a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebara" data-slide="false" href="#"><i class="fas fa-th-large"></i></a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->