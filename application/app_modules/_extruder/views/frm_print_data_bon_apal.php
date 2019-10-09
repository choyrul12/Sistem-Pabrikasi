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
        height: 25px;
      }
      th{
        text-align: left;
      }
    </style>
  </head>
  <body>
    <div>
      <div class="header">
        <h3 class="h3"><b>Laporan Data Bon Apal Extruder</b></h3>
        <div class="pull-right">
          <small>Tanggal : <?php echo "$Tanggal"; ?></small>
        </div>
      </div>
      <table width="100%">
        <tr>
          <th align="center">Warna</th>
          <th align="center">Jumlah</th>
          <th align="center">Shift</th>
        </tr>
          <?php
          $totalApal = 0;
          foreach ($Data as $arrData) {
            $totalApal += floatval($arrData["jumlah_apal"]);
          ?>
            <tr>
              <td><?php echo $arrData["warna"]; ?></td>
              <td>
                <?php
                if(strpos($arrData["jumlah_apal"],".00") !== FALSE){
                  echo number_format(substr($arrData["jumlah_apal"],0,strlen($arrData["jumlah_apal"])-3));
                }else{
                  echo number_format($arrData["jumlah_apal"],1);
                }
                  // echo $arrData["jumlah_apal"];
                ?>
              </td>
              <td><?php echo $arrData["shift"]; ?></td>
            </tr>
          <?php } ?>
      </table>
      <h4>Total Apal : <?php echo $totalApal; ?></h4>
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
