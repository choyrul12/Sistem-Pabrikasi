<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laporan Hasil Extruder</title>
    <style>
      td{
        height: 25px;
      }
    </style>
  </head>
  <body>
    <h3>Laporan Hasil Extruder</h3>
    <p align="right">Tanggal : <?php echo $Tanggal; ?></p>

    <div style="float:left; width:100%;">
      <table width="100%" border="1">
        <thead>
          <tr>
            <th align="center" width="10%">Tebal</th>
            <th align="center" width="20%">Merek</th>
            <th align="center" width="8%">Ukuran</th>
            <th align="center" width="15%">Biji Warna</th>
            <th align="center" width="10%">Berat Hasil</th>
            <th align="center" width="3%">Roll</th>
            <th align="center" width="3%">Berat Roll</th>
            <th align="center" width="8%">Jenis Roll</th>
            <th align="center" width="3%">Shift</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $jumlahBerat = 0;
            $jumlahApal = 0;
            $pemakaianStrip = 0;
            foreach ($Data["dataHasilExtruder"] as $arrValue):
          ?>
            <tr>
              <td align="center"><?php echo $arrValue["tebal"]; ?></td>
              <td align="center"><?php echo $arrValue["merek"]; ?></td>
              <td align="center"><?php echo $arrValue["hasil_ukuran"]; ?></td>
              <td align="center"><?php echo $arrValue["biji_warna"]." / ".$arrValue["keterangan"]; ?></td>
              <td align="center"><?php echo $arrValue["jumlah_selesai"]; ?></td>
              <td align="center"><?php echo $arrValue["roll_lembar"]; ?></td>
              <td align="center"><?php echo $arrValue["roll_pipa"]; ?></td>
              <td align="center"><?php echo str_replace("_"," ",$arrValue["jenis_roll"]); ?></td>
              <td align="center"><?php echo $arrValue["shift"]; ?></td>
            </tr>
          <?php
            if($arrValue["keterangan"] == "STRIP"){
              if(strtoupper($arrValue["merek"]) == "KP" || strtoupper($arrValue["merek"]) == "MP"){
                if(strtoupper($arrValue["bijiWarna"]) == "PUTIH"){
                  $pemakaianStrip += ($arrValue["jumlah_selesai"] - $arrValue["roll_pipa"]) * 0.0015;
                }else{
                  $pemakaianStrip += ($arrValue["jumlah_selesai"] - $arrValue["roll_pipa"] - $arrValue["jumlah_biji_warna"]) * 0.0015;
                }
              }else{
                if(strtoupper($arrValue["bijiWarna"]) == "PUTIH"){
                  $pemakaianStrip += ($arrValue["jumlah_selesai"] - $arrValue["roll_pipa"]) * 0.0015;
                }else{
                  $pemakaianStrip += ($arrValue["jumlah_selesai"] - $arrValue["roll_pipa"] - $arrValue["jumlah_biji_warna"]) * 0.0015;
                }
              }
            }
            $jumlahBerat += $arrValue["jumlah_selesai"];
            $jumlahApal += $arrValue["roll_pipa"];
            endforeach;
          ?>
        </tbody>
      </table>
    </div>

    <div style="float:left; margin-top:50px;">
      <div style="float:left; width:50%">
        <table width="100%">
          <?php foreach ($Data["dataBijiWarna"] as $arrValue): ?>
            <tr>
              <td width="40%"><?php echo $arrValue["biji_warna"]; ?></td>
              <td width="2%">:</td>
              <td><?php echo round($arrValue["jumlah_biji_warna"],2); ?></td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td width="40%">Penggunaan Strip</td>
            <td width="2%">:</td>
            <td id="tdPenggunaanStrip"><?php echo round($pemakaianStrip,2); ?></td>
          </tr>
          <tr>
            <td>Penambahan Biji</td>
            <td>:</td>
            <td id="tdPenambahanBiji"><?php echo round($Data["dataJobExtruder"][0]["penambahan_biji"],2); ?></td>
          </tr>
          <tr>
            <td>Pengurangan Biji</td>
            <td>:</td>
            <td id="tdPenguranganBiji"><?php echo round($Data["dataJobExtruder"][0]["pengurangan_biji"],2); ?></td>
          </tr>
        </table>
      </div>
      <div style="float:left; width:50%">
        <table width="100%" style="float:left">
          <tr>
            <td width="40%">Sisa Shift Sebelumnya</td>
            <td width="2%">:</td>
            <td id="tdSisaShiftSebelumnya"><?php echo number_format($Data["sisaBijiKemarin"][0]["sisa_biji_kemarin"],2); ?></td>
          </tr>
          <tr>
            <td>Sisa</td>
            <td>:</td>
            <td id="tdSisa"><?php echo number_format($Data["dataJobExtruder"][0]["sisa_biji_kemarin"],2); ?></td>
          </tr>
          <tr>
            <td>Berat</td>
            <td>:</td>
            <td id="tdBerat"><?php echo number_format($jumlahBerat,2); ?></td>
          </tr>
          <tr>
            <td>Apal</td>
            <td>:</td>
            <td id="tdApal"><?php echo number_format($Data["dataJobExtruder"][0]["jumlah_apal"],2); ?></td>
          </tr>
          <tr>
            <td>Roll</td>
            <td>:</td>
            <td id="tdRoll"><?php echo number_format($jumlahApal,2); ?></td>
          </tr>
          <tr>
            <td>Total</td>
            <td>:</td>
            <td id="tdTotal"><?php echo number_format($Data["dataJobExtruder"][0]["total"],2); ?></td>
          </tr>
          <tr>
            <td>Jumlah Biji Warna</td>
            <td>:</td>
            <td id="tdJumlahBijiWarna"><?php echo number_format($Data["dataJobExtruder"][0]["total_biji_warna"],2); ?></td>
          </tr>
          <tr>
            <td>Plus/Minus</td>
            <td>:</td>
            <td id="tdPlusMinus"><?php echo number_format($Data["dataJobExtruder"][0]["plusminus"],2); ?></td>
          </tr>
        </table>
      </div>
    </div>
  </body>
</html>
