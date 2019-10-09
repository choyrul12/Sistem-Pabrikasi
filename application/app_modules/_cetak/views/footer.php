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

<!--===============================================On Load Function (Start) ===============================================-->
      <script type="text/javascript">
        $(function () {
          //======= Run Method Automatically (Start) =======//
            if($("#tableRencanaPPIC").length == 1){
              datatableRencanaPPIC();
            }
            if($("#tableRencanaMandor").length == 1){
              datatablesListRencanaMandor();
            }
            if($("#tableHasilCetakPending").length == 1){
              tableHasilCetakPending();
            }
            if($("#tableDataBarangDiambilPotong").length == 1){
              datatableListBarangDiambilPotong();
            }
            if($("#tableDataPengambilanExtruder").length == 1){
              tablePengambilanCetakExtruder();
            }
          //======= Run Method Automatically (Finish) =======//
          //======= Inisialisasi Komponen (Start) =======
          $('.date').datepicker({
              language: 'id',
              viewMode: 'years',
              format: 'yyyy-mm-dd',
              autoclose : true,
              todayHighlight : true
          });

          $(".number").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 3,autoGroup: true});
  				$(".numberFive").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 5,autoGroup: true});

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

<!--===============================================On Load External Function (Start) ===============================================-->
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
<!--===============================================On Load External Function (Finish) ===============================================-->

<!--===============================================General Function (Start) ===============================================-->
      <script>
