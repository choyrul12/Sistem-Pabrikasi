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
        <h3 class="h3"><b>Laporan Bon Apal</b></h3>
        <div class="pull-right">
          <small>Tanggal : <?php echo date("d F Y",strtotime($this->uri->rsegment(3))); ?> - <?php echo date("d F Y",strtotime($this->uri->rsegment(4))); ?></small>
        </div>
      </div>
      <div style="height:85%;">
        <table style="border:0px solid #4a4a4a; font-size:11pt;" width='100%'>
          <tr style="border-bottom:1px solid #4a4a4a;">
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="20%">Tanggal</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="20%">Nama Barang</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="20%">Ukuran</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="20%">Warna</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="20%">Jumlah</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="20%">Keterangan</td>
          </tr>
          <?php
            $total = 0;
            foreach ($Data as $value) {
              $total += floatval($value["jumlah_apal"]);
          ?>
            <tr>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="20%"><?php echo $value["tgl_transaksi"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="20%"><?php echo $value["merek"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="20%"><?php echo $value["ukuran"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="20%"><?php echo $value["warna_plastik"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="20%"><?php echo $value["jumlah_apal"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="20%"><?php echo $value["customer"]; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
      <div style="margin-top:5px;height:5%;">
        <label>Total : <?php echo $total; ?></label>
      </div>
    </div>
  </body>
</html>
