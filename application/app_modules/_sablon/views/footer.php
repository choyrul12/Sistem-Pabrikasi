	<footer class="main-footer">
          <div class="pull-right hidden-xs">
              <b>Beta Version</b> V 0.0.1
          </div>
          <strong>Copyright &copy; 2017 <a href="http://www.klipplastik.co.id">Klip Plastik Indonesia</a>
        </footer>
      </div> <!--Wrapper-->
      <!-- jQuery 2.2.3 -->
      <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
      <!-- Bootstrap 3.3.6 -->
      <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
      <!-- FastClick -->
      <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
      <!-- AdminLTE App -->
      <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
      <!-- Sparkline -->
      <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
      <!-- jvectormap -->
      <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
      <!-- SlimScroll 1.3.0 -->
      <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
      <!-- ChartJS 1.0.1 -->
      <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>

      <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/input-mask/inputmask.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/input-mask/inputmask.numeric.extensions.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/fixedheader/js/dataTables.fixedHeader.min.js"></script>

      <script type="text/javascript">
        $(function () {
          datatableRencanaPIC();
          datatableRencanaSablon();
          datatablePengembalianHD();
          // datatableHasilSablon()
        });
      </script>
      <script type="text/javascript">
        $('.date').datepicker({
              language: 'id',
              viewMode: 'years',
              format: 'yyyy-mm-dd',
              autoclose : true,
              todayHighlight : true
          });
      </script>
      <script type="text/javascript">
      	function datatableRencanaPIC(){
        $("#tableDataRencanaPIC").dataTable().fnDestroy();
        $("#tableDataRencanaPIC").dataTable({
					// "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "bJQueryUI" : true,
          "sPaginationType" : "full_numbers",
          "sAjaxSource" : "<?php echo base_url(); ?>_sablon/main/getDataRencanaPIC",
          "aoColumnDefs": [
            { "sWidth": "10%", "aTargets": [ -1 ] }
        ],
          "columns" : [
            {"data" : "kd_ppic", "name" : "kd_ppic"},
            {"data" : "tgl_rencana", "name" : "tgl_rencana"},
            {"data" : "nm_cust", "name" : "nm_cust"},
            {"data" : "merek", "name" : "merek"},
            {"data" : "jns_permintaan", "name" : "jns_permintaan"},
            {"data" : "ukuran", "name" : "ukuran"},
            {"data" : "warna_plastik", "name" : "warna_plastik"},
            {"data" : "warna_cetak", "name" : "warna_cetak"},
            {"data" : "jumlah_permintaan", "name" : "jumlah_permintaan"},
            {"data" : "sisa", "name" : "sisa"},
            {"data" : "prioritas", "name" : "prioritas"},
            {"data" : "keterangan", "name" : "keterangan"},
            {"data" : "satuan_kilo", "name" : "satuan_kilo"},
            {"data" : "kd_ppic", "name" : "kd_ppic"}
          ],
          "fnServerData" : function(sSource,aoData,fnCallback){
            $.ajax({
              "type"      : "POST",
              "dataType"  : "JSON",
              "url"       : sSource,
              "data"      : aoData,
              "success"   : fnCallback
            });
          },
          "fnRowCallback" : function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(0)",nRow).text(++iDisplayIndex);
            $("td:eq(8)",nRow).html(+parseInt(aData["jumlah_permintaan"]));
            if (aData["prioritas"]=="URGENT") {
              $("td:eq(10)",nRow).html("<b style='color:red;'>"+aData["prioritas"]+"</b>");
            }
            if (!aData['satuan_kilo']) {
              $("td:eq(9)",nRow).html(+parseInt(aData["sisa"]));
              $("td:eq(12)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' onclick=conversiKG('"+aData['kd_ppic']+"')><i class='fa fa-balance-scale'> Conversi Kg</i></button>");
              $("td:eq(13)",nRow).html("");
            }else{
              $("td:eq(9)",nRow).html(+parseInt(aData["sisa"]));
              $("td:eq(12)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' onclick=buatRencana('"+aData['kd_ppic']+"') title='Tambah Rencana'><i class='fa fa-plus'>  Rencana&nbsp;&nbsp; </i></button>");
              $("td:eq(13)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' onclick=editconversiKG('"+aData['kd_ppic']+"') title='Edit Konversi'><i class='fa fa-edit'> Konversi</i></button>");
            }

          }
        });
      }

      </script>

      <script type="text/javascript">
      function conversiKG(id){
         $.ajax({
            type : "POST",
            url : "<?php echo site_url('_sablon/main/getDataConversi'); ?>",
            data : {kd_ppic : id},
            success : function(response){
              $("#form").html(response);
            }
          });

         $("#ModalConversi").modal({backdrop:"static"});
      }
      </script>

      <script type="text/javascript">
      function editconversiKG(id){
         $.ajax({
            type : "POST",
            url : "<?php echo site_url('_sablon/main/editDataConversi'); ?>",
            data : {kd_ppic : id},
            success : function(response){
              $("#form").html(response);
            }
          });

         $("#ModalConversi").modal({backdrop:"static"});
      }
      </script>

      <script type="text/javascript">
        function convertKG()
        {
          var kd_ppic = $("#kd_ppic").val();
          var konversi= $("#konversi").val();
          if (konversi == "" || konversi == 0) {
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Kolom Tidak Boleh Kosong</b></div>");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
            },2000);
            setTimeout(function(){
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },3000);
          }else{
            $.ajax({
            type : "POST",
            url : "<?php echo site_url('_sablon/main/convertKG'); ?>",
            data : {kd_ppic : kd_ppic, konversi : konversi},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $('#ModalConversi').modal('hide');
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Berhasil di Conversi</b></div>");
                $("#modal-notif").addClass("modal-info");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableRencanaPIC();
                },3000);
              }else if(jQuery.trim(response) === "Gagal"){
                $('#ModalConversi').modal('hide');
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Gagal di Conversi</b></div>");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },3000);
              }
            }
            });
          }
        }
      </script>

      <script type="text/javascript">
        function buatRencana(id){
          $.ajax({
            type : "POST",
            url : "<?php echo site_url('_sablon/main/buatRencana'); ?>",
            data : {kd_ppic : id},
            success : function(response){
              $("#form_rencana").html(response);
              datatableListRencana(id);
              $("#ModalRencana").modal({backdrop:"static"});
              $('.date').datepicker({
                  language: 'id',
                  viewMode: 'years',
                  format: 'yyyy-mm-dd',
                  autoclose : true,
                  todayHighlight : true
              });
            }
          });
        }
      </script>

      <script type="text/javascript">
        function datatableListRencana(id){
          $("#tableListRencana").dataTable().fnDestroy();
          $("#tableListRencana").dataTable({
						// "fixedHeader" : true,
            "autoWidth"   : false,
            "ordering"    : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI"   : true,
            "sPaginationType" : "full_numbers",
            "sAjaxSource" : '<?php echo base_url(); ?>_sablon/main/getDataRencanaTemp/'+id+'',
            "aoColumnDefs": [{ "sWidth"  : "10%", "aTargets": [ -1 ] }],
            "columns" : [
              {"data" : "kd_ppic", "name" : "kd_ppic"},
              {"data" : "merek", "name" : "merek"},
              {"data" : "ukuran", "name" : "ukuran"},
              {"data" : "tgl_rencana", "name" : "tgl_rencana"},
              {"data" : "warna_plastik", "name" : "warna_plastik"},
              {"data" : "warna_sablon", "name" : "warna_sablon"},
              {"data" : "jml_rencana", "name" : "jml_rencana"},
              {"data" : "kd_sablon", "name" : "kd_sablon"}
            ],
            "fnServerData" : function(sSource,aoData,fnCallback){
              $.ajax({
                "type"      : "POST",
                "dataType"  : "JSON",
                "url"       : sSource,
                "data"      : aoData,
                "success"   : fnCallback
              });
            },
            "fnRowCallback" : function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(0)",nRow).text(++iDisplayIndex);
              $("td:eq(7)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' title='Edit' onclick=editListRencana('"+aData['kd_sablon']+"')><i class='fa fa-edit'></i></button><button class='btn btn-sm btn-flat btn-danger' title='Delete' onclick=deleteListRencana('"+aData['kd_sablon']+"','"+aData['kd_ppic']+"','"+aData['jml_rencana']+"')><i class='fa fa-trash-o'>&nbsp;</i></button><input type='hidden' value='"+aData['kd_ppic']+"' id='check'>");
            }
          });
        }
      </script>

      <script type="text/javascript">
        function addRencana(){
          var kd_ppic       = $("#kd_ppic").val();
          var kd_sablon     = $("#kd_sablon").val();
          var kd_gd_hasil   = $("#kd_gd_hasil").val();
          var customer      = $("#customer").val();
          var merek         = $("#merek").val();
          var tgl_rencana   = $("#tgl_rencana").val();
          var ukuran        = $("#ukuran").val();
          var warna_plastik = $("#warna_plastik").val();
          var warna_sablon  = $("#warna_sablon").val();
          var nm_operator   = $("#nm_operator").val();
          var jml_permintaan= $("#jml_permintaan").val();
          var jml_rencana   = $("#jml_rencana").val();
          var satuan_kilo   = $("#satuan_kilo").val();
          if (!kd_sablon || !nm_operator || !tgl_rencana || !jml_rencana) {

            $("#modal-notif").modal("show")
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Kolom Tidak Boleh Kosong</b></div>");
            $("#modal-notif").addClass("modal-warning");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
            },2000);
            setTimeout(function(){
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },3000);

          }else{

            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('_sablon/main/addRencana') ?>",
              data : {kd_ppic : kd_ppic, kd_sablon : kd_sablon, kd_gd_hasil : kd_gd_hasil, customer : customer, merek : merek, tgl_rencana : tgl_rencana, ukuran : ukuran, warna_plastik : warna_plastik, warna_sablon : warna_sablon, nm_operator : nm_operator, jml_permintaan : jml_permintaan, jml_rencana : jml_rencana, satuan_kilo:satuan_kilo},
              success:function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  datatableListRencana();
                  datatableRencanaPIC();
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>List Rencana Berhasil Ditambah</b></div>");
                  $("#modal-notif").addClass("modal-info");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                  },2000);
                  setTimeout(function(){
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                  },3000);
                }else if (jQuery.trim(response) === "Gagal"){
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>List Rencana Gagal Ditambah</b></div>");
                  $("#modal-notif").addClass("modal-danger");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                  },2000);
                  setTimeout(function(){
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },3000);
                }
              }
            });
          }
        }
      </script>

      <script type="text/javascript">
        function deleteListRencana(id,kd_ppic,jml_rencana){
          var sisa_sekarang = $("#sisa_sekarang").val();
          var jml_rencana = jml_rencana;
          var sisa =parseFloat(sisa_sekarang)+parseFloat(jml_rencana);
          var r = confirm("Hapus Rencana Sablon ?");
          if (r == true) {
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('_sablon/main/deleteRencana'); ?>",
              data : {kd_sablon : id, kd_ppic : kd_ppic, sisa : sisa},
              success:function(response){
                if (jQuery.trim(response) === 'Berhasil') {
                  datatableListRencana();
                  buatRencana(kd_ppic);
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>List Rencana Berhasil Dihapus</b></div>");
                  $("#modal-notif").addClass("modal-info");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                  },2000);
                  setTimeout(function(){
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                  },3000);
                }else if (jQuery.trim(response) === 'Gagal') {
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>List Rencana Gagal Dihapus</b></div>");
                  $("#modal-notif").addClass("modal-danger");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                  },2000);
                  setTimeout(function(){
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },3000);
                }
              }
            });
          } else {

          }
        }
      </script>

      <script type="text/javascript">
        function editListRencana(id){
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_sablon/main/editRencana') ?>",
            data : {kd_sablon : id},
            success: function(response){
              $("#form_editRencana").html(response);
              $("#modal_editRencana").modal({backdrop:"static"});
            }
          });
        }
      </script>

      <script type="text/javascript">
        function updateRencana(){
          var kd_sablon   = $("#1").val();
          var nm_operator = $("#2").val();
          var jml_rencana = $("#3").val();
          var tgl_rencana = $("#4").val();
          var jml_sebelum = $("#5").val();
          var kd_ppic = $('#kd_ppic').val();
          var sisa_sekarang = $("#sisa_sekarang").val();

          var re_sisa = parseFloat(sisa_sekarang)+parseFloat(jml_sebelum);
          var sisa = parseFloat(re_sisa) - parseFloat(jml_rencana);

          if (!kd_sablon || !nm_operator || !tgl_rencana || !jml_rencana) {

            $("#modal-notif").modal("show")
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Kolom Tidak Boleh Kosong</b></div>");
            $("#modal-notif").addClass("modal-warning");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
            },2000);
            setTimeout(function(){
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },3000);

          }else{

            $.ajax({
              type : "POST",
              url  : "<?php echo site_url("_sablon/main/updateRencana") ?>",
              data : {kd_ppic : kd_ppic, kd_sablon : kd_sablon, nm_operator : nm_operator, tgl_rencana : tgl_rencana, jml_rencana : jml_rencana, sisa : sisa},
              success: function(response){
                if (jQuery.trim(response) == "Success") {
                  $("#modal_editRencana").modal("hide");
                  datatableListRencana();
                  buatRencana(kd_ppic);
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>List Rencana Berhasil Diperbarui</b></div>");
                  $("#modal-notif").addClass("modal-info");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                  },2000);
                  setTimeout(function(){
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                  },3000);
                }else if(jQuery.trim(response) == "Failed"){
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>List Rencana Gagal Diperbarui</b></div>");
                  $("#modal-notif").addClass("modal-danger");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                  },2000);
                  setTimeout(function(){
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },3000);
                }
              }
            });
          }
        }
      </script>

      <script type="text/javascript">
        function saveRencana(id)
        {
          var kd_ppic = id;
          var check   = $("#check").val();
          if (!check) {
            $("#modal-notif").modal("show")
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak Ada Rencana</b></div>");
            $("#modal-notif").addClass("modal-warning");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
            },2000);
            setTimeout(function(){
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },3000);
          }else{
            $.ajax({
            type : "POST",
            url  : "<?php echo site_url("_sablon/main/saveRencana") ?>",
            data : {kd_ppic : kd_ppic},
            success: function(response){
              if (jQuery.trim(response) == "Success") {
                $("#modal_editRencana").modal("hide");
                datatableListRencana();
                buatRencana(kd_ppic);
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Berhasil Disimpan</b></div>");
                $("#modal-notif").addClass("modal-info");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                },3000);
              }else if (jQuery.trim(response) == "Failed") {
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Gagal Disimpan</b></div>");
                $("#modal-notif").addClass("modal-danger");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },3000);
              }
            }
          });
          }
        }
      </script>

      <script type="text/javascript">
        function datatableRencanaSablon(){
        $("#tableDataRencanaSablon").dataTable().fnDestroy();
        $("#tableDataRencanaSablon").dataTable({
					// "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "bJQueryUI" : true,
          "sPaginationType" : "full_numbers",
          "sAjaxSource" : "<?php echo base_url(); ?>_sablon/main/getDataRencanaSablon",
          "aoColumnDefs": [
            { "sWidth": "10%", "aTargets": [ -1 ] }
        ],
          "columns" : [
            {"data" : "kd_sablon", "name" : "kd_sablon"},
            {"data" : "tgl_rencana", "name" : "tgl_rencana"},
            {"data" : "customer", "name" : "customer"},
            {"data" : "merek", "name" : "merek"},
            {"data" : "ukuran", "name" : "ukuran"},
            {"data" : "warna_plastik", "name" : "warna_plastik"},
            {"data" : "warna_sablon", "name" : "warna_sablon"},
            {"data" : "jml_rencana", "name" : "jml_rencana"},
            {"data" : "jml_sisa", "name" : "jml_sisa"},
            {"data" : "kd_sablon", "name" : "kd_sablon"}
          ],
          "fnServerData" : function(sSource,aoData,fnCallback){
            $.ajax({
              "type"      : "POST",
              "dataType"  : "JSON",
              "url"       : sSource,
              "data"      : aoData,
              "success"   : fnCallback
            });
          },
          "fnRowCallback" : function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(0)",nRow).text(++iDisplayIndex);
            $("td:eq(7)",nRow).text(+aData["jml_rencana"]);
            $("td:eq(8)",nRow).text(+aData["jml_sisa"]);
            $("td:eq(9)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' onclick=inputHasil('"+aData['kd_sablon']+"') title='Input Hasil'>Input Hasil</button>");
            if (aData["prioritas"]=="URGENT") {
              $("td:eq(9)",nRow).html("<b style='color:red;'>"+aData["prioritas"]+"</b>");
            }
          }
        });
      }
    </script>
    <script type="text/javascript">
      function inputHasil(key)
      {
        var kd_sablon = key;
        $.ajax({
          type : "POST",
          url  : "<?php echo site_url("_sablon/main/inputHasil");?>",
          data : {kd_sablon : kd_sablon},
          success:function(response){
            $("#form_hasil").html(response);
            $("#modal_inputhasil").modal({backdrop:"static"});

            $("#warna_cat").select2({
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

            $("#minyak").select2({
              placeholder : "Pilih Minyak",
              dropdownParent : $("#modal_inputhasil"),
              width : "100%",
              cache:true,
              allowClear:true,
              ajax:{
                url : "<?php echo base_url(); ?>_sablon/main/getMinyak",
                dataType : "JSON",
                delay : 0,
                processResults : function(data){
                  return{
                    results : $.map(data, function(item){
                      return{
                        text:item.nm_barang,
                    id:item.kd_gd_bahan
                      }
                    })
                  };
                }
              }
            });
          }
        });
      }
    </script>

    <script type="text/javascript">
      function saveHasilSablon(){
        var kd_ppic     = $("#kd_ppic").val();
        var kd_sablon   = $("#kd_sablon").val();
        var kd_gd_hasil = $("#kd_gd_hasil").val();
        var merek       = $("#merek").val();
        var tgl_rencana = $("#tgl_pengerjaan").val();
        var ukuran      = $("#ukuran").val();
        var w_plastik   = $("#warna_plastik").val();
        var w_sablon    = $("#warna_sablon").val();
        var hasil_lembar= $("#hasil_lembar").val();
        var hasil_berat = $("#hasil_berat").val();
        var jenis_barang= $("#jenis_barang").val();
        var keterangan  = $("#keterangan").val();
        var id_user     = $("#id_user").val();
        var kd_hasil    = $("#kd_hasil").val();
        var jml_sisa    = $("#jml_sisa").val();
        var jml_hasil   = $("#jml_hasil").val();
        var totHasil    = parseFloat(jml_hasil) + parseFloat(hasil_lembar);
        var sisa        = jml_sisa - hasil_lembar;

        var warna_cat = [];
        var stuff = $('select[name="warna_cat[]"]').each(function(i, item) {
           warna_cat.push(item.value);
        });

        var jum_cat = [];
        var stuff = $('input[name="jum_cat[]"]').each(function(i, item) {
           jum_cat.push(item.value);
        });

        var satuan_cat = [];
        var stuff = $('select[name="satuan_cat[]"]').each(function(i, item) {
           satuan_cat.push(item.value);
        });

        var sisa_cat = [];
        var stuff = $('input[name="sisa_cat[]"]').each(function(i, item) {
           sisa_cat.push(item.value);
        });

        var satuan_sisaCat = [];
        var stuff = $('select[name="satuan_sisaCat[]"]').each(function(i, item) {
           satuan_sisaCat.push(item.value);
        });

        var minyak = $("#minyak").val();
        var jum_minyak = $("#jum_minyak").val();
        var satuan_minyak = $("#satuan_minyak").val();
        var sisa_minyak = $("#sisa_minyak").val();
        var satuan_sisaMinyak = $("#satuan_sisaMinyak").val();

        $.ajax({
          type : "POST",
          url  : "<?php echo site_url("_sablon/main/saveHasilSablon"); ?>",
          data : {kd_ppic : kd_ppic, kd_hasil : kd_hasil, kd_sablon : kd_sablon, kd_gd_hasil : kd_gd_hasil, merek : merek, tgl_rencana : tgl_rencana, ukuran : ukuran, w_plastik : w_plastik, w_sablon : w_sablon, hasil_lembar : hasil_lembar, hasil_berat : hasil_berat, jenis_barang : jenis_barang, keterangan : keterangan, id_user : id_user, warna_cat : warna_cat, jum_cat : jum_cat, sisa_cat : sisa_cat, minyak : minyak, jum_minyak : jum_minyak, sisa_minyak : sisa_minyak, sisa : sisa, totHasil : totHasil, satuan_cat : satuan_cat, satuan_sisaCat : satuan_sisaCat, satuan_minyak : satuan_minyak, satuan_sisaMinyak : satuan_sisaMinyak},
          success: function(response){
            if (jQuery.trim(response) == "Success") {
              datatableRencanaSablon();
              $("#modal_inputhasil").modal("hide");
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Hasil Sablon Berhasil Disimpan</b></div>");
              $("#modal-notif").addClass("modal-info");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
              },2000);
              setTimeout(function(){
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
              },3000);
            }else if (jQuery.trim(response) == "Failed") {
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Hasil Sablon Gagal Disimpan</b></div>");
              $("#modal-notif").addClass("modal-danger");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
              },2000);
              setTimeout(function(){
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },3000);
            }else if (jQuery.trim(response) == "Empty") {
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Kolom Tidak Boleh Kosong</b></div>");
              $("#modal-notif").addClass("modal-warning");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
              },2000);
              setTimeout(function(){
                $("#modal-notif").removeClass("modal-warning");
                $("#modalNotifContent").text("");
              },3000);
            }
          }
        });
      }
    </script>

    <script type="text/javascript">
        function datatableHasilSablon(){
        $("#tableDataHasilSablon").dataTable().fnDestroy();
        $("#tableDataHasilSablon").dataTable({
					// "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "bJQueryUI" : true,
          "sPaginationType" : "full_numbers",
          "sAjaxSource" : "<?php echo base_url(); ?>_sablon/main/getDataHasilSablon",
          "aoColumnDefs": [{ "sWidth": "10%", "aTargets": [ -1 ] }],
          "columns" : [
            {"data" : "kd_sablon", "name" : "b.kd_sablon"},
            {"data" : "tanggal", "name" : "b.tanggal"},
            {"data" : "customer", "name" : "a.customer"},
            {"data" : "merek", "name" : "b.merek"},
            {"data" : "ukuran", "name" : "b.ukuran"},
            {"data" : "warna_plastik", "name" : "b.warna_plastik"},
            {"data" : "warna_cat", "name" : "b.warna_cat"},
            {"data" : "hasil_lembar", "name" : "b.hasil_lembar"},
            {"data" : "hasil_berat", "name" : "b.hasil_berat"},
            {"data" : "kd_sablon", "name" : "b.kd_sablon"}
          ],
          "fnServerData" : function(sSource,aoData,fnCallback){
            $.ajax({
              "type"      : "POST",
              "dataType"  : "JSON",
              "url"       : sSource,
              "data"      : aoData,
              "success"   : fnCallback
            });
          },
          "fnRowCallback" : function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(0)",nRow).text(++iDisplayIndex);
            if (aData["prioritas"]=="URGENT") {
              $("td:eq(10)",nRow).html("<b style='color:red;'>"+aData["prioritas"]+"</b>");
            }
            $("td:eq(9)",nRow).html("<button class='btn btn-sm btn-flat btn-primary'  onclick=detailHasilSablon('"+aData['kd_hasil_sablon']+"') title='Detail Hasil'><i class='fa fa-navicon '> Detail</i></button>");
          }
        });
      }
      </script>
      <script type="text/javascript">
        function cariHasilSablon()
        {
          var tgl1 = $('#tgl_awal').val();
          var tgl2 = $('#tgl_akhir').val();
          if (!tgl2 || !tgl2) {
            $("#modal-notif").modal("show")
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Tanggal Harus Dipilih</b></div>");
            $("#modal-notif").addClass("modal-warning");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
            },2000);
            setTimeout(function(){
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },3000);
          }else{
            $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_sablon/main/checkHasilSablon') ?>",
            data : {tgl1 : tgl1, tgl2 : tgl2},
            success: function(response){
              if (jQuery.trim(response) > 0) {
                $("#tableDataHasilSablonPerTgl").show();
                datatableHasilSablonPerTgl(tgl1,tgl2);
                document.getElementById("tgl1").value = tgl1;
                document.getElementById("tgl2").value = tgl2;
                $("#modal_cariHasilSablon").modal('hide');
                var d1 = tgl1.split('-');
                var d2 = tgl2.split('-');
                $("#tanggal").html('('+d1[2] +'-'+ d1[1] +'-'+ d1[0]+' s/d '+d2[2] +'-'+ d2[1] +'-'+ d2[0]+')');
              }else{
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak Ada Hasil</b></div>");
                $("#modal-notif").addClass("modal-warning");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-warning");
                  $("#modalNotifContent").text("");
                },3000);
              }
            }
          });
          }
        }
      </script>

      <script type="text/javascript">
        function cariBonHasilSablon()
        {
          var tgl = $('#tgl_cari').val();
          if (!tgl) {
            $("#modal-notif").modal("show")
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Tanggal Harus Dipilih</b></div>");
            $("#modal-notif").addClass("modal-warning");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
            },2000);
            setTimeout(function(){
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },3000);
          }else{
            $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_sablon/main/checkBonHasilSablon') ?>",
            data : {tgl : tgl},
            success: function(response){
              if (jQuery.trim(response) > 0) {
                $("#tableDataBonHasilSablonPerTgl").show();
                datatableBonHasilSablonPerTgl(tgl);
                var d = tgl.split('-');
                $("#tanggal").html('('+d[2] +'-'+ d[1] +'-'+ d[0]+')');
                $("#Modal_HasilSablon").modal('show');
                $("#modal_cariHasilSablon").modal('hide');
                $("#button").html('<div class="form-group" style="text-align: center; margin-bottom: 5px;"><button type="submit" onclick=kirimHasilSablon("'+tgl+'") class="btn btn-flat bg-navy margin" style="width: 15%;"><b><i class="fa fa-check"></i>  KIRIM</b></button><a href="<?php echo base_url();?>_sablon/main/printBonSablon/'+tgl+'" target="_blank" type="button" class="btn btn-flat bg-navy margin" style="width: 15%;"><b><i class="fa fa-print"></i>  PRINT</b></a></div>')
              }else{
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak Ada Hasil</b></div>");
                $("#modal-notif").addClass("modal-warning");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-warning");
                  $("#modalNotifContent").text("");
                },3000);
              }
            }
          });
          }
        }
      </script>

      <script type="text/javascript">
      function datatableHasilSablonPerTgl(tgl1,tgl2){
        $("#tableDataHasilSablonPerTgl").dataTable().fnDestroy();
        $("#tableDataHasilSablonPerTgl").dataTable({
					// "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "bJQueryUI" : true,
          "sPaginationType" : "full_numbers",
          "sAjaxSource" : "<?php echo base_url(); ?>_sablon/main/getHasilSablonPerTgl/"+tgl1+"/"+tgl2+"",
          "aoColumnDefs": [{ "sWidth": "10%", "aTargets": [ -1 ] }],
          "columns" : [
            {"data" : "kd_sablon", "name" : "b.kd_sablon"},
            {"data" : "tanggal", "name" : "b.tanggal"},
            {"data" : "customer", "name" : "a.customer"},
            {"data" : "merek", "name" : "b.merek"},
            {"data" : "ukuran", "name" : "b.ukuran"},
            {"data" : "warna_plastik", "name" : "b.warna_plastik"},
            {"data" : "warna_cat", "name" : "b.warna_cat"},
            {"data" : "hasil_lembar", "name" : "b.hasil_lembar"},
            {"data" : "hasil_berat", "name" : "b.hasil_berat"},
            {"data" : "jns_brg", "name" : "b.jns_brg"},
            {"data" : "kd_hasil_sablon", "name" : "b.kd_hasil_sablon"},
            {"data" : "kd_hasil_sablon", "name" : "b.kd_hasil_sablon"}
          ],
          "fnServerData" : function(sSource,aoData,fnCallback){
            $.ajax({
              "type"      : "POST",
              "dataType"  : "JSON",
              "url"       : sSource,
              "data"      : aoData,
              "success"   : fnCallback
            });
          },
          "fnRowCallback" : function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            var d = aData["tanggal"].split('-');
            $("td:eq(1)",nRow).html(d[2] +'-'+ d[1] +'-'+ d[0]);
            $("td:eq(0)",nRow).text(++iDisplayIndex);
            if (aData['status_bon'] == "FALSE") {
              $("td:eq(10)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' onclick=detailHasilSablon('"+aData['kd_hasil_sablon']+"') title='Detail Hasil'><i class='fa fa-navicon '> Detail</i></button>");
              $("td:eq(11)",nRow).html("<button class='btn btn-sm btn-flat btn-danger' onclick=deleteHasilSablon('"+aData['kd_hasil_sablon']+"','"+aData['kd_sablon']+"') title='Hapus Hasil'><i class='fa fa-trash'> Hapus</i></button>");
            }else{
              $("td:eq(10)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' onclick=detailHasilSablon('"+aData['kd_hasil_sablon']+"') title='Delete Hasil'><i class='fa fa-navicon '> Detail</i></button>");
              $("td:eq(11)",nRow).html("");
            }
          }
        });
      }
      </script>

      <script type="text/javascript">
        function datatableBonHasilSablonPerTgl(tgl){
          $("#tableDataBonHasilSablonPerTgl").dataTable().fnDestroy();
          $("#tableDataBonHasilSablonPerTgl").dataTable({
						// "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI" : true,
            "sPaginationType" : "full_numbers",
            "sAjaxSource" : "<?php echo base_url(); ?>_sablon/main/getBonHasilSablonPerTgl/"+tgl+"",
            "aoColumnDefs": [
              { "sWidth": "10%", "aTargets": [ -1 ] }
          ],
            "columns" : [
              {"data" : "kd_sablon", "name" : "b.kd_sablon"},
              {"data" : "tanggal", "name" : "b.tanggal"},
              {"data" : "customer", "name" : "a.customer"},
              {"data" : "merek", "name" : "b.merek"},
              {"data" : "ukuran", "name" : "b.ukuran"},
              {"data" : "warna_plastik", "name" : "b.warna_plastik"},
              {"data" : "warna_cat", "name" : "b.warna_cat"},
              {"data" : "hasil_lembar", "name" : "b.hasil_lembar"},
              {"data" : "hasil_berat", "name" : "b.hasil_berat"},
              {"data" : "status_bon", "name" : "b.status_bon"}
            ],
            "fnServerData" : function(sSource,aoData,fnCallback){
              $.ajax({
                "type"      : "POST",
                "dataType"  : "JSON",
                "url"       : sSource,
                "data"      : aoData,
                "success"   : fnCallback
              });
            },
            "fnRowCallback" : function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              var d = aData["tanggal"].split('-');
              $("td:eq(1)",nRow).html(d[2] +'-'+ d[1] +'-'+ d[0]);
              $("td:eq(0)",nRow).text(++iDisplayIndex);
              if (aData["status_bon"]=="FALSE") {
                $("td:eq(9)",nRow).html("<label style='color:red;'>Belum Dikirim</label>");
              }else if(aData["status_bon"]=="TRUE"){
                 $("td:eq(9)",nRow).html("<label style='color:green;'>Sudah Dikirim</label>");
              }

            }
          });
        }
      </script>

      <script type="text/javascript">
        function detailHasilSablon(id)
        {
          $("modal_detailHasilSablon").modal({backdrop:"static"});
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_sablon/main/detailHasilSablon'); ?>",
            data : {id : id},
            success: function(response){
              $("#detail_hasil_sablon").html(response);
              $("#modal_detailHasilSablon").modal({backdrop:"static"});
            }
          });
        }
      </script>

      <script type="text/javascript">
        function kirimHasilSablon(tgl)
        {
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_sablon/main/kirimHasilSablon'); ?>",
            data : {tgl : tgl},
            success: function(response){
              if (jQuery.trim(response) == "Success") {
              datatableBonHasilSablonPerTgl(tgl);
              $("#modal_inputhasil").modal("hide");
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Hasil Sablon Berhasil Dikirim</b></div>");
              $("#modal-notif").addClass("modal-info");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
              },2000);
              setTimeout(function(){
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
              },3000);
            }else if (jQuery.trim(response) == "Failed") {
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Hasil Sablon Gagal Dikirim</b></div>");
              $("#modal-notif").addClass("modal-danger");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
              },2000);
              setTimeout(function(){
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },3000);
            }else if (jQuery.trim(response) == "Sent") {
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Hasil Sablon Sudah Dikirim</b></div>");
              $("#modal-notif").addClass("modal-warning");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
              },2000);
              setTimeout(function(){
                $("#modal-notif").removeClass("modal-warning");
                $("#modalNotifContent").text("");
              },3000);
            }
            }
          });
        }
      </script>

      <script type="text/javascript">
        $("#ukuranHD").select2({
            placeholder : "Pilih Ukuran HD",
            dropdownParent : $("#modal_pengembalianHD"),
            width : "100%",
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_sablon/main/getBarangHD",
              dataType : "JSON",
              delay : 0,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.ukuran+" "+item.warna_plastik,
                      id:item.kd_gd_hasil
                    }
                  })
                };
              }
            }
          });
      </script>

      <script type="text/javascript">
        $("#merekSablon").select2({
            placeholder : "Pilih Ukuran HD",
            dropdownParent : $("#modal_rencanaSusulan"),
            width : "100%",
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_sablon/main/getMerekSablon",
              dataType : "JSON",
              delay : 0,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.merek+" "+item.ukuran+" "+item.warna_plastik,
                      id:item.kd_gd_hasil+"|"+item.merek+"|"+item.ukuran+"|"+item.warna_plastik
                    }
                  })
                };
              }
            }
          });
      </script>
      <script type="text/javascript">
        function addPengembalianHD()
        {
          var ukuran   = $("#ukuranHD").val();
          var customer = $("#customer").val();
          var tgl      = $("#tgl_pengembalian").val();
          var berat    = $("#berat").val();
          var lembar   = $("#lembar").val();
          if (!ukuran || !tgl || !berat || !lembar || !customer) {
            $("#modal-notif").modal("show")
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Semua Kolom Harus Diisi</b></div>");
            $("#modal-notif").addClass("modal-warning");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
            },2000);
            setTimeout(function(){
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },3000);
          }else{
            $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_sablon/main/addDataPengembalianHD'); ?>",
            data : {customer : customer, ukuran : ukuran, tgl : tgl, berat : berat, lembar : lembar},
            success:function(response){
              if (jQuery.trim(response)=="Success") {
                datatablePengembalianHD();
                $("#modal_pengembalianHD").modal('hide');
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Kembalian HD Berhasil Ditambah</b></div>");
                $("#modal-notif").addClass("modal-info");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                },3000);
              }else if(jQuery.trim(response)=="Failed"){
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Kembalian HD Gagal Ditambah</b></div>");
                $("#modal-notif").addClass("modal-danger");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },3000);
              }
            }
          });
          }
        }
      </script>

      <script type="text/javascript">
        function datatablePengembalianHD(){
          $("#tableDataPengembalianHD").dataTable().fnDestroy();
          $("#tableDataPengembalianHD").dataTable({
						// "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI" : true,
            "sPaginationType" : "full_numbers",
            "sAjaxSource" : "<?php echo base_url(); ?>_sablon/main/getDataPengembalianHD",
            "aoColumnDefs": [
              { "sWidth": "10%", "aTargets": [ -1 ] }
          ],
            "columns" : [
              {"data" : "kd_gd_hasil", "name" : "kd_gd_hasil"},
              {"data" : "tgl_transaksi", "name" : "tgl_transaksi"},
              {"data" : "customer", "name" : "customer"},
              {"data" : "merek", "name" : "merek"},
              {"data" : "ukuran", "name" : "ukuran"},
              {"data" : "warna", "name" : "warna"},
              {"data" : "jumlah_lembar", "name" : "jumlah_lembar"},
              {"data" : "jumlah_berat", "name" : "jumlah_berat"},
              {"data" : "kd_gd_hasil", "name" : "kd_gd_hasil"},
              {"data" : "id_permintaan_jadi", "name" : "id_permintaan_jadi"}
            ],
            "fnServerData" : function(sSource,aoData,fnCallback){
              $.ajax({
                "type"      : "POST",
                "dataType"  : "JSON",
                "url"       : sSource,
                "data"      : aoData,
                "success"   : fnCallback
              });
            },
            "fnRowCallback" : function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(0)",nRow).text(++iDisplayIndex);
              $("td:eq('8')",nRow).html("<button class='btn btn-sm btn-flat btn-primary' data-toggle='modal' data-target='#edit_pengembalianHD') onclick=edit_pengembalianHD('"+aData["id_permintaan_jadi"]+"')><i class='fa fa-edit'></i>  Edit</button>");
              $("td:eq('9')",nRow).html("<button class='btn btn-sm btn-flat bg-red' onclick=deleteKembalianHD('"+aData["id_permintaan_jadi"]+"')><i class='fa fa-trash'></i>  Delete</button><input type='hidden' value='"+aData["id_permintaan_jadi"]+"' id='check'>");
            }
          });
        }
      </script>

      <script type="text/javascript">
        function edit_pengembalianHD(id)
        {
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_sablon/main/editKembalianHD'); ?>",
            data : { id : id },
            dataType : "JSON",
            success:function(response){
              document.getElementById("id_jadi").value = response[0].id_permintaan_jadi;
              document.getElementById("editBerat").value = response[0].jumlah_berat;
              document.getElementById("editLembar").value = response[0].jumlah_lembar;
              document.getElementById("editUkuranHD").value = response[0].ukuran+" "+response[0].warna;
              document.getElementById("edit_tgl_pengembalian").value = response[0].tgl_transaksi;
              document.getElementById("edit_customer").value = response[0].customer;
            }
          });
        }
      </script>

      <script type="text/javascript">
        function updateListPengembalianHD()
        {
          var id = $("#id_jadi").val();
          var berat = $("#editBerat").val();
          var lembar = $("#editLembar").val();
          var tanggal = $("#edit_tgl_pengembalian").val();
          var customer = $("#edit_customer").val();
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_sablon/main/updateListPengembalianHD'); ?>",
            data : { id : id, customer : customer, berat : berat, lembar : lembar, tanggal : tanggal},
            success:function(response)
            {
              if (jQuery.trim(response)=="Success") {
                datatablePengembalianHD();
                $("#edit_pengembalianHD").modal('hide');
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>List Berhasil Diperbarui</b></div>");
                $("#modal-notif").addClass("modal-info");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                },3000);
              }else if(jQuery.trim(response)=="Failed"){
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>List Gagal Diperbarui</b></div>");
                $("#modal-notif").addClass("modal-danger");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },3000);
              }
            }
          });
        }
      </script>

      <script type="text/javascript">
        function deleteKembalianHD(key)
        {
          var r = confirm("Hapus List Kembalian Barang HD ?");
          if (r == true) {
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('_sablon/main/deleteListKembalianHD'); ?>",
              data : {key : key},
              success:function(response){
                if (jQuery.trim(response)=="Success") {
                  datatablePengembalianHD();
                  $("#modal_pengembalianHD").modal('hide');
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Berhasil Dihapus</b></div>");
                  $("#modal-notif").addClass("modal-info");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                  },2000);
                  setTimeout(function(){
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                  },3000);
                }else if(jQuery.trim(response)=="Failed"){
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Gagal Dihapus</b></div>");
                  $("#modal-notif").addClass("modal-danger");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                  },2000);
                  setTimeout(function(){
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },3000);
                }
              }
            });
          }
        }
      </script>

      <script type="text/javascript">
        function kirimPengembalianHD()
        {
          var check = $("#check").val();
          if (!check) {
            $("#modal-notif").modal("show")
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak Ada List Pengembalian HD</b></div>");
            $("#modal-notif").addClass("modal-warning");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
            },2000);
            setTimeout(function(){
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },3000);
          }else{
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('_sablon/main/kirimPengembalianHD');?>",
              data : {},
              success:function(response){
                if (jQuery.trim(response)=="Success") {
                  datatablePengembalianHD();
                  $("#modal_pengembalianHD").modal('hide');
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Berhasil Dikirim</b></div>");
                  $("#modal-notif").addClass("modal-info");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                  },2000);
                  setTimeout(function(){
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                  },3000);
                }else if(jQuery.trim(response)=="Failed"){
                  datatablePengembalianHD();
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Gagal Dikirim</b></div>");
                  $("#modal-notif").addClass("modal-danger");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                  },2000);
                  setTimeout(function(){
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },3000);
                }
              }
            });
          }
        }
      </script>
      <script type="text/javascript">
        function addRencanaSusulan()
        {
          var kd_sablon     = $("#kd_sablon").val();
          var customer      = $("#customer").val();
          var merek         = $("#merekSablon").val();
          var tgl_rencana   = $("#tgl_rencana").val();
          var warna_sablon  = $("#w_cat").val();
          var nm_operator   = $("#nm_operator").val();
          var jml_rencana   = $("#jml_rencana").val();
          if (warna_sablon == "Custom"){
            warna_sablon = $("#w_catCustom").val();
          }
          if (!kd_sablon || !customer || !merek || !tgl_rencana || !warna_sablon || !nm_operator || !jml_rencana) {
            $("#modal-notif").modal("show")
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Semua Kolom Harus Diisi</b></div>");
            $("#modal-notif").addClass("modal-warning");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
            },2000);
            setTimeout(function(){
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },3000);
          }else{
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('_sablon/main/addRencanaSusulan'); ?>",
              data : {kd_sablon : kd_sablon, customer : customer, merek : merek, tgl_rencana : tgl_rencana, warna_sablon : warna_sablon, nm_operator : nm_operator, jml_rencana : jml_rencana},
              success: function(response){
                if (jQuery.trim(response)=="Success") {
                  datatableRencanaSablon();
                  $('#merekSablon').val('');
                  $('#w_cat').val('');
                  $('#customer').val('');
                  $('#jml_rencana').val('');
                  $('#nm_operator').val('');
                  $('#tgl_rencana').val('');
                  $("#modal_rencanaSusulan").modal('hide');
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Berhasil Ditambah</b></div>");
                  $("#modal-notif").addClass("modal-info");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                  },2000);
                  setTimeout(function(){
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                  },3000);
                }else if(jQuery.trim(response)=="Failed"){
                  datatableRencanaSablon();
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Gagal Ditambah</b></div>");
                  $("#modal-notif").addClass("modal-danger");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                  },2000);
                  setTimeout(function(){
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },3000);
                }
              }
            });
          }
        }
      </script>
      <script type="text/javascript">
        function modal_rencanaSusulan()
        {
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_sablon/main/getKdSablon'); ?>",
            data : {},
            success:function(response){
              document.getElementById("kd_sablon").value = response;
            }
          });
        }
      </script>

      <script type="text/javascript">
        function edit_detailBahanSablon(id)
        {
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_sablon/main/getDataPenggunaanBahanSablonById');?>",
            data : {id : id},
            dataType : "JSON",
            success: function(response)
            {
              $("#edit_penggunanBahanSablon").modal('show');
              document.getElementById("id_penggunaan_sablon").value = response[0].id_penggunaan_sablon;
              document.getElementById("kd_hasil_sablon").value = response[0].kd_hasil_sablon;
              document.getElementById("jum_pemakaian").value = response[0].jumlah_pengambilan;
              document.getElementById("sisa_pemakaian").value = response[0].sisa_pengambilan;
              document.getElementById("jenis").value = response[0].jenis;
              document.getElementById("nm_barang").value = "("+response[0].nm_barang+") "  +response[0].warna;
            }
          });
        }
      </script>

      <script type="text/javascript">
        function updatePenggunaanBahanSablon(id)
        {
          var id  = $("#id_penggunaan_sablon").val();
          var key = $("#kd_hasil_sablon").val();
          var jum_pemakaian = $("#jum_pemakaian").val();
          var sisa_pemakaian = $("#sisa_pemakaian").val();
          var kd_hasil_sablon = $("#kd_hasil_sablon").val();
          var satuan_pemakaian = $("#satuan_pemakaian").val();
          var satuan_sisa = $("#satuan_sisa").val();
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url("_sablon/main/updatePenggunaanBahanSablon"); ?>",
            data : {id : id, jum_pemakaian : jum_pemakaian, sisa_pemakaian : sisa_pemakaian, satuan_pemakaian : satuan_pemakaian, satuan_sisa : satuan_sisa},
            success:function(response){
              if (jQuery.trim(response)=="Success"){
                detailHasilSablon(key);
                document.getElementById("satuan_pemakaian").value = "Kg";
                document.getElementById("satuan_sisa").value = "Kg";
                $("#edit_penggunanBahanSablon").modal('hide');
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Berhasil Diperbarui</b></div>");
                $("#modal-notif").addClass("modal-info");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                },3000);
              }else if(jQuery.trim(response)=="Failed"){
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Gagal Diperbarui</b></div>");
                $("#modal-notif").addClass("modal-danger");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },3000);
              }
            }
          });
        }
      </script>

      <script type="text/javascript">
        function edit_detailHasilSablon(id)
        {
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_sablon/main/getDataHasilSablonById'); ?>",
            data : {id : id},
            dataType : "JSON",
            success: function(response)
            {
              document.getElementById("kd_sablon").value = response[0].kd_sablon ;
              document.getElementById("kd_hasil_sablon").value = response[0].kd_hasil_sablon ;
              document.getElementById("nm_produk").value =response[0].ukuran+" - "+response[0].merek+" - "+response[0].warna_plastik ;
              document.getElementById("warna_cat").value = response[0].warna_cat ;
              document.getElementById("hasil_lembar").value = response[0].hasil_lembar ;
              document.getElementById("hasil_awal").value = response[0].hasil_lembar ;
              document.getElementById("hasil_berat").value = response[0].hasil_berat ;
              document.getElementById("tgl").value = response[0].tanggal ;
              $("#edit_hasilSablon").modal("show");
            }
          });
        }
      </script>
      <script type="text/javascript">
      function updateHasilSablon()
      {
        var kd_sablon       = $("#kd_sablon").val();
        var kd_hasil_sablon = $("#kd_hasil_sablon").val();
        var hasil_berat     = $("#hasil_berat").val();
        var hasil_lembar    = $("#hasil_lembar").val();
        var hasil_awal      = $("#hasil_awal").val();
        $.ajax({
          type : "POST",
          url  : "<?php echo site_url('_sablon/main/updateDataHasilSablon') ?>",
          data : {kd_sablon : kd_sablon, kd_hasil_sablon : kd_hasil_sablon, hasil_berat : hasil_berat, hasil_lembar : hasil_lembar, hasil_awal : hasil_awal},
          success: function(response)
          {
            if (jQuery.trim(response)=="Success"){
              detailHasilSablon(kd_hasil_sablon);
              $("#edit_hasilSablon").modal('hide');
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Berhasil Diperbarui</b></div>");
              $("#modal-notif").addClass("modal-info");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
              },2000);
              setTimeout(function(){
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
              },3000);
            }else if(jQuery.trim(response)=="Failed"){
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Gagal Diperbarui</b></div>");
              $("#modal-notif").addClass("modal-danger");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
              },2000);
              setTimeout(function(){
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },3000);
            }
          }
        });
      }
      </script>
      <script type="text/javascript">
        function deleteHasilSablon(idHasil,idSablon)
        {
          var tgl1 = $("#tgl1").val();
          var tgl2 = $("#tgl2").val();
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_sablon/main/deleteHasilSablon'); ?>",
            data : {idHasil : idHasil, idSablon : idSablon},
            success: function(response)
            {
              if (jQuery.trim(response)=="Success"){
                datatableHasilSablonPerTgl(tgl1,tgl2);
                $("#edit_hasilSablon").modal('hide');
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Berhasil Dihapus</b></div>");
                $("#modal-notif").addClass("modal-info");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                },3000);
              }else if(jQuery.trim(response)=="Failed"){
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Gagal Dihapus</b></div>");
                $("#modal-notif").addClass("modal-danger");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                },2000);
                setTimeout(function(){
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },3000);
              }
            }
          });
        }
      </script>

      <script type="text/javascript">
        function datatableSearchRencanaPIC(tgl_awal,tgl_akhir){
        $("#tableSearchDataRencanaPIC").dataTable().fnDestroy();
        $("#tableSearchDataRencanaPIC").dataTable({
					// "fixedHeader" : true,
          "autoWidth" : false,
          "ordering"  : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "bJQueryUI" : true,
          "sPaginationType" : "full_numbers",
          "sAjaxSource" : "<?php echo base_url(); ?>_sablon/main/getDataSearchRencanaPIC/"+tgl_awal+"/"+tgl_akhir+"",
          "language": {"emptyTable": "Tidak Ada Rencana PIC Di Tanggal ( "+tgl_awal+" s/d "+tgl_akhir+" )"},
          "aoColumnDefs": [{ "sWidth": "10%", "aTargets": [ -1 ] } ],
          "columns" : [
            {"data" : "kd_ppic", "name" : "kd_ppic"},
            {"data" : "tgl_rencana", "name" : "tgl_rencana"},
            {"data" : "nm_cust", "name" : "nm_cust"},
            {"data" : "merek", "name" : "merek"},
            {"data" : "jns_permintaan", "name" : "jns_permintaan"},
            {"data" : "ukuran", "name" : "ukuran"},
            {"data" : "warna_plastik", "name" : "warna_plastik"},
            {"data" : "warna_cetak", "name" : "warna_cetak"},
            {"data" : "jumlah_permintaan", "name" : "jumlah_permintaan"},
            {"data" : "sisa", "name" : "sisa"},
            {"data" : "prioritas", "name" : "prioritas"},
            {"data" : "keterangan", "name" : "keterangan"},
            {"data" : "satuan_kilo", "name" : "satuan_kilo"},
            {"data" : "kd_ppic", "name" : "kd_ppic"}
          ],
          "fnServerData" : function(sSource,aoData,fnCallback){
            $.ajax({
              "type"      : "POST",
              "dataType"  : "JSON",
              "url"       : sSource,
              "data"      : aoData,
              "success"   : fnCallback
            });
          },
          "fnRowCallback" : function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(0)",nRow).text(++iDisplayIndex);
            $("td:eq(8)",nRow).html(+parseInt(aData["jumlah_permintaan"]));
            if (aData["prioritas"]=="URGENT") {
              $("td:eq(10)",nRow).html("<b style='color:red;'>"+aData["prioritas"]+"</b>");
            }
            if (!aData['satuan_kilo']) {
              $("td:eq(9)",nRow).html(+parseInt(aData["sisa"]));
              $("td:eq(12)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' onclick=conversiKG('"+aData['kd_ppic']+"')><i class='fa fa-balance-scale'> Conversi Kg</i></button>");
              $("td:eq(13)",nRow).html("");
            }else{
              $("td:eq(9)",nRow).html(+parseInt(aData["sisa"]));
              $("td:eq(12)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' onclick=buatRencana('"+aData['kd_ppic']+"') title='Tambah Rencana'><i class='fa fa-plus'>  Rencana&nbsp;&nbsp; </i></button>");
              $("td:eq(13)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' onclick=editconversiKG('"+aData['kd_ppic']+"') title='Edit Konversi'><i class='fa fa-edit'> Konversi</i></button>");
            }
          }
        });
      }

      </script>
      <script type="text/javascript">
        function cariRencanaPIC()
        {
          var tgl_awal = $("#tgl_awal").val();
          var tgl_akhir= $("#tgl_akhir").val();
          if (!tgl_awal || !tgl_akhir) {
            $("#modal-notif").modal("show")
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Semua Kolom Harus Diisi</b></div>");
            $("#modal-notif").addClass("modal-warning");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
            },2000);
            setTimeout(function(){
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },3000);
          }else{
            $("#rencanaPIC").hide();
            datatableSearchRencanaPIC(tgl_awal,tgl_akhir);
            var d1 = tgl_awal.split('-');
            var d2 = tgl_akhir.split('-');
            $("#tgl_list").html('( '+d1[2] +'-'+ d1[1] +'-'+ d1[0]+' s/d '+d2[2] +'-'+ d2[1] +'-'+ d2[0]+' )');
            $("#tableSearchDataRencanaPIC").show();
            $("#modal_cariRencanaPIC").modal("hide");
          }
        }
      </script>
	</body>
</html>
