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
      th{
        text-align: left;
      }
      td{
        height: 30px;
      }
    </style>
  </head>
  <body>
    <div>
      <div class="header">
        <h3 class="h3"><b>Laporan Data Bon Roll Polos</b></h3>
        <div class="pull-right">
          <small>Tanggal : <?php echo "$Tanggal"; ?></small>
        </div>
      </div>
      <table>
        <tr>
          <th align="center" width="8%">Tebal</th>
          <th align="center" width="10%">Ukuran</th>
          <th align="center" width="8%">Jumlah</th>
          <th align="center" width="8%">Warna</th>
          <th align="center" width="5%">Roll</th>
          <th align="center" width="13%">Jenis Roll</th>
          <th align="center" width="9%">Jenis Barang</th>
          <th align="center" width="4%">Shift</th>
          <th align="center" width="15%">Status Bon</th>
        </tr>
          <?php foreach ($Data as $arrData) { ?>
            <tr height="15px">
              <td><?php echo $arrData["tebal"]; ?></td>
              <td><?php echo $arrData["hasil_ukuran"]." &nbsp;&nbsp;(".$arrData["merek"].")"; ?></td>
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
              <td><?php echo $arrData["shift"]; ?></td>
              <td><?php echo ($arrData["sts_pengiriman"]=="TRUE" ? "sudah dikirim" : "belum dikirim"); ?></td>
            </tr>
          <?php } ?>
      </table>
    </div>
    <script type="text/javascript">
      window.print();
      window.onafterprint = function () {
                              window.close();
                            }
    </script>
  </body>
</html>
