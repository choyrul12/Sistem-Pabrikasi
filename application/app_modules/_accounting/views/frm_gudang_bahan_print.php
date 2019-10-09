<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$NamaFile.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h3><?php echo $NamaFile; ?></h3>
<table width="100%" border="1">
  <thead>
    <th>Nama Barang</th>
    <th>Saldo Awal</th>
    <th>Masuk</th>
    <th>Keluar</th>
    <th>Sisa</th>
  </thead>
  <tbody>
    <?php foreach ($Data as $arrValue): ?>
      <tr>
        <td><?php echo $arrValue["nm_barang"]; ?></td>
        <td><?php echo number_format($arrValue["saldo_awal"],2); ?></td>
        <td><?php echo number_format($arrValue["total_masuk_per_periode"],2); ?></td>
        <td><?php echo number_format($arrValue["total_keluar_per_periode"],2); ?></td>
        <td><?php echo number_format($arrValue["saldo_awal"] + $arrValue["total_masuk_per_periode"] - $arrValue["total_keluar_per_periode"],2); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
