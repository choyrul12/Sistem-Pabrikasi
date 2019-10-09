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

      <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/input-mask/inputmask.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/input-mask/inputmask.numeric.extensions.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.fnReloadAjax.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/fixedheader/js/dataTables.fixedHeader.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart_2.4.0.js"></script>

<!--===============================================On Load Function (Start) ===============================================-->
      <script type="text/javascript">
        $(function () {

          if ($("#tableOrderPerHariDK").length) {
            totalOrderPerHari("DK")
          }

          if ($("#tableOrderPerHariLK").length) {
            totalOrderPerHari("LK")
          }

          if ($("#tableOrderPerHariCBG").length) {
            totalOrderPerHari("CBG")
          }
          datatableOrederPerHari()
          //======= Inisialisasi Komponen (Start) =======
          // $("#txt_uang_muka").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_harga").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_omset_kg").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_omset_lembar").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_potongan").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_jumlah").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_hsl_diskon").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});

          // $("#txt_uang_muka_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_harga_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_omset_kg_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_omset_lembar_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_potongan_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_jumlah_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_hsl_diskon_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});

          $(".select2").select2();
          $("#btn-note-customer").attr("disabled","disabled");
          $("#keranjang-belanja_temp").dataTable({
            // "fixedHeader" : true,
            "searching":false,
            "scrollY" : "200px",
            "ordering" : false,
            "paging" : false
          });
          $("#keranjang-belanja").dataTable({
            // "fixedHeader" : true,
            "searching":false,
            "scrollY" : "200px",
            "ordering" : false,
            "paging" : false
          });
          $("#product_service").dataTable({
            // "fixedHeader" : true,
            "autoWidth":false,
            "ordering" : false,
            "paging" : false,
            "scrollY" : "300px"
          });
          if($("#cmb-payment-edit").length > 0){
            $("#cmb-payment-edit").trigger("change");
            $("#cmb-payment-edit").val($("#hiddenPayment").val());
          }

          reloadCounterOrderDeadline();
          setTimeout(function(){
            reloadCounterOrderDeadline();
          },60000);
          //======= Inisialisasi Komponen (End) =======

          $("#cmb_customer").select2({
            placeholder : "Pilih Customer",
            ajax:{
              url : "<?php echo base_url() ?>_marketing/main/getCustomerLike",
              dataType : "json",
              delay : 250,
              processResults: function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.nm_perusahaan,
                      id:item.kd_cust
                    }
                  })
                };
              },
              cache : true
            }
          });

          $("#cmb_customer_history").select2({
            placeholder : "Pilih Customer",
            ajax:{
              url : "<?php echo base_url() ?>_marketing/main/getCustomerLike",
              dataType : "json",
              delay : 250,
              processResults: function(data){
                return{
                  results : $.map(data, function(item){
                    return{
                      text:item.nm_perusahaan,
                      id:item.kd_cust
                    }
                  })
                };
              },
              cache : true
            }
          });

          $("#cmb_ukuran").select2({
            placeholder : "Pilih Ukuran",
            allowClear : true,
            ajax:{
              url : "<?php echo base_url() ?>_marketing/main/getGudangHasilLike",
              dataType : "json",
              delay : 250,
              processResults: function(data){
                return{
                  results : $.map(data, function(item){
                    if(item.jenis == "MINYAK" || item.jenis == "CAT MURNI"){
                      return{
                        text:item.nm_barang +" - "+ item.warna +" - "+ item.status +" - "+ item.jenis,
                        id:item.kd_gd_bahan
                      }
                    }else{
                      return{
                        text:item.ukuran +" - "+ item.warna_plastik +" - "+ item.tebal +" - "+ item.merek +" - "+ item.jns_brg,
                        id:item.kd_gd_hasil
                      }
                    }
                  })
                };
              },
              cache : true
            }
          });

          $("#cmb_ukuran_edit").select2({
            placeholder : "Pilih Ukuran",
            ajax:{
              url : "<?php echo base_url() ?>_marketing/main/getGudangHasilLike",
              dataType : "json",
              delay : 250,
              processResults: function(data){
                return{
                  results : $.map(data, function(item){
                    if(item.jenis == "MINYAK" || item.jenis == "CAT MURNI"){
                      return{
                        text:item.nm_barang +" - "+ item.warna +" - "+ item.status +" - "+ item.jenis,
                        id:item.kd_gd_bahan
                      }
                    }else{
                      return{
                        text:item.ukuran +" - "+ item.warna_plastik +" - "+ item.tebal +" - "+ item.merek +" - "+ item.jns_permintaan +" - "+ item.jns_brg,
                        id:item.kd_gd_hasil
                      }
                    }
                  })
                };
              },
              cache : true
            }
          });

          $("#cmb_customer").on("select2:select",function(e){
              e.preventDefault();
              var id = $("#cmb_customer").val();
              var no_order = $("#txt_no_order").val();
              $("#pesanan-detail-tbody").load("<?php echo base_url(); ?>_marketing/main/getPesananDetailsTemp/" + no_order + "/" + id );
              $.ajax({
                type : "POST",
                url : "<?php echo base_url() ?>_marketing/main/getCustomerOrder",
                dataType : "JSON",
                data : {kd_cust : id},
                success : function(response){
                  $("#txt_kd_cust").val(response[0].kd_cust);
                  $("#txt_nm_perusahaan").val((response[0].nm_perusahaan_update =="" || response[0].nm_perusahaan_update ==null) ? response[0].nm_perusahaan : response[0].nm_perusahaan_update);
                  if(response[0].pajak == "0"){
                    $("input[name='rb_pajak'][value='FALSE']").attr("checked","checked");
                  }else{
                    $("input[name='rb_pajak'][value='TRUE']").attr("checked","checked");
                  }
                  var kdCust = response[0].kd_cust;
                  var jnsOrder = kdCust.substring(kdCust.length-2, kdCust.length);
                  if(jnsOrder != "XX"){
                    $("#cmb-jns-order").val(jnsOrder);
                  }
                  $("#btn-note-customer").attr("href","<?php echo base_url(); ?>_marketing/main/show_customer_note/"+id);
                  $("#btn-note-customer").removeAttr("disabled");
                  $("#produk-service").load("<?php echo base_url() ?>_marketing/main/show_product_service/"+id);
                }
              });
          });

          $("#cmb_customer_history").on("select2:select",function(e){
              e.preventDefault();
              var id = $("#cmb_customer_history").val();
              $("#history-table").dataTable().fnDestroy();
              $('#history-table').dataTable({
                // "fixedHeader" : true,
                "bProcessing" : true,
                "bServerSide" : true,
                "autoWidth": false,
                "responsive" : true,
                "scrollY" : "500px",
                "scrollX" : "100%",
                "sAjaxSource":"<?php echo base_url(); ?>_marketing/main/getHistoryOrderJson?kd_cust="+id,
                "columns":[
                  {"data":"tgl_pesan","name":"P.tgl_pesan"},
                  {"data":"tgl_estimasi","name":"P.tgl_estimasi"},
                  {"data":"kd_cust","name":"P.kd_cust"},
                  {"data":"nm_owner","name":"C.nm_owner"},
                  {"data":"nm_purchasing","name":"C.nm_purchasing"},
                  {"data":"jumlah","name":"PD.jumlah"},
                  {"data":"ukuran","name":"GH.ukuran"},
                  {"data":"payment_method","name":"P.payment_method"},
                  {"data":"harga","name":"PD.harga"},
                  {"data":"merek","name":"PD.merek"},
                  {"data":"warna_plastik","name":"GH.warna_plastik"},
                  {"data":"warna_cetak","name":"PD.warna_cetak"},
                  {"data":"sm","name":"PD.sm"},
                  {"data":"dll","name":"PD.dll"},
                  {"data":"kd_hrg","name":"PD.kd_hrg"},
                  {"data":"no_order","name":"PD.no_order"}
                ],
                "sPaginationType": "full_numbers",
                "iDisplayStart ": 10,
                "fnServerData": function (sSource, aoData, fnCallback){
                  $.ajax({
                           "dataType": "json",
                           "type": "POST",
                           "url": sSource,
                           "data": aoData,
                           "success": fnCallback
                       });
                },
                "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
                  var jumlah = parseFloat(AvData["jumlah"]).toLocaleString();
                  var harga = parseFloat(AvData["harga"]).toLocaleString();
                  $("td:eq(5)",AvRow).text(jumlah + " " + AvData["satuan"]);
                  $("td:eq(8)",AvRow).text(harga + " ");
                  $("td:eq(15)",AvRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalLihatNotePesanan('"+AvData["no_order"]+"')>Lihat Note Pesanan</button>")
                }
              });

              $("#history-table-lama").dataTable().fnDestroy();
              $('#history-table-lama').dataTable({
                // "fixedHeader" : true,
                "bProcessing" : true,
                "bServerSide" : true,
                "autoWidth": false,
                "responsive" : true,
                "scrollY" : "500px",
                "scrollX" : "100%",
                "sAjaxSource":"<?php echo base_url(); ?>_marketing/main/getHistoryOrderJsonLama",
                "columns":[
                  {"data":"tgl_pesan","name":"P.tgl_pesan"},
                  {"data":"tgl_estimasi","name":"P.tgl_estimasi"},
                  {"data":"kd_customer","name":"P.kd_customer"},
                  {"data":"nm_owner","name":"C.nm_owner"},
                  {"data":"nm_purchasing","name":"C.nm_purchasing"},
                  {"data":"jumlah","name":"PD.jumlah"},
                  {"data":"ukuran","name":"GH.ukuran"},
                  {"data":"term_payment","name":"P.term_payment"},
                  {"data":"harga","name":"PD.harga"},
                  {"data":"merek","name":"PD.merek"},
                  {"data":"warna_plastik","name":"GH.warna_plastik"},
                  {"data":"cetak","name":"PD.cetak"},
                  {"data":"sm","name":"PD.sm"},
                  {"data":"dll","name":"PD.dll"},
                  {"data":"kd_harga","name":"PD.kd_harga"},
                  {"data":"no_order","name":"PD.no_order"}
                ],
                "sPaginationType": "full_numbers",
                "iDisplayStart ": 10,
                "fnServerData": function (sSource, aoData, fnCallback){
                  aoData.push({"name":"kdCust","value":id});
                  $.ajax({
                           "dataType": "json",
                           "type": "POST",
                           "url": sSource,
                           "data": aoData,
                           "success": fnCallback
                       });
                },
                "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
                  var jumlah = parseFloat(AvData["jumlah"]).toLocaleString();
                  var harga = parseFloat(AvData["harga"]).toLocaleString();
                  $("td:eq(5)",AvRow).text(jumlah + " " + AvData["satuan"]);
                  $("td:eq(8)",AvRow).text(harga + " ");
                  $("td:eq(15)",AvRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalLihatNotePesananLama('"+AvData["no_order"]+"')>Lihat Note Pesanan</button>")
                }
              });
          });

          $(".proof").on("change",function(e){
            var proof = this.value;
            if(proof == "PERLU"){
              $("#cmb_ket_proof").removeAttr("disabled");
            }else{
              $("#cmb_ket_proof").attr("disabled","disabled");
            }
          });

          $(".proof_edit").on("change",function(e){
            var proof = this.value;
            if(proof == "PERLU"){
              $("#cmb_ket_proof_edit").removeAttr("disabled");
            }else{
              $("#cmb_ket_proof_edit").attr("disabled","disabled");
            }
          });

          $("#btn-tambah-pesanan-detail").click(function(e){
            e.preventDefault();
            var no_order1 = $("#txt_no_order").val();
            var kd_gudang1 = $("#cmb_ukuran").val();
            var jumlah1 = $("#txt_jumlah").val().replace(/,/g , "");
            var satuan1 = $("#cmb_satuan").val();
            var harga1 = $("#txt_harga").val().replace(/,/g , "");
            var mata_uang1 = $(".mata_uang").val();;
            var warna_cetak1 = $("#txt_warna_cetak").val();
            var dll1 = $("#txt_dll").val();
            var strip1 = $("#txt_strip").val();
            var kd_harga1 = $("#txt_kd_hrg").val();
            var omset_kg1 = $("#txt_omset_kg").val().replace(/,/g , "");
            var omset_lembar1 = $("#txt_omset_lembar").val().replace(/,/g , "");
            var potongan1 = $("#txt_potongan").val().replace(/,/g , "");
            var hsl_diskon1 = $("#txt_hsl_diskon").val().replace(/,/g , "");
            var cn1 = $("#txt_cn").val();
            var merek1 = $("#txt_merek").val();
            var kd_cust1 = $("#txt_kd_cust").val();

            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_marketing/main/savePesananDetailTemp",
              dataType : "text",
              data : {
                      no_order:no_order1,kd_gudang:kd_gudang1,
                      jumlah:jumlah1,satuan:satuan1,
                      harga:harga1,mata_uang:mata_uang1,
                      warna_cetak:warna_cetak1,dll:dll1,
                      strip:strip1,kd_harga:kd_harga1,
                      omset_kg:omset_kg1,omset_lembar:omset_lembar1,
                      potongan:potongan1,hsl_diskon:hsl_diskon1,
                      cn:cn1,merek:merek1,kd_cust:kd_cust1
                    },
              success: function(response){
                if (jQuery.trim(response) === "Berhasil"){
                  var out = "";
                  $("#notif-detail-pesanan").html("<div class='alert alert-success fade in' role='alert'><b>Item Pesanan Berhasil Ditambahkan</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2000);
                  $("#pesanan-detail-tbody").load("<?php echo base_url(); ?>_marketing/main/getPesananDetailsTemp/"+no_order1+"/"+kd_cust1+"");
                  $("#cmb_ukuran").empty().trigger("change");
                  $("#txt_jumlah").val("");
                  $("#cmb_satuan").val("");
                  $("#txt_harga").val("");
                  //$(".mata_uang").val("");;
                  $("#txt_warna_cetak").val("");
                  $("#txt_dll").val("");
                  $("#txt_strip").val("");
                  $("#txt_kd_hrg").val("");
                  $("#txt_omset_kg").val("");
                  $("#txt_omset_lembar").val("");
                  $("#txt_potongan").val("");
                  $("#txt_hsl_diskon").val("");
                  $("#txt_cn").val("");
                  $("#txt_merek").val("");
                }else{
                  $("#notif-detail-pesanan").html("<div class='alert alert-danger fade in' role='alert'><b>Item Pesanan Gagal Ditambahkan !</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2000);
                  $("#pesanan-detail-tbody").load("<?php echo base_url(); ?>_marketing/main/getPesananDetailsTemp/"+no_order1+"/"+kd_cust1);
                }
              }
            });
          });

          $("#btn-checkout").click(function(e){
            e.preventDefault();
            for (instance in CKEDITOR.instances) {
               CKEDITOR.instances[instance].updateElement();
            }
            var kd_cust = $("#txt_kd_cust").val();
            var no_order = $("#txt_no_order").val();
            var tgl_pesan = $("#txt_tgl_pesan").val();
            var tgl_estimasi = $("#txt_tgl_estimasi").val();
            var no_po = $("#txt_no_po").val();
            var nm_pemesan = $("#txt_nm_pemesan").val();
            var file_1 = $("#file_1").val().replace(/.*(\/|\\)/, '');//replace path with string null;
            var file_2 = $("#file_2").val().replace(/.*(\/|\\)/, '');
            var pajak = $(".pajak:checked").val();
            var jns_order = $("#cmb-jns-order").val();
            var kd_order = $("#txt_kd_order").val();
            var uang_muka = $("#txt_uang_muka").val();
            var mata_uang = $(".mata_uang_p:checked").val();
            var ekspedisi = $("#txt_ekspedisi").val();
            var payment = $("#cmb-payment").val();
            var proof = $(".proof:checked").val();
            var ket_proof = $("#cmb_ket_proof").val();
            var sales1 = $("#cmbSales").val();
            var note = CKEDITOR.instances['txt_note'].getData();

            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_marketing/main/savePesananFinal",
              dataType : "text",
              data : {kd_cust:kd_cust, no_order:no_order, tgl_pesan:tgl_pesan,
                      tgl_estimasi:tgl_estimasi, no_po:no_po, nm_pemesan:nm_pemesan,
                      file_1:file_1, file_2:file_2, pajak:pajak, jns_order:jns_order,
                      kd_order:kd_order, uang_muka:uang_muka, mata_uang:mata_uang,
                      ekspedisi:ekspedisi, payment:payment, proof:proof, note:note,
                      ket_proof:ket_proof, sales:sales1},
              success : function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  var form_data = new FormData();
                  form_data.append("file", $("#file_1")[0].files[0]);
                  form_data.append("file2", $("#file_2")[0].files[0]);

                  $.ajax({
                    type : "POST",
                    url : "<?php echo base_url(); ?>_marketing/main/uploadFoto",
                    contentType : false,
                    processData : false,
                    dataType : "text",
                    data : form_data,
                    success : function(response){
                      if (jQuery.trim(response) === "Berhasil") {
                        $("#notif-detail-pesanan").html("<div class='alert alert-success fade in' role='alert'><b>Pesanan Berhasil Ditambahkan</b></div>");
                        setTimeout(function(){
                          $(".alert").alert("close");
                        },2000);
                        location.reload();
                      }else{
                        $("#notif-detail-pesanan").html("<div class='alert alert-danger fade in' role='alert'><b>Pesanan Gagal Ditambahkan!</b></div>");
                        setTimeout(function(){
                          $(".alert").alert("close");
                        },2000);
                      }
                    }
                  });
                }else if(jQuery.trim(response) === "Gagal"){
                  $("#notif-detail-pesanan").html("<div class='alert alert-danger fade in' role='alert'><b>Data Gagal Masuk!</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2000);
                }else{
                  $("#notif-detail-pesanan").html("<div class='alert alert-warning fade in' role='alert'><b>Kolom Berwarna Merah Tidak Boleh Kosong!</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2500);
                }
              }
            });
          });

          $("#btn-edit-pesanan-detail-temp").click(function(e){
            e.preventDefault();
            var kd_cust1 = $("#txt_kd_cust").val();
            var no_order1 = $("#txt_no_order").val();
            var kd_gudang1 = $("#cmb_ukuran1").val();
            var jumlah1 = $("#txt_jumlah1").val().replace(/,/g , "");
            var satuan1 = $("#cmb_satuan1").val();
            var harga1 = $("#txt_harga1").val().replace(/,/g , "");
            var mata_uang1 = $(".mata_uang1").val();
            var id_dp1 = $("#id_dp").val();
            var warna1 = $("#txt_warna_cetak1").val();
            var dll1 = $("#txt_dll1").val();
            var strip1 = $("#txt_strip1").val();
            var kd_harga1 = $("#txt_kd_hrg1").val();
            var omset_kg1 = $("#txt_omset_kg1").val().replace(/,/g , "");
            var omset_lembar1 = $("#txt_omset_lembar1").val().replace(/,/g , "");
            var potongan1 = $("#txt_potongan1").val().replace(/,/g , "");
            var hsl_diskon1 = $("#txt_hsl_diskon1").val().replace(/,/g , "");
            var cn1 = $("#txt_cn1").val();
            var merek1 = $("#txt_merek1").val();

            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_marketing/main/modifyPesananDetailTemp",
              dataType : "text",
              data : {
                      id_dp:id_dp1, kd_gudang:kd_gudang1, jumlah:jumlah1,
                      satuan:satuan1, harga:harga1, mata_uang:mata_uang1,
                      warna:warna1, dll:dll1, strip:strip1, kd_harga:kd_harga1,
                      omset_kg:omset_kg1, omset_lembar:omset_lembar1, potongan:potongan1,
                      hsl_diskon:hsl_diskon1, cn:cn1, merek:merek1
                    },
              success : function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  $("#edit-modal-pesanan-detail-temp").modal("hide");
                  $("#notif-detail-pesanan").html("<div class='alert alert-success fade in' role='alert'><b>Pesanan Berhasil Diubah</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2000);
                  $("#pesanan-detail-tbody").load("<?php echo base_url(); ?>_marketing/main/getPesananDetailsTemp/"+no_order1+"/"+kd_cust1+"");
                }else{
                  $("#edit-modal-pesanan-detail-temp").modal("hide");
                  $("#notif-detail-pesanan").html("<div class='alert alert-danger fade in' role='alert'><b>Pesanan Gagal Diubah</b></div>");
                  //alert(response);
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2000);
                  $("#pesanan-detail-tbody").load("<?php echo base_url(); ?>_marketing/main/getPesananDetailsTemp/"+no_order1+"/"+kd_cust1+"");
                }
              }
            });
          });

          $("#table-pencarian").dataTable({
            // "fixedHeader" : true,
            "bProcessing" : true,
            "bServerSide" : true,
            "autoWidth": false,
            "responsive" : true,
            "sScrollX": "100%",
            "bScrollCollapse": false,
            "sAjaxSource":"<?php echo base_url(); ?>_marketing/main/getPencarian",
            "columns":[
              {"data":"no_order","name":"P.no_order"},
              {"data":"nm_perusahaan","name":"C.nm_perusahaan"},
              {"data":"ukuran","name":"GH.ukuran"},
              {"data":"merek","name":"PD.merek","width":"30%"},
              {"data":"nm_brg","name":"GH.Merek"},
              {"data":"harga","name":"PD.harga"},
              {"data":"jumlah_pesanan","name":"PD.jumlah"},
              {"data":"kd_hrg","name":"PD.kd_hrg"},
              {"data":"warna_cetak","name":"PD.warna_cetak"},
              {"data":"warna_plastik","name":"GH.warna_plastik"},
              {"data":"tgl_pesan","name":"P.tgl_pesan"},
              {"data":"sts_pesanan","name":"P.sts_pesanan"}
            ],
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "order": [[0, "desc"]],
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
              $("td:eq(0)",nRow).html("<a href='#' data-toggle='modal' data-target='#modal-lihat-detail-pesanan' onclick=lihatDetailPesanan('"+aData['no_order']+"')>"+aData['no_order']+"</a>");
              $("td:eq(1)",nRow).html("<a href='#' data-toggle='modal' data-target='#modal-detail-customer' onclick=lihatDetailCustomer('"+aData['kd_cust']+"')>"+aData['nm_perusahaan']+"</a>");
              if(aData["deleted"] == "TRUE"){
                $("td",nRow).css({"background-color":"rgba(255,0,0,0.7)","color":"#FFF"});
                $("td:eq(0)",nRow).html("<a href='#' data-toggle='modal' style='color : #FFF;' data-target='#modal-lihat-detail-pesanan' onclick=lihatDetailPesanan('"+aData['no_order']+"')>"+aData['no_order']+"</a>");
                $("td:eq(1)",nRow).html("<a href='#' data-toggle='modal' style='color : #FFF;' data-target='#modal-detail-customer' onclick=lihatDetailCustomer('"+aData['kd_cust']+"')>"+aData['nm_perusahaan']+"</a>");
              }
            }
          });

