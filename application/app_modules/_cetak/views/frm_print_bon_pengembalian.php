<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Produksi Terintegrasi</title>
    <style>
      .header{
        position: relative;
        widtd: 100%;
        float: left;
      }
      .pull-right{
        float: right;
        text-align : right;
        padding-right: 10px;
        margin-bottom: 5px;
      }
      .h3{
        margin: 0;
        padding: 0;
      }
      .col-md-4{
        float: left;
        position: relative;
        width: 200px;
        text-align: left;
      }
      .wrapper{
        position: relative;
        margin-top: 20px;
      }
    </style>
  </head>
  <body>
    <div>
      <div class="header">
        <h3 class="h3"><b>Laporan Bon Pengembalian <?php echo $jenis; ?></b></h3>
        <div class="pull-right">
          <small>Tanggal : <?php echo date("d F Y",strtotime($this->uri->rsegment(3))); ?> - <?php echo date("d F Y",strtotime($this->uri->rsegment(4))); ?></small>
        </div>
      </div>
      <div>
        <table style="border:0px solid #4a4a4a; font-size:11pt;" width='100%'>
          <tr style="border-bottom:1px solid #4a4a4a;">
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Nama Barang</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Ukuran</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Warna</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Jenis <?php echo $jenis; ?></td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Jumlah</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Status Bon</td>
          </tr>
          <?php
            foreach ($Data as $value) {
              $status = ($value["status_bon_sisa"]=="FALSE") ? "BELUM DIKIRIM" : "SUDAH DIKIRIM";
          ?>
            <tr>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo $value["merek"]." (".$value["kd_gd_cetak"].")"; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo $value["ukuran"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo $value["warna_plastik"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo ($value["jenis"]=="CAT CAMPUR" ? $value["warna"] : $value["nm_barang"])." (".$value["kd_gd_bahan"].")"; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo $value["jumlah_pengambilan"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo $status; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </body>
</html>
