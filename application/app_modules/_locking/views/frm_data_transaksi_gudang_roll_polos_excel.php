<?php
$tglAwal = date("d-F-Y",strtotime($this->uri->rsegment(3)));
$tglAkhir = date("d-F-Y",strtotime($this->uri->rsegment(4)));
$Title = "Transaksi_Gudang_Roll_Polos(".$tglAwal." - ".$tglAkhir.")";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$Title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h3>DETAIL KELUAR DAN MASUK STOK DARI POTONG </h3>
<table border="1" width="100%">
  <thead>
    <th>Ukuran</th>
    <th>Tanggal</th>
    <th>Berat</th>
    <th>Bobin</th>
    <th>Payung</th>
    <th>Payung Kuning</th>
    <th>Status</th>
    <th>Keterangan</th>
  </thead>
  <tbody>
    <?php foreach ($TransaksiGudangRoll as $arrData1) { ?>
    <tr>
      <td><?php echo $arrData1["barang"]; ?></td>
      <td><?php echo $arrData1["tgl_transaksi"]; ?></td>
      <td><?php echo $arrData1["berat"]; ?></td>
      <td><?php echo $arrData1["bobin"]; ?></td>
      <td><?php echo $arrData1["payung"]; ?></td>
      <td><?php echo $arrData1["payung_kuning"]; ?></td>
      <td><?php echo $arrData1["keterangan_history"]; ?></td>
      <td><?php echo $arrData1["keterangan_transaksi"]; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>


<h3>HASIL EXTRUDER</h3>
<table border="1" width="100%">
  <thead>
    <th>Ukuran</th>
    <th>Tanggal</th>
    <th>Berat</th>
    <th>Bobin</th>
    <th>Payung</th>
    <th>Payung Kuning</th>
    <th>Shift</th>
    <th>Status</th>
    <th>Keterangan</th>
  </thead>
  <tbody>
    <?php foreach ($TransaksiHasilExtruder as $arrData1) { ?>
    <tr>
      <td><?php echo $arrData1["barang"]; ?></td>
      <td><?php echo $arrData1["tgl_transaksi"]; ?></td>
      <td><?php echo $arrData1["berat"]; ?></td>
      <td><?php echo $arrData1["bobin"]; ?></td>
      <td><?php echo $arrData1["payung"]; ?></td>
      <td><?php echo $arrData1["payung_kuning"]; ?></td>
      <td><?php echo $arrData1["shift"]; ?></td>
      <td><?php echo $arrData1["keterangan_transaksi"]; ?></td>
      <td><?php echo $arrData1["keterangan_history"]; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
