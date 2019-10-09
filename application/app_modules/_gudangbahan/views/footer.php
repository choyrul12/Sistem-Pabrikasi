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
          // setInterval(function(){
          //   alertPermintaanCatSablon();
          //   alertPermintaanMinyakSablon();
          // },10000);
          // alertPermintaanCatSablon();
          // alertPermintaanMinyakSablon();
          reloadTrash();
          datatableListBahanBaku();
          datatableListBijiWarna();
          datatableListMinyak();
          datatableListCatCampur();
          datatableListCatMurni();
          datatableListApal();
          datatableListSparePart();
          // alert($("#alertPermintaanCatSablon").length)
          if($("#alertApproveBahanBakuExtruder").length){
            reloadAlert("EXTRUDER","BAHAN BAKU","#alertApproveBahanBakuExtruder");
            if($("#alertApprovePembelian").length){
              reloadAlertPembelian("BAHAN BAKU","#alertApprovePembelian");
            }
          }else if($("#alertApproveBijiWarnaExtruder").length){
            reloadAlert("EXTRUDER","BIJI WARNA","#alertApproveBijiWarnaExtruder");
            if($("#alertApprovePembelian").length){
              reloadAlertPembelian("BIJI WARNA","#alertApprovePembelian");
            }
          }else if($("#alertApproveMinyak").length){
            reloadAlert("CETAK|SABLON","MINYAK","#alertApproveMinyak");
            if($("#alertApprovePembelian").length){
              reloadAlertPembelian("MINYAK","#alertApprovePembelian");
            }
            if ($("#alertPermintaanMinyakSablon").length){
            alertPermintaanMinyakSablon();}
          }else if($("#alertApproveCatCampur").length){
            reloadAlert("CETAK","CAT CAMPUR","#alertApproveCatCampur");
            if($("#alertApprovePembelian").length){
              reloadAlertPembelian("CAT CAMPUR","#alertApprovePembelian");
            }
          }else if($("#alertApproveCatMurni").length){
            reloadAlert("CETAK|SABLON","CAT MURNI","#alertApproveCatMurni");
            if($("#alertApprovePembelian").length){
              reloadAlertPembelian("CAT MURNI","#alertApprovePembelian");
            }
            if ($("#alertPermintaanCatSablon").length){
            alertPermintaanCatSablon();}
          }else{
            if($("#alertApproveApal").length){
              reloadAlertApal("#alertApproveApal");
            }
          }

          if($("#tableDataPermintaan").length > 0){
            datatableDataPermintaan();
          }

          if($("#tableDataPermintaanSparepart").length > 0){
            datatableDataPermintaanSparePart();
          }

          if($("#tableDetailPermintaan").length > 0){
            datatablesDetailPermintaan();
          }

          if($("#tableDetailPermintaanSparePart").length > 0){
            datatablesDetailPermintaanSparePart();
          }

          //
          //======= Run Method Automatically (Finish) =======//
          //======= Inisialisasi Komponen (Start) =======
          $('.date').datepicker({
              language: 'id',
              viewMode: 'years',
              format: 'yyyy-mm-dd',
              autoclose : true,
              todayHighlight : true
          });
          $(".number").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          //======= Inisialisasi Komponen (End) =======
        });//Tutup $(function(){}); yang pertama
      </script>
<!--===============================================General Function (Start) ===============================================-->
      <script>
      //============================================MODAL METHOD (Start)============================================//
      function modalTambahBahanBakuBaru(param){
        switch (param) {
          case "BAHAN_BAKU" : $("#btnSimpanBahanBaru").text("Simpan Bahan Baku Baru").removeClass("btn-warning").addClass("btn-success").removeAttr("onclick").attr("onclick","saveBahanBaku('BAHAN BAKU')");
                              $("#modalTitleTambahBahanBakuBaru").text("Tambah Bahan Baku Baru");
                              break;
          case "BIJI_WARNA" : $("#btnSimpanBahanBaru").text("Simpan Biji Warna Baru").removeClass("btn-warning").addClass("btn-success").removeAttr("onclick").attr("onclick","saveBahanBaku('BIJI WARNA')");
                              $("#modalTitleTambahBahanBakuBaru").text("Tambah Biji Warna Baru");
                              break;
          case "MINYAK"     : $("#btnSimpanBahanBaru").text("Simpan Minyak Baru").removeClass("btn-warning").addClass("btn-success").removeAttr("onclick").attr("onclick","saveBahanBaku('MINYAK')");
                              $("#modalTitleTambahBahanBakuBaru").text("Tambah Minyak Baru");
                              break;
          case "CAT_CAMPUR" : $("#btnSimpanBahanBaru").text("Simpan Cat Campur Baru").removeClass("btn-warning").addClass("btn-success").removeAttr("onclick").attr("onclick","saveBahanBaku('CAT CAMPUR')");
                              $("#modalTitleTambahBahanBakuBaru").text("Tambah Cat Campur Baru");
                              break;
          case "CAT_MURNI"  : $("#btnSimpanBahanBaru").text("Simpan Cat Murni Baru").removeClass("btn-warning").addClass("btn-success").removeAttr("onclick").attr("onclick","saveBahanBaku('CAT MURNI')");
                              $("#modalTitleTambahBahanBakuBaru").text("Tambah Cat Murni Baru");
                              break;
          default: break;

        }
        resetFormTambahBahanBaku();
      }

      function modalTambahBijiWarnaBaru(){
        resetFormTambahBijiWarna();
        $("#btnSimpanBijiWarnaBaru").text("Simpan Biji Warna Baru").removeClass("btn-warning").addClass("btn-success").removeAttr("onclick").attr("onclick","saveBijiWarna()");
        $("#modalTitleTambahBijiWarnaBaru").text("Tambah Biji Warna Baru");
      }

      function modalTambahPembelianBahanBaku(param){
        var placeholder = param.replace("_"," ");

        $.ajax({
          url : "<?php echo base_url('_gudangbahan/main/getGeneratedRequestCode'); ?>",
          dataType : "JSON",
          success : function(response){
            $("#txtKdPermintaan").val(response.Code);
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

        $("#cmbGudangBahan").select2({
          placeholder : "Pilih Bahan ("+placeholder+")",
          dropdownParent: $('#modalTambahPembelianBahanBaru'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueBahan/"+param,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_bahan+" - "+item.nm_barang+" - "+item.warna+" - "+item.status,
                    id:item.kd_gd_bahan
                  }
                })
              };
            }
          }
        });

        $("#cmbGudangBahan").on("select2:select",function(){
          var id = $(this).val();
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailBarangBahan",
            dataType : "JSON",
            data : {kd_gd_bahan:id},
            success : function(response){
              $("#txtNamaBahan").val(response[0].nm_barang);
              $("#txtJumlahPermintaan").removeAttr("readonly");
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
        });

        $("#cmbGudangBahan").on("select2:unselect",function(){
          $("#txtNamaBahan").val("");
          $("#txtJumlahPermintaan").attr("readonly","readonly");
        });
        $("#btnTambahPembelian").attr("onclick","saveCartPembelian('"+placeholder+"');").text("Tambah");
        tableListPembelianBahanBakuTemp(placeholder);
      }

      function modalTambahPembelianSparePart(){
        $.ajax({
          url : "<?php echo base_url('_gudangbahan/main/getGeneratedRequestSparePartCode'); ?>",
          dataType : "JSON",
          success : function(response){
            $("#txtKdPermintaan").val(response.Code);
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

        $("#cmbGudangBahan").select2({
          placeholder : "Pilih Spare Part",
          dropdownParent: $('#modalTambahPembelianBahanBaru'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueSparePart",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_spare_part+" - "+item.nm_spare_part+" - "+item.ukuran,
                    id:item.kd_spare_part
                  }
                })
              };
            }
          }
        });

        $("#cmbGudangBahan").on("select2:select",function(){
          var id = $(this).val();
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailSparePart",
            dataType : "JSON",
            data : {kdSparePart:id},
            success : function(response){
              $("#txtNamaBahan").val(response[0].nm_spare_part);
              $("#txtJumlahPermintaan").removeAttr("readonly");
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
        });

        $("#cmbGudangBahan").on("select2:unselect",function(){
          $("#txtNamaBahan").val("");
          $("#txtJumlahPermintaan").attr("readonly","readonly");
        });
        $("#btnTambahPembelian").attr("onclick","saveCartPembelianSparePart();").text("Tambah");
        tableListPembelianSparePartTemp();
      }

      function modalCheckHistory(param){
        var placeholder = param.replace("_"," ");
        $("#cmbBahan1").select2({
          placeholder : "Pilih Bahan ("+placeholder+")",
          dropdownParent: $('#modalCheckHistory'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueBahan/"+param,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_bahan+" | "+item.nm_barang+" | "+item.warna+" | "+item.status,
                    id:item.kd_gd_bahan
                  }
                })
              };
            }
          }
        });
      }

      function modalKoreksi(param){
        var placeholder = param.replace("_"," ");
        $("#cmbBahan").select2({
          placeholder : "Pilih Bahan ("+placeholder+")",
          dropdownParent: $('#modalKoreksian'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueBahan/"+param,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_bahan+" - "+item.nm_barang+" - "+item.warna+" - "+item.status,
                    id:item.kd_gd_bahan
                  }
                })
              };
            }
          }
        });

        $("#cmbBahan").on("select2:select",function(){
          var id = $(this).val();
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailBarangBahan",
            dataType : "JSON",
            data : {kd_gd_bahan:id},
            success : function(response){
              $('[id="txtNamaBahan"]').val(response[0].nm_barang);
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
        });

        $("#cmbBahan").on("select2:unselect",function(){
          $('[id="txtNamaBahan"]').val("");
        });

        $("#cmbJenisKoreksi").on("change",function(){
          var jenisKoreksi = $(this).val();
          switch (param) {
            case "BAHAN_BAKU" : if(jenisKoreksi == "PLUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI STOK OPNAME'>Stok Opname</option>"+
                                                           "<option value='KOREKSI BAHAN BAKU'>Koreksi Bahan Baku</option>");
                                }else if(jenisKoreksi == "MINUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI KELUAR KE EXTRUDER'>Keluar Ke Extruder</option>"+
                                                           "<option value='KOREKSI STOK OPNAME'>Stok Opname</option>"+
                                                           "<option value='KOREKSI BAHAN BAKU'>Koreksi Bahan Baku</option>"+
                                                           "<option value='PENGIRIMAN KE BREBES'>Pengiriman Ke Brebes</option>");
                                }else{
                                  $("#cmbKeterangan").html("<option value='#'>Pilih Jenis Koreksi Terlebih Dahulu</option>");
                                }
                                break;

            case "BIJI_WARNA" : if(jenisKoreksi == "PLUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>");
                                }else if(jenisKoreksi == "MINUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>"+
                                                           "<option value='PENGIRIMAN KE BREBES'>Pengiriman Ke Brebes</option>");
                                }else{
                                  $("#cmbKeterangan").html("<option value='#'>Pilih Jenis Koreksi Terlebih Dahulu</option>");
                                }
                                break;

            case "MINYAK"     : if(jenisKoreksi == "PLUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>");
                                }else if(jenisKoreksi == "MINUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>");
                                }else{
                                  $("#cmbKeterangan").html("<option value='#'>Pilih Jenis Koreksi Terlebih Dahulu</option>");
                                }
                                break;

            case "CAT_CAMPUR" : if(jenisKoreksi == "PLUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>");
                                }else if(jenisKoreksi == "MINUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>"+
                                                           "<option value='PENGIRIMAN KE BREBES'>Pengiriman Ke Brebes</option>");
                                }else{
                                  $("#cmbKeterangan").html("<option value='#'>Pilih Jenis Koreksi Terlebih Dahulu</option>");
                                }
                                break;

            case "CAT_MURNI" : if(jenisKoreksi == "PLUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>");
                                }else if(jenisKoreksi == "MINUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>"+
                                                           "<option value='PENGIRIMAN KE BREBES'>Pengiriman Ke Brebes</option>");
                                }else{
                                  $("#cmbKeterangan").html("<option value='#'>Pilih Jenis Koreksi Terlebih Dahulu</option>");
                                }
                                break;
            default:

          }

        });
        resetFormKoreksi(param);
        tableListKoreksi(param);
      }

      function modalEditGudangBahan(param){
        $("#modalTambahBahanBaru").modal({
          backdrop : "static"
        });
        $.ajax({
          type : "POST",
          url : "<?php echo base_url() ?>_gudangbahan/main/getDetailBarangBahan",
          dataType : "JSON",
          data : {kd_gd_bahan : param},
          success : function(response){
            $("#txtKdBahan").val(response[0].kd_gd_bahan);
            $("#txtKdAccurate").val(response[0].kd_accurate);
            $("#txtTanggal").val(response[0].tgl_masuk);
            $("#txtWarna").val(response[0].warna);
            $("#txtNamaBahanBaru").val(response[0].nm_barang);
            $("#txtStok").val(response[0].stok).attr("readonly","readonly");
            $("#cmbSatuan").val(response[0].satuan);
            $("#cmbStatus").val(response[0].status);
            $("#btnSimpanBahanBaru").text("Simpan Perubahan").removeClass("btn-success").addClass("btn-warning").removeAttr("onclick").attr("onclick","editBahanBaku()");
            $("#modalTitleTambahBahanBakuBaru").text("Ubah Bahan Baku");
            $("#modalTitleTambahBijiWarnaBaru").text("Ubah Biji Warna");
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

      function modalTrashGudangBahan(){
        datatableListTrashGudangBahan();
        datatableListTrashSparePart();
        datatableListTrashTransaksiGudangBahan();
        datatableListTrashTransaksiGudangApal();
        datatableListTrashTransaksiSparePart();
      }

      function modalEditPembelianBahanTemp(param, param2){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailItemPembelianGudangBahanTemp",
          dataType : "JSON",
          data : {rowId:param},
          success:function(response){
            $("#txtTanggalBeli").val(response.tgl_permintaan);
            $("#txtNamaCustomer").val(response.nama);
            $("#cmbGudangBahan").val(response.kd_gd_bahan).trigger("change");
            $("#txtNamaBahan").val(response.name);
            $("#txtJumlahPermintaan").val(response.jumlah_permintaan).removeAttr("readonly");
            $("#txtKeterangan").val(response.keterangan);
            $("#btnTambahPembelian").attr("onclick","editPembelianGudangBahanTemp('"+response.rowid+"','"+param2+"')").text("Ubah");
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

      function modalEditPembelianSparePartTemp(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailItemPembelianGudangBahanTemp",
          dataType : "JSON",
          data : {rowId:param},
          success:function(response){
            $("#txtTanggalBeli").val(response.tgl_permintaan);
            $("#txtNamaCustomer").val(response.nama);
            $("#cmbGudangBahan").val(response.kd_gd_bahan).trigger("change");
            $("#txtNamaBahan").val(response.name);
            $("#txtJumlahPermintaan").val(response.jumlah_permintaan).removeAttr("readonly");
            $("#txtKeterangan").val(response.keterangan);
            $("#btnTambahPembelian").attr("onclick","editPembelianSparePartTemp('"+response.rowid+"')").text("Ubah");
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

      function modalEditKoreksiTemp(param,param2){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailKoreksi",
          dataType : "JSON",
          data : {id : param},
          success : function(response){
            var jenisKoreksi = response[0].keterangan_history.replace(")","").split("(");
            $("#txtTanggalKoreksi").val(response[0].tgl_permintaan);
            $('[id="cmbBahan"]').val(response[0].kd_gd_bahan).trigger("change");
            $('[id="txtNamaBahan"]').val(response[0].nm_barang);
            $("#txtJumlahKoreksi").val(response[0].jumlah_permintaan);
            $("#cmbJenisKoreksi").val(jenisKoreksi[1]).trigger("change");
            $("#cmbKeterangan").val(jenisKoreksi[0]).trigger("change");
            $("#btnAddKoreksi").attr("onclick","editKoreksiTemp('"+response[0].id+"','"+param2+"')").html("<span class='fa fa-pencil'></span> Ubah");
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

      function modalEditHistory(param,param2,param3,param4,param5){
        $("#modalEditHistory").modal({backdrop:"static"});
        var placeholder = param.replace("_"," ");
        $("#cmbBahanEditHistory").select2({
          placeholder : "Pilih Bahan ("+placeholder+")",
          dropdownParent: $('#modalEditHistory'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueBahan/"+param,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_bahan+" - "+item.nm_barang+" - "+item.warna+" - "+item.status,
                    id:item.kd_gd_bahan
                  }
                })
              };
            }
          }
        });

        $("#cmbBahanEditHistory").on("select2:select",function(){
          var id = $(this).val();
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailBarangBahan",
            dataType : "JSON",
            data : {kd_gd_bahan:id},
            success : function(response){
              $('[id="txtWarna"]').val(response[0].warna);
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
        });

        $("#cmbBahanEditHistory").on("select2:unselect",function(){
          $('[id="txtWarna"]').val("");
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailTransaksiGudangBahan",
          dataType : "JSON",
          data : {id:param2},
          success : function(response){
            $("#txtTanggalHistory").val(response[0].tgl_permintaan);
            $('[id="cmbBahan"]').val(response[0].kd_gd_bahan).trigger("change");
            $('[id="txtWarna"]').val(response[0].warna);
            $("#txtJumlah").val(response[0].jumlah_permintaan);
            $('[id="btnEditHistory"]').attr("onclick","editHistoryGudangBahan('"+param2+"','"+param3+"','"+param4+"','"+param5+"')");
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
            $('[id="btnEditHistory"]').removeAttr("onclick");
          }
        });
      }

      function modalPengeluaran(param){
        var placeholder = param.replace("_"," ");
        $("#cmbBarang1").select2({
          placeholder : "Pilih Bahan ("+placeholder+")",
          dropdownParent: $('#modalPengeluaran'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueBahan/"+param,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_bahan+" - "+item.nm_barang+" - "+item.warna+" - "+item.status,
                    id:item.kd_gd_bahan
                  }
                })
              };
            }
          }
        });

        $("#cmbBarang1").on("select2:select",function(){
          var id = $(this).val();
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailBarangBahan",
            dataType : "JSON",
            data : {kd_gd_bahan:id},
            success : function(response){
              $("#txtNamaBarang").val(response[0].nm_barang);
              $("#txtJumlahPengeluaran").removeAttr("readonly");
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
        });

        $("#cmbBarang1").on("select2:unselect",function(){
          $("#txtNamaBarang").val("");
          $("#txtJumlahPengeluaran").attr("readonly","readonly");
        });
        tablePengeluaranGudangBahan(param);
      }

      function modalEditPengeluaranTemp(param,param2){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailPengeluaran",
          dataType : "JSON",
          data : {id:param},
          success : function(response){
            $("#txtTanggalPengeluaran").val(response[0].tgl_permintaan);
            $("#cmbBarang").val(response[0].kd_gd_bahan).trigger("change");
            $("#txtNamaBarang").val(response[0].nm_barang);
            $("#txtJumlahPengeluaran").val(response[0].jumlah_permintaan).removeAttr("readonly");
            $("#keterangan").val(response[0].keterangan_history);
            $("#btnAddPengeluaran").removeAttr("onclick").attr("onclick","editPengeluaran('"+param+"','"+param2+"')").html("<i class='fa fa-pencil'></i> Ubah");
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

      function modalTambahApalBaru(){
        resetFormTambahApal();
        var warna = ['MERAH','BIRU','KUNING','HIJAU','COKLAT','ORANGE','PUTIH','PUTIHSUSU','UNGU','SILVER','HITAM'];
        $("#cmbJenisApal").on("change",function(e){
          if(this.value != ""){
            switch (this.value) {
              case "CETAK": $("#cmbSubJenis").empty();
                            $("#subJenis").addClass("has-warning");
                            for (var i = 0; i < warna.length; i++) {
                              $("#cmbSubJenis").append("<option value='"+warna[i]+" CETAK'>"+warna[i]+" CETAK</option>");
                            } break;
              case "POLOS": $("#cmbSubJenis").empty();
                            $("#subJenis").addClass("has-warning");
                            for (var i = 0; i < warna.length; i++) {
                              $("#cmbSubJenis").append("<option value='"+warna[i]+" POLOS'>"+warna[i]+" POLOS</option>");
                            } break;
              default: $("#cmbSubJenis").empty().html("<option value=''>--Pilih Jenis Apal Telebih Dahulu--</option>");
                       $("#subJenis").removeClass("has-warning");
                       break;
            }
          }else{
            $("#cmbSubJenis").empty().html("<option value=''>--Pilih Jenis Apal Telebih Dahulu--</option>");
            $("#subJenis").removeClass("has-warning");
          }
        });
      }

      function modalEditApal(param){
        resetFormTambahApal();
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailGudangApal",
          dataType : "JSON",
          data : {kdGdApal:param},
          success : function(response){
            $("#txtKdApal").val(response[0].kd_gd_apal);
            $("#txtKdAccurate").val(response[0].kd_accurate);
            $("#cmbJenisApal").val(response[0].jenis).trigger("change");
            $("#cmbSubJenis").val(response[0].sub_jenis);
            $("#txtStok").val(response[0].stok);
            $("#txtTanggal").val(response[0].tanggal);
            $("#btnSimpanApalBaru").removeAttr("onclick").attr("onclick","editApal()").removeClass("btn-success").addClass("btn-warning").text("Ubah Apal");
            $("#modalTambahApalBaru").modal({backdrop:"static"});
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

        var warna = ['MERAH','BIRU','KUNING','HIJAU','COKLAT','ORANGE','PUTIH','PUTIHSUSU','UNGU','SILVER','HITAM'];
        $("#cmbJenisApal").on("change",function(e){
          if(this.value != ""){
            switch (this.value) {
              case "CETAK": $("#cmbSubJenis").empty();
                            $("#subJenis").addClass("has-warning");
                            for (var i = 0; i < warna.length; i++) {
                              $("#cmbSubJenis").append("<option value='"+warna[i]+" CETAK'>"+warna[i]+" CETAK</option>");
                            } break;
              case "POLOS": $("#cmbSubJenis").empty();
                            $("#subJenis").addClass("has-warning");
                            for (var i = 0; i < warna.length; i++) {
                              $("#cmbSubJenis").append("<option value='"+warna[i]+" CETAK'>"+warna[i]+" POLOS</option>");
                            } break;
              default: $("#cmbSubJenis").empty().html("<option value=''>--Pilih Jenis Apal Telebih Dahulu--</option>");
                       $("#subJenis").removeClass("has-warning");
                       break;
            }
          }else{
            $("#cmbSubJenis").empty().html("<option value=''>--Pilih Jenis Apal Telebih Dahulu--</option>");
            $("#subJenis").removeClass("has-warning");
          }
        });
      }

      function modalPenjualanApal(){
        resetFormPenjualanApal();
        tableListPenjualanApalTemp();
        $("#cmbGudangApal").select2({
          placeholder : "Pilih Apal",
          dropdownParent: $('#modalPenjualanApalBaru'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueApal/",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_apal+" - "+item.jenis+" - "+item.sub_jenis,
                    id:item.kd_gd_apal
                  }
                })
              };
            }
          }
        });

        $("#cmbGudangApal").on("select2:select",function(){
          $("#txtJumlahPermintaan").removeAttr("readonly");
        });

        $("#cmbGudangApal").on("select2:unselect",function(){
          $("#txtJumlahPermintaan").attr("readonly","readonly");
        });
      }

      function modalEditPenjualanApalTemp(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailTransaksiGudangApal",
          dataType : "JSON",
          data : {id:param},
          success : function(response){
            $("#txtTanggalJual").val(response[0].tgl_transaksi);
            $("#txtNamaCustomer").val(response[0].nama);
            $("#cmbGudangApal").val(response[0].kd_gd_apal).trigger("change");
            $("#txtJumlahPermintaan").val(response[0].jumlah_apal).removeAttr("readonly");
            $("#btnTambahPenjualan").removeAttr("onclick").attr("onclick","editPenjualanApalTemp('"+response[0].id+"')").text("Ubah");
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

      function modalCheckHistoryApal(){
        $("#cmbGudangApal2").select2({
          placeholder : "Pilih Apal",
          dropdownParent: $('#modalCheckHistory'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueApal/",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_apal+" - "+item.jenis+" - "+item.sub_jenis,
                    id:item.kd_gd_apal
                  }
                })
              };
            }
          }
        });
      }

      function modalEditHistoryApal(param2,param3,param4,param5){
        $("#modalEditHistory").modal({backdrop:"static"});
        $("#cmbGudangApal3").select2({
          placeholder : "Pilih Apal",
          dropdownParent: $('#modalEditHistory'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueApal/",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_apal+" - "+item.jenis+" - "+item.sub_jenis,
                    id:item.kd_gd_apal
                  }
                })
              };
            }
          }
        });

        $("#cmbGudangApal3").on("select2:select",function(){
          var id = $(this).val();
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailGudangApal",
            dataType : "JSON",
            data : {kdGdApal:id},
            success : function(response){
              $("#txtSubJenis").val(response[0].sub_jenis);
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
        });

        $("#cmbGudangApal3").on("select2:unselect",function(){
          $("#txtSubJenis").val("");
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailTransaksiGudangApal",
          dataType : "JSON",
          data : {id:param2},
          success : function(response){
            $("#txtTanggalHistory").val(response[0].tgl_transaksi);
            $("#txtNama").val(response[0].nama);
            $('#cmbGudangApal2').val(response[0].kd_gd_apal).trigger("change");
            $('#txtSubJenis').val(response[0].sub_jenis);
            $("#txtJumlah").val(response[0].jumlah_apal);
            $('[id="btnEditHistory"]').attr("onclick","editHistoryGudangApal('"+param2+"','"+param3+"','"+param4+"','"+param5+"')");
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
            $('[id="btnEditHistory"]').removeAttr("onclick");
          }
        });
      }

      function modalKoreksiGudangApal(){
        $("#cmbGudangApal4").select2({
          placeholder : "Pilih Apal",
          dropdownParent: $('#modalKoreksian'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueApal/",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_apal+" - "+item.jenis+" - "+item.sub_jenis,
                    id:item.kd_gd_apal
                  }
                })
              };
            }
          }
        });

        $("#cmbGudangApal4").on("select2:select",function(){
          $("#txtJumlahKoreksi").removeAttr("readonly");
        });

        $("#cmbGudangApal4").on("select2:unselect",function(){
          $("#txtJumlahKoreksi").attr("readonly","readonly");
        });

        $("#cmbJenisKoreksi").on("change",function(){
          var jenisKoreksi = $(this).val();
          if(jenisKoreksi == "PLUS"){
            $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                     "<option value='KOREKSI STOK'>Koreksi Stok</option>"+
                                     "<option value='GUDANG STANDARD'>Gudang Standar</option>"+
                                     "<option value='GUDANG CAMPUR'>Gudang Campur</option>"+
                                     "<option value='GUDANG ROLL'>Gudang Roll</option>"+
                                     "<option value='GUDANG KANTONG'>Gudang Kantong</option>"+
                                     "<option value='POTONG'>Potong</option>"+
                                     "<option value='CETAK'>Cetak</option>"+
                                     "<option value='EXTRUDER'>Extruder</option>"+
                                     "<option value='SABLON'>Sablon</option>"+
                                     "<option value='CUSTOM'>Custom</option>");
          }else if(jenisKoreksi == "MINUS"){
            $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                     "<option value='KOREKSI STOK'>Koreksi Stok</option>"+
                                     "<option value='GUDANG STANDARD'>Gudang Standar</option>"+
                                     "<option value='GUDANG CAMPUR'>Gudang Campur</option>"+
                                     "<option value='GUDANG ROLL'>Gudang Roll</option>"+
                                     "<option value='GUDANG KANTONG'>Gudang Kantong</option>"+
                                     "<option value='POTONG'>Potong</option>"+
                                     "<option value='CETAK'>Cetak</option>"+
                                     "<option value='EXTRUDER'>Extruder</option>"+
                                     "<option value='SABLON'>Sablon</option>"+
                                     "<option value='CUSTOM'>Custom</option>");
          }else{
            $("#cmbKeterangan").html("<option value='#'>Pilih Jenis Koreksi Terlebih Dahulu</option>");
          }
        });

        $("#cmbKeterangan").on("change",function(){
          var value = $("#cmbKeterangan").val();
          if(jQuery.trim(value) === "CUSTOM"){
            $(".comboKeterangan").attr({disabled:"disabled",style:"display:none;"});
            $("#input-group").removeAttr("style").attr("style","width:100%;float:left;");
            $(".textKeterangan").removeAttr("disabled");
          }
        });

        $("#close").click(function(){
          $(".textKeterangan").attr({disabled:"disabled"});
          $("#input-group").removeAttr("style").attr("style","width:100%;float:left;display:none;");
          $(".comboKeterangan").removeAttr("disabled style");
        });

        $("#btnAddKoreksi").attr("onclick","saveKoreksiApalTemp()").removeClass("btn-warning").html("<i class='fa fa-plus'></i> Simpan");
        tableListKoreksiApalTemp();
      }

      function modalEditKoreksiApalTemp(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailTransaksiGudangApal",
          dataType : "JSON",
          data : {id:param},
          success : function(response){
            $("#txtTanggalKoreksi").val(response[0].tgl_transaksi);
            $("#cmbGudangApal4").val(response[0].kd_gd_apal).trigger("change");
            $("#txtJumlahKoreksi").val(response[0].jumlah_apal);
            $("#txtJumlahKoreksi").removeAttr("readonly");
            if(response[0].status_history == "MASUK"){
              $("#cmbJenisKoreksi").val("PLUS").trigger("change");
            }else if(response[0].status_history == "MASUK"){
              $("#cmbJenisKoreksi").val("MINUS").trigger("change");
            }else{
              $("#cmbJenisKoreksi").val("#").trigger("change");
            }
            $("#cmbKeterangan").val(response[0].ketarangan_history).trigger("change");
            $("#btnAddKoreksi").attr("onclick","editKoreksiApalTemp('"+response[0].id+"')").removeClass("btn-warning").html("<i class='fa fa-pencil'></i> Ubah");
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
        $("#cmbGudangApal4").select2({
          placeholder : "Pilih Apal",
          dropdownParent: $('#modalKoreksian'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueApal/",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_apal+" - "+item.jenis+" - "+item.sub_jenis,
                    id:item.kd_gd_apal
                  }
                })
              };
            }
          }
        });

        $("#cmbGudangApal4").on("select2:select",function(){
          $("#txtJumlahKoreksi").removeAttr("readonly");
        });

        $("#cmbGudangApal4").on("select2:unselect",function(){
          $("#txtJumlahKoreksi").attr("readonly","readonly");
        });

        $("#cmbJenisKoreksi").on("change",function(){
          var jenisKoreksi = $(this).val();
          if(jenisKoreksi == "PLUS"){
            $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksian Opname</option>"+
                                     "<option value='KOREKSI STOK'>Koreksian Stok</option>"+
                                     "<option value='GUDANG STANDARD'>Gudang Standar</option>"+
                                     "<option value='GUDANG CAMPUR'>Gudang Campur</option>"+
                                     "<option value='GUDANG ROLL'>Gudang Roll</option>"+
                                     "<option value='GUDANG KANTONG'>Gudang Kantong</option>"+
                                     "<option value='POTONG'>Potong</option>"+
                                     "<option value='CETAK'>Cetak</option>"+
                                     "<option value='EXTRUDER'>Extruder</option>"+
                                     "<option value='SABLON'>Sablon</option>"+
                                     "<option value='CUSTOM'>Custom</option>");
          }else if(jenisKoreksi == "MINUS"){
            $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksian Opname</option>"+
                                     "<option value='KOREKSI STOK'>Koreksian Stok</option>"+
                                     "<option value='GUDANG STANDARD'>Gudang Standar</option>"+
                                     "<option value='GUDANG CAMPUR'>Gudang Campur</option>"+
                                     "<option value='GUDANG ROLL'>Gudang Roll</option>"+
                                     "<option value='GUDANG KANTONG'>Gudang Kantong</option>"+
                                     "<option value='POTONG'>Potong</option>"+
                                     "<option value='CETAK'>Cetak</option>"+
                                     "<option value='EXTRUDER'>Extruder</option>"+
                                     "<option value='SABLON'>Sablon</option>"+
                                     "<option value='CUSTOM'>Custom</option>");
          }else{
            $("#cmbKeterangan").html("<option value='#'>Pilih Jenis Koreksi Terlebih Dahulu</option>");
          }
        });

        $("#cmbKeterangan").on("change",function(){
          var value = $("#cmbKeterangan").val();
          if(jQuery.trim(value) === "CUSTOM"){
            $(".comboKeterangan").attr({disabled:"disabled",style:"display:none;"});
            $("#input-group").removeAttr("style").attr("style","width:100%;float:left;");
            $(".textKeterangan").removeAttr("disabled");
          }
        });

        $("#close").click(function(){
          $(".textKeterangan").attr({disabled:"disabled"});
          $("#input-group").removeAttr("style").attr("style","width:100%;float:left;display:none;");
          $(".comboKeterangan").removeAttr("disabled style");
        });
      }

      function modalEditDataAwalApal(){
        $("#cmbGudangApal5").select2({
          placeholder : "Pilih Apal",
          dropdownParent: $('#modalEditDataAwal'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueApal/",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_apal+" - "+item.jenis+" - "+item.sub_jenis,
                    id:item.kd_gd_apal
                  }
                })
              };
            }
          }
        });

        $("#cmbGudangApal5").on("select2:select",function(){
          var id = $("#cmbGudangApal5").val();
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/getDataAwalApal",
            dataType : "JSON",
            data : {kdGdApal:id},
            success : function(response){
              $("#txtTanggalPengeluaran").val(response[0].tgl_transaksi);
              $("#txtJenisApal").val(response[0].jenis);
              $("#txtSubJenisApal").val(response[0].sub_jenis);
              $("#txtJumlahApal").val(response[0].jumlah_apal).removeAttr("readonly");
              $("#btnUbahDataAwal").removeAttr("onclick").attr("onclick","editDataAwalApal('"+response[0].id+"','"+response[0].kd_gd_apal+"')")
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
        });

        $("#cmbGudangApal5").on("select2:unselect",function(){
          $("#txtTanggalPengeluaran").val("");
          $("#txtJenisApal").val("");
          $("#txtSubJenisApal").val("");
          $("#txtJumlahApal").val("").attr("readonly","readonly");
        });
      }

      function modalTambahSparePartBaru(){
        resetFormTambahSparePartBaru();
      }

      function modalEditSparePart(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailSparePart",
          dataType : "JSON",
          data : {kdSparePart:param},
          success : function(response){
            $("#txtKdSparePart").val(response[0].kd_spare_part);
            $("#txtKodeAccurate").val(response[0].kd_accurate);
            $("#txtTanggalBuat").val(response[0].tgl_masuk);
            $("#txtNamaBarang").val(response[0].nm_spare_part);
            $("#txtKode").val(response[0].kode);
            $("#txtUkuran").val(response[0].ukuran);
            $("#txtStok").val(response[0].stok).attr("readonly","readonly");
            $("#modalTambahSparePartBaru").modal({
              backdrop : "static"
            })
            $("#btnSimpanSparePartBaru").removeAttr("onclick").attr("onclick","editSparePart()").text("Ubah");
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

      function modalCheckHistorySparePart(){
        $("#cmbSparePart1").select2({
          placeholder : "Pilih Spare Part",
          dropdownParent: $('#modalCheckHistory'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueSparePart/",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_spare_part+" | "+item.nm_spare_part+" | "+item.ukuran,
                    id:item.kd_spare_part
                  }
                })
              };
            }
          }
        });
      }

      function modalPengeluaranSparePart(){
        resetFormPengeluaranSparePart();
        tableListPengeluaranSparePartTemp();
        $("#cmbSparePart2").select2({
          placeholder : "Pilih Spare Part",
          dropdownParent: $('#modalPengeluaranSparePart'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueSparePart/",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_spare_part+" | "+item.nm_spare_part+" | "+item.ukuran,
                    id:item.kd_spare_part
                  }
                })
              };
            }
          }
        });

        $("#cmbSparePart2").on("select2:select",function(){
          var dataText = $("#cmbSparePart2").select2("data")[0]["text"];
          var arrDataText = dataText.split(" | ");
          $("#txtNamaSparePart").val(arrDataText[1]);
          $("#txtJumlahPengeluaran").removeAttr("readonly");
        });

        $("#cmbSparePart2").on("select2:unselect",function(){
          $("#txtNamaSparePart").val("");
          $("#txtJumlahPengeluaran").attr("readonly","readonly").val("");
        });
      }

      function modalEditPengeluaranSparePart(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailTransaksiSparePart",
          dataType : "JSON",
          data : {id:param},
          success : function(response){
            $("#txtTglPengeluaran").val(response[0].tgl_transaksi);
            $("#cmbSparePart2").val(response[0].kd_spare_part).trigger("change");
            $("#txtNamaSparePart").val(response[0].nm_spare_part);
            $("#txtJumlahPengeluaran").val(response[0].jumlah).removeAttr("readonly");
            $("#cmbKeteranganPengeluaran").val(response[0].keterangan_history).trigger("change");
            $("#btnAddPengeluaranSparePart").removeAttr("onclick").attr("onclick","editPengeluaranSparePartTemp('"+response[0].id+"')").html("<i class='fa fa-pencil'></i> Ubah");
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

      function modalKoreksiSparePart(){
        resetFormKoreksiSparePart();
        tableListKoreksiSparePartTemp();
        $("#cmbSparePart3").select2({
          placeholder : "Pilih Spare Part",
          dropdownParent: $('#modalKoreksian'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueSparePart/",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_spare_part+" | "+item.nm_spare_part+" | "+item.ukuran,
                    id:item.kd_spare_part
                  }
                })
              };
            }
          }
        });

        $("#cmbSparePart3").on("select2:select",function(){
          var dataText = $("#cmbSparePart3").select2("data")[0]["text"];
          var arrDataText = dataText.split(" | ");
          $("#txtNamaBarangKoreksi").val(arrDataText[1]);
          $("#txtJumlahKoreksi").removeAttr("readonly");
        });

        $("#cmbSparePart3").on("select2:unselect",function(){
          $("#txtNamaBarangKoreksi").val("");
          $("#txtJumlahKoreksi").attr("readonly","readonly").val("");
        });
      }

      function modalEditKoreksiSparePart(param){
        var jenisKoreksi = "";
        var keteranganHistory = "";
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailTransaksiSparePart",
          dataType : "JSON",
          data : {id:param},
          success : function(response){
            var keteranganHistoryTemp = response[0].keterangan_history;
            keteranganHistory = keteranganHistoryTemp.split("(");
            $("#txtTanggalKoreksi").val(response[0].tgl_transaksi);
            $("#cmbSparePart3").val(response[0].kd_spare_part).trigger("change");
            $("#txtNamaBarangKoreksi").val(response[0].nm_spare_part);
            $("#txtJumlahKoreksi").val(response[0].jumlah).removeAttr("readonly");
            if(response[0].sts_history == "MASUK"){
              jenisKoreksi = "PLUS";
            }else{
              jenisKoreksi = "MINUS";
            }
            $("#cmbJenisKoreksi").val(jenisKoreksi).trigger("change");
            $("#cmbKeterangan").val(keteranganHistory).trigger("change");
            $("#btnAddKoreksiSparePart").removeAttr("onclick").attr("onclick","editKoreksiSparePartTemp('"+response[0].id+"')").html("<i class='fa fa-pencil'></i> Ubah");
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

      function modalEditHistorySparePart(param,param2,param3,param4){
        $("#modalEditHistorySparePart").modal({
          backdrop : "static"
        });
        $("#cmbSparePart4").select2({
          placeholder : "Pilih Spare Part",
          dropdownParent: $('#modalEditHistorySparePart'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueSparePart/",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_spare_part+" | "+item.nm_spare_part+" | "+item.ukuran,
                    id:item.kd_spare_part
                  }
                })
              };
            }
          }
        });

        $("#cmbSparePart4").on("select2:select",function(){
          var dataText = $("#cmbSparePart4").select2("data")[0]["text"];
          var arrDataText = dataText.split(" | ");
          $("#txtNamaBarang2").val(arrDataText[1]);
        });

        $("#cmbSparePart4").on("select2:unselect",function(){
          $("#txtNamaBarang2").val("");
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailTransaksiSparePart",
          dataType : "JSON",
          data : {id:param},
          success : function(response){
            var keteranganHistoryTemp = response[0].keterangan_history;
            keteranganHistory = keteranganHistoryTemp.split("(");
            $("#txtTanggalHistory").val(response[0].tgl_transaksi);
            $("#cmbSparePart4").val(response[0].kd_spare_part).trigger("change");
            $("#txtNamaBarang2").val(response[0].nm_spare_part);
            $("#txtJumlahHistory").val(response[0].jumlah);
            $("#btnEditHistorySparePart").removeAttr("onclick").attr("onclick","editHistorySparePart('"+param+"','"+param2+"','"+param3+"','"+param4+"')");
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

      function modalApprove(param,param2){
        $("#modalTitle").text("Data Permintaan / Kembalian");
        datatableListApproveBahanBakuExtruder(param,param2);
        $("#btnApproveBahanBaku").removeAttr("onclick").attr("onclick","saveApproveTransaksiGudangBahan('"+param+"','"+param2+"')");
      }

      function modalApprovePembelian(param){
        $("#modalTitle").text("Data Barang Yang Sudah Dibeli");
        datatableListApprovePembelianBahanBaku(param);
        $("#btnApproveBahanBaku").removeAttr("onclick").attr("onclick","saveApprovePembelian('"+param+"')");
      }

      function modalEditDataForApprove(param,param2,param3){
        $("#modalEditDataForApprove").modal({
          backdrop : "static"
        });
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailPengeluaran",
          dataType : "JSON",
          data : {id:param},
          success : function(response){
            $("#txtNamaBarangForApprove").val(response[0].nm_barang);
            $("#txtJumlahForApprove").val(response[0].jumlah_permintaan);
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
        $("#btnEditForApprove").removeAttr("onclick").attr("onclick","editDataForApprove('"+param+"','"+param2+"','"+param3+"')");
      }

      function modalEditDataPembelianForApprove(param,param2){
        $("#modalEditDataForApprove").modal({
          backdrop : "static"
        });
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailPengeluaran",
          dataType : "JSON",
          data : {id:param},
          success : function(response){
            $("#txtNamaBarangForApprove").val(response[0].nm_barang);
            $("#txtJumlahForApprove").val(response[0].jumlah_permintaan);
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
        $("#btnEditForApprove").removeAttr("onclick").attr("onclick","editDataPembelianForApprove('"+param+"','"+param2+"')");
      }

      function modalApproveApal(){
        $("#modalTitle").text("Data Kiriman Apal");
        datatableListApproveGudangApal();
        $("#btnApproveApal").removeAttr("onclick").attr("onclick","saveApproveTransaksiGudangApal()");
      }

      function modalEditDataApalForApprove(param){
        $("#modalEditDataForApprove").modal({
          backdrop : "static"
        });
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailTransaksiGudangApal",
          dataType : "JSON",
          data : {id:param},
          success : function(response){
            $("#txtNamaBarangForApprove").val(response[0].jenis+" ("+response[0].sub_jenis+")");
            $("#txtJumlahForApprove").val(response[0].jumlah_apal);
            $("#btnEditForApprove").removeAttr("onclick").attr("onclick","editDataApalForApprove('"+response[0].id+"')");
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

      function cari_bonPermintaan(param) {
        var jenis = param.replace("_", " ")
        var tgl_awal  = $("#tgl_cari1").val();
        var tgl_akhir = $("#tgl_cari2").val();
        $("#jenis").text(jenis);
        $("#print_bon_permintaan").attr('onclick', 'printElem()');
        if (jenis=="SPARE PART") {
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudangbahan/main/listBonPermintaanSP') ?>",
            data : {jenis:jenis,tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
            dataType : "JSON",
            success:function(response){
              $("#modalBonPermintaan").modal({backdrop:"static"});
              $("#modal_cariBonPermintaan").modal("hide");
              $("#tableListBonPermintaan > tbody > tr").empty();
              $.each(response,function(index,value){
                var no = ++index;
                $("#tableListBonPermintaan > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+no+"</td>"+
                    "<td>"+value.tgl_transaksi+"</td>"+
                    "<td>"+value.nm_spare_part+"</td>"+
                    "<td>"+value.ukuran+"</td>"+
                    "<td>"+value.jumlah+"</td>"+
                  "</tr>"
                );
              });
            }
          });
        }else{
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudangbahan/main/listBonPermintaan') ?>",
            data : {jenis:jenis,tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
            dataType : "JSON",
            success:function(response){
              $("#modalBonPermintaan").modal({backdrop:"static"});
              $("#modal_cariBonPermintaan").modal("hide");
              $("#tableListBonPermintaan > tbody > tr").empty();
              $.each(response,function(index,value){
                var no = ++index;
                $("#tableListBonPermintaan > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+no+"</td>"+
                    "<td>"+value.tgl_permintaan+"</td>"+
                    "<td>"+value.nama+"</td>"+
                    "<td>"+value.nm_barang+"</td>"+
                    "<td>"+value.warna+"</td>"+
                    "<td>"+value.jenis+"</td>"+
                    "<td>"+value.jumlah_permintaan+"</td>"+
                  "</tr>"
                );
              });
            }
          });
        }
      }

      function modalCariBonPermintaan(param){
        $("#btn_cariBonPermintaan").attr("onclick","cari_bonPermintaan('"+param+"')");
      }

      function modalLihatDetailPermintaan(param){
        $("#modalLihatPesanan").modal({
          backdrop:"static"
        });
        datatablesDetailPermintaan(param);
      }

      function modalLihatDetailPermintaanSparePart(param){
        $("#modalLihatPesanan").modal({
          backdrop:"static"
        });
        datatablesDetailPermintaanSparePart(param);
      }

      function modalTerimaBarangFull(param, param2){
        $("#trJumlahPermintaan").css("display","none");
        $("#btnTerima").attr("onclick","terimaBarangFull('"+param+"','"+param2+"')");
        $("#modalInputPenerimaanBarang").modal({
          backdrop : "static"
        });
      }

      function modalTerimaBarangSetengah(param, param2){
        $("#trJumlahPermintaan").css("display","table-row");
        $("#btnTerima").attr("onclick","terimaBarangSetengah('"+param+"','"+param2+"')");
        $("#modalInputPenerimaanBarang").modal({
          backdrop : "static"
        });
      }

      function modalTerimaSparePartFull(param, param2){
        $("#trJumlahPermintaan").css("display","none");
        $("#btnTerima").attr("onclick","terimaSparePartFull('"+param+"','"+param2+"')");
        $("#modalInputPenerimaanBarang").modal({
          backdrop : "static"
        });
      }

      function modalTerimaSparePartSetengah(param, param2){
        $("#trJumlahPermintaan").css("display","table-row");
        $("#btnTerima").attr("onclick","terimaSparePartSetengah('"+param+"','"+param2+"')");
        $("#modalInputPenerimaanBarang").modal({
          backdrop : "static"
        });
      }

      function modalTambahDataAwal(param){
        var placeholder = param.replace("_"," ");
        $("#cmbBarang").select2({
          placeholder : "Pilih Bahan ("+placeholder+")",
          dropdownParent: $('#modalTambahDataAwal'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueBahan/"+param,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_bahan+" - "+item.nm_barang+" - "+item.warna+" - "+item.status,
                    id:item.kd_gd_bahan
                  }
                })
              };
            }
          }
        });

        $("#cmbBarang").on("select2:select",function(){
          var id = $(this).val();
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailDataAwal",
            dataType : "JSON",
            data : {kdGdBahan:id},
            success : function(response){
              if(response.length > 0){
                $("#txtJumlahDataAwal").val(response[0].jumlah_permintaan);
                $("#btnTambahDataAwal").attr("onclick","editDataAwal('"+response[0].id+"','"+response[0].kd_gd_bahan+"')")
                                       .removeClass("btn-primary")
                                       .addClass("btn-warning")
                                       .html("<i class='fa fa-pencil'></i> Ubah Data Awal");
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
        });

        $("#cmbBarang").on("select2:unselect",function(){
          $("#btnTambahDataAwal").attr("onclick","addDataAwal('"+param+"')")
                                 .removeClass("btn-warning")
                                 .addClass("btn-primary")
                                 .html("<i class='fa fa-plus'></i> Tambah");
          $("#txtJumlahDataAwal").val("");
        });

        $("#txtJumlahDataAwal").val("");
        $("#cmbBarang").val("");
        $("#btnTambahDataAwal").attr("onclick","addDataAwal('"+param+"')")
                               .removeClass("btn-warning")
                               .addClass("btn-primary")
                               .html("<i class='fa fa-plus'></i> Tambah");
        tableListDataAwalPending(param.replace(/_/gi," "));
      }

      function modalTambahDataAwalSparePart(){
        $("#cmbBarang").select2({
          placeholder : "Pilih Bahan Spare Part",
          dropdownParent: $('#modalTambahDataAwal'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangbahan/main/getComboBoxValueSparePart",
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_spare_part+" | "+item.nm_spare_part+" | "+item.ukuran,
                    id:item.kd_spare_part
                  }
                })
              };
            }
          }
        });

        $("#cmbBarang").on("select2:select",function(){
          var id = $(this).val();
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/getDetailDataAwalSparePart",
            dataType : "JSON",
            data : {kdSparePart:id},
            success : function(response){
              if(response.length > 0){
                $("#txtJumlahDataAwal").val(response[0].jumlah);
                $("#btnTambahDataAwal").attr("onclick","editDataAwalSparePart('"+response[0].id+"','"+response[0].kd_spare_part+"')")
                                       .removeClass("btn-primary")
                                       .addClass("btn-warning")
                                       .html("<i class='fa fa-pencil'></i> Ubah Data Awal");
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
        });

        $("#cmbBarang").on("select2:unselect",function(){
          $("#btnTambahDataAwal").attr("onclick","addDataAwalSparePart()")
                                 .removeClass("btn-warning")
                                 .addClass("btn-primary")
                                 .html("<i class='fa fa-plus'></i> Tambah");
          $("#txtJumlahDataAwal").val("");
        });

        $("#txtJumlahDataAwal").val("");
        $("#cmbBarang").val("");
        $("#btnTambahDataAwal").attr("onclick","addDataAwalSparePart()")
                               .removeClass("btn-warning")
                               .addClass("btn-primary")
                               .html("<i class='fa fa-plus'></i> Tambah");
        tableListDataAwalSparePartPending();
      }
      //============================================MODAL METHOD (Finish)============================================//

      //============================================SAVE METHOD (Start)============================================//
      function saveBahanBaku(param){
        var kdGdBahan1 = $("#txtKdBahan").val();
        var kdAccurate1 = $("#txtKdAccurate").val();
        var nmBarang1 = $("#txtNamaBahanBaru").val();
        var stok1 = $("#txtStok").val().replace(/,/g , "");
        var satuan1 = $("#cmbSatuan").val();
        var warna1 = $("#txtWarna").val();
        var tglMasuk1 = $("#txtTanggal").val();
        var status1 = $("#cmbStatus").val();
        var jenis1 = param.replace("_"," ");

        if(kdGdBahan1=="" || nmBarang1=="" || stok1=="" ||
           satuan1=="" || tglMasuk1=="" || status1=="" || jenis1==""
         ){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/saveGudangBahan",
            dataType : "TEXT",
            data : {kdGdBahan:kdGdBahan1,kdAccurate:kdAccurate1,nmBarang:nmBarang1,
                    stok:stok1,satuan:satuan1,warna:warna1,tglMasuk:tglMasuk1,status:status1,jenis:jenis1},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormTambahBahanBaku();
                  datatableListBahanBaku();
                  datatableListBijiWarna();
                  datatableListMinyak();
                  datatableListCatCampur();
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
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

      function saveCartPembelian(param){
        var tanggal1 = $("#txtTanggalBeli").val();
        var kdPermintaan1 = $("#txtKdPermintaan").val();
        // var nama1 = $("#txtNamaCustomer").val();
        var namaBahan1 = $("#txtNamaBahan").val();
        var kdGdBahan1 = $("#cmbGudangBahan").val();
        var jumlahPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g , "");
        var keterangan1 = $("#txtKeterangan").val();

        if(tanggal1==""||kdGdBahan1==""||jumlahPermintaan1==""||kdPermintaan1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/addPembelianGudangBahanTemp",
            dataType : "TEXT",
            data : {kdGdBahan         : kdGdBahan1,
                    tanggal           : tanggal1,
                    jumlahPermintaan  : jumlahPermintaan1,
                    namaBahan         : namaBahan1,
                    kdPermintaan      : kdPermintaan1,
                    keterangan        : keterangan1,
                    jenis             : param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Item Pembelian Berhasil Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormPembelian();
                  tableListPembelianBahanBakuTemp(param);
                  modalTambahPembelianBahanBaku(param.replace(/ /gi,"_"));
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Item Pembelian Gagal Ditambahkan");
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

      function saveCartPembelianSparePart(){
        var kodePermintaan1 = $("#txtKdPermintaan").val();
        var tanggal1 = $("#txtTanggalBeli").val();
        // var nama1 = $("#txtNamaCustomer").val();
        var namaBahan1 = $("#txtNamaBahan").val();
        var kdGdBahan1 = $("#cmbGudangBahan").val();
        var jumlahPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g , "");
        var keterangan1 = $("#txtKeterangan").val();

        if(tanggal1==""||kdGdBahan1==""||jumlahPermintaan1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/addPembelianSparePartTemp",
            dataType : "TEXT",
            data : {kdPermintaan      : kodePermintaan1,
                    kdSparePart       : kdGdBahan1,
                    tanggal           : tanggal1,
                    // nama:nama1,
                    jumlahPermintaan  : jumlahPermintaan1,
                    namaSparePart     : namaBahan1,
                    keterangan        : keterangan1
            },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Item Pembelian Berhasil Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormPembelian();
                  modalTambahPembelianSparePart();
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Item Pembelian Gagal Ditambahkan");
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

      function saveDanKirimPermintaan(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/savePembelianGudangBahan",
          dataType : "TEXT",
          data : {
            jenis : param
          },
          success : function(response){
            if(jQuery.trim(response) === "Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Item Pembelian Berhasil Dikirim");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                resetFormPembelian(param);
                tableListPembelianBahanBakuTemp(param);
              },2000);
            }else if(jQuery.trim(response) === "Gagal"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Item Pembelian Gagal Dikirim");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else{
              $("#modal-notif").addClass("modal-warning");
              $("#modalNotifContent").text("Item Pembelian Masih Kosong");
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

      function saveDanKirimPermintaanSparePart(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/savePembelianSparePart",
          dataType : "TEXT",
          success : function(response){
            if(jQuery.trim(response) === "Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Item Pembelian Berhasil Dikirim");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                resetFormPembelian();
                tableListPembelianSparePartTemp();
              },2000);
            }else if(jQuery.trim(response) === "Gagal"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Item Pembelian Gagal Dikirim");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else{
              $("#modal-notif").addClass("modal-warning");
              $("#modalNotifContent").text("Item Pembelian Masih Kosong");
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

      function saveCartKoreksi(param){
        var tglKoreksi1 = $("#txtTanggalKoreksi").val();
        var kdGdBahan1 = $("#cmbBahan").val();
        var nmBahanBaku1 = $("#txtNamaBahan").val();
        var jumlahKoreksi1 = $("#txtJumlahKoreksi").val().replace(/,/g , "");
        var jenisKoreksi1 = $("#cmbJenisKoreksi").val();
        var keterangan1 = $("#cmbKeterangan").val();

        if(tglKoreksi1 =="" || kdGdBahan1 == "" || nmBahanBaku1 == "" ||
           jumlahKoreksi1 =="" || jenisKoreksi1 == "" || keterangan1 ==""){
             $("#modal-notif").addClass("modal-warning");
             $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
             $("#modal-notif").modal("show");
             setTimeout(function(){
               $("#modal-notif").modal("hide");
               $("#modal-notif").removeClass("modal-warning");
               $("#modalNotifContent").text("");
             },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/addKoreksiTemp",
            dataType : "TEXT",
            data : {tglKoreksi:tglKoreksi1,kdGdBahan:kdGdBahan1,nmBahanBaku:nmBahanBaku1,
                  jumlahKoreksi:jumlahKoreksi1,jenisKoreksi:jenisKoreksi1,keterangan:keterangan1},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Koreksi Berhasil Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormKoreksi(param);
                  tableListKoreksi(param);
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Koreksi Gagal Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                });
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
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
            }
          });
        }
      }

      function saveKoreksi(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/saveKoreksi",
          dataType : "TEXT",
          data : {jenis:param},
          success : function(response){
            if(jQuery.trim(response) === "Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Item Koreksi Berhasil Disimpan");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                resetFormKoreksi(param);
                tableListKoreksi(param);
              },2000);
            }else if(jQuery.trim(response) === "Gagal"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Item Koreksi Gagal Disimpan");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else if(jQuery.trim(response) === "Lock"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else{
              $("#modal-notif").addClass("modal-warning");
              $("#modalNotifContent").text("Item Kosong");
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
        })
      }

      function savePengeluaranTemp(param){
        var tanggal1 = $("#txtTanggalPengeluaran").val();
        var kdGdBahan1 = $("#cmbBarang1").val();
        var jumlah1 = $("#txtJumlahPengeluaran").val().replace(/,/g , "");
        var keterangan1 = $("#keterangan").val();
        if(tanggal1=="" || kdGdBahan1 =="" || jumlah1 ==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/addPengeluaran",
            dataType : "TEXT",
            data : {tanggal:tanggal1,kdGdBahan:kdGdBahan1,jumlah:jumlah1,keterangan:keterangan1},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Pengeluaran Berhasil Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tablePengeluaranGudangBahan(param);
                  resetFormPengeluaran(param);
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Pengeluaran Gagal Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
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

      function savePengeluaran(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/savePengeluaran",
          dataType : "TEXT",
          data : {jenis:param},
          success : function(response){
            if(jQuery.trim(response) === "Berhasil") {
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Item Koreksi Berhasil Disimpan");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                resetFormKoreksi(param);
                tablePengeluaranGudangBahan(param);
              },2000);
            }else if(jQuery.trim(response) === "Gagal"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Item Koreksi Gagal Disimpan");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else if(jQuery.trim(response) === "Lock"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else{
              $("#modal-notif").addClass("modal-warning");
              $("#modalNotifContent").text("Item Kosong");
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

      function saveApal(){
        var kdGdApal1 = $("#txtKdApal").val();
        var kdAccurate1 = $("#txtKdAccurate").val();
        var jenis1 = $("#cmbJenisApal").val();
        var subJenis1 = $("#cmbSubJenis").val();
        var stok1 = $("#txtStok").val().replace(/,/g , "");;
        var tanggal1 = $("#txtTanggal").val();
        if(kdGdApal1==""||jenis1==""||stok1==""||tanggal1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/saveApal",
            dataType : "TEXT",
            data : {kdGdApal:kdGdApal1,kdAccurate:kdAccurate1,jenis:jenis1,subJenis:subJenis1,
                    stok:stok1,tanggal:tanggal1},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Apal Baru Berhasil Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormTambahApal();
                  datatableListApal();
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-gagal");
                $("#modalNotifContent").text("Apal Baru Gagal Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-gagal");
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

      function savePenjualanApalTemp(){
        var tanggal1 = $("#txtTanggalJual").val();
        var nama1 = $("#txtNamaCustomer").val();
        var kdGdApal1 = $("#cmbGudangApal").val();
        var jumlah1 = $("#txtJumlahPermintaan").val().replace(/,/g , "");

        if(tanggal1==""||kdGdApal1==""||jumlah1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/addPenjualanApalTemp",
            dataType : "TEXT",
            data : {tanggal:tanggal1,nama:nama1,kdGdApal:kdGdApal1,jumlah:jumlah1},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Penjualan Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPenjualanApalTemp();
                  resetFormPenjualanApal();
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Penjualan Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
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

      function savePenjualanApal(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/savePenjualanApal",
          dataType : "TEXT",
          success : function(response){
            if(jQuery.trim(response) === "Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Item Penjualan Berhasil Dikirim Ke Bagian Purchasing");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                resetFormPenjualanApal();
                tableListPenjualanApalTemp();
              },2000);
            }else if(jQuery.trim(response) === "Gagal"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Item Penjualan Gagal Dikirim Ke Bagian Purchasing");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else if(jQuery.trim(response) === "Lock"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else{
              $("#modal-notif").addClass("modal-warning");
              $("#modalNotifContent").text("Item Penjualan Masih Kosong");
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

      function saveKoreksiApalTemp(){
        var tanggal1 = $("#txtTanggalKoreksi").val();
        var kdGdApal1 = $("#cmbGudangApal4").val();
        var jumlah1 = $("#txtJumlahKoreksi").val().replace(/,/g , "");
        var jenisKoreksi1 = $("#cmbJenisKoreksi").val();
        var ketarangan1 = null;
        if(jQuery.trim($("#cmbKeterangan").val()) === "CUSTOM"){
          ketarangan1 = $(".textKeterangan").val();
        }else{
          ketarangan1 = $(".comboKeterangan").val();
        }
        if(tanggal1==""||kdGdApal1==""||jumlah1==""||jenisKoreksi1==""||ketarangan1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/saveKoreksiApalTemp",
            dataType : "TEXT",
            data : {tanggal:tanggal1,kdGdApal:kdGdApal1,jumlah:jumlah1,jenisKoreksi:jenisKoreksi1,keterangan:ketarangan1},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Koreksi Apal Berhasil Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListKoreksiApalTemp();
                  resetFormKoreksiApal();
                },2000);
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Koreksi Apal Gagal Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
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

      function saveKoreksiApal(){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/saveKoreksiApal",
          dataType : "TEXT",
          success : function(response){
            if(jQuery.trim(response) === "Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Item Koreksi Berhasil Disimpan");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                resetFormKoreksiApal();
                tableListKoreksiApalTemp();
                datatableListApal();
              },2000);
            }else if(jQuery.trim(response) === "Gagal"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Item Koreksi Gagal Disimpan");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else if(jQuery.trim(response) === "Lock"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else{
              $("#modal-notif").addClass("modal-warning");
              $("#modalNotifContent").text("Item Kosong");
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
        })
      }

      function saveSparePart(){
        var kdSparePart1 = $("#txtKdSparePart").val();
        var kdAccurate1 = $("#txtKodeAccurate").val();
        var tanggal1 = $("#txtTanggalBuat").val();
        var namaBarang1 = $("#txtNamaBarang").val();
        var kode1 = $("#txtKode").val();
        var ukuran1 = $("#txtUkuran").val();
        var stok1 = $("#txtStok").val().replace(/,/g,"");
        if(kdSparePart1==""||tanggal1==""||namaBarang1==""||stok1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/saveSparePart",
            dataType : "TEXT",
            data : {kdSparePart:kdSparePart1,kdAccurate:kdAccurate1,
                    tanggal:tanggal1,namaBarang:namaBarang1,
                    kode:kode1,ukuran:ukuran1,stok:stok1},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Spare Part Berhasil Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormTambahSparePartBaru();
                  datatableListSparePart();
                },2000);
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Spare Part Gagal Ditambahkan");
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

      function savePengeluaranSparePartTemp(){
        var tanggal1 = $("#txtTglPengeluaran").val();
        var kdSparePart1 = $("#cmbSparePart2").val();
        var jumlah1 = $("#txtJumlahPengeluaran").val().replace(/,/g,"");
        var keterangan1 = $("#cmbKeteranganPengeluaran").val();

        if(tanggal1==""||kdSparePart1==""||jumlah1==""||keterangan1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/savePengeluaranSparePartTemp",
            dataType : "TEXT",
            data : {tanggal           : tanggal1,
                    kdSparePart       : kdSparePart1,
                    jumlah            : jumlah1,
                    keteranganHistory : keterangan1},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormPengeluaranSparePart();
                  tableListPengeluaranSparePartTemp();
                },2000);
              }else if(jQuery.trim(response)==="Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                });
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Ditambahkan");
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

      function savePengeluaranSparePart(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/savePengeluaranSparePart",
          dataType : "TEXT",
          success : function(response){
            if(jQuery.trim(response)==="Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                resetFormPengeluaranSparePart();
                tableListPengeluaranSparePartTemp();
              },2000);
            }else if(jQuery.trim(response)==="Gagal") {
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Transaksi Gagal Disimpan");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else{
              $("#modal-notif").addClass("modal-warning");
              $("#modalNotifContent").text("Item Pengeluaran Masih Kosong");
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

      function saveKoreksiSparePartTemp(){
        var tanggal1 = $("#txtTanggalKoreksi").val();
        var kdSparePart1 = $("#cmbSparePart3").val();
        var jumlah1 = $("#txtJumlahKoreksi").val().replace(/,/g,"");
        var jenisKoreksi1 = $("#cmbJenisKoreksi").val();
        var keterangan1 = $("#cmbKeterangan").val();

        if(tanggal1==""||kdSparePart1==""||jumlah1==""||jenisKoreksi1==""||keterangan1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/saveKoreksiSparePartTemp",
            dataType : "TEXT",
            data : {kdSparePart       : kdSparePart1,
                    tanggal           : tanggal1,
                    jumlah            : jumlah1,
                    jenisKoreksi      : jenisKoreksi1,
                    keteranganHistory : keterangan1},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Ditambahkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormKoreksiSparePart();
                  tableListKoreksiSparePartTemp();
                },2000);
              }else if(jQuery.trim(response)==="Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                });
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Ditambahkan");
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

      function saveKoreksiSparePart(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/saveKoreksiSparePart",
          dataType : "TEXT",
          success : function(response){
            if(jQuery.trim(response)==="Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                resetFormKoreksiSparePart();
                tableListKoreksiSparePartTemp();
              },2000);
            }else if(jQuery.trim(response)==="Gagal") {
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Transaksi Gagal Disimpan");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else{
              $("#modal-notif").addClass("modal-warning");
              $("#modalNotifContent").text("Item Pengeluaran Masih Kosong");
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

      function saveApproveTransaksiGudangBahan(param,param2){
        if(confirm("Apakah Anda Yakin Tidak Ada Yang Salah?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/saveApproveTransaksiGudangBahan",
            dataType : "TEXT",
            data : {bagian  : param,
                    jenis   : param2},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableListApproveBahanBakuExtruder(param,param2);
                },2000);
              }else if(jQuery.trim(response)==="Item Kosong"){
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Item Transaksi Masih Kosong!");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-warning");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Parameter Kosong Hub. IT");
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

      function saveApproveTransaksiGudangApal(){
        if(confirm("Apakah Anda Yakin Tidak Ada Yang Salah?")){
          $.ajax({
            url : "<?php echo base_url(); ?>_gudangbahan/main/saveApproveTransaksiGudangApal",
            dataType : "TEXT",
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableListApproveGudangApal();
                },2000);
              }else if(jQuery.trim(response)==="Item Kosong"){
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Item Transaksi Masih Kosong!");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-warning");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Parameter Kosong Hub. IT");
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

      function saveApprovePembelian(param){
        if(confirm("Apakah Anda Yakin Tidak Ada Yang Salah?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/saveApprovePembelianGudangBahan",
            dataType : "TEXT",
            data : {jenis   : param},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableListApprovePembelianBahanBaku(param);
                },2000);
              }else if(jQuery.trim(response)==="Item Kosong"){
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Item Transaksi Masih Kosong!");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-warning");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Parameter Kosong Hub. IT");
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

      function terimaBarangFull(param, param2){
        var namaSupplier = $("#txtNamaSupplier").val();
        var tglTerima = $("#txtTglTerima").val();

        if(namaSupplier=="" || tglTerima==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/terimaBarangFull'); ?>",
            dataType : "TEXT",
            data : {
              idDpb         : param,
              idPermintaan  : param2,
              namaSupplier  : namaSupplier,
              tglTerima     : tglTerima
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $(".active a").trigger("click");
                  $("input").val("");
                  $(".date").datepicker("setDate",null);
                  $("#modalInputPenerimaanBarang").modal("hide");
                },2000);
              }else if($.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if($.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan, Bulan Ini Sudah Dikunci");
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

      function terimaBarangSetengah(param, param2){
        var namaSupplier = $("#txtNamaSupplier").val();
        var tglTerima = $("#txtTglTerima").val();
        var jumlahTerima = $("#txtJumlahPenerimaan").val().replace(/,/gi,"");

        if(namaSupplier=="" || tglTerima=="" || jumlahTerima==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/terimaBarangSetengah'); ?>",
            dataType : "TEXT",
            data : {
              idDpb         : param,
              idPermintaan  : param2,
              namaSupplier  : namaSupplier,
              tglTerima     : tglTerima,
              jumlahTerima  : jumlahTerima
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $(".active a").trigger("click");
                  $("input").val("");
                  $(".date").datepicker("setDate",null);
                  $("#modalInputPenerimaanBarang").modal("hide");
                },2000);
              }else if($.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if($.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan, Bulan Ini Sudah Dikunci");
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

      function selesaiPermintaan(param, param2){
        if(confirm("Apakah Anda Yaki Ingin Menyelesaikan Pesanan Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/selesaiPermintaan'); ?>",
            dataType : "TEXT",
            data : {
              idDpb : param,
              idPermintaan : param2
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $(".active a").trigger("click");
                },2000);
              }else if($.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
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

      function terimaSparePartFull(param, param2){
        var namaSupplier = $("#txtNamaSupplier").val();
        var tglTerima = $("#txtTglTerima").val();

        if(namaSupplier=="" || tglTerima==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/terimaSparePartFull'); ?>",
            dataType : "TEXT",
            data : {
              idDpsp         : param,
              idPermintaan   : param2,
              namaSupplier   : namaSupplier,
              tglTerima      : tglTerima
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $(".active a").trigger("click");
                  $("input").val("");
                  $(".date").datepicker("setDate",null);
                  $("#modalInputPenerimaanBarang").modal("hide");
                },2000);
              }else if($.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if($.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan, Bulan Ini Sudah Dikunci");
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

      function terimaSparePartSetengah(param, param2){
        var namaSupplier = $("#txtNamaSupplier").val();
        var tglTerima = $("#txtTglTerima").val();
        var jumlahTerima = $("#txtJumlahPenerimaan").val().replace(/,/gi,"");

        if(namaSupplier=="" || tglTerima=="" || jumlahTerima==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/terimaSparePartSetengah'); ?>",
            dataType : "TEXT",
            data : {
              idDpsp         : param,
              idPermintaan   : param2,
              namaSupplier   : namaSupplier,
              tglTerima      : tglTerima,
              jumlahTerima   : jumlahTerima
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $(".active a").trigger("click");
                  $("input").val("");
                  $(".date").datepicker("setDate",null);
                  $("#modalInputPenerimaanBarang").modal("hide");
                },2000);
              }else if($.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if($.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan, Bulan Ini Sudah Dikunci");
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

      function selesaiPermintaanSparePart(param, param2){
        if(confirm("Apakah Anda Yaki Ingin Menyelesaikan Pesanan Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/selesaiPermintaanSparePart'); ?>",
            dataType : "TEXT",
            data : {
              idDpsp : param,
              idPermintaan : param2
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $(".active a").trigger("click");
                },2000);
              }else if($.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
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

      function addDataAwal(param){
        var kdGdBahan = $("#cmbBarang").val();
        var jumlahDataAwal = $("#txtJumlahDataAwal").val().replace(/,/gi,"");
        var jenis = param.replace(/_/gi," ");
        if(kdGdBahan=="" || jumlahDataAwal==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/addDataAwal'); ?>",
            dataType : "TEXT",
            data : {
              kdGdBahan : kdGdBahan,
              jumlahPermintaan : jumlahDataAwal,
              jenis : jenis
            },
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListDataAwalPending(jenis);
                },2000);
              }else if(jQuery.trim(response)==="Item Kosong"){
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Item Transaksi Masih Kosong!");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-warning");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Parameter Kosong Hub. IT");
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

      function saveDataAwal(param){
        if(confirm("Apakah Anda Yakin Tidak Ada Yang Salah?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url("_gudangbahan/main/saveDataAwal") ?>",
            dataType : "TEXT",
            data : {
              jenis : param.replace(/_/gi," ")
            },
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListDataAwalPending(param.replace(/_/gi," "));
                },2000);
              }else if(jQuery.trim(response)==="Item Kosong"){
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Item Transaksi Masih Kosong!");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-warning");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Parameter Kosong Hub. IT");
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

      function addDataAwalSparePart(){
        var kdSparePart = $("#cmbBarang").val();
        var jumlah = $("#txtJumlahDataAwal").val().replace(/,/gi,"");
        if(kdSparePart=="" || jumlah==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/addDataAwalSparePart') ?>",
            dataType : "TEXT",
            data : {
              kdSparePart : kdSparePart,
              jumlah : jumlah
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListDataAwalSparePartPending();
                },2000);
              }else if($.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
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

      function saveDataAwalSparePart(){
        if(confirm("Apakah Anda Yakin Tidak Ada Yang Salah?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url("_gudangbahan/main/saveDataAwalSparePart") ?>",
            dataType : "TEXT",
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListDataAwalSparePartPending();
                },2000);
              }else if(jQuery.trim(response)==="Item Kosong"){
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Item Transaksi Masih Kosong!");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-warning");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Parameter Kosong Hub. IT");
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
      //============================================SAVE METHOD (Finish)============================================//

      //============================================EDIT METHOD (Start)============================================//

      function editPembelianGudangBahanTemp(param, param2){
        var kdPermintaan1 = $("#txtKdPermintaan").val();
        var tanggal1 = $("#txtTanggalBeli").val();
        // var nama1 = $("#txtNamaCustomer").val();
        var namaBahan1 = $("#txtNamaBahan").val();
        var kdGdBahan1 = $("#cmbGudangBahan").val();
        var jumlahPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g , "");
        var keterangan1 = $("#txtKeterangan").val();

        if(tanggal1==""||jumlahPermintaan1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editPembelianGudangBahanTemp",
            dataType : "TEXT",
            data : {kdGdBahan         : kdGdBahan1,
                    tanggal           : tanggal1,
                    jumlahPermintaan  : jumlahPermintaan1,
                    namaBahan         : namaBahan1,
                    kdPermintaan      : kdPermintaan1,
                    keterangan        : keterangan1,
                    rowId             : param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Item Pembelian Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormPembelian(param2.replace(/_/gi," "));
                  tableListPembelianBahanBakuTemp(param2.replace(/_/gi," "));
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Item Pembelian Gagal Diubah");
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

      function editPembelianSparePartTemp(param, param2){
        var kdPermintaan1 = $("#txtKdPermintaan").val();
        var tanggal1 = $("#txtTanggalBeli").val();
        // var nama1 = $("#txtNamaCustomer").val();
        var namaBahan1 = $("#txtNamaBahan").val();
        var kdGdBahan1 = $("#cmbGudangBahan").val();
        var jumlahPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g , "");
        var keterangan1 = $("#txtKeterangan").val();

        if(tanggal1==""||jumlahPermintaan1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editPembelianSparePartTemp",
            dataType : "TEXT",
            data : {kdGdBahan         : kdGdBahan1,
                    tanggal           : tanggal1,
                    jumlahPermintaan  : jumlahPermintaan1,
                    namaBahan         : namaBahan1,
                    kdPermintaan      : kdPermintaan1,
                    keterangan        : keterangan1,
                    rowId             : param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Item Pembelian Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormPembelianSparePart();
                  tableListPembelianSparePartTemp();
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Item Pembelian Gagal Diubah");
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

      function editBahanBaku(){
        var kdGdBahan1 = $("#txtKdBahan").val();
        var kdAccurate1 = $("#txtKdAccurate").val();
        var nmBarang1 = $("#txtNamaBahanBaru").val();
        var stok1 = $("#txtStok").val().replace(/,/g , "");
        var satuan1 = $("#cmbSatuan").val();
        var warna1 = $("#txtWarna").val();
        var tglMasuk1 = $("#txtTanggal").val();
        var status1 = $("#cmbStatus").val();

        if(kdGdBahan1=="" || nmBarang1=="" || stok1=="" ||
           satuan1=="" || tglMasuk1=="" || status1==""
         ){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editGudangBahan",
            dataType : "TEXT",
            data : {kdGdBahan:kdGdBahan1,kdAccurate:kdAccurate1,nmBarang:nmBarang1,
                    stok:stok1,satuan:satuan1,warna:warna1,tglMasuk:tglMasuk1,status:status1},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormTambahBahanBaku();
                  datatableListBahanBaku();
                  datatableListBijiWarna();
                  datatableListMinyak();
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
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
                $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
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

      function editKoreksiTemp(param,param2){
        var tglKoreksi1 = $('[id="txtTanggalKoreksi"]').val();
        var kdGdBahan1 = $('[id="cmbBahan"]').val();
        var namaBahan1 = $('[id="txtNamaBahan"]').val();
        var jumlahKoreksi1 = $('[id="txtJumlahKoreksi"]').val().replace(/,/g , "");
        var jenisKoreksi1 = $('[id="cmbJenisKoreksi"]').val();
        var keterangan1 = $('[id="cmbKeterangan"]').val();

        if(tglKoreksi1 =="" || namaBahan1 == "" ||
           jumlahKoreksi1 =="" || jenisKoreksi1 == "" || keterangan1 ==""){
             $("#modal-notif").addClass("modal-warning");
             $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
             $("#modal-notif").modal("show");
             setTimeout(function(){
               $("#modal-notif").modal("hide");
               $("#modal-notif").removeClass("modal-warning");
               $("#modalNotifContent").text("");
             },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editKoreksiTemp",
            dataType : "TEXT",
            data :{
                   id : param,
                   tglKoreksi : tglKoreksi1,
                   kdGdBahan : kdGdBahan1,
                   nmBahanBaku : namaBahan1,
                   jumlahKoreksi : jumlahKoreksi1,
                   jenisKoreksi : jenisKoreksi1,
                   keterangan : keterangan1
                 },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Koreksi Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormKoreksi(param2);
                  tableListKoreksi(param2);
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Koreksi Gagal Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                });
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
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

      function editHistoryGudangBahan(param,param2,param3,param4){
        var id1 = param;
        var tglTransaksi1 = $('[id="txtTanggalHistory"]').val();
        var kdGdBahan1 = param4;
        var kdGdBahan2 = $("#cmbBahanEditHistory").val();
        var jumlah1 = $('[id="txtJumlah"]').val().replace(/,/g , "");
        if(id1==""||tglTransaksi1==""||jumlah1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editHistoryGudangBahan",
            dataType : "TEXT",
            data : {id:id1,kdGdBahan:kdGdBahan1,kdGdBahan2:kdGdBahan2,tglTransaksi:tglTransaksi1,jumlah:jumlah1,
                    tglAwal:param2,tglAkhir:param3},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data History Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableSearchHistoryBahanBaku(param2,param3,param4);
                  datatableSearchHistoryBijiWarna(param2,param3,param4);
                  datatableSearchHistoryMinyak(param2,param3,param4);
                  datatableSearchHistoryCatCampur(param2,param3,param4);
                  datatableSearchHistoryCatMurni(param2,param3,param4);
                  $("#modalEditHistory").modal("hide");
                },2000);
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data History Gagal Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
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

      function editPengeluaran(param,param2){
        var kdGdBahan1 = $("#cmbBarang").val();
        var tanggal1 = $("#txtTanggalPengeluaran").val();
        var jumlah1 = $("#txtJumlahPengeluaran").val().replace(/,/g , "");
        var keterangan1 = $("#keterangan").val();

        if(param==""||tanggal1==""||jumlah1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editPengeluaran",
            dataType : "TEXT",
            data : {id:param,kdGdBahan:kdGdBahan1,tanggal:tanggal1,jumlah:jumlah1,keterangan:keterangan1},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Pengeluaran Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tablePengeluaranGudangBahan(param2);
                  resetFormPengeluaran(param2);
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Pengeluaran Gagal Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
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

      function editPenjualanApalTemp(param){
        var tanggal1 = $("#txtTanggalJual").val();
        var nama1 = $("#txtNamaCustomer").val();
        var kdGdApal1 = $("#cmbGudangApal").val();
        var jumlah1 = $("#txtJumlahPermintaan").val().replace(/,/g , "");

        if(tanggal1==""||jumlah1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editPenjualanApalTemp",
            dataType : "TEXT",
            data : {id:param,tanggal:tanggal1,nama:nama1,kdGdApal:kdGdApal1,jumlah:jumlah1},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Penjualan Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPenjualanApalTemp();
                  resetFormPenjualanApal();
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Penjualan Gagal Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
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

      function editHistoryGudangApal(param,param2,param3,param4){
        var id1 = param;
        var nama = $("#txtNama").val();
        var tglTransaksi1 = $('[id="txtTanggalHistory"]').val();
        var kdGdApal1 = param4;
        var kdGdApal2 = $("#cmbGudangApal3").val();
        var jumlah1 = $('[id="txtJumlah"]').val().replace(/,/g , "");
        if(id1==""||tglTransaksi1==""||jumlah1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editHistoryGudangApal",
            dataType : "TEXT",
            data : {id:id1,kdGdApal:kdGdApal1,kdGdApal2:kdGdApal2,
                    tglTransaksi:tglTransaksi1,jumlah:jumlah1,tglAwal:param2,
                    tglAkhir:param3},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("History Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableSearchHistoryGudangApal(param2,param3,param4);
                  resetFormHistoryGudangApal();
                  $("#modalEditHistory").modal("hide");
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("History Gagal Diubah");
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
            }
          });
        }
      }

      function editKoreksiApalTemp(param){
        var tanggal1 = $("#txtTanggalKoreksi").val();
        var kdGdApal1 = $("#cmbGudangApal4").val();
        var jumlah1 = $("#txtJumlahKoreksi").val().replace(/,/g , "");
        var jenisKoreksi1 = $("#cmbJenisKoreksi").val();
        var ketarangan1 = null;
        if(jQuery.trim($("#cmbKeterangan").val()) === "CUSTOM"){
          ketarangan1 = $(".textKeterangan").val();
        }else{
          ketarangan1 = $(".comboKeterangan").val();
        }
        if(tanggal1==""||jumlah1==""||jenisKoreksi1==""||ketarangan1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editKoreksiApalTemp",
            dataType : "TEXT",
            data : {tanggal:tanggal1,kdGdApal:kdGdApal1,jumlah:jumlah1,
                    jenisKoreksi:jenisKoreksi1,keterangan:ketarangan1,id:param},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Koreksi Apal Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListKoreksiApalTemp();
                  resetFormKoreksiApal();
                },2000);
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Koreksi Apal Gagal Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
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

      function editDataAwalApal(param,param2){
        var jumlah = $("#txtJumlahApal").val().replace(/,/g,"");
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/editDataAwalApal",
          dataType : "TEXT",
          data : {id:param,jumlah:jumlah,kdGdApal:param2},
          success : function(response){
            if(jQuery.trim(response)==="Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Data Berhasil Diubah");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                resetFormUbahDataAwalApal();
                datatableListApal();
              },2000);
            }else if(jQuery.trim(response)==="Gagal"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Data Gagal Diubah");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else if(jQuery.trim(response)==="Lock"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Tanggal Transaksi Tersebut Sudah Di Lock");
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

      function editSparePart(){
        var kdSparePart1 = $("#txtKdSparePart").val();
        var kdAccurate1 = $("#txtKodeAccurate").val();
        var tanggal1 = $("#txtTanggalBuat").val();
        var namaBarang1 = $("#txtNamaBarang").val();
        var kode1 = $("#txtKode").val();
        var ukuran1 = $("#txtUkuran").val();
        if(kdSparePart1==""||tanggal1==""||namaBarang1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editSparePart",
            dataType : "TEXT",
            data : {kdSparePart:kdSparePart1,kdAccurate:kdAccurate1,
                    tanggal:tanggal1,namaBarang:namaBarang1,
                    kode:kode1,ukuran:ukuran1},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Spare Part Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormTambahSparePartBaru();
                  datatableListSparePart();
                },2000);
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Spare Part Gagal Diubah");
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

      function editPengeluaranSparePartTemp(param){
        var tanggal1 = $("#txtTglPengeluaran").val();
        var kdSparePart1 = $("#cmbSparePart2").val();
        var jumlah1 = $("#txtJumlahPengeluaran").val().replace(/,/g,"");
        var keterangan1 = $("#cmbKeteranganPengeluaran").val();

        if(tanggal1==""||jumlah1==""||keterangan1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editPengeluaranSparePartTemp",
            dataType : "TEXT",
            data : {tanggal           : tanggal1,
                    kdSparePart       : kdSparePart1,
                    jumlah            : jumlah1,
                    keteranganHistory : keterangan1,
                    id                : param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormPengeluaranSparePart();
                  tableListPengeluaranSparePartTemp();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Diubah");
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

      function editKoreksiSparePartTemp(param){
        var tanggal1 = $("#txtTanggalKoreksi").val();
        var kdSparePart1 = $("#cmbSparePart3").val();
        var jumlah1 = $("#txtJumlahKoreksi").val().replace(/,/g,"");
        var jenisKoreksi1 = $("#cmbJenisKoreksi").val();
        var keterangan1 = $("#cmbKeterangan").val();

        if(tanggal1==""||jumlah1==""||jenisKoreksi1==""||keterangan1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editKoreksiSparePartTemp",
            dataType : "TEXT",
            data : {kdSparePart       : kdSparePart1,
                    tanggal           : tanggal1,
                    jumlah            : jumlah1,
                    jenisKoreksi      : jenisKoreksi1,
                    keteranganHistory : keterangan1,
                    idTransaksi       : param},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormKoreksiSparePart();
                  tableListKoreksiSparePartTemp();
                },2000);
              }else if(jQuery.trim(response)==="Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bulan Ini Sudah Di Kunci");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                });
              }else if(jQuery.trim(response)==="Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Diubah");
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

      function editHistorySparePart(param,param2,param3,param4){
        var tanggal1 = $("#txtTanggalHistory").val();
        var kdSparePart1 = $("#cmbSparePart4").val();
        var jumlah1 = $("#txtJumlahHistory").val().replace(/,/g,"");
        if(tanggal1==""||jumlah1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/editHistorySparePart",
            dataType : "TEXT",
            data : {tanggal       : tanggal1,
                    kdSparePart   : param4,
                    jumlah        : jumlah1,
                    tglAwal       : param2,
                    tglAkhir      : param3,
                    kdSparePart2  : kdSparePart1,
                    id            : param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $("#modalEditHistorySparePart").modal("hide");
                  datatableSearchHistorySparePart(param2,param3,param4);
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Diubah");
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

      function editDataForApprove(param,param2,param3){
        var jumlah1 = $("#txtJumlahForApprove").val().replace(/,/g,"");
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/editDataForApprove",
          dataType : "TEXT",
          data : {id:param,jumlah:jumlah1},
          success : function(response){
            if(jQuery.trim(response)==="Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Transaksi Berhasil Diubah");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                datatableListApproveBahanBakuExtruder(param2,param3.replace("_"," "));
                $("#modalEditDataForApprove").modal("hide");
              },2000);
            }else if(jQuery.trim(response)==="Gagal"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Transaksi Gagal Diubah");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else{
              $("#modal-notif").addClass("modal-warning");
              $("#modalNotifContent").text("Kolom Berwarna Kuning Tidak Boleh Kosong!");
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

      function editDataApalForApprove(param){
        var jumlah1 = $("#txtJumlahForApprove").val().replace(/,/g,"");
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/editDataApalForApprove",
          dataType : "TEXT",
          data : {id:param,jumlah:jumlah1},
          success : function(response){
            if(jQuery.trim(response)==="Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Transaksi Berhasil Diubah");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                datatableListApproveGudangApal();
                $("#modalEditDataForApprove").modal("hide");
              },2000);
            }else if(jQuery.trim(response)==="Gagal"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Transaksi Gagal Diubah");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else{
              $("#modal-notif").addClass("modal-warning");
              $("#modalNotifContent").text("Kolom Berwarna Kuning Tidak Boleh Kosong!");
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

      function editDataPembelianForApprove(param,param2){
        var jumlah1 = $("#txtJumlahForApprove").val().replace(/,/g,"");
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/editDataForApprove",
          dataType : "TEXT",
          data : {id:param,jumlah:jumlah1},
          success : function(response){
            if(jQuery.trim(response)==="Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Transaksi Berhasil Diubah");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                datatableListApprovePembelianBahanBaku(param2.replace("_"," "));
                $("#modalEditDataForApprove").modal("hide");
              },2000);
            }else if(jQuery.trim(response)==="Gagal"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Transaksi Gagal Diubah");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-danger");
                $("#modalNotifContent").text("");
              },2000);
            }else{
              $("#modal-notif").addClass("modal-warning");
              $("#modalNotifContent").text("Kolom Berwarna Kuning Tidak Boleh Kosong!");
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

      function editDataAwal(param, param2){
        var jumlah = $("#txtJumlahDataAwal").val().replace(/,/gi,"");
        $.ajax({
          type : "POST",
          url : "<?php echo base_url('_gudangbahan/main/editDataAwal') ?>",
          dataType : "TEXT",
          data : {
            idTransaksi : param,
            kdBarang : param2,
            jumlah : jumlah
          },
          success : function(response){
            if($.trim(response) === "Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Transaksi Berhasil Diubah");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                $("#txtJumlahDataAwal").val("");
                $("#cmbBarang").val("").trigger("change").trigger("select2:unselect");
              },2000);
            }else{
              ("#modal-danger").addClass("modal-danger");
              $("#modalNotifContent").text("Transaksi Gagal Diubah");
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

      function editDataAwalSparePart(param, param2){
        var jumlah = $("#txtJumlahDataAwal").val().replace(/,/gi,"");
        $.ajax({
          type : "POST",
          url : "<?php echo base_url('_gudangbahan/main/editDataAwalSparePart') ?>",
          dataType : "TEXT",
          data : {
            idTransaksi : param,
            kdSparePart : param2,
            jumlah : jumlah
          },
          success : function(response){
            if($.trim(response) === "Berhasil"){
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Transaksi Berhasil Diubah");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                $("#txtJumlahDataAwal").val("");
                $("#cmbBarang").val("").trigger("change").trigger("select2:unselect");
              },2000);
            }else{
              ("#modal-danger").addClass("modal-danger");
              $("#modalNotifContent").text("Transaksi Gagal Diubah");
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
      //============================================EDIT METHOD (Finish)============================================//

      //============================================DELETE METHOD (Start)============================================//
      function deleteGudangBahan(param){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/deleteGudangBahan",
            dataType : "TEXT",
            data : {kdGdBahan:param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Bahan Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableListBahanBaku();
                  datatableListBijiWarna();
                  datatableListMinyak();
                  reloadTrash();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bahan Gagal Dihapus");
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

      function deletePembelianTemp(param,param2){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url() ?>_gudangbahan/main/removePembelianTemp",
            dataType : "TEXT",
            data : {rowId:param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Pembelian Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  switch (param2) {
                    case "BIJI_WARNA":tableListPembelianBahanBakuTemp(param2.replace(/_/gi," "));break;
                    case "MINYAK":tableListPembelianBahanBakuTemp(param2.replace(/_/gi," "));break;
                    default: tableListPembelianSparePartTemp(); break;
                  }

                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Pembelian Berhasil Dihapus");
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

      function deleteKoreksiTemp(param,param2){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/deleteTransaksiGudangBahan",
            dataType : "TEXT",
            data : {id:param},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  reloadTrash();
                  tableListKoreksi(param2);
                  tablePengeluaranGudangBahan(param2);
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Gagal Dihapus");
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

      function deleteTransaksiGudangBahan(param,param2,param3,param4,param5){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/deleteTransaksiGudangBahan",
            dataType : "TEXT",
            data : {id:param,kdGdBahan:param4,tglAwal:param3},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  switch (param5) {
                    case "BAHAN_BAKU" : datatableSearchHistoryBahanBaku(param2,param3,param4);break;
                    case "BIJI_WARNA" : datatableSearchHistoryBijiWarna(param2,param3,param4);break;
                    case "MINYAK"     : datatableSearchHistoryMinyak(param2,param3,param4);break;
                    case "CAT_CAMPUR" : datatableSearchHistoryCatCampur(param2,param3,param4);break;
                    case "CAT_MURNI"  : datatableSearchHistoryCatMurni(param2,param3,param4);break;
                    default:break;
                  }
                  reloadTrash();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Berhasil Dihapus");
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

      function deletePenjualanApalTemp(param){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/deleteTransaksiGudangApal",
            dataType : "TEXT",
            data : {id:param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Penjualan Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  reloadTrash();
                  tableListPenjualanApalTemp();
                  tableListKoreksiApalTemp();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Penjualan Gagal Dihapus");
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

      function deleteTransaksiGudangApal(param,param2,param3,param4){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/deleteTransaksiGudangApal",
            dataType : "TEXT",
            data : {id:param,kdGdApal:param4,tglAwal:param3},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableSearchHistoryGudangApal(param2,param3,param4);
                  reloadTrash();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Dihapus");
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

      function deleteSparePart(param){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/deleteSparePart",
            dataType : "TEXT",
            data : {kdSparePart:param},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Spare Part Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableListSparePart();
                  reloadTrash();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Spare Part Gagal Dihapus");
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

      function deleteTransaksiSparePart(param,param2,param3,param4){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Transaksi Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/deleteTransaksiSparePart",
            dataType : "TEXT",
            data : {id:param,kdSparePart:param4},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableSearchHistorySparePart(param2,param3,param4);
                  reloadTrash();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Dihapus");
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

      function deleteTransaksiSparePartTemp(param){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Transaksi Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/deleteTransaksiSparePartTemp",
            dataType : "TEXT",
            data : {id:param},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPengeluaranSparePartTemp();
                  tableListKoreksiSparePartTemp();
                  reloadTrash();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Dihapus");
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

      function deleteTransaksiGudangBahanForApprove(param,param2="",param3=""){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/deleteTransaksiGudangBahan",
            dataType : "TEXT",
            data : {id:param},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  reloadTrash();
                  if(param2 != ""){
                    datatableListApproveBahanBakuExtruder(param2,param3.replace("_"," "));
                  }else{
                    datatableListApprovePembelianBahanBaku(param3.replace("_"," "));
                  }
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Dihapus");
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

      function deleteTransaksiGudangApalForApprove(param){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/deleteTransaksiGudangApal",
            dataType : "TEXT",
            data : {id:param},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  reloadTrash();
                  datatableListApproveGudangApal();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Dihapus");
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

      function deleteAndRestorePermintaanBarang(param, param2){
        if(param2 == "TRUE"){
          teksKonfirmasi = "Apakah Anda Yakin Ingin Menghapus Permintaan Ini?";
          textBerhasil = "Data Berhasil Dihapus";
          textGagal = "Data Gagal Dihapus";
        }else{
          teksKonfirmasi = "Apakah Anda Yakin Ingin Mengembalikan Permintaan Ini?";
          textBerhasil = "Data Berhasil Dipulihkan";
          textGagal = "Data Gagal Dipulihkan";
        }
        if(confirm(teksKonfirmasi)){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/deleteAndRestorePermintaanBarang'); ?>",
            dataType : "TEXT",
            data : {
              idTransaksi : param,
              deleted     : param2
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text(textBerhasil);
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $(".active a").trigger("click");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text(textGagal);
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

      function deleteAndRestorePermintaanSparePart(param, param2){
        if(param2 == "TRUE"){
          teksKonfirmasi = "Apakah Anda Yakin Ingin Menghapus Permintaan Ini?";
          textBerhasil = "Data Berhasil Dihapus";
          textGagal = "Data Gagal Dihapus";
        }else{
          teksKonfirmasi = "Apakah Anda Yakin Ingin Mengembalikan Permintaan Ini?";
          textBerhasil = "Data Berhasil Dipulihkan";
          textGagal = "Data Gagal Dipulihkan";
        }
        if(confirm(teksKonfirmasi)){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/deleteAndRestorePermintaanSparePart'); ?>",
            dataType : "TEXT",
            data : {
              idTransaksi : param,
              deleted     : param2
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text(textBerhasil);
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $(".active a").trigger("click");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text(textGagal);
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

      function deleteAndRestoreDetailPermintaanBarang(param, param2, param3){
        if(param3 == "TRUE"){
          teksKonfirmasi = "Apakah Anda Yakin Ingin Menghapus Permintaan Ini?";
          textBerhasil = "Data Berhasil Dihapus";
          textGagal = "Data Gagal Dihapus";
        }else{
          teksKonfirmasi = "Apakah Anda Yakin Ingin Mengembalikan Permintaan Ini?";
          textBerhasil = "Data Berhasil Dipulihkan";
          textGagal = "Data Gagal Dipulihkan";
        }
        if(confirm(teksKonfirmasi)){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/deleteAndRestoreDetailPermintaanBarang'); ?>",
            dataType : "TEXT",
            data : {
              idTransaksi  : param,
              kdPermintaan : param2,
              deleted      : param3
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text(textBerhasil);
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $(".active a").trigger("click");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text(textGagal);
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

      function deleteAndRestoreDetailPermintaanSparePart(param, param2, param3){
        if(param3 == "TRUE"){
          teksKonfirmasi = "Apakah Anda Yakin Ingin Menghapus Permintaan Ini?";
          textBerhasil = "Data Berhasil Dihapus";
          textGagal = "Data Gagal Dihapus";
        }else{
          teksKonfirmasi = "Apakah Anda Yakin Ingin Mengembalikan Permintaan Ini?";
          textBerhasil = "Data Berhasil Dipulihkan";
          textGagal = "Data Gagal Dipulihkan";
        }
        if(confirm(teksKonfirmasi)){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/deleteAndRestoreDetailPermintaanSparePart'); ?>",
            dataType : "TEXT",
            data : {
              idTransaksi  : param,
              kdPermintaan : param2,
              deleted      : param3
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text(textBerhasil);
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $(".active a").trigger("click");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text(textGagal);
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

      function deleteAndRestoreListDataAwalPending(param, param2, param3){
        if(param3 == "TRUE"){
          teksKonfirmasi = "Apakah Anda Yakin Ingin Menghapus Data Ini?";
          textBerhasil = "Data Berhasil Dihapus";
          textGagal = "Data Gagal Dihapus";
        }else{
          teksKonfirmasi = "Apakah Anda Yakin Ingin Mengembalikan Data Ini?";
          textBerhasil = "Data Berhasil Dikembalikan";
          textGagal = "Data Gagal Dikembalikan";
        }

        if(confirm(teksKonfirmasi)){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/deleteAndRestoreListDataAwalPending'); ?>",
            dataType : "TEXT",
            data : {
              id : param,
              deleted : param3
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text(textBerhasil);
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListDataAwalPending(param2.replace(/_/gi," "));
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text(textGagal);
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

      function deleteAndRestoreListDataAwalSparePartPending(param,param2){
        if(param2 == "TRUE"){
          teksKonfirmasi = "Apakah Anda Yakin Ingin Menghapus Data Ini?";
          textBerhasil = "Data Berhasil Dihapus";
          textGagal = "Data Gagal Dihapus";
        }else{
          teksKonfirmasi = "Apakah Anda Yakin Ingin Mengembalikan Data Ini?";
          textBerhasil = "Data Berhasil Dikembalikan";
          textGagal = "Data Gagal Dikembalikan";
        }

        if(confirm(teksKonfirmasi)){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudangbahan/main/deleteAndRestoreListDataAwalSparePartPending'); ?>",
            dataType : "TEXT",
            data : {
              idTransaksi : param,
              deleted : param2
            },
            success : function(response){
              if($.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text(textBerhasil);
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListDataAwalSparePartPending();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text(textGagal);
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
      //============================================DELETE METHOD (Finish)============================================//

      //============================================RESET METHOD (Start)============================================//
      function resetFormTambahBahanBaku(){
        $("#txtKdBahan").val("");
        $("#txtKdAccurate").val("");
        $("#txtNamaBahanBaru").val("");
        $("#txtStok").val("").removeAttr("readonly");
        $("#cmbSatuan").val("KG");
        $("#txtWarna").val("");
        $("#txtTanggal").val("");
        $("#cmbStatus").val("LOKAL");
        $('.date').datepicker("setDate",null);

        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/getGeneratedGudangBahanCode",
          dataType : "JSON",
          success : function(response){
            $("#txtKdBahan").val(response.Code);
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

      function resetFormTambahBijiWarna(){
        $("#txtKdBahan").val("");
        $("#txtKdAccurate").val("");
        $("#txtNamaBahanBaru").val("");
        $("#txtStok").val("");
        $("#cmbSatuan").val("KG");
        $("#txtWarna").val("");
        $("#txtTanggal").val("");
        $("#cmbStatus").val("LOKAL");
        $('.date').datepicker("setDate",null);

        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/getGeneratedGudangBahanCode",
          dataType : "JSON",
          success : function(response){
            $("#txtKdBahan").val(response.Code);
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

      function resetFormPembelian(param){
        $("#txtTanggalBeli").val("");
        $('.date').datepicker("setDate",null);
        $("#txtNamaCustomer").val("");
        $("#cmbGudangBahan").val("").trigger("change");
        $("#txtNamaBahan").val("");
        $("#txtJumlahPermintaan").val("").attr("readonly","readonly");
        $("#txtKeterangan").val("");
        $("#btnTambahPembelian").attr("onclick","saveCartPembelian('"+param+"');").text("Tambah");
      }

      function resetFormPembelianSparePart(){
        $("#txtTanggalBeli").val("");
        $('.date').datepicker("setDate",null);
        $("#txtNamaCustomer").val("");
        $("#cmbGudangBahan").val("").trigger("change");
        $("#txtNamaBahan").val("");
        $("#txtJumlahPermintaan").val("").attr("readonly","readonly");
        $("#txtKeterangan").val("");
        $("#btnTambahPembelian").attr("onclick","saveCartPembelianSparePart();").text("Tambah");
      }

      function resetFormKoreksi(param){
        $('.date').datepicker("setDate",null);
        $("input[type='text']").val("");
        $("#cmbJenisKoreksi").val("#").trigger("change");
        $("#cmbBahan").val("").trigger("change");
        $("#btnAddKoreksi").attr("onclick","saveCartKoreksi('"+param+"')").html("<span class='fa fa-plus'></span> Simpan");
      }

      function resetFormPengeluaran(param){
        $("#txtTanggalPengeluaran").val("");
        $("#cmbBarang").val("").trigger("change");
        $("#txtNamaBarang").val("");
        $("#txtJumlahPengeluaran").val("").attr("readonly","readonly");
        $("#keterangan").val("");
        $("#btnAddPengeluaran").removeAttr("onclick").attr("onclick","savePengeluaranTemp('"+param+"')").html("<i class='fa fa-plus'></i> Tambah");
      }

      function resetFormTambahApal(){
        $("#txtKdApal").val("");
        $("#txtKdAccurate").val("");
        $("#cmbJenisApal").val("").trigger("change");
        $("#cmbSubJenis").val("");
        $("#txtStok").val("");
        $('.date').datepicker("setDate",null);
        $("#btnSimpanApalBaru").removeAttr("onclick").attr("onclick","saveApal()").removeClass("btn-warning").addClass("btn-success").text("Simpan Apal");
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/getGeneratedGudangApalCode",
          dataType : "JSON",
          success : function(response){
            $("#txtKdApal").val(response.Code);
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

      function resetFormPenjualanApal(){
        $('.date').datepicker("setDate",null);
        $("#txtNamaCustomer").val("");
        $("#cmbGudangApal").val("").trigger("change");
        $("#txtJumlahPermintaan").val("");
        $("#txtJumlahPermintaan").attr("readonly","readonly");
        $("#btnTambahPenjualan").removeAttr("onclick").attr("onclick","savePenjualanApalTemp()").text("Tambah");
      }

      function resetFormHistoryGudangApal(){
        $("#txtTanggalHistory").val("");
        $("#txtNama").val("");
        $("#cmbGudangApal3").val("").trigger("change");
        $("#txtSubJenis").val("");
        $("#txtJumlah").val("");
        $('.date').datepicker("setDate",null);
      }

      function resetFormKoreksiApal(){
        $("#txtTanggalKoreksi").val("");
        $("#cmbGudangApal4").val("").trigger("change");
        $("#txtJumlahKoreksi").val("");
        $("#txtJumlahKoreksi").attr("readonly","readonly");
        $("#cmbJenisKoreksi").val("#").trigger("change");
        $('.date').datepicker("setDate",null);
        $("#btnAddKoreksi").attr("onclick","saveKoreksiApalTemp()").removeClass("btn-warning").html("<i class='fa fa-plus'></i> Simpan");
      }

      function resetFormUbahDataAwalApal(){
        $("#txtTanggalPengeluaran").val("");
        $("#txtJenisApal").val("");
        $("#txtSubJenisApal").val("");
        $("#txtJumlahApal").val("").attr("readonly","readonly");
        $("#btnUbahDataAwal").removeAttr("onclick");
        $("#cmbGudangApal5").val("").trigger("change");
      }

      function resetFormTambahSparePartBaru(){
        $("#txtKdSparePart").val("");
        $("#txtKodeAccurate").val("");
        $(".date").datepicker("setDate",null);
        $("#txtNamaBarang").val("");
        $("#txtKode").val("");
        $("#txtUkuran").val("");
        $("#txtStok").val("").removeAttr("readonly");
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/getGeneratedGudangSparePartCode",
          dataType : "JSON",
          success : function(response){
            $("#txtKdSparePart").val(response.Code);
            $("#btnSimpanSparePartBaru").removeAttr("onclick").attr("onclick","saveSparePart()").text("Simpan");
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

      function resetFormPengeluaranSparePart(){
        $(".date").datepicker("setDate",null);
        $("#cmbSparePart2").val("").trigger("change");
        $("#txtNamaSparePart").val("");
        $("#txtJumlahPengeluaran").val("").attr("readonly","readonly");
        $("#cmbKeteranganPengeluaran").val("").trigger("change");
        $("#btnAddPengeluaranSparePart").removeAttr("onclick").attr("onclick","savePengeluaranSparePartTemp()").html("<i class='fa fa-plus'></i> Tambah");
      }

      function resetFormKoreksiSparePart(){
        $(".date").datepicker("setDate",null);
        $("#txtTanggalKoreksi").val("");
        $("#cmbSparePart3").val("").trigger("change");
        $("#txtNamaBarangKoreksi").val("");
        $("#txtJumlahKoreksi").val("").attr("readonly","readonly");
        $("#cmbJenisKoreksi").val("");
        $("#cmbKeterangan").val("");
        $("#btnAddKoreksiSparePart").removeAttr("onclick").attr("onclick","saveKoreksiSparePartTemp()").html("<i class='fa fa-plus'></i> Tambah");
      }
      //============================================RESET METHOD (Finish)============================================//

      //============================================RELOAD METHOD (Start)============================================//
      function reloadTrash(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/getCountTrashGudangBahan",
          dataType : "JSON",
          success : function(response){
            $("#count-trash").text(response.Total);
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

      function reloadAlert(param,param2,param3){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getCountAlert",
          dataType : "JSON",
          data : {bagian : param, jenis : param2},
          success : function(response){
            if(response[0].Jumlah > 0){
              $(param3).addClass("in").removeAttr("style");
            }else{
              $(param3).removeClass("in").attr("style","display:none;");
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

      function reloadAlertPembelian(param,param2){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getCountAlertPembelianGudangBahan",
          dataType : "JSON",
          data : {jenis : param},
          success : function(response){
            if(response[0].Jumlah > 0){
              $(param2).addClass("in").removeAttr("style");
            }else{
              $(param2).removeClass("in").attr("style","display:none;");
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

      function reloadAlertApal(param){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/getCountAlertApal",
          dataType : "JSON",
          success : function(response){
            if(response[0].Jumlah > 0){
              $(param).addClass("in").removeAttr("style");
            }else{
              $(param).removeClass("in").attr("style","display:none;");
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
      //============================================RELOAD METHOD (Finish)============================================//

      //============================================RESTORE METHOD (Start)============================================//
      function restoreGudangBahan(param){
        if(confirm("Apakah Anda Yakin Barang Ini Akan Dikembalikan?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/restoreGudangBahan",
            dataType : "TEXT",
            data : {kdGdBahan : param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Bahan Berhasil Dikembalikan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  reloadTrash();
                  datatableListBahanBaku();
                  datatableListBijiWarna();
                  datatableListMinyak();
                  datatableListTrashGudangBahan();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Bahan Gagal Dikembalikan");
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

      function restoreSparePart(param){
        if(confirm("Apakah Anda Yakin Barang Ini Akan Dikembalikan?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/restoreSparePart",
            dataType : "TEXT",
            data : {kdSparePart : param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Spare Part Berhasil Dikembalikan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  reloadTrash();
                  //datatableListBahanBaku();
                  datatableListTrashSparePart();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Spare Part Gagal Dikembalikan");
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

      function restoreTransaksiGudangBahan(param,param2){
        if(confirm("Apakah Anda Yakin Transaksi Ini Akan Dikembalikan?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/restoreTransaksiGudangBahan",
            dataType : "TEXT",
            data : {id : param,kdGdBahan:param2},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Dikembalikan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  reloadTrash();
                  datatableListTrashTransaksiGudangBahan();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Dikembalikan");
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

      function restoreTransaksiGudangApal(param,param2){
        if(confirm("Apakah Anda Yakin Transaksi Ini Akan Dikembalikan?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/restoreTransaksiGudangApal",
            dataType : "TEXT",
            data : {id : param,kdGdApal:param2},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Dikembalikan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  reloadTrash();
                  datatableListTrashTransaksiGudangApal();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Dikembalikan");
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

      function restoreTransaksiSparePart(param,param2){
        if(confirm("Apakah Anda Yakin Transaksi Ini Akan Dikembalikan?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudangbahan/main/restoreTransaksiSparePart",
            dataType : "TEXT",
            data : {id : param,kdGdSparePart:param2},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Dikembalikan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  reloadTrash();
                  datatableListTrashTransaksiSparePart();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Dikembalikan");
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
      //============================================RESTORE METHOD (Finish)============================================//

      //============================================SEARCH METHOD (Start)============================================//
      function searchHistory(param){
        var tglAwal1 = $("#txtTglAwal").val();
        var tglAkhir1 = $("#txtTglAkhir").val();
        var kdGdBahan1 = $("#cmbBahan1").val();
        var dataText = $("#cmbBahan1").select2("data")[0]["text"];
        var arrDataText = dataText.split(" | ");
        var arrTglAwal = tglAwal1.split("-");
        var arrTglAkhir = tglAkhir1.split("-");
        var arrMonth = ["Januari","Februari","Maret","April","Mei","Juni",
                        "Juli","Agustus","September","Oktober","November","Desember"];
        var dateTglAwal = new Date(arrTglAwal[0],arrTglAwal[1]-1,arrTglAwal[2]);
        var dateTglAkhir = new Date(arrTglAkhir[0],arrTglAkhir[1]-1,arrTglAkhir[2]);
        if(tglAwal1=="" || tglAkhir1=="" || kdGdBahan1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Dan Bahan Baku Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          switch (param) {
            case "BAHAN_BAKU": $("#tableDataMasterBahanBaku").dataTable().fnDestroy();
                               $("#tableDataMasterBahanBaku tbody").empty();
                               $("#tableDataMasterBahanBaku").attr("style","display:none");

                               $("#tableDataHistoryBahanBaku").removeAttr("style");
                               datatableSearchHistoryBahanBaku(tglAwal1,tglAkhir1,kdGdBahan1);
                               $("#infoSaldoWrapper").removeAttr("style");
                               $("#infoFlowWrapper").removeAttr("style");

                               $("#txtTglAwal").val("");
                               $("#txtTglAkhir").val("");
                               $("#cmbBahan1").val("");
                               $('.date').datepicker("setDate",null);
                               $("#modalCheckHistory").modal("hide");
                               $("#txtDetailHistory").text("Detail History "+
                                                            arrDataText[1]+" ( "+
                                                            arrDataText[2]+" ) Tanggal "+
                                                            dateTglAwal.getDate() + " " +
                                                            arrMonth[dateTglAwal.getMonth()] + " "+
                                                            dateTglAwal.getFullYear() +" - " +
                                                            dateTglAkhir.getDate() + " " +
                                                            arrMonth[dateTglAkhir.getMonth()] + " "+
                                                            dateTglAkhir.getFullYear());
                               $("#btnRefreshTableHistory").attr("onclick","datatableSearchHistoryBahanBaku('"+tglAwal1+"','"+tglAkhir1+"','"+kdGdBahan1+"')");
                               break;
            case "BIJI_WARNA": $("#tableDataMasterBijiWarna").dataTable().fnDestroy();
                               $("#tableDataMasterBijiWarna tbody").empty();
                               $("#tableDataMasterBijiWarna").attr("style","display:none");

                               $("#tableDataHistoryBijiWarna").removeAttr("style");
                               datatableSearchHistoryBijiWarna(tglAwal1,tglAkhir1,kdGdBahan1);
                               $("#infoSaldoWrapper").removeAttr("style");
                               $("#infoFlowWrapper").removeAttr("style");

                               $("#txtTglAwal").val("");
                               $("#txtTglAkhir").val("");
                               $("#cmbBahan1").val("");
                               $('.date').datepicker("setDate",null);
                               $("#modalCheckHistory").modal("hide");
                               $("#txtDetailHistory").text("Detail History "+
                                                            arrDataText[1]+" ( "+
                                                            arrDataText[2]+" ) Tanggal "+
                                                            dateTglAwal.getDate() + " " +
                                                            arrMonth[dateTglAwal.getMonth()] + " "+
                                                            dateTglAwal.getFullYear() +" - " +
                                                            dateTglAkhir.getDate() + " " +
                                                            arrMonth[dateTglAkhir.getMonth()] + " "+
                                                            dateTglAkhir.getFullYear());
                               $("#btnRefreshTableHistory").attr("onclick","datatableSearchHistoryBijiWarna('"+tglAwal1+"','"+tglAkhir1+"','"+kdGdBahan1+"')");
                               break;
            case "MINYAK"    : $("#tableDataMasterMinyak").dataTable().fnDestroy();
                               $("#tableDataMasterMinyak tbody").empty();
                               $("#tableDataMasterMinyak").attr("style","display:none");

                               $("#tableDataHistoryMinyak").removeAttr("style");
                               datatableSearchHistoryMinyak(tglAwal1,tglAkhir1,kdGdBahan1);
                               $("#infoSaldoWrapper").removeAttr("style");
                               $("#infoFlowWrapper").removeAttr("style");

                               $("#txtTglAwal").val("");
                               $("#txtTglAkhir").val("");
                               $("#cmbBahan1").val("");
                               $('.date').datepicker("setDate",null);
                               $("#modalCheckHistory").modal("hide");
                               $("#txtDetailHistory").text("Detail History "+
                                                            arrDataText[1]+" ( "+
                                                            arrDataText[2]+" ) Tanggal "+
                                                            dateTglAwal.getDate() + " " +
                                                            arrMonth[dateTglAwal.getMonth()] + " "+
                                                            dateTglAwal.getFullYear() +" - " +
                                                            dateTglAkhir.getDate() + " " +
                                                            arrMonth[dateTglAkhir.getMonth()] + " "+
                                                            dateTglAkhir.getFullYear());
                               $("#btnRefreshTableHistory").attr("onclick","datatableSearchHistoryMinyak('"+tglAwal1+"','"+tglAkhir1+"','"+kdGdBahan1+"')");
                               break;
            case "CAT_CAMPUR": $("#tableDataMasterCatCampur").dataTable().fnDestroy();
                               $("#tableDataMasterCatCampur tbody").empty();
                               $("#tableDataMasterCatCampur").attr("style","display:none");

                               $("#tableDataHistoryCatCampur").removeAttr("style");
                               datatableSearchHistoryCatCampur(tglAwal1,tglAkhir1,kdGdBahan1);
                               $("#infoSaldoWrapper").removeAttr("style");
                               $("#infoFlowWrapper").removeAttr("style");

                               $("#txtTglAwal").val("");
                               $("#txtTglAkhir").val("");
                               $("#cmbBahan1").val("");
                               $('.date').datepicker("setDate",null);
                               $("#modalCheckHistory").modal("hide");
                               $("#txtDetailHistory").text("Detail History "+
                                                            arrDataText[1]+" ( "+
                                                            arrDataText[2]+" ) Tanggal "+
                                                            dateTglAwal.getDate() + " " +
                                                            arrMonth[dateTglAwal.getMonth()] + " "+
                                                            dateTglAwal.getFullYear() +" - " +
                                                            dateTglAkhir.getDate() + " " +
                                                            arrMonth[dateTglAkhir.getMonth()] + " "+
                                                            dateTglAkhir.getFullYear());
                               $("#btnRefreshTableHistory").attr("onclick","datatableSearchHistoryCatCampur('"+tglAwal1+"','"+tglAkhir1+"','"+kdGdBahan1+"')");
                               break;
            case "CAT_MURNI" : $("#tableDataMasterCatMurni").dataTable().fnDestroy();
                               $("#tableDataMasterCatMurni tbody").empty();
                               $("#tableDataMasterCatMurni").attr("style","display:none");

                               $("#tableDataHistoryCatMurni").removeAttr("style");
                               datatableSearchHistoryCatMurni(tglAwal1,tglAkhir1,kdGdBahan1);
                               $("#infoSaldoWrapper").removeAttr("style");
                               $("#infoFlowWrapper").removeAttr("style");

                               $("#txtTglAwal").val("");
                               $("#txtTglAkhir").val("");
                               $("#cmbBahan1").val("");
                               $('.date').datepicker("setDate",null);
                               $("#modalCheckHistory").modal("hide");
                               $("#txtDetailHistory").text("Detail History "+
                                                            arrDataText[1]+" ( "+
                                                            arrDataText[2]+" ) Tanggal "+
                                                            dateTglAwal.getDate() + " " +
                                                            arrMonth[dateTglAwal.getMonth()] + " "+
                                                            dateTglAwal.getFullYear() +" - " +
                                                            dateTglAkhir.getDate() + " " +
                                                            arrMonth[dateTglAkhir.getMonth()] + " "+
                                                            dateTglAkhir.getFullYear());
                               $("#btnRefreshTableHistory").attr("onclick","datatableSearchHistoryCatMurni('"+tglAwal1+"','"+tglAkhir1+"','"+kdGdBahan1+"')");
                               break;
            default:break;


          }

        }
      }

      function searchHistoryApal(){
        var tglAwal1 = $("#txtTglAwal").val();
        var tglAkhir1 = $("#txtTglAkhir").val();
        var kdGdApal1 = $("#cmbGudangApal2").val();
        if(tglAwal1=="" || tglAkhir1=="" || kdGdApal1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Dan Bahan Baku Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          var dataText = $("#cmbGudangApal2").select2("data")[0]["text"];
          var arrDataText = dataText.split("-");
          var arrTglAwal = tglAwal1.split("-");
          var arrTglAkhir = tglAkhir1.split("-");
          var arrMonth = ["Januari","Februari","Maret","April","Mei","Juni",
                          "Juli","Agustus","September","Oktober","November","Desember"];
          var dateTglAwal = new Date(arrTglAwal[0],arrTglAwal[1]-1,arrTglAwal[2]);
          var dateTglAkhir = new Date(arrTglAkhir[0],arrTglAkhir[1]-1,arrTglAkhir[2]);
          $("#tableDataMasterApal").dataTable().fnDestroy();
          $("#tableDataMasterApal tbody").empty();
          $("#tableDataMasterApal").attr("style","display:none");
          $("#tableDataHistoryApal").removeAttr("style");
          datatableSearchHistoryGudangApal(tglAwal1,tglAkhir1,kdGdApal1);
          $("#infoSaldoWrapper").removeAttr("style");
          $("#infoFlowWrapper").removeAttr("style");

          $("#txtTglAwal").val("");
          $("#txtTglAkhir").val("");
          $("#cmbGudangApal2").val("").trigger("change");
          $('.date').datepicker("setDate",null);
          $("#modalCheckHistory").modal("hide");
          $("#txtDetailHistory").text("Detail History "+
                                      arrDataText[1]+" ( "+
                                      arrDataText[2]+" ) Tanggal "+
                                      dateTglAwal.getDate() + " " +
                                      arrMonth[dateTglAwal.getMonth()] + " "+
                                      dateTglAwal.getFullYear() +" - " +
                                      dateTglAkhir.getDate() + " " +
                                      arrMonth[dateTglAkhir.getMonth()] + " "+
                                      dateTglAkhir.getFullYear());
          $("#btnRefreshTableHistory").attr("onclick","datatableSearchHistoryGudangApal('"+tglAwal1+"','"+tglAkhir1+"','"+kdGdApal1+"')");
        }
      }

      function searchHistorySparePart(){
        var tglAwal1 = $("#txtTglAwal").val();
        var tglAkhir1 = $("#txtTglAkhir").val();
        var kdSparePart1 = $("#cmbSparePart1").val();

        if(tglAwal1=="" || tglAkhir1=="" || kdSparePart1==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Dan Bahan Baku Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          var dataText = $("#cmbSparePart1").select2("data")[0]["text"];
          var arrDataText = dataText.split(" | ");
          var arrTglAwal = tglAwal1.split("-");
          var arrTglAkhir = tglAkhir1.split("-");
          var arrMonth = ["Januari","Februari","Maret","April","Mei","Juni",
                          "Juli","Agustus","September","Oktober","November","Desember"];
          var dateTglAwal = new Date(arrTglAwal[0],arrTglAwal[1]-1,arrTglAwal[2]);
          var dateTglAkhir = new Date(arrTglAkhir[0],arrTglAkhir[1]-1,arrTglAkhir[2]);
          $("#tableDataMasterSparePart").dataTable().fnDestroy();
          $("#tableDataMasterSparePart tbody").empty();
          $("#tableDataMasterSparePart").attr("style","display:none");
          $("#tableDataHistorySparePart").removeAttr("style");
          datatableSearchHistorySparePart(tglAwal1,tglAkhir1,kdSparePart1);
          $("#infoSaldoWrapper").removeAttr("style");
          $("#infoFlowWrapper").removeAttr("style");

          $("#txtTglAwal").val("");
          $("#txtTglAkhir").val("");
          $("#cmbSparePart1").val("").trigger("change");
          $('.date').datepicker("setDate",null);
          $("#modalCheckHistory").modal("hide");
          $("#txtDetailHistory").text("Detail History "+
                                      arrDataText[1]+" ( "+
                                      arrDataText[2]+" ) Tanggal "+
                                      dateTglAwal.getDate() + " " +
                                      arrMonth[dateTglAwal.getMonth()] + " "+
                                      dateTglAwal.getFullYear() +" - " +
                                      dateTglAkhir.getDate() + " " +
                                      arrMonth[dateTglAkhir.getMonth()] + " "+
                                      dateTglAkhir.getFullYear());
          $("#btnRefreshTableHistory").attr("onclick","datatableSearchHistorySparePart('"+tglAwal1+"','"+tglAkhir1+"','"+kdSparePart1+"')");
        }
      }
      //============================================SEARCH METHOD (Finish)============================================//

      //============================================DATATABLE METHOD (Start)============================================//
      function datatableListBahanBaku(){
        $("#tableDataMasterBahanBaku").dataTable().fnDestroy();
        $("#tableDataMasterBahanBaku").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListGudangBahanDatatable",
          "columns":[
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"},
            {"data" : "nm_barang","name":"nm_barang"},
            {"data" : "stok","name":"stok"},
            {"data" : "warna","name":"warna"},
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"jenis","value":"BAHAN_BAKU"});
            //aoData.push({"name":"bagian","value":"SABLON"});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(0)",nRow).html(aData["kd_gd_bahan"]+" "+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>");
            $("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditGudangBahan('"+aData['kd_gd_bahan']+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteGudangBahan('"+aData['kd_gd_bahan']+"')><span class='fa fa-trash'></span> Hapus</button>");
          }
        });
      }

      function datatableListTrashGudangBahan(){
        $("#tableTrashGudangBahan").dataTable().fnDestroy();
        $("#tableTrashGudangBahan").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListTrashGudangBahanDatatable",
          "columns":[
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"},
            {"data" : "nm_barang","name":"nm_barang"},
            {"data" : "stok","name":"stok"},
            {"data" : "warna","name":"warna"},
            {"data" : "jenis","name":"jenis"},
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"}
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
            $("td:eq(0)",nRow).html(aData["kd_gd_bahan"]+" "+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>");
            $("td:eq(5)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=restoreGudangBahan('"+aData['kd_gd_bahan']+"')>Pulihkan</button>");
          }
        });
      }

      function datatableListTrashSparePart(){
        $("#tableTrashSparePart").dataTable().fnDestroy();
        $("#tableTrashSparePart").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListTrashSparePartDatatable",
          "columns":[
            {"data" : "kd_spare_part","name":"kd_spare_part"},
            {"data" : "nm_spare_part","name":"nm_spare_part"},
            {"data" : "ukuran","name":"ukuran"},
            {"data" : "stok","name":"stok"},
            {"data" : "kd_spare_part","name":"kd_spare_part"}
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
            $("td:eq(0)",nRow).html(aData["kd_spare_part"]+" "+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>");
            $("td:eq(3)",nRow).html(aData["stok"]+" "+"<label class='text-red'>("+aData["stok_aktual"]+")</label>");
            $("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=restoreSparePart('"+aData['kd_spare_part']+"')>Pulihkan</button>");
          }
        });
      }

      function datatableListTrashTransaksiGudangBahan(){
        $("#tableTrashTransaksi").dataTable().fnDestroy();
        $("#tableTrashTransaksi").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListTrashTransaksiGudangBahanDatatable",
          "columns":[
            {"data" : "tgl_permintaan","name":"TGB.tgl_permintaan"},
            {"data" : "nm_barang","name":"TGB.nm_barang"},
            {"data" : "jumlah_permintaan","name":"TGB.jumlah_permintaan"},
            {"data" : "keterangan_history","name":"TGB.keterangan_history"},
            {"data" : "id","name":"TGB.id"}
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
            if(aData['status_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['status_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }

            $("td:eq(4)",nRow).html("<button class='btn btn-md btn-success btn-flat' onclick=restoreTransaksiGudangBahan('"+aData["id"]+"','"+aData["kd_gd_bahan"]+"')>Pulihkan</button>")
          }
        });
      }

      function datatableListTrashTransaksiGudangApal(){
        $("#tableTrashTransaksiGudangApal").dataTable().fnDestroy();
        $("#tableTrashTransaksiGudangApal").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListTrashTransaksiGudangApalDatatable",
          "columns":[
            {"data" : "tgl_transaksi","name":"TDHA.tgl_transaksi"},
            {"data" : "nama","name":"TDHA.nama"},
            {"data" : "jenis","name":"GA.sub_jenis"},
            {"data" : "jumlah_apal","name":"TDHA.jumlah_apal"},
            {"data" : "keterangan_history","name":"TDHA.keterangan_history"},
            {"data" : "id","name":"TDHA.id"}
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
            if(aData['status_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['status_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }
            $("td:eq(2)",nRow).html(aData["jenis"]+" <label>[ "+aData["sub_jenis"]+" ]</label>")
            $("td:eq(5)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=restoreTransaksiGudangApal('"+aData["id"]+"','"+aData["kd_gd_apal"]+"')>Pulihkan</button>");
          }
        });
      }

      function datatableListTrashTransaksiSparePart(){
        $("#tableTrashTransaksiGudangSparePart").dataTable().fnDestroy();
        $("#tableTrashTransaksiGudangSparePart").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListTrashTransaksiSparePartDatatable",
          "columns":[
            {"data" : "tgl_transaksi","name":"TDSP.tgl_transaksi"},
            {"data" : "nm_spare_part","name":"SP.nm_spare_part"},
            {"data" : "jumlah","name":"TDSP.jumlah"},
            {"data" : "keterangan_history","name":"TDSP.keterangan_history"},
            {"data" : "id","name":"TDSP.id"}
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
            if(aData['sts_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['status_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }
            $("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=restoreTransaksiSparePart('"+aData["id"]+"','"+aData["kd_spare_part"]+"')>Pulihkan</button>");
          }
        });
      }

      function datatableSearchHistoryBahanBaku(tglAwal,tglAkhir,kdBahanBaku){
        $("#tableDataHistoryBahanBaku").dataTable().fnDestroy();
        $("#tableDataHistoryBahanBaku").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListHistoryGudangBahan",
          "columns":[
            {"data" : "tgl_permintaan","name":"tgl_permintaan"},
            {"data" : "jumlah_permintaan","name":"jumlah_permintaan"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id","name":"id"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":tglAwal},
                        {"name":"tglAkhir","value":tglAkhir},
                        {"name":"kdGdBahan","value":kdBahanBaku});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(2)",nRow).text(aData["keterangan_history"]+" ("+aData["nama"]+")");
            if(aData['status_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['status_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }

            if(aData["status_lock"] == "TRUE"){
              $("td:eq(3)",nRow).html("<label class='btn btn-md btn-block btn-flat btn-default'><i class='fa fa-lock'></i> BULAN INI SUDAH DI LOCK</label>")
            }else{
              $("td:eq(3)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=modalEditHistory('BAHAN_BAKU','"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdBahanBaku+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiGudangBahan('"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdBahanBaku+"','BAHAN_BAKU')><span class='fa fa-trash'></span> Hapus</button>");
            }
            $("td:eq(3)",nRow).css("background-color","f4f4f4");
          }
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getSaldoAwalBulanGudangBahan",
          dataType : "JSON",
          data : {tglAwal:tglAwal,tglAkhir:tglAkhir,kdGdBahan:kdBahanBaku},
          success : function(response){
            $("#textSaldoAwal").text("Saldo Awal : "+response.saldoAwal);
            $("#textSaldoAkhir").text("Saldo Akhir : "+response.saldoAkhir);
            $("#textBarangMasuk").text("Masuk : "+response.saldoMasuk);
            $("#textBarangKeluar").text("Keluar : "+response.saldoKeluar);
          }
        });
      }

      function datatableSearchHistoryBijiWarna(tglAwal,tglAkhir,kdBahanBaku){
        $("#tableDataHistoryBijiWarna").dataTable().fnDestroy();
        $("#tableDataHistoryBijiWarna").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListHistoryGudangBahan",
          "columns":[
            {"data" : "tgl_permintaan","name":"tgl_permintaan"},
            {"data" : "jumlah_permintaan","name":"jumlah_permintaan"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id","name":"id"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":tglAwal},
                        {"name":"tglAkhir","value":tglAkhir},
                        {"name":"kdGdBahan","value":kdBahanBaku});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(2)",nRow).text(aData["keterangan_history"]+" ("+aData["nama"]+")");
            if(aData['status_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['status_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }

            if(aData["status_lock"] == "TRUE"){
              $("td:eq(3)",nRow).html("<label class='btn btn-md btn-block btn-flat btn-default'><i class='fa fa-lock'></i> BULAN INI SUDAH DI LOCK</label>")
            }else{
              $("td:eq(3)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=modalEditHistory('BIJI_WARNA','"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdBahanBaku+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiGudangBahan('"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdBahanBaku+"','BIJI_WARNA')><span class='fa fa-trash'></span> Hapus</button>");
            }
            $("td:eq(3)",nRow).css("background-color","f4f4f4");
          }
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getSaldoAwalBulanGudangBahan",
          dataType : "JSON",
          data : {tglAwal:tglAwal,tglAkhir:tglAkhir,kdGdBahan:kdBahanBaku},
          success : function(response){
            $("#textSaldoAwal").text("Saldo Awal : "+response.saldoAwal);
            $("#textSaldoAkhir").text("Saldo Akhir : "+response.saldoAkhir);
            $("#textBarangMasuk").text("Masuk : "+response.saldoMasuk);
            $("#textBarangKeluar").text("Keluar : "+response.saldoKeluar);
          }
        });
      }

      function datatableSearchHistoryMinyak(tglAwal,tglAkhir,kdBahanBaku){
        $("#tableDataHistoryMinyak").dataTable().fnDestroy();
        $("#tableDataHistoryMinyak").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListHistoryGudangBahan",
          "columns":[
            {"data" : "tgl_permintaan","name":"tgl_permintaan"},
            {"data" : "jumlah_permintaan","name":"jumlah_permintaan"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id","name":"id"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":tglAwal},
                        {"name":"tglAkhir","value":tglAkhir},
                        {"name":"kdGdBahan","value":kdBahanBaku});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(2)",nRow).text(aData["keterangan_history"]+" ("+aData["nama"]+")");
            if(aData['status_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['status_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }

            if(aData["status_lock"] == "TRUE"){
              $("td:eq(3)",nRow).html("<label class='btn btn-md btn-block btn-flat btn-default'><i class='fa fa-lock'></i> BULAN INI SUDAH DI LOCK</label>")
            }else{
              $("td:eq(3)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=modalEditHistory('MINYAK','"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdBahanBaku+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiGudangBahan('"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdBahanBaku+"','MINYAK')><span class='fa fa-trash'></span> Hapus</button>");
            }
            $("td:eq(3)",nRow).css("background-color","f4f4f4");
          }
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getSaldoAwalBulanGudangBahan",
          dataType : "JSON",
          data : {tglAwal:tglAwal,tglAkhir:tglAkhir,kdGdBahan:kdBahanBaku},
          success : function(response){
            $("#textSaldoAwal").text("Saldo Awal : "+response.saldoAwal);
            $("#textSaldoAkhir").text("Saldo Akhir : "+response.saldoAkhir);
            $("#textBarangMasuk").text("Masuk : "+response.saldoMasuk);
            $("#textBarangKeluar").text("Keluar : "+response.saldoKeluar);
          }
        });
      }

      function datatableSearchHistoryCatCampur(tglAwal,tglAkhir,kdBahanBaku){
        $("#tableDataHistoryCatCampur").dataTable().fnDestroy();
        $("#tableDataHistoryCatCampur").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListHistoryGudangBahan",
          "columns":[
            {"data" : "tgl_permintaan","name":"tgl_permintaan"},
            {"data" : "jumlah_permintaan","name":"jumlah_permintaan"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id","name":"id"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":tglAwal},
                        {"name":"tglAkhir","value":tglAkhir},
                        {"name":"kdGdBahan","value":kdBahanBaku});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(2)",nRow).text(aData["keterangan_history"]+" ("+aData["nama"]+")");
            if(aData['status_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['status_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }

            if(aData["status_lock"] == "TRUE"){
              $("td:eq(3)",nRow).html("<label class='btn btn-md btn-block btn-flat btn-default'><i class='fa fa-lock'></i> BULAN INI SUDAH DI LOCK</label>")
            }else{
              $("td:eq(3)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=modalEditHistory('CAT_CAMPUR','"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdBahanBaku+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiGudangBahan('"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdBahanBaku+"','CAT_CAMPUR')><span class='fa fa-trash'></span> Hapus</button>");
            }
            $("td:eq(3)",nRow).css("background-color","f4f4f4");
          }
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getSaldoAwalBulanGudangBahan",
          dataType : "JSON",
          data : {tglAwal:tglAwal,tglAkhir:tglAkhir,kdGdBahan:kdBahanBaku},
          success : function(response){
            $("#textSaldoAwal").text("Saldo Awal : "+response.saldoAwal);
            $("#textSaldoAkhir").text("Saldo Akhir : "+response.saldoAkhir);
            $("#textBarangMasuk").text("Masuk : "+response.saldoMasuk);
            $("#textBarangKeluar").text("Keluar : "+response.saldoKeluar);
          }
        });
      }

      function datatableSearchHistoryCatMurni(tglAwal,tglAkhir,kdBahanBaku){
        $("#tableDataHistoryCatMurni").dataTable().fnDestroy();
        $("#tableDataHistoryCatMurni").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListHistoryGudangBahan",
          "columns":[
            {"data" : "tgl_permintaan","name":"tgl_permintaan"},
            {"data" : "jumlah_permintaan","name":"jumlah_permintaan"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id","name":"id"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":tglAwal},
                        {"name":"tglAkhir","value":tglAkhir},
                        {"name":"kdGdBahan","value":kdBahanBaku});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(2)",nRow).text(aData["keterangan_history"]+" ("+aData["nama"]+")");
            if(aData['status_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['status_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }

            if(aData["status_lock"] == "TRUE"){
              $("td:eq(3)",nRow).html("<label class='btn btn-md btn-block btn-flat btn-default'><i class='fa fa-lock'></i> BULAN INI SUDAH DI LOCK</label>")
            }else{
              $("td:eq(3)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=modalEditHistory('CAT_MURNI','"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdBahanBaku+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiGudangBahan('"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdBahanBaku+"','CAT_MURNI')><span class='fa fa-trash'></span> Hapus</button>");
            }
            $("td:eq(3)",nRow).css("background-color","f4f4f4");
          }
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getSaldoAwalBulanGudangBahan",
          dataType : "JSON",
          data : {tglAwal:tglAwal,tglAkhir:tglAkhir,kdGdBahan:kdBahanBaku},
          success : function(response){
            $("#textSaldoAwal").text("Saldo Awal : "+response.saldoAwal);
            $("#textSaldoAkhir").text("Saldo Akhir : "+response.saldoAkhir);
            $("#textBarangMasuk").text("Masuk : "+response.saldoMasuk);
            $("#textBarangKeluar").text("Keluar : "+response.saldoKeluar);
          }
        });
      }

      function tableListPembelianBahanBakuTemp(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getPembelianGudangBahanTemp",
          dataType : "JSON",
          data : {
            jenis : param
          },
          success : function(response){
            $("#tableListPembelianBahanBakuTemp > tbody > tr").empty();
            $.each(response,function(index,value){
              var no = ++index;
              $("#tableListPembelianBahanBakuTemp > tbody:last-child").append(
                "<tr>"+
                  "<td>"+no+"</td>"+
                  "<td>"+value.kd_permintaan+"</td>"+
                  "<td>"+value.tgl_permintaan+"</td>"+
                  "<td>"+value.namaBarang+"</td>"+
                  "<td>"+value.jumlah_permintaan+"</td>"+
                  "<td>"+value.keterangan+"</td>"+
                  "<td>"+
                    "<button class='btn btn-sm btn-flat btn-warning' onclick=modalEditPembelianBahanTemp('"+value.rowid+"','"+param.replace(/ /gi,"_")+"')><span class='fa fa-edit'></span> Ubah</button>"+
                    "<button class='btn btn-sm btn-flat btn-danger' onclick=deletePembelianTemp('"+value.rowid+"','"+param.replace(/ /gi,"_")+"')><span class='fa fa-trash'></span> Hapus</button>"+
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

      function tableListPembelianSparePartTemp(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/getPembelianSparePartTemp",
          dataType : "JSON",
          success : function(response){
            $("#tableListPembelianSparePartTemp > tbody > tr").empty();
            $.each(response,function(index,value){
              var no = ++index;
              $("#tableListPembelianSparePartTemp > tbody:last-child").append(
                "<tr>"+
                  "<td>"+no+"</td>"+
                  "<td>"+value.kd_permintaan_spare_part+"</td>"+
                  "<td>"+value.tgl_permintaan+"</td>"+
                  "<td>"+value.namaBarang+"</td>"+
                  "<td>"+value.jumlah_permintaan+"</td>"+
                  "<td>"+value.keterangan+"</td>"+
                  "<td>"+
                    "<button class='btn btn-sm btn-flat btn-warning' onclick=modalEditPembelianSparePartTemp('"+value.rowid+"')><span class='fa fa-edit'></span> Ubah</button>"+
                    "<button class='btn btn-sm btn-flat btn-danger' onclick=deletePembelianTemp('"+value.rowid+"')><span class='fa fa-trash'></span> Hapus</button>"+
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

      function tableListKoreksi(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getKoreksiTemp",
          dataType : "JSON",
          data : {jenis:param},
          success : function(response){
            $("#tableListKoreksi > tbody > tr").empty();
            $.each(response,function(index,value){
              var no = ++index;
              $("#tableListKoreksi > tbody:last-child").append(
                "<tr>"+
                  "<td>"+no+"</td>"+
                  "<td>"+value.tgl_permintaan+"</td>"+
                  "<td>"+value.nm_barang+"</td>"+
                  "<td>"+value.jumlah_permintaan+"</td>"+
                  "<td>"+value.keterangan_history+"</td>"+
                  "<td>"+
                    "<button class='btn btn-sm btn-flat btn-warning' onclick=modalEditKoreksiTemp('"+value.id+"','"+param+"')><span class='fa fa-edit'></span> Ubah</button>"+
                    "<button class='btn btn-sm btn-flat btn-danger' onclick=deleteKoreksiTemp('"+value.id+"','"+param+"')><span class='fa fa-trash'></span> Hapus</button>"+
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

      function tablePengeluaranGudangBahan(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getPengeluaranGudangBahanTemp",
          dataType : "JSON",
          data : {jenis:param},
          success : function(response){
            $("#tableListPengeluaran > tbody > tr").empty();
            $.each(response,function(index,value){
              var no = ++index;
              $("#tableListPengeluaran > tbody:last-child").append(
                "<tr>"+
                  "<td>"+no+"</td>"+
                  "<td>"+value.tgl_permintaan+"</td>"+
                  "<td>"+value.nm_barang+"</td>"+
                  "<td>"+value.jumlah_permintaan+"</td>"+
                  "<td>"+value.keterangan_history+"</td>"+
                  "<td>"+
                    "<button class='btn btn-sm btn-flat btn-warning' onclick=modalEditPengeluaranTemp('"+value.id+"','"+param+"')><span class='fa fa-edit'></span> Ubah</button>"+
                    "<button class='btn btn-sm btn-flat btn-danger' onclick=deleteKoreksiTemp('"+value.id+"','"+param+"')><span class='fa fa-trash'></span> Hapus</button>"+
                  "</td>"+
                "</tr>"
              );
            });
          }
        });
      }

      function datatableListBijiWarna(){
        $("#tableDataMasterBijiWarna").dataTable().fnDestroy();
        $("#tableDataMasterBijiWarna").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListGudangBahanDatatable",
          "columns":[
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"},
            {"data" : "nm_barang","name":"nm_barang"},
            {"data" : "stok","name":"stok"},
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"jenis","value":"BIJI_WARNA"});
            //aoData.push({"name":"bagian","value":"SABLON"});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(0)",nRow).html(aData["kd_gd_bahan"]+" "+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>");
            $("td:eq(1)",nRow).html(aData["nm_barang"]+" "+"<label class='text-blue'>["+aData["warna"]+"]</label>");
            $("td:eq(3)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditGudangBahan('"+aData['kd_gd_bahan']+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteGudangBahan('"+aData['kd_gd_bahan']+"')><span class='fa fa-trash'></span> Hapus</button>");
          }
        });
      }

      function datatableListMinyak(){
        $("#tableDataMasterMinyak").dataTable().fnDestroy();
        $("#tableDataMasterMinyak").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListGudangBahanDatatable",
          "columns":[
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"},
            {"data" : "nm_barang","name":"nm_barang"},
            {"data" : "stok","name":"stok"},
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"jenis","value":"MINYAK"});
            //aoData.push({"name":"bagian","value":"SABLON"});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(0)",nRow).html(aData["kd_gd_bahan"]+" "+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>");
            $("td:eq(3)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditGudangBahan('"+aData['kd_gd_bahan']+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteGudangBahan('"+aData['kd_gd_bahan']+"')><span class='fa fa-trash'></span> Hapus</button>");
          }
        });
      }

      function datatableListCatCampur(){
        $("#tableDataMasterCatCampur").dataTable().fnDestroy();
        $("#tableDataMasterCatCampur").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListGudangBahanDatatable",
          "columns":[
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"},
            {"data" : "nm_barang","name":"nm_barang"},
            {"data" : "stok","name":"stok"},
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"jenis","value":"CAT_CAMPUR"});
            //aoData.push({"name":"bagian","value":"SABLON"});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(1)",nRow).html(aData["nm_barang"]+" <label class='text-blue'>("+aData["warna"]+")</label>")
            $("td:eq(0)",nRow).html(aData["kd_gd_bahan"]+" "+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>");
            $("td:eq(3)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditGudangBahan('"+aData['kd_gd_bahan']+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteGudangBahan('"+aData['kd_gd_bahan']+"')><span class='fa fa-trash'></span> Hapus</button>");
          }
        });
      }

      function datatableListCatMurni(){
        $("#tableDataMasterCatMurni").dataTable().fnDestroy();
        $("#tableDataMasterCatMurni").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListGudangBahanDatatable",
          "columns":[
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"},
            {"data" : "nm_barang","name":"nm_barang"},
            {"data" : "stok","name":"stok"},
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"jenis","value":"CAT_MURNI"});
            //aoData.push({"name":"bagian","value":"SABLON"});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(1)",nRow).html(aData["nm_barang"]+" <label class='text-blue'>("+aData["warna"]+")</label>")
            $("td:eq(0)",nRow).html(aData["kd_gd_bahan"]+" "+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>");
            $("td:eq(3)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditGudangBahan('"+aData['kd_gd_bahan']+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteGudangBahan('"+aData['kd_gd_bahan']+"')><span class='fa fa-trash'></span> Hapus</button>");
          }
        });
      }

      function datatableListApal(){
        $("#tableDataMasterApal").dataTable().fnDestroy();
        $("#tableDataMasterApal").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListGudangApalDatatable",
          "columns":[
            {"data" : "kd_gd_apal","name":"kd_gd_apal"},
            {"data" : "jenis","name":"jenis"},
            {"data" : "sub_jenis","name":"sub_jenis"},
            {"data" : "stok","name":"stok"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            // aoData.push({"name":"jenis","value":"CAT_MURNI"});
            //aoData.push({"name":"bagian","value":"SABLON"});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(0)",nRow).html(aData["kd_gd_apal"]+" "+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>");
            // $("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditApal('"+aData['kd_gd_apal']+"')><span class='fa fa-edit'></span> Ubah</button>"+
            //                         "<button class='btn btn-md btn-flat btn-danger' onclick=deleteGudangBahan('"+aData['kd_gd_bahan']+"')><span class='fa fa-trash'></span> Hapus</button>");
          }
        });
      }

      function tableListPenjualanApalTemp(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/getPenjualanApalTemp",
          dataType : "JSON",
          success : function(response){
            $("#tableListPenjualanApalTemp > tbody > tr").empty();
            $.each(response,function(index,value){
              $("#tableListPenjualanApalTemp > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++index +"</td>"+
                  "<td>"+ value.tgl_transaksi+"</td>"+
                  "<td>"+ value.nama +"</td>"+
                  "<td>"+ value.jenis+" ( "+value.sub_jenis+" )"+"</td>"+
                  "<td>"+ value.jumlah_apal +"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditPenjualanApalTemp('"+value.id+"')>Ubah</button>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deletePenjualanApalTemp('"+value.id+"')>Hapus</button>"+
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

      function datatableSearchHistoryGudangApal(tglAwal,tglAkhir,kdGudangApal){
        $("#tableDataHistoryApal").dataTable().fnDestroy();
        $("#tableDataHistoryApal").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListHistoryGudangApal",
          "columns":[
            {"data" : "tgl_transaksi","name":"tgl_transaksi"},
            {"data" : "nama","name":"nama"},
            {"data" : "jumlah_apal","name":"jumlah_apal"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id","name":"id"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":tglAwal},
                        {"name":"tglAkhir","value":tglAkhir},
                        {"name":"kdGdApal","value":kdGudangApal});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            if(aData['status_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['status_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }

            if(aData["status_lock"] == "TRUE"){
              $("td:eq(4)",nRow).html("<label class='btn btn-md btn-block btn-flat btn-default'><i class='fa fa-lock'></i> BULAN INI SUDAH DI LOCK</label>")
            }else{
              $("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=modalEditHistoryApal('"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdGudangApal+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiGudangApal('"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdGudangApal+"')><span class='fa fa-trash'></span> Hapus</button>");
            }
            $("td:eq(4)",nRow).css("background-color","f4f4f4");
            $("td:eq(3)",nRow).text(aData["keterangan_history"]+" ("+aData["bagian"]+")");
          }
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getSaldoAwalBulanGudangApal",
          dataType : "JSON",
          data : {tglAwal:tglAwal,tglAkhir:tglAkhir,kdGdApal:kdGudangApal},
          success : function(response){
            $("#textSaldoAwal").text("Saldo Awal : "+response.saldoAwal);
            $("#textSaldoAkhir").text("Saldo Akhir : "+response.saldoAkhir);
            $("#textBarangMasuk").text("Masuk : "+response.saldoMasuk);
            $("#textBarangKeluar").text("Keluar : "+response.saldoKeluar);
          }
        });
      }

      function tableListKoreksiApalTemp(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/getKoreksiApalTemp",
          dataType : "JSON",
          success : function(response){
            $("#tableListKoreksiApalTemp > tbody > tr").empty();
            $.each(response,function(index,value){
              $("#tableListKoreksiApalTemp > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++index +"</td>"+
                  "<td>"+ value.tgl_transaksi+"</td>"+
                  "<td>"+ value.jenis+" ( "+value.sub_jenis+" )"+"</td>"+
                  "<td>"+ value.jumlah_apal +"</td>"+
                  "<td>"+ value.keterangan_history +"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditKoreksiApalTemp('"+value.id+"')>Ubah</button>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deletePenjualanApalTemp('"+value.id+"')>Hapus</button>"+
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

      function datatableListSparePart(){
        $("#tableDataMasterSparePart").dataTable().fnDestroy();
        $("#tableDataMasterSparePart").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListGudangSparePartDatatable",
          "columns":[
            {"data" : "kd_spare_part","name":"nm_spare_part"},
            {"data" : "nm_spare_part","name":"ukuran"},
            {"data" : "stok","name":"stok"},
            {"data" : "kd_spare_part","name":"kd_spare_part"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            // aoData.push({"name":"jenis","value":"CAT_MURNI"});
            //aoData.push({"name":"bagian","value":"SABLON"});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(0)",nRow).html(aData["kd_spare_part"]+" "+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>");
            $("td:eq(1)",nRow).text(aData["nm_spare_part"]+" "+aData["ukuran"]);
            $("td:eq(3)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditSparePart('"+aData['kd_spare_part']+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteSparePart('"+aData['kd_spare_part']+"')><span class='fa fa-trash'></span> Hapus</button>");
          }
        });
      }

      function datatableSearchHistorySparePart(tglAwal,tglAkhir,kdSparePart){
        $("#tableDataHistorySparePart").dataTable().fnDestroy();
        $("#tableDataHistorySparePart").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getListHistorySparePart",
          "columns":[
            {"data" : "tgl_transaksi","name":"tgl_transaksi"},
            {"data" : "jumlah","name":"jumlah"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id","name":"id"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":tglAwal},
                        {"name":"tglAkhir","value":tglAkhir},
                        {"name":"kdSparePart","value":kdSparePart});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            if(aData['sts_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['sts_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }

            if(aData["status_lock"] == "TRUE"){
              $("td:eq(3)",nRow).html("<label class='btn btn-md btn-block btn-flat btn-default'><i class='fa fa-lock'></i> BULAN INI SUDAH DI LOCK</label>")
            }else{
              $("td:eq(3)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=modalEditHistorySparePart('"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdSparePart+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiSparePart('"+aData['id']+"','"+tglAwal+"','"+tglAkhir+"','"+kdSparePart+"')><span class='fa fa-trash'></span> Hapus</button>");
            }
            $("td:eq(3)",nRow).css("background-color","f4f4f4");
          }
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudangbahan/main/getSaldoAwalBulanSparePart",
          dataType : "JSON",
          data : {tglAwal:tglAwal,tglAkhir:tglAkhir,kdSparePart:kdSparePart},
          success : function(response){
            $("#textSaldoAwal").text("Saldo Awal : "+response.saldoAwal);
            $("#textSaldoAkhir").text("Saldo Akhir : "+response.saldoAkhir);
            $("#textBarangMasuk").text("Masuk : "+response.saldoMasuk);
            $("#textBarangKeluar").text("Keluar : "+response.saldoKeluar);
          }
        });
      }

      function tableListPengeluaranSparePartTemp(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/getPengeluaranSparePartTemp",
          dataType : "JSON",
          success : function(response){
            $("#tableListPengeluaranSparePartTemp > tbody > tr").empty();
            $.each(response,function(index,value){
              $("#tableListPengeluaranSparePartTemp > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++index +"</td>"+
                  "<td>"+ value.tgl_transaksi+"</td>"+
                  "<td>"+ value.nm_spare_part+"</td>"+
                  "<td>"+ value.jumlah +"</td>"+
                  "<td>"+ value.keterangan_history +"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditPengeluaranSparePart('"+value.id+"')>Ubah</button>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiSparePartTemp('"+value.id+"')>Hapus</button>"+
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

      function tableListKoreksiSparePartTemp(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangbahan/main/getKoreksiSparePartTemp",
          dataType : "JSON",
          success : function(response){
            $("#tableListKoreksiSparePartTemp > tbody > tr").empty();
            $.each(response,function(index,value){
              $("#tableListKoreksiSparePartTemp > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++index +"</td>"+
                  "<td>"+ value.tgl_transaksi+"</td>"+
                  "<td>"+ value.nm_spare_part+"</td>"+
                  "<td>"+ value.jumlah +"</td>"+
                  "<td>"+ value.keterangan_history +"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditKoreksiSparePart('"+value.id+"')>Ubah</button>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiSparePartTemp('"+value.id+"')>Hapus</button>"+
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

      function datatableListApproveBahanBakuExtruder(param,param2){
        $("#tableDataApproveGudangBahan").dataTable().fnDestroy();
        $("#tableDataApproveGudangBahan").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getTransaksiGudangBahanForApproveDataTable",
          "columns":[
            {"data" : "tgl_permintaan","name":"TGB.tgl_permintaan"},
            {"data" : "nm_barang","name":"GB.nm_barang"},
            {"data" : "jumlah_permintaan","name":"TGB.jumlah_permintaan"},
            {"data" : "id","name":"TGB.id"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"bagian","value":param},
                        {"name":"jenis","value":param2});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            if(aData['status_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['status_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }
            param3 = param2.replace(" ","_");
            $("td:eq(3)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditDataForApprove('"+aData["id"]+"','"+param+"','"+param3+"')>Ubah</button>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiGudangBahanForApprove('"+aData["id"]+"','"+param+"','"+param3+"')>Hapus</button>");
            $("td:eq(3)",nRow).css("background-color","transparent");
            if((param=="CETAK|SABLON"||param=="SABLON|CETAK")&&(aData["jenis"]=="CAT CAMPUR" || aData["jenis"]=="CAT MURNI")){
              $("td:eq(1)",nRow).text(aData["nm_barang"]+" "+aData["warna"]+" ("+aData["bagian"]+")");
            }else{
              $("td:eq(1)",nRow).text(aData["nm_barang"]+" "+aData["warna"]+" ("+aData["bagian"]+")");
            }
          }
        });
      }

      function datatableListApprovePembelianBahanBaku(param){
        $("#tableDataApproveGudangBahan").dataTable().fnDestroy();
        $("#tableDataApproveGudangBahan").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getPembelianGudangBahanForApproveDataTable",
          "columns":[
            {"data" : "tgl_permintaan","name":"TGB.tgl_permintaan"},
            {"data" : "nm_barang","name":"GB.nm_barang"},
            {"data" : "jumlah_permintaan","name":"TGB.jumlah_permintaan"},
            {"data" : "id","name":"TGB.id"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"jenis","value":param});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            if(aData['status_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['status_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }

            $("td:eq(3)",nRow).css("background-color","transparent")
                              .html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditDataPembelianForApprove('"+aData["id"]+"','"+param.replace(" ","_")+"')>Ubah</button>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiGudangBahanForApprove('"+aData["id"]+"','','"+param.replace(" ","_")+"')>Hapus</button>");

            if(aData["jenis"]=="CAT CAMPUR" || aData["jenis"]=="CAT MURNI"){
              $("td:eq(1)",nRow).text(aData["nm_barang"]+" "+aData["warna"]);
            }

          }
        });
      }

      function datatableListApproveGudangApal(){
        $("#tableDataApproveGudangApal").dataTable().fnDestroy();
        $("#tableDataApproveGudangApal").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getTransaksiGudangApalForApproveDataTable",
          "columns":[
            {"data" : "tgl_transaksi","name":"TDHA.tgl_transaksi"},
            {"data" : "bagian","name":"TDHA.bagian"},
            {"data" : "jenis","name":"GA.jenis"},
            {"data" : "sub_jenis","name":"GA.sub_jenis"},
            {"data" : "jumlah_apal","name":"TDHA.jumlah_apal"},
            {"data" : "id","name":"TDHA.id"}
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
            if(aData['status_history'] == 'MASUK'){
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
            }else if(aData['status_history'] == 'KELUAR'){
              $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }

            $("td:eq(5)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditDataApalForApprove('"+aData["id"]+"')>Ubah</button>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiGudangApalForApprove('"+aData["id"]+"')>Hapus</button>");
            $("td:eq(5)",nRow).css("background-color","transparent");
          }
        });
      }

      function datatableDataPermintaan(){
        $("#tableDataPermintaan").dataTable().fnDestroy();
        $("#tableDataPermintaan").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getPermintaanBarang",
          "columns":[
            {"data" : "kd_permintaan_barang","name":"TPB.kd_permintaan_barang"},
            {"data" : "kd_permintaan_barang","name":"TPB.kd_permintaan_barang"},
            {"data" : "tgl_permintaan","name":"TPB.tgl_permintaan"},
            {"data" : "status_permintaan","name":"TPB.status_permintaan"},
            {"data" : "username","name":"USR.username"},
            {"data" : "kd_permintaan_barang","name":"TPB.kd_permintaan_barang"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            $.ajax({
                     "dataType": "JSON",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(0)",nRow).text(++iDisplayIndex);
            $("td:eq(5)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalLihatDetailPermintaan('"+aData["kd_permintaan_barang"]+"')>Lihat Permintaan</button>"+
                                    "<a href='<?php echo base_url('_gudangbahan/main/printBonPermintaanBarang/') ?>"+aData["kd_permintaan_barang"]+"' target='_blank' class='btn btn-md btn-flat btn-success'>Cetak Bon Permintaan</a>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestorePermintaanBarang('"+aData["kd_permintaan_barang"]+"','TRUE')>Hapus</button>");
          }
        });
      }

      function datatableDataPermintaanSparePart(){
        $("#tableDataPermintaanSparepart").dataTable().fnDestroy();
        $("#tableDataPermintaanSparepart").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getPermintaanSparePart",
          "columns":[
            {"data" : "kd_permintaan_spare_part","name":"TPB.kd_permintaan_spare_part"},
            {"data" : "kd_permintaan_spare_part","name":"TPB.kd_permintaan_spare_part"},
            {"data" : "tgl_permintaan","name":"TPB.tgl_permintaan"},
            {"data" : "status_permintaan","name":"TPB.status_permintaan"},
            {"data" : "username","name":"USR.username"},
            {"data" : "kd_permintaan_spare_part","name":"TPB.kd_permintaan_spare_part"}
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
            $("td:eq(0)",nRow).text(++iDisplayIndex);
            $("td:eq(5)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalLihatDetailPermintaanSparePart('"+aData["kd_permintaan_spare_part"]+"')>Lihat Permintaan</button>"+
                                    "<a href='<?php echo base_url('_gudangbahan/main/printBonPermintaanSparePart/') ?>"+aData["kd_permintaan_spare_part"]+"' target='_blank' class='btn btn-md btn-flat btn-success'>Cetak Bon Permintaan</a>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestorePermintaanSparePart('"+aData["kd_permintaan_spare_part"]+"','TRUE')>Hapus</button>");
          }
        });
      }

      function datatablesDetailPermintaan(param=""){
        $("#tableDetailPermintaan").dataTable().fnDestroy();
        $("#tableDetailPermintaan").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "pageLength" : 100,
          "scrollX" : "100%",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getDetailPermintaanBaru",
          "columns":[
            {"data" : "id_dpb","name":"TDPB.id_dpb"},
            {"data" : "nm_barang","name":"GB.nm_barang"},
            {"data" : "warna","name":"GB.warna"},
            {"data" : "tgl_permintaan","name":"TPB.tgl_permintaan"},
            {"data" : "jumlah_permintaan","name":"TDPB.jumlah_permintaan"},
            {"data" : "sisa","name":"(TDPB.jumlah_permintaan - TDPB.jumlah_terima)"},
            {"data" : "keterangan","name":"TDPB.keterangan"},
            {"data" : "status_permintaan","name":"TDPB.status_permintaan"},
            {"data" : "id_dpb","name":"TDPB.id_dpb"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"idPermintaan","value":param});
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
            $("td:eq(4)",nRow).text(parseFloat(aData["jumlah_permintaan"]).toLocaleString());
            $("td:eq(5)",nRow).text(parseFloat(aData["sisa"]).toLocaleString());
            if(aData["jenis"] == "MINYAK"){
                switch (aData["nm_barang"].toUpperCase()) {
                  case "SMT": $("td:eq(4)",nRow).text((parseFloat(aData["jumlah_permintaan"]) / 160).toLocaleString());
                              $("td:eq(5)",nRow).text((parseFloat(aData["sisa"]) / 160).toLocaleString());
                              break;
                  case "IPA": $("td:eq(4)",nRow).text((parseFloat(aData["jumlah_permintaan"]) / 160).toLocaleString());
                              $("td:eq(5)",nRow).text((parseFloat(aData["sisa"]) / 160).toLocaleString());
                              break;
                  case "REDUSER-SABLON-FR001": $("td:eq(4)",nRow).text((parseFloat(aData["jumlah_permintaan"]) / 15).toLocaleString());
                                               $("td:eq(5)",nRow).text((parseFloat(aData["sisa"]) / 15).toLocaleString());
                                               break;
                  default: $("td:eq(4)",nRow).text((parseFloat(aData["jumlah_permintaan"]) / 170).toLocaleString());
                           $("td:eq(5)",nRow).text((parseFloat(aData["sisa"]) / 170).toLocaleString());
                           break;

                }
            }

            if(aData["status_permintaan"] == "PENDING"){
              $("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-default'><i class='fa fa-lock'></i> Permintaan Belum Disetujui Oleh Purchasing</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreDetailPermintaanBarang('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"','TRUE')>Batal Minta</button>"+
                                      "<a href='<?php echo base_url('_gudangbahan/main/printBonPermintaanBarang/') ?>"+aData["kd_permintaan_barang"]+"' target='_blank' class='btn btn-md btn-flat btn-success'>Cetak Bon Permintaan</a>");
            }else if(aData["status_permintaan"] == "CANCEL"){
              $("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-default'><i class='fa fa-lock'></i> Permintaan Dibatalkan Oleh Purchasing</button>");
            }else{
              $("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalTerimaBarangSetengah('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"')>Terima Setengah</button>"+
                                      "<button class='btn btn-md btn-flat btn-success' onclick=modalTerimaBarangFull('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"')>Terima Full</button>"+
                                      // "<button class='btn btn-md btn-flat btn-danger' onclick=batalkanPermintaan('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"')>Batal Minta</button>"+
                                      "<button class='btn btn-md btn-flat btn-primary' onclick=selesaiPermintaan('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"')>Selesai Permintaan</button>"+
                                      "<a href='<?php echo base_url('_gudangbahan/main/printBonPermintaanBarang/') ?>"+aData["kd_permintaan_barang"]+"' target='_blank' class='btn btn-md btn-flat bg-purple'>Cetak Bon Permintaan</a>");
            }

            if(aData["status_permintaan"] == "CANCEL" && (aData["keterangan_purchasing"] != null && aData["keterangan_purchasing"] != "")){
              $("td:eq(7)",nRow).html("<label class='text-red'>["+aData["status_permintaan"]+"]</label><br>"+
                                      "<label class='text-blue'>["+aData["keterangan_purchasing"]+"]</label>");
            }else{
              $("td:eq(7)",nRow).text(aData["status_permintaan"]);
            }
          }
        });
      }

      function datatablesDetailPermintaanSparePart(param=""){
        $("#tableDetailPermintaanSparePart").dataTable().fnDestroy();
        $("#tableDetailPermintaanSparePart").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "pageLength" : 100,
          "scrollX" : "100%",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangbahan/main/getDetailPermintaanSparePartBaru",
          "columns":[
            {"data" : "id_dpsp","name":"TDPB.id_dpsp"},
            {"data" : "nm_spare_part","name":"GB.nm_spare_part"},
            {"data" : "ukuran","name":"GB.ukuran"},
            {"data" : "tgl_permintaan","name":"TPB.tgl_permintaan"},
            {"data" : "jumlah_permintaan","name":"TDPB.jumlah_permintaan"},
            {"data" : "sisa","name":"(TDPB.jumlah_permintaan - TDPB.jumlah_terima)"},
            {"data" : "keterangan","name":"TDPB.keterangan"},
            {"data" : "status_permintaan","name":"TDPB.status_permintaan"},
            {"data" : "id_dpsp","name":"TDPB.id_dpsp"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"idPermintaan","value":param});
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
            $("td:eq(4)",nRow).text(parseFloat(aData["jumlah_permintaan"]).toLocaleString());
            $("td:eq(5)",nRow).text(parseFloat(aData["sisa"]).toLocaleString());
            if(aData["status_permintaan"] == "PENDING"){
              $("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-default'><i class='fa fa-lock'></i> Permintaan Belum Disetujui Oleh Purchasing</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreDetailPermintaanSparePart('"+aData["id_dpsp"]+"','"+aData["kd_permintaan_spare_part"]+"','TRUE')>Batal Minta</button>"+
                                      "<a href='<?php echo base_url('_gudangbahan/main/printBonPermintaanSparePart/') ?>"+aData["kd_permintaan_spare_part"]+"' target='_blank' class='btn btn-md btn-flat bg-purple'>Cetak Bon Permintaan</a>");
            }else if(aData["status_permintaan"] == "CANCEL"){
              $("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-default'><i class='fa fa-lock'></i> Permintaan Dibatalkan Oleh Purchasing</button>");
            }else{
              $("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalTerimaSparePartSetengah('"+aData["id_dpsp"]+"','"+aData["kd_permintaan_spare_part"]+"')>Terima Setengah</button>"+
                                      "<button class='btn btn-md btn-flat btn-success' onclick=modalTerimaSparePartFull('"+aData["id_dpsp"]+"','"+aData["kd_permintaan_spare_part"]+"')>Terima Full</button>"+
                                      // "<button class='btn btn-md btn-flat btn-danger' onclick=batalkanPermintaan('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"')>Batal Minta</button>"+
                                      "<button class='btn btn-md btn-flat btn-primary' onclick=selesaiPermintaanSparePart('"+aData["id_dpsp"]+"','"+aData["kd_permintaan_spare_part"]+"')>Selesai Permintaan</button>"+
                                      "<a href='<?php echo base_url('_gudangbahan/main/printBonPermintaanSparePart/') ?>"+aData["kd_permintaan_spare_part"]+"' target='_blank' class='btn btn-md btn-flat bg-purple'>Cetak Bon Permintaan</a>");
            }

            if(aData["status_permintaan"] == "CANCEL" && (aData["keterangan_purchasing"] != null && aData["keterangan_purchasing"] != "")){
              $("td:eq(7)",nRow).html("<label class='text-red'>["+aData["status_permintaan"]+"]</label><br>"+
                                      "<label class='text-blue'>["+aData["keterangan_purchasing"]+"]</label>");
            }else{
              $("td:eq(7)",nRow).text(aData["status_permintaan"]);
            }
          }
        });
      }

      function alertPermintaanCatSablon(){
        $.ajax({
          type : "POST",
          url  : "<?php echo site_url('_gudangbahan/main/countPermintaanCatSablon'); ?>",
          success:function(response){
            if (response>0) {
              $("#alertPermintaanCatSablon").show();
            }else{
              $("#alertPermintaanCatSablon").hide();
            }
          }
        });
      }

      function alertPermintaanMinyakSablon(){
        $.ajax({
          type : "POST",
          url  : "<?php echo site_url('_gudangbahan/main/countPermintaanMinyakSablon'); ?>",
          success:function(response){
            if (response>0) {
              $("#alertPermintaanMinyakSablon").show();
            }else{
              $("#alertPermintaanMinyakSablon").hide();
            }
          }
        });
      }

      function modalPermintaanBahanSablon(jenis){
        $("#title_jenis").text(jenis);
        $("#btn_approvePermintaanBahanSablon").attr("onclick","approvePermintaanBahanSablon('"+encodeURIComponent(jenis)+"')");
        tableListPermintaanBahanSablon(jenis);
      }

      function tableListPermintaanBahanSablon(jenis){
          $.ajax({
            type : "POST",
            url  : "<?php echo base_url() ?>_gudangbahan/main/getDataPermintaanBahanSablon",
            data : {jenis:jenis},
            dataType : "JSON",
            success : function(response){
              $("#tableDataPermintaanBahanSablon > tbody > tr").empty();
              $.each(response,function(AvIndex,AvValue){
                $("#tableDataPermintaanBahanSablon > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+ ++AvIndex +"</td>"+
                    "<td>"+AvValue.tgl_permintaan+"</td>"+
                    "<td>"+AvValue.nm_barang+"</td>"+
                    "<td>"+AvValue.jenis+"</td>"+
                    "<td>"+AvValue.warna+"</td>"+
                    "<td>"+AvValue.jumlah_permintaan+"</td>"+
                    "<td>"+
                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteListPermintaanBahanSablon('"+AvValue.id+"','"+encodeURIComponent(AvValue.jenis)+"')><i class='fa fa-trash'></i> Hapus</button>"
                    +"</td>"+
                  "</tr>"
                );
              });
            }
          });
        }

        function tableListDataAwalPending(jenis){
          $.ajax({
            type : "POST",
            url  : "<?php echo base_url() ?>_gudangbahan/main/getListDataAwalPending",
            data : {jenis:jenis},
            dataType : "JSON",
            success : function(response){
              $("#tableDaftarDataAwal > tbody > tr").empty();
              $.each(response,function(AvIndex,AvValue){
                $("#tableDaftarDataAwal > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+ ++AvIndex +"</td>"+
                    "<td>"+AvValue.nm_barang+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_permintaan).toLocaleString()+"</td>"+
                    "<td>"+
                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreListDataAwalPending('"+AvValue.id+"','"+jenis.replace(/ /gi,"_")+"','TRUE')><i class='fa fa-trash'></i> Hapus</button>"
                    +"</td>"+
                  "</tr>"
                );
              });
            }
          });
        }

        function tableListDataAwalSparePartPending(){
          $.ajax({
            type : "POST",
            url  : "<?php echo base_url() ?>_gudangbahan/main/getListDataAwalSparePartPending",
            dataType : "JSON",
            success : function(response){
              $("#tableDaftarDataAwal > tbody > tr").empty();
              $.each(response,function(AvIndex,AvValue){
                $("#tableDaftarDataAwal > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+ ++AvIndex +"</td>"+
                    "<td>"+AvValue.nm_spare_part+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah).toLocaleString()+"</td>"+
                    "<td>"+
                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreListDataAwalSparePartPending('"+AvValue.id+"','TRUE')><i class='fa fa-trash'></i> Hapus</button>"
                    +"</td>"+
                  "</tr>"
                );
              });
            }
          });
        }

        function deleteListPermintaanBahanSablon(param1,param2){
          var r = confirm("Hapus List Permintaan Bahan..?");
          if (r==true) {
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('_gudangbahan/main/deleteListPermintaanBahanSablon'); ?>",
              data : {id:param1},
              success:function(response){
                if (jQuery.trim(response)=="Success"){
                  tableListPermintaanBahanSablon(decodeURIComponent(param2))
                  alertPermintaanCatSablon();
                  alertPermintaanMinyakSablon();
                  $("#modalKirimanBahanSablon").modal("hide");
                  $("#modal-notif").modal("show");
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>List Permintaan Berhasil Dihapus</b></div>");
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
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>List Permintaan Gagal Dihapus</b></div>");
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

        function approvePermintaanBahanSablon(param){
          var jenis = decodeURIComponent(param);
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudangbahan/main/approvePermintaanBahanSablon'); ?>",
            data : {jenis:jenis},
            success:function(response){
              if (jQuery.trim(response)=="Success"){
                datatableListMinyak();
                datatableListCatMurni();
                alertPermintaanCatSablon();
                alertPermintaanMinyakSablon();
                $("#modalPermintaanBahanSablon").modal("hide");
                $("#modal-notif").modal("show");
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Approve Berhasil</b></div>");
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
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Approve Gagal</b></div>");
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

        function printElem() {
            var content = document.getElementById("section-to-print").innerHTML;
            var mywindow = open();
            mywindow.document.write('<html><head><title>Print</title>');
            mywindow.document.write('</head><body style="width:100%;">');
            mywindow.document.write(content);
            mywindow.document.write('</body></html>');

            mywindow.document.close();
            mywindow.focus()
            mywindow.print();
            mywindow.close();
            return true;
        }
      //============================================DATATABLE METHOD (Finish)============================================//
      </script>
<!--===============================================General Function (Finish) ===============================================-->
    </body>
</html>
