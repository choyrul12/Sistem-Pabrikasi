<?php
$cnFlag = 0;
$potonganFlag = 0;
foreach ($arrDataPesananDetail as $arrData) {
  if(!empty($arrData["cn"])){
    $cnFlag++;
  }
  if($arrData["potongan"]>0 || $arrData["diskon"]>0){
    $potonganFlag++;
  }
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Faktur Pesanan Dengan No. Order : <?php echo $this->uri->rsegment(3); ?></title>
    <style>
    body{
      font-family: times;
    }
      .col-md-6{
        width: 49.99%;
        height: auto;
        float: left;
        margin: 0;
        padding: 0;
        /* border: 1px solid #000; */
      }
      .col-md-12{
        width: 100%;
        height: auto;
        float: left;
        margin: 0;
        padding: 0;
        /* border: 1px solid #000; */
      }
      .col-md-11 {
        width: 91.66666667%;
        height: auto;
        float: left;
        position: relative;
        margin: 0;
        padding: 0;
      }
      .col-md-10 {
        width: 80%;
        height: auto;
        float: left;
        position: relative;
        margin: 0;
        padding: 0;
      }
      .col-md-9{
        width: 75%;
        height: auto;
        float: left;
        position: relative;
        margin: 0;
        padding: 0;
        /* border: 1px solid #000; */
      }
      .col-md-3{
        width: 24.8%;
        height: auto;
        float: left;
        position: relative;
        margin: 0;
        padding: 0;
      }
      .col-md-4{
        width: 33.333%;
        height: auto;
        float: left;
        position: relative;
        margin: 0;
        padding: 0;
      }
      .col-md-2 {
        width: 19.666%;
        height: auto;
        float: left;
        position: relative;
        margin: 0;
        padding: 0;
      }
      .img{
        position: absolute;
        top: 0;
        right: 0;
        width: 40px;
        height: 40px;
      }
      .company-name{
        position: absolute;
        top: 0;
        left: 1;
        height:10px;
        font-size: 12px;
        font-weight: bold;
      }
      .address{
        position: absolute;
        font-size: 9px;
      }
      .text-wrapper{
        position: relative;
        float: left;
        width: 80%;
        margin-top: 10px;
      }
      .img-wrapper{
        position: relative;
        float: left;
        width: 13%;
      }
      hr{
        margin: 5px 0 5px  0;
        padding: 0;
      }
      .table-pesanan tr td{
        border: 1px solid #CCC;
        font-size: 11px;
      }
      .table-pesanan tr th{
        border: 1px solid #CCC;
        font-size: 11px;
        font-weight: bold;
      }
      .rounded-rect{
        height: 100%;
        border: 1px solid #000;
        border-radius: 10px;
        margin-left: 5px;
        position: relative;
        padding: 3px;
      }

      .content-wrapper{
        float: left;
        /* border: 1px solid #000; */
        height: 420px;
        /* page-break-inside:avoid !important; */
      }
      .signature-wrapper{
        float: left;
        position: relative;
        width: 100%;
        height: 50px;
        border: 1px solid #000;
        border-radius: 10px;
      }
      .signature{
        padding-top: 40px;
        padding-left: 5px;
        padding-right: 5px;
        padding-bottom: 0;
        width: 100%;
        margin: 0;
        /* border: 1 solid #000; */
      }
      ul {
        margin: 12px;
        padding: 0;
        font-size: 10px;
      }
    </style>
  </head>
  <body>
    <div class="col-md-6">
      <div class="img-wrapper">
        <img src="assets/images/LOGO_KLIP_PLASTIK.jpg" class="img" alt="" width="40px" height="40px">
      </div>
      <div class="text-wrapper">
        <div class="company-name">PT. KLIP PLASTIK</div>
        <div class="address">
          Jl. Yos Sudarso No. 115 A (Daan Mogot Km. 19) Batu Ceper, Tangerang
          Telp.: 5518899 (Hunting), 5404656, 5404657 Fax : 5539999 <br>
          Homepage : http://www.klipplastik.co.id <br>
          Email : sales@klipplastik.co.id
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="col-md-6">
        <h5 style="border: 1px solid #000; padding:3px 5px 3px 5px; text-align:center; margin:0;">SURAT PESANAN</h5>
        <h6 style="margin:0; margin-top:3px; text-align:center;"><?php echo $arrDataPesanan[0]["no_order"]." ".$arrDataPesanan[0]["pajak"]." ".$arrDataPesanan[0]["jns_order"]; ?></h6>
      </div>
      <div class="col-md-6">
        <h6 style="margin-left:5px;">KETERANGAN : </h6>
        <div class="address" style="margin-left:5px;">
          Setiap order selalu ada toleransi ukuran dan jumlah pesanan.<br>
          Approval : <?php echo $arrDataPesanan[0]["proof"]; ?> <?php echo "(".$arrDataPesanan[0]["ket_proof"].")"; ?>
        </div>
      </div>
    </div>
    <hr>
    <div class="col-md-10">
      <div class="content-wrapper">
        <table width="100%" class="table-pesanan">
          <tr>
            <td width="18%">TANGGAL</td>
            <td width="1%">:</td>
            <td><?php echo $arrDataPesanan[0]["tgl_pesan"]; ?></td>
            <td width="10%">No. PO</td>
            <td width="1%">:</td>
            <td width="25%"><?php echo $arrDataPesanan[0]["no_po"]; ?></td>
          </tr>
          <tr>
            <td>NAMA PEMESAN</td>
            <td>:</td>
            <td><?php echo $arrDataPesanan[0]["nm_perusahaan"]; ?></td>
            <td>Telp.</td>
            <td>:</td>
            <td><?php echo $arrDataPesanan[0]["tlp_kantor"]; ?></td>
          </tr>
          <tr>
            <td>ALAMAT</td>
            <td>:</td>
            <td colspan="4"><?php echo $arrDataPesanan[0]["alamat"]; ?></td>
          </tr>
        </table>

        <table class="table-pesanan" style="margin-top:5px;" width="100%">
          <thead>
            <tr>
              <th rowspan="2" width="7%"><center>QTY</center></th>
              <th rowspan="2" width="8%"><center>SATUAN</center></th>
              <th colspan="2"><center>UKURAN</center></th>
              <th rowspan="2" width="13%"><center>MEREK</center></th>
              <th rowspan="2" width="10%"><center>NAMA PRODUK</center></th>
              <th rowspan="2"><center>HARGA <br>( <?php echo $arrDataPesanan[0]["mata_uang"]; ?> )</center></th>
              <?php
              if($cnFlag > 0){
                echo "<th rowspan='2'><center>CN</center></th>";
              }
              if($potonganFlag > 0){
                echo "<th colspan='2'><center>POTONGAN</center></th>";
              }
              ?>
              <th colspan="4"><center>WARNA</center></th>
              <th colspan="2"><center>OMSET</center></th>
            </tr>
            <tr>
              <th width="5%"><center>P</center></th>
              <th width="5%"><center>L</center></th>
              <?php
              if($potonganFlag > 0){
                echo "<th><center>".$arrDataPesanan[0]["mata_uang"]."</center></th>
                      <th><center>Disc.</center></th>";
              }
              ?>
              <th width="10%"><center>PLSTK</center></th>
              <th><center>CETAK</center></th>
              <th><center>STRIP</center></th>
              <th><center>DLL</center></th>
              <th><center>KG.</center></th>
              <th><center>LMBR.</center></th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($arrDataPesananDetail as $arrData):
                if(strpos($arrData["ukuran"],"/") !== FALSE){
                  $arrUkuran = explode("/",$arrData["ukuran"]);
                  $arrUkuranPrimer = explode("x",strtolower($arrUkuran[0]));
                  $arrUkuranSekunder = explode("x",strtolower($arrUkuran[1]));
                  $panjang = "<u>".$arrUkuranPrimer[0]."</u><br>".$arrUkuranSekunder[0];
                  $lebar = "<u>".$arrUkuranPrimer[1]."</u><br>".$arrUkuranSekunder[1];
                }else{
                  $arrUkuran = explode("x",strtolower($arrData["ukuran"]));
                  $panjang = $arrUkuran[0];
                  $lebar = $arrUkuran[1];
                }
            ?>
              <tr>
                <td>
                  <center>
                    <?php
                    if(strpos($arrData["jumlah"],'.0') !== FALSE){
                      echo substr($arrData["jumlah"],0,strlen($arrData["jumlah"])-2);
                    }else{
                      echo $arrData["jumlah"];
                    }
                    ?>
                  </center>
                </td>
                <td><center><?php echo $arrData["satuan"]; ?></center></td>
                <td><center><?php echo $panjang; ?></center></td>
                <td><center><?php echo $lebar; ?></center></td>
                <td><center><?php echo $arrData["merek"]; ?></center></td>
                <td><center><?php echo $arrData["merekProduk"]; ?></center></td>
                <td>
                  <center>
                    <?php
                      if(substr($arrData["harga"],strlen($arrData["harga"])-2, 2) == ".0"){
                        echo number_format(substr($arrData["harga"],0,strlen($arrData["harga"])-3));
                      }else{
                        echo number_format($arrData["harga"],2);
                      }
                    ?>
                  </center>
                </td>
                <?php
                if($cnFlag > 0){
                  // if(substr($arrData["cn"],strlen($arrData["cn"])-2, 2) == ".0"){
                  //   echo "<td><center>".number_format(substr($arrData["cn"],0,strlen($arrData["cn"])-3))."</center></td>";
                  // }else{
                    echo "<td><center>".$arrData["cn"]."</center></td>";
                  // }
                }
                if($potonganFlag > 0){
                  if(substr($arrData["potong"],strlen($arrData["potong"])-2, 2) == ".0" || substr($arrData["diskon"],strlen($arrData["diskon"])-2, 2) == ".0"){
                    echo "<td><center>".number_format(substr($arrData["potong"],0,strlen($arrData["potong"])-3))."</center></td>";
                    echo "<td><center>".number_format(substr($arrData["diskon"],0,strlen($arrData["diskon"])-3))."</center></td>";
                  }else{
                    echo "<td><center>".number_format($arrData["potong"],2)."</center></td>";
                    echo "<td><center>".number_format($arrData["diskon"],2)."</center></td>";
                  }
                }
                ?>
                <td><center><?php echo $arrData["warna_plastik"]; ?></center></td>
                <td><center><?php echo $arrData["warna_cetak"]; ?></center></td>
                <td><center><?php echo $arrData["sm"]; ?></center></td>
                <td><center><?php echo $arrData["dll"]; ?></center></td>
                <td>
                  <center>
                    <?php
                    $arrOmset = explode("=",$arrData["omset"]);
                      if(strpos($arrOmset[0],".00") !== FALSE){
                        echo substr($arrOmset[0],0,strlen($arrOmset[0])-3);
                      }else{
                        if(substr($arrOmset[0],strlen($arrOmset[0])-1,1) == "0"){
                          echo substr($arrOmset[0],0,strlen($arrOmset[0])-1);
                        }else{
                          echo $arrOmset[0];
                        }
                      }
                    ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php
                    if(strpos($arrOmset[1],".00") !== FALSE){
                      echo substr($arrOmset[1],0,strlen($arrOmset[1])-3);
                    }else{
                      if(substr($arrOmset[1],strlen($arrOmset[0])-1,1) == "0"){
                        echo substr($arrOmset[1],0,strlen($arrOmset[1])-1);
                      }else{
                        echo $arrOmset[1];
                      }
                    }
                    ?>
                  </center>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="col-md-12">
        <div class="col-md-6">
          <table border="1" width="100%" class="table-pesanan">
            <tr>
              <td style="height:20px; border:0;" width="35%">Uang Muka. </td>
              <td style="height:20px; border:0;" width="1%">:</td>
              <td style="height:20px; border:0; padding-left:5px;">
                <p><?php echo $arrDataPesanan[0]["mata_uang"]." ".$arrDataPesanan[0]["dp"]; ?></p>
              </td>
            </tr>
          </table>
          <p style="font-size:9px; width:75%;">(Uang muka tidak dapat dikembalikan apabila order dibatalkan oleh pemesan).</p>
        </div>
        <div class="col-md-6">
          <table border="1" width="100%" class="table-pesanan">
            <tr>
              <td style="height:20px; border:0;" width="35%">Tgl. Penyerahan</td>
              <td style="height:20px; border:0;" width="1%">:</td>
              <td style="height:20px; border:0; padding-left:5px;">
                <p><?php echo $arrDataPesanan[0]["tgl_estimasi"]; ?></p>
              </td>
            </tr>
            <tr>
              <td style="height:20px; border:0;">Syarat Pembayaran</td>
              <td style="height:20px; border:0;">:</td>
              <td style="height:20px; border:0; padding-left:5px;">
                <p><?php echo $arrDataPesanan[0]["payment_method"]; ?></p>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-12">
        <div class="signature-wrapper">
          <div class="col-md-4">
            <div class="signature">
              <hr style="margin:0; padding:0;">
              <p style="font-size:10px; font-weight:bold; padding:0; margin:0; text-align:center;">
                <?php echo $arrDataPesanan[0]["nm_pemesan"]; ?>
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <p></p>
          </div>
          <div class="col-md-4">
            <div class="signature">
              <hr style="margin:0; padding:0;">
              <p style="font-size:10px; font-weight:bold; padding:0; margin:0; text-align:center;">
                Salesman ( <?php echo $arrDataPesanan[0]["sales"]; ?> )
              </p>
            </div>
          </div>
        </div>
        <p style="font-size:9px; margin:0;">Uang muka harap ditulis jika tidak ditanggung sepenuhnya oleh pemesan</p>
      </div>
    </div>
    <div class="col-md-2">
      <div class="rounded-rect">
          <p style="text-align:center; margin:0; padding:0; font-size:11px; text-decoration:underline;">Expedisi</p>
          <p style="font-size:10px; margin:0; padding:0;">
            <?php echo $arrDataPesanan[0]["expedisi"]; ?>
          </p>
          <?php
            if(empty($arrDataPesanan[0]["foto_1"]) && empty($arrDataPesanan[0]["foto_2"])){
          ?>
            <div style="width:100px; height:120px; margin-top:10px;">
              <a href="assets/images/klip.jpg" target="_blank">
                <img src='assets/images/klip.jpg'>
              </a>
            </div>
          <?php
            }else{
              if(!empty($arrDataPesanan[0]["foto_1"])){
          ?>
          <div style="width:100px; height:120px; margin-top:10px;">
            <a href='assets/images/upload/<?php echo $arrDataPesanan[0]["foto_1"]; ?>' target="_blank">
              <img src='assets/images/upload/<?php echo $arrDataPesanan[0]["foto_1"]; ?>'>
            </a>
          </div>
          <?php
              }else{
          ?>
          <div style="width:100px; height:120px; margin-top:10px;">
            <a href='assets/images/upload/<?php echo $arrDataPesanan[0]["foto_2"]; ?>'>
              <img src='assets/images/upload/<?php echo $arrDataPesanan[0]["foto_2"]; ?>'>
            </a>
          </div>
          <?php
              }
            }
          ?>
          <div style="margin:0; margin-top:10px; padding:0; font-size:10px;">
            <?php echo $arrDataPesanan[0]["note"]; ?>
          </div>
      </div>
    </div>
  </body>
</html>