//================================ MODAL METHOD (START) ============================//
        function modalKonversi(param){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getDetailRencanaPPIC'); ?>",
            dataType : "JSON",
            data : {
              kdPpic : param
            },
            success : function(response){
              $.each(response, function(AvIndex, AvValue){
                $("#txtPemintaanKonversi").val(AvValue.jumlah_permintaan);
                $("#lblSatuan").text(AvValue.satuan);
                $("#txtUkuranKonversi").val(AvValue.ukuran);
                $("#txtBeratKonversi").val(AvValue.berat);
                $("#txtTebalKonversi").val(AvValue.tebal);
                $("#txtJumlahKonversi").val(AvValue.satuan_kilo);
                $("#btnSimpanKonversi").attr("onclick","saveAndEditKonversi('"+param+"')");
              });
              $("#modalKonversiBerat").modal({backdrop:"static"});
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
        }

        function modalBuatRencanaCetak(param){
          resetFormBuatRencanaPending(param);
          $("#btnResetFormBuatRencana").attr("onclick","resetFormBuatRencanaPending('"+param+"')");
        }

        function modalEditRencanaCetak(param, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getDetailRencanaMandorPending'); ?>",
            dataType : "JSON",
            data : {
              kdCetak : param,
              kdPPIC : param2
            },
            success : function(response){
              $("#tableRencanaDetailPPIC > tbody > tr").empty();
              $.each(response.DetailRencanaPPIC, function(AvIndex, AvValue){
                $("#tableRencanaDetailPPIC tbody:last-child").append(
                  "<tr>"+
                    "<td>"+ ++AvIndex+"</td>"+
                    "<td>"+AvValue.nm_cust+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+AvValue.tebal+"</td>"+
                    "<td>"+AvValue.jumlah_permintaan+" "+AvValue.satuan+"</td>"+
                    "<td>"+AvValue.sisa+" KG</td>"+
                    "<td>"+AvValue.sts_pengerjaan+" <label class='text-red'>("+AvValue.prioritas+")</label></td>"+
                  "</tr>"
                );
              });
              $.each(response.DetailRencanaMandor, function(AvIndex, AvValue){
                $("#txtKodeRencana").val(AvValue.kd_cetak);
                $("#txtKodeBarang").val(AvValue.kd_gd_cetak);
                $("#txtNamaCustomer").val(AvValue.customer);
                $("#txtMerek").val(AvValue.merek);
                $("#txtUkuran").val(AvValue.ukuran);
                $("#txtWarnaCat").val(AvValue.warna_cat);
                $("#txtStrip").val(AvValue.strip);
                $("#txtWarnaPlastik").val(AvValue.warna_plastik);
                $("#txtTebal").val(AvValue.tebal);
                $("#txtStatus").val(AvValue.prioritas);
                $("#txtJumlahPermintaan").val(AvValue.jml_permintaan);
                $("#txtJnsBrg").val(AvValue.jns_brg);
                $("#cmbMesin").val(AvValue.no_mesin);
                var panjangPlastik = AvValue.ukuran.split("x");
                $("#txtKodeGdRoll").select2({
    		          placeholder : "Pilih Roll (POLOS)",
    		          dropdownParent: $("#modalBuatRencana"),
    		          width : "100%",
    		          cache : false,
    		          allowClear:true,
    		          ajax:{
    		            url : "<?php echo base_url(); ?>_cetak/main/getComboBoxValueGudangRoll/POLOS/"+panjangPlastik[0],
    		            dataType : "JSON",
    		            delay : 0,
    		            processResults : function(data){
    		              return{
    		                results : $.map(data, function(item){
    		                  return{
    		                    text:item.kd_gd_roll+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_brg+" | "+item.jns_permintaan,
    		                    id:item.kd_gd_roll
    		                  }
    		                })
    		              };
    		            }
    		          }
    		        });
              });
              $("#btnTambahRencanaPending").attr("onclick","editRencanaMandorPending('"+param+"','"+param2+"')").removeClass("btn-primary").addClass("btn-warning").html("<i class='fa fa-pencil'></i> Ubah");
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
        }

        function modalBuatRencanaSusulanCetak(){
          resetFormBuatRencanaSusulanPending();
        }

        function modalEditRencanaSusulanCetak(param){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getDetailRencanaSusulan'); ?>",
            dataType : "JSON",
            data : {
              idTransaksi : param
            },
            success : function(response){
              $.each(response, function(AvIndex, AvValue){
                $("#txtKodeCetak").val(AvValue.kd_cetak);
                $("#txtTglPengerjaan").val(AvValue.tgl_rencana);
                $("#cmbMesin").val(AvValue.no_mesin);
                $("#txtNama").val(AvValue.customer);
                $("#cmbMerek").val(AvValue.kd_gd_cetak).trigger("change");
                $("#cmbMerekPolos").val(AvValue.kd_gd_roll).trigger("change");
                $("#txtWarnaStrip").val(AvValue.strip);
                $("#txtWarnaCat").val(AvValue.warna_cat);
                $("#txtTebal").val(AvValue.tebal);
                $("#txtJumlah").val(AvValue.stok_permintaan);
              });
              $("#btnTambahRencanaSusulanPending").attr("onclick","editTambahRencanaSusulanPending()").removeAttr("btn-primary").addClass("btn-warning").html("<i class='fa fa-pencil'></i> Ubah");
            }
          });
        }

        function modalEditStatusRencana(param,param2){
          $("#cmbStatusPengerjaan").val(param2);
          $("#btnUbahStatusPengerjaan").attr("onclick","editStatusPengerjaan('"+param+"')");
        }

        function modalEditGantiMesin(param, param2){
          $("#cmbNoMesin").val(param2.replace(/_/g, " "));
          $("#btnEditMesin").attr("onclick","editGantiMesin('"+param+"')");
        }

        function modalInputHasil(param){
          $("input").val("");
          $("#txtJenisApal").val("").trigger("change");
          $("#cmbJenisRoll").val("").trigger("change");
          $("select[name='cmbCatMurni']").val("").trigger("change");
          $("select[name='cmbCatCampur']").val("").trigger("change");
          $("select[name='cmbMinyak']").val("").trigger("change");
          $(".number, .numberFive").val(0);
          var clickCatMurni = 1;
          var clickCatCampur = 1;
          var clickMinyak = 1;
          var arrCatMurni = [];
          var arrCatCampur = [];
          var arrMinyak = [];
          $.ajax({
            url : "<?php echo base_url('_cetak/main/getListCatMurni'); ?>",
            dataType : "JSON",
            success : function(response){
              arrCatMurni = response;
              $("#cmbCatMurni1").empty();
              $("#cmbCatMurni1").append('<option value="">--Pilih Jenis Cat Murni--</option>');
              $.each(response, function(AvIndex, AvValue){
                $("#cmbCatMurni1").append('<option value="'+AvValue.kd_gd_bahan+'">'+AvValue.nm_barang+'</option>');
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
          $.ajax({
            url : "<?php echo base_url('_cetak/main/getListCatCampur'); ?>",
            dataType : "JSON",
            success : function(response){
              arrCatCampur = response;
              $("#cmbCatCampur1").empty();
              $("#cmbCatCampur1").append('<option value="">--Pilih Jenis Cat Campur--</option>');
              $.each(response, function(AvIndex, AvValue){
                $("#cmbCatCampur1").append('<option value="'+AvValue.kd_gd_bahan+'">'+AvValue.warna+'</option>');
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
          $.ajax({
            url : "<?php echo base_url('_cetak/main/getListMinyak'); ?>",
            dataType : "JSON",
            success : function(response){
              arrMinyak = response;
              $("#cmbMinyak1").empty();
              $("#cmbMinyak1").append('<option value="">--Pilih Jenis Minyak--</option>');
              $.each(response, function(AvIndex, AvValue){
                $("#cmbMinyak1").append('<option value="'+AvValue.kd_gd_bahan+'">'+AvValue.nm_barang+'</option>');
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
          $.ajax({
            url : "<?php echo base_url('_cetak/main/getListApal'); ?>",
            dataType : "JSON",
            success : function(response){
              $("#txtJenisApal").empty();
              $("#txtJenisApal").append("<option value=''>--Pilih Jenis Apal--</option>");
              $.each(response, function(AvIndex, AvValue){
                $("#txtJenisApal").append("<option value='"+AvValue.kd_gd_apal+"'>"+AvValue.sub_jenis+"</option>");
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
          $.ajax({
            url : "<?php echo base_url('_cetak/main/getGenerateInputHasilCode'); ?>",
            dataType : "JSON",
            success : function(response){
              $("#txtKodeTransaksi").val(response.Code);
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getDetailRencanaForInpurHasil'); ?>",
            dataType : "JSON",
            data : {
              idTransaksi : param
            },
            success : function(response){
              $.each(response, function(AvIndex, AvValue){
                $("#txtKodeRencana").val(AvValue.kd_cetak);
                $("#txtNamaCustomer").val(AvValue.customer);
                $("#txtMerek").val(AvValue.merek);
                $("#txtNoMesin").val(AvValue.no_mesin);
                $("#txtUkuran").val(AvValue.ukuran);
                $("#txtWarnaPlastik").val(AvValue.warna_plastik);
                $("#txtJenisBarang").val(AvValue.jns_brg);
                $("#txtMerekBahan").val(AvValue.merek_bahan);
                $("#txtKeterangan").val(AvValue.strip);
                $("#txtKdGdRollPolos").val(AvValue.kd_gd_roll);
                $("#txtKdGdRollCetak").val(AvValue.kd_gd_cetak);
                $.ajax({
                  type : "POST",
                  url : "<?php echo base_url('_cetak/main/getPengambilanCetakExtruder'); ?>",
                  dataType : "JSON",
                  data : {
                    kdCetak : AvValue.kd_cetak,
                    tglRencana : AvValue.tgl_rencana
                  },
                  success : function(response2){
                    $.each(response2, function(AvIndex2, AvValue2){
                      $("#txtBeratPengambilanExtruder").val((AvValue2.berat > 0) ? AvValue.berat : 0);
                      $("#txtBobinPengambilanExtruder").val((AvValue2.bobin > 0) ? AvValue.bobin : 0);
                      $("#txtPayungPengambilanExtruder").val((AvValue2.payung > 0) ? AvValue.payung : 0);
                      $("#txtPayungKuningPengambilanExtruder").val((AvValue2.payung_kuning > 0) ? AvValue.payung_kuning : 0);
                    });
                  },
                  error : function(response2){
                    $("#modal-notif").addClass("modal-danger");
      							$("#modalNotifContent").text("Server Fault Error Code ( "+response2.status+" ) "+response2.statusText);
      							$("#modal-notif").modal("show");
      							setTimeout(function(){
      								$("#modal-notif").modal("hide");
      								$("#modal-notif").removeClass("modal-danger");
      								$("#modalNotifContent").text("");
      							},2000);
                  }
                })
              });
            }
          });

          $("#txtJenisApal").change(function(){
            $("#txtJumlahApal").val(0);
            if($(this).val() == ""){
              $("#trJumlahApal").css("display","none");
            }else{
              $("#trJumlahApal").css("display","table-row");
            }
          });

          $("#btnTambahCatMurni").click(function(){
              clickCatMurni++;
              if(clickCatMurni <=5){
                $("#tableCatMurniWrapper").append(
                  '<form name="frmCatMurni">'+
                    '<table class="table table-responsive" style="float:left; width:85%;">'+
                      '<tr>'+
                        '<td>'+
                          '<select class="form-control" name="cmbCatMurni" id="cmbCatMurni'+clickCatMurni+'">'+
                            '<option value="">--Pilih Jenis Cat Murni--</option>'+
                          '</select>'+
                        '</td>'+
                        '<td>'+
                          '<input type="text" name="txtJumlahCatMurni" class="form-control number" placeholder="Masukan Jumlah Cat Murni" value="0">'+
                        '</td>'+
                        '<td>'+
                          '<input type="text" name="txtSisaCatMurni" class="form-control number" placeholder="Masukan Sisa Cat Murni" value="0">'+
                        '</td>'+
                      '</tr>'+
                    '</table>'+
                  '</form>'
                );
                $.each(arrCatMurni, function(AvIndex, AvValue){
                  $("#cmbCatMurni"+clickCatMurni).append('<option value="'+AvValue.kd_gd_bahan+'">'+AvValue.nm_barang+'</option>')
                });
              }else{
                $(this).attr("disabled","disabled");
              }
              numberMasking();
          });

          $("#btnTambahCatCampur").click(function(){
            clickCatCampur++;
            if(clickCatCampur <= 5){
              $("#tableCatCampurWrapper").append(
                '<form name="frmCatCampur">'+
                  '<table class="table table-responsive" style="float:left; width:85%;">'+
                    '<tr>'+
                      '<td>'+
                        '<select class="form-control" name="cmbCatCampur" id="cmbCatCampur'+clickCatCampur+'">'+
                          '<option value="">--Pilih Jenis Cat Campur--</option>'+
                        '</select>'+
                      '</td>'+
                      '<td>'+
                        '<input type="text" name="txtJumlahCatCampur" class="form-control number" placeholder="Masukan Jumlah Cat Campur" value="0">'+
                      '</td>'+
                      '<td>'+
                        '<input type="text" name="txtSisaCatCampur" class="form-control number" placeholder="Masukan Sisa Cat Campur" value="0">'+
                      '</td>'+
                    '</tr>'+
                  '</table>'+
                '</form>'
              );
              $.each(arrCatCampur, function(AvIndex, AvValue){
                $("#cmbCatCampur"+clickCatCampur).append('<option value="'+AvValue.kd_gd_bahan+'">'+AvValue.warna+'</option>')
              });
            }else{
              $(this).attr("disabled","disabled");
            }
            numberMasking();
          });

          $("#btnTambahMinyak").click(function(){
            clickMinyak++;
            if(clickMinyak <= 5){
              $("#tableMinyakWrapper").append(
                '<form name="frmMinyak">'+
                  '<table class="table table-responsive" style="float:left; width:85%;">'+
                    '<tr>'+
                      '<td>'+
                        '<select class="form-control" name="cmbMinyak" id="cmbMinyak'+clickMinyak+'">'+
                          '<option value="">--Pilih Jenis Minyak--</option>'+
                        '</select>'+
                      '</td>'+
                      '<td>'+
                        '<input type="text" name="txtJumlahMinyak" class="form-control number" placeholder="Masukan Jumlah Minyak" value="0">'+
                      '</td>'+
                      '<td>'+
                        '<input type="text" name="txtSisaMinyak" class="form-control number" placeholder="Masukan Sisa Minyak" value="0">'+
                      '</td>'+
                    '</tr>'+
                  '</table>'+
                '</form>'
              );
              $.each(arrMinyak, function(AvIndex, AvValue){
                $("#cmbMinyak"+clickMinyak).append('<option value="'+AvValue.kd_gd_bahan+'">'+AvValue.nm_barang+'</option>')
              });
            }else{
              $(this).attr("disabled","disabled");
            }
            numberMasking();
          });

          $("#cmbJenisRoll").change(function(){
            switch ($(this).val()) {
              case "PAYUNG"                 : $("#tablePAYUNG").css("display","block");
                                              $("#tablePAYUNG_KUNING").css("display","none");
                                              $("#tableBOBIN").css("display","none");
                                              $("#tablePAYUNG_KUNING_PAYUNG").css("display","none");
                                              $("#tablePAYUNG_BOBIN").css("display","none");
                                              break;

              case "PAYUNG_KUNING"          : $("#tablePAYUNG").css("display","none");
                                              $("#tablePAYUNG_KUNING").css("display","block");
                                              $("#tableBOBIN").css("display","none");
                                              $("#tablePAYUNG_KUNING_PAYUNG").css("display","none");
                                              $("#tablePAYUNG_BOBIN").css("display","none");
                                              break;

              case "BOBIN"                  : $("#tablePAYUNG").css("display","none");
                                              $("#tablePAYUNG_KUNING").css("display","none");
                                              $("#tableBOBIN").css("display","block");
                                              $("#tablePAYUNG_KUNING_PAYUNG").css("display","none");
                                              $("#tablePAYUNG_BOBIN").css("display","none");
                                              var arrUkuran = $("#txtUkuran").val().split("x");
                                              $("#txtPanjangPlastik").val(arrUkuran[0]);
                                              break;

              case "PAYUNG_KUNING_PAYUNG"   : $("#tablePAYUNG").css("display","none");
                                              $("#tablePAYUNG_KUNING").css("display","none");
                                              $("#tableBOBIN").css("display","none");
                                              $("#tablePAYUNG_KUNING_PAYUNG").css("display","block");
                                              $("#tablePAYUNG_BOBIN").css("display","none");
                                              break;

              case "PAYUNG_BOBIN"           : $("#tablePAYUNG").css("display","none");
                                              $("#tablePAYUNG_KUNING").css("display","none");
                                              $("#tableBOBIN").css("display","none");
                                              $("#tablePAYUNG_KUNING_PAYUNG").css("display","none");
                                              $("#tablePAYUNG_BOBIN").css("display","block");
                                              var arrUkuran = $("#txtUkuran").val().split("x");
                                              $("#txtPanjangPlastik_PB").val(arrUkuran[0]);
                                              break;

              default                       : $("#tablePAYUNG").css("display","none");
                                              $("#tablePAYUNG_KUNING").css("display","none");
                                              $("#tableBOBIN").css("display","none");
                                              $("#tablePAYUNG_KUNING_PAYUNG").css("display","none");
                                              $("#tablePAYUNG_BOBIN").css("display","none");
                                              break;

            }
          });
        }

        function modalDetailJob(param){
          tablePemakaianBahanCetak(param);
          $("#modalDetailJob").modal({backdrop:"static"});
        }

        function modalEditDetailJobCetak(param){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getEditDetailJobCetak'); ?>",
            dataType : "JSON",
            data : {
              idTransaksi : param
            },
            success : function(response){
              $.each(response, function(AvIndex, AvValue){
                $("#txtKodeCetak").val(AvValue.kd_cetak);
                $("#txtNamaCustomer").val(AvValue.customer);
                $("#txtMerek").val(AvValue.merek);
                $("#txtUkuran").val(AvValue.ukuran);
                $("#txtWarnaPlastik").val(AvValue.warna_plastik);
                $("#txtTglPengerjaan").val(AvValue.tgl_transaksi);
                $("#txtJumlahBeratBahan").val(AvValue.jumlah_berat_pengambilan);
                $("#txtJumlahPayungPengambilan").val(AvValue.jumlah_payung_pengambilan);
                $("#txtJumlahPayungKuningPengambilan").val(AvValue.jumlah_payung_kuning_pengambilan);
                $("#txtJumlahBobinPengambilan").val(AvValue.jumlah_bobin_pengambilan);
                $("#txtJumlahSisaBeratBahan").val(AvValue.jumlah_sisa_pengambilan);
                $("#txtJumlahBeratHasilCetak").val(AvValue.jumlah_hasil_selesai);
                $("#txtJumlahPayungHasilCetak").val(AvValue.jumlah_hasil_payung);
                $("#txtJumlahPayungKuningHasilCetak").val(AvValue.jumlah_hasil_payung_kuning);
                $("#txtJumlahBobinHasilCetak").val(AvValue.jumlah_hasil_bobin);
                $("#txtJumlahApal").val(AvValue.jumlah_apal);
                $("#txtJumlahBeratPayungTerbuang").val(AvValue.jumlah_payung_terbuang);
                $("#txtJumlahBeratBobinTerbuang").val(AvValue.jumlah_bobin_terbuang);
                $("#txtJumlahBeratPayungKuningTerbuang").val(AvValue.jumlah_payung_kuning_terbuang);
                $("#txtRollPipa").val(AvValue.berat_roll);
                $("#txtPlusminus").val(AvValue.plusminus);
                switch (AvValue.jenis_roll) {
                  case "PAYUNG"                 : $("#txtJumlahPayungPengambilan").removeAttr("disabled");
                                                  $("#txtJumlahPayungKuningPengambilan").attr("disabled","disabled");
                                                  $("#txtJumlahBobinPengambilan").attr("disabled","disabled");
                                                  $("#txtJumlahPayungHasilCetak").removeAttr("disabled");
                                                  $("#txtJumlahPayungKuningHasilCetak").attr("disabled","disabled");
                                                  $("#txtJumlahBobinHasilCetak").attr("disabled","disabled");
                                                  break;
                  case "PAYUNG_KUNING"          : $("#txtJumlahPayungKuningPengambilan").removeAttr("disabled");
                                                  $("#txtJumlahPayungPengambilan").attr("disabled","disabled");
                                                  $("#txtJumlahBobinPengambilan").attr("disabled","disabled");
                                                  $("#txtJumlahPayungKuningHasilCetak").removeAttr("disabled");
                                                  $("#txtJumlahPayungHasilCetak").attr("disabled","disabled");
                                                  $("#txtJumlahBobinHasilCetak").attr("disabled","disabled");
                                                  break;
                  case "PAYUNG_KUNING_PAYUNG"   : $("#txtJumlahPayungPengambilan").removeAttr("disabled");
                                                  $("#txtJumlahPayungKuningPengambilan").removeAttr("disabled");
                                                  $("#txtJumlahBobinPengambilan").attr("disabled","disabled");
                                                  $("#txtJumlahPayungHasilCetak").removeAttr("disabled");
                                                  $("#txtJumlahPayungKuningHasilCetak").removeAttr("disabled");
                                                  $("#txtJumlahBobinHasilCetak").attr("disabled","disabled");
                                                  break;
                  case "BOBIN"                  : $("#txtJumlahBobinPengambilan").removeAttr("disabled");
                                                  $("#txtJumlahPayungPengambilan").attr("disabled","disabled");
                                                  $("#txtJumlahPayungKuningPengambilan").attr("disabled","disabled");
                                                  $("#txtJumlahBobinHasilCetak").removeAttr("disabled");
                                                  $("#txtJumlahPayungHasilCetak").attr("disabled","disabled");
                                                  $("#txtJumlahPayungKuningHasilCetak").attr("disabled","disabled");
                                                  break;
                  case "PAYUNG_BOBIN"           : $("#txtJumlahPayungPengambilan").removeAttr("disabled");
                                                  $("#txtJumlahPayungKuningPengambilan").attr("disabled","disabled");
                                                  $("#txtJumlahBobinPengambilan").removeAttr("disabled");
                                                  $("#txtJumlahPayungHasilCetak").removeAttr("disabled");
                                                  $("#txtJumlahPayungKuningHasilCetak").attr("disabled","disabled");
                                                  $("#txtJumlahBobinHasilCetak").removeAttr("disabled");
                                                  break;
                  default                       : $("#txtJumlahPayungPengambilan").attr("disabled","disabled");
                                                  $("#txtJumlahPayungKuningPengambilan").attr("disabled","disabled");
                                                  $("#txtJumlahBobinPengambilan").attr("disabled","disabled");
                                                  $("#txtJumlahPayungHasilCetak").attr("disabled","disabled");
                                                  $("#txtJumlahPayungKuningHasilCetak").attr("disabled","disabled");
                                                  $("#txtJumlahBobinHasilCetak").attr("disabled","disabled");
                                                  break;

                }
              });
              $("#btnEditDetailJob").attr("onclick","editDetailJobCetak('"+param+"')");
              $("#modalEditDetailJobCetak").modal({backdrop:"static"});
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
        }

        function modalPengambilanCetak(){
          $("input").val("");
          $("#cmbShift").val("");
          $("#cmbUkuran").val("").trigger("change");
          $("#txtTglTransaksi").on("change", function() {
            var tglRencana = $(this).val();
            $("#cmbUkuran").select2({
              placeholder : "Pilih Ukuran",
              dropdownParent: $("#modalTambahPengambilanExtruder"),
              width : "100%",
              cache : false,
              allowClear:true,
              ajax:{
                url : "<?php echo base_url(); ?>_cetak/main/getUkuranPengambilanCetak/"+tglRencana,
                dataType : "JSON",
                delay : 0,
                processResults : function(data){
                  return{
                    results : $.map(data, function(item){
                      return{
                        text:item.customer+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana,
                        id:item.kd_cetak+"#"+item.kd_gd_roll
                      }
                    })
                  };
                }
              }
            });
          });
          $("#btnSave").attr("onclick","savePengambilanCetak()").removeClass("btn-warning").addClass("btn-primary").html("<i class='fa fa-plus'></i> Tambah");
          $("#txtTglTransaksi").trigger("change");
        }

        function modalEditPengambilanCetakExtruder(param){
          $("input").val("");
          $("#cmbShift").val("");
          $("#cmbUkuran").val("").trigger("change");
          $("#txtTglTransaksi").on("change", function() {
            var tglRencana = $(this).val();
            $("#cmbUkuran").select2({
              placeholder : "Pilih Ukuran",
              dropdownParent: $("#modalTambahPengambilanExtruder"),
              width : "100%",
              cache : false,
              allowClear:true,
              ajax:{
                url : "<?php echo base_url(); ?>_cetak/main/getUkuranPengambilanCetak/"+tglRencana,
                dataType : "JSON",
                delay : 0,
                processResults : function(data){
                  return{
                    results : $.map(data, function(item){
                      return{
                        text:item.customer+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana,
                        id:item.kd_cetak+"#"+item.kd_gd_roll
                      }
                    })
                  };
                }
              }
            });
          });

          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getDetailPengambilanCetakExtruder'); ?>",
            dataType : "JSON",
            data : {idTransaksi : param},
            success : function(response){
              $.each(response, function(AvIndex, AvValue){
                $("#txtTglTransaksi").val(AvValue.tgl_rencana).trigger("change");
                $("#cmbUkuran").val(AvValue.kd_cetak+"#"+AvValue.kd_gd_roll).trigger("change");
                $("#txtBerat").val(AvValue.berat);
                $("#txtBobin").val(AvValue.bobin);
                $("#txtPayung").val(AvValue.payung);
                $("#txtPayungKuning").val(AvValue.payung_kuning);
                $("#cmbShift").val(AvValue.shift);
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
          $("#btnSave").attr("onclick","editPengambilanCetakExtruder('"+param+"')").removeClass("btn-primary").addClass("btn-warning").html("<i class='fa fa-pencil'></i> Ubah");
          $("#modalTambahPengambilanExtruder").modal({backdrop:"static"})
        }

        function modalEditPenggunaanBahan(param, param2){
          var jenis=null;
          var kdGdBahan=null;
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getPenggunaanBahanCetak'); ?>",
            dataType : "JSON",
            data : {
              idTransaksi : param
            },
            success : function(response){
              $.each(response, function(AvIndex, AvValue){
                $("#txtJumlahPengambilan").val(AvValue.jumlah_pengambilan);
                $("#txtSisaPengambilan").val(AvValue.sisa_pengambilan);
                if($.trim(AvValue.jenis)==="CAT MURNI"){
                  $.ajax({
                    url : "<?php echo base_url('_cetak/main/getListCatMurni'); ?>",
                    dataType : "JSON",
                    success : function(response){
                      arrCatMurni = response;
                      $("#cmbJenis").empty();
                      $("#cmbJenis").append('<option value="">--Pilih Jenis Cat Murni--</option>');
                      $.each(response, function(AvIndex, AvValue){
                        $("#cmbJenis").append('<option value="'+AvValue.kd_gd_bahan+'">'+AvValue.nm_barang+'</option>');
                      });
                      $("#cmbJenis").val(AvValue.kd_gd_bahan);
                    },
                    error : function(response){
                      $("#modal-notif").addClass("modal-danger");
        							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
        							$("#modal-notif").modal("show");
        							setTimeout(function(){
        								$("#modal-notif").modal("hide");
        								$("#modal-notif").removeClass("modal-danger");
        								$("#modalNotifContent").text("");
        							},2000);
                    }
                  });
                }else if($.trim(AvValue.jenis)==="CAT CAMPUR"){
                  $.ajax({
                    url : "<?php echo base_url('_cetak/main/getListCatCampur'); ?>",
                    dataType : "JSON",
                    success : function(response){
                      arrCatMurni = response;
                      $("#cmbJenis").empty();
                      $("#cmbJenis").append('<option value="">--Pilih Jenis Cat Campur--</option>');
                      $.each(response, function(AvIndex, AvValue){
                        $("#cmbJenis").append('<option value="'+AvValue.kd_gd_bahan+'">'+AvValue.warna+'</option>');
                      });
                      $("#cmbJenis").val(AvValue.kd_gd_bahan);
                    },
                    error : function(response){
                      $("#modal-notif").addClass("modal-danger");
        							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
        							$("#modal-notif").modal("show");
        							setTimeout(function(){
        								$("#modal-notif").modal("hide");
        								$("#modal-notif").removeClass("modal-danger");
        								$("#modalNotifContent").text("");
        							},2000);
                    }
                  });
                }else if($.trim(AvValue.jenis)==="MINYAK"){
                  $.ajax({
                    url : "<?php echo base_url('_cetak/main/getListMinyak'); ?>",
                    dataType : "JSON",
                    success : function(response){
                      arrCatMurni = response;
                      $("#cmbJenis").empty();
                      $("#cmbJenis").append('<option value="">--Pilih Jenis Minyak--</option>');
                      $.each(response, function(AvIndex, AvValue){
                        $("#cmbJenis").append('<option value="'+AvValue.kd_gd_bahan+'">'+AvValue.nm_barang+'</option>');
                      });
                      $("#cmbJenis").val(AvValue.kd_gd_bahan);
                    },
                    error : function(response){
                      $("#modal-notif").addClass("modal-danger");
        							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
        							$("#modal-notif").modal("show");
        							setTimeout(function(){
        								$("#modal-notif").modal("hide");
        								$("#modal-notif").removeClass("modal-danger");
        								$("#modalNotifContent").text("");
        							},2000);
                    }
                  });
                }else{
                  $("#cmbJenis").empty();
                }
                $("#btnEditPenggunaanBahan").attr("onclick","editPenggunaanBahan('"+param+"','"+param2+"')");
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
          $("#modalEditPenggunaanBahan").modal({backdrop:"static"});
        }

        function modalEditStatusPpic(param){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getDetailRencanaPPIC'); ?>",
            dataType : "JSON",
            data : {
              kdPpic : param
            },
            success : function(response){
              $("#cmbStatusPengerjaan").val(response[0].sts_pengerjaan);
              $("#btnUbahStatusPengerjaan").attr("onclick","editStatusRencanaPpic('"+param+"')");
              $("#modalEditStatusRencana").modal({backdrop:"static"});
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
        }
//================================ MODAL METHOD (FINISH) ============================//

//================================ SEARCH METHOD (START) ============================//
        function searchDataRencanaPPIC(){
          var bulan = $("#cmbBulan").val();
          var tahun = $("#cmbTahun").val();
          if(bulan=="" || tahun==""){
            $("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
          }else{
            datatableRencanaPPIC(bulan, tahun);
          }
        }

        function searchDataListHasilCetak(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
          }else{
            datatableHasilCetak(tglAwal1,tglAkhir1);
            $("#tableHasilCetakWrapper").css("display","block");
            $("#modalCariHasilCetak").modal("hide");
            $("input").empty();
            $(".date").datepicker("setDate",null);
          }
        }

        function searchBonApal(){
          var tglAwal = $("#txtTglAwal").val();
          var tglAkhir = $("#txtTglAkhir").val();
          if(tglAwal=="" || tglAkhir==""){
            $("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
          }else{
            var arrNamaBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            var arrTglAwal = tglAwal.split("-");
            var arrTglAkhir = tglAkhir.split("-");
            var periodeAwal = arrTglAwal[2]+" "+arrNamaBulan[parseInt(arrTglAwal[1])-1]+" "+arrTglAwal[0];
            var periodeAkhir = arrTglAkhir[2]+" "+arrNamaBulan[parseInt(arrTglAkhir[1])-1]+" "+arrTglAkhir[0];
            $("#lblPeriode").text(periodeAwal+" - "+periodeAkhir);
            tableDataBonApal(tglAwal, tglAkhir);
            $("input").empty();
            $(".date").datepicker("setDate",null);
            $("#modalCariBonApal").modal("hide");
            $("#btnPrint").attr("href","<?php echo base_url('_cetak/main/printListBonApal'); ?>/"+tglAwal+"/"+tglAkhir);
            $("#bonApalWrapper").css("display","block");
          }
        }

        function searchBonHasil(){
          var tglAwal = $("#txtTglAwal").val();
          var tglAkhir = $("#txtTglAkhir").val();
          if(tglAwal=="" || tglAkhir==""){
            $("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
          }else{
            var arrNamaBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            var arrTglAwal = tglAwal.split("-");
            var arrTglAkhir = tglAkhir.split("-");
            var periodeAwal = arrTglAwal[2]+" "+arrNamaBulan[parseInt(arrTglAwal[1])-1]+" "+arrTglAwal[0];
            var periodeAkhir = arrTglAkhir[2]+" "+arrNamaBulan[parseInt(arrTglAkhir[1])-1]+" "+arrTglAkhir[0];
            $("#lblPeriode").text(periodeAwal+" - "+periodeAkhir);
            tableDataHasilCetak(tglAwal, tglAkhir);
            $("input").empty();
            $(".date").datepicker("setDate",null);
            $("#modalCariBonHasilCetak").modal("hide");
            $("#bonHasilCetakWrapper").css("display","block");
            $("#btnKirim").attr("onclick","saveKirimHasilCetak('"+tglAwal+"','"+tglAkhir+"')");
            $("#btnPrint").attr("href","<?php echo base_url('_cetak/main/printListBonHasilCetak'); ?>/"+tglAwal+"/"+tglAkhir);
          }
        }

        function searchBonPengambilanBahan(param){
          var tglAwal = $("#txtTglAwal").val();
          var tglAkhir = $("#txtTglAkhir").val();
          if(tglAwal=="" || tglAkhir==""){
            $("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
          }else{
            var arrNamaBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            var arrTglAwal = tglAwal.split("-");
            var arrTglAkhir = tglAkhir.split("-");
            var periodeAwal = arrTglAwal[2]+" "+arrNamaBulan[parseInt(arrTglAwal[1])-1]+" "+arrTglAwal[0];
            var periodeAkhir = arrTglAkhir[2]+" "+arrNamaBulan[parseInt(arrTglAkhir[1])-1]+" "+arrTglAkhir[0];
            $("#lblPeriode").text(periodeAwal+" - "+periodeAkhir);
            tableListPenggunaanBahan(tglAwal, tglAkhir, param);
            $("input").empty();
            $(".date").datepicker("setDate",null);
            $("#modalCariBonPengambilanBahan").modal("hide");
            $("#bonPengambilanBahan").css("display","block");
            $("#btnKirim").attr("onclick","saveKirimBonPengambilan('"+tglAwal+"','"+tglAkhir+"','"+param+"')");
            $("#btnPrint").attr("href","<?php echo base_url('_cetak/main/printListBonPengambilan') ?>/"+tglAwal+"/"+tglAkhir+"/"+param);
          }
        }

        function searchBonPengembalianCatCampur(){
          var tglAwal = $("#txtTglAwal").val();
          var tglAkhir = $("#txtTglAkhir").val();
          if(tglAwal=="" || tglAkhir==""){
            $("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
          }else{
            var arrNamaBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            var arrTglAwal = tglAwal.split("-");
            var arrTglAkhir = tglAkhir.split("-");
            var periodeAwal = arrTglAwal[2]+" "+arrNamaBulan[parseInt(arrTglAwal[1])-1]+" "+arrTglAwal[0];
            var periodeAkhir = arrTglAkhir[2]+" "+arrNamaBulan[parseInt(arrTglAkhir[1])-1]+" "+arrTglAkhir[0];
            $("#lblPeriode").text(periodeAwal+" - "+periodeAkhir);
            tableListPengembalianCatCampur(tglAwal, tglAkhir);
            $("input").empty();
            $(".date").datepicker("setDate",null);
            $("#modalCariBonPengembalianCatCampur").modal("hide");
            $("#bonPengembalianCatCampurWrapper").css("display","block");
            $("#btnKirim").attr("onclick","saveKirimBonPengembalianCatCampur('"+tglAwal+"','"+tglAkhir+"')");
            $("#btnPrint").attr("href","<?php echo base_url('_cetak/main/printListBonPengembalianCatCampur') ?>/"+tglAwal+"/"+tglAkhir);
          }
        }

        function searchBonPengambilanGudang(){
          var tglAwal = $("#txtTglAwal").val();
          var tglAkhir = $("#txtTglAkhir").val();
          if(tglAwal=="" || tglAkhir==""){
            $("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
          }else{
            var arrNamaBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            var arrTglAwal = tglAwal.split("-");
            var arrTglAkhir = tglAkhir.split("-");
            var periodeAwal = arrTglAwal[2]+" "+arrNamaBulan[parseInt(arrTglAwal[1])-1]+" "+arrTglAwal[0];
            var periodeAkhir = arrTglAkhir[2]+" "+arrNamaBulan[parseInt(arrTglAkhir[1])-1]+" "+arrTglAkhir[0];
            $("#lblPeriode").text(periodeAwal+" - "+periodeAkhir);
            tableListDataPengambilanGudang(tglAwal, tglAkhir);
            $("input").empty();
            $(".date").datepicker("setDate",null);
            $("#modalCariBonPengambilanBahan").modal("hide");
            $("#bonPengambilanBahan").css("display","block");
            // $("#btnKirim").attr("onclick","saveKirimBonPengembalianCatCampur('"+tglAwal+"','"+tglAkhir+"')");
            $("#btnPrint").attr("href","<?php echo base_url('_cetak/main/printListBonPengambilanGudangRoll') ?>/"+tglAwal+"/"+tglAkhir);
          }
        }
//================================ SEARCH METHOD (FINISH) ============================//

//================================ RELOAD METHOD (START) ============================//

//================================ RELOAD METHOD (FINISH) ============================//

//================================ RESET METHOD (START) ============================//
        function resetFormBuatRencanaPending(param){
          $("input").val("");
          $("#txtKodeGdRoll").val("");
          $("#txtTglPengerjaan").val("<?php echo date('Y-m-d'); ?>");
          $("#btnTambahRencanaPending").attr("onclick","saveRencanaCetakPending('"+param+"')");
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getDetailRencanaPPIC'); ?>",
            dataType : "JSON",
            data : {
              kdPpic : param
            },
            success : function(response){
              $("#tableRencanaDetailPPIC > tbody > tr").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableRencanaDetailPPIC tbody:last-child").append(
                  "<tr>"+
                    "<td>"+ ++AvIndex+"</td>"+
                    "<td>"+AvValue.nm_cust+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+AvValue.tebal+"</td>"+
                    "<td>"+AvValue.jumlah_permintaan+" "+AvValue.satuan+"</td>"+
                    "<td>"+AvValue.sisa+" KG</td>"+
                    "<td>"+AvValue.sts_pengerjaan+" <label class='text-red'>("+AvValue.prioritas+")</label></td>"+
                  "</tr>"
                );
                $("#txtKodeBarang").val(AvValue.kd_gd_roll);
                $("#txtNamaCustomer").val(AvValue.nm_cust);
                $("#txtMerek").val(AvValue.merek);
                $("#txtUkuran").val(AvValue.ukuran);
                $("#txtWarnaCat").val(AvValue.warna_cat);
                $("#txtStrip").val(AvValue.strip);
                $("#txtWarnaPlastik").val(AvValue.warna_plastik);
                $("#txtTebal").val(AvValue.tebal);
                $("#txtStatus").val(AvValue.prioritas);
                $("#txtJumlahPermintaan").val(AvValue.satuan_kilo);
                $("#txtJnsBrg").val(AvValue.jns_brg);

                if (AvValue.ukuran.indexOf('x') > -1){
                  var panjangPlastik = AvValue.ukuran.split("x");
                }else if (AvValue.ukuran.indexOf('X') > -1) {
                  var panjangPlastik = AvValue.ukuran.split("X");
                }
                $("#txtKodeGdRoll").select2({
    		          placeholder : "Pilih Roll (POLOS)",
    		          dropdownParent: $("#modalBuatRencana"),
    		          width : "100%",
    		          cache:false,
    		          allowClear:true,
    		          ajax:{
    		            url : "<?php echo base_url(); ?>_cetak/main/getComboBoxValueGudangRoll/POLOS/"+panjangPlastik[0],
    		            dataType : "JSON",
    		            delay : 0,
    		            processResults : function(data){
    		              return{
    		                results : $.map(data, function(item){
    		                  return{
    		                    text:item.kd_gd_roll+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_brg+" | "+item.jns_permintaan,
    		                    id:item.kd_gd_roll
    		                  }
    		                })
    		              };
    		            }
    		          }
    		        });
              });
              $("#modalBuatRencana").modal({backdrop:"static"});
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });

          $.ajax({
            url : "<?php echo base_url('_cetak/main/getGenerateCetakCode'); ?>",
            dataType : "JSON",
            success : function(response){
              $("#txtKodeRencana").val(response.Code);
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });

          $.ajax({
            url : "<?php echo base_url('_cetak/main/getListMesin'); ?>",
            dataType : "JSON",
            success : function(response){
              $("#cmbMesin").empty();
              $("#cmbMesin").append("<option value=''>--PIlih Mesin--</option>");
              $.each(response, function(AvIndex, AvValue){
                $("#cmbMesin").append("<option value='"+AvValue.no_mesin+"'>"+AvValue.no_mesin+"</option>");
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });

          tableRencanaMandorPending();

          $("#btnTambahRencanaPending").removeClass("btn-warning").addClass("btn-primary").html("<i class='fa fa-plus'></i> Tambah");
        }

        function resetFormBuatRencanaSusulanPending(){
          $("input").val("");
          $("#cmbMerek").val("");
          $("#cmbMerekPolos").val("");
          $("#txtTglPengerjaan").val("<?php echo date('Y-m-d'); ?>");
          $.ajax({
            url : "<?php echo base_url('_cetak/main/getGenerateCetakCode'); ?>",
            dataType : "JSON",
            success : function(response){
              $("#txtKodeCetak").val(response.Code);
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
          $.ajax({
            url : "<?php echo base_url('_cetak/main/getListMesin'); ?>",
            dataType : "JSON",
            success : function(response){
              $("#cmbMesin").empty();
              $("#cmbMesin").append("<option>--PIlih Mesin--</option>");
              $.each(response, function(AvIndex, AvValue){
                $("#cmbMesin").append("<option value='"+AvValue.no_mesin+"'>"+AvValue.no_mesin+"</option>");
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
							$("#modal-notif").modal("show");
							setTimeout(function(){
								$("#modal-notif").modal("hide");
								$("#modal-notif").removeClass("modal-danger");
								$("#modalNotifContent").text("");
							},2000);
            }
          });
          $("#cmbMerek").select2({
            placeholder : "Pilih Roll (CETAK)",
            dropdownParent: $("#modalBuatRencanaKerjaSusulan"),
            width : "100%",
            cache:false,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_cetak/main/getComboBoxValueGudangCetak",
              dataType : "JSON",
              delay : 0,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.kd_gd_roll+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_brg+" | "+item.jns_permintaan,
                      id:item.kd_gd_roll
                    }
                  })
                };
              }
            }
          });

          $("#cmbMerekPolos").select2({
            placeholder : "Pilih Roll (POLOS)",
            dropdownParent: $("#modalBuatRencanaKerjaSusulan"),
            width : "100%",
            cache : false,
            allowClear:true
          });

          $("#cmbMerek").on("select2:select", function(){
            var dataText = $("#cmbMerek").select2("data")[0]["text"];
            var arrDataText = dataText.split(" | ");
            $("#cmbMerekPolos").select2({
              placeholder : "Pilih Roll (POLOS)",
              dropdownParent: $("#modalBuatRencanaKerjaSusulan"),
              width : "100%",
              cache : false,
              allowClear:true,
              ajax:{
                url : "<?php echo base_url(); ?>_cetak/main/getComboBoxValueGudangRoll/POLOS/"+arrDataText[1],
                dataType : "JSON",
                delay : 0,
                processResults : function(data){
                  return{
                    results : $.map(data, function(item){
                      return{
                        text:item.kd_gd_roll+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_brg+" | "+item.jns_permintaan,
                        id:item.kd_gd_roll
                      }
                    })
                  };
                }
              }
            });
          });

          $("#cmbMerek").on("select2:unselect", function(){
            $("#cmbMerekPolos").select2({
              placeholder : "Pilih Roll (POLOS)",
              dropdownParent: $("#modalBuatRencanaKerjaSusulan"),
              width : "100%",
              cache : false,
              allowClear:true
            });
          });

          $("#btnTambahRencanaSusulanPending").attr("onclick","saveTambahRencanaSusulanPending()").removeClass("btn-warning").addClass("btn-primary").html("<i class='fa fa-plus'></i> Tambah");
          tableRencanaMandorSusulanPending();
        }

        function resetPengambilanCetakExtruder(){
          $("input").val("");
          $("#cmbShift").val("");
          $("#cmbUkuran").val("").trigger("change");
          tablePengambilanCetakExtruder();
        }
//================================ RESET METHOD (FINISH) ============================//

//================================ SAVE METHOD (START) ============================//
        function saveAndEditKonversi(param){
          var jumlahKonversi1 = $("#txtJumlahKonversi").val().replace(/,/g,"");
          if(jumlahKonversi1==""){
            $("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
          }else{
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/saveAndEditKonversi'); ?>",
              dataType : "TEXT",
              data : {
                idTransaksi : param,
                jumlahKonversi : jumlahKonversi1
              },
              beforeSend : function(){
                $("#loading").modal({
                  backdrop:"static",
                  keyboard : false
                });
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
    							$("#modalNotifContent").text("Data Berhasil Disimpan");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-info");
    								$("#modalNotifContent").text("");
                    datatableRencanaPPIC();
                    $("#modalKonversiBerat").modal("hide");
    							},2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
  								$("#modalNotifContent").text("Data Baru Gagal Disimpan");
  								$("#modal-notif").modal("show");
  								setTimeout(function(){
  									$("#modal-notif").modal("hide");
  									$("#modal-notif").removeClass("modal-danger");
  									$("#modalNotifContent").text("");
  								},2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
    							$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-warning");
    								$("#modalNotifContent").text("");
    							},2000);
                }
                $("#loading").modal("hide");
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
  							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
  							$("#modal-notif").modal("show");
  							setTimeout(function(){
  								$("#modal-notif").modal("hide");
  								$("#modal-notif").removeClass("modal-danger");
  								$("#modalNotifContent").text("");
  							},2000);
                $("#loading").modal("hide");
              }
            });
          }
        }

        function saveRencanaCetakPending(param){
          var idRencanaCetak1 = $("#txtKodeRencana").val();
          var kdGdRollCetak1 = $("#txtKodeBarang").val();
          var kdGdRollPolos1 = $("#txtKodeGdRoll").val();
          var customer1 = $("#txtNamaCustomer").val();
          var merek1 = $("#txtMerek").val();
          var ukuran1 = $("#txtUkuran").val();
          var warnaPlastik1 = $("#txtWarnaPlastik").val();
          var warnaCat1 = $("#txtWarnaCat").val();
          var tglRencana1 = $("#txtTglPengerjaan").val();
          var noMesin1 = $("#cmbMesin").val();
          var tebal1 = $("#txtTebal").val();
          var jmlPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g,"");
          var jnsBrg1 = $("#txtJnsBrg").val();
          var strip1 = $("#txtStrip").val();

          if(idRencanaCetak1=="" || kdGdRollCetak1=="" || kdGdRollPolos1=="" ||
             customer1=="" || merek1=="" || ukuran1=="" || warnaPlastik1=="" ||
             warnaCat1=="" || tglRencana1=="" || noMesin1=="" || tebal1=="" ||
             jmlPermintaan1=="" || jnsBrg1=="" || strip1==""
           ){
            $("#modal-notif").addClass("modal-warning");
 						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
 						$("#modal-notif").modal("show");
 						setTimeout(function(){
 							$("#modal-notif").modal("hide");
 							$("#modal-notif").removeClass("modal-warning");
 							$("#modalNotifContent").text("");
 						},2000);
           }else{
             $.ajax({
               type : "POST",
               url : "<?php echo base_url('_cetak/main/saveRencanaCetakPending'); ?>",
               dataType : "TEXT",
               data : {
                 idRencanaPPIC  : param,
                 idRencanaCetak : idRencanaCetak1,
                 kdGdRollCetak  : kdGdRollCetak1,
                 kdGdRollPolos  : kdGdRollPolos1,
                 customer       : customer1,
                 merek          : merek1,
                 ukuran         : ukuran1,
                 warnaPlastik   : warnaPlastik1,
                 warnaCat       : warnaCat1,
                 tglRencana     : tglRencana1,
                 noMesin        : noMesin1,
                 tebal          : tebal1,
                 jmlPermintaan  : jmlPermintaan1,
                 jnsBrg         : jnsBrg1,
                 strip          : strip1
               },
               beforeSend : function(){
                 $("#loading").modal({
                   backdrop:"static",
                   keyboard : false
                 });
               },
               success : function(response){
                 if($.trim(response) === "Berhasil"){
                    $("#modal-notif").addClass("modal-info");
        						$("#modalNotifContent").text("Data Berhasil Ditambahkan");
        						$("#modal-notif").modal("show");
        						setTimeout(function(){
        							$("#modal-notif").modal("hide");
        							$("#modal-notif").removeClass("modal-info");
        							$("#modalNotifContent").text("");
                      tableRencanaMandorPending();
        						},2000);
                 }else if($.trim(response) === "Gagal"){
                    $("#modal-notif").addClass("modal-danger");
        						$("#modalNotifContent").text("Data Gagal Ditambahkan!");
        						$("#modal-notif").modal("show");
        						setTimeout(function(){
        							$("#modal-notif").modal("hide");
        							$("#modal-notif").removeClass("modal-danger");
        							$("#modalNotifContent").text("");
        						},2000);
                 }else{
                    $("#modal-notif").addClass("modal-warning");
        						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
        						$("#modal-notif").modal("show");
        						setTimeout(function(){
        							$("#modal-notif").modal("hide");
        							$("#modal-notif").removeClass("modal-warning");
        							$("#modalNotifContent").text("");
        						},2000);
                 }
                 $("#loading").modal("hide");
               },
               error : function(response){
                $("#modal-notif").addClass("modal-danger");
   							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
   							$("#modal-notif").modal("show");
   							setTimeout(function(){
   								$("#modal-notif").modal("hide");
   								$("#modal-notif").removeClass("modal-danger");
   								$("#modalNotifContent").text("");
   							},2000);
                $("#loading").modal("hide");
               }
             });
           }
        }

        function saveRencanaCetak(){
          if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
            $.ajax({
              url : "<?php echo base_url('_cetak/main/saveRencanaCetak'); ?>",
              dataType : "TEXT",
              beforeSend : function(){
                $("#loading").modal({
                  backdrop:"static",
                  keyboard : false
                });
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
    							$("#modalNotifContent").text("Data Berhasil Disimpan");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-info");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                    tableRencanaMandorPending();
    							},2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
  								$("#modalNotifContent").text("Data Gagal Disimpan");
  								$("#modal-notif").modal("show");
  								setTimeout(function(){
  									$("#modal-notif").modal("hide");
  									$("#modal-notif").removeClass("modal-danger");
  									$("#modalNotifContent").text("");
  								},2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
    							$("#modalNotifContent").text("Item Rencana Masih Kosong!");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-warning");
    								$("#modalNotifContent").text("");
    							},2000);
                }
                $("#loading").modal("hide");
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
  							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
  							$("#modal-notif").modal("show");
  							setTimeout(function(){
  								$("#modal-notif").modal("hide");
  								$("#modal-notif").removeClass("modal-danger");
  								$("#modalNotifContent").text("");
  							},2000);
                $("#loading").modal("hide");
              }
            });
          }
        }

        function saveTambahRencanaSusulanPending(){
          var idRencanaCetak1 = $("#txtKodeCetak").val();
          var kdGdRollCetak1 = $("#cmbMerek").val();
          var kdGdRollPolos1 = $("#cmbMerekPolos").val();
          var customer1 = $("#txtNama").val();
          var warnaCat1 = $("#txtWarnaCat").val();
          var tglRencana1 = $("#txtTglPengerjaan").val();
          var noMesin1 = $("#cmbMesin").val();
          var tebal1 = $("#txtTebal").val();
          var jmlPermintaan1 = $("#txtJumlah").val().replace(/,/g,"");
          var strip1 = $("#txtWarnaStrip").val();
          if(kdGdRollCetak1=="" || kdGdRollCetak1==null){
            var merek1 = "";
            var ukuran1 = "";
            var warnaPlastik1 = "";
            var jnsBrg1 = "";
          }else{
            var dataText = $("#cmbMerek").select2("data")[0]["text"];
            var arrDataText = dataText.split(" | ");
            var merek1 = arrDataText[2];
            var ukuran1 = arrDataText[1];
            var warnaPlastik1 = arrDataText[3];
            var jnsBrg1 = arrDataText[4];
          }
          if(idRencanaCetak1=="" || kdGdRollCetak1=="" || kdGdRollPolos1=="" ||
             customer1=="" || merek1=="" || ukuran1=="" || warnaPlastik1=="" ||
             warnaCat1=="" || tglRencana1=="" || noMesin1=="" || tebal1=="" ||
             jmlPermintaan1=="" || jnsBrg1=="" || strip1==""
           ){
            $("#modal-notif").addClass("modal-warning");
 						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
 						$("#modal-notif").modal("show");
 						setTimeout(function(){
 							$("#modal-notif").modal("hide");
 							$("#modal-notif").removeClass("modal-warning");
 							$("#modalNotifContent").text("");
 						},2000);
           }else{
             $.ajax({
               type : "POST",
               url : "<?php echo base_url('_cetak/main/saveTambahRencanaSusulanPending'); ?>",
               dataType : "TEXT",
               data : {
                 idRencanaCetak : idRencanaCetak1,
                 kdGdRollCetak  : kdGdRollCetak1,
                 kdGdRollPolos  : kdGdRollPolos1,
                 customer       : customer1,
                 merek          : merek1,
                 ukuran         : ukuran1,
                 warnaPlastik   : warnaPlastik1,
                 warnaCat       : warnaCat1,
                 tglRencana     : tglRencana1,
                 noMesin        : noMesin1,
                 tebal          : tebal1,
                 jmlPermintaan  : jmlPermintaan1,
                 jnsBrg         : jnsBrg1,
                 strip          : strip1
               },
               beforeSend : function(){
                 $("#loading").modal({
                   backdrop:"static",
                   keyboard : false
                 });
               },
               success : function(response){
                 if($.trim(response) === "Berhasil"){
                    $("#modal-notif").addClass("modal-info");
        						$("#modalNotifContent").text("Data Berhasil Ditambahkan");
        						$("#modal-notif").modal("show");
        						setTimeout(function(){
        							$("#modal-notif").modal("hide");
        							$("#modal-notif").removeClass("modal-info");
        							$("#modalNotifContent").text("");
                      tableRencanaMandorSusulanPending();
        						},2000);
                 }else if($.trim(response) === "Gagal"){
                    $("#modal-notif").addClass("modal-danger");
        						$("#modalNotifContent").text("Data Gagal Ditambahkan!");
        						$("#modal-notif").modal("show");
        						setTimeout(function(){
        							$("#modal-notif").modal("hide");
        							$("#modal-notif").removeClass("modal-danger");
        							$("#modalNotifContent").text("");
        						},2000);
                 }else{
                    $("#modal-notif").addClass("modal-warning");
        						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
        						$("#modal-notif").modal("show");
        						setTimeout(function(){
        							$("#modal-notif").modal("hide");
        							$("#modal-notif").removeClass("modal-warning");
        							$("#modalNotifContent").text("");
        						},2000);
                 }
                 $("#loading").modal("hide");
               },
               error : function(response){
                $("#modal-notif").addClass("modal-danger");
   							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
   							$("#modal-notif").modal("show");
   							setTimeout(function(){
   								$("#modal-notif").modal("hide");
   								$("#modal-notif").removeClass("modal-danger");
   								$("#modalNotifContent").text("");
   							},2000);
                $("#loading").modal("hide");
               }
             });
           }
        }

        function saveRencanaCetakSusulan(){
          if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
            $.ajax({
              url : "<?php echo base_url('_cetak/main/saveRencanaCetakSusulan'); ?>",
              dataType : 'TEXT',
              beforeSend : function(){
                $("#loading").modal({
                  backdrop:"static",
                  keyboard : false
                });
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
    							$("#modalNotifContent").text("Data Berhasil Disimpan");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-info");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                    tableRencanaMandorSusulanPending();
    							},2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
  								$("#modalNotifContent").text("Data Gagal Disimpan");
  								$("#modal-notif").modal("show");
  								setTimeout(function(){
  									$("#modal-notif").modal("hide");
  									$("#modal-notif").removeClass("modal-danger");
  									$("#modalNotifContent").text("");
  								},2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
    							$("#modalNotifContent").text("Item Rencana Masih Kosong!");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-warning");
    								$("#modalNotifContent").text("");
    							},2000);
                }
                $("#loading").modal("hide");
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
  							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
  							$("#modal-notif").modal("show");
  							setTimeout(function(){
  								$("#modal-notif").modal("hide");
  								$("#modal-notif").removeClass("modal-danger");
  								$("#modalNotifContent").text("");
  							},2000);
                $("#loading").modal("hide");
              }
            });
          }
        }

        function saveInputHasilCetak(){
          var idTransaksi1 = $("#txtKodeTransaksi").val();
          var idRencanaCetak1 = $("#txtKodeRencana").val();
          var namaOperator1 = $("#txtNamaOperator").val();
          var tglTransaksi1 = $("#txtTglPengerjaanHasil").val();
          var jumlahHasilBerat1 = $("#txtJumlahBeratHasilCetak").val().replace(/,/g,"");
          var jumlahHasilBobin1 = $("#txtJumlahBobinHasilCetak").val().replace(/,/g,"");
          var jumlahHasilPayung1 = $("#txtJumlahPayungHasilCetak").val().replace(/,/g,"");
          var jumlahHasilPayungKuning1 = $("#txtJumlahPayungKuningHasilCetak").val().replace(/,/g,"");
          var beratRoll1 = $("#txtRollPipa").val().replace(/,/g,"");
          var plusMinus1 = $("#txtPlusminus").val().replace(/,/g,"");

          var kdGdRollCetak1 = $("#txtKdGdRollCetak").val();
          var kdGdRollPolos1 = $("#txtKdGdRollPolos").val();

          var jumlahBeratPengambilanExtruder1 = $("#txtBeratPengambilanExtruder").val().replace(/,/g,"");
          var jumlahPayungPengambilanExtruder1 = $("#txtPayungPengambilanExtruder").val().replace(/,/g,"");
          var jumlahPayungKuningPengambilanExtruder1 = $("#txtPayungKuningPengambilanExtruder").val().replace(/,/,"");
          var jumlahBobinPengambilanExtruder1 = $("#txtBobinPengambilanExtruder").val().replace(/,/g,"");

          var jumlahBeratPengambilan1 = $("#txtJumlahBeratBahan").val().replace(/,/g,"");
          var jumlahPayungPengambilan1 = $("#txtJumlahPayungBahan").val().replace(/,/g,"");
          var jumlahPayungKuningPengambilan1 = $("#txtJumlahPayungKuningBahan").val().replace(/,/,"");
          var jumlahBobinPengambilan1 = $("#txtJumlahBobinBahan").val().replace(/,/g,"");

          var jumlahSisaPengambalian1 = $("#txtJumlahSisaBeratBahan").val().replace(/,/g,"");
          var jumlahBeratHasilCetak1 = $("#txtJumlahBeratHasilCetak").val().replace(/,/g,"");
          var jumlahPayungHasilCetak1 = $("#txtJumlahPayungHasilCetak").val().replace(/,/g,"");
          var jumlahPayungKuningHasilCetak1 = $("#txtJumlahPayungKuningHasilCetak").val().replace(/,/g,"");
          var jumlahBobinHasilCetak1 = $("#txtJumlahBobinHasilCetak").val().replace(/,/g,"");
          var jumlahPayungTerbuang1 = $("#txtJumlahBeratPayungTerbuang").val().replace(/,/g,"");
          var jumlahPayungKuningTerbuang1 = $("#txtJumlahBeratPayungKuningTerbuang").val().replace(/,/g,"");
          var jumlahBobinTerbuang1 = $("#txtJumlahBeratBobinTerbuang").val().replace(/,/g,"");
          var kdGdApal1 = $("#txtJenisApal").val();
          var jumlahApal1 = $("#txtJumlahApal").val().replace(/,/g,"");
          var jenisRoll1 = $("#cmbJenisRoll").val();

          var arrFrmCatMurni1 = $("form[name='frmCatMurni']").serializeArray();
          var arrFrmCatCampur1 = $("form[name='frmCatCampur']").serializeArray();
          var arrFrmMinyak1 = $("form[name='frmMinyak']").serializeArray();
          var arrCatMurni1 = [];
          var arrCatCampur1 = [];
          var arrMinyak1 = [];
          for (var i = 0; i < arrFrmCatMurni1.length; i+=3) {
            if(arrFrmCatMurni1[i].value != ""){
              var obj = {kdGdBahan : arrFrmCatMurni1[i].value,
                         jumlah : arrFrmCatMurni1[i+1].value,
                         sisa : arrFrmCatMurni1[i+2].value};
              arrCatMurni1.push(obj);
            }
          }
          for (var i = 0; i < arrFrmCatCampur1.length; i+=3) {
            if(arrFrmCatCampur1[i].value != ""){
              var obj = {kdGdBahan : arrFrmCatCampur1[i].value,
                         jumlah : arrFrmCatCampur1[i+1].value,
                         sisa : arrFrmCatCampur1[i+2].value};
              arrCatCampur1.push(obj);
            }
          }
          for (var i = 0; i < arrFrmMinyak1.length; i+=3) {
            if(arrFrmMinyak1[i].value != ""){
              var obj = {kdGdBahan : arrFrmMinyak1[i].value,
                         jumlah : arrFrmMinyak1[i+1].value,
                         sisa : arrFrmMinyak1[i+2].value};
              arrMinyak1.push(obj);
            }
          }

          if(idTransaksi1==""             || idRencanaCetak1==""            || namaOperator1==""                    || tglTransaksi1==""                  ||
             jumlahHasilBerat1==""        || jumlahHasilBobin1==""          || jumlahHasilPayung1==""               || jumlahHasilPayungKuning1==""       ||
             beratRoll1==""               || plusMinus1==""                 || kdGdRollCetak1==""                   || kdGdRollPolos1==""                 ||
             jumlahBeratPengambilan1==""  || jumlahPayungPengambilan1==""   || jumlahPayungKuningPengambilan1==""   || jumlahBobinPengambilan1==""        ||
             jumlahSisaPengambalian1==""  || jumlahBeratHasilCetak1==""     || jumlahPayungHasilCetak1==""          || jumlahPayungKuningHasilCetak1==""  ||
             jumlahBobinHasilCetak1==""   || jumlahPayungTerbuang1==""      || jumlahPayungKuningTerbuang1==""      || jumlahBobinTerbuang1==""           ||
             kdGdApal1==""                || jumlahApal1==""                || jenisRoll1==""
          ){
            $("#modal-notif").addClass("modal-warning");
 						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
 						$("#modal-notif").modal("show");
 						setTimeout(function(){
 							$("#modal-notif").modal("hide");
 							$("#modal-notif").removeClass("modal-warning");
 							$("#modalNotifContent").text("");
 						},2000);
          }else{
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/saveInputHasilCetak'); ?>",
              dataType : "TEXT",
              data : {
                idTransaksi                             : idTransaksi1,
                idRencanaCetak                          : idRencanaCetak1,
                namaOperator                            : namaOperator1,
                tglTransaksi                            : tglTransaksi1,
                jumlahHasilBerat                        : jumlahHasilBerat1,
                jumlahHasilBobin                        : jumlahHasilBobin1,
                jumlahHasilPayung                       : jumlahHasilPayung1,
                jumlahHasilPayungKuning                 : jumlahHasilPayungKuning1,
                beratRoll                               : beratRoll1,
                plusMinus                               : plusMinus1,
                kdGdRollCetak                           : kdGdRollCetak1,
                kdGdRollPolos                           : kdGdRollPolos1,
                jumlahBeratPengambilanExtruder          : jumlahBeratPengambilanExtruder1,
                jumlahPayungPengambilanExtruder         : jumlahPayungPengambilanExtruder1,
                jumlahPayungKuningPengambilanExtruder   : jumlahPayungKuningPengambilanExtruder1,
                jumlahBobinPengambilanExtruder          : jumlahBobinPengambilanExtruder1,
                jumlahBeratPengambilan                  : jumlahBeratPengambilan1,
                jumlahPayungPengambilan                 : jumlahPayungPengambilan1,
                jumlahPayungKuningPengambilan           : jumlahPayungKuningPengambilan1,
                jumlahBobinPengambilan                  : jumlahBobinPengambilan1,
                jumlahSisaPengambalian                  : jumlahSisaPengambalian1,
                jumlahBeratHasilCetak                   : jumlahBeratHasilCetak1,
                jumlahPayungHasilCetak                  : jumlahPayungHasilCetak1,
                jumlahPayungKuningHasilCetak            : jumlahPayungKuningHasilCetak1,
                jumlahBobinHasilCetak                   : jumlahBobinHasilCetak1,
                jumlahPayungTerbuang                    : jumlahPayungTerbuang1,
                jumlahPayungKuningTerbuang              : jumlahPayungKuningTerbuang1,
                jumlahBobinTerbuang                     : jumlahBobinTerbuang1,
                kdGdApal                                : kdGdApal1,
                jumlahApal                              : jumlahApal1,
                jenisRoll                               : jenisRoll1,
                arrCatMurni                             : arrCatMurni1,
                arrCatCampur                            : arrCatCampur1,
                arrMinyak                               : arrMinyak1
              },
              beforeSend : function(){
                $("#loading").modal({
                  backdrop:"static",
                  keyboard : false
                });
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
    							$("#modalNotifContent").text("Data Berhasil Disimpan");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-info");
    								$("#modalNotifContent").text("");
                    $("#modalInputHasil").modal("hide");
                    tableHasilCetakPending();
    							},2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
  								$("#modalNotifContent").text("Data Gagal Disimpan");
  								$("#modal-notif").modal("show");
  								setTimeout(function(){
  									$("#modal-notif").modal("hide");
  									$("#modal-notif").removeClass("modal-danger");
  									$("#modalNotifContent").text("");
  								},2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
       						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
       						$("#modal-notif").modal("show");
       						setTimeout(function(){
       							$("#modal-notif").modal("hide");
       							$("#modal-notif").removeClass("modal-warning");
       							$("#modalNotifContent").text("");
       						},2000);
                }
                $("#loading").modal("hide");
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
  							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
  							$("#modal-notif").modal("show");
  							setTimeout(function(){
  								$("#modal-notif").modal("hide");
  								$("#modal-notif").removeClass("modal-danger");
  								$("#modalNotifContent").text("");
  							},2000);
                $("#loading").modal("hide");
              }
            });
          }
        }

        function saveHasilJobCetak(){
          if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
            $.ajax({
              url : "<?php echo base_url('_cetak/main/saveHasilJobCetak'); ?>",
              dataType : "TEXT",
              beforeSend : function(){
                $("#loading").modal({
                  backdrop:"static",
                  keyboard : false
                });
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
    							$("#modalNotifContent").text("Data Berhasil Disimpan");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-info");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                    tableHasilCetakPending();
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-danger");
  								$("#modalNotifContent").text("Data Gagal Disimpan");
  								$("#modal-notif").modal("show");
  								setTimeout(function(){
  									$("#modal-notif").modal("hide");
  									$("#modal-notif").removeClass("modal-danger");
  									$("#modalNotifContent").text("");
  								},2000);
                }
                $("#loading").modal("hide");
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
                $("#loading").modal("hide");
              }
            });
          }
        }

        function saveKirimHasilCetak(param,param2){
          if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/saveKirimHasilCetak'); ?>",
              dataType : "TEXT",
              data : {
                tglAwal : param,
                tglAkhir : param2
              },
              beforeSend : function(){
                $("#loading").modal({
                  backdrop:"static",
                  keyboard : false
                });
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
    							$("#modalNotifContent").text("Data Berhasil Dikirim");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-info");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                    tableDataHasilCetak(param,param2);
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
    							$("#modalNotifContent").text("Data Gagal Dikirim");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-danger");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                  },2000);
                }else if($.trim(response) === "Lock"){
                  $("#modal-notif").addClass("modal-danger");
    							$("#modalNotifContent").text("Maaf Bulan Tersebut Sudah Dikunci");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-danger");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
    							$("#modalNotifContent").text("Parameter Kosong");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-warning");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                  },2000);
                }
                $("#loading").modal("hide");
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
                $("#loading").modal("hide");
              }
            });
          }
        }

        function saveKirimBonPengambilan(param, param2, param3){
          if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
            $("#loading").modal("show");
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/saveKirimBonPengambilan') ?>",
              dataType : "TEXT",
              data : {
                tglAwal : param,
                tglAkhir : param2,
                jenis : param3
              },
              beforeSend : function(){
                $("#loading").modal({
                  backdrop:"static",
                  keyboard : false
                });
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
    							$("#modalNotifContent").text("Data Berhasil Dikirim");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-info");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                    tableListPenggunaanBahan(param, param2, param3);
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
    							$("#modalNotifContent").text("Data Gagal Dikirim");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-danger");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                  },2000);
                }else if($.trim(response) === "Lock"){
                  $("#modal-notif").addClass("modal-danger");
    							$("#modalNotifContent").text("Maaf, Bulan Ini Sudah Dikunci");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-danger");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
    							$("#modalNotifContent").text("Data List Penggunaan Bahan Masih Kosong");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-warning");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                  },2000);
                }
                $("#loading").modal("hide");
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
                $("#loading").modal("hide");
              }
            });
          }
        }

        function saveKirimBonPengembalianCatCampur(param, param2){
          if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/saveKirimBonPengembalianCatCampur') ?>",
              dataType : "TEXT",
              data : {
                tglAwal : param,
                tglAkhir : param2
              },
              beforeSend : function(){
                $("#loading").modal({
                  backdrop:"static",
                  keyboard : false
                });
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
    							$("#modalNotifContent").text("Data Berhasil Dikirim");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-info");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                    tableListPengembalianCatCampur(param, param2);
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
    							$("#modalNotifContent").text("Data Gagal Dikirim");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-danger");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                  },2000);
                }else if($.trim(response) === "Lock"){
                  $("#modal-notif").addClass("modal-danger");
    							$("#modalNotifContent").text("Maaf, Bulan Ini Sudah Dikunci");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-danger");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
    							$("#modalNotifContent").text("Data List Penggunaan Bahan Masih Kosong");
    							$("#modal-notif").modal("show");
    							setTimeout(function(){
    								$("#modal-notif").modal("hide");
    								$("#modal-notif").removeClass("modal-warning");
    								$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
                  },2000);
                }
                $("#loading").modal("hide");
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
                $("#loading").modal("hide");
              }
            });
          }
        }

        function savePengambilanCetak(){
          var tglTransaksi1 = $("#txtTglTransaksi").val();
          var dataUkuran = $("#cmbUkuran").val();
          var berat1 = $("#txtBerat").val().replace(/,/g,"");
          var bobin1 = $("#txtBobin").val().replace(/,/g,"");
          var payung1 = $("#txtPayung").val().replace(/,/g,"");
          var payungKuning1 = $("#txtPayungKuning").val().replace(/,/g,"");
          var shift1 = $("#cmbShift").val();
          if(dataUkuran != null){
            arrDataUkuran = dataUkuran.split("#");
            var kdCetak1 = arrDataUkuran[0];
            var kdGdRoll1 = arrDataUkuran[1];
          }else{
            var kdCetak1 = "";
            var kdGdRoll1 = "";
          }

          if(tglTransaksi1=="" || berat1=="" || bobin1=="" || payung1=="" ||
             payungKuning1=="" || shift1=="" || kdCetak1=="" || kdGdRoll1==""
           ){
             $("#modal-notif").addClass("modal-warning");
  					 $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
  					 $("#modal-notif").modal("show");
  					 setTimeout(function(){
  					 	$("#modal-notif").modal("hide");
  					 	$("#modal-notif").removeClass("modal-warning");
  					 	$("#modalNotifContent").text("");
  					 },2000);
           }else{
             $.ajax({
               type : "POST",
               url : "<?php echo base_url('_cetak/main/savePengambilanCetak'); ?>",
               dataType : "TEXT",
               data : {
                 tglRencana   : tglTransaksi1,
                 berat        : berat1,
                 bobin        : bobin1,
                 payung       : payung1,
                 payungKuning : payungKuning1,
                 shift        : shift1,
                 kdCetak      : kdCetak1,
                 kdGdRoll     : kdGdRoll1
               },
               beforeSend : function(){
                 $("loading").modal({
                   backdrop : "static",
                   keyboard : false
                 });
               },
               success : function(response){
                 if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
     							$("#modalNotifContent").text("Data Berhasil Disimpan");
     							$("#modal-notif").modal("show");
     							setTimeout(function(){
     								$("#modal-notif").modal("hide");
     								$("#modal-notif").removeClass("modal-info");
     								$("#modalNotifContent").text("");
                    $("#modalTambahPengambilanExtruder").modal("hide");
                    resetPengambilanCetakExtruder();
     							},2000);
                 }else if($.trim(response) === "Gagal"){
                   $("#modal-notif").addClass("modal-danger");
      						 $("#modalNotifContent").text("Data Gagal Disimpan");
      						 $("#modal-notif").modal("show");
      						 setTimeout(function(){
      						 	$("#modal-notif").modal("hide");
      						 	$("#modal-notif").removeClass("modal-danger");
      						 	$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
      						 },2000);
                 }else if($.trim(response) === "Lock"){
                   $("#modal-notif").addClass("modal-danger");
      					   $("#modalNotifContent").text("Maaf, Bulan Ini Sudah DiKunci");
      						 $("#modal-notif").modal("show");
      						 setTimeout(function(){
      						 	$("#modal-notif").modal("hide");
      						 	$("#modal-notif").removeClass("modal-danger");
      						 	$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
      						 },2000);
                 }else{
                   $("#modal-notif").addClass("modal-warning");
        					 $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
        					 $("#modal-notif").modal("show");
        					 setTimeout(function(){
        					 	$("#modal-notif").modal("hide");
        					 	$("#modal-notif").removeClass("modal-warning");
        					 	$("#modalNotifContent").text("");
        					 },2000);
                 }
                 $("loading").modal("hide");
               },
               error : function(response){
                $("#modal-notif").addClass("modal-danger");
   							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
   							$("#modal-notif").modal("show");
   							setTimeout(function(){
   								$("#modal-notif").modal("hide");
   								$("#modal-notif").removeClass("modal-danger");
   								$("#modalNotifContent").text("");
   							},2000);
                 $("#loading").modal("hide");
               }
             });
           }
        }
//================================ SAVE METHOD (FINISH) ============================//

//================================ EDIT METHOD (START) ============================//
        function editRencanaMandorPending(param, param2){
          var idRencanaCetak1 = $("#txtKodeRencana").val();
          var kdGdRollCetak1 = $("#txtKodeBarang").val();
          var kdGdRollPolos1 = $("#txtKodeGdRoll").val();
          var customer1 = $("#txtNamaCustomer").val();
          var merek1 = $("#txtMerek").val();
          var ukuran1 = $("#txtUkuran").val();
          var warnaPlastik1 = $("#txtWarnaPlastik").val();
          var warnaCat1 = $("#txtWarnaCat").val();
          var tglRencana1 = $("#txtTglPengerjaan").val();
          var noMesin1 = $("#cmbMesin").val();
          var tebal1 = $("#txtTebal").val();
          var jmlPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g,"");
          var jnsBrg1 = $("#txtJnsBrg").val();
          var strip1 = $("#txtStrip").val();

          if(idRencanaCetak1=="" || kdGdRollCetak1=="" ||
             customer1=="" || merek1=="" || ukuran1=="" || warnaPlastik1=="" ||
             warnaCat1=="" || tglRencana1=="" || noMesin1=="" || tebal1=="" ||
             jmlPermintaan1=="" || jnsBrg1=="" || strip1==""
           ){
            $("#modal-notif").addClass("modal-warning");
 						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
 						$("#modal-notif").modal("show");
 						setTimeout(function(){
 							$("#modal-notif").modal("hide");
 							$("#modal-notif").removeClass("modal-warning");
 							$("#modalNotifContent").text("");
 						},2000);
           }else{
             $.ajax({
               type : "POST",
               url : "<?php echo base_url('_cetak/main/editRencanaMandorPending'); ?>",
               dataType : "TEXT",
               data : {
                 idRencanaPPIC  : param2,
                 idRencanaCetak : idRencanaCetak1,
                 kdGdRollCetak  : kdGdRollCetak1,
                 kdGdRollPolos  : kdGdRollPolos1,
                 customer       : customer1,
                 merek          : merek1,
                 ukuran         : ukuran1,
                 warnaPlastik   : warnaPlastik1,
                 warnaCat       : warnaCat1,
                 tglRencana     : tglRencana1,
                 noMesin        : noMesin1,
                 tebal          : tebal1,
                 jmlPermintaan  : jmlPermintaan1,
                 jnsBrg         : jnsBrg1,
                 strip          : strip1
               },
               beforeSend : function(){
                 $("#loading").modal({
                   backdrop:"static",
                   keyboard : false
                 });
               },
               success : function(response){
                 if($.trim(response) === "Berhasil"){
                    $("#modal-notif").addClass("modal-info");
        						$("#modalNotifContent").text("Data Berhasil Diubah");
        						$("#modal-notif").modal("show");
        						setTimeout(function(){
        							$("#modal-notif").modal("hide");
        							$("#modal-notif").removeClass("modal-info");
        							$("#modalNotifContent").text("");
                      tableRencanaMandorPending();
                      $("#btnResetFormBuatRencana").trigger("click");
        						},2000);
                 }else if($.trim(response) === "Gagal"){
                    $("#modal-notif").addClass("modal-danger");
        						$("#modalNotifContent").text("Data Gagal Diubah!");
        						$("#modal-notif").modal("show");
        						setTimeout(function(){
        							$("#modal-notif").modal("hide");
        							$("#modal-notif").removeClass("modal-danger");
        							$("#modalNotifContent").text("");
        						},2000);
                 }else{
                    $("#modal-notif").addClass("modal-warning");
        						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
        						$("#modal-notif").modal("show");
        						setTimeout(function(){
        							$("#modal-notif").modal("hide");
        							$("#modal-notif").removeClass("modal-warning");
        							$("#modalNotifContent").text("");
        						},2000);
                 }
                 $("#loading").modal("hide");
               },
               error : function(response){
                $("#modal-notif").addClass("modal-danger");
   							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
   							$("#modal-notif").modal("show");
   							setTimeout(function(){
   								$("#modal-notif").modal("hide");
   								$("#modal-notif").removeClass("modal-danger");
   								$("#modalNotifContent").text("");
   							},2000);
                $("#loading").modal("hide");
               }
             });
           }
        }

        function editTambahRencanaSusulanPending(){
          var idRencanaCetak1 = $("#txtKodeCetak").val();
          var kdGdRollCetak1 = $("#cmbMerek").val();
          var kdGdRollPolos1 = $("#cmbMerekPolos").val();
          var customer1 = $("#txtNama").val();
          var warnaCat1 = $("#txtWarnaCat").val();
          var tglRencana1 = $("#txtTglPengerjaan").val();
          var noMesin1 = $("#cmbMesin").val();
          var tebal1 = $("#txtTebal").val();
          var jmlPermintaan1 = $("#txtJumlah").val().replace(/,/g,"");
          var strip1 = $("#txtWarnaStrip").val();
          if(kdGdRollCetak1=="" || kdGdRollCetak1==null){
            var merek1 = "";
            var ukuran1 = "";
            var warnaPlastik1 = "";
            var jnsBrg1 = "";
          }else{
            var dataText = $("#cmbMerek").select2("data")[0]["text"];
            var arrDataText = dataText.split(" | ");
            var merek1 = arrDataText[2];
            var ukuran1 = arrDataText[1];
            var warnaPlastik1 = arrDataText[3];
            var jnsBrg1 = arrDataText[4];
          }
          if(idRencanaCetak1=="" || customer1=="" ||
             warnaCat1=="" || tglRencana1=="" || noMesin1=="" || tebal1=="" ||
             jmlPermintaan1=="" || strip1==""
           ){
            $("#modal-notif").addClass("modal-warning");
 						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
 						$("#modal-notif").modal("show");
 						setTimeout(function(){
 							$("#modal-notif").modal("hide");
 							$("#modal-notif").removeClass("modal-warning");
 							$("#modalNotifContent").text("");
 						},2000);
           }else{
             $.ajax({
               type : "POST",
               url : "<?php echo base_url('_cetak/main/editTambahRencanaSusulanPending'); ?>",
               dataType : "TEXT",
               data : {
                 idRencanaCetak : idRencanaCetak1,
                 kdGdRollCetak  : kdGdRollCetak1,
                 kdGdRollPolos  : kdGdRollPolos1,
                 customer       : customer1,
                 merek          : merek1,
                 ukuran         : ukuran1,
                 warnaPlastik   : warnaPlastik1,
                 warnaCat       : warnaCat1,
                 tglRencana     : tglRencana1,
                 noMesin        : noMesin1,
                 tebal          : tebal1,
                 jmlPermintaan  : jmlPermintaan1,
                 jnsBrg         : jnsBrg1,
                 strip          : strip1
               },
               beforeSend : function(){
                 $("#loading").modal({
                   backdrop:"static",
                   keyboard : false
                 });
               },
               success : function(response){
                 if($.trim(response) === "Berhasil"){
                    $("#modal-notif").addClass("modal-info");
        						$("#modalNotifContent").text("Data Berhasil Diubah");
        						$("#modal-notif").modal("show");
        						setTimeout(function(){
        							$("#modal-notif").modal("hide");
        							$("#modal-notif").removeClass("modal-info");
        							$("#modalNotifContent").text("");
                      resetFormBuatRencanaSusulanPending();
        						},2000);
                 }else if($.trim(response) === "Gagal"){
                    $("#modal-notif").addClass("modal-danger");
        						$("#modalNotifContent").text("Data Gagal Diubah!");
        						$("#modal-notif").modal("show");
        						setTimeout(function(){
        							$("#modal-notif").modal("hide");
        							$("#modal-notif").removeClass("modal-danger");
        							$("#modalNotifContent").text("");
        						},2000);
                 }else{
                    $("#modal-notif").addClass("modal-warning");
        						$("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
        						$("#modal-notif").modal("show");
        						setTimeout(function(){
        							$("#modal-notif").modal("hide");
        							$("#modal-notif").removeClass("modal-warning");
        							$("#modalNotifContent").text("");
        						},2000);
                 }
                 $("#loading").modal("hide");
               },
               error : function(response){
                $("#modal-notif").addClass("modal-danger");
   							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
   							$("#modal-notif").modal("show");
   							setTimeout(function(){
   								$("#modal-notif").modal("hide");
   								$("#modal-notif").removeClass("modal-danger");
   								$("#modalNotifContent").text("");
   							},2000);
                $("#loading").modal("hide");
               }
             });
           }
        }

        function editStatusPengerjaan(param){
          var stsPengerjaan1 = $("#cmbStatusPengerjaan").val();
          if(stsPengerjaan1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/editStatusPengerjaan'); ?>",
              dataType : "TEXT",
              data : {
                idTransaksi : param,
                stsPengerjaan : stsPengerjaan1
              },
              beforeSend : function(){
                $("#loading").modal({
                  backdrop:"static",
                  keyboard : false
                });
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Data Berhasil Diubah");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    datatablesListRencanaMandor();
                    $("#cmbStatusPengerjaan").val("");
                    $("#modalEditStatusRencana").modal("hide");
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Data Gagal Diubah!");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
                  $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-warning");
                    $("#modalNotifContent").text("");
                  },2000);
                }
                $("#loading").modal("hide");
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
                $("#loading").modal("hide");
              }
            });
          }
        }

        function editGantiMesin(param){
          var noMesin1 = $("#cmbNoMesin").val();
          if(noMesin1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/editGantiMesin'); ?>",
              dataType : "TEXT",
              data : {
                idTransaksi : param,
                noMesin : noMesin1
              },
              beforeSend : function(){
                $("#loading").modal({
                  backdrop:"static",
                  keyboard : false
                });
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Data Berhasil Diubah");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    datatablesListRencanaMandor();
                    $("#cmbNoMesin").val("");
                    $("#modalEditMesin").modal("hide");
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Data Gagal Diubah!");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
                  $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-warning");
                    $("#modalNotifContent").text("");
                  },2000);
                }
                $("#loading").modal("hide");
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
                $("#loading").modal("hide");
              }
            });
          }
        }

        function editDetailJobCetak(param){
          var idTransaksi1 = param;
          var jumlahBeratPengambilan1 = $("#txtJumlahBeratBahan").val().replace(/,/g, "");
          var jumlahPayungPengambilan1 = $("#txtJumlahPayungPengambilan").val().replace(/,/g, "");
          var jumlahPayungKuningPengambilan1 = $("#txtJumlahPayungKuningPengambilan").val().replace(/,/g, "");
          var jumlahBobinPengambilan1 = $("#txtJumlahBobinPengambilan").val().replace(/,/g, "");
          var jumlahSisaPengambilan1 = $("#txtJumlahSisaBeratBahan").val().replace(/,/g, "");
          var jumlahBeratHasil1 = $("#txtJumlahBeratHasilCetak").val().replace(/,/g, "");
          var jumlahPayungHasil1 = $("#txtJumlahPayungHasilCetak").val().replace(/,/g, "");
          var jumlahPayungKuningHasil1 = $("#txtJumlahPayungKuningHasilCetak").val().replace(/,/g, "");
          var jumlahBobinHasil1 = $("#txtJumlahBobinHasilCetak").val().replace(/,/g, "");
          var jumlahApal1 = $("#txtJumlahApal").val().replace(/,/g, "");
          var jumlahPayungTerbuang1 = $("#txtJumlahBeratPayungTerbuang").val().replace(/,/g, "");
          var jumlahPayungKuningTerbuang1 = $("#txtJumlahBeratPayungKuningTerbuang").val().replace(/,/g, "");
          var jumlahBobinTerbuang1 = $("#txtJumlahBeratBobinTerbuang").val().replace(/,/g, "");
          var rollPipa1 = $("#txtRollPipa").val().replace(/,/g, "");
          var plusminus1 = $("#txtPlusminus").val().replace(/,/g, "");
          var tglTransaksi1 = $("#txtTglPengerjaan").val();

          if(idTransaksi1 == "" || jumlahBeratPengambilan1 == "" || jumlahPayungPengambilan1 == "" ||
             jumlahPayungKuningPengambilan1 == "" || jumlahBobinPengambilan1 == "" ||
             jumlahSisaPengambilan1 == "" || jumlahBeratHasil1 == "" || jumlahPayungHasil1 == "" ||
             jumlahPayungKuningHasil1 == "" || jumlahBobinHasil1 == "" || jumlahApal1 == "" ||
             jumlahPayungTerbuang1 == "" || jumlahPayungKuningTerbuang1 == "" ||
             jumlahBobinTerbuang1 == "" || rollPipa1 == "" || plusminus1 == "" || tglTransaksi1 == ""
           ){
             $("#modal-notif").addClass("modal-warning");
             $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
             $("#modal-notif").modal("show");
             setTimeout(function(){
               $("#modal-notif").modal("hide");
               $("#modal-notif").removeClass("modal-warning");
               $("#modalNotifContent").text("");
             },2000);
           }else{
             $.ajax({
               type : "POST",
               url : "<?php echo base_url('_cetak/main/editDetailJobCetak'); ?>",
               dataType : "TEXT",
               data : {
                 idTransaksi                    : idTransaksi1,
                 jumlahBeratPengambilan         : jumlahBeratPengambilan1,
                 jumlahPayungPengambilan        : jumlahPayungPengambilan1,
                 jumlahPayungKuningPengambilan  : jumlahPayungKuningPengambilan1,
                 jumlahBobinPengambilan         : jumlahBobinPengambilan1,
                 jumlahSisaPengambilan          : jumlahSisaPengambilan1,
                 jumlahBeratHasil               : jumlahBeratHasil1,
                 jumlahPayungHasil              : jumlahPayungHasil1,
                 jumlahPayungKuningHasil        : jumlahPayungKuningHasil1,
                 jumlahBobinHasil               : jumlahBobinHasil1,
                 jumlahApal                     : jumlahApal1,
                 jumlahPayungTerbuang           : jumlahPayungTerbuang1,
                 jumlahPayungKuningTerbuang     : jumlahPayungKuningTerbuang1,
                 jumlahBobinTerbuang            : jumlahBobinTerbuang1,
                 rollPipa                       : rollPipa1,
                 plusminus                      : plusminus1,
                 tglTransaksi                   : tglTransaksi1
               },
               beforeSend : function(){
                 $("#loading").modal({
                   backdrop:"static",
                   keyboard : false
                 });
               },
               success : function(response){
                 if($.trim(response) === "Berhasil"){
                   $("#modal-notif").addClass("modal-info");
                   $("#modalNotifContent").text("Data Berhasil Diubah");
                   $("#modal-notif").modal("show");
                   setTimeout(function(){
                     $("#modal-notif").modal("hide");
                     $("#modal-notif").removeClass("modal-info");
                     $("#modalNotifContent").text("");
                     $("#modalEditDetailJobCetak").modal("hide");
                   },2000);
                 }else if($.trim(response) === "Gagal"){
                   $("#modal-notif").addClass("modal-danger");
                   $("#modalNotifContent").text("Data Gagal Diubah!");
                   $("#modal-notif").modal("show");
                   setTimeout(function(){
                     $("#modal-notif").modal("hide");
                     $("#modal-notif").removeClass("modal-danger");
                     $("#modalNotifContent").text("");
                   },2000);
                 }else{
                   $("#modal-notif").addClass("modal-warning");
                   $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
                   $("#modal-notif").modal("show");
                   setTimeout(function(){
                     $("#modal-notif").modal("hide");
                     $("#modal-notif").removeClass("modal-warning");
                     $("#modalNotifContent").text("");
                   },2000);
                 }
                 $("#loading").modal("hide");
               },
               error : function(response) {
                 $("#modal-notif").addClass("modal-danger");
                 $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
                 $("#modal-notif").modal("show");
                 setTimeout(function(){
                   $("#modal-notif").modal("hide");
                   $("#modal-notif").removeClass("modal-danger");
                   $("#modalNotifContent").text("");
                 },2000);
                 $("#loading").modal("hide");
               }
             });
           }
        }

        function editPengambilanCetakExtruder(param){
          var tglTransaksi1 = $("#txtTglTransaksi").val();
          var dataUkuran = $("#cmbUkuran").val();
          var berat1 = $("#txtBerat").val().replace(/,/g,"");
          var bobin1 = $("#txtBobin").val().replace(/,/g,"");
          var payung1 = $("#txtPayung").val().replace(/,/g,"");
          var payungKuning1 = $("#txtPayungKuning").val().replace(/,/g,"");
          var shift1 = $("#cmbShift").val();
          if(dataUkuran != null){
            arrDataUkuran = dataUkuran.split("#");
            var kdCetak1 = arrDataUkuran[0];
            var kdGdRoll1 = arrDataUkuran[1];
          }else{
            var kdCetak1 = "";
            var kdGdRoll1 = "";
          }

          if(tglTransaksi1=="" || berat1=="" || bobin1=="" || payung1=="" ||
             payungKuning1=="" || shift1==""
           ){
             $("#modal-notif").addClass("modal-warning");
  					 $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
  					 $("#modal-notif").modal("show");
  					 setTimeout(function(){
  					 	$("#modal-notif").modal("hide");
  					 	$("#modal-notif").removeClass("modal-warning");
  					 	$("#modalNotifContent").text("");
  					 },2000);
           }else{
             $.ajax({
               type : "POST",
               url : "<?php echo base_url('_cetak/main/editPengambilanCetak'); ?>",
               dataType : "TEXT",
               data : {
                 tglRencana   : tglTransaksi1,
                 berat        : berat1,
                 bobin        : bobin1,
                 payung       : payung1,
                 payungKuning : payungKuning1,
                 shift        : shift1,
                 kdCetak      : kdCetak1,
                 kdGdRoll     : kdGdRoll1,
                 idTransaksi  : param
               },
               beforeSend : function(){
                 $("loading").modal({
                   backdrop : "static",
                   keyboard : false
                 });
               },
               success : function(response){
                 if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
     							$("#modalNotifContent").text("Data Berhasil Disimpan");
     							$("#modal-notif").modal("show");
     							setTimeout(function(){
     								$("#modal-notif").modal("hide");
     								$("#modal-notif").removeClass("modal-info");
     								$("#modalNotifContent").text("");
                    $("#modalTambahPengambilanExtruder").modal("hide");
                    resetPengambilanCetakExtruder();
     							},2000);
                 }else if($.trim(response) === "Gagal"){
                   $("#modal-notif").addClass("modal-danger");
      						 $("#modalNotifContent").text("Data Gagal Disimpan");
      						 $("#modal-notif").modal("show");
      						 setTimeout(function(){
      						 	$("#modal-notif").modal("hide");
      						 	$("#modal-notif").removeClass("modal-danger");
      						 	$("#modalNotifContent").text("");
                    $("#modalBuatRencana").modal("hide");
      						 },2000);
                 }else{
                   $("#modal-notif").addClass("modal-warning");
        					 $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
        					 $("#modal-notif").modal("show");
        					 setTimeout(function(){
        					 	$("#modal-notif").modal("hide");
        					 	$("#modal-notif").removeClass("modal-warning");
        					 	$("#modalNotifContent").text("");
        					 },2000);
                 }
                 $("loading").modal("hide");
               },
               error : function(response){
                $("#modal-notif").addClass("modal-danger");
   							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
   							$("#modal-notif").modal("show");
   							setTimeout(function(){
   								$("#modal-notif").modal("hide");
   								$("#modal-notif").removeClass("modal-danger");
   								$("#modalNotifContent").text("");
   							},2000);
                 $("#loading").modal("hide");
               }
             });
           }
        }

        function editPenggunaanBahan(param, param2){
          var idTransaksi1 = param;
          var kdGdBahan1 = $("#cmbJenis").val();
          var jumlahPenggunaan1 = $("#txtJumlahPengambilan").val().replace(/,/g,"");
          var sisaPenggunaan1 = $("#txtSisaPengambilan").val().replace(/,/g,"");

          if(kdGdBahan1=="" || jumlahPenggunaan1=="" || sisaPenggunaan1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
             $("#modal-notif").modal("hide");
             $("#modal-notif").removeClass("modal-warning");
             $("#modalNotifContent").text("");
            },2000);
          }else{
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/editPenggunaanBahan'); ?>",
              dataType : "TEXT",
              data : {
                idTransaksi       : idTransaksi1,
                kdGdBahan         : kdGdBahan1,
                jumlahPenggunaan  : jumlahPenggunaan1,
                sisaPenggunaan    : sisaPenggunaan1
              },
              beforeSend : function(){
                $("loading").modal({
                  backdrop : "static",
                  keyboard : false
                });
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Data Berhasil Diubah");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                   $("#modal-notif").modal("hide");
                   $("#modal-notif").removeClass("modal-info");
                   $("#modalNotifContent").text("");
                   $("#modalEditPenggunaanBahan").modal("hide");
                   tablePemakaianBahanCetak(param2);
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Data Gagal Diubah");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                   $("#modal-notif").modal("hide");
                   $("#modal-notif").removeClass("modal-danger");
                   $("#modalNotifContent").text("");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
                  $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                   $("#modal-notif").modal("hide");
                   $("#modal-notif").removeClass("modal-warning");
                   $("#modalNotifContent").text("");
                  },2000);
                }
                $("loading").modal("hide");
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
   							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
   							$("#modal-notif").modal("show");
   							setTimeout(function(){
   								$("#modal-notif").modal("hide");
   								$("#modal-notif").removeClass("modal-danger");
   								$("#modalNotifContent").text("");
   							},2000);
                $("loading").modal("hide");
              }
            });
          }
        }

        function editStatusRencanaPpic(param){
          var status = $("#cmbStatusPengerjaan").val();
          if(status==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
             $("#modal-notif").modal("hide");
             $("#modal-notif").removeClass("modal-warning");
             $("#modalNotifContent").text("");
            },2000);
          }else{
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/editStatusRencanaPpic'); ?>",
              dataType : "TEXT",
              data : {
                kdPpic : param,
                stsPengerjaan : status
              },
              success : function(response){
                if($.trim(response) == "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Data Berhasil Diubah");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                   $("#modal-notif").modal("hide");
                   $("#modal-notif").removeClass("modal-info");
                   $("#modalNotifContent").text("");
                   $("#modalEditStatusRencana").modal("hide");
                   $(".active a").trigger("click");
                  },2000);
                }else if($.trim(response) == "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Data Gagal Diubah");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                   $("#modal-notif").modal("hide");
                   $("#modal-notif").removeClass("modal-danger");
                   $("#modalNotifContent").text("");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
                  $("#modalNotifContent").text("Semua Kolom Tidak Boleh Kosong!");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                   $("#modal-notif").modal("hide");
                   $("#modal-notif").removeClass("modal-warning");
                   $("#modalNotifContent").text("");
                  },2000);
                }
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
   							$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
   							$("#modal-notif").modal("show");
   							setTimeout(function(){
   								$("#modal-notif").modal("hide");
   								$("#modal-notif").removeClass("modal-danger");
   								$("#modalNotifContent").text("");
   							},2000);
              }
            });
          }
        }
