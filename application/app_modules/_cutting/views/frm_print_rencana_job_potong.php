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
      table { border-collapse: collapse; }
      tr { border: none; }
      td{
        height: 50px;
        padding : 15px 0 25px 0;
      }
    </style>
  </head>
  <body>
    <div>
      <div class="header">
        <h3 class="h3" style="font-weight:bold;"><b>Rencana Job Potong</b></h3>
        <div>
          <small style="font-weight:bold;">Tanggal : <?php echo date("d F Y",strtotime($this->uri->rsegment(4))); ?></small>
        </div>
      </div>
      <table style="font-size:11pt;" width='100%'>
        <tr>
          <th align="center" style="font-weight:bold;" width="10%">Nama Barang</th>
          <th align="center" style="font-weight:bold;" width="10%">Ukuran</th>
          <th align="center" style="font-weight:bold;" width="10%">Berat</th>
          <th align="center" style="font-weight:bold;" width="10%">Warna Plastik</th>
          <th align="center" style="font-weight:bold;" width="10%">Hasil Lembar</th>
          <th align="center" style="font-weight:bold;" width="10%">Hasil Berat</th>
          <th align="center" style="font-weight:bold;" width="10%">Apal</th>
          <th align="center" style="font-weight:bold;" width="8%">Pipa</th>
          <th align="center" style="font-weight:bold;" width="10%">Plus / Minus</th>
          <th align="center" style="font-weight:bold;" width="12%">Keterangan</th>
        </tr>
        <?php foreach ($Data as $value) { ?>
          <tr>
            <td align="center" style="font-weight:bold;" width="10%"><?php echo $value["merek"]." (".$value["tebal"].") (".$value["strip"].")"; ?></td>
            <td align="center" style="font-weight:bold;" width="10%"><?php echo $value["ukuran"]." (".$value["no_mesin"].")"; ?></td>
            <td align="center" style="font-weight:bold;" width="10%"></td>
            <td align="center" style="font-weight:bold;" width="10%"><?php echo $value["warna_plastik"]; ?></td>
            <td align="center" style="font-weight:bold;" width="10%"></td>
            <td align="center" style="font-weight:bold;" width="10%"></td>
            <td align="center" style="font-weight:bold;" width="10%"></td>
            <td align="center" style="font-weight:bold;" width="10%"></td>
            <td align="center" style="font-weight:bold;" width="10%"></td>
            <td align="center" style="font-weight:bold;" width="10%"><?php echo $value["customer"]; ?> ( <?php echo $value["berat"]; ?> )</td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <script type="text/javascript">
        window.print();
        window.onafterprint = function () {  window.close(); }
    </script>
  </body>
</html>
