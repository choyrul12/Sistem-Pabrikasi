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
      <div class="box box-warning">
        <div class="box-header with-border">
          <div class="col-md-4">
            <button type="button" class="btn btn-md btn-primary btn-flat btn-block" data-toggle="modal" data-target="#modalSearchHistoryPpicExtruder"><span class="fa fa-search"></span> Cari History PPIC Extruder</button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-responsive table-striped" id="tableListHistoryPpicExtruder">
                <thead>
                  <th>Kode SPK</th>
                  <th>Tgl. Permintaan</th>
                  <th>Customer</th>
                  <th>Permintaan</th>
                  <th>Ukuran</th>
                  <th>Warna Plastik</th>
                  <th>Tebal</th>
                  <th>Merek</th>
                  <th>Ket.Merek</th>
                  <th>Berat</th>
                  <th>Jumlah Permintaan</th>
                  <th>Sisa</th>
                  <th>Strip</th>
                  <th>Keterangan</th>
                  <th>Status Pengerjaan</th>
                  <th>Diperbarui</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalSearchHistoryPpicExtruder" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="##modalSearchHistoryPpicExtruder">&times;</button>
              <h4 class="modal-title text-blue">Cari History PPIC Extruder</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Pilih Bulan</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbBulan">
                        <option value="01"> Januari</option>
                        <option value="02"> Februari</option>
                        <option value="03"> Maret</option>
                        <option value="04"> April</option>
                        <option value="05"> Mei</option>
                        <option value="06"> Juni</option>
                        <option value="07"> July</option>
                        <option value="08"> Agustus</option>
                        <option value="09"> September</option>
                        <option value="10"> Oktober</option>
                        <option value="11"> November</option>
                        <option value="12"> Desember</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Pilih Tahun</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbTahun">
                        <?php
                          for ($i=date('Y'); $i >= date("Y")-32; $i--) {
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnCari" class="btn btn-flat btn-md btn-primary pull-right" onclick="cariHistoryPpic('EXTRUDER')">Cari</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
