<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$NamaFile.xlsx");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h3><?php echo $NamaFile; ?></h3>
<table width="100%" border="1">
  <thead>
    <th>Kode Barang</th>
    <th>Tanggal</th>
    <th>Ukuran</th>
    <th>Merek</th>
    <th>Warna</th>
    <th>Jumlah Selesai</th>
    <th>Roll Bobin</th>
    <th>Roll Payung</th>
    <th>Roll Payung Kuning</th>
  </thead>
  <tbody>
    <?php
      foreach ($Data as $arrValue) {
    ?>
    <tr>
      <td><?php echo $arrValue["kd_gd_roll"]; ?></td>
      <td><?php echo $arrValue["tgl_transaksi"]; ?></td>
      <td><?php echo $arrValue["ukuran"]; ?></td>
      <td><?php echo $arrValue["merek"]; ?></td>
      <td><?php echo $arrValue["warna_plastik"]; ?></td>
      <td><?php echo number_format($arrValue["jumlah_selesai"],2); ?></td>
      <td><?php echo $arrValue["bobin"]; ?></td>
      <td><?php echo $arrValue["payung"]; ?></td>
      <td><?php echo $arrValue["payung_kuning"]; ?></td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
