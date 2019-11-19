<!-- -----------------------------------------Content Header -------------------------------
-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Starter Page</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- 
----------------------------------------/Content Header--------------------------------
-->

  <!-- 
-----------------------------------------Main Content----------------------------------
-->
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Modal Examples
              </h3>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                Launch Default Modal
              </button>

              <br />
              <br />
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-sm">
                Launch Small Modal
              </button>
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                Launch Large Modal
              </button>
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-xl">
                Launch Extra Large Modal
              </button>
              <br />
              <br />
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-overlay">
                Launch Modal with Overlay
              </button>
              <div class="text-muted mt-3">
                Instructions for how to use modals are available on the
                <a href="http://getbootstrap.com/javascript/#modals">Bootstrap documentation</a>
              </div>
            </div>
            <!-- /.card -->
          </div>

        </div>





      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->

    <div class="modal fade" id="modal-default" role="dialog">
      <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
          <div class="modal-content card">
            <div class="modal-header card-header bg-gradient-light">
              <h5 class="modal-title card-title">Default Modal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-institusi" class="form-horizontal">
              <div class="modal-body card-body">
                <div class="form-group">
                  <label for="institusi" class="control-label">Institusi</label>
                  <div>
                    <input type="hidden" id="id" name="id">
                    <input type="text" name="institusi" class="form-control" id="institusi" autocomplete="off" placeholder="Nama Institusi">
                    <span id="institusi_error" class="text-danger"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="keterangan" class="control-label">Keterangan</label>
                  <div>
                    <input type="text" name="keterangan" class="form-control" id="keterangan" autocomplete="off" placeholder="Keterangan">
                    <span id="keterangan_error" class="text-danger"></span>
                  </div>
                </div>
              </div>
              <div class="modal-footer card-footer">
                <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>
    <!-- /.modal -->

  </div>
  <!-- /.content -->

  <!-- 
-----------------------------------------/Main Content -------------------------------
-->
</div>
<!-- /.content-wrapper