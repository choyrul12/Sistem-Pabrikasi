<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?></h1>
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-success">
        <div class="box-header">

        </div>
        <div class="box-body">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#roll-polos" data-toggle="tab">Stok Barang Polos</a></li>
              <li><a href="#roll-cetak" data-toggle="tab">Stok Barang Cetak</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Cek Stok Barang Roll</li>
            </ul>
            <div class="tab-content no-padding">
              <div class="chart tab-pane active" id="roll-polos">
                <div class="box box-warning">
                  <div class="box-header">
                    <button class="btn btn-flat btn-md btn-primary" data-toggle="modal" data-target="#modal-check-roll" onclick="modalCariHistoryRoll('POLOS')">
                      <span class="fa fa-search"></span>&nbsp;
                      Detail Histori Keluar Masuk Barang (Polos)
                    </button>
                  </div>
                  <div class="box-body">
                    <table class="table table-responsive table-striped" id="table-stok-polos">
                      <thead>
                        <th>Kode Barang</th>
                        <th>Warna</th>
                        <th>Ukuran</th>
                        <th>Tebal</th>
                        <th>Stok</th>
                        <th>Bobin</th>
                        <th>Payung</th>
                        <th>Merek</th>
                        <th>Jenis Barang</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
              <div class="chart tab-pane" id="roll-cetak">
                <div class="box box-info">
                  <div class="box-header">
                    <button class="btn btn-flat btn-md btn-primary" data-toggle="modal" data-target="#modal-check-roll" onclick="modalCariHistoryRoll('CETAK')">
                      <span class="fa fa-search"></span>&nbsp;
                      Detail Histori Keluar Masuk Barang (Cetak)
                    </button>
                  </div>
                  <div class="box-body">
                    <table class="table table-responsive table-striped" id="table-stok-cetak">
                      <thead>
                        <th>Kode Barang</th>
                        <th>Warna</th>
                        <th>Ukuran</th>
                        <th>Tebal</th>
                        <th>Stok</th>
                        <th>Bobin</th>
                        <th>Payung</th>
                        <th>Merek</th>
                        <th>Jenis Barang</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-check-roll" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal" data-target="#modal-check-roll">&times;</button>
              <div class="modal-title">
                <h3 class="text-primary">Pilih Periode History</h3>
              </div>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="form-group">
                  <div class="col-md-6">
                    <div class="input-group date">
                      <input class="form-control" type="text" id="txt_tgl_awal" required readonly placeholder="Tanggal Awal">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="input-group date">
                      <input class="form-control" type="text" id="txt_tgl_akhir" required readonly placeholder="Tanggal Akhir">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12" style="margin-top : 10px;">
                    <select class="form-control" id="cmb-barang-roll" required></select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-flat btn-md btn-success" id="btn-check-roll">Cari History</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
