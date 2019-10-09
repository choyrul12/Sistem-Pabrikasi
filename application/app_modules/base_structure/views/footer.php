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

<!--===============================================On Load Function (Start) ===============================================-->
      <script type="text/javascript">
        $(function () {
          //======= Run Method Automatically (Start) =======//
            reloadPesananPerRefeshPage();
            reloadPesananPerMenit();
            dataTableRollMaster();
            dataTableHasilMaster();
            dataTableOrderMarketing();
            dataTableOrderCabang();
            dataTableListSpkExtruder();
            dataTableListSpkCutting();
            dataTableListSpkPrinting();
            dataTableListSpkSablon();
            dataTableListHistoryPpicExtruder();
            dataTableListRencanaKerjaExtruder();
            dataTableListRencanaKerjaCutting();
            dataTableListRencanaKerjaPrinting();
            dataTableListRencanaKerjaSablon();
            reloadCountSpkTrash();
          //======= Run Method Automatically (Finish) =======//
          //======= Inisialisasi Komponen (Start) =======
          $('.date').datepicker({
              language: 'id',
              viewMode: 'years',
              format: 'yyyy-mm-dd',
              autoclose : true,
              todayHighlight : true
          });

          $("#chkStatusPengerjaan").change(function(){
            if($(this).prop("checked")){
              $("#cmbStatusPengerjaan").removeAttr("disabled");
              $(this).attr("value","");
            }else{
              $("#cmbStatusPengerjaan").val("");
              $("#cmbStatusPengerjaan").attr("disabled","disabled");
              $(this).attr("value","STOP");
            }
          });
          //======= Inisialisasi Komponen (End) =======
        });//Tutup $(function(){}); yang pertama
      </script>
<!--===============================================On Load Function (Finish) ===============================================-->

