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
        <h3 class="h3"><b>Laporan Bon Pengambilan <?php echo $jenis; ?></b></h3>
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
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Berat</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Bobin</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Payung</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Payung Kuning</td>
          </tr>
          <?php
            foreach ($Data as $value) {
              $status = ($value["status_bon"]=="FALSE") ? "BELUM DIKIRIM" : "SUDAH DIKIRIM";
          ?>
            <tr>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo $value["merek"]." (".$value["kd_gd_roll_polos"].")"; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo $value["ukuran"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo $value["warna_plastik"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo $value["jumlah_berat_pengambilan"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo $value["jumlah_bobin_pengambilan"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo $value["jumlah_payung_pengambilan"]; ?></td>
              <td align="center" style="border-bottom:1px solid #4a4a4a; padding-top:3px;" width="10%"><?php echo $value["jumlah_payung_kuning_pengambilan"]; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <script type="text/javascript">
        // setTimeout(function () {
          window.print();
        // }, 500);
        //window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
        window.onafterprint = function () {
                                //setTimeout(function () {
                                  window.close();
                                //}, 500);
                              }
    </script>
  </body>
</html>
