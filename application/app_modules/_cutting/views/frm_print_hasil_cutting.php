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
      td{
        padding-top: 30px;
        text-align: left;
      }
    </style>
  </head>
  <body>
    <div>
      <div class="header" style="width: 100%;">
        <h3 class="h3"><b>Hasil Job Potong</b></h3>
        <div class="pull-right">
          <small>Tanggal : <?php echo date("d F Y",strtotime($this->uri->rsegment(4))); ?></small>
        </div>
      </div>
      <table style="font-size:12pt; font-family: Arial;" width='100%'>
        <tr style="border: 1px solid;">
          <td align="center" width="5%">No. Mesin</td>
          <td align="center" width="10%">Customer</td>
          <td align="center" width="10%">Merek</td>
          <td align="center" width="15%">Ukuran</td>
          <td align="center" width="5%">Warna Plastik</td>
          <td align="center" width="5%">Permintaan</td>
          <td align="center" width="10%">Total Lembar</td>
          <td align="center" width="10%">Total Berat (Bersih)</td>
          <td align="center" width="10%">Total Berat (Kotor)</td>
          <td align="center" width="5%">Total Apal</td>
          <td align="center" width="10%">Total Pipa</td>
          <td align="center" width="11%">Hasil (Lembar)</td>
          <td align="center" width="8%">Hasil (Berat)</td>
          <td align="center" width="5%">Berat</td>
          <td align="center" width="5%">Gudang</td>
        </tr>
        <?php foreach ($Data as $value) { ?>
          <tr>
          <td align="center" width="7%"><?php echo $value["no_mesin"]; ?></td>
          <td align="center" width="10%"><?php echo $value["customer"]; ?></td>
          <td align="center" width="10%"><?php echo $value["merek"]; ?></td>
          <td align="center" width="10%"><?php echo $value["ukuran"]; ?></td>
          <td align="center" width="10%"><?php echo $value["warna_plastik"]; ?></td>
          <td align="center" width="10%"><?php echo strtolower($value["jns_permintaan"]); ?></td>
          <td align="center" width="10%"><?php echo $value["hasil_lembar"]; ?></td>
          <td align="center" width="10%"><?php echo $value["hasil_berat_bersih"]; ?></td>
          <td align="center" width="10%"><?php echo $value["hasil_berat_kotor"]; ?></td>
          <td align="center" width="10%"><?php echo $value["jumlah_apal_global"]; ?></td>
          <td align="center" width="10%"><?php echo round($value["jumlah_roll_pipa"]); ?></td>
          <td align="center" width="10%"><?php echo $value["jumlah_lembar"]; ?></td>
          <td align="center" width="10%"><?php echo $value["jumlah_berat"]; ?></td>
          <td align="center" width="10%"><?php echo $value["berat"]; ?></td>
          <td align="center" width="10%"><?php echo strtolower($value["jns_brg"]); ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </body>
  <script type="text/javascript">
      setTimeout(function () {
        window.print();
      }, 500);
      window.onfocus = function () { window.close();}
      window.onafterprint = function () {  window.close(); }
  </script>
</html>
