<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Produksi Terintegrasi</title>
    <style>
	table{
		font-size:12px;
	}
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
	table{
		border-collapse: collapse;
	}
	th, td {
   	  border: 1px solid black;
	}
    </style>
  </head>
  <body>
    <div>
      <div class="header">
        <div style="float:left; width:50%; border:0;">
          <table width="100%" style="border:0;">
            <tr>
              <td width="20%" style="border:0;">Tanggal</td>
              <td width="2%" style="border:0;">:</td>
              <td style="border:0;"><?php echo date("d-M-Y", strtotime($Pesanan[0]["tgl_pesan"])); ?></td>
            </tr>
            <tr>
              <td style="border:0;">Nama Pemesan</td>
              <td style="border:0;">:</td>
              <td style="border:0;"><?php echo $Pesanan[0]["nm_pemesan"]; ?></td>
            </tr>
            <tr>
              <td style="border:0;">Alamat</td>
              <td style="border:0;">:</td>
              <td style="border:0;"><?php echo $Pesanan[0]["alamat"]; ?></td>
            </tr>
          </table>
        </div>
        <div style="float:left; width:50%;">
          <table width="100%">
            <tr>
              <td width="20%" style="border:0;">No. PO</td>
              <td width="2%" style="border:0;">:</td>
              <td style="border:0;"><?php echo $Pesanan[0]["no_po"]; ?> ( <?php echo $Pesanan[0]["no_order"]; ?> )</td>
            </tr>
            <tr>
              <td style="border:0;">Telp.</td>
              <td style="border:0;">:</td>
              <td style="border:0;"><?php echo $Pesanan[0]["hp_purchasing"]; ?> / <?php echo $Pesanan[0]["tlp_kantor"]; ?> / <?php echo $Pesanan[0]["tlp_lainnya"]; ?></td>
            </tr>
          </table>
        </div>
      </div>
      <table width='100%' id="table" style="margin-top:20px">
        <tr>
          <td align="center" rowspan="2">Jumlah Order</td>
          <td align="center" colspan="2">Ukuran</td>
          <td align="center" rowspan="2">Merek</td>
          <td align="center" colspan="2">Warna</td>
          <td align="center" colspan="2">Atas Klip</td>
          <td align="center" rowspan="2">Note</td>
        </tr>
        <tr>
          <td align="center">Panjang</td>
          <td align="center">Lebar</td>
          <td align="center">Plastik</td>
          <td align="center">Cetak</td>
          <td align="center">Strip</td>
          <td align="center">DLL</td>
        </tr>
        <?php foreach ($PesananDetail as $value) {
          $arrUkuran = explode("x",$value["ukuran"]);
        ?>
          <tr>
            <td align="center">
              <?php
              if(strpos($value["jumlah"],'.00') !== FALSE){
                echo substr($value["jumlah"],0,strlen($value["jumlah"])-3)." ".$value["satuan"];
              }else{
                echo $value["jumlah"]." ".$value["satuan"];
              }
              ?>
            </td>
            <td align="center"><?php echo $arrUkuran[0]; ?></td>
            <td align="center"><?php echo $arrUkuran[1]; ?></td>
            <td align="center"><?php echo $value["merek"]; ?></td>
            <td align="center"><?php echo (empty($value["kd_gd_hasil"]) ? $value["warna"] : $value["warna_plastik"]); ?></td>
            <td align="center"><?php echo $value["warna_cetak"]; ?></td>
            <td align="center"><?php echo $value["sm"]; ?></td>
            <td align="center"><?php echo $value["dll"]; ?></td>
            <td align="center"><?php echo $value["keterangan"]; ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </body>
</html>
