        <footer class="main-footer">
          <div class="pull-right hidden-xs">
              <b>Beta Version</b> V 0.0.1
          </div>
          <strong>Copyright &copy; 2017 <a href="http://www.avandhykurniawan.tk">Developed By Avandhy Kurniawan</a>
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

<!--===============================================On Load Method (Start) ===============================================-->
      <script type="text/javascript">
        $(function () {
          //======= Run Method Automatically (Start) =======//

          //======= Run Method Automatically (Finish) =======//
          //======= Inisialisasi Komponen (Start) =======
          $('.date').datepicker({
              language: 'id',
              viewMode: 'years',
              format: 'yyyy-mm-dd',
              autoclose : true,
              todayHighlight : true
          });
          //======= Inisialisasi Komponen (End) =======
        });//Tutup $(function(){}); yang pertama
      </script>
<!--===============================================On Load Method (Finish) ===============================================-->

<!--===============================================On Load External Modal Method (Start) ===============================================-->
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
<!--===============================================On Load External Modal Method (Finish) ===============================================-->

<!--===============================================General Method (Start) ===============================================-->
      <script>
//================================ MODAL METHOD (START) ============================//
        function modalDetailJob(param){
          tablePemakaianBahanCetak(param);
          $("#modalDetailJob").modal({backdrop:"static"});
        }
//================================ MODAL METHOD (FINISH) ============================//

