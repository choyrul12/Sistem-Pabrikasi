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
          datatableBarangRetur()
          datatableDataOrderCabang();
          datatableListOrderBaruCabang();
          datatableListPantauOrderCabangGlobal();
          datatableListPantauOrderLuarKota();
          orderBaruCabangCounter();
          orderMarketingDeadlineCounter("DK");
          orderMarketingDeadlineCounter("LK");
          orderMarketingDeadlineCounter("CBG");
          orderMarketingDeadlineCounterGlobal();
          setInterval(function() {
            orderBaruCabangCounter();
          },600000);
          setInterval(function() {
            orderMarketingDeadlineCounter("DK");
            orderMarketingDeadlineCounter("LK");
          },600000);
          if($("#tableListDataOrderMarketing_DK").length > 0){
            datatableDataOrderMarketing("DK");
          }

          if($("#tableListDataOrderMarketing_LK").length > 0){
            datatableDataOrderMarketing("LK");
          }
          datatablePantauOrderCabang();
          datatablePantauOrderMarketing();
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
//================================ MODAL METHOD (START) ============================//
        function modalDetailPesanan(param){
          $("#modalDetailPesanan").modal({
            backdrop : 'static'
          });
          datatableDetailPesanan(param);
          $("#btnApprove").attr("onclick","saveApproveOrder('"+param+"')");
        }

        function modalDetailPesananHistory(param){
          $("#modalDetailPesanan").modal({
            backdrop : 'static'
          });
          datatableDetailPesananHistory(param);
        }

        function modalEditDetailPesanan(param,param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_pengiriman/main/getDetailPesanan'); ?>",
            dataType : "JSON",
            data : {
              idDetail : param
            },
            success : function(response){
              $("#cmbUkuran").select2({
      					placeholder : "Pilih Ukuran Barang",
      					dropdownParent: $('#modalEditPesananDetail'),
      					width : "100%",
      					cache:true,
      					allowClear:true,
      					ajax:{
      						url : "<?php echo base_url(); ?>_pengiriman/main/getComboBoxValueHasil/",
      						dataType : "JSON",
      						delay : 0,
      						processResults : function(data){
      							return{
      								results : $.map(data, function(item){
      									if(item.jenis == "MINYAK" || item.jenis == "CAT MURNI"){
      										return{
      											text:item.nm_barang +" | "+ item.warna +" | "+ item.status +" | "+ item.jenis,
      											id:item.kd_gd_bahan
      										}
      									}else{
      										return{
      											text:item.ukuran +" | "+ item.warna_plastik +" | "+ item.tebal +" | "+ item.merek +" | "+ item.jns_permintaan +" | "+ item.jns_brg,
      											id:item.kd_gd_hasil
      										}
      									}
      								})
      							};
      						}
      					}
      				});
              $.each(response, function(AvIndex, AvValue){
                $("#txtWarnaCetak").val(AvValue.warna_cetak);
                $("#txtWarnaStrip").val(AvValue.sm);
                $("#cmbJenis").val(AvValue.jenis);
                $("#txtTebal").val(AvValue.dll);
                $("#txtJumlahPermintaan").val(AvValue.jumlah);
                $("#cmbSatuan").val(AvValue.satuan);
                $("#txtKetarangan").val(AvValue.keterangan);
                $("#btnEditPesananDetail").attr("onclick","editPesananDetail('"+AvValue.id_dp+"','"+param2+"')")
              });
            }
          });
          $("#modalEditPesananDetail").modal({
            backdrop : "static"
          });
        }
//================================ MODAL METHOD (FINISH) ============================//

//================================ SEARCH METHOD (START) ============================//
        function searchHistoryOrderCabang(){
          var tglAwal = $("#txtTglAwal").val();
          var tglAkhir = $("#txtTglAkhir").val();
          if(tglAwal=="" || tglAkhir==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            datatableListHistoryOrderCabangGlobal();
            var arrBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
  					var date = new Date(tglAwal);
  					var tanggal1 = date.getDate();
  					var bulan1 = date.getMonth();
  					var tahun1 = date.getFullYear();
  					var dateFormat1 = tanggal1 + " " + arrBulan[bulan1] + " " + tahun1;

            var date = new Date(tglAkhir);
  					var tanggal2 = date.getDate();
  					var bulan2 = date.getMonth();
  					var tahun2 = date.getFullYear();
  					var dateFormat2 = tanggal2 + " " + arrBulan[bulan2] + " " + tahun2;

            $("#h4Judul").text("History Order Tanggal "+dateFormat1+" Sampai "+dateFormat2);
            $("#dataWrapper").css("display","block");

            $("#modalCariHistory").modal("hide");
          }
        }

        function searchHistoryOrderLuarKota(){
          var tglAwal = $("#txtTglAwal").val();
          var tglAkhir = $("#txtTglAkhir").val();
          if(tglAwal=="" || tglAkhir==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            datatableListHistoryOrderLuarKota(tglAwal,tglAkhir);
            var arrBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            var date = new Date(tglAwal);
            var tanggal1 = date.getDate();
            var bulan1 = date.getMonth();
            var tahun1 = date.getFullYear();
            var dateFormat1 = tanggal1 + " " + arrBulan[bulan1] + " " + tahun1;

            var date = new Date(tglAkhir);
            var tanggal2 = date.getDate();
            var bulan2 = date.getMonth();
            var tahun2 = date.getFullYear();
            var dateFormat2 = tanggal2 + " " + arrBulan[bulan2] + " " + tahun2;

            $("#h4Judul").text("History Order Tanggal "+dateFormat1+" s/d "+dateFormat2);
            $("#dataWrapper").css("display","block");

            $("#modalCariHistory").modal("hide");
          }
        }
//================================ SEARCH METHOD (FINISH) ============================//

//================================ RELOAD METHOD (START) ============================//

//================================ RELOAD METHOD (FINISH) ============================//

//================================ RESET FORM METHOD (START) ============================//

//================================ RESET FORM METHOD (FINISH) ============================//

