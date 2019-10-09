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
			$(function(){
				dataTablePesananTemp();
				dataTablePantauOrder();
				getCountPesananApprove();
				getCountTrash();
				dataTableApproveOrder();
				setInterval(function(){
					getCountPesananApprove();
					getCountTrash();
				},60000);
				$(".date").datepicker({
					language: 'id',
					viewMode: 'years',
					format: 'yyyy-mm-dd',
					autoclose : true,
					todayHighlight : true
				});
			});
		</script>
		<script type="text/javascript">
			function modalOrderCabang(){
				$("#txtJumlah").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});

				$(".date").datepicker({
					language: 'id',
					viewMode: 'years',
					format: 'yyyy-mm-dd',
					autoclose : true,
					todayHighlight : true
				});

				$("#cmbUkuran").select2({
					placeholder : "Pilih Ukuran Barang",
					dropdownParent: $('#modalOrder'),
					width : "100%",
					cache:true,
					allowClear:true,
					ajax:{
						url : "<?php echo base_url(); ?>_cabang/main/getComboBoxValueHasil/",
						dataType : "JSON",
						delay : 250,
						processResults : function(data){
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
					}
				});

				$("#cmbUkuran").on("select2:select",function(){
					var kode = $(this).val();
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_cabang/main/getGudangHasilDetailId",
						dataType : "JSON",
						data : {kode:kode},
						success : function(response){
							$("#txtMerek").val(response[0].merek);
							$("#txtUkuran").val(response[0].ukuran);
							$("#txtWarnaPlastik").val(response[0].warna_plastik);
						}
					});
				});

				$("#cmbUkuran").on("select2:unselect",function(){
					$("#txtMerek").val("");
					$("#txtUkuran").val("");
					$("#txtWarnaPlastik").val("");
				});
			}

			function saveDetailOrderTemp(){
				var noOrder = $("#txtNoOrder").val();
				var kdCust = $("#txtKdCust").val();
				var kode = $("#cmbUkuran").val();
				var merek = $("#txtMerek").val();
				var strip = $("#txtStrip").val();
				var jenis = $("#cmbJenis").val();
				var warnaCetak = $("#txtCetak").val();
				var tebal = $("#txtTebal").val();
				var jumlah = $("#txtJumlah").val().replace(/,/g,"");
				var satuan = $("#cmbSatuan").val();
				var keterangan = $("#txtKeterangan").val();

				if(noOrder=="" || kode=="" ||
					 merek=="" || strip=="" || jenis=="" ||
				 	 warnaCetak=="" || tebal=="" || jumlah=="" ||
				 	 satuan==""
				 ){
					 $("#modal-notif").addClass("modal-warning");
					 $("#modalNotifContent").text("Kolom Berwarna Kuning Tidak Boleh Kosong!");
					 $("#modal-notif").modal("show");
					 setTimeout(function(){
						 $("#modal-notif").modal("hide");
						 $("#modal-notif").removeClass("modal-warning");
						 $("#modalNotifContent").text("");
					 },2000);
				 }else{
					 $.ajax({
						 type : "POST",
						 url : "<?php echo base_url(); ?>_cabang/main/savePesananDetaiTemp",
						 dataType : "TEXT",
						 data : {no_order:noOrder,kd_cust:kdCust,kd_barang:kode,
						 				 merek:merek,strip:strip,jenis:jenis,warna_cetak:warnaCetak,
									 	 tebal:tebal,jumlah:jumlah,satuan:satuan,ket:keterangan},
						 success : function(response){
							 if(jQuery.trim(response) === "Berhasil"){
								 $("#modal-notif").addClass("modal-info");
								 $("#modalNotifContent").text("Pesanan anda berhasil ditambahkan");
								 $("#modal-notif").modal("show");
								 setTimeout(function(){
									 $("#modal-notif").modal("hide");
									 $("#modal-notif").removeClass("modal-info");
									 $("#modalNotifContent").text("");
									 resetForm();
									 dataTablePesananTemp();
								 },2000);
							 }else if(jQuery.trim(response) === "Gagal"){
									 $("#modal-notif").addClass("modal-danger");
									 $("#modalNotifContent").text("Pesanan anda gagal ditambahkan");
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
						 }
					 });
				 }
			}

			function savePesananFinal(){
				if(confirm("Apakah anda yakin pesanan sudah benar dan akan diteruskan untu di approve?")){
					var noOrder1 = $("#txtNoOrder").val();
					var kdCust1 = $("#txtKdCust").val();
					var noPo1 = $("#txtNoPo").val();
					var nmCust1 = $("#txtNmCust").val();
					var tglPesan1 = $("#txtTglPesan").val();

					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_cabang/main/savePesananFinal",
						dataType : "TEXT",
						data : {noOrder:noOrder1,kdCust:kdCust1,noPo:noPo1,nmCust:nmCust1,tglPesan:tglPesan1},
						success : function(response){
							if(jQuery.trim(response) === "DPM"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Pesanan anda berhasil diteruskan untuk di approve");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									dataTablePesananTemp();
									location.reload();
								},2500);
							}else if(jQuery.trim(response) === "DPGM"){
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Item pesanan anda gagal diteruskan untuk di approve!");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-warning");
									$("#modalNotifContent").text("");
									dataTablePesananTemp();
								},2000);
							}else if(jQuery.trim(response) === "PGM"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Pesanan anda gagal diteruskan untuk di approve!");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
									dataTablePesananTemp();
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data anda tidak boleh kosong!");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
									dataTablePesananTemp();
								},2000);
							}
						}
					});
				}
			}

			function resetForm(){
				$("#cmbUkuran").val("");
				$("#txtMerek").val("");
				$("#txtStrip").val("");
				$("#cmbJenis").val("STANDARD");
				$("#txtCetak").val("");
				$("#txtTebal").val("");
				$("#txtJumlah").val("");
				$("#cmbSatuan").val("BAL");
				$("#txtKeterangan").val("");
			}

			function deletePesananDetailTemp(param){
				if(confirm("Apakah anda yakin ingin menghapus?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url() ?>_cabang/main/removePesananDetailTempId",
						dataType : "TEXT",
						data : {id : param},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Pesanan anda berhasil dihapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									dataTablePesananTemp();
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Pesanan anda gagal dihapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}
						}
					});
				}else{
					$("#modal-notif").addClass("modal-success");
					$("#modalNotifContent").text("Pesanan anda tidak jadi dihapus");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-success");
						$("#modalNotifContent").text("");
					},2000);
				}
			}

			function printOutOrder(param){
				if(confirm("Apakah anda yakin ingin mencetak faktur?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_cabang/main/updatePesananPrintOut",
						dataType : "TEXT",
						data : {noOrder : param},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modalPrintOut").modal("show");
								$("#cetakFakturLoad").attr("src","<?php echo base_url(); ?>_cabang/main/cetakFaktur/"+param);
								dataTablePantauOrder();
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Faktur anda gagal di print");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-warning");
									$("#modalNotifContent").text("");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("No. Order Tidak Boleh Kosong!");
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

			function getCountPesananApprove(){
				$.ajax({
					url : "<?php echo base_url(); ?>_cabang/main/getCountPesananApprove",
					dataType : "JSON",
					success : function(response){
						$("#M_Approve_Permintaan").html("<span class='fa fa-check'></span>Approve Permintaan <span class='label bg-yellow pull-right'>"+response[0].jumlah+"</span>");
					}
				});
			}

			function getCountTrash(){
				$.ajax({
					url : "<?php echo base_url(); ?>_cabang/main/getCountTrash",
					dataType : "JSON",
					success : function(response){
						$("#count-trash").text(response[0].jumlah);
					}
				});
			}

			function cariHistoryOrder(){
				var tglAwal1 = $("#txtTglAwal").val();
				var tglAkhir1 = $("#txtTglAkhir").val();
				var status1 = $("#cmbStatus").val();

				$("#tableHistoryOrder").dataTable().fnDestroy();
				$("#tableHistoryOrder").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "200px",
					"sPaginationType": "full_numbers",
					"iDisplayStart ": 20,
					"sAjaxSource":"<?php echo base_url(); ?>_cabang/main/getDatatablesCariHistory",
					"columns":[
						{"data" : "no_order","name":"no_order"},
						{"data" : "tgl_pesan","name":"tgl_pesan"},
						{"data" : "no_po","name":"no_po"},
						{"data" : "nm_pemesan","name":"nm_pemesan"},
						{"data" : "approve_cabang","name":"approve_cabang"},
						{"data" : "no_order","name":"no_order"}
					],
					"fnServerData": function (sSource, aoData, fnCallback){
						aoData.push({"name":"tglAwal","value":tglAwal1});
						aoData.push({"name":"tglAkhir","value":tglAkhir1});
						aoData.push({"name":"status","value":status1});
						$.ajax({
										 "dataType": "json",
										 "type": "POST",
										 "url": sSource,
										 "data": aoData,
										 "success": fnCallback
								 });
					},
					"fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
						var no = iDisplayIndex;
						$("td:eq(0)",nRow).text(++no);
						if(aData["approve_cabang"]=="FALSE") {
							("td:eq(4)",nRow).html("<label class='text-yellow'>WAITING TO APPROVED</label>");
						}else{
							switch (aData["sts_pesanan"]) {
								case "WAITING": $("td:eq(4)",nRow).html("<label class='text-yellow'>"+aData["sts_pesanan"]+"</label>");break;
								case "OPEN" : $("td:eq(4)",nRow).html("<label class='text-light-blue'>"+aData["sts_pesanan"]+"</label>");break;
								case "PROGRESS" : $("td:eq(4)",nRow).html("<label class='text-red'>"+aData["sts_pesanan"]+"</label>");break;
								case "PACKING" : $("td:eq(4)",nRow).html("<label class='text-purple'>"+aData["sts_pesanan"]+"</label>");break;
								case "FINISH" : $("td:eq(4)",nRow).html("<label class='text-green'>"+aData["sts_pesanan"]+"</label>");break;
								default: $("td:eq(8)",nRow).html("<label class='text-red'>ERROR</label>");break;
							}
						}
						$("td:eq(5)",nRow).html("<button class='btn btn-md btn-flat btn-info' onclick=showDetailOrder('"+aData["no_order"]+"')>Detail</button>");
					}
				});
				$("#tableWrapper").removeAttr("style");
				$("#modalCariHistoryOrder").modal("hide");
			}

			function showDetailOrder(param){
				$("#modalDetailOrder").modal("show");
				$("#tableDetailOrder").dataTable().fnDestroy();
				$("#tableDetailOrder").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType": "full_numbers",
					"iDisplayStart ": 10,
					"sAjaxSource":"<?php echo base_url(); ?>_cabang/main/getDatatablesDetailOrder",
					"columns":[
						{"data" : "ukuran","name":"GH.ukuran"},
						{"data" : "merek","name":"DP.merek"},
						{"data" : "jns_brg","name":"GH.jns_brg"},
						{"data" : "warna_plastik","name":"GH.warna_plastik"},
						{"data" : "warna_cetak","name":"DP.warna_cetak"},
						{"data" : "sm","name":"DP.sm"},
						{"data" : "dll","name":"DP.dll"},
						{"data" : "jumlah","name":"DP.jumlah"},
						{"data" : "keterangan","name":"DP.keterangan"},
						{"data" : "sts_pesanan","name":"DP.sts_pesanan"}
					],
					"fnServerData": function (sSource, aoData, fnCallback){
						aoData.push({"name":"noOrder","value":param});
						$.ajax({
										 "dataType": "json",
										 "type": "POST",
										 "url": sSource,
										 "data": aoData,
										 "success": fnCallback
								 });
					},
					"fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
						$("td:eq(2)",nRow).html("<label class='text-red'>"+aData["jns_brg"]+"</label>");
						if (aData["approve_cabang"] == "FALSE") {
							$("td:eq(9)",nRow).html("<label class='text-yellow'>WAITING TO APPROVED</label>");
						}else{
							switch (aData["sts_pesanan"]) {
								case "WAITING" : $("td:eq(9)",nRow).html("<label class='text-yellow'>"+aData["sts_pesanan"]+"</label>");break;
								case "OPEN" : $("td:eq(9)",nRow).html("<label class='text-light-blue'>"+aData["sts_pesanan"]+"</label>");break;
								case "PROGRESS" : $("td:eq(9)",nRow).html("<label class='text-red'>"+aData["sts_pesanan"]+"</label>");break;
								case "PACKING" : $("td:eq(9)",nRow).html("<label class='text-purple'>"+aData["sts_pesanan"]+"</label>");break;
								case "FINISH" : $("td:eq(9)",nRow).html("<label class='text-green'>"+aData["sts_pesanan"]+"</label>");break;
								default: $("td:eq(9)",nRow).html("<label class='text-red'>ERROR</label>");break;
							}
						}
					}
				});
			}

			function showDetailOrderApprove(param){
				$("#modalDetailOrder").modal("show");
				dataTableDetailOrder(param);
				$("#btnApprove").attr("onclick","approveOrder('"+param+"')");
			}

			function modalModifyOrder(param,param2){
				$("#txtJumlah").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 2,autoGroup: true});
				$("#modalEditOrder").modal({
					backdrop : "static",
					keyboard : true
				});
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_cabang/main/getPesananDetailId",
					dataType : "JSON",
					data : {idDp : param},
					success : function(response){
						$("#cmbUkuran").select2({
							placeholder : "Pilih Ukuran Barang",
							dropdownParent: $('#modalEditOrder'),
							width : "100%",
							cache:true,
							allowClear:true,
							ajax:{
								url : "<?php echo base_url(); ?>_cabang/main/getComboBoxValueHasil/",
								dataType : "JSON",
								delay : 250,
								processResults : function(data){
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
							}
						});

						$("#cmbUkuran").on("select2:select",function(){
							var kode = $(this).val();
							$.ajax({
								type : "POST",
								url : "<?php echo base_url(); ?>_cabang/main/getGudangHasilDetailId",
								dataType : "JSON",
								data : {kode:kode},
								success : function(response){
									$("#txtMerek").val(response[0].merek);
									$("#txtUkuran").val(response[0].ukuran);
									$("#txtWarnaPlastik").val(response[0].warna_plastik);
								}
							});
						});

						$("#cmbUkuran").on("select2:unselect",function(){
							$("#txtMerek").val("");
							$("#txtUkuran").val("");
							$("#txtWarnaPlastik").val("");
						});
						$("#btnUbahPesananDetail").attr("onclick","modifyDetailOrder('"+param+"','"+param2+"')")
						if(response[0].nm_barang == "NULL" || response[0].nm_barang == "" || response[0].nm_barang == null){
							$("#txtMerek").val(response[0].merek);
							$("#txtUkuran").val(response[0].ukuran);
							$("#txtWarnaPlastik").val(response[0].warna_plastik);
						}else{
							$("#txtMerek").val(response[0].nm_barang);
							$("#txtUkuran").val("");
							$("#txtWarnaPlastik").val(response[0].warna);
						}
						$("#txtStrip").val(response[0].sm);
						$("#cmbJenis").val(response[0].jenis);
						$("#txtCetak").val(response[0].warna_cetak);
						$("#txtTebal").val(response[0].dll);
						$("#txtJumlah").val(response[0].jumlah);
						$("#cmbSatuan").val(response[0].satuan);
						$("#txtKeterangan").val(response[0].keterangan);
					}
				});
				$("#modalEditOrder").modal("show");
			}

			function modifyDetailOrder(param,param2){
				var kdBarang1 = $("#cmbUkuran").val();
				var merek1 = $("#txtMerek").val();
				var strip1 = $("#txtStrip").val();
				var jenis1 = $("#cmbJenis").val();
				var warnaCetak1 = $("#txtCetak").val();
				var dll1 = $("#txtTebal").val();
				var jumlah1 = $("#txtJumlah").val().replace(/,/g,"");
				var satuan1 = $("#cmbSatuan").val();
				var ket1 = $("#txtKeterangan").val();

				if(merek1=="" || strip1=="" || jenis1=="" ||
				 	 warnaCetak1=="" || dll1=="" || jumlah1=="" ||
				 	 satuan1==""
				  ){
						$("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Kolom Berwarna Kuning Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
					}else{
						$.ajax({
							type : "POST",
							url : "<?php echo base_url(); ?>_cabang/main/modifyDetailOrder",
							dataType : "TEXT",
							data : {idDp:param,kdBarang:kdBarang1,merek:merek1,strip:strip1,
											jenis:jenis1,warnaCetak:warnaCetak1,dll:dll1,
											jumlah:jumlah1,satuan:satuan1,ket:ket1},
							success : function(response){
								if(jQuery.trim(response) === "Berhasil"){
									$("#modal-notif").addClass("modal-info");
 								 	$("#modalNotifContent").text("Item pesanan anda berhasil diubah");
 								 	$("#modal-notif").modal("show");
 								 	setTimeout(function(){
 									 	$("#modal-notif").modal("hide");
 									 	$("#modal-notif").removeClass("modal-info");
 									 	$("#modalNotifContent").text("");
 									 	resetForm();
										$("#modalEditOrder").modal("hide");
										dataTableDetailOrder(param2);
									},2000);
								}else if(jQuery.trim(response) === "Gagal"){
									$("#modal-notif").addClass("modal-danger");
 								 	$("#modalNotifContent").text("Item pesanan anda gagal diubah");
 								 	$("#modal-notif").modal("show");
 								 	setTimeout(function(){
 									 	$("#modal-notif").modal("hide");
 									 	$("#modal-notif").removeClass("modal-danger");
 									 	$("#modalNotifContent").text("");
									},2000);
								}else{
									$("#modal-notif").addClass("modal-warning");
 								 	$("#modalNotifContent").text("Kolom berwarna kuning tidak boleh kosong!");
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

			function deleteDetailOrder(param,param2){
				if(confirm("Apakah anda yakin ingin menghapus item ini?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_cabang/main/deleteDetailOrder",
						dataType : "TEXT",
						data : {idDp:param,noOrder:param2},
						success : function(response){
							if(jQuery.trim(response)){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Item pesanan anda berhasil dihapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									dataTableDetailOrder(param2);
									getCountTrash();
									dataTableApproveOrder();
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Item pesanan anda gagal dihapus");
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

			function restoreDetailOrder(param,param2){
				if(confirm("Apakah anda yakin ingin menghapus item ini?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_cabang/main/restoreDetailOrder",
						dataType : "TEXT",
						data : {idDp:param,noOrder:param2},
						success : function(response){
							if(jQuery.trim(response)){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Item pesanan anda berhasil dipulihkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									dataTableDetailOrderTrash();
									getCountTrash();
									dataTableApproveOrder();
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Item pesanan anda gagal dipulihkan");
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

			function approveOrder(param){
				if(confirm("Apakah anda yakin pesanan sudah sesuai?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_cabang/main/modifyApproveOrder",
						dataType : "TEXT",
						data : {noOrder:param},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Pesanan anda berhasil diteruskan ke marketing");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									dataTableApproveOrder();
									getCountPesananApprove();
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Pesanan anda berhasil diteruskan ke marketing");
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

//============================= Data Table Function (Start) =============================//
			function dataTablePesananTemp(){
				var noOrder = $("#txtNoOrder").val();
				var kdCust = $("#txtKdCust").val();
				$("#tablePesananTemp").dataTable().fnDestroy();
				$("#tablePesananTemp").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType": "full_numbers",
					"iDisplayStart ": 20,
					"sAjaxSource":"<?php echo base_url(); ?>_cabang/main/getDatatablesPesananTemp",
					"columns":[
						{"data" : "tanggal","name":"DPT.no_order"},
						{"data" : "ukuran","name":"GH.ukuran"},
						{"data" : "merek","name":"DPT.merek"},
						{"data" : "jns_brg","name":"GH.jns_brg"},
						{"data" : "warna_plastik","name":"GH.warna_plastik"},
						{"data" : "warna_cetak","name":"DPT.warna_cetak"},
						{"data" : "sm","name":"DPT.sm"},
						{"data" : "dll","name":"DPT.dll"},
						{"data" : "jumlah","name":"DPT.jumlah"},
						{"data" : "keterangan","name":"PD.keterangan"},
						{"data" : "id_dp","name":"DPT.id_dp"},
					],
					"fnServerData": function (sSource, aoData, fnCallback){
						aoData.push({"name":"no_order","value":noOrder});
						aoData.push({"name":"kd_cust","value":kdCust});
						$.ajax({
										 "dataType": "json",
										 "type": "POST",
										 "url": sSource,
										 "data": aoData,
										 "success": fnCallback
								 });
					},
					"fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
						$("td:eq(3)",nRow).html("<label class='text-red'>"+aData["jns_brg"]+"</label>");
						$("td:eq(10)",nRow).html("<button class='btn btn-md btn-flat btn-danger' onclick=deletePesananDetailTemp("+aData['id_dp']+")><span class='fa fa-trash'></span> Hapus</button>")
					}
				});
			}

			function dataTablePantauOrder(){
				$("#tablePantauOrder").dataTable().fnDestroy();
				$("#tablePantauOrder").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType": "full_numbers",
					"iDisplayStart ": 20,
					"sAjaxSource":"<?php echo base_url(); ?>_cabang/main/getDatatablesPantauOrder",
					"columns":[
						{"data" : "no_order","name":"no_order"},
						{"data" : "tgl_pesan","name":"tgl_pesan"},
						{"data" : "nm_pemesan","name":"nm_pemesan"},
						{"data" : "approve_cabang","name":"approve_cabang"},
						{"data" : "no_order","name":"no_order"}
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
						var i = iDisplayIndex;
						$("td:eq(0)",nRow).text(++i);
						$("td:eq(1)",nRow).html(aData["tgl_pesan"]+" <label class='text-red'>["+aData["no_po"]+"]</label>");
						if (aData["approve_cabang"] == "FALSE") {
							$("td:eq(3)",nRow).html("<label class='text-yellow'>WAITING TO APPROVED</label>");
						}else{
							switch (aData["sts_pesanan"]) {
								case "WAITING" : $("td:eq(3)",nRow).html("<label class='text-yellow'>"+aData["sts_pesanan"]+"</label>");break;
								case "OPEN" : $("td:eq(3)",nRow).html("<label class='text-light-blue'>"+aData["sts_pesanan"]+"</label>");break;
								case "PROGRESS" : $("td:eq(3)",nRow).html("<label class='text-red'>"+aData["sts_pesanan"]+"</label>");break;
								case "PACKING" : $("td:eq(3)",nRow).html("<label class='text-purple'>"+aData["sts_pesanan"]+"</label>");break;
								case "FINISH" : $("td:eq(3)",nRow).html("<label class='text-green'>"+aData["sts_pesanan"]+"</label>");break;
								default: $("td:eq(8)",nRow).html("<label class='text-red'>ERROR</label>");break;
							}
						}
						if(aData["sts_print_cabang"] == "FALSE"){
							$("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-info' onclick=showDetailOrder('"+aData["no_order"]+"')>Detail</button>&nbsp;"+
																			"<button class='btn btn-md btn-flat btn-success' onclick=printOutOrder('"+aData["no_order"]+"')>Print</button>");
						}else{
							$("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-info' onclick=showDetailOrder('"+aData["no_order"]+"')>Detail</button>&nbsp;"+
																			"<button class='btn btn-md btn-flat btn-warning' onclick=printOutOrder('"+aData["no_order"]+"')>Sudah Di Print</button>");
						}
					}
				});
			}

			function dataTableApproveOrder(){
				$("#tableApproveOrder").dataTable().fnDestroy();
				$("#tableApproveOrder").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType": "full_numbers",
					"iDisplayStart ": 20,
					"sAjaxSource":"<?php echo base_url(); ?>_cabang/main/getDatatablesApproveOrder",
					"columns":[
						{"data" : "no_order","name":"no_order"},
						{"data" : "tgl_pesan","name":"tgl_pesan"},
						{"data" : "nm_pemesan","name":"nm_pemesan"},
						{"data" : "sts_pesanan","name":"sts_pesanan"},
						{"data" : "no_order","name":"no_order"}
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
						var i = iDisplayIndex;
						$("td:eq(0)",nRow).text(++i);
						$("td:eq(1)",nRow).html(aData["tgl_pesan"]+" <label class='text-red'>["+aData["no_po"]+"]</label>");
						if (aData["approve_cabang"] == "FALSE") {
							$("td:eq(3)",nRow).html("<label class='text-yellow'>WAITING TO APPROVED</label>");
						}else{
							switch (aData["sts_pesanan"]) {
								case "WAITING" : $("td:eq(3)",nRow).html("<label class='text-yellow'>"+aData["sts_pesanan"]+"</label>");break;
								case "OPEN" : $("td:eq(3)",nRow).html("<label class='text-light-blue'>"+aData["sts_pesanan"]+"</label>");break;
								case "PROGRESS" : $("td:eq(3)",nRow).html("<label class='text-red'>"+aData["sts_pesanan"]+"</label>");break;
								case "PACKING" : $("td:eq(3)",nRow).html("<label class='text-purple'>"+aData["sts_pesanan"]+"</label>");break;
								case "FINISH" : $("td:eq(3)",nRow).html("<label class='text-green'>"+aData["sts_pesanan"]+"</label>");break;
								default: $("td:eq(8)",nRow).html("<label class='text-red'>ERROR</label>");break;
							}
						}
						if(aData["sts_print"] == "FALSE"){
							$("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-info' onclick=showDetailOrderApprove('"+aData["no_order"]+"')>Detail</button>");
						}else{
							$("td:eq(4)",nRow).html("<button class='btn btn-md btn-flat btn-info' onclick=showDetailOrderApprove('"+aData["no_order"]+"')>Detail</button>");
						}
					}
				});
			}

		  function dataTableDetailOrder(param){
				$("#tableDetailOrder").dataTable().fnDestroy();
				$("#tableDetailOrder").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType": "full_numbers",
					"iDisplayStart ": 10,
					"sAjaxSource":"<?php echo base_url(); ?>_cabang/main/getDatatablesDetailOrder",
					"columns":[
						{"data" : "ukuran","name":"GH.ukuran"},
						{"data" : "merek","name":"DP.merek"},
						{"data" : "jns_brg","name":"GH.jns_brg"},
						{"data" : "warna_plastik","name":"GH.warna_plastik"},
						{"data" : "warna_cetak","name":"DP.warna_cetak"},
						{"data" : "sm","name":"DP.sm"},
						{"data" : "dll","name":"DP.dll"},
						{"data" : "jumlah","name":"DP.jumlah"},
						{"data" : "keterangan","name":"DP.keterangan"},
						{"data" : "sts_pesanan","name":"DP.sts_pesanan"},
						{"data" : "id_dp","name":"DP.no_order"}
					],
					"fnServerData": function (sSource, aoData, fnCallback){
						aoData.push({"name":"noOrder","value":param});
						$.ajax({
										 "dataType": "json",
										 "type": "POST",
										 "url": sSource,
										 "data": aoData,
										 "success": fnCallback
								 });
					},
					"fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
						$("td:eq(2)",nRow).html("<label class='text-red'>"+aData["jns_brg"]+"</label>");
						if (aData["approve_cabang"] == "FALSE") {
							$("td:eq(9)",nRow).html("<label class='text-yellow'>WAITING TO APPROVED</label>");
						}else{
							switch (aData["sts_pesanan"]) {
								case "WAITING" : $("td:eq(9)",nRow).html("<label class='text-yellow'>"+aData["sts_pesanan"]+"</label>");break;
								case "OPEN" : $("td:eq(9)",nRow).html("<label class='text-light-blue'>"+aData["sts_pesanan"]+"</label>");break;
								case "PROGRESS" : $("td:eq(9)",nRow).html("<label class='text-red'>"+aData["sts_pesanan"]+"</label>");break;
								case "PACKING" : $("td:eq(9)",nRow).html("<label class='text-purple'>"+aData["sts_pesanan"]+"</label>");break;
								case "FINISH" : $("td:eq(9)",nRow).html("<label class='text-green'>"+aData["sts_pesanan"]+"</label>");break;
								default: $("td:eq(9)",nRow).html("<label class='text-red'>ERROR</label>");break;
							}
						}
						$("td:eq(10)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalModifyOrder('"+aData["id_dp"]+"','"+aData["no_order"]+"')>Edit</button>&nbsp;"+
																		"<button class='btn btn-md btn-flat btn-danger' onclick=deleteDetailOrder('"+aData["id_dp"]+"','"+aData["no_order"]+"')>Delete</button>");
					}
				});
			}

			function dataTableDetailOrderTrash(){
				$("#tableTrash").dataTable().fnDestroy();
				$("#tableTrash").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType": "full_numbers",
					"iDisplayStart ": 10,
					"sAjaxSource":"<?php echo base_url(); ?>_cabang/main/getDatatablesDetailOrderTrash",
					"columns":[
						{"data" : "no_order","name":"DP.no_order"},
						{"data" : "ukuran","name":"GH.ukuran"},
						{"data" : "merek","name":"DP.merek"},
						{"data" : "warna_plastik","name":"GH.warna_plastik"},
						{"data" : "warna_cetak","name":"DP.warna_cetak"},
						{"data" : "sm","name":"DP.sm"},
						{"data" : "dll","name":"DP.dll"},
						{"data" : "jumlah","name":"DP.jumlah"},
						{"data" : "keterangan","name":"DP.keterangan"},
						{"data" : "sts_pesanan","name":"DP.sts_pesanan"},
						{"data" : "id_dp","name":"DP.no_order"}
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
						switch (aData["sts_pesanan"]) {
							case "WAITING": $("td:eq(9)",nRow).html("<label class='text-yellow'>"+aData["sts_pesanan"]+"</label>");break;
							case "OPEN" : $("td:eq(9)",nRow).html("<label class='text-light-blue'>"+aData["sts_pesanan"]+"</label>");break;
							case "PROGRESS" : $("td:eq(9)",nRow).html("<label class='text-red'>"+aData["sts_pesanan"]+"</label>");break;
							case "PACKING" : $("td:eq(9)",nRow).html("<label class='text-purple'>"+aData["sts_pesanan"]+"</label>");break;
							case "FINISH" : $("td:eq(9)",nRow).html("<label class='text-green'>"+aData["sts_pesanan"]+"</label>");break;
							default: $("td:eq(9)",nRow).html("<label class='text-red'>ERROR</label>");break;
						}
						$("td:eq(10)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=restoreDetailOrder('"+aData["id_dp"]+"','"+aData["no_order"]+"')>Pulihkan</button>");
					}
				});
			}
//============================= Data Table Function (Finish) =============================//
		</script>
	</body>
</html>