//================================ SEARCH METHOD (START) ============================//
        function searchHistoryExtruderKeRollPolos(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListHasilExtruder(tglAwal1, tglAkhir1);
            $("#btnPrintLaporanHasilExtruder").attr("href","<?php echo base_url('_accounting/main/exportHasilExtruderKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchHistoryRollPolosKePotong(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListRollPolosKePotong(tglAwal1, tglAkhir1);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListRollPolos_ExtruderKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchHistoryPotongKeRollPolos(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListPotongKeRollPolos(tglAwal1, tglAkhir1);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListPotong_RollPolosKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchHistoryRollPolosKeCetak(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListRollPolosKeCetak(tglAwal1, tglAkhir1);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListRollPolos_CetakKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchHistoryRollPolosKeRollCetak(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListRollPolosKeRollCetak(tglAwal1, tglAkhir1);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListRollPolos_RollCetakKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchHistoryRollCetakKePotong(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListRollCetakKePotong(tglAwal1, tglAkhir1);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListRollCetak_PotongKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchHistoryPotongKeRollCetak(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListPotongKeRollCetak(tglAwal1, tglAkhir1);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListPotong_RollCetakKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchHistoryBarangHasil(param){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListHistoryBarangHasil(tglAwal1, tglAkhir1, param);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListHistoryBarangHasilToExcel') ?>/"+tglAwal1+"/"+tglAkhir1+"/"+param);
            resetSearchForm();
          }
        }

        function searchHistoryPengeluaranBarangStandard(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListHistoryPengeluaranBarangStandard(tglAwal1, tglAkhir1);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListHistoryPengeluaranBarangStandard') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchHistoryJobPotong(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListHistoryJobPotong(tglAwal1, tglAkhir1);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListHistoryJobPotong') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchHistoryJobCetak(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListHistoryJobCetak(tglAwal1, tglAkhir1);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListHistoryJobCetak') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchHistoryJobSablon(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListHistoryJobSablon(tglAwal1, tglAkhir1);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListHistoryJobSablon') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchHistoryGudangBahan(param){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          var jenis = param.toUpperCase().replace(/_/g," ");
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListHistoryGudangBahan(tglAwal1, tglAkhir1, jenis);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListHistoryGudangBahan') ?>/"+tglAwal1+"/"+tglAkhir1+"/"+param.toUpperCase());
            resetSearchForm();
          }
        }

        function searchHistoryGudangSparePart(){
          var tglAwal1 = $("#txtTglAwal").val();
          var tglAkhir1 = $("#txtTglAkhir").val();
          if(tglAwal1=="" || tglAkhir1==""){
            $("#modal-notif").addClass("modal-warning");
            $("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
            $("#modal-notif").modal("show");
            setTimeout(function(){
              $("#modal-notif").modal("hide");
              $("#modal-notif").removeClass("modal-warning");
              $("#modalNotifContent").text("");
            },2000);
          }else{
            tableListHistoryGudangSparePart(tglAwal1, tglAkhir1);
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListHistoryGudangSparePart') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }
//================================ SEARCH METHOD (FINISH) ============================//

//================================ RELOAD METHOD (START) ============================//

//================================ RELOAD METHOD (FINISH) ============================//

//================================ RESET FORM METHOD (START) ============================//
        function resetSearchForm(){
          $("input").val("");
          $(".date").datepicker("setDate",null);
          $("#modalCariHistory").modal("hide");
        }
//================================ RESET FORM METHOD (FINISH) ============================//

//================================ SAVE METHOD (START) ============================//

//================================ SAVE METHOD (FINISH) ============================//

//================================ EDIT METHOD (START) ============================//

//================================ EDIT METHOD (FINISH) ============================//

//================================ REMOVE METHOD (START) ============================//

//================================ REMOVE METHOD (FINISH) ============================//

//================================ UNSPECIFIED METHOD (START) ============================//

//================================ UNSPECIFIED METHOD (FINISH) ============================//

//================================ DATATABLE METHOD (START) ============================//
        function tableListHasilExtruder(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getHasilExtruder'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2
            },
            success : function(response){
              $("#tableHasilExtruder > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                var totalRoll = AvValue.totalRoll;
                $("#tableHasilExtruder > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.kd_gd_roll+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.panjang+"</td>"+
                    "<td>"+AvValue.warnaPlastik.replace(/,/g,"<br>")+"</td>"+
                    "<td>"+AvValue.tgl_jadi+"</td>"+
                    "<td>"+AvValue.jumlahSelesai.replace(/,/g,"<br>")+"<br><b style='border-top:1px solid #000;'>"+AvValue.total+"</b></td>"+
                    "<td>"+AvValue.rollPipa.replace(/,/g,"<br>")+"<br><b style='border-top:1px solid #000;'>"+parseFloat(totalRoll).toFixed(2)+"</b></td>"+
                    "<td>"+AvValue.jenisRoll.replace(/,/g,"<br>").replace(/_/g," ")+"</td>"+
                    "<td>"+AvValue.shift.replace(/,/g,"<br>")+"</td>"+
                  "</tr>"
                );
              })
            },
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

        function tableListRollPolosKePotong(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListRollPolosKePotong'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
            },
            success : function(response){
              $("#tableRollPolosKePotong > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableRollPolosKePotong > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.tgl_rencana+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.jns_permintaan+"</td>"+
                    "<td>"+AvValue.totalBeratPengambilan+"</td>"+
                    "<td>"+AvValue.totalBobinPengambilan+"</td>"+
                    "<td>"+AvValue.totalPayungPengambilan+"</td>"+
                    "<td>"+AvValue.totalPayungKuningPengambilan+"</td>"+
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

        function tableListPotongKeRollPolos(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListPotongKeRollPolos'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
            },
            success : function(response){
              $("#tablePotongKeRollPolos > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tablePotongKeRollPolos > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.tgl_rencana+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+parseFloat(AvValue.totalBeratSisa).toFixed(2)+"</td>"+
                    "<td>"+AvValue.totalBobinSisa+"</td>"+
                    "<td>"+AvValue.totalPayungSisa+"</td>"+
                    "<td>"+AvValue.totalPayungKuningSisa+"</td>"+
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

        function tableListRollPolosKeCetak(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListRollPolosKeCetak'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
            },
            success : function(response){
              $("#tableRollPolosKeCetak > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableRollPolosKeCetak > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.tgl_transaksi+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.jns_permintaan+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+parseFloat(AvValue.totalBeratPengambilan).toFixed(2)+"</td>"+
                    "<td>"+AvValue.totalBobinPengambilan+"</td>"+
                    "<td>"+AvValue.totalPayungPengambilan+"</td>"+
                    "<td>"+AvValue.totalPayungKuningPengambilan+"</td>"+
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

        function tableListRollPolosKeRollCetak(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListRollPolosKeRollCetak'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
            },
            success : function(response){
              $("#tableHasilCetak > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableHasilCetak > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.kd_gd_roll+"</td>"+
                    "<td>"+AvValue.tgl_transaksi+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_selesai).toFixed(2)+"</td>"+
                    "<td>"+AvValue.bobin+"</td>"+
                    "<td>"+AvValue.payung+"</td>"+
                    "<td>"+AvValue.payung_kuning+"</td>"+
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

        function tableListRollCetakKePotong(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListRollCetakKePotong'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
            },
            success : function(response){
              $("#tableRollCetakKePotong > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableRollCetakKePotong > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.tgl_rencana+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+AvValue.jns_permintaan+"</td>"+
                    "<td>"+AvValue.totalBeratPengambilan+"</td>"+
                    "<td>"+AvValue.totalBobinPengambilan+"</td>"+
                    "<td>"+AvValue.totalPayungPengambilan+"</td>"+
                    "<td>"+AvValue.totalPayungKuningPengambilan+"</td>"+
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

        function tableListPotongKeRollCetak(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListPotongKeRollCetak'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
            },
            success : function(response){
              $("#tablePotongKeRollCetak > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tablePotongKeRollCetak > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.tgl_rencana+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+parseFloat(AvValue.totalBeratSisa).toFixed(2)+"</td>"+
                    "<td>"+AvValue.totalBobinSisa+"</td>"+
                    "<td>"+AvValue.totalPayungSisa+"</td>"+
                    "<td>"+AvValue.totalPayungKuningSisa+"</td>"+
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

        function tableListHistoryBarangHasil(param1, param2, param3){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListHistoryBarangHasil'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
              stsBarang : param3
            },
            success : function(response){
              $("#tableBarang"+param3+" > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableBarang"+param3+" > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.kd_gd_hasil+"</td>"+
                    "<td>"+AvValue.customer+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna+"</td>"+
                    "<td>"+AvValue.arrTglTransaksi.replace(/,/g,'<br>')+"</td>"+
                    "<td>"+AvValue.arrJumlahBerat.replace(/,/g,'<br>')+"<br><b style='border-top:1px solid #000;'>"+parseFloat(AvValue.totalJumlahBerat).toFixed(2)+"</b></td>"+
                    "<td>"+AvValue.arrJumlahLembar.replace(/,/g,'<br>')+"<br><b style='border-top:1px solid #000;'>"+parseFloat(AvValue.totalJumlahLembar).toFixed(0)+"</b></td>"+
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

        function tableListHistoryPengeluaranBarangStandard(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListHistoryPengeluaranBarangStandard'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2
            },
            success : function(response){
              $("#tableBarangStandardKeluar > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableBarangStandardKeluar > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.kd_gd_hasil+"</td>"+
                    "<td>"+AvValue.customer+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna+"</td>"+
                    "<td>"+AvValue.arrTglTransaksi.replace(/,/g,'<br>')+"</td>"+
                    "<td>"+AvValue.arrJumlahBerat.replace(/,/g,'<br>')+"<br><b style='border-top:1px solid #000;'>"+parseFloat(AvValue.totalJumlahBerat).toFixed(2)+"</b></td>"+
                    "<td>"+AvValue.arrJumlahLembar.replace(/,/g,'<br>')+"<br><b style='border-top:1px solid #000;'>"+parseFloat(AvValue.totalJumlahLembar).toFixed(0)+"</b></td>"+
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

        function tableListHistoryJobPotong(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListHistoryJobPotong'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2
            },
            success : function(response){
              $("#tableListJobPotong > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableListJobPotong > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.arrTglJadi.replace(/,/g, '<br>')+"</td>"+
                    "<td>"+AvValue.arrCustomer.replace(/,/g, '<br>')+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.arrJumlahLembar.replace(/,/g, '<br>')+"</td>"+
                    "<td>"+parseFloat(AvValue.hasil_berat_kotor).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.hasil_berat_bersih).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.beratPengambilan).toLocaleString()+"</td>"+
                    "<td>"+AvValue.bobinPengambilan+"</td>"+
                    "<td>"+AvValue.payungPengambilan+"</td>"+
                    "<td>"+AvValue.payungKuningPengambilan+"</td>"+
                    "<td>"+parseFloat(AvValue.berat_sisa_hari_ini).toLocaleString()+"</td>"+
                    "<td>"+AvValue.bobin_sisa_hari_ini+"</td>"+
                    "<td>"+AvValue.payung_sisa_hari_ini+"</td>"+
                    "<td>"+AvValue.payung_kuning_sisa_hari_ini+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_apal_global).toFixed(2)+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_roll_pipa).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.plusminus).toLocaleString()+"</td>"+
                  "</tr>"
                );
              })
            },
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

        function tableListHistoryJobCetak(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListHistoryJobCetak'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2
            },
            success : function(response){
              $("#tableListJobCetak > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableListJobCetak > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+ ++AvIndex +"</td>"+
                    "<td>"+AvValue.customer+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+parseFloat(AvValue.beratPengambilan).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.bobinPengambilan).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.payungPengambilan).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.payungKuningPengambilan).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_sisa_pengambilan).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_hasil_selesai).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_hasil_bobin).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_hasil_payung).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_hasil_payung_kuning).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_bobin_terbuang).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_payung_terbuang).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_payung_kuning_terbuang).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_apal).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.plusminus).toLocaleString()+"</td>"+
                    "<td><button class='btn btn-md btn-flat btn-primary' onclick=modalDetailJob('"+AvValue.kd_hasil_cetak+"')>Detail Job</button></td>"+
                  "</tr>"
                );
              })
            },
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
            url : "<?php echo base_url('_accounting/main/getListPemakaianBahanCetakId'); ?>",
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

        function tableListHistoryJobSablon(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListHistoryJobSablon'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2
            },
            success : function(response){
              $("#tableListJobSablon > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableListJobSablon > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.tanggal+"</td>"+
                    "<td>"+AvValue.customer+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+AvValue.warna_sablon+"</td>"+
                    "<td>"+parseFloat(AvValue.hasil_lembar).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.hasil_berat).toLocaleString()+"</td>"+
                  "</tr>"
                );
              })
            },
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

        function tableListHistoryGudangBahan(param1, param2, param3){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListHistoryGudangBahan'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
              jenis : param3
            },
            success : function(response){
              $("#tableHistoryGudangBahan > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableHistoryGudangBahan > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.nm_barang+"( "+AvValue.warna+" )</td>"+
                    "<td>"+parseFloat(AvValue.saldo_awal).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.total_masuk_per_periode).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.total_keluar_per_periode).toLocaleString()+"</td>"+
                    "<td>"+parseFloat((parseFloat(AvValue.saldo_awal) + parseFloat(AvValue.total_masuk_per_periode)) - parseFloat(AvValue.total_keluar_per_periode)).toLocaleString()+"</td>"+
                  "</tr>"
                );
              });
            }
          })
        }

        function tableListHistoryGudangSparePart(param1, param2){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListHistoryGudangSparePart'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2
            },
            success : function(response){
              $("#tableHistoryGudangSparePart > tbody").empty();
              $.each(response, function(AvIndex, AvValue){
                $("#tableHistoryGudangSparePart > tbody:last-child").append(
                  "<tr>"+
                    "<td>"+AvValue.nm_spare_part+"</td>"+
                    "<td>"+parseFloat(AvValue.saldo_awal).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.total_masuk_per_periode).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.total_keluar_per_periode).toLocaleString()+"</td>"+
                    "<td>"+parseFloat((parseFloat(AvValue.saldo_awal) + parseFloat(AvValue.total_masuk_per_periode)) - parseFloat(AvValue.total_keluar_per_periode)).toLocaleString()+"</td>"+
                  "</tr>"
                );
              });
            }
          })
        }
//================================ DATATABLE METHOD (FINISH) ============================//
      </script>
<!--===============================================General Function (Finish) ===============================================-->
    </body>
</html>
