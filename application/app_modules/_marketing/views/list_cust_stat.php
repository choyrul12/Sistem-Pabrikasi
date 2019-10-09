<style>
     .dataTable > thead > tr > td[class*="sort"]::after{display: none}
     .dataTable > thead > tr > th{background-color: #337ab7; color: #FFF;}
</style>
<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?></h1>
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
  </section>

  <section class="content">
    <table id="data-statistik-customer" class="table table-bordered table-responsive table-striped">
      <thead>
        <tr>
          <th rowspan="2" style="vertical-align: middle;">No.</th>
          <th rowspan="2" style="vertical-align: middle;">Nama Perusahaan</th>
          <th colspan="3" style="vertical-align: middle;"><center>Jumlah</center></th>
        </tr>
        <tr>
          <td><center>Kg</center></th>
          <td><center>Lembar</center></th>
          <td><center>Bal</center></td>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </section>
</div>
