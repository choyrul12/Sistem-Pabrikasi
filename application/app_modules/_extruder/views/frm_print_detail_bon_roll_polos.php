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
        font-weight: bold;
      }
      body{

      }
      table tr td{
        height: 30px;
        font-size: 16px;
        font-family: Arial, Helvetica, sans-serif;
      }
      th{
        text-align: left;
      }
    </style>
  </head>
  <body>
    <div>
      <div class="header">
        <h3 class="h3"><b>Laporan Data Bon Roll Polos (Shift <?php echo $this->uri->rsegment(5); ?>)</b></h3>
        <div>
          <small>Tanggal : <?php echo "$Tanggal"; ?></small>
        </div>
      </div>
      <table width="100%">
        <tr>
          <th>Tebal</th>
          <th>Ukuran</th>
          <th>Jumlah</th>
          <th>Warna</th>
          <th>Roll</th>
          <th>Jenis Roll</th>
          <th>Jenis Barang</th>
        </tr>
          <?php foreach ($Data as $arrData) { ?>
            <tr>
              <td><?php echo $arrData["tebal"]; ?></td>
              <td><?php echo $arrData["hasil_ukuran"]." &nbsp;&nbsp;( ".$arrData["merek"]." )"; ?></td>
              <td>
                <?php
                if(strpos($arrData["jumlah_selesai"],".00") !== FALSE){
                  echo number_format(substr($arrData["jumlah_selesai"],0,strlen($arrData["jumlah_selesai"])-4));
                }else{
                  echo number_format($arrData["jumlah_selesai"],1);
                }
                ?>
              </td>
              <td><?php echo $arrData["warna_plastik"]; ?></td>
              <td><?php echo $arrData["roll_lembar"]; ?></td>
              <td><?php echo ($arrData["jenis_roll"]=="PAYUNG_KUNING" ? "payung kuning" : strtolower($arrData["jenis_roll"])); ?></td>
              <td><?php echo strtolower($arrData["jns_brg"]); ?></td>
            </tr>
          <?php } ?>
      </table>
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