//================================ EDIT METHOD (FINISH) ============================//

//================================ REMOVE METHOD (START) ============================//
        function deleteAndRestoreRencanaMandorPending(param, param2){
          if(param2 == "TRUE"){
            var confirmText = "Apakah Anda Yakin Ingin Menghapus Data Ini?";
            var successText = "Data Berhasil Dihapus";
            var failedText = "Data Gagal Dihapus";
          }else{
            var confirmText = "Apakah Anda Yakin Ingin Mengembalikan Data Ini?";
            var successText = "Data Berhasil Dikembalikan";
            var failedText = "Data Gagal Dikembalikan";
          }

          if(confirm(confirmText)){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/deleteAndRestoreRencanaMandorPending') ?>",
              dataType : "TEXT",
              data : {
                idTransaksi : param,
                deleted : param2
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text(successText);
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    if($("#tableRencanaCetakPending").length == 1){
                      tableRencanaMandorPending();
                    }
                    if($("#tableRencanaSusulanPending").length == 1){
                      tableRencanaMandorSusulanPending();
                    }
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text(failedText);
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },2000);
                }
              },
              error : function(response){
               $("#modal-notif").addClass("modal-danger");
               $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
               $("#modal-notif").modal("show");
               setTimeout(function(){
                 $("#modal-notif").modal("hide");
                 $("#modal-notif").removeClass("modal-danger");
                 $("#modalNotifContent").text("");
               },2000);
              }
            });
          }
        }

        function deleteAndRestoreHasilJobCetak(param, param2){
          if(param2 == "TRUE"){
            var confirmText = "Apakah Anda Yakin Ingin Menghapus Data Ini?";
            var successText = "Data Berhasil Dihapus";
            var failedText = "Data Gagal Dihapus";
          }else{
            var confirmText = "Apakah Anda Yakin Ingin Mengembalikan Data Ini?";
            var successText = "Data Berhasil Dikembalikan";
            var failedText = "Data Gagal Dikembalikan";
          }
          if(confirm(confirmText)){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/deleteAndRestoreHasilJobCetak'); ?>",
              dataType : "TEXT",
              data : {
                idTransaksi : param,
                deleted : param2
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text(successText);
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    if($("#tableHasilCetakPending").length == 1){
                      tableHasilCetakPending();
                    }
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text(failedText);
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
                  $("#modalNotifContent").text("Parameter Tidak Boleh Kosong!");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-warning");
                    $("#modalNotifContent").text("");
                  },2000);
                }
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }
            });
          }
        }

        function deleteAndRestorePengambilanCetak(param, param2){
          if(param2 == "TRUE"){
            var confirmText = "Apakah Anda Yakin Ingin Menghapus Data Ini?";
            var successText = "Data Berhasil Dihapus";
            var failedText = "Data Gagal Dihapus";
          }else{
            var confirmText = "Apakah Anda Yakin Ingin Mengembalikan Data Ini?";
            var successText = "Data Berhasil Dikembalikan";
            var failedText = "Data Gagal Dikembalikan";
          }
          if(confirm(confirmText)){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/deleteAndRestorePengambilanCetak'); ?>",
              dataType : "TEXT",
              data : {
                idTransaksi : param,
                deleted : param2
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text(successText);
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    resetPengambilanCetakExtruder();
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text(failedText);
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
                  $("#modalNotifContent").text("Parameter Tidak Boleh Kosong!");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-warning");
                    $("#modalNotifContent").text("");
                  },2000);
                }
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }
            });
          }
        }

        function deleteAndRestorePenggunaanBahan(param, param2, param3){
          if(param2 == "TRUE"){
            var confirmText = "Apakah Anda Yakin Ingin Menghapus Data Ini?";
            var successText = "Data Berhasil Dihapus";
            var failedText = "Data Gagal Dihapus";
          }else{
            var confirmText = "Apakah Anda Yakin Ingin Mengembalikan Data Ini?";
            var successText = "Data Berhasil Dikembalikan";
            var failedText = "Data Gagal Dikembalikan";
          }

          if(confirm(confirmText)){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_cetak/main/deleteAndRestorePenggunaanBahan'); ?>",
              dataType : "TEXT",
              data : {
                idTransaksi : param,
                deleted : param2
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text(successText);
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    tablePemakaianBahanCetak(param3);
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text(failedText);
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
                  $("#modalNotifContent").text("Parameter Tidak Boleh Kosong!");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-warning");
                    $("#modalNotifContent").text("");
                  },2000);
                }
              },
              error : function(response){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }
            });
          }
        }
