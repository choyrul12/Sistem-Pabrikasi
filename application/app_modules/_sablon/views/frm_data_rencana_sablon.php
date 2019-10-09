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
       <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_rencanaSusulan" onclick="modal_rencanaSusulan()" ><i class="fa fa-plus"></i> Rencana Susulan</button>
    	<div class="table-responsive">
          <table class="table table-responsive table-striped" id="tableDataRencanaSablon">
            <thead>
            	<th>No</th>
          		<th>Tanggal Pengerjaan</th>
            	<th>Customer</th>
            	<th>Merek</th>
            	<th>Ukuran</th>
            	<th>Warna Plastik</th>
            	<th>Warna Cetak</th>
              <th>Jumlah Rencana</th>
            	<th>Sisa Rencana</th>
            	<th>Action</th>
            </thead>
          </table>
        </div>
    </section>
    <section>
      <div id="modal_inputhasil" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" style="width: 1050px;margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Form Input Hasil Sablon</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="content">
                <div id="form_hasil"></div>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_rencanaSusulan" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" style="width: 900px;margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Form Rencana Kerja Susulan Sablon</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:400px; overflow-y:scroll;">
            <div class="content">
              <div class='form-group col-md-6'>
                <label style='text-align:left;'>Kode Sablon :</label>
                <input type='text' class='form-control' value='' placeholder='Kode Sablon' name='kd_sablon' id='kd_sablon' readonly required>
              </div>
              <div class="form-group col-md-6">
                <label style='text-align:left;'>Tanggal Pengerjaan :</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tgl_rencana" id="tgl_rencana" placeholder="Tanggal Pengerjaan">
                </div>
              </div>
              <div class='form-group col-md-6'>
                <label style='text-align:left;'>Merek :</label>
                <select class="form-control" id='merekSablon' name='merek'>
                  <option value="">Pilih Merek Sablon</option>
                  
                </select>
              </div>
              <div class='form-group col-md-6'>
                <label style='text-align:left;'>Warna Cat :</label>
                <select class="form-control" id="w_cat" name="w_cat" onchange="warnaCat()">
                  <option value="" selected="selected">Pilih Warna</option>
                  <option value="putih">Putih</option>
                  <option value="biru">Biru</option>
                  <option value="hijau">Hijau</option>
                  <option value="merah">Merah</option>
                  <option value="coklat">Coklat</option>
                  <option value="kuning">Kuning</option>
                  <option value="hitam">Hitam</option>
                  <option value="violet">Violet</option>
                  <option value="HJ/HJ">Hijau/Hijau</option>
                  <option value="Custom">Custom</option>
                </select>
              </div>
              <div id="warna_custom"></div>
              <div class='form-group col-md-6'>
                <label style='text-align:left;'>Customer :</label>
                <input type='text' class='form-control' placeholder='Customer' id='customer' name='customer' required>
              </div>
              <div class='form-group col-md-6'>
                <label style='text-align:left;'>Jumlah Rencana :</label>
                <input type='number' class='form-control' placeholder='Jumlah Rencana' name='jml_rencana' id='jml_rencana' required>
              </div>
              <div class='form-group col-md-6'>
                <label style='text-align:left;'> Nama Operator :</label>
                <input type='text' class='form-control' placeholder='Nama Operator' name='nm_operator' id='nm_operator' required>
              </div>

              <div class='form-group col-md-12' style='text-align:center;'>
                <button class='btn btn-flat bg-navy' style='width:20%' onclick='addRencanaSusulan()'>SIMPAN</button>
              </div>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
</div>
<script type="text/javascript">
  function warnaCat()
  {
    var warna = $("#w_cat").val();
    if (warna == 'Custom') {
      $("#warna_custom").show();
      $("#warna_custom").html("<div class='form-group col-md-6'><label style='text-align:left;'>Warna Custom :</label><input type='text' class='form-control' placeholder='Warna Custom' id='w_catCustom' name='customer' required></div>");
    }else{
      $("#warna_custom").hide();
    }
  }
</script>
<script>
  var i = 2;
  function addInput()
  {
    if (i > 10) {
      $("#modal-notif").modal("show")
      $("#modalNotifContent").html("<div style='text-align: center;'><b>Kolom yang ditambah telah mencapai batas maksimum</b></div>");
      $("#modal-notif").addClass("modal-warning");
      setTimeout(function(){
        $("#modal-notif").modal("hide");
      },2000);
      setTimeout(function(){
        $("#modal-notif").removeClass("modal-warning");
        $("#modalNotifContent").text("");
      },3000);
    }else{
      $("<div class='col-md-12'></div><div class='form-group col-md-4'><select class='form-control' name='warna_cat[]' id='warna_cat"+i+"'></select></div><div class='form-group col-md-3' style='width:200px; padding-right:0px;'><input type='number' class='form-control' value='' placeholder='Jumlah Cat "+i+"' name='jum_cat[]' id='jum_cat' required></div><div class='form-group col-md-1' style='width:100px;'><select class='form-control' name='satuan_cat[]'><option value='Kg'>Kg</option><option value='Ons'>Ons</option></select></div><div class='form-group col-md-3' style='width:200px; padding-right:0px;'><input type='number' class='form-control' value='' placeholder='Sisa Cat "+i+"' name='sisa_cat[]' id='sisa_cat' required></div><div class='form-group col-md-1' style='width:100px;'><select class='form-control' name='satuan_sisaCat[]'><option value='Kg'>Kg</option><option value='Ons'>Ons</option></select></div>").appendTo("#dynamicInput"); 

        $("#warna_cat"+i+"").select2({
          placeholder : "Pilih Cat",
          dropdownParent : $("#modal_inputhasil"),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_sablon/main/getCatMurni",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.nm_barang+" ( "+item.warna+" )",
                    id:item.kd_gd_bahan
                  }
                })
              };
            }
          }
        });
      i++;
    }
  }
</script>


