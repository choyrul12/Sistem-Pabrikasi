<style>
     .dataTable > thead > tr > td[class*="sort"]::after{display: none}
     .dataTable > thead > tr > th{background-color: #337ab7; color: #FFF;}
</style>
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
        <div class="col-md-3">
          <select class="form-control" id="cmb_pilihan_statistik">
            <option value="#">--Pilihan Statistik--</option>
            <optgroup label="Statistik Per Bulan">
              <option value="L-Stat-Bulanan">Lihat Statistik</option>
            </optgroup>
            <optgroup label="Statistik Per Tanggal">
              <option value="L-Stat-Tanggal">Lihat Statistik</option>
            </optgroup>
            <optgroup label="Rincian Transaksi">
              <option value="R_Trans">Lihat Transaksi</option>
            </optgroup>
          </select>
        </div>
        <div class="col-md-3">
          <div class="input-group date">
            <input class="form-control pull-right" type="text" name="txt_tgl_mulai" id="txt_tgl_mulai" required readonly placeholder="Tanggal Mulai">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="input-group date">
            <input class="form-control pull-right" type="text" name="txt_tgl_akhir" id="txt_tgl_akhir" required readonly placeholder="Tanggal Akhir">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
          </div>
        </div>
        <div class="col-md-1">
          <button type="button" id="btn-lihat-stat" class="btn btn-flat btn-success btn-md btn-block">Lihat</button>
        </div>
      </div>
      <div class="col-md-12">
        <center>
          <h2>
            <?php
              if(empty($CustomerData[0]["nm_perusahaan_update"])){
                echo $CustomerData[0]["nm_perusahaan"];
              }else{
                echo $CustomerData[0]["nm_perusahaan_update"]; 
              }
            ?>
          </h2>
        </center>
        <div id="content-wrapper">
          <table class="table table-striped table-responsive" id="table-global-stat">
            <thead>
              <tr>
                <th rowspan="2" style="vertical-align:middle">No. Order</th>
                <th rowspan="2" style="vertical-align:middle">Tgl. Transaksi</th>
                <th rowspan="2" style="vertical-align:middle">Keterangan</th>
                <th colspan="2"><center>Omset</center></th>
              </tr>
              <tr>
                <td><center>Kg.</center></td>
                <td><center>Lembar</center></td>
              </tr>
            </thead>
          </table>

          <div class="nav-tabs-custom" style="display:none;">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#kaleng-chart" data-toggle="tab" id="btn-chart-kaleng">Kaleng</a></li>
              <li><a href="#bal-chart" data-toggle="tab" id="btn-chart-bal">BAL</a></li>
              <li><a href="#lembar-chart" data-toggle="tab" id="btn-chart-lembar">Lembar</a></li>
              <li class="active"><a href="#kg-chart" data-toggle="tab" id="btn-chart-kg">KG</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Grafik Penjualan</li>
            </ul>

            <div class="tab-content no-padding">
              <div class="chart tab-pane active" id="kg-chart" style="position: relative; height: 300px;">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Statistik Jumlah Pesanan (KG)</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="kg-bar-chart" style="height:230px"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <div class="chart tab-pane" id="lembar-chart" style="position: relative; height: 300px;">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Statistik Jumlah Pesanan (LEMBAR)</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="lembar-bar-chart" style="height:230px"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <div class="chart tab-pane" id="bal-chart" style="position: relative; height: 300px;">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Statistik Jumlah Pesanan (BAL)</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="bal-bar-chart" style="height:230px"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <div class="chart tab-pane" id="kaleng-chart" style="position: relative; height: 300px;">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Statistik Jumlah Pesanan (KALENG)</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="kaleng-bar-chart" style="height:230px"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="nav-tabs-custom" style="display:none;">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#omset-lembar-chart" data-toggle="tab" id="btn-chart-omset-lembar">Lembar</a></li>
              <li class="active"><a href="#omset-kg-chart" data-toggle="tab" id="btn-chart-omset-kg">KG</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Grafik Omset</li>
            </ul>

            <div class="tab-content no-padding">
              <div class="chart tab-pane active" id="omset-kg-chart" style="position: relative; height: 300px;">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Statistik Omset Pesanan (KG)</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="omset-kg-line-chart" style="height:230px"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <div class="chart tab-pane" id="omset-lembar-chart" style="position: relative; height: 300px;">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Statistik Omset Pesanan (LEMBAR)</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="omset-lembar-line-chart" style="height:230px"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>