//================================ REMOVE METHOD (FINISH) ============================//

//================================ DATATABLE METHOD (START) ============================//
        function datatableRencanaPPIC(param1="", param2=""){
          $("#tableRencanaPPIC").dataTable().fnDestroy();
          $("#tableRencanaPPIC").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : true,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "width" : "100%",
            "height" : "500px",
            "scrollX" : "100%",
            "scrollY" : "500px",
            "sPaginationType" : "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_cetak/main/getRencanaPPIC'); ?>",
            "columns" : [
              {"data":"kd_ppic", "name":"RP.kd_ppic"},
              {"data":"tgl_rencana", "name":"RP.tgl_rencana"},
              {"data":"nm_cust", "name":"RP.nm_cust"},
              {"data":"merek", "name":"RP.merek"},
              {"data":"berat", "name":"RP.berat"},
              {"data":"ukuran", "name":"RP.ukuran"},
              {"data":"warna_plastik", "name":"RP.warna_plastik"},
              {"data":"warna_cat", "name":"RP.warna_cat"},
              {"data":"strip", "name":"RP.strip"},
              {"data":"tebal", "name":"RP.tebal"},
              {"data":"jumlah_permintaan", "name":"RP.jumlah_permintaan"},
              {"data":"sisa", "name":"RP.sisa"},
              {"data":"sts_pengerjaan", "name":"RP.sts_pengerjaan"},
              {"data":"keterangan", "name":"RP.keterangan"},
              {"data":"kd_ppic", "name":"RP.kd_ppic"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              AvData.push({"name":"bulan","value":param1},
              {"name":"tahun","value":param2});
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
              $("td:eq(0)", AvRow).text(++AvDisplayIndex);
              $("td:eq(10)",AvRow).text(AvData["jumlah_permintaan"]+" "+AvData["satuan"]);
              if(AvData["satuan_kilo"]==null || AvData["satuan_kilo"]==""){
                $("td:eq(11)",AvRow).text(AvData["sisa"]+" "+AvData["satuan"]);
              }else{
                $("td:eq(11)",AvRow).text(AvData["sisa"]+" KG");
              }
              $("td:eq(12)",AvRow).html(AvData["sts_pengerjaan"]+" <label class='text-red'>("+AvData["prioritas"]+")</label>");
              if(AvData["satuan_kilo"] != null){
                if(AvData["sts_pengerjaan"] == "PENDING"){
                  $("td:eq(14)", AvRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalBuatRencanaCetak('"+AvData["kd_ppic"]+"');>Buat Rencana Kerja</button>"+
                  "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditStatusPpic('"+AvData["kd_ppic"]+"');>Edit Status</button>");
                }else{
                  $("td:eq(14)", AvRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalBuatRencanaCetak('"+AvData["kd_ppic"]+"');>Buat Rencana Kerja</button>"+
                  "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditStatusPpic('"+AvData["kd_ppic"]+"');>Edit Status</button>");
                  $("td:eq(12)",AvRow).text("").css("background-color","#dd4b39");
                }
              }else{
                $("td:eq(14)", AvRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalKonversi('"+AvData["kd_ppic"]+"');>Konversi Ke KG</button>");
              }
            }
          });
        }

        function tableRencanaMandorPending(){
          $.ajax({
            url : "<?php echo base_url('_cetak/main/getRencanaPPICPending'); ?>",
            dataType : "JSON",
            success : function(response){
              $("#tableRencanaCetakPending > tbody > tr").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableRencanaCetakPending > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++AvIndex+"</td>"+
                  "<td>"+AvValue.no_mesin+"</td>"+
                  "<td>"+AvValue.merek+"</td>"+
                  "<td>"+AvValue.ukuran+"</td>"+
                  "<td>"+AvValue.warna_plastik+"</td>"+
                  "<td>"+AvValue.tebal+"</td>"+
                  "<td>"+AvValue.jml_permintaan+"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditRencanaCetak('"+AvValue.kd_cetak+"','"+AvValue.kd_ppic+"')>Ubah</button>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRencanaMandorPending('"+AvValue.kd_cetak+"','TRUE')>Hapus</button>"+
                  "</td>"+
                "</tr>"
                );
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }
          });
        }

        function datatablesListRencanaMandor(){
          $("#tableRencanaMandor").dataTable().fnDestroy();
          $("#tableRencanaMandor").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : true,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "width" : "100%",
            "height" : "500px",
            "scrollX" : "100%",
            "scrollY" : "500px",
            "sPaginationType" : "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_cetak/main/getListRencanaMandor'); ?>",
            "columns" : [
            {"data":"kd_cetak", "name":"RC.kd_cetak"},
            {"data":"tgl_rencana", "name":"RC.tgl_rencana"},
            {"data":"no_mesin", "name":"RC.no_mesin"},
            {"data":"customer", "name":"RC.customer"},
            {"data":"merek", "name":"RC.merek"},
            {"data":"ukuran", "name":"RC.ukuran"},
            {"data":"warna_plastik", "name":"RC.warna_plastik"},
            {"data":"warna_cat", "name":"RC.warna_cat"},
            {"data":"tebal", "name":"RC.tebal"},
            {"data":"stok_permintaan", "name":"RC.stok_permintaan"},
            {"data":"jml_permintaan", "name":"RC.jml_permintaan"},
            {"data":"sts_pengerjaan", "name":"RC.sts_pengerjaan"},
            {"data":"keterangan", "name":"RP.keterangan"},
            {"data":"kd_cetak", "name":"RC.kd_cetak"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              // AvData.push({"name":"bulan","value":param1},
              //             {"name":"tahun","value":param2});
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
              $("td:eq(0)",AvRow).text(++AvDisplayIndex);
              if(AvData["sts_pengerjaan_ppic"] == "PROGRESS" && AvData["sts_pengerjaan"] == "PENDING"){
                $("td:eq(13)",AvRow).html("<button class='btn btn-md btn-flat btn-warning' data-toggle='modal' data-target='#modalEditStatusRencana' data-backdrop='static' onclick=modalEditStatusRencana('"+AvData["kd_cetak"]+"','"+AvData["sts_pengerjaan"]+"')>Edit Status</button>");
              }else{
                $("td:eq(13)",AvRow).html("<button class='btn btn-md btn-flat btn-warning' data-toggle='modal' data-target='#modalEditStatusRencana' data-backdrop='static' onclick=modalEditStatusRencana('"+AvData["kd_cetak"]+"','"+AvData["sts_pengerjaan"]+"')>Edit Status</button>"+
                                          "<button class='btn btn-md btn-flat btn-success' data-toggle='modal' data-target='#modalInputHasil' data-backdrop='static' onclick=modalInputHasil('"+AvData["kd_cetak"]+"')>Input Hasil</button>"+
                                          "<button class='btn btn-md btn-flat btn-primary' data-toggle='modal' data-target='#modalEditMesin' data-backdrop='static' onclick=modalEditGantiMesin('"+AvData["kd_cetak"]+"','"+AvData["no_mesin"].replace(/ /g,"_")+"')>Ganti Mesin</button>");
              }
            }
          });
        }

        function tableRencanaMandorSusulanPending(){
          $.ajax({
            url : "<?php echo base_url('_cetak/main/getRencanaSusulanPending'); ?>",
            dataType : "JSON",
            success : function(response){
              $("#tableRencanaSusulanPending > tbody > tr").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableRencanaSusulanPending > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++AvIndex+"</td>"+
                  "<td>"+AvValue.no_mesin+"</td>"+
                  "<td>"+AvValue.customer+"</td>"+
                  "<td>"+AvValue.ukuran+"</td>"+
                  "<td>"+AvValue.merek+"</td>"+
                  "<td>"+AvValue.warna_plastik+"</td>"+
                  "<td>"+AvValue.warna_cat+"</td>"+
                  "<td>"+AvValue.tebal+"</td>"+
                  "<td>"+AvValue.jml_permintaan+"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditRencanaSusulanCetak('"+AvValue.kd_cetak+"')>Ubah</button>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRencanaMandorPending('"+AvValue.kd_cetak+"','TRUE')>Hapus</button>"+
                  "</td>"+
                "</tr>"
                );
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }
          });
        }

        function tableHasilCetakPending(){
          $.ajax({
            url : "<?php echo base_url('_cetak/main/getHasilJobCetakPending') ?>",
            dataType : "JSON",
            success : function(response){
              $("#tableHasilCetakPending > tbody > tr").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableHasilCetakPending > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++AvIndex+"</td>"+
                  "<td>"+AvValue.customer+"</td>"+
                  "<td>"+AvValue.merek+"</td>"+
                  "<td>"+AvValue.ukuran+"</td>"+
                  "<td>"+AvValue.warna_plastik+"</td>"+
                  "<td>"+AvValue.jumlah_berat_pengambilan+"</td>"+
                  "<td>"+AvValue.jumlah_payung_pengambilan+"</td>"+
                  "<td>"+AvValue.jumlah_payung_kuning_pengambilan+"</td>"+
                  "<td>"+AvValue.jumlah_bobin_pengambilan+"</td>"+
                  "<td>"+AvValue.jumlah_sisa_pengambilan+"</td>"+
                  "<td>"+AvValue.jumlah_selesai+"</td>"+
                  "<td>"+AvValue.payung+"</td>"+
                  "<td>"+AvValue.payung_kuning+"</td>"+
                  "<td>"+AvValue.bobin+"</td>"+
                  "<td>"+AvValue.berat_roll+"</td>"+
                  "<td>"+AvValue.jumlah_apal+"</td>"+
                  "<td>"+AvValue.plusminus+"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreHasilJobCetak('"+AvValue.kd_hasil_cetak+"','TRUE')>Hapus</button>"+
                    "<button class='btn btn-md btn-flat btn-info' onclick=modalDetailJob('"+AvValue.kd_hasil_cetak+"')>Detail Job</button>"+
                  "</td>"+
                "</tr>"
                );
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }
          });
        }

        function tablePemakaianBahanCetak(param){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getListPemakaianBahanCetakId'); ?>",
            dataType : "JSON",
            data : {
              idTransaksi : param
            },
            success : function(response){
              $("#tablePemakaianBahanCetak > tbody > tr").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tablePemakaianBahanCetak > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+(AvValue.jenis == "CAT CAMPUR" ? AvValue.warna : AvValue.nm_barang)+"</td>"+
                    "<td>"+AvValue.jumlah_pengambilan+"</td>"+
                    "<td>"+AvValue.sisa_pengambilan+"</td>"+
                    "<td>"+
                      "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditPenggunaanBahan('"+AvValue.id_penggunaan_cetak+"','"+param+"')>Ubah</button>"+
                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestorePenggunaanBahan('"+AvValue.id_penggunaan_cetak+"','TRUE','"+param+"')>Hapus</button>"+
                    "</td>"+
                  "</tr>"
                );
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }
          });
        }

        function datatableHasilCetak(param1, param2){
          $("#tableHasilCetak").dataTable().fnDestroy();
          $("#tableHasilCetak").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "width" : "100%",
            "height" : "500px",
            "scrollX" : "100%",
            "scrollX" : "500px",
            "sPaginationType" : "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_cetak/main/getListHasilCetak'); ?>",
            "columns" : [
              {"data":"kd_hasil_cetak", "name":"THC.kd_hasil_cetak"},
              {"data":"tgl_transaksi", "name":"THC.tgl_transaksi"},
              {"data":"customer", "name":"RC.customer"},
              {"data":"merek", "name":"RC.merek"},
              {"data":"ukuran", "name":"RC.ukuran"},
              {"data":"warna_plastik", "name":"RC.warna_plastik"},
              {"data":"warna_cat", "name":"RC.warna_cat"},
              {"data":"jumlah_berat_pengambilan", "name":"TDHC.jumlah_berat_pengambilan"},
              {"data":"jumlah_bobin_pengambilan", "name":"TDHC.jumlah_bobin_pengambilan"},
              {"data":"jumlah_payung_pengambilan", "name":"TDHC.jumlah_payung_pengambilan"},
              {"data":"jumlah_payung_kuning_pengambilan", "name":"TDHC.jumlah_payung_kuning_pengambilan"},
              {"data":"jumlah_hasil_selesai", "name":"TDHC.jumlah_hasil_selesai"},
              {"data":"jumlah_hasil_bobin", "name":"TDHC.jumlah_hasil_bobin"},
              {"data":"jumlah_hasil_payung", "name":"TDHC.jumlah_hasil_payung"},
              {"data":"jumlah_hasil_payung_kuning", "name":"TDHC.jumlah_hasil_payung_kuning"},
              {"data":"berat_roll", "name":"THC.berat_roll"},
              {"data":"jumlah_apal", "name":"TDHC.jumlah_apal"},
              {"data":"plusminus", "name":"THC.plusminus"},
              {"data":"kd_hasil_cetak", "name":"THC.kd_hasil_cetak"},
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              AvData.push({"name":"tglAwal","value":param1},
              {"name":"tglAkhir","value":param2});
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
              $("td:eq(0)", AvRow).text(++AvDisplayIndex);
              var plusminus = parseFloat(AvData["plusminus"]);
              $("td:eq(17)", AvRow).text(plusminus.toFixed(2));
              $("td:eq(18)", AvRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalDetailJob('"+AvData["kd_hasil_cetak"]+"')>Detail Job</button>"+
                                         "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditDetailJobCetak('"+AvData["kd_hasil_cetak"]+"')>Edit Job</button>"+
                                         "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreHasilJobCetak('"+AvData["kd_hasil_cetak"]+"','TRUE')>Hapus Job</button>");
            }
          });
        }

        function tableDataBonApal(param, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getListBonApal'); ?>",
            dataType : "JSON",
            data : {
              tglAwal   : param,
              tglAkhir  : param2
            },
            success : function(response){
              var total = 0;
              $("#tableDataBonApal > tbody > tr").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableDataBonApal > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.tgl_transaksi+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+AvValue.jumlah_apal+"</td>"+
                    "<td>"+AvValue.customer+"</td>"+
                  "</tr>"
                );
                total += parseFloat(AvValue.jumlah_apal);
              });
              $("#lblTotal").text("Total : " + total.toFixed(2));
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }
          });
        }

        function tableDataHasilCetak(param, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getListDataBonHasil') ?>",
            dataType : "JSON",
            data : {
              tglAwal : param,
              tglAkhir : param2,
            },
            success : function(response){
              $("#tableDataHasilCetak > tbody > tr").empty();
              $.each(response, function(AvIndex, AvValue){
                var statusBon = (AvValue.status_bon=="FALSE" ? "<label class='text-red'>BELUM DIKIRIM</label>" : "<label class='text-green'>SUDAH DIKIRIM</label>");
                $("#tableDataHasilCetak > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+AvValue.jumlah_selesai+"</td>"+
                    "<td>"+AvValue.bobin+"</td>"+
                    "<td>"+AvValue.payung+"</td>"+
                    "<td>"+AvValue.payung_kuning+"</td>"+
                    "<td>"+AvValue.jns_brg+"</td>"+
                    "<td>"+AvValue.nama_operator+"</td>"+
                    "<td>"+statusBon+"</td>"+
                  "</tr>"
                );
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }
          });
        }

        function tableListPenggunaanBahan(param, param2, param3){
          var counter = 0;
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getListPenggunaanBahan'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param,
              tglAkhir : param2,
              jenis : param3
            },
            success : function(response){
              $("#tableDataBonPengambilanBahan > tbody > tr").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableDataBonPengambilanBahan > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.merek+" <label>("+AvValue.kd_gd_cetak+")</label>"+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+(AvValue.jenis=="CAT CAMPUR" ? AvValue.warna+" <label>("+AvValue.kd_gd_bahan+")</label>" : AvValue.nm_barang+" <label>("+AvValue.kd_gd_bahan+")</label>")+"</td>"+
                    "<td>"+AvValue.jumlah_pengambilan+"</td>"+
                    "<td>"+(AvValue.status_bon=="FALSE" ? "<label class='text-red'>BELUM DIKIRIM</label>" : "<label class='text-success'>SUDAH DIKIRIM</label>")+"</td>"+
                  "</tr>"
                );
                (AvValue.status_bon=="FALSE" ? "" : counter++);
              });
              if(counter == response.length){
                $("#btnKirim").attr("disabled","disabled");
              }
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }
          });
        }

        function tableListPengembalianCatCampur(param, param2){
          var counter = 0;
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getListPengembalianCatCampur'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param,
              tglAkhir : param2
            },
            success : function(response){
              $("#tableDataBonPengembalianCatCampur > tbody > tr").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableDataBonPengembalianCatCampur > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.merek+" <label>("+AvValue.kd_gd_cetak+")</label>"+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+(AvValue.jenis=="CAT CAMPUR" ? AvValue.warna+" <label>("+AvValue.kd_gd_bahan+")</label>" : AvValue.nm_barang+" <label>("+AvValue.kd_gd_bahan+")</label>")+"</td>"+
                    "<td>"+AvValue.sisa_pengambilan+"</td>"+
                    "<td>"+(AvValue.status_bon_sisa=="FALSE" ? "<label class='text-red'>BELUM DIKIRIM</label>" : "<label class='text-success'>SUDAH DIKIRIM</label>")+"</td>"+
                  "</tr>"
                );
                (AvValue.status_bon_sisa=="FALSE" ? "" : counter++);
              });
              if(counter == response.length){
                //$("#btnKirim").attr("disabled","disabled");
              }
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }
          });
        }

        function datatableListBarangDiambilPotong(){
          $("#tableDataBarangDiambilPotong").dataTable().fnDestroy();
          $("#tableDataBarangDiambilPotong").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : true,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "width" : "100%",
            "height" : "500px",
            "scrollX" : "100%",
            "scrollX" : "500px",
            "sPaginationType" : "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_cetak/main/getListBarangDiambilPotong'); ?>",
            "columns" : [
              {"data":"id", "name":"TGR.id"},
              {"data":"tgl_transaksi", "name":"TGR.tgl_transaksi"},
              {"data":"ukuran", "name":"GR.ukuran"},
              {"data":"merek", "name":"GR.merek"},
              {"data":"warna_plastik", "name":"GR.warna_plastik"},
              {"data":"berat", "name":"TGR.berat"},
              {"data":"bobin", "name":"TGR.bobin"},
              {"data":"payung", "name":"TGR.payung"},
              {"data":"payung_kuning", "name":"TGR.payung_kuning"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              // AvData.push({"name":"tglAwal","value":param1},
                          // {"name":"tglAkhir","value":param2});
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
              $("td:eq(0)", AvRow).text(++AvDisplayIndex);
            }
          });
        }

        function tablePengambilanCetakExtruder(){
          $("#tableDataPengambilanExtruder").dataTable().fnDestroy();
          $("#tableDataPengambilanExtruder").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : true,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "width" : "100%",
            "height" : "500px",
            "scrollX" : "100%",
            "scrollX" : "500px",
            "sPaginationType" : "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_cetak/main/getListPengambilanExtruder'); ?>",
            "columns" : [
              {"data":"id", "name":"TDPC.id"},
              {"data":"tgl_rencana", "name":"TDPC.tgl_rencana"},
              {"data":"ukuran", "name":"RC.ukuran"},
              {"data":"merek", "name":"RC.merek"},
              {"data":"warna_plastik", "name":"RC.warna_plastik"},
              {"data":"tebal", "name":"TDPC.tebal"},
              {"data":"berat", "name":"TDPC.berat"},
              {"data":"bobin", "name":"TDPC.bobin"},
              {"data":"payung", "name":"TDPC.payung"},
              {"data":"payung_kuning", "name":"TDPC.payung_kuning"},
              {"data":"shift", "name":"TDPC.shift"},
              {"data":"id", "name":"TDPC.id"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              // AvData.push({"name":"tglAwal","value":param1},
                          // {"name":"tglAkhir","value":param2});
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
              $("td:eq(0)", AvRow).text(++AvDisplayIndex);
              if(AvData["sts_transaksi"] == "FINISH"){
                $("td:eq(11)", AvRow).html("<button class='btn btn-md btn-flat btn-default'> <i class='fa fa-lock'></i> Data Sudah Di Approve</button>");
              }else{
                $("td:eq(11)", AvRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditPengambilanCetakExtruder('"+AvData["id"]+"')>Ubah</button>"+
                                           "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestorePengambilanCetak('"+AvData["id"]+"','TRUE')>Hapus</button>");

              }
            }
          });
        }

        function tableListDataPengambilanGudang(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_cetak/main/getPengambilanGudangRoll'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2
            },
            success : function(response){
              $("#tableDataBonPengambilanBahan > tbody > tr").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableDataBonPengambilanBahan > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.merek+" ("+AvValue.kd_gd_roll_polos+")"+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+AvValue.jumlah_berat_pengambilan+"</td>"+
                    "<td>"+AvValue.jumlah_bobin_pengambilan+"</td>"+
                    "<td>"+AvValue.jumlah_payung_pengambilan+"</td>"+
                    "<td>"+AvValue.jumlah_payung_kuning_pengambilan+"</td>"+
                  "</tr>"
                );
              });
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }
          });
        }