//================================ SAVE METHOD (START) ============================//
        function saveApproveOrder(param){
          if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_pengiriman/main/saveApproveOrder'); ?>",
              dataType : "TEXT",
              data : {
                noOrder : param
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Pesanan Berhasil Di Approve");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    datatableDetailPesanan(param);
                    datatableListOrderBaruCabang();
                    $("#modalDetailPesanan").modal("hide");
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Pesanan Gagal Di Approve");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
                  $("#modalNotifContent").text("Tidak Ada Item Untuk Di Approve");
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

        function saveKirimPesananFull(param, param2){
          if(confirm("Apakah Anda Yakin Ingin Mengirim Barang Ini?")){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_pengiriman/main/saveKirimPesananFull'); ?>",
              dataType : "TEXT",
              data : {
                idDp : param,
                noOrder : param2
              },
              success : function(response) {
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Item Pesanan Berhasil Di Kirim");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Item Pesanan Gagal Di Kirim");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
                  $("#modalNotifContent").text("ID Pesanan Tidak Di Temukan");
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

        function closePesanan(param, param2){
          if(confirm("Pesanan Akan Dianggap Selesai?")){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_pengiriman/main/saveKirimPesananFull'); ?>",
              dataType : "TEXT",
              data : {
                idDp : param,
                noOrder : param2
              },
              success : function(response) {
                if($.trim(response) === "Berhasil"){
                  datatableDataOrderMarketing("LK");
                  datatableDataOrderMarketing("DK");
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Transaksi Berhasil");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Transaksi Gagal");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
                  $("#modalNotifContent").text("ID Pesanan Tidak Di Temukan");
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

        function saveKirimPesananFullBatch(){
          var arrIdDp = $("input[name='pilihanItem']").serializeArray();
          if(arrIdDp.length <= 0){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Anda Belum Memilih Item Untuk Dikirim!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_pengiriman/main/saveKirimPesananFullBatch'); ?>",
              dataType : "TEXT",
              data : {
                arrIdDp : arrIdDp
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Item Pesanan Berhasil Dikirim");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Item Pesanan Gagal Dikirim");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
                  $("#modalNotifContent").text("Anda Belum Memilih Item Untuk Dikirim!");
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

        function saveKirimPesananSetengah(param, param2){
          if(confirm("Apakah Anda Yakin Ingin Mengirim Setengah Dari Barang Ini?")){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_pengiriman/main/saveKirimPesananSetengah'); ?>",
              dataType : "TEXT",
              data : {
                idDp : param,
                noOrder : param2
              },
              success : function(response) {
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Item Pesanan Berhasil Di Kirim");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                  },2000);
                }else if($.trim(response) === "Gagal"){
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Item Pesanan Gagal Di Kirim");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-danger");
                    $("#modalNotifContent").text("");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-warning");
                  $("#modalNotifContent").text("ID Pesanan Tidak Di Temukan");
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
//================================ SAVE METHOD (FINISH) ============================//

//================================ EDIT METHOD (START) ============================//
        function editPesananDetail(param,param2){
          var kdBarang1 = $("#cmbUkuran").val();
          var warnaCetak1 = $("#txtWarnaCetak").val();
          var warnaStrip1 = $("#txtWarnaStrip").val();
          var jenis1 = $("#cmbJenis").val();
          var tebal1 = $("#txtTebal").val();
          var jumlahPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g,"");
          var satuan1 = $("#cmbSatuan").val();
          var keterangan1 = $("#txtKetarangan").val();
          if(warnaCetak1==""||warnaStrip1==""||jenis1==""||
             tebal1==""||jumlahPermintaan1==""||satuan1==""){
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
              url : "<?php echo base_url('_pengiriman/main/editPesananDetail'); ?>",
              dataType : "TEXT",
              data : {
                idTransaksi       : param,
                kdBarang          : kdBarang1,
                warnaCetak        : warnaCetak1,
                warnaStrip        : warnaStrip1,
                jenis             : jenis1,
                tebal             : tebal1,
                jumlahPermintaan  : jumlahPermintaan1,
                satuan            : satuan1,
                keterangan        : keterangan1
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
                    datatableDetailPesanan(param2);
                    $("#modalEditPesananDetail").modal("hide");
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

        function editStatusPrintPengiriman(param){
          if(confirm("Apakah Pesanan Ini Akan Diprint?")){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_pengiriman/main/editStatusPrintPengiriman'); ?>",
              dataType : "TEXT",
              data : {
                noOrder : param
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
                    $("#modalEditPesananDetail").modal("hide");
                    $(".active a[aria-controls='tableListPantauOrderCabangGlobal']").trigger("click");
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Data Gagal Diubah");
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
//================================ EDIT METHOD (FINISH) ============================//

//================================ REMOVE METHOD (START) ============================//
        function deleteAndRestoreDetailPesanan(param, param2, param3){
          if(param3 == "TRUE"){
            confirmText = "Apakah Anda Yakin Ingin Menghapus Data Ini?";
            successText = "Data Berhasil Dihapus";
            failedText = "Data Gagal Dihapus";
          }else{
            confirmText = "Apakah Anda Yakin Ingin Mengembalikan Data Ini?";
            successText = "Data Berhasil Dikembalikan";
            failedText = "Data Gagal Dikembalikan";
          }
          if(confirm(confirmText)){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_pengiriman/main/deleteAndRestoreDetailPesanan') ?>",
              dataType : "TEXT",
              data : {
                idTransaksi : param,
                noOrder : param2,
                deleted : param3
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
                    datatableDetailPesanan(param2);
                    $("#modalEditPesananDetail").modal("hide");
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
//================================ REMOVE METHOD (FINISH) ============================//

//================================ UNSPECIFIED METHOD (START) ============================//
        function showImage(param){
          var url = $(param).attr("src");
          $("#imageShow").attr("src",url);
          $("#modalShowImage").modal("show");
        }

        function orderBaruCabangCounter(){
          $.ajax({
            url : "<?php echo base_url('_pengiriman/main/getCountOrderBaru'); ?>",
            dataType : "JSON",
            success : function(response){
              $("#M_OrderBaruCabang").html('<i class="fa fa-book"></i>Order Baru Cabang <span class="pull-right-container">'+
              '<span class="label bg-blue">'+response[0].counter+'</span>'+
              '</span>');
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

        function orderMarketingDeadlineCounter(param){
          if (param=="DK") {
            var objId = "#MI_OrderMarketingDalamKota";
            var text = "Order Marketing Dalam Kota";
          }else if(param=="LK"){
            var objId = "#MI_OrderMarketingLuarKota";
            var text = "Order Marketing Luar Kota";
          }else if (param=="CBG") {
            var objId = "#MI_OrderCabang";
            var text = "Order Cabang";
          }
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_pengiriman/main/getCountOrderMarketingDeadline'); ?>",
            dataType : "JSON",
            data : {
              jnsOrder : param,
            },
            success : function(response){
              $(objId).html(text+'<span class="label bg-blue pull-right">'+response.Counter+'</span>');
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

        function orderMarketingDeadlineCounterGlobal(){
          var status = "<?php echo $this->session->userdata('fabricationStatus') ?>";
          if (status=="1") {
            $.ajax({
            url : "<?php echo base_url('_pengiriman/main/getCountOrderMarketingDeadlineGlobal'); ?>",
            dataType : "JSON",
            success : function(response){
              $("#M_Order").html('<i class="fa fa-book"></i>'+
                                 ' <span>Order</span>'+
                                 '<span class="pull-right-container">'+
                                  '<i class="fa fa-angle-left pull-right"></i>'+
                                  '<span class="label bg-red">'+response.Counter+'</span>'+
                                 '</span>');
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
//================================ UNSPECIFIED METHOD (FINISH) ============================//

//================================ DATATABLE METHOD (START) ============================//
        function datatableDataOrderCabang(){
          $("#tableDataOrderCabang").dataTable().fnDestroy();
          $("#tableDataOrderCabang").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "scrollX" : "100%",
            "scrollY" : "500px",
            "sPaginationType": "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_pengiriman/main/getListDataOrderCabangSiapDikirim') ?>",
            "columns" : [
              {"data":"id_dp","name":"P.no_po"},
              {"data":"tgl_pesan","name":"P.tgl_pesan"},
              {"data":"tgl_estimasi","name":"P.tgl_estimasi"},
              {"data":"nm_pemesan","name":"P.nm_pemesan"},
              {"data":"jumlah","name":"PD.jumlah"},
              {"data":"jumlah_kirim","name":"PD.jumlah_kirim"},
              {"data":"sisa","name":"(PD.jumlah - PD.jumlah_kirim)"},
              {"data":"ukuran","name":"GH.ukuran"},
              {"data":"warna_plastik","name":"GH.warna_plastik"},
              {"data":"merek","name":"PD.merek"},
              {"data":"sts_pesanan","name":"PD.sts_pesanan"},
              {"data":"no_order","name":"P.no_order","width":"20%"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "drawCallback" : function(){
              $('.minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
              });
              var limit = 20;
              var counter = 0;
              $(".minimal").on("ifChecked",function(e){
                var checkboxes = $("input:checkbox");
                var $this=$(this);
                $("#btnKirimPilihan_Cabang").html('<i class="fa fa-send"></i> Kirim ('+ ++counter +') Item Pesanan');
                if (checkboxes.filter(":checked").length > limit) {
                  alert('Maksimal Ceklis 20 Item Saja !');
                  setTimeout(function(){
                      $this.iCheck('uncheck');
                  },1);
                }
              });
              $(".minimal").on("ifUnchecked", function(e){
                $("#btnKirimPilihan_Cabang").html('<i class="fa fa-send"></i> Kirim ('+ --counter +') Item Pesanan')
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvFullDisplayIndex){
              $("td:eq(0)", AvRow).text(++AvDisplayIndex);
              $("td:eq(2)",AvRow).html(AvData["nm_pemesan"]+
                                       "<label class='text-blue'>["+AvData["no_order"]+"]</label>"+
                                       "<label class='text-yellow'>["+AvData["no_po"]+"]</label>");
              if(parseFloat(AvData["sisa"]) <= 0){
                $("td:eq(11)", AvRow).html("<button class='btn btn-md btn-flat btn-primary' style='float:left; margin-right:5px;' onclick=modalKirimParsial('"+AvData["id_dp"]+"')><i class='fa fa-send'></i> Kirim</button>"+
                                           "<input type='checkbox' value='"+AvData["id_dp"]+"#"+AvData["no_order"]+"' class='minimal' name='pilihanItem' style='float:left;'>");
              }else if(parseFloat(AvData["sisa"]) > 0 && parseFloat(AvData["jumlah_kirim"]) > 0){
                $("td:eq(11)", AvRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalKirimParsial('"+AvData["id_dp"]+"')><i class='fa fa-send'></i> Kirim Setengah</button>");
              }else{
                $("td:eq(11)", AvRow).html("<button class='btn btn-md btn-flat btn-danger'><i class='fa fa-lock'></i> Pesanan Belum Siap</button>");
              }

              if(AvData["sts_pesanan"] == "PACKING"){
                $("td:eq(10)",AvRow).html("<label class='text-green'>"+AvData["sts_pesanan"]+"</label>");
              }else{
                $("td:eq(10)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
              }
              $("td:eq(4)",AvRow).text(parseFloat(AvData["jumlah"]).toLocaleString()+" "+AvData["satuan"]);
              $("td:eq(5)",AvRow).text(parseFloat(AvData["jumlah_kirim"]).toLocaleString()+" "+AvData["satuan"]);
              $("td:eq(6)",AvRow).text(parseFloat(AvData["sisa"]).toLocaleString()+" "+AvData["satuan"]);
            }
          });
        }

        function datatableDataOrderMarketing(param){
          $("#tableListDataOrderMarketing_"+param).dataTable().fnDestroy();
          $("#tableListDataOrderMarketing_"+param).dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "scrollX" : "100%",
            "scrollY" : "500px",
            "sPaginationType": "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_pengiriman/main/getListDataOrderMarketingSiapDikirim') ?>",
            "columns" : [
              {"data":"id_dp","name":"P.kd_order"},
              {"data":"tgl_pesan","name":"P.tgl_pesan"},
              {"data":"tgl_estimasi","name":"P.tgl_estimasi"},
              {"data":"nm_perusahaan","name":"C.nm_perusahaan"},
              {"data":"jumlah","name":"PD.jumlah"},
              {"data":"jumlah_kirim","name":"PD.jumlah_kirim"},
              {"data":"sisa","name":"(PD.jumlah - PD.jumlah_kirim)"},
              {"data":"ukuran","name":"GH.ukuran"},
              {"data":"warna_plastik","name":"GH.warna_plastik"},
              {"data":"merek","name":"PD.merek"},
              {"data":"sts_pesanan","name":"C.nm_perusahaan_update"},
              {"data":"no_order","name":"P.no_order","width":"20%"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              AvData.push({"name":"jnsOrder","value":param})
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "drawCallback" : function(){
              $('.minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
              });
              var limit = 20;
              var counter = 0;
              $(".minimal").on("ifChecked",function(e){
                var checkboxes = $("input:checkbox");
                var $this=$(this);

                $("#btnKirimPilihan_Marketing").html('<i class="fa fa-send"></i> Kirim ('+ ++counter +') Item Pesanan');
                if (checkboxes.filter(":checked").length > limit) {
                  alert('Maksimal Ceklis 20 Item Saja !');
                  setTimeout(function(){
                      $this.iCheck('uncheck');
                  },1);
                }
              });
              $(".minimal").on("ifUnchecked", function(e){
                $("#btnKirimPilihan_Marketing").html('<i class="fa fa-send"></i> Kirim ('+ --counter +') Item Pesanan')
              });
              $("#btnKirimPilihan_Marketing").attr("onclick","saveKirimPesananFullBatch()");
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvFullDisplayIndex){
              $("td:eq(0)", AvRow).text(++AvDisplayIndex);
              var status = "<?php echo $this->session->userdata("fabricationStatus"); ?>" ;
              if(parseFloat(AvData["sisa"]) <= 0){
                // if (status == "2"){
                  $("td:eq(11)", AvRow).html("<button class='btn btn-md btn-flat btn-primary' style='float:left; width:130px; margin-right:5px;' onclick=modalKirimParsial('"+AvData["id_dp"]+"')><i class='fa fa-send'></i> Kirim</button><button class='btn btn-md btn-flat btn-success' style='float:left; width:130px; margin-right:5px;' onclick=closePesanan('"+AvData["id_dp"]+"','"+AvData["no_order"]+"')><i class='fa fa-check'></i> Close</button> <input type='checkbox' value='"+AvData["id_dp"]+"#"+AvData["no_order"]+"' class='minimal' name='pilihanItem' style='float:left;'>");
                // }else if (status == "1"){
                //   $("td:eq(11)", AvRow).html("<button class='btn btn-md btn-flat btn-primary' style='float:left; margin-right:5px;' onclick=saveKirimPesananFull('"+AvData["id_dp"]+"','"+AvData["no_order"]+"')><i class='fa fa-send'></i> Kirim</button>"+
                //                            "<input type='checkbox' value='"+AvData["id_dp"]+"#"+AvData["no_order"]+"' class='minimal' name='pilihanItem' style='float:left;'>");
                // }
              }else if(parseFloat(AvData["sisa"]) > 0 && parseFloat(AvData["jumlah_kirim"]) > 0){
                // if (status == "2"){
                //   $("td:eq(11)", AvRow).html("<button class='btn btn-md btn-flat btn-primary' style='float:left; width:130px; margin-right:5px;' onclick=modalKirimParsial('"+AvData["id_dp"]+"')><i class='fa fa-send'></i> Kirim</button>");
                // }else if (status == "1"){
                  $("td:eq(11)", AvRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalKirimParsial('"+AvData["id_dp"]+"')><i class='fa fa-send'></i> Kirim Setengah</button>");

                // }
              }else{
                $("td:eq(11)", AvRow).html("<button class='btn btn-md btn-flat btn-danger'><i class='fa fa-lock'></i> Pesanan Belum Siap</button>");
              }

              if(AvData["sts_pesanan"] == "PACKING"){
                $("td:eq(10)",AvRow).html("<label class='text-green'>"+AvData["sts_pesanan"]+"</label>");
              }else{
                $("td:eq(10)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
              }

              var arrTglEstimasi = AvData["tgl_estimasi"].split("-");
              var tgl_estimasi = new Date(arrTglEstimasi[2],arrTglEstimasi[1]-1,arrTglEstimasi[0]);
              var date = new Date();
              var month = date.getMonth()+1;
              var day = date.getDate();
              var tgl_sekarang_temp = (date.getFullYear()+'-'+
                                      ((''+month).length<2 ? '0' : '')+ month +'-'+
                                      ((''+day).length<2 ? '0' : ''))+ day;
              var tgl_sekarang = new Date(tgl_sekarang_temp);
              var timeDiff = Math.round(tgl_estimasi.getTime() - tgl_sekarang.getTime());
              var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
              if(diffDays <= 2 && diffDays >= 0){
                $('td', AvRow).css('background-color', 'rgba(237,234,0,0.6)');
                $('td:eq(10)', AvRow).css('background-color', 'transparent');
                $('td:eq(11)', AvRow).css('background-color', 'transparent');
                $("td:eq(3)",AvRow).html(AvData["nm_perusahaan"]+
                                         "<label>["+AvData["no_order"]+"]</label>"+
                                         "<label>["+AvData["kd_order"]+"]</label>");
              }else if(diffDays < 0){
                $('td', AvRow).css('background-color', 'rgba(255,0,0,0.6)');
                $('td:eq(10)', AvRow).css('background-color', 'transparent');
                $('td:eq(11)', AvRow).css('background-color', 'transparent');
                $("td:eq(3)",AvRow).html(AvData["nm_perusahaan"]+
                                         "<label>["+AvData["no_order"]+"]</label>"+
                                         "<label>["+AvData["kd_order"]+"]</label>");
                $('td', AvRow).css('color', '#FFF');
              }else{
                $("td:eq(3)",AvRow).html(AvData["nm_perusahaan"]+
                                         "<label class='text-blue'>["+AvData["no_order"]+"]</label>"+
                                         "<label class='text-yellow'>["+AvData["kd_order"]+"]</label>");
              }

              $("td:eq(4)",AvRow).text(parseFloat(AvData["jumlah"]).toLocaleString()+" "+AvData["satuan"]);
              $("td:eq(5)",AvRow).text(parseFloat(AvData["jumlah_kirim"]).toLocaleString()+" "+AvData["satuan"]);
              $("td:eq(6)",AvRow).text(parseFloat(AvData["sisa"]).toLocaleString()+" "+AvData["satuan"]);
            }
          });
        }

        function modalKirimParsial(id)
        {
          $("#tgl_kirim").val("");
          $("#jml_kirim").val("");
          $(".date").datepicker("setDate",null);
          tabelPengirimanParsial(id);
          tabelListPengirimanParsial(id);
        }

        function tabelPengirimanParsial(id)
        {
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_pengiriman/main/getDetailPengirimanParsial'); ?>",
            data : {id:id},
            dataType : "JSON",
            success:function(response){
              $("#tableListOrder > tbody > tr").empty();
              $.each(response, function(Index, Value){
                $("#tableListOrder tbody:last-child").append(
                  "<tr>"+
                    "<td>"+Value.no_order+"</td>"+
                    "<td>"+Value.jumlah+" "+Value.satuan+"</td>"+
                    "<td>"+Value.jumlah_terkirim+" "+Value.satuan+"</td>"+
                    "<td>"+(Value.jumlah-Value.jumlah_terkirim)+" "+Value.satuan+"</td>"+
                  "</tr>"
                );
              });
              $("#noOrder").val(response[0].no_order)
              $("#idDp").val(id)
              $("#modalKirimParsial").modal("show");
            }
          });
        }

        function tabelListPengirimanParsial(id)
        {
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_pengiriman/main/getListPengirimanParsial'); ?>",
            data : {id:id},
            dataType : "JSON",
            success:function(response){
              $("#tableListDetailPengirimanParsial > tbody > tr").empty();
              $.each(response, function(Index, Value){
                $("#tableListDetailPengirimanParsial tbody:last-child").append(
                  "<tr>"+
                    "<td>"+Value.tanggal_kirim+"</td>"+
                    "<td>"+Value.jumlah_kirim+"</td>"+
                    "<td><button class='btn btn-flat btn-primary btn-sm' style='width:80px'>Edit</button><button class='btn btn-flat btn-danger btn-sm' style='width:80px'>Hapus</button></td>"+
                  "</tr>"
                );
              });
              $("#idDp").val(id)
              $("#modalKirimParsial").modal("show");
            }
          });
        }

        function kirimBarangParsial()
        {
          var id_dp = $("#idDp").val();
          var jml_kirim = $("#jml_kirim").val();
          var tgl_kirim = $("#tgl_kirim").val();
          var no_order = $("#noOrder").val();
          if (!id_dp||!jml_kirim||!tgl_kirim||!no_order) {
            $("#modal-notif").modal("show")
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Kolom Harus Diisi !</b></div>");
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
              url  : "<?php echo site_url('_pengiriman/main/kirimBarangParsial'); ?>",
              data : {id_dp:id_dp,jml_kirim:jml_kirim,tgl_kirim:tgl_kirim,no_order:no_order},
              success:function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  modalKirimParsial(id_dp);
                  datatableDataOrderMarketing("LK");
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

        function datatableListOrderBaruCabang(){
          $("#tableListOrderBaruCabang").dataTable().fnDestroy();
          $("#tableListOrderBaruCabang").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "scrollX" : "100%",
            "scrollY" : "500px",
            "sPaginationType": "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_pengiriman/main/getListOrderBaruCabang') ?>",
            "columns" : [
              {"data":"no_order","name":"no_order"},
              {"data":"tgl_pesan","name":"tgl_pesan"},
              {"data":"nm_pemesan","name":"nm_pemesan"},
              {"data":"sts_pesanan","name":"sts_pesanan"},
              {"data":"no_order","name":"no_order"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "drawCallback" : function(){
              $('.minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvFullDisplayIndex){
              $("td:eq(0)", AvRow).text(++AvDisplayIndex);
              $("td:eq(3)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
              $("td:eq(4)",AvRow).html("<button class='btn btn-md btn-flat btn-info' onclick=modalDetailPesanan('"+AvData["no_order"]+"')><i class='fa fa-list'></i> Detail Pesanan</button>");
            }
          });
        }

        function datatableListPantauOrderCabangGlobal(){
          $("#tableListPantauOrderCabangGlobal").dataTable().fnDestroy();
          $("#tableListPantauOrderCabangGlobal").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "scrollX" : "100%",
            "scrollY" : "500px",
            "sPaginationType": "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_pengiriman/main/getListPantauOrderCabangGlobal') ?>",
            "columns" : [
              {"data":"no_order","name":"no_po"},
              {"data":"tgl_pesan","name":"tgl_pesan"},
              {"data":"nm_pemesan","name":"nm_pemesan"},
              {"data":"sts_pesanan","name":"sts_pesanan"},
              {"data":"no_order","name":"no_order"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "drawCallback" : function(){
              $('.minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvFullDisplayIndex){
              $("td:eq(0)", AvRow).text(++AvDisplayIndex);
              switch (AvData["sts_pesanan"]) {
                case "WAITING"  : $("td:eq(3)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "OPEN"     : $("td:eq(3)",AvRow).html("<label class='text-purple'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PROGRESS" : $("td:eq(3)",AvRow).html("<label class='text-yellow'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PACKING"  : $("td:eq(3)",AvRow).html("<label class='text-blue'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "FINISH"   : $("td:eq(3)",AvRow).html("<label class='text-green'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                default:

              }
              $("td:eq(3)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
              $("td:eq(1)",AvRow).html(AvData["tgl_pesan"]+" <label class='text-blue'>["+AvData["no_po"]+"]</label>"+" <label class='text-yellow'>["+AvData["no_order"]+"]</label>");
              if(AvData["sts_print_pengiriman"] == "TRUE"){
                $("td:eq(4)",AvRow).html("<button class='btn btn-md btn-flat btn-info' onclick=modalDetailPesanan('"+AvData["no_order"]+"')><i class='fa fa-list'></i> Detail Pesanan</button>"+
                                         "<a href='<?php echo base_url('_pengiriman/main/printOrderSheet/') ?>"+AvData["no_order"]+"' target='_blank' onclick=editStatusPrintPengiriman('"+AvData["no_order"]+"') class='btn btn-md btn-flat btn-danger'><i class='fa fa-print'></i> Sudah Di Print</a>");
              }else{
                $("td:eq(4)",AvRow).html("<button class='btn btn-md btn-flat btn-info' onclick=modalDetailPesanan('"+AvData["no_order"]+"')><i class='fa fa-list'></i> Detail Pesanan</button>"+
                                         "<a href='<?php echo base_url('_pengiriman/main/printOrderSheet/') ?>"+AvData["no_order"]+"' target='_blank' onclick=editStatusPrintPengiriman('"+AvData["no_order"]+"') class='btn btn-md btn-flat btn-default'><i class='fa fa-print'></i> Print</a>");
              }
            }
          });
        }

        function datatableListPantauOrderLuarKota(){
          $("#tableListPantauOrderLuarKota").dataTable().fnDestroy();
          $("#tableListPantauOrderLuarKota").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "sPaginationType": "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_pengiriman/main/getListPantauOrderLuarKota') ?>",
            "columns" : [
              {"data":"id_dp","name":"PD.id_dp"},
              {"data":"tgl_pesan","name":"P.tgl_pesan"},
              {"data":"nm_pemesan","name":"P.nm_pemesan"},
              {"data":"jumlah","name":"PD.jumlah"},
              {"data":"jumlah_kirim","name":"PD.jumlah_kirim"},
              {"data":"sisa","name":"(PD.jumlah - PD.jumlah_kirim)"},
              {"data":"ukuran","name":"GH.ukuran"},
              {"data":"warna_plastik","name":"GH.warna_plastik"},
              {"data":"merek","name":"PD.merek"},
              {"data":"dll","name":"PD.dll"},
              {"data":"sts_pesanan","name":"PD.sts_pesanan"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "drawCallback" : function(){
              $('.minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvFullDisplayIndex){
              $("td:eq(0)",AvRow).text(++AvDisplayIndex);
              switch (AvData["sts_pesanan"]) {
                case "WAITING"  : $("td:eq(10)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "OPEN"     : $("td:eq(10)",AvRow).html("<label class='text-purple'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PROGRESS" : $("td:eq(10)",AvRow).html("<label class='text-yellow'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PACKING"  : $("td:eq(10)",AvRow).html("<label class='text-blue'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "FINISH"   : $("td:eq(10)",AvRow).html("<label class='text-green'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                default:

              }

              $("td:eq(3)",AvRow).text(parseFloat(AvData["jumlah"]).toLocaleString()+" "+ AvData["satuan"]);
              $("td:eq(4)",AvRow).text(parseFloat(AvData["jumlah_kirim"]).toLocaleString()+" "+ AvData["satuan"]);
              $("td:eq(5)",AvRow).text(parseFloat(AvData["sisa"]).toLocaleString()+" "+ AvData["satuan"]);
              if(AvData["kd_gd_hasil"]==null){
                $("td:eq(7)",AvRow).text(AvData["warna"]);
              }else{
                $("td:eq(7)",AvRow).text(AvData["warna_plastik"]);
              }
              $("td:eq(2)",AvRow).html(AvData["nm_pemesan"]+" <label class='text-blue'>["+AvData["no_po"]+"]</label>")
            }
          });
        }

        function datatableDetailPesanan(param){
          $("#tableListDetailPesanan").dataTable().fnDestroy();
          $("#tableListDetailPesanan").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "sPaginationType": "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_pengiriman/main/getListDetailPesanan') ?>",
            "columns" : [
              {"data":"ukuran","name":"GH.ukuran"},
              {"data":"merek","name":"PD.merek"},
              {"data":"warna_plastik","name":"GH.warna_plastik"},
              {"data":"warna_cetak","name":"PD.warna_cetak"},
              {"data":"sm","name":"PD.sm"},
              {"data":"dll","name":"PD.dll"},
              {"data":"jumlah","name":"PD.jumlah"},
              {"data":"keterangan","name":"PD.keterangan"},
              {"data":"sts_pesanan","name":"PD.sts_pesanan"},
              {"data":"id_dp","name":"PD.id_dp"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              AvData.push({"name" : "noOrder", "value":param});
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "drawCallback" : function(){
              $('.minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvFullDisplayIndex){
              switch (AvData["sts_pesanan"]) {
                case "WAITING"  : $("td:eq(8)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "OPEN"     : $("td:eq(8)",AvRow).html("<label class='text-purple'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PROGRESS" : $("td:eq(8)",AvRow).html("<label class='text-yellow'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PACKING"  : $("td:eq(8)",AvRow).html("<label class='text-blue'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "FINISH"   : $("td:eq(8)",AvRow).html("<label class='text-green'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                default:

              }
              $("td:eq(9)", AvRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditDetailPesanan('"+AvData["id_dp"]+"','"+param+"')>Ubah</button>"+
                                        "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreDetailPesanan('"+AvData["id_dp"]+"','"+param+"','TRUE')>Hapus</button>");
              $("td:eq(6)",AvRow).text(parseFloat(AvData["jumlah"]).toLocaleString()+" "+ AvData["satuan"]);
              if(AvData["kd_gd_hasil"]==null){
                $("td:eq(2)",AvRow).text(AvData["warna"]);
              }else{
                $("td:eq(2)",AvRow).text(AvData["warna_plastik"]);
              }
            }
          });
        }

        function datatablePantauOrderCabang(){
          $("#tablePantauOrderCabang").dataTable().fnDestroy();
          $("#tablePantauOrderCabang").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "sPaginationType": "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_pengiriman/main/getListPantauOrderCabang') ?>",
            "columns" : [
              {"data":"id_dp","name":"PD.id_dp"},
              {"data":"tgl_pesan","name":"P.tgl_pesan"},
              {"data":"nm_pemesan","name":"P.nm_pemesan"},
              {"data":"jumlah","name":"PD.jumlah"},
              {"data":"jumlah_kirim","name":"PD.jumlah_kirim"},
              {"data":"sisa","name":"(PD.jumlah - PD.jumlah_kirim)"},
              {"data":"ukuran","name":"GH.ukuran"},
              {"data":"warna_plastik","name":"GH.warna_plastik"},
              {"data":"merek","name":"PD.merek"},
              {"data":"dll","name":"PD.dll"},
              {"data":"sts_pesanan","name":"P.no_order"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "drawCallback" : function(){
              $('.minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvFullDisplayIndex){
              $("td:eq(0)",AvRow).text(++AvDisplayIndex);
              switch (AvData["sts_pesanan"]) {
                case "WAITING"  : $("td:eq(10)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "OPEN"     : $("td:eq(10)",AvRow).html("<label class='text-purple'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PROGRESS" : $("td:eq(10)",AvRow).html("<label class='text-yellow'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PACKING"  : $("td:eq(10)",AvRow).html("<label class='text-blue'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "FINISH"   : $("td:eq(10)",AvRow).html("<label class='text-green'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                default:

              }

              $("td:eq(3)",AvRow).text(parseFloat(AvData["jumlah"]).toLocaleString()+" "+ AvData["satuan"]);
              $("td:eq(4)",AvRow).text(parseFloat(AvData["jumlah_kirim"]).toLocaleString()+" "+ AvData["satuan"]);
              $("td:eq(5)",AvRow).text(parseFloat(AvData["sisa"]).toLocaleString()+" "+ AvData["satuan"]);
              if(AvData["kd_gd_hasil"]==null){
                $("td:eq(7)",AvRow).text(AvData["warna"]);
              }else{
                $("td:eq(7)",AvRow).text(AvData["warna_plastik"]);
              }
              $("td:eq(2)",AvRow).html(AvData["nm_pemesan"]+" <label class='text-blue'>["+AvData["no_po"]+"]</label>"+" <label class='text-yellow'>["+AvData["no_order"]+"]</label>");
            }
          });
        }

        function datatablePantauOrderMarketing(){
          $("#tablePantauOrderMarketing").dataTable().fnDestroy();
          $("#tablePantauOrderMarketing").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "sPaginationType": "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_pengiriman/main/getListPantauOrderMarketing') ?>",
            "columns" : [
              {"data":"id_dp","name":"PD.id_dp"},
              {"data":"tgl_pesan","name":"P.tgl_pesan"},
              {"data":"nm_perusahaan","name":"C.nm_perusahaan"},
              {"data":"jumlah","name":"PD.jumlah"},
              {"data":"jumlah_kirim","name":"PD.jumlah_kirim"},
              {"data":"sisa","name":"(PD.jumlah - PD.jumlah_kirim)"},
              {"data":"ukuran","name":"GH.ukuran"},
              {"data":"warna_plastik","name":"GH.warna_plastik"},
              {"data":"merek","name":"PD.merek"},
              {"data":"dll","name":"PD.dll"},
              {"data":"sts_pesanan","name":"PD.no_order"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "drawCallback" : function(){
              $('.minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvFullDisplayIndex){
              $("td:eq(0)",AvRow).text(++AvDisplayIndex);
              switch (AvData["sts_pesanan"]) {
                case "WAITING"  : $("td:eq(10)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "OPEN"     : $("td:eq(10)",AvRow).html("<label class='text-purple'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PROGRESS" : $("td:eq(10)",AvRow).html("<label class='text-yellow'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PACKING"  : $("td:eq(10)",AvRow).html("<label class='text-blue'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "FINISH"   : $("td:eq(10)",AvRow).html("<label class='text-green'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                default:

              }

              $("td:eq(3)",AvRow).text(parseFloat(AvData["jumlah"]).toLocaleString()+" "+ AvData["satuan"]);
              $("td:eq(4)",AvRow).text(parseFloat(AvData["jumlah_kirim"]).toLocaleString()+" "+ AvData["satuan"]);
              $("td:eq(5)",AvRow).text(parseFloat(AvData["sisa"]).toLocaleString()+" "+ AvData["satuan"]);
              if(AvData["kd_gd_hasil"]==null){
                $("td:eq(7)",AvRow).text(AvData["warna"]);
              }else{
                $("td:eq(7)",AvRow).text(AvData["warna_plastik"]);
              }
              $("td:eq(2)",AvRow).html(AvData["nm_perusahaan"]+" <label class='text-blue'>["+AvData["no_po"]+"]</label>"+" <label class='text-yellow'>["+AvData["no_order"]+"]</label>")
            }
          });
        }

        function datatableListHistoryOrderCabangGlobal(param, param2){
          $("#tableListHistoryOrderCabang").dataTable().fnDestroy();
          $("#tableListHistoryOrderCabang").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "scrollX" : "100%",
            "scrollY" : "500px",
            "sPaginationType": "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_pengiriman/main/getListPantauOrderCabangGlobal') ?>",
            "columns" : [
              {"data":"no_order","name":"no_po"},
              {"data":"tgl_pesan","name":"tgl_pesan"},
              {"data":"nm_pemesan","name":"nm_pemesan"},
              {"data":"sts_pesanan","name":"sts_pesanan"},
              {"data":"no_order","name":"no_order"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              AvData.push({"name":"tglAwal","value":param},
                          {"name":"tglAwal","value":param2});
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "drawCallback" : function(){
              $('.minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvFullDisplayIndex){
              $("td:eq(0)", AvRow).text(++AvDisplayIndex);
              switch (AvData["sts_pesanan"]) {
                case "WAITING"  : $("td:eq(3)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "OPEN"     : $("td:eq(3)",AvRow).html("<label class='text-purple'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PROGRESS" : $("td:eq(3)",AvRow).html("<label class='text-yellow'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PACKING"  : $("td:eq(3)",AvRow).html("<label class='text-blue'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "FINISH"   : $("td:eq(3)",AvRow).html("<label class='text-green'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                default:

              }
              $("td:eq(3)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
              $("td:eq(1)",AvRow).html(AvData["tgl_pesan"]+" <label class='text-blue'>["+AvData["no_po"]+"]</label>"+"<label class='text-yellow'>["+AvData["no_order"]+"]</label>");
              $("td:eq(4)",AvRow).html("<button class='btn btn-md btn-flat btn-info' onclick=modalDetailPesananHistory('"+AvData["no_order"]+"')><i class='fa fa-list'></i> Detail Pesanan</button>");
            }
          });
        }

        function datatableListHistoryOrderLuarKota(param1, param2){
          $("#tableListHistoryOrderLuarKota").dataTable().fnDestroy();
          $("#tableListHistoryOrderLuarKota").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "scrollX" : "100%",
            "scrollY" : "500px",
            "sPaginationType": "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_pengiriman/main/getHistoryListOrderLuarKota') ?>",
            "columns" : [
              {"data":"no_order","name":"no_po"},
              {"data":"tgl_pesan","name":"tgl_pesan"},
              {"data":"nm_pemesan","name":"nm_pemesan"},
              {"data":"sts_pesanan","name":"sts_pesanan"},
              {"data":"no_order","name":"no_order", "sClass": "center"}
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
            "drawCallback" : function(){
              $('.minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvFullDisplayIndex){
              $("td:eq(0)", AvRow).text(++AvDisplayIndex);
              switch (AvData["sts_pesanan"]) {
                case "WAITING"  : $("td:eq(3)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "OPEN"     : $("td:eq(3)",AvRow).html("<label class='text-purple'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PROGRESS" : $("td:eq(3)",AvRow).html("<label class='text-yellow'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PACKING"  : $("td:eq(3)",AvRow).html("<label class='text-blue'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "FINISH"   : $("td:eq(3)",AvRow).html("<label class='text-green'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                default:

              }
              $("td:eq(3)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
              $("td:eq(1)",AvRow).html(AvData["tgl_pesan"]+" <label class='text-blue'>["+AvData["no_po"]+"]</label>");
              $("td:eq(4)",AvRow).html("<div style='text-align:center; margin:0px;'><button class='btn btn-md btn-flat btn-info' onclick=modalDetailPesananHistory('"+AvData["no_order"]+"')><i class='fa fa-list'></i> Detail Pesanan</button></div>");
            }
          });
        }

        function datatableDetailPesananHistory(param){
          $("#tableListDetailPesanan").dataTable().fnDestroy();
          $("#tableListDetailPesanan").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "sPaginationType": "full_numbers",
            "sAjaxSource" : "<?php echo base_url('_pengiriman/main/getListDetailPesanan') ?>",
            "columns" : [
              {"data":"ukuran","name":"GH.ukuran"},
              {"data":"merek","name":"PD.merek"},
              {"data":"warna_plastik","name":"GH.warna_plastik"},
              {"data":"warna_cetak","name":"PD.warna_cetak"},
              {"data":"sm","name":"PD.sm"},
              {"data":"dll","name":"PD.dll"},
              {"data":"jumlah","name":"PD.jumlah"},
              {"data":"keterangan","name":"PD.keterangan"},
              {"data":"sts_pesanan","name":"PD.sts_pesanan"}
            ],
            "fnServerData" : function(AvUrl, AvData, AvResponse){
              AvData.push({"name" : "noOrder", "value":param});
              $.ajax({
                type : "POST",
                url : AvUrl,
                dataType : "JSON",
                data : AvData,
                success : AvResponse
              });
            },
            "drawCallback" : function(){
              $('.minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
              });
            },
            "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvFullDisplayIndex){
              switch (AvData["sts_pesanan"]) {
                case "WAITING"  : $("td:eq(8)",AvRow).html("<label class='text-red'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "OPEN"     : $("td:eq(8)",AvRow).html("<label class='text-purple'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PROGRESS" : $("td:eq(8)",AvRow).html("<label class='text-yellow'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "PACKING"  : $("td:eq(8)",AvRow).html("<label class='text-blue'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                case "FINISH"   : $("td:eq(8)",AvRow).html("<label class='text-green'>"+AvData["sts_pesanan"]+"</label>");
                                  break;
                default:
              }
              $("td:eq(6)",AvRow).text(parseFloat(AvData["jumlah"]).toLocaleString()+" "+ AvData["satuan"]);
              if(AvData["kd_gd_hasil"]==null){
                $("td:eq(2)",AvRow).text(AvData["warna"]);
              }else{
                $("td:eq(2)",AvRow).text(AvData["warna_plastik"]);
              }
            }
          });
        }

        $("#jns_barang").on("change", function() {
          var jenis = $("#jns_barang").val();
          if (!jenis) {
            $("#fieldBarang").hide();
            $("#nm_barang").prop('disabled', true);
            $("#customer").prop('disabled', true);
            $("#berat").prop('disabled', true);
            $("#lembar").prop('disabled', true);
            $("#tgl_retur").prop('disabled', true);
            $("#btn_addBarangRetur").prop('disabled', true);
          }else{
            $("#fieldBarang").show();
            $("#nm_barang").prop('disabled', false);
            $("#customer").prop('disabled', false);
            $("#berat").prop('disabled', false);
            $("#lembar").prop('disabled', false);
            $("#tgl_retur").prop('disabled', false);
            $("#btn_addBarangRetur").prop('disabled', false);
            $("#nm_barang").select2({
              placeholder : "Pilih Produk",
              width : "100%",
              cache:true,
              allowClear:true,
              ajax:{
                url : "<?php echo base_url(); ?>_pengiriman/main/getBarang/"+jenis,
                dataType : "JSON",
                delay : 0,
                processResults : function(data){
                  return{
                    results : $.map(data, function(item){
                      return{
                        text:item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_permintaan+" | "+item.sts_brg,
                        id:item.kd_gd_hasil+","+item.ukuran+","+item.merek+","+item.warna_plastik+","+item.jns_permintaan
                      }
                    })
                  };
                }
              }
            });
          }
        });

        function addBarangRetur(){
          var jenis  = $("#jns_barang").val();
          var produk = $("#nm_barang").val();
          var customer = $("#customer").val();
          var berat  = $("#berat").val();
          var lembar = $("#lembar").val();
          var tgl    = $("#tgl_retur").val();
          if (!jenis||!produk||!customer||!berat||!lembar||!tgl) {
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
            url  : "<?php echo site_url("_pengiriman/main/addBarangRetur"); ?>",
            data : {jenis:jenis,produk:produk,customer:customer,berat:berat,lembar:lembar,tgl:tgl},
            success:function(response){
              if (jQuery.trim(response)=="Success"){
                datatableBarangRetur();
                $("input").val(" ");
                $("select").val("");
                $("#fieldBarang").hide();
                $("#nm_barang").prop('disabled', true);
                $("#customer").prop('disabled', true);
                $("#berat").prop('disabled', true);
                $("#lembar").prop('disabled', true);
                $("#tgl_retur").prop('disabled', true);
                $("#btn_addBarangRetur").prop('disabled', true);
                $("#nm_barang").select2("val", " ");
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

        function datatableBarangRetur(){
          $("#tableDataBarangRetur").dataTable().fnDestroy();
          $("#tableDataBarangRetur").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering"  : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI" : true,
            "sPaginationType" : "full_numbers",
            "sAjaxSource" : "<?php echo base_url(); ?>_pengiriman/main/getDataBarangReturPengiriman",
            "aoColumnDefs": [{ "sWidth": "10%", "aTargets": [ -1 ] } ],
            "columns" : [
              {"data" : "kd_gd_hasil", "name" : "kd_gd_hasil"},
              {"data" : "tgl_transaksi", "name" : "tgl_transaksi"},
              {"data" : "customer", "name" : "customer]"},
              {"data" : "ukuran", "name" : "ukuran"},
              {"data" : "merek", "name" : "merek"},
              {"data" : "warna", "name" : "warna"},
              {"data" : "sts_barang", "name" : "sts_barang"},
              {"data" : "jumlah_berat", "name" : "jumlah_berat"},
              {"data" : "jumlah_lembar", "name" : "jumlah_lembar"},
              {"data" : "id_permintaan_jadi", "name" : "id_permintaan_jadi"},
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
              $("td:eq(9)",nRow).html("<button class='btn btn-primary btn-flat' title='Edit' onclick=editListRetur("+aData["id_permintaan_jadi"]+")><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-flat' onclick=deleteListRetur("+aData["id_permintaan_jadi"]+") title='Hapus'><i class='fa fa-trash'></i></button>");
              $("td:eq(7)",nRow).text(parseFloat(aData["jumlah_berat"]).toLocaleString());
              $("td:eq(8)",nRow).text(parseFloat(aData["jumlah_lembar"]).toLocaleString());
            }
          });
        }

        function kirimBarangReturPengiriaman()
        {
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_pengiriman/main/kirimBarangReturPengiriaman'); ?>",
            success:function(response){
              if (jQuery.trim(response)=="Success"){
                datatableBarangRetur();
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
              }else if(jQuery.trim(response)=="Empty"){
                $("#modal-notif").modal("show")
                $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak ada data barang retur di list !</b></div>");
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

        function deleteListRetur(id)
        {
          var r = confirm("Hapus daftar barang retur ?")
          if (r == true) {
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('_pengiriman/main/deleteListRetur');?>",
              data : {id:id},
              success:function(response){
                if (jQuery.trim(response)=="Success"){
                  datatableBarangRetur();
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
              $("#berat_edit").val(response[0].jumlah_berat);
              $("#lembar_edit").val(response[0].jumlah_lembar);
              $("#tgl_retur_edit").val(response[0].tgl_transaksi);
              $("#modalEditRetur").modal({backdrop:"static"});
            }
          });
        }

        function updateListRetur()
        {
          var id    = $("#id_permintaan_jadi").val();
          var tgl   = $("#tgl_retur_edit").val();
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
                $("#modalEditRetur").modal("hide");
                datatableBarangRetur();
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
//================================ DATATABLE METHOD (FINISH) ============================//
      </script>
<!--===============================================General Function (Finish) ===============================================-->
    </body>
</html>
