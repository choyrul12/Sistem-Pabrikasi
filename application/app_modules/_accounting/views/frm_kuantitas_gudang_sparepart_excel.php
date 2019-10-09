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
      <th>Nama Barang</th>
      <th>Kode</th>
      <th>Ukuran</th>
      <th>Stok</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($gudang_bahan->result_array() as $value):?>
    <tr>
      <td><?php echo $i++;?></td>
      <td><?php echo $value["nm_spare_part"]; ?></td>
      <td><?php echo $value["kode"];?></td>
      <td><?php echo $value["ukuran"];?></td>
      <td><?php echo $value["stok"];?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>