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
    </style>
  </head>
  <body>
    <div>
      <div class="header">
        <div style="float:left; width:50%;">
          <table width="100%">
            <tr>
              <td width="20%">Tanggal</td>
              <td width="2%">:</td>
              <td><?php echo date("d-M-Y", strtotime($Pesanan[0]["tgl_pesan"])); ?></td>
            </tr>
            <tr>
              <td>Nama Pemesan</td>
              <td>:</td>
              <td><?php echo $Pesanan[0]["nm_pemesan"]; ?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td><?php echo $Pesanan[0]["alamat"]; ?></td>
            </tr>
          </table>
        </div>
        <div style="float:left; width:50%;">
          <table width="100%">
            <tr>
              <td width="20%">No. PO</td>
              <td width="2%">:</td>
              <td><?php echo $Pesanan[0]["no_po"]; ?> ( <?php echo $Pesanan[0]["no_order"]; ?> )</td>
            </tr>
            <tr>
              <td>Telp.</td>
              <td>:</td>
              <td><?php echo $Pesanan[0]["hp_purchasing"]; ?> / <?php echo $Pesanan[0]["tlp_kantor"]; ?> / <?php echo $Pesanan[0]["tlp_lainnya"]; ?></td>
            </tr>
          </table>
        </div>
      </div>
      <table width='100%' style="margin-top:20px">
        <tr style="border:1px solid #4a4a4a;">
          <td align="center" style="border:1px solid #4a4a4a;" width="10%" rowspan="2">Jumlah Order</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="20%" colspan="2">Ukuran</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="10%" rowspan="2">Merek</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="20%" colspan="2">Warna</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="20%" colspan="2">Atas Klip</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="10%" rowspan="2">Note</td>
        </tr>
        <tr>
          <td align="center" style="border:1px solid #4a4a4a;" width="5%">Panjang</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="8%">Lebar</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="10%">Plastik</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="10%">Cetak</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="10%">Strip</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="10%">DLL</td>
        </tr>
        <?php foreach ($PesananDetail as $value) {
          $arrUkuran = explode("x",$value["ukuran"]);
        ?>
          <tr>
            <td align="center" style="border:1px solid #4a4a4a;" width="10%"><?php echo $value["jumlah"]; ?></td>
            <td align="center" style="border:1px solid #4a4a4a;" width="10%"><?php echo $arrUkuran[0]; ?></td>
            <td align="center" style="border:1px solid #4a4a4a;" width="10%"><?php echo $arrUkuran[1]; ?></td>
            <td align="center" style="border:1px solid #4a4a4a;" width="10%"><?php echo $value["merek"]; ?></td>
            <td align="center" style="border:1px solid #4a4a4a;" width="10%"><?php echo (empty($value["kd_gd_hasil"]) ? $value["warna"] : $value["warna_plastik"]); ?></td>
            <td align="center" style="border:1px solid #4a4a4a;" width="10%"><?php echo $value["warna_cetak"]; ?></td>
            <td align="center" style="border:1px solid #4a4a4a;" width="10%"><?php echo $value["sm"]; ?></td>
            <td align="center" style="border:1px solid #4a4a4a;" width="10%"><?php echo $value["dll"]; ?></td>
            <td align="center" style="border:1px solid #4a4a4a;" width="10%"><?php echo $value["keterangan"]; ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </body>
</html>
