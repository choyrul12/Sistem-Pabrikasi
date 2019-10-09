<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h3><?php echo $title; ?></h3>
<table width="100%" border="1">
  <thead>
    <tr>
      <th>No</th>
      <th>Warna</th>
      <th>Jenis</th>
      <th>Stok</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($gudang_bahan->result_array() as $value):?>
    <tr>
      <td><?php echo $i++;?></td>
      <td><?php echo $value["sub_jenis"]; ?></td>
      <td><?php echo $value["jenis"];?></td>
      <td style="text-align: right;"><?php echo number_format($value["stok"],2);?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>