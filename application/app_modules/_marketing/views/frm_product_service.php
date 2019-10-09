<style>
  .img-hover:hover{
    transform: scale(3);
    z-index: 1000;
    transition: 1s;
  }
  .img-hover{
    transition: 1s;
  }
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
      <table class="table" style="width:80%">
        <?php
          foreach ($CustomerData as $arrCustomerData) {
        ?>
        <tr>
          <td width="20%">No. Customer</td>
          <td width="1%">:</td>
          <td>
            <input type="text" class="form-control" readonly style="width:35%" name="txt_no_cust" value="<?php echo $arrCustomerData['kd_cust']; ?>">
          </td>
        </tr>
        <tr>
          <td>Nama Perusahaan</td>
          <td>:</td>
          <td>
            <input type="text" class="form-control" readonly style="width:50%" name="txt_nm_perusahaan" value="<?php echo $arrCustomerData['nm_perusahaan']; ?>">
          </td>
        </tr>
        <?php } ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>
            <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#product_service_modal">Tambah Data Produk Servis</button>
          </td>
        </tr>
      </table>

      <div class="modal fade" id="product_service_modal" role="dialog">
        <div class="modal-dialog modal-lg">
          <?php echo form_open_multipart(base_url()."_marketing/main/saveProductService/".$this->uri->rsegment(3)); ?>
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Tambah Produk Service</h4>
            </div>
            <div class="modal-body" id="bodyModal">

                <table class="table">
                  <tr>
                    <td width="20%">Nama Produk</td>
                    <td width="1%">:</td>
                    <td>
                      <input type="text" id="txt_nm_produk" name="txt_nm_produk" class="form-control" placeholder="Masukan Nama Produk">
                    </td>
                  </tr>
                  <tr>
                    <td>Ukuran</td>
                    <td>:</td>
                    <td>
                      <input type="text" id="txt_ukuran" name="txt_ukuran" class="form-control" placeholder="Masukan Ukuran Produk">
                    </td>
                  </tr>
                  <tr>
                    <td>Harga</td>
                    <td>:</td>
                    <td>
                      <input type="text" id="txt_harga1" name="txt_harga" class="form-control" placeholder="Masukan Harga Produk">
                    </td>
                  </tr>
                  <tr>
                    <td>Term Payment</td>
                    <td>:</td>
                    <td>
                      <input type="text" id="txt_payment" name="txt_payment" class="form-control" placeholder="Masukan Term Payment">
                    </td>
                  </tr>
                  <tr>
                    <td>Merek</td>
                    <td>:</td>
                    <td>
                      <input type="text" id="txt_merek" name="txt_merek" class="form-control" placeholder="Masukan Merek Produk">
                    </td>
                  </tr>
                  <tr>
                    <td>Gambar</td>
                    <td>:</td>
                    <td>
                      <input type="file" id="txt_file" name="txt_file" class="form-control">
                      <p class="text-danger">Max. Size 1MB</p>
                    </td>
                  </tr>
                  <tr>
                    <td>Note</td>
                    <td>:</td>
                    <td>
                      <textarea id="txt_note" name="txt_note"></textarea>
                    </td>
                  </tr>
                </table>
              <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <input type="submit" id="btn-simpan" class="btn btn-primary" value="Simpan Data">
            </div>
          </div><!-- modal-content -->
        </form>
        </div><!-- modal-dialog -->
      </div><!-- modal -->

      <table id="product_service" class="table table-striped table-responsive">
        <thead>
          <th>Produk</th>
          <th>Ukuran</th>
          <th>Harga</th>
          <th>Term Payment</th>
          <th>Merek</th>
          <th>Gambar</th>
          <th>Pilihan</th>
        </thead>

        <tbody>
          <?php
            foreach ($ProductService as $arrProductService) {
          ?>
          <tr>
            <td><?php echo $arrProductService["servis_produk"]; ?></td>
            <td><?php echo $arrProductService["ukuran"]; ?></td>
            <td><?php echo $arrProductService["harga"]; ?></td>
            <td><?php echo $arrProductService["term_payment"]; ?></td>
            <td><?php echo $arrProductService["merek"]; ?></td>
            <td>
                <img src="<?php echo base_url()."assets/images/upload/".$arrProductService["foto"]; ?>" alt="Gambar Tidak Ada" width="50px" height="50px" data-toggle="modal" data-target="#modalShowImage" onclick="showImage(this)">
            </td>
            <td>
              <a href="<?php echo base_url() ?>_marketing/main/show_product_service_note/<?php echo $arrProductService["id_sp"]; ?>" class="btn btn-xs btn-info modal_link" data-toggle="modal"><i class="fa fa-sticky-note-o"></i> Note</a> &nbsp;
              <a href="<?php echo base_url() ?>_marketing/main/edit_product_service/<?php echo $arrProductService["id_sp"]; ?>" class="btn btn-xs btn-warning modal_link" data-toggle="modal"><i class="fa fa-edit"></i> Ubah</a> &nbsp;
              <a href="#" class="btn btn-xs btn-danger" onclick="deleteProductService('<?php echo $arrProductService["id_sp"]; ?>')"><i class="fa fa-trash"></i> Hapus</a> &nbsp;
              <button type="button" class="btn btn-xs btn-danger" onclick="deleteImageProductService('<?php echo $arrProductService["id_sp"]; ?>')"><i class="fa fa-remove"></i> Hapus Gambar </button>&nbsp;
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

  </section>
</div>
<script type="text/javascript">
  CKEDITOR.replace("txt_note");
</script>
