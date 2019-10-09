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
      <th rowspan="2" style="vertical-align:middle;">Tanggal</th>
      <th rowspan="2" style="vertical-align:middle;">Customer</th>
      <th rowspan="2" style="vertical-align:middle;">Merek</th>
      <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
      <th rowspan="2" style="vertical-align:middle;">Warna Plastik</th>
      <th rowspan="2" style="vertical-align:middle;">Berat Bahan</th>
      <th rowspan="2" style="vertical-align:middle;">Berat Bobin</th>
      <th rowspan="2" style="vertical-align:middle;">Berat Payung</th>
      <th rowspan="2" style="vertical-align:middle;">Berat Payung Kuning</th>
      <th rowspan="2" style="vertical-align:middle;">Berat Sisa</th>
      <th rowspan="2" style="vertical-align:middle;">Hasil Cetak</th>
      <th rowspan="2" style="vertical-align:middle;">Hasil Bobin</th>
      <th rowspan="2" style="vertical-align:middle;">Hasil Payung</th>
      <th rowspan="2" style="vertical-align:middle;">Hasil Payung Kuning</th>
      <th colspan="3" style="vertical-align:middle;"><center>Pipa</center></th>
      <th rowspan="2" style="vertical-align:middle;">Apal</th>
      <th rowspan="2" style="vertical-align:middle;">Plus/Minus</th>
    </tr>
    <tr>
      <th>Bobin</th>
      <th>Payung</th>
      <th>Payung Kuning</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no = 1;
      foreach ($Data as $arrValue):
    ?>
      <tr>
        <td><?php echo $arrValue["tgl_transaksi"]; ?></td>
        <td><?php echo $arrValue["customer"]; ?></td>
        <td><?php echo $arrValue["merek"]; ?></td>
        <td><?php echo $arrValue["ukuran"]; ?></td>
        <td><?php echo $arrValue["warna_plastik"]; ?></td>
        <td><?php echo number_format($arrValue["beratPengambilan"],2); ?></td>
        <td><?php echo number_format($arrValue["bobinPengambilan"],0); ?></td>
        <td><?php echo number_format($arrValue["payungPengambilan"],0); ?></td>
        <td><?php echo number_format($arrValue["payungKuningPengambilan"],0); ?></td>
        <td><?php echo number_format($arrValue["jumlah_sisa_pengambilan"],2); ?></td>
        <td><?php echo number_format($arrValue["jumlah_hasil_selesai"],2); ?></td>
        <td><?php echo number_format($arrValue["jumlah_hasil_bobin"],0); ?></td>
        <td><?php echo number_format($arrValue["jumlah_hasil_payung"],0); ?></td>
        <td><?php echo number_format($arrValue["jumlah_hasil_payung_kuning"],0); ?></td>
        <td><?php echo number_format($arrValue["jumlah_bobin_terbuang"],0); ?></td>
        <td><?php echo number_format($arrValue["jumlah_payung_terbuang"],0); ?></td>
        <td><?php echo number_format($arrValue["jumlah_payung_kuning_terbuang"],0); ?></td>
        <td><?php echo number_format($arrValue["jumlah_apal"],2); ?></td>
        <td><?php echo number_format($arrValue["plusminus"],2); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
