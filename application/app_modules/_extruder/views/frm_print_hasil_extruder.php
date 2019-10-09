<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laporan Hasil Extruder</title>
    <style>
      td{
        height: 20px;
      }
      th{
        text-align: left;
      }
    </style>
  </head>
  <body>
    <h3>Laporan Hasil Extruder</h3>
    <p align="right">Tanggal : <?php echo $Tanggal; ?></p>

    <div style="float:left; width:100%;">
      <table width="100%" border="0">
        <thead>
          <tr>
            <th width="5%">Tebal</th>
            <th width="10%">Merek</th>
            <th width="8%">Ukuran</th>
            <th width="13%">Biji Warna</th>
            <th width="10%">Berat Hasil</th>
            <th width="3%">Roll</th>
            <th width="8%">Berat Roll</th>
            <th width="12%">Jenis Roll</th>
            <th width="3%">Shift</th>
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
              <td><?php echo $arrValue["tebal"]; ?></td>
              <td><?php echo $arrValue["merek"]; ?></td>
              <td><?php echo $arrValue["hasil_ukuran"]; ?></td>
              <td><?php echo strtolower($arrValue["biji_warna"])." / ".$arrValue["keterangan"]; ?></td>
              <td>
                <?php
                  if(strpos($arrValue["jumlah_selesai"],".00") !== FALSE){
                    echo substr($arrValue["jumlah_selesai"],0,strlen($arrValue["jumlah_selesai"])-3);
                  }else{
                    if(strpos(number_format($arrValue["jumlah_selesai"],1),".0") !== FALSE){
                      echo number_format($arrValue["jumlah_selesai"],0);
                    }else{
                      echo number_format($arrValue["jumlah_selesai"],1);
                    }
                  }
                  //echo number_format($arrValue["jumlah_selesai"],1);
                ?>
              </td>
              <td><?php echo $arrValue["roll_lembar"]; ?></td>
              <td>
                <?php
                  if(strpos($arrValue["roll_pipa"],".00") !== FALSE){
                    echo substr($arrValue["roll_pipa"],0,strlen($arrValue["roll_pipa"])-2);
                  }else{
                    if(strpos(number_format($arrValue["roll_pipa"],1),".0") !== FALSE){
                      echo number_format($arrValue["roll_pipa"],0);
                    }else{
                      echo number_format($arrValue["roll_pipa"],1);
                    }
                  }
                  //echo number_format($arrValue["roll_pipa"],1);
                ?>
              </td>
              <td><?php echo str_replace("_"," ",strtolower($arrValue["jenis_roll"])); ?></td>
              <td align="center"><?php echo $arrValue["shift"]; ?></td>
            </tr>
          <?php
            if(empty($arrValue["pemakaian_strip"])){
              $x = "0";
            }else{
              $x = $arrValue["pemakaian_strip"];
            }
            if(strpos($x,"#") !== FALSE){
              $pemakaianStripTemp = explode("#",$x);
              $pemakaianStrip += floatval($pemakaianStripTemp[0]) + floatval($pemakaianStripTemp[1]);
            }else{
              $pemakaianStrip += floatval($x);
            }
            // if($arrValue["keterangan"] == "STRIP"){
            //   if(strtoupper($arrValue["merek"]) == "KP" || strtoupper($arrValue["merek"]) == "MP"){
            //     if(strtoupper($arrValue["bijiWarna"]) == "PUTIH"){
            //       $pemakaianStrip += ($arrValue["jumlah_selesai"] - $arrValue["roll_pipa"]) * 0.0015;
            //     }else{
            //       $pemakaianStrip += ($arrValue["jumlah_selesai"] - $arrValue["roll_pipa"] - $arrValue["jumlah_biji_warna"]) * 0.0015;
            //     }
            //   }else{
            //     if(strtoupper($arrValue["bijiWarna"]) == "PUTIH"){
            //       $pemakaianStrip += ($arrValue["jumlah_selesai"] - $arrValue["roll_pipa"]) * 0.0015;
            //     }else{
            //       $pemakaianStrip += ($arrValue["jumlah_selesai"] - $arrValue["roll_pipa"] - $arrValue["jumlah_biji_warna"]) * 0.0015;
            //     }
            //   }
            // }
            $jumlahBerat += $arrValue["jumlah_selesai"];
            $jumlahRoll += $arrValue["roll_pipa"];
            endforeach;
          ?>
        </tbody>
      </table>
    </div>
    <div style="float:left; margin-top:10px; width:100%;">
      <div style="float:left; width:45%; padding-left:5%">
        <h3>Biji Warna</h3>
        <table width="100%">
          <?php
            //asort($Data["dataBijiWarna"]);
            foreach ($Data["dataBijiWarna"] as $arrValue): ?>
            <tr>
              <td width="40%"><?php echo $arrValue["biji_warna"]; ?></td>
              <td width="2%">:</td>
              <td>
                <?php
                  if(strpos($arrValue["jumlah_biji_warna"],".00") !== FALSE){
                    echo substr($arrValue["jumlah_biji_warna"],0,strlen($arrValue["jumlah_biji_warna"])-3);
                  }else{
                    if(strpos(number_format($arrValue["jumlah_biji_warna"],1),".0") !== FALSE){
                      echo number_format($arrValue["jumlah_biji_warna"],0);
                    }else{
                      echo number_format($arrValue["jumlah_biji_warna"],1);
                    }
                  }
                  // echo round($arrValue["jumlah_biji_warna"],2);
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td width="40%">Penggunaan Strip</td>
            <td width="2%">:</td>
            <td id="tdPenggunaanStrip">
              <?php
                if(strpos($pemakaianStrip,".00") !== FALSE){
                  echo substr($pemakaianStrip,0,strlen($pemakaianStrip)-3);
                }else{
                  if(strpos(number_format($pemakaianStrip,1),".0") !== FALSE){
                    echo number_format($pemakaianStrip,0);
                  }else{
                    echo number_format($pemakaianStrip,1);
                  }
                }
                // echo round($pemakaianStrip,2);
              ?>
            </td>
          </tr>
          <tr>
            <td>Penambahan Biji</td>
            <td>:</td>
            <td id="tdPenambahanBiji">
              <?php
                if(strpos($Data["dataJobExtruder"][0]["penambahan_biji"],".00") !== FALSE){
                  echo substr($Data["dataJobExtruder"][0]["penambahan_biji"],0,strlen($Data["dataJobExtruder"][0]["penambahan_biji"])-4);
                }else{
                  if(strpos(number_format($Data["dataJobExtruder"][0]["penambahan_biji"],1),".0") !== FALSE){
                    echo number_format($Data["dataJobExtruder"][0]["penambahan_biji"],0);
                  }else{
                    echo number_format($Data["dataJobExtruder"][0]["penambahan_biji"],1);
                  }
                }
                //echo round($Data["dataJobExtruder"][0]["penambahan_biji"],2);
              ?>
            </td>
          </tr>
          <tr>
            <td>Pengurangan Biji</td>
            <td>:</td>
            <td id="tdPenguranganBiji">
              <?php
                if(strpos($Data["dataJobExtruder"][0]["pengurangan_biji"],".00") !== FALSE){
                  echo substr($Data["dataJobExtruder"][0]["pengurangan_biji"],0,strlen($Data["dataJobExtruder"][0]["pengurangan_biji"])-4);
                }else{
                  if(strpos(number_format($Data["dataJobExtruder"][0]["pengurangan_biji"],1),".0") !== FALSE){
                    echo number_format($Data["dataJobExtruder"][0]["pengurangan_biji"],0);
                  }else{
                    echo number_format($Data["dataJobExtruder"][0]["pengurangan_biji"],1);
                  }
                }
                // echo round($Data["dataJobExtruder"][0]["pengurangan_biji"],2);
              ?>
            </td>
          </tr>
        </table>
      </div>
      <div style="float:left; width:45%; padding-left:5%">
        <center><h3>Hasil Global Extruder  <?php echo $Tanggal; ?></h3></center>
        <table width="100%" style="float:left">
          <tr>
            <td width="40%">Sisa Bahan Sebelumnya</td>
            <td width="2%">:</td>
            <td id="tdSisaShiftSebelumnya">
              <?php
                if(strpos($Data["sisaBijiKemarin"][0]["sisa_biji_kemarin"],".00") !== FALSE){
                  echo substr($Data["sisaBijiKemarin"][0]["sisa_biji_kemarin"],0,strlen($Data["sisaBijiKemarin"][0]["sisa_biji_kemarin"])-3);
                }else{
                  if(strpos(number_format($Data["sisaBijiKemarin"][0]["sisa_biji_kemarin"],1),".0") !== FALSE){
                    echo number_format($Data["sisaBijiKemarin"][0]["sisa_biji_kemarin"],0);
                  }else{
                    echo number_format($Data["sisaBijiKemarin"][0]["sisa_biji_kemarin"],1);
                  }
                }
                //echo number_format($Data["sisaBijiKemarin"][0]["sisa_biji_kemarin"],2);
              ?>
            </td>
          </tr>
          <tr>
            <td>Pemakaian Bahan</td>
            <td>:</td>
            <td id="tdTotal">
              <?php
              if(strpos($Data["dataJobExtruder"][0]["total"],".00") !== FALSE){
                echo number_format(substr($Data["dataJobExtruder"][0]["total"],0,strlen($Data["dataJobExtruder"][0]["total"])-4));
              }else{
                echo number_format($Data["dataJobExtruder"][0]["total"],1);
              }
              // echo number_format($Data["dataJobExtruder"][0]["total"],2);
              ?>
            </td>
          </tr>
          <tr>
            <td>Total Bahan Hari Ini</td>
            <td>:</td>
            <td id="tdSisa">
              <?php
                $sisaBijiKemarin = number_format($Data["dataJobExtruder"][0]["sisa_biji_kemarin"],2);
                if(strpos($Data["dataJobExtruder"][0]["sisa_biji_kemarin"],".00") !== FALSE){
                  echo number_format(substr($Data["dataJobExtruder"][0]["sisa_biji_kemarin"],0,strlen($Data["dataJobExtruder"][0]["sisa_biji_kemarin"])-4));
                }else{
                  echo $sisaBijiKemarin;
                }

              ?>
            </td>
          </tr>
          <tr>
            <td>Berat Hasil Jadi</td>
            <td>:</td>
            <td id="tdBerat">
              <?php
              // $sisaBijiKemarin = number_format($Data["dataJobExtruder"][0]["sisa_biji_kemarin"],2);
              if(strpos($jumlahBerat,".00") !== FALSE){
                echo number_format(substr($jumlahBerat,0,strlen($jumlahBerat)-4));
              }else{
                echo number_format($jumlahBerat,1);
              }
                //echo number_format($jumlahBerat,2);
              ?>
            </td>
          </tr>
          <tr>
            <td>Apal</td>
            <td>:</td>
            <td id="tdApal">
              <?php
              if(strpos($Data["dataJobExtruder"][0]["jumlah_apal"],".00") !== FALSE){
                echo number_format(substr($Data["dataJobExtruder"][0]["jumlah_apal"],0,strlen($Data["dataJobExtruder"][0]["jumlah_apal"])-4));
              }else{
                echo number_format($Data["dataJobExtruder"][0]["jumlah_apal"],1);
              }
                // echo number_format($Data["dataJobExtruder"][0]["jumlah_apal"],2);
              ?>
            </td>
          </tr>
          <tr>
            <td>Jumlah Biji Warna</td>
            <td>:</td>
            <td id="tdJumlahBijiWarna">
              <?php
              if(strpos($Data["dataJobExtruder"][0]["total_biji_warna"],".00") !== FALSE){
                echo number_format(substr($Data["dataJobExtruder"][0]["total_biji_warna"],0,strlen($Data["dataJobExtruder"][0]["total_biji_warna"])-4));
              }else{
                echo number_format($Data["dataJobExtruder"][0]["total_biji_warna"],1);
              }
              // echo number_format($Data["dataJobExtruder"][0]["total_biji_warna"],2);
              ?>
            </td>
          </tr>
          <tr>
            <td>Roll</td>
            <td>:</td>
            <td id="tdRoll">
              <?php
                if(strpos($jumlahRoll,".00") !== FALSE){
                  echo number_format(substr($jumlahRoll,0,strlen($jumlahRoll)-4));
                }else{
                  echo number_format($jumlahRoll,1);
                }
                // echo number_format($jumlahRoll,2);
              ?>
            </td>
          </tr>
          <tr>
            <td>Plus/Minus</td>
            <td>:</td>
            <td id="tdPlusMinus">
              <?php
              if(strpos($Data["dataJobExtruder"][0]["plusminus"],".00") !== FALSE){
                echo number_format(substr($Data["dataJobExtruder"][0]["plusminus"],0,strlen($Data["dataJobExtruder"][0]["plusminus"])-4));
              }else{
                echo number_format($Data["dataJobExtruder"][0]["plusminus"],1);
              }
                // echo number_format($Data["dataJobExtruder"][0]["plusminus"],2);
              ?>
            </td>
          </tr>
        </table>
      </div>
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
