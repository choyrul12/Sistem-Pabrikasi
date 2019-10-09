<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Produksi Terintegrasi</title>
    <style>
      .header{
        position: relative;
        width: 100%;
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
      <div class="header" style="width: 100%">
        <h3 class="h3"><b>Bon Hasil Jadi Potong</b></h3>
        <div style="float: right;">
          <small>Tanggal : <?php echo date("d F Y",strtotime($this->uri->rsegment(5))); ?></small>
        </div>
      </div>
      <table style="font-size:11pt;" width='100%'>
        <tr>
          <td align="center" width="15%">Merek</td>
          <td align="center" width="7%">Tebal</td>
          <td align="center" width="15%">Ukuran</td>
          <td align="center" width="10%">Warna</td>
          <td align="center" width="15%">Hasil Berat</td>
          <td align="center" width="15%">Hasil Lembar</td>
          <td align="center" width="10%">Gudang</td>
          <td align="center" width="15%">Keterangan</td>
        </tr>
        <?php foreach ($Data as $value) { ?>
          <tr>
          <td align="center" width="7%"><?php echo $value["merek"]; ?></td>
          <td align="center" width="10%"><?php echo $value["tebal"]; ?></td>
          <td align="center" width="10%"><?php echo $value["ukuran"]; ?></td>
          <td align="center" width="10%"><?php echo $value["warna_plastik"]; ?></td>
          <td align="center" width="10%">
            <?php
              if(strpos($value["jumlah_berat"],".00") !== FALSE){
                echo number_format(substr($value["jumlah_berat"],0,strlen($value["jumlah_berat"])-3));
              }else{
                echo number_format($value["jumlah_berat"],1);
              }
            ?>
          </td>
          <td align="center" width="10%"><?php echo $value["jumlah_lembar"]; ?></td>
          <td align="center" width="10%"><?php echo strtolower($value["jns_brg"]); ?></td>
          <td align="center" width="10%"><?php echo $value["customer"]; ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <script type="text/javascript">
        setTimeout(function () {
          window.print();
        }, 500);
        window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
         window.onafterprint = function () {  window.close(); }
    </script>
  </body>
</html>