//============ EDIT PESANAN DAN PESANAN DETAIL AJAX METHOD ============
          $("#produk-service-edit").load("<?php echo base_url(); ?>_marketing/main/show_product_service/"+$("#txt_kd_cust_edit").val());
          $("#btn-note-customer-edit").attr("href","<?php echo base_url(); ?>_marketing/main/show_customer_note/"+$("#txt_kd_cust_edit").val());
          $("#pesanan-detail-tbody-edit").load("<?php echo base_url(); ?>_marketing/main/getPesananDetails/" + $("#txt_no_order_edit").val());

          $("#btn-checkout-edit").click(function(e){
            e.preventDefault();
            for (instance in CKEDITOR.instances) {
               CKEDITOR.instances[instance].updateElement();
            }
            var kd_cust = $("#txt_kd_cust_edit").val();
            var no_order = $("#txt_no_order_edit").val();
            var tgl_pesan = $("#txt_tgl_pesan_edit").val();
            var tgl_estimasi = $("#txt_tgl_estimasi_edit").val();
            var no_po = $("#txt_no_po_edit").val();
            var nm_pemesan = $("#txt_nm_pemesan_edit").val();
            var file_1 = $("#file_1_edit").val().replace(/.*(\/|\\)/, '')//replace path with string null;
            var file_2 = $("#file_2_edit").val().replace(/.*(\/|\\)/, '');
            var pajak = $(".pajak_edit:checked").val();
            var jns_order = $("#cmb-jns-order-edit").val();
            var kd_order = $("#txt_kd_order_edit").val();
            var uang_muka = $("#txt_uang_muka_edit").val();
            var mata_uang = $(".mata_uang_p_edit:checked").val();
            var ekspedisi = $("#txt_ekspedisi_edit").val();
            var payment = $("#cmb-payment-edit").val();
            var proof = $(".proof_edit:checked").val();
            var ket_proof = $("#cmb_ket_proof_edit").val();
            var note = CKEDITOR.instances['txt_note_edit'].getData();

            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_marketing/main/modifyPesananFinal",
              dataType : "text",
              data : {kd_cust:kd_cust, no_order:no_order, tgl_pesan:tgl_pesan,
                      tgl_estimasi:tgl_estimasi, no_po:no_po, nm_pemesan:nm_pemesan,
                      file_1:file_1, file_2:file_2, pajak:pajak, jns_order:jns_order,
                      kd_order:kd_order, uang_muka:uang_muka, mata_uang:mata_uang,
                      ekspedisi:ekspedisi, payment:payment, proof:proof, note:note,ket_proof:ket_proof},
              success : function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  var form_data = new FormData();
                  form_data.append("file", $("#file_1_edit")[0].files[0]);
                  form_data.append("file2", $("#file_2_edit")[0].files[0]);

                  $.ajax({
                    type : "POST",
                    url : "<?php echo base_url(); ?>_marketing/main/uploadFoto",
                    contentType : false,
                    processData : false,
                    dataType : "text",
                    data : form_data,
                    success : function(response){
                      if (jQuery.trim(response) === "Berhasil") {
                        $("#notif-detail-pesanan").html("<div class='alert alert-success fade in' role='alert'><b>Pesanan Berhasil Diubah</b></div>");
                        setTimeout(function(){
                          $(".alert").alert("close");
                        },2000);
                        document.location = "<?php echo base_url(); ?>_marketing/main/pantau_order";
                      }else{
                        $("#notif-detail-pesanan").html("<div class='alert alert-danger fade in' role='alert'><b>Pesanan Gagal Diubah!</b></div>");
                        setTimeout(function(){
                          $(".alert").alert("close");
                        },2000);
                        //alert(response);
                      }
                    }
                  });
                }else if(jQuery.trim(response) === "Gagal"){
                  $("#notif-detail-pesanan").html("<div class='alert alert-danger fade in' role='alert'><b>Data Gagal Diubah!</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2000);
                }else{
                  $("#notif-detail-pesanan").html("<div class='alert alert-warning fade in' role='alert'><b>Kolom Berwarna Merah Tidak Boleh Kosong!</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2500);
                }
              }
            });
          });

          $("#btn-tambah-pesanan-detail-edit").click(function(e){
            e.preventDefault();
            var no_order1 = $("#txt_no_order_edit").val();
            var kd_gudang1 = $("#cmb_ukuran_edit").val();
            var jumlah1 = $("#txt_jumlah_edit").val().replace(/,/gi,"");
            var satuan1 = $("#cmb_satuan_edit").val();
            var harga1 = $("#txt_harga_edit").val().replace(/,/g , "");
            var mata_uang1 = $(".mata_uang_edit").val();;
            var warna_cetak1 = $("#txt_warna_cetak_edit").val();
            var dll1 = $("#txt_dll_edit").val();
            var strip1 = $("#txt_strip_edit").val();
            var kd_harga1 = $("#txt_kd_hrg_edit").val();
            var omset_kg1 = $("#txt_omset_kg_edit").val().replace(/,/g , "");
            var omset_lembar1 = $("#txt_omset_lembar_edit").val().replace(/,/g , "");
            var potongan1 = $("#txt_potongan_edit").val().replace(/,/g , "");
            var hsl_diskon1 = $("#txt_hsl_diskon_edit").val().replace(/,/g , "");
            var cn1 = $("#txt_cn_edit").val();
            var merek1 = $("#txt_merek_edit").val();
            //var kd_cust1 = $("#txt_kd_cust_edit").val();

            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_marketing/main/savePesananDetail",
              dataType : "text",
              data : {
                      no_order:no_order1,kd_gudang:kd_gudang1,
                      jumlah:jumlah1,satuan:satuan1,
                      harga:harga1,mata_uang:mata_uang1,
                      warna_cetak:warna_cetak1,dll:dll1,
                      strip:strip1,kd_harga:kd_harga1,
                      omset_kg:omset_kg1,omset_lembar:omset_lembar1,
                      potongan:potongan1,hsl_diskon:hsl_diskon1,
                      cn:cn1,merek:merek1//,kd_cust:kd_cust1
                    },
              success: function(response){
                if (jQuery.trim(response) === "Berhasil"){
                  var out = "";
                  $("#notif-detail-pesanan").html("<div class='alert alert-success fade in' role='alert'><b>Item Pesanan Berhasil Ditambahkan</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2000);
                  $("#pesanan-detail-tbody-edit").load("<?php echo base_url(); ?>_marketing/main/getPesananDetails/" + no_order1);
                  $("#cmb_ukuran_edit").val("");
                  $("#txt_jumlah_edit").val("");
                  $("#cmb_satuan_edit").val("");
                  $("#txt_harga_edit").val("");
                  $("#txt_warna_cetak_edit").val("");
                  $("#txt_dll_edit").val("");
                  $("#txt_strip_edit").val("");
                  $("#txt_kd_hrg_edit").val("");
                  $("#txt_omset_kg_edit").val("");
                  $("#txt_omset_lembar_edit").val("");
                  $("#txt_potongan_edit").val("");
                  $("#txt_hsl_diskon_edit").val("");
                  $("#txt_cn_edit").val("");
                  $("#txt_merek_edit").val("");
                }else{
                  $("#notif-detail-pesanan").html("<div class='alert alert-danger fade in' role='alert'><b>Item Pesanan Gagal Ditambahkan !</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2000);
                  $("#pesanan-detail-tbody-edit").load("<?php echo base_url(); ?>_marketing/main/getPesananDetails/" + no_order1);
                }
              }
            });
          });

          $("#btn-edit-pesanan-detail").click(function(e){
            e.preventDefault();
            //var kd_cust1 = $("#txt_kd_cust").val();
            var no_order1 = $("#txt_no_order_edit").val();
            var kd_gudang1 = $("#cmb_ukuran1_edit").val();
            var jumlah1 = $("#txt_jumlah1_edit").val().replace(/,/g , "");
            var satuan1 = $("#cmb_satuan1_edit").val();
            var harga1 = $("#txt_harga1_edit").val().replace(/,/g , "");
            var mata_uang1 = $(".mata_uang1_edit").val();
            var id_dp1 = $("#id_dp_edit").val();
            var warna1 = $("#txt_warna_cetak1_edit").val();
            var dll1 = $("#txt_dll1_edit").val();
            var strip1 = $("#txt_strip1_edit").val();
            var kd_harga1 = $("#txt_kd_hrg1_edit").val();
            var omset_kg1 = $("#txt_omset_kg1_edit").val().replace(/,/g , "");
            var omset_lembar1 = $("#txt_omset_lembar1_edit").val().replace(/,/g , "");
            var potongan1 = $("#txt_potongan1_edit").val().replace(/,/g , "");
            var hsl_diskon1 = $("#txt_hsl_diskon1_edit").val().replace(/,/g , "");
            var cn1 = $("#txt_cn1_edit").val();
            var merek1 = $("#txt_merek1_edit").val();

            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_marketing/main/modifyPesananDetail",
              dataType : "text",
              data : {
                      id_dp:id_dp1, kd_gudang:kd_gudang1, jumlah:jumlah1,
                      satuan:satuan1, harga:harga1, mata_uang:mata_uang1,
                      warna:warna1, dll:dll1, strip:strip1, kd_harga:kd_harga1,
                      omset_kg:omset_kg1, omset_lembar:omset_lembar1, potongan:potongan1,
                      hsl_diskon:hsl_diskon1, cn:cn1, merek:merek1
                    },
              success : function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  $("#edit-modal-pesanan-detail").modal("hide");
                  $("#notif-detail-pesanan").html("<div class='alert alert-success fade in' role='alert'><b>Pesanan Berhasil Diubah</b></div>");
                  $("#cmb_ukuran1_edit").val("");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2000);
                  $("#pesanan-detail-tbody-edit").load("<?php echo base_url(); ?>_marketing/main/getPesananDetails/"+no_order1);
                }else{
                  $("#edit-modal-pesanan-detail").modal("hide");
                  $("#notif-detail-pesanan").html("<div class='alert alert-danger fade in' role='alert'><b>Pesanan Gagal Diubah</b></div>");
                  //alert(response);
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2000);
                  $("#pesanan-detail-tbody-edit").load("<?php echo base_url(); ?>_marketing/main/getPesananDetails/"+no_order1);
                }
              }
            });
          });
//============ EDIT PESANAN DAN PESANAN DETAIL AJAX METHOD ============

          $('.date').datepicker({
              language: 'id',
              viewMode: 'years',
              format: 'yyyy-mm-dd',
              autoclose : true,
              todayHighlight : true
          });

          $('#data-customer').dataTable({
            // "fixedHeader" : true,
            "bProcessing" : true,
            "bServerSide" : true,
            "autoWidth": false,
            "responsive" : true,
            "sAjaxSource":"<?php echo base_url(); ?>_marketing/main/getCustomerListJson",
            "columns":[
              {"data":"kd_cust","name":"C.kd_cust"},
              {"data":"nm_perusahaan","name":"C.nm_perusahaan"},
              {"data":"nm_owner","name":"C.nm_owner"},
              {"data":"nm_purchasing","name":"C.nm_purchasing"},
              {"data":"tlp_kantor","name":"C.tlp_kantor"},
              {"data":"alamat","name":"C.alamat"},
              {"data":"kota","name":"C.kota"},
              {"data":"kode_pos","name":"C.kode_pos"},
              {"data":"action","name":"C.kd_cust"}
            ],
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "order": [[0, "desc"]],
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
              if(aData['status_customer'] == "TIDAK_AKTIF"){
                $("td",nRow).css("background-color","rgba(255, 0, 0, 0.7)");
              }
              $("td:eq(0)",nRow).html(aData["kd_cust"]+"<label class='text-blue'>["+aData["no_cust"]+"]</label>");
            }
          });

          $("#btn-closed-order").click(function(e){
            e.preventDefault();
            $('#data-order').dataTable().fnDestroy();
            $('#data-order').remove();
            $('#data-order-closed').removeAttr("style");
            $('#data-order-closed').css("font-size","12px");
            $('#data-order-closed').dataTable({
              // "fixedHeader" : true,
              "bProcessing" : true,
              "bServerSide" : true,
              "autoWidth": false,
              "sAjaxSource":"<?php echo base_url(); ?>_marketing/main/getClosedOrderListJson",
              "columns":[
                {"data":"no_order","name":"no_order"},
                {"data":"kd_order","name":"kd_order","sWidth":"35px"},
                {"data":"nm_perusahaan","name":"nm_perusahaan"},
                {"data":"nm_pemesan","name":"nm_pemesan"},
                {"data":"tgl_pesan","name":"tgl_pesan","sWidth":"35px"},
                {"data":"tgl_estimasi","name":"tgl_estimasi","sWidth":"35px"},
                {"data":"sts_pesanan","name":"sts_pesanan","sWidth":"35px"},
                {"data":"approve_1","name":"approve_1"},
                {"data":"approve_2","name":"approve_2"},
                {"data":"approve_3","name":"approve_3"},
                // {"data":"approve_4","name":"approve_4"},
                {"data":"approve_5","name":"approve_5"},
                {"data":"approve_6","name":"approve_6"},
                {"data":"action","name":"no_order"}
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
                        [0, "desc"]
                      ],
              "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                $(".print-out",nRow).attr("onclick","print_out('"+aData["no_order"]+"')");
                // $(".edit-pesanan",nRow).attr("href","<?php echo base_url().'_marketing/main/ubah_order/' ?>"+aData["no_order"]);
                if(aData["sts_pesanan"] != "OPEN" ){
                  // $(".trash-pesanan",nRow).attr({"disabled":"disabled","title":"Silahkan Konfirmasi Ke PPIC Terlebih Dahulu"});
                  $(".edit-pesanan",nRow).attr({"disabled":"disabled","title":"Silahkan Konfirmasi Ke PPIC Terlebih Dahulu"});
                }else{
                  // $(".trash-pesanan",nRow).attr("onclick","trashPesanan('"+aData["no_order"]+"')");
                  $(".edit-pesanan",nRow).attr("href","<?php echo base_url().'_marketing/main/ubah_order/' ?>"+aData["no_order"]);
                }
                if(aData["sts_pesanan"]=="FINISH" && (aData["tgl_kirim"] != "null" || aData["tgl_kirim"] != "")){
                  $('td', nRow).css('background-color', 'rgba(0, 226, 89, 0.6)');
                }else{

                }
                $("td:eq(0)",nRow).html("<a href='#' data-toggle='modal' data-target='#modal-lihat-detail-pesanan' onclick=lihatDetailPesanan('"+aData['no_order']+"')>"+aData['no_order']+"</a>");
                if(aData["approve_1"] == "FALSE"){
                  $("td:eq(7)",nRow).text("");
                }else{
                  $("td:eq(7)",nRow).html("<i class='fa fa-check'></i>");
                }
                if(aData["approve_2"] == "FALSE"){
                  $("td:eq(8)",nRow).text("");
                }else{
                  $("td:eq(8)",nRow).html("<i class='fa fa-check'></i>");
                }
                if(aData["approve_3"] == "FALSE"){
                  $("td:eq(9)",nRow).text("");
                }else{
                  $("td:eq(9)",nRow).html("<i class='fa fa-check'></i>");
                }
                if(aData["approve_5"] == "FALSE"){
                  $("td:eq(10)",nRow).text("");
                }else{
                  $("td:eq(10)",nRow).html("<i class='fa fa-check'></i>");
                }
                if(aData["approve_6"] == "FALSE"){
                  $("td:eq(11)",nRow).text("");
                }else{
                  $("td:eq(11)",nRow).html("<i class='fa fa-check'></i>");
                }
                // if(aData["approve_6"] == "FALSE"){
                //   $("td:eq(12)",nRow).text("");
                // }else{
                //   $("td:eq(12)",nRow).html("<i class='fa fa-check'></i>");
                // }
              }
            });
            $("#btn-closed-order").remove();
            $("#btn-wrapper").html("<a href='<?php echo base_url(); ?>_marketing/main/pantau_order' class='btn btn-flat btn-block btn-success'>Order Aktif</a>")
          });

          $("#data-statistik-customer").dataTable({
            // "fixedHeader" : true,
            "bProcessing" : true,
            "bServerSide" : true,
            "autoWidth" : false,
            "sAjaxSource" : "<?php echo base_url(); ?>_marketing/main/getStatistikCustomerGlobalJson",
            "columns" : [
              {"data":"kd_cust","name":"C.kd_cust"},
              {"data":"nm_perusahaan","name":"C.nm_perusahaan"},
              {"data":"KG","name":"C.nm_perusahaan_update"},
              {"data":"LEMBAR","name":"C.nm_perusahaan"},
              {"data":"BAL","name":"C.nm_perusahaan"},
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
                      [1, "ASC"]
                    ],
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              var index = iDisplayIndex+1;
              $("td:eq(0)",nRow).text(index);
              $("td:eq(2)",nRow).text(parseFloat(aData["KG"]).toLocaleString());
              $("td:eq(3)",nRow).text(parseFloat(aData["LEMBAR"]).toLocaleString());
              $("td:eq(4)",nRow).text(parseFloat(aData["BAL"]).toLocaleString());
              $("td:eq(1)",nRow).html("<a href='<?php echo base_url(); ?>_marketing/main/detail_statistik/"+aData["kd_cust"]+"'>"+aData["nm_perusahaan"]+"</a>");
            }
          });

          $('#data-order').dataTable({
            // "fixedHeader" : true,
            "bProcessing" : true,
            "bServerSide" : true,
            // "autoWidth": false,
            "bAutoWidth": true,
            "sPaginationType": "full_numbers",
            // "sScrollX" : "100%",
            "sAjaxSource":"<?php echo base_url(); ?>_marketing/main/getOrderListJson",
            "columns":[
              {"data":"no_order","name":"no_order"},
              {"data":"kd_order","name":"kd_order","sWidth":"35px"},
              {"data":"nm_perusahaan","name":"nm_perusahaan","sWidth":"150px"},
              {"data":"nm_pemesan","name":"nm_pemesan"},
              {"data":"nm_purchasing","name":"nm_purchasing","sWidth":"100px"},
              {"data":"tgl_pesan","name":"tgl_pesan","sWidth":"35px"},
              {"data":"tgl_estimasi","name":"tgl_estimasi","sWidth":"35px"},
              {"data":"sts_pesanan","name":"sts_pesanan","sWidth":"35px"},
              {"data":"approve_1","name":"approve_1"},
              {"data":"approve_2","name":"approve_2"},
              {"data":"approve_3","name":"approve_3"},
              // {"data":"approve_4","name":"approve_4"},
              {"data":"approve_5","name":"approve_5"},
              {"data":"approve_6","name":"approve_6"},
              {"data":"action","name":"no_order"}
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
            "order": [
                      [0, "desc"]
                    ],
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              $(".print-out",nRow).attr("onclick","print_out('"+aData["no_order"]+"')");
              $(".print-out-produksi",nRow).attr("onclick","print_out_produksi('"+aData["no_order"]+"')");
              if(aData["sts_pesanan"] != "OPEN" ){
                $(".trash-pesanan",nRow).attr({"disabled":"disabled","title":"Silahkan Konfirmasi Ke PPIC Terlebih Dahulu"});
                $(".edit-pesanan",nRow).attr({"disabled":"disabled","title":"Silahkan Konfirmasi Ke PPIC Terlebih Dahulu"});
              }else{
                $(".trash-pesanan",nRow).attr("onclick","trashPesanan('"+aData["no_order"]+"')");
                $(".edit-pesanan",nRow).attr("href","<?php echo base_url().'_marketing/main/ubah_order/' ?>"+aData["no_order"]);
              }
              $("td:eq(0)",nRow).html("<a href='#' data-toggle='modal' data-target='#modal-lihat-detail-pesanan' onclick=lihatDetailPesanan('"+aData['no_order']+"') class='bg-blue'>"+aData['no_order']+"</a>");
              var arrTglEstimasi = aData["tgl_estimasi"].split("-");
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
                $('td', nRow).css('background-color', 'rgba(237,234,0,0.6)');
                $('td:eq(13)', nRow).css('background-color', 'transparent');
              }else if(diffDays < 0){
                $('td', nRow).css('background-color', 'rgba(255,0,0,0.6)');
                $('td:eq(13)', nRow).css('background-color', 'transparent');
                $('td', nRow).css('color', '#FFF');
              }else{

              }

              if(aData["approve_1"] == "FALSE"){
                $("td:eq(8)",nRow).text("");
              }else{
                $("td:eq(8)",nRow).html("<i class='fa fa-check'></i>");
              }
              if(aData["approve_2"] == "FALSE"){
                $("td:eq(9)",nRow).text("");
              }else{
                $("td:eq(9)",nRow).html("<i class='fa fa-check'></i>");
              }
              if(aData["approve_3"] == "FALSE"){
                $("td:eq(10)",nRow).text("");
              }else{
                $("td:eq(10)",nRow).html("<i class='fa fa-check'></i>");
              }
              if(aData["approve_5"] == "FALSE"){
                $("td:eq(11)",nRow).text("");
              }else{
                $("td:eq(11)",nRow).html("<i class='fa fa-check'></i>");
              }
              if(aData["approve_6"] == "FALSE"){
                $("td:eq(12)",nRow).text("");
              }else{
                $("td:eq(12)",nRow).html("<i class='fa fa-check'></i>");
              }
              // if(aData["approve_6"] == "FALSE"){
              //   $("td:eq(13)",nRow).text("");
              // }else{
              //   $("td:eq(13)",nRow).html("<i class='fa fa-check'></i>");
              // }
            }
          });

          $("#table-global-stat").dataTable({
            // "fixedHeader" : true,
            "bProcessing" : true,
            "bServerSide" : true,
            "autoWidth" : false,
            "sAjaxSource" : "<?php echo base_url(); ?>_marketing/main/getDetailStatistikCustomerJson/<?php echo $this->uri->rsegment(3); ?>",
            "columns" : [
              {"data":"no_order","name":"PD.no_order","width" : "12%"},
              {"data":"tgl_pesan","name":"P.tgl_pesan","width" : "12%"},
              {"data":function(data, type,dataToSet){
                if(jQuery.trim(data.kd_gd_hasil) == "NULL" || jQuery.trim(data.kd_gd_hasil) == ""){
                  return data.kd_gd_bahan + " " + data.nm_barang;
                }else{
                  return data.kd_gd_hasil + " " + data.ukuran +" "+ data.merek + " " + " " + data.warna_plastik;
                }
              },"name" : 'GH.merek'},
              {"data":"omset_kg","name":"PD.omset_kg","width":"15%"},
              {"data":"omset_lembar","name":"PD.omset_lembar","width":"15%"},
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
                      [1, "ASC"]
                    ],
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              $("td:eq(3)",nRow).text(parseFloat(aData["omset_kg"]).toLocaleString());
            }
          });

          $.ajax({
            url:"<?php echo base_url(); ?>_marketing/main/getTotalTrash",
            dataType : "JSON",
            success : function(response){
              $("#count-trash").text(response);
            }
          });

          setInterval(function(){
            $.ajax({
              url:"<?php echo base_url(); ?>_marketing/main/getTotalTrash",
              dataType : "JSON",
              success : function(response){
                $("#count-trash").text(response);
              }
            });
          },60000);

          $("#modal-trash").on("shown.bs.modal",function(e){
            $("#table-trash").dataTable().fnDestroy();
            $("#table-trash").dataTable({
              // "fixedHeader" : true,
              "bProcessing" : true,
              "bServerSide" : true,
              "autoWidth" : false,
              "sAjaxSource" : "<?php echo base_url(); ?>_marketing/main/getPesananTrash",
              "columns" : [
                {"data":"no_order","name":"no_order"},
                {"data":"nm_pemesan","name":"nm_pemesan"},
                {"data":"diperbarui","name":"diperbarui"},
                {"data":"no_order","name":"no_order"}
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
                        [2, "DESC"]
                      ],
              "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                $("td:eq(3)",nRow).html('<button class="btn btn-flat btn-sm btn-success btn-restore" onclick="restorePesananTrash()" data-id="'+aData['no_order']+'">Pulihkan</button>');
              }
            });
          });

