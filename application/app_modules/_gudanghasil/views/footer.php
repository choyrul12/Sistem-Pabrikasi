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
          //   alertKirimanBahanSablon()
          //   alertReturBarang("Standard")
          //   alertReturBarang("Campur")
          //   alertReturBarang("Kantong")
          //   alertReturBarang("Sablon")
          // },10000);
          // alertKirimanBahanSablon()
          // alertReturBarang("Standard")
          // alertReturBarang("Campur")
          // alertReturBarang("Kantong")
          // alertReturBarang("Sablon")
          datatableBahanSablon();
          datatableListPengirimanBaru();
          datatableListPesananTerkirim();
          datatableListPesananBelumTerkirim();
          reloadTrashGudangHasil();
          datatableListCatMurni();
          if($("#tableDataMasterGudangHasilCampur").length){
            datatableListGudangHasil("#tableDataMasterGudangHasilCampur","CAMPUR");
            if($("#alertApproveReturBarangCampur").length){
              alertReturBarang("Campur");
            }
          }
          if($("#tableDataMasterGudangHasilKantong").length){
            datatableListGudangHasil("#tableDataMasterGudangHasilKantong","KANTONG");
            if($("#alertApproveReturBarangKantong").length){
              alertReturBarang("Kantong");
            }
          }
          if($("#tableDataMasterGudangHasilBuffer").length){
            datatableListGudangHasil("#tableDataMasterGudangHasilBuffer","SABLON","POLOS");
            if($("#alertKirimanBahanSablon").length){
              alertKirimanBahanSablon();
            }
          }
          if($("#tableDataMasterGudangHasilSablon").length){
            datatableListGudangHasil("#tableDataMasterGudangHasilSablon","SABLON","CETAK");
            if($("#alertApproveReturBarangSablon").length){
              alertReturBarang("Sablon");
            }
          }
          if($("#tableDataMasterGudangHasilStandard").length){
            datatableListGudangHasil("#tableDataMasterGudangHasilStandard","STANDARD");
            if($("#alertApproveReturBarangStandard").length){
              alertReturBarang("Standard");
            }
          }

          if($("#tableListPengeluaranGudangCampur").length){
            datatableListPengeluaranGudangHasil("#tableListPengeluaranGudangCampur","CAMPUR");
          }
          if($("#tableListPengeluaranGudangStandard").length){
            datatableListPengeluaranGudangHasil("#tableListPengeluaranGudangStandard","STANDARD");
          }
          if($("#tableListPengeluaranGudangSablonBuffer").length){
            datatableListPengeluaranGudangHasil("#tableListPengeluaranGudangSablonBuffer","SABLON","POLOS");
          }
          if ($("#alertKirimanBarangKeGudangBuffer").length) {
            alertKirimanBarangKeGudangBuffer();
          }
          if ($("#alertKirimanBarangKeCampur").length) {
            alertKirimanBarang('Campur','POTONG');
          }

          if ($("#alertKirimanBarangKeKantong").length) {
            alertKirimanBarang('Kantong','POTONG');
          }

          if ($("#alertKirimanBarangKeSablon").length) {
            alertKirimanBarang('Sablon','SABLON','CETAK');
          }

          if ($("#alertKirimanBarangKeStandard").length) {
            alertKirimanBarang('Standard','POTONG');
          }
          if ($("#alertKembalianHDSablon").length) {
            alertKembalianHDSablon();
          }

          if($("#alertApproveCatMurni").length){
            reloadAlert("CETAK|SABLON","CAT MURNI","#alertApproveCatMurni");
            if($("#alertApprovePembelian").length){
              reloadAlertPembelian("CAT MURNI","#alertApprovePembelian");
            }
            if ($("#alertPermintaanCatSablon").length){
            alertPermintaanCatSablon();}
          }

          if($("#tableDataPermintaan").length > 0){
            datatableDataPermintaan();
          }

          if($("#tableDetailPermintaan").length > 0){
            datatablesDetailPermintaan();
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
          $(".number").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          //======= Inisialisasi Komponen (End) =======
        });//Tutup $(function(){}); yang pertama
      </script>
<!--===============================================General Function (Start) ===============================================-->
      <script>
      //============================================MODAL METHOD (Start)============================================//
      function modalLihatNote(param,param2=""){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getNotePesanan",
          dataType : "JSON",
          data : {noOrder : param,
                  idDP : param2},
          success : function(response){
            var note = response[0].note;
            if(note=="" || note==null){
              $("#noteWrapper").html("<label class='text-danger'>Note Tidak Tersedia</label>");
            }else{
              $("#noteWrapper").html("<label>"+note+"</label>");
            }
            $("#modalLihatNote").modal("show");
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

      function modalKirimPesanan(param){
        resetFormPengirimanBaru();
        tableListPengirimanBaruTemp();
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getPesananDetailData",
          dataType : "JSON",
          data : {idDp : param},
          success : function(response){
            $("#tableDataPesanan > tbody > tr").empty();
            $.each(response,function(index, value){
              if(value.satuan == "KG"){
                $("#tdJumlahDikirim").text("Jumlah Kilogram");
              }else if(value.satuan == "LEMBAR"){
                $("#tdJumlahDikirim").text("Jumlah Lembar");
              }else if(value.satuan == "BAL"){
                $("#tdJumlahDikirim").text("Jumlah BAL");
              }
              $("#tableDataPesanan > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++index +"</td>"+
                  "<td>"+value.tgl_pesan+"</td>"+
                  "<td>"+value.nm_pemesan+"</td>"+
                  "<td>"+value.ukuran+"</td>"+
                  "<td>"+value.warna_plastik+"</td>"+
                  "<td>"+value.merek+"</td>"+
                  "<td>"+value.dll+"</td>"+
                  "<td>"+value.jumlah+" "+value.satuan+"</td>"+
                  "<td>"+value.jumlah_kirim+" "+value.satuan+"</td>"+
                  "<td>"+value.sisa+" "+value.satuan+"</td>"+
                "</tr>"
              );
              $("#txtJumlahOrder").val(value.jumlah);
              if(value.jns_brg == null){
                $("#txtJenisBarang").val(value.jenis);
              }else{
                $("#txtJenisBarang").val(value.jns_brg);
              }
              $("#txtIdDp").val(value.id_dp);
              $("#txtKdGdHasil").val(value.kd_gd_hasil);
              $("#txtKdGdBahan").val(value.kd_gd_bahan);
              if(value.warna_plastik == null){
                $("#txtWarna").val(value.warna);
              }else{
                $("#txtWarna").val(value.warna_plastik);
              }
              var jumlah = parseFloat(value.jumlah);
              var sisa = (parseFloat(value.jumlah)-parseFloat(value.jumlah_kirim));
              if(jumlah == sisa){
                $("#txtJenisJumlah").val("BUKAN_SISA");
              }else{
                $("#txtJenisJumlah").val("SISA");
              }
            });
            $("#btnAddItemPengiriman").attr("onclick","saveAddPengirimanBaruTemp()");
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
        $("#modalKirimPesanan").modal({
          backdrop : "static"
        });
      }

      function modalTambahBarangBaru(param, param2=""){
        resetFormTambahBarangBaru(param,param2);
        $("#cmbMerek1").on("change",function(){
          var merek = $("#cmbMerek1").val();
          if(merek == "Custom"){
            $(".textMerek").css("display","block");
            $("#cmbMerek1").css("display","none");
          }
        });
        $("#btnClose").on("click",function(){
          $("#txtMerek1").val("");
          $(".textMerek").css("display","none");
          $("#cmbMerek1").css("display","block");
          $("#cmbMerek1").val("");
        });
      }

      function modalEditBarangGudangHasil(param){
        $("#cmbMerek1").on("change",function(){
          var merek = $("#cmbMerek1").val();
          if(merek == "Custom"){
            $(".textMerek").css("display","block");
            $("#cmbMerek1").css("display","none");
          }
        });
        $("#btnClose").on("click",function(){
          $("#txtMerek1").val("");
          $(".textMerek").css("display","none");
          $("#cmbMerek1").css("display","block");
          $("#cmbMerek1").val("");
        });
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getDetailBarangGudangHasil",
          dataType : "JSON",
          data : {kdGdHasil : param},
          success : function(response){
            $("#modalTambahGudangHasil").modal({
              backdrop : "static"
            });
            var arrMerek = ["KLIP","KLIP DOUBLE","KLIP KLOP","KLIP IN","KP","MP","PON","HD","ZIPPIN","EXPORT"];
            $.each(response,function(AvIndex,AvValue){
              $("#txtKdGdHasil1").val(AvValue.kd_gd_hasil);
              $("#txtTanggal1").val(AvValue.tgl_buat);
              $("#txtKdAccurate1").val(AvValue.kd_accurate);
              $("#txtWarnaPlastik1").val(AvValue.warna_plastik);
              $("#txtUkuran1").val(AvValue.ukuran);
              $("#txtStokTebal1").val(AvValue.tebal);
              $("#txtStokBerat1").val(AvValue.stok_berat).attr("readonly","readonly");
              $("#txtStokLembar1").val(AvValue.stok_lembar).attr("readonly","readonly");
              $("#txtKeterangan1").val(AvValue.keterangan);
              $("#cmbJenisPermintaan1").val(AvValue.jns_permintaan);
              $("#cmbJenisBarang1").val(AvValue.sts_brg);
              var merek = AvValue.merek;
              if(jQuery.inArray(merek.toUpperCase(),arrMerek) == -1){
                $("#cmbMerek1").val("Custom").trigger("change");
                $("#txtMerek1").val(merek);
              }else{
                $("#cmbMerek1").val(merek).trigger("change");
              }
            });
            $("#btnSaveGudangHasil").attr("onclick","editBarangGudangHasil()");
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

      function modalLihatDetailPengiriman(param){
        $("#modalLihatDetailPengiriman").modal({
          backdrop : "static"
        });
        tableListDetailPengiriman(param);
        $("#id_dp").val(param);
      }

      function modalTrashGudangHasil(){
        datatableTrashListGudangHasil();
        datatableTrashHistoryGudangHasil();
      }

      function modalCariHistory(param,param2=""){
        // $("input").val("");
        // $(".date").datepicker("setDate",null);
        $("#cmbUkuran1").val("").trigger("change");
        var placeholder = param.replace("_"," ");
        $("#cmbUkuran1").select2({
          placeholder : "Pilih Hasil ("+placeholder+")",
          dropdownParent: $('#modalCariHistory'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueHasil/"+param+"/"+param2,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_permintaan+" | "+item.sts_brg,
                    id:item.kd_gd_hasil
                  }
                })
              };
            }
          }
        });
      }

      function modalEditHistory(param1,param2,param3,param4,param5,param6=""){
        if(param6 != ""){
          var jnsPermintaan = "/"+param6;
        }else{
          var jnsPermintaan = "";
        }
        $("#modalEditHistoryMasukGudangHasil").modal({
          backdrop : "static"
        });
        $("#cmbUkuran6").select2({
          placeholder : "Pilih Hasil ("+param1+")",
          dropdownParent: $('#modalEditHistoryMasukGudangHasil'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueHasil/"+param1+jnsPermintaan,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_permintaan+" | "+item.sts_brg,
                    id:item.kd_gd_hasil
                  }
                })
              };
            }
          }
        });
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getDetailTransaksiGudangHasil",
          dataType : "JSON",
          data : {idTransaksi : param2},
          success : function(response){
            $.each(response,function(AvIndex,AvValue){
              $("#txtTglHistoryMasuk").val(AvValue.tgl_transaksi);
              $("#cmbUkuran6").val(AvValue.kd_gd_hasil).trigger("change");
              $("#txtBeratMasukHistory").val(AvValue.jumlah_berat);
              $("#txtLembarMasukHistory").val(AvValue.jumlah_lembar);
              if(AvValue.jumlah_terkirim != null){
                $("#trJumlahPengiriman").removeAttr("style");
                $("#txtJumlahPengiriman").val(AvValue.jumlah_terkirim);
                $("#txtSatuan").text(AvValue.satuan);
              }
            });
            $("#btnSaveEditHistoryGudangHasil").attr("onclick","editTransaksiGudangHasil('"+param2+"','"+param3+"','"+param4+"','"+param5+"')");
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

      function modalPengambilanSablon(param,param2=""){
        $("input").val("");
        $(".date").datepicker("setDate",null);
        $("#cmbUkuran2").val("").trigger("change");
        var placeholder = param.replace("_"," ");
        $("#cmbUkuran2").select2({
          placeholder : "Pilih Hasil ("+placeholder+")",
          dropdownParent: $('#modalPengambilanSablon'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueHasil/"+param+"/"+param2,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_permintaan+" | "+item.sts_brg,
                    id:item.kd_gd_hasil
                  }
                })
              };
            }
          }
        });

        $("#cmbUkuran2").on("select2:select",function(){
          var dataText = $("#cmbUkuran2").select2("data")[0]["text"];
          var arrDataText = dataText.split(" | ");
          var ukuran = arrDataText[1];
          var warna = arrDataText[3];
          if(param=="SABLON" && param2=="CETAK"){
            var jnsPermintaan = "POLOS";
            var jnsBarang = "SABLON";
          }else{
            var jnsPermintaan = arrDataText[4];
            var jnsBarang = "SABLON";
          }

          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/getListComboBoxCustom",
            dataType : "JSON",
            data : {
              ukuran : ukuran,
              warna : warna,
              jnsPermintaan : jnsPermintaan,
              jnsBarang : jnsBarang
            },
            success : function(response){
              $("#cmbUkuranBarangSablon").empty();
              $.each(response,function(AvIndex,AvValue){
                $("#cmbUkuranBarangSablon").append(
                  "<option value='"+AvValue.kd_gd_hasil+"'>"+AvValue.ukuran+" | "+AvValue.merek+" | "+AvValue.warna_plastik+" | "+AvValue.jns_permintaan+" | "+AvValue.sts_brg+"</option>"
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
        });

        $("#cmbUkuran2").on("select2:unselect",function(){
          $("#cmbUkuranBarangSablon").empty();
        });

        $("#btnAddPengambilanCampur").attr("onclick","savePengambilanSablonTemp()");
        $("#btnSavePengambilanCampur").attr("onclick","savePengambilanSablon()");
        tableListPengambilanSablonTemp();
      }

      function modalPengirimanGudang(param, param2=""){
        $("input").val("");
        $(".date").datepicker("setDate",null);
        $("#cmbUkuran3").val("").trigger("change").removeAttr("disabled");
        $("#cmbKeteranganPengiriman").val("");

        var placeholder = param.replace("_"," ");
        $("#cmbUkuran3").select2({
          placeholder : "Pilih Hasil ("+placeholder+")",
          dropdownParent: $('#modalPengirimanGudangCampur'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueHasil/"+param+"/"+param2,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_permintaan+" | "+item.sts_brg,
                    id:item.kd_gd_hasil
                  }
                })
              };
            }
          }
        });
        $("#btnAddPengirimanCampur").attr("onclick","savePengirimanGudangTemp('"+param+"')").html("<i class='fa fa-plus'></i> Tambah");
        $("#btnSavePengirimanCampur").attr("onclick","savePengirimanGudang('"+param+"')");
        tableListPengirimanGudangTemp(param);
      }

      function modalEditPengirimanGudangTemp(param, param2){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getDetailPengirimanGudangTemp",
          dataType : "JSON",
          data : {idDetailPengiriman : param2},
          success : function(response){
            $.each(response,function(AvIndex, AvValue){
              $("#txtTanggalPengiriman").val(AvValue.tgl_pengiriman);
              $("#txtNamaCustomer").val(AvValue.customer);
              $("#cmbUkuran3").attr("disabled","disabled");
              $("#txtBeratPengiriman").val(AvValue.jumlah_kg);
              $("#txtLembarPengiriman").val(AvValue.jumlah_lembar);
              $("#cmbKeteranganPengiriman").val(AvValue.keterangan);
              $("#btnAddPengirimanCampur").attr("onclick","editPengirimanGudangTemp('"+param+"','"+param2+"')").html("<i class='fa fa-pencil'></i> Ubah");
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

      function modalKirimApal(){
        $("input").val("");
        $("#txtKeteranganPengirimanApal").val("KIRIMAN APAL");
        $(".date").datepicker("setDate",null);
        $.ajax({
          url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValuetGudangApal",
          dataType : "JSON",
          success : function(response){
            $("#cmbJenisApal").empty();
            $.each(response,function(AvIndex, AvValue){
              if(AvValue.sub_jenis == ""){
                $("#cmbJenisApal").append("<option value='"+AvValue.kd_gd_apal+"'>"+AvValue.jenis+"</option>");
              }else{
                $("#cmbJenisApal").append("<option value='"+AvValue.kd_gd_apal+"'>"+AvValue.sub_jenis+"</option>");
              }
            })
          }
        });
        $("#btnAddKirimanApal").attr("onclick","saveAddKirimanApalTemp()");
        $("#btnSaveKirimanApal").attr("onclick","saveKirimanApal()");
        tableListPengirimanApalTemp();
      }

      function modalPengembalianBarang(param, param2=""){
        $("input").val("");
        $(".date").datepicker("setDate",null);
        $("#cmbKeteranganPengembalian").val("");
        $("#cmbUkuran4").val("").trigger("change");
        var placeholder = param.replace("_"," ");
        $("#cmbUkuran4").select2({
          placeholder : "Pilih Hasil ("+placeholder+")",
          dropdownParent: $('#modalPengembalianCampur'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueHasil/"+param+"/"+param2,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_permintaan+" | "+item.sts_brg,
                    id:item.kd_gd_hasil
                  }
                })
              };
            }
          }
        });

        $("#btnAddPengembalianBarang").attr("onclick","saveAddKembalianGudangTemp('"+param+"')");
        $("#btnSavePengembalian").attr("onclick","saveKembalianGudang('"+param+"')");
        tableListPengembalianGudangHasil(param);
      }

      function modalPembelianBarangHd(){
        $("input").val("");
        $(".date").datepicker("setDate",null);
        $.ajax({
          url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueHasilHd",
          dataType : "JSON",
          success : function(response){
            $("#cmbUkuran5").empty();
            $.each(response, function(AvIndex, AvValue){
              $("#cmbUkuran5").append("<option value='"+AvValue.kd_gd_hasil+"'>"+AvValue.ukuran+" | "+AvValue.merek+" | "+AvValue.warna_plastik+" | "+AvValue.jns_brg+" | "+AvValue.sts_brg+" | "+AvValue.jns_permintaan+"</option>");
            });

            $("#btnAddPembelianHd").attr("onclick","saveAddPembelianHd()");
            $("#btnSavePembelianHd").attr("onclick","savePembelianHd()");
            tableListPembelianBarangHd();
          }
        });
      }

      function modalCariHistoryApal(){
        $("input").val("");
        $(".date").datepicker("setDate",null);
        $.ajax({
          url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValuetGudangApal",
          dataType : "JSON",
          success : function(response){
            $("#cmbJenisApal2").empty();
            $.each(response,function(AvIndex, AvValue){
              if(AvValue.sub_jenis == ""){
                $("#cmbJenisApal2").append("<option value='"+AvValue.kd_gd_apal+"'>"+AvValue.jenis+"</option>");
              }else{
                $("#cmbJenisApal2").append("<option value='"+AvValue.kd_gd_apal+"'>"+AvValue.sub_jenis+"</option>");
              }
            })
          }
        });
      }

      function modalKoreksiGudangHasil(param1, param2=""){
        $("input").val("");
        $(".date").datepicker("setDate",null);
        $("#cmbJenisKoreksi").val("PLUS");
        $("#cmbUkuran3").val("").trigger("change");
        tableListKoreksiGudangBufferTemp();
        var placeholder = param1.replace("_"," ");
        $("#cmbUkuran3").select2({
          placeholder : "Pilih Hasil ("+placeholder+")",
          dropdownParent: $('#modalKoreksiGudangHasil'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueHasil/"+param1+"/"+param2,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_permintaan+" | "+item.sts_brg,
                    id:item.kd_gd_hasil
                  }
                })
              };
            }
          }
        });
        $("#btnAddKoreksiGudangHasil").attr("onclick","saveAddKoreksiGudangBuffer('"+param1+"')");
        $("#btnSaveKoreksiGudangHasil").attr("onclick","saveKoreksiGudangBuffer()");
      }

      function modalEditKoreksiGudangBuffer(param){
        var jnsKoreksi = "";
        var kdGdHasil = "";
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getDetailTransaksiGudangHasil",
          dataType : "JSON",
          data : {idTransaksi : param},
          success : function(response){
            $.each(response,function(AvIndex,AvValue){
              kdGdHasil = String(AvValue.kd_gd_hasil);
              $("#txtTglKoreksi").val(AvValue.tgl_transaksi);
              $("#cmbUkuran3").val(kdGdHasil).trigger("change");
              $("#txtBeratKoreksi").val(AvValue.jumlah_berat);
              $("#txtLembarKoreksi").val(AvValue.jumlah_lembar);
              (AvValue.status_history == "MASUK") ? jnsKoreksi="PLUS" : jnsKoreksi="MINUS";
              $("#cmbJenisKoreksi").val(jnsKoreksi);
              $("#txtKeterangan").val(AvValue.keterangan);
              $("#btnAddKoreksiGudangHasil").attr("onclick","editKoreksiGudangBufferTemp('"+AvValue.sts_barang+"','"+AvValue.id_permintaan_jadi+"')").html("<i class='fa fa-pencil'></i> Ubah");
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

      function modalPengembalianBarangStandard(param1, param2="",param3){
        resetFormPengembalianKeStandard(param1);
        tableListPengembalianGudangBuffer();
        var placeholder = param1.replace("_"," ");
        $("#cmbUkuran5").select2({
          placeholder : "Pilih Hasil ("+placeholder+")",
          dropdownParent: $('#modalPengembalianStandard'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueHasil/"+param1+"/"+param2,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_permintaan+" | "+item.sts_brg,
                    id:item.kd_gd_hasil
                  }
                })
              };
            }
          }
        });

        $("#cmbUkuran5").on("select2:select",function(){
          var dataText = $("#cmbUkuran5").select2("data")[0]["text"];
          var arrDataText = dataText.split(" | ");
          var ukuran = arrDataText[1];
          var warna = arrDataText[3];
          var jnsPermintaan = arrDataText[4];
          var jnsBarang = param3;

          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/getListComboBoxCustom",
            dataType : "JSON",
            data : {
              ukuran : ukuran,
              warna : warna,
              jnsPermintaan : jnsPermintaan,
              jnsBarang : jnsBarang
            },
            success : function(response){
              $("#cmbUkuran5_1").empty();
              $.each(response,function(AvIndex,AvValue){
                $("#cmbUkuran5_1").append(
                  "<option value='"+AvValue.kd_gd_hasil+"'>"+AvValue.ukuran+" | "+AvValue.merek+" | "+AvValue.warna_plastik+" | "+AvValue.jns_permintaan+" | "+AvValue.sts_brg+"</option>"
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
        });

        $("#cmbUkuran5").on("select2:unselect",function(){
          $("#cmbUkuran5_1").empty();
        });
      }

      function modalKirimanDariBagian(param,param2,param3=""){
        datatableKirimanDariBagian(param, param2, param3);
      }

      function modalKirimanUntukBufferSablon(param){
        datatableKirimanUntukBufferSablon(param);
      }

      function modalEditDataOrderTerkirim(param){
        $("#modalEditDataOrderTerkirim").modal({backdrop:"static"});
        $.ajax({
          type : "POST",
          url : "<?php echo base_url('_gudanghasil/main/getDetailDataOrderTerkirim'); ?>",
          dataType : "JSON",
          data : {
            idTransaksi : param
          },
          success : function(response){
            $.each(response, function(AvIndex, AvValue){
              $("#txtTglPengiriman").val(AvValue.tgl_pengiriman);
              $("#txtNamaCustomer").val(AvValue.customer);
              $("#txtJumlahOrder").val(AvValue.jumlah_pesanan);
              $("#txtJumlahPerKg").val(AvValue.jumlah_kg);
              $("#txtJumlahPerLembar").val(AvValue.jumlah_lembar);
              $("#txtJumlahDikirim").val(AvValue.jumlah_terkirim);
              $("#txtKeterangan").val(AvValue.keterangan);
              $("#txtJenisBarang").val(AvValue.sts_pengiriman);
              $("#txtJenisJumlah").val(AvValue.jenis_jumlah);
              $("#txtIdDp").val(AvValue.id_dp);
              $("#txtWarna").val(AvValue.warna);
              $("#txtKdGdHasil").val(AvValue.kd_gd_hasil);
              $("#txtKdGdBahan").val(AvValue.kd_gd_bahan);
              $("#txtNamaBarang").val(AvValue.ukuran+" - "+AvValue.merek+" - "+AvValue.warna_plastik);
              $("#id_detail_pengiriman").val(AvValue.id_detail_pengiriman);
              $("#txtJumlahSebelum").val(AvValue.jumlah_terkirim);
            });
          }
        });
      }

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

      function modalEditGudangBahan(param){
        $("#modalTambahBahanBaru").modal({
          backdrop : "static"
        });
        $.ajax({
          type : "POST",
          url : "<?php echo base_url() ?>_gudanghasil/main/getDetailBarangBahan",
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

      function modalTambahPembelianBahanBaku(param){
        var placeholder = param.replace("_"," ");

        $.ajax({
          url : "<?php echo base_url('_gudanghasil/main/getGeneratedRequestCode'); ?>",
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueBahan/"+param,
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/getDetailBarangBahan",
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

      function modalEditPembelianBahanTemp(param, param2){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getDetailItemPembelianGudangBahanTemp",
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

      function modalCheckHistory(param){
        var placeholder = param.replace("_"," ");
        $("#cmbBahan1").select2({
          placeholder : "Pilih Bahan ("+placeholder+")",
          dropdownParent: $('#modalCheckHistory'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueBahan/"+param,
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueBahan/"+param,
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/getDetailBarangBahan",
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
                                                           "<option value='KOREKSI BAHAN BAKU'>Koreksi Bahan Baku</option>");
                                }else{
                                  $("#cmbKeterangan").html("<option value='#'>Pilih Jenis Koreksi Terlebih Dahulu</option>");
                                }
                                break;

            case "BIJI_WARNA" : if(jenisKoreksi == "PLUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>");
                                }else if(jenisKoreksi == "MINUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>");
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
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>");
                                }else{
                                  $("#cmbKeterangan").html("<option value='#'>Pilih Jenis Koreksi Terlebih Dahulu</option>");
                                }
                                break;

            case "CAT_MURNI" : if(jenisKoreksi == "PLUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>");
                                }else if(jenisKoreksi == "MINUS"){
                                  $("#cmbKeterangan").html("<option value='KOREKSI OPNAME'>Koreksi Opname</option>"+
                                                           "<option value='KOREKSI STOK'>Koreksi Stok</option>");
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

      function modalEditKoreksiTemp(param,param2){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getDetailKoreksi",
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

      function modalPengeluaran(param){
        var placeholder = param.replace("_"," ");
        $("#cmbBarang").select2({
          placeholder : "Pilih Bahan ("+placeholder+")",
          dropdownParent: $('#modalPengeluaran'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueBahan/"+param,
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/getDetailBarangBahan",
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

        $("#cmbBarang").on("select2:unselect",function(){
          $("#txtNamaBarang").val("");
          $("#txtJumlahPengeluaran").attr("readonly","readonly");
        });
        tablePengeluaranGudangBahan(param);
      }

      function modalEditPengeluaranTemp(param,param2){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getDetailPengeluaran",
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

      function modalLihatDetailPermintaan(param){
        $("#modalLihatPesanan").modal({
          backdrop:"static"
        });
        datatablesDetailPermintaan(param);
      }

      function modalTerimaBarangSetengah(param, param2){
        $("#trJumlahPermintaan").css("display","table-row");
        $("#btnTerima").attr("onclick","terimaBarangSetengah('"+param+"','"+param2+"')");
        $("#modalInputPenerimaanBarang").modal({
          backdrop : "static"
        });
      }

      function modalTerimaBarangFull(param, param2){
        $("#trJumlahPermintaan").css("display","none");
        $("#btnTerima").attr("onclick","terimaBarangFull('"+param+"','"+param2+"')");
        $("#modalInputPenerimaanBarang").modal({
          backdrop : "static"
        });
      }

      function modalApprove(param,param2){
        $("#modalTitle").text("Data Permintaan / Kembalian");
        datatableListApproveBahanBakuExtruder(param,param2);
        $("#btnApproveBahanBaku").removeAttr("onclick").attr("onclick","saveApproveTransaksiGudangBahan('"+param+"','"+param2+"')");
      }

      function modalTambahDataAwal(param){
        var placeholder = param.replace("_"," ");
        $("#cmbBarang2").select2({
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

        $("#cmbBarang2").on("select2:select",function(){
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

        $("#cmbBarang2").on("select2:unselect",function(){
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

      function modalTambahDataAwalGudangHasil(param, param2=""){
        var placeholder = param.replace("_"," ");
        $("#cmbNamaBarang").select2({
          placeholder : "Pilih Bahan ("+placeholder+")",
          dropdownParent: $('#modalTambahDataAwal'),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudanghasil/main/getComboBoxValueHasil/"+param+"/"+param2,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_permintaan+" | "+item.sts_brg,
                    id:item.kd_gd_hasil
                  }
                })
              };
            }
          }
        });

        $("#cmbNamaBarang").on("select2:select",function(){
          var id = $(this).val();
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/getDetailDataAwalGudangHasil",
            dataType : "JSON",
            data : {kdGdHasil:id},
            success : function(response){
              if(response.length > 0){
                $("#txtJumlahBerat").val(response[0].jumlah_berat);
                $("#txtJumlahLembar").val(response[0].jumlah_lembar);
                $("#btnAddDataAwal").attr("onclick","editDataAwalGudangHasil('"+response[0].id_permintaan_jadi+"','"+response[0].kd_gd_hasil+"')")
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

        $("#cmbNamaBarang").on("select2:unselect",function(){
          $("#btnAddDataAwal").attr("onclick","addDataAwalGudangHasil('"+param+"')")
                                 .removeClass("btn-warning")
                                 .addClass("btn-primary")
                                 .html("<i class='fa fa-plus'></i> Tambah");
          $("#txtJumlahBerat").val("");
          $("#txtJumlahLembar").val("");
        });

        $("#txtJumlahBerat").val("");
        $("#txtJumlahLembar").val("");
        $("#cmbNamaBarang").val("");
        $("#btnAddDataAwal").attr("onclick","addDataAwalGudangHasil('"+param+"')")
                               .removeClass("btn-warning")
                               .addClass("btn-primary")
                               .html("<i class='fa fa-plus'></i> Tambah");
        tableListDataAwalGudangHasilPending(param.replace(/_/gi," "));
      }
      //============================================MODAL METHOD (Finish)============================================//

      //============================================SAVE METHOD (Start)============================================//
      function updateDataOrderTerkirim(){
        var id = $("#id_detail_pengiriman").val();
        var id_dp = $("#id_dp").val();
        var jumlah_berat  = $("#txtJumlahPerKg").val().replace(/,/gi,"");
        var jumlah_lembar = $("#txtJumlahPerLembar").val().replace(/,/gi,"");
        var jumlah_kirim  = $("#txtJumlahDikirim").val().replace(/,/gi,"");
        var jumlah_sebelum= $("#txtJumlahSebelum").val().replace(/,/gi,"");

        $.ajax({
          type : "POST",
          url  : "<?php echo site_url('_gudanghasil/main/updateDataOrderTerkirim'); ?>",
          dataType : "TEXT",
          data : {id:id,
                  jumlah_berat:jumlah_berat,
                  jumlah_lembar:jumlah_lembar,
                  jumlah_kirim:jumlah_kirim,
                  jumlah_sebelum:jumlah_sebelum},
          success:function(response){
            if(jQuery.trim(response) === "Success"){
              datatableListPesananTerkirim(param="");
              modalLihatDetailPengiriman(id_dp);
              $("#modalEditDataOrderTerkirim").modal("hide");
              $("#modal-notif").addClass("modal-info");
              $("#modalNotifContent").text("Data Baru Berhasil Diperbarui");
              $("#modal-notif").modal("show");
              setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-info");
                $("#modalNotifContent").text("");
                resetFormPengirimanBaru();
                tableListPengirimanBaruTemp();
              },2000);
            }else if(jQuery.trim(response) === "Failed"){
              $("#modal-notif").addClass("modal-danger");
              $("#modalNotifContent").text("Data Baru Gagal Diperbarui");
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

      function saveAddPengirimanBaruTemp(){
        var tglPengiriman1 = $("#txtTglPengiriman").val();
        var customer1 = $("#txtNamaCustomer").val();
        var jumlahPesanan1 = $("#txtJumlahOrder").val().replace(/,/g, "");
        var jumlahBerat1 = $("#txtJumlahPerKg").val().replace(/,/g, "");
        var jumlahLembar1 = $("#txtJumlahPerLembar").val().replace(/,/g,"");
        var jumlahDikirim1 = $("#txtJumlahDikirim").val().replace(/,/g,"");
        var keterangan1 = $("#txtKeterangan").val();
        var statusPengiriman1 = $("#txtJenisBarang").val();
        var jenisJumlah1 = $("#txtJenisJumlah").val();
        var idDp1 = $("#txtIdDp").val();
        var warna1 = $("#txtWarna").val();
        var kdGdHasil1 = $("#txtKdGdHasil").val();
        var kdGdBahan1 = $("#txtKdGdBahan").val();
        if(tglPengiriman1==""||customer1==""||jumlahPesanan1==""||jumlahBerat1==""||
           jumlahLembar1==""||keterangan1==""||statusPengiriman1==""||jenisJumlah1==""||
           idDp1==""||warna1==""||jumlahDikirim1==""
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
              url : "<?php echo base_url(); ?>_gudanghasil/main/addPengirimanBaru",
              dataType : "TEXT",
              data : {kdGdHasil         : kdGdHasil1,
                      kdGdBahan         : kdGdBahan1,
                      idDp              : idDp1,
                      customer          : customer1,
                      tglPengiriman     : tglPengiriman1,
                      jumlahPesanan     : jumlahPesanan1,
                      jumlahBerat       : jumlahBerat1,
                      jumlahLembar      : jumlahLembar1,
                      jumlahDikirim     : jumlahDikirim1,
                      warna             : warna1,
                      statusPengiriman  : statusPengiriman1,
                      jenisJumlah       : jenisJumlah1,
                      keterangan        : keterangan1},
              success : function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    resetFormPengirimanBaru();
                    tableListPengirimanBaruTemp();
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

      function savePengirimanBaru(){
        if(confirm("Apakah Anda Yakin Semua Sudah Sesuai Dan Tidak Ada Yang Salah?")){
          $.ajax({
            url : "<?php echo base_url(); ?>_gudanghasil/main/savePengirimanBaru",
            dataType : "TEXT",
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Semua Item Berhasil Dikirim Ke Bagian Pengiriman");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormPengirimanBaru();
                  tableListPengirimanBaruTemp();
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Semua Item Gagal Dikirim Ke Bagian Pengiriman");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Item Pengiriman Masih Kosong!");
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

      function saveBarangBaru(param){
        var kdGdHasil1 = $("#txtKdGdHasil1").val();
        var kdAccurate1 = $("#txtKdAccurate1").val();
        var tglBuat1 = $("#txtTanggal1").val();
        var warnaPlastik1 = $("#txtWarnaPlastik1").val();
        var tebal1 = $("#txtStokTebal1").val().replace(/,/g , "");
        var ukuran1 = $("#txtUkuran1").val();
        var stokBerat1 = $("#txtStokBerat1").val().replace(/,/g , "");
        var stokLembar1 = $("#txtStokLembar1").val().replace(/,/g , "");
        if($("#cmbMerek1").val() == "Custom"){
          var merek1 = $("#txtMerek1").val();
        }else{
          var merek1 = $("#cmbMerek1").val();
        }
        var keterangan1 = $("#txtKeterangan1").val();
        var jnsPermintaan1 = $("#cmbJenisPermintaan1").val();
        var stsBarang1 = $("#cmbJenisBarang1").val();
        var jnsBarang1 = param;

        if(kdGdHasil1==""||tglBuat1==""||warnaPlastik1==""||tebal1==""||ukuran1==""||
           stokBerat1==""||stokLembar1==""||merek1==""||jnsPermintaan1==""||stsBarang1==""||jnsBarang1=="")
        {
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/saveBarangBaruGudangHasil",
            dataType : "TEXT",
            data : {kdGdHasil : kdGdHasil1,
                    kdAccurate : kdAccurate1,
                    tglBuat : tglBuat1,
                    warnaPlastik : warnaPlastik1,
                    tebal : tebal1,
                    ukuran : ukuran1,
                    stokBerat : stokBerat1,
                    stokLembar : stokLembar1,
                    merek : merek1,
                    jnsPermintaan : jnsPermintaan1,
                    jnsBarang : jnsBarang1,
                    stsBarang : stsBarang1,
                    keterangan : keterangan1},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormTambahBarangBaru(param);
                  if($("#tableDataMasterGudangHasilCampur").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilCampur","CAMPUR");
                  }
                  if($("#tableDataMasterGudangHasilKantong").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilKantong","KANTONG");
                  }
                  if($("#tableDataMasterGudangHasilBuffer").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilBuffer","SABLON","POLOS");
                  }
                  if($("#tableDataMasterGudangHasilSablon").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilSablon","SABLON","CETAK");
                  }
                  if($("#tableDataMasterGudangHasilStandard").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilStandard","STANDARD");
                  }
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

      function savePengambilanSablonTemp(){
        var tanggal1 = $("#txtTanggalPengambilan").val();
        var kdGdHasil1 = $("#cmbUkuran2").val();
        var kdGdSablonBuffer1 = $("#cmbUkuranBarangSablon").val();
        var jumlahLembar1 = $("#txtLembarPengambilan").val().replace(/,/g,"");
        var jumlahBerat1 = $("#txtBeratPengambilan").val().replace(/,/g,"");
        var keterangan1 = $("#txtKeteranganPengambilan").val();

        if(tanggal1=="" || kdGdHasil1=="" || jumlahLembar1=="" || jumlahBerat1==""){
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/addPengambilanSablon",
            dataType : "TEXT",
            data : {kdGdHasil     : kdGdHasil1,
                    kdGdSablonBuffer : kdGdSablonBuffer1,
                    tanggal       : tanggal1,
                    jumlahLembar  : jumlahLembar1,
                    jumlahBerat   : jumlahBerat1,
                    keterangan    : keterangan1
                  },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $("input").val("");
                  $(".date").datepicker("setDate",null);
                  $("#cmbUkuran2").val("").trigger("change");
                  tableListPengambilanSablonTemp();
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
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
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

      function savePengambilanSablon(){
        if(confirm("Apakah Anda Yakin Tidak Ada Yang Salah?")){
          $.ajax({
            url : "<?php echo base_url(); ?>_gudanghasil/main/savePengambilanSablon",
            dataType : "TEXT",
            success : function(response) {
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $("input").val("");
                  $(".date").datepicker("setDate",null);
                  $("#cmbUkuran2").val("").trigger("change");
                  tableListPengambilanSablonTemp();
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
                $("#modalNotifContent").text("Item Kosong!, Tidak Ada Data Yang Dikirim");
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
      }

      function savePengirimanGudangTemp(param){
        var tanggal1 = $("#txtTanggalPengiriman").val();
        var customer1 = $("#txtNamaCustomer").val();
        var kdGdHasil1 = $("#cmbUkuran3").val();
        var jumlahBerat1 = $("#txtBeratPengiriman").val().replace(/,/g, "");
        var jumlahLembar1 = $("#txtLembarPengiriman").val().replace(/,/g, "");
        var keterangan1 = $("#cmbKeteranganPengiriman").val();
        var statusPengiriman1 = param;

        if(tanggal1=="" || customer1=="" || kdGdHasil1=="" || jumlahBerat1=="" ||
           jumlahLembar1=="" || keterangan1=="" || statusPengiriman1==""
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
             url : "<?php echo base_url(); ?>_gudanghasil/main/saveAddPengirimanGudangTemp",
             dataType : "TEXT",
             data : {tanggal : tanggal1,
                     namaCustomer : customer1,
                     kdGdHasil : kdGdHasil1,
                     jumlahBerat : jumlahBerat1,
                     jumlahLembar : jumlahLembar1,
                     keterangan : keterangan1,
                     statusPengiriman : statusPengiriman1},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $("input").val("");
                  $(".date").datepicker("setDate",null);
                  $("#cmbUkuran2").val("").trigger("change");
                  tableListPengirimanGudangTemp(param);
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

      function savePengirimanGudang(param){
        if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/savePengirimanGudang",
            dataType : "TEXT",
            data : {stsPengiriman : param},
            success : function(response) {
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  resetFormPengirimanGudang(param);
                  tableListPengirimanGudangTemp(param);
                },2000);
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Baru Gagal Disimpan");
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

      function saveAddKirimanApalTemp(){
        var tanggal1 = $("#txtTanggalPengirimanApal").val();
        var kdGdApal1 = $("#cmbJenisApal").val();
        var jumlahApal1 = $("#txtJumlahApal").val().replace(/,/g, "");
        var keterangan1 = $("#txtKeteranganPengirimanApal").val();
        var warna1 = $("#cmbJenisApal option:selected").text();

        if(tanggal1=="" || kdGdApal1=="" || jumlahApal1=="" || keterangan1==""){
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/saveAddKirimanApalTemp",
            dataType : "TEXT",
            data : {
              tglTransaksi     : tanggal1,
              kdGdApal         : kdGdApal1,
              jumlahApal       : jumlahApal1,
              keterangan       : keterangan1,
              warna            : warna1
            },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPengirimanApalTemp();
                  $("input").val("");
                  $("#txtKeteranganPengirimanApal").val("KIRIMAN APAL");
                  $(".date").datepicker("setDate",null);
                  $("#cmbJenisApal").val("APL170808001");
                },2000);
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
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

      function saveKirimanApal(){
        if(confirm("Apakah Anda Yakin Tidak Ada Data Yang Salah?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/saveKirimanApal",
            dataType : "TEXT",
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Dikirim");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPengirimanApalTemp();
                  $("input").val("");
                  $("#txtKeteranganPengirimanApal").val("KIRIMAN APAL");
                  $(".date").datepicker("setDate",null);
                  $("#cmbJenisApal").val("APL170808001");
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Sebagian Data Gagal Dikirim");
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

      function saveAddKembalianGudangTemp(param){
        var kdGdHasil1 = $("#cmbUkuran4").val();
        var namaCustomer1 = $("#txtNamaCustomer1").val();
        var tanggal1 = $("#txtTanggalPengembalian").val();
        var jumlahBerat1 = $("#txtBeratPengembalian").val().replace(/,/g,"");
        var jumlahLembar1 = $("#txtLembarPengembalian").val().replace(/,/g,"");
        var keterangan1 = $("#cmbKeteranganPengembalian").val();
        var dataText = $("#cmbUkuran4").select2("data")[0]["text"];
        var arrDataText = dataText.split(" | ");
        var ukuran1 = arrDataText[1];
        var merek1 = arrDataText[2];
        var warna1 = arrDataText[3];
        var jnsPermintaan1 = arrDataText[4];
        var statusBarang1 = param;

        if(kdGdHasil1=="" || namaCustomer1=="" || tanggal1=="" || jumlahBerat1=="" ||
           jumlahLembar1=="" || keterangan1==""
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
             url : "<?php echo base_url(); ?>_gudanghasil/main/saveAddPengembalianGudang",
             dataType : "TEXT",
             data : {
               kdGdHasil        : kdGdHasil1,
               namaCustomer     : namaCustomer1,
               tglTransaksi     : tanggal1,
               jumlahBerat      : jumlahBerat1,
               jumlahLembar     : jumlahLembar1,
               keterangan       : keterangan1,
               jenisPermintaan  : jnsPermintaan1,
               statusBarang     : statusBarang1,
               merek            : merek1,
               ukuran           : ukuran1,
               warna            : warna1
             },
             success : function(response){
               if(jQuery.trim(response) === "Berhasil"){
                 $("#modal-notif").addClass("modal-info");
                 $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                 $("#modal-notif").modal("show");
                 setTimeout(function(){
                   $("#modal-notif").modal("hide");
                   $("#modal-notif").removeClass("modal-info");
                   $("#modalNotifContent").text("");
                   tableListPengembalianGudangHasil(param);
                   $("input").val("");
                   $(".date").datepicker("setDate",null);
                   $("#cmbKeteranganPengembalian").val("PENGEMBALIAN CAMPUR (BUKAN KOREKSI)");
                   $("#cmbUkuran4").val("").trigger("change");
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
               }else if(jQuery.trim(response) === "Lock"){
                 $("#modal-notif").addClass("modal-danger");
                 $("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
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

      function saveKembalianGudang(param){
        if(confirm("Apakah Anda Yakin Tidak Ada Yang Salah?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/saveKembalianGudang",
            dataType : "TEXT",
            data : {statusBarang : param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPengembalianGudangHasil(param);
                  $("input").val("");
                  $(".date").datepicker("setDate",null);
                  $("#cmbKeteranganPengembalian").val("PENGEMBALIAN CAMPUR (BUKAN KOREKSI)");
                  $("#cmbUkuran4").val("").trigger("change");
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
              }else if(jQuery.trim(response) === "BreakInMaster"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Proses Terhenti, Beberapa Data Master Gagal Diupdate");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "BreakInTransaction"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Proses Terhenti, Beberapa Transaksi Gagal Dikirim");
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

      function saveAddPembelianHd(){
        var kdGdHasil1 = $("#cmbUkuran5").val();
        var namaCustomer1 = $("#txtNamaCustomer2").val();
        var tanggal1 = $("#txtTanggalPembelian").val();
        var jumlahBerat1 = $("#txtBeratPembelian").val().replace(/,/g,"");
        var jumlahLembar1 = $("#txtLembarPembelian").val().replace(/,/g,"");
        var dataText = $("#cmbUkuran5 option:selected").text();
        var arrDataText = dataText.split(" | ");
        var ukuran1 = arrDataText[0];
        var warna1 = arrDataText[2];
        var merek1 = arrDataText[1];
        var jnsPermintaan1 = arrDataText[5];
        var statusBarang1 = arrDataText[3];

        if(kdGdHasil1==""||namaCustomer1==""||tanggal1==""||jumlahBerat1==""||jumlahLembar1==""){
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/saveAddPembelianHd",
            dataType : "TEXT",
            data : {
              kdGdHasil       : kdGdHasil1,
              ukuran          : ukuran1,
              jumlahBerat     : jumlahBerat1,
              jumlahLembar    : jumlahLembar1,
              warna           : warna1,
              namaCustomer    : namaCustomer1,
              tanggal         : tanggal1,
              merek           : merek1,
              jnsPermintaan   : jnsPermintaan1,
              statusBarang    : statusBarang1
            },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPembelianBarangHd();
                  $("input").val("");
                  $(".date").datepicker("setDate",null);
                  $("#cmbUkuran5").val("HSL1706120084");
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
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
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

      function savePembelianHd(){
        if(confirm("Apakah Anda Yakin Tidak Ada Yang Salah?")){
          $.ajax({
            url : "<?php echo base_url(); ?>_gudanghasil/main/savePembelianHd",
            dataType : "TEXT",
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPembelianBarangHd();
                  $("input").val("");
                  $(".date").datepicker("setDate",null);
                  $("#cmbUkuran5").val("HSL1706120084");
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
              }else if(jQuery.trim(response) === "BreakInMaster"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Proses Terhenti, Beberapa Data Master Gagal Diupdate");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "BreakInTransaction"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Proses Terhenti, Beberapa Transaksi Gagal Dikirim");
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

      function saveAddKoreksiGudangBuffer(param){
        var kdGdHasil1 = $("#cmbUkuran3").val();
        var jumlahBerat1 = $("#txtBeratKoreksi").val().replace(/,/g, "");
        var jumlahLembar1 = $("#txtLembarKoreksi").val().replace(/,/g, "");
        var tglTransaksi1 = $("#txtTglKoreksi").val();
        var jenisKoreksi1 = $("#cmbJenisKoreksi").val();
        var keterangan1 = $("#txtKeterangan").val();
        var dataText = $("#cmbUkuran3").select2("data")[0]["text"];
        var arrDataText = dataText.split(" | ");
        var ukuran1 = arrDataText[1];
        var warna1 = arrDataText[3];
        var merek1 = arrDataText[2];
        var jnsPermintaan1 = arrDataText[4];
        var stsBarang1 = param;

        if(kdGdHasil1=="" || jumlahBerat1=="" || jumlahLembar1=="" ||
           tglTransaksi1=="" || jenisKoreksi1==""
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
             url : "<?php echo base_url(); ?>_gudanghasil/main/saveAddKoreksiGudangBuffer",
             dataType : "TEXT",
             data : {
               kdGdHasil      : kdGdHasil1,
               ukuran         : ukuran1,
               jumlahBerat    : jumlahBerat1,
               jumlahLembar   : jumlahLembar1,
               warna          : warna1,
               tglTransaksi   : tglTransaksi1,
               merek          : merek1,
               jnsPermintaan  : jnsPermintaan1,
               stsBarang      : stsBarang1,
               jenisKoreksi   : jenisKoreksi1,
               keterangan     : keterangan1
             },
             success : function(response){
               if(jQuery.trim(response) === "Berhasil"){
                 $("#modal-notif").addClass("modal-info");
                 $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                 $("#modal-notif").modal("show");
                 setTimeout(function(){
                   $("#modal-notif").modal("hide");
                   $("#modal-notif").removeClass("modal-info");
                   $("#modalNotifContent").text("");
                   tableListKoreksiGudangBufferTemp();
                   resetFormKoreksiGudangBuffer(param);
                   $("input").val("");
                   $(".date").datepicker("setDate",null);
                   $("#cmbJenisKoreksi").val("PLUS");
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
               }else if(jQuery.trim(response) === "Lock"){
                 $("#modal-notif").addClass("modal-danger");
                 $("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
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

      function saveKoreksiGudangBuffer(){
        if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
          $.ajax({
            url : "<?php echo base_url(); ?>_gudanghasil/main/saveKoreksiGudangBuffer",
            dataType : "TEXT",
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListKoreksiGudangBufferTemp();
                  $("input").val("");
                  $(".date").datepicker("setDate",null);
                  $("#cmbJenisKoreksi").val("PLUS");
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
              }else if(jQuery.trim(response) === "BreakInMaster"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Proses Terhenti, Beberapa Data Master Gagal Diupdate");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "BreakInTransaction"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Proses Terhenti, Beberapa Transaksi Gagal Dikirim");
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

      function saveAddPengembalianKeStandard(param){
        var kdGudangSablon1 = $("#cmbUkuran5").val();
        var kdGudangStandard1 = $("#cmbUkuran5_1").val();
        var namaCustomer1 = $("#txtNamaCustomer2").val();
        var tglTransaksi1 = $("#txtTanggalPengembalian2").val();
        var jumlahBerat1 = $("#txtBeratPengembalian2").val().replace(/,/g,"");
        var jumlahLembar1 = $("#txtLembarPengembalian2").val().replace(/,/g,"");
        var keterangan1 = $("#txtKeteranganPengembalian").val();
        var dataText = $("#cmbUkuran5").select2("data")[0]["text"];
        var arrDataText = dataText.split(" | ");
        var ukuran1 = arrDataText[1];
        var warna1 = arrDataText[3];
        var merek1 = arrDataText[2];
        var jnsPermintaan1 = arrDataText[4];
        var stsBarang1 = param;
        if(kdGudangSablon1=="" || kdGudangStandard1=="" || namaCustomer1=="" ||
           tglTransaksi1=="" || jumlahBerat1=="" || jumlahLembar1=="" || keterangan1==""
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
             url : "<?php echo base_url(); ?>_gudanghasil/main/saveAddPengembalianKeGudangStandard",
             dataType : "TEXT",
             data : {
               kdGudangSablon     : kdGudangSablon1,
               kdGudangStandard   : kdGudangStandard1,
               ukuran             : ukuran1,
               jumlahBerat        : jumlahBerat1,
               jumlahLembar       : jumlahLembar1,
               warna              : warna1,
               namaCustomer       : namaCustomer1,
               tglTransaksi       : tglTransaksi1,
               merek              : merek1,
               jnsPermintaan      : jnsPermintaan1,
               stsBarang          : stsBarang1,
               keterangan         : keterangan1
             },
             success : function(response){
               if(jQuery.trim(response) === "Berhasil"){
                 $("#modal-notif").addClass("modal-info");
                 $("#modalNotifContent").text("Data Baru Berhasil Disimpan");
                 $("#modal-notif").modal("show");
                 setTimeout(function(){
                   $("#modal-notif").modal("hide");
                   $("#modal-notif").removeClass("modal-info");
                   $("#modalNotifContent").text("");
                   resetFormPengembalianKeStandard(param);
                   tableListPengembalianGudangBuffer();
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
               }else if(jQuery.trim(response) === "Lock"){
                 $("#modal-notif").addClass("modal-danger");
                 $("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
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

      function savePengembalianKeGudangStandard(){
        if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
          $.ajax({
            url : "<?php echo base_url(); ?>_gudanghasil/main/savePengembalianKeGudangStandard",
            dataType : "TEXT",
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPengembalianGudangBuffer();
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "UpdateMasterGagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Gagal, Sebagian Data Master Gagal Di Update");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "UpdateTransaksiGagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Gagal, Sebagian Data Transaksi Gagal Di Update");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Gagal, Error Tidak Terdefinisi Silahkan Hub.IT");
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

      function saveApproveKirimanDariBagian(param, param2, param3=""){
        if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudanghasil/main/saveApproveKirimanDariBagian'); ?>",
            dataType : "TEXT",
            data : {
              stsBarang : param,
              bagian : param2,
              jnsPermintaan : param3
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
                  datatableKirimanDariBagian(param, param2, param3);
                },2000);
              }else if($.trim(response) === "Berhasil Beberapa"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Beberapa Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableKirimanDariBagian(param, param2);
                },2000);
              }else if($.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
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

      function saveApproveKirimanUntukBufferSablon(param){
        if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudanghasil/main/saveApproveKirimanUntukBufferSablon'); ?>",
            dataType : "TEXT",
            data : {
              stsBarang : param
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
                  datatableKirimanUntukBufferSablon(param);
                },2000);
              }else if($.trim(response) === "Berhasil Beberapa"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Beberapa Transaksi Berhasil Disimpan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableKirimanUntukBufferSablon(param);
                },2000);
              }else if($.trim(response) === "Lock"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Disimpan");
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/saveGudangBahan",
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
                  datatableListCatMurni();
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/addPembelianGudangBahanTemp",
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

      function saveDanKirimPermintaan(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/savePembelianGudangBahan",
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/addKoreksiTemp",
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

      function savePengeluaranTemp(param){
        var tanggal1 = $("#txtTanggalPengeluaran").val();
        var kdGdBahan1 = $("#cmbBarang").val();
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/addPengeluaran",
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
          url : "<?php echo base_url(); ?>_gudanghasil/main/savePengeluaran",
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

      function saveKoreksi(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/saveKoreksi",
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
            url : "<?php echo base_url('_gudanghasil/main/terimaBarangFull'); ?>",
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
            url : "<?php echo base_url('_gudanghasil/main/terimaBarangSetengah'); ?>",
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
            url : "<?php echo base_url('_gudanghasil/main/selesaiPermintaan'); ?>",
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

      function saveApproveTransaksiGudangBahan(param,param2){
        if(confirm("Apakah Anda Yakin Tidak Ada Yang Salah?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/saveApproveTransaksiGudangBahan",
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

      function addDataAwal(param){
        var kdGdBahan = $("#cmbBarang2").val();
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
            url : "<?php echo base_url('_gudanghasil/main/addDataAwal'); ?>",
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
                  $("#cmbBarang2").val("").trigger("change");
                  $("#txtJumlahDataAwal").val("");
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
            url : "<?php echo base_url("_gudanghasil/main/saveDataAwal") ?>",
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

      function addDataAwalGudangHasil(param){
        var kdGdHasil = $("#cmbNamaBarang").val();
        var jumlahBerat = $("#txtJumlahBerat").val().replace(/,/gi,"");
        var jumlahLembar = $("#txtJumlahLembar").val().replace(/,/gi,"");
        var dataText = $("#cmbNamaBarang").select2('data')[0]["text"];
        var arrDataText = dataText.split(" | ");

        if(kdGdHasil=="" || jumlahBerat=="" || jumlahLembar==""){
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
            url : "<?php echo base_url('_gudanghasil/main/addDataAwalGudangHasil'); ?>",
            dataType : "TEXT",
            data : {
              kdGdHasil : kdGdHasil,
              ukuran : arrDataText[1],
              warna : arrDataText[3],
              merek : arrDataText[2],
              jnsPermintaan : arrDataText[4],
              stsBarang : param,
              jumlahBerat : jumlahBerat,
              jumlahLembar : jumlahLembar
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
                  tableListDataAwalGudangHasilPending(param);
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

      function saveDataAwalGudangHasil(param){
        if(confirm("Apakah Anda Yakin Tidak Ada Yang Salah?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudanghasil/main/saveDataAwalGudangHasil') ?>",
            dataType : "TEXT",
            data : {
              stsBarang : param
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
                  tableListDataAwalGudangHasilPending(param);
                  $(".active a").click();
                  $("#modalTambahDataAwal").modal("hide");
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
                $("#modalNotifContent").text("Data Kosong");
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
      function editBarangGudangHasil(){
        var kdGdHasil1 = $("#txtKdGdHasil1").val();
        var kdAccurate1 = $("#txtKdAccurate1").val();
        var tglBuat1 = $("#txtTanggal1").val();
        var warnaPlastik1 = $("#txtWarnaPlastik1").val();
        var tebal1 = $("#txtStokTebal1").val().replace(/,/g , "");
        var ukuran1 = $("#txtUkuran1").val();
        if($("#cmbMerek1").val() == "Custom"){
          var merek1 = $("#txtMerek1").val();
        }else{
          var merek1 = $("#cmbMerek1").val();
        }
        var keterangan1 = $("#txtKeterangan1").val();
        var jnsPermintaan1 = $("#cmbJenisPermintaan1").val();
        var stsBarang1 = $("#cmbJenisBarang1").val();

        if(kdGdHasil1==""||tglBuat1==""||warnaPlastik1==""||tebal1==""||ukuran1==""||
           merek1==""||jnsPermintaan1==""||stsBarang1=="")
        {
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/editBarangGudangHasil",
            dataType : "TEXT",
            data : {kdGdHasil : kdGdHasil1,
                    kdAccurate : kdAccurate1,
                    tglBuat : tglBuat1,
                    warnaPlastik : warnaPlastik1,
                    tebal : tebal1,
                    ukuran : ukuran1,
                    merek : merek1,
                    jnsPermintaan : jnsPermintaan1,
                    stsBarang : stsBarang1,
                    keterangan : keterangan1},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  if($("#tableDataMasterGudangHasilCampur").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilCampur","CAMPUR");
                  }
                  if($("#tableDataMasterGudangHasilKantong").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilKantong","KANTONG");
                  }
                  if($("#tableDataMasterGudangHasilBuffer").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilBuffer","SABLON","POLOS");
                  }
                  if($("#tableDataMasterGudangHasilSablon").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilSablon","SABLON","CETAK");
                  }
                  if($("#tableDataMasterGudangHasilStandard").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilStandard","STANDARD");
                  }
                  $("#modalTambahGudangHasil").modal("hide");
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

      function editTransaksiGudangHasil(param1,param2,param3,param4){
        var tanggal1 = $("#txtTglHistoryMasuk").val();
        var kdGdHasil2 = $("#cmbUkuran6").val();
        var berat1 = $("#txtBeratMasukHistory").val().replace(/,/g, "");
        var lembar1 = $("#txtLembarMasukHistory").val().replace(/,/g, "");
        var jumlahPengiriman1 = $("txtJumlahPengiriman").val();
        var idTransaksi1 = param1;

        if(tanggal1==""||berat1==""||lembar1==""||idTransaksi1==""){
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/editHistoryGudangHasil",
            dataType : "TEXT",
            data : {idTransaksi : idTransaksi1,
                    kdGdHasil1 : param4,
                    kdGdHasil2 : kdGdHasil2,
                    tanggal : tanggal1,
                    berat : berat1,
                    lembar : lembar1,
                    tglAwal : param2,
                    tglAkhir : param3,
                    jumlahPengiriman : jumlahPengiriman1},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Transaksi Berhasil Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  $("#modalEditHistoryMasukGudangHasil").modal("hide");
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Transaksi Gagal Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else if(jQuery.trim(response) === "Update Stok Master Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Master Gagal Diubah");
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

      function editPengirimanGudangTemp(param1, param2){
        var idTransaksi1 = param2;
        var tanggal1 = $("#txtTanggalPengiriman").val();
        var customer1 = $("#txtNamaCustomer").val();
        var jumlahBerat1 = $("#txtBeratPengiriman").val().replace(/,/g, "");
        var jumlahLembar1 = $("#txtLembarPengiriman").val().replace(/,/g, "");
        var keterangan1 = $("#cmbKeteranganPengiriman").val();

        if(idTransaksi1=="" || tanggal1=="" || customer1=="" ||
           jumlahBerat1=="" || jumlahLembar1=="" || keterangan1==""
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
             url : "<?php echo base_url(); ?>_gudanghasil/main/editPengirimanGudangTemp",
             dataType : "TEXT",
             data : {
               idTransaksi    : idTransaksi1,
               tanggal        : tanggal1,
               namaCustomer   : customer1,
               jumlahBerat    : jumlahBerat1,
               jumlahLembar   : jumlahLembar1,
               keterangan     : keterangan1
             },
             success : function(response){
               if(jQuery.trim(response)==="Berhasil"){
                 $("#modal-notif").addClass("modal-info");
                 $("#modalNotifContent").text("Data Transaksi Berhasil Diubah");
                 $("#modal-notif").modal("show");
                 setTimeout(function(){
                   $("#modal-notif").modal("hide");
                   $("#modal-notif").removeClass("modal-info");
                   $("#modalNotifContent").text("");
                   tableListPengirimanGudangTemp(param1);
                   resetFormPengirimanGudang(param1);
                 },2000);
               }else if(jQuery.trim(response)==="Gagal"){
                 $("#modal-notif").addClass("modal-danger");
                 $("#modalNotifContent").text("Data Transaksi Gagal Diubah");
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
               $("#modal-notif").addClass("modal-warning");
               $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
               $("#modal-notif").modal("show");
               setTimeout(function(){
                $("#modal-notif").modal("hide");
                $("#modal-notif").removeClass("modal-warning");
                $("#modalNotifContent").text("");
               },2000);
             }
           });
         }
      }

      function editKoreksiGudangBufferTemp(param,param2){
        var kdGdHasil1 = $("#cmbUkuran3").val();
        var jumlahBerat1 = $("#txtBeratKoreksi").val().replace(/,/g, "");
        var jumlahLembar1 = $("#txtLembarKoreksi").val().replace(/,/g, "");
        var tglTransaksi1 = $("#txtTglKoreksi").val();
        var jenisKoreksi1 = $("#cmbJenisKoreksi").val();
        var keterangan1 = $("#txtKeterangan").val();
        if(kdGdHasil1=="" || kdGdHasil1==null){
          var dataText = "";
        }else{
          var dataText = $("#cmbUkuran3").select2("data")[0]["text"];
        }
        var arrDataText = dataText.split(" | ");
        var ukuran1 = arrDataText[1];
        var warna1 = arrDataText[3];
        var merek1 = arrDataText[2];
        var jnsPermintaan1 = arrDataText[4];
        var stsBarang1 = param;

        if(jumlahBerat1=="" || jumlahLembar1=="" ||
           tglTransaksi1=="" || jenisKoreksi1==""
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
             url : "<?php echo base_url(); ?>_gudanghasil/main/editKoreksiGudangBufferTemp",
             dataType : "TEXT",
             data : {
               idTransaksi    : param2,
               kdGdHasil      : kdGdHasil1,
               ukuran         : ukuran1,
               jumlahBerat    : jumlahBerat1,
               jumlahLembar   : jumlahLembar1,
               warna          : warna1,
               tglTransaksi   : tglTransaksi1,
               merek          : merek1,
               jnsPermintaan  : jnsPermintaan1,
               stsBarang      : stsBarang1,
               jenisKoreksi   : jenisKoreksi1,
               keterangan     : keterangan1
             },
             success : function(response){
               if(jQuery.trim(response) === "Berhasil"){
                 $("#modal-notif").addClass("modal-info");
                 $("#modalNotifContent").text("Data Baru Berhasil Diubah");
                 $("#modal-notif").modal("show");
                 setTimeout(function(){
                   $("#modal-notif").modal("hide");
                   $("#modal-notif").removeClass("modal-info");
                   $("#modalNotifContent").text("");
                   tableListKoreksiGudangBufferTemp();
                   resetFormKoreksiGudangBuffer(param);
                   $("input").val("");
                   $(".date").datepicker("setDate",null);
                   $("#cmbJenisKoreksi").val("PLUS");
                 },2000);
               }else{
                 $("#modal-notif").addClass("modal-danger");
                 $("#modalNotifContent").text("Data Baru Gagal Diubah");
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/editGudangBahan",
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
                  datatableListCatMurni();
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/editPembelianGudangBahanTemp",
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/editKoreksiTemp",
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
            url : "<?php echo base_url(); ?>_gudanghasil/main/editPengeluaran",
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

      function editDataAwal(param, param2){
        var jumlah = $("#txtJumlahDataAwal").val().replace(/,/gi,"");
        if(jumlah==""){
          $("#modal-danger").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudanghasil/main/editDataAwal') ?>",
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
                  $("#cmbBarang2").val("").trigger("change").trigger("select2:unselect");
                },2000);
              }else if($.trim(response) === "Gagal"){
                $("#modal-danger").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-danger").addClass("modal-warning");
                $("#modalNotifContent").text("Semua Kolom Kuning Tidak Boleh Kosong!");
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

      function editDataAwalGudangHasil(param, param2){
        var jumlahBerat = $("#txtJumlahBerat").val().replace(/,/gi,"");
        var jumlahLembar = $("#txtJumlahLembar").val().replace(/,/gi,"");
        if(jumlahBerat=="" || jumlahLembar==""){
          $("#modal-danger").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Kuning Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudanghasil/main/editDataAwalGudangHasil') ?>",
            dataType : "TEXT",
            data : {
              idTransaksi : param,
              kdBarang : param2,
              jumlahBerat : jumlahBerat,
              jumlahLembar : jumlahLembar
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
                  $("#txtJumlahBerat").val("");
                  $("#txtJumlahLembar").val("");
                  $("#cmbNamaBarang").val("").trigger("change").trigger("select2:unselect");
                },2000);
              }else if($.trim(response) === "Gagal"){
                $("#modal-danger").addClass("modal-danger");
                $("#modalNotifContent").text("Transaksi Gagal Diubah");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-danger").addClass("modal-warning");
                $("#modalNotifContent").text("Semua Kolom Kuning Tidak Boleh Kosong!");
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
      //============================================EDIT METHOD (Finish)============================================//

      //============================================DELETE METHOD (Start)============================================//
      function deletePengirimanBaruTemp(param){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deletePengirimanBaruTemp",
            dataType : "TEXT",
            data : {idDetailPengiriman:param},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Transaksi Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPengirimanBaruTemp();
                  reloadTrashGudangHasil();
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

      function deleteBarangGudangHasil(param){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Barang Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deleteAndRestoreBarangGudangHasil",
            dataType : "TEXT",
            data : {kdGdHasil : param, deleted : "TRUE"},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  if($("#tableDataMasterGudangHasilCampur").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilCampur","CAMPUR");
                  }
                  if($("#tableDataMasterGudangHasilKantong").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilKantong","KANTONG");
                  }
                  if($("#tableDataMasterGudangHasilBuffer").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilBuffer","SABLON","POLOS");
                  }
                  if($("#tableDataMasterGudangHasilSablon").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilSablon","SABLON","CETAK");
                  }
                  if($("#tableDataMasterGudangHasilStandard").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilStandard","STANDARD");
                  }
                  reloadTrashGudangHasil();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Baru Gagal Dihapus");
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

      function deleteTransaksiGudangHasil(param1,param2,param3,param4,param5){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deleteAndRestoreTransaksiGudangHasil",
            dataType : "TEXT",
            data : {idTransaksi : param2,
                    tglAwal : param3,
                    tglAkhir : param4,
                    kdGdHasil : param5,
                    deleted : "TRUE"},
            success : function(response){
              if(jQuery.trim(response)==="Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableSearchHistoryGudangHasilMasuk(param1,param3,param4,param5);
                  reloadTrashGudangHasil();
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

      function deletePengambilanSablonTemp(param){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deleteAndRestorePengambilanSablonTemp",
            dataType : "TEXT",
            data : {idPengambilanSablon : param, deleted : "TRUE"},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPengambilanSablonTemp();
                  reloadTrashGudangHasil();
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

      function deletePengirimanGudangTemp(param1, param2){
        if(confirm("Apakah Anda Yakin Menghapus Transaksi Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deleteAndRestorePengirimanGudangTemp",
            dataType : "TEXT",
            data : {
              idTransaksi : param2,
              deleted : "TRUE"
            },
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPengirimanGudangTemp(param1);
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Gagal Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Parameter Kosong!");
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

      function deletePengirimanApalTemp(param){
        if (confirm("Apakah Anda Yakin Ingin Menghapus Transaksi Ini?")) {
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deletedAndRestoreTransaksiDetailHistoryApalTemp",
            dataType : "TEXT",
            data : {idTransaksi : param, deleted : "TRUE"},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPengirimanApalTemp();
                  reloadTrashGudangHasil();
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Gagal Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Parameter Kosong!");
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

      function deletePengembalianGudangHasil(param1, param2){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Transaksi Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deleteAndRestorePengembalianGudangHasil",
            dataType : "TEXT",
            data : {idTransaksi : param2, deleted : "TRUE"},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPengembalianGudangHasil(param1);
                  reloadTrashGudangHasil();
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Gagal Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Parameter Kosong!");
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

      function deletePembelianBarangHd(param){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deleteAndRestorePengembalianGudangHasil",
            dataType : "TEXT",
            data : {idTransaksi : param, deleted:"TRUE"},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPembelianBarangHd();
                  reloadTrashGudangHasil();
                },2000);
              }else if(jQuery.trim(response) === "Gagal"){
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Gagal Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-danger");
                  $("#modalNotifContent").text("");
                },2000);
              }else{
                $("#modal-notif").addClass("modal-warning");
                $("#modalNotifContent").text("Parameter Kosong!");
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

      function deleteTransaksiGudangBuffer(param){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Transaksi Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deleteAndRestoreTransaksiGudangBufferTemp",
            dataType : "TEXT",
            data : {idTransaksi : param, deleted:"TRUE"},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListKoreksiGudangBufferTemp();
                  reloadTrashGudangHasil();
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

      function deletePengembalianGudangBuffer(param){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Transaksi Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deleteAndRestoreTransaksiGudangBufferTemp",
            dataType : "TEXT",
            data : {idTransaksi : param, deleted:"TRUE"},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Berhasil Dihapus");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  tableListPengembalianGudangBuffer();
                  reloadTrashGudangHasil();
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

      function deleteGudangBahan(param){
        if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deleteGudangBahan",
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
                  datatableListCatMurni();
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
            url : "<?php echo base_url() ?>_gudanghasil/main/removePembelianTemp",
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
                  tableListPembelianBahanBakuTemp("CAT MURNI");

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
            url : "<?php echo base_url(); ?>_gudanghasil/main/deleteTransaksiGudangBahan",
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
                  // reloadTrash();
                  tableListKoreksi(param2);
                  resetFormPengeluaran(param2);
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
            url : "<?php echo base_url('_gudanghasil/main/deleteAndRestorePermintaanBarang'); ?>",
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
            url : "<?php echo base_url('_gudanghasil/main/deleteAndRestoreListDataAwalPending'); ?>",
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

      function deleteAndRestoreDataAwalGudangHasilPending(param, param2, param3){
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
            url : "<?php echo base_url('_gudanghasil/main/deleteAndRestoreDataAwalGudangHasilPending'); ?>",
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
                  tableListDataAwalGudangHasilPending(param2.replace(/_/gi," "));
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
      function resetFormPengirimanBaru(){
        $("#txtTglPengiriman").val("");
        $("#txtNamaCustomer").val("");
        $("#txtJumlahOrder").val("");
        $("#txtJumlahPerKg").val("");
        $("#txtJumlahPerLembar").val("");
        $("#txtJenisBarang").val("");
        $("#txtJumlahDikirim").val("");
        $("#txtJenisJumlah").val("");
        $("#txtIdDp").val("");
        $("#txtWarna").val("");
        $("#txtKdGdHasil").val("");
        $("#txtKdGdBahan").val("");
        $(".date").datepicker("setDate",null);
        $("#btnSelesaiKiriman").attr("onclick","savePengirimanBaru()");
      }

      function resetFormTambahBarangBaru(param,param2=""){
        $("input, select").val("");
        $("#cmbJenisPermintaan1").val("POLOS");
        $("#cmbJenisBarang1").val("LOKAL");
        $(".date").datepicker("setDate",null);
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getGeneratedGudangHasilCode",
          dataType : "JSON",
          data : {
            jns_brg        : param,
            jns_permintaan : param2
          },
          success : function(response){
            $("#txtKdGdHasil1").val(response.Code);
            $("#btnSaveGudangHasil").removeAttr("onclick").attr("onclick","saveBarangBaru('"+param+"')");
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

      function resetFormPengirimanGudang(param){
        $("input").val("");
        $(".date").datepicker("setDate",null);
        $("#cmbUkuran3").val("").trigger("change").removeAttr("disabled");
        $("#cmbKeteranganPengiriman").val("PENGIRIMAN(KOREKSI STOK)");
        $("#btnAddPengirimanCampur").attr("onclick","savePengirimanGudangTemp('"+param+"')").html("<i class='fa fa-plus'></i> Tambah");
      }

      function resetFormKoreksiGudangBuffer(param){
        $("input").val("");
        $("#cmbUkuran3").val("").trigger("change");
        $("#cmbJenisKoreksi").val("PLUS");
        $(".date").datepicker("setDate",null);
        $("#btnAddKoreksiGudangHasil").attr("onclick","saveAddKoreksiGudangBuffer('"+param+"')").html("<i class='fa fa-plus'></i> Tambah");
      }

      function resetFormPengembalianKeStandard(param){
        $("input").val("");
        $('#txtKeteranganPengembalian').val("PENGEMBALIAN KE GUDANG STANDARD");
        $(".date").datepicker("setDate",null);
        $("#cmbUkuran5").val("").trigger("change");
        $("#btnAddPengembalianBarangStandard").attr("onclick","saveAddPengembalianKeStandard('"+param+"')").html("<i class='fa fa-plus'></i> Tambah");
        $("#btnSavePengembalianStandard").attr("onclick","savePengembalianKeGudangStandard()");
      }

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
          url : "<?php echo base_url(); ?>_gudanghasil/main/getGeneratedGudangBahanCode",
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
        $("#keterangan").val("PENGELUARAN KE CETAK");
        $("#btnAddPengeluaran").removeAttr("onclick").attr("onclick","savePengeluaranTemp('"+param+"')").html("<i class='fa fa-plus'></i> Tambah");
      }
      //============================================RESET METHOD (Finish)============================================//

      //============================================RELOAD METHOD (Start)============================================//
      function reloadTrashGudangHasil(){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getCountTrashGudangHasil",
          dataType : "JSON",
          success : function(response){
            $("#count-trash").text(response.Jumlah);
          }
        });
      }

      function reloadAlert(param,param2,param3){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getCountAlert",
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
          url : "<?php echo base_url(); ?>_gudanghasil/main/getCountAlertPembelianGudangBahan",
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

      function alertPermintaanCatSablon(){
        $.ajax({
          type : "POST",
          url  : "<?php echo site_url('_gudanghasil/main/countPermintaanCatSablon'); ?>",
          success:function(response){
            if (response>0) {
              $("#alertPermintaanCatSablon").show();
            }else{
              $("#alertPermintaanCatSablon").hide();
            }
          }
        });
      }
      //============================================RELOAD METHOD (Finish)============================================//

      //============================================RESTORE METHOD (Start)============================================//
      function restoreBarangGudangHasil(param){
        if(confirm("Apakah Anda Yakin Ingin Mengembalikan Barang Ini?")){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deleteAndRestoreBarangGudangHasil",
            dataType : "TEXT",
            data : {kdGdHasil:param, deleted:"FALSE"},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Dipulihkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  if($("#tableDataMasterGudangHasilCampur").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilCampur","CAMPUR");
                  }
                  if($("#tableDataMasterGudangHasilKantong").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilKantong","KANTONG");
                  }
                  if($("#tableDataMasterGudangHasilBuffer").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilBuffer","SABLON","POLOS");
                  }
                  if($("#tableDataMasterGudangHasilSablon").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilSablon","SABLON","CETAK");
                  }
                  if($("#tableDataMasterGudangHasilStandard").length){
                    datatableListGudangHasil("#tableDataMasterGudangHasilStandard","STANDARD");
                  }
                  reloadTrashGudangHasil();
                  datatableTrashListGudangHasil();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Baru Gagal Dipulihkan");
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

      function restoreTransaksiGudangHasil(param1,param2){
        if(confirm("Apakah Anda Yakin Ingin Mengembalikan Data Ini?")){
          tglAwal1 = "<?php echo date("Y-m-d",strtotime('-1 days')); ?>";
          tglAkhir1 = "<?php echo date("Y-m-d"); ?>";
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_gudanghasil/main/deleteAndRestoreTransaksiGudangHasil",
            dataType : "TEXT",
            data : {idTransaksi : param1, kdGdHasil:param2, tglAwal:tglAwal1, tglAkhir:tglAkhir1, deleted:"FALSE"},
            success : function(response){
              if(jQuery.trim(response) === "Berhasil"){
                $("#modal-notif").addClass("modal-info");
                $("#modalNotifContent").text("Data Baru Berhasil Dipulihkan");
                $("#modal-notif").modal("show");
                setTimeout(function(){
                  $("#modal-notif").modal("hide");
                  $("#modal-notif").removeClass("modal-info");
                  $("#modalNotifContent").text("");
                  datatableTrashHistoryGudangHasil();
                  reloadTrashGudangHasil();
                },2000);
              }else{
                $("#modal-notif").addClass("modal-danger");
                $("#modalNotifContent").text("Data Baru Gagal Dipulihkan");
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
      function cariHistoryGudangHasil(param){
        tglAwal = $("#txtTglAwal1").val();
        tglAkhir = $("#txtTglAkhir1").val();
        kdGdHasil = $("#cmbUkuran1").val();
        if(kdGdHasil=="" || kdGdHasil==null){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Dan Bahan Baku Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          var dataText = $("#cmbUkuran1").select2("data")[0]["text"];
          var arrDataText = dataText.split(" | ");
          var arrTglAwal = tglAwal.split("-");
          var arrTglAkhir = tglAkhir.split("-");
          var arrMonth = ["Januari","Februari","Maret","April","Mei","Juni",
          "Juli","Agustus","September","Oktober","November","Desember"];
          var dateTglAwal = new Date(arrTglAwal[0],arrTglAwal[1]-1,arrTglAwal[2]);
          var dateTglAkhir = new Date(arrTglAkhir[0],arrTglAkhir[1]-1,arrTglAkhir[2]);
        }
        if(tglAwal=="" || tglAkhir=="" || kdGdHasil==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Dan Bahan Baku Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          datatableSearchHistoryGudangHasilMasuk(param,tglAwal,tglAkhir,kdGdHasil);
          datatableSearchHistoryGudangHasilKeluar(param,tglAwal,tglAkhir,kdGdHasil);
          $("#modalCariHistory").modal("hide");
          $("#masterContainerHasil").css("display","none");
          $("#historyContainerApal").css("display","none");
          $("#historyContainerHasil").css("display","block");
          $("#txtDetailHistory").text("Detail History Masuk "+
                                       arrDataText[1]+" ( "+
                                       arrDataText[2]+" "+arrDataText[3]+" ) Tanggal "+
                                       dateTglAwal.getDate() + " " +
                                       arrMonth[dateTglAwal.getMonth()] + " "+
                                       dateTglAwal.getFullYear() +" - " +
                                       dateTglAkhir.getDate() + " " +
                                       arrMonth[dateTglAkhir.getMonth()] + " "+
                                       dateTglAkhir.getFullYear());
          $("#txtDetailHistory2").text("Detail History Keluar "+
                                       arrDataText[1]+" ( "+
                                       arrDataText[2]+" "+arrDataText[3]+" ) Tanggal "+
                                       dateTglAwal.getDate() + " " +
                                       arrMonth[dateTglAwal.getMonth()] + " "+
                                       dateTglAwal.getFullYear() +" - " +
                                       dateTglAkhir.getDate() + " " +
                                       arrMonth[dateTglAkhir.getMonth()] + " "+
                                       dateTglAkhir.getFullYear());
          $("#btnRefreshTableHistory").attr("onclick","datatableSearchHistoryGudangHasilMasuk('"+param+"','"+tglAwal+"','"+tglAkhir+"','"+kdGdHasil+"')");
        }
      }

      function cariHistoryGudangHasilBuffer(param){
        tglAwal = $("#txtTglAwal1").val();
        tglAkhir = $("#txtTglAkhir1").val();
        kdGdHasil = $("#cmbUkuran1").val();
        if(kdGdHasil=="" || kdGdHasil==null){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Dan Bahan Baku Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          var dataText = $("#cmbUkuran1").select2("data")[0]["text"];
          var arrDataText = dataText.split(" | ");
          var arrTglAwal = tglAwal.split("-");
          var arrTglAkhir = tglAkhir.split("-");
          var arrMonth = ["Januari","Februari","Maret","April","Mei","Juni",
          "Juli","Agustus","September","Oktober","November","Desember"];
          var dateTglAwal = new Date(arrTglAwal[0],arrTglAwal[1]-1,arrTglAwal[2]);
          var dateTglAkhir = new Date(arrTglAkhir[0],arrTglAkhir[1]-1,arrTglAkhir[2]);
        }
        if(tglAwal=="" || tglAkhir=="" || kdGdHasil==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Dan Bahan Baku Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          datatableSearchHistoryGudangBufferKeluar(param,tglAwal,tglAkhir,kdGdHasil);
          datatableSearchHistoryGudangHasilBufferMasuk(param,tglAwal,tglAkhir,kdGdHasil);
          $("#modalCariHistory").modal("hide");
          $("#masterContainerHasil").css("display","none");
          $("#historyContainerApal").css("display","none");
          $("#historyContainerHasil").css("display","block");
          $("#txtDetailHistory").text("Detail History Masuk "+
                                       arrDataText[1]+" ( "+
                                       arrDataText[2]+" "+arrDataText[3]+" ) Tanggal "+
                                       dateTglAwal.getDate() + " " +
                                       arrMonth[dateTglAwal.getMonth()] + " "+
                                       dateTglAwal.getFullYear() +" - " +
                                       dateTglAkhir.getDate() + " " +
                                       arrMonth[dateTglAkhir.getMonth()] + " "+
                                       dateTglAkhir.getFullYear());
          $("#txtDetailHistory2").text("Detail History Keluar "+
                                       arrDataText[1]+" ( "+
                                       arrDataText[2]+" "+arrDataText[3]+" ) Tanggal "+
                                       dateTglAwal.getDate() + " " +
                                       arrMonth[dateTglAwal.getMonth()] + " "+
                                       dateTglAwal.getFullYear() +" - " +
                                       dateTglAkhir.getDate() + " " +
                                       arrMonth[dateTglAkhir.getMonth()] + " "+
                                       dateTglAkhir.getFullYear());
          $("#btnRefreshTableHistory").attr("onclick","datatableSearchHistoryGudangHasilBufferMasuk('"+param+"','"+tglAwal+"','"+tglAkhir+"','"+kdGdHasil+"')");
        }
      }

      function cariHistoryGudangApal(){
        tglAwal = $("#txtTglAwal2").val();
        tglAkhir = $("#txtTglAkhir2").val();
        kdGdHasil = $("#cmbJenisApal2").val();
      }

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

      function searchDataKartuStok(){
        var tglAwal = $("#txtTglAwal").val();
        var tglAkhir = $("#txtTglAkhir").val();
        var stsBarang = $("#cmbJenis").val();

        if(tglAwal=="" || tglAkhir=="" || stsBarang==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Dan Bahan Baku Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          tableCekKartuStok(tglAwal, tglAkhir, stsBarang);
          $("#btnSortir").attr("onclick","searchDataKartuStokSort('"+tglAwal+"','"+tglAkhir+"','"+stsBarang+"')");
          $("#modalCariKartuStok").modal("hide");
        }
      }

      function searchDataKartuStokSort(param, param2, param3){
        if(param=="" || param2=="" || param3==""){
          $("#modal-notif").addClass("modal-warning");
          $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Dan Bahan Baku Tidak Boleh Kosong!");
          $("#modal-notif").modal("show");
          setTimeout(function(){
            $("#modal-notif").modal("hide");
            $("#modal-notif").removeClass("modal-warning");
            $("#modalNotifContent").text("");
          },2000);
        }else{
          tableCekKartuStokSort(param, param2, param3);
        }
      }
      //============================================SEARCH METHOD (Finish)============================================//

      //============================================DATATABLE METHOD (Start)============================================//
      function searchDataPengirminan(){
        var key = $("#searchPengirimanBaru").val();
        datatableListPengirimanBaru(key)
      }

      function datatableListPengirimanBaru(param1){
        $("#tableDataPengirimanBaru").dataTable().fnDestroy();
        $("#tableDataPengirimanBaru").dataTable({
          // "fixedHeader" : true,
          "bFilter": false ,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType" : "full_numbers",
          "sAjaxSource" : "<?php echo base_url(); ?>_gudanghasil/main/getListPengirimanBaruDatatable",
          "columns" : [
            {"data" : "no_order", "name" : "GH.ukuran"},
            {"data" : "ukuran", "name" : "GH.ukuran"},
            {"data" : "nm_pemesan", "name" : "P.nm_pemesan"},
            {"data" : "tgl_pesan", "name" : "P.tgl_pesan"},
            {"data" : "warna_plastik", "name" : "GH.warna_plastik"},
            {"data" : "merek", "name" : "PD.merek"},
            {"data" : "dll", "name" : "PD.dll"},
            {"data" : "sm", "name" : "PD.sm"},
            {"data" : "jumlah", "name" : "PD.jumlah"},
            {"data" : "jumlah_kirim", "name" : "PD.jumlah_kirim"},
            {"data" : "sisa", "name" : "PD.jumlah"},
            {"data" : "note", "name" : "P.note"},
            {"data" : "no_order", "name" : "P.no_order"}
          ],
          "fnServerData" : function(sSource,aoData,fnCallback){
            aoData.push({"name":"key","value":param1});
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
            if(aData["kd_order"]==""||aData["kd_order"]==null){
              if (aData["nm_pemesan"] == aData["nm_perusahaan"]) {
                $("td:eq(2)",nRow).html(aData["nm_pemesan"]+"<label class='text-blue'>["+aData["no_order"]+"]</label>"+
                                      "<label class='text-blue'>["+aData["no_po"]+"]</label>");
              }else{
                 $("td:eq(2)",nRow).html(aData["nm_perusahaan"]+"<BR>"+aData["nm_pemesan"]+"<label class='text-blue'>["+aData["no_order"]+"]</label>"+
                                      "<label class='text-blue'>["+aData["no_po"]+"]</label>");
              }

            }else{
              if (aData["nm_pemesan"] == aData["nm_perusahaan"]) {
                $("td:eq(2)",nRow).html(aData["nm_pemesan"]+"<label class='text-blue'>["+aData["no_order"]+"]</label>"+
                                      "<label class='text-blue'>["+aData["kd_order"]+"]</label>");
              }else{
                $("td:eq(2)",nRow).html(aData["nm_perusahaan"]+" ("+aData["nm_pemesan"]+")"+"<label class='text-blue'>["+aData["no_order"]+"]</label>"+
                                      "<label class='text-blue'>["+aData["kd_order"]+"]</label>");
              }

            }

            if(aData["jumlah_kirim"] == 0){
              $("td:eq(9)",nRow).css("background-color","#00c0ef");
            }

            $("td:eq(8)",nRow).text(parseFloat(aData["jumlah"]).toLocaleString()+" "+aData["satuan"]);
            $("td:eq(9)",nRow).text(parseFloat(aData["jumlah_kirim"]).toLocaleString()+" "+aData["satuan"]);
            $("td:eq(10)",nRow).text(parseFloat(aData["sisa"]).toLocaleString()+" "+aData["satuan"]);

            // $("td:eq(11)",nRow).html("<button class='btn btn-md btn-flat btn-info' onclick=modalLihatNote('"+aData["no_order"]+"','"+aData["id_dp"]+"')>Lihat Note</button>");
            $("td:eq(12)",nRow).html("<button class='btn btn-md btn-flat btn-primary margin' onclick=modalKirimPesanan('"+aData["id_dp"]+"')>Kirim</button><button class='btn btn-md btn-flat btn-primary margin' onclick=modalEditStatus('"+aData["id_dp"]+"')>Edit Status</button>");
            if(aData["note"]==null || aData["note"]==""){
              $("td:eq(11)",nRow).html(aData["keterangan"]);
            }else{
              $("td:eq(11)",nRow).html(aData["note"]);
            }
          }
        });
      }

      function modalEditStatus(id){
        $("#idDp").val(id);
        $("#modal_editStatus").modal("show");
      }

      function updateStatus(){
        var id = $("#idDp").val();
        var status = $("#status").val();
        $.ajax({
          type : "POST",
          url  : "<?php echo site_url('_gudanghasil/main/updateStatus'); ?>",
          data : {id:id, status:status},
          success:function(response){
            if (jQuery.trim(response) === 'Berhasil') {
              datatableListPengirimanBaru()
              $("#modal_editStatus").modal("hide");
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Status Barang Berhasil Diubah </b></div>");
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
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Status Barang Gagal Diubah</b></div>");
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

      function searchDataTerkirim(){
        var key = $("#searchOrderTerkirim").val();
        datatableListPesananTerkirim(key)
      }

      function datatableListPesananTerkirim(param1){
        $("#tableDataOrderTerkirim").css("font-size","14px");
        $("#tableDataOrderTerkirim").dataTable().fnDestroy();
        $("#tableDataOrderTerkirim").dataTable({
          // "fixedHeader" : true,
          "bFilter": false ,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType" : "full_numbers",
          "sAjaxSource" : "<?php echo base_url(); ?>_gudanghasil/main/getListPesananTerkirim",
          "columns" : [
            {"data" : "no_order", "name" : "P.no_order"},
            {"data" : "tgl_pesan", "name" : "P.tgl_pesan"},
            {"data" : "nm_pemesan", "name" : "P.nm_pemesan"},
            {"data" : "ukuran", "name" : "GH.ukuran"},
            {"data" : "warna_plastik", "name" : "GH.warna_plastik"},
            {"data" : "merek", "name" : "GH.merek"},
            {"data" : "dll", "name" : "PD.dll"},
            {"data" : "jumlah", "name" : "PD.jumlah"},
            {"data" : "jumlah_kirim", "name" : "PD.jumlah_kirim"},
            {"data" : "sisa", "name" : "PD.jumlah"},
            {"data" : "no_order", "name" : "C.nm_perusahaan"}
          ],
          "fnServerData" : function(sSource,aoData,fnCallback){
            aoData.push({"name":"key","value":param1});
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
            if(aData["kd_order"]==""||aData["kd_order"]==null){
              $("td:eq(2)",nRow).html(aData["nm_pemesan"]+
                                      "<label class='text-blue'>["+aData["nm_perusahaan"]+"]</label>"+
                                      "<label class='text-blue'>["+aData["no_order"]+"]</label>"+
                                      "<label class='text-blue'>["+aData["no_po"]+"]</label>");
            }else{
              $("td:eq(2)",nRow).html(aData["nm_pemesan"]+
                                      "<label class='text-blue'>["+aData["nm_perusahaan"]+"]</label>"+
                                      "<label class='text-blue'>["+aData["no_order"]+"]</label>"+
                                      "<label class='text-blue'>["+aData["kd_order"]+"]</label>");
            }
            $("td:eq(10)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalLihatDetailPengiriman('"+aData["id_dp"]+"')>Lihat Detail</button>");
            if(aData["merek"]==""||aData["merek"]==null){
              $("td:eq(5)",nRow).text(aData["nm_barang"]);
            }
            if(aData["warna_plastik"]==""||aData["warna_plastik"]==null){
              $("td:eq(4)",nRow).text(aData["warna"]);
            }
            $("td:eq(7)",nRow).text(parseFloat(aData["jumlah"]).toLocaleString()+" "+aData["satuan"]);
            $("td:eq(8)",nRow).text(parseFloat(aData["jumlah_kirim"]).toLocaleString()+" "+aData["satuan"]);
            $("td:eq(9)",nRow).text(parseFloat(aData["sisa"]).toLocaleString()+" "+aData["satuan"]);
          }
        });
      }

      function datatableListPesananBelumTerkirim(){
        $("#tableDataSisaOrderBelumTerkirim").css("font-size","14px");
        $("#tableDataSisaOrderBelumTerkirim").dataTable().fnDestroy();
        $("#tableDataSisaOrderBelumTerkirim").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType" : "full_numbers",
          "sAjaxSource" : "<?php echo base_url(); ?>_gudanghasil/main/getListPesananBelumTerkirim",
          "columns" : [
            {"data" : "no_order", "name" : "P.no_order"},
            {"data" : "tgl_pesan", "name" : "P.tgl_pesan"},
            {"data" : "tgl_estimasi", "name" : "P.tgl_estimasi"},
            {"data" : "nm_pemesan", "name" : "P.nm_pemesan"},
            {"data" : "jumlah", "name" : "PD.jumlah"},
            {"data" : "sisa", "name" : "PD.jumlah"},
            {"data" : "ukuran", "name" : "GH.ukuran"},
            {"data" : "warna_plastik", "name" : "GH.warna_plastik"},
            {"data" : "merek", "name" : "GH.merek"},
            {"data" : "dll", "name" : "PD.dll"}
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
            $("td:eq(10)",nRow).html("<button class='btn btn-md btn-flat btn-primary'>Lihat Detail</button>");
            if(aData["merek"]==""||aData["merek"]==null){
              $("td:eq(8)",nRow).text(aData["nm_barang"]);
            }
            if(aData["warna_plastik"]==""||aData["warna_plastik"]==null){
              $("td:eq(7)",nRow).text(aData["warna"]);
            }
            $("td:eq(4)",nRow).text(parseFloat(aData["jumlah"]).toLocaleString()+" "+aData["satuan"]);
            $("td:eq(5)",nRow).text(parseFloat(aData["sisa"]).toLocaleString()+" "+aData["satuan"]);
          }
        });
      }

      function tableListPengirimanBaruTemp(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudanghasil/main/getListPengirimanBaruTemp",
          dataType : "JSON",
          success : function(response){
            $("#tableListPengirimanBaruTemp > tbody > tr").empty();
            $.each(response,function(index,value){
              $("#tableListPengirimanBaruTemp > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++index +"</td>"+
                  "<td>"+ value.tgl_pengiriman+"</td>"+
                  "<td>"+ value.customer+"</td>"+
                  "<td>"+ value.ukuran+"</td>"+
                  "<td>"+ value.jumlah_pesanan+"</td>"+
                  "<td>"+ value.jumlah_terkirim+"</td>"+
                  "<td>"+ value.jumlah_kg+"</td>"+
                  "<td>"+ value.jumlah_lembar+"</td>"+
                  "<td>"+ value.warna+"</td>"+
                  "<td>"+ value.merek+"</td>"+
                  "<td>"+ value.sts_pengiriman+"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deletePengirimanBaruTemp('"+value.id_detail_pengiriman+"')>Hapus</button>"+
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

      function tableListDetailPengiriman(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getListDetailPesananTerkirim",
          dataType : "JSON",
          data : {idDp : param},
          success : function(response){
            $("#tableListDetailPengiriman > tbody > tr").empty();
            $.each(response,function(index,value){
              $("#tableListDetailPengiriman > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++index +"</td>"+
                  "<td>"+value.tgl_pengiriman+"</td>"+
                  "<td>"+value.ukuran+"</td>"+
                  "<td>"+value.warna+"</td>"+
                  "<td>"+value.merek+"</td>"+
                  "<td>"+parseFloat(value.jumlah_kg).toLocaleString()+" KG"+"</td>"+
                  "<td>"+parseFloat(value.jumlah_lembar).toLocaleString()+" LEMBAR"+"</td>"+
                  "<td>"+parseFloat(value.jumlah_terkirim).toLocaleString()+" "+value.satuan+"</td>"+
                  "<td>"+value.status+"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditDataOrderTerkirim('"+value.id_detail_pengiriman+"')>Ubah</button>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteDataOrderTerkirim('"+value.id_detail_pengiriman+"')>Hapus</button>"+
                  "</td>"+
                "</tr>"
              )
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

      function datatableListGudangHasil(param1,param2,param3=""){
        $(param1).css("font-size","14px");
        $(param1).dataTable().fnDestroy();
        $(param1).dataTable({
          // "fixedHeader" : true,
          "autoWidth" : true,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType" : "full_numbers",
          "sAjaxSource" : "<?php echo base_url(); ?>_gudanghasil/main/getListGudangHasil",
          "columns" : [
            {"data" : "kd_gd_hasil", "name" : "ukuran"},
            {"data" : "ukuran", "name" : "ukuran"},
            {"data" : "merek", "name" : "merek"},
            {"data" : "warna_plastik", "name" : "warna_plastik"},
            {"data" : "stok_berat", "name" : "stok_berat"},
            {"data" : "stok_lembar", "name" : "stok_lembar"},
            {"data" : "jns_permintaan", "name" : "jns_permintaan"},
            {"data" : "jns_brg", "name" : "merek"},
            {"data" : "kd_gd_hasil", "name" : "kd_gd_hasil"}
          ],
          "fnServerData" : function(sSource,aoData,fnCallback){
            aoData.push({"name":"jnsBrg","value":param2},
                        {"name":"jnsPermintaan","value":param3});
            $.ajax({
              "type"      : "POST",
              "dataType"  : "JSON",
              "url"       : sSource,
              "data"      : aoData,
              "success"   : fnCallback
            });
          },
          "fnRowCallback" : function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(0)",nRow).html(aData["kd_gd_hasil"]+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>")
            $("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditBarangGudangHasil('"+aData["kd_gd_hasil"]+"')><i class='fa fa-edit'></i> Ubah</button>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteBarangGudangHasil('"+aData["kd_gd_hasil"]+"')><i class='fa fa-trash'></i> Hapus</button>");
          }
        });
      }

      function datatableTrashListGudangHasil(){
        $("#tableTrashGudangHasil").css("font-size","14px");
        $("#tableTrashGudangHasil").dataTable().fnDestroy();
        $("#tableTrashGudangHasil").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : true,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType" : "full_numbers",
          "sAjaxSource" : "<?php echo base_url(); ?>_gudanghasil/main/getTrashListGudangHasil",
          "columns" : [
            {"data" : "kd_gd_hasil", "name" : "kd_gd_hasil"},
            {"data" : "ukuran", "name" : "ukuran"},
            {"data" : "stok_berat", "name" : "stok_berat"},
            {"data" : "stok_lembar", "name" : "stok_lembar"},
            {"data" : "warna_plastik", "name" : "warna_plastik"},
            {"data" : "merek", "name" : "merek"},
            {"data" : "jns_permintaan", "name" : "jns_permintaan"},
            {"data" : "jns_brg", "name" : "jns_brg"},
            {"data" : "kd_gd_hasil", "name" : "kd_gd_hasil"}
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
            $("td:eq(0)",nRow).html(aData["kd_gd_hasil"]+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>")
            $("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=restoreBarangGudangHasil('"+aData["kd_gd_hasil"]+"')>Pulihkan</button>");
          }
        });
      }

      function datatableSearchHistoryGudangHasilMasuk(param,tglAwal,tglAkhir,kdGdHasil){
        $("#tableHistoryGudangHasilMasuk").css("font-size","14px");
        $("#tableHistoryGudangHasilMasuk").dataTable().fnDestroy();
        $("#tableHistoryGudangHasilMasuk").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListHistoryGudangHasilMasukDatatable",
          "columns":[
            {"data" : "tgl_transaksi","name":"tgl_transaksi"},
            {"data" : "jumlah_berat","name":"jumlah_berat"},
            {"data" : "jumlah_lembar","name":"jumlah_lembar"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":tglAwal},
                        {"name":"tglAkhir","value":tglAkhir},
                        {"name":"kdGdHasil","value":kdGdHasil});
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
              $("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=modalEditHistory('"+param+"','"+aData['id_permintaan_jadi']+"','"+tglAwal+"','"+tglAkhir+"','"+kdGdHasil+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiGudangHasil('"+param+"','"+aData['id_permintaan_jadi']+"','"+tglAwal+"','"+tglAkhir+"','"+kdGdHasil+"')><span class='fa fa-trash'></span> Hapus</button>");
            }
            $("td:eq(4)",nRow).css("background-color","f4f4f4");

            if(aData["keterangan"] !="" || aData["keterangan"] !=null ){
              $("td:eq(3)",nRow).html(aData["keterangan_history"] +" <b>[ "+aData["customer"]+" ]</b> " + " [ "+aData["keterangan"] + " ]");
            }else{
              $("td:eq(3)",nRow).html(aData["keterangan_history"]);
            }
          }
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getSaldoAwalGudangHasil",
          dataType : "JSON",
          data : {tglAwal:tglAwal,tglAkhir:tglAkhir,kdGdHasil:kdGdHasil},
          success : function(response){
            $("#textSaldoAwalBerat").text("BERAT : "+response.saldoAwalBerat);
            $("#textSaldoAwalLembar").text("LEMBAR : "+response.saldoAwalLembar);
            $("#textSaldoAkhirBerat").text("BERAT : "+response.saldoAkhirBerat);
            $("#textSaldoAkhirLembar").text("LEMBAR : "+response.saldoAkhirLembar);
            $("#textMasukBerat").text("BERAT : "+response.saldoMasukBerat);
            $("#textMasukLembar").text("LEMBAR : "+response.saldoMasukLembar);
            $("#textKeluarBerat").text("BERAT : "+response.saldoKeluarBerat);
            $("#textKeluarLembar").text("LEMBAR : "+response.saldoKeluarLembar);
          }
        });

        $.ajax({
          type : "POST",
          url  : "<?php echo site_url('_gudanghasil/main/getDataStokMaster'); ?>",
          data : {kdGdHasil : kdGdHasil },
          dataType : "JSON",
          success:function(response){
            $("#textBeratStok").text("STOK BERAT : "+response[0].stok_berat);
            $("#textLembarStok").text("STOK LEMBAR : "+response[0].stok_lembar);
          }
        });
      }

      function datatableSearchHistoryGudangHasilBufferMasuk(param,tglAwal,tglAkhir,kdGdHasil){
        $("#tableHistoryGudangHasilMasuk").css("font-size","14px");
        $("#tableHistoryGudangHasilMasuk").dataTable().fnDestroy();
        $("#tableHistoryGudangHasilMasuk").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListHistoryGudangHasilBufferMasukDatatable",
          "columns":[
            {"data" : "tgl_transaksi","name":"tgl_transaksi"},
            {"data" : "jumlah_berat","name":"jumlah_berat"},
            {"data" : "jumlah_lembar","name":"jumlah_lembar"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":tglAwal},
                        {"name":"tglAkhir","value":tglAkhir},
                        {"name":"kdGdHasil","value":kdGdHasil});
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
              $("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
              // $("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
            }else{

            }

            if(aData["status_lock"] == "TRUE"){
              $("td:eq(4)",nRow).html("<label class='btn btn-md btn-block btn-flat btn-default'><i class='fa fa-lock'></i> BULAN INI SUDAH DI LOCK</label>")
            }else{
              $("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=modalEditHistory('"+param+"','"+aData['id_permintaan_jadi']+"','"+tglAwal+"','"+tglAkhir+"','"+kdGdHasil+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiGudangHasil('"+param+"','"+aData['id_permintaan_jadi']+"','"+tglAwal+"','"+tglAkhir+"','"+kdGdHasil+"')><span class='fa fa-trash'></span> Hapus</button>");
            }
            $("td:eq(4)",nRow).css("background-color","f4f4f4");

            if(aData["keterangan"] !="" || aData["keterangan"] !=null ){
              $("td:eq(3)",nRow).html(aData["keterangan_history"] +" <b>[ "+aData["customer"]+" ]</b> " + " [ "+aData["keterangan"] + " ]");
            }else{
              $("td:eq(3)",nRow).html(aData["keterangan_history"]);
            }
          }
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getSaldoAwalGudangHasilBuffer",
          dataType : "JSON",
          data : {tglAwal:tglAwal,tglAkhir:tglAkhir,kdGdHasil:kdGdHasil},
          success : function(response){
            $("#textSaldoAwalBerat").text("BERAT : "+response.saldoAwalBerat);
            $("#textSaldoAwalLembar").text("LEMBAR : "+response.saldoAwalLembar);
            $("#textSaldoAkhirBerat").text("BERAT : "+response.saldoAkhirBerat);
            $("#textSaldoAkhirLembar").text("LEMBAR : "+response.saldoAkhirLembar);
            $("#textMasukBerat").text("BERAT : "+response.saldoMasukBerat);
            $("#textMasukLembar").text("LEMBAR : "+response.saldoMasukLembar);
            $("#textKeluarBerat").text("BERAT : "+response.saldoKeluarBerat);
            $("#textKeluarLembar").text("LEMBAR : "+response.saldoKeluarLembar);
          }
        });
      }

      function datatableSearchHistoryGudangHasilKeluar(param,tglAwal,tglAkhir,kdGdHasil){
        $("#tableHistoryGudangHasilKeluar").css("font-size","14px");
        $("#tableHistoryGudangHasilKeluar").dataTable().fnDestroy();
        $("#tableHistoryGudangHasilKeluar").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListHistoryGudangHasilKeluarDatatable",
          "columns":[
            {"data" : "tgl_transaksi","name":"tgl_transaksi"},
            {"data" : "jumlah_berat","name":"jumlah_berat"},
            {"data" : "jumlah_lembar","name":"jumlah_lembar"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":tglAwal},
                        {"name":"tglAkhir","value":tglAkhir},
                        {"name":"kdGdHasil","value":kdGdHasil});
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
              $("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=modalEditHistory('"+param+"','"+aData['id_permintaan_jadi']+"','"+tglAwal+"','"+tglAkhir+"','"+kdGdHasil+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' disabled='disabled' onclick=deleteTransaksiGudangHasil('"+param+"','"+aData['id_permintaan_jadi']+"','"+tglAwal+"','"+tglAkhir+"','"+kdGdHasil+"')><span class='fa fa-trash'></span> Hapus</button>");
            }
            $("td:eq(4)",nRow).css("background-color","f4f4f4");

            if(aData["keterangan"] !="" || aData["keterangan"] !=null ){
              $("td:eq(3)",nRow).html(aData["keterangan_history"] +" <b>[ "+aData["customer"]+" ]</b> " + " [ "+aData["keterangan"] + " ]");
            }else{
              $("td:eq(3)",nRow).html(aData["keterangan_history"]);
            }
          }
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getSaldoAwalGudangHasil",
          dataType : "JSON",
          data : {tglAwal:tglAwal,tglAkhir:tglAkhir,kdGdHasil:kdGdHasil},
          success : function(response){
            $("#textSaldoAwalBerat").text("BERAT : "+response.saldoAwalBerat);
            $("#textSaldoAwalLembar").text("LEMBAR : "+response.saldoAwalLembar);
            $("#textSaldoAkhirBerat").text("BERAT : "+response.saldoAkhirBerat);
            $("#textSaldoAkhirLembar").text("LEMBAR : "+response.saldoAkhirLembar);
            $("#textMasukBerat").text("BERAT : "+response.saldoMasukBerat);
            $("#textMasukLembar").text("LEMBAR : "+response.saldoMasukLembar);
            $("#textKeluarBerat").text("BERAT : "+response.saldoKeluarBerat);
            $("#textKeluarLembar").text("LEMBAR : "+response.saldoKeluarLembar);
          }
        });
      }

      function datatableSearchHistoryGudangBufferKeluar(param,tglAwal,tglAkhir,kdGdHasil){
        $("#tableHistoryGudangHasilKeluar").css("font-size","14px");
        $("#tableHistoryGudangHasilKeluar").dataTable().fnDestroy();
        $("#tableHistoryGudangHasilKeluar").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListHistoryGudangBufferKeluarDatatable",
          "columns":[
            {"data" : "tgl_transaksi","name":"tgl_transaksi"},
            {"data" : "jumlah_berat","name":"jumlah_berat"},
            {"data" : "jumlah_lembar","name":"jumlah_lembar"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":tglAwal},
                        {"name":"tglAkhir","value":tglAkhir},
                        {"name":"kdGdHasil","value":kdGdHasil});
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
              $("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=modalEditHistory('"+param+"','"+aData['id_permintaan_jadi']+"','"+tglAwal+"','"+tglAkhir+"','"+kdGdHasil+"')><span class='fa fa-edit'></span> Ubah</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' disabled='disabled' onclick=deleteTransaksiGudangHasil('"+param+"','"+aData['id_permintaan_jadi']+"','"+tglAwal+"','"+tglAkhir+"','"+kdGdHasil+"')><span class='fa fa-trash'></span> Hapus</button>");
            }
            $("td:eq(4)",nRow).css("background-color","f4f4f4");

            if(aData["keterangan"] !="" || aData["keterangan"] !=null ){
              $("td:eq(3)",nRow).html(aData["keterangan_history"] +" <b>[ "+aData["keterangan_barang"]+" ]</b> " + " [ "+aData["keterangan"] + " ]");
            }else{
              $("td:eq(3)",nRow).html(aData["keterangan_history"]);
            }
          }
        });

        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getSaldoAwalGudangHasilBuffer",
          dataType : "JSON",
          data : {tglAwal:tglAwal,tglAkhir:tglAkhir,kdGdHasil:kdGdHasil},
          success : function(response){
            $("#textSaldoAwalBerat").text("BERAT : "+response.saldoAwalBerat);
            $("#textSaldoAwalLembar").text("LEMBAR : "+response.saldoAwalLembar);
            $("#textSaldoAkhirBerat").text("BERAT : "+response.saldoAkhirBerat);
            $("#textSaldoAkhirLembar").text("LEMBAR : "+response.saldoAkhirLembar);
            $("#textMasukBerat").text("BERAT : "+response.saldoMasukBerat);
            $("#textMasukLembar").text("LEMBAR : "+response.saldoMasukLembar);
            $("#textKeluarBerat").text("BERAT : "+response.saldoKeluarBerat);
            $("#textKeluarLembar").text("LEMBAR : "+response.saldoKeluarLembar);
          }
        });
      }

      function datatableTrashHistoryGudangHasil(){
        $("#tableTrashTransaksi").css("font-size","14px");
        $("#tableTrashTransaksi").dataTable().fnDestroy();
        $("#tableTrashTransaksi").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getTrashListTransaksiGudangHasil",
          "columns":[
            {"data" : "tgl_transaksi","name":"tgl_transaksi"},
            {"data" : "merek","name":"merek"},
            {"data" : "jumlah_berat","name":"jumlah_berat"},
            {"data" : "jumlah_lembar","name":"jumlah_lembar"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            // aoData.push({"name":"tglAwal","value":tglAwal},
            //             {"name":"tglAkhir","value":tglAkhir},
            //             {"name":"kdGdHasil","value":kdGdHasil});
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
              $("td:eq(5)",nRow).html("<label class='btn btn-md btn-block btn-flat btn-default'><i class='fa fa-lock'></i> BULAN INI SUDAH DI LOCK</label>")
            }else{
              $("td:eq(5)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=restoreTransaksiGudangHasil('"+aData["id_permintaan_jadi"]+"','"+aData["kd_gd_hasil"]+"')>Pulihkan</button>");
            }
            $("td:eq(5)",nRow).css("background-color","f4f4f4");
          }
        });
      }

      function tableListPengambilanSablonTemp(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudanghasil/main/getListPengambilanSablonTemp",
          dataType : "JSON",
          success : function(response){
            $("#tablePengambilanSablonTemp > tbody > tr").empty();
            $.each(response,function(index,value){
              $("#tablePengambilanSablonTemp > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++index +"</td>"+
                  "<td>"+value.tgl_pengambilan+"</td>"+
                  "<td>"+value.ukuran+"</td>"+
                  "<td>"+value.jumlah_berat+"</td>"+
                  "<td>"+value.jumlah_lembar+"</td>"+
                  "<td>"+value.warna_plastik+"</td>"+
                  "<td>"+value.merek+"</td>"+
                  "<td>"+value.jns_permintaan+"</td>"+
                  "<td><button class='btn btn-md btn-flat btn-danger' onclick=deletePengambilanSablonTemp('"+value.id_pengambilan_sablon+"')><i class='fa fa-trash'></i> Hapus</button></td>"+
                "</tr>"
              )
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

      function tableListPengirimanGudangTemp(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getListPengirimanGudangTemp",
          dataType : "JSON",
          data : {stsPengiriman : param},
          success : function(response){
            $("#tableListPengirimanGudangTemp > tbody > tr").empty();
            $.each(response,function(index,value){
              $("#tableListPengirimanGudangTemp > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++index +"</td>"+
                  "<td>"+value.tgl_pengiriman+"</td>"+
                  "<td>"+value.customer.toUpperCase()+"</td>"+
                  "<td>"+value.ukuran+"</td>"+
                  "<td>"+value.jumlah_kg+"</td>"+
                  "<td>"+value.jumlah_lembar+"</td>"+
                  "<td>"+value.warna_plastik+"</td>"+
                  "<td>"+value.merek+"</td>"+
                  "<td>"+value.jns_permintaan+"</td>"+
                  "<td><button class='btn btn-sm btn-flat btn-warning' onclick=modalEditPengirimanGudangTemp('"+param+"','"+value.id_detail_pengiriman+"')><i class='fa fa-edit'></i> Ubah</button>"+
                       "<button class='btn btn-sm btn-flat btn-danger' onclick=deletePengirimanGudangTemp('"+param+"','"+value.id_detail_pengiriman+"')><i class='fa fa-trash'></i> Hapus</button>"+
                  "</td>"+
                "</tr>"
              )
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

      function tableListPengirimanApalTemp(){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getListKirimanApalTemp",
          dataType : "JSON",
          success : function(response){
            $("#tableListPengirimanApalTemp > tbody > tr").empty();
            $.each(response,function(index,value){
              $("#tableListPengirimanApalTemp > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++index +"</td>"+
                  "<td>"+value.tgl_transaksi+"</td>"+
                  "<td>"+value.warna+"</td>"+
                  "<td>"+value.jumlah_apal+"</td>"+
                  "<td>"+
                    "<button class='btn btn-sm btn-flat btn-danger' onclick=deletePengirimanApalTemp('"+value.id+"')><i class='fa fa-trash'></i> Hapus</button>"+
                  "</td>"+
                "</tr>"
              )
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

      function tableListPengembalianGudangHasil(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getListPengembalianBarang",
          dataType : "JSON",
          data : {statusBarang : param},
          success : function(response){
            $("#tableListPengembalianGudangHasil > tbody > tr").empty();
            $.each(response,function(index,value){
              $("#tableListPengembalianGudangHasil > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++index +"</td>"+
                  "<td>"+value.tgl_transaksi+"</td>"+
                  "<td>"+value.customer+"</td>"+
                  "<td>"+value.ukuran+"</td>"+
                  "<td>"+value.jumlah_berat+"</td>"+
                  "<td>"+value.jumlah_lembar+"</td>"+
                  "<td>"+value.warna+"</td>"+
                  "<td>"+value.merek+"</td>"+
                  "<td>"+value.jns_permintaan+"</td>"+
                  "<td>"+value.keterangan+"</td>"+
                  "<td>"+
                    "<button class='btn btn-sm btn-flat btn-danger' onclick=deletePengembalianGudangHasil('"+param+"','"+value.id_permintaan_jadi+"')><i class='fa fa-trash'></i> Hapus</button>"+
                  "</td>"+
                "</tr>"
              )
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

      function tableListPembelianBarangHd(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudanghasil/main/getListPembelianBarangHdTemp",
          dataType : "JSON",
          success : function(response){
            $("#tableListPembelianBarangHd > tbody > tr").empty();
            $.each(response, function(AvIndex, AvValue){
              $("#tableListPembelianBarangHd > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++AvIndex +"</td>"+
                  "<td>"+AvValue.tgl_transaksi+"</td>"+
                  "<td>"+AvValue.customer+"</td>"+
                  "<td>"+AvValue.ukuran+"</td>"+
                  "<td>"+AvValue.jumlah_berat+"</td>"+
                  "<td>"+AvValue.jumlah_lembar+"</td>"+
                  "<td>"+AvValue.warna+"</td>"+
                  "<td>"+AvValue.merek+"</td>"+
                  "<td>"+AvValue.jns_permintaan+"</td>"+
                  "<td>"+
                    "<button class='btn btn-sm btn-flat btn-danger' onclick=deletePembelianBarangHd('"+AvValue.id_permintaan_jadi+"')><i class='fa fa-trash'></i> Hapus</button>"+
                  "</td>"+
                "</tr>"
              );
            });
          }
        });
      }

      function datatableSearchHistoryGudangApal(tglAwal,tglAkhir,kdGudangApal){
        $("#tableDataHistoryApal").css("font-size","14px");
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
          url : "<?php echo base_url(); ?>_gudanghasil/main/getSaldoAwalBulanGudangApal",
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

      function tableListKoreksiGudangBufferTemp(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudanghasil/main/getListKoreksiGudangBufferTemp",
          dataType : "JSON",
          success : function(response){
            $("#tableListKoreksiGudangBufferTemp > tbody > tr").empty();
            $.each(response, function(AvIndex, AvValue){
              $("#tableListKoreksiGudangBufferTemp > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++AvIndex +"</td>"+
                  "<td>"+AvValue.tgl_transaksi+"</td>"+
                  "<td>"+AvValue.ukuran+"</td>"+
                  "<td>"+AvValue.jumlah_berat+"</td>"+
                  "<td>"+AvValue.jumlah_lembar+"</td>"+
                  "<td>"+AvValue.warna+"</td>"+
                  "<td>"+AvValue.merek+"</td>"+
                  "<td>"+AvValue.keterangan_history+"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditKoreksiGudangBuffer('"+AvValue.id_permintaan_jadi+"')>Ubah</button>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteTransaksiGudangBuffer('"+AvValue.id_permintaan_jadi+"')>Hapus</button>"+
                  "</td>"+
                "</tr>"
              );
            });
          }
        });
      }

      function tableListPengembalianGudangBuffer(){
        $.ajax({
          url : "<?php echo base_url() ?>_gudanghasil/main/getListPengembalianBarangGudangBufferKeStandardTemp",
          dataType : "JSON",
          success : function(response){
            $("#tableListPengembalianGudangBuffer > tbody > tr").empty();
            $.each(response,function(AvIndex,AvValue){
              $("#tableListPengembalianGudangBuffer > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++AvIndex +"</td>"+
                  "<td>"+AvValue.tgl_transaksi+"</td>"+
                  "<td>"+AvValue.customer+"</td>"+
                  "<td>"+AvValue.ukuran+"</td>"+
                  "<td>"+AvValue.jumlah_berat+"</td>"+
                  "<td>"+AvValue.jumlah_lembar+"</td>"+
                  "<td>"+AvValue.warna+"</td>"+
                  "<td>"+AvValue.merek+"</td>"+
                  "<td>"+AvValue.jns_permintaan+"</td>"+
                  "<td>"+AvValue.keterangan+"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deletePengembalianGudangBuffer('"+AvValue.id_permintaan_jadi+"')>Hapus</button>"
                  +"</td>"+
                "</tr>"
              );
            });
          }
        });
      }

      function datatableListPengeluaranGudangHasil(param1, param2, param3=""){
        $(param1).css("font-size","14px");
        $(param1).dataTable().fnDestroy();
        $(param1).dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListPengeluaranGudangHasil",
          "columns":[
            {"data" : "tgl_pengambilan","name":"TPS.tgl_pengambilan"},
            {"data" : "ukuran","name":"GH.ukuran"},
            {"data" : "warna_plastik","name":"GH.warna_plastik"},
            {"data" : "merek","name":"GH.merek"},
            {"data" : "keterangan","name":"TPS.keterangan"},
            {"data" : "jumlah_lembar","name":"TPS.jumlah_lembar"},
            {"data" : "jumlah_berat","name":"TPS.jumlah_berat"},
            {"data" : "id_pengambilan_sablon","name":"TPS.id_pengambilan_sablon"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"jnsBrg","value":param2},
                         {"name":"tglAkhir","value":param3});
            //             {"name":"kdGdHasil","value":kdGdHasil});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){

          }
        });
      }

      function datatableKirimanDariBagian(param1, param2, param3=""){
        $("#tableListKirimanDariBagian"+param2).css("font-size","14px");
        $("#tableListKirimanDariBagian"+param2).dataTable().fnDestroy();
        $("#tableListKirimanDariBagian"+param2).dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType" : "full_numbers",
					"scrollX" : "100%",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListKirimanDariBagian",
          "columns":[
            {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"},
            {"data" : "tgl_transaksi","name":"tgl_transaksi"},
            {"data" : "ukuran","name":"ukuran"},
            {"data" : "jumlah_berat","name":"jumlah_berat"},
            {"data" : "jumlah_lembar","name":"jumlah_lembar"},
            {"data" : "warna","name":"warna"},
            {"data" : "merek","name":"merek"},
            {"data" : "jns_permintaan","name":"jns_permintaan"},
            {"data" : "customer","name":"customer"},
            {"data" : "sts_barang","name":"sts_barang"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"stsBarang","value":param1},
                         {"name":"bagian","value":param2},
                         {"name":"jnsPermintaan","value":param3});
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
            $("td:eq(11)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=editKekuranganKelebihan('"+aData["id_permintaan_jadi"]+"') title='Kirim Balik'>Kirim Balik</button>"+
                                     "<button class='btn btn-md btn-flat btn-warning' disabled title='Fitur Ini Belum Tersedia'>Edit Merek / Id</button>" +
                                     "<button class='btn btn-md btn-flat btn-danger' disabled title='Fitur Ini Belum Tersedia'>Hapus</button>");
          }
        });
      }

      function datatableKirimanUntukBufferSablon(param1){
        $("#tableListKirimanDariBagianSABLON_"+param1).css("font-size","14px");
        $("#tableListKirimanDariBagianSABLON_"+param1).dataTable().fnDestroy();
        $("#tableListKirimanDariBagianSABLON_"+param1).dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType" : "full_numbers",
					"scrollX" : "100%",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListKirimanUntukBufferSablon",
          "columns":[
            {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"},
            {"data" : "tgl_transaksi","name":"tgl_transaksi"},
            {"data" : "ukuran","name":"ukuran"},
            {"data" : "jumlah_berat","name":"jumlah_berat"},
            {"data" : "jumlah_lembar","name":"jumlah_lembar"},
            {"data" : "warna","name":"warna"},
            {"data" : "merek","name":"merek"},
            {"data" : "jns_permintaan","name":"jns_permintaan"},
            {"data" : "customer","name":"customer"},
            {"data" : "sts_barang","name":"sts_barang"},
            {"data" : "keterangan_history","name":"keterangan_history"},
            {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"stsBarang","value":param1});
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
            $("td:eq(11)",nRow).html("<button class='btn btn-md btn-flat btn-primary' disabled title='Fitur Ini Belum Tersedia'>Edit Kekurangan/Kelebihan</button>"+
                                     "<button class='btn btn-md btn-flat btn-warning' disabled title='Fitur Ini Belum Tersedia'>Edit Merek / Id</button>" +
                                     "<button class='btn btn-md btn-flat btn-danger' disabled title='Fitur Ini Belum Tersedia'>Hapus</button>");
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
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListGudangBahanDatatable",
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

      function tableListPembelianBahanBakuTemp(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getPembelianGudangBahanTemp",
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
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListHistoryGudangBahan",
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
          url : "<?php echo base_url(); ?>_gudanghasil/main/getSaldoAwalBulanGudangBahan",
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

      function tableListKoreksi(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url(); ?>_gudanghasil/main/getKoreksiTemp",
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
          url : "<?php echo base_url(); ?>_gudanghasil/main/getPengeluaranGudangBahanTemp",
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

      function datatableDataPermintaan(){
        $("#tableDataPermintaan").dataTable().fnDestroy();
        $("#tableDataPermintaan").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getPermintaanBarang",
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
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            $("td:eq(0)",nRow).text(++iDisplayIndex);
            $("td:eq(5)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalLihatDetailPermintaan('"+aData["kd_permintaan_barang"]+"')>Lihat Permintaan</button>"+
                                    "<a href='<?php echo base_url('_gudanghasil/main/printBonPermintaanBarang/') ?>"+aData["kd_permintaan_barang"]+"' target='_blank' class='btn btn-md btn-flat btn-success'>Cetak Bon Permintaan</a>"+
                                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestorePermintaanBarang('"+aData["kd_permintaan_barang"]+"','TRUE')>Hapus</button>");
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
          "scrollY" : "720px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getDetailPermintaanBaru",
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
            if(aData["status_permintaan"] == "PENDING"){
              $("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-default'><i class='fa fa-lock'></i> Permintaan Belum Disetujui Oleh Purchasing</button>"+
                                      "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreDetailPermintaanBarang('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"','TRUE')>Batal Minta</button>"+
                                      "<a href='<?php echo base_url('_gudanghasil/main/printBonPermintaanBarang/') ?>"+aData["kd_permintaan_barang"]+"' target='_blank' class='btn btn-md btn-flat bg-purple'>Cetak Bon Permintaan</a>");
            }else if(aData["status_permintaan"] == "CANCEL"){
              $("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-default'><i class='fa fa-lock'></i> Permintaan Dibatalkan Oleh Purchasing</button>");
            }else{
              $("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalTerimaBarangSetengah('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"')>Terima Setengah</button>"+
                                      "<button class='btn btn-md btn-flat btn-success' onclick=modalTerimaBarangFull('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"')>Terima Full</button>"+
                                      // "<button class='btn btn-md btn-flat btn-danger' onclick=batalkanPermintaan('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"')>Batal Minta</button>"+
                                      "<button class='btn btn-md btn-flat btn-primary' onclick=selesaiPermintaan('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"')>Selesai Permintaan</button>"+
                                      "<a href='<?php echo base_url('_gudanghasil/main/printBonPermintaanBarang/') ?>"+aData["kd_permintaan_barang"]+"' target='_blank' class='btn btn-md btn-flat bg-purple'>Cetak Bon Permintaan</a>");
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

      function datatableListApproveBahanBakuExtruder(param,param2){
        $("#tableDataApproveGudangBahan").dataTable().fnDestroy();
        $("#tableDataApproveGudangBahan").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getTransaksiGudangBahanForApproveDataTable",
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

      function tableCekKartuStok(param, param2, param3){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url('_gudanghasil/main/getCekKartuStok'); ?>",
          dataType : "JSON",
          data : {
            tglAwal : param,
            tglAkhir : param2,
            stsBarang : param3
          },
          success : function(response){
            $("#tableDataKartuStok > tbody > tr").empty();
            $.each(response.dataMaster, function(AvIndex, AvValue){
              var kdGdHasil = AvValue.kd_gd_hasil;
              var saldoAwalBerat = 0;
              var saldoAwalLembar = 0;

              var saldoAkhirBerat = 0;
              var saldoAkhirLembar = 0;

              var totalBeratMasukPerPeriode = 0;
              var totalLembarMasukPerPeriode = 0;

              var totalBeratKeluarPerPeriode = 0;
              var totalLembarKeluarPerPeriode = 0;

              $.each(response.saldoAwal, function(AvIndex2, AvValue2){
                if(AvValue2.kd_gd_hasil == kdGdHasil){
                  saldoAwalBerat = parseFloat(AvValue2.saldo_awal_berat);
                  saldoAwalLembar = parseFloat(AvValue2.saldo_awal_lembar);

                  saldoAkhirBerat += saldoAwalBerat;
                  saldoAkhirLembar += saldoAwalLembar;
                }
              });

              $.each(response.saldoPerPeriode, function(AvIndex3, AvValue3){
                if(AvValue3.kd_gd_hasil == kdGdHasil){
                  totalBeratMasukPerPeriode = parseFloat(AvValue3.total_masuk_berat_per_periode);
                  totalLembarMasukPerPeriode = parseFloat(AvValue3.total_masuk_lembar_per_periode);

                  totalBeratKeluarPerPeriode = parseFloat(AvValue3.total_keluar_berat_per_periode);
                  totalLembarKeluarPerPeriode = parseFloat(AvValue3.total_keluar_lembar_per_periode);

                  saldoAkhirBerat += (totalBeratMasukPerPeriode - totalBeratKeluarPerPeriode);
                  saldoAkhirLembar += (totalLembarMasukPerPeriode - totalLembarKeluarPerPeriode);
                }
              });


              $("#tableDataKartuStok > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++AvIndex +"</td>"+
                  "<td>"+ AvValue.nm_barang +"</td>"+
                  "<td>"+ parseFloat(AvValue.stok_berat).toLocaleString() +"</td>"+
                  "<td>"+ parseFloat(AvValue.stok_berat).toLocaleString() +"</td>"+
                  "<td>"+ saldoAwalBerat.toLocaleString() +"</td>"+
                  "<td>"+ saldoAwalLembar.toLocaleString() +"</td>"+
                  "<td>"+ totalBeratMasukPerPeriode.toLocaleString() +"</td>"+
                  "<td>"+ totalLembarMasukPerPeriode.toLocaleString() +"</td>"+
                  "<td>"+ totalBeratKeluarPerPeriode.toLocaleString() +"</td>"+
                  "<td>"+ totalLembarKeluarPerPeriode.toLocaleString() +"</td>"+
                  "<td>"+ saldoAkhirBerat.toLocaleString() +"</td>"+
                  "<td>"+ saldoAkhirLembar.toLocaleString() +"</td>"+
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

      function tableListTambahBahanSablon(){
        $.ajax({
          url : "<?php echo base_url() ?>_gudanghasil/main/getTempDataBahanSablon",
          dataType : "JSON",
          success : function(response){
            $("#tableListTambahBahanSablon > tbody > tr").empty();
            $.each(response,function(AvIndex,AvValue){
              $("#tableListTambahBahanSablon > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++AvIndex +"</td>"+
                  "<td>"+AvValue.tanggal+"</td>"+
                  "<td>"+AvValue.nm_bahan+"</td>"+
                  "<td>"+AvValue.warna+"</td>"+
                  "<td>"+AvValue.status_barang+"</td>"+
                  "<td>"+AvValue.stok+"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteListTempBahanSablon('"+AvValue.kd_bahan_sablon+"')><i class='fa fa-trash'></i> Hapus</button>"
                  +"</td>"+
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

      function datatableBahanSablon(){
        $("#tableDataBahanSablon").dataTable().fnDestroy();
        $("#tableDataBahanSablon").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListBahanSablon",
          "columns":[
            {"data" : "kd_bahan_sablon","name":"kd_bahan_sablon"},
            {"data" : "nm_bahan","name":"nm_bahan"},
            {"data" : "warna","name":"warna"},
            {"data" : "jenis","name":"jenis"},
            {"data" : "status_barang","name":"status_barang"},
            {"data" : "stok","name":"stok"},
            {"data" : "kd_bahan_sablon","name":"kd_bahan_sablon"}
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
            $("td:eq(6)",nRow).html("<button class='btn btn-sm btn-flat btn-warning' onclick=editListBahanSablon('"+aData["kd_bahan_sablon"]+"')><i class='fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-flat btn-danger' onclick=deleteBahanSablon('"+aData["kd_bahan_sablon"]+"')><i class='fa fa-edit'></i> Hapus</button>");
          }
        });
      }

      function datatableHistoryBahanSablonKeluar(param1,param2,param3){
        $("#tableHistoryBahanSablonKeluar").dataTable().fnDestroy();
        $("#tableHistoryBahanSablonKeluar").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListHistoryBahanSablonKeluar",
          "columns":[
            {"data" : "kd_hasil_sablon","name":"a.kd_hasil_sablon"},
            {"data" : "tanggal","name":"c.tanggal"},
            {"data" : "jumlah_pengambilan","name":"a.jumlah_pengambilan"},
            {"data" : "sisa_pengambilan","name":"a.sisa_pengambilan"},
            {"data" : "pemakaian","name":"a.sisa_pengambilan"},
            {"data" : "ukuran","name":"c.ukuran"}
            // {"data" : "kd_hasil_sablon","name":"kd_hasil_sablon"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":param1},
                       {"name":"tglAkhir","value":param2},
                       {"name":"nm_bahan","value":param3});
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
            $("td:eq(5)",nRow).text("( "+aData["ukuran"]+" )  "+aData["merek"]);
            // $("td:eq(6)",nRow).html("<button class='btn btn-sm btn-flat btn-warning' onclick=editListBahanSablon('"+aData["kd_bahan_sablon"]+"')><i class='fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-flat btn-danger' onclick=deleteBahanSablon('"+aData["kd_bahan_sablon"]+"')><i class='fa fa-edit'></i> Hapus</button>");
          }
        });
      }

      function datatableHistoryBahanSablonMasuk(param1,param2,param3){
        $("#tableHistoryBahanSablonMasuk").dataTable().fnDestroy();
        $("#tableHistoryBahanSablonMasuk").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListHistoryBahanSablonMasuk",
          "columns":[
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"},
            {"data" : "tgl_permintaan","name":"tgl_permintaan"},
            {"data" : "jumlah_permintaan","name":"jumlah_permintaan"},
            {"data" : "keterangan_history","name":"keterangan_history"}
            // {"data" : "kd_hasil_sablon","name":"kd_hasil_sablon"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":param1},
                       {"name":"tglAkhir","value":param2},
                       {"name":"nm_bahan","value":param3});
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
            $("td:eq(5)",nRow).text("( "+aData["ukuran"]+" )  "+aData["merek"]);
            // $("td:eq(6)",nRow).html("<button class='btn btn-sm btn-flat btn-warning' onclick=editListBahanSablon('"+aData["kd_bahan_sablon"]+"')><i class='fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-flat btn-danger' onclick=deleteBahanSablon('"+aData["kd_bahan_sablon"]+"')><i class='fa fa-edit'></i> Hapus</button>");
          }
        });
      }

      function tableListPermintaanBahanSablon(){
        $.ajax({
          url : "<?php echo base_url() ?>_gudanghasil/main/getTempDataPermintaanBahanSablon",
          dataType : "JSON",
          success : function(response){
            $("#tableListPermintaanBahanSablon > tbody > tr").empty();
            $.each(response,function(AvIndex,AvValue){
              $("#tableListPermintaanBahanSablon > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++AvIndex +"</td>"+
                  "<td>"+AvValue.tgl_permintaan+"</td>"+
                  "<td>"+AvValue.nm_barang+"</td>"+
                  "<td>"+AvValue.jenis+"</td>"+
                  "<td>"+AvValue.warna+"</td>"+
                  "<td>"+AvValue.jumlah_permintaan+"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteListPermintaanBahanSablon('"+AvValue.id+"')><i class='fa fa-trash'></i> Hapus</button>"
                  +"</td>"+
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

      function datatableDetailHasilJadi(param1,param2){
        $("#tableDetailHasilJadi").dataTable().fnDestroy();
        $("#tableDetailHasilJadi").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListDetailHasilJadi",
          "order": [[ 2, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "asc" ],[ 9, "asc" ],[ 10, "asc" ]],
          "columns":[
            {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"},
            {"data" : "tgl_transaksi","name":"tgl_transaksi"},
            {"data" : "ukuran","name":"ukuran"},
            {"data" : "jumlah_berat","name":"jumlah_berat"},
            {"data" : "jumlah_lembar","name":"jumlah_lembar"},
            {"data" : "warna","name":"warna"},
            {"data" : "merek","name":"merek"},
            {"data" : "jns_permintaan","name":"jns_permintaan"},
            {"data" : "customer","name":"customer"},
            {"data" : "sts_barang","name":"sts_barang"},
            {"data" : "status_history","name":"status_history"},
            {"data" : "keterangan_history","name":"keterangan_history"},
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":param1},
                       {"name":"tglAkhir","value":param2});
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

      function tableListDataAwalPending(jenis){
        $.ajax({
          type : "POST",
          url  : "<?php echo base_url() ?>_gudanghasil/main/getListDataAwalPending",
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

      function tableListDataAwalGudangHasilPending(jenis){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url('_gudanghasil/main/getListDataAwalGudangHasilPending'); ?>",
          dataType : "JSON",
          data : {
            stsBarang : jenis
          },
          success : function(response){
            $("#tableListDataAwalGudangHasilPending > tbody > tr").empty();
            $.each(response, function(AvIndex, AvValue){
              $("#tableListDataAwalGudangHasilPending > tbody:last-child").append(
                "<tr>"+
                  "<td>"+ ++AvIndex +"</td>"+
                  "<td>"+AvValue.nm_barang+"</td>"+
                  "<td>"+parseFloat(AvValue.jumlah_berat).toLocaleString()+"</td>"+
                  "<td>"+parseFloat(AvValue.jumlah_lembar).toLocaleString()+"</td>"+
                  "<td>"+
                    "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreDataAwalGudangHasilPending('"+AvValue.id_permintaan_jadi+"','"+jenis+"','TRUE')>Hapus</button>"+
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

      function tableCekKartuStokSort(param, param2, param3){
        var havingStokMaster = $("#cmbStokMaster").val();
        var havingStokAwal = $("#cmbStokAwal").val();
        var havingStokAkhir = $("#cmbStokAkhir").val();
        if(havingStokMaster=="" && havingStokAwal=="" && havingStokAkhir==""){
          tableCekKartuStok(param, param2, param3);
        }else{
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_gudanghasil/main/getCekKartuStokSort'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param,
              tglAkhir : param2,
              stsBarang : param3,
              havingStokMaster : havingStokMaster,
              havingStokAwal : havingStokAwal,
              havingStokAkhir : havingStokAkhir
            },
            success : function(response){
              $("#tableDataKartuStok > tbody > tr").empty();
              $.each(response.saldo, function(AvIndex, AvValue){
                $("#tableDataKartuStok > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+ ++AvIndex +"</td>"+
                    "<td>"+ AvValue.nm_barang +"</td>"+
                    "<td>"+ parseFloat(AvValue.stok_berat).toLocaleString() +"</td>"+
                    "<td>"+ parseFloat(AvValue.stok_lembar).toLocaleString() +"</td>"+
                    "<td>"+ parseFloat(AvValue.saldoAwalBerat).toLocaleString() +"</td>"+
                    "<td>"+ parseFloat(AvValue.saldoAwalLembar).toLocaleString() +"</td>"+
                    "<td>"+ parseFloat(AvValue.totalBeratMasukPerPeriode).toLocaleString() +"</td>"+
                    "<td>"+ parseFloat(AvValue.totalLembarMasukPerPeriode).toLocaleString() +"</td>"+
                    "<td>"+ parseFloat(AvValue.totalBeratKeluarPerPeriode).toLocaleString() +"</td>"+
                    "<td>"+ parseFloat(AvValue.totalLembarKeluarPerPeriode).toLocaleString() +"</td>"+
                    "<td>"+ parseFloat(AvValue.saldoAkhirBerat).toLocaleString() +"</td>"+
                    "<td>"+ parseFloat(AvValue.saldoAkhirLembar).toLocaleString() +"</td>"+
                  "</tr>"
                );
              });
            }
          });
        }
      }
      //============================================DATATABLE METHOD (Finish)============================================//
      </script>

      <script type="text/javascript">
        function modalKembalianHDSablon(){
          $("#modalApproveKembalianHDSablon").modal('show');
          datatableKembalianHDSablon();
        }
      </script>

      <script type="text/javascript">
        function datatableKembalianHDSablon(){
          $("#tableListKembalianHDSablon").css("font-size","14px");
          $("#tableListKembalianHDSablon").dataTable().fnDestroy();
          $("#tableListKembalianHDSablon").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "sPaginationType": "full_numbers",
            "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListKembalianHDSablon",
            "columns":[
              {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"},
              {"data" : "tgl_transaksi","name":"tgl_transaksi"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "warna","name":"warna"},
              {"data" : "merek","name":"merek"},
              {"data" : "jumlah_lembar","name":"jumlah_lembar"},
              {"data" : "jumlah_berat","name":"jumlah_berat"},
              {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"}
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
              $("td:eq(7)",nRow).html("<button class='btn btn-sm btn-flat btn-primary'><i class='fa fa-edit'></i> Edit</button>");
             }
            });
        }
      </script>
      <script type="text/javascript">
        function approveKembalianHDSablon(){
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudanghasil/main/approveKembalianHDSablon'); ?>",
            data :{},
            success:function(response){
              if (jQuery.trim(response) == "Success") {
                datatableKembalianHDSablon();
                $("#modal_rencanaSusulan").modal("hide");
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Berhasil Diapprove</b></div>");
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
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Gagal Diapprove</b></div>");
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
        function modalApproveReturBarang(param){
          $("#modalApproveReturBarang").modal({backdrop:"static"});
          $("#title_jenis").text(param);
          datatableBarangRetur(param);
          $("#btn_approveRetur").attr("onclick","approve_returBarang('"+param+"')");
        }
      </script>
      <script type="text/javascript">
        function datatableBarangRetur(param){
          $("#tableDataBarangRetur").dataTable().fnDestroy();
          $("#tableDataBarangRetur").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "sPaginationType": "full_numbers",
            "sAjaxSource":"<?php echo base_url(); ?>_gudanghasil/main/getListDataBarangRetur",
            "columns":[
              {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"},
              {"data" : "tgl_transaksi","name":"tgl_transaksi"},
              {"data" : "customer","name":"customer"},
              {"data" : "ukuran","name":"ukuran"},
              {"data" : "merek","name":"merek"},
              {"data" : "warna","name":"warna"},
              {"data" : "jumlah_berat","name":"jumlah_berat"},
              {"data" : "jumlah_lembar","name":"jumlah_lembar"},
              {"data" : "id_permintaan_jadi","name":"id_permintaan_jadi"}
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              aoData.push({"name":"stsBarang","value":param});
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
              $("td:eq(8)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' onclick=editListRetur('"+aData["id_permintaan_jadi"]+"')><i class='fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-flat btn-danger' onclick=deletedListRetur('"+aData["id_permintaan_jadi"]+"')><i class='fa fa-trash'></i> Hapus</button>");
            }
          });
        }
      </script>
      <script type="text/javascript">
        function approve_returBarang(param){
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudanghasil/main/approveReturBarang'); ?>",
            data : {param:param},
            success:function(response){
              if (jQuery.trim(response) == "Success") {
                alertReturBarang(param)
                datatableBarangRetur(param);
                datatableListGudangHasil("#tableDataMasterGudangHasil"+param+"",param);
                $("#modalApproveReturBarang").modal("hide");
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Berhasil Diapprove</b></div>");
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
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Gagal Diapprove</b></div>");
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
        function alertReturBarang(jenis){
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudanghasil/main/countReturBarang'); ?>",
            data : {jenis:jenis},
            success:function(response){
              if (response>0) {
                $("#alertApproveReturBarang"+jenis+"").show();
              }else{
                $("#alertApproveReturBarang"+jenis+"").hide();
              }
            }
          });
        }
      </script>
      <script type="text/javascript">
        function editListRetur(id) {
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_pengiriman/main/getListReturPerId') ?>",
            data : {id:id},
            dataType : "JSON",
            success:function(response){
              var produk = response[0].ukuran+" - "+response[0].merek+" - "+response[0].warna+" - "+response[0].jns_permintaan;
              $("#id_permintaan_jadi").val(response[0].id_permintaan_jadi);
              $("#produk").val(produk.toUpperCase());
              $("#customer_edit").val(response[0].customer);
              $("#jenis").val(response[0].sts_barang);
              $("#berat_edit").val(response[0].jumlah_berat);
              $("#lembar_edit").val(response[0].jumlah_lembar);
              $("#tgl_retur_edit").val(response[0].tgl_transaksi);
              $("#modalEditRetur").modal({backdrop:"static"});
            }
          });
        }

        function deletedListRetur(id){
          var r = confirm("Hapus barang retur..?");
          if (r==true) {
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('_gudanghasil/main/deletedListRetur'); ?>",
              data : {id:id},
              success:function(response){
                if (jQuery.trim(response)=="Success"){
                  alertReturBarang(param);
                  datatableBarangRetur(jenis);
                  $("#modalEditRetur").modal("hide");
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

        function updateListRetur(){
          var id    = $("#id_permintaan_jadi").val();
          var tgl   = $("#tgl_retur_edit").val();
          var jenis = $("#jenis").val();
          var berat = $("#berat_edit").val();
          var lembar= $("#lembar_edit").val();
          var customer = $("#customer_edit").val();
          if (!id||!tgl||!berat||!lembar||!customer) {
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
            url  : "<?php echo site_url('_pengiriman/main/updateListRetur'); ?>",
            data : {id:id,tgl:tgl,berat:berat,lembar:lembar,customer:customer},
            success:function(response){
              if (jQuery.trim(response)=="Success"){
                alertReturBarang(param);
                datatableBarangRetur(jenis);
                $("#modalEditRetur").modal("hide");
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
        function getKodeBahanSablon(){
          tableListTambahBahanSablon();
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudanghasil/main/genKodeBahanSablon'); ?>",
            success:function(response){
              $("#kdBahanSablon").val(response);
            }
          });
        }

        function getBahanSablon(){
          var jenis = $("#jenisBahanSablon").val();
          if (!jenis) {
            $("#frmBahanSablon").hide();
            $("#stokBahanSablon").prop('disabled', true);
            $("#tglBahanSablon").prop('disabled', true);
          }else{
            $("#frmBahanSablon").show();
            $("#stokBahanSablon").prop('disabled', false);
            $("#tglBahanSablon").prop('disabled', false);
            $("#namaBahanSablon").select2({
              placeholder : "Pilih Bahan",
              dropdownParent: $('#modalTambahBahanSablon'),
              width : "100%",
              cache:true,
              allowClear:true,
              ajax:{
                url : "<?php echo base_url(); ?>_gudanghasil/main/getBahanSablon/"+jenis,
                dataType : "JSON",
                delay : 0,
                processResults : function(data){
                  return{
                    results : $.map(data, function(item){
                      return{
                        text:item.kd_gd_bahan+" | "+item.nm_barang+" | "+item.warna+" | "+item.status,
                        id:item.kd_gd_bahan+","+item.nm_barang+","+item.warna+","+item.status+","+item.jenis
                      }
                    })
                  };
                }
              }
            });
          }
        }

        function addBahanSablon(){
          var kode  = $("#kdBahanSablon").val();
          var jenis = $("#jenisBahanSablon").val();
          var nama  = $("#namaBahanSablon").val();
          var stok  = $("#stokBahanSablon").val();
          var tgl   = $("#tglBahanSablon").val();
          if (!kode||!jenis||!nama||!stok||!tgl) {
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
              url  : "<?php echo site_url('_gudanghasil/main/addBahanSablon'); ?>",
              data : {kode:kode,jenis:jenis,nama:nama,stok:stok,tgl:tgl},
              success:function(response){
                if (jQuery.trim(response)=="Success"){
                  getKodeBahanSablon()
                  $("input").val(" ");
                  $("select").val("");
                  $("#frmBahanSablon").hide();
                  $("#stokBahanSablon").prop('disabled', true);
                  $("#tglBahanSablon").prop('disabled', true);
                  $("#modal-notif").modal("show")
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Berhasil Ditambah</b></div>");
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
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Gagal Ditambah</b></div>");
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

        function deleteListTempBahanSablon(id){
          var r = confirm("Hapus Data..?");
          if (r==true) {
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('_gudanghasil/main/deleteListTempBahanSablon'); ?>",
              data : {id:id},
              success:function(response){
                if (jQuery.trim(response)=="Success"){
                  getKodeBahanSablon()
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

        function saveBahanSablon(){
          $.ajax({
            type : "POST",
            url  : "<?php site_url("_gudanghasil/main/countListTambahBahanSablon"); ?>",
            success:function(num){
              if (num>0) {
                $.ajax({
                  type : "POST",
                  url  : "<?php echo site_url('_gudanghasil/main/saveBahanSablon'); ?>",
                  success:function(response){
                    if (jQuery.trim(response)=="Success"){
                      datatableBahanSablon()
                      $("#modalTambahBahanSablon").modal("hide");
                      $("#modal-notif").modal("show")
                      $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Berhasil Disimpan</b></div>");
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
                      $("#modalNotifContent").html("<div style='text-align: center;'><b>Data Gagal Disimpan</b></div>");
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
              }else{
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak Ada List Permintaan Bahan.</b></div>");
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

        function alertKirimanBahanSablon(){
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudanghasil/main/countKirimanBahanSablon') ?>",
            success:function(response){
              if (response>0) {
                $("#alertKirimanBahanSablon").show();
              }else{
                $("#alertKirimanBahanSablon").hide();
              }
            }
          });
        }

        function modalKirimanBahanSablon(){
          $.ajax({
            url : "<?php echo base_url() ?>_gudanghasil/main/getDataKirimanBahanSablon",
            dataType : "JSON",
            success : function(response){
              $("#tableDataKirimanBahanSablon > tbody > tr").empty();
              $.each(response,function(AvIndex,AvValue){
                $("#tableDataKirimanBahanSablon > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+ ++AvIndex +"</td>"+
                    "<td>"+AvValue.tgl_permintaan+"</td>"+
                    "<td>"+AvValue.nm_barang+"</td>"+
                    "<td>"+AvValue.jenis+"</td>"+
                    "<td>"+AvValue.warna+"</td>"+
                    "<td>"+AvValue.jumlah_permintaan+"</td>"+
                  "</tr>"
                );
              });
            }
          });
        }

        function approveKirimanBahanSablon(){
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url("_gudanghasil/main/approveKirimanBahanSablon"); ?>",
            success:function(response){
              if (jQuery.trim(response)=="Success"){
                datatableBahanSablon()
                alertKirimanBahanSablon()
                $("#modalKirimanBahanSablon").modal("hide");
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

        function deleteBahanSablon(id){
          var r = confirm("Hapus List Data Bahan ?");
          var id = id;
          if (r==true) {
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('_gudanghasil/main/deleteBahanSablon'); ?>",
              data : {id:id},
              success:function(response){
                if (jQuery.trim(response)=="Success"){
                  datatableBahanSablon()
                  $("#modalKirimanBahanSablon").modal("hide");
                  $("#modal-notif").modal("show");
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

        function editListBahanSablon(id){
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudanghasil/main/editListBahanSablon') ?>",
            data : {id:id},
            dataType : "JSON",
            success:function(response){
              $("#kd_bahanSablon").val(response[0].kd_bahan_sablon);
              $("#nama_bahanSablon").val(response[0].nm_bahan);
              $("#warna").val(response[0].warna);
              $("#edit_jenisBahanSablon").val(response[0].jenis);
              $("#stok_bahanSablon").val(response[0].stok);
              $("#modalEditBahanSablon").modal({backdrop:"static"});
            }
          });
        }

        function updateListBahanSablon(){
          var id   = $("#kd_bahanSablon").val();
          var stok = $("#stok_bahanSablon").val();
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudanghasil/main/updateListBahanSablon'); ?>",
            data : {id:id,stok:stok},
            success:function(response){
              if (jQuery.trim(response)=="Success"){
                datatableBahanSablon()
                $("#modalEditBahanSablon").modal("hide");
                $("#modal-notif").modal("show");
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

        $("#cariJenis").on("change",function(){
          var jenis = $("#cariJenis").val();
          if (!jenis) {
            $("#fldBahanSablon").hide();
          }else{
            $("#fldBahanSablon").show();
            $("#cariBahan").select2({
              placeholder : "Pilih Bahan",
              dropdownParent: $('#modalCariHistoryBahanSablon'),
              width : "100%",
              cache:true,
              allowClear:true,
              ajax:{
                url : "<?php echo base_url(); ?>_gudanghasil/main/getBahanSablonFull/"+jenis,
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
        });

        function cariHistoryBahanSablon(){
          var tglAwal  = $("#tglAwal").val();
          var tglAkhir = $("#tglAkhir").val();
          var jenis    = $("#cariJenis").val();
          var bahan    = $("#cariBahan").val();
          if (!tglAwal||!tglAkhir||!jenis||!bahan) {
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
            function UpperCaseFirstLetter(str){
                 return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
            }
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url("_gudanghasil/main/getDetailHistoryBahanSablon"); ?>",
              data : {tglAwal:tglAwal, tglAkhir:tglAkhir, bahan:bahan},
              dataType : "JSON",
              success:function(response){
                if(response["totalPemakaian"]==null) {response["totalPemakaian"]=0;}
                if(response["totalPengambilan"]==null){response["totalPengambilan"]=0;}
                $("#saldoAwal").text(response["saldoAwal"]);
                $("#totalPengambilan").text(response["totalPengambilan"]);
                $("#totalPemakaian").text(response["totalPemakaian"]);
                $("#saldoAkhir").text(response["saldoAkhir"]);
                $("#titleNmBahan1").text(UpperCaseFirstLetter(jenis+" "+response["nm_bahan"]+" "+response["warna"]));
                $("#titleNmBahan2").text(UpperCaseFirstLetter(jenis+" "+response["nm_bahan"]+" "+response["warna"]));
              }
            });
            $("#modalCariHistory").modal("hide");
            $("#masterContainerHasil").css("display","none");
            $("#historyContainerApal").css("display","none");
            $("#historyContainerHasil").css("display","none");
            $("#historyBahanSablon").show();
            datatableHistoryBahanSablonKeluar(tglAwal,tglAkhir,bahan)
            datatableHistoryBahanSablonMasuk(tglAwal,tglAkhir,bahan)
            $("#modalCariHistoryBahanSablon").modal("hide")
            $("input").val(""); $("select").val(""); $("#fldBahanSablon").hide();
          }
        }

        function getPermintaanBahanSablon(){
          var jenis = $("#jenisPermintaanBahan").val();
          if (!jenis) {
            $("#frmPilihBahan").hide();
            $("#jumlahPermintaan").prop('disabled', true);
            $("#tglPermintaan").prop('disabled', true);
          }else{
            $("#frmPilihBahan").show();
            $("#jumlahPermintaan").prop('disabled', false);
            $("#tglPermintaan").prop('disabled', false);
            $("#BahanSablon").select2({
              placeholder : "Pilih Bahan",
              dropdownParent: $('#modalPermintaanBahanSablon'),
              width : "100%",
              cache:true,
              allowClear:true,
              ajax:{
                url : "<?php echo base_url(); ?>_gudanghasil/main/getPermintaanBahanSablon/"+jenis,
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
        }

        function addPermintaanBahanSablon(){
          var jenis   = $("#jenisPermintaanBahan").val();
          var nmBahan = $("#BahanSablon").val();
          var jumlah  = $("#jumlahPermintaan").val();
          var tanggal = $("#tglPermintaan").val();
          if (!jenis||!nmBahan||!jumlah||!tanggal) {
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
              url  : "<?php echo site_url('_gudanghasil/main/addPermintaanBahanSablon'); ?>",
              data : {jenis:jenis,nmBahan:nmBahan,jumlah:jumlah,tanggal:tanggal},
              success:function(response){
                if (jQuery.trim(response)=="Success"){
                  tableListPermintaanBahanSablon()
                  $("#modal-notif").modal("show");
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>List Permintaan Berhasil Ditambah</b></div>");
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
                  $("#modalNotifContent").html("<div style='text-align: center;'><b>List Permintaan Gagal Ditambah</b></div>");
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

        function modalPermintaanBahanSablon() {
          tableListPermintaanBahanSablon()
        }

        function deleteListPermintaanBahanSablon(id){
          var r = confirm("Hapus List Permintaan Bahan..?");
          if (r==true) {
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('_gudanghasil/main/deleteListPermintaanBahanSablon'); ?>",
              data : {id:id},
              success:function(response){
                if (jQuery.trim(response)=="Success"){
                  tableListPermintaanBahanSablon()
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

        function kirimPermintaanBahanSablon(){
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url("_gudanghasil/main/countPermintaanBahanSablonPending") ?>",
            success:function(num){
              if (num>0) {
                $.ajax({
                  type : "POST",
                  url  : "<?php echo site_url('_gudanghasil/main/kirimPermintaanBahanSablon'); ?>",
                  success:function(response){
                    if (jQuery.trim(response)=="Success"){
                      tableListPermintaanBahanSablon()
                      $("#modalPermintaanBahanSablon").modal("hide");
                      $("#modal-notif").modal("show");
                      $("#modalNotifContent").html("<div style='text-align: center;'><b>List Permintaan Berhasil Dikirim</b></div>");
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
                      $("#modalNotifContent").html("<div style='text-align: center;'><b>List Permintaan Gagal Dikirim</b></div>");
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
              }else{
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak Ada List Permintaan.</b></div>");
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

        function cariHasilJadi(){
          var tglAwal  = $("#txtTanggalAwal").val();
          var tglAkhir = $("#txtTanggalAkhir").val();
          if (!tglAwal||!tglAkhir) {
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
            datatableDetailHasilJadi(tglAwal,tglAkhir);
            $("#modalCariBonHasil").modal("hide");
            $("#tableDetailHasilJadi").show();
          }
        }

        function editKekuranganKelebihan(id){
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudanghasil/main/getKirimanPotongPerId');?>",
            data : {id:id},
            dataType : "JSON",
            success:function(response){
              $("#modalEditKekuranganKelebihanKiriman").modal({backdrop:"static"});
              $("#id").val(response[0].id_permintaan_jadi);
              $("#tanggal").val(response[0].tgl_transaksi);
              $("#customer").val(response[0].customer);
              $("#nmBarang").val(response[0].ukuran+" "+response[0].merek+" "+response[0].warna);
              $("#berat").val(response[0].jumlah_berat);
              $("#lembar").val(response[0].jumlah_lembar);
              $("#stsBarang").val(response[0].sts_barang);
            }
          });
        }

        function kirimBalikKiriman(){
          var id   = $("#id").val();
          var note = $("#note").val();
          var status = $("#stsBarang").val();
          if (!note) {
            $("#modal-notif").modal("show")
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Note Harus diisi..!</b></div>");
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
            url  : "<?Php echo site_url('_gudanghasil/main/kirimBalikKiriman'); ?>",
            data : {id:id,note:note},
            success:function(response){
              if (jQuery.trim(response)=="Success"){
                modalKirimanDariBagian(status,'POTONG');
                $("#modalEditKekuranganKelebihanKiriman").modal("hide");
                $("#modal-notif").modal("show");
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Berhasil Mengirim Balik</b></div>");
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
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Gagal Mengirim Balik</b></div>");
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

        function alertKirimanBarangKeGudangBuffer(){
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudanghasil/main/countKirimanBarangKeGudangBuffer'); ?>",
            success:function(num){
              if (num>0) {
                $("#alertKirimanBarangKeGudangBuffer").show();
              }else{
                $("#alertKirimanBarangKeGudangBuffer").hide();
              }
            }
          });
        }

        function alertKirimanBarang(param1,param2,param3=""){
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudanghasil/main/countKirimanBarang');?>",
            data : {stsBarang:param1, bagian:param2, jnsPermintaan:param3},
            success:function(response){
              if (response>0) {
                $("#alertKirimanBarangKe"+param1+"").show();
              }else{
                $("#alertKirimanBarangKe"+param1+"").hide();
              }
            }
          });
        }

        function alertKembalianHDSablon(){
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_gudanghasil/main/countKembalianHDSablon') ?>",
            success:function(response){
              if (response>0) {
                $("#alertKembalianHDSablon").show();
              }else{
                $("#alertKembalianHDSablon").hide();
              }
            }
          });
        }

        function deleteDataOrderTerkirim(id){
          var id_dp = $("#id_dp").val();
          if (confirm("Hapus data terkirim..?")) {
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('_gudanghasil/main/deleteDataOrderTerkirim') ?>",
              data : {id:id},
              success:function(response){
                if(jQuery.trim(response) === "Success"){
                  datatableListPesananTerkirim(param="");
                  modalLihatDetailPengiriman(id_dp);
                  $("#modalEditDataOrderTerkirim").modal("hide");
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Data Baru Berhasil Dihapus");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    resetFormPengirimanBaru();
                    tableListPengirimanBaruTemp();
                  },2000);
                }else if(jQuery.trim(response) === "Failed"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Data Baru Gagal Dihapus");
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
      </script>
<!--===============================================General Function (Finish) ===============================================-->
    </body>
</html>
