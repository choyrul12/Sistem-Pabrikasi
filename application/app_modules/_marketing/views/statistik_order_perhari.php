<style>
     .dataTable > thead > tr > td[class*="sort"]::after{display: none}
     .dataTable > thead > tr > th{background-color: #337ab7; color: #FFF;}
</style>
<div class="content-wrapper">
  <section class="content-header">
    <p><h1><?php echo $Data['Title']; ?></h1> </p>
    <div class="input-group input-group-sm col-md-3" style="width: 270px; font-size: 14px;">
      <input type="text" class="form-control date" autocomplete="off" id="tgl_awal" placeholder="Pilih Tanggal Awal">
      <input type="text" class="form-control date" autocomplete="off" id="tgl_akhir" placeholder="Pilih Tanggal Akhir">
          <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat" onclick="statisticChartPerHari()" style="height: 60px;"> Cari </button>
          </span>
    </div>
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
  </section>

  <section class="content">
    <div class="nav-tabs-custom" style="cursor: move;">
      <ul class="nav nav-tabs pull-right ui-sortable-handle">
        <li><a href="#CBG" data-toggle="tab"  onclick="changeTitleChart('Cabang')">Cabang</a></li>
        <li><a href="#LK" data-toggle="tab" onclick="changeTitleChart('Luar Kota')">Luar Kota</a></li>
        <li class="active" id="test"><a href="#DK" data-toggle="tab"  onclick="changeTitleChart('Dalam Kota')">Dalam Kota</a></li>
        <li class="pull-left header"><i class="fa fa-inbox"></i> Order <span id="title">Dalam Kota</span> ( <span id="tglTitle"></span> )</li>
      </ul>
      <div class="tab-content padding">
        <div class="chart tab-pane active" id="DK">
          <canvas id="myChart1"></canvas>
        </div>
        <div class="chart tab-pane" id="LK">
          <canvas id="myChart2"></canvas>
        </div>
        <div class="chart tab-pane" id="CBG">
          <canvas id="myChart3"></canvas>
        </div>
      </div>
  </section>
</div>