//======================================== Graphing (Start) ================================
          $("#btn-lihat-stat").click(function(e){
            e.preventDefault();
            var pilihan = $("#cmb_pilihan_statistik").val();
            var tgl_awal = $("#txt_tgl_mulai").val();
            var tgl_akhir = $("#txt_tgl_akhir").val();
            if(pilihan == "#" || tgl_awal == "" || tgl_akhir == ""){
              alert("Pilihan Dan Tanggal Tidak Boleh Kosong!");
            }else{
              if(pilihan == "L-Stat-Bulanan"){
                $('#table-global-stat_wrapper').hide();
                $(".nav-tabs-custom").removeAttr("style");
              }else if(pilihan == "L-Stat-Tanggal"){
                $('#table-global-stat_wrapper').hide();
                $(".nav-tabs-custom").removeAttr("style");
              }else if(pilihan == "R_Trans"){
                $('#table-global-stat').dataTable().fnDestroy();
                $(".nav-tabs-custom").css("display","none");
                $("#table-global-stat").dataTable({
                  // "fixedHeader" : true,
                  "bProcessing" : true,
                  "bServerSide" : true,
                  "autoWidth" : false,
                  "sAjaxSource" : "<?php echo base_url(); ?>_marketing/main/getDetailStatistikCustomerJson/<?php echo $this->uri->rsegment(3); ?>?tgl_awal="+tgl_awal+"&tgl_akhir="+tgl_akhir,
                  "columns" : [
                    {"data":"no_order","name":"PD.no_order","width" : "12%"},
                    {"data":"tgl_pesan","name":"P.tgl_pesan","width" : "12%"},
                    {"data":function(data, type,dataToSet){
                      if(jQuery.trim(data.kd_gd_hasil) == "NULL" || jQuery.trim(data.kd_gd_hasil) == ""){
                        return data.kd_gd_bahan + " " + data.nm_barang;
                      }else{
                        return data.kd_gd_hasil + " " + data.ukuran +" "+ data.merek + " " + " " + data.warna_plastik;
                      }
                    },"name" : 'GH.merek'},
                    {"data":"omset_kg","name":"PD.omset_kg","width":"15%"},
                    {"data":"omset_lembar","name":"PD.omset_lembar","width":"15%"},
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
                            [1, "ASC"]
                          ],
                  "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {

                  }
                });
              }else{

              }
            }
          });

          $("#btn-chart-kg").click(function(e){
            e.preventDefault();
            var kd_cust1 = "<?php echo $this->uri->rsegment(3); ?>";
            var pilihan = $("#cmb_pilihan_statistik").val();
            var url1 = "";
            if(pilihan == "L-Stat-Bulanan"){
              url1 = "<?php echo base_url(); ?>_marketing/main/getChartDataOrderKg";
            }else if(pilihan == "L-Stat-Tanggal"){
              url1 = "<?php echo base_url(); ?>_marketing/main/getChartDataOrderKgPerTanggal";
            }else{
              url1 = "";
            }
            var tgl_mulai1 = $("#txt_tgl_mulai").val();
            var tgl_akhir1 = $("#txt_tgl_akhir").val();
            if(tgl_mulai1 == "" && tgl_akhir1==""){
              alert("Tanggal Awal dan Akhir Tidak Boleh Kosong!");
            }else{
              $.ajax({
                type : "POST",
                url : url1,
                dataType : "JSON",
                data : {kd_cust:kd_cust1,tgl_awal:tgl_mulai1,tgl_akhir:tgl_akhir1},
                success : function(response){
                  var Bulan = response.Bulan;
                  var Jumlah = response.Jumlah.map(Number);

                  var ctx = $("#kg-bar-chart").get(0).getContext('2d');
                  var chart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels: Bulan,
                          datasets: [
                          {
                              label: "Kg",
                              backgroundColor: 'rgb(0, 255, 106)',
                              borderColor: 'rgb(0, 255, 106)',
                              data: Jumlah,
                          }
                          ]
                      },


                      // Configuration options go here
                      options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                      }
                  });

                }
              });
            }
          });

          $("#btn-chart-lembar").click(function(e){
            e.preventDefault();
            var kd_cust1 = "<?php echo $this->uri->rsegment(3); ?>";
            var pilihan = $("#cmb_pilihan_statistik").val();
            var url1 = "";
            if(pilihan == "L-Stat-Bulanan"){
              url1 = "<?php echo base_url(); ?>_marketing/main/getChartDataOrderLembar";
            }else if(pilihan == "L-Stat-Tanggal"){
              url1 = "<?php echo base_url(); ?>_marketing/main/getChartDataOrderLembarPerTanggal";
            }else{
              url1 = "";
            }
            var tgl_mulai1 = $("#txt_tgl_mulai").val();
            var tgl_akhir1 = $("#txt_tgl_akhir").val();
            if(tgl_mulai1 == "" && tgl_akhir1==""){
              alert("Tanggal Awal dan Akhir Tidak Boleh Kosong!");
            }else{
              $.ajax({
                type : "POST",
                url : url1,
                dataType : "JSON",
                data : {kd_cust:kd_cust1,tgl_awal:tgl_mulai1,tgl_akhir:tgl_akhir1},
                success : function(response){
                  var Bulan = response.Bulan;
                  var Jumlah = response.Jumlah.map(Number);

                  var ctx = $("#lembar-bar-chart").get(0).getContext('2d');
                  var chart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels: Bulan,
                          datasets: [
                          {
                              label: "Lembar",
                              backgroundColor: 'rgb(0, 255, 106)',
                              borderColor: 'rgb(0, 255, 106)',
                              data: Jumlah,
                          }
                          ]
                      },


                      // Configuration options go here
                      options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                      }
                  });

                }
              });
            }
          });

          $("#btn-chart-bal").click(function(e){
            e.preventDefault();
            var kd_cust1 = "<?php echo $this->uri->rsegment(3); ?>";
            var tgl_mulai1 = $("#txt_tgl_mulai").val();
            var tgl_akhir1 = $("#txt_tgl_akhir").val();
            var pilihan = $("#cmb_pilihan_statistik").val();
            var url1 = "";
            if(pilihan == "L-Stat-Bulanan"){
              url1 = "<?php echo base_url(); ?>_marketing/main/getChartDataOrderBal";
            }else if(pilihan == "L-Stat-Tanggal"){
              url1 = "<?php echo base_url(); ?>_marketing/main/getChartDataOrderBalPerTanggal";
            }else{
              url1 = "";
            }
            if(tgl_mulai1 == "" && tgl_akhir1==""){
              alert("Tanggal Awal dan Akhir Tidak Boleh Kosong!");
            }else{
              $.ajax({
                type : "POST",
                url : url1,
                dataType : "JSON",
                data : {kd_cust:kd_cust1,tgl_awal:tgl_mulai1,tgl_akhir:tgl_akhir1},
                success : function(response){
                  var Bulan = response.Bulan;
                  var Jumlah = response.Jumlah.map(Number);

                  var ctx = $("#bal-bar-chart").get(0).getContext('2d');
                  var chart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels: Bulan,
                          datasets: [
                          {
                              label: "BAL",
                              backgroundColor: 'rgb(0, 255, 106)',
                              borderColor: 'rgb(0, 255, 106)',
                              data: Jumlah,
                          }
                          ]
                      },


                      // Configuration options go here
                      options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                      }
                  });
                }
              });
            }
          });

          $("#btn-chart-kaleng").click(function(e){
            e.preventDefault();
            var kd_cust1 = "<?php echo $this->uri->rsegment(3); ?>";
            var tgl_mulai1 = $("#txt_tgl_mulai").val();
            var tgl_akhir1 = $("#txt_tgl_akhir").val();
            var pilihan = $("#cmb_pilihan_statistik").val();
            var url1 = "";
            if(pilihan == "L-Stat-Bulanan"){
              url1 = "<?php echo base_url(); ?>_marketing/main/getChartDataOrderKaleng";
            }else if(pilihan == "L-Stat-Tanggal"){
              url1 = "<?php echo base_url(); ?>_marketing/main/getChartDataOrderKalengPerTanggal";
            }else{
              url1 = "";
            }
            if(tgl_mulai1 == "" && tgl_akhir1==""){
              alert("Tanggal Awal dan Akhir Tidak Boleh Kosong!");
            }else{
              $.ajax({
                type : "POST",
                url : url1,
                dataType : "JSON",
                data : {kd_cust:kd_cust1,tgl_awal:tgl_mulai1,tgl_akhir:tgl_akhir1},
                success : function(response){
                  var Bulan = response.Bulan;
                  var Jumlah = response.Jumlah.map(Number);

                  var ctx = $("#kaleng-bar-chart").get(0).getContext('2d');
                  var chart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels: Bulan,
                          datasets: [
                          {
                              label: "Kaleng",
                              backgroundColor: 'rgb(0, 255, 106)',
                              borderColor: 'rgb(0, 255, 106)',
                              data: Jumlah,
                          }
                          ]
                      },


                      // Configuration options go here
                      options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                      }
                  });
                }
              });
            }
          });

          $("#btn-chart-omset-kg").click(function(e){
            e.preventDefault();
            var kd_cust1 = "<?php echo $this->uri->rsegment(3); ?>";
            var tgl_mulai1 = $("#txt_tgl_mulai").val();
            var tgl_akhir1 = $("#txt_tgl_akhir").val();
            var pilihan = $("#cmb_pilihan_statistik").val();
            var url1 = "";
            if(pilihan == "L-Stat-Bulanan"){
              url1 = "<?php echo base_url(); ?>_marketing/main/getChartDataOmsetOrderKg";
            }else if(pilihan == "L-Stat-Tanggal"){
              url1 = "<?php echo base_url(); ?>_marketing/main/getChartDataOmsetOrderKgPerTanggal";
            }else{
              url1 = "";
            }
            if(tgl_mulai1 == "" && tgl_akhir1==""){
              alert("Tanggal Awal dan Akhir Tidak Boleh Kosong!");
            }else{
              $.ajax({
                type : "POST",
                url : url1,
                dataType : "JSON",
                data : {kd_cust:kd_cust1,tgl_awal:tgl_mulai1,tgl_akhir:tgl_akhir1},
                success : function(response){
                  var Bulan = response.Bulan;
                  var Jumlah = response.Jumlah.map(Number);

                  var ctx = $("#omset-kg-line-chart").get(0).getContext('2d');
                  var chart = new Chart(ctx, {
                      type: 'line',
                      data: {
                          labels: Bulan,
                          datasets: [
                          {
                              label: "Omset Kg",
                              backgroundColor: 'rgba(255, 255, 255, 0)',
                              borderColor: 'rgb(0, 255, 106)',
                              data: Jumlah,
                          }
                          ]
                      },


                      // Configuration options go here
                      options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                      }
                  });

                }
              });
            }
          });

          $("#btn-chart-omset-lembar").click(function(e){
            e.preventDefault();
            var kd_cust1 = "<?php echo $this->uri->rsegment(3); ?>";
            var tgl_mulai1 = $("#txt_tgl_mulai").val();
            var tgl_akhir1 = $("#txt_tgl_akhir").val();
            var pilihan = $("#cmb_pilihan_statistik").val();
            var url1 = "";
            if(pilihan == "L-Stat-Bulanan"){
              url1 = "<?php echo base_url(); ?>_marketing/main/getChartDataOmsetOrderLembar";
            }else if(pilihan == "L-Stat-Tanggal"){
              url1 = "<?php echo base_url(); ?>_marketing/main/getChartDataOmsetOrderLembarPerTanggal";
            }else{
              url1 = "";
            }
            if(tgl_mulai1 == "" && tgl_akhir1==""){
              alert("Tanggal Awal dan Akhir Tidak Boleh Kosong!");
            }else{
              $.ajax({
                type : "POST",
                url : url1,
                dataType : "JSON",
                data : {kd_cust:kd_cust1,tgl_awal:tgl_mulai1,tgl_akhir:tgl_akhir1},
                success : function(response){
                  var Bulan = response.Bulan;
                  var Jumlah = response.Jumlah.map(Number);

                  var ctx = $("#omset-lembar-line-chart").get(0).getContext('2d');
                  var chart = new Chart(ctx, {
                      type: 'line',
                      data: {
                          labels: Bulan,
                          datasets: [
                          {
                              label: "Omset Lembar",
                              backgroundColor: 'rgba(255, 255, 255, 0)',
                              borderColor: 'rgb(0, 255, 106)',
                              data: Jumlah,
                          }
                          ]
                      },


                      // Configuration options go here
                      options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                      }
                  });
                }
              });
            }
          });
