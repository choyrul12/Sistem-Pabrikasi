<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$NamaFile.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h3><?php echo $NamaFile; ?></h3>
<table width="100%" border="1">
  <thead>
    <th>Kode Barang</th>
    <th>Customer</th>
    <th>Merek</th>
    <th>Ukuran</th>
    <th>Warna</th>
    <th>Tanggal</th>
    <th>Berat</th>
    <th>Lembar</th>
  </thead>
  <tbody>
    <?php
      foreach ($Data as $arrValue) {
    ?>
      <tr>
        <td valign="middle"><?php echo $arrValue["kd_gd_hasil"]; ?></td>
        <td valign="middle"><?php echo $arrValue["customer"]; ?></td>
        <td valign="middle"><?php echo $arrValue["merek"]; ?></td>
        <td valign="middle"><?php echo $arrValue["ukuran"]; ?></td>
        <td valign="middle"><?php echo $arrValue["warna"]; ?></td>
        <td><?php echo str_replace(",","<br>",$arrValue["arrTglTransaksi"]); ?></td>
        <td><?php echo str_replace(",","<br>",$arrValue["arrJumlahBerat"]); ?><br><b><?php echo $arrValue["totalJumlahBerat"]; ?></b></td>
        <td><?php echo str_replace(",","<br>",$arrValue["arrJumlahLembar"]); ?><br><b><?php echo $arrValue["totalJumlahLembar"]; ?></b></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
