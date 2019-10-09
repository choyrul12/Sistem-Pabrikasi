<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Produksi Terintegrasi</title>
    <style>
    	table{
    		font-size:14px;
    	}
      .header{
        position: relative;
        width: 100%;
        float: left;
        margin-bottom: 20px;
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
      .img-wrapper{
        position: relative;
        float: left;
        width: 15%;
      }
      .col-md-6{
        width: 50%;
        height: auto;
        float: left;
        margin: 0;
        padding: 0;
        /* border: 1px solid #000; */
      }
      .address{
        position: absolute;
        top: 5;
        font-size: 12px;
      }
      .text-wrapper{
        position: relative;
        float: left;
        width: 80%;
        margin-top: 10px;
      }
      .company-name{
        position: absolute;
        top: -10;
        left: 1;
        height:10px;
        font-size: 14px;
        font-weight: bold;
      }
    </style>
  </head>
  <body>
    <div>
      <div class="header">
        <div class="col-md-6">
          <div class="img-wrapper">
            <img src="<?php echo base_url('assets/images/LOGO_KLIP_PLASTIK.jpg'); ?>" class="img" alt="" width="40px" height="40px">
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
        <center>
          <h3>Bon Permintaan Barang</h3>
        </center>
        <div style="float:left; width:50%; border:0; margin-top : 50px;">
          <table width="100%" style="border:0;">
            <tr>
              <td width="20%" style="border:0;">No.Bon</td>
              <td width="2%" style="border:0;">:</td>
              <td style="border:0;"><?php echo $DataPermintaan[0]["kd_permintaan_barang"]; ?></td>
            </tr>
            <tr>
              <td style="border:0;">Tanggal</td>
              <td style="border:0;">:</td>
              <td style="border:0;"><?php echo date("d F Y",strtotime($DataPermintaan[0]["tgl_permintaan"])); ?></td>
            </tr>
            <tr>
              <td style="border:0;">Bagian</td>
              <td style="border:0;">:</td>
              <td style="border:0;"><?php echo str_replace("_"," ",$DataPermintaan[0]["bagian"]); ?></td>
            </tr>
          </table>
        </div>
        <!-- <div style="float:left; width:50%;">
          <table width="100%">
            <tr>
              <td width="20%" style="border:0;">No. PO</td>
              <td width="2%" style="border:0;">:</td>
              <td style="border:0;"></td>
            </tr>
            <tr>
              <td style="border:0;">Telp.</td>
              <td style="border:0;">:</td>
              <td style="border:0;"></td>
            </tr>
          </table>
        </div> -->
      </div>
      <table width='100%' id="table">
        <thead>
          <th align="center">No.</th>
          <th align="center">Nama Barang</th>
          <th align="center">Warna</th>
          <th align="center">QTY</th>
          <th align="center">Keterangan</th>
        </thead>
        <tbody>
          <?php
            $no = 1;
            foreach ($DataDetailPermintaan as $arrValue) {
          ?>
          <tr>
            <td><center><?php echo $no++; ?></center></td>
            <td><center><?php echo $arrValue["nm_barang"]; ?></center></td>
            <td><center><?php echo $arrValue["warna"]; ?></center></td>
            <td>
              <center>
                <?php
                  if(strpos($arrValue["jumlah_permintaan"],".00") !== FALSE){
                    if ($arrValue["jenis"] == "MINYAK") {
                      switch (strtoupper($arrValue["nm_barang"])) {
                        case 'SMT':
                          echo ($arrValue["jumlah_permintaan"] / 156);
                          break;
                        case 'IPA':
                          echo ($arrValue["jumlah_permintaan"] / 160);
                          break;
                        case 'REDUSER-SABLON-FR001':
                          echo ($arrValue["jumlah_permintaan"] / 15);
                        break;

                        default:
                          echo ($arrValue["jumlah_permintaan"] / 170);
                          break;
                      }
                    }else{
                      echo number_format(substr($arrValue["jumlah_permintaan"],0,strlen($arrValue["jumlah_permintaan"])-3));
                    }
                  }else{
                    echo number_format($arrValue["jumlah_permintaan"],1);
                  }
                ?>
              </center>
            </td>
            <td><center><?php echo $arrValue["keterangan"]; ?></center></td>
          </tr>
          <?php
          } ?>
        </tbody>
      </table>
      <div style="margin-top:50px;">
        <div style="height:100px; width:140px; float:left;">
          <center>
            <label>Pimpinan</label>
            <br><br><br><br>
            <label>(________________)</label>
          </center>
        </div>
        <div style="height:100px; width:140px; float:left;">
          <center>
            <label>Kepala Pabrik</label>
            <br><br><br><br>
            <label>(________________)</label>
          </center>
        </div>
        <div style="height:100px; width:140px; float:left;">
          <center>
            <label>Yang Meminta</label>
            <br><br><br><br>
            <label>(________________)</label>
          </center>
        </div>
        <div style="height:100px; width:140px; float:left;">
          <center>
            <label>Yang Membeli</label>
            <br><br><br><br>
            <label>(________________)</label>
          </center>
        </div>
        <div style="height:100px; width:140px; float:left;">
          <center>
            <label>Pembukuan</label>
            <br><br><br><br>
            <label>(________________)</label>
          </center>
        </div>
      </div>
    </div>
    <script type="text/javascript">
        window.print();
        window.onafterprint = function () {  window.close(); }
    </script>
  </body>
</html>