//======================================== Graphing (End) ================================
        });//Tutup $(function(){}); yang pertama
          // $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          //   checkboxClass: 'icheckbox_flat-green',
          //   radioClass: 'iradio_flat-green'
          // });
          CKEDITOR.config.toolbar = [
                                     ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                     ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print']
                                    ];
          if($("#txt_note").length > 0 || $("#txt_note_edit").length > 0 ){
            CKEDITOR.replace("txt_note",{height:120});
            CKEDITOR.replace("txt_note_edit",{height:120});
          }
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

        function showImage(param){
          var url = $(param).attr("src");
          $("#imageShow").attr("src",url);
        }

        function deleteImageProductService(param){
          if(confirm("Apakah Anda Yakin Ingin menghapus Gambar Ini?")){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_marketing/main/removeImageProductService'); ?>",
              dataType : "TEXT",
              data : {
                id : param
              },
              success : function(response){
                if($.trim(response) === "Berhasil"){
                  $("#modal-notif").addClass("modal-info");
                  $("#modalNotifContent").text("Gambar Berhasil Dihapus");
                  $("#modal-notif").modal("show");
                  setTimeout(function(){
                    $("#modal-notif").modal("hide");
                    $("#modal-notif").removeClass("modal-info");
                    $("#modalNotifContent").text("");
                    location.reload();
                  },2000);
                }else{
                  $("#modal-notif").addClass("modal-danger");
                  $("#modalNotifContent").text("Gambar Gagal Dihapus");
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

        function verifikasiPassowordLama(param){
          setTimeout(function(){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_marketing/main/getVerifikasiPasswordLama'); ?>",
              dataType : "TEXT",
              data : {passwordLama:param.value},
              success : function(response){
                if($.trim(response) === "TRUE"){
                  $("#indikatorPasswordLama").removeClass("has-error").addClass("has-success");
                  $("#iconIndikatorPasswordLama").removeClass("fa-remove").addClass("fa-check");
                  $("#indikatorPasswordLama").css({"float":"left","display":"block"});
                }else if($.trim(response) === "FALSE"){
                  $("#indikatorPasswordLama").removeClass("has-success").addClass("has-error");
                  $("#iconIndikatorPasswordLama").removeClass("fa-check").addClass("fa-remove");
                  $("#indikatorPasswordLama").css({"float":"left","display":"block"});
                }else{
                  $("#indikatorPasswordLama").css({"float":"left","display":"none"});
                }
              },
              error : function(response){
                alert("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
              }
            });
          },1000);
        }

        function konfirmasiPassword(param){
          setTimeout(function(){
            var passwordBaru = $("#txtNewPass").val();
            if(param.value == passwordBaru){
              $("#indikatorKonfirmasiPassword").removeClass("has-error").addClass("has-success");
              $("#iconIndikatorKonfirmasiPassword").removeClass("fa-remove").addClass("fa-check");
              $("#indikatorKonfirmasiPassword").css({"float":"left","display":"block"});
            }else{
              $("#indikatorKonfirmasiPassword").removeClass("has-success").addClass("has-error");
              $("#iconIndikatorKonfirmasiPassword").removeClass("fa-check").addClass("fa-remove");
              $("#indikatorKonfirmasiPassword").css({"float":"left","display":"block"});
            }
          },1000);
        }

        function changePassword(){
          var passwordBaru = $("#txtNewPass").val();
          var konfirmasiPasswordBaru = $("#txtConfirmPass").val();
          if(passwordBaru == "" || konfirmasiPasswordBaru == ""){
            alert("Kolom Kata Sandi Baru Dan Konfirmasi Kata Sandi Tidak Boleh Kosong!");
          }else{
            if(konfirmasiPasswordBaru == passwordBaru){
              $.ajax({
                type : "POST",
                url : "<?php echo base_url('_marketing/main/changePassword'); ?>",
                dataType : "TEXT",
                data : {
                  passwordBaru : passwordBaru
                },
                success : function(response){
                  if($.trim(response) === "Berhasil"){
                    $("#alertChangePass").removeClass("alert-danger").addClass("alert-success").text("Kata Sandi Berhasil Diubah").css("display","block");
                    setTimeout(function(){
                      $("#alertChangePass").css("display","block");
                    },2000);
                    setTimeout(function(){
                      window.location = "<?php echo base_url('_main/main/logout'); ?>";
                    },1000);
                  }else{
                    $("#alertChangePass").removeClass("alert-success").addClass("alert-danger").text("Kata Sandi Gagal Diubah").css("display","block");
                    setTimeout(function(){
                      $("#alertChangePass").css("display","block");
                    },2000);
                    setTimeout(function(){
                      window.location = "<?php echo base_url('_main/main/logout'); ?>";
                    },1000);
                  }
                }
              });
            }else{

            }
          }
        }
      </script>
<!--===============================================On Load External Modal Function (Finish) ===============================================-->

<!--===============================================General Function (Start) ===============================================-->
      <script>
        function showModalNoteProductServiceJson(id){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_marketing/main/show_product_service_note_json/",
            dataType : "JSON",
            data : {id_sp : id},
            success : function(response){
              $("#json-wrapper").html(response[0].note);
            }
          });
        }

        function removePaymentCustom(){
          var id = $("#close").data("id");
          var idSelector = "#"+$("#close").data("id");
          $(idSelector).remove();
          $("#close").remove();
          $("#payment-wrapper").html(
          '<select class="form-control" name="cmb-payment" onchange="changePaymentCustom(this)" id="'+id+'" required style="width: 180px; float:left; margin-right:5px;">'+
            '<option value="">--Pilih Term Payment--</option>'+
            '<option value="Cash 2%">Cash 2%</option>'+
            '<option value="Cash 3%">Cash 3%</option>'+
            '<option value="Cash 4%">Cash 4%</option>'+
            '<option value="Cash 5%">Cash 5%</option>'+
            '<option value="Cash TD">Cash TD</option>'+
            '<option value="COD">COD</option>'+
            '<option value="COD + Cash 2%">COD + Cash 2%</option>'+
            '<option value="Disc 2% Tdk Tercantum">Disc 2% Tdk Tercantum</option>'+
            '<option value="Disc 2% Tdk Tercantum + KU dulu">Disc 2% Tdk Tercantum + KU dulu</option>'+
            '<option value="Disc 2% Tercantum">Disc 2% Tercantum</option>'+
            '<option value="Disc 2% Tercantum + KU dulu">Disc 2% Tercantum + KU dulu</option>'+
            '<option value="Disc 3% Tdk Tercantum">Disc 3% Tdk Tercantum</option>'+
            '<option value="Disc 3% Tdk Tercantum + KU dulu">Disc 3% Tdk Tercantum + KU dulu</option>'+
            '<option value="Disc 3% Tercantum">Disc 3% Tercantum</option>'+
            '<option value="Disc 3% Tercantum + KU dulu">Disc 3% Tercantum + KU dulu</option>'+
            '<option value="DP">DP</option>'+
            '<option value="DP + KU DULU">DP + KU DULU</option>'+
            '<option value="KU Dulu">KU Dulu</option>'+
            '<option value="Potong 1000">Potong 1000</option>'+
            '<option value="Potong 500">Potong 500</option>'+
            '<option value="Tempo 1 Bulan">Tempo 1 Bulan</option>'+
            '<option value="Tempo 14 Hari">Tempo 14 Hari</option>'+
            '<option value="Tempo 2 Minggu">Tempo 2 Minggu</option>'+
            '<option value="Tempo 40 Hari">Tempo 40 Hari</option>'+
            '<option value="Tempo 7 Hari">Tempo 7 Hari</option>'+
            '<option value="Custom">Custom</option>'+
          '</select>');
        }

        function changePaymentCustom(e){
          if(e.value == "Custom"){
            $("#"+e.id).remove();
            $("#payment-wrapper").html(
              '<div class="input-group" style="width: 200px; float:left; margin-right:5px;">'+
              '<input type="text" class="form-control" name="cmb-payment" id="'+e.id+'" style="width: 180px; float:left;">'+
              '<button type="button" class="close" id="close" aria-label="Close" data-id="'+e.id+'" onclick="removePaymentCustom()" style="margin-right:5px">'+
              '<span aria-hidden="true">&times;</span></button>'+
              '</div>'
            );
          }
        }

        function lihatDetailPesanan(param){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_marketing/main/getLihatPesanan",
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
                "sAjaxSource" : "<?php echo base_url(); ?>_marketing/main/getLihatPesananDetail?no_order="+param,
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

        function showModalEditPesananDetailTemp(id){
          var id_dp = id;
          $("#txt_harga1").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_omset_kg1").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_omset_lembar1").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_jumlah1").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_potongan1").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_hsl_diskon1").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#cmb_ukuran1").select2({
            placeholder : "Pilih Ukuran",
            dropdownParent: $('#edit-modal-pesanan-detail-temp'),
            width : "100%",
            allowClear : true,
            ajax:{
              url : "<?php echo base_url() ?>_marketing/main/getGudangHasilLike",
              dataType : "json",
              delay : 250,
              processResults: function(data){
                return{
                  results : $.map(data, function(item){
                    if(item.jenis == "MINYAK" || item.jenis == "CAT MURNI"){
                      return{
                        text:item.nm_barang +" - "+ item.warna +" - "+ item.status +" - "+ item.jenis,
                        id:item.kd_gd_bahan
                      }
                    }else{
                      return{
                        text:item.ukuran +" - "+ item.warna_plastik +" - "+ item.tebal +" - "+ item.merek +" - "+ item.jns_permintaan +" - "+ item.jns_brg,
                        id:item.kd_gd_hasil
                      }
                    }
                  })
                };
              },
              cache : true

            }
          });
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_marketing/main/getModifyPesananDetailTempModal",
            dataType : "JSON",
            data : {id_dp : id_dp},
            success : function(response){
              $("#txt_jumlah1").val(response[0].jumlah);
              $("#cmb_satuan1").val(response[0].satuan);
              $("#txt_harga1").val(response[0].harga);
              if(response[0].mata_uang == "Rp."){
                 $('#rb_1').iCheck('check');
                 $('#rb_1').attr("checked","checked");
              }else{
                $('#rb_2').iCheck('check');
                $('#rb_2').attr("checked","checked");
              }
              $("#id_dp").val(response[0].id_dp);
              $("#txt_warna_cetak1").val(response[0].warna_cetak);
              $("#txt_dll1").val(response[0].dll);
              $("#txt_strip1").val(response[0].sm);
              $("#txt_kd_hrg1").val(response[0].kd_hrg);
              $("#txt_omset_kg1").val(response[0].omset_kg);
              $("#txt_omset_lembar1").val(response[0].omset_lembar);
              $("#txt_potongan1").val(response[0].potongan);
              $("#txt_hsl_diskon1").val(response[0].diskon);
              $("#txt_cn1").val(response[0].cn);
              $("#txt_merek1").val(response[0].merek);
            }
          });
        }

        function showModalEditPesananDetail(id){
          var id_dp = id;
          $("#txt_harga1_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_omset_kg1_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_omset_lembar1_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_jumlah1_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_potongan1_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $("#txt_hsl_diskon1_edit").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_marketing/main/getModifyPesananDetailModal",
            dataType : "JSON",
            data : {id_dp : id_dp},
            success : function(response){
              $("#cmb_ukuran1_edit").select2({
                placeholder : "Pilih Ukuran",
                dropdownParent: $('#edit-modal-pesanan-detail'),
                width : "100%",
                allowClear : true,
                ajax:{
                  url : "<?php echo base_url() ?>_marketing/main/getGudangHasilLike",
                  dataType : "json",
                  delay : 250,
                  processResults: function(data){
                    return{
                      results : $.map(data, function(item){
                        if(item.jenis == "MINYAK" || item.jenis == "CAT MURNI"){
                          return{
                            text:item.nm_barang +" - "+ item.warna +" - "+ item.status +" - "+ item.jenis,
                            id:item.kd_gd_bahan
                          }
                        }else{
                          return{
                            text:item.ukuran +" - "+ item.warna_plastik +" - "+ item.tebal +" - "+ item.merek +" - "+ item.jns_permintaan +" - "+ item.jns_brg,
                            id:item.kd_gd_hasil
                          }
                        }
                      })
                    };
                  }
                },
                cache : true,
              });
              $("#txt_jumlah1_edit").val(response[0].jumlah);
              $("#cmb_satuan1_edit").val(response[0].satuan);
              $("#txt_harga1_edit").val(response[0].harga);
              if(response[0].mata_uang == "Rp."){
                 $('#rb_1_edit').iCheck('check');
                 $('#rb_1_edit').attr("checked","checked");
              }else{
                $('#rb_2_edit').iCheck('check');
                $('#rb_2_edit').attr("checked","checked");
              }
              $("#id_dp_edit").val(response[0].id_dp);
              $("#txt_warna_cetak1_edit").val(response[0].warna_cetak);
              $("#txt_dll1_edit").val(response[0].dll);
              $("#txt_strip1_edit").val(response[0].sm);
              $("#txt_kd_hrg1_edit").val(response[0].kd_hrg);
              $("#txt_omset_kg1_edit").val(response[0].omset_kg);
              $("#txt_omset_lembar1_edit").val(response[0].omset_lembar);
              $("#txt_potongan1_edit").val(response[0].potongan);
              $("#txt_hsl_diskon1_edit").val(response[0].diskon);
              $("#txt_cn1_edit").val(response[0].cn);
              $("#txt_merek1_edit").val(response[0].merek);
            }
          });
        }

        function jnsCust(){
          var jenis = document.getElementById('jenis').value;
          var kd_cust = document.getElementById('txt_no_cust').value;
          var hasil = kd_cust+jenis;
          if(kd_cust.substring(12,14)=="XX"){
            document.getElementById('txt_no_cust').value=kd_cust.replace("XX",jenis);
          }else{
            document.getElementById('txt_no_cust').value=kd_cust.replace(kd_cust.substring(12,14),jenis);
          }
        }

        function deleteProductService(id){
          if (confirm("Yakin Ingin Menghapus?")) {
            var id = id;
            var kd_cust = "<?php echo $this->uri->rsegment(3); ?>";
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_marketing/main/removeProductService",
              dataType : "text",
              data : {id_sp : id, kd_cust : kd_cust},
              success : function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  alert("Data Berhasil Dihapus");
                  location.reload();
                }else{
                  alert("Data Gagal Dihapus");
                  location.reload();
                }
              }
            });
          }else{
            alert(id + "Tidak Terhapus");
            location.reload();
          }
        }

        function discount(h,pM,hsl){
          var HtmlHarga = "#"+h.id;
          var HtmlPm = "#"+pM;
          var HtmlHsl = "#"+hsl;
          var harga_item = $(HtmlHarga).val().replace(/,/g , "");
          var payment_method = $(HtmlPm).val();
          if(payment_method == ""){
            alert("Pilih Term Payment Terlebih Dahulu");
          }else{
            switch (payment_method) {
              case 'Cash 2%': $(HtmlHsl).val(0.02 * harga_item);break;
              case 'Cash 3%': $(HtmlHsl).val(0.03 * harga_item);break;
              case 'Cash 4%': $(HtmlHsl).val(0.04 * harga_item);break;
              case 'Cash 5%': $(HtmlHsl).val(0.05 * harga_item);break;
              case 'COD + Cash 2%': $(HtmlHsl).val(0.02 * harga_item);break;
              case 'Disc 2% Tdk Tercantum': $(HtmlHsl).val(0.02 * harga_item);break;
              case 'Disc 2% Tdk Tercantum + KU dulu': $(HtmlHsl).val(0.02 * harga_item);break;
              case 'Disc 2% Tercantum': $(HtmlHsl).val(0.02 * harga_item);break;
              case 'Disc 2% Tercantum + KU dulu': $(HtmlHsl).val(0.02 * harga_item);break;
              case 'Disc 3% Tdk Tercantum': $(HtmlHsl).val(0.03 * harga_item);break;
              case 'Disc 3% Tdk Tercantum + KU dulu': $(HtmlHsl).val(0.03 * harga_item);break;
              case 'Disc 3% Tercantum': $(HtmlHsl).val(0.03 * harga_item);break;
              case 'Disc 3% Tercantum + KU dulu': $(HtmlHsl).val(0.03 * harga_item);break;
              break;
              default:
            }
          }
        }

        function deletePesananDetailTemp(id){
          var no_order1 = $("#txt_no_order").val();
          var kd_cust = $("#txt_kd_cust").val();
          if (confirm("Yakin Ingin Menghapus?")) {
            var id = id;
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_marketing/main/removePesananDetailTemp",
              dataType : "text",
              data : {id : id},
              success : function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  $("#notif-detail-pesanan").html("<div class='alert alert-info fade in' role='alert'><b>Item Pesanan Berhasil Dihapus</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2500);
                  $("#pesanan-detail-tbody").load("<?php echo base_url(); ?>_marketing/main/getPesananDetailsTemp/"+no_order1+"/"+kd_cust);
                }else{
                  $("#notif-detail-pesanan").html("<div class='alert alert-danger fade in' role='alert'><b>Item Pesanan Gagal Dihapus</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2500);
                  $("#pesanan-detail-tbody").load("<?php echo base_url(); ?>_marketing/main/getPesananDetailsTemp/"+no_order1+"/"+kd_cust);
                }
              }
            });
          }else{
            $("#notif-detail-pesanan").html("<div class='alert alert-info fade in' role='alert'><b>Item Pesanan Tidak Jadi Dihapus</b></div>");
            setTimeout(function(){
              $(".alert").alert("close");
            },2500);
            $("#pesanan-detail-tbody").load("<?php echo base_url(); ?>_marketing/main/getPesananDetailsTemp/"+no_order1+"/"+kd_cust);
          }
        }

        function deletePesananDetail(id){
          var no_order1 = $("#txt_no_order_edit").val();
          if (confirm("Yakin Ingin Menghapus?")) {
            var id = id;
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_marketing/main/removePesananDetail",
              dataType : "text",
              data : {id : id},
              success : function(response){
                if(jQuery.trim(response) === "Berhasil"){
                  $("#notif-detail-pesanan").html("<div class='alert alert-info fade in' role='alert'><b>Item Pesanan Berhasil Dihapus</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2500);
                  $("#pesanan-detail-tbody-edit").load("<?php echo base_url(); ?>_marketing/main/getPesananDetails/" + no_order1);
                }else{
                  $("#notif-detail-pesanan").html("<div class='alert alert-danger fade in' role='alert'><b>Item Pesanan Gagal Dihapus</b></div>");
                  setTimeout(function(){
                    $(".alert").alert("close");
                  },2500);
                  $("#pesanan-detail-tbody-edit").load("<?php echo base_url(); ?>_marketing/main/getPesananDetails/" + no_order1);
                }
              }
            });
          }else{
            $("#notif-detail-pesanan").html("<div class='alert alert-info fade in' role='alert'><b>Item Pesanan Tidak Jadi Dihapus</b></div>");
            setTimeout(function(){
              $(".alert").alert("close");
            },2500);
            $("#pesanan-detail-tbody-edit").load("<?php echo base_url(); ?>_marketing/main/getPesananDetails/" + no_order1);
          }
        }

        function trashPesanan(id){
          if(confirm("Apakah Pesanan Ini Akan Dihapus?")){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_marketing/main/trashPesanan",
              dataType : "text",
              data : {id:id},
              success:function(response){
                if(jQuery.trim(response)==="Delete Berhasil"){
                  alert("Pesanan Terhapus");
                  location.reload();
                }else if(jQuery.trim(response)==="Gagal Delete Item Pesanan"){
                  alert("Gagal Delete Item Pesanan");
                  location.reload();
                }else{
                  alert("Gagal Delete Pesanan");
                  location.reload();
                }
              }
            });
          }else{
            location.reload();
          }
        }

        function restorePesananTrash(){
          var id = $(".btn-restore").data("id");
          if(confirm("Apakah pesanan ini akan dipulihkan?")){
            $.ajax({
              type : "POST",
              url : "<?php echo base_url(); ?>_marketing/main/updatePulihkanPesananTrash",
              dataType : "text",
              data : {no_order:id},
              success : function(response){
                if(jQuery.trim(response) === "Pesanan Berhasil Dipulihkan"){
                  $("#table-trash").dataTable().fnDestroy();
                  $("#table-trash").dataTable({
                    // "fixedHeader" : true,
                    "bProcessing" : true,
                    "bServerSide" : true,
                    "autoWidth" : false,
                    "sAjaxSource" : "<?php echo base_url(); ?>_marketing/main/getPesananTrash",
                    "columns" : [
                      {"data":"no_order","name":"no_order"},
                      {"data":"nm_pemesan","name":"nm_pemesan"},
                      {"data":"diperbarui","name":"diperbarui"},
                      {"data":"no_order","name":"no_order"}
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
                              [2, "DESC"]
                            ],
                    "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                      $("td:eq(3)",nRow).html('<button class="btn btn-flat btn-sm btn-success btn-restore" onclick="restorePesananTrash()" data-id="'+aData['no_order']+'">Pulihkan</button>');
                    }
                  });
                }else{
                  $("#table-trash").dataTable().fnDestroy();
                  $("#table-trash").dataTable({
                    // "fixedHeader" : true,
                    "bProcessing" : true,
                    "bServerSide" : true,
                    "autoWidth" : false,
                    "sAjaxSource" : "<?php echo base_url(); ?>_marketing/main/getPesananTrash",
                    "columns" : [
                      {"data":"no_order","name":"no_order"},
                      {"data":"nm_pemesan","name":"nm_pemesan"},
                      {"data":"diperbarui","name":"diperbarui"},
                      {"data":"no_order","name":"no_order"}
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
                              [2, "DESC"]
                            ],
                    "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                      $("td:eq(3)",nRow).html('<button class="btn btn-flat btn-sm btn-success btn-restore" onclick="restorePesananTrash()" data-id="'+aData['no_order']+'">Pulihkan</button>');
                    }
                  });
                }
              }
            });
          }
        }

        function print_out(no_order){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_marketing/main/getCheckApproveUserNoOrder",
            dataType : "JSON",
            data : {no_order : no_order},
            success : function(response){
              if(response.Approved== "TRUE"){
                $("#btn-approve").attr("disabled","disabled");
              }else{
                $("#btn-approve").removeAttr("disabled");
                $("#btn-approve").attr("onclick","approve_print_out('"+no_order+"')");
              }
              $("#btn-note").attr("href","<?php echo base_url(); ?>_marketing/main/show_customer_note/"+response.Kd_cust);
              $("#btn-produk-servis").attr("onclick","showProductServiceModal('"+response.Kd_cust+"')");
              $("#btnShowHistory").attr("onclick","showHistoryOrder('"+response.Kd_cust+"')");
            }
          });
          $("#cetakFakturLoad").removeAttr("src");
          $("#cetakFakturLoad").attr("src","<?php echo base_url(); ?>_marketing/main/cetakFakturPesanan/"+no_order);
        }

        function print_out_produksi(no_order){
          $("#cetakFakturLoad").removeAttr("src");
          $("#cetakFakturLoad").attr("src","<?php echo base_url(); ?>_marketing/main/cetakFakturPesananProduksi/"+no_order);
        }

        function approve_print_out(no_order){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_marketing/main/saveApproveUserNoOrder",
            dataType : "text",
            data : {no_order : no_order},
            success : function(response){
              if(jQuery.trim(response) == "Berhasil"){
                $("#notif").html("<div class='alert alert-success'><b>Pesanan Berhasil DiSetujui</b></div>");
                setTimeout(function(){
                  $(".alert").alert("close");
                },2500);
                location.reload();
              }else if(jQuery.trim(response) == "Gagal"){
                $("#notif").html("<div class='alert alert-warning'><b>Pesanan Gagal DiSetujui</b></div>");
                setTimeout(function(){
                  $(".alert").alert("close");
                },2500);
              }else{
                $("#notif").html("<div class='alert alert-danger'><b>Fungsi Approve Error</b></div>");
                setTimeout(function(){
                  $(".alert").alert("close");
                },2500);
                location.reload();
              }
            }
          });
        }

        function showProductServiceModal(kd_cust){
          $("#produk-service-table").load("<?php echo base_url(); ?>_marketing/main/show_product_service/"+kd_cust);
        }

        function showHistoryOrder(kd_cust){
          var id = kd_cust;
          $("#history-table").dataTable().fnDestroy();
          $('#history-table').dataTable({
            // "fixedHeader" : true,
            "bProcessing" : true,
            "bServerSide" : true,
            "autoWidth": false,
            "responsive" : true,
            "scrollX" : "100%",
            // "scrollY" : "350px",
            "sAjaxSource":"<?php echo base_url(); ?>_marketing/main/getHistoryOrderJson?kd_cust="+id,
            "columns":[
              {"data":"tgl_pesan","name":"P.tgl_pesan"},
              {"data":"tgl_estimasi","name":"P.tgl_estimasi"},
              {"data":"kd_cust","name":"P.kd_cust"},
              {"data":"nm_owner","name":"C.nm_owner"},
              {"data":"nm_purchasing","name":"C.nm_purchasing"},
              {"data":"jumlah","name":"PD.jumlah"},
              {"data":"ukuran","name":"GH.ukuran"},
              {"data":"payment_method","name":"P.payment_method"},
              {"data":"harga","name":"PD.harga"},
              {"data":"merek","name":"PD.merek"},
              {"data":"warna_plastik","name":"GH.warna_plastik"},
              {"data":"warna_cetak","name":"PD.warna_cetak"},
              {"data":"sm","name":"PD.sm"},
              {"data":"dll","name":"PD.dll"},
              {"data":"kd_hrg","name":"PD.kd_hrg"},
              {"data":"no_order","name":"PD.no_order"}
            ],
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 10,
            "fnServerData": function (sSource, aoData, fnCallback){
              $.ajax({
                       "dataType": "json",
                       "type": "POST",
                       "url": sSource,
                       "data": aoData,
                       "success": fnCallback
                   });
            },
            "fnRowCallback": function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
              var jumlah = parseFloat(AvData["jumlah"]).toLocaleString();
              var harga = parseFloat(AvData["harga"]).toLocaleString();
              $("td:eq(5)",AvRow).text(jumlah + " " + AvData["satuan"]);
              $("td:eq(8)",AvRow).text(harga);
              $("td:eq(15)",AvRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalLihatNotePesanan('"+AvData["no_order"]+"')>Lihat Note</button>");
            }
          });

          $("#history-table-lama").dataTable().fnDestroy();
              $('#history-table-lama').dataTable({
                // "fixedHeader" : true,
                "bProcessing" : true,
                "bServerSide" : true,
                "autoWidth": false,
                "responsive" : true,
                // "scrollY" : "500px",
                "scrollX" : "100%",
                "sAjaxSource":"<?php echo base_url(); ?>_marketing/main/getHistoryOrderJsonLama",
                "columns":[
                  {"data":"tgl_pesan","name":"P.tgl_pesan"},
                  {"data":"tgl_estimasi","name":"P.tgl_estimasi"},
                  {"data":"kd_customer","name":"P.kd_customer"},
                  {"data":"nm_owner","name":"C.nm_owner"},
                  {"data":"nm_purchasing","name":"C.nm_purchasing"},
                  {"data":"jumlah","name":"PD.jumlah"},
                  {"data":"ukuran","name":"GH.ukuran"},
                  {"data":"term_payment","name":"P.term_payment"},
                  {"data":"harga","name":"PD.harga"},
                  {"data":"merek","name":"PD.merek"},
                  {"data":"warna_plastik","name":"GH.warna_plastik"},
                  {"data":"cetak","name":"PD.cetak"},
                  {"data":"sm","name":"PD.sm"},
                  {"data":"dll","name":"PD.dll"},
                  {"data":"kd_harga","name":"PD.kd_harga"},
                  {"data":"no_order","name":"PD.no_order"}
                ],
                "sPaginationType": "full_numbers",
                "iDisplayStart ": 10,
                "fnServerData": function (sSource, aoData, fnCallback){
                  aoData.push({"name":"kdCust","value":id});
                  $.ajax({
                           "dataType": "json",
                           "type": "POST",
                           "url": sSource,
                           "data": aoData,
                           "success": fnCallback
                       });
                },
                "fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
                  var jumlah = parseFloat(AvData["jumlah"]).toLocaleString();
                  var harga = parseFloat(AvData["harga"]).toLocaleString();
                  $("td:eq(5)",AvRow).text(jumlah + " " + AvData["satuan"]);
                  $("td:eq(8)",AvRow).text(harga + " ");
                  $("td:eq(15)",AvRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalLihatNotePesananLama('"+AvData["no_order"]+"')>Lihat Note Pesanan</button>")
                }
              });
        }

        function lihatDetailCustomer(kd_cust){
          $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>_marketing/main/getCustomerDetailJson",
            dataType : "JSON",
            data : {kd_cust : kd_cust},
            success : function(response){
              $("#td_kd_cust").text(response[0].kd_cust);
              $("#td_nm_perusahaan1").text(response[0].nm_perusahaan);
              $("#td_nm_owner1").text(response[0].nm_owner);
              $("#td_nm_purchasing1").text(response[0].nm_purchasing+"( "+response[0].hp_purchasing+" )");
              $("#td_no_telp").text(response[0].tlp_kantor+" / "+response[0].tlp_lainnya);
              $("#td_alamat").html(response[0].alamat+" / "+response[0].alamat_lainnya);
              $("#td_kota_prov_negara").text(response[0].kota+" / "+response[0].provinsi+" / "+response[0].negara);
              $("#td_kd_pos").text(response[0].kode_pos);
              $("#td_no_fax").text(response[0].no_fax);
              $("#td_email").text(response[0].email+" / "+response[0].email_lainnya);
              $("#td_website").text(response[0].website);
              $("#td_note").html(response[0].note);

              $("#table-product-service").dataTable().fnDestroy();
              $("#table-product-service").dataTable({
                // "fixedHeader" : true,
                "bProcessing" : true,
                "bServerSide" : true,
                "autoWidth": false,
                "responsive" : true,
                "sAjaxSource":"<?php echo base_url(); ?>_marketing/main/getProductServiceJson?kd_cust="+response[0].kd_cust,
                "columns":[
                  {"data":"servis_produk","name":"PS.servis_produk"},
                  {"data":"ukuran","name":"PS.ukuran"},
                  {"data":"harga","name":"PS.harga"},
                  {"data":"term_payment","name":"term_payment"},
                  {"data":"merek","name":"PS.merek"},
                  {"data":"foto","name":"PS.foto"},
                  {"data":"id_sp","name":"PS.id_sp"}
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
                "fnRowCallback" : function (nRow,aData,iDisplayIndex,iDisplayIndexFull){
                  $("td:eq(6)",nRow).html("<button class='btn btn-sm btn-flat btn-info' onclick=lihatNoteProdukServis('"+aData['id_sp']+"') data-toggle='modal' data-target='#modal-note'><span clas='fa fa-sticky-note-o'></span> Note</button>");
                }
              });
            }
          });
        }

        function lihatNoteProdukServis(id_sp){
          $.ajax({
            type : "GET",
            url : "<?php echo base_url(); ?>_marketing/main/getProdukServisNoteJson",
            dataType : "JSON",
            data : {id_sp : id_sp},
            success : function(response){
              $("#note-wrapper").html(response[0].note);
            }
          });
        }

        function reloadCounterOrderDeadline(){
          $.ajax({
            url : "<?php echo base_url('_marketing/main/getCountOrderDeadline'); ?>",
            dataType : "JSON",
            success : function(response){
              $("#countOrder").text(response.Counter);
            },
            error : function(response){
              alert("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
            }
          });
        }

        function editTglEstimasi(param){
          var tglEstimasi1 = $("#txtTglEstimasi").val();
          if(tglEstimasi1==""){
            alert("Kolom Berwarna Kuning Tidak Boleh Kosong!");
          }else{
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_marketing/main/editTglEstimasi'); ?>",
              dataType : "TEXT",
              data : {
                noOrder : param,
                tglEstimasi : tglEstimasi1
              },
              success : function(response){
                if($.trim(response)==="Berhasil"){
                  alert("Tanggal Estimasi Berhasil Di Ubah");
                  $(".active a[aria-controls='tableListPesananLewatTglEstimasi']").trigger("click");
                  $("#modalEditTglEstimasi").modal("hide");
                  $("input").val("");
                  $(".date").datepicker("setDate",null);
                }else if($.trim(response)=="Gagal"){
                  alert("Tanggal Estimasi Gagal Di Ubah");
                }else{
                  alert("Kolom Berwarna Kuning Tidak Boleh Kosong!");
                }
              }
            });
          }
        }
      </script>
