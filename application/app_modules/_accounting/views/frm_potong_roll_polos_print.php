<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$NamaFile.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h3><?php echo $NamaFile; ?></h3>
<table width="100%" border="1">
  <thead>
    <th>Tanggal</th>
    <th>Ukuran</th>
    <th>Warna</th>
    <th>Merek</th>
    <th>Sisa</th>
    <th>Bobin</th>
    <th>Payung</th>
    <th>Payung Kuning</th>
  </thead>
  <tbody>
    <?php
      foreach ($Data as $arrValue) {
    ?>
    <tr>
      <td><?php echo $arrValue["tgl_rencana"]; ?></td>
      <td><?php echo $arrValue["ukuran"]; ?></td>
      <td><?php echo $arrValue["warna_plastik"]; ?></td>
      <td><?php echo $arrValue["merek"]; ?></td>
      <td><?php echo number_format($arrValue["totalBeratSisa"],2); ?></td>
      <td><?php echo $arrValue["totalBobinSisa"]; ?></td>
      <td><?php echo $arrValue["totalPayungSisa"]; ?></td>
      <td><?php echo $arrValue["totalPayungKuningSisa"]; ?></td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
