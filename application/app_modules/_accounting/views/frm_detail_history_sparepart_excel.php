<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title($nm_barang).xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h3><?php echo $title; ?></h3>
<h4><?php echo str_replace("%20", " ", $nm_barang); ?></h4>
<table width="100%" border="1">
  <thead>
    <tr style="background-color: green; text-align: center;">
      <th style="width: 100px;">Tanggal</th>
      <th style="width: 100px;">Masuk</th>
      <th style="width: 100px;">Keluar</th>
      <th style="width: 100px;">Saldo</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($history[2] as $value):?>
    <tr>
      <td style="text-align: center;"><?php echo $value["tgl_transaksi"] ?></td>
      <td style="text-align: right;"><?php echo $value["debit"]; ?></td>
      <td style="text-align: right;"><?php echo $value["kredit"]; ?></td>
      <td style="text-align: right;"><?php echo $value["saldo"]; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php $i=1; foreach ($history[0] as $value):?>
    <tr>
      <td style="text-align: center;">Jumlah :</td>
      <td style="background-color: #00c0ef; text-align: right;"><b><?php echo $value["totalmasuk"];?></b></td>
      <td style="background-color: #00c0ef; text-align: right;"><b><?php echo $value["totalkeluar"]; ?></b></td>
      <td></td>
    </tr>
    <?php endforeach; ?>
  </tbody>