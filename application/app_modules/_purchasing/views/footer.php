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
      datatableMasterBahanBaku();
      datatableMasterBijiWarna();
      datatableMasterMinyak();
      datatableMasterCatMurni();
      datatableMasterCatCampur();
      datatableMasterApal();
      datatableMasterSparePart();
      datatableLowStockSparePart();
			counterPermintaanBarang();
			setInterval(function(){
				counterPermintaanBarang();
			},10000);
      // countTrashPurceshing()
			if($("#tableDataPermintaan").length > 0){
				datatableDataPermintaan();
			}

			if($("#tableDataPermintaanSparepart").length > 0){
				datatableDataPermintaanSparePart();
			}

			if($("#tablePenerimaanBarang").length > 0){
				datatableDataPenerimaanBarang();
			}

			if($("#tablePenerimaanSparePart").length > 0){
				datatableDataPenerimaanSparePart();
			}
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
  function datatableMasterBahanBaku(){
    $("#tableMasterBahanBaku").dataTable().fnDestroy();
    $("#tableMasterBahanBaku").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataMasterBahanBaku",
      // "aoColumnDefs": [{ "sWidth": "20%", "aTargets": [ 4 ], "sWidth": "20%", "aTargets": [ 5 ] }],
      "columns" : [
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"},
        {"data" : "nm_barang", "name" : "nm_barang"},
        {"data" : "warna", "name" : "warna"},
        {"data" : "stok", "name" : "stok"},
        // {"data" : "satuan", "name" : "satuan"},
        // {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"}
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
        $("td:eq(3)",nRow).html(parseFloat(aData["stok"]).toFixed(2)+" "+aData["satuan"]);
        // $("td:eq(4)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' style='float:right;' onclick=editStokBahan('"+aData['kd_gd_bahan']+"') title='Edit'><i class='fa fa-edit'> &nbsp;  Edit &nbsp;</i></button>");
        // $("td:eq(5)",nRow).html("<button class='btn btn-sm btn-flat btn-danger' onclick=deleteStokBahan('"+aData['kd_gd_bahan']+"') title='Hapus'><i class='fa fa-trash'>  Hapus </i></button>");
      }
    });
  }
  </script>
  <script type="text/javascript">
  function datatableMasterBijiWarna(){
    $("#tableMasterBijiWarna").dataTable().fnDestroy();
    $("#tableMasterBijiWarna").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataMasterBijiWarna",
      // "aoColumnDefs": [{ "sWidth": "20%", "aTargets": [ 4 ], "sWidth": "20%", "aTargets": [ 5 ] }],
      "columns" : [
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"},
        {"data" : "nm_barang", "name" : "nm_barang"},
        {"data" : "warna", "name" : "warna"},
        {"data" : "stok", "name" : "stok"},
        // {"data" : "satuan", "name" : "satuan"},
        // {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"}

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
        $("td:eq(3)",nRow).html(parseFloat(aData["stok"]).toFixed(2)+" "+aData["satuan"]);
        // $("td:eq(4)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' style='float:right;' onclick=editStokBahan('"+aData['kd_gd_bahan']+"') title='Edit'><i class='fa fa-edit'> &nbsp;  Edit &nbsp;</i></button>");
        // $("td:eq(5)",nRow).html("<button class='btn btn-sm btn-flat btn-danger' onclick=deleteStokBahan('"+aData['kd_gd_bahan']+"') title='Hapus'><i class='fa fa-trash'>  Hapus </i></button>");
      }
    });
  }
  </script>
  <script type="text/javascript">
  function datatableMasterMinyak(){
    $("#tableMasterMinyak").dataTable().fnDestroy();
    $("#tableMasterMinyak").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataMasterMinyak",
      // "aoColumnDefs": [{ "sWidth": "20%", "aTargets": [ 3 ], "sWidth": "20%", "aTargets": [ 4 ] }],
      "columns" : [
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"},
        {"data" : "nm_barang", "name" : "nm_barang"},
        {"data" : "stok", "name" : "stok"},
        // {"data" : "satuan", "name" : "satuan"},
        // {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"}
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
        $("td:eq(2)",nRow).html(parseFloat(aData["stok"]).toFixed(2)+" "+aData["satuan"]);
        // $("td:eq(3)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' style='float:right;' onclick=editStokBahan('"+aData['kd_gd_bahan']+"') title='Edit'><i class='fa fa-edit'> &nbsp;  Edit &nbsp;</i></button>");
        // $("td:eq(4)",nRow).html("<button class='btn btn-sm btn-flat btn-danger' onclick=deleteStokBahan('"+aData['kd_gd_bahan']+"') title='Tambah Rencana'><i class='fa fa-trash'>  Hapus </i></button>");
      }
    });
  }
  </script>
  <script type="text/javascript">
  function datatableMasterCatMurni(){
    $("#tableMasterCatMurni").dataTable().fnDestroy();
    $("#tableMasterCatMurni").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataMasterCatMurni",
      // "aoColumnDefs": [{ "sWidth": "20%", "aTargets": [ 4 ], "sWidth": "20%", "aTargets": [ 5 ] }],
      "columns" : [
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"},
        {"data" : "nm_barang", "name" : "nm_barang"},
        {"data" : "warna", "name" : "warna"},
        {"data" : "stok", "name" : "stok"},
        // {"data" : "satuan", "name" : "satuan"},
        // {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"}
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
        $("td:eq(3)",nRow).html(parseFloat(aData["stok"]).toFixed(2)+" "+aData["satuan"]);
        // $("td:eq(4)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' style='float:right;' onclick=editStokBahan('"+aData['kd_gd_bahan']+"') title='Edit'><i class='fa fa-edit'> &nbsp;  Edit &nbsp;</i></button>");
        // $("td:eq(5)",nRow).html("<button class='btn btn-sm btn-flat btn-danger' onclick=deleteStokBahan('"+aData['kd_gd_bahan']+"') title='Hapus'><i class='fa fa-trash'>  Hapus </i></button>");
      }
    });
  }
  </script>
  <script type="text/javascript">
  function datatableMasterCatCampur(){
    $("#tableMasterCatCampur").dataTable().fnDestroy();
    $("#tableMasterCatCampur").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataMasterCatCampur",
      // "aoColumnDefs": [{ "sWidth": "20%", "aTargets": [ 4 ], "sWidth": "20%", "aTargets": [ 5 ] }],
      "columns" : [
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"},
        {"data" : "nm_barang", "name" : "nm_barang"},
        {"data" : "warna", "name" : "warna"},
        {"data" : "stok", "name" : "stok"},
        // {"data" : "satuan", "name" : "satuan"},
        // {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"}
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
        $("td:eq(3)",nRow).html(parseFloat(aData["stok"]).toFixed(2)+" "+aData["satuan"]);
        // $("td:eq(4)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' style='float:right;' onclick=editStokBahan('"+aData['kd_gd_bahan']+"') title='Edit'><i class='fa fa-edit'> &nbsp;  Edit &nbsp;</i></button>");
        // $("td:eq(5)",nRow).html("<button class='btn btn-sm btn-flat btn-danger' onclick=deleteStokBahan('"+aData['kd_gd_bahan']+"') title='Hapus'><i class='fa fa-trash'>  Hapus </i></button>");
      }
    });
  }
  </script>
  <script type="text/javascript">
  function datatableMasterApal(){
    $("#tableMasterApal").dataTable().fnDestroy();
    $("#tableMasterApal").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataMasterApal",
      // "aoColumnDefs": [{ "sWidth": "20%", "aTargets": [ 4 ], "sWidth": "20%", "aTargets": [ 5 ] }],
      "columns" : [
        {"data" : "kd_gd_apal", "name" : "kd_gd_apal"},
        {"data" : "jenis", "name" : "jenis"},
        {"data" : "sub_jenis", "name" : "sub_jenis"},
        {"data" : "stok", "name" : "stok"},
        // {"data" : "kd_gd_apal", "name" : "kd_gd_apal"},
        // {"data" : "kd_gd_apal", "name" : "kd_gd_apal"}
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
        // $("td:eq(4)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' style='float:right;' onclick=editStokApal('"+aData['kd_gd_apal']+"') title='Edit'><i class='fa fa-edit'> &nbsp;  Edit &nbsp;</i></button>");
        // $("td:eq(5)",nRow).html("<button class='btn btn-sm btn-flat btn-danger' onclick=deleteStokApal('"+aData['kd_gd_apal']+"') title='Hapus'><i class='fa fa-trash'>  Hapus </i></button>");
      }
    });
  }
  </script>
  <script type="text/javascript">
  function datatableMasterSparePart(){
    $("#tableMasterSparePart").dataTable().fnDestroy();
    $("#tableMasterSparePart").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataMasterSparePart",
      // "aoColumnDefs": [{ "sWidth": "20%", "aTargets": [ 4 ], "sWidth": "20%", "aTargets": [ 5 ] }],
      "columns" : [
        {"data" : "kd_spare_part", "name" : "kd_spare_part"},
        {"data" : "nm_spare_part", "name" : "nm_spare_part"},
        {"data" : "ukuran", "name" : "ukuran"},
        {"data" : "stok_aktual", "name" : "stok_aktual"},
        {"data" : "stok", "name" : "stok"},
        // {"data" : "kd_spare_part", "name" : "kd_spare_part"},
        // {"data" : "kd_spare_part", "name" : "kd_spare_part"}
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
        var stok = aData['stok']/aData['stok_aktual']*100;
        if (stok<=100 && stok>50) {
          $("td:eq(4)",nRow).html('<div class="clearfix"><small class="pull-left">'+aData['stok']+'</small></div><div class="progress xs"><div class="progress-bar progress-bar-green" style="width: '+stok+'%;"></div></div>');
        }else if(stok<=50 && stok>30) {
          $("td:eq(4)",nRow).html('<div class="clearfix"><small class="pull-left">'+aData['stok']+'</small></div><div class="progress xs"><div class="progress-bar progress-bar-yellow" style="width: '+stok+'%;"></div></div>');
        }else if(stok<=30){
          $("td:eq(4)",nRow).html('<div class="clearfix"><small class="pull-left">'+aData['stok']+'</small></div><div class="progress xs"><div class="progress-bar progress-bar-red" style="width: '+stok+'%;"></div></div>');
        }
        if (aData["kode"] !="") { $("td:eq(1)",nRow).text(aData["nm_spare_part"]+" ( "+aData["kode"]+" )");}
        // $("td:eq(5)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' style='float:right;' onclick=editSparePart('"+aData['kd_spare_part']+"') title='Edit'><i class='fa fa-edit'> &nbsp;  Edit &nbsp;</i></button>");
        // $("td:eq(6)",nRow).html("<button class='btn btn-sm btn-flat btn-danger' onclick=deleteSparePart('"+aData['kd_spare_part']+"') title='Hapus'><i class='fa fa-trash'>  Hapus </i></button>");
      }
    });
  }
  </script>

  <script type="text/javascript">
    function listPermintaanPembelianBarang(param) {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/listPermintaanPembelianBarang'); ?>",
        data : {param:param},
        dataType : "JSON",
        success:function(response)
        {
          $("#title_header").text(param);
          $('#approve_permintaan').attr('onclick','approvePermintaanBahan("'+param+'")');
          $("#tableListPermintaanBarang > tbody > tr").empty();
          $.each(response,function(index,value){
          var no = ++index;
           $("#tableListPermintaanBarang > tbody:last-child").append(
              "<tr>"+
                "<td>"+no+"</td>"+
                "<td>"+value.tgl_permintaan+"</td>"+
                "<td>"+value.bagian.replace(/,/gi," ")+"</td>"+
                "<td>"+value.nm_barang+"</td>"+
                "<td id='td_warna'>"+value.warna+"</td>"+
                "<td id='jum_"+value.id+"' width='110px'>"+parseFloat(value.jumlah_permintaan).toLocaleString()+"</td>"+
                "<td align='center' width='200px'>"+"<button class='btn btn-sm btn-flat btn-success' id='update_"+value.id+"' onclick=updatePermintaanBahan('"+value.id+"','"+encodeURIComponent(value.jenis)+"') style='display:none;'><i class='fa fa-refresh'>  Update</i></button><button class='btn btn-sm btn-flat btn-primary' id='edit_"+value.id+"' onclick=editPermintaanBahan('"+value.id+"','"+value.jumlah_permintaan+"')><i class='fa fa-edit'>  Edit</i></button><button class='btn btn-sm btn-flat btn-danger' onclick=deletePermintaanBahan('"+value.id+"','"+encodeURIComponent(value.jenis)+"')><i class='fa fa-trash'>  Hapus</i></button>"+"</td>"+
              "</tr>"
            );
          });
          if (param=="MINYAK") {
            $("#td_warna").hide();
            $("#th_warna").hide();
          }
          $("#modal_daftarPermintaanBarang").modal({backdrop:"static"});
        }
      });
    }
  </script>

  <script type="text/javascript">
    function listPermintaanPembelianSparePart() {
      var param = 'Spare Part';
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/listPermintaanPembelianSparePart'); ?>",
        dataType : "JSON",
        success:function(response)
        {
          $("#title_header").text(param);
          $('#approve_permintaan').attr('onclick','approvePermintaanBahan("'+param+'")');
          $("#tableListPermintaanSparePart > tbody > tr").empty();
          $.each(response,function(index,value){
          var no = ++index;
           $("#tableListPermintaanSparePart > tbody:last-child").append(
              "<tr>"+
                "<td>"+no+"</td>"+
                "<td>"+value.tgl_transaksi+"</td>"+
                "<td>"+value.nm_spare_part+"</td>"+
                "<td>"+value.ukuran+"</td>"+
                "<td id='jum_sp_"+value.id+"' width='110px'>"+value.jumlah+"</td>"+
                "<td align='center' width='200px'>"+"<button class='btn btn-sm btn-flat btn-success' id='update_"+value.id+"' onclick=updatePermintaanSparePart('"+value.id+"') style='display:none;'><i class='fa fa-refresh'>  Update</i></button><button class='btn btn-sm btn-flat btn-primary' id='edit_"+value.id+"' onclick=editPermintaanSparePart('"+value.id+"','"+value.jumlah+"')><i class='fa fa-edit'>  Edit</i></button><button class='btn btn-sm btn-flat btn-danger' onclick=deletePermintaanSparePart('"+value.id+"')><i class='fa fa-trash'>  Hapus</i></button>"+"</td>"+
              "</tr>"
            );
          });
          $("#modal_daftarPermintaanSparePart").modal({backdrop:"static"});
        }
      });
    }
  </script>

  <script type="text/javascript">
    function alertPermintaanBahan(){
      var param = "BAHAN BAKU";
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/checkPermintaanBahan'); ?>",
        data : {param:param},
        dataType : "text",
        success:function(response)
        {
         if (jQuery.trim(response)>0) {
            $("#alert_permintaanBahan").show();
            $("#numList_permintaanBahan").text(response+ "  Item");
         }else{
            $("#alert_permintaanBahan").hide();
         }
        }
      });
    }
  </script>

  <script type="text/javascript">
    function alertRencanaPembelianBahan(){
      var param = "BAHAN BAKU";
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/checkRencanaPembelianBahan'); ?>",
        data : {param:param},
        dataType : "text",
        success:function(response)
        {
         if (jQuery.trim(response)>0) {
            $("#alert_rencanaPembelianBahan").show();
            $("#numList_rencanaPembelianBahan").text(response+ "  Item");
         }else{
            $("#alert_rencanaPembelianBahan").hide();
         }
        }
      });
    }
  </script>
  <script type="text/javascript">
    function counterPermintaanBarang(){
      $.ajax({
        url  : "<?php echo site_url('_purchasing/main/checkPermintaanBahan'); ?>",
        dataType : "JSON",
        success:function(response){
					var jumlah = parseFloat(response.PermintaanBarang) + parseFloat(response.PermintaanSparePart);
         $("#Permintaan_Barang").html('<i class="fa fa-book"></i>Permintaan Barang <span class="pull-right-container">'+
				 '<span class="label bg-blue">'+jumlah+'</span>'+
				 '</span>');
        }
      });
    }
  </script>

  <script type="text/javascript">
    function alertRencanaPembelianBijiWarna(){
      var param = "BIJI WARNA";
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/checkRencanaPembelianBahan'); ?>",
        data : {param:param},
        dataType : "text",
        success:function(response)
        {
         if (jQuery.trim(response)>0) {
            $("#alert_rencanaPembelianBijiWarna").show();
            $("#numList_rencanaPembelianBijiWarna").text(response+ "  Item");
         }else{
            $("#alert_rencanaPembelianBijiWarna").hide();
         }
        }
      });
    }
  </script>
  <script type="text/javascript">
    function alertPermintaanMinyak(){
      var param = "MINYAK";
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/checkPermintaanBahan'); ?>",
        data : {param:param},
        dataType : "text",
        success:function(response)
        {
         if (jQuery.trim(response)>0) {
            $("#alert_permintaanMinyak").show();
            $("#numList_permintaanMinyak").text(response+ "  Item");
         }else{
            $("#alert_permintaanMinyak").hide();
         }
        }
      });
    }
  </script>

  <script type="text/javascript">
    function alertRencanaPembelianMinyak(){
      var param = "MINYAK";
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/checkRencanaPembelianBahan'); ?>",
        data : {param:param},
        dataType : "text",
        success:function(response)
        {
         if (jQuery.trim(response)>0) {
            $("#alert_rencanaPembelianMinyak").show();
            $("#numList_rencanaPembelianMinyak").text(response+ "  Item");
         }else{
            $("#alert_rencanaPembelianMinyak").hide();
         }
        }
      });
    }
  </script>
  <script type="text/javascript">
    function alertPermintaanCatMurni(){
      var param = "CAT MURNI";
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/checkPermintaanBahan'); ?>",
        data : {param:param},
        dataType : "text",
        success:function(response)
        {
         if (jQuery.trim(response)>0) {
            $("#alert_permintaanCatMurni").show();
            $("#numList_permintaanCatMurni").text(response+ "  Item");
         }else{
            $("#alert_permintaanCatMurni").hide();
         }
        }
      });
    }
  </script>

  <script type="text/javascript">
    function alertRencanaPembelianCatMurni(){
      var param = "CAT MURNI";
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/checkRencanaPembelianBahan'); ?>",
        data : {param:param},
        dataType : "text",
        success:function(response)
        {
         if (jQuery.trim(response)>0) {
            $("#alert_rencanaPembelianCatMurni").show();
            $("#numList_rencanaPembelianCatMurni").text(response+ "  Item");
         }else{
            $("#alert_rencanaPembelianCatMurni").hide();
         }
        }
      });
    }
  </script>
  <script type="text/javascript">
    function alertPermintaanCatCampur(){
      var param = "CAT CAMPUR";
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/checkPermintaanBahan'); ?>",
        data : {param:param},
        dataType : "text",
        success:function(response)
        {
         if (jQuery.trim(response)>0) {
            $("#alert_permintaanCatCampur").show();
            $("#numList_permintaanCatCampur").text(response+ "  Item");
         }else{
            $("#alert_permintaanCatCampur").hide();
         }
        }
      });
    }
  </script>

  <script type="text/javascript">
    function alertRencanaPembelianCatCampur(){
      var param = "CAT CAMPUR";
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/checkRencanaPembelianBahan'); ?>",
        data : {param:param},
        dataType : "text",
        success:function(response)
        {
         if (jQuery.trim(response)>0) {
            $("#alert_rencanaPembelianCatCampur").show();
            $("#numList_rencanaPembelianCatCampur").text(response+ "  Item");
         }else{
            $("#alert_rencanaPembelianCatCampur").hide();
         }
        }
      });
    }
  </script>

  <script type="text/javascript">
    function alertStokSparePart(){
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/checkStokSparePart'); ?>",
        dataType : "text",
        success:function(response)
        {
         if (jQuery.trim(response)>0) {
            $("#alert_stokSparePart").show();
            $("#numList_stokSparePart").text(response+ "  Item");
         }else{
            $("#alert_stokSparePart").hide();
         }
        }
      });
    }
  </script>

  <script type="text/javascript">
    function alertRencanaPembelianSparePart(){
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/checkRencanaPembelianSparePart'); ?>",
        dataType : "text",
        success:function(response)
        {
         if (jQuery.trim(response)>0) {
            $("#alert_rencanaPembelianSparePart").show();
            $("#numList_rencanaPembelianSparePart").text(response+ "  Item");
         }else{
            $("#alert_rencanaPembelianSparePart").hide();
         }
        }
      });
    }
  </script>

  <script type="text/javascript">
    function alertPermintaanSparePart(){
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/checkPermintaanSparePart'); ?>",
        // data : {param:param},
        dataType : "text",
        success:function(response)
        {
         if (jQuery.trim(response)>0) {
            $("#alert_permintaanSparePart").show();
            $("#numList_permintaanSparePart").text(response+ "  Item");
         }else{
            $("#numList_permintaanSparePart").hide();
         }
        }
      });
    }
  </script>
  <script type="text/javascript">
    function deletePermintaanBahan(id,jenis)
    {
      var jenis = decodeURIComponent(jenis);
      var r = confirm("Hapus List Permintaan ?");
      if (r == true) {
        $.ajax({
          type : "POST",
          url  : "<?php echo site_url('_purchasing/main/deletePermintaanBahan'); ?>",
          data : {id : id},
          success: function(response){
            if (jQuery.trim(response)=="Success"){
              alertPermintaanBahan();
              alertPermintaanBijiWarna();
              alertPermintaanMinyak();
              alertPermintaanCatCampur();
              alertPermintaanCatMurni();
              listPermintaanPembelianBarang(jenis);
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
  </script>
  <script type="text/javascript">
    function deletePermintaanSparePart(id)
    {
      var r = confirm("Hapus List Permintaan ?");
      if (r == true) {
        $.ajax({
          type : "POST",
          url  : "<?php echo site_url('_purchasing/main/deletePermintaanSparePart'); ?>",
          data : {id : id},
          success: function(response){
            if (jQuery.trim(response)=="Success"){
              alertPermintaanSparePart();
              listPermintaanPembelianSparePart();
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
  </script>
  <script type="text/javascript">
    function editPermintaanBahan(id,jumlah_permintaan)
    {
      $("#jum_"+id).html("<input type='text' id='jumlah_"+id+"' value='"+jumlah_permintaan+"' class='form-control' autofocus='autofocus'>");
      $("#edit_"+id).hide();
      $("#update_"+id).show();
    }
  </script>
  <script type="text/javascript">
    function editPermintaanSparePart(id,jumlah_permintaan)
    {
      $("#jum_sp_"+id).html("<input type='text' id='jumlah_"+id+"' value='"+jumlah_permintaan+"' class='form-control' autofocus='autofocus'>");
      $("#edit_"+id).hide();
      $("#update_"+id).show();
    }
  </script>
  <script type="text/javascript">
    function updatePermintaanBahan(id,jenis)
    {
      var jumlah = $("#jumlah_"+id).val();
      var jenis  = decodeURIComponent(jenis);
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/updatePermintaanBahan'); ?>",
        data : {jumlah : jumlah, id : id},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            listPermintaanPembelianBarang(jenis);
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
  </script>
  <script type="text/javascript">
    function updatePermintaanSparePart(id)
    {
      var jumlah = $("#jumlah_"+id).val();
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/updatePermintaanSparePart'); ?>",
        data : {jumlah : jumlah, id : id},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            listPermintaanPembelianSparePart();
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
  </script>
  <script type="text/javascript">
    function approvePermintaanBahan(param)
    {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/approvePermintaanBahan');?>",
        data : {param : param},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            alertPermintaanBahan();
            alertRencanaPembelianBahan();
            alertPermintaanBijiWarna();
            alertRencanaPembelianBijiWarna();
            $("#modal_daftarPermintaanBarang").modal('hide');
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
  </script>
  <script type="text/javascript">
    function approve_permintaan_sp()
    {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/approve_permintaan_sp'); ?>",
        success : function(response){
          if (jQuery.trim(response)=="Success"){
            alertPermintaanSparePart();
            alertRencanaPembelianSparePart();
            $("#modal_daftarPermintaanSparePart").modal('hide');
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
  </script>
  <script type="text/javascript">
    function listRencanaPembelianBarang(param)
    {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/listRencanaPembelianBarang'); ?>",
        data : {param : param},
        dataType : "JSON",
        success:function(response){
          $("#title_header_rencana").text(param);
          $("#tableListRencanaPembelianBarang > tbody > tr").empty();
          $.each(response,function(index,value){
          var no = ++index;
           $("#tableListRencanaPembelianBarang > tbody:last-child").append(
              "<tr>"+
                "<td>"+no+"</td>"+
                "<td>"+value.tgl_permintaan+"</td>"+
                "<td>"+value.nama+"</td>"+
                "<td>"+value.nm_barang+"</td>"+
                "<td id='td_warna1'>"+value.warna+"</td>"+
                "<td width='110px'>"+value.jumlah_permintaan+"</td>"+
                "<td align='center' width='200px'>"+"<button class='btn btn-sm btn-flat btn-success' onclick=inputHasilPembelianBahan('"+value.id+"','"+value.jumlah_permintaan+"')><i class='fa fa-check'>  Input</i></button><button class='btn btn-sm btn-flat btn-danger' onclick=deleteRencanaPembelianBahan('"+value.id+"','"+encodeURIComponent(value.jenis)+"')><i class='fa fa-trash'>  Hapus</i></button>"+"</td>"+
              "</tr>"
            );
          });
          if (param=="MINYAK") {
            $("#td_warna1").hide();
            $("#th_warna1").hide();
          }
          $("#modal_daftarRencanaPembeliBarang").modal({backdrop:"static"});
        }
      });
    }
  </script>
  <script type="text/javascript">
    function deleteRencanaPembelianBahan(id,jenis)
    {
      var r = confirm("Hapus List Permintaan ?");
      if (r == true) {
        $.ajax({
          type : "POST",
          url  : "<?php echo site_url('_purchasing/main/deletePermintaanBahan'); ?>",
          data : {id : id},
          success: function(response){
            if (jQuery.trim(response)=="Success"){
              alertRencanaPembelianBahan();
              alertRencanaPembelianBijiWarna();
              alertRencanaPembelianMinyak()
              alertRencanaPembelianCatMurni()
              alertRencanaPembelianCatCampur()
              listRencanaPembelianBarang(decodeURIComponent(jenis));
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
  </script>
  <script type="text/javascript">
    function inputHasilPembelianBahan(id)
    {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url("_purchasing/main/getRencanaPembelianBahanPerId");?>",
        data : {id:id},
        dataType : "JSON",
        success:function(response){
          $("#id").val(response[0].id);
          $("#tgl_permintaan").val(response[0].tgl_permintaan);
          $("#customer").val(response[0].nama);
          if (!response[0].warna) {
            $("#nm_barang").val(response[0].nm_barang);
          }else{
            $("#nm_barang").val(response[0].nm_barang+" ( "+response[0].warna+" ) ");
          }
          $("#jum_permintaan").val(response[0].jumlah_permintaan);
          $("#modal_inputHasilPembelianBarang").modal({backdrop:"static"});
        }
      });
    }
  </script>
  <script type="text/javascript">
    function kirimHasilPembelianBahan()
    {
      var id = $("#id").val();
      var tgl_pembelian = $("#tgl_pembelian").val();
      var jum_pembelian = $("#jum_pembelian").val();
      if (!id || !tgl_pembelian || !jum_pembelian) {
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
          url  : "<?php echo site_url('_purchasing/main/kirimHasilPembelianBahan'); ?>",
          data :{id:id,tgl_pembelian:tgl_pembelian,jum_pembelian:jum_pembelian},
          success:function(response){
            if (jQuery.trim(response)=="Success"){
              $("#modal_inputHasilPembelianBarang").modal('hide');
              alertRencanaPembelianBahan();
              listRencanaPembelianBahanBaku("PEMBELIAN BARANG");
              $("#tgl_pembelian").val("")
              $("#jum_pembelian").val("")
              $("#modal-notif").modal("show");
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
    $("#nama_barang").select2({
        placeholder : "Pilih Barang",
        dropdownParent : $("#modal_inputRencanaPembelianBarang"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getBahanBaku",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.nm_barang+" - "+item.warna+" - "+item.status,
                  id:item.kd_gd_bahan
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    $("#BahanBaku").select2({
        placeholder : "Pilih Barang",
        dropdownParent : $("#modal_searchHistoryBahan"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getBahanBaku",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.nm_barang+" - "+item.warna+" - "+item.status,
                  id:item.kd_gd_bahan
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    $("#BijiWarna").select2({
        placeholder : "Pilih Barang",
        dropdownParent : $("#modal_searchHistoryBijiWarna"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getBijiWarna",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.nm_barang+" - "+item.warna+" - "+item.status,
                  id:item.kd_gd_bahan
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    $("#nama_biji").select2({
        placeholder : "Pilih Biji Warna",
        dropdownParent : $("#modal_inputRencanaPembelianBijiWarna"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getBijiWarna",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.nm_barang+" - "+item.warna+" - "+item.status,
                  id:item.kd_gd_bahan
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    $("#nama_minyak").select2({
        placeholder : "Pilih Jenis Minyak",
        dropdownParent : $("#modal_inputRencanaPembelianMinyak"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getMinyak",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.nm_barang+" - "+item.status,
                  id:item.kd_gd_bahan
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    $("#Minyak").select2({
        placeholder : "Pilih Jenis Minyak",
        dropdownParent : $("#modal_searchHistoryMinyak"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getMinyak",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.nm_barang+" - "+item.status,
                  id:item.kd_gd_bahan
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    $("#nama_catMurni").select2({
        placeholder : "Pilih Cat Murni *",
        dropdownParent : $("#modal_inputRencanaPembelianCatMurni"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getCatMurni",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.nm_barang+" - "+item.warna+" - "+item.status,
                  id:item.kd_gd_bahan
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    $("#CatMurni").select2({
        placeholder : "Pilih Cat Murni *",
        dropdownParent : $("#modal_searchHistoryCatMurni"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getCatMurni",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.nm_barang+" - "+item.warna+" - "+item.status,
                  id:item.kd_gd_bahan
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    $("#nama_catCampur").select2({
        placeholder : "Pilih Cat Murni *",
        dropdownParent : $("#modal_inputRencanaPembelianCatCampur"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getCatCampur",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.nm_barang+" - "+item.warna+" - "+item.status,
                  id:item.kd_gd_bahan
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    $("#CatCampur").select2({
        placeholder : "Pilih Cat Murni *",
        dropdownParent : $("#modal_searchHistoryCatCampur"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getCatCampur",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.nm_barang+" - "+item.warna+" - "+item.status,
                  id:item.kd_gd_bahan
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    $("#sparepart").select2({
        placeholder : "Pilih Barang",
        dropdownParent : $("#modal_InputRencanaPembelianSparePart"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getSparePart",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.nm_spare_part+" - "+item.ukuran,
                  id:item.kd_spare_part
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    $("#SparePart").select2({
        placeholder : "Pilih Barang",
        dropdownParent : $("#modal_searchHistorySparePart"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getSparePart",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.nm_spare_part+" - "+item.ukuran,
                  id:item.kd_spare_part
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    $("#Apal").select2({
        placeholder : "Pilih Barang",
        dropdownParent : $("#modal_searchHistoryApal"),
        width : "100%",
        cache:true,
        allowClear:true,
        ajax:{
          url : "<?php echo base_url(); ?>_purchasing/main/getApal",
          dataType : "JSON",
          delay : 0,
          processResults : function(data){
            return{
              results : $.map(data, function(item){
                return{
                  text:item.sub_jenis,
                  id:item.kd_gd_apal
                }
              })
            };
          }
        }
      });
  </script>
  <script type="text/javascript">
    function simpanRencanaPembelianBahan()
    {
      var tanggal   = $("#tanggal").val();
      var customer  = $("#nm_customer").val();
      var nm_barang = $("#nama_barang").val();
      var jumlah    = $("#jumlah").val();
      if (!tanggal||!customer||!nm_barang||!jumlah) {
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
        url  : "<?php echo site_url('_purchasing/main/simpanRencanaPembelianBahan'); ?>",
        data : {tanggal:tanggal,customer:customer,nm_barang:nm_barang,jumlah:jumlah},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            $("#modal_inputRencanaPembelianBarang").modal('hide');
            alertRencanaPembelianBahan();
            $("#tgl_pembelian").val("")
            $("#jum_pembelian").val("")
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Pembelian Berhasil Ditambah</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Pembelian Gagal Ditambah</b></div>");
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
    function simpanRencanaPembelianBijiWarna()
    {
      var tanggal   = $("#tanggal").val();
      var customer  = $("#nm_customer").val();
      var nm_barang = $("#nama_biji").val();
      var jumlah    = $("#jumlah").val();
      if (!tanggal||!customer||!nm_barang||!jumlah) {
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
        url  : "<?php echo site_url('_purchasing/main/simpanRencanaPembelianBahan'); ?>",
        data : {tanggal:tanggal,customer:customer,nm_barang:nm_barang,jumlah:jumlah},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            $("#modal_inputRencanaPembelianBijiWarna").modal('hide');
            alertRencanaPembelianBijiWarna();
            $("#tgl_pembelian").val("")
            $("#jum_pembelian").val("")
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Pembelian Berhasil Ditambah</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Pembelian Gagal Ditambah</b></div>");
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
    function simpanRencanaPembelianMinyak()
    {
      var tanggal   = $("#tanggal").val();
      var customer  = $("#nm_customer").val();
      var nm_barang = $("#nama_minyak").val();
      var jumlah    = $("#jumlah").val();
      if (!tanggal||!customer||!nm_barang||!jumlah) {
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
        url  : "<?php echo site_url('_purchasing/main/simpanRencanaPembelianBahan'); ?>",
        data : {tanggal:tanggal,customer:customer,nm_barang:nm_barang,jumlah:jumlah},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            $("#modal_inputRencanaPembelianMinyak").modal('hide');
            alertRencanaPembelianMinyak();
            $("#tgl_pembelian").val("")
            $("#jum_pembelian").val("")
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Pembelian Berhasil Ditambah</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Pembelian Gagal Ditambah</b></div>");
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
    function simpanRencanaPembelianCatMurni()
    {
      var tanggal   = $("#tanggal").val();
      var customer  = $("#nm_customer").val();
      var nm_barang = $("#nama_catMurni").val();
      var jumlah    = $("#jumlah").val();
      if (!tanggal||!customer||!nm_barang||!jumlah) {
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
        url  : "<?php echo site_url('_purchasing/main/simpanRencanaPembelianBahan'); ?>",
        data : {tanggal:tanggal,customer:customer,nm_barang:nm_barang,jumlah:jumlah},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            $("#modal_inputRencanaPembelianCatMurni").modal('hide');
            alertRencanaPembelianCatMurni();
            $("#tgl_pembelian").val("")
            $("#jum_pembelian").val("")
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Pembelian Berhasil Ditambah</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Pembelian Gagal Ditambah</b></div>");
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
    function simpanRencanaPembelianCatCampur()
    {
      var tanggal   = $("#tanggal").val();
      var customer  = $("#nm_customer").val();
      var nm_barang = $("#nama_catCampur").val();
      var jumlah    = $("#jumlah").val();
      if (!tanggal||!customer||!nm_barang||!jumlah) {
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
        url  : "<?php echo site_url('_purchasing/main/simpanRencanaPembelianBahan'); ?>",
        data : {tanggal:tanggal,customer:customer,nm_barang:nm_barang,jumlah:jumlah},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            $("#modal_inputRencanaPembelianCatCampur").modal('hide');
            alertRencanaPembelianCatCampur();
            $("#tgl_pembelian").val("")
            $("#jum_pembelian").val("")
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Pembelian Berhasil Ditambah</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencana Pembelian Gagal Ditambah</b></div>");
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
    function getKdBahan(param)
    {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/getGeneratedGudangBahanCode'); ?>",
        success:function(response){
          $("#title_addBahan").text(param)
          $("#kd_gd_bahan").val(response);
          $('#add').attr('onclick','addBahanBaku("'+param+'")');
          if (param=="MINYAK") {
            $("#addWarna").hide();
          }
        }
      });
    }
  </script>
  <script type="text/javascript">
    function addBahanBaku(param)
    {
      var kd_bahan   = $("#kd_gd_bahan").val();
      var kd_accurate= $("#kd_accurate").val();
      var nm_barang  = $("#nmBarang").val();
      var warna      = $("#warna").val();
      var stok       = $("#stok").val();
      var satuan     = $("#satuan").val();
      var status     = $("#status").val();
      var tanggal    = $("#tgl_input").val();
      var jenis      = param;
      if (!kd_bahan||!nm_barang||!stok||!satuan||!status||!tanggal) {
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
        url  : "<?php echo site_url('_purchasing/main/addBahanBaku'); ?>",
        data : {kd_bahan:kd_bahan,kd_accurate:kd_accurate,nm_barang:nm_barang,warna:warna,stok:stok,satuan:satuan,status:status,tanggal:tanggal,jenis:jenis},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            $("#modal_addBahan").modal('hide');
            datatableMasterBahanBaku()
            $("#tgl_pembelian").val("")
            $("#jum_pembelian").val("")
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Bahan Baku Berhasil Ditambah</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Bahan Baku Gagal Ditambah</b></div>");
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
    function deleteStokBahan(id)
    {
      var r = confirm("Hapus List Bahan ?");
      if (r == true) {
        $.ajax({
          type : "POST",
          url  : "<?php echo site_url('_purchasing/main/deleteStokBahan'); ?>",
          data : {id:id},
          success:function(response){
            if (jQuery.trim(response)=="Success"){
              datatableMasterBahanBaku();
              datatableMasterBijiWarna();
              datatableMasterMinyak();
              datatableMasterCatMurni();
              datatableMasterCatCampur();
              countTrashPurceshing();
              $("#modal_addBahanBaku").modal('hide');
              $("#tgl_pembelian").val("")
              $("#jum_pembelian").val("")
              $("#modal-notif").modal("show");
              $("#modalNotifContent").html("<div style='text-align: center;'><b>List Stok Berhasil Dihapus</b></div>");
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
              $("#modalNotifContent").html("<div style='text-align: center;'><b>List Stok Gagal Dihapus</b></div>");
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
    function editStokBahan(id) {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/getDataStokBahanPerId'); ?>",
        data : {id:id},
        dataType : "JSON",
        success:function(response){
          $("#kdBahan").val(response[0].kd_gd_bahan);
          $("#nama_bahan").val(response[0].nm_barang);
          $("#warna_bahan").val(response[0].warna);
          $("#stok_bahan").val(response[0].stok);
          if (response[0].warna =="") {
            $("#kolom_warna").hide();
          }else{
            $("#kolom_warna").show();
          }
          $("#modal_editStokBahan").modal("show");
        }
      });
    }
  </script>
  <script type="text/javascript">
    function updateStokBahan() {
      var kd_bahan  = $("#kdBahan").val();
      var nm_barang = $("#nama_bahan").val();
      var warna     = $("#warna_bahan").val();
      var stok      = $("#stok_bahan").val();
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/updateStokBahan')?>",
        data : {kd_bahan:kd_bahan, nm_barang:nm_barang, warna:warna, stok:stok},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            datatableMasterBahanBaku();
            datatableMasterBijiWarna();
            datatableMasterMinyak();
            datatableMasterCatMurni();
            datatableMasterCatCampur();
            datatableMasterApal();
            datatableMasterSparePart();
            $("#modal_editStokBahan").modal('hide');
            $("#tgl_pembelian").val("")
            $("#jum_pembelian").val("")
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>List Stok Berhasil Diperbarui</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>List Stok Gagal Diperbarui</b></div>");
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
    function listStokHampirHabisSparePart()
    {
      $("#modal_lowStockSparePart").modal({backdrop:"static"});
      datatableLowStockSparePart();
    }
  </script>
  <script type="text/javascript">
    function datatableLowStockSparePart(){
    $("#tableListLowStokSparePart").dataTable().fnDestroy();
    $("#tableListLowStokSparePart").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getLowStockSparePart",
      "columns" : [
        {"data" : "kd_spare_part", "name" : "kd_spare_part"},
        {"data" : "kd_spare_part", "name" : "kd_spare_part"},
        {"data" : "nm_spare_part", "name" : "nm_spare_part"},
        {"data" : "ukuran", "name" : "ukuran"},
        {"data" : "stok", "name" : "stok"},
        {"data" : "kd_spare_part", "name" : "kd_spare_part"}
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
        var stok = aData['stok']/aData['stok_aktual']*100;
        if (stok<20) {
          $("td:eq(4)",nRow).html('<div class="clearfix"><small class="pull-left">'+aData['stok']+'</small></div><div class="progress xs"><div class="progress-bar progress-bar-red" style="width: '+stok+'%;"></div></div>');
        }else {
          $("td:eq(4)",nRow).html('<div class="clearfix"><small class="pull-left">'+aData['stok']+'</small></div><div class="progress xs"><div class="progress-bar progress-bar-yellow" style="width: '+stok+'%;"></div></div>');
        }
        $("td:eq(5)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' style='float:center;' onclick=addRencanaPembelianSparePart('"+aData['kd_spare_part']+"','"+encodeURIComponent(aData['nm_spare_part'])+"') title='Edit'><i class='fa fa-plus'> &nbsp;  Rencana Pembelian &nbsp;</i></button>");
      }
    });
  }
  </script>
  <script type="text/javascript">
    function addRencanaPembelianSparePart(id,nama)
    {
      $("#nm_sparepart").val(decodeURIComponent(nama));
      $("#kd_spare_part").val(id);
      $("#modal_inputRencanaPembelianSparePart").modal("show");
    }
  </script>
  <script type="text/javascript">
    function simpanRencanaPembelianSparePart()
    {
      var kd_spare_part = $("#kd_spare_part").val();
      var nm_spare_part = $("#nm_sparepart").val();
      var tanggal       = $("#tanggal").val();
      var jumlah        = $("#jumlah").val();
      if (!kd_spare_part||!nm_spare_part||!tanggal||!jumlah) {
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
          url  : "<?php echo site_url('_purchasing/main/simpanRencanaPembelianSparePart'); ?>",
          data : {kd_spare_part:kd_spare_part,nm_spare_part:nm_spare_part,tanggal:tanggal,jumlah:jumlah},
          success:function(response){
            if (jQuery.trim(response)=="Success"){
              alertRencanaPembelianSparePart();
              $("#modal_inputRencanaPembelianSparePart").modal('hide');
              $("#modal-notif").modal("show");
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencan Pembelian Berhasil Disimpan</b></div>");
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
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencan Pembelian Gagal Disimpan</b></div>");
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
    function simpanRencanaPembelianSP()
    {
      var kd_spare_part = $("#sparepart").val();
      var tanggal       = $("#tgl_pembelian_sp").val();
      var jumlah        = $("#jum_pembelian_sp").val();
      if (!kd_spare_part||!tanggal||!jumlah) {
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
          url  : "<?php echo site_url('_purchasing/main/simpanRencanaPembelianSparePart'); ?>",
          data : {kd_spare_part:kd_spare_part,tanggal:tanggal,jumlah:jumlah},
          success:function(response){
            if (jQuery.trim(response)=="Success"){
              alertRencanaPembelianSparePart();
              $("#modal_InputRencanaPembelianSparePart").modal('hide');
              $("#modal-notif").modal("show");
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencan Pembelian Berhasil Disimpan</b></div>");
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
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Rencan Pembelian Gagal Disimpan</b></div>");
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
    function listRencanaPembelianSparePart()
    {
      $("#modal_listRencanaPembelianSparePart").modal({backdrop:"static"});
      datatableRencanaPembelianSparePart();
    }
  </script>
  <script type="text/javascript">
  function datatableRencanaPembelianSparePart(){
    $("#tableListRencanaPembelianSparePart").dataTable().fnDestroy();
    $("#tableListRencanaPembelianSparePart").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getListRencanaSparePart",
      "aoColumnDefs": [{ "sWidth": "20%", "aTargets": [ 4 ], "sWidth": "20%", "aTargets": [ 5 ] }],
      "columns" : [
        {"data" : "id", "name" : "id"},
        {"data" : "kd_spare_part", "name" : "kd_spare_part"},
        {"data" : "nm_spare_part", "name" : "nm_spare_part"},
        {"data" : "ukuran", "name" : "ukuran"},
        {"data" : "jumlah", "name" : "jumlah"},
        {"data" : "kd_spare_part", "name" : "kd_spare_part"}
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
        var stok = aData['stok']/aData['stok_aktual']*100;
        $("td:eq(5)",nRow).html("<button class='btn btn-sm btn-flat btn-success' onclick=inputHasilPembelianSparePart('"+aData['id']+"')><i class='fa fa-check'>  Input</i></button><button class='btn btn-sm btn-flat btn-danger' onclick=deleteRencanaPembelianSparePart('"+aData['id']+"')><i class='fa fa-trash'>  Hapus</i></button>");
      }
    });
  }
  </script>
  <script type="text/javascript">
    function deleteRencanaPembelianSparePart(id)
    {
      var r = confirm("Hapus List Rencana..?");
      if (r == true) {
        $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/deleteRencanaPembelianSparePart'); ?>",
        data : {id:id},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            alertRencanaPembelianSparePart();
            datatableRencanaPembelianSparePart()
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
  </script>
  <script type="text/javascript">
    function inputHasilPembelianSparePart(id)
    {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/getDataRencanaPembelianSparePartPerId'); ?>",
        data : {id : id},
        dataType : "JSON",
        success:function(response){
          $("#modal_inputHasilPembelianSparePart").modal({backdrop:"static"});
          $("#id_sparepart").val(response[0].id);
          $("#tgl_transaksi").val(response[0].tgl_transaksi);
          $("#nm_spare_part").val(response[0].nm_spare_part);
          $("#ukuran_sparepart").val(response[0].ukuran);
          $("#jum_rencana").val(response[0].jumlah);
        }
      });
    }
  </script>
  <script type="text/javascript">
    function kirimHasilPembelianSparePart() {
      var id      = $("#id_sparepart").val();
      var tanggal = $("#tgl_pembelian_sparepart").val();
      var jumlah  = $("#jum_pembelian_sparepart").val();
      if (!tgl_pembelian||!jumlah) {
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
          url  : "<?php echo site_url('_purchasing/main/kirimHasilPembelianSparePart'); ?>",
          data : {id:id,tanggal:tanggal,jumlah:jumlah},
          success:function(response){
          if (jQuery.trim(response)=="Success"){
            alertRencanaPembelianSparePart();
            datatableRencanaPembelianSparePart();
            $("#modal_inputHasilPembelianSparePart").modal("hide");
            $("#modal-notif").modal("show");
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
    function getCodeSparePart()
    {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/getCodeSparePart'); ?>",
        dataType : "TEXT",
        success:function(response){
          $("#kd_sparepart").val(response);
        }
      });
    }
  </script>
  <script type="text/javascript">
    function add_SparePart() {
      var kd_spare_part = $("#kd_sparepart").val();
      var kd_accurate   = $("#kd_accurate_sparepart").val();
      var nm_sparepart  = $("#nm_sparePart").val();
      var kode          = $("#kode").val();
      var stok          = $("#stok_sparepart").val();
      var tanggal       = $("#tgl_input_sparepart").val();
      var ukuran        = $("#ukuran_sparePart").val();
      if (!kd_spare_part||!nm_sparepart||!stok||!tanggal) {
        $("#modal-notif").modal("show")
        $("#modalNotifContent").html("<div style='text-align: center;'><b>Kolom Nama Barang, Tanggal dan Stok Harus Diisi</b></div>");
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
          url  : "<?php echo site_url('_purchasing/main/add_SparePart'); ?>",
          data : {kd_spare_part:kd_spare_part,kd_accurate:kd_accurate,nm_sparepart:nm_sparepart,kode:kode,stok:stok,tanggal:tanggal,ukuran:ukuran},
          success:function(response){
            if (jQuery.trim(response)=="Success"){
              $("#modal_addSparePart").modal("hide");
              datatableMasterSparePart();
              $("#modal-notif").modal("show");
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Spare Part Berhasil Ditambah</b></div>");
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
              $("#modalNotifContent").html("<div style='text-align: center;'><b>pare Part Gagal Ditambah</b></div>");
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
    function deleteSparePart(id)
    {
      var r = confirm("Hapus Spare Part..?");
      if (r == true) {
        $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/deleteSparePart'); ?>",
        data : {id:id},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            datatableMasterSparePart();
            countTrashPurceshing()
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Spare Part Berhasil Dihapus</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>pare Part Gagal Dihapus</b></div>");
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
    function editSparePart(id) {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/getStokSparePartPerId'); ?>",
        data : {id:id},
        dataType : "JSON",
        success:function(response){
          $("#kdSparePart").val(response[0].kd_spare_part);
          $("#nama_sparePart").val(response[0].nm_spare_part);
          $("#ukuranSparePart").val(response[0].ukuran);
          $("#stok_awal").val(response[0].stok_aktual);
          $("#stok_sekarang").val(response[0].stok);
          $("#kodeSP").val(response[0].kode);
          $("#modal_editStokSparePart").modal("show");
        }
      });
    }
  </script>
  <script type="text/javascript">
    function updateStokSparePart()
    {
      var kd_spare_part = $("#kdSparePart").val();
      var nm_spare_part = $("#nama_sparePart").val();
      var ukuran        = $("#ukuranSparePart").val();
      var stok_awal     = $("#stok_awal").val();
      var stok_sekarang = $("#stok_sekarang").val();
      var kode          = $("#kodeSP").val();
      if (!kd_spare_part||!nm_spare_part||!stok_awal||!stok_sekarang) {
        $("#modal-notif").modal("show")
        $("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
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
          url  : "<?Php echo site_url('_purchasing/main/updateStokSparePart') ?>",
          data : {kd_spare_part:kd_spare_part,nm_spare_part:nm_spare_part,ukuran:ukuran,stok_awal:stok_awal,stok_sekarang:stok_sekarang,kode:kode},
          success:function(response){
            if (jQuery.trim(response)=="Success"){
              $("#modal_editStokSparePart").modal("hide");
              datatableMasterSparePart();
              $("#modal-notif").modal("show");
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Spare Part Berhasil Diubah</b></div>");
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
              $("#modalNotifContent").html("<div style='text-align: center;'><b>pare Part Gagal Diubah</b></div>");
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
    function cariHistoryBahanBaku(param)
    {
      var tgl_awal = $("#tgl_awal").val();
      var tgl_akhir= $("#tgl_akhir").val();
      var kd_bahan = $("#BahanBaku").val();
      if (!tgl_awal||!tgl_akhir||!kd_bahan) {
        $("#modal-notif").modal("show")
        $("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
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
          url  : "<?php echo site_url('_purchasing/main/getTotalMasukBahanBaku'); ?>",
          data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_bahan:kd_bahan},
          dataType : "JSON",
          success: function(total_masuk){
            if (total_masuk[0].total == null) {
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak ada history <p>ditanggal "+tgl_awal+ " s/d " +tgl_akhir +".</b></div>");
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
                url  : "<?php echo site_url('_purchasing/main/getTotalKeluarBahanBaku'); ?>",
                data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_bahan:kd_bahan},
                dataType : "JSON",
                success:function(total_keluar){
                  $("#tgl_history").text(tgl_awal+" s/d "+tgl_akhir);
                  $("#title_header_history").text(param);
                  $("#modal_searchHistoryBahan").modal("hide");
                  datatableHistoryBahanBaku(tgl_awal,tgl_akhir,kd_bahan)
                  $("#total_masuk").text(total_masuk[0].total);
                  $("#total_keluar").text(total_keluar[0].total);
                  $("#saldo").text(total_masuk[0].total-total_keluar[0].total);
                  $("#modal_historyBahanBaku").modal({backdrop:"static"});
                }
              });
            }
          }
        });
      }
    }
  </script>
  <script type="text/javascript">
  function datatableHistoryBahanBaku(tgl_awal,tgl_akhir,kd_bahan){
    $("#tableHistoryBahanBaku").dataTable().fnDestroy();
    $("#tableHistoryBahanBaku").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getHistoryBahanBaku",
      "columns" : [
        {"data" : "id", "name" : "id"},
        {"data" : "tgl_permintaan", "name" : "tgl_permintaan"},
        {"data" : "keterangan_history", "name" : "keterangan_history"},
        {"data" : "jumlah_permintaan", "name" : "jumlah_permintaan"},
        {"data" : "jumlah_permintaan", "name" : "jumlah_permintaan"}
      ],
      "fnServerData" : function(sSource,aoData,fnCallback){
        aoData.push({"name":"tgl_awal","value":tgl_awal});
        aoData.push({"name":"tgl_akhir","value":tgl_akhir});
        aoData.push({"name":"kd_bahan","value":kd_bahan});
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
        if (aData['status_history']=="MASUK") {
          $("td:eq(3)",nRow).text(aData['jumlah_permintaan']);
          $("td:eq(4)",nRow).text("");
        }
        if (aData['status_history']=="KELUAR") {
          $("td:eq(3)",nRow).text("");
          $("td:eq(4)",nRow).text(aData['jumlah_permintaan']);
        }
      }
    });
  }
  </script>

  <script type="text/javascript">
    function cariHistoryBijiWarna(param)
    {
      var tgl_awal = $("#tgl_awal").val();
      var tgl_akhir= $("#tgl_akhir").val();
      var kd_bahan = $("#BijiWarna").val();
      if (!tgl_awal||!tgl_akhir||!kd_bahan) {
        $("#modal-notif").modal("show")
        $("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
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
          url  : "<?php echo site_url('_purchasing/main/getTotalMasukBahanBaku'); ?>",
          data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_bahan:kd_bahan},
          dataType : "JSON",
          success: function(total_masuk){
            if (total_masuk[0].total == null) {
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak ada history <p>ditanggal "+tgl_awal+ " s/d " +tgl_akhir +".</b></div>");
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
                url  : "<?php echo site_url('_purchasing/main/getTotalKeluarBahanBaku'); ?>",
                data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_bahan:kd_bahan},
                dataType : "JSON",
                success:function(total_keluar){
                  $("#tgl_history").text(tgl_awal+" s/d "+tgl_akhir);
                  $("#title_header_history").text(param);
                  $("#modal_searchHistoryBijiWarna").modal("hide");
                  datatableHistoryBahanBaku(tgl_awal,tgl_akhir,kd_bahan)
                  $("#total_masuk").text(total_masuk[0].total);
                  $("#total_keluar").text(total_keluar[0].total);
                  $("#saldo").text(total_masuk[0].total-total_keluar[0].total);
                  $("#modal_historyBahanBaku").modal({backdrop:"static"});
                }
              });
            }
          }
        });
      }
    }
  </script>
  <script type="text/javascript">
    function cariHistoryMinyak(param)
    {
      var tgl_awal = $("#tgl_awal").val();
      var tgl_akhir= $("#tgl_akhir").val();
      var kd_bahan = $("#Minyak").val();
      if (!tgl_awal||!tgl_akhir||!kd_bahan) {
        $("#modal-notif").modal("show")
        $("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
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
          url  : "<?php echo site_url('_purchasing/main/getTotalMasukBahanBaku'); ?>",
          data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_bahan:kd_bahan},
          dataType : "JSON",
          success: function(total_masuk){
            if (total_masuk[0].total == null) {
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak ada history <p>ditanggal "+tgl_awal+ " s/d " +tgl_akhir +".</b></div>");
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
                url  : "<?php echo site_url('_purchasing/main/getTotalKeluarBahanBaku'); ?>",
                data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_bahan:kd_bahan},
                dataType : "JSON",
                success:function(total_keluar){
                  $("#tgl_history").text(tgl_awal+" s/d "+tgl_akhir);
                  $("#title_header_history").text(param);
                  $("#modal_searchHistoryMinyak").modal("hide");
                  datatableHistoryBahanBaku(tgl_awal,tgl_akhir,kd_bahan)
                  $("#total_masuk").text(total_masuk[0].total);
                  $("#total_keluar").text(total_keluar[0].total);
                  $("#saldo").text(total_masuk[0].total-total_keluar[0].total);
                  $("#modal_historyBahanBaku").modal({backdrop:"static"});
                }
              });
            }
          }
        });
      }
    }
  </script>
  <script type="text/javascript">
    function cariHistoryCatMurni(param)
    {
      var tgl_awal = $("#tgl_awal").val();
      var tgl_akhir= $("#tgl_akhir").val();
      var kd_bahan = $("#CatMurni").val();
      if (!tgl_awal||!tgl_akhir||!kd_bahan) {
        $("#modal-notif").modal("show")
        $("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
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
          url  : "<?php echo site_url('_purchasing/main/getTotalMasukBahanBaku'); ?>",
          data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_bahan:kd_bahan},
          dataType : "JSON",
          success: function(total_masuk){
            if (total_masuk[0].total == null) {
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak ada history <p>ditanggal "+tgl_awal+ " s/d " +tgl_akhir +".</b></div>");
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
                url  : "<?php echo site_url('_purchasing/main/getTotalKeluarBahanBaku'); ?>",
                data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_bahan:kd_bahan},
                dataType : "JSON",
                success:function(total_keluar){
                  $("#tgl_history").text(tgl_awal+" s/d "+tgl_akhir);
                  $("#title_header_history").text(param);
                  $("#modal_searchHistoryCatMurni").modal("hide");
                  datatableHistoryBahanBaku(tgl_awal,tgl_akhir,kd_bahan)
                  $("#total_masuk").text(total_masuk[0].total);
                  $("#total_keluar").text(total_keluar[0].total);
                  $("#saldo").text(total_masuk[0].total-total_keluar[0].total);
                  $("#modal_historyBahanBaku").modal({backdrop:"static"});
                }
              });
            }
          }
        });
      }
    }
  </script>
  <script type="text/javascript">
    function cariHistoryCatCampur(param)
    {
      var tgl_awal = $("#tgl_awal").val();
      var tgl_akhir= $("#tgl_akhir").val();
      var kd_bahan = $("#CatCampur").val();
      if (!tgl_awal||!tgl_akhir||!kd_bahan) {
        $("#modal-notif").modal("show")
        $("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
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
          url  : "<?php echo site_url('_purchasing/main/getTotalMasukBahanBaku'); ?>",
          data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_bahan:kd_bahan},
          dataType : "JSON",
          success: function(total_masuk){
            if (total_masuk[0].total == null) {
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak ada history <p>ditanggal "+tgl_awal+ " s/d " +tgl_akhir +".</b></div>");
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
                url  : "<?php echo site_url('_purchasing/main/getTotalKeluarBahanBaku'); ?>",
                data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_bahan:kd_bahan},
                dataType : "JSON",
                success:function(total_keluar){
                  $("#tgl_history").text(tgl_awal+" s/d "+tgl_akhir);
                  $("#title_header_history").text(param);
                  $("#modal_searchHistoryCatCampur").modal("hide");
                  datatableHistoryBahanBaku(tgl_awal,tgl_akhir,kd_bahan)
                  $("#total_masuk").text(total_masuk[0].total);
                  $("#total_keluar").text(total_keluar[0].total);
                  $("#saldo").text(total_masuk[0].total-total_keluar[0].total);
                  $("#modal_historyBahanBaku").modal({backdrop:"static"});
                }
              });
            }
          }
        });
      }
    }
  </script>
  <script type="text/javascript">
    function cariHistorySparePart()
    {
      var tgl_awal = $("#tgl_awal").val();
      var tgl_akhir= $("#tgl_akhir").val();
      var kd_bahan = $("#SparePart").val();
      if (!tgl_awal||!tgl_akhir||!kd_bahan) {
        $("#modal-notif").modal("show")
        $("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
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
          url  : "<?php echo site_url('_purchasing/main/getTotalMasukSparePart'); ?>",
          data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_bahan:kd_bahan},
          dataType : "JSON",
          success: function(total_masuk){
            if (total_masuk[0].total == null) {
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak ada history <p>ditanggal "+tgl_awal+ " s/d " +tgl_akhir +".</b></div>");
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
                url  : "<?php echo site_url('_purchasing/main/getTotalKeluarSparePart'); ?>",
                data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_bahan:kd_bahan},
                dataType : "JSON",
                success:function(total_keluar){
                  $("#tgl_history_sp").text(tgl_awal+" s/d "+tgl_akhir);
                  $("#modal_searchHistorySparePart").modal("hide");
                  datatableHistorySparePart(tgl_awal,tgl_akhir,kd_bahan)
                  $("#total_masuk_sp").text(total_masuk[0].total);
                  $("#total_keluar_sp").text(total_keluar[0].total);
                  $("#saldo").text(total_masuk[0].total-total_keluar[0].total);
                  $("#modal_historySparePart").modal({backdrop:"static"});
                }
              });
            }
          }
        });
      }
    }
  </script>
  <script type="text/javascript">
  function datatableHistorySparePart(tgl_awal,tgl_akhir,kd_bahan){
    $("#tableHistorySparePart").dataTable().fnDestroy();
    $("#tableHistorySparePart").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getHistorySparePart",
      "columns" : [
        {"data" : "id", "name" : "id"},
        {"data" : "tgl_transaksi", "name" : "tgl_transaksi"},
        {"data" : "keterangan_history", "name" : "keterangan_history"},
        {"data" : "jumlah", "name" : "jumlah"},
        {"data" : "jumlah", "name" : "jumlah"}
      ],
      "fnServerData" : function(sSource,aoData,fnCallback){
        aoData.push({"name":"tgl_awal","value":tgl_awal});
        aoData.push({"name":"tgl_akhir","value":tgl_akhir});
        aoData.push({"name":"kd_bahan","value":kd_bahan});
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
        if (aData['sts_history']=="MASUK") {
          $("td:eq(3)",nRow).text(aData['jumlah']);
          $("td:eq(4)",nRow).text("");
        }
        if (aData['sts_history']=="KELUAR") {
          $("td:eq(3)",nRow).text("");
          $("td:eq(4)",nRow).text(aData['jumlah']);
        }
      }
    });
  }
  </script>
  <script type="text/javascript">
    function datatableTrashBahanBaku(){
    $("#tableTrashBahanBaku").dataTable().fnDestroy();
    $("#tableTrashBahanBaku").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataTrashBahanBaku",
      "columns" : [
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"},
        {"data" : "nm_barang", "name" : "nm_barang"},
        {"data" : "warna", "name" : "warna"},
        {"data" : "stok", "name" : "stok"},
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"}
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
        $("td:eq(3)",nRow).html(parseFloat(aData["stok"]).toFixed(2)+" "+aData["satuan"]);
        $("td:eq(4)",nRow).html("<div style='text-align:center;'><button class='btn btn-sm btn-flat btn-primary' onclick=restoreBahan('"+aData['kd_gd_bahan']+"') title='Edit'><i class='fa fa-refresh'> &nbsp;  Restore &nbsp;</i></button></div>");
      }
    });
  }
  </script>
  <script type="text/javascript">
  function datatableTrashBijiWarna(){
    $("#tableTrashBijiWarna").dataTable().fnDestroy();
    $("#tableTrashBijiWarna").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataTrashBijiWarna",
      "columns" : [
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"},
        {"data" : "nm_barang", "name" : "nm_barang"},
        {"data" : "warna", "name" : "warna"},
        {"data" : "stok", "name" : "stok"},
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"}
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
        $("td:eq(3)",nRow).html(parseFloat(aData["stok"]).toFixed(2)+" "+aData["satuan"]);
        $("td:eq(4)",nRow).html("<div style='text-align:center;'><button class='btn btn-sm btn-flat btn-primary' onclick=restoreBahan('"+aData['kd_gd_bahan']+"') title='Edit'><i class='fa fa-refresh'> &nbsp;  Restore &nbsp;</i></button></div>");
      }
    });
  }
  </script>
  <script type="text/javascript">
  function datatableTrashMinyak(){
    $("#tableTrashMinyak").dataTable().fnDestroy();
    $("#tableTrashMinyak").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataTrashMinyak",
      "columns" : [
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"},
        {"data" : "nm_barang", "name" : "nm_barang"},
        {"data" : "stok", "name" : "stok"},
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"}],
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
        $("td:eq(2)",nRow).html(parseFloat(aData["stok"]).toFixed(2)+" "+aData["satuan"]);
        $("td:eq(3)",nRow).html("<div style='text-align:center;'><button class='btn btn-sm btn-flat btn-primary' onclick=restoreBahan('"+aData['kd_gd_bahan']+"') title='Edit'><i class='fa fa-refresh'> &nbsp;  Restore &nbsp;</i></button></div>");
      }
    });
  }
  </script>
  <script type="text/javascript">
  function datatableTrashCatMurni(){
    $("#tableTrashCatMurni").dataTable().fnDestroy();
    $("#tableTrashCatMurni").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataTrashCatMurni",
      "columns" : [
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"},
        {"data" : "nm_barang", "name" : "nm_barang"},
        {"data" : "warna", "name" : "warna"},
        {"data" : "stok", "name" : "stok"},
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"}],
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
        $("td:eq(3)",nRow).html(parseFloat(aData["stok"]).toFixed(2)+" "+aData["satuan"]);
        $("td:eq(4)",nRow).html("<div style='text-align:center;'><button class='btn btn-sm btn-flat btn-primary' onclick=restoreBahan('"+aData['kd_gd_bahan']+"') title='Edit'><i class='fa fa-refresh'> &nbsp;  Restore &nbsp;</i></button></div>");
      }
    });
  }
  </script>
  <script type="text/javascript">
  function datatableTrashCatCampur(){
    $("#tableTrashCatCampur").dataTable().fnDestroy();
    $("#tableTrashCatCampur").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataTrashCatCampur",
      "columns" : [
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"},
        {"data" : "nm_barang", "name" : "nm_barang"},
        {"data" : "warna", "name" : "warna"},
        {"data" : "stok", "name" : "stok"},
        {"data" : "kd_gd_bahan", "name" : "kd_gd_bahan"}],
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
        $("td:eq(3)",nRow).html(parseFloat(aData["stok"]).toFixed(2)+" "+aData["satuan"]);
        $("td:eq(4)",nRow).html("<div style='text-align:center;'><button class='btn btn-sm btn-flat btn-primary' onclick=restoreBahan('"+aData['kd_gd_bahan']+"') title='Edit'><i class='fa fa-refresh'> &nbsp;  Restore &nbsp;</i></button></div>");
      }
    });
  }
  </script>
  <script type="text/javascript">
  function datatableTrashApal(){
    $("#tableTrashApal").dataTable().fnDestroy();
    $("#tableTrashApal").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataTrashApal",
      "aoColumnDefs": [{ "sWidth": "20%", "aTargets": [ 4 ], "sWidth": "20%", "aTargets": [ 5 ] }],
      "columns" : [
        {"data" : "kd_gd_apal", "name" : "kd_gd_apal"},
        {"data" : "jenis", "name" : "jenis"},
        {"data" : "sub_jenis", "name" : "sub_jenis"},
        {"data" : "stok", "name" : "stok"},
        {"data" : "kd_gd_apal", "name" : "kd_gd_apal"},
        {"data" : "kd_gd_apal", "name" : "kd_gd_apal"}],
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
        $("td:eq(4)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' style='float:right;' onclick=restoreApal('"+aData['kd_gd_apal']+"') title='Edit'><i class='fa fa-refresh'> &nbsp;  Restore &nbsp;</i></button>");
      }
    });
  }
  </script>

  <script type="text/javascript">
  function datatableTrashSparePart(){
    $("#tableTrashSparePart").dataTable().fnDestroy();
    $("#tableTrashSparePart").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getDataTrashSparePart",
      "columns" : [
        {"data" : "kd_spare_part", "name" : "kd_spare_part"},
        {"data" : "nm_spare_part", "name" : "nm_spare_part"},
        {"data" : "ukuran", "name" : "ukuran"},
        {"data" : "stok_aktual", "name" : "stok_aktual"},
        {"data" : "stok", "name" : "stok"},
        {"data" : "kd_spare_part", "name" : "kd_spare_part"}],
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
        var stok = aData['stok']/aData['stok_aktual']*100;
        if (stok<=100 && stok>50) {
          $("td:eq(4)",nRow).html('<div class="clearfix"><small class="pull-left">'+aData['stok']+'</small></div><div class="progress xs"><div class="progress-bar progress-bar-green" style="width: '+stok+'%;"></div></div>');
        }else if(stok<=50 && stok>30) {
          $("td:eq(4)",nRow).html('<div class="clearfix"><small class="pull-left">'+aData['stok']+'</small></div><div class="progress xs"><div class="progress-bar progress-bar-yellow" style="width: '+stok+'%;"></div></div>');
        }else if(stok<=30){
          $("td:eq(4)",nRow).html('<div class="clearfix"><small class="pull-left">'+aData['stok']+'</small></div><div class="progress xs"><div class="progress-bar progress-bar-red" style="width: '+stok+'%;"></div></div>');
        }
        if (aData["kode"] !="") { $("td:eq(1)",nRow).text(aData["nm_spare_part"]+" ( "+aData["kode"]+" )");}
        $("td:eq(5)",nRow).html("<button class='btn btn-sm btn-flat btn-primary' onclick=restoreSparePart('"+aData['kd_spare_part']+"') title='Edit'><i class='fa fa-refresh'> &nbsp;  Restore &nbsp;</i></button>");
      }
    });
  }
  </script>
  <script type="text/javascript">
    function restoreBahan(id)
    {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/restoreBahan'); ?>",
        data : {id:id},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            modalTrashPurchasing();
            datatableMasterBahanBaku();
            datatableMasterBijiWarna();
            datatableMasterMinyak();
            datatableMasterCatMurni();
            datatableMasterCatCampur();
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Bahan Baku Berhasil Dipulihkan</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Bahan Baku Gagal Dipulihkan</b></div>");
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
    function restoreApal(id)
    {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/restoreApal'); ?>",
        data : {id:id},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            modalTrashPurchasing();
            datatableMasterApal();
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Apal Berhasil Dipulihkan</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Apal Gagal Dipulihkan</b></div>");
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
    function restoreSparePart(id)
    {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/restoreSparePart'); ?>",
        data : {id:id},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            modalTrashPurchasing();
            datatableMasterSparePart();
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Spare Part Berhasil Dipulihkan</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>Spare Part Gagal Dipulihkan</b></div>");
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
    function modalTrashPurchasing()
    {
      datatableTrashBahanBaku();
      datatableTrashBijiWarna();
      datatableTrashMinyak();
      datatableTrashCatMurni();
      datatableTrashCatCampur();
      datatableTrashApal();
      datatableTrashSparePart();
      countTrashPurceshing();
    }
  </script>
  <script type="text/javascript">
    function deleteStokApal(id)
    {
      var r = confirm("Hapus Stok Apal..?");
      if (r==true) {
        $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/deleteStokApal'); ?>",
        data : {id:id},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            datatableMasterApal();
            countTrashPurceshing();
            $("#modal_addBahanBaku").modal('hide');
            $("#tgl_pembelian").val("")
            $("#jum_pembelian").val("")
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>List Stok Berhasil Dihapus</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>List Stok Gagal Dihapus</b></div>");
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
    function editStokApal(id)
    {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/getStokApalPerId'); ?>",
        data : {id:id},
        dataType : "JSON",
        success:function(response){
          $("#kd_gd_apal").val(response[0].kd_gd_apal);
          $("#jenis_apal").val(response[0].jenis);
          $("#warna_apal").val(response[0].sub_jenis);
          $("#stok_apal").val(response[0].stok);
          $("#modal_editStokApal").modal('show');
        }
      });
    }
  </script>
  <script type="text/javascript">
    function updateStokApal()
    {
      var id    = $("#kd_gd_apal").val();
      var stok  = $("#stok_apal").val();
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/updateStokApal'); ?>",
        data : {id:id,stok:stok},
        success:function(response){
          if (jQuery.trim(response)=="Success"){
            datatableMasterApal();
            $("#modal_addBahanBaku").modal('hide');
            $("#tgl_pembelian").val("")
            $("#jum_pembelian").val("")
            $("#modal-notif").modal("show");
            $("#modalNotifContent").html("<div style='text-align: center;'><b>List Stok Berhasil Diubah</b></div>");
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
            $("#modalNotifContent").html("<div style='text-align: center;'><b>List Stok Gagal Diubah</b></div>");
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
    function countTrashPurceshing() {
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('_purchasing/main/countTrashPurceshing'); ?>",
        success:function(response){
          $("#numTrashPurchasing").text(response);
        }
      });
    }
  </script>
  <script type="text/javascript">
    function cariHistoryApal()
    {
      var tgl_awal  = $("#tgl_awal").val();
      var tgl_akhir = $("#tgl_akhir").val();
      var kd_apal   = $("#Apal").val();

      if (!tgl_awal||!tgl_akhir||!kd_apal) {
        $("#modal-notif").modal("show")
        $("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
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
          url  : "<?php echo site_url('_purchasing/main/getTotalMasukApal'); ?>",
          data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_apal:kd_apal},
          dataType : "JSON",
          success: function(total_masuk){
            if (total_masuk[0].total == null) {
              $("#modal-notif").modal("show")
              $("#modalNotifContent").html("<div style='text-align: center;'><b>Tidak ada history <p>ditanggal "+tgl_awal+ " s/d " +tgl_akhir +".</b></div>");
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
                url  : "<?php echo site_url('_purchasing/main/getTotalKeluarApal'); ?>",
                data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kd_apal:kd_apal},
                dataType : "JSON",
                success:function(total_keluar){
                  $("#tgl_history_apal").text(tgl_awal+" s/d "+tgl_akhir);
                  $("#modal_searchHistoryApal").modal("hide");
                  $("#total_masuk_apal").text(total_masuk[0].total);
                  $("#total_keluar_apal").text(total_keluar[0].total);
                  $("#saldo_apal").text(total_masuk[0].total-total_keluar[0].total);
                  datatableHistoryApal(tgl_awal,tgl_akhir,kd_apal)
                  $("#modal_historyApal").modal({backdrop:"static"});
                }
              });
            }
          }
        });
      }
    }
  </script>

  <script type="text/javascript">
  function datatableHistoryApal(tgl_awal,tgl_akhir,kd_apal){
    $("#tableHistoryApal").dataTable().fnDestroy();
    $("#tableHistoryApal").dataTable({
			// "fixedHeader" : true,
      "autoWidth" : false,
      "ordering" : false,
      "bProcessing" : true,
      "bServerSide" : true,
      "bJQueryUI" : true,
      "sPaginationType" : "full_numbers",
      "sAjaxSource" : "<?php echo base_url(); ?>_purchasing/main/getHistoryApal",
      "columns" : [
        {"data" : "id", "name" : "id"},
        {"data" : "tgl_transaksi", "name" : "tgl_transaksi"},
        {"data" : "keterangan_history", "name" : "keterangan_history"},
        {"data" : "jumlah_apal", "name" : "jumlah_apal"},
        {"data" : "jumlah_apal", "name" : "jumlah_apal"}
      ],
      "fnServerData" : function(sSource,aoData,fnCallback){
        aoData.push({"name":"tgl_awal","value":tgl_awal});
        aoData.push({"name":"tgl_akhir","value":tgl_akhir});
        aoData.push({"name":"kd_apal","value":kd_apal});
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
        if (aData['status_history']=="MASUK") {
          $("td:eq(3)",nRow).text(aData['jumlah_apal']);
          $("td:eq(4)",nRow).text("");
        }
        if (aData['status_history']=="KELUAR") {
          $("td:eq(3)",nRow).text("");
          $("td:eq(4)",nRow).text(aData['jumlah_apal']);
        }
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
			"info" : false,
			"sPaginationType": "full_numbers",
			"sAjaxSource":"<?php echo base_url(); ?>_purchasing/main/getPermintaanBarang",
			"columns":[
				{"data" : "kd_permintaan_barang","name":"TPB.kd_permintaan_barang"},
				{"data" : "kd_permintaan_barang","name":"TPB.kd_permintaan_barang"},
				{"data" : "tgl_permintaan","name":"TPB.tgl_permintaan"},
				{"data" : "status_permintaan","name":"TPB.status_permintaan"},
				{"data" : "jenis","name":"GB.jenis"},
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
				$("td:eq(6)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalLihatDetailPermintaan('"+aData["kd_permintaan_barang"]+"')>Lihat Permintaan</button>"+
																"<a href='<?php echo base_url('_purchasing/main/printBonPermintaanBarang/') ?>"+aData["kd_permintaan_barang"]+"' target='_blank' class='btn btn-md btn-flat btn-success'>Cetak Bon Permintaan</a>");//+
																//"<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestorePermintaanBarang('"+aData["kd_permintaan_barang"]+"','TRUE')>Hapus</button>");
			}
		});
	}

	function modalLihatDetailPermintaan(param){
		$("#modalLihatPesanan").modal({
			backdrop:"static"
		});
		$("#btnSetujuiPermintaanBarang").attr("onclick","setujuiPermintaanBarang('"+param+"')");
		datatablesDetailPermintaan(param);
	}

	function modalLihatDetailPermintaanSparePart(param){
		$("#modalLihatPesanan").modal({
			backdrop:"static"
		});
		$("#btnSetujuiPermintaanBarang").attr("onclick","setujuiPermintaanSparePart('"+param+"')");
		datatablesDetailPermintaanSparePart(param);
	}

	function setujuiPermintaanBarang(param){
		if(confirm("Apakah Anda Yakin Menyetujui Permintaan Ini?")){
			$.ajax({
				type : "POST",
				url : "<?php echo base_url('_purchasing/main/setujuiPermintaanBarang') ?>",
				dataType : "TEXT",
				data : {
					idPermintaan : param
				},
				success : function(response){
					if($.trim(response) === "Berhasil"){
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Item Permintaan Berhasil Disetujui</b></div>");
						$("#modal-notif").addClass("modal-info");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$(".active a").trigger("click");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-info");
							$("#modalNotifContent").text("");
						},3000);
					}else{
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Item Permintaan Gagal Disetujui</b></div>");
						$("#modal-notif").addClass("modal-danger");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$(".active a").trigger("click");
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

	function setujuiPermintaanSparePart(param){
		if(confirm("Apakah Anda Yakin Menyetujui Permintaan Ini?")){
			$.ajax({
				type : "POST",
				url : "<?php echo base_url('_purchasing/main/setujuiPermintaanSparePart') ?>",
				dataType : "TEXT",
				data : {
					idPermintaan : param
				},
				success : function(response){
					if($.trim(response) === "Berhasil"){
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Item Permintaan Berhasil Disetujui</b></div>");
						$("#modal-notif").addClass("modal-info");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$(".active a").trigger("click");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-info");
							$("#modalNotifContent").text("");
						},3000);
					}else{
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Item Permintaan Gagal Disetujui</b></div>");
						$("#modal-notif").addClass("modal-danger");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$(".active a").trigger("click");
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

	function modalBatalkanPermintaan(param1, param2){
		$("#modalBatalPermintaan").modal({
			backdrop : "static"
		});
		$("#btnBatalPermintaan").attr("onclick","batalkanPermintaan('"+param1+"','"+param2+"')");
	}

	function modalAktifkanPermintaan(param1, param2){
		$("#modalAktifkanPermintaan").modal({
			backdrop : "static"
		});
		$("#btnAktifkanPermintaan").attr("onclick","aktifkanPermintaan('"+param1+"','"+param2+"')");
	}

	function modalBatalkanPermintaanSparePart(param1, param2){
		$("#modalBatalPermintaan").modal({
			backdrop : "static"
		});
		$("#btnBatalPermintaan").attr("onclick","batalkanPermintaanSparePart('"+param1+"','"+param2+"')");
	}

	function modalAktifkanPermintaanSparePart(param1, param2){
		$("#modalAktifkanPermintaan").modal({
			backdrop : "static"
		});
		$("#btnAktifkanPermintaan").attr("onclick","aktifkanPermintaanSparePart('"+param1+"','"+param2+"')");
	}

	function batalkanPermintaan(param,param2){
		var keteranganPurchasing = $("#txtKeteranganPurchasing").val();
		if(keteranganPurchasing == ""){
			$("#modal-notif").modal("show")
			$("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
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
				url : "<?php echo base_url('_purchasing/main/batalkanPermintaan') ?>",
				dataType : "TEXT",
				data : {
					idTransaksi : param,
					idPermintaan : param2,
					keteranganPurchasing : keteranganPurchasing
				},
				success : function(response){
					if($.trim(response) === "Berhasil"){
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Item Permintaan Berhasil Dibatalkan</b></div>");
						$("#modal-notif").addClass("modal-info");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$(".active a").trigger("click");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-info");
							$("#modalNotifContent").text("");
						},3000);
					}else if($.trim(response) === "Gagal"){
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Item Permintaan Gagal Dibatalkan</b></div>");
						$("#modal-notif").addClass("modal-danger");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-danger");
							$("#modalNotifContent").text("");
						},3000);
					}else{
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
						$("#modal-notif").addClass("modal-warning");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},3000);
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

	function aktifkanPermintaan(param,param2){
		var statusPermintaan = $("#cmbStatusPermintaan").val();
		if(statusPermintaan == ""){
			$("#modal-notif").modal("show")
			$("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
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
				url : "<?php echo base_url('_purchasing/main/aktifkanPermintaan') ?>",
				dataType : "TEXT",
				data : {
					idTransaksi : param,
					idPermintaan : param2,
					statusPermintaan : statusPermintaan
				},
				success : function(response){
					if($.trim(response) === "Berhasil"){
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Item Permintaan Berhasil Diaktifkan</b></div>");
						$("#modal-notif").addClass("modal-info");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$(".active a").trigger("click");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-info");
							$("#modalNotifContent").text("");
						},3000);
					}else if($.trim(response) === "Gagal"){
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Item Permintaan Gagal Diaktifkan</b></div>");
						$("#modal-notif").addClass("modal-danger");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-danger");
							$("#modalNotifContent").text("");
						},3000);
					}else{
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
						$("#modal-notif").addClass("modal-warning");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},3000);
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

	function batalkanPermintaanSparePart(param,param2){
		var keteranganPurchasing = $("#txtKeteranganPurchasing").val();
		if(keteranganPurchasing == ""){
			$("#modal-notif").modal("show")
			$("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
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
				url : "<?php echo base_url('_purchasing/main/batalkanPermintaanSparePart') ?>",
				dataType : "TEXT",
				data : {
					idTransaksi : param,
					idPermintaan : param2,
					keteranganPurchasing : keteranganPurchasing
				},
				success : function(response){
					if($.trim(response) === "Berhasil"){
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Item Permintaan Berhasil Dibatalkan</b></div>");
						$("#modal-notif").addClass("modal-info");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$(".active a").trigger("click");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-info");
							$("#modalNotifContent").text("");
						},3000);
					}else if($.trim(response) === "Gagal"){
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Item Permintaan Gagal Dibatalkan</b></div>");
						$("#modal-notif").addClass("modal-danger");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-danger");
							$("#modalNotifContent").text("");
						},3000);
					}else{
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
						$("#modal-notif").addClass("modal-warning");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},3000);
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

	function aktifkanPermintaanSparePart(param,param2){
		var statusPermintaan = $("#cmbStatusPermintaan").val();
		if(statusPermintaan == ""){
			$("#modal-notif").modal("show")
			$("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
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
				url : "<?php echo base_url('_purchasing/main/aktifkanPermintaanSparePart') ?>",
				dataType : "TEXT",
				data : {
					idTransaksi : param,
					idPermintaan : param2,
					statusPermintaan : statusPermintaan
				},
				success : function(response){
					if($.trim(response) === "Berhasil"){
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Item Permintaan Berhasil Diaktifkan</b></div>");
						$("#modal-notif").addClass("modal-info");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$(".active a").trigger("click");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-info");
							$("#modalNotifContent").text("");
						},3000);
					}else if($.trim(response) === "Gagal"){
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Item Permintaan Gagal Diaktifkan</b></div>");
						$("#modal-notif").addClass("modal-danger");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-danger");
							$("#modalNotifContent").text("");
						},3000);
					}else{
						$("#modal-notif").modal("show")
						$("#modalNotifContent").html("<div style='text-align: center;'><b>Semua kolom harus diisi.</b></div>");
						$("#modal-notif").addClass("modal-warning");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
						},2000);
						setTimeout(function(){
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},3000);
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

	function datatablesDetailPermintaan(param){
		$("#tableDetailPermintaan").dataTable().fnDestroy();
		$("#tableDetailPermintaan").dataTable({
			// "fixedHeader" : true,
			"autoWidth" : false,
			"ordering" : false,
			"bProcessing" : true,
			"bServerSide" : true,
			"sPaginationType": "full_numbers",
			"sAjaxSource":"<?php echo base_url(); ?>_purchasing/main/getDetailPermintaanBaru",
			"columns":[
				{"data" : "id_dpb","name":"TDPB.id_dpb"},
				{"data" : "nm_barang","name":"GB.nm_barang"},
				{"data" : "warna","name":"GB.warna"},
				{"data" : "jumlah_permintaan","name":"TDPB.jumlah_permintaan"},
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
				if(aData["status_permintaan"] == "PENDING"){
					$("td:eq(6)",nRow).html(//"<button class='btn btn-md btn-flat btn-default'><i class='fa fa-lock'></i> Permintaan Belum Disetujui Oleh Purchasing</button>"+
																	"<button class='btn btn-md btn-flat btn-danger' onclick=modalBatalkanPermintaan('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"')>Batalkan Permintaan</button>");
				}else if(aData["status_permintaan"] == "CANCEL"){
					$("td:eq(6)",nRow).html(//"<button class='btn btn-md btn-flat btn-default'><i class='fa fa-lock'></i> Permintaan Belum Disetujui Oleh Purchasing</button>"+
																	"<button class='btn btn-md btn-flat btn-success' onclick=modalAktifkanPermintaan('"+aData["id_dpb"]+"','"+aData["kd_permintaan_barang"]+"')>Aktifkan Permintaan</button>");
				}else{
					$("td:eq(6)",nRow).html(//"<button class='btn btn-md btn-flat btn-default'><i class='fa fa-lock'></i> Permintaan Belum Disetujui Oleh Purchasing</button>"+
																	"<button class='btn btn-md btn-flat btn-default')><i class='fa fa-lock'></i> Tidak Ada Aksi</button>");
				}
			}
		});
	}

	function datatablesDetailPermintaanSparePart(param){
		$("#tableDetailPermintaan").dataTable().fnDestroy();
		$("#tableDetailPermintaan").dataTable({
			// "fixedHeader" : true,
			"autoWidth" : false,
			"ordering" : false,
			"bProcessing" : true,
			"bServerSide" : true,
			"sPaginationType": "full_numbers",
			"sAjaxSource":"<?php echo base_url(); ?>_purchasing/main/getDetailPermintaanSparePartBaru",
			"columns":[
				{"data" : "id_dpsp","name":"TDPB.id_dpsp"},
				{"data" : "nm_spare_part","name":"GB.nm_spare_part"},
				{"data" : "ukuran","name":"GB.ukuran"},
				{"data" : "jumlah_permintaan","name":"TDPB.jumlah_permintaan"},
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
				if(aData["status_permintaan"] == "PENDING"){
					$("td:eq(6)",nRow).html(//"<button class='btn btn-md btn-flat btn-default'><i class='fa fa-lock'></i> Permintaan Belum Disetujui Oleh Purchasing</button>"+
																	"<button class='btn btn-md btn-flat btn-danger' onclick=modalBatalkanPermintaanSparePart('"+aData["id_dpsp"]+"','"+aData["kd_permintaan_spare_part"]+"')>Batalkan Permintaan</button>");
				}else if(aData["status_permintaan"] == "CANCEL"){
					$("td:eq(6)",nRow).html(//"<button class='btn btn-md btn-flat btn-default'><i class='fa fa-lock'></i> Permintaan Belum Disetujui Oleh Purchasing</button>"+
																	"<button class='btn btn-md btn-flat btn-success' onclick=modalAktifkanPermintaanSparePart('"+aData["id_dpsp"]+"','"+aData["kd_permintaan_spare_part"]+"')>Aktifkan Permintaan</button>");
				}else{
					$("td:eq(6)",nRow).html(//"<button class='btn btn-md btn-flat btn-default'><i class='fa fa-lock'></i> Permintaan Belum Disetujui Oleh Purchasing</button>"+
																	"<button class='btn btn-md btn-flat btn-default')><i class='fa fa-lock'></i> Tidak Ada Aksi</button>");
				}
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
			"info"	: false,
			"sPaginationType": "full_numbers",
			"sAjaxSource":"<?php echo base_url(); ?>_purchasing/main/getPermintaanSparePart",
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
																"<a href='<?php echo base_url('_purchasing/main/printBonPermintaanSparePart/') ?>"+aData["kd_permintaan_spare_part"]+"' target='_blank' class='btn btn-md btn-flat btn-success'>Cetak Bon Permintaan</a>");
			}
		});
	}

	function datatableDataPenerimaanBarang(){
		$("#tablePenerimaanBarang").dataTable().fnDestroy();
		$("#tablePenerimaanBarang").dataTable({
			// "fixedHeader" : true,
			"autoWidth" : false,
			"ordering" : false,
			"bProcessing" : true,
			"bServerSide" : true,
			"sPaginationType": "full_numbers",
			"sAjaxSource":"<?php echo base_url(); ?>_purchasing/main/getBuktiPenerimaanBarang",
			"columns":[
				{"data" : "kd_bpb","name":"TBPB.kd_bpb"},
				{"data" : "kd_permintaan_barang","name":"TPB.kd_permintaan_barang"},
				{"data" : "nm_barang","name":"GB.nm_barang"},
				{"data" : "warna","name":"GB.warna"},
				{"data" : "jumlah_permintaan","name":"TDPB.jumlah_permintaan"},
				{"data" : "jumlah_terima","name":"TBPB.jumlah_terima"},
				{"data" : "tgl_terima","name":"TBPB.tgl_terima"},
				{"data" : "username","name":"USR.username"},
				{"data" : "kd_bpb","name":"TBPB.kd_bpb"}
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
				if(aData["jenis"] == "MINYAK"){
					switch (aData["nm_barang"].toUpperCase()) {
						case "SMT":
							$("td:eq(4)",nRow).text((parseFloat(aData["jumlah_permintaan"]) / 156).toLocaleString());
							$("td:eq(5)",nRow).text((parseFloat(aData["jumlah_terima"]) / 156).toLocaleString());
							break;
						case "IPA":
							$("td:eq(4)",nRow).text((parseFloat(aData["jumlah_permintaan"]) / 160).toLocaleString());
							$("td:eq(5)",nRow).text((parseFloat(aData["jumlah_terima"]) / 160).toLocaleString());
							break;
						case "REDUSER-SABLON-FR001":
							$("td:eq(4)",nRow).text((parseFloat(aData["jumlah_permintaan"]) / 15).toLocaleString());
							$("td:eq(5)",nRow).text((parseFloat(aData["jumlah_terima"]) / 15).toLocaleString());
							break;
						default:
							$("td:eq(4)",nRow).text((parseFloat(aData["jumlah_permintaan"]) / 170).toLocaleString());
							$("td:eq(5)",nRow).text((parseFloat(aData["jumlah_terima"]) / 170).toLocaleString());
						break;
					}
				}else{
					$("td:eq(4)",nRow).text((parseFloat(aData["jumlah_permintaan"])).toLocaleString());
					$("td:eq(5)",nRow).text((parseFloat(aData["jumlah_terima"])).toLocaleString());
				}
				$("td:eq(0)",nRow).text(++iDisplayIndex);
				$("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-primary'>Print</button>");
			}
		});
	}

	function datatableDataPenerimaanSparePart(){
		$("#tablePenerimaanSparePart").dataTable().fnDestroy();
		$("#tablePenerimaanSparePart").dataTable({
			// "fixedHeader" : true,
			"autoWidth" : false,
			"ordering" : false,
			"bProcessing" : true,
			"bServerSide" : true,
			"sPaginationType": "full_numbers",
			"sAjaxSource":"<?php echo base_url(); ?>_purchasing/main/getBuktiPenerimaanSparePart",
			"columns":[
				{"data" : "kd_bpsp","name":"TBPSP.kd_bpsp"},
				{"data" : "kd_permintaan_spare_part","name":"TPSP.kd_permintaan_spare_part"},
				{"data" : "nm_spare_part","name":"SP.nm_spare_part"},
				{"data" : "ukuran","name":"SP.ukuran"},
				{"data" : "jumlah_permintaan","name":"TDPSP.jumlah_permintaan"},
				{"data" : "jumlah_terima","name":"TBPSP.jumlah_terima"},
				{"data" : "tgl_terima","name":"TBPSP.tgl_terima"},
				{"data" : "username","name":"USR.username"},
				{"data" : "kd_bpsp","name":"TBPSP.kd_bpsp"}
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
				$("td:eq(4)",nRow).text((parseFloat(aData["jumlah_permintaan"])).toLocaleString());
				$("td:eq(5)",nRow).text((parseFloat(aData["jumlah_terima"])).toLocaleString());
				$("td:eq(0)",nRow).text(++iDisplayIndex);
				$("td:eq(8)",nRow).html("<button class='btn btn-md btn-flat btn-primary'>Print</button>");
			}
		});
	}

	function modalTambahPembelianBahanBaku(param){
		var placeholder = param.replace("_"," ");

		$.ajax({
			url : "<?php echo base_url('_purchasing/main/getGeneratedRequestCode'); ?>",
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
				url : "<?php echo base_url(); ?>_purchasing/main/getComboBoxValueBahan/"+param,
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
				url : "<?php echo base_url(); ?>_purchasing/main/getDetailBarangBahan",
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

	function tableListPembelianBahanBakuTemp(param){
		$.ajax({
			type : "POST",
			url : "<?php echo base_url(); ?>_purchasing/main/getPembelianGudangBahanTemp",
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
				url : "<?php echo base_url(); ?>_purchasing/main/addPembelianGudangBahanTemp",
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

	function saveDanKirimPermintaan(param){
		$.ajax({
			type : "POST",
			url : "<?php echo base_url(); ?>_purchasing/main/savePembelianGudangBahan",
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

	function modalEditPembelianBahanTemp(param, param2){
		$.ajax({
			type : "POST",
			url : "<?php echo base_url(); ?>_purchasing/main/getDetailItemPembelianGudangBahanTemp",
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
				url : "<?php echo base_url(); ?>_purchasing/main/editPembelianGudangBahanTemp",
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

	function deletePembelianTemp(param,param2){
		if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini")){
			$.ajax({
				type : "POST",
				url : "<?php echo base_url() ?>_purchasing/main/removePembelianTemp",
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
								case "BAHAN_BAKU":tableListPembelianBahanBakuTemp(param2.replace(/_/gi," "));break;
								case "MINYAK":tableListPembelianBahanBakuTemp(param2.replace(/_/gi," "));break;
								default: break;
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
  </script>
	</body>
</html>
