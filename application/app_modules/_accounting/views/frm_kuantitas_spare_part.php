<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?> <span id="title_kuantitas"></span></h1>
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive table-striped table-bordered" id="tableDataKuantitasSparePart">
                  <thead>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kode</th>
                    <th>Ukuran</th>
                    <th>Stok</th>
                    <th>Last Update</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <a href="#" id="btnPrintLaporan" class="btn btn-md btn-flat btn-success"><i class="fa fa-download"></i> Export To Excel</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
