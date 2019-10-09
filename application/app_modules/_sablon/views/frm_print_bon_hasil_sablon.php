<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Produksi Terintegrasi</title>
    <style>
      .header{
        position: relative;
        widtd: 100%;
        text-align: center
      }
      .pull-right{
        float: right;
        text-align : right;
        padding-right: 10px;
        margin-bottom: 5px;
      }
      .h3{
        margin: 0;
        padding: 0;
      }
      .col-md-4{
        float: left;
        position: relative;
        width: 200px;
        text-align: left;
      }
      .wrapper{
        position: relative;
        margin-top: 20px;
      }
    </style>
  </head>
  <body>
    <div>
      <div class="header">
        <h3 class="h3"><b>Laporan Bon Hasil Sablon</b></h3>
        <div class="pull-right">
          <small>Tanggal : <?php echo date("d F Y",strtotime($this->uri->rsegment(3))); ?></small>
        </div>
      </div>
      <div>
        <table style="border:1px solid #4a4a4a; font-size:11pt;" width='100%'>
          <tr style="border-bottom:1px solid #4a4a4a;">
            <td align="center" style="border-bottom:1px solid #4a4a4a; border-right:1px solid #4a4a4a;" width="5%">No</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a; padding: 10px 0 10px 0;" width="10%"><b>Tanggal</b></td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Customer</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Merek</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Ukuran</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Warna Plastik</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Warna Cetak</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Hasil Lembar</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Hasil Berat</td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%">Status Bon</td>
          </tr>
          <?php $no =1; foreach ($bon_sablon->result_array() as $bon):?>
          <tr>
            <td align="center" style="border-bottom:1px solid #4a4a4a; border-right:1px solid #4a4a4a;" width="5%"><?php echo $no++ ?></td>
            <td align="center" style="border-bottom:1px solid #4a4a4a; padding: 5px 0 5px 0;" width="10%"><?php echo $bon['tanggal']; ?></td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%"><?php echo $bon['customer']; ?></td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%"><?php echo $bon['merek']; ?></td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%"><?php echo $bon['ukuran']; ?></td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%"><?php echo $bon['warna_plastik']; ?></td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%"><?php echo $bon['warna_cat']; ?></td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%"><?php echo $bon['hasil_lembar']; ?></td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%"><?php echo $bon['hasil_berat']; ?></td>
            <td align="center" style="border-bottom:1px solid #4a4a4a;" width="10%"><?php if ($bon['status_bon'] == 'TRUE') {echo "Sudah Dikirim";}else{echo "Belum Dikirim";} ?></td>
          </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  </body>
</html>
