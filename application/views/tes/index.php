<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <!-- <div class="container-fluid"> -->
    <div class="row">
      <div class="col-sm-6">
        <h3 class="ml-3"><?= $kontensubmenu; ?></h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right mr-4">
          <li class="breadcrumb-item"><a>Master Data
              <? // $kontenmenu; 
                                                    ?></a></li>
          <li class="breadcrumb-item active">Role Management Tes
            <? // $kontensubmenu; 
                                                                ?>
          </li>
        </ol>
      </div>
    </div>
    <!-- </div> -->
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col col-md-12">
          <div class="card">
            <div class="card-header bg-gradient-light">
              <div>
                <h4 class="card-title">
                  <a href="#" class="text-reset" id="btn-tambah-role"><i class="fas fa-file-alt" style="color: teal"></i> Tambah data </a>
                </h4>
              </div>
              <div class="float-right">
                <h4 class="card-title" disabled="disabled">
                  Cetak <i class="fas fa-print" style="color: teal"></i>
                </h4>
              </div>

            </div>
            <div class="card-body">
              <h4 class="card-title" disabled="disabled">
                <form method="POST" action="<?= base_url('tes/cetak'); ?>" target="_blank">
                  <button class="btn btn-link" id="btn-cetak-data">
                    Cetak <i class="fas fa-print" style="color: teal"></i>
                  </button>
                </form>
              </h4>
            </div>
            <!-- /.card-header -->
            <!-- <div class="card-body" id="tabel-data">
              <table id="tabel-tes" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <td class="w-1">No</td>
                    <td class="w-1">Id</td>
                    <td class="w-25">Role</td>
                    <td class="w-74">Keterangan</td>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>

            </div> -->
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <?php //$this->load->view('role/modal2'); 
    ?>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->