<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$NamaFile.xlsx");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h3><?php echo $NamaFile; ?></h3>
<table width="100%" border="1">
  <thead>
    <th>Tanggal</th>
    <th>Customer</th>
    <th>Merek</th>
    <th>Ukuran</th>
    <th>Warna Plastik</th>
    <th>Warna Cat</th>
    <th>Hasil Lembar</th>
    <th>Hasil Berat</th>
  </thead>
  <tbody>
    <?php foreach ($Data as $arrValue): ?>
      <tr>
        <td><?php echo $arrValue["tanggal"]; ?></td>
        <td><?php echo $arrValue["customer"]; ?></td>
        <td><?php echo $arrValue["merek"]; ?></td>
        <td><?php echo $arrValue["ukuran"]; ?></td>
        <td><?php echo $arrValue["warna_plastik"]; ?></td>
        <td><?php echo $arrValue["warna_sablon"]; ?></td>
        <td><?php echo number_format($arrValue["hasil_lembar"],0); ?></td>
        <td><?php echo number_format($arrValue["hasil_berat"],2); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
