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
          if ($("#tableOrderDenganPajakDK").length) {
            tableOrderDenganPajak("DK");
          }
          if ($("#tableOrderDenganPajakLK").length) {
            tableOrderDenganPajak("LK");
          }
          if ($("#tableOrderDenganPajakLK").length) {
            tableOrderDenganPajak("CBG");
          }
          
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

      function tableOrderDenganPajak(param1) {
        $("#tableOrderDenganPajak"+param1).dataTable().fnDestroy();
        $("#tableOrderDenganPajak"+param1).dataTable({
          // "fixedHeader" : true,
          "autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "bJQueryUI" : true,
          "sPaginationType" : "full_numbers",
          "sAjaxSource" : "<?php echo base_url(); ?>_pajak/main/getDataOrderPajak",
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
            aoData.push({"name":"jenis","value":param1});
            // aoData.push({"name":"tgl","value":param2});
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
            $("td:eq(8)",nRow).html("<button class='btn btn-flat btn-primary btn-sm' style='width:70px;' data-toggle='modal' data-target='#modal-lihat-detail-pesanan' onclick=lihatDetailPesanan('"+aData['no_order']+"')>Detail</button><button class='btn btn-flat btn-success btn-sm' style='width:70px;' data-toggle='modal' data-target='#print-out' onclick=print_out('"+aData['no_order']+"')>Print</button>");
          }
        });
      }

      function lihatDetailPesanan(param){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_pajak/main/getLihatPesanan",
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
                "sAjaxSource" : "<?php echo base_url(); ?>_pajak/main/getLihatPesananDetail?no_order="+param,
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

        function changeTitle(title) {
          $("#title").text(title);
        }

        function print_out(no_order){
          $("#cetakFakturLoad").removeAttr("src");
          $("#cetakFakturLoad").attr("src","<?php echo base_url(); ?>_pajak/main/cetakFakturPesanan/"+no_order);
        }
//================================ MODAL FUNCTION (START) ============================//
        
//================================ DATATABLE FUNCTION (FINISH) ============================//
      </script>
<!--===============================================General Function (Finish) ===============================================-->
    </body>
</html>
