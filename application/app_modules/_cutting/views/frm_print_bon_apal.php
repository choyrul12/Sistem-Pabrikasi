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
      .col-md-4{
        float: left;
        position: relative;
        width: 200px;
        text-align: left;
      }
      .wrapper{
        position: relative;
        margin-top: 20px;
      }

      table { border-collapse: collapse; }
      tr { border: none; }
      td {
        height: 30px;
      }
  </style>
  </head>
  <body>
    <div>
      <div class="header">
        <h3 class="h3"><b>Laporan Bon Apal</b></h3>
        <div style="margin-top:10px; margin-bottom:10px;">
          <small>Tanggal : <?php echo date("d F Y",strtotime($this->uri->rsegment(4))); ?></small>
        </div>
      </div>
      <table style="border:1px solid #4a4a4a; font-size:12pt;" width='100%'>
        <tr style="border:1px solid #4a4a4a;">
          <td align="center" style="border:1px solid #4a4a4a;" width="15%">Ukuran</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="15%">Merek</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="7%">No. Mesin</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="15%">Apal</td>
          <td align="center" style="border:1px solid #4a4a4a;" width="15%">Warna</td>
        </tr>
        <?php
        $Total = 0;
        $arrValue = array("Merah" => 0,
                          "Hijau" => 0,
                          "Biru" => 0,
                          "Orange" => 0,
                          "Coklat" => 0,
                          "Hitam" => 0,
                          "Ungu" => 0,
                          "Silver" => 0,
                          "Strip" => 0,
                          "Putih Susu" => 0,
                          "Putih" => 0,
                          "Total" => 0);
        foreach ($ListBon as $value) {
          $jenis = $value["jns_permintaan"];
          $Total += floatval($value["apal"]);
          if($value["warna_plastik"]=="merah"){
            $arrValue["Merah"] += floatval($value["apal"]);
          }else if($value["warna_plastik"]=="hijau"){
            $arrValue["Hijau"] += floatval($value["apal"]);
          }else if($value["warna_plastik"]=="kuning"){
            $arrValue["Kuning"] += floatval($value["apal"]);
          }else if($value["warna_plastik"]=="biru"){
            $arrValue["Biru"] += floatval($value["apal"]);
          }else if($value["warna_plastik"]=="orange"){
            $arrValue["Orange"] += floatval($value["apal"]);
          }else if($value["warna_plastik"]=="coklat"){
            $arrValue["Coklat"] += floatval($value["apal"]);
          }else if($value["warna_plastik"]=="hitam"){
            $arrValue["Hitam"] += floatval($value["apal"]);
          }else if($value["warna_plastik"]=="ungu"){
            $arrValue["Ungu"] += floatval($value["apal"]);
          }else if($value["warna_plastik"]=="silver"){
            $arrValue["Silver"] += floatval($value["apal"]);
          }else if($value["warna_plastik"]=="putih susu" || $value["sub_jenis"]=="pss"){
            $arrValue["Putih Susu"] += floatval($value["apal"]);
          }else if($value["warna_plastik"]=="putih"){
            $arrValue["Putih"] += floatval($value["apal"]);
          }else{

          }
        ?>
          <tr>
          <td align="center" width="7%"><?php echo $value["ukuran"]; ?></td>
          <td align="center" width="10%"><?php echo $value["merek"]; ?></td>
          <td align="center" width="10%"><?php echo $value["no_mesin"]; ?></td>
          <td align="center" width="10%"><?php echo floatval($value["apal"]); ?></td>
          <td align="center" width="10%"><?php echo $value["warna_plastik"]; ?></td>
          </tr>
        <?php } ?>
      </table>
      <div class="wrapper">
        <div class="col-md-4">
          <label>Keterangan : </label>
          <ul>
            <?php
            foreach ($ListTotalSubBon as $value) {
              if($value["jenis"]=="STRIP" || $value["jenis"]=="STRIP"){
                $arrValue["Strip"] = $value["jumlah"];
              }else{

              }
              if ($jenis=='POLOS') {
                $arrValue["Total"] += $value["jumlah"];
              }else{
                $arrValue["Total"] += $value["jumlah"]-$arrValue["Strip"];
              }

            } ?>
            <li><label id="liMerah">Merah =<?php echo $arrValue["Merah"]; ?></label></li>
            <li><label id="liHijau">Hijau = <?php echo $arrValue["Hijau"]; ?></label></li>
            <li><label id="liKuning">Kuning = <?php echo $arrValue["Kuning"]; ?></label></li>
            <li><label id="liBiru">Biru = <?php echo $arrValue["Biru"]; ?></label></li>
            <li><label id="liOrange">Orange = <?php echo $arrValue["Orange"]; ?></label></li>
            <li><label id="liCoklat">Coklat = <?php echo $arrValue["Coklat"]; ?></label></li>
            <li><label id="liHitam">Hitam = <?php echo $arrValue["Hitam"]; ?></label></li>
            <li><label id="liUngu">Ungu = <?php echo $arrValue["Ungu"]; ?></label></li>
            <li><label id="liSilver">Silver = <?php echo $arrValue["Silver"]; ?></label></li>
            <?php if ($jenis == "POLOS") {?>
             <li><label id="liStrip">Strip = <?php echo $arrValue["Strip"]; ?></label></li>
            <?php } ?>

          </ul>
        </div>
        <div class="col-md-4">
          <ul>
            <li><label id="liPutihSusu">Putih Susu = <?php echo $arrValue["Putih Susu"]; ?></label></li>
            <li><label id="liPutih">Putih = <?php echo abs($arrValue["Putih"]-$arrValue["Strip"]); ?></label></li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul>
            <li><label id="liLaporan">Laporan = <?php echo $Total; ?></label></li>
          </ul>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      window.print();
      window.onafterprint = function () {
                              window.close();
                            }
    </script>
  </body>
