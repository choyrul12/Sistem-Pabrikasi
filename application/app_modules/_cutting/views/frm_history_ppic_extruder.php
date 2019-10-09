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
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-md-8">
                <table class="table table-responsive">
                  <tr>
                    <td width="50%">
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbBulan">
                          <option value="">--Pilih Bulan--</option>
                          <?php
                          $arrBulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                          for ($i=1; $i <=12; $i++) {
                            ?>
                            <option value="<?php echo ($i < 10 ? '0'.$i : $i); ?>"><?php echo $arrBulan[$i-1]; ?></option>
                            <?php } ?>
                          </select>
                      </div>
                    </td>
                    <td width="30%">
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbTahun">
                          <option value="">--Pilih Tahun--</option>
                          <?php
                          $last5Years = date("Y",strtotime("-12 years"));
                          for ($i=date("Y"); $i > $last5Years ; $i--) {
                            ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </td>
                    <td width="20%">
                      <button type="button" id="btnCariHistory" class="btn btn-md btn-flat btn-success" onclick="searchListHistoryPpicExtruder();"><i class="fa fa-check"></i> Cari History</button>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableListHistoryPPICExtruder">
                    <thead>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Customer</th>
                      <th>Merek</th>
                      <th>Permintaan</th>
                      <th>Ukuran</th>
                      <th>Warna Plastik</th>
                      <th>Tebal</th>
                      <th>Berat</th>
                      <th>Jumlah Permintaan</th>
                      <th>Sisa</th>
                      <th>Strip</th>
                      <th>Status</th>
                      <th>Gambar</th>
                      <th>Keterangan</th>
                      <th>Diperbarui</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
