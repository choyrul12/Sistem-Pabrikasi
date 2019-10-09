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

<!--===============================================On Load Method (Start) ===============================================-->
      <script type="text/javascript">
        $(function () {
          //======= Run Method Automatically (Start) =======//
          // var newURL = window.location.protocol + "://" + window.location.host + "/" + window.location.pathname;
          var pathArray = window.location.pathname.split( '/' );
          if (pathArray[4]=="kuantitas_gudang_hasil"){
            datatableListKuantitasGudangHasil(pathArray[5])
            $("#title_kuantitas").text(pathArray[5])
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportKuantitasGudangHasil') ?>/"+pathArray[5]+"");
          }else if(pathArray[4]=="kuantitas_gudang_roll"){
            datatableListKuantitasGudangRoll(pathArray[5])
            $("#title_kuantitas").text(pathArray[5])
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportKuantitasGudangRoll') ?>/"+pathArray[5]+"");
          }else if(pathArray[4]=="kuantitas_gudang_bahan"){
            var jenis = pathArray[5].replace("_"," ")
            datatableListKuantitasGudangBahan(jenis)
            $("#title_kuantitas").text(jenis)
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportKuantitasGudangBahan') ?>/"+pathArray[5]+"");
          }else if (pathArray[4]=="kuantitas_spare_part"){
             var jenis = pathArray[5].replace("_"," ")
             datatableListKuantitasSparePart()
            $("#title_kuantitas").text(jenis)
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportKuantitasSparePart') ?>/");
          }else if (pathArray[4]=="kuantitas_apal") {
            datatableListKuantitasApal()
            $("#title_kuantitas").text(pathArray[5])
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportKuantitasApal') ?>/");
          }

          datatableOrder();
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
            $("#txtSearch").attr("onchange","searchTanggalHistoryExtruderKeRollPolos('"+tglAwal1+"','"+tglAkhir1+"',this)");
            $("#btnPrintLaporanHasilExtruder").attr("href","<?php echo base_url('_accounting/main/exportHasilExtruderKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchTanggalHistoryExtruderKeRollPolos(param,param2,param3){
          tableListHasilExtruder(param, param2, param3.value);
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
            $("#txtSearch").attr("onchange","searchTanggalHistoryRollPolosKePotong('"+tglAwal1+"','"+tglAkhir1+"',this)");
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListRollPolos_ExtruderKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchTanggalHistoryRollPolosKePotong(param,param2,param3){
          tableListRollPolosKePotong(param, param2, param3.value);
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
            $("#txtSearch").attr("onchange","searchTanggalHistoryPotongKeRollPolos('"+tglAwal1+"','"+tglAkhir1+"',this)");
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListPotong_RollPolosKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchTanggalHistoryPotongKeRollPolos(param,param2,param3){
          tableListPotongKeRollPolos(param, param2, param3.value);
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
            $("#txtSearch").attr("onchange","searchTanggalHistoryRollPolosKeCetak('"+tglAwal1+"','"+tglAkhir1+"',this)");
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListRollPolos_CetakKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchTanggalHistoryRollPolosKeCetak(param,param2,param3){
          tableListRollPolosKeCetak(param, param2, param3.value);
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
            $("#txtSearch").attr("onchange","searchTanggalHistoryRollPolosKeRollCetak('"+tglAwal1+"','"+tglAkhir1+"',this)");
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListRollPolos_RollCetakKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchTanggalHistoryRollPolosKeRollCetak(param,param2,param3){
          tableListRollPolosKeRollCetak(param, param2, param3.value);
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
            $("#txtSearch").attr("onchange","searchTanggalHistoryRollCetakKePotong('"+tglAwal1+"','"+tglAkhir1+"',this)");
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListRollCetak_PotongKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchTanggalHistoryRollCetakKePotong(param,param2,param3){
          tableListRollCetakKePotong(param, param2, param3.value);
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
            $("#txtSearch").attr("onchange","searchTanggalHistoryPotongKeRollCetak('"+tglAwal1+"','"+tglAkhir1+"',this)");
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListPotong_RollCetakKeExcel') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchTanggalHistoryPotongKeRollCetak(param,param2,param3){
          tableListPotongKeRollCetak(param, param2, param3.value);
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
            $("#txtSearch").attr("onchange","searchTanggalHistoryBarangHasil('"+tglAwal1+"','"+tglAkhir1+"','"+param+"',this)");
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListHistoryBarangHasilToExcel') ?>/"+tglAwal1+"/"+tglAkhir1+"/"+param);
            resetSearchForm();
          }
        }

        function searchTanggalHistoryBarangHasil(param,param2,param3,param4){
          tableListHistoryBarangHasil(param, param2, param3, param4.value);
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
            $("#txtSearch").attr("onchange","searchTanggalPengeluaranBarangStandard('"+tglAwal1+"','"+tglAkhir1+"',this)");
            $("#btnPrintLaporan").attr("href","<?php echo base_url('_accounting/main/exportListHistoryPengeluaranBarangStandard') ?>/"+tglAwal1+"/"+tglAkhir1);
            resetSearchForm();
          }
        }

        function searchTanggalPengeluaranBarangStandard(param,param2,param3){
          tableListHistoryPengeluaranBarangStandard(param, param2, param3.value);
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
            $("#tglAwal").val(tglAwal1)
            $("#tglAkhir").val(tglAkhir1)
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
            $('#tglAwal').val(tglAwal1)
            $('#tglAkhir').val(tglAkhir1)
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
          $("#txtTglAwal").val("");
          $("#txtTglAkhir").val("");
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
        function tableListHasilExtruder(param1, param2, param3=""){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getHasilExtruder'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
              key : param3
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
                    "<td>"+AvValue.tgl_rencana+"</td>"+
                    "<td>"+AvValue.jumlahSelesai.replace(/,/g,"<br>")+"<br><b style='border-top:1px solid #000;'>"+AvValue.total+"</b></td>"+
                    "<td>"+AvValue.rollPipa.replace(/,/g,"<br>")+"<br><b style='border-top:1px solid #000;'>"+parseFloat(totalRoll).toFixed(2)+"</b></td>"+
                    "<td>"+AvValue.jenisRoll.replace(/,/g,"<br>").replace(/_/g," ")+"</td>"+
                    "<td>"+AvValue.shift.replace(/,/g,"<br>")+"</td>"+
                    "<td width='200px'>"+AvValue.diperbarui.replace(/,/g,"<br>")+"</td>"+
                    "<td>"+AvValue.username.replace(/,/g,"<br>")+"</td>"+
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

        function tableListRollPolosKePotong(param1, param2, param3=""){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListRollPolosKePotong'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
              key : param3
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
                    "<td>"+AvValue.diperbarui+"</td>"+
                    "<td>"+AvValue.username+"</td>"+
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

        function tableListPotongKeRollPolos(param1, param2, param3=""){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListPotongKeRollPolos'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
              key : param3
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
                    "<td>"+AvValue.diperbarui+"</td>"+
                    "<td>"+AvValue.username+"</td>"+
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

        function tableListRollPolosKeCetak(param1, param2, param3=""){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListRollPolosKeCetak'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
              key : param3
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
                    "<td>"+AvValue.diperbarui+"</td>"+
                    "<td>"+AvValue.username+"</td>"+
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

        function tableListRollPolosKeRollCetak(param1, param2, param3=""){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListRollPolosKeRollCetak'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
              key : param3
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
                    "<td>"+AvValue.diperbarui+"</td>"+
                    "<td>"+AvValue.username+"</td>"+
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

        function tableListRollCetakKePotong(param1, param2, param3=""){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListRollCetakKePotong'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
              key : param3
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
                    "<td>"+AvValue.diperbarui+"</td>"+
                    "<td>"+AvValue.username+"</td>"+
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

        function tableListPotongKeRollCetak(param1, param2, param3=""){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListPotongKeRollCetak'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
              key : param3,
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
                    "<td>"+AvValue.diperbarui+"</td>"+
                    "<td>"+AvValue.username+"</td>"+
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

        function tableListHistoryBarangHasil(param1, param2, param3, param4=""){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListHistoryBarangHasil'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
              stsBarang : param3,
              key : param4
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
                    "<td>"+AvValue.arrTglTransaksi.replace(/#/g,'<br>')+"</td>"+
                    "<td>"+AvValue.arrJumlahBerat.replace(/#/g,'<br>')+"<br><b style='border-top:1px solid #000;'>"+parseFloat(AvValue.totalJumlahBerat).toLocaleString()+"</b></td>"+
                    "<td>"+AvValue.arrJumlahLembar.replace(/#/g,'<br>')+"<br><b style='border-top:1px solid #000;'>"+parseFloat(AvValue.totalJumlahLembar).toLocaleString()+"</b></td>"+
                    "<td>"+AvValue.diperbarui.replace(/#/g,'<br>')+"<br><td>"+
                    "<td>"+AvValue.username.replace(/#/g,'<br>')+"<br><td>"+
                  "</tr>"
                );
              });
              $("#tableBarang"+param3+" td").css("font-size","13px");
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
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

        function tableListHistoryPengeluaranBarangStandard(param1, param2, param3=""){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListHistoryPengeluaranBarangStandard'); ?>",
            dataType : "JSON",
            data : {
              tglAwal : param1,
              tglAkhir : param2,
              key : param3
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
                    "<td>"+AvValue.arrTglTransaksi.replace(/#/g,'<br>')+"</td>"+
                    "<td>"+AvValue.arrJumlahBerat.replace(/#/g,'<br>')+"<br><b style='border-top:1px solid #000;'>"+parseFloat(AvValue.totalJumlahBerat).toLocaleString()+"</b></td>"+
                    "<td>"+AvValue.arrJumlahLembar.replace(/#/g,'<br>')+"<br><b style='border-top:1px solid #000;'>"+parseFloat(AvValue.totalJumlahLembar).toLocaleString()+"</b></td>"+
                    "<td>"+AvValue.diperbarui.replace(/#/g,'<br>')+"</td>"+
                    "<td>"+AvValue.username.replace(/#/g,'<br>')+"</td>"+
                  "</tr>"
                );
              });
              $("#tableBarangStandardKeluar").css("font-size","13px");
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
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
                    "<td>"+AvValue.tgl_rencana+"</td>"+
                    "<td>"+AvValue.customer+"</td>"+
                    "<td>"+AvValue.ukuran+"</td>"+
                    "<td>"+AvValue.warna_plastik+"</td>"+
                    "<td>"+AvValue.merek+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_lembar).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.hasil_berat_kotor).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.hasil_berat_bersih).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.beratPengambilan).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.bobinPengambilan).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.payungPengambilan).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.payungKuningPengambilan).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.berat_sisa_hari_ini).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.bobin_sisa_hari_ini).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.payung_sisa_hari_ini).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.payung_kuning_sisa_hari_ini).toLocaleString()+"</td>"+
                    "<td>"+parseFloat(AvValue.jumlah_apal_global).toLocaleString()+"</td>"+
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
                    "<td>"+ AvValue.tgl_transaksi +"</td>"+
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
                    "<td><a href='#' onclick=keluarMasukBahan('"+AvValue.kd_gd_bahan+"','"+encodeURIComponent(AvValue.nm_barang)+"')>"+AvValue.nm_barang+"( "+AvValue.warna+" )</a></td>"+
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

        function datatableListKuantitasGudangHasil(param){
        $("#tableDataKuantitasGudangHasil").dataTable().fnDestroy();
        $("#tableDataKuantitasGudangHasil").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_accounting/main/getListDataKuantitasGudangHasil",
          "columns":[
            {"data" : "kd_gd_hasil","name":"kd_gd_hasil"},
            {"data" : "kd_accurate","name":"kd_accurate"},
            {"data" : "ukuran","name":"ukuran"},
            {"data" : "merek","name":"merek"},
            {"data" : "warna_plastik","name":"warna_plastik"},
            {"data" : "sts_brg","name":"sts_brg"},
            {"data" : "stok_lembar","name":"stok_lembar"},
            {"data" : "stok_berat","name":"stok_berat"},
            {"data" : "diperbarui","name":"diperbarui"},
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"jns_brg","value":param});
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

      function datatableListKuantitasGudangRoll(param){
        $("#tableDataKuantitasGudangRoll").dataTable().fnDestroy();
        $("#tableDataKuantitasGudangRoll").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_accounting/main/getListDataKuantitasGudangRoll",
          "columns":[
            {"data" : "kd_gd_roll","name":"kd_gd_roll"},
            {"data" : "kd_accurate","name":"kd_accurate"},
            {"data" : "ukuran","name":"ukuran"},
            {"data" : "merek","name":"merek"},
            {"data" : "warna_plastik","name":"warna_plastik"},
            {"data" : "jns_brg","name":"jns_brg"},
            {"data" : "stok","name":"stok"},
            {"data" : "bobin","name":"bobin"},
            {"data" : "payung","name":"payung"},
            {"data" : "payung_kuning","name":"payung_kuning"},
            {"data" : "diperbarui","name":"diperbarui"},
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"jns_brg","value":param});
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

      function datatableListKuantitasGudangBahan(param){
        $("#tableDataKuantitasGudangBahan").dataTable().fnDestroy();
        $("#tableDataKuantitasGudangBahan").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_accounting/main/getListDataKuantitasGudangBahan",
          "columns":[
            {"data" : "kd_gd_bahan","name":"kd_gd_bahan"},
            {"data" : "kd_accurate","name":"kd_accurate"},
            {"data" : "nm_barang","name":"nm_barang"},
            {"data" : "warna","name":"warna"},
            {"data" : "stok","name":"stok"},
            {"data" : "diperbarui","name":"diperbarui"},
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"jns_brg","value":param});
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

      function datatableListKuantitasSparePart(){
        $("#tableDataKuantitasSparePart").dataTable().fnDestroy();
        $("#tableDataKuantitasSparePart").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_accounting/main/getListDataKuantitasSparePart",
          "columns":[
            {"data" : "kd_spare_part","name":"kd_spare_part"},
            {"data" : "nm_spare_part","name":"nm_spare_part"},
            {"data" : "kode","name":"kode"},
            {"data" : "ukuran","name":"ukuran"},
            {"data" : "stok","name":"stok"},
            {"data" : "diperbarui","name":"diperbarui"},
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
          }
        });
      }

      function datatableListKuantitasApal(){
        $("#tableDataKuantitasApal").dataTable().fnDestroy();
        $("#tableDataKuantitasApal").dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "scrollX" : "100%",
          "scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_accounting/main/getListDataKuantitasApal",
          "columns":[
            {"data" : "kd_gd_apal","name":"kd_gd_apal"},
            {"data" : "sub_jenis","name":"sub_jenis"},
            {"data" : "jenis","name":"jenis"},
            {"data" : "stok","name":"stok"},
            {"data" : "diperbarui","name":"diperbarui"},
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
          }
        });
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
                    "<td>"+AvValue.kd_accurate+"</td>"+
                    "<td><a href='#' onclick=keluarMasukSparePart('"+AvValue.kd_spare_part+"','"+encodeURIComponent(AvValue.nm_spare_part)+"')>"+AvValue.nm_spare_part+"</a></td>"+
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

        function keluarMasukSparePart(param1,param2)
        {
          var tglAwal  = $("#tglAwal").val();
          var tglAkhir = $("#tglAkhir").val();
          $("#btnExportExcel").attr("href","<?php echo base_url('_accounting/main/exportExcelDetailHistorySparePart') ?>/"+param1+"/"+tglAwal+"/"+tglAkhir+"/"+param2+"");
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListDataKeluarMasukSparePart'); ?>",
            dataType : "JSON",
            data : {
              kd_spare_part : param1,
              tglAwal : tglAwal,
              tglAkhir : tglAkhir
            },
            success : function(response){
              $("#tableDataKeluarMasukSparePart > tbody").empty();
              if (response[0][0].totalmasuk == null || response[0][0].totalkeluar == null) {
                $("#tableDataKeluarMasukSparePart > tbody:last-child").append(
                  "<tr>"+
                    "<td colspan='4' align='center'>Tidak Ada Transaksi Dibulan "+tglAwal+" s/d "+tglAkhir+".</td>"+
                  "</tr>"
                );
              }else{
                $.each(response[2], function(AvIndex, AvValue){
                  $("#tableDataKeluarMasukSparePart > tbody:last-child").append(
                    "<tr>"+
                      "<td align='center'>"+AvValue.tgl_transaksi+"</td>"+
                      "<td align='right'>"+parseFloat(AvValue.debit).toFixed(2)+"</td>"+
                      "<td align='right'>"+parseFloat(AvValue.kredit).toFixed(2)+"</td>"+
                      "<td align='right'>"+parseFloat(AvValue.saldo).toFixed(2)+"</td>"+
                    "</tr>"
                  );
                });
                $("#tableDataKeluarMasukSparePart > tbody:last-child").append(
                  "<tr>"+
                    "<td align='center'><b>Jumlah :</b></td>"+
                    "<td align='right' style='background-color:#00c0ef;'><b>"+parseFloat(response[0][0].totalmasuk).toFixed(2)+"</b></td>"+
                    "<td align='right' style='background-color:#00c0ef;'><b>"+parseFloat(response[0][0].totalkeluar).toFixed(2)+"</b></td>"+
                    "<td></td>"+
                  "</tr>"
                );
              }
              $("#nm_sparePart").text("( "+decodeURIComponent(param2)+" )")
              $("#modalKeluarMasukSparePart").modal({backdrop:"static"});
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
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

        function keluarMasukBahan(param1,param2) {
          var tglAwal  = $("#tglAwal").val();
          var tglAkhir = $("#tglAkhir").val();
          $("#btnExportExcel").attr("href","<?php echo base_url('_accounting/main/exportExcelDetailHistoryBahan') ?>/"+param1+"/"+tglAwal+"/"+tglAkhir+"/"+param2+"");
          $.ajax({
            type : "POST",
            url : "<?php echo base_url('_accounting/main/getListDataKeluarMasukBahan'); ?>",
            dataType : "JSON",
            data : {
              kd_gd_bahan : param1,
              tglAwal : tglAwal,
              tglAkhir : tglAkhir
            },
            success : function(response){
              $("#tableDataKeluarMasukBahan > tbody").empty();
              if (response[0][0].totalmasuk == null || response[0][0].totalkeluar == null) {
               $("#tableDataKeluarMasukBahan > tbody:last-child").append(
                  "<tr>"+
                    "<td colspan='4' align='center'>Tidak Ada Transaksi Dibulan "+tglAwal+" s/d "+tglAkhir+".</td>"+
                  "</tr>"
                );
              }else{
                $.each(response[2], function(AvIndex, AvValue){
                  $("#tableDataKeluarMasukBahan > tbody:last-child").append(
                    "<tr>"+
                      "<td align='center'>"+parseFloat(AvValue.tgl_permintaan).toFixed(2)+"</td>"+
                      "<td align='right'>"+parseFloat(AvValue.debit).toFixed(2)+"</td>"+
                      "<td align='right'>"+parseFloat(AvValue.kredit).toFixed(2)+"</td>"+
                      "<td align='right'>"+parseFloat(AvValue.saldo).toFixed(2)+"</td>"+
                    "</tr>"
                  );
                });
                $("#tableDataKeluarMasukBahan > tbody:last-child").append(
                  "<tr>"+
                    "<td align='center'><b>Jumlah :</b></td>"+
                    "<td align='right' style='background-color:#00c0ef;'><b>"+parseFloat(response[0][0].totalmasuk).toFixed(2)+"</b></td>"+
                    "<td align='right' style='background-color:#00c0ef;'><b>"+parseFloat(response[0][0].totalkeluar).toFixed(2)+"</b></td>"+
                    "<td></td>"+
                  "</tr>"
                );
              }
              $("#nm_Bahan").text("( "+decodeURIComponent(param2)+" )")
              $("#modalKeluarMasukBahan").modal({backdrop:"static"});
            },
            error : function(response){
              $("#modal-notif").addClass("modal-danger");
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

        $("#listBarangSablon").select2({
            placeholder : "Pilih Ukuran Sablon",
            dropdownParent : $("#modalCariHistoryBarangSablon"),
            width : "100%",
            cache:true,
            allowClear:true,
            ajax:{
              url : "<?php echo base_url(); ?>_accounting/main/getBarangSablon",
              dataType : "JSON",
              delay : 0,
              processResults : function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text: item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik,
                      id:item.kd_gd_hasil
                    }
                  })
                };
              }
            }
          });

        function searchHistoryBarangSablon(){
          var tglAwal  = $("#txtTglAwal").val();
          var tglAkhir = $("#txtTglAkhir").val();
          var kd_gd_hasil = $("#listBarangSablon").val();

          if (!tglAwal||!tglAkhir||!kd_gd_hasil) {
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
            $(".box-body").show();
            $("#modalCariHistoryBarangSablon").modal("hide");
            datatableListBarangSablonMasuk(tglAwal,tglAkhir,kd_gd_hasil)
            datatableListBarangSablonKeluar(tglAwal,tglAkhir,kd_gd_hasil)
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url("_accounting/main/saldoAwalSablon")?>",
              data : {tglAwal:tglAwal,tglAkhir:tglAkhir,kd_gd_hasil:kd_gd_hasil},
              dataType : "JSON",
              success:function(response){
                if (response["totalLembarMasuk"]==null||response["totalBeratMasuk"]) {
                  response["totalLembarMasuk"] = 0;
                  response["totalBeratMasuk"] = 0;
                }
                if (response["totalBeratKeluar"]==null||response["totalLembarKeluar"]==null) {
                  response["totalBeratKeluar"] = 0;
                  response["totalLembarKeluar"] = 0;
                }
                $("#dataAwalBerat").text(response["dataAwalBerat"]);
                $("#dataAwalLembar").text(response["dataAwalLembar"]);
                $("#totalBeratMasuk").text(response["totalBeratMasuk"]);
                $("#totalLembarMasuk").text(response["totalLembarMasuk"]);
                $("#totalBeratKeluar").text(response["totalBeratKeluar"]);
                $("#totalLembarKeluar").text(response["totalLembarKeluar"]);
                $("#saldoLembarAkhir").text(response["saldoLembar"]);
                $("#saldoBeratAkhir").text(response["saldoBerat"]);
              }
            });
          }
        }

        function print_out(no_order){
          $("#cetakFakturLoad").removeAttr("src");
          $("#cetakFakturLoad").attr("src","<?php echo base_url(); ?>_accounting/main/cetakFakturPesanan/"+no_order);
        }

        function datatableListBarangSablonMasuk(param1,param2,param3){
          $("#tableDataBarangSablonMasuk").dataTable().fnDestroy();
          $("#tableDataBarangSablonMasuk").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "sPaginationType": "full_numbers",
            "sAjaxSource":"<?php echo base_url(); ?>_accounting/main/getListDataBarangSablonMasuk",
            "columns":[
              {"data" : "kd_gd_hasil","name":"kd_gd_hasil"},
              {"data" : "tgl_transaksi","name":"tgl_transaksi"},
              {"data" : "jumlah_berat","name":"jumlah_berat"},
              {"data" : "jumlah_lembar","name":"jumlah_lembar"},
              {"data" : "keterangan_history","name":"keterangan_history"},
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              aoData.push({"name":"tglAwal","value":param1});
              aoData.push({"name":"tglAkhir","value":param2});
              aoData.push({"name":"kode","value":param3});
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

        function datatableListBarangSablonKeluar(param1,param2,param3){
          $("#tableDataBarangSablonKeluar").dataTable().fnDestroy();
          $("#tableDataBarangSablonKeluar").dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "sPaginationType": "full_numbers",
            "sAjaxSource":"<?php echo base_url(); ?>_accounting/main/getListDataBarangSablonKeluar",
            "columns":[
              {"data" : "kd_gd_hasil","name":"kd_gd_hasil"},
              {"data" : "tgl_transaksi","name":"tgl_transaksi"},
              {"data" : "jumlah_berat","name":"jumlah_berat"},
              {"data" : "jumlah_lembar","name":"jumlah_lembar"},
              {"data" : "keterangan_history","name":"keterangan_history"},
            ],
            "fnServerData": function (sSource, aoData, fnCallback){
              aoData.push({"name":"tglAwal","value":param1});
              aoData.push({"name":"tglAkhir","value":param2});
              aoData.push({"name":"kode","value":param3});
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

        function changeTitle(title) {
          var date = $("#tglTitle").text().split(" s/d ");
          $("#tglTitle").text(date[0]+" s/d "+date[1]);
          $("#title").text(title);
          if (title=="Dalam Kota") {
            datatableOrder("DK",date[0],date[1]);
          }else if (title=="Luar Kota"){
            datatableOrder("LK",date[0],date[1]);
          }else if (title=="Cabang"){
            datatableOrder("CBG",date[0],date[1]);
          }
        }

        function datatableOrder(jenis="",tgl1="",tgl2=""){
          if (jenis=="") {jenis="DK"}
          $("#datatableOrder"+jenis).dataTable().fnDestroy();
          $("#datatableOrder"+jenis).dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI" : true,
            "sPaginationType" : "full_numbers",
            "sAjaxSource" : "<?php echo base_url(); ?>_accounting/main/getDataOrder",
            "columns" : [
              {"data" : "no_order", "name" : "P.no_order"},
              {"data" : "no_order", "name" : "P.no_order"},
              {"data" : "kd_order", "name" : "P.kd_order"},
              {"data" : "nm_perusahaan", "name" : "C.nm_perusahaan"},
              {"data" : "nm_pemesan", "name" : "P.nm_pemesan"},
              {"data" : "tgl_pesan", "name" : "P.tgl_pesan"},
              {"data" : "tgl_estimasi", "name" : "P.tgl_estimasi"},
              {"data" : "sts_pesanan", "name" : "P.sts_pesanan"},
              {"data" : "no_order", "name" : "P.no_order"}
            ],
            "fnServerData" : function(sSource,aoData,fnCallback){
              aoData.push({"name":"jenis","value":jenis});
              aoData.push({"name":"tgl1","value":tgl1});
              aoData.push({"name":"tgl2","value":tgl2});
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
              $("td:eq(8)",nRow).html("<button class='btn btn-flat btn-primary btn-sm' data-toggle='modal' data-target='#modal-lihat-detail-pesanan' onclick=lihatDetailPesanan('"+aData['no_order']+"')>Detail</button>"+
                                      "<button class='btn btn-md btn-flat btn-sm' onclick=print_out('"+aData["no_order"]+"') data-toggle='modal' data-target='#print-out'>Print Out</button>");
            }
          });
        }

        function orderPerHariByDate(){
          var date1 = $("#tanggal1").val();
          var date2 = $("#tanggal2").val();
          if (!date1 || !date2) {
            alert("Tanggal Tidak Boleh Kosong!")
          }else{
            $("#tglTitle").text(date1+" s/d "+date2);
            if ($("#datatableOrderDK").length) {
              datatableOrder("DK",date1,date2)
            }

            if ($("#datatableOrderLK").length) {
              datatableOrder("LK",date1,date2)
            }

            if ($("#datatableOrderCBG").length) {
              datatableOrder("CBG",date1,date2)
            }
          }
        }

        function lihatDetailPesanan(param){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_accounting/main/getLihatPesanan",
            dataType : "JSON",
            data : {no_order : param},
            success : function(response){
              $("#td_no_order").text(response[0].no_order);
              $("#td_nm_perusahaan").text(response[0].nm_perusahaan);
              $("#td_nm_owner").text(response[0].nm_owner);
              $("#td_nm_pemesan").text(response[0].nm_pemesan);
              $("#td_nm_purchasing").text(response[0].nm_purchasing);
              $("#td_tgl_pesan").text(response[0].tgl_pesan);
              $("#td_tgl_estimasi").text(response[0].tgl_estimasi);
              $("#td_term_payment").text(response[0].payment_method);
              $("#td_proof").text(response[0].proof);
              $("#td_expedisi").text(response[0].expedisi);
              $("#paragraf-note").html(response[0].note);
              $("#last-update").text("Last Update : "+response[0].diperbarui);

              $("#tabel-lihat-pesanan-detail").dataTable().fnDestroy();
              $("#tabel-lihat-pesanan-detail").dataTable({
                // "fixedHeader" : true,
                "bProcessing" : true,
                "bServerSide" : true,
                "autoWidth" : false,
                "bScrollCollapse" : true,
                "sAjaxSource" : "<?php echo base_url(); ?>_accounting/main/getLihatPesananDetail?no_order="+param,
                "columns" : [
                  {"data":"jumlah","name":"DP.jumlah"},
                  {"data":"sisa","name":"(DP.jumlah - DP.jumlah_kirim)"},
                  {"data":"ukuran","name":"GH.ukuran"},
                  {"data":"harga","name":"DP.harga"},
                  {"data":"merek","name":"DP.merek"},
                  {"data":"warna_plastik","name":"GH.warna_plastik"},
                  {"data":"warna_cetak","name":"DP.warna_cetak"},
                  {"data":"sm","name":"DP.sm"},
                  {"data":"dll","name":"DP.dll"},
                  {"data":"kd_hrg","name":"DP.kd_hrg"},
                  {"data":"sts_pesanan","name":"DP.sts_pesanan"},
                  {"data":"sts_kirim","name":"DP.sts_kirim"}
                ],
                "sPaginationType": "full_numbers",
                "iDisplayStart ": 20,
                "fnServerData": function (sSource, aoData, fnCallback){
                  $.ajax({
                           "dataType": "json",
                           "type": "POST",
                           "url": sSource,
                           "data": aoData,
                           "success": fnCallback
                       });
                },
                "order": [
                          [0, "DESC"]
                        ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                  $("td:eq(0)",nRow).text(aData["jumlah"]+" "+aData["satuan"]);
                  $("td:eq(1)",nRow).text(aData["sisa"]+" "+aData["satuan"]);
                  $("td:eq(3)",nRow).text(aData["mata_uang"]+" "+aData["harga"]);
                }
              });
            }
          });
        }

//================================ DATATABLE METHOD (FINISH) ============================//
      </script>
<!--===============================================General Function (Finish) ===============================================-->
    </body>
</html>
