<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$NamaFile.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h3><?php echo $NamaFile; ?></h3>
<table width="100%" border="1">
  <thead>
    <tr>
      <th>Kode Barang</th>
      <th>Merek</th>
      <th>Panjang</th>
      <th>Warna</th>
      <th>Tanggal</th>
      <th>Hasil</th>
      <th>Jumlah Roll</th>
      <th>Jenis Roll</th>
      <th>Shift</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Data as $arrData): ?>
      <tr>
        <td align="center" valign="middle"><?php echo $arrData["kd_gd_roll"]; ?></td>
        <td align="center" valign="middle"><?php echo $arrData["merek"]; ?></td>
        <td align="center" valign="middle"><?php echo $arrData["panjang"]; ?></td>
        <td align="center" valign="middle">
          <table width="100%">
            <?php
              $arrWarnaPlastik = explode(',',$arrData["warnaPlastik"]);
              foreach ($arrWarnaPlastik as $arrValueWarnaPlastik) {
            ?>
            <tr>
              <td align="center" valign="middle"><?php echo $arrValueWarnaPlastik; ?></td>
            </tr>
            <?php } ?>
          </table>
        </td>
        <td align="center" valign="middle">
          <table width="100%">
            <?php
              $arrTglKirim = explode(',',$arrData["tgl_kirim"]);
              foreach ($arrTglKirim as $arrValueTglKirim) {
            ?>
            <tr>
              <td align="center" valign="middle"><?php echo $arrValueTglKirim; ?></td>
            </tr>
            <?php } ?>
          </table>
        </td>
        <td align="center" valign="middle">
          <table width="100%">
            <?php
              $arrHasil = explode(',',$arrData["jumlahSelesai"]);
              foreach ($arrHasil as $arrValueHasil) {
            ?>
            <tr>
              <td align="center" valign="middle"><?php echo $arrValueHasil; ?></td>
            </tr>
            <?php } ?>
          </table>
          <b><?php echo number_format($arrData["total"],2); ?></b>
        </td>
        <td align="center" valign="middle">
          <table width="100%">
            <?php
              $arrJumlahRoll = explode(',',$arrData["rollPipa"]);
              foreach ($arrJumlahRoll as $arrValueJumlahRoll) {
            ?>
            <tr>
              <td align="center" valign="middle"><?php echo $arrValueJumlahRoll; ?></td>
            </tr>
            <?php } ?>
          </table>
          <b><?php echo number_format($arrData["totalRoll"],2); ?></b>
        </td>
        <td align="center" valign="middle">
          <table width="100%">
            <?php
              $arrJenisRoll = explode(',',$arrData["jenisRoll"]);
              foreach ($arrJenisRoll as $arrValueJenisRoll) {
            ?>
            <tr>
              <td align="center" valign="middle"><?php echo str_replace("_"," ",$arrValueJenisRoll); ?></td>
            </tr>
            <?php } ?>
          </table>
        </td>
        <td align="center" valign="middle">
          <table width="100%">
            <?php
              $arrShift = explode(',',$arrData["shift"]);
              foreach ($arrShift as $arrValueShift) {
            ?>
            <tr>
              <td align="center" valign="middle"><?php echo $arrValueShift; ?></td>
            </tr>
            <?php } ?>
          </table>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
