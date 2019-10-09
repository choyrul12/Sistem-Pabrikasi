<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h3><?php echo $title; ?></h3>
<table width="100%" border="1">
  <thead>
    <tr style="background-color: green;">
      <th>No</th>
      <th>Kode Accurate</th>
      <th>Ukuran</th>
      <th>Merek</th>
      <th>Warna</th>
      <th>Status</th>
      <th>Stok Lembar</th>
      <th>Stok Berat</th>
    </tr>
  </thead>
  <tbody>
  	<?php $i=1; foreach ($gudang_bahan->result_array() as $value):?>
  	<tr>
  		<td><?php echo $i++;?></td>
  		<td><?php echo $value["kd_accurate"]; ?></td>
  		<td><?php echo $value["ukuran"];?></td>
  		<td><?php echo $value["merek"];?></td>
  		<td><?php echo $value["warna_plastik"];?></td>
  		<td><?php echo $value["sts_brg"];?></td>
  		<td style="text-align: right;"><?php echo number_format($value["stok_lembar"],2);?></td>
  		<td style="text-align: right;"><?php echo number_format($value["stok_berat"],2);?></td>
  	</tr>
  	<?php endforeach; ?>
  </tbody>
