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
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="text-blue">Bukti Penerimaan Barang</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <h4 class="text-blue">Penerimaan Barang</h4>
                <table class="table table-response table-striped" id="tablePenerimaanBarang">
                  <thead>
                    <th>No.</th>
                    <th>Kode Permintaan</th>
                    <th>Nama Barang</th>
                    <th>Warna</th>
                    <th>Jumlah Permintaan</th>
                    <th>Jumlah Diterima</th>
                    <th>Tgl. Terima</th>
                    <th>Penerima</th>
                    <th>Action</th>
                  </thead>
                </table>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <h4 class="text-blue">Penerimaan Spare Part</h4>
                <table class="table table-response table-striped" id="tablePenerimaanSparePart">
                  <thead>
                    <th>No.</th>
                    <th>Kode Permintaan</th>
                    <th>Nama Barang</th>
                    <th>Ukuran</th>
                    <th>Jumlah Permintaan</th>
                    <th>Jumlah Diterima</th>
                    <th>Tgl. Terima</th>
                    <th>Penerima</th>
                    <th>Action</th>
                  </thead>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>