<!--===============================================On Load External Modal Function (Start) ===============================================-->
      <script type="text/javascript">
        $(document).ready(function() {
          $('.modal_link').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            if (url.indexOf('#') == 0) {
              $(url).modal('open');
            } else {
              $.get(url, function(data) {
                $(data).modal();
              });
            }
          });
        });

        function previewImage(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('#preview-'+input.id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }

        function clearPreviewImage(param){
          $("#"+param).val("");
          $("#preview-"+param).attr('src',"");
        }
      </script>
<!--===============================================On Load External Modal Function (Finish) ===============================================-->

<!--===============================================General Function (Start) ===============================================-->
      <script>
//================================ MODAL FUNCTION (START) ============================//
        function modalCariHistoryRoll(param){
          $("#btn-check-roll").attr("onclick","cariHistoryRoll('"+param+"')");
          $("#cmb-barang-roll").select2({
            placeholder : "Pilih Ukuran Barang Roll ("+param+")",
            dropdownParent: $('#modal-check-roll'),
            width : "100%",
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_ppic/main/getComboBoxValueRoll/"+param,
              dataType : "JSON",
              delay : 250,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.ukuran+" - "+item.merek+" - "+item.warna_plastik+" - "+item.jns_permintaan+" - "+item.jns_brg,
                      id:item.kd_gd_roll
                    }
                  })
                };
              }
            }
          });
        }

        function modalCariHistoryHasil(param){
          $("#btn-check-hasil").attr("onclick","cariHistoryHasil('"+param+"')");
          $("#cmb-barang-hasil").select2({
            placeholder : "Pilih Ukuran Barang Jadi ("+param+")",
            width : "100%",
            dropdownParent : $("#modal-check-hasil"),
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_ppic/main/getComboBoxValueHasil/"+param,
              dataType : "JSON",
              delay : 250,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.ukuran+" - "+item.merek+" - "+item.warna_plastik+" - "+item.jns_permintaan+" - "+item.sts_brg,
                      id:item.kd_gd_hasil
                    }
                  })
                };
              }
            }
          });
        }

        function modalKirimKeGudang(param){
          $("#tableDetailPesanan").dataTable().fnDestroy();
          $("#tableDetailPesanan").dataTable({
            "autoWidth" : true,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getOrderDetail",
            "columns":[
              {"data" : "tgl_pesan","name":"P.tgl_pesan"},
              {"data" : "jumlah","name":"PD.jumlah"},
              {"data" : "ukuran","name":"GH.ukuran"},
              {"data" : "merek","name":"PD.merek"},
              {"data" : "warna_plastik","name":"GH.warna_plastik"},
              {"data" : "warna_cetak","name":"PD.warna_cetak"},
              {"data" : "sm","name":"PD.sm"},
              {"data" : "dll","name":"PD.dll"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              aoData.push({"name":"no_order","value":param});
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("#h4-no-order").html("No. Order : "+aData["no_order"]+" <b class='text-primary'>["+aData["nm_perusahaan"]+"] </b>"+"<b class='text-success'>[ "+aData["nm_pemesan"]+" ]</b>");
              if(aData["kirim_gudang"] == "TRUE"){
                $("#btnKirimKeGudang").attr("disable","disable");
              }else{
                $("#btnKirimKeGudang").removeAttr("disable");
                $("#btnKirimKeGudang").attr("onclick","kirimKeGudang('"+aData["no_order"]+"')");
              }
            }
          });
          $("#modalKirimKeGudang").modal("show");
        }

        function modalTambahSpkExtruder(param){
          $("#cmbBarangExtruder").select2({
            placeholder : "Pilih Ukuran Barang Roll ("+param+")",
            dropdownParent: $('#modal-tambah-spk-extruder'),
            width : "100%",
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_ppic/main/getComboBoxValueRoll/"+param,
              dataType : "JSON",
              delay : 250,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.kd_gd_roll+" - "+item.ukuran+" - "+item.merek+" - "+item.warna_plastik+" - "+item.jns_permintaan+" - "+item.jns_brg,
                      id:item.kd_gd_roll
                    }
                  })
                };
              }
            }
          });

          $("#cmbBarangExtruder").on("select2:select",function(){
            var id = $(this).val();
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_ppic/main/getDetailBarangRoll",
              dataType : "JSON",
              data : {kd_gd_roll:id},
              success : function(response){
                $("#txtMerek").val(response[0].merek);
                $("#txtWarnaPlastik").val(response[0].warna_plastik);
                $("#txtPermintaan").val(response[0].jns_permintaan);
                $("#txtUkuran").val(response[0].ukuran+"x");
              }
            });
          });

          $("#cmbBarangExtruder").on("select2:unselect",function(){
            $("#txtMerek").val("");
            $("#txtWarnaPlastik").val("");
            $("#txtPermintaan").val("");
            $("#txtUkuran").val("");
          });

          $.ajax({
            url : "<?php echo base_url(); ?>_ppic/main/getGeneratedCodePpic",
            dataType : "JSON",
            success : function(response){
              $("#txtKdPpic").val(response.Code);
            }
          });
          $("#btnSimpanSpkExtruder").attr("onclick","saveSpkExtruder()");
        }

        function modalTambahSpkCutting(){
          $("#cmbBarangCutting").select2({
            placeholder : "Pilih Ukuran Barang Hasil",
            dropdownParent: $('#modal-tambah-spk-cutting'),
            width : "100%",
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_ppic/main/getComboBoxValueHasil/ALL",
              dataType : "JSON",
              delay : 250,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.kd_gd_hasil+" - "+item.ukuran+" - "+item.merek+" - "+item.warna_plastik+" - "+item.jns_permintaan+" - "+item.sts_brg+" - "+item.jns_brg,
                      id:item.kd_gd_hasil
                    }
                  })
                };
              }
            }
          });

          $("#cmbBarangCutting").on("select2:select",function(){
            var id = $(this).val();
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_ppic/main/getDetailBarangHasil",
              dataType : "JSON",
              data : {kd_gd_hasil:id},
              success : function(response){
                $("#txtMerek").val(response[0].merek);
                $("#txtWarnaPlastik").val(response[0].warna_plastik);
                $("#txtUkuran").val(response[0].ukuran);
              }
            });
          });

          $("#cmbBarangCutting").on("select2:unselect",function(){
            $("#txtMerek").val("");
            $("#txtWarnaPlastik").val("");
            $("#txtUkuran").val("");
          });

          $.ajax({
            url : "<?php echo base_url(); ?>_ppic/main/getGeneratedCodePpic",
            dataType : "JSON",
            success : function(response){
              $("#txtKdPpic").val(response.Code);
            }
          });
          $("#btnSimpanSpkCutting").attr("onclick","saveSpkCutting()");
        }

        function modalTambahSpkPrinting(param){
          $("#cmbBarangPrinting").select2({
            placeholder : "Pilih Ukuran Barang Printing ("+param+")",
            dropdownParent: $('#modal-tambah-spk-printing'),
            width : "100%",
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_ppic/main/getComboBoxValueRoll/"+param,
              dataType : "JSON",
              delay : 250,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.kd_gd_roll+" - "+item.ukuran+" - "+item.merek+" - "+item.warna_plastik+" - "+item.jns_permintaan+" - "+item.jns_brg,
                      id:item.kd_gd_roll
                    }
                  })
                };
              }
            }
          });

          $("#cmbBarangPrinting").on("select2:select",function(){
            var id = $(this).val();
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_ppic/main/getDetailBarangRoll",
              dataType : "JSON",
              data : {kd_gd_roll:id},
              success : function(response){
                $("#txtMerek").val(response[0].merek);
                $("#txtWarnaPlastik").val(response[0].warna_plastik);
                $("#txtPermintaan").val(response[0].jns_permintaan);
                $("#txtUkuran").val(response[0].ukuran+"x");
              }
            });
          });

          $("#cmbBarangPrinting").on("select2:unselect",function(){
            $("#txtMerek").val("");
            $("#txtWarnaPlastik").val("");
            $("#txtPermintaan").val("");
            $("#txtUkuran").val("");
          });

          $.ajax({
            url : "<?php echo base_url(); ?>_ppic/main/getGeneratedCodePpic",
            dataType : "JSON",
            success : function(response){
              $("#txtKdPpic").val(response.Code);
            }
          });
          $("#btnSimpanSpkPrinting").attr("onclick","saveSpkPrinting()");
        }

        function modalTambahSpkSablon(param){
          $("#cmbBarangSablon").select2({
            placeholder : "Pilih Ukuran Barang Hasil ("+param+")",
            dropdownParent: $('#modal-tambah-spk-sablon'),
            width : "100%",
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_ppic/main/getComboBoxValueHasil/"+param,
              dataType : "JSON",
              delay : 250,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.kd_gd_hasil+" - "+item.ukuran+" - "+item.merek+" - "+item.warna_plastik+" - "+item.jns_permintaan+" - "+item.jns_brg,
                      id:item.kd_gd_hasil
                    }
                  })
                };
              }
            }
          });

          $("#cmbBarangSablon").on("select2:select",function(){
            var id = $(this).val();
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_ppic/main/getDetailBarangHasil",
              dataType : "JSON",
              data : {kd_gd_hasil:id},
              success : function(response){
                $("#txtMerek").val(response[0].merek);
                $("#txtWarnaPlastik").val(response[0].warna_plastik);
                $("#txtPermintaan").val(response[0].jns_brg);
                $("#txtUkuran").val(response[0].ukuran);
              }
            });
          });

          $("#cmbBarangSablon").on("select2:unselect",function(){
            $("#txtMerek").val("");
            $("#txtWarnaPlastik").val("");
            $("#txtPermintaan").val("");
            $("#txtUkuran").val("");
          });

          $.ajax({
            url : "<?php echo base_url(); ?>_ppic/main/getGeneratedCodePpic",
            dataType : "JSON",
            success : function(response){
              $("#txtKdPpic").val(response.Code);
            }
          });
          $("#btnSimpanSpkSablon").attr("onclick","saveSpkSablon()");
        }

        function modalEditSpkExtruder(param,param2){
          $("#modalTitleSpkExtruder").text("Ubah SPK Extruder");
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/getDetailSpk",
            dataType : "JSON",
            data : {kd_ppic:param},
            success : function(response){
              $("#txtKdPpic").val(response[0].kd_ppic);
              $("#txtNmCustomer").val(response[0].nm_cust);
              $("#txtTglRencana").val(response[0].tgl_rencana);
              $("#txtMerek").val(response[0].merek);
              $("#txtKetMerek").val(response[0].ket_merek);
              $("#txtWarnaPlastik").val(response[0].warna_plastik);
              $("#txtPermintaan").val(response[0].jns_permintaan);
              $("#txtKetPermintaan").val(response[0].ket_permintaan);
              $("#txtUkuran").val(response[0].ukuran);
              $("#txtTebal").val(response[0].tebal);
              $("#txtBerat").val(response[0].berat);
              $("#txtJumlahPermintaan").val(response[0].jumlah_permintaan);
              $("#cmbSatuan").val(response[0].satuan);
              $("#cmbStrip").val(response[0].strip);
              $("#cmbStatus").val(response[0].prioritas);
              $("#txtKeterangan").val(response[0].keterangan);
              $('#preview-fileFoto').attr('src',"<?php echo base_url(); ?>assets/images/upload/"+response[0].foto_depan);
            }
          });

          $("#cmbBarangExtruder").select2({
            placeholder : "Pilih Ukuran Barang Roll ("+param2+")",
            dropdownParent: $('#modal-tambah-spk-extruder'),
            width : "100%",
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_ppic/main/getComboBoxValueRoll/"+param2,
              dataType : "JSON",
              delay : 250,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.kd_gd_roll+" - "+item.ukuran+" - "+item.merek+" - "+item.warna_plastik+" - "+item.jns_permintaan+" - "+item.jns_brg,
                      id:item.kd_gd_roll
                    }
                  })
                };
              }
            }
          });

          $("#cmbBarangExtruder").on("select2:select",function(){
            var id = $(this).val();
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_ppic/main/getDetailBarangRoll",
              dataType : "JSON",
              data : {kd_gd_roll:id},
              success : function(response){
                $("#txtMerek").val(response[0].merek);
                $("#txtWarnaPlastik").val(response[0].warna_plastik);
                $("#txtPermintaan").val(response[0].jns_permintaan);
                $("#txtUkuran").val(response[0].ukuran);
              }
            });
          });

          $("#cmbBarangExtruder").on("select2:unselect",function(){
            $("#txtMerek").val("");
            $("#txtWarnaPlastik").val("");
            $("#txtPermintaan").val("");
            $("#txtUkuran").val("");
          });
          $("#btnSimpanSpkExtruder").attr("onclick","editSpkExtruder()");
        }

        function modalEditSpkCutting(param,param2){
          $("#modalTitleSpkCutting").text("Ubah SPK Cutting");
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/getDetailSpk",
            dataType : "JSON",
            data : {kd_ppic:param},
            success : function(response){
              $("#txtKdPpic").val(response[0].kd_ppic);
              $("#txtNmCustomer").val(response[0].nm_cust);
              $("#txtTglRencana").val(response[0].tgl_rencana);
              $("#txtMerek").val(response[0].merek);
              $("#txtKetMerek").val(response[0].ket_merek);
              $("#txtWarnaPlastik").val(response[0].warna_plastik);
              $("#txtPermintaan").val(response[0].jns_permintaan);
              $("#txtKetPermintaan").val(response[0].ket_permintaan);
              $("#txtUkuran").val(response[0].ukuran);
              $("#txtTebal").val(response[0].tebal);
              $("#txtBerat").val(response[0].berat);
              $("#txtJumlahPermintaan").val(response[0].jumlah_permintaan);
              $("#cmbSatuan").val(response[0].satuan);
              $("#cmbStrip").val(response[0].strip);
              $("#cmbStatus").val(response[0].prioritas);
              $("#txtKeterangan").val(response[0].keterangan);
              $('#preview-fileFoto').attr('src',"<?php echo base_url(); ?>assets/images/upload/"+response[0].foto_depan);
            }
          });

          $("#cmbBarangCutting").select2({
            placeholder : "Pilih Ukuran Barang Hasil",
            dropdownParent: $('#modal-tambah-spk-cutting'),
            width : "100%",
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_ppic/main/getComboBoxValueHasil/ALL",
              dataType : "JSON",
              delay : 250,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.kd_gd_hasil+" - "+item.ukuran+" - "+item.merek+" - "+item.warna_plastik+" - "+item.jns_permintaan+" - "+item.sts_brg+" - "+item.jns_brg,
                      id:item.kd_gd_hasil
                    }
                  })
                };
              }
            }
          });

          $("#cmbBarangCutting").on("select2:select",function(){
            var id = $(this).val();
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_ppic/main/getDetailBarangHasil",
              dataType : "JSON",
              data : {kd_gd_hasil:id},
              success : function(response){
                $("#txtMerek").val(response[0].merek);
                $("#txtWarnaPlastik").val(response[0].warna_plastik);
                $("#txtUkuran").val(response[0].ukuran);
              }
            });
          });

          $("#cmbBarangCutting").on("select2:unselect",function(){
            $("#txtMerek").val("");
            $("#txtWarnaPlastik").val("");
            $("#txtUkuran").val("");
          });
          $("#btnSimpanSpkCutting").attr("onclick","editSpkCutting()");
        }

        function modalEditSpkPrinting(param,param2){
          $("#modalTitleSpkExtruder").text("Ubah SPK Cetak");
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/getDetailSpk",
            dataType : "JSON",
            data : {kd_ppic:param},
            success : function(response){
              $("#txtKdPpic").val(response[0].kd_ppic);
              $("#txtNmCustomer").val(response[0].nm_cust);
              $("#txtTglRencana").val(response[0].tgl_rencana);
              $("#txtMerek").val(response[0].merek);
              $("#txtWarnaPlastik").val(response[0].warna_plastik);
              $("#txtPermintaan").val(response[0].jns_permintaan);
              $("#txtUkuran").val(response[0].ukuran);
              $("#txtTebal").val(response[0].tebal);
              $("#txtBerat").val(response[0].berat);
              $("#txtJumlahPermintaan").val(response[0].jumlah_permintaan);
              $("#cmbSatuan").val(response[0].satuan);
              $("#cmbStrip").val(response[0].strip);
              $("#cmbStatus").val(response[0].prioritas);
              $("#txtWarnaCat").val(response[0].warna_cat);
              $("#txtKeterangan").val(response[0].keterangan);
              $('#preview-fileFoto').attr('src',"<?php echo base_url(); ?>assets/images/upload/"+response[0].foto_depan);
              $('#preview-fileFoto2').attr('src',"<?php echo base_url(); ?>assets/images/upload/"+response[0].foto_belakang);

            }
          });

          $("#cmbBarangPrinting").select2({
            placeholder : "Pilih Ukuran Barang Roll ("+param2+")",
            dropdownParent: $('#modal-tambah-spk-printing'),
            width : "100%",
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_ppic/main/getComboBoxValueRoll/"+param2,
              dataType : "JSON",
              delay : 250,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.kd_gd_roll+" - "+item.ukuran+" - "+item.merek+" - "+item.warna_plastik+" - "+item.jns_permintaan+" - "+item.jns_brg,
                      id:item.kd_gd_roll
                    }
                  })
                };
              }
            }
          });

          $("#cmbBarangPrinting").on("select2:select",function(){
            var id = $(this).val();
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_ppic/main/getDetailBarangRoll",
              dataType : "JSON",
              data : {kd_gd_roll:id},
              success : function(response){
                $("#txtMerek").val(response[0].merek);
                $("#txtWarnaPlastik").val(response[0].warna_plastik);
                $("#txtPermintaan").val(response[0].jns_permintaan);
                $("#txtUkuran").val(response[0].ukuran);
              }
            });
          });

          $("#cmbBarangPrinting").on("select2:unselect",function(){
            $("#txtMerek").val("");
            $("#txtWarnaPlastik").val("");
            $("#txtPermintaan").val("");
            $("#txtUkuran").val("");
          });
          $("#btnSimpanSpkPrinting").attr("onclick","editSpkPrinting()");
        }

        function modalEditSpkSablon(param,param2){
          $("#modalTitleSpkSablon").text("Ubah SPK Sablon");
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/getDetailSpk",
            dataType : "JSON",
            data : {kd_ppic:param},
            success : function(response){
              $("#txtKdPpic").val(response[0].kd_ppic);
              $("#txtNmCustomer").val(response[0].nm_cust);
              $("#txtTglRencana").val(response[0].tgl_rencana);
              $("#txtMerek").val(response[0].merek);
              $("#txtKetMerek").val(response[0].ket_merek);
              $("#txtWarnaPlastik").val(response[0].warna_plastik);
              $("#txtPermintaan").val(response[0].jns_permintaan);
              $("#txtKetPermintaan").val(response[0].ket_permintaan);
              $("#txtUkuran").val(response[0].ukuran);
              $("#txtTebal").val(response[0].tebal);
              $("#txtBerat").val(response[0].berat);
              $("#txtJumlahPermintaan").val(response[0].jumlah_permintaan);
              $("#cmbSatuan").val(response[0].satuan);
              $("#cmbStrip").val(response[0].strip);
              $("#cmbStatus").val(response[0].prioritas);
              $("#txtKeterangan").val(response[0].keterangan);
              $('#preview-fileFoto').attr('src',"<?php echo base_url(); ?>assets/images/upload/"+response[0].foto_depan);
            }
          });

          $("#cmbBarangSablon").select2({
            placeholder : "Pilih Ukuran Barang Hasil ("+param2+")",
            dropdownParent: $('#modal-tambah-spk-sablon'),
            width : "100%",
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_ppic/main/getComboBoxValueHasil/"+param2,
              dataType : "JSON",
              delay : 250,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.kd_gd_hasil+" - "+item.ukuran+" - "+item.merek+" - "+item.warna_plastik+" - "+item.jns_permintaan+" - "+item.jns_brg,
                      id:item.kd_gd_hasil
                    }
                  })
                };
              }
            }
          });

          $("#cmbBarangHasil").on("select2:select",function(){
            var id = $(this).val();
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_ppic/main/getDetailBarangHasil",
              dataType : "JSON",
              data : {kd_gd_hasil:id},
              success : function(response){
                $("#txtMerek").val(response[0].merek);
                $("#txtWarnaPlastik").val(response[0].warna_plastik);
                $("#txtPermintaan").val(response[0].jns_permintaan);
                $("#txtUkuran").val(response[0].ukuran);
              }
            });
          });

          $("#cmbBarangHasil").on("select2:unselect",function(){
            $("#txtMerek").val("");
            $("#txtWarnaPlastik").val("");
            $("#txtPermintaan").val("");
            $("#txtUkuran").val("");
          });
          $("#btnSimpanSpkSablon").attr("onclick","editSpkSablon()");
        }

        function modalCheckStatusPengerjaan(param,param2){
          if(param2 != "STOP"){
            $("#chkStatusPengerjaan").attr("checked","checked").prop("checked",true).change();
            $("#cmbStatusPengerjaan").val(param2);
            $("#chkStatusPengerjaan").val(param2);
          }else{
            $("#chkStatusPengerjaan").prop("checked",false).change();
            $("#cmbStatusPengerjaan").attr("disabled","disabled");
            $("#cmbStatusPengerjaan").val("");
            $("#chkStatusPengerjaan").val(param2);
          }
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/getDetailSpk",
            dataType : "JSON",
            data : {kd_ppic:param},
            success : function(response){
              $("#txtKetStop").val(response[0].ket_stop);
            }
          });
          $("#btnStopSpk").attr("onclick","editStatusPengerjaan('"+param+"')");
        }

        function modalTrashSpk(){
          $("#tableTrashSpk").dataTable().fnDestroy();
          $("#tableTrashSpk").dataTable({
            "autoWidth" : false,
            "ordering" : true,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getListTrashSpk",
            "columns":[
              {"data" : "kd_ppic","name":"kd_ppic"},
              {"data" : "tgl_rencana","name":"tgl_rencana"},
              {"data" : "nm_cust","name":"nm_cust"},
              {"data" : "merek","name":"merek"},
              {"data" : "jns_permintaan","name":"jns_permintaan"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "warna_plastik","name":"warna_plastik"},
              {"data" : "bagian","name":"bagian"},
              {"data" : "kd_ppic","name":"kd_ppic"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(8)",nRow).html("<button class='btn btn-sm btn-flat btn-success' onclick=restoreSpk('"+aData["kd_ppic"]+"')>Pulihkan</button>"+
                                      "<button class='btn btn-sm btn-flat btn-info' data-toggle='modal' data-target='#modalDetailDeletedSpk' onclick=showDetailDeletedSpk('"+aData["kd_ppic"]+"')>Detail</button>");
            },
            "order":[[1,"desc"]]
          });
        }

//================================ MODAL FUNCTION (FINISH) ============================//

//================================ SEARCH FUNCTION (START) ============================//
        function cariHistoryRoll(param){

        }

        function cariHistoryHasil(param){

        }

        function cariSpkExtruder(){
          var tglAwal = $("#txt_tgl_awal").val();
          var tglAkhir = $("#txt_tgl_akhir").val();
          if(tglAwal == "" && tglAkhir == ""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Tanggal Awal Dan Tanggal Akhir Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            var periode = tglAwal+"#"+tglAkhir;
            dataTableListSpkExtruder(periode);
            $("#txt_tgl_awal").val("");
            $("#txt_tgl_akhir").val("");
            $("#modal-cari-spk-extruder").modal("hide");
          }
        }

        function cariSpkCutting(){
          var tglAwal = $("#txt_tgl_awal").val();
          var tglAkhir = $("#txt_tgl_akhir").val();
          if(tglAwal == "" && tglAkhir == ""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Tanggal Awal Dan Tanggal Akhir Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            var periode = tglAwal+"#"+tglAkhir;
            dataTableListSpkCutting(periode);
            $("#txt_tgl_awal").val("");
            $("#txt_tgl_akhir").val("");
            $("#modal-cari-spk-cutting").modal("hide");
          }
        }

        function cariSpkPrinting(){
          var tglAwal = $("#txt_tgl_awal").val();
          var tglAkhir = $("#txt_tgl_akhir").val();
          if(tglAwal == "" && tglAkhir == ""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Tanggal Awal Dan Tanggal Akhir Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            var periode = tglAwal+"#"+tglAkhir;
            dataTableListSpkPrinting(periode);
            $("#txt_tgl_awal").val("");
            $("#txt_tgl_akhir").val("");
            $("#modal-cari-spk-printing").modal("hide");
          }
        }

        function cariSpkSablon(){
          var tglAwal = $("#txt_tgl_awal").val();
          var tglAkhir = $("#txt_tgl_akhir").val();
          if(tglAwal == "" && tglAkhir == ""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Tanggal Awal Dan Tanggal Akhir Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            var periode = tglAwal+"#"+tglAkhir;
            dataTableListSpkSablon(periode);
            $("#txt_tgl_awal").val("");
            $("#txt_tgl_akhir").val("");
            $("#modal-cari-spk-extruder").modal("hide");
          }
        }

        function cariHistoryPpic(param){
          var bulan = $("#cmbBulan").val();
          var tahun = $("#cmbTahun").val();

          if(param == "EXTRUDER"){
            dataTableListHistoryPpicExtruder(bulan,tahun);
          }
        }

        function cariRencanaKerjaPerBagian(param,param2){
          if($(param).val() == ""){
            var tanggal = "<?php echo date('Y-m-d'); ?>";
          }else{
            var tanggal = $(param).val();
          }
          switch (param2) {
            case "EXTRUDER":dataTableListRencanaKerjaExtruder(tanggal);break;
            case "CUTTING":dataTableListRencanaKerjaCutting(tanggal);break;
            case "PRINTING":dataTableListRencanaKerjaPrinting(tanggal);break;
            case "SABLON":dataTableListRencanaKerjaSablon(tanggal);break;
            default: alert("Parameter Kedua (Nama Bagian) Harus Diisi (Huruf Kapital)"); break;
          }
        }
//================================ SEARCH FUNCTION (FINISH) ============================//

//================================ RELOAD FUNCTION (START) ============================//
        function reloadPesananPerMenit(){
          setInterval(function(){
            $.ajax({
              url : "<?php echo base_url() ?>_ppic/main/getCountPesananGlobalBaru",
              dataType : "JSON",
              success : function(response){
                $("#Order-Parent-Menu .pull-right-container").html("<i class='fa fa-angle-left pull-right'></i><span class='label bg-blue'>"+response[0].jumlah_pesanan+"</span>");
              }
            });
            $.ajax({
              url : "<?php echo base_url() ?>_ppic/main/getCountPesananMarketingBaru",
              dataType : "JSON",
              success : function(response){
                $("#Order-Dalam-Kota-Child-Menu").html("Order Marketing <span class='label bg-green pull-right'>"+response[0].jumlah_pesanan+"</span>");
              }
            });
            $.ajax({
              url : "<?php echo base_url() ?>_ppic/main/getCountPesananCabangBaru",
              dataType : "JSON",
              success : function(response){
                $("#Order-Luar-Kota-Child-Menu").html("Order Cabang <span class='label bg-yellow pull-right'>"+response[0].jumlah_pesanan+"</span>");
              }
            });
          },60000);
        }

        function reloadPesananPerRefeshPage(){
          $.ajax({
            url : "<?php echo base_url() ?>_ppic/main/getCountPesananGlobalBaru",
            dataType : "JSON",
            success : function(response){
              $("#Order-Parent-Menu .pull-right-container").html("<i class='fa fa-angle-left pull-right'></i><span class='label bg-blue'>"+response[0].jumlah_pesanan+"</span>");
            }
          });
          $.ajax({
            url : "<?php echo base_url() ?>_ppic/main/getCountPesananMarketingBaru",
            dataType : "JSON",
            success : function(response){
              $("#Order-Dalam-Kota-Child-Menu").html("Order Marketing <span class='label bg-green pull-right'>"+response[0].jumlah_pesanan+"</span>");
            }
          });
          $.ajax({
            url : "<?php echo base_url() ?>_ppic/main/getCountPesananCabangBaru",
            dataType : "JSON",
            success : function(response){
              $("#Order-Luar-Kota-Child-Menu").html("Order Cabang <span class='label bg-yellow pull-right'>"+response[0].jumlah_pesanan+"</span>");
            }
          });
        }

        function reloadCountSpkTrash(){
          $.ajax({
            url : "<?php echo base_url(); ?>_ppic/main/getCountRencanaTrash",
            dataType : "TEXT",
            success : function(response){
              $("#count-trash").text(response);
            }
          });
        }
//================================ RELOAD FUNCTION (FINISH) ============================//

//================================ RESET FORM FUNCTION (START) ============================//
        function resetFormTambahSpkExt(){
          $.ajax({
            url : "<?php echo base_url(); ?>_ppic/main/getGeneratedCodePpic",
            dataType : "JSON",
            success : function(response){
              $("#txtKdPpic").val(response.Code);
            }
          });
          $("#txtNmCustomer").val("");
          $("#txtTglRencana").val("");
          $("#cmbBarangExtruder").val("").trigger("change");
          $("#txtMerek").val("");
          $("#txtKetMerek").val("");
          $("#txtWarnaPlastik").val("");
          $("#txtPermintaan").val("");
          $("#txtKetPermintaan").val("");
          $("#txtUkuran").val("");
          $("#txtTebal").val("");
          $("#txtBerat").val("");
          $("#txtJumlahPermintaan").val("");
          $("#cmbSatuan").val("#");
          $("#cmbStrip").val("#");
          $("#cmbStatus").val("#");
          $("#txtKeterangan").val("");
          $("#fileFoto").val("");
          $('#preview-fileFoto').attr('src',"");
        }
        function resetFormTambahSpkCutting(){
          $.ajax({
            url : "<?php echo base_url(); ?>_ppic/main/getGeneratedCodePpic",
            dataType : "JSON",
            success : function(response){
              $("#txtKdPpic").val(response.Code);
            }
          });
          $("#txtNmCustomer").val("ES BUAH(MERAH)");
          $("#txtTglRencana").val("");
          $("#cmbBarangCutting").val("").trigger("change");
          $("#txtMerek").val("");
          $("#txtWarnaPlastik").val("");
          $("#txtPermintaan").val("");
          $("#txtUkuran").val("");
          $("#txtTebal").val("");
          $("#txtBerat").val("");
          $("#txtJumlahPermintaan").val("");
          $("#txtJumlahMesin").val("");
          $("#cmbSatuan").val("#");
          $("#cmbStrip").val("#");
          $("#cmbStatus").val("#");
          $("#txtKeterangan").val("");
          $("#fileFoto").val("");
          $('#preview-fileFoto').attr('src',"");
        }
        function resetFormTambahSpkPrinting(){
          $.ajax({
            url : "<?php echo base_url(); ?>_ppic/main/getGeneratedCodePpic",
            dataType : "JSON",
            success : function(response){
              $("#txtKdPpic").val(response.Code);
            }
          });
          $("#txtNmCustomer").val("");
          $("#txtTglRencana").val("");
          $("#cmbBarangPrinting").val("").trigger("change");
          $("#txtMerek").val("");
          $("#txtWarnaPlastik").val("");
          $("#txtPermintaan").val("");
          $("#txtUkuran").val("");
          $("#txtTebal").val("");
          $("#txtBerat").val("");
          $("#txtJumlahPermintaan").val("");
          $("#txtWarnaCat").val("");
          $("#cmbSatuan").val("#");
          $("#cmbStrip").val("#");
          $("#cmbStatus").val("#");
          $("#txtKeterangan").val("");
          $("#fileFoto").val("");
          $('#preview-fileFoto').attr('src',"");
          $("#fileFoto2").val("");
          $('#preview-fileFoto2').attr('src',"");
        }
        function resetFormTambahSpkSablon(){
          $.ajax({
            url : "<?php echo base_url(); ?>_ppic/main/getGeneratedCodePpic",
            dataType : "JSON",
            success : function(response){
              $("#txtKdPpic").val(response.Code);
            }
          });
          $("#txtNmCustomer").val("");
          $("#txtTglRencana").val("");
          $("#cmbBarangSablon").val("").trigger("change");
          $("#txtMerek").val("");
          $("#txtWarnaPlastik").val("");
          $("#txtPermintaan").val("");
          $("#txtUkuran").val("");
          $("#txtTebal").val("");
          $("#txtBerat").val("");
          $("#txtJumlahPermintaan").val("");
          $("#txtWarnaCetak").val("");
          $("#cmbSatuan").val("#");
          $("#cmbStrip").val("#");
          $("#cmbStatus").val("#");
          $("#txtKeterangan").val("");
          $("#fileFoto").val("");
          $('#preview-fileFoto').attr('src',"");
          $("#fileFoto2").val("");
          $('#preview-fileFoto2').attr('src',"");
        }
//================================ RESET FORM FUNCTION (FINISH) ============================//

//================================ SAVE FUNCTION (START) ============================//
        function saveSpkExtruder(){
          var kdPpic = $("#txtKdPpic").val();
          var nmCust = $("#txtNmCustomer").val();
          var tglRencana = $("#txtTglRencana").val();
          var kdGdRoll = $("#cmbBarangExtruder").val();
          var merek = $("#txtMerek").val();
          var ketMerek = $("#txtKetMerek").val();
          var warnaPlastik = $("#txtWarnaPlastik").val();
          var permintaan = $("#txtPermintaan").val();
          var ketPermintaan = $("#txtKetPermintaan").val();
          var ukuran = $("#txtUkuran").val();
          var tebal = $("#txtTebal").val();
          var berat = $("#txtBerat").val();
          var jmlPermintaan = $("#txtJumlahPermintaan").val();
          var satuan = $("#cmbSatuan").val();
          var strip = $("#cmbStrip").val();
          var status = $("#cmbStatus").val();
          var keterangan = $("#txtKeterangan").val();
          var fileFoto = $("#fileFoto").val().replace(/.*(\/|\\)/, '');//replace path with string null;

          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/saveSpkExtruder",
            dataType : "TEXT",
            data : {kd_ppic:kdPpic,nm_cust:nmCust,tgl_rencana:tglRencana,
                    kd_gd_roll:kdGdRoll,merek:merek,ket_merek:ketMerek,
                    warna_plastik:warnaPlastik,permintaan:permintaan,ket_permintaan:ketPermintaan,
                    ukuran:ukuran,tebal:tebal,berat:berat,jml_permintaan:jmlPermintaan,
                    satuan:satuan,strip:strip,status:status,keterangan:keterangan,gambar:fileFoto
                   },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                var formData = new FormData();
                formData.append("gambar",$("#fileFoto")[0].files[0]);
                $.ajax({
                  type : "POST",
                  url : "<?php echo base_url(); ?>_ppic/main/uploadFoto",
                  contentType : false,
                  processData : false,
                  dataType : "text",
                  data : formData,
                  success : function(response){
                    if(jQuery.trim(response) === "Berhasil"){
                      $("#modal-notif").addClass("modal-info");
                      $("#modalNotifContent").text("SPK Berhasil Ditambahkan Ke Bagian Extruder");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-info");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkExt();
                        dataTableListSpkExtruder();
                      },2000);
                    }else if(jQuery.trim(response) === "Gagal"){
                      $("#modal-notif").addClass("modal-warning");
                      $("#modalNotifContent").text("Gambar Gagal Di Unggah");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-warning");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkExt();
                        dataTableListSpkExtruder();
                      },2000);
                    }else{
                      $("#modal-notif").addClass("modal-info");
                      $("#modalNotifContent").text("SPK Berhasil Ditambahkan Ke Bagian Extruder");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-info");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkExt();
                        dataTableListSpkExtruder();
                      },2000);
                    }
                  }
                });
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("SPK Gagal Ditambahkan Ke Bagian Extruder");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }
            }
          });
        }

        function saveSpkCutting(){
          var kdPpic = $("#txtKdPpic").val();
          var nmCust = $("#txtNmCustomer").val();
          var tglRencana = $("#txtTglRencana").val();
          var kdGdHasil = $("#cmbBarangCutting").val();
          var merek = $("#txtMerek").val();
          var ukuran = $("#txtUkuran").val();
          var warnaPlastik = $("#txtWarnaPlastik").val();
          var permintaan = $("#cmbPermintaan").val();
          var tebal = $("#txtTebal").val();
          var berat = $("#txtBerat").val();
          var jmlPermintaan = $("#txtJumlahPermintaan").val();
          var jmlMesin = $("#txtJumlahMesin").val();
          var satuan = $("#cmbSatuan").val();
          var strip = $("#cmbStrip").val();
          var status = $("#cmbStatus").val();
          var keterangan = $("#txtKeterangan").val();
          var fileFoto = $("#fileFoto").val().replace(/.*(\/|\\)/, '');//replace path with string null;

          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/saveSpkCutting",
            dataType : "TEXT",
            data : {kd_ppic:kdPpic,nm_cust:nmCust,tgl_rencana:tglRencana,
                    kd_gd_hasil:kdGdHasil,merek:merek,warna_plastik:warnaPlastik,
                    permintaan:permintaan,ukuran:ukuran,tebal:tebal,berat:berat,
                    jml_permintaan:jmlPermintaan,satuan:satuan,strip:strip,jml_mesin:jmlMesin,
                    status:status,keterangan:keterangan,gambar:fileFoto
                   },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                var formData = new FormData();
                formData.append("gambar",$("#fileFoto")[0].files[0]);
                $.ajax({
                  type : "POST",
                  url : "<?php echo base_url(); ?>_ppic/main/uploadFoto",
                  contentType : false,
                  processData : false,
                  dataType : "text",
                  data : formData,
                  success : function(response){
                    if(jQuery.trim(response) === "Berhasil"){
                      $("#modal-notif").addClass("modal-info");
                      $("#modalNotifContent").text("SPK Berhasil Ditambahkan Ke Bagian Potong");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-info");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkCutting();
                        dataTableListSpkCutting();
                      },2000);
                    }else if(jQuery.trim(response) === "Gagal"){
                      $("#modal-notif").addClass("modal-warning");
                      $("#modalNotifContent").text("Gambar Gagal Di Unggah");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-warning");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkCutting();
                        dataTableListSpkCutting();
                      },2000);
                    }else{
                      $("#modal-notif").addClass("modal-info");
                      $("#modalNotifContent").text("SPK Berhasil Ditambahkan Ke Bagian Potong");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-info");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkCutting();
                        dataTableListSpkCutting();
                      },2000);
                    }
                  }
                });
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("SPK Gagal Ditambahkan Ke Bagian Potong");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }
            }
          });
        }

        function saveSpkPrinting(){
          var kdPpic = $("#txtKdPpic").val();
          var nmCust = $("#txtNmCustomer").val();
          var tglRencana = $("#txtTglRencana").val();
          var kdGdRoll = $("#cmbBarangPrinting").val();
          var merek = $("#txtMerek").val();
          var warnaPlastik = $("#txtWarnaPlastik").val();
          var permintaan = $("#txtPermintaan").val();
          var ukuran = $("#txtUkuran").val();
          var tebal = $("#txtTebal").val();
          var berat = $("#txtBerat").val();
          var jmlPermintaan = $("#txtJumlahPermintaan").val();
          var satuan = $("#cmbSatuan").val();
          var strip = $("#cmbStrip").val();
          var status = $("#cmbStatus").val();
          var warnaCat = $("#txtWarnaCat").val();
          var keterangan = $("#txtKeterangan").val();
          var fileFoto = $("#fileFoto").val().replace(/.*(\/|\\)/, '');//replace path with string null;
          var fileFoto2 = $("#fileFoto2").val().replace(/.*(\/|\\)/, '');//replace path with string null;

          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/saveSpkPrinting",
            dataType : "TEXT",
            data : {kd_ppic:kdPpic,nm_cust:nmCust,tgl_rencana:tglRencana,
                    kd_gd_roll:kdGdRoll,merek:merek,warna_plastik:warnaPlastik,
                    permintaan:permintaan,ukuran:ukuran,tebal:tebal,berat:berat,jml_permintaan:jmlPermintaan,
                    satuan:satuan,strip:strip,status:status,warna_cat:warnaCat,keterangan:keterangan,
                    gambar:fileFoto,gambar2:fileFoto2
                   },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                var formData = new FormData();
                formData.append("gambar",$("#fileFoto")[0].files[0]);
                formData.append("gambar2",$("#fileFoto2")[0].files[0]);
                $.ajax({
                  type : "POST",
                  url : "<?php echo base_url(); ?>_ppic/main/uploadFoto",
                  contentType : false,
                  processData : false,
                  dataType : "text",
                  data : formData,
                  success : function(response){
                    if(jQuery.trim(response) === "Berhasil"){
                      $("#modal-notif").addClass("modal-info");
                      $("#modalNotifContent").text("SPK Berhasil Ditambahkan Ke Bagian Cetak");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-info");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkPrinting();
                      },2000);
                    }else if(jQuery.trim(response) === "Gagal"){
                      $("#modal-notif").addClass("modal-warning");
                      $("#modalNotifContent").text("Gambar Gagal Di Unggah");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-warning");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkPrinting();
                      },2000);
                    }else{
                      $("#modal-notif").addClass("modal-info");
                      $("#modalNotifContent").text("SPK Berhasil Ditambahkan Ke Bagian Cetak");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-info");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkPrinting();
                      },2000);
                    }
                  }
                });
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("SPK Gagal Ditambahkan Ke Bagian Cetak");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }
            }
          });
        }

        function saveSpkSablon(){
          var kdPpic = $("#txtKdPpic").val();
          var nmCust = $("#txtNmCustomer").val();
          var tglRencana = $("#txtTglRencana").val();
          var kdGdHasil = $("#cmbBarangSablon").val();
          var merek = $("#txtMerek").val();
          var warnaPlastik = $("#txtWarnaPlastik").val();
          var permintaan = $("#txtPermintaan").val();
          var ukuran = $("#txtUkuran").val();
          var tebal = $("#txtTebal").val();
          var berat = $("#txtBerat").val();
          var jmlPermintaan = $("#txtJumlahPermintaan").val();
          var satuan = $("#cmbSatuan").val();
          var warnaCetak = $("#cmbWarnaCetak").val();
          var strip = $("#cmbStrip").val();
          var status = $("#cmbStatus").val();
          var keterangan = $("#txtKeterangan").val();
          var fileFoto = $("#fileFoto").val().replace(/.*(\/|\\)/, '');//replace path with string null;

          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/saveSpkSablon",
            dataType : "TEXT",
            data : {kd_ppic:kdPpic,nm_cust:nmCust,tgl_rencana:tglRencana,
                    kd_gd_hasil:kdGdHasil,merek:merek,warna_plastik:warnaPlastik,
                    permintaan:permintaan,ukuran:ukuran,tebal:tebal,berat:berat,
                    jml_permintaan:jmlPermintaan,warna_cetak:warnaCetak,
                    satuan:satuan,strip:strip,status:status,keterangan:keterangan,gambar:fileFoto
                   },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                var formData = new FormData();
                formData.append("gambar",$("#fileFoto")[0].files[0]);
                $.ajax({
                  type : "POST",
                  url : "<?php echo base_url(); ?>_ppic/main/uploadFoto",
                  contentType : false,
                  processData : false,
                  dataType : "text",
                  data : formData,
                  success : function(response){
                    if(jQuery.trim(response) === "Berhasil"){
                      $("#modal-notif").addClass("modal-info");
                      $("#modalNotifContent").text("SPK Berhasil Ditambahkan Ke Bagian Sablon");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-info");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkSablon();
                        dataTableListSpkSablon();
                      },2000);
                    }else if(jQuery.trim(response) === "Gagal"){
                      $("#modal-notif").addClass("modal-warning");
                      $("#modalNotifContent").text("Gambar Gagal Di Unggah");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-warning");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkSablon();
                        dataTableListSpkSablon();
                      },2000);
                    }else{
                      $("#modal-notif").addClass("modal-info");
                      $("#modalNotifContent").text("SPK Berhasil Ditambahkan Ke Bagian Sablon");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-info");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkSablon();
                        dataTableListSpkSablon();
                      },2000);
                    }
                  }
                });
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("SPK Gagal Ditambahkan Ke Bagian Sablon");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }
            }
          });
        }
//================================ SAVE FUNCTION (FINISH) ============================//

//================================ EDIT FUNCTION (START) ============================//
        function editSpkExtruder(){
          var kdPpic = $("#txtKdPpic").val();
          var nmCust = $("#txtNmCustomer").val();
          var tglRencana = $("#txtTglRencana").val();
          var kdGdRoll = $("#cmbBarangExtruder").val();
          var merek = $("#txtMerek").val();
          var ketMerek = $("#txtKetMerek").val();
          var warnaPlastik = $("#txtWarnaPlastik").val();
          var permintaan = $("#txtPermintaan").val();
          var ketPermintaan = $("#txtKetPermintaan").val();
          var ukuran = $("#txtUkuran").val();
          var tebal = $("#txtTebal").val();
          var berat = $("#txtBerat").val();
          var jmlPermintaan = $("#txtJumlahPermintaan").val();
          var satuan = $("#cmbSatuan").val();
          var strip = $("#cmbStrip").val();
          var status = $("#cmbStatus").val();
          var keterangan = $("#txtKeterangan").val();
          var fileFoto = $("#fileFoto").val().replace(/.*(\/|\\)/, '');//replace path with string null;

          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/editSpkExtruder",
            dataType : "TEXT",
            data : {kd_ppic:kdPpic,nm_cust:nmCust,tgl_rencana:tglRencana,
                    kd_gd_roll:kdGdRoll,merek:merek,ket_merek:ketMerek,
                    warna_plastik:warnaPlastik,permintaan:permintaan,ket_permintaan:ketPermintaan,
                    ukuran:ukuran,tebal:tebal,berat:berat,jml_permintaan:jmlPermintaan,
                    satuan:satuan,strip:strip,status:status,keterangan:keterangan,gambar:fileFoto
                   },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                if(fileFoto == "" || fileFoto == null){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("SPK Extruder Berhasil Diubah");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    resetFormTambahSpkExt();
                    $("#table-list-spk-extruder").dataTable().fnDestroy();
                    dataTableListSpkExtruder();
                    $("#modal-tambah-spk-extruder").modal("hide");
                  },2000);
                }else{
                  var formData = new FormData();
                  formData.append("gambar",$("#fileFoto")[0].files[0]);
                  $.ajax({
                    type : "POST",
                    url : "<?php echo base_url(); ?>_ppic/main/uploadFoto",
                    contentType : false,
                    processData : false,
                    dataType : "text",
                    data : formData,
                    success : function(response){
                      if(jQuery.trim(response) === "Berhasil"){
                        $("#modal-notif").addClass("modal-info");
                        $("#modalNotifContent").text("SPK Extruder Berhasil Diubah");
                        $("#modal-notif").modal("show");
                        setTimeout(function(){
                          $("#modal-notif").modal("hide");
                          $("#modal-notif").removeClass("modal-info");
                          $("#modalNotifContent").text("");
                          resetFormTambahSpkExt();
                          $("#table-list-spk-extruder").dataTable().fnDestroy();
                          dataTableListSpkExtruder();
                          $("#modal-tambah-spk-extruder").modal("hide");
                        },2000);
                      }else{
                        $("#modal-notif").addClass("modal-warning");
                        $("#modalNotifContent").text("Gambar Gagal Di Unggah");
                        $("#modal-notif").modal("show");
                        setTimeout(function(){
                          $("#modal-notif").modal("hide");
                          $("#modal-notif").removeClass("modal-info");
                          $("#modalNotifContent").text("");
                          resetFormTambahSpkExt();
                          $("#table-list-spk-extruder").dataTable().fnDestroy();
                          dataTableListSpkExtruder();
                        },2000);
                      }
                    }
                  });
                }
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("SPK Extruder Gagal Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }
            }
          });
        }

        function editSpkCutting(){
          var kdPpic = $("#txtKdPpic").val();
          var nmCust = $("#txtNmCustomer").val();
          var tglRencana = $("#txtTglRencana").val();
          var kdGdHasil = $("#cmbBarangCutting").val();
          var merek = $("#txtMerek").val();
          var ukuran = $("#txtUkuran").val();
          var warnaPlastik = $("#txtWarnaPlastik").val();
          var permintaan = $("#cmbPermintaan").val();
          var tebal = $("#txtTebal").val();
          var berat = $("#txtBerat").val();
          var jmlPermintaan = $("#txtJumlahPermintaan").val();
          var jmlMesin = $("#txtJumlahMesin").val();
          var satuan = $("#cmbSatuan").val();
          var strip = $("#cmbStrip").val();
          var status = $("#cmbStatus").val();
          var keterangan = $("#txtKeterangan").val();
          var fileFoto = $("#fileFoto").val().replace(/.*(\/|\\)/, '');//replace path with string null;

          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/editSpkCutting",
            dataType : "TEXT",
            data : {kd_ppic:kdPpic,nm_cust:nmCust,tgl_rencana:tglRencana,
                    kd_gd_hasil:kdGdHasil,merek:merek,warna_plastik:warnaPlastik,
                    permintaan:permintaan,ukuran:ukuran,tebal:tebal,berat:berat,
                    jml_permintaan:jmlPermintaan,satuan:satuan,strip:strip,jml_mesin:jmlMesin,
                    status:status,keterangan:keterangan,gambar:fileFoto
                   },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                if(fileFoto == "" || fileFoto == null){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("SPK Potong Berhasil Diubah");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    resetFormTambahSpkCutting();
                    dataTableListSpkCutting();
                    $("#modal-tambah-spk-cutting").modal("hide");
                  },2000);
                }else{
                  var formData = new FormData();
                  formData.append("gambar",$("#fileFoto")[0].files[0]);
                  $.ajax({
                    type : "POST",
                    url : "<?php echo base_url(); ?>_ppic/main/uploadFoto",
                    contentType : false,
                    processData : false,
                    dataType : "text",
                    data : formData,
                    success : function(response){
                      if(jQuery.trim(response) === "Berhasil"){
                        $("#modal-notif").addClass("modal-info");
                        $("#modalNotifContent").text("SPK Potong Berhasil Diubah");
                        $("#modal-notif").modal("show");
                        setTimeout(function(){
                          $("#modal-notif").modal("hide");
                          $("#modal-notif").removeClass("modal-info");
                          $("#modalNotifContent").text("");
                          resetFormTambahSpkCutting();
                          dataTableListSpkCutting();
                          $("#modal-tambah-spk-cutting").modal("hide");
                        },2000);
                      }else{
                        $("#modal-notif").addClass("modal-warning");
                        $("#modalNotifContent").text("Gambar Gagal Di Unggah");
                        $("#modal-notif").modal("show");
                        setTimeout(function(){
                          $("#modal-notif").modal("hide");
                          $("#modal-notif").removeClass("modal-info");
                          $("#modalNotifContent").text("");
                          resetFormTambahSpkCutting();
                          dataTableListSpkCutting();
                        },2000);
                      }
                    }
                  });
                }
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("SPK Potong Gagal Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }
            }
          });
        }

        function editSpkPrinting(){
          var kdPpic = $("#txtKdPpic").val();
          var nmCust = $("#txtNmCustomer").val();
          var tglRencana = $("#txtTglRencana").val();
          var kdGdRoll = $("#cmbBarangPrinting").val();
          var merek = $("#txtMerek").val();
          var warnaPlastik = $("#txtWarnaPlastik").val();
          var permintaan = $("#txtPermintaan").val();
          var ukuran = $("#txtUkuran").val();
          var tebal = $("#txtTebal").val();
          var berat = $("#txtBerat").val();
          var jmlPermintaan = $("#txtJumlahPermintaan").val();
          var satuan = $("#cmbSatuan").val();
          var strip = $("#cmbStrip").val();
          var status = $("#cmbStatus").val();
          var warnaCat = $("#txtWarnaCat").val();
          var keterangan = $("#txtKeterangan").val();
          var fileFoto = $("#fileFoto").val().replace(/.*(\/|\\)/, '');//replace path with string null;
          var fileFoto2 = $("#fileFoto2").val().replace(/.*(\/|\\)/, '');//replace path with string null;

          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/editSpkPrinting",
            dataType : "TEXT",
            data : {kd_ppic:kdPpic,nm_cust:nmCust,tgl_rencana:tglRencana,
                    kd_gd_roll:kdGdRoll,merek:merek,warna_plastik:warnaPlastik,
                    permintaan:permintaan,ukuran:ukuran,tebal:tebal,berat:berat,jml_permintaan:jmlPermintaan,
                    satuan:satuan,strip:strip,status:status,warna_cat:warnaCat,keterangan:keterangan,
                    gambar:fileFoto,gambar2:fileFoto2
                   },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                var formData = new FormData();
                formData.append("gambar",$("#fileFoto")[0].files[0]);
                formData.append("gambar2",$("#fileFoto2")[0].files[0]);
                $.ajax({
                  type : "POST",
                  url : "<?php echo base_url(); ?>_ppic/main/uploadFoto",
                  contentType : false,
                  processData : false,
                  dataType : "text",
                  data : formData,
                  success : function(response){
                    if(jQuery.trim(response) === "Berhasil"){
                      $("#modal-notif").addClass("modal-info");
                      $("#modalNotifContent").text("SPK Cetak Berhasil Diubah");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-info");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkPrinting();
                      },2000);
                    }else if(jQuery.trim(response) === "Gagal"){
                      $("#modal-notif").addClass("modal-warning");
                      $("#modalNotifContent").text("Gambar Gagal Di Unggah");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-warning");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkPrinting();
                      },2000);
                    }else{
                      $("#modal-notif").addClass("modal-info");
                      $("#modalNotifContent").text("SPK Cetak Berhasil Diubah");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-info");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkPrinting();
                      },2000);
                    }
                  }
                });
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("SPK Cetak Gagal Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }
            }
          });
        }

        function editSpkSablon(){
          var kdPpic = $("#txtKdPpic").val();
          var nmCust = $("#txtNmCustomer").val();
          var tglRencana = $("#txtTglRencana").val();
          var kdGdHasil = $("#cmbBarangSablon").val();
          var merek = $("#txtMerek").val();
          var warnaPlastik = $("#txtWarnaPlastik").val();
          var permintaan = $("#txtPermintaan").val();
          var ukuran = $("#txtUkuran").val();
          var tebal = $("#txtTebal").val();
          var berat = $("#txtBerat").val();
          var jmlPermintaan = $("#txtJumlahPermintaan").val();
          var satuan = $("#cmbSatuan").val();
          var warnaCetak = $("#cmbWarnaCetak").val();
          var strip = $("#cmbStrip").val();
          var status = $("#cmbStatus").val();
          var keterangan = $("#txtKeterangan").val();
          var fileFoto = $("#fileFoto").val().replace(/.*(\/|\\)/, '');//replace path with string null;

          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/editSpkSablon",
            dataType : "TEXT",
            data : {kd_ppic:kdPpic,nm_cust:nmCust,tgl_rencana:tglRencana,
                    kd_gd_hasil:kdGdHasil,merek:merek,warna_plastik:warnaPlastik,
                    permintaan:permintaan,ukuran:ukuran,tebal:tebal,berat:berat,
                    jml_permintaan:jmlPermintaan,warna_cetak:warnaCetak,
                    satuan:satuan,strip:strip,status:status,keterangan:keterangan,gambar:fileFoto
                   },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                var formData = new FormData();
                formData.append("gambar",$("#fileFoto")[0].files[0]);
                $.ajax({
                  type : "POST",
                  url : "<?php echo base_url(); ?>_ppic/main/uploadFoto",
                  contentType : false,
                  processData : false,
                  dataType : "text",
                  data : formData,
                  success : function(response){
                    if(jQuery.trim(response) === "Berhasil"){
                      $("#modal-notif").addClass("modal-info");
                      $("#modalNotifContent").text("SPK Sablon Berhasil Diubah");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-info");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkSablon();
                        dataTableListSpkSablon();
                      },2000);
                    }else if(jQuery.trim(response) === "Gagal"){
                      $("#modal-notif").addClass("modal-warning");
                      $("#modalNotifContent").text("Gambar Gagal Di Unggah");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-warning");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkSablon();
                        dataTableListSpkSablon();
                      },2000);
                    }else{
                      $("#modal-notif").addClass("modal-info");
                      $("#modalNotifContent").text("SPK Sablon Berhasil Diubah");
                      $("#modal-notif").modal("show");
                      setTimeout(function(){
                        $("#modal-notif").modal("hide");
                        $("#modal-notif").removeClass("modal-info");
                        $("#modalNotifContent").text("");
                        resetFormTambahSpkSablon();
                        dataTableListSpkSablon();
                      },2000);
                    }
                  }
                });
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("SPK Sablon Gagal Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }
            }
          });
        }

        function editStatusPengerjaan(param){
          var kd_ppic1 = param;
          var ket_stop1 = $("#txtKetStop").val();
          var sts_pengerjaan1 = "";
          if($("#chkStatusPengerjaan").val() == ""){
            if($("#cmbStatusPengerjaan").val() == ""){
              $("#modal-notif").addClass("modal-warning");
              $("#modalNotifContent").text("Status Pengerjaan Tidak Boleh Kosong!");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-warning");
                $("#modalNotifContent").text("");
              },2000);
            }else{
              if($("#cmbStatusPengerjaan").val() == ""){
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Status Pengerjaan Tidak Boleh Kosong!");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-warning");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                sts_pengerjaan1 = $("#cmbStatusPengerjaan").val();
              }
            }
          }else{
            sts_pengerjaan1 = $("#chkStatusPengerjaan").val();
          }
          if(kd_ppic1=="" || sts_pengerjaan1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Kode PPIC Dan Status Pengerjaan Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            $.ajax({
              type : "POST",
              url : "<?php echo base_url() ?>_ppic/main/editStatusPengerjaan",
              dataType : "TEXT",
              data : {kd_ppic:kd_ppic1,sts_pengerjaan:sts_pengerjaan1,ket_stop:ket_stop1},
              success : function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  if(sts_pengerjaan1 == "STOP"){
                    var text = "Spk Berhasil Diberhentikan";
                  }else{
                    var text = "Spk Berhasil Dijalankan"
                  }
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text(text);
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    dataTableListSpkExtruder();
                    dataTableListSpkCutting();
                    dataTableListSpkPrinting();
                    dataTableListSpkSablon();
                    $("#modalStopSpk").modal("hide");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Spk Gagal Diberhentikan");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },2000);
                }
              }
            });
          }
        }
//================================ EDIT FUNCTION (FINISH) ============================//

//================================ REMOVE FUNCTION (START) ============================//
        function removeSpk(param){
          if (confirm("Apakah anda yakin SPK ini akan dihapus?")) {
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_ppic/main/removeSpk",
              dataType : "TEXT",
              data : {kd_ppic : param},
              success : function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("SPK Berhasil Dihapus");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    resetFormTambahSpkExt();
                    dataTableListSpkExtruder();
                    dataTableListSpkCutting();
                    dataTableListSpkPrinting();
                    dataTableListSpkSablon();
                    reloadCountSpkTrash();
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("SPK Gagal Dihapus");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                  },2000);
                }
              }
            });
          }
        }
//================================ REMOVE FUNCTION (FINISH) ============================//

//================================ UNSPECIFIED FUNCTION (START) ============================//
        function showImage(param){
          var url = $(param).attr("src");
          $("#imageShow").attr("src",url);
          $("#modalShowImage").modal("show");
        }

        function removeStripCustom(){
          var id = $("#close").data("id");
          var idSelector = "#"+$("#close").data("id");
          $(idSelector).remove();
          $("#close").remove();
          $("#td-strip-wrapper").html(
            '<div class="form-group has-warning">'+
              '<select class="form-control" id="'+id+'" onchange="changeStripCustom(this)">'+
                '<option value="#">--Pilih Strip--</option>'+
                '<option value="Merah">Merah</option>'+
                '<option value="Pink">Pink</option>'+
                '<option value="Merah Orange">Merah Orange</option>'+
                '<option value="Orange">Orange</option>'+
                '<option value="Merah Putih">Merah Putih</option>'+
                '<option value="Lose">Lose</option>'+
                '<option value="Putih Susu">Putih Susu</option>'+
                '<option value="Custom">Custom</option>'+
              '</select>'+
            '</div>'
          );
        }

        function changeStripCustom(e){
          if(e.value == "Custom"){
            $("#td-strip-wrapper").html(
              '<div class="form-group has-warning">'+
                '<div class="input-group" id="inputGroup" style="width:100%;float:left;">'+
                  '<input type="text" class="form-control" id="'+e.id+'" style="width:98%; float:left;">'+
                  ' <button type="button" class="close" id="close" data-id="'+e.id+'" onclick="removeStripCustom()" style="margin-top:6px;">&times;</button>'+
                '</div>'+
              '</div>'
            );
          }
        }

        function changeCustomCombo(e){
          if(e.value == "Custom"){
            $("#comboCustomWrapper").append(
              '<div class="input-group" id="inputGroup" style="width:100%;float:left;">'+
              ' <input type="text" class="form-control" id="'+e.id+'" style="width:98%; float:left;">'+
              ' <button type="button" class="close" id="close" data-id="'+e.id+'" onclick="removeCustomCombo()" style="margin-top:6px;">&times;</button>'+
              '</div>'
            );
            $("#"+e.id).attr({disabled:"disabled",style:"display:none",id:"disableCombo"});
          }
        }

        function removeCustomCombo(){
          var id = $("#close").data("id");
          var idSelector = "#"+$("#close").data("id");
          $(idSelector).remove();
          $("#close").remove();
          $("#inputGroup").remove();
          $("#disableCombo").removeAttr("style disabled");
          $("#disableCombo").attr("id",id);
        }

        function printOut(param){
          if (confirm("Anda Yakin Ingin Print?")) {
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_ppic/main/printOutPesanan",
              dataType : "TEXT",
              data : {no_order : param},
              success : function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  $("#modalPrintOut").modal("show");
                  $("#framePrintOut").attr("src","<?php echo base_url(); ?>_ppic/main/cetakFakturProduksi/"+param);
                }else{
                  alert("Oops! Telah Terjadi Kesalahan Pada Sistem Print Out Anda");
                }
              }
            });
          }
        }

        function kirimKeGudang(param){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/updateKirimKeGudang",
            dataType : "TEXT",
            data : {no_order : param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modalNotif").addClass("modal-success");
                $("#notifContent").html("<b id='text'>Selamat, Pesanan Berhasil Dikirim Ke Gudang</b>");
                $("#modalNotif").modal("show");
                setTimeout(function(){
                  $("b").remove("#text");
                  $("#modalNotif").modal("hide");
                  $("#modal-notif").removeClass("modal-success");
                },2000);
                $("#modalKirimKeGudang").modal("hide");
                $("#table-order-marketing").dataTable().fnDestroy();
                dataTableOrderMarketing();
              }else{
                $("#modalNotif").addClass("modal-danger");
                $("#notifContent").html("<b id='text'>Maaf, Pesanan Gagal Dikirim Ke Gudang</b>");
                $("#modalNotif").modal("show");
                setTimeout(function(){
                  $("b").remove("#text");
                  $("#modalNotif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                },2000);
              }
            }
          });
        }

        function restoreSpk(param){
          if(confirm("Apakah Anda Yakin Data Ini Ingin Dipulihkan?")){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_ppic/main/restoreSpk",
              dataType : "TEXT",
              data : {kd_ppic:param},
              success : function(response) {
                if(jQuery.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Selemat, SPK Berhasil Dipulihkan");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    dataTableListSpkExtruder();
                    dataTableListSpkCutting();
                    dataTableListSpkPrinting();
                    dataTableListSpkSablon();
                    reloadCountSpkTrash();
                    modalTrashSpk();
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Maaf, SPK Gagal Dipulihkan");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                    reloadCountSpkTrash();
                  },2000);
                }
              }
            });
          }
        }

        function showDetailDeletedSpk(param){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/getDetailSpk"
          });
        }

        function showDetailDeletedSpk(param){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_ppic/main/getDetailSpk",
            dataType : "JSON",
            data : {kd_ppic : param},
            success : function(response){
              $("#tdKodePpic").text(response[0].kd_ppic);
              $("#tdNamaCustomer").text(response[0].nm_cust);
              $("#tdTglRencana").text(response[0].tgl_rencana);
              $("#tdBagian").text(response[0].bagian);
              $("#tdJnsPermintaan").text(response[0].jns_permintaan);
              $("#tdMerek").text(response[0].merek);
              $("#tdUkuran").text(response[0].ukuran);
              $("#tdWarnaPlastik").text(response[0].warna_plastik);
              $("#tdTebal").text(response[0].tebal);
              $("#tdBerat").text(response[0].berat);
              $("#tdJumlahPermintaan").text(response[0].jumlah_permintaan);
              $("#tdStrip").text(response[0].strip);
              $("#tdStatusPengerjaan").text(response[0].sts_pengerjaan);
              $("#tdPrioritas").text(response[0].prioritas);
            }
          });
        }

//================================ UNSPECIFIED FUNCTION (FINISH) ============================//

//================================ DATATABLE FUNCTION (START) ============================//

        function dataTableRollMaster(){
          $("#table-stok-polos").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getStokBarangRoll/POLOS",
            "order":[[0, "desc"]],
            "columns":[
              {"data" : "kd_gd_roll","name":"kd_gd_roll"},
              {"data" : "warna_plastik","name":"warna_plastik"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "tebal","name":"tebal"},
              {"data" : "stok","name":"stok"},
              {"data" : "bobin","name":"bobin"},
              {"data" : "payung","name":"payung"},
              {"data" : "merek","name":"merek"},
              {"data" : "jns_brg","name":"jns_brg"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(4)",nRow).text(aData["stok"]+" KG");
            }
          });
          $("#table-stok-cetak").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getStokBarangRoll/CETAK",
            "order":[[0, "desc"]],
            "columns":[
              {"data" : "kd_gd_roll","name":"kd_gd_roll"},
              {"data" : "warna_plastik","name":"warna_plastik"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "tebal","name":"tebal"},
              {"data" : "stok","name":"stok"},
              {"data" : "bobin","name":"bobin"},
              {"data" : "payung","name":"payung"},
              {"data" : "merek","name":"merek"},
              {"data" : "jns_brg","name":"jns_brg"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(4)",nRow).text(aData["stok"]+" KG");
            }
          });
        }

        function dataTableHasilMaster(){
          $("#table-stok-standar").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getStokBarangHasil/STANDARD",
            "order":[[0, "desc"]],
            "columns":[
              {"data" : "kd_gd_hasil","name":"kd_gd_hasil"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "tebal","name":"tebal"},
              {"data" : "stok_berat","name":"stok_berat"},
              {"data" : "stok_lembar","name":"stok_lembar"},
              {"data" : "warna_plastik","name":"warna_plastik"},
              {"data" : "merek","name":"merek"},
              {"data" : "sts_brg","name":"sts_brg"},
              {"data" : "jns_brg","name":"jns_brg"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(3)",nRow).text(aData["stok_berat"]+" KG");
              $("td:eq(4)",nRow).text(aData["stok_lembar"]+" LEMBAR");
            }
          });
          $("#table-stok-campur").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getStokBarangHasil/CAMPUR",
            "order":[[0, "desc"]],
            "columns":[
              {"data" : "kd_gd_hasil","name":"kd_gd_hasil"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "tebal","name":"tebal"},
              {"data" : "stok_berat","name":"stok_berat"},
              {"data" : "stok_lembar","name":"stok_lembar"},
              {"data" : "warna_plastik","name":"warna_plastik"},
              {"data" : "merek","name":"merek"},
              {"data" : "sts_brg","name":"sts_brg"},
              {"data" : "jns_brg","name":"jns_brg"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(3)",nRow).text(aData["stok_berat"]+" KG");
              $("td:eq(4)",nRow).text(aData["stok_lembar"]+" LEMBAR");
            }
          });
          $("#table-stok-kantong").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getStokBarangHasil/KANTONG",
            "order":[[0, "desc"]],
            "columns":[
              {"data" : "kd_gd_hasil","name":"kd_gd_hasil"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "tebal","name":"tebal"},
              {"data" : "stok_berat","name":"stok_berat"},
              {"data" : "stok_lembar","name":"stok_lembar"},
              {"data" : "warna_plastik","name":"warna_plastik"},
              {"data" : "merek","name":"merek"},
              {"data" : "sts_brg","name":"sts_brg"},
              {"data" : "jns_brg","name":"jns_brg"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },"fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(3)",nRow).text(aData["stok_berat"]+" KG");
              $("td:eq(4)",nRow).text(aData["stok_lembar"]+" LEMBAR");
            }
          });
          $("#table-stok-sablon").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getStokBarangHasil/SABLON",
            "order":[[0, "desc"]],
            "columns":[
              {"data" : "kd_gd_hasil","name":"kd_gd_hasil"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "tebal","name":"tebal"},
              {"data" : "stok_berat","name":"stok_berat"},
              {"data" : "stok_lembar","name":"stok_lembar"},
              {"data" : "warna_plastik","name":"warna_plastik"},
              {"data" : "merek","name":"merek"},
              {"data" : "sts_brg","name":"sts_brg"},
              {"data" : "jns_brg","name":"jns_brg"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(3)",nRow).text(aData["stok_berat"]+" KG");
              $("td:eq(4)",nRow).text(aData["stok_lembar"]+" LEMBAR");
            }
          });
        }

        function dataTableOrderMarketingBulanSebelumnya(param){
          $("#table-order-marketing").removeAttr("style");
          $("#table-order-marketing").dataTable().fnDestroy();
          $("#table-order-marketing tbody").empty();
          $("#tableOrderMarketingTerkirim").dataTable().fnDestroy();
          $("#tableOrderMarketingTerkirim tbody").empty();
          $("#tableOrderMarketingTerkirim").attr("style","display:none");
          dataTableOrderMarketing(param);
        }

        function dataTableOrderMarketingTerkirim(){
          $("#table-order-marketing").dataTable().fnDestroy();
          $("#table-order-marketing tbody").empty();
          $("#table-order-marketing").attr("style","display:none");
          $("#tableOrderMarketingTerkirim").removeAttr("style");
          $("#tableOrderMarketingTerkirim").dataTable().fnDestroy();
          $("#tableOrderMarketingTerkirim").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getOrderMarketingTerkirim",
            "columns":[
              {"data" : "tgl_pesan","name":"P.tgl_pesan"},
              {"data" : "nm_pemesan","name":"P.nm_pemesan"},
              {"data" : "jumlah","name":"PD.jumlah"},
              {"data" : "ukuran","name":"GH.ukuran"},
              {"data" : "merek","name":"PD.merek"},
              {"data" : "warna_plastik","name":"GH.warna_plastik"},
              {"data" : "warna_cetak","name":"PD.warna_cetak"},
              {"data" : "sm","name":"PD.sm"},
              {"data" : "dll","name":"PD.dll"},
              {"data" : "note","name":"C.nm_perusahaan"},
              {"data" : "kirim_gudang","name":"P.no_order"},
              {"data" : "sts_print","name":"P.kd_order"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(1)",nRow).text(aData["nm_perusahaan"]+" ("+aData["nm_pemesan"]+") ["+aData["no_order"]+"] ["+aData["kd_order"]+"]");
              if(aData["kirim_gudang"] == "FALSE"){
                $("td:eq(10)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalKirimKeGudang('"+aData["no_order"]+"')>Kirim Ke Gudang</button>");
              }else{
                $("td:eq(10)",nRow).html("<div class='label label-danger'>Sudah Dikirim Ke Gudang</div>");
              }

              if(aData["sts_print"] == "FALSE"){
                $("td:eq(11)",nRow).html("<button class='btn btn-md btn-flat btn-info' onclick=printOut('"+aData["no_order"]+"')>Print Out</button>");
              }else{
                $("td:eq(11)",nRow).html("<div class='label label-flat label-warning'>Sudah Di Print Out</div>");
              }
            }
          });
        }

        function dataTableOrderMarketingBulanan(){
          $("#table-order-marketing").removeAttr("style");
          $("#table-order-marketing").dataTable().fnDestroy();
          $("#table-order-marketing tbody").empty();
          $("#tableOrderMarketingTerkirim").dataTable().fnDestroy();
          $("#tableOrderMarketingTerkirim tbody").empty();
          $("#tableOrderMarketingTerkirim").attr("style","display:none");
          var tahun = $("#cmbTahun").val();
          var bulan = $("#cmbBulan").val();
          if(tahun=="" || bulan==""){
            $("#modalNotif").addClass("modal-danger");
            $("#notifContent").text("Tahun Dan Bulan Harus Dipulih Terlebih Dahulu");
            $("#modalNotif").modal("show");
            setTimeout(function(){
              $("#modalNotif").modal("hide");
            },2000);
          }else{
            var param = tahun+"-"+bulan;
            $("#table-order-marketing").dataTable().fnDestroy();
            $("#table-order-marketing tbody").empty();
            dataTableOrderMarketing(param);
            $("#cmbTahun").val("");
            $("#cmbBulan").val("");
            $("#modalSearchMarketingOrderBulanan").modal("hide");
          }
        }

        function dataTableOrderMarketing(thnBln="<?php echo date("Y-m"); ?>"){
          $("#table-order-marketing").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getOrderMarketing",
            "columns":[
              {"data" : "tgl_pesan","name":"P.tgl_pesan"},
              {"data" : "nm_pemesan","name":"P.nm_pemesan"},
              {"data" : "jumlah","name":"PD.jumlah"},
              {"data" : "ukuran","name":"GH.ukuran"},
              {"data" : "merek","name":"PD.merek"},
              {"data" : "warna_plastik","name":"GH.warna_plastik"},
              {"data" : "warna_cetak","name":"PD.warna_cetak"},
              {"data" : "sm","name":"PD.sm"},
              {"data" : "dll","name":"PD.dll"},
              {"data" : "note","name":"C.nm_perusahaan"},
              {"data" : "kirim_gudang","name":"P.no_order"},
              {"data" : "sts_print","name":"P.kd_order"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              aoData.push({"name":"thn_bln","value":thnBln});
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(1)",nRow).text(aData["nm_perusahaan"]+" ("+aData["nm_pemesan"]+") ["+aData["no_order"]+"] ["+aData["kd_order"]+"]");
              if(aData["kirim_gudang"] == "FALSE"){
                $("td:eq(10)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalKirimKeGudang('"+aData["no_order"]+"')>Kirim Ke Gudang</button>");
              }else{
                $("td:eq(10)",nRow).html("<div class='label label-danger'>Sudah Dikirim Ke Gudang</div>");
              }

              if(aData["sts_print"] == "FALSE"){
                $("td:eq(11)",nRow).html("<button class='btn btn-md btn-flat btn-info' onclick=printOut('"+aData["no_order"]+"')>Print Out</button>");
              }else{
                $("td:eq(11)",nRow).html("<div class='label label-flat label-warning'>Sudah Di Print Out</div>");
              }
            }
          });
        }

        function dataTableOrderCabangBulanSebelumnya(param){
          $("#table-order-cabang").removeAttr("style");
          $("#table-order-cabang").dataTable().fnDestroy();
          $("#table-order-cabang tbody").empty();
          $("#tableOrderCabangTerkirim").dataTable().fnDestroy();
          $("#tableOrderCabangTerkirim tbody").empty();
          $("#tableOrderCabangTerkirim").attr("style","display:none");
          dataTableOrderCabang(param);
        }

        function dataTableOrderCabangTerkirim(){
          $("#table-order-cabang").dataTable().fnDestroy();
          $("#table-order-cabang tbody").empty();
          $("#table-order-cabang").attr("style","display:none");
          $("#tableOrderCabangTerkirim").removeAttr("style");
          $("#tableOrderCabangTerkirim").dataTable().fnDestroy();
          $("#tableOrderCabangTerkirim").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getOrderCabangTerkirim",
            "columns":[
              {"data" : "tgl_pesan","name":"P.tgl_pesan"},
              {"data" : "nm_pemesan","name":"P.nm_pemesan"},
              {"data" : "jumlah","name":"PD.jumlah"},
              {"data" : "ukuran","name":"GH.ukuran"},
              {"data" : "merek","name":"PD.merek"},
              {"data" : "warna_plastik","name":"GH.warna_plastik"},
              {"data" : "warna_cetak","name":"PD.warna_cetak"},
              {"data" : "sm","name":"PD.sm"},
              {"data" : "dll","name":"PD.dll"},
              {"data" : "note","name":"C.nm_perusahaan"},
              {"data" : "kirim_gudang","name":"P.no_order"},
              {"data" : "sts_print","name":"P.kd_order"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(1)",nRow).text(aData["nm_perusahaan"]+" ("+aData["nm_pemesan"]+") ["+aData["no_order"]+"] ["+aData["kd_order"]+"]");
              if(aData["kirim_gudang"] == "FALSE"){
                $("td:eq(10)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalKirimKeGudang('"+aData["no_order"]+"')>Kirim Ke Gudang</button>");
              }else{
                $("td:eq(10)",nRow).html("<div class='label label-danger'>Sudah Dikirim Ke Gudang</div>");
              }

              if(aData["sts_print"] == "FALSE"){
                $("td:eq(11)",nRow).html("<button class='btn btn-md btn-flat btn-info' onclick=printOut('"+aData["no_order"]+"')>Print Out</button>");
              }else{
                $("td:eq(11)",nRow).html("<div class='label label-flat label-warning'>Sudah Di Print Out</div>");
              }
            }
          });
        }

        function dataTableOrderCabangBulanan(){
          $("#table-order-cabang").removeAttr("style");
          $("#table-order-cabang").dataTable().fnDestroy();
          $("#table-order-cabang tbody").empty();
          $("#tableOrderCabangTerkirim").dataTable().fnDestroy();
          $("#tableOrderCabangTerkirim tbody").empty();
          $("#tableOrderCabangTerkirim").attr("style","display:none");
          var tahun = $("#cmbTahun").val();
          var bulan = $("#cmbBulan").val();
          if(tahun=="" || bulan==""){
            $("#modalNotif").addClass("modal-danger");
            $("#notifContent").text("Tahun Dan Bulan Harus Dipulih Terlebih Dahulu");
            $("#modalNotif").modal("show");
            setTimeout(function(){
              $("#modalNotif").modal("hide");
            },2000);
          }else{
            var param = tahun+"-"+bulan;
            $("#table-order-cabang").dataTable().fnDestroy();
            $("#table-order-cabang tbody").empty();
            dataTableOrderCabang(param);
            $("#cmbTahun").val("");
            $("#cmbBulan").val("");
            $("#modalSearchCabangOrderBulanan").modal("hide");
          }
        }

        function dataTableOrderCabang(thnBln="<?php echo date("Y-m"); ?>"){
          $("#table-order-cabang").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getOrderCabang",
            "columns":[
              {"data" : "tgl_pesan","name":"P.tgl_pesan"},
              {"data" : "nm_pemesan","name":"P.nm_pemesan"},
              {"data" : "jumlah","name":"PD.jumlah"},
              {"data" : "ukuran","name":"GH.ukuran"},
              {"data" : "merek","name":"PD.merek"},
              {"data" : "warna_plastik","name":"GH.warna_plastik"},
              {"data" : "warna_cetak","name":"PD.warna_cetak"},
              {"data" : "sm","name":"PD.sm"},
              {"data" : "dll","name":"PD.dll"},
              {"data" : "note","name":"C.nm_perusahaan"},
              {"data" : "kirim_gudang","name":"P.no_order"},
              {"data" : "sts_print","name":"P.kd_order"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              aoData.push({"name":"thn_bln","value":thnBln});
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(1)",nRow).html(aData["nm_perusahaan"]+" ("+aData["nm_pemesan"]+") <label class='text-blue'>["+aData["no_order"]+"]</label> <label class='text-yellow'>["+aData["no_po"]+"]</label>");
              if(aData["kirim_gudang"] == "FALSE"){
                $("td:eq(10)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalKirimKeGudang('"+aData["no_order"]+"')>Kirim Ke Gudang</button>");
              }else{
                $("td:eq(10)",nRow).html("<div class='label label-danger'>Sudah Dikirim Ke Gudang</div>");
              }

              if(aData["sts_print"] == "FALSE"){
                $("td:eq(11)",nRow).html("<button class='btn btn-md btn-flat btn-info' onclick=printOut('"+aData["no_order"]+"')>Print Out</button>");
              }else{
                $("td:eq(11)",nRow).html("<div class='label label-flat label-warning'>Sudah Di Print Out</div>");
              }
            }
          });
        }

        function dataTableListSpkExtruder(param=""){
          $("#table-list-spk-extruder").dataTable().fnDestroy();
          $("#table-list-spk-extruder").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "scrollY" : "700px",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getListSpk",
            "columns":[
              {"data" : "kd_ppic","name":"kd_ppic"},
              {"data" : "tgl_rencana","name":"tgl_rencana"},
              {"data" : "nm_cust","name":"nm_cust"},
              {"data" : "jns_permintaan","name":"jns_permintaan"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "warna_plastik","name":"warna_plastik"},
              {"data" : "tebal","name":"tebal"},
              {"data" : "merek","name":"merek"},
              {"data" : "ket_merek","name":"ket_merek"},
              {"data" : "berat","name":"berat"},
              {"data" : "jumlah_permintaan","name":"jumlah_permintaan"},
              {"data" : "sisa","name":"sisa"},
              {"data" : "strip","name":"strip"},
              {"data" : "keterangan","name":"keterangan"},
              {"data" : "sts_pengerjaan","name":"sts_pengerjaan"},
              {"data" : "kd_ppic","name":"kd_ppic"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              if(param != ""){
                aoData.push({"name":"periode","value":param});
              }
              aoData.push({"name":"bagian","value":"EXTRUDER"});
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              if(aData["sts_pengerjaan"] == "STOP"){
                var text = " Jalankan";
              }else{
                var text = " Berhenti";
              }
              $("td:eq(10)",nRow).html(aData["jumlah_permintaan"]+" "+aData["satuan"]);
              $("td:eq(11)",nRow).html(aData["sisa"]+" "+aData["satuan"]);
              $("td:eq(14)",nRow).html(aData["sts_pengerjaan"]+" <label class='text-red'>["+aData["prioritas"]+"]</label>");
              $("td:eq(15)",nRow).html(
                                       "<button class='btn btn-flat btn-sm btn-info' onclick=modalEditSpkExtruder('"+aData["kd_ppic"]+"','POLOS'); data-toggle='modal' data-target='#modal-tambah-spk-extruder'><span class='fa fa-edit'></span> Ubah</button>"+
                                       "<button class='btn btn-flat btn-sm btn-warning' data-toggle='modal' data-target='#modalStopSpk' onclick=modalCheckStatusPengerjaan('"+aData["kd_ppic"]+"','"+aData["sts_pengerjaan"]+"')><span class='fa fa-stop-circle-o'></span> "+text+"</button>"+
                                       "<button class='btn btn-flat btn-sm btn-danger' onclick=removeSpk('"+aData["kd_ppic"]+"')><span class='fa fa-trash'></span> Hapus</button>"
                                     );
              if(aData['sts_pengerjaan'] == "STOP"){
                $("td",nRow).css("background-color","rgba(255, 0, 0, 0.7)");
                $("td",nRow).css("color","#FFF");
              }
            }
          });
        }

        function dataTableListSpkCutting(param=""){
          $("#table-list-spk-cutting").dataTable().fnDestroy();
          $("#table-list-spk-cutting").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "scrollY" : "700px",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getListSpk",
            "columns":[
              {"data" : "kd_ppic","name":"kd_ppic"},
              {"data" : "tgl_rencana","name":"tgl_rencana"},
              {"data" : "nm_cust","name":"nm_cust"},
              {"data" : "merek","name":"jns_permintaan"},
              {"data" : "jns_permintaan","name":"ukuran"},
              {"data" : "ukuran","name":"warna_plastik"},
              {"data" : "warna_plastik","name":"tebal"},
              {"data" : "berat","name":"merek"},
              {"data" : "tebal","name":"ket_merek"},
              {"data" : "jumlah_permintaan","name":"berat"},
              {"data" : "sisa","name":"jumlah_permintaan"},
              {"data" : "strip","name":"sisa"},
              {"data" : "permintaan_mesin","name":"strip"},
              {"data" : "keterangan","name":"keterangan"},
              {"data" : "foto_depan","name":"keterangan"},
              {"data" : "sts_pengerjaan","name":"sts_pengerjaan"},
              {"data" : "kd_ppic","name":"kd_ppic"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              if(param != ""){
                aoData.push({"name":"periode","value":param});
              }
              aoData.push({"name":"bagian","value":"POTONG"});
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              if(aData["sts_pengerjaan"] == "STOP"){
                var text = " Jalankan";
              }else{
                var text = " Berhenti";
              }
              if(aData["foto_depan"]==""||aData["foto_depan"]=="NULL"||aData["foto_depan"]==null){

              }else{
                $("td:eq(14)",nRow).html("<img src='<?php echo base_url(); ?>assets/images/upload/"+aData["foto_depan"]+"' class='gambar' onclick='showImage(this)' width='50px' height='75px'>");
              }
              $("td:eq(9)",nRow).html(aData["jumlah_permintaan"]+" "+aData["satuan"]);
              $("td:eq(10)",nRow).html(aData["sisa"]+" "+aData["satuan"]);
              $("td:eq(15)",nRow).html(aData["sts_pengerjaan"]+" <label class='text-red'>["+aData["prioritas"]+"]</label>");
              $("td:eq(16)",nRow).html(
                                       "<button class='btn btn-flat btn-sm btn-info' onclick=modalEditSpkCutting('"+aData["kd_ppic"]+"','POLOS'); data-toggle='modal' data-target='#modal-tambah-spk-cutting'><span class='fa fa-edit'></span> Ubah</button>"+
                                       "<button class='btn btn-flat btn-sm btn-warning' data-toggle='modal' data-target='#modalStopSpk' onclick=modalCheckStatusPengerjaan('"+aData["kd_ppic"]+"','"+aData["sts_pengerjaan"]+"')><span class='fa fa-stop-circle-o'></span> "+text+"</button>"+
                                       "<button class='btn btn-flat btn-sm btn-danger' onclick=removeSpk('"+aData["kd_ppic"]+"')><span class='fa fa-trash'></span> Hapus</button>"
                                     );
              if(aData['sts_pengerjaan'] == "STOP"){
                $("td",nRow).css("background-color","rgba(255, 0, 0, 0.7)");
                $("td",nRow).css("color","#FFF");
              }
            }
          });
        }

        function dataTableListSpkPrinting(param=""){
          $("#table-list-spk-printing").dataTable().fnDestroy();
          $("#table-list-spk-printing").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "scrollY" : "700px",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getListSpk",
            "columns":[
              {"data" : "kd_ppic","name":"kd_ppic"},
              {"data" : "tgl_rencana","name":"tgl_rencana"},
              {"data" : "nm_cust","name":"nm_cust"},
              {"data" : "merek","name":"merek"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "warna_plastik","name":"warna_plastik"},
              {"data" : "berat","name":"berat"},
              {"data" : "tebal","name":"tebal"},
              {"data" : "strip","name":"strip"},
              {"data" : "jumlah_permintaan","name":"jumlah_permintaan"},
              {"data" : "sisa","name":"sisa"},
              {"data" : "warna_cat","name":"warna_cat"},
              {"data" : "sts_pengerjaan","name":"sts_pengerjaan"},
              {"data" : "keterangan","name":"keterangan"},
              {"data" : "kd_ppic","name":"kd_ppic"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              if(param != ""){
                aoData.push({"name":"periode","value":param});
              }
              aoData.push({"name":"bagian","value":"CETAK"});
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              if(aData["sts_pengerjaan"] == "STOP"){
                var text = " Jalankan";
              }else{
                var text = " Berhenti";
              }
              $("td:eq(9)",nRow).html(aData["jumlah_permintaan"]+" "+aData["satuan"]);
              $("td:eq(10)",nRow).html(aData["sisa"]+" "+aData["satuan"]);
              $("td:eq(12)",nRow).html(aData["sts_pengerjaan"]+" <label class='text-red'>["+aData["prioritas"]+"]</label>");
              $("td:eq(14)",nRow).html(
                                       "<button class='btn btn-flat btn-sm btn-info' onclick=modalEditSpkPrinting('"+aData["kd_ppic"]+"','CETAK'); data-toggle='modal' data-target='#modal-tambah-spk-printing'><span class='fa fa-edit'></span> Ubah</button>"+
                                       "<button class='btn btn-flat btn-sm btn-warning' data-toggle='modal' data-target='#modalStopSpk' onclick=modalCheckStatusPengerjaan('"+aData["kd_ppic"]+"','"+aData["sts_pengerjaan"]+"')><span class='fa fa-stop-circle-o'></span> "+text+"</button>"+
                                       "<button class='btn btn-flat btn-sm btn-danger' onclick=removeSpk('"+aData["kd_ppic"]+"')><span class='fa fa-trash'></span> Hapus</button>"
                                     );
              if(aData['sts_pengerjaan'] == "STOP"){
                $("td",nRow).css("background-color","rgba(255, 0, 0, 0.7)");
                $("td",nRow).css("color","#FFF");
              }
            }
          });
        }

        function dataTableListSpkSablon(param=""){
          $("#table-list-spk-sablon").dataTable().fnDestroy();
          $("#table-list-spk-sablon").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "scrollY" : "700px",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getListSpk",
            "columns":[
              {"data" : "kd_ppic","name":"kd_ppic"},
              {"data" : "tgl_rencana","name":"tgl_rencana"},
              {"data" : "nm_cust","name":"nm_cust"},
              {"data" : "merek","name":"merek"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "warna_plastik","name":"warna_plastik"},
              {"data" : "warna_cetak","name":"warna_cetak"},
              {"data" : "berat","name":"berat"},
              {"data" : "tebal","name":"tebal"},
              {"data" : "strip","name":"strip"},
              {"data" : "jumlah_permintaan","name":"jumlah_permintaan"},
              {"data" : "sisa","name":"sisa"},
              {"data" : "sts_pengerjaan","name":"sts_pengerjaan"},
              {"data" : "keterangan","name":"keterangan"},
              {"data" : "foto_depan","name":"foto_depan"},
              {"data" : "kd_ppic","name":"kd_ppic"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              if(param != ""){
                aoData.push({"name":"periode","value":param});
              }
              aoData.push({"name":"bagian","value":"SABLON"});
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              if(aData["sts_pengerjaan"] == "STOP"){
                var text = " Jalankan";
              }else{
                var text = " Berhenti";
              }
              $("td:eq(10)",nRow).html(aData["jumlah_permintaan"]+" "+aData["satuan"]);
              $("td:eq(11)",nRow).html(aData["sisa"]+" "+aData["satuan"]);
              $("td:eq(12)",nRow).html(aData["sts_pengerjaan"]+" <label class='text-red'>["+aData["prioritas"]+"]</label>");
              $("td:eq(14)",nRow).html("<img src='<?php echo base_url(); ?>assets/images/upload/"+aData['foto_depan']+"' class='gambar' width='50px' height='75px' onclick='showImage(this)'>");
              $("td:eq(15)",nRow).html(
                                       "<button class='btn btn-flat btn-sm btn-info' onclick=modalEditSpkSablon('"+aData["kd_ppic"]+"','SABLON'); data-toggle='modal' data-target='#modal-tambah-spk-sablon'><span class='fa fa-edit'></span> Ubah</button>"+
                                       "<button class='btn btn-flat btn-sm btn-warning' data-toggle='modal' data-target='#modalStopSpk' onclick=modalCheckStatusPengerjaan('"+aData["kd_ppic"]+"','"+aData["sts_pengerjaan"]+"')><span class='fa fa-stop-circle-o'></span> "+text+"</button>"+
                                       "<button class='btn btn-flat btn-sm btn-danger' onclick=removeSpk('"+aData["kd_ppic"]+"')><span class='fa fa-trash'></span> Hapus</button>"
                                     );
              if(aData['sts_pengerjaan'] == "STOP"){
                $("td",nRow).css("background-color","rgba(255, 0, 0, 0.7)");
                $("td",nRow).css("color","#FFF");
              }
            }
          });
        }

        function dataTableListHistoryPpicExtruder(param="",param2=""){
          $("#tableListHistoryPpicExtruder").dataTable().fnDestroy();
          $("#tableListHistoryPpicExtruder").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "scrollY" : "700px",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getListHistorySpk",
            "columns":[
              {"data" : "kd_ppic","name":"kd_ppic"},
              {"data" : "tgl_rencana","name":"tgl_rencana"},
              {"data" : "nm_cust","name":"nm_cust"},
              {"data" : "jns_permintaan","name":"jns_permintaan"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "warna_plastik","name":"warna_plastik"},
              {"data" : "tebal","name":"tebal"},
              {"data" : "merek","name":"merek"},
              {"data" : "ket_merek","name":"ket_merek"},
              {"data" : "berat","name":"berat"},
              {"data" : "jumlah_permintaan","name":"jumlah_permintaan"},
              {"data" : "sisa","name":"sisa"},
              {"data" : "strip","name":"strip"},
              {"data" : "keterangan","name":"keterangan"},
              {"data" : "sts_pengerjaan","name":"sts_pengerjaan"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              if(param !="" && param2 !=""){
                aoData.push({"name":"bulan","value":param},{"name":"tahun","value":param2});
              }
              aoData.push({"name":"bagian","value":"EXTRUDER"});
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              if(aData["sts_pengerjaan"] == "STOP"){
                var text = " Jalankan";
              }else{
                var text = " Berhenti";
              }
              $("td:eq(10)",nRow).html(aData["jumlah_permintaan"]+" "+aData["satuan"]);
              $("td:eq(11)",nRow).html(aData["sisa"]+" "+aData["satuan"]);
              $("td:eq(14)",nRow).html(aData["sts_pengerjaan"]+" <label class='text-red'>["+aData["prioritas"]+"]</label>");
              if(aData['sts_pengerjaan'] == "STOP"){
                $("td",nRow).css("background-color","rgba(255, 0, 0, 0.7)");
                $("td",nRow).css("color","#FFF");
              }
            }
          });
        }

        function dataTableListRencanaKerjaExtruder(param="<?php echo date('Y-m-d'); ?>"){
          $("#tableRencanaKerjaExtruder").dataTable().fnDestroy();
          $("#tableRencanaKerjaExtruder").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "scrollY" : "700px",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getListRencanaPerBagian",
            "columns":[
              {"data" : "kd_extruder","name":"EXT.kd_extruder"},
              {"data" : "tgl_rencana","name":"EXT.tgl_rencana"},
              {"data" : "mesin","name":"MSN.no_mesin"},
              {"data" : "nm_cust","name":"EXT.nm_cust"},
              {"data" : "merek","name":"EXT.merek"},
              {"data" : "berat","name":"EXT.berat"},
              {"data" : "ukuran","name":"EXT.ukuran"},
              {"data" : "warna","name":"EXT.warna"},
              {"data" : "tebal","name":"EXT.tebal"},
              {"data" : "strip","name":"EXT.strip"},
              {"data" : "jml_permintaan","name":"EXT.jml_permintaan"},
              {"data" : "sisa","name":"PPIC.sisa"},
              {"data" : "sts_pengerjaan","name":"EXT.sts_pengerjaan"},
              {"data" : "keterangan","name":"PPIC.keterangan"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              aoData.push({"name":"tanggal","value":param});
              aoData.push({"name":"bagian","value":"EXTRUDER"});
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(0)",nRow).text(++iDisplayIndex);
            }
          });
        }

        function dataTableListRencanaKerjaCutting(param="<?php echo date('Y-m-d'); ?>"){
          $("#tableRencanaKerjaCutting").dataTable().fnDestroy();
          $("#tableRencanaKerjaCutting").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "scrollY" : "700px",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getListRencanaPerBagian",
            "columns":[
              {"data" : "kd_potong","name":"CUT.kd_potong"},
              {"data" : "tgl_rencana","name":"CUT.tgl_rencana"},
              {"data" : "no_mesin","name":"CUT.no_mesin"},
              {"data" : "customer","name":"CUT.customer"},
              {"data" : "merek","name":"CUT.merek"},
              {"data" : "ukuran","name":"CUT.ukuran"},
              {"data" : "warna_plastik","name":"CUT.warna_plastik"},
              {"data" : "berat","name":"CUT.berat"},
              {"data" : "tebal","name":"CUT.tebal"},
              {"data" : "strip","name":"CUT.strip"},
              {"data" : "jml_permintaan","name":"CUT.jml_permintaan"},
              {"data" : "sisa","name":"PPIC.sisa"},
              {"data" : "sts_pengerjaan","name":"CUT.sts_pengerjaan"},
              {"data" : "keterangan","name":"PPIC.keterangan"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              aoData.push({"name":"tanggal","value":param});
              aoData.push({"name":"bagian","value":"CUTTING"});
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(0)",nRow).text(++iDisplayIndex);
            }
          });
        }

        function dataTableListRencanaKerjaPrinting(param="<?php echo date('Y-m-d'); ?>"){
          $("#tableRencanaKerjaPrinting").dataTable().fnDestroy();
          $("#tableRencanaKerjaPrinting").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "scrollY" : "700px",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getListRencanaPerBagian",
            "columns":[
              {"data" : "kd_cetak","name":"PRT.kd_cetak"},
              {"data" : "tgl_rencana","name":"PRT.tgl_rencana"},
              {"data" : "no_mesin","name":"PRT.no_mesin"},
              {"data" : "customer","name":"PRT.customer"},
              {"data" : "merek","name":"PRT.merek"},
              {"data" : "ukuran","name":"PRT.ukuran"},
              {"data" : "warna_plastik","name":"PRT.warna_plastik"},
              {"data" : "tebal","name":"PRT.tebal"},
              {"data" : "strip","name":"PRT.strip"},
              {"data" : "jml_permintaan","name":"PRT.jml_permintaan"},
              {"data" : "sisa","name":"PPIC.sisa"},
              {"data" : "sts_pengerjaan","name":"PRT.sts_pengerjaan"},
              {"data" : "keterangan","name":"PPIC.keterangan"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              aoData.push({"name":"tanggal","value":param});
              aoData.push({"name":"bagian","value":"PRINTING"});
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(0)",nRow).text(++iDisplayIndex);
            }
          });
        }

        function dataTableListRencanaKerjaSablon(param="<?php echo date('Y-m-d'); ?>"){
          $("#tableRencanaKerjaSablon").dataTable().fnDestroy();
          $("#tableRencanaKerjaSablon").dataTable({
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI": true,
            "scrollX" : "100%",
            "scrollY" : "700px",
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "sAjaxSource":"<?php echo base_url(); ?>_ppic/main/getListRencanaPerBagian",
            "columns":[
              {"data" : "kd_sablon","name":"SBN.kd_sablon"},
              {"data" : "tgl_rencana","name":"SBN.tgl_rencana"},
              {"data" : "customer","name":"SBN.customer"},
              {"data" : "merek","name":"SBN.merek"},
              {"data" : "jns_permintaan","name":"PPIC.jns_permintaan"},
              {"data" : "ukuran","name":"SBN.ukuran"},
              {"data" : "warna_plastik","name":"SBN.warna_plastik"},
              {"data" : "warna_sablon","name":"SBN.warna_sablon"},
              {"data" : "jml_permintaan","name":"SBN.jml_permintaan"},
              {"data" : "sts_pengerjaan","name":"SBN.sts_pengerjaan"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              aoData.push({"name":"tanggal","value":param});
              aoData.push({"name":"bagian","value":"SABLON"});
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
              $("td:eq(0)",nRow).text(++iDisplayIndex);
            }
          });
        }
//================================ DATATABLE FUNCTION (FINISH) ============================//
      </script>
<!--===============================================General Function (Finish) ===============================================-->
    </body>
</html>