</html>

    <!-- </style>
  </head>
  <body>
    <div>
      <div class="header">
        <h3 class="h3"><b>Laporan Bon Apal</b></h3>
        <div class="pull-right">
          <small>Tanggal : <?php echo date("d F Y",strtotime($this->uri->rsegment(4))); ?></small>
        </div>
      </div>
      <table style="font-size:11pt;" width='100%'>
        <tr>
          <td align="center" width="15%">Ukuran</td>
          <td align="center" width="7%">No. Mesin</td>
          <td align="center" width="15%">Apal</td>
        </tr>
        <?php foreach ($ListBon as $value) { ?>
          <tr>
          <td align="center" width="7%"><?php echo $value["ukuran"]; ?></td>
          <td align="center" width="10%"><?php echo $value["no_mesin"]; ?></td>
          <td align="center" width="10%"><?php echo $value["apal"]; ?></td>
          </tr>
        <?php } ?>
      </table>
      <div class="wrapper">
        <div class="col-md-4">
          <label>Keterangan : </label>
          <ul>
            <?php
            $arrValue = array("Merah" => "0",
                              "Hijau" => "0",
                              "Biru" => "0",
                              "Orange" => "0",
                              "Coklat" => "0",
                              "Hitam" => "0",
                              "Ungu" => "0",
                              "Silver" => "0",
                              "Strip" => "0",
                              "Putih Susu" => "0",
                              "Putih" => "0",
                              "Total" => 0);
            foreach ($ListTotalSubBon as $value) {
              if($value["sub_jenis"]=="MERAH POLOS" || $value["sub_jenis"]=="MERAH CETAK"){
                $arrValue["Merah"] = $value["jumlah"];
              }else if($value["sub_jenis"]=="HIJAU POLOS" || $value["sub_jenis"]=="HIJAU CETAK"){
                $arrValue["Hijau"] = $value["jumlah"];
              }else if($value["sub_jenis"]=="KUNING POLOS" || $value["sub_jenis"]=="KUNING CETAK"){
                $arrValue["Kuning"] = $value["jumlah"];
              }else if($value["sub_jenis"]=="BIRU POLOS" || $value["sub_jenis"]=="BIRU CETAK"){
                $arrValue["Biru"] = $value["jumlah"];
              }else if($value["sub_jenis"]=="ORANGE POLOS" || $value["sub_jenis"]=="ORANGE CETAK"){
                $arrValue["Orange"] = $value["jumlah"];
              }else if($value["sub_jenis"]=="COKLAT POLOS" || $value["sub_jenis"]=="COKLAT CETAK"){
                $arrValue["Coklat"] = $value["jumlah"];
              }else if($value["sub_jenis"]=="HITAM POLOS" || $value["sub_jenis"]=="HITAM CETAK"){
                $arrValue["Hitam"] = $value["jumlah"];
              }else if($value["sub_jenis"]=="UNGU POLOS" || $value["sub_jenis"]=="UNGU CETAK"){
                $arrValue["Ungu"] = $value["jumlah"];
              }else if($value["sub_jenis"]=="SILVER POLOS" || $value["sub_jenis"]=="SILVER CETAK"){
                $arrValue["Silver"] = $value["jumlah"];
              }else if($value["jenis"]=="STRIP" || $value["jenis"]=="STRIP"){
                $arrValue["Strip"] = $value["jumlah"];
              }else if($value["sub_jenis"]=="PUTIH SUSU POLOS" || $value["sub_jenis"]=="PUTIH SUSU CETAK"){
                $arrValue["Putih Susu"] = $value["jumlah"];
              }else if($value["sub_jenis"]=="PUTIH POLOS" || $value["sub_jenis"]=="PUTIH CETAK"){
                $arrValue["Putih"] = $value["jumlah"];
              }else{

              }
              $arrValue["Total"] += $value["jumlah"];
            } ?>
            <li><label id="liMerah">Merah =<?php echo $arrValue["Merah"]; ?></label></li>
            <li><label id="liHijau">Hijau = <?php echo $arrValue["Hijau"]; ?></label></li>
            <li><label id="liKuning">Kuning = <?php echo $arrValue["Kuning"]; ?></label></li>
            <li><label id="liBiru">Biru = <?php echo $arrValue["Biru"]; ?></label></li>
            <li><label id="liOrange">Orange = <?php echo $arrValue["Orange"]; ?></label></li>
            <li><label id="liCoklat">Coklat = <?php echo $arrValue["Coklat"]; ?></label></li>
            <li><label id="liHitam">Hitam = <?php echo $arrValue["Hitam"]; ?></label></li>
            <li><label id="liUngu">Ungu = <?php echo $arrValue["Ungu"]; ?></label></li>
            <li><label id="liSilver">Silver = <?php echo $arrValue["Silver"]; ?></label></li>
            <li><label id="liStrip">Strip = <?php echo $arrValue["Strip"]; ?></label></li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul>
            <li><label id="liPutihSusu">Putih Susu = <?php echo $arrValue["Putih Susu"]; ?></label></li>
            <li><label id="liPutih">Putih = <?php echo $arrValue["Putih"]; ?></label></li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul>
            <li><label id="liLaporan">Laporan = <?php echo $arrValue["Total"]; ?></label></li>
          </ul>
        </div>
      </div>
    </div>
  </body>
</html> -->