//================================ DATATABLE METHOD (FINISH) ============================//

//================================ UNSPECIFIED METHOD (START) ============================//
        function hitungRollPipa(){
          var jenisPipa = $("#cmbJenisRoll").val();
          var ukuran = $("#txtUkuran").val().toUpperCase();
          var merek = $("#txtMerek").val().toUpperCase();
          if(jenisPipa == "PAYUNG"){
						var arrUkuran = ukuran.split("x");
						var panjang = arrUkuran[0].replace(/,/gi,".");
						var arrPanjangPlastik = panjang.replace(/PON/gi,"").split("+");
						if(ukuran.indexOf("PON") != -1 || merek.indexOf("PON") != -1){
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
								 					if(arrPanjangPlastik[1] > 1){
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
													}
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[1] > 1){
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;

							}
						}else{
              if(ukuran.indexOf("IN") != -1){
                switch (arrPanjangPlastik.length) {
                  case 2 : var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]);
                  break;
                  case 3 : var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
                  break;
                  default: var TPanjangPlastik = (parseFloat(arrPanjangPlastik)*2.54); break;

                }
              }else{
                switch (arrPanjangPlastik.length) {
                  case 2 : var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]);
                  break;
                  case 3 : var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
                  break;
                  default: var TPanjangPlastik = parseFloat(arrPanjangPlastik); break;
                }
              }
						}
						if(TPanjangPlastik < 6){
              var jumlahPayung = $("#txtSisaPayung").val().replace(/,/g,"");
							var rollPipa = (parseFloat(jumlahPayung)*5000)/1000;
              $("#txtRollPipa").val(rollPipa);
						}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
              var jumlahPayung = $("#txtSisaPayung").val().replace(/,/g,"");
							var rollPipa = (parseFloat(jumlahPayung)*6000)/1000;
              $("#txtRollPipa").val(rollPipa);
						}else{
              var jumlahPayung = $("#txtSisaPayung").val().replace(/,/g,"");
							var rollPipa = (parseFloat(jumlahPayung)*7000)/1000;
              $("#txtRollPipa").val(rollPipa);
						}
          }else if(jenisPipa == "PAYUNG_KUNING"){
            var arrUkuran = ukuran.split("x");
						var panjang = arrUkuran[0].replace(",",".");
						var arrPanjangPlastik = panjang.replace(/PON/gi,"").split("+");
						if(ukuran.indexOf("PON") != -1 || merek.indexOf("PON") != -1){
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
								 					if(arrPanjangPlastik[1] > 1){
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
													}
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[1] > 1){
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;

							}
						}else{
              if(ukuran.indexOf("IN") != -1){
                switch (arrPanjangPlastik.length) {
                  case 2 : var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]);
                  break;
                  case 3 : var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
                  break;
                  default: var TPanjangPlastik = (parseFloat(arrPanjangPlastik)*2.54); break;
                }
              }else{
                switch (arrPanjangPlastik.length) {
                  case 2 : var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]);
                  break;
                  case 3 : var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
                  break;
                  default: var TPanjangPlastik = parseFloat(arrPanjangPlastik); break;
                }
              }
						}
						if(TPanjangPlastik <= 30){
              var jumlahPayung = $("#txtSisaPayungKuning").val().replace(/,/g,"");
							var rollPipa = (parseFloat(jumlahPayung)*4000)/1000;
              $("#txtRollPipa").val(rollPipa);
						}else{
              var jumlahPayung = $("#txtSisaPayungKuning").val().replace(/,/g,"");
							var rollPipa = (parseFloat(jumlahPayung)*5000)/1000;
              $("#txtRollPipa").val(rollPipa);
						}
          }else if(jenisPipa == "BOBIN"){
            var arrUkuran = ukuran.split("x");
						var panjang = arrUkuran[0].replace(",",".");
						var arrPanjangPlastik = panjang.replace(/PON/gi,"").split("+");
            var doubleSingle = $("#txtDoubleSingle").val().replace(/,/g,"");
            var jumlahBobin = $("#txtBobin").val().replace(/,/g,"");
						if(ukuran.indexOf("PON") != -1 || merek.indexOf("PON") != -1){
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
								 					if(arrPanjangPlastik[1] > 1){
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
													}
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[1] > 1){
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;

							}
						}else{
              if(ukuran.indexOf("IN") != -1){
                switch (arrPanjangPlastik.length) {
                  case 2 : var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]);
                  break;
                  case 3 : var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
                  break;
                  default: var TPanjangPlastik = (parseFloat(arrPanjangPlastik)*2.54); break;
                }
              }else{
                switch (arrPanjangPlastik.length) {
                  case 2 : var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]);
                  break;
                  case 3 : var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
                  break;
                  default: var TPanjangPlastik = parseFloat(arrPanjangPlastik); break;
                }
              }
						}
            var rollPipa = (TPanjangPlastik * parseFloat(doubleSingle) * 30 * parseFloat(jumlahBobin))/1000;
            $("#txtRollPipa").val(rollPipa);
          }else if(jenisPipa == "PAYUNG_KUNING_PAYUNG"){
            var arrUkuran = ukuran.split("x");
						var panjang = arrUkuran[0].replace(",",".");
						var arrPanjangPlastik = panjang.replace(/PON/gi,"").split("+");
						if(ukuran.indexOf("PON") != -1 || merek.indexOf("PON") != -1){
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
								 					if(arrPanjangPlastik[1] > 1){
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
													}
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[1] > 1){
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;

							}
						}else{
              if(ukuran.indexOf("IN") != -1){
                switch (arrPanjangPlastik.length) {
                  case 2 : var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]);
                  break;
                  case 3 : var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
                  break;
                  default: var TPanjangPlastik = (parseFloat(arrPanjangPlastik)*2.54); break;
                }
              }else{
                switch (arrPanjangPlastik.length) {
                  case 2 : var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]);
                  break;
                  case 3 : var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
                  break;
                  default: var TPanjangPlastik = parseFloat(arrPanjangPlastik); break;
                }
              }
						}
            if(TPanjangPlastik <= 30){
              var multiplier = 4000;
            }else{
              var multiplier = 5000;
            }

            if(TPanjangPlastik < 6){
              var jumlahPayung = $("#txtPayung_PKP").val().replace(/,/g,"");
              var jumlahPayungKuning = $("#txtPayungKuning_PKP").val().replace(/,/g,"");
							var rollPipa = ((parseFloat(jumlahPayung)*5000)/1000) + ((parseFloat(jumlahPayungKuning)*multiplier)/1000);
              $("#txtRollPipa").val(rollPipa);
						}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
              var jumlahPayung = $("#txtPayung_PKP").val().replace(/,/g,"");
              var jumlahPayungKuning = $("#txtPayungKuning_PKP").val().replace(/,/g,"");
							var rollPipa = ((parseFloat(jumlahPayung)*6000)/1000) + ((parseFloat(jumlahPayungKuning)*multiplier)/1000);
              $("#txtRollPipa").val(rollPipa);
						}else{
              var jumlahPayung = $("#txtPayung_PKP").val().replace(/,/g,"");
              var jumlahPayungKuning = $("#txtPayungKuning_PKP").val().replace(/,/g,"");
							var rollPipa = ((parseFloat(jumlahPayung)*7000)/1000) + ((parseFloat(jumlahPayungKuning)*multiplier)/1000);
              $("#txtRollPipa").val(rollPipa);
						}
          }else if(jenisPipa == "PAYUNG_BOBIN"){
            var arrUkuran = ukuran.split("x");
						var panjang = arrUkuran[0].replace(",",".");
						var arrPanjangPlastik = panjang.replace(/PON/gi,"").split("+");
            var doubleSingle = $("#txtDoubleSingle_PB").val().replace(/,/g,"");
            var jumlahBobin = $("#txtBobin_PB").val().replace(/,/g,"");
            var jumlahPayung = $("#txtPayung_PB").val().replace(/,/g,"");
						if(ukuran.indexOf("PON") != -1 || merek.indexOf("PON") != -1){
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
								 					if(arrPanjangPlastik[1] > 1){
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
													}
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[1] > 1){
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;

							}
						}else{
              if(ukuran.indexOf("IN") != -1){
                switch (arrPanjangPlastik.length) {
                  case 2 : var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]);
                  break;
                  case 3 : var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
                  break;
                  default: var TPanjangPlastik = (parseFloat(arrPanjangPlastik)*2.54); break;
                }
              }else{
                switch (arrPanjangPlastik.length) {
                  case 2 : var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]);
                  break;
                  case 3 : var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
                  break;
                  default: var TPanjangPlastik = parseFloat(arrPanjangPlastik); break;
                }
              }
						}
            if(TPanjangPlastik < 6){
							var rollPipa = ((parseFloat(jumlahPayung)*5000)/1000) + ((TPanjangPlastik * parseFloat(doubleSingle) * 30 * parseFloat(jumlahBobin))/1000);
              $("#txtRollPipa").val(rollPipa);
						}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
							var rollPipa = ((parseFloat(jumlahPayung)*6000)/1000) + ((TPanjangPlastik * parseFloat(doubleSingle) * 30 * parseFloat(jumlahBobin))/1000);
              $("#txtRollPipa").val(rollPipa);
						}else{
							var rollPipa = ((parseFloat(jumlahPayung)*7000)/1000) + ((TPanjangPlastik * parseFloat(doubleSingle) * 30 * parseFloat(jumlahBobin))/1000);
              $("#txtRollPipa").val(rollPipa);
						}
          }else{
            $("#txtRollPipa").val("0");
          }
          hitungPlusMinus();
        }

        function hitungPlusMinus(){
          var beratRoll = parseFloat($("#txtRollPipa").val().replace(/,/g,""));
          var beratPayungTerbuang = parseFloat($("#txtJumlahBeratPayungTerbuang").val().replace(/,/g,""));
          var beratPayungKuningTerbuang = parseFloat($("#txtJumlahBeratPayungKuningTerbuang").val().replace(/,/g,""));
          var beratBobinTerbuang = parseFloat($("#txtJumlahBeratBobinTerbuang").val().replace(/,/g,""));
          var hasilBerat = parseFloat($("#txtJumlahBeratHasilCetak").val().replace(/,/g,""));
          var beratApal = parseFloat($("#txtJumlahApal").val().replace(/,/g,""));
          var beratPengambilan = parseFloat($("#txtJumlahBeratBahan").val().replace(/,/g,""));
          var beratSisaPengambilan = parseFloat($("#txtJumlahSisaBeratBahan").val().replace(/,/g,""));
          var beratPengambilanExtruder = parseFloat($("#txtBeratPengambilanExtruder").val().replace(/,/g,""));

          if(beratPayungTerbuang > 0){
            var plusMinus = ((hasilBerat + beratRoll + beratApal + (beratSisaPengambilan + beratPengambilanExtruder)) - beratPayungTerbuang) - (beratPengambilan + beratPengambilanExtruder);
          }else if(beratPayungKuningTerbuang > 0){
            var plusMinus = ((hasilBerat + beratRoll + beratApal + (beratSisaPengambilan + beratPengambilanExtruder)) - beratPayungKuningTerbuang) - (beratPengambilan + beratPengambilanExtruder);
          }else if(beratBobinTerbuang > 0){
            var plusMinus = ((hasilBerat + beratRoll + beratApal + (beratSisaPengambilan + beratPengambilanExtruder)) - beratBobinTerbuang) - (beratPengambilan + beratPengambilanExtruder);
          }else{
            var plusMinus = (hasilBerat + beratRoll + beratApal + (beratSisaPengambilan)) - ((beratPengambilan + beratPengambilanExtruder));
          }
          $("#txtPlusminus").val(plusMinus);
        }

        function numberMasking(){
          $(".number").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 3,autoGroup: true});
  				$(".numberFive").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 5,autoGroup: true});
        }
//================================ UNSPECIFIED METHOD (FINISH) ============================//

      </script>
<!--===============================================General Function (Finish) ===============================================-->
    </body>
</html>