<!--===============================================General Function (Finish) ===============================================-->
      <script type="text/javascript">
      //============ Modal Method (Start) ============//
      function modalLihatNotePesanan(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url('_marketing/main/getNotePesanan'); ?>",
          dataType : "JSON",
          data : {
            noOrder : param
          },
          success : function(response){
            $("#textNote").html(response[0].note);
            $("#modalLihatNotePesanan").modal("show");
          },
          error : function(response){
            alert("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
          }
        });
      }

      function modalLihatNotePesananLama(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url('_marketing/main/getNotePesananLama'); ?>",
          dataType : "JSON",
          data : {
            noOrder : param
          },
          success : function(response){
            $("#textNote").html(response[0].note);
            $("#modalLihatNotePesanan").modal("show");
          },
          error : function(response){
            alert("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
          }
        });
      }

      function modalEditTglEstimasi(param){
        $.ajax({
          type : "POST",
          url : "<?php echo base_url('_marketing/main/getTglEstimasi'); ?>",
          dataType : "JSON",
          data : {
            noOrder : param
          },
          success : function(response){
            $("#txtTglEstimasi").val(response[0].tgl_estimasi);
            $("#btnEditTanggal").attr("onclick","editTglEstimasi('"+param+"')");
            $("#modalEditTglEstimasi").modal("show");
          },
          error : function(response){
            alert("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
          }
        });
      }

      function modalShowOrderDeadline(){
        $("#tableListPesananLewatTglEstimasi").dataTable().fnDestroy();
        $('#tableListPesananLewatTglEstimasi').dataTable({
          // "fixedHeader" : true,
          "bProcessing" : true,
          "bServerSide" : true,
          "autoWidth": false,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_marketing/main/getOrderDeadline",
          "columns":[
            {"data":"no_order","name":"no_order"},
            {"data":"kd_order","name":"kd_order"},
            {"data":"nm_perusahaan","name":"nm_perusahaan"},
            {"data":"nm_pemesan","name":"nm_pemesan"},
            {"data":"nm_purchasing","name":"nm_purchasing"},
            {"data":"tgl_pesan","name":"tgl_pesan"},
            {"data":"tgl_estimasi","name":"tgl_estimasi"},
            {"data":"sts_pesanan","name":"sts_pesanan"},
            {"data":"approve_1","name":"approve_1"},
            {"data":"approve_2","name":"approve_2"},
            {"data":"approve_3","name":"approve_3"},
            // {"data":"approve_4","name":"approve_4"},
            {"data":"approve_5","name":"nm_perusahaan_update"},
            {"data":"approve_6","name":"nm_purchasing_update"},
            {"data":"no_order","name":"no_order"}
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
          "order": [
                    [0, "desc"]
                  ],
          "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            $("td:eq(0)",nRow).html("<a href='#' data-toggle='modal' data-target='#modal-lihat-detail-pesanan' onclick=lihatDetailPesanan('"+aData['no_order']+"') class='bg-blue'>"+aData['no_order']+"</a>");
            var arrTglEstimasi = aData["tgl_estimasi"].split("-");
            var tgl_estimasi = new Date(arrTglEstimasi[2],arrTglEstimasi[1]-1,arrTglEstimasi[0]);
            var date = new Date();
            var month = date.getMonth()+1;
            var day = date.getDate();
            var tgl_sekarang_temp = ((''+day).length<2 ? '0' : '')+ day +'-'+
                                    ((''+month).length<2 ? '0' : '')+ month +'-'+
                                    date.getFullYear();
            var tgl_sekarang = new Date(tgl_sekarang_temp);
            var timeDiff = Math.round(tgl_estimasi.getTime() - tgl_sekarang.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            if(diffDays <= 2 && diffDays >= 0){
              $('td', nRow).css('background-color', 'rgba(237,234,0,0.7)');
              $('td:eq(13)', nRow).css('background-color', 'transparent');
            }else if(diffDays < 0){
              $('td', nRow).css('background-color', 'rgba(255,0,0,0.7)');
              $('td:eq(13)', nRow).css('background-color', 'transparent');
              $('td', nRow).css('color', '#FFF');
            }else{

            }

            if(aData["approve_1"] == "FALSE"){
              $("td:eq(8)",nRow).text("");
            }else{
              $("td:eq(8)",nRow).html("<i class='fa fa-check'></i>");
            }
            if(aData["approve_2"] == "FALSE"){
              $("td:eq(9)",nRow).text("");
            }else{
              $("td:eq(9)",nRow).html("<i class='fa fa-check'></i>");
            }
            if(aData["approve_3"] == "FALSE"){
              $("td:eq(10)",nRow).text("");
            }else{
              $("td:eq(10)",nRow).html("<i class='fa fa-check'></i>");
            }
            if(aData["approve_5"] == "FALSE"){
              $("td:eq(11)",nRow).text("");
            }else{
              $("td:eq(11)",nRow).html("<i class='fa fa-check'></i>");
            }
            if(aData["approve_6"] == "FALSE"){
              $("td:eq(12)",nRow).text("");
            }else{
              $("td:eq(12)",nRow).html("<i class='fa fa-check'></i>");
            }
            $("td:eq(13)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditTglEstimasi('"+aData["no_order"]+"')>Ubah Tanggal Estimasi</button>")
            // if(aData["approve_6"] == "FALSE"){
            //   $("td:eq(13)",nRow).text("");
            // }else{
            //   $("td:eq(13)",nRow).html("<i class='fa fa-check'></i>");
            // }
          }
        });
      }
      //============ Modal Method (Finish) ============//

      //============ Save Method (Start) ============//
        function saveCustomerBaru(){
          for (instance in CKEDITOR.instances) {
             CKEDITOR.instances[instance].updateElement();
          }
          var header = $("#header").val();
          var noCust = $("#txt_no_cust").val();
          if(header == "MODIFY"){
            var kdCust = $("#txt_kd_cust_baru").val();
            var nmPerusahaan = $("#txt_nm_perusahaan_baru").val();
            var nmOwner = $("#txt_nm_owner_baru").val();
            var nmPurchasing = $("#txt_nm_purchasing_baru").val();
          }else{
            var kdCust = $("#txt_kd_cust").val();
            var nmPerusahaan = $("#txt_nm_perusahaan").val();
            var nmOwner = $("#txt_nm_owner").val();
            var nmPurchasing = $("#txt_nm_purchasing").val();
          }
          var bidang = $("#cmb_bidang").val();
          var hpOwner = $("#txt_hp_own").val();
          var hpPurchasing = $("#txt_hp_purchasing").val();
          var jnsKelamin = $("input[name='rb_jenkel']:checked").val();
          var telpPrimary = $("#txt_telp_primary").val();
          var telpSecondary = $("#txt_telp_secondary").val();
          var alamat = CKEDITOR.instances['txt_alamat'].getData();
          var alamatSecondary = CKEDITOR.instances['txt_alamat_second'].getData();
          var negara = $("#cmb_negara").val();
          var provinisi = $("#cmb_provinsi").val();
          var kota = $("#cmb_kota").val();
          var fax = $("#txt_fax").val();
          var kdPos = $("#txt_kd_pos").val();
          var email = $("#txt_email").val();
          var emailSecondary = $("#txt_email_secondary").val();
          var pajak = $("input[name='rb_pajak']:checked").val();
          var web = $("#txt_web").val();
          var note = CKEDITOR.instances['txt_note'].getData();

          if(noCust=="" || nmPerusahaan=="" || bidang=="" || nmPurchasing=="" ||
             hpPurchasing=="" || jnsKelamin=="" || telpPrimary=="" || alamat== ""
            ){
               alert('Gagal,Semua data yang berbintang tidak boleh kosong!');
          }else{
            $.ajax({
              type : "POST",
              url : "<?php echo base_url('_marketing/main/saveCustomer'); ?>",
              dataType : "html",
              data : {
                header                : header,
                txt_no_cust           : noCust,
                txt_kd_cust           : kdCust,
                txt_nm_perusahaan     : nmPerusahaan,
                cmb_bidang            : bidang,
                txt_nm_owner          : nmOwner,
                txt_hp_own            : hpOwner,
                txt_nm_purchasing     : nmPurchasing,
                txt_hp_purchasing     : hpPurchasing,
                rb_jenkel             : jnsKelamin,
                txt_telp_primary      : telpPrimary,
                txt_telp_secondary    : telpSecondary,
                txt_alamat            : alamat,
                txt_alamat_secondary  : alamatSecondary,
                cmb_negara            : negara,
                cmb_provinsi          : provinisi,
                cmb_kota              : kota,
                txt_fax               : fax,
                txt_kd_pos            : kdPos,
                txt_email             : email,
                txt_email_secondary   : emailSecondary,
                rb_pajak              : pajak,
                txt_web               : web,
                txt_note              : note
              },
              success : function(response){
                $("body").append(response);
                var x = response.replace(/<script>|<\/script>|alert|\(|\)|\'|\;/g,"");
                if($.trim(x) === "Selamat, Data customer baru berhasil diinput"){
                  location.reload();
                }else if($.trim(x) === "Selamat, Data customer berhasil diubah')"){
                  location.reload();
                }
              },
              error : function(response){
                alert("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
              }
            });
          }
        }

        function changeTitle(title) {

          var date = $("#tglTitle").text();
          $("#tglTitle").text(date);
          $("#title").text(title);
          if (title=="Dalam Kota") {
            datatableOrederPerHari("DK",date);
          }else if (title=="Luar Kota"){
            datatableOrederPerHari("LK",date);
          }else if (title=="Cabang"){
            datatableOrederPerHari("CBG",date);
          }
        }

        function datatableOrederPerHari(jenis="",tgl=""){
          if (jenis=="") {jenis="DK"}
          $("#tableOrderPerHari"+jenis).dataTable().fnDestroy();
          $("#tableOrderPerHari"+jenis).dataTable({
            // "fixedHeader" : true,
            "autoWidth" : false,
            "ordering" : false,
            "bProcessing" : true,
            "bServerSide" : true,
            "bJQueryUI" : true,
            "sPaginationType" : "full_numbers",
            "sAjaxSource" : "<?php echo base_url(); ?>_marketing/main/getDataOrderPerHari",
            "columns" : [
              {"data" : "no_order", "name" : "P.no_order"},
              {"data" : "no_order", "name" : "P.no_order"},
              {"data" : "kd_order", "name" : "P.kd_order"},
              {"data" : "nm_perusahaan", "name" : "C.nm_perusahaan"},
              {"data" : "nm_pemesan", "name" : "P.nm_pemesan"},
              {"data" : "tgl_pesan", "name" : "P.tgl_pesan"},
              {"data" : "tgl_estimasi", "name" : "P.tgl_estimasi"},
              {"data" : "sts_pesanan", "name" : "P.sts_pesanan"},
              {"data" : "no_order", "name" : "C.nm_perusahaan_update"}
            ],
            "fnServerData" : function(sSource,aoData,fnCallback){
              aoData.push({"name":"jenis","value":jenis});
              aoData.push({"name":"tgl","value":tgl});
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
              $("td:eq(8)",nRow).html("<button class='btn btn-flat btn-primary btn-sm' data-toggle='modal' data-target='#modal-lihat-detail-pesanan' onclick=lihatDetailPesanan('"+aData['no_order']+"')>Detail</button>");
            }
          });
        }

        function totalOrderPerHari(param,param2="") {
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_marketing/main/getTotalOrderPerHari'); ?>",
            data :{jenis:param,tgl:param2},
            dataType : "JSON",
            success:function(response){
              if (param=="DK") {
                $.each(response,function(index, value){
                  $("#totalPerHariDK").append(value.jumlah+" "+value.satuan+"<br>");
                });
              }else if (param=="LK"){
                $.each(response,function(index, value){
                  $("#totalPerHariLK").append(value.jumlah+" "+value.satuan+"<br>");
                });
              }else if (param=="CBG"){
                 $.each(response,function(index, value){
                  $("#totalPerHariCBG").append(value.jumlah+" "+value.satuan+"<br>");
                });
              }

            }
          });
        }

        function orderPerHariByDate(){
          var date = $("#tanggal").val();
          if (!date) {
            alert("Tanggal Tidak Boleh Kosong!")
          }else{
            $("#tglTitle").text(date);
            if ($("#tableOrderPerHariDK").length) {
              $("#totalPerHariDK").empty();
              totalOrderPerHari("DK",date)
              datatableOrederPerHari("DK",date)
            }

            if ($("#tableOrderPerHariLK").length) {
              $("#totalPerHariLK").empty();
              totalOrderPerHari("LK",date)
              datatableOrederPerHari("LK",date)
            }

            if ($("#tableOrderPerHariCBG").length) {
              $("#totalPerHariCBG").empty();
              totalOrderPerHari("CBG",date)
              datatableOrederPerHari("CBG",date)
            }
          }
        }

        function statisticChartPerHari(jenis="",tgl_awal="",tgl_akhir=""){
          var tgl_awal  = $("#tgl_awal").val();
          var tgl_akhir = $("#tgl_akhir").val();
          $("#tglTitle").text(tgl_awal+" s/d "+tgl_akhir);
          var jns = $("#title").text();
          if (jns=="Dalam Kota") {
            var jenis = "DK";
            var canvas = "myChart1";
          }else if(jns=="Luar Kota"){
            var jenis = "LK";
            var canvas = "myChart2";
          }else{
            var jenis = 'CBG';
            var canvas = "myChart3";
          }
          if (!tgl_awal||!tgl_akhir) {
            alert("Semua kolom harus diisi!");
          }else{
            $.ajax({
            type : "POST",
            url  : "<?php echo site_url('_marketing/main/getDataChart'); ?>",
            data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,jenis:jenis},
            dataType : "JSON",
            success:function(response){
              var labels = response.map(function(e) {
                 return e.tgl_pesan;
              });
              var dataBal = response.map(function(e) {
                 return e.Bal;
              });
              var dataKg = response.map(function(e) {
                 return e.Kg;
              });
              var dataLembar = response.map(function(e) {
                 return e.Lembar;
              });
              var ctx = document.getElementById(canvas).getContext('2d');
              var chart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: labels,
                      datasets: [{
                          label: "Bal",
                          backgroundColor: 'rgb(0, 97, 255)',
                          borderColor: 'rgb(0, 97, 255)',
                          data: dataBal,
                      },
                      {
                          label: "Kg",
                          backgroundColor: 'rgb(0, 255, 106)',
                          borderColor: 'rgb(0, 255, 106)',
                          data: dataKg,
                      },
                      {
                          label: "Lembar",
                          backgroundColor: 'rgb(255, 99, 132)',
                          borderColor: 'rgb(255, 99, 132)',
                          data: dataLembar,
                      }
                      ]
                  },


                  // Configuration options go here
                  options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                  }
              });

            }
          });
          }
        }

        function changeTitleChart(title) {
          var date = $("#tglTitle").text().split(" s/d ");
          $("#tglTitle").text(date[0]+" s/d "+date[1]);
          $("#title").text(title);
          if (title=="Dalam Kota") {
            statisticChartPerHari("DK",date[0],date[1]);
          }else if (title=="Luar Kota"){
            statisticChartPerHari("LK",date[0],date[1]);
          }else if (title=="Cabang"){
            statisticChartPerHari("CBG",date[0],date[1]);
          }
        }

      //============ Save Method (Finish) ============//
      </script>
    </body>
</html>
