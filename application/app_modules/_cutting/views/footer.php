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

				datatablesRencanaPpicPotong();
				if($("#tableDataRencanaMandor").length > 0){
					datatablesRencanaMandorPotong();
					datatablesHasilJobPotongPending();
				}

				if($("#tableListHistoryPPICExtruder").length > 0){
					datatablesListHistoryPpicExtruder();
				}

				if($("#tableDataPengambilanExtruder").length > 0){
					tableDataPengambilan("EXTRUDER");
				}

				if($("#tableDataPengambilanCetak").length > 0){
					tableDataPengambilan("CETAK");
				}

				if($("#tableListHistorySisa").length > 0){
					datatablestableListHistorySisa();
				}

				if ($("#alertKirimanBalikGudangHasil").length>0) {
					alertKirimanBalikGudangHasil();
				}

				if($("#boxInputHasil").length > 0){
					var param1 = "<?php echo $this->uri->rsegment(3); ?>";
					var param2 = "<?php echo $this->uri->rsegment(4); ?>";
					var param3 = "<?php echo $this->uri->rsegment(5); ?>";
					var param4 = "<?php echo $this->uri->rsegment(6); ?>";
					setInterval(function(){
						$.ajax({
							url : "<?php echo base_url('_cutting/main/getGenerateInputHasil'); ?>",
							dataType : "JSON",
							success : function(response){
								$("#idTransaksi").val(response.Code);
							}
						});
					},5000);
					modalInputHasil(param1, param2, param3, param4);
				}
				//======= Inisialisasi Komponen (End) =======
			});
		</script>

		<script type="text/javascript">
			//============================================MODAL METHOD (Start)============================================//
			function showImage(param){
				var url = $(param).attr("src");
				$("#imageShow").attr("src",url);
				$("#modalShowImage").modal({backdrop:"static"});
			}

			function modalKonversi(param){
				$("input").val("");
				$("#txtKonversi_Konversi").val("");
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_cutting/main/getDataRencanaPpic_Konversi",
					dataType : "JSON",
					data : {kdPpic : param},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#txtJumlahPermintaan_Konversi").val(AvValue.jumlah_permintaan);
							$("#lblSatuanAsli_Konversi").text(AvValue.satuan);
							$("#txtUkuran_Konversi").val(AvValue.ukuran);
							$("#txtBerat_Konversi").val(AvValue.berat);
							$("#txtTebal_Konversi").val(AvValue.tebal);
							$("#txtKonversi_Konversi").val(AvValue.satuan_kilo);
						});
						$("#btnSaveKonversi").attr("onclick","saveKonversi('"+param+"')");
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
				})
			}

			function modalEditStatus(param, param2="", param3=""){
				$("#modalEditStatus").modal({backdrop:"static"});
				$("#btnUbahStatusRencana").attr("onclick","editStatusPengerjaan('"+param+"','"+param2+"','"+param3+"')");
			}

			function modalInputKeterangan(param){
				$("#modalEditKeteranganMandor").modal({backdrop:"static"});
				$("#btnEditKetMandor").attr("onclick","saveKeteranganMandor('"+param+"')");
				$.ajax({
					type : "POST",
					url : "<?php echo base_url() ?>_cutting/main/getKeteranganMandor",
					dataType : "JSON",
					data : {kdPpic : param},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#txtKetMandor_Edit").val(AvValue.ket_mandor);
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

			function modalBuatRencanaKerja(param, param2="", param3=""){
				$("#modalInputRencanaKerja").modal({backdrop:"static"});
				$("#cmbWarnaStrip").on("change",function(){
					if(this.value == "CUSTOM"){
						$("#comboStripWrapper").css("display","none");
						$("#textStripWrapper").css("display","block");
					}else{
						$("#comboStripWrapper").css("display","block");
						$("#textStripWrapper").css("display","none");
					}
				});
				$("#btnClose").on("click",function(){
					$("#cmbWarnaStrip").val("").trigger("change");
					$("#txtWarnaStrip").val("");
				});
				resetFormBuatRencanaPending(param2, param3);
				tableRencanaPotongPending();
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_cutting/main/getDetailRencanaPPIC",
					dataType : "JSON",
					data : {kdPpic : param},
					success : function(response){
						var arrUkuranPlastik = response[0].ukuran.split("x");
						var arrPanjangPlastik = arrUkuranPlastik[0].split("+");
						var panjangPlastik = arrUkuranPlastik[0];
						var merek = response[0].merek.replace(/ /gi,"_");
						var warnaPlastik = response[0].warna_plastik.replace(/ /gi,"_");
						$("#tableRencanaPpic tbody").empty();
						var arrStrip = ["MERAH PUTIH","MERAH","PINK","MERAH ORANGE","PUTIH SUSU","LOSE","BIRU"];
						$.each(response, function(AvIndex, AvValue){
							$("#tableRencanaPpic > tbody:last-child").append(
								"<tr>"+
									"<td>"+AvValue.tgl_rencana+"</td>"+
									"<td>"+AvValue.nm_cust+"</td>"+
									"<td>"+AvValue.merek+"</td>"+
									"<td>"+AvValue.ukuran+"</td>"+
									"<td>"+AvValue.warna_plastik+"</td>"+
									"<td>"+AvValue.tebal+"</td>"+
									"<td>"+AvValue.berat+"</td>"+
									"<td>"+AvValue.jumlah_permintaan+" "+AvValue.satuan+"</td>"+
									"<td>"+AvValue.sisa+"</td>"+
									"<td>"+AvValue.strip+"</td>"+
									"<td>"+AvValue.keterangan+"</td>"+
								"</tr>"
							);
							$("#txtUkuran").val(AvValue.ukuran);
							$("#txtCustomer").val(AvValue.nm_cust);
							$("#txtTebal").val(AvValue.tebal);
							$("#txtKdPpic").val(AvValue.kd_ppic);
							$("#txtKdGdHasil").val(AvValue.kd_gd_hasil);
							$("#txtWarnaPlastik").val(AvValue.warna_plastik);
							$("#txtSatuan").val(AvValue.satuan);
							$("#txtMerek").val(AvValue.merek);
							$("#txtKetBarang").val(AvValue.keterangan);
							$("#txtJnsPermintaan").val(AvValue.jns_permintaan);
							$("#txtJmlPermintaan").val(AvValue.jumlah_permintaan);
							$("#txtBerat").val(AvValue.berat);
							$("#txtKetMerek").val(AvValue.ket_merek);
							if(AvValue.satuan == "KG" || AvValue.satuan == "LEMBAR"){
								$("#txtJumlahPembuatan").val(AvValue.jumlah_permintaan);
							}
							$("#imgContohPlastik").attr("src","<?php echo base_url(); ?>assets/images/upload/"+AvValue.foto_depan);
							if(arrStrip.indexOf(AvValue.strip.toUpperCase()) != -1){
								$("#cmbWarnaStrip").val(AvValue.strip.toUpperCase()).trigger("change");
							}else{
								$("#cmbWarnaStrip").val("CUSTOM").trigger("change");
								$("#txtWarnaStrip").val(AvValue.strip.toUpperCase());
							}
						});

						if(response[0].jns_permintaan == "CETAK/POLOS"){
							var arrJnsPermintaan = response[0].jns_permintaan.split("/");
							var jnsPermintaan = arrJnsPermintaan[0];
						}else{
							var jnsPermintaan = response[0].jns_permintaan;
						}

						$("#cmbKdGdRoll").select2({
		          placeholder : "Pilih Roll ("+jnsPermintaan+")",
		          dropdownParent: $("#modalInputRencanaKerja"),
		          width : "100%",
		          cache:false,
		          allowClear:true,
		          ajax:{
		            url : "<?php echo base_url(); ?>_cutting/main/getComboBoxValueGudangRoll/"+jnsPermintaan+"/"+panjangPlastik+"/"+merek+"/"+warnaPlastik,
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
					},
					error : function(response){
						$("#modal-notif").addClass("modal-danger");
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

			function modalEditMesin(param, param2="", param3=""){
				$("#modalEditMesin").modal({backdrop:"static"});
				$("#btnEditMesin").attr("onclick","editMesinRencanaPpic('"+param+"','"+param2+"','"+param3+"')");
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_cutting/main/getMesinRencanaPpic",
					dataType : "JSON",
					data : {
						kdPpic : param
					},
					success : function(response){
						$.each(response,function(AvIndex, AvValue){
							$("#txtNoMesin_Edit").val(AvValue.no_mesin);
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

			function modalEditRencanaPotongPending(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_cutting/main/getDetailRencanaPotongPending",
					dataType : "JSON",
					data : {
						kdPotong : param
					},
					success : function(response){
						var arrStrip = ["MERAH PUTIH","MERAH","PINK","MERAH ORANGE"];
						var kdGdRoll = "";
						$("#btnTambahRencanaPotong").attr("onclick","editRencanaPotongPending()").html("<i class='fa fa-pencil'></i> Ubah").removeClass("btn-primary").addClass("btn-warning");
						$.each(response, function(AvIndex, AvValue){
							$("#txtKodeRencana").val(AvValue.kd_potong);
							$("#txtTanggalRencana").val(AvValue.tgl_rencana);
							$("#txtMesin").val(AvValue.no_mesin);
							$("#txtJumlahMesin").val(AvValue.jml_mesin);
							$("#txtUkuran").val(AvValue.ukuran);
							$("#cmbKdGdRoll").val(AvValue.kd_gd_roll).trigger("change");
							$("#txtCustomer").val(AvValue.customer);
							$("#txtTebal").val(AvValue.tebal);
							$("#txtKeterangan").val(AvValue.ket_merek);
							$("#txtJumlahPembuatan").val(AvValue.stok_permintaan);
							$("#cmbShift").val(AvValue.shift);
							if(arrStrip.indexOf(AvValue.strip) != -1){
								$("#cmbWarnaStrip").val(AvValue.strip.toUpperCase()).trigger("change");
							}else{
								$("#cmbWarnaStrip").val("CUSTOM").trigger("change");
								$("#txtWarnaStrip").val(AvValue.strip.toUpperCase());
							}
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
				})
			}

			function modalEditMerek(param1, param2=""){
				$("#modalEditMerek").modal({backdrop:"static"});
				$("#cmbKdGdHasil").val("").trigger("change");
				$("#cmbKdGdHasil").select2({
					placeholder : "Pilih Ukuran Plastik",
					dropdownParent: $("#modalEditMerek"),
					width : "100%",
					cache:false,
					allowClear:true,
					ajax:{
						url : "<?php echo base_url(); ?>_cutting/main/getComboBoxValueGudangHasil",
						dataType : "JSON",
						delay : 0,
						processResults : function(data){
							return{
								results : $.map(data, function(item){
									return{
										text:item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_brg+" | "+item.jns_permintaan,
										id:item.kd_gd_hasil
									}
								})
							};
						}
					}
				});
				$("#btnUbahMerek").attr("onclick","editMerekRencana('"+param1+"','"+param2+"')");
			}

			function modalEditTanggal(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url() ?>_cutting/main/getTanggalRencanaMandor",
					dataType : "JSON",
					data : {kdPotong : param},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#txtTanggalRencana").val(AvValue.tgl_rencana);
						});
						$("#modalEditTanggal").modal({backdrop:"static"});
						$("#btnEditTanggalRencana").attr("onclick","editTanggalRencanaMandor('"+param+"')");
					},
					error : function(response){
						$("#modal-notif").addClass("modal-danger");
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

			function modalEditGantiMesinMandor(param1, param2=""){
				$("#modalEditMesin").modal({backdrop:"static"});
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_cutting/main/getMesinRencanaMandor",
					dataType : "JSON",
					data : {kdPotong : param1},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#txtNoMesin_Edit").val(AvValue.no_mesin);
						});
						$("#btnEditMesin").attr("onclick","editGantiMesinMandor('"+param1+"','"+param2+"')");
					},
					error : function(response){
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

			function modalBuatRencanaKerjaSusulan(){
				resetFormBuatRencanaKerjaSusulan();
				tableRencanaMandoPotongSusulanPending();
				$("#cmbWarnaStrip").on("change",function(){
					if(this.value == "CUSTOM"){
						$("#comboStripWrapper").css("display","none");
						$("#textStripWrapper").css("display","block");
					}else{
						$("#comboStripWrapper").css("display","block");
						$("#textStripWrapper").css("display","none");
					}
				});
				$("#btnClose").on("click",function(){
					$("#cmbWarnaStrip").val("").trigger("change");
					$("#txtWarnaStrip").val("");
				});
				$("#cmbKdHasil").select2({
					placeholder : "Pilih Ukuran Plastik",
					dropdownParent: $("#modalTambahRencanaSusulan"),
					width : "100%",
					cache:false,
					allowClear:true,
					ajax:{
						url : "<?php echo base_url(); ?>_cutting/main/getComboBoxValueGudangHasil",
						dataType : "JSON",
						delay : 0,
						processResults : function(data){
							return{
								results : $.map(data, function(item){
									return{
										text:item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_brg+" | "+item.jns_permintaan,
										id:item.kd_gd_hasil
									}
								})
							};
						}
					}
				});
				$("#cmbKdHasil").on("select2:select",function(){
					var dataText = $("#cmbKdHasil").select2("data")[0]["text"];
					var arrDataText = dataText.split(" | ");
					var arrUkuranPlastik = arrDataText[1].split("x");
					var arrPanjangPlastik = arrUkuranPlastik[0].split("+");
					var merek = arrDataText[2].replace(/ /gi,"_");
					var warnaPlastik = arrDataText[3].replace(/ /gi,"_");
					if(arrPanjangPlastik.length > 2){
						var panjangPlastik = (parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]))+"+"+arrPanjangPlastik[2];
					}else{
						var panjangPlastik = arrUkuranPlastik[0];
					}
					$("#cmbKdBahan").select2({
						placeholder : "Pilih Roll ("+arrDataText[5]+")",
						dropdownParent: $("#modalTambahRencanaSusulan"),
						width : "100%",
						cache:false,
						allowClear:true,
						ajax:{
							url : "<?php echo base_url(); ?>_cutting/main/getComboBoxValueGudangRoll/"+arrDataText[5].replace(/\//g,"-")+"/"+panjangPlastik+"/"+merek+"/"+warnaPlastik,
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
					$("#trBahanPolos").removeAttr("style");
				});

				$("#cmbKdHasil").on("select2:unselect",function(){
					$("#trBahanPolos").css("display","none");
				});
			}

			function modalEditRencanaPotongSusulanPending(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_cutting/main/getDetailRencanaPotongPending",
					dataType : "JSON",
					data : {
						kdPotong : param
					},
					success : function(response){
						var arrStrip = ["MERAH PUTIH","MERAH","PINK","MERAH ORANGE"];
						var kdGdRoll = "";
						$("#btnTambahRencanaSusulanPending").attr("onclick","editRencanaPotongSusulanPending()").html("<i class='fa fa-pencil'></i> Ubah").removeClass("btn-primary").addClass("btn-warning");
						$.each(response, function(AvIndex, AvValue){
							$("#txtKodePotong").val(AvValue.kd_potong);
							$("#txtTglRencana").val(AvValue.tgl_rencana);
							$("#txtNoMesin").val(AvValue.no_mesin);
							$("#txtJumlahMesin").val(AvValue.jml_mesin);
							$("#cmbKdHasil").val(AvValue.kd_gd_hasil).trigger("change");
							$("#cmbKdBahan").val(AvValue.kd_gd_roll).trigger("change");
							$("#txtNamaCustomer").val(AvValue.customer);
							$("#txtTebalPlastik").val(AvValue.tebal);
							$("#txtKeteranganMerek").val(AvValue.ket_merek);
							$("#txtJumlahPermintaan").val(AvValue.stok_permintaan);
							$("#cmbSatuan").val(AvValue.satuan);
							$("#cmbShiftRencana").val(AvValue.shift);
							$("#txtBeratRencana").val(AvValue.berat);
							$("#txtKeterangan").val(AvValue.ket_barang);
							if(arrStrip.indexOf(AvValue.strip) != -1){
								$("#cmbWarnaStrip").val(AvValue.strip.toUpperCase()).trigger("change");
							}else{
								$("#cmbWarnaStrip").val("CUSTOM").trigger("change");
								$("#txtWarnaStrip").val(AvValue.strip.toUpperCase());
							}
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
				})
			}

			function modalSisaPengambilan(param){
				resetFormSisaPengambilan(param);
				$("#cmbUkuran"+param).select2({
					placeholder : "Pilih Ukuran Plastik",
					dropdownParent: $("#modalSisaPengambilan_"+param),
					width : "100%",
					cache:false,
					allowClear:true,
					ajax:{
						url : "<?php echo base_url(); ?>_cutting/main/getUkuranPengembalianPotong/"+param,
						dataType : "JSON",
						delay : 0,
						processResults : function(data){
							return{
								results : $.map(data, function(item){
									if(item.ket_barang.toUpperCase().indexOf("TUMPUK") == -1){
										return{
											text:item.customer+" | "+item.panjang+" | "+item.ket_barang+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana+" | "+item.jns_permintaan,
											id:item.kd_potong+"#"+item.kd_gd_roll
										}
									}else{
										return{
											text:item.customer+" | "+item.ukuran+" | "+item.ket_barang+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana+" | "+item.jns_permintaan,
											id:item.kd_potong+"#"+item.kd_gd_roll
										}
									}
								})
							};
						}
					}
				});

				$("#cmbUkuran"+param).on("select2:select", function(){
					var dataText = $("#cmbUkuran"+param).select2("data")[0]["text"];
					var arrDataText = dataText.split(" | ");
					$("#txtPanjangPlastik"+param).val(arrDataText[1]);
					$("#txtMerek"+param).val(arrDataText[3]);
					$("#txtWarnaPlastik"+param).val(arrDataText[4]);
					$("#txtPermintaan"+param).val(arrDataText[6]);
					$("#txtKetBarang"+param).val(arrDataText[2]);
					if(arrDataText[2].toUpperCase().indexOf("TUMPUK") == -1){
						$("#trUkuranTumpuk"+param).css("display","none");
					}else{
						if(arrDataText[1].toUpperCase().indexOf("/") == -1){
							var arrPanjangSecondary = arrDataText[1].toLowerCase().replace(/ /g,"").split("x");
						}else{
							var arrUkuran = arrDataText[1].replace(/ /g,"").split("/");
							var arrPanjangSecondary = arrUkuran[1].toLowerCase().split("x");
						}

						if(arrDataText[6] == "CETAK/POLOS"){
							var arrJnsPermintaan = arrDataText[6].split("/");
							var jnsPermintaan = arrJnsPermintaan[1];
						}else{
							var jnsPermintaan = arrDataText[6];
						}

						$("#cmbUkuranTumpuk"+param).select2({
		          placeholder : "Pilih Roll ("+jnsPermintaan+")",
		          dropdownParent: $("#modalSisaPengambilan_"+param),
		          width : "100%",
		          cache:false,
		          allowClear:true,
		          ajax:{
		            url : "<?php echo base_url(); ?>_cutting/main/getComboBoxValueGudangRoll/"+jnsPermintaan+"/"+arrPanjangSecondary[0]+"/"+arrDataText[3]+"/"+arrDataText[4],
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
						$("#trUkuranTumpuk"+param).css("display","table-row");
					}
					var arrKode = $("#cmbUkuran"+param).val().split("#");
					$("#txtKdGdRoll"+param).val(arrKode[1]);
				});

				$("#cmbUkuranTumpuk"+param).on("select2:select", function(){
					$("#trSisaTumpuk"+param).css("display","table-row");
					$("#trPayungTumpuk"+param).css("display","table-row");
					$("#trPayungKuningTumpuk"+param).css("display","table-row");
					$("#trBobinTumpuk"+param).css("display","table-row");
				});
				$("#cmbUkuranTumpuk"+param).on("select2:unselect", function(){
					$("#trSisaTumpuk"+param).css("display","none");
					$("#trPayungTumpuk"+param).css("display","none");
					$("#trPayungKuningTumpuk"+param).css("display","none");
					$("#trBobinTumpuk"+param).css("display","none");
				});

				$("#cmbUkuran"+param).on("select2:unselect", function(){
					$("#txtPanjangPlastik"+param).val("");
					$("#txtMerek"+param).val("");
					$("#txtWarnaPlastik"+param).val("");
					$("#txtPermintaan"+param).val("");
					$("#trUkuranTumpuk"+param).css("display","none");
					$("#trSisaTumpuk"+param).css("display","none");
					$("#trPayungTumpuk"+param).css("display","none");
					$("#trPayungKuningTumpuk"+param).css("display","none");
					$("#trBobinTumpuk"+param).css("display","none");
				});

				$("#cmbKeterangan"+param).on("change",function(){
					var value = this.value;
					if(value == "POTONG BESOK"){
						$("#trTanggalAwal"+param).css("display","table-row");
						$("#trTanggalAkhir"+param).css("display","table-row");
						$("#tdTanggalAkhir"+param).text("Tanggal Potong");
					}else if(value == "KEMBALI GUDANG"){
						$("#trTanggalAwal"+param).css("display","table-row");
						$("#trTanggalAkhir"+param).css("display","table-row");
						$("#tdTanggalAkhir"+param).text("Tanggal Kembali");
					}else{
						$("#trTanggalAwal"+param).css("display","none");
						$("#trTanggalAkhir"+param).css("display","none");
						$("#tdTanggalAkhir"+param).text("Tanggal Kembali");
					}
				});
				$("#btnTambahSisaPengambilan"+param).attr("onclick","saveTambahSisaPengambilanPotong('"+param+"')");
				$("#btnSimpanSisaPengambilan"+param).attr("onclick","saveSisaPengambilanPotong('"+param+"')");
				tableListSisaPengembalian(param);
			}

			function modalTambahPengambilanPotong(param){
				$("input").val("").trigger("change");
				$("#cmbKetarangan").val("");
				$(".date").datepicker("setDate",null);
				if(param=="POLOS"){
					$("#txtStatusPengambilan").val("EXTRUDER");
				}else{
					$("#txtStatusPengambilan").val("CETAK");
				}
				$("#txtTglPotong").on("change",function(){
					var tglRencana1 = this.value;
					$("#cmbKdCutting").select2(); //Trigger Select2 Agar Tidak Menampilkan Message Error Saat Destroy
					$("#cmbKdCutting").val(null);
					$("#txtBeratPengambilan").val(0);
					$("#txtPayung").val(0);
					$("#txtPayungKuning").val(0);
					$("#txtJumlahBobin").val(0);
					if(tglRencana1 == "" || tglRencana1==null){
						$("#cmbKdCutting").select2('destroy');
						$("#trUkuran").css("display","none");
					}else{
						$("#trUkuran").css("display","table-row");
						$("#cmbKdCutting").select2({
							placeholder : "Pilih Ukuran Plastik",
							dropdownParent: $("#modalTambahPengambilan"),
							width : "100%",
							cache:false,
							allowClear:true,
							ajax:{
								url : "<?php echo base_url(); ?>_cutting/main/getUkuranPengambilanPotong/"+param+"/"+tglRencana1,
								dataType : "JSON",
								delay : 0,
								processResults : function(data){
									return{
										results : $.map(data, function(item){
											if(item.ket_barang.toUpperCase().indexOf("TUMPUK") == -1){
												return{
													text:item.customer+" | "+item.panjang+" | "+item.ket_barang+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana+" | "+item.jns_permintaan,
													id:item.kd_potong+"#"+item.kd_gd_roll
												}
											}else{
												return{
													text:item.customer+" | "+item.ukuran+" | "+item.ket_barang+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana+" | "+item.jns_permintaan,
													id:item.kd_potong+"#"+item.kd_gd_roll
												}
											}
										})
									};
								}
							}
						});$("#cmbKdCutting").on("select2:select", function(){
							var dataText = $("#cmbKdCutting").select2("data")[0]["text"];
							var arrDataText = dataText.split(" | ");
							if(arrDataText[2].toUpperCase().indexOf("TUMPUK") == -1){
								$("#trUkuranTumpuk"+param).css("display","none");
							}else{
								if(arrDataText[1].toUpperCase().indexOf("/") == -1){
									var arrPanjangSecondary = arrDataText[1].toLowerCase().replace(/ /g,"").split("x");
								}else{
									var arrUkuran = arrDataText[1].replace(/ /g,"").split("/");
									var arrPanjangSecondary = arrUkuran[1].toLowerCase().split("x");
								}
								if(arrDataText[6] == "CETAK/POLOS"){
									var arrJnsPermintaan = arrDataText[6].split("/");
									var jnsPermintaan = arrJnsPermintaan[1];
								}else{
									var jnsPermintaan = arrDataText[6];
								}
								$("#cmbUkuranTumpuk").select2({
				          placeholder : "Pilih Roll ("+jnsPermintaan+")",
				          dropdownParent: $("#modalTambahPengambilan"),
				          width : "100%",
				          cache:false,
				          allowClear:true,
				          ajax:{
				            url : "<?php echo base_url(); ?>_cutting/main/getComboBoxValueGudangRoll/"+jnsPermintaan+"/"+arrPanjangSecondary[0],
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
								$("#trUkuranTumpuk").css("display","table-row");
							}
							$("#cmbUkuranTumpuk").on("select2:select", function(){
								$("#trUkuranTumpuk").css("display","table-row");
								$("#trBeratTumpuk").css("display","table-row");
								$("#trPayungTumpuk").css("display","table-row");
								$("#trPayungKuningTumpuk").css("display","table-row");
								$("#trBobinTumpuk").css("display","table-row");
								$("#txtBeratTumpuk").val(0);
								$("#txtPayungTumpuk").val(0);
								$("#txtPayungKuningTumpuk").val(0);
								$("#txtBobinTumpuk").val(0);
							});

							$("#cmbUkuranTumpuk").on("select2:unselect", function(){
								$("#trUkuranTumpuk").css("display","none");
								$("#trBeratTumpuk").css("display","none");
								$("#trPayungTumpuk").css("display","none");
								$("#trPayungKuningTumpuk").css("display","none");
								$("#trBobinTumpuk").css("display","none");
								$("#txtBeratTumpuk").val(0);
								$("#txtPayungTumpuk").val(0);
								$("#txtPayungKuningTumpuk").val(0);
								$("#txtBobinTumpuk").val(0);
							});
							// var arrKode = $("#cmbUkuran"+param).val().split("#");
							// $("#txtKdGdRoll"+param).val(arrKode[1]);
						});
						// $("#trUkuran").css("display","table-row");
					}
				});
				$("#btnTambahPengambilan").attr("onclick","savePengambilanPotong('"+param+"')").removeClass("btn-warning").addClass("btn-primary").html("<i class='fa fa-plus'></i> Tambah");
			}

			function modalTambahPengambilanPotongTertinggal(param){
				$("input").val("").trigger("change");
				$("select").val("");
				$(".date").datepicker("setDate",null);
				if(param=="POLOS"){
					$("#txtStatusPengambilanTertinggal").val("EXTRUDER");
				}else{
					$("#txtStatusPengambilanTertinggal").val("CETAK");
				}
				$("#txtTglPotongTertinggal").on("change",function(){
					var tglRencana1 = this.value;
					$("#cmbKdCuttingTertinggal").select2(); //Trigger Select2 Agar Tidak Menampilkan Message Error Saat Destroy
					$("#cmbKdCuttingTertinggal").val(null);
					if(tglRencana1 == "" || tglRencana1==null){
						$("#cmbKdCuttingTertinggal").select2('destroy');
						$("#trUkuranTertinggal").css("display","none");
					}else{
						$("#cmbKdCuttingTertinggal").select2({
							placeholder : "Pilih Ukuran Plastik",
							dropdownParent: $("#modalTambahPengambilanTertinggal"),
							width : "100%",
							cache:false,
							allowClear:true,
							ajax:{
								url : "<?php echo base_url(); ?>_cutting/main/getUkuranPengambilanPotong/"+param+"/"+tglRencana1,
								dataType : "JSON",
								delay : 0,
								processResults : function(data){
									return{
										results : $.map(data, function(item){
											if(item.ket_barang.toUpperCase().indexOf("TUMPUK") == -1){
												return{
													text:item.customer+" | "+item.panjang+" | "+item.ket_barang+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana+" | "+item.jns_permintaan,
													id:item.kd_potong+"#"+item.kd_gd_roll
												}
											}else{
												return{
													text:item.customer+" | "+item.ukuran+" | "+item.ket_barang+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana+" | "+item.jns_permintaan,
													id:item.kd_potong+"#"+item.kd_gd_roll
												}
											}
										})
									};
								}
							}
						});
						$("#trUkuranTertinggal").css("display","table-row");
					}
				});
				$("#btnTambahPengambilanTertinggal").attr("onclick","savePengambilanPotongTertinggal('"+param+"')").removeClass("btn-warning").addClass("btn-primary").html("<i class='fa fa-plus'></i> Tambah");
			}

			function modalInputHasil(param1, param2, param3, param4){
				// $("#modalInputHasil").modal({backdrop:"static"});
				$("input").val("");
				$("#cmbRollPipa").val("").trigger("change");
				$("#cmbShift").val("").trigger("change");
				$(".number").val(0);
				$(".numberFive").val(0);
				$("#cmbShift").val("1");
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_cutting/main/getDataInputHasil'); ?>",
					dataType : "JSON",
					data : {
						panjangPlastik 	: param1.replace(/_/g," "),
						warnaPlastik 		: param2.replace(/_/g," "),
						kdGdRoll 				: param3.replace(/_/g," "),
						tglRencana 			: param4.replace(/_/g," ")
					},
					success : function(response){
						$("#idTransaksi").val(response.IdTransaksi);
						$("#tableDetailRencana").empty();
						$.each(response.DetailRencana, function(AvIndex, AvValue){
							$("#txtTglPengerjaan").val(AvValue.tgl_rencana);
							$("#txtMerek").val(AvValue.merek);
							$("#txtPermintaan").val(AvValue.jns_permintaan);
							$("#txtWarnaPlastik").val(AvValue.warna_plastik);
							$("#ketMerek").val((AvValue.ket_merek_ppic==null || AvValue.ket_merek_ppic=="") ? AvValue.ket_merek : AvValue.ket_merek_ppic);
							$("#ketBarang").val((AvValue.ket_barang==null || AvValue.ket_barang=="") ? "0" : AvValue.ket_barang);

							$("#tableDetailRencana").append(
								'<tr>'+
									'<td width="10%">Customer</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control" name="txtCustomer" placeholder="Masukan Nama Customer" readonly value="'+AvValue.customer+'">'+
											'<input type="hidden" name="txtKdCutting" value="'+AvValue.kd_potong+'">'+
											'<input type="hidden" name="txtKdGdHasil" value="'+AvValue.kd_gd_hasil+'">'+
											'<input type="hidden" name="txtKdGdRoll" value="'+AvValue.kd_gd_roll+'">'+
										'</div>'+
									'</td>'+
									'<td width="5%">Lembar</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control number" name="txtLembar" placeholder="Masukan Jumlah Lembar">'+
										'</div>'+
									'</td>'+
									'<td width="5%">Berat</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control number" name="txtBerat" placeholder="Masukan Jumlah Berat">'+
										'</div>'+
									'</td>'+
									'<td width="5%">Tebal</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control" name="txtTebal" placeholder="Masukan Tebal" readonly value="'+AvValue.tebal+'">'+
										'</div>'+
									'</td>'+
								'</tr>'+
								'<tr>'+
									'<td width="10%">Roll(Ukuran)</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control" name="txtUkuran" placeholder="Masukan Ukuran" readonly value="'+AvValue.ukuran+'">'+
										'</div>'+
									'</td>'+
									'<td width="5%">Gudang</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control" name="txtGudang" placeholder="Masukan Gudang" readonly value="'+AvValue.jns_brg+'">'+
										'</div>'+
									'</td>'+
									'<td width="5%">Strip</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control" name="txtStrip" placeholder="Masukan Strip" readonly value="'+AvValue.strip+'">'+
										'</div>'+
									'</td>'+
									'<td width="5%">No. Mesin</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control" name="txtNoMesin" placeholder="Masukan No. Mesin" readonly value="'+AvValue.no_mesin+'">'+
										'</div>'+
									'</td>'+
								'</tr>'
							);
						});
						numberMasking();

						$.each(response.PengambilanPotong, function(AvIndex, AvValue){
							if($("#txtPermintaan").val().toUpperCase() == "POLOS"){
								$("#tdBahan").text("Berat Pengambilan Extruder");
								$("#tdBobin").text("Bobin Pengambilan Extruder");
								$("#tdPayung").text("Payung Pengambilan Extruder");
								$("#tdPayungKuning").text("Payung Kuning Pengambilan Extruder");
							}else{
								$("#tdBahan").text("Berat Pengambilan Cetak");
								$("#tdBobin").text("Bobin Pengambilan Cetak");
								$("#tdPayung").text("Payung Pengambilan Cetak");
								$("#tdPayungKuning").text("Payung Kuning Pengambilan Cetak");
							}
							$("#txtBahan").val((AvValue.jumlahBerat == null) ? 0 : AvValue.jumlahBerat);
							$("#txtBobin").val((AvValue.jumlahBobin == null) ? 0 : AvValue.jumlahBobin);
							$("#txtPayung").val((AvValue.jumlahPayung == null) ? 0 : AvValue.jumlahPayung);
							$("#txtPayungKuning").val((AvValue.jumlahPayungKuning == null) ? 0 : AvValue.jumlahPayungKuning);
						});

						$.each(response.SisaPengambilanPotongSemalam, function(AvIndex, AvValue){
							$("#txtBeratSisaSemalam").val((AvValue.jumlahSisa == null) ? 0 : AvValue.jumlahSisa);
							$("#txtBobinSisaSemalam").val((AvValue.jumlahBobin == null) ? 0 : AvValue.jumlahBobin);
							$("#txtPayungSisaSemalam").val((AvValue.jumlahPayung == null) ? 0 : AvValue.jumlahPayung);
							$("#txtPayungKuningSisaSemalam").val((AvValue.jumlahPayungKuning == null) ? 0 : AvValue.jumlahPayungKuning);
						});

						$.each(response.SisaPengambilanPotongHariIni, function(AvIndex, AvValue){
							$("#txtSisa").val((AvValue.jumlahSisa == null) ? 0 : AvValue.jumlahSisa);
							$("#txtSisaBobin").val((AvValue.jumlahBobin == null) ? 0 : AvValue.jumlahBobin);
							$("#txtSisaPayung").val((AvValue.jumlahPayung == null) ? 0 : AvValue.jumlahPayung);
							$("#txtSisaPayungKuning").val((AvValue.jumlahPayungKuning == null) ? 0 : AvValue.jumlahPayungKuning);
						});

						if(response.DetailRencana[0].ket_barang.toUpperCase().indexOf("TUMPUK") != -1){
							if($("#txtPermintaan").val() == "CETAK/POLOS"){
								var arrJnsPermintaan = $("#txtPermintaan").val().split("/");
								var jnsPermintaan = arrJnsPermintaan[1];
							}else{
								var jnsPermintaan = $("#txtPermintaan").val();
							}
							var arrUkuran = response.DetailRencana[0].ukuran.replace(/ /g,"").split("/");
							var arrUkuranPlastikSecondary = arrUkuran[1].split("x");
							var merek = $("#txtMerek").val();
							$("#cmbUkuranTumpuk").select2({
								placeholder : "Pilih Roll ("+jnsPermintaan+")",
								// dropdownParent: $("#modalInputHasil"),
								width : "100%",
								cache:false,
								allowClear:true,
								ajax:{
									url : "<?php echo base_url(); ?>_cutting/main/getComboBoxValueGudangRoll/"+jnsPermintaan+"/"+arrUkuranPlastikSecondary[0]+"/"+merek+"/"+param2,
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

							$("#cmbUkuranTumpuk").on("select2:select", function(){
								var kdGdRollTumpuk = $("#cmbUkuranTumpuk").val().replace(/_/g," ");
								$.ajax({
									type : "POST",
									url : "<?php echo base_url('_cutting/main/getDataInputHasil'); ?>",
									dataType : "JSON",
									data : {
										panjangPlastik 	: arrUkuranPlastikSecondary[0].replace(/_/g," "),
										warnaPlastik 	: param2.replace(/_/g," "),
										kdGdRoll 		: kdGdRollTumpuk,
										tglRencana 		: param4.replace(/_/g," ")
									},
									success : function(response){
										$.each(response.PengambilanPotong, function(AvIndex, AvValue){
											if(jnsPermintaan == "POLOS"){
												$("#tdBahanTumpuk").text("Berat Pengambilan Extruder (Tumpuk)");
												$("#tdBobinTumpuk").text("Bobin Pengambilan Extruder (Tumpuk)");
												$("#tdPayungTumpuk").text("Payung Pengambilan Extruder (Tumpuk)");
												$("#tdPayungKuningTumpuk").text("Payung Kuning Pengambilan Extruder (Tumpuk)");
											}else{
												$("#tdBahanTumpuk").text("Berat Pengambilan Cetak (Tumpuk)");
												$("#tdBobinTumpuk").text("Bobin Pengambilan Cetak (Tumpuk)");
												$("#tdPayungTumpuk").text("Payung Pengambilan Cetak (Tumpuk)");
												$("#tdPayungKuningTumpuk").text("Payung Kuning Pengambilan Cetak (Tumpuk)");
											}
											$("#txtBahanTumpuk").val((AvValue.jumlahBerat == null) ? 0 : AvValue.jumlahBerat);
											$("#txtBobinTumpuk").val((AvValue.jumlahBobin == null) ? 0 : AvValue.jumlahBobin);
											$("#txtPayungTumpuk").val((AvValue.jumlahPayung == null) ? 0 : AvValue.jumlahPayung);
											$("#txtPayungKuningTumpuk").val((AvValue.jumlahPayungKuning == null) ? 0 : AvValue.jumlahPayungKuning);
										});

										$.each(response.SisaPengambilanPotongSemalam, function(AvIndex, AvValue){
											$("#txtBeratSisaSemalamTumpuk").val((AvValue.jumlahSisa == null) ? 0 : AvValue.jumlahSisa);
											$("#txtBobinSisaSemalamTumpuk").val((AvValue.jumlahBobin == null) ? 0 : AvValue.jumlahBobin);
											$("#txtPayungSisaSemalamTumpuk").val((AvValue.jumlahPayung == null) ? 0 : AvValue.jumlahPayung);
											$("#txtPayungKuningSisaSemalamTumpuk").val((AvValue.jumlahPayungKuning == null) ? 0 : AvValue.jumlahPayungKuning);
										});

										$.each(response.SisaPengambilanPotongHariIni, function(AvIndex, AvValue){
											$("#txtSisaTumpuk").val((AvValue.jumlahSisa == null) ? 0 : AvValue.jumlahSisa);
											$("#txtSisaBobinTumpuk").val((AvValue.jumlahBobin == null) ? 0 : AvValue.jumlahBobin);
											$("#txtSisaPayungTumpuk").val((AvValue.jumlahPayung == null) ? 0 : AvValue.jumlahPayung);
											$("#txtSisaPayungKuningTumpuk").val((AvValue.jumlahPayungKuning == null) ? 0 : AvValue.jumlahPayungKuning);
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
							$("#cmbUkuranTumpuk").on("select2:unselect", function(){
								$("#txtBahanTumpuk").val(0);
								$("#txtBobinTumpuk").val(0);
								$("#txtPayungTumpuk").val(0);
								$("#txtPayungKuningTumpuk").val(0);
								$("#txtBeratSisaSemalamTumpuk").val(0);
								$("#txtBobinSisaSemalamTumpuk").val(0);
								$("#txtPayungSisaSemalamTumpuk").val(0);
								$("#txtPayungKuningSisaSemalamTumpuk").val(0);
								$("#txtSisaTumpuk").val(0);
								$("#txtSisaBobinTumpuk").val(0);
								$("#txtSisaPayungTumpuk").val(0);
								$("#txtSisaPayungKuningTumpuk").val(0);
							});
							$("#tumpuk").css("display","block");
						}else{
							$("#tumpuk").css("display","none");
							$("#cmbUkuranTumpuk").on("select2:unselect", function(){
								$("#txtBahanTumpuk").val(0);
								$("#txtBobinTumpuk").val(0);
								$("#txtPayungTumpuk").val(0);
								$("#txtPayungKuningTumpuk").val(0);
								$("#txtBeratSisaSemalamTumpuk").val(0);
								$("#txtBobinSisaSemalamTumpuk").val(0);
								$("#txtPayungSisaSemalamTumpuk").val(0);
								$("#txtPayungKuningSisaSemalamTumpuk").val(0);
								$("#txtSisaTumpuk").val(0);
								$("#txtSisaBobinTumpuk").val(0);
								$("#txtSisaPayungTumpuk").val(0);
								$("#txtSisaPayungKuningTumpuk").val(0);
							});
							$("#cmbUkuranTumpuk").trigger("select2:unselect");
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

				$("#cmbRollPipa").on("change",function(){
					if(this.value == "PAYUNG"){
						$("#tdPayung").text("Jumlah Payung");
						$("#txtJumlahPayung").attr("placeholder","Masukan Jumlah Payung");
						$("#payung").css("display","block");
						$("#payungKuningPayung").css("display","none");
						$("#bobin").css("display","none");
						$("#bobinPayung").css("display","none");
						$("#bobin_payung_kuning_payung").css("display","none");
						var ketBarang = $("#ketBarang").val().toUpperCase();
						var ketMerek = $("#ketMerek").val().toUpperCase();
						var merek = $("#txtMerek").val().toUpperCase();
						if(param1.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1 || merek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
													}
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
								 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
														}else{
															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
														}
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
														}else{
															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
														}
													}
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
 															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
 														}else{
 															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
 														}
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
 															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
 														}else{
 															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
 														}
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;
							}
						}else{
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }
												 break;
							  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }
												 break;
								default:if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
												 }
												 break;
							}
						}
						if(TPanjangPlastik < 6){
							$("#txtRumusRollPayung").val(5000);
						}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
							$("#txtRumusRollPayung").val(6000);
						}else{
							$("#txtRumusRollPayung").val(7000);
						}
						var payungPengambilanBagian = parseFloat($("#txtPayung").val());
						var payungSisaSemalam = parseFloat($("#txtPayungSisaSemalam").val());
						var payungPengambilanGudang = parseFloat($("#txtPayungPengambilan").val());
						var payungSisaHariIni = parseFloat($("#txtSisaPayung").val());

						var payungPengambilanBagianTumpuk = parseFloat($("#txtPayungTumpuk").val());
						var payungSisaSemalamTumpuk = parseFloat($("#txtPayungSisaSemalamTumpuk").val());
						var payungPengambilanGudangTumpuk = parseFloat($("#txtPayungPengambilanTumpuk").val());
						var payungSisaHariIniTumpuk = parseFloat($("#txtSisaPayungTumpuk").val());

						var jumlahPayung =(((payungPengambilanBagian + payungPengambilanBagianTumpuk) + (payungSisaSemalam + payungSisaSemalamTumpuk) +
																(payungPengambilanGudang + payungPengambilanGudangTumpuk)) - (payungSisaHariIni + payungSisaHariIniTumpuk));
						$("#txtJumlahPayung").attr("readonly","readonly");
						$("#txtJumlahPayung").val(jumlahPayung);
					}else if(this.value == "PAYUNG_KUNING"){
						$("#tdPayung").text("Jumlah Payung Kuning");
						$("#txtJumlahPayung").attr("placeholder","Masukan Jumlah Payung Kuning");
						$("#payung").css("display","block");
						$("#payungKuningPayung").css("display","none");
						$("#bobin").css("display","none");
						$("#bobinPayung").css("display","none");
						$("#bobin_payung_kuning_payung").css("display","none");
						var ketBarang = $("#ketBarang").val().toUpperCase();
						var ketMerek = $("#ketMerek").val().toUpperCase();
						var merek = $("#txtMerek").val().toUpperCase();
						if(param1.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1 || merek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
								 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }
													}
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;
							}
						}else{
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }
												 break;
							  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }
												 break;
								default: if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
												 }
												 break;
							}
						}

						if(TPanjangPlastik <= 30){
							$("#txtRumusRollPayung").val(4000);
						}else{
							$("#txtRumusRollPayung").val(5000);
						}
						var payungKuningPengambilanBagian = parseFloat($("#txtPayungKuning").val());
						var payungKuningSisaSemalam = parseFloat($("#txtPayungKuningSisaSemalam").val());
						var payungKuningPengambilanGudang = parseFloat($("#txtPayungKuningPengambilan").val());
						var payungKuningSisaHariIni = parseFloat($("#txtSisaPayungKuning").val());

						var payungKuningPengambilanBagianTumpuk = parseFloat($("#txtPayungKuningTumpuk").val());
						var payungKuningSisaSemalamTumpuk = parseFloat($("#txtPayungKuningSisaSemalamTumpuk").val());
						var payungKuningPengambilanGudangTumpuk = parseFloat($("#txtPayungKuningPengambilanTumpuk").val());
						var payungKuningSisaHariIniTumpuk = parseFloat($("#txtSisaPayungKuningTumpuk").val());

						var jumlahPayungKuning =(((payungKuningPengambilanBagian + payungKuningPengambilanBagianTumpuk) + (payungKuningSisaSemalam + payungKuningSisaSemalamTumpuk) +
																			(payungKuningPengambilanGudang + payungKuningPengambilanGudangTumpuk)) - (payungKuningSisaHariIni + payungKuningSisaHariIniTumpuk));
						$("#txtJumlahPayung").attr("readonly","readonly");
						$("#txtJumlahPayung").val(jumlahPayungKuning);
					}else if(this.value == "PAYUNG_KUNING_PAYUNG"){
						$("#payung").css("display","none");
						$("#bobin").css("display","none");
						$("#payungKuningPayung").css("display","block");
						$("#bobin_payung_kuning_payung").css("display","none");
						$("#bobinPayung").css("display","none");
						var payungPengambilanBagian = parseFloat($("#txtPayung").val());
						var payungSisaSemalam = parseFloat($("#txtPayungSisaSemalam").val());
						var payungPengambilanGudang = parseFloat($("#txtPayungPengambilan").val());
						var payungSisaHariIni = parseFloat($("#txtSisaPayung").val());

						var payungPengambilanBagianTumpuk = parseFloat($("#txtPayungTumpuk").val());
						var payungSisaSemalamTumpuk = parseFloat($("#txtPayungSisaSemalamTumpuk").val());
						var payungPengambilanGudangTumpuk = parseFloat($("#txtPayungPengambilanTumpuk").val());
						var payungSisaHariIniTumpuk = parseFloat($("#txtSisaPayungTumpuk").val());

						var jumlahPayung =(((payungPengambilanBagian + payungPengambilanBagianTumpuk) + (payungSisaSemalam + payungSisaSemalamTumpuk) +
																(payungPengambilanGudang + payungPengambilanGudangTumpuk)) - (payungSisaHariIni + payungSisaHariIniTumpuk))

						var payungKuningPengambilanBagian = parseFloat($("#txtPayungKuning").val());
						var payungKuningSisaSemalam = parseFloat($("#txtPayungKuningSisaSemalam").val());
						var payungKuningPengambilanGudang = parseFloat($("#txtPayungKuningPengambilan").val());
						var payungKuningSisaHariIni = parseFloat($("#txtSisaPayungKuning").val());

						var payungKuningPengambilanBagianTumpuk = parseFloat($("#txtPayungKuningTumpuk").val());
						var payungKuningSisaSemalamTumpuk = parseFloat($("#txtPayungKuningSisaSemalamTumpuk").val());
						var payungKuningPengambilanGudangTumpuk = parseFloat($("#txtPayungKuningPengambilanTumpuk").val());
						var payungKuningSisaHariIniTumpuk = parseFloat($("#txtSisaPayungKuningTumpuk").val());

						var jumlahPayungKuning =(((payungKuningPengambilanBagian + payungKuningPengambilanBagianTumpuk) + (payungKuningSisaSemalam + payungKuningSisaSemalamTumpuk) +
																			(payungKuningPengambilanGudang + payungKuningPengambilanGudangTumpuk)) - (payungKuningSisaHariIni + payungKuningSisaHariIniTumpuk));

						$("#txtJumlahPayung_PKP").attr("readonly","readonly");
						$("#txtJumlahPayungKuning_PKP").attr("readonly","readonly");
						$("#txtJumlahPayung_PKP").val(jumlahPayung);
						$("#txtJumlahPayungKuning_PKP").val(jumlahPayungKuning);
					}else if(this.value == "BOBIN"){
						$("#payung").css("display","none");
						$("#bobin").css("display","block");
						$("#payungKuningPayung").css("display","none");
						$("#bobinPayung").css("display","none");
						$("#bobin_payung_kuning_payung").css("display","none");
						$("#txtUkuranPlastik").val(param1);
						$("#txtRumus").val(30);
						var bobinPengambilanBagian = parseFloat($("#txtBobin").val());
						var bobinSisaSemalam = parseFloat($("#txtBobinSisaSemalam").val());
						var bobinPengambilanGudang = parseFloat($("#txtBobinPengambilan").val());
						var bobinSisaHariIni = parseFloat($("#txtSisaBobin").val());

						var bobinPengambilanBagianTumpuk = parseFloat($("#txtBobinTumpuk").val());
						var bobinSisaSemalamTumpuk = parseFloat($("#txtBobinSisaSemalamTumpuk").val());
						var bobinPengambilanGudangTumpuk = parseFloat($("#txtBobinPengambilanTumpuk").val());
						var bobinSisaHariIniTumpuk = parseFloat($("#txtSisaBobinTumpuk").val());

						var jumlahBobin = (((bobinPengambilanBagian + bobinPengambilanBagianTumpuk) + (bobinSisaSemalam + bobinSisaSemalamTumpuk) +
																(bobinPengambilanGudang + bobinPengambilanGudangTumpuk)) - (bobinSisaHariIni + bobinSisaHariIniTumpuk));
						$("#txtBanyaknyaPipa").attr("readonly","readonly");
						$("#txtBanyaknyaPipa").val(jumlahBobin);
					}else if(this.value == "BOBIN_PAYUNG"){
						$("#payung").css("display","none");
						$("#bobin").css("display","none");
						$("#payungKuningPayung").css("display","none");
						$("#bobinPayung").css("display","block");
						$("#bobin_payung_kuning_payung").css("display","none");
						$("#txtJumlahBobinPayung_Payung").attr("placeholder","Masukan Jumlah Payung");
						var ketBarang = $("#ketBarang").val().toUpperCase();
						var ketMerek = $("#ketMerek").val().toUpperCase();
						var merek = $("#txtMerek").val().toUpperCase();
						if(param1.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1 || merek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
								 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }
													}
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;
							}
						}else{
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }
												 break;
							  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }
												 break;
								default: if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
												 }
												 break;
							}
						}

						if(TPanjangPlastik < 6){
							$("#txtRumusRollBobinPayung_Payung").val(5000);
						}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
							$("#txtRumusRollBobinPayung_Payung").val(6000);
						}else{
							$("#txtRumusRollBobinPayung_Payung").val(7000);
						}
						var payungPengambilanBagian = parseFloat($("#txtPayung").val());
						var payungSisaSemalam = parseFloat($("#txtPayungSisaSemalam").val());
						var payungPengambilanGudang = parseFloat($("#txtPayungPengambilan").val());
						var payungSisaHariIni = parseFloat($("#txtSisaPayung").val());

						var payungPengambilanBagianTumpuk = parseFloat($("#txtPayungTumpuk").val());
						var payungSisaSemalamTumpuk = parseFloat($("#txtPayungSisaSemalamTumpuk").val());
						var payungPengambilanGudangTumpuk = parseFloat($("#txtPayungPengambilanTumpuk").val());
						var payungSisaHariIniTumpuk = parseFloat($("#txtSisaPayungTumpuk").val());

						var jumlahPayung =(((payungPengambilanBagian + payungPengambilanBagianTumpuk) + (payungSisaSemalam + payungSisaSemalamTumpuk) +
																(payungPengambilanGudang + payungPengambilanGudangTumpuk)) - (payungSisaHariIni + payungSisaHariIniTumpuk))

						var bobinPengambilanBagian = parseFloat($("#txtBobin").val());
						var bobinSisaSemalam = parseFloat($("#txtBobinSisaSemalam").val());
						var bobinPengambilanGudang = parseFloat($("#txtBobinPengambilan").val());
						var bobinSisaHariIni = parseFloat($("#txtSisaBobin").val());

						var bobinPengambilanBagianTumpuk = parseFloat($("#txtBobinTumpuk").val());
						var bobinSisaSemalamTumpuk = parseFloat($("#txtBobinSisaSemalamTumpuk").val());
						var bobinPengambilanGudangTumpuk = parseFloat($("#txtBobinPengambilanTumpuk").val());
						var bobinSisaHariIniTumpuk = parseFloat($("#txtSisaBobinTumpuk").val());

						var jumlahBobin = (((bobinPengambilanBagian + bobinPengambilanBagianTumpuk) + (bobinSisaSemalam + bobinSisaSemalamTumpuk) +
																(bobinPengambilanGudang + bobinPengambilanGudangTumpuk)) - (bobinSisaHariIni + bobinSisaHariIniTumpuk));

						$("#txtRumusRollBobinPayung_Bobin").val(30);
						$("#txtJumlahBobinPayung_Payung").attr("readonly","readonly");
						$("#txtJumlahBobinPayung_Bobin").attr("readonly","readonly");
						$("#txtJumlahBobinPayung_Payung").val(jumlahPayung);
						$("#txtJumlahBobinPayung_Bobin").val(jumlahBobin);
					}else if(this.value == "BOBIN_PAYUNG_KUNING"){
						$("#payung").css("display","none");
						$("#bobin").css("display","none");
						$("#payungKuningPayung").css("display","none");
						$("#bobin_payung_kuning_payung").css("display","none");
						$("#bobinPayung").css("display","block");
						$("#txtJumlahBobinPayung_Payung").attr("placeholder","Masukan Jumlah Payung Kuning");
						var ketBarang = $("#ketBarang").val().toUpperCase();
						var ketMerek = $("#ketMerek").val().toUpperCase();
						var merek = $("#txtMerek").val().toUpperCase();
						if(param1.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1 || merek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
								 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }
													}
												 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
													 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;
							}
						}else{
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }
												 break;
							  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }
												 break;
								default: if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
												 }
												 break;
							}
						}

						if(TPanjangPlastik <= 30){
							$("#txtRumusRollBobinPayung_Payung").val(4000);
						}else{
							$("#txtRumusRollBobinPayung_Payung").val(5000);
						}
						var payungKuningPengambilanBagian = parseFloat($("#txtPayungKuning").val());
						var payungKuningSisaSemalam = parseFloat($("#txtPayungKuningSisaSemalam").val());
						var payungKuningPengambilanGudang = parseFloat($("#txtPayungKuningPengambilan").val());
						var payungKuningSisaHariIni = parseFloat($("#txtSisaPayungKuning").val());

						var payungKuningPengambilanBagianTumpuk = parseFloat($("#txtPayungKuningTumpuk").val());
						var payungKuningSisaSemalamTumpuk = parseFloat($("#txtPayungKuningSisaSemalamTumpuk").val());
						var payungKuningPengambilanGudangTumpuk = parseFloat($("#txtPayungKuningPengambilanTumpuk").val());
						var payungKuningSisaHariIniTumpuk = parseFloat($("#txtSisaPayungKuningTumpuk").val());

						var jumlahPayungKuning =(((payungKuningPengambilanBagian + payungKuningPengambilanBagianTumpuk) + (payungKuningSisaSemalam + payungKuningSisaSemalamTumpuk) +
																			(payungKuningPengambilanGudang + payungKuningPengambilanGudangTumpuk)) - (payungKuningSisaHariIni + payungKuningSisaHariIniTumpuk));

						var bobinPengambilanBagian = parseFloat($("#txtBobin").val());
						var bobinSisaSemalam = parseFloat($("#txtBobinSisaSemalam").val());
						var bobinPengambilanGudang = parseFloat($("#txtBobinPengambilan").val());
						var bobinSisaHariIni = parseFloat($("#txtSisaBobin").val());

						var bobinPengambilanBagianTumpuk = parseFloat($("#txtBobinTumpuk").val());
						var bobinSisaSemalamTumpuk = parseFloat($("#txtBobinSisaSemalamTumpuk").val());
						var bobinPengambilanGudangTumpuk = parseFloat($("#txtBobinPengambilanTumpuk").val());
						var bobinSisaHariIniTumpuk = parseFloat($("#txtSisaBobinTumpuk").val());

						var jumlahBobin = (((bobinPengambilanBagian + bobinPengambilanBagianTumpuk) + (bobinSisaSemalam + bobinSisaSemalamTumpuk) +
																(bobinPengambilanGudang + bobinPengambilanGudangTumpuk)) - (bobinSisaHariIni + bobinSisaHariIniTumpuk));

						$("#txtRumusRollBobinPayung_Bobin").val(30);
						$("#txtJumlahBobinPayung_Payung").attr("readonly","readonly");
						$("#txtJumlahBobinPayung_Bobin").attr("readonly","readonly");
						$("#txtJumlahBobinPayung_Payung").val(jumlahPayungKuning);
						$("#txtJumlahBobinPayung_Bobin").val(jumlahBobin);
					}else if(this.value == "BOBIN_PAYUNG_KUNING_PAYUNG"){
						$("#payung").css("display","none");
						$("#bobin").css("display","none");
						$("#payungKuningPayung").css("display","none");
						$("#bobinPayung").css("display","none");
						$("#bobin_payung_kuning_payung").css("display","block");
						$("#txtBPKP_UkuranPlastik").val(param1);
						$("#txtBPKP_Rumus").val(30);

						var ketBarang = $("#ketBarang").val().toUpperCase();
						var ketMerek = $("#ketMerek").val().toUpperCase();
						var merek = $("#txtMerek").val().toUpperCase();
						if(param1.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1 || merek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
								 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }
													}
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1]) + 5.5;
														 }
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;
							}
						}else{
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }
												 break;
							  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }
												 break;
								default: if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
												 }
												 break;
							}
						}

						if(TPanjangPlastik <= 30){
							$("#txtBPKP_RumusPayungKuning").val(4000);
						}else{
							$("#txtBPKP_RumusPayungKuning").val(5000);
						}

						if(TPanjangPlastik < 6){
							$("#txtBPKP_RumusPayung").val(5000);
						}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
							$("#txtBPKP_RumusPayung").val(6000);
						}else{
							$("#txtBPKP_RumusPayung").val(7000);
						}

						var payungPengambilanBagian = parseFloat($("#txtPayung").val());
						var payungSisaSemalam = parseFloat($("#txtPayungSisaSemalam").val());
						var payungPengambilanGudang = parseFloat($("#txtPayungPengambilan").val());
						var payungSisaHariIni = parseFloat($("#txtSisaPayung").val());

						var payungPengambilanBagianTumpuk = parseFloat($("#txtPayungTumpuk").val());
						var payungSisaSemalamTumpuk = parseFloat($("#txtPayungSisaSemalamTumpuk").val());
						var payungPengambilanGudangTumpuk = parseFloat($("#txtPayungPengambilanTumpuk").val());
						var payungSisaHariIniTumpuk = parseFloat($("#txtSisaPayungTumpuk").val());

						var jumlahPayung =(((payungPengambilanBagian + payungPengambilanBagianTumpuk) + (payungSisaSemalam + payungSisaSemalamTumpuk) +
																(payungPengambilanGudang + payungPengambilanGudangTumpuk)) - (payungSisaHariIni + payungSisaHariIniTumpuk))

						var payungKuningPengambilanBagian = parseFloat($("#txtPayungKuning").val());
						var payungKuningSisaSemalam = parseFloat($("#txtPayungKuningSisaSemalam").val());
						var payungKuningPengambilanGudang = parseFloat($("#txtPayungKuningPengambilan").val());
						var payungKuningSisaHariIni = parseFloat($("#txtSisaPayungKuning").val());

						var payungKuningPengambilanBagianTumpuk = parseFloat($("#txtPayungKuningTumpuk").val());
						var payungKuningSisaSemalamTumpuk = parseFloat($("#txtPayungKuningSisaSemalamTumpuk").val());
						var payungKuningPengambilanGudangTumpuk = parseFloat($("#txtPayungKuningPengambilanTumpuk").val());
						var payungKuningSisaHariIniTumpuk = parseFloat($("#txtSisaPayungKuningTumpuk").val());

						var jumlahPayungKuning =(((payungKuningPengambilanBagian + payungKuningPengambilanBagianTumpuk) + (payungKuningSisaSemalam + payungKuningSisaSemalamTumpuk) +
																			(payungKuningPengambilanGudang + payungKuningPengambilanGudangTumpuk)) - (payungKuningSisaHariIni + payungKuningSisaHariIniTumpuk));

						var bobinPengambilanBagian = parseFloat($("#txtBobin").val());
						var bobinSisaSemalam = parseFloat($("#txtBobinSisaSemalam").val());
						var bobinPengambilanGudang = parseFloat($("#txtBobinPengambilan").val());
						var bobinSisaHariIni = parseFloat($("#txtSisaBobin").val());

						var bobinPengambilanBagianTumpuk = parseFloat($("#txtBobinTumpuk").val());
						var bobinSisaSemalamTumpuk = parseFloat($("#txtBobinSisaSemalamTumpuk").val());
						var bobinPengambilanGudangTumpuk = parseFloat($("#txtBobinPengambilanTumpuk").val());
						var bobinSisaHariIniTumpuk = parseFloat($("#txtSisaBobinTumpuk").val());

						var jumlahBobin = (((bobinPengambilanBagian + bobinPengambilanBagianTumpuk) + (bobinSisaSemalam + bobinSisaSemalamTumpuk) +
																(bobinPengambilanGudang + bobinPengambilanGudangTumpuk)) - (bobinSisaHariIni + bobinSisaHariIniTumpuk));

						$("#txtBPKP_BanyaknyaPipa").attr("readonly","readonly");
						$("#txtBPKP_JumlahPayung").attr("readonly","readonly");
						$("#txtBPKP_JumlahPayungKuning").attr("readonly","readonly");
						$("#txtBPKP_BanyaknyaPipa").val(jumlahBobin);
						$("#txtBPKP_JumlahPayung").val(jumlahPayung);
						$("#txtBPKP_JumlahPayungKuning").val(jumlahPayungKuning);
					}else{
						$("#payung").css("display","none");
						$("#bobin").css("display","none");
						$("#payungKuningPayung").css("display","none");
						$("#bobinPayung").css("display","none");
						$("#bobin_payung_kuning_payung").css("display","none");
					}
				});

				$("#cmbRollPipa").val("").trigger("change");
			}

			function modalTambahHistoryTertinggal(param){
				if(param == "POLOS"){
					$("#txtTglAwal_Polos").val("");
					$("#txtTglAkhir_Polos").val("");
					$(".date").datepicker("setDate",null);
					$("#btnCariHistorySisaPolosTertinggal").attr("onclick","searchTambahHistoryTertinggal('"+param+"')");
				}else{
					$("#txtTglAwal_Cetak").val("");
					$("#txtTglAkhir_Cetak").val("");
					$(".date").datepicker("setDate",null);
					$("#btnCariHistorySisaCetakTertinggal").attr("onclick","searchTambahHistoryTertinggal('"+param+"')");
				}
			}

			function modalTambahKeteranganApal(param,param2){
				$("#cmbJenisApal").val("");
				$("#txtJumlahApal").val("");
				tableListDataBonApalPending();
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_cutting/main/getGudangApal') ?>",
					dataType : "JSON",
					data : {
						jnsPermintaan : param2
					},
					success : function(response){
						$("#cmbJenisApal").empty();
						$("#cmbJenisApal").append("<option value=''>-- Pilih Jenis Apal--</option>");
						$.each(response, function(AvIndex, AvValue){
							if(AvValue.sub_jenis=="" || AvValue.sub_jenis==null){
								$("#cmbJenisApal").append("<option value='"+AvValue.kd_gd_apal+"'>"+AvValue.jenis+"</option>");
							}else{
								$("#cmbJenisApal").append("<option value='"+AvValue.kd_gd_apal+"'>"+AvValue.sub_jenis+"</option>");
							}
						});
						$("#btnTambahApalGlobalPerJenis").attr("onclick","saveTambahBonApal('"+param+"')");
						$("#btnResetEditBonApal").attr("onclick","resetTambahBonApalPending('"+param+"')");
					},
					error : function(response){
						$("#modal-notif").addClass("modal-danger");
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

			function modalEditBonApalPending(param, param2){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_cutting/main/getDetailBonApal') ?>",
					dataType : "JSON",
					data : {
						idTransaksi : param
					},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#cmbJenisApal").val(AvValue.kd_gd_apal);
							$("#txtJumlahApal").val(AvValue.jumlah_apal);
							$("#btnTambahApalGlobalPerJenis").attr("onclick","editBonApal('"+AvValue.id+"','"+param2+"')").removeClass("btn-primary").addClass("btn-warning").html("<i class='fa fa-pencil'></i> Ubah");
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

			function modalBuatBon(param, param2){
				$("#liMerah").text("Merah = 0");
				$("#liHijau").text("Hijau = 0");
				$("#liKuning").text("Kuning = 0");
				$("#liBiru").text("Biru = 0");
				$("#liOrange").text("Orange = 0");
				$("#liCoklat").text("Coklat = 0");
				$("#liHitam").text("Hitam = 0");
				$("#liSilver").text("Silver = 0");
				$("#liStrip").text("Strip = 0");
				$("#liPutihSusu").text("Putih Susu = 0");
				$("#liPutih").text("Putih = 0");
				$("#liLaporan").text("Laporan = 0");
				var Merah = 0;
				var Hijau = 0;
				var Kuning = 0;
				var Biru = 0;
				var Orange = 0;
				var Coklat = 0;
				var Hitam = 0;
				var Ungu = 0;
				var Silver = 0;
				var Putih_Susu = 0;
				var Putih = 0;

				var total = 0;
				var strip = 0;
				var totalx = 0;
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_cutting/main/getBuatBon') ?>",
					dataType : "JSON",
					data : {
						tglJadi : param,
						jnsPermintaan : param2
					},
					success : function(response){
						$("#tableListBon > tbody > tr").empty();
						$.each(response.ListBon, function(AvIndex, AvValue){
							$("#tableListBon tbody:last-child").append(
								"<tr>"+
									"<td>"+AvValue.ukuran+"</td>"+
									"<td>"+AvValue.merek+"</td>"+
									"<td>"+AvValue.no_mesin+"</td>"+
									"<td>"+AvValue.apal+"</td>"+
									"<td>"+AvValue.warna_plastik+"</td>"+
								"</tr>"
							);
							totalx += parseFloat(AvValue.apal);
							if(AvValue.warna_plastik == "merah"){
								Merah += parseFloat(AvValue.apal);
							}else if(AvValue.warna_plastik == "hijau"){
								Hijau += parseFloat(AvValue.apal);
							}else if(AvValue.warna_plastik == "kuning"){
								Kuning += parseFloat(AvValue.apal);
							}else if(AvValue.warna_plastik == "biru"){
								Biru += parseFloat(AvValue.apal);
							}else if(AvValue.warna_plastik == "orange"){
								Orange += parseFloat(AvValue.apal);
							}else if(AvValue.warna_plastik == "coklat"){
								Coklat += parseFloat(AvValue.apal);
							}else if(AvValue.warna_plastik == "hitam"){
								Hitam += parseFloat(AvValue.apal);
							}else if(AvValue.warna_plastik == "ungu"){
								Ungu += parseFloat(AvValue.apal);
							}else if(AvValue.warna_plastik == "silver"){
								Silver += parseFloat(AvValue.apal);
							}else if(AvValue.warna_plastik == "putih susu" || AvValue.warna_plastik == "pss"){
								Putih_Susu += parseFloat(AvValue.apal);
							}else if(AvValue.warna_plastik == "putih"){
								Putih += parseFloat(AvValue.apal);
							}
						});

						$.each(response.ListTotalSubBon, function(AvIndex, AvValue){
							if(AvValue.jenis == "STRIP" || AvValue.jenis == "STRIP"){
								if(param2=="CETAK"){
									$("#liStrip").text("Strip = 0");
								}else{
									strip += parseFloat(AvValue.jumlah);
									$("#liStrip").text("Strip = " + AvValue.jumlah );
								}
							}else{
								// $("#liMerah").text("Merah = 0");
								// $("#liHijau").text("Hijau = 0");
								// $("#liKuning").text("Kuning = 0");
								// $("#liBiru").text("Biru = 0");
								// $("#liOrange").text("Orange = 0");
								// $("#liCoklat").text("Coklat = 0");
								// $("#liHitam").text("Hitam = 0");
								// $("#liSilver").text("Silver = 0");
								$("#liStrip").text("Strip = 0");
								// $("#liPutihSusu").text("Putih Susu = 0");
								// $("#liPutih").text("Putih = 0");
							}
							total += parseFloat(AvValue.jumlah);
						});
						$("#liMerah").text("Merah = " + Merah);
						$("#liHijau").text("Hijau = " + Hijau);
						$("#liKuning").text("Kuning = " + Kuning);
						$("#liBiru").text("Biru = " + Biru);
						$("#liOrange").text("Orange = " + Orange);
						$("#liCoklat").text("Coklat = " + Coklat);
						$("#liHitam").text("Hitam = " + Hitam);
						$("#liUngu").text("Ungu = " + Ungu);
						$("#liSilver").text("Silver = " + Silver);
						$("#liPutihSusu").text("Putih Susu = " + Putih_Susu);
						$("#liPutih").text("Putih = " + parseFloat(Putih-strip).toLocaleString());

						if(param2=="CETAK"){
							$("#liLaporan").text("Laporan = "+parseFloat(totalx).toFixed(2).toLocaleString());
						}else{
							$("#liLaporan").text("Laporan = "+parseFloat(totalx).toFixed(2).toLocaleString());
						}
						$("#btnPrint").attr("href","<?php echo base_url('_cutting/main/printListBonApal'); ?>/"+param2+"/"+param);
					},
					error : function(response){
						$("#modal-notif").addClass("modal-danger");
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

			function modalEditHasilCutting(param, param1, param3, param4){
				$("input").val("");
				$("#cmbRollPipa").val("").trigger("change");
				$("#cmbMerek").trigger("select2:unselect");
				$("#btnEditHasilCutting").attr("disabled","disabled");
				param3 = param3.replace(/_/g," ");
				$("#modalEditHasilCutting").modal({backdrop:"static"});
				$("#btnEditHasilCutting").attr("onclick","editHasilCutting('"+param+"','"+param4+"')");
				$("#cmbRollPipa").on("change",function(){
					if(this.value == "PAYUNG"){
						$("#tdPayung").text("Jumlah Payung");
						$("#txtJumlahPayung").attr("placeholder","Masukan Jumlah Payung");
						$("#payung").css("display","block");
						$("#payungKuningPayung").css("display","none");
						$("#bobin").css("display","none");
						$("#bobinPayung").css("display","none");
						$("#bobin_payung_kuning_payung").css("display","none");
						var ketBarang = $("#ketBarang").val().toUpperCase();
						var ketMerek = $("#ketMerek").val().toUpperCase();
						var merek = $("#txtMerek").val().toUpperCase();
						if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
													}
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
								 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
														}else{
															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
														}
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
														}else{
															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
														}
													}
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
 															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
 														}else{
 															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
 														}
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
 															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
 														}else{
 															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
 														}
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;
							}
						}else{
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }
												 break;
							  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }
												 break;
								default:if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
												 }
												 break;
							}
						}

						if(TPanjangPlastik < 6){
							$("#txtRumusRollPayung").val(5000);
						}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
							$("#txtRumusRollPayung").val(6000);
						}else{
							$("#txtRumusRollPayung").val(7000);
						}
						var payungPengambilanBagian = parseFloat($("#txtPayung").val());
						var payungSisaSemalam = parseFloat($("#txtPayungSisaSemalam").val());
						var payungPengambilanGudang = parseFloat($("#txtPayungPengambilan").val());
						var payungSisaHariIni = parseFloat($("#txtSisaPayung").val());

						var payungPengambilanBagianTumpuk = parseFloat($("#txtPayungTumpuk").val());
						var payungSisaSemalamTumpuk = parseFloat($("#txtPayungSisaSemalamTumpuk").val());
						var payungPengambilanGudangTumpuk = parseFloat($("#txtPayungPengambilanTumpuk").val());
						var payungSisaHariIniTumpuk = parseFloat($("#txtSisaPayungTumpuk").val());

						var jumlahPayung =(((payungPengambilanBagian + payungPengambilanBagianTumpuk) + (payungSisaSemalam + payungSisaSemalamTumpuk) +
																(payungPengambilanGudang + payungPengambilanGudangTumpuk)) - (payungSisaHariIni + payungSisaHariIniTumpuk));
						$("#txtJumlahPayung").attr("readonly","readonly");
						$("#txtJumlahPayung").val(jumlahPayung);
					}else if(this.value == "PAYUNG_KUNING"){
						$("#tdPayung").text("Jumlah Payung Kuning");
						$("#txtJumlahPayung").attr("placeholder","Masukan Jumlah Payung Kuning");
						$("#payung").css("display","block");
						$("#payungKuningPayung").css("display","none");
						$("#bobin").css("display","none");
						$("#bobinPayung").css("display","none");
						$("#bobin_payung_kuning_payung").css("display","none");
						var ketBarang = $("#ketBarang").val().toUpperCase();
						var ketMerek = $("#ketMerek").val().toUpperCase();
						var merek = $("#txtMerek").val().toUpperCase();
						if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
								 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }
													}
												 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
													 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;
							}
						}else{
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }
												 break;
							  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }
												 break;
								default: if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
												 }
												 break;
							}
						}

						if(TPanjangPlastik <= 30){
							$("#txtRumusRollPayung").val(4000);
						}else{
							$("#txtRumusRollPayung").val(5000);
						}
						var payungKuningPengambilanBagian = parseFloat($("#txtPayungKuning").val());
						var payungKuningSisaSemalam = parseFloat($("#txtPayungKuningSisaSemalam").val());
						var payungKuningPengambilanGudang = parseFloat($("#txtPayungKuningPengambilan").val());
						var payungKuningSisaHariIni = parseFloat($("#txtSisaPayungKuning").val());

						var payungKuningPengambilanBagianTumpuk = parseFloat($("#txtPayungKuningTumpuk").val());
						var payungKuningSisaSemalamTumpuk = parseFloat($("#txtPayungKuningSisaSemalamTumpuk").val());
						var payungKuningPengambilanGudangTumpuk = parseFloat($("#txtPayungKuningPengambilanTumpuk").val());
						var payungKuningSisaHariIniTumpuk = parseFloat($("#txtSisaPayungKuningTumpuk").val());

						var jumlahPayungKuning =(((payungKuningPengambilanBagian + payungKuningPengambilanBagianTumpuk) + (payungKuningSisaSemalam + payungKuningSisaSemalamTumpuk) +
																			(payungKuningPengambilanGudang + payungKuningPengambilanGudangTumpuk)) - (payungKuningSisaHariIni + payungKuningSisaHariIniTumpuk));
						$("#txtJumlahPayung").attr("readonly","readonly");
						$("#txtJumlahPayung").val(jumlahPayungKuning);
					}else if(this.value == "PAYUNG_KUNING_PAYUNG"){
						$("#payung").css("display","none");
						$("#bobin").css("display","none");
						$("#payungKuningPayung").css("display","block");
						$("#bobin_payung_kuning_payung").css("display","none");
						$("#bobinPayung").css("display","none");
						var payungPengambilanBagian = parseFloat($("#txtPayung").val());
						var payungSisaSemalam = parseFloat($("#txtPayungSisaSemalam").val());
						var payungPengambilanGudang = parseFloat($("#txtPayungPengambilan").val());
						var payungSisaHariIni = parseFloat($("#txtSisaPayung").val());

						var payungPengambilanBagianTumpuk = parseFloat($("#txtPayungTumpuk").val());
						var payungSisaSemalamTumpuk = parseFloat($("#txtPayungSisaSemalamTumpuk").val());
						var payungPengambilanGudangTumpuk = parseFloat($("#txtPayungPengambilanTumpuk").val());
						var payungSisaHariIniTumpuk = parseFloat($("#txtSisaPayungTumpuk").val());

						var jumlahPayung =(((payungPengambilanBagian + payungPengambilanBagianTumpuk) + (payungSisaSemalam + payungSisaSemalamTumpuk) +
																(payungPengambilanGudang + payungPengambilanGudangTumpuk)) - (payungSisaHariIni + payungSisaHariIniTumpuk))

						var payungKuningPengambilanBagian = parseFloat($("#txtPayungKuning").val());
						var payungKuningSisaSemalam = parseFloat($("#txtPayungKuningSisaSemalam").val());
						var payungKuningPengambilanGudang = parseFloat($("#txtPayungKuningPengambilan").val());
						var payungKuningSisaHariIni = parseFloat($("#txtSisaPayungKuning").val());

						var payungKuningPengambilanBagianTumpuk = parseFloat($("#txtPayungKuningTumpuk").val());
						var payungKuningSisaSemalamTumpuk = parseFloat($("#txtPayungKuningSisaSemalamTumpuk").val());
						var payungKuningPengambilanGudangTumpuk = parseFloat($("#txtPayungKuningPengambilanTumpuk").val());
						var payungKuningSisaHariIniTumpuk = parseFloat($("#txtSisaPayungKuningTumpuk").val());

						var jumlahPayungKuning =(((payungKuningPengambilanBagian + payungKuningPengambilanBagianTumpuk) + (payungKuningSisaSemalam + payungKuningSisaSemalamTumpuk) +
																			(payungKuningPengambilanGudang + payungKuningPengambilanGudangTumpuk)) - (payungKuningSisaHariIni + payungKuningSisaHariIniTumpuk));

						$("#txtJumlahPayung_PKP").attr("readonly","readonly");
						$("#txtJumlahPayungKuning_PKP").attr("readonly","readonly");
						$("#txtJumlahPayung_PKP").val(jumlahPayung);
						$("#txtJumlahPayungKuning_PKP").val(jumlahPayungKuning);
					}else if(this.value == "BOBIN"){
						$("#payung").css("display","none");
						$("#bobin").css("display","block");
						$("#payungKuningPayung").css("display","none");
						$("#bobinPayung").css("display","none");
						$("#bobin_payung_kuning_payung").css("display","none");
						$("#txtUkuranPlastik").val(param1);
						$("#txtRumus").val(30);
						var bobinPengambilanBagian = parseFloat($("#txtBobin").val());
						var bobinSisaSemalam = parseFloat($("#txtBobinSisaSemalam").val());
						var bobinPengambilanGudang = parseFloat($("#txtBobinPengambilan").val());
						var bobinSisaHariIni = parseFloat($("#txtSisaBobin").val());

						var bobinPengambilanBagianTumpuk = parseFloat($("#txtBobinTumpuk").val());
						var bobinSisaSemalamTumpuk = parseFloat($("#txtBobinSisaSemalamTumpuk").val());
						var bobinPengambilanGudangTumpuk = parseFloat($("#txtBobinPengambilanTumpuk").val());
						var bobinSisaHariIniTumpuk = parseFloat($("#txtSisaBobinTumpuk").val());

						var jumlahBobin = (((bobinPengambilanBagian + bobinPengambilanBagianTumpuk) + (bobinSisaSemalam + bobinSisaSemalamTumpuk) +
																(bobinPengambilanGudang + bobinPengambilanGudangTumpuk)) - (bobinSisaHariIni + bobinSisaHariIniTumpuk));
						$("#txtBanyaknyaPipa").attr("readonly","readonly");
						$("#txtBanyaknyaPipa").val(jumlahBobin);
					}else if(this.value == "BOBIN_PAYUNG"){
						$("#payung").css("display","none");
						$("#bobin").css("display","none");
						$("#payungKuningPayung").css("display","none");
						$("#bobinPayung").css("display","block");
						$("#bobin_payung_kuning_payung").css("display","none");
						$("#txtJumlahBobinPayung_Payung").attr("placeholder","Masukan Jumlah Payung");
						var ketBarang = $("#ketBarang").val().toUpperCase();
						var ketMerek = $("#ketMerek").val().toUpperCase();
						var merek = $("#txtMerek").val().toUpperCase();
						if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
													 if(parseFloat(arrPanjangPlastik[0].indexOf("in")) != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
								 					if(arrPanjangPlastik[1].replace(/in/gi,'') > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }
													}
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;
							}
						}else{
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }
												 break;
							  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }
												 break;
								default: if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
												 }
												 break;
							}
						}

						if(TPanjangPlastik < 6){
							$("#txtRumusRollBobinPayung_Payung").val(5000);
						}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
							$("#txtRumusRollBobinPayung_Payung").val(6000);
						}else{
							$("#txtRumusRollBobinPayung_Payung").val(7000);
						}
						var payungPengambilanBagian = parseFloat($("#txtPayung").val());
						var payungSisaSemalam = parseFloat($("#txtPayungSisaSemalam").val());
						var payungPengambilanGudang = parseFloat($("#txtPayungPengambilan").val());
						var payungSisaHariIni = parseFloat($("#txtSisaPayung").val());

						var payungPengambilanBagianTumpuk = parseFloat($("#txtPayungTumpuk").val());
						var payungSisaSemalamTumpuk = parseFloat($("#txtPayungSisaSemalamTumpuk").val());
						var payungPengambilanGudangTumpuk = parseFloat($("#txtPayungPengambilanTumpuk").val());
						var payungSisaHariIniTumpuk = parseFloat($("#txtSisaPayungTumpuk").val());

						var jumlahPayung =(((payungPengambilanBagian + payungPengambilanBagianTumpuk) + (payungSisaSemalam + payungSisaSemalamTumpuk) +
																(payungPengambilanGudang + payungPengambilanGudangTumpuk)) - (payungSisaHariIni + payungSisaHariIniTumpuk))

						var bobinPengambilanBagian = parseFloat($("#txtBobin").val());
						var bobinSisaSemalam = parseFloat($("#txtBobinSisaSemalam").val());
						var bobinPengambilanGudang = parseFloat($("#txtBobinPengambilan").val());
						var bobinSisaHariIni = parseFloat($("#txtSisaBobin").val());

						var bobinPengambilanBagianTumpuk = parseFloat($("#txtBobinTumpuk").val());
						var bobinSisaSemalamTumpuk = parseFloat($("#txtBobinSisaSemalamTumpuk").val());
						var bobinPengambilanGudangTumpuk = parseFloat($("#txtBobinPengambilanTumpuk").val());
						var bobinSisaHariIniTumpuk = parseFloat($("#txtSisaBobinTumpuk").val());

						var jumlahBobin = (((bobinPengambilanBagian + bobinPengambilanBagianTumpuk) + (bobinSisaSemalam + bobinSisaSemalamTumpuk) +
																(bobinPengambilanGudang + bobinPengambilanGudangTumpuk)) - (bobinSisaHariIni + bobinSisaHariIniTumpuk));

						$("#txtJumlahBobinPayung_Rumus").val(30);
						$("#txtJumlahBobinPayung_Payung").attr("readonly","readonly");
						$("#txtJumlahBobinPayung_Bobin").attr("readonly","readonly");
						$("#txtJumlahBobinPayung_Payung").val(jumlahPayung);
						$("#txtJumlahBobinPayung_Bobin").val(jumlahBobin);
					}else if(this.value == "BOBIN_PAYUNG_KUNING"){
						$("#payung").css("display","none");
						$("#bobin").css("display","none");
						$("#payungKuningPayung").css("display","none");
						$("#bobin_payung_kuning_payung").css("display","none");
						$("#bobinPayung").css("display","block");
						$("#txtJumlahBobinPayung_Payung").attr("placeholder","Masukan Jumlah Payung Kuning");
						var ketBarang = $("#ketBarang").val().toUpperCase();
						var ketMerek = $("#ketMerek").val().toUpperCase();
						var merek = $("#txtMerek").val().toUpperCase();
						if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
								 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }
													}
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;
							}
						}else{
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }
												 break;
							  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }
												 break;
								default: if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
												 }
												 break;
							}
						}

						if(TPanjangPlastik <= 30){
							$("#txtRumusRollBobinPayung_Payung").val(4000);
						}else{
							$("#txtRumusRollBobinPayung_Payung").val(5000);
						}
						var payungKuningPengambilanBagian = parseFloat($("#txtPayungKuning").val());
						var payungKuningSisaSemalam = parseFloat($("#txtPayungKuningSisaSemalam").val());
						var payungKuningPengambilanGudang = parseFloat($("#txtPayungKuningPengambilan").val());
						var payungKuningSisaHariIni = parseFloat($("#txtSisaPayungKuning").val());

						var payungKuningPengambilanBagianTumpuk = parseFloat($("#txtPayungKuningTumpuk").val());
						var payungKuningSisaSemalamTumpuk = parseFloat($("#txtPayungKuningSisaSemalamTumpuk").val());
						var payungKuningPengambilanGudangTumpuk = parseFloat($("#txtPayungKuningPengambilanTumpuk").val());
						var payungKuningSisaHariIniTumpuk = parseFloat($("#txtSisaPayungKuningTumpuk").val());

						var jumlahPayungKuning =(((payungKuningPengambilanBagian + payungKuningPengambilanBagianTumpuk) + (payungKuningSisaSemalam + payungKuningSisaSemalamTumpuk) +
																			(payungKuningPengambilanGudang + payungKuningPengambilanGudangTumpuk)) - (payungKuningSisaHariIni + payungKuningSisaHariIniTumpuk));

						var bobinPengambilanBagian = parseFloat($("#txtBobin").val());
						var bobinSisaSemalam = parseFloat($("#txtBobinSisaSemalam").val());
						var bobinPengambilanGudang = parseFloat($("#txtBobinPengambilan").val());
						var bobinSisaHariIni = parseFloat($("#txtSisaBobin").val());

						var bobinPengambilanBagianTumpuk = parseFloat($("#txtBobinTumpuk").val());
						var bobinSisaSemalamTumpuk = parseFloat($("#txtBobinSisaSemalamTumpuk").val());
						var bobinPengambilanGudangTumpuk = parseFloat($("#txtBobinPengambilanTumpuk").val());
						var bobinSisaHariIniTumpuk = parseFloat($("#txtSisaBobinTumpuk").val());

						var jumlahBobin = (((bobinPengambilanBagian + bobinPengambilanBagianTumpuk) + (bobinSisaSemalam + bobinSisaSemalamTumpuk) +
																(bobinPengambilanGudang + bobinPengambilanGudangTumpuk)) - (bobinSisaHariIni + bobinSisaHariIniTumpuk));

						$("#txtJumlahBobinPayung_Rumus").val(30);
						$("#txtJumlahBobinPayung_Payung").attr("readonly","readonly");
						$("#txtJumlahBobinPayung_Bobin").attr("readonly","readonly");
						$("#txtJumlahBobinPayung_Payung").val(jumlahPayungKuning);
						$("#txtJumlahBobinPayung_Bobin").val(jumlahBobin);
					}else if(this.value == "BOBIN_PAYUNG_KUNING_PAYUNG"){
						$("#payung").css("display","none");
						$("#bobin").css("display","none");
						$("#payungKuningPayung").css("display","none");
						$("#bobinPayung").css("display","none");
						$("#bobin_payung_kuning_payung").css("display","block");
						$("#txtBPKP_UkuranPlastik").val(param1);
						$("#txtBPKP_Rumus").val(30);

						var ketBarang = $("#ketBarang").val().toUpperCase();
						var ketMerek = $("#ketMerek").val().toUpperCase();
						var merek = $("#txtMerek").val().toUpperCase();
						if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
								 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
 													 }
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
 													 }
													}
												 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
													 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
														 }
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
														 }
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;
							}
						}else{
							var arrPanjangPlastik = param1.replace(/ |pon/gi, "").replace(/,/g,".").split("+");
							switch (arrPanjangPlastik.length) {
								case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
												 }
												 break;
							  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
												 }
												 break;
								default: if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
												 }
												 break;
							}
						}

						if(TPanjangPlastik <= 30){
							$("#txtBPKP_RumusPayungKuning").val(4000);
						}else{
							$("#txtBPKP_RumusPayungKuning").val(5000);
						}

						if(TPanjangPlastik < 6){
							$("#txtBPKP_RumusPayung").val(5000);
						}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
							$("#txtBPKP_RumusPayung").val(6000);
						}else{
							$("#txtBPKP_RumusPayung").val(7000);
						}

						var payungPengambilanBagian = parseFloat($("#txtPayung").val());
						var payungSisaSemalam = parseFloat($("#txtPayungSisaSemalam").val());
						var payungPengambilanGudang = parseFloat($("#txtPayungPengambilan").val());
						var payungSisaHariIni = parseFloat($("#txtSisaPayung").val());

						var payungPengambilanBagianTumpuk = parseFloat($("#txtPayungTumpuk").val());
						var payungSisaSemalamTumpuk = parseFloat($("#txtPayungSisaSemalamTumpuk").val());
						var payungPengambilanGudangTumpuk = parseFloat($("#txtPayungPengambilanTumpuk").val());
						var payungSisaHariIniTumpuk = parseFloat($("#txtSisaPayungTumpuk").val());

						var jumlahPayung =(((payungPengambilanBagian + payungPengambilanBagianTumpuk) + (payungSisaSemalam + payungSisaSemalamTumpuk) +
																(payungPengambilanGudang + payungPengambilanGudangTumpuk)) - (payungSisaHariIni + payungSisaHariIniTumpuk))

						var payungKuningPengambilanBagian = parseFloat($("#txtPayungKuning").val());
						var payungKuningSisaSemalam = parseFloat($("#txtPayungKuningSisaSemalam").val());
						var payungKuningPengambilanGudang = parseFloat($("#txtPayungKuningPengambilan").val());
						var payungKuningSisaHariIni = parseFloat($("#txtSisaPayungKuning").val());

						var payungKuningPengambilanBagianTumpuk = parseFloat($("#txtPayungKuningTumpuk").val());
						var payungKuningSisaSemalamTumpuk = parseFloat($("#txtPayungKuningSisaSemalamTumpuk").val());
						var payungKuningPengambilanGudangTumpuk = parseFloat($("#txtPayungKuningPengambilanTumpuk").val());
						var payungKuningSisaHariIniTumpuk = parseFloat($("#txtSisaPayungKuningTumpuk").val());

						var jumlahPayungKuning =(((payungKuningPengambilanBagian + payungKuningPengambilanBagianTumpuk) + (payungKuningSisaSemalam + payungKuningSisaSemalamTumpuk) +
																			(payungKuningPengambilanGudang + payungKuningPengambilanGudangTumpuk)) - (payungKuningSisaHariIni + payungKuningSisaHariIniTumpuk));

						var bobinPengambilanBagian = parseFloat($("#txtBobin").val());
						var bobinSisaSemalam = parseFloat($("#txtBobinSisaSemalam").val());
						var bobinPengambilanGudang = parseFloat($("#txtBobinPengambilan").val());
						var bobinSisaHariIni = parseFloat($("#txtSisaBobin").val());

						var bobinPengambilanBagianTumpuk = parseFloat($("#txtBobinTumpuk").val());
						var bobinSisaSemalamTumpuk = parseFloat($("#txtBobinSisaSemalamTumpuk").val());
						var bobinPengambilanGudangTumpuk = parseFloat($("#txtBobinPengambilanTumpuk").val());
						var bobinSisaHariIniTumpuk = parseFloat($("#txtSisaBobinTumpuk").val());

						var jumlahBobin = (((bobinPengambilanBagian + bobinPengambilanBagianTumpuk) + (bobinSisaSemalam + bobinSisaSemalamTumpuk) +
																(bobinPengambilanGudang + bobinPengambilanGudangTumpuk)) - (bobinSisaHariIni + bobinSisaHariIniTumpuk));

						$("#txtBPKP_BanyaknyaPipa").attr("readonly","readonly");
						$("#txtBPKP_JumlahPayung").attr("readonly","readonly");
						$("#txtBPKP_JumlahPayungKuning").attr("readonly","readonly");
						$("#txtBPKP_BanyaknyaPipa").val(jumlahBobin);
						$("#txtBPKP_JumlahPayung").val(jumlahPayung);
						$("#txtBPKP_JumlahPayungKuning").val(jumlahPayungKuning);
					}else{
						$("#payung").css("display","none");
						$("#bobin").css("display","none");
						$("#payungKuningPayung").css("display","none");
						$("#bobinPayung").css("display","none");
						$("#bobin_payung_kuning_payung").css("display","none");
					}
				});
				// $("#cmbRollPipa").on("change",function(){
				// 	if(this.value == "PAYUNG"){
				// 		$("#tdPayung").text("Jumlah Payung");
				// 		$("#txtJumlahPayung").attr("placeholder","Masukan Jumlah Payung");
				// 		$("#payung").css("display","block");
				// 		$("#payungKuningPayung").css("display","none");
				// 		$("#bobin").css("display","none");
				// 		$("#bobinPayung").css("display","none");
				// 		$("#bobin_payung_kuning_payung").css("display","none");
				// 		var ketBarang = $("#ketBarang").val().toUpperCase();
				// 		var ketMerek = $("#ketMerek").val().toUpperCase();
				// 		if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
				// 			var arrPanjangPlastik = param1.replace(/ |_/g, "").replace(/,/g,".").split("+");
				// 			switch (arrPanjangPlastik.length) {
				// 				case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
				// 									 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
				// 									 }
				// 								 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
				// 									 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 										var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
				// 									}else{
				// 										var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
				// 									}
				// 								 }else{
				// 									 var TPanjangPlastik = 0;
				// 								 }
				// 								 break;
				//
				// 			 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
				// 				 					if(arrPanjangPlastik[1] > 1){
				// 										if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 											var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
				// 										}else{
				// 											var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
				// 										}
				// 									}else{
				// 										if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 											var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5;
				// 										}else{
				// 											var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
				// 										}
				// 									}
				// 								 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
				// 									 if(arrPanjangPlastik[1] > 1){
				// 										 if(arrPanjangPlastik[0].indexOf("in") != -1){
 				// 											var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
 				// 										}else{
 				// 											var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
 				// 										}
				// 									 }else{
				// 										 if(arrPanjangPlastik[0].indexOf("in") != -1){
 				// 											var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5.5;
 				// 										}else{
 				// 											var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
 				// 										}
				// 									 }
				// 								 }else{
				// 									 var TPanjangPlastik = 0;
				// 								 }
				// 								 break;
				// 				default: var TPanjangPlastik = 0; break;
				// 			}
				// 		}else{
				// 			var arrPanjangPlastik = param1.replace(/ |_/g, "").replace(/,/g,".").split("+");
				// 			switch (arrPanjangPlastik.length) {
				// 				case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]);
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]);
				// 								 }
				// 								 break;
				// 			  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
				// 								 }
				// 								 break;
				// 				default:if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
				// 								 }
				// 								 break;
				// 			}
				// 		}
				//
				// 		if(TPanjangPlastik < 6){
				// 			$("#txtRumusRollPayung").val(5000);
				// 		}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
				// 			$("#txtRumusRollPayung").val(6000);
				// 		}else{
				// 			$("#txtRumusRollPayung").val(7000);
				// 		}
				// 	}else if(this.value == "PAYUNG_KUNING"){
				// 		$("#tdPayung").text("Jumlah Payung Kuning");
				// 		$("#txtJumlahPayung").attr("placeholder","Masukan Jumlah Payung Kuning");
				// 		$("#payung").css("display","block");
				// 		$("#payungKuningPayung").css("display","none");
				// 		$("#bobin").css("display","none");
				// 		$("#bobinPayung").css("display","none");
				// 		$("#bobin_payung_kuning_payung").css("display","none");
				// 		var ketBarang = $("#ketBarang").val().toUpperCase();
				// 		var ketMerek = $("#ketMerek").val().toUpperCase();
				// 		if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
				// 			var arrPanjangPlastik = param1.replace(/ |_/g, "").replace(/,/g,".").split("+");
				// 			switch (arrPanjangPlastik.length) {
				// 				case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
				// 									 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
				// 									 }
				// 								 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
				// 									 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
				// 									 }
				// 								 }else{
				// 									 var TPanjangPlastik = 0;
				// 								 }
				// 								 break;
				//
				// 			 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
				// 				 					if(arrPanjangPlastik[1] > 1){
				// 										if(arrPanjangPlastik[0].indexOf("in") != -1){
 				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
 				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
 				// 									 }
				// 									}else{
				// 										if(arrPanjangPlastik[0].indexOf("in") != -1){
 				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5;
 				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
 				// 									 }
				// 									}
				// 								 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
				// 									 if(arrPanjangPlastik[1] > 1){
				// 										 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 											 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
				// 										 }else{
				// 											 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
				// 										 }
				// 									 }else{
				// 										 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 											 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5.5;
				// 										 }else{
				// 											 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
				// 										 }
				// 									 }
				// 								 }else{
				// 									 var TPanjangPlastik = 0;
				// 								 }
				// 								 break;
				// 				default: var TPanjangPlastik = 0; break;
				// 			}
				// 		}else{
				// 			var arrPanjangPlastik = param1.replace(/ |_/g, "").replace(/,/g,".").split("+");
				// 			switch (arrPanjangPlastik.length) {
				// 				case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]);
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]);
				// 								 }
				// 								 break;
				// 			  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
				// 								 }
				// 								 break;
				// 				default: if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
				// 								 }
				// 								 break;
				// 			}
				// 		}
				//
				// 		if(TPanjangPlastik <= 30){
				// 			$("#txtRumusRollPayung").val(4000);
				// 		}else{
				// 			$("#txtRumusRollPayung").val(5000);
				// 		}
				// 	}else if(this.value == "PAYUNG_KUNING_PAYUNG"){
				// 		$("#payung").css("display","none");
				// 		$("#bobin").css("display","none");
				// 		$("#payungKuningPayung").css("display","block");
				// 		$("#bobinPayung").css("display","none");
				// 		$("#bobin_payung_kuning_payung").css("display","none");
				// 	}else if(this.value == "BOBIN"){
				// 		$("#payung").css("display","none");
				// 		$("#bobin").css("display","block");
				// 		$("#payungKuningPayung").css("display","none");
				// 		$("#bobinPayung").css("display","none");
				// 		$("#bobin_payung_kuning_payung").css("display","none");
				// 		$("#txtUkuranPlastik").val(param1);
				// 		$("#txtRumus").val(30);
				// 	}else if(this.value == "BOBIN_PAYUNG"){
				// 		$("#payung").css("display","none");
				// 		$("#bobin").css("display","none");
				// 		$("#payungKuningPayung").css("display","none");
				// 		$("#bobinPayung").css("display","block");
				// 		$("#bobin_payung_kuning_payung").css("display","none");
				// 		$("#txtJumlahBobinPayung_Payung").attr("placeholder","Masukan Jumlah Payung");
				// 		var ketBarang = $("#ketBarang").val().toUpperCase();
				// 		var ketMerek = $("#ketMerek").val().toUpperCase();
				// 		if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
				// 			var arrPanjangPlastik = param1.replace(/ |_/g, "").replace(/,/g,".").split("+");
				// 			switch (arrPanjangPlastik.length) {
				// 				case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
				// 									 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
				// 									 }
				// 								 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
				// 									 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
				// 									 }
				// 								 }else{
				// 									 var TPanjangPlastik = 0;
				// 								 }
				// 								 break;
				//
				// 			 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
				// 				 					if(arrPanjangPlastik[1] > 1){
				// 										if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
 				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
 				// 									 }
				// 									}else{
				// 										if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5;
 				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
 				// 									 }
				// 									}
				// 								 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
				// 									 if(arrPanjangPlastik[1] > 1){
				// 										 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 											 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
				// 										 }else{
				// 											 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
				// 										 }
				// 									 }else{
				// 										 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 											 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5.5;
				// 										 }else{
				// 											 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
				// 										 }
				// 									 }
				// 								 }else{
				// 									 var TPanjangPlastik = 0;
				// 								 }
				// 								 break;
				// 				default: var TPanjangPlastik = 0; break;
				// 			}
				// 		}else{
				// 			var arrPanjangPlastik = param1.replace(/ |_/g, "").replace(/,/g,".").split("+");
				// 			switch (arrPanjangPlastik.length) {
				// 				case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]);
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]);
				// 								 }
				// 								 break;
				// 			  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
				// 								 }
				// 								 break;
				// 				default: if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
				// 								 }
				// 								 break;
				// 			}
				// 		}
				//
				// 		if(TPanjangPlastik < 6){
				// 			$("#txtRumusRollBobinPayung_Payung").val(5000);
				// 		}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
				// 			$("#txtRumusRollBobinPayung_Payung").val(6000);
				// 		}else{
				// 			$("#txtRumusRollBobinPayung_Payung").val(7000);
				// 		}
				// 		$("#txtJumlahBobinPayung_Rumus").val(30);
				// 	}else if(this.value == "BOBIN_PAYUNG_KUNING"){
				// 		$("#payung").css("display","none");
				// 		$("#bobin").css("display","none");
				// 		$("#payungKuningPayung").css("display","none");
				// 		$("#bobinPayung").css("display","block");
				// 		$("#bobin_payung_kuning_payung").css("display","none");
				// 		$("#txtJumlahBobinPayung_Payung").attr("placeholder","Masukan Jumlah Payung Kuning");
				// 		var ketBarang = $("#ketBarang").val().toUpperCase();
				// 		var ketMerek = $("#ketMerek").val().toUpperCase();
				// 		if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
				// 			var arrPanjangPlastik = param1.replace(/ |_/g, "").replace(/,/g,".").split("+");
				// 			switch (arrPanjangPlastik.length) {
				// 				case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
				// 									 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
				// 									 }
				// 								 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
				// 									 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
				// 									 }
				// 								 }else{
				// 									 var TPanjangPlastik = 0;
				// 								 }
				// 								 break;
				//
				// 			 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
				// 				 					if(arrPanjangPlastik[1] > 1){
				// 										if(arrPanjangPlastik[0].indexOf("in") != -1){
 				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
 				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
 				// 									 }
				// 									}else{
				// 										if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 											var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5;
 				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
 				// 									 }
				// 									}
				// 								 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
				// 									 if(arrPanjangPlastik[1] > 1){
				// 										 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 											 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
				// 										 }else{
				// 											 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
				// 										 }
				// 									 }else{
				// 										 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 											 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5.5;
				// 										 }else{
				// 											 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
				// 										 }
				// 									 }
				// 								 }else{
				// 									 var TPanjangPlastik = 0;
				// 								 }
				// 								 break;
				// 				default: var TPanjangPlastik = 0; break;
				// 			}
				// 		}else{
				// 			var arrPanjangPlastik = param1.replace(/ |_/g, "").replace(/,/g,".").split("+");
				// 			switch (arrPanjangPlastik.length) {
				// 				case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]);
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]);
				// 								 }
				// 								 break;
				// 			  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
				// 								 }
				// 								 break;
				// 				default: if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
				// 								 }
				// 								 break;
				// 			}
				// 		}
				//
				// 		if(TPanjangPlastik <= 30){
				// 			$("#txtRumusRollBobinPayung_Payung").val(4000);
				// 		}else{
				// 			$("#txtRumusRollBobinPayung_Payung").val(5000);
				// 		}
				// 		$("#txtJumlahBobinPayung_Rumus").val(30);
				// 	}else if(this.value == "BOBIN_PAYUNG_KUNING_PAYUNG"){
				// 		$("#payung").css("display","none");
				// 		$("#bobin").css("display","none");
				// 		$("#payungKuningPayung").css("display","none");
				// 		$("#bobinPayung").css("display","none");
				// 		$("#bobin_payung_kuning_payung").css("display","block");
				// 		$("#txtBPKP_UkuranPlastik").val(param1);
				// 		$("#txtBPKP_Rumus").val(30);
				//
				// 		var ketBarang = $("#ketBarang").val().toUpperCase();
				// 		var ketMerek = $("#ketMerek").val().toUpperCase();
				// 		if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
				// 			var arrPanjangPlastik = param1.replace(/ |_/g, "").replace(/,/g,".").split("+");
				// 			switch (arrPanjangPlastik.length) {
				// 				case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
				// 									 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
				// 									 }
				// 								 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
				// 									 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
				// 									 }
				// 								 }else{
				// 									 var TPanjangPlastik = 0;
				// 								 }
				// 								 break;
				//
				// 			 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
				// 				 					if(arrPanjangPlastik[1] > 1){
				// 										if(arrPanjangPlastik[0].indexOf("in") != -1){
 				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
 				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
 				// 									 }
				// 									}else{
				// 										if(arrPanjangPlastik[0].indexOf("in") != -1){
 				// 										 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5;
 				// 									 }else{
				// 										 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
 				// 									 }
				// 									}
				// 								 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
				// 									 if(arrPanjangPlastik[1] > 1){
				// 										 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 											 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
				// 										 }else{
				// 											 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
				// 										 }
				// 									 }else{
				// 										 if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 											 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5.5;
				// 										 }else{
				// 											 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
				// 										 }
				// 									 }
				// 								 }else{
				// 									 var TPanjangPlastik = 0;
				// 								 }
				// 								 break;
				// 				default: var TPanjangPlastik = 0; break;
				// 			}
				// 		}else{
				// 			var arrPanjangPlastik = param1.replace(/ |_/g, "").replace(/,/g,".").split("+");
				// 			switch (arrPanjangPlastik.length) {
				// 				case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]);
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]);
				// 								 }
				// 								 break;
				// 			  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
				// 								 }
				// 								 break;
				// 				default: if(arrPanjangPlastik[0].indexOf("in") != -1){
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
				// 								 }else{
				// 									 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
				// 								 }
				// 								 break;
				// 			}
				// 		}
				//
				// 		if(TPanjangPlastik <= 30){
				// 			$("#txtBPKP_RumusPayungKuning").val(4000);
				// 		}else{
				// 			$("#txtBPKP_RumusPayungKuning").val(5000);
				// 		}
				//
				// 		if(TPanjangPlastik < 6){
				// 			$("#txtBPKP_RumusPayung").val(5000);
				// 		}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
				// 			$("#txtBPKP_RumusPayung").val(6000);
				// 		}else{
				// 			$("#txtBPKP_RumusPayung").val(7000);
				// 		}
				//
				// 	}else{
				// 		$("#payung").css("display","none");
				// 		$("#bobin").css("display","none");
				// 		$("#payungKuningPayung").css("display","none");
				// 		$("#bobinPayung").css("display","none");
				// 		$("#bobin_payung_kuning_payung").css("display","none");
				// 	}
				// });

				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_cutting/main/getDataForUpdateHasil'); ?>",
					dataType : "JSON",
					data : {
						idTransaksi : param
					},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#txtTglRencana").val(AvValue.tgl_rencana);
							$("#txtTglInput").val(AvValue.tgl_jadi);
							$("#cmbMerek").val(AvValue.kd_gd_hasil);
							$("#txtJnsPermintaan").val(AvValue.jns_permintaan);
							$("#txtJumlahApal").val(parseFloat(AvValue.jumlah_apal_global).toLocaleString());
							$("#txtHasilBeratBersih").val(parseFloat(AvValue.hasil_berat_bersih).toLocaleString());
							$("#txtHasilBeratKotor").val(parseFloat(AvValue.hasil_berat_kotor).toLocaleString());
							$("#txtJumlahBeratKotor").val(parseFloat(AvValue.hasil_berat_kotor).toLocaleString());
							$("#txtJumlahLembar").val(parseFloat(AvValue.hasil_lembar).toLocaleString());
							$("#txtNamaCustomer").val(AvValue.customer);
							$("#txtJumlahSubLembar").val(parseFloat(AvValue.jumlah_lembar).toLocaleString());
							$("#txtJumlahSubBerat").val(parseFloat(AvValue.jumlah_berat).toLocaleString());
							$("#txtTebal").val(AvValue.tebal);
							$("input[name='txtUkuran']").val(AvValue.ukuran);
							$("#txtJenisGudang").val(AvValue.jns_brg);
							$("#txtWarnaStrip").val(AvValue.strip);
							$("#txtNoMesin").val(AvValue.no_mesin);
							$("#cmbRollPipa").val(AvValue.jenis_roll_pipa).trigger("change");
							switch (AvValue.jenis_roll_pipa) {
								case "PAYUNG" 										: $("#txtJumlahPayung").val(parseFloat(AvValue.jumlah_payung).toLocaleString());
																										break;
								case "PAYUNG_KUNING" 							: $("#txtJumlahPayung").val(parseFloat(AvValue.jumlah_payung_kuning).toLocaleString());
																			 							break;
								case "PAYUNG_KUNING_PAYUNG" 			: $("#txtJumlahPayung_PKP").val(parseFloat(AvValue.jumlah_payung).toLocaleString());
																										$("#txtJumlahPayungKuning_PKP").val(parseFloat(AvValue.jumlah_payung_kuning).toLocaleString());
																										break;
								case "BOBIN" 											: $("#txtBanyaknyaPipa").val(parseFloat(AvValue.jumlah_bobin).toLocaleString());
																										break;
								case "BOBIN_PAYUNG" 							: $("#txtJumlahBobinPayung_Payung").val(parseFloat(AvValue.jumlah_payung).toLocaleString());
																										$("#txtJumlahBobinPayung_Bobin").val(parseFloat(AvValue.jumlah_bobin).toLocaleString());
																										break;
								case "BOBIN_PAYUNG_KUNING" 				: $("#txtJumlahBobinPayung_Payung").val(parseFloat(AvValue.jumlah_payung_kuning).toLocaleString());
																						 				$("#txtJumlahBobinPayung_Bobin").val(parseFloat(AvValue.jumlah_bobin).toLocaleString());
																										break;
								case "BOBIN_PAYUNG_KUNING_PAYUNG" : $("#txtBPKP_BanyaknyaPipa").val(parseFloat(AvValue.jumlah_bobin).toLocaleString());
																										$("#txtBPKP_JumlahPayung").val(parseFloat(AvValue.jumlah_payung).toLocaleString());
																										$("#txtBPKP_JumlahPayungKuning").val(parseFloat(AvValue.jumlah_payung_kuning).toLocaleString());
																										break;
								default														: $("#txtJumlahPayung").val(0);
												 														$("#txtJumlahPayung_PKP").val(0);
												 														$("#txtJumlahPayungKuning_PKP").val(0);
												 														$("#txtBanyaknyaPipa").val(0);
												 														$("#txtJumlahBobinPayung_Payung").val(0);
												 														$("#txtJumlahBobinPayung_Bobin").val(0);
												 														$("#txtBPKP_BanyaknyaPipa").val(0);
												 														$("#txtBPKP_JumlahPayung").val(0);
												 														$("#txtBPKP_JumlahPayungKuning").val(0);
																										break;

							}
							$("#txtJumlahRollPipa").val(parseFloat(AvValue.jumlah_roll_pipa).toLocaleString());
							$("#txtPlusMinus").val(parseFloat(AvValue.plusminus).toLocaleString());

							$("#ketMerek").val(AvValue.ket_merek);
							$("#ketBarang").val(AvValue.ket_barang);
							$("#txtMerek").val(param3);
							$("#txtBeratPengambilan").val(parseFloat(AvValue.berat_pengambilan_gudang).toLocaleString());
							$("#txtBahan").val(parseFloat(AvValue.berat_pengambilan_bagian).toLocaleString());
							$("#txtBeratSisaSemalam").val(parseFloat(AvValue.berat_sisa_semalam).toLocaleString());
							$("#txtSisa").val(parseFloat(AvValue.berat_sisa_hari_ini).toLocaleString());
							$("#txtHasilBeratBersih").val(parseFloat(AvValue.hasil_berat_bersih).toLocaleString());
							$("#txtJumlahApalLama").val(parseFloat(AvValue.jumlah_apal_global).toLocaleString());
							$("#txtBeratPengambilanTumpuk").val(parseFloat(AvValue.berat_pengambilan_gudang_tumpuk).toLocaleString());
							$("#txtBahanTumpuk").val(parseFloat(AvValue.bobin_pengambilan_bagian_tumpuk).toLocaleString());
							$("#txtBeratSisaSemalamTumpuk").val(parseFloat(AvValue.berat_sisa_semalam_tumpuk).toLocaleString());
							$("#txtSisaTumpuk").val(parseFloat(AvValue.berat_sisa_hari_ini_tumpuk).toLocaleString());

							$("#txtSubLembarLama").val(parseFloat(AvValue.jumlah_lembar).toLocaleString());
							$("#txtSubBeratLama").val(parseFloat(AvValue.jumlah_berat).toLocaleString());

							$("#txtJumlahBeratLama").val(parseFloat(AvValue.hasil_berat_bersih).toLocaleString());
							$("#txtJumlahLembarLama").val(parseFloat(AvValue.hasil_lembar).toLocaleString());

							$("#txtBeratPengambilan").val(parseFloat(AvValue.berat_pengambilan_gudang).toLocaleString());
							$("#txtBobinPengambilan").val(parseFloat(AvValue.bobin_pengambilan_gudang).toLocaleString());
							$("#txtPayungPengambilan").val(parseFloat(AvValue.payung_pengambilan_gudang).toLocaleString());
							$("#txtPayungKuningPengambilan").val(parseFloat(AvValue.payung_kuning_pengambilan_gudang).toLocaleString());

							$("#txtBahan").val(parseFloat(AvValue.berat_pengambilan_bagian).toLocaleString());
							$("#txtBobin").val(parseFloat(AvValue.bobin_pengambilan_bagian).toLocaleString());
							$("#txtPayung").val(parseFloat(AvValue.payung_pengambilan_bagian).toLocaleString());
							$("#txtPayungKuning").val(parseFloat(AvValue.payung_kuning_pengambilan_bagian).toLocaleString());

							$("#txtBeratSisaSemalam").val(parseFloat(AvValue.berat_sisa_semalam).toLocaleString());
							$("#txtBobinSisaSemalam").val(parseFloat(AvValue.bobin_sisa_semalam).toLocaleString());
							$("#txtPayungSisaSemalam").val(parseFloat(AvValue.payung_sisa_semalam).toLocaleString());
							$("#txtPayungKuningSisaSemalam").val(parseFloat(AvValue.payung_kuning_sisa_semalam).toLocaleString());

							$("#txtSisa").val(parseFloat(AvValue.berat_sisa_hari_ini).toLocaleString());
							$("#txtSisaBobin").val(parseFloat(AvValue.bobin_sisa_hari_ini).toLocaleString());
							$("#txtSisaPayung").val(parseFloat(AvValue.payung_sisa_hari_ini).toLocaleString());
							$("#txtSisaPayungKuning").val(parseFloat(AvValue.payung_kuning_sisa_hari_ini).toLocaleString());

							$("#txtBeratPengambilanTumpuk").val(parseFloat(AvValue.berat_pengambilan_gudang_tumpuk).toLocaleString());
							$("#txtBobinPengambilanTumpuk").val(parseFloat(AvValue.bobin_pengambilan_gudang_tumpuk).toLocaleString());
							$("#txtPayungPengambilanTumpuk").val(parseFloat(AvValue.payung_pengambilan_gudang_tumpuk).toLocaleString());
							$("#txtPayungKuningPengambilanTumpuk").val(parseFloat(AvValue.payung_kuning_pengambilan_gudang_tumpuk).toLocaleString());

							$("#txtBeratSisaSemalamTumpuk").val(parseFloat(AvValue.berat_sisa_semalam_tumpuk).toLocaleString());
							$("#txtBobinSisaSemalamTumpuk").val(parseFloat(AvValue.bobin_sisa_semalam_tumpuk).toLocaleString());
							$("#txtPayungSisaSemalamTumpuk").val(parseFloat(AvValue.payung_sisa_semalam_tumpuk).toLocaleString());
							$("#txtPayungKuningSisaSemalamTumpuk").val(parseFloat(AvValue.payung_kuning_sisa_semalam_tumpuk).toLocaleString());

							$("#txtSisaTumpuk").val(parseFloat(AvValue.berat_sisa_hari_ini_tumpuk).toLocaleString());
							$("#txtSisaBobinTumpuk").val(parseFloat(AvValue.bobin_sisa_hari_ini_tumpuk).toLocaleString());
							$("#txtSisaPayungTumpuk").val(parseFloat(AvValue.payung_sisa_hari_ini_tumpuk).toLocaleString());
							$("#txtSisaPayungKuningTumpuk").val(parseFloat(AvValue.payung_kuning_sisa_hari_ini_tumpuk).toLocaleString());

							$("#txtBahanTumpuk").val(parseFloat(AvValue.berat_pengambilan_bagian_tumpuk).toLocaleString());
							$("#txtBobinTumpuk").val(parseFloat(AvValue.bobin_pengambilan_bagian_tumpuk).toLocaleString());
							$("#txtPayungTumpuk").val(parseFloat(AvValue.payung_pengambilan_bagian_tumpuk).toLocaleString());
							$("#txtPayungKuningTumpuk").val(parseFloat(AvValue.payung_kuning_pengambilan_bagian_tumpuk).toLocaleString());

							$("#cmbMerek").select2({
								placeholder : "Pilih Ukuran Plastik",
								dropdownParent: $("#modalEditHasilCutting"),
								width : "100%",
								cache:false,
								allowClear:true,
								ajax:{
									url : "<?php echo base_url(); ?>_cutting/main/getUkuranEditHasilCutting/"+AvValue.jns_permintaan+"/"+AvValue.tgl_rencana,
									dataType : "JSON",
									delay : 0,
									processResults : function(data){
										return{
											results : $.map(data, function(item){
												return{
													text:item.customer+" | "+item.ukuran+" | "+item.ket_barang+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana+" | "+item.jns_permintaan,
													id:item.kd_potong+"#"+item.kd_gd_roll
												}
											})
										};
									}
								}
							});
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

			function modalEditPengambilanPotong(param,param2){
				if(param2 == "EXTRUDER"){
					var jnsPermintaan = "POLOS";
				}else{
					var jnsPermintaan = "CETAK";
				}
				$("#modalEditPengambilan").modal({backdrop : "static"});
				$("input").val("").trigger("change");
				$("#cmbKetarangan_Edit").val("");
				$(".date").datepicker("setDate",null);
				// $("#txtTglPotong_Edit").on("change",function(){
				// 	var tglRencana1 = this.value;
				// 	$("#cmbKdCutting_Edit").select2(); //Trigger Select2 Agar Tidak Menampilkan Message Error Saat Destroy
				// 	$("#cmbKdCutting_Edit").val(null);
				// 	if(tglRencana1 == "" || tglRencana1==null){
				// 		$("#cmbKdCutting_Edit").select2('destroy');
				// 		$("#trUkuran_Edit").css("display","none");
				// 	}else{
				// 		$("#cmbKdCutting_Edit").select2({
				// 			placeholder : "Pilih Ukuran Plastik",
				// 			dropdownParent: $("#modalEditPengambilan"),
				// 			width : "100%",
				// 			cache:false,
				// 			allowClear:true,
				// 			ajax:{
				// 				url : "<?php echo base_url(); ?>_cutting/main/getUkuranPengambilanPotong/"+jnsPermintaan+"/"+tglRencana1,
				// 				dataType : "JSON",
				// 				delay : 0,
				// 				processResults : function(data){
				// 					return{
				// 						results : $.map(data, function(item){
				// 							if(item.ket_barang.toUpperCase().indexOf("TUMPUK") == -1){
				// 								return{
				// 									text:item.customer+" | "+item.panjang+" | "+item.ket_barang+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana+" | "+item.jns_permintaan,
				// 									id:item.kd_potong+"#"+item.kd_gd_roll
				// 								}
				// 							}else{
				// 								return{
				// 									text:item.customer+" | "+item.ukuran+" | "+item.ket_barang+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana+" | "+item.jns_permintaan,
				// 									id:item.kd_potong+"#"+item.kd_gd_roll
				// 								}
				// 							}
				// 						})
				// 					};
				// 				}
				// 			}
				// 		});
				// 		$("#trUkuran_Edit").css("display","table-row");
				// 	}
				// });

				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_cutting/main/getDetailPengambilanPotong'); ?>",
					dataType : "JSON",
					data : {
						idTransaksi : param
					},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#txtTglPengambilan_Edit").val(AvValue.tgl_sisa);
							$("#txtTglPotong_Edit").val(AvValue.tgl_potong).trigger("change");
							$("#cmbKdCutting_Edit").val(AvValue.kd_potong+"#"+AvValue.kd_gd_roll).trigger("change");
							$("#txtBeratPengambilan_Edit").val(AvValue.berat);
							$("#txtPayung_Edit").val(AvValue.payung);
							$("#txtPayungKuning_Edit").val(AvValue.payung_kuning);
							$("#txtJumlahBobin_Edit").val(AvValue.bobin);
							$("#cmbKetarangan_Edit").val(AvValue.keterangan_waktu);
							$("#txtStatusPengambilan_Edit").val(AvValue.status);
						});
					}
				});

				$("#btnEditPengambilan").attr("onclick","editPengambilanPotong('"+param+"','"+param2+"')");
			}

			function modalEditHistorySisa(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_cutting/main/getDetailHistorySisa'); ?>",
					dataType : "JSON",
					data : {
						id : param
					},
					success : function(response){
							$.each(response, function(AvIndex, AvValue){
								$("#txtPanjangPlastikPOLOS_Edit").val(AvValue.ukuran);
								$("#txtMerekPOLOS_Edit").val(AvValue.merek);
								$("#txtWarnaPlastikPOLOS_Edit").val(AvValue.warna_plastik);
								$("#txtPermintaanPOLOS_Edit").val(AvValue.jns_permintaan);
								$("#txtJumlahSisaPOLOS_Edit").val(AvValue.berat);
								$("#txtJumlahPayungPOLOS_Edit").val(AvValue.payung);
								$("#txtJumlahPayungKuningPOLOS_Edit").val(AvValue.payung_kuning);
								$("#txtJumlahBobinPOLOS_Edit").val(AvValue.bobin);
								$("#cmbShiftPOLOS_Edit").val(AvValue.shift);
							});
					}
				});
				$("#btnTambahSisaPengambilanPOLOS_Edit").attr("onclick","editHistorySisa('"+param+"')");
				$("#modalEditSisaPengambilan_POLOS").modal({
					backdrop : "static"
				});
			}

			function modalEditHasilCuttingTemp(param){
				$("#btnSaveHasilExtruder").attr("onclick","editHasilCuttingTemp('"+param+"')");
				$("#modalInputHasil").modal({backdrop:"static"});
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_cutting/main/getDataForUpdateHasilTemp'); ?>",
					dataType : "JSON",
					data : {
						idTransaksi : param
					},
					success : function(response){
						$("#idTransaksi").val(response.IdTransaksi);
						$("#tableDetailRencana").empty();
						var arrParam1 = response.DetailRencana[0].ukuran.split("x");
						param1 = arrParam1[0];
						param2 = response.DetailRencana[0].warna_plastik;
						param3 = (response.DetailRencana[0].kd_gd_roll_tumpuk == null ? "0" : response.DetailRencana[0].kd_gd_roll_tumpuk.toUpperCase());
						param4 = response.DetailRencana[0].tgl_rencana;
						$("#cmbRollPipa").on("change",function(){
							if(this.value == "PAYUNG"){
								$("#tdPayung").text("Jumlah Payung");
								$("#txtJumlahPayung").attr("placeholder","Masukan Jumlah Payung");
								$("#payung").css("display","block");
								$("#payungKuningPayung").css("display","none");
								$("#bobin").css("display","none");
								$("#bobinPayung").css("display","none");
								$("#bobin_payung_kuning_payung").css("display","none");
								var ketBarang = $("#ketBarang").val().toUpperCase();
								var ketMerek = $("#ketMerek").val().toUpperCase();
								if(param3.indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
									var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
									switch (arrPanjangPlastik.length) {
										case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
															}else{
																var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
															}
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;

									 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
										 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
																if(arrPanjangPlastik[0].indexOf("in") != -1){
																	var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
																}else{
																	var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
																}
															}else{
																if(arrPanjangPlastik[0].indexOf("in") != -1){
																	var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
																}else{
																	var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
																}
															}
														 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
															 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
																 if(arrPanjangPlastik[0].indexOf("in") != -1){
		 															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
		 														}else{
		 															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
		 														}
															 }else{
																 if(arrPanjangPlastik[0].indexOf("in") != -1){
		 															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
		 														}else{
		 															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
		 														}
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;
										default: var TPanjangPlastik = 0; break;
									}
								}else{
									var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
									switch (arrPanjangPlastik.length) {
										case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
														 }
														 break;
									  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
														 }
														 break;
										default:if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
														 }
														 break;
									}
								}

								if(TPanjangPlastik < 6){
									$("#txtRumusRollPayung").val(5000);
								}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
									$("#txtRumusRollPayung").val(6000);
								}else{
									$("#txtRumusRollPayung").val(7000);
								}
							}else if(this.value == "PAYUNG_KUNING"){
								$("#tdPayung").text("Jumlah Payung Kuning");
								$("#txtJumlahPayung").attr("placeholder","Masukan Jumlah Payung Kuning");
								$("#payung").css("display","block");
								$("#payungKuningPayung").css("display","none");
								$("#bobin").css("display","none");
								$("#bobinPayung").css("display","none");
								$("#bobin_payung_kuning_payung").css("display","none");
								var ketBarang = $("#ketBarang").val().toUpperCase();
								var ketMerek = $("#ketMerek").val().toUpperCase();
								if(param3.indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
									var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
									switch (arrPanjangPlastik.length) {
										case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;

									 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
										 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
																if(arrPanjangPlastik[0].indexOf("in") != -1){
		 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
		 													 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
		 													 }
															}else{
																if(arrPanjangPlastik[0].indexOf("in") != -1){
		 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
		 													 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
		 													 }
															}
														 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
															 if(arrPanjangPlastik[1].replace(/in/gi,'') > 1){
																 if(arrPanjangPlastik[0].indexOf("in") != -1){
																	 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
																 }else{
																	 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
																 }
															 }else{
																 if(arrPanjangPlastik[0].indexOf("in") != -1){
																	 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
																 }else{
																	 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
																 }
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;
										default: var TPanjangPlastik = 0; break;
									}
								}else{
									var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
									switch (arrPanjangPlastik.length) {
										case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
														 }
														 break;
									  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
														 }
														 break;
										default: if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
														 }
														 break;
									}
								}

								if(TPanjangPlastik <= 30){
									$("#txtRumusRollPayung").val(4000);
								}else{
									$("#txtRumusRollPayung").val(5000);
								}
							}else if(this.value == "PAYUNG_KUNING_PAYUNG"){
								$("#payung").css("display","none");
								$("#bobin").css("display","none");
								$("#payungKuningPayung").css("display","block");
								$("#bobin_payung_kuning_payung").css("display","none");
								$("#bobinPayung").css("display","none");
							}else if(this.value == "BOBIN"){
								$("#payung").css("display","none");
								$("#bobin").css("display","block");
								$("#payungKuningPayung").css("display","none");
								$("#bobinPayung").css("display","none");
								$("#bobin_payung_kuning_payung").css("display","none");
								$("#txtUkuranPlastik").val(param1);
								$("#txtRumus").val(30);
							}else if(this.value == "BOBIN_PAYUNG"){
								$("#payung").css("display","none");
								$("#bobin").css("display","none");
								$("#payungKuningPayung").css("display","none");
								$("#bobinPayung").css("display","block");
								$("#bobin_payung_kuning_payung").css("display","none");
								$("#txtJumlahBobinPayung_Payung").attr("placeholder","Masukan Jumlah Payung");
								var ketBarang = $("#ketBarang").val().toUpperCase();
								var ketMerek = $("#ketMerek").val().toUpperCase();
								if(param3.indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
									var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
									switch (arrPanjangPlastik.length) {
										case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;

									 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
										 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
																if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
		 													 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
		 													 }
															}else{
																if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
		 													 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
		 													 }
															}
														 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
															 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
																 if(arrPanjangPlastik[0].indexOf("in") != -1){
																	 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
																 }else{
																	 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
																 }
															 }else{
																 if(arrPanjangPlastik[0].indexOf("in") != -1){
																	 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
																 }else{
																	 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
																 }
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;
										default: var TPanjangPlastik = 0; break;
									}
								}else{
									var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
									switch (arrPanjangPlastik.length) {
										case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
														 }
														 break;
									  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
														 }
														 break;
										default: if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
														 }
														 break;
									}
								}

								if(TPanjangPlastik < 6){
									$("#txtRumusRollBobinPayung_Payung").val(5000);
								}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
									$("#txtRumusRollBobinPayung_Payung").val(6000);
								}else{
									$("#txtRumusRollBobinPayung_Payung").val(7000);
								}
							}else if(this.value == "BOBIN_PAYUNG_KUNING"){
								$("#payung").css("display","none");
								$("#bobin").css("display","none");
								$("#payungKuningPayung").css("display","none");
								$("#bobin_payung_kuning_payung").css("display","none");
								$("#bobinPayung").css("display","block");
								$("#txtJumlahBobinPayung_Payung").attr("placeholder","Masukan Jumlah Payung Kuning");
								var ketBarang = $("#ketBarang").val().toUpperCase();
								var ketMerek = $("#ketMerek").val().toUpperCase();
								if(param3.indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
									var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
									switch (arrPanjangPlastik.length) {
										case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;

									 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
										 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
																if(arrPanjangPlastik[0].indexOf("in") != -1){
		 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
		 													 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
		 													 }
															}else{
																if(arrPanjangPlastik[0].indexOf("in") != -1){
																	var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
		 													 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
		 													 }
															}
														 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
															 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
																 if(arrPanjangPlastik[0].indexOf("in") != -1){
																	 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
																 }else{
																	 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
																 }
															 }else{
																 if(arrPanjangPlastik[0].indexOf("in") != -1){
																	 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
																 }else{
																	 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
																 }
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;
										default: var TPanjangPlastik = 0; break;
									}
								}else{
									var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
									switch (arrPanjangPlastik.length) {
										case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]);
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]);
														 }
														 break;
									  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
														 }
														 break;
										default: if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
														 }
														 break;
									}
								}

								if(TPanjangPlastik <= 30){
									$("#txtRumusRollBobinPayung_Payung").val(4000);
								}else{
									$("#txtRumusRollBobinPayung_Payung").val(5000);
								}
							}else if(this.value == "BOBIN_PAYUNG_KUNING_PAYUNG"){
								$("#payung").css("display","none");
								$("#bobin").css("display","none");
								$("#payungKuningPayung").css("display","none");
								$("#bobinPayung").css("display","none");
								$("#bobin_payung_kuning_payung").css("display","block");
								$("#txtBPKP_UkuranPlastik").val(param1);
								$("#txtBPKP_Rumus").val(30);

								var ketBarang = $("#ketBarang").val().toUpperCase();
								var ketMerek = $("#ketMerek").val().toUpperCase();
								if(param3.indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
									var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
									switch (arrPanjangPlastik.length) {
										case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;

									 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
										 					if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
																if(arrPanjangPlastik[0].indexOf("in") != -1){
		 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
		 													 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
		 													 }
															}else{
																if(arrPanjangPlastik[0].indexOf("in") != -1){
		 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
		 													 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
		 													 }
															}
														 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
															 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
																 if(arrPanjangPlastik[0].indexOf("in") != -1){
																	 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
																 }else{
																	 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
																 }
															 }else{
																 if(arrPanjangPlastik[0].indexOf("in") != -1){
																	 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
																 }else{
																	 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
																 }
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;
										default: var TPanjangPlastik = 0; break;
									}
								}else{
									var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
									switch (arrPanjangPlastik.length) {
										case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
														 }
														 break;
									  case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
														 }
														 break;
										default: if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
														 }
														 break;
									}
								}

								if(TPanjangPlastik <= 30){
									$("#txtBPKP_RumusPayungKuning").val(4000);
								}else{
									$("#txtBPKP_RumusPayungKuning").val(5000);
								}

								if(TPanjangPlastik < 6){
									$("#txtBPKP_RumusPayung").val(5000);
								}else if(TPanjangPlastik >= 6 && TPanjangPlastik <= 40){
									$("#txtBPKP_RumusPayung").val(6000);
								}else{
									$("#txtBPKP_RumusPayung").val(7000);
								}

							}else{
								$("#payung").css("display","none");
								$("#bobin").css("display","none");
								$("#payungKuningPayung").css("display","none");
								$("#bobinPayung").css("display","none");
								$("#bobin_payung_kuning_payung").css("display","none");
							}
						});
						$.each(response.DetailRencana, function(AvIndex, AvValue){
							$("#txtTglPengerjaan").val(AvValue.tgl_rencana);
							$("#txtMerek").val(AvValue.merek);
							$("#txtPermintaan").val(AvValue.jns_permintaan);
							$("#txtWarnaPlastik").val(AvValue.warna_plastik);
							$("#ketMerek").val((AvValue.ket_merek==null || AvValue.ket_merek=="") ? "0" : AvValue.ket_merek);
							$("#ketBarang").val((AvValue.ket_barang==null || AvValue.ket_barang=="") ? "0" : AvValue.ket_barang);
							$("#idTransaksi").val(AvValue.kd_hasil_potong);
							$("#txtHasilLembar").val(AvValue.hasil_lembar);
							$("#txtHasilBeratBersih").val(AvValue.hasil_berat_bersih);
							$("#txtHasilBeratKotor").val(AvValue.hasil_berat_kotor);
							$("#txtJumlahApal").val(AvValue.jumlah_apal_global);
							$("#txtBeratPengambilan").val(AvValue.berat_pengambilan_gudang);
							$("#txtBobinPengambilan").val(AvValue.bobin_pengambilan_gudang);
							$("#txtPayungPengambilan").val(AvValue.payung_pengambilan_gudang);
							$("#txtPayungKuningPengambilan").val(AvValue.payung_kuning_pengambilan_gudang);
							$("#txtBeratPengambilanTumpuk").val(AvValue.berat_pengambilan_gudang_tumpuk);
							$("#txtBobinPengambilanTumpuk").val(AvValue.bobin_pengambilan_gudang_tumpuk);
							$("#txtPayungPengambilanTumpuk").val(AvValue.payung_pengambilan_gudang_tumpuk);
							$("#txtPayungKuningPengambilanTumpuk").val(AvValue.payung_kuning_pengambilan_gudang_tumpuk);
							$("#cmbRollPipa").val(AvValue.jenis_roll_pipa).trigger("change");
							switch (AvValue.jenis_roll_pipa) {
								case "PAYUNG" 										: $("#txtJumlahPayung").val(AvValue.jumlah_payung);
																										break;
								case "PAYUNG_KUNING" 							: $("#txtJumlahPayung").val(AvValue.jumlah_payung_kuning);
																										break;
								case "PAYUNG_KUNING_PAYUNG" 			: $("#txtJumlahPayung_PKP").val(AvValue.jumlah_payung);
																										$("#txtJumlahPayungKuning_PKP").val(AvValue.jumlah_payung_kuning);
																										break;
								case "BOBIN" 											: $("#txtBanyaknyaPipa").val(AvValue.jumlah_bobin);
																										break;
								case "BOBIN_PAYUNG" 							: $("#txtJumlahBobinPayung_Payung").val(AvValue.jumlah_payung);
																										$("#txtJumlahBobinPayung_Bobin").val(AvValue.jumlah_bobin);
																										break;
								case "BOBIN_PAYUNG_KUNING" 				: $("#txtJumlahBobinPayung_Payung").val(AvValue.jumlah_payung);
																										$("#txtJumlahBobinPayung_Bobin").val(AvValue.jumlah_bobin);
																										break;
								case "BOBIN_PAYUNG_KUNING_PAYUNG" : $("#txtBPKP_BanyaknyaPipa").val(AvValue.jumlah_bobin);
																										$("#txtBPKP_JumlahPayung").val(AvValue.jumlah_payung);
																										$("#txtBPKP_JumlahPayungKuning").val(AvValue.jumlah_payung_kuning);
																										break;

								default: $("#txtJumlahPayung").empty();
												 $("#txtJumlahPayung_PKP").empty();
												 $("#txtJumlahPayungKuning_PKP").empty();
												 $("#txtBanyaknyaPipa").empty();
												 $("#txtJumlahBobinPayung_Payung").empty();
												 $("#txtJumlahBobinPayung_Bobin").empty();
												 $("#txtBPKP_BanyaknyaPipa").empty();
												 $("#txtBPKP_JumlahPayung").empty();
												 $("#txtBPKP_JumlahPayungKuning").empty();
												 $("#cmbRollPipa").val("").trigger("change");

							}
							$("#cmbShift").val(AvValue.shift);
							$("#txtKetarangan").val(AvValue.keterangan);

							$("#tableDetailRencana").append(
								'<tr>'+
									'<td width="10%">Customer</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control" name="txtCustomer" placeholder="Masukan Nama Customer" readonly value="'+AvValue.customer+'">'+
											'<input type="hidden" name="txtKdCutting" value="'+AvValue.kd_potong+'">'+
											'<input type="hidden" name="txtKdGdHasil" value="'+AvValue.kd_gd_hasil+'">'+
											'<input type="hidden" name="txtKdGdRoll" value="'+AvValue.kd_gd_roll+'">'+
										'</div>'+
									'</td>'+
									'<td width="5%">Lembar</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control number" name="txtLembar" value="'+AvValue.jumlah_lembar+'" placeholder="Masukan Jumlah Lembar">'+
										'</div>'+
									'</td>'+
									'<td width="5%">Berat</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control number" name="txtBerat" value="'+AvValue.jumlah_berat+'" placeholder="Masukan Jumlah Berat">'+
										'</div>'+
									'</td>'+
									'<td width="5%">Tebal</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control" name="txtTebal" placeholder="Masukan Tebal" readonly value="'+AvValue.tebal+'">'+
										'</div>'+
									'</td>'+
								'</tr>'+
								'<tr>'+
									'<td width="10%">Roll(Ukuran)</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control" name="txtUkuran" placeholder="Masukan Ukuran" readonly value="'+AvValue.ukuran+'">'+
										'</div>'+
									'</td>'+
									'<td width="5%">Gudang</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control" name="txtGudang" placeholder="Masukan Gudang" readonly value="'+AvValue.jns_brg+'">'+
										'</div>'+
									'</td>'+
									'<td width="5%">Strip</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control" name="txtStrip" placeholder="Masukan Strip" readonly value="'+AvValue.strip+'">'+
										'</div>'+
									'</td>'+
									'<td width="5%">No. Mesin</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control" name="txtNoMesin" placeholder="Masukan No. Mesin" readonly value="'+AvValue.no_mesin+'">'+
										'</div>'+
									'</td>'+
								'</tr>'
							);
						});
						numberMasking();

						$.each(response.PengambilanPotong, function(AvIndex, AvValue){
							if($("#txtPermintaan").val().toUpperCase() == "POLOS"){
								$("#tdBahan").text("Bahan Extruder");
								$("#tdBobin").text("Bobin Extruder");
								$("#tdPayung").text("Payung Extruder");
								$("#tdPayungKuning").text("Payung Kuning Extruder");
							}else{
								$("#tdBahan").text("Bahan Cetak");
								$("#tdBobin").text("Bobin Cetak");
								$("#tdPayung").text("Payung Cetak");
								$("#tdPayungKuning").text("Payung Kuning Cetak");
							}
							$("#txtBahan").val((AvValue.jumlahBerat == null) ? 0 : AvValue.jumlahBerat);
							$("#txtBobin").val((AvValue.jumlahBobin == null) ? 0 : AvValue.jumlahBobin);
							$("#txtPayung").val((AvValue.jumlahPayung == null) ? 0 : AvValue.jumlahPayung);
							$("#txtPayungKuning").val((AvValue.jumlahPayungKuning == null) ? 0 : AvValue.jumlahPayungKuning);
						});

						$.each(response.SisaPengambilanPotongSemalam, function(AvIndex, AvValue){
							$("#txtBeratSisaSemalam").val((AvValue.jumlahSisa == null) ? 0 : AvValue.jumlahSisa);
							$("#txtBobinSisaSemalam").val((AvValue.jumlahBobin == null) ? 0 : AvValue.jumlahBobin);
							$("#txtPayungSisaSemalam").val((AvValue.jumlahPayung == null) ? 0 : AvValue.jumlahPayung);
							$("#txtPayungKuningSisaSemalam").val((AvValue.jumlahPayungKuning == null) ? 0 : AvValue.jumlahPayungKuning);
						});

						$.each(response.SisaPengambilanPotongHariIni, function(AvIndex, AvValue){
							$("#txtSisa").val((AvValue.jumlahSisa == null) ? 0 : AvValue.jumlahSisa);
							$("#txtSisaBobin").val((AvValue.jumlahBobin == null) ? 0 : AvValue.jumlahBobin);
							$("#txtSisaPayung").val((AvValue.jumlahPayung == null) ? 0 : AvValue.jumlahPayung);
							$("#txtSisaPayungKuning").val((AvValue.jumlahPayungKuning == null) ? 0 : AvValue.jumlahPayungKuning);
						});

						if(response.DetailRencana[0].ket_barang.toUpperCase().indexOf("TUMPUK") != -1){
							if($("#txtPermintaan").val() == "CETAK/POLOS"){
								var arrJnsPermintaan = $("#txtPermintaan").val().split("/");
								var jnsPermintaan = arrJnsPermintaan[1];
							}else{
								var jnsPermintaan = $("#txtPermintaan").val();
							}
							var arrUkuran = response.DetailRencana[0].ukuran.replace(/ /g,"").split("/");
							var arrUkuranPlastikSecondary = arrUkuran[1].split("x");
							$("#cmbUkuranTumpuk").select2({
								placeholder : "Pilih Roll ("+jnsPermintaan+")",
								dropdownParent: $("#modalInputHasil"),
								width : "100%",
								cache:false,
								allowClear:true,
								ajax:{
									url : "<?php echo base_url(); ?>_cutting/main/getComboBoxValueGudangRoll/"+jnsPermintaan+"/"+arrUkuranPlastikSecondary[0],
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
							$("#cmbUkuranTumpuk").on("select2:select", function(){
								var kdGdRollTumpuk = $("#cmbUkuranTumpuk").val().replace(/_/g, "");
								$.ajax({
									type : "POST",
									url : "<?php echo base_url('_cutting/main/getDataInputHasil'); ?>",
									dataType : "JSON",
									data : {
										panjangPlastik 	: arrUkuranPlastikSecondary[0].replace(/_/g," "),
										warnaPlastik 		: param2.replace(/_/g," "),
										kdGdRoll 				: kdGdRollTumpuk,
										tglRencana 			: param4.replace(/_/g," ")
									},
									success : function(response){
										$.each(response.PengambilanPotong, function(AvIndex, AvValue){
											if($("#txtPermintaan").val().toUpperCase() == "POLOS"){
												$("#tdBahanTumpuk").text("Bahan Extruder (Tumpuk)");
												$("#tdBobinTumpuk").text("Bobin Extruder (Tumpuk)");
												$("#tdPayungTumpuk").text("Payung Extruder (Tumpuk)");
												$("#tdPayungKuningTumpuk").text("Payung Kuning Extruder (Tumpuk)");
											}else{
												$("#tdBahanTumpuk").text("Bahan Cetak (Tumpuk)");
												$("#tdBobinTumpuk").text("Bobin Cetak (Tumpuk)");
												$("#tdPayungTumpuk").text("Payung Cetak (Tumpuk)");
												$("#tdPayungKuningTumpuk").text("Payung Kuning Cetak (Tumpuk)");
											}
											$("#txtBahanTumpuk").val((AvValue.jumlahBerat == null) ? 0 : AvValue.jumlahBerat);
											$("#txtBobinTumpuk").val((AvValue.jumlahBobin == null) ? 0 : AvValue.jumlahBobin);
											$("#txtPayungTumpuk").val((AvValue.jumlahPayung == null) ? 0 : AvValue.jumlahPayung);
											$("#txtPayungKuningTumpuk").val((AvValue.jumlahPayungKuning == null) ? 0 : AvValue.jumlahPayungKuning);
										});

										$.each(response.SisaPengambilanPotongSemalam, function(AvIndex, AvValue){
											$("#txtBeratSisaSemalamTumpuk").val((AvValue.jumlahSisa == null) ? 0 : AvValue.jumlahSisa);
											$("#txtBobinSisaSemalamTumpuk").val((AvValue.jumlahBobin == null) ? 0 : AvValue.jumlahBobin);
											$("#txtPayungSisaSemalamTumpuk").val((AvValue.jumlahPayung == null) ? 0 : AvValue.jumlahPayung);
											$("#txtPayungKuningSisaSemalamTumpuk").val((AvValue.jumlahPayungKuning == null) ? 0 : AvValue.jumlahPayungKuning);
										});

										$.each(response.SisaPengambilanPotongHariIni, function(AvIndex, AvValue){
											$("#txtSisaTumpuk").val((AvValue.jumlahSisa == null) ? 0 : AvValue.jumlahSisa);
											$("#txtSisaBobinTumpuk").val((AvValue.jumlahBobin == null) ? 0 : AvValue.jumlahBobin);
											$("#txtSisaPayungTumpuk").val((AvValue.jumlahPayung == null) ? 0 : AvValue.jumlahPayung);
											$("#txtSisaPayungKuningTumpuk").val((AvValue.jumlahPayungKuning == null) ? 0 : AvValue.jumlahPayungKuning);
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
							$("#tumpuk").css("display","block");
						}else{
							$("#tumpuk").css("display","none");
						}
					}
				});
			}

			function modalEditSisaPengambilanTemp(param, param2){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_cutting/main/getDetailDataSisaPengambilan'); ?>",
					dataType : "JSON",
					data : {
						idTransaksi : param
					},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#cmbUkuran"+param2).val(AvValue.kd_poton+"#"+AvValue.kd_gd_roll).trigger("change");
							var arrUkuran = AvValue.ukuran.split("x");
							$("#txtPanjangPlastik"+param2).val(arrUkuran[0]);
							$("#txtMerek"+param2).val(AvValue.merek);
							$("#txtWarnaPlastik"+param2).val(AvValue.warna_plastik);
							$("#txtPermintaan"+param2).val(AvValue.jns_permintaan);
							$("#txtJumlahSisa"+param2).val(AvValue.sisa);
							$("#txtJumlahPayung"+param2).val(AvValue.payung);
							$("#txtJumlahPayungKuning"+param2).val(AvValue.payung_kuning);
							$("#txtJumlahBobin"+param2).val(AvValue.bobin);
							$("#cmbShift"+param2).val(AvValue.shift);
							$("#cmbKeterangan"+param2).val(AvValue.keterangan).trigger("change");
							$("#txtTglAwal"+param2).val(AvValue.tgl_sisa);
							$("#txtTglAkhir"+param2).val(AvValue.tgl_potong);
						});
						$("#btnTambahSisaPengambilan"+param2).attr("onclick","editSisaPengambilanTemp('"+param+"','"+param2+"')").html("<i class='fa fa-pencil'></i> Ubah");
					}
				});
			}

			function modalEditRencana(param){
				$("#cmbWarnaStrip_Edit").on("change",function(){
					if(this.value == "CUSTOM"){
						$("#comboStripWrapper_Edit").css("display","none");
						$("#textStripWrapper_Edit").css("display","block");
					}else{
						$("#comboStripWrapper_Edit").css("display","block");
						$("#textStripWrapper_Edit").css("display","none");
					}
				});
				$("#btnClose_Edit").on("click",function(){
					$("#cmbWarnaStrip_Edit").val("").trigger("change");
					$("#txtWarnaStrip_Edit").val("");
				});
				$("#cmbKdHasil_Edit").select2({
					placeholder : "Pilih Ukuran Plastik",
					dropdownParent: $("#modalEditRencana"),
					width : "100%",
					cache:false,
					allowClear:true,
					ajax:{
						url : "<?php echo base_url(); ?>_cutting/main/getComboBoxValueGudangHasil",
						dataType : "JSON",
						delay : 0,
						processResults : function(data){
							return{
								results : $.map(data, function(item){
									return{
										text:item.kd_gd_hasil+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_brg+" | "+item.jns_permintaan,
										id:item.kd_gd_hasil
									}
								})
							};
						}
					}
				});
				$("#cmbKdHasil_Edit").on("select2:select",function(){
					var dataText = $("#cmbKdHasil_Edit").select2("data")[0]["text"];
					var arrDataText = dataText.split(" | ");
					var arrUkuran = arrDataText[1].split("x");
					$("#cmbKdBahan_Edit").select2({
						placeholder : "Pilih Roll ("+arrDataText[5]+")",
						dropdownParent: $("#modalEditRencana"),
						width : "100%",
						cache:false,
						allowClear:true,
						ajax:{
							url : "<?php echo base_url(); ?>_cutting/main/getComboBoxValueGudangRoll/"+arrDataText[5].replace(/\//g,"-")+"/"+arrUkuran[0]+"/"+arrDataText[2]+"/"+arrDataText[3],
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
					$("#trBahanPolos_Edit").removeAttr("style");
				});

				$("#cmbKdHasil_Edit").on("select2:unselect",function(){
					$("#trBahanPolos_Edit").css("display","none");
				});
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_cutting/main/getDetaiRencanaForEdit",
					dataType : "JSON",
					data : {
						kdPotong : param
					},
					success : function(response){
						var arrStrip = ["MERAH PUTIH","MERAH","PINK","MERAH ORANGE"];
						var kdGdRoll = "";
						$("#btnSimpanRencanaSusulan_Edit").attr("onclick","editRencana('"+param+"')");
						$.each(response, function(AvIndex, AvValue){
							$("#txtKdPPIC_Edit").val(AvValue.kd_ppic);
							$("#txtKodePotong_Edit").val(AvValue.kd_potong);
							$("#txtTglRencana_Edit").val(AvValue.tgl_rencana);
							$("#txtNoMesin_Edit1").val(AvValue.no_mesin);
							$("#txtJumlahMesin_Edit").val(AvValue.jml_mesin);
							$("#cmbKdHasil_Edit").val(AvValue.kd_gd_hasil).trigger("change");
							$("#cmbKdBahan_Edit").val(AvValue.kd_gd_roll).trigger("change");
							$("#txtNamaCustomer_Edit").val(AvValue.customer);
							$("#txtTebalPlastik_Edit").val(AvValue.tebal);
							$("#txtKeteranganMerek_Edit").val(AvValue.ket_merek);
							$("#txtJumlahPermintaan_Edit").val(AvValue.stok_permintaan);
							$("#cmbSatuan_Edit").val(AvValue.satuan);
							$("#cmbShiftRencana_Edit").val(AvValue.shift);
							$("#txtBeratRencana_Edit").val(AvValue.berat);
							$("#txtKeterangan_Edit").val(AvValue.ket_barang);
							if(arrStrip.indexOf(AvValue.strip) != -1){
								$("#cmbWarnaStrip_Edit").val(AvValue.strip.toUpperCase()).trigger("change");
							}else{
								$("#cmbWarnaStrip_Edit").val("CUSTOM").trigger("change");
								$("#txtWarnaStrip_Edit").val(AvValue.strip.toUpperCase());
							}
						});
						$("#modalEditRencana").modal({backdrop:"static"});
					},
					error : function(response){
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
			//============================================MODAL METHOD (Finish)============================================//

			//============================================SAVE METHOD (Start)============================================//
			function saveTambahRencanaPotongPending(param1="", param2=""){
				var kdPotong1 = $("#txtKodeRencana").val();
				var kdPpic1 = $("#txtKdPpic").val();
				var kdGdHasil1 = $("#txtKdGdHasil").val();
				var kdGdRoll1 = $("#cmbKdGdRoll").val();
				var tglRencana1 = $("#txtTanggalRencana").val();
				var customer1 = $("#txtCustomer").val();
				var ukuran1 = $("#txtUkuran").val();
				var warnaPlastik1 = $("#txtWarnaPlastik").val();
				var tebal1 = $("#txtTebal").val();
				var jnsPermintaan1 = $("#txtJnsPermintaan").val();
				var jmlPermintaan1 = $("#txtJmlPermintaan").val();
				var stokPermintaan1 = $("#txtJumlahPembuatan").val().replace(/,/g, "");
				var satuan1 = $("#txtSatuan").val();
				var merek1 = $("#txtMerek").val();
				var noMesin1 = $("#txtMesin").val();
				var jmlMesin1 = $("#txtJumlahMesin").val();
				var shift1 = $("#cmbShift").val();
				var berat1 = $("#txtBerat").val();
				var ketMerek1 = $("#txtKetMerek").val();
				var ketBarang1 = $("#txtKeterangan").val();
				if ($("#cmbWarnaStrip").val()=="CUSTOM") {
					var strip1 = $("#txtWarnaStrip").val().toUpperCase();
				}else{
					var strip1 = $("#cmbWarnaStrip").val();
				}

				if(kdPotong1=="" || kdPpic1=="" || kdGdHasil1=="" || kdGdRoll1=="" ||
					 tglRencana1=="" || customer1=="" || ukuran1=="" || warnaPlastik1=="" ||
				 	 strip1=="" || jnsPermintaan1=="" || jmlPermintaan1=="" || stokPermintaan1==""||
				 	 satuan1=="" || merek1=="" || noMesin1=="" || jmlMesin1=="" || shift1==""){
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
						url : "<?php echo base_url(); ?>_cutting/main/saveTambahRencanaPotongPending",
						dataType : "TEXT",
						data : {
							kdPotong 				: kdPotong1,
							kdPpic 					: kdPpic1,
							kdGdHasil 			: kdGdHasil1,
							kdGdRoll 				: kdGdRoll1,
							tglRencana 			: tglRencana1,
							customer 				: customer1,
							ukuran 					: ukuran1,
							warnaPlastik 		: warnaPlastik1,
							strip 					: strip1,
							tebal 					: tebal1,
							jnsPermintaan 	: jnsPermintaan1,
							jmlPermintaan 	: jmlPermintaan1,
							stokPermintaan 	: stokPermintaan1,
							satuan 					: satuan1,
							merek 					: merek1,
							noMesin 				: noMesin1,
							jmlMesin 				: jmlMesin1,
							shift 					: shift1,
							berat 					: berat1,
							ketMerek 				: ketMerek1,
							ketBarang 			: ketBarang1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Tambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormBuatRencanaPending(param1, param2);
									tableRencanaPotongPending();
									datatablesRencanaPpicPotong(param1, param2);
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Tambahkan");
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

			function saveRencanaPotong(param1="",param2=""){
				if(confirm("Apakah Anda Yakin Tidak Ada Yang Salah?")){
					$.ajax({
						url : "<?php echo base_url(); ?>_cutting/main/saveRencanaPotong",
						dataType : "TEXT",
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Simpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormBuatRencanaPending(param1, param2);
									tableRencanaPotongPending();
									datatablesRencanaPpicPotong(param1);
									$("#modalInputRencanaKerja").modal("hide");
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Simpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("List Rencana Kosong! Data Tidak Dikirim");
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

			function saveKeteranganMandor(param){
				var ketMandor1 = $("#txtKetMandor_Edit").val();
				if(ketMandor1 == ""){
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
						url : "<?php echo base_url(); ?>_cutting/main/editKeteranganMandor",
						dataType : "TEXT",
						data : {
							kdPpic : param,
							ketMandor : ketMandor1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Simpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									$(".active a").trigger("click");
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Simpan");
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

			function saveTambahRencanaPotongSusulanPending(){
				var kdPotong1 = $("#txtKodePotong").val();
				var tglRencana1 = $("#txtTglRencana").val();
				var noMesin1 = $("#txtNoMesin").val();
				var jmlMesin1 = $("#txtJumlahMesin").val();
				var customer1 = $("#txtNamaCustomer").val();
				var kdGdHasil1 = $("#cmbKdHasil").val();
				var ketMerek1 = $("#txtKeteranganMerek").val();
				var kdGdRoll1 = $("#cmbKdBahan").val();
				var tebal1 = $("#txtTebalPlastik").val();
				var stokPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g, "");
				var jmlPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g, "");
				var satuan1 = $("#cmbSatuan").val();
				var shift1 = $("#cmbShiftRencana").val();
				var berat1 = $("#txtBeratRencana").val();
				var ketBarang1 = $("#txtKeterangan").val();
				if(kdGdRoll1 == null || kdGdRoll1=="" || kdGdRoll1=="null"){
					var ukuran1 = "";
					var warnaPlastik1 = "";
					var jnsPermintaan1 = "";
					var merek1 = "";
				}else{
					var dataText = $("#cmbKdHasil").select2("data")[0]["text"];
					var arrDataText = dataText.split(" | ");
					var ukuran1 = arrDataText[1];
					var warnaPlastik1 = arrDataText[3];
					var jnsPermintaan1 = arrDataText[5];
					var merek1 = arrDataText[2];
				}
				if ($("#cmbWarnaStrip").val()=="CUSTOM") {
					var strip1 = $("#txtWarnaStrip").val().toUpperCase();
				}else{
					var strip1 = $("#cmbWarnaStrip").val();
				}

				if(kdPotong1=="" || kdGdHasil1=="" || kdGdRoll1=="" ||
					 tglRencana1=="" || customer1=="" || ukuran1=="" || warnaPlastik1=="" ||
				 	 strip1=="" || jnsPermintaan1=="" || jmlPermintaan1=="" || stokPermintaan1==""||
				 	 satuan1=="" || merek1=="" || noMesin1=="" || jmlMesin1=="" || shift1==""){
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
						url : "<?php echo base_url(); ?>_cutting/main/saveTambahRencanaPotongSusulanPending",
						dataType : "TEXT",
						data : {
							kdPotong 				: kdPotong1,
							kdGdHasil 			: kdGdHasil1,
							kdGdRoll 				: kdGdRoll1,
							tglRencana 			: tglRencana1,
							customer 				: customer1,
							ukuran 					: ukuran1,
							warnaPlastik 		: warnaPlastik1,
							strip 					: strip1,
							tebal 					: tebal1,
							jnsPermintaan 	: jnsPermintaan1,
							jmlPermintaan 	: jmlPermintaan1,
							stokPermintaan 	: stokPermintaan1,
							satuan 					: satuan1,
							merek 					: merek1,
							noMesin 				: noMesin1,
							jmlMesin 				: jmlMesin1,
							shift 					: shift1,
							berat 					: berat1,
							ketMerek 				: ketMerek1,
							ketBarang 			: ketBarang1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Tambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormBuatRencanaKerjaSusulan();
									tableRencanaMandoPotongSusulanPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Tambahkan");
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

			function saveRencanaPotongSusulan(){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						url : "<?php echo base_url(); ?>_cutting/main/saveRencanaPotongSusulan",
						dataType : "TEXT",
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Simpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									tableRencanaMandoPotongSusulanPending();
									datatablesRencanaPpicPotong();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Simpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("List Rencana Kosong! Data Tidak Dikirim");
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

			function saveTambahSisaPengambilanPotong(param){
				var ketBarang1 = $("#txtKetBarang"+param).val();
				if(ketBarang1.toUpperCase().indexOf("TUMPUK") == -1){
					var dataKdCutting1 = $("#cmbUkuran"+param).val();
					if(dataKdCutting1=="" || dataKdCutting1==null){
						var arrKdCutting1 = ["",""];
					}else{
						var arrKdCutting1 = dataKdCutting1.split("#");
					}
					var kdCutting1 = arrKdCutting1[0];
					var kdGdRoll1 = $("#txtKdGdRoll"+param).val();
					var jnsPermintaan1 = $("#txtPermintaan"+param).val();
					var tglAwal1 = $("#txtTglAwal"+param).val();
					var tglAkhir1 = $("#txtTglAkhir"+param).val();
					var berat1 = $("#txtJumlahSisa"+param).val().replace(/,/g,"");
					var bobin1 = $("#txtJumlahBobin"+param).val().replace(/,/g,"");
					var payung1 = $("#txtJumlahPayung"+param).val().replace(/,/g,"");
					var payungKuning1 = $("#txtJumlahPayungKuning"+param).val().replace(/,/g,"");
					var shift1 = $("#cmbShift"+param).val();
					var keteranganHistory1 = $("#cmbKeterangan"+param).val();
					var ukuran1 = $("#txtPanjangPlastik"+param).val();
					var panjangPlastik1 = $("#txtPanjangPlastik"+param).val();
					var merek1 = $("#txtMerek"+param).val();
					var warnaPlastik1 = $("#txtWarnaPlastik"+param).val();

					var kdGdRollTumpuk1 = "";
					var dataText = "";
					var arrDataText = "";
					var jnsPermintaanTumpuk1 = "";
					var panjangPlastikTumpuk1 = "";
					var beratTumpuk1 = "";
					var bobinTumpuk1 = "";
					var payungTumpuk1 = "";
					var payungKuningTumpuk1 = "";

					if(berat1=="" || payung1=="" ||
						 payungKuning1=="" || bobin1=="" || kdCutting1=="" ||
						 shift1=="" || keteranganHistory1=="" || tglAwal1=="" || tglAkhir1==""){
							 var booleanCheck = false;
						 }else{
							 var booleanCheck = true;
						 }
				}else{
					var dataKdCutting1 = $("#cmbUkuran"+param).val();
					if(dataKdCutting1=="" || dataKdCutting1==null){
						var arrKdCutting1 = ["",""];
					}else{
						var arrKdCutting1 = dataKdCutting1.split("#");
					}
					var kdCutting1 = arrKdCutting1[0];
					var kdGdRoll1 = $("#txtKdGdRoll"+param).val();
					var jnsPermintaan1 = $("#txtPermintaan"+param).val();
					var tglAwal1 = $("#txtTglAwal"+param).val();
					var tglAkhir1 = $("#txtTglAkhir"+param).val();
					var berat1 = $("#txtJumlahSisa"+param).val().replace(/,/g,"");
					var bobin1 = $("#txtJumlahBobin"+param).val().replace(/,/g,"");
					var payung1 = $("#txtJumlahPayung"+param).val().replace(/,/g,"");
					var payungKuning1 = $("#txtJumlahPayungKuning"+param).val().replace(/,/g,"");
					var shift1 = $("#cmbShift"+param).val();
					var keteranganHistory1 = $("#cmbKeterangan"+param).val();
					var arrUkuran1 = $("#txtPanjangPlastik"+param).val().replace(/ /g,"").split("/");
					var arrUkuranPlastikPrimary = arrUkuran1[0].toLowerCase().split("x");
					var arrUkuranPlastikSecondary = arrUkuran1[1].toLowerCase().split("x");
					var panjangPlastik1 = arrUkuranPlastikPrimary[0];
					var panjangPlastikTumpuk1 = arrUkuranPlastikSecondary[0];
					var merek1 = $("#txtMerek"+param).val();
					var warnaPlastik1 = $("#txtWarnaPlastik"+param).val();

					var kdGdRollTumpuk1 = $("#cmbUkuranTumpuk"+param).val();
					if(kdGdRollTumpuk1=="" || kdGdRollTumpuk1==null){
						var dataText = "";
					}else{
						var dataText = $("#cmbUkuranTumpuk"+param).select2("data")[0]["text"];
					}
					var arrDataText = dataText.split(" | ");
					var jnsPermintaanTumpuk1 = arrDataText[5];
					var beratTumpuk1 = $("#txtJumlahSisaTumpuk"+param).val().replace(/,/g,"");
					var bobinTumpuk1 = $("#txtJumlahBobinTumpuk"+param).val().replace(/,/g,"");
					var payungTumpuk1 = $("#txtJumlahPayungTumpuk"+param).val().replace(/,/g,"");
					var payungKuningTumpuk1 = $("#txtJumlahPayungKuningTumpuk"+param).val().replace(/,/g,"");
					var merekTumpuk1 = arrDataText[2];
					var warnaPlastikTumpuk1 = arrDataText[3];

					if(berat1=="" || payung1=="" || payungKuning1=="" ||
						 bobin1=="" || kdGdRollTumpuk1=="" || tglAwal1=="" ||
					 	 tglAkhir1=="" || beratTumpuk1=="" || payungTumpuk1=="" ||
					 	 payungKuningTumpuk1=="" || bobinTumpuk1=="" || shift1=="" ||
					   keteranganHistory1==""){
							 var booleanCheck = false;
						 }else{
							 var booleanCheck = true;
						 }
				}
				if(booleanCheck){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_cutting/main/saveTambahSisaPengambilanPotong'); ?>",
						dataType : "TEXT",
						data : {
							kdCutting 						: kdCutting1,
							kdGdRoll 							: kdGdRoll1,
							jnsPermintaan 				: jnsPermintaan1,
							tglAwal 							: tglAwal1,
							tglAkhir 							: tglAkhir1,
							berat 								: berat1,
							bobin 								: bobin1,
							payung 								: payung1,
							payungKuning 					: payungKuning1,
							shift 								: shift1,
							keteranganHistory 		: keteranganHistory1,
							ukuran 								: panjangPlastik1,
							panjangPlastik 				: panjangPlastik1,
							merek 								: merek1,
							warnaPlastik 					: warnaPlastik1,
							ketBarang 						: ketBarang1,
							kdGdRollTumpuk 				: kdGdRollTumpuk1,
							jnsPermintaanTumpuk 	: jnsPermintaanTumpuk1,
							beratTumpuk 					: beratTumpuk1,
							bobinTumpuk 					: bobinTumpuk1,
							payungTumpuk 					: payungTumpuk1,
							payungKuningTumpuk 		: payungKuningTumpuk1,
							ukuranTumpuk 					: panjangPlastikTumpuk1,
							panjangPlastikTumpuk 	: panjangPlastikTumpuk1,
							merekTumpuk 					: merekTumpuk1,
							warnaPlastikTumpuk 		: warnaPlastikTumpuk1,
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Tambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									tableListSisaPengembalian(param);
									$("input").val("");
									$("select").val("");
									$(".date").datepicker("setDate",null);
									$("#cmbUkuran"+param).val("").trigger("change");
								},2000);
							}else if(jQuery.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal! Maaf Bulan Tersebut Sudah Di Lock");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Tambahkan");
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

			function saveSisaPengambilanPotong(param){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_cutting/main/saveSisaPengambilanPotong'); ?>",
						dataType : "TEXT",
						data : {jnsPermintaan : param},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modalSisaPengambilan_"+param+"").modal("hide");
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Kirim");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									tableListSisaPengembalian(param);
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Kirim");
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
					})
				}
			}

			function savePengambilanPotong(param){
				var tglPengambilan1 = $("#txtTglPengambilan").val();
				var tglPotong1 = $("#txtTglPotong").val();
				var dataValueKdCutting = $("#cmbKdCutting").val();
				var berat1 = $("#txtBeratPengambilan").val().replace(/,/g,"");
				var payung1 = $("#txtPayung").val().replace(/,/g,"");
				var payungKuning1 = $("#txtPayungKuning").val().replace(/,/g,"");
				var bobin1 = $("#txtJumlahBobin").val().replace(/,/g,"");
				var keteranganWaktu1 = $("#cmbKetarangan").val();
				var statusPengambilan1 = $("#txtStatusPengambilan").val();

				if(dataValueKdCutting == "" || dataValueKdCutting == null){

				}else{
					var arrDataValue = dataValueKdCutting.split("#");
					var kdCutting1 = arrDataValue[0];
					var kdGdRoll1 = arrDataValue[1];
					var dataText = $("#cmbKdCutting").select2("data")[0]["text"];
					var arrDataText = dataText.split(" | ");
					if(arrDataText[1].indexOf("/") != -1){
						var arrUkuran = arrDataText[1].split("/");
						var arrUkuranPrimer = arrUkuran[0].split("x");
						var panjangPlastik1 = arrUkuranPrimer[0];
					}else{
						var panjangPlastik1 = arrDataText[1];
					}
					var merek1 = arrDataText[3];
					var warnaPlastik1 = arrDataText[4];
					if(arrDataText[6] == "CETAK/POLOS"){
						var arrJnsPermintaan = arrDataText[6].split("/");
						var jnsPermintaan1 = arrJnsPermintaan[0];
					}else{
						var jnsPermintaan1 = arrDataText[6];
					}
					var ketBarang1 = arrDataText[2];
				}

				if(tglPengambilan1=="" || tglPotong1=="" || dataValueKdCutting=="" ||
					 berat1=="" || payung1=="" || payungKuning1=="" || bobin1=="" ||
				 	 keteranganWaktu1=="" || statusPengambilan1=="" || kdCutting1=="" ||
				 	 kdGdRoll1=="" || panjangPlastik1=="" || merek1=="" ||
				 	 warnaPlastik1=="" || jnsPermintaan1==""){
					$("#modal-notif").addClass("modal-warning");
 					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
 					$("#modal-notif").modal("show");
 					setTimeout(function(){
 						$("#modal-notif").modal("hide");
 						$("#modal-notif").removeClass("modal-warning");
 						$("#modalNotifContent").text("");
						$(".active a").trigger("click");
 					},2000);
				}else{
					if(ketBarang1.toUpperCase().indexOf("TUMPUK") != -1){
						var ukuranTumpuk1 = $("#cmbUkuranTumpuk").val();
						var beratTumpuk1 = $("#txtBeratTumpuk").val().replace(/,/g, "");
						var payungTumpuk1 = $("#txtPayungTumpuk").val().replace(/,/g, "");
						var payungKuningTumpuk1 = $("#txtPayungKuningTumpuk").val().replace(/,/g, "");
						var bobinTumpuk1 = $("#txtBobinTumpuk").val().replace(/,/g, "");
						if(ukuranTumpuk1 != "" || ukuranTumpuk1 != null){
							var dataText2 = $("#cmbUkuranTumpuk").select2("data")[0]["text"];
							var arrDataText2 = dataText2.split(" | ");
							var panjangPlastikTumpuk1 = arrDataText2[1];
							var merekTumpuk1 = arrDataText2[2];
							var warnaTumpuk1 = arrDataText2[3];
							var jnsPermintaanTumpuk1 = arrDataText2[5];
						}else{
							var panjangPlastikTumpuk1 = "";
							var merekTumpuk1 = "";
							var warnaTumpuk1 = "";
							var jnsPermintaanTumpuk1 = "";
						}
					}else{

					}
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_cutting/main/savePengambilanPotong'); ?>",
						dataType : "TEXT",
						data : {
							tglPengambilan 				: tglPengambilan1,
							tglPotong 						: tglPotong1,
							berat 								: berat1,
							payung 								: payung1,
							payungKuning 					: payungKuning1,
							bobin 								: bobin1,
							keteranganWaktu 			: keteranganWaktu1,
							statusPengambilan 		: statusPengambilan1,
							panjangPlastik 				: panjangPlastik1,
							merek 								: merek1,
							warnaPlastik 					: warnaPlastik1,
							jnsPermintaan 				: jnsPermintaan1,
							kdCutting 						: kdCutting1,
							kdGdRoll 							: kdGdRoll1,
							kdGdRollTumpuk 				: ukuranTumpuk1,
							panjangPlastikTumpuk 	: panjangPlastikTumpuk1,
							merekTumpuk						: merekTumpuk1,
							warnaPlastikTumpuk		: warnaTumpuk1,
							jnsPermintaanTumpuk		: jnsPermintaanTumpuk1,
							ketBarang							: ketBarang1,
							beratTumpuk 					: beratTumpuk1,
							payungTumpuk 					: payungTumpuk1,
							payungKuningTumpuk 		: payungKuningTumpuk1,
							bobinTumpuk 					: bobinTumpuk1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
			 					$("#modalNotifContent").text("Data Berhasil Ditambahkan");
			 					$("#modal-notif").modal("show");
			 					setTimeout(function(){
			 						$("#modal-notif").modal("hide");
			 						$("#modal-notif").removeClass("modal-info");
			 						$("#modalNotifContent").text("");
									$("input").val("").trigger("change");
									$("#cmbKetarangan").val("");
									$("#txtStatusPengambilan").val("EXTRUDER");
									$(".date").datepicker("setDate",null);
									$(".active a").trigger("click");
									$("#modalTambahPengambilan").modal("hide");
			 					},2000);
							}else if(jQuery.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
			 					$("#modalNotifContent").text("Maaf, Bulan Tersebut Sudah Di Lock");
			 					$("#modal-notif").modal("show");
			 					setTimeout(function(){
			 						$("#modal-notif").modal("hide");
			 						$("#modal-notif").removeClass("modal-danger");
			 						$("#modalNotifContent").text("");
			 					},2000);
							}else if(jQuery.trim(response) === "Gagal"){
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

			function savePengambilanPotongTertinggal(param){
				var tglPengambilan1 = $("#txtTglPengambilanTertinggal").val();
				var tglPotong1 = $("#txtTglPotongTertinggal").val();
				var dataValueKdCutting = $("#cmbKdCuttingTertinggal").val();
				var berat1 = $("#txtBeratPengambilanTertinggal").val().replace(/,/g,"");
				var payung1 = $("#txtPayungTertinggal").val().replace(/,/g,"");
				var payungKuning1 = $("#txtPayungKuningTertinggal").val().replace(/,/g,"");
				var bobin1 = $("#txtJumlahBobinTertinggal").val().replace(/,/g,"");
				var keteranganWaktu1 = $("#cmbKetaranganTertinggal").val();
				var statusPengambilan1 = $("#txtStatusPengambilanTertinggal").val();

				if(dataValueKdCutting == "" || dataValueKdCutting == null){

				}else{
					var arrDataValue = dataValueKdCutting.split("#");
					var kdCutting1 = arrDataValue[0];
					var kdGdRoll1 = arrDataValue[1];
					var dataText = $("#cmbKdCuttingTertinggal").select2("data")[0]["text"];
					var arrDataText = dataText.split(" | ");
					var panjangPlastik1 = arrDataText[1];
					var merek1 = arrDataText[3];
					var warnaPlastik1 = arrDataText[4];
					var jnsPermintaan1 = arrDataText[6];
				}

				if(tglPengambilan1=="" || tglPotong1=="" || dataValueKdCutting=="" ||
					 berat1=="" || payung1=="" || payungKuning1=="" || bobin1=="" ||
				 	 keteranganWaktu1=="" || statusPengambilan1=="" || kdCutting1=="" ||
				 	 kdGdRoll1=="" || panjangPlastik1=="" || merek1=="" ||
				 	 warnaPlastik1=="" || jnsPermintaan1==""){
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
						url : "<?php echo base_url('_cutting/main/savePengambilanPotongTertinggal'); ?>",
						dataType : "TEXT",
						data : {
							tglPengambilan 		: tglPengambilan1,
							tglPotong 				: tglPotong1,
							berat 						: berat1,
							payung 						: payung1,
							payungKuning 			: payungKuning1,
							bobin 						: bobin1,
							keteranganWaktu 	: keteranganWaktu1,
							statusPengambilan : statusPengambilan1,
							panjangPlastik 		: panjangPlastik1,
							merek 						: merek1,
							warnaPlastik 			: warnaPlastik1,
							jnsPermintaan 		: jnsPermintaan1,
							kdCutting 				: kdCutting1,
							kdGdRoll 					: kdGdRoll1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
			 					$("#modalNotifContent").text("Data Berhasil Ditambahkan");
			 					$("#modal-notif").modal("show");
			 					setTimeout(function(){
			 						$("#modal-notif").modal("hide");
			 						$("#modal-notif").removeClass("modal-info");
			 						$("#modalNotifContent").text("");
									$(".active a").trigger("click");
			 					},2000);
							}else if(jQuery.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
			 					$("#modalNotifContent").text("Maaf, Bulan Tersebut Sudah Di Lock");
			 					$("#modal-notif").modal("show");
			 					setTimeout(function(){
			 						$("#modal-notif").modal("hide");
			 						$("#modal-notif").removeClass("modal-danger");
			 						$("#modalNotifContent").text("");
			 					},2000);
							}else if(jQuery.trim(response) === "Gagal"){
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

			function saveInputHasil(){
				var ketBarang1 = $("#ketBarang").val().toUpperCase();
				var ketMerek1 = $("#ketMerek").val().toUpperCase();
				var idTransaksi1 = $("#idTransaksi").val();
				var validator = false;
				if(ketBarang1.indexOf("TUMPUK") != -1 || ketMerek1.indexOf("TUMPUK") != -1){
					var tglRencana1 = $("#txtTglPengerjaan").val();
					var merek1 = $("#txtMerek").val().toUpperCase();
					var jnsPermintaan1 = $("#txtPermintaan").val();
					var warnaPlastik1 = $("#txtWarnaPlastik").val();

					// var arrCustomer1 = $("input[name='txtCustomer']").serializeArray();
					var arrLembar1 = $("input[name='txtLembar']").serializeArray();
					var arrBerat1 = $("input[name='txtBerat']").serializeArray();
					// var arrTebal1 = $("input[name='txtTebal']").serializeArray();
					// var arrUkuran1 = $("input[name='txtUkuran']").serializeArray();
					// var arrJnsGudang1 = $("input[name='txtGudang']").serializeArray();
					// var arrStrip1 = $("input[name='txtStrip']").serializeArray();
					// var arrNoMesin1 = $("input[name='txtNoMesin']").serializeArray();
					var arrKdCutting1 = $("input[name='txtKdCutting']").serializeArray();
					var arrKdGdHasil1 = $("input[name='txtKdGdHasil']").serializeArray();
					var arrKdGdRoll1 = $("input[name='txtKdGdRoll']").serializeArray();

					var beratBagian1 = $("#txtBahan").val().replace(/,/g,"");
					var bobinBagian1 = $("#txtBobin").val().replace(/,/g,"");
					var payungBagian1 = $("#txtPayung").val().replace(/,/g,"");
					var payungKuningBagian1 = $("#txtPayungKuning").val().replace(/,/g,"");
					var beratBagianTumpuk1 = $("#txtBahanTumpuk").val().replace(/,/g,"");
					var bobinBagianTumpuk1 = $("#txtBobinTumpuk").val().replace(/,/g,"");
					var payungBagianTumpuk1 = $("#txtPayungTumpuk").val().replace(/,/g,"");
					var payungKuningBagianTumpuk1 = $("#txtPayungKuningTumpuk").val().replace(/,/g,"");

					var beratSisaSemalam1 = $("#txtBeratSisaSemalam").val().replace(/,/g,"");
					var bobinSisaSemalam1 = $("#txtBobinSisaSemalam").val().replace(/,/g,"");
					var payungSisaSemalam1 = $("#txtPayungSisaSemalam").val().replace(/,/g,"");
					var payungKuningSisaSemalam1 = $("#txtPayungKuningSisaSemalam").val().replace(/,/g,"");
					var beratSisaSemalamTumpuk1 = $("#txtBeratSisaSemalamTumpuk").val().replace(/,/g,"");
					var bobinSisaSemalamTumpuk1 = $("#txtBobinSisaSemalamTumpuk").val().replace(/,/g,"");
					var payungSisaSemalamTumpuk1 = $("#txtPayungSisaSemalamTumpuk").val().replace(/,/g,"");
					var payungKuningSisaSemalamTumpuk1 = $("#txtPayungKuningSisaSemalamTumpuk").val().replace(/,/g,"");

					var beratPengambilan1 = $("#txtBeratPengambilan").val().replace(/,/g,"");
					var bobinPengambilan1 = $("#txtBobinPengambilan").val().replace(/,/g,"");
					var payungPengambilan1 = $("#txtPayungPengambilan").val().replace(/,/g,"");
					var payungKuningPengambilan1 = $("#txtPayungKuningPengambilan").val().replace(/,/g,"");
					var beratPengambilanTumpuk1 = $("#txtBeratPengambilanTumpuk").val().replace(/,/g,"");
					var bobinPengambilanTumpuk1 = $("#txtBobinPengambilanTumpuk").val().replace(/,/g,"");
					var payungPengambilanTumpuk1 = $("#txtPayungPengambilanTumpuk").val().replace(/,/g,"");
					var payungKuningPengambilanTumpuk1 = $("#txtPayungKuningPengambilanTumpuk").val().replace(/,/g,"");

					var beratSisaHariIni1 = $("#txtSisa").val().replace(/,/g,"");
					var bobinSisaHariIni1 = $("#txtSisaBobin").val().replace(/,/g,"");
					var payungSisaHariIni1 = $("#txtSisaPayung").val().replace(/,/g,"");
					var payungKuningSisaHariIni1 = $("#txtSisaPayungKuning").val().replace(/,/g,"");
					var beratSisaHariIniTumpuk1 = $("#txtSisaTumpuk").val().replace(/,/g,"");
					var bobinSisaHariIniTumpuk1 = $("#txtSisaBobinTumpuk").val().replace(/,/g,"");
					var payungSisaHariIniTumpuk1 = $("#txtSisaPayungTumpuk").val().replace(/,/g,"");
					var payungKuningSisaHariIniTumpuk1 = $("#txtSisaPayungKuningTumpuk").val().replace(/,/g,"");

					var hasilLembar1 = $("#txtHasilLembar").val().replace(/,/g,"");
					var hasilBeratBersih1 = $("#txtHasilBeratBersih").val().replace(/,/g,"");
					var hasilBeratKotor1 = $("#txtHasilBeratKotor").val().replace(/,/g,"");
					var beratApal1 = $("#txtJumlahApal").val().replace(/,/g,"");
					var jnsRollPipa1 = $("#cmbRollPipa").val().replace(/,/g,"");
					var shift1 = $("#cmbShift").val().replace(/,/g,"");
					var keterangan1 = $("#txtKetarangan").val().replace(/,/g,"");
					var rollPipa1 = $("#txtJumlahRollPipa").val().replace(/,/g,"");
					var plusMinus1 = $("#txtPlusMinus").val().replace(/,/g,"");
					var kdGdRollTumpuk1 = $("#cmbUkuranTumpuk").val();

					switch (jnsRollPipa1) {
						case "PAYUNG"								: var payung1 = $("#txtJumlahPayung").val().replace(/,/g, "");
													 								var payungKuning1 = "0";
													 								var bobin1 = "0";
													 								break;
						case "PAYUNG_KUNING" 				: var payung1 = "0";
													 				 				var payungKuning1 = $("#txtJumlahPayung").val().replace(/,/g, "");
													 				 				var bobin1 = "0";
													 				 				break;
						case "PAYUNG_KUNING_PAYUNG" : var payung1 = $("#txtJumlahPayung_PKP").val().replace(/,/g, "");
													 				 				var payungKuning1 = $("#txtJumlahPayungKuning_PKP").val().replace(/,/g, "");
													 				 				var bobin1 = "0";
													 				 				break;
						case "BOBIN" 								: var payung1 = "0";
													 								var payungKuning1 = "0"
													 								var bobin1 = $("#txtBanyaknyaPipa").val().replace(/,/g, "");
													 								break;
						case "BOBIN_PAYUNG" 				: var payung1 = $("#txtJumlahBobinPayung_Payung").val().replace(/,/g, "");
													 								var payungKuning1 = "0";
													 								var bobin1 = $("#txtJumlahBobinPayung_Bobin").val().replace(/,/g, "");
													 								break;
						case "BOBIN_PAYUNG_KUNING" 	: var payung1 = "0";
													 							 	var payungKuning1 = $("#txtJumlahBobinPayung_Payung").val().replace(/,/g, "");
													 						 	 	var bobin1 = $("#txtJumlahBobinPayung_Bobin").val().replace(/,/g, "");
													 						 	 	break;
						default											: var payung1 = "0";
										 											var payungKuning1 = "0";
										 											var bobin1 = "0";
										 											break;

					}

					if(tglRencana1 == "" 						 || merek1 == "" 									|| jnsPermintaan1 == "" 					|| warnaPlastik1 == "" 									||
						 beratBagian1 == "" 					 || bobinBagian1 == "" 						|| payungBagian1 == "" 						|| payungKuningBagian1 == "" 						||
						 beratBagianTumpuk1 == "" 		 || bobinBagianTumpuk1 == "" 			|| payungBagianTumpuk1 == "" 			|| payungKuningBagianTumpuk1 == "" 			||
						 beratSisaSemalam1 == "" 			 || bobinSisaSemalam1 == "" 			|| payungSisaSemalam1 == "" 			|| payungKuningSisaSemalam1 == "" 			||
						 beratSisaSemalamTumpuk1 == "" || bobinSisaSemalamTumpuk1 == "" || payungSisaSemalamTumpuk1 == "" || payungKuningSisaSemalamTumpuk1 == "" ||
						 beratPengambilan1 == "" 			 || bobinPengambilan1 == "" 			|| payungPengambilan1 == "" 			|| payungKuningPengambilan1 == "" 			||
						 beratPengambilanTumpuk1 == "" || bobinPengambilanTumpuk1 == "" || payungPengambilanTumpuk1 == "" || payungKuningPengambilanTumpuk1 == "" ||
						 beratSisaHariIni1 == "" 			 || bobinSisaHariIni1 == "" 			|| payungSisaHariIni1 == "" 			|| payungKuningSisaHariIni1 == "" 			||
						 beratSisaHariIniTumpuk1 == "" || bobinSisaHariIniTumpuk1 == "" || payungSisaHariIniTumpuk1 == "" || payungKuningSisaHariIniTumpuk1 == "" ||
						 hasilLembar1 == "" 					 || hasilBeratBersih1 == "" 			|| hasilBeratKotor1 == "" 				|| beratApal1 == "" 										||
						 jnsRollPipa1 == "" 					 || shift1 == "" 									|| keterangan1 == "" 							|| rollPipa1 == "" 											||
						 plusMinus1 == "" 						 || kdGdRollTumpuk1 == "" 				|| arrLembar1.length <= 0 				|| arrBerat1.length <= 0 				 				||
	 					 arrKdCutting1.length <= 0 		 || arrKdGdHasil1.length <= 0 		|| arrKdGdRoll1.length <= 0
					  ){
						 if(payung1=="" || payungKuning1=="" || bobin1==""){
							 validator = false;
						 }else{
							 validator = false;
						 }
					 }else{
						 var data = {
							 	idTransaksi										: idTransaksi1,
							 	ketBarang											: ketBarang1,
			 			 		ketMerek											: ketMerek1,
			 		 			tglRencana										: tglRencana1,
			 	 				merek													: merek1,
			 					jnsPermintaan									: jnsPermintaan1,
			 					warnaPlastik									: warnaPlastik1,
			 				// 	arrCustomer										: arrCustomer1,
			 					arrLembar											: arrLembar1,
			 					arrBerat											: arrBerat1,
			 				// 	arrTebal											: arrTebal1,
			 				// 	arrUkuran											: arrUkuran1,
			 				// 	arrJnsGudang									: arrJnsGudang1,
			 				// 	arrStrip											: arrStrip1,
			 				// 	arrNoMesin										: arrNoMesin1,
			 					arrKdCutting									: arrKdCutting1,
			 					arrKdGdHasil									: arrKdGdHasil1,
			 					arrKdGdRoll										: arrKdGdRoll1,
			 					beratBagian										: beratBagian1,
			 					bobinBagian										: bobinBagian1,
			 					payungBagian									: payungBagian1,
			 					payungKuningBagian						: payungKuningBagian1,
			 					beratBagianTumpuk							: beratBagianTumpuk1,
			 					bobinBagianTumpuk							: bobinBagianTumpuk1,
			 					payungBagianTumpuk						: payungBagianTumpuk1,
			 					payungKuningBagianTumpuk			: payungKuningBagianTumpuk1,
			 					beratSisaSemalam							: beratSisaSemalam1,
			 					bobinSisaSemalam							: bobinSisaSemalam1,
			 					payungSisaSemalam							: payungSisaSemalam1,
			 					payungKuningSisaSemalam				: payungKuningSisaSemalam1,
			 					beratSisaSemalamTumpuk				: beratSisaSemalamTumpuk1,
			 					bobinSisaSemalamTumpuk				: bobinSisaSemalamTumpuk1,
			 					payungSisaSemalamTumpuk				: payungSisaSemalamTumpuk1,
			 					payungKuningSisaSemalamTumpuk	: payungKuningSisaSemalamTumpuk1,
			 					beratPengambilan							: beratPengambilan1,
			 					bobinPengambilan							: bobinPengambilan1,
			 					payungPengambilan							: payungPengambilan1,
			 					payungKuningPengambilan				: payungKuningPengambilan1,
			 					beratPengambilanTumpuk				: beratPengambilanTumpuk1,
			 					bobinPengambilanTumpuk				: bobinPengambilanTumpuk1,
			 					payungPengambilanTumpuk				: payungPengambilanTumpuk1,
			 					payungKuningPengambilanTumpuk	: payungKuningPengambilanTumpuk1,
			 					beratSisaHariIni							: beratSisaHariIni1,
			 					bobinSisaHariIni							: bobinSisaHariIni1,
			 					payungSisaHariIni							: payungSisaHariIni1,
			 					payungKuningSisaHariIni				: payungKuningSisaHariIni1,
			 					beratSisaHariIniTumpuk				: beratSisaHariIniTumpuk1,
			 					bobinSisaHariIniTumpuk				: bobinSisaHariIniTumpuk1,
			 					payungSisaHariIniTumpuk				: payungSisaHariIniTumpuk1,
			 					payungKuningSisaHariIniTumpuk	: payungKuningSisaHariIniTumpuk1,
			 					hasilLembar										: hasilLembar1,
			 					hasilBeratBersih							: hasilBeratBersih1,
			 					hasilBeratKotor								: hasilBeratKotor1,
			 					beratApal											: beratApal1,
			 					jnsRollPipa										: jnsRollPipa1,
								payung												: payung1,
								payungKuning									: payungKuning1,
								bobin													: bobin1,
			 					shift													: shift1,
			 					keterangan										: keterangan1,
			 					rollPipa											: rollPipa1,
			 					plusMinus											: plusMinus1,
			 					kdGdRollTumpuk								: kdGdRollTumpuk1,
						 }
						 validator = true;
					 }
				}else{
					var tglRencana1 = $("#txtTglPengerjaan").val();
					var merek1 = $("#txtMerek").val().toUpperCase();
					var jnsPermintaan1 = $("#txtPermintaan").val();
					var warnaPlastik1 = $("#txtWarnaPlastik").val();

					// var arrCustomer1 = $("input[name='txtCustomer']").serializeArray();
					var arrLembar1 = $("input[name='txtLembar']").serializeArray();
					var arrBerat1 = $("input[name='txtBerat']").serializeArray();
					// var arrTebal1 = $("input[name='txtTebal']").serializeArray();
					// var arrUkuran1 = $("input[name='txtUkuran']").serializeArray();
					// var arrJnsGudang1 = $("input[name='txtGudang']").serializeArray();
					// var arrStrip1 = $("input[name='txtStrip']").serializeArray();
					// var arrNoMesin1 = $("input[name='txtNoMesin']").serializeArray();
					var arrKdCutting1 = $("input[name='txtKdCutting']").serializeArray();
					var arrKdGdHasil1 = $("input[name='txtKdGdHasil']").serializeArray();
					var arrKdGdRoll1 = $("input[name='txtKdGdRoll']").serializeArray();

					var beratBagian1 = $("#txtBahan").val().replace(/,/g,"");
					var bobinBagian1 = $("#txtBobin").val().replace(/,/g,"");
					var payungBagian1 = $("#txtPayung").val().replace(/,/g,"");
					var payungKuningBagian1 = $("#txtPayungKuning").val().replace(/,/g,"");
					var beratBagianTumpuk1 = "0";
					var bobinBagianTumpuk1 = "0";
					var payungBagianTumpuk1 = "0";
					var payungKuningBagianTumpuk1 = "0";

					var beratSisaSemalam1 = $("#txtBeratSisaSemalam").val().replace(/,/g,"");
					var bobinSisaSemalam1 = $("#txtBobinSisaSemalam").val().replace(/,/g,"");
					var payungSisaSemalam1 = $("#txtPayungSisaSemalam").val().replace(/,/g,"");
					var payungKuningSisaSemalam1 = $("#txtPayungKuningSisaSemalam").val().replace(/,/g,"");
					var beratSisaSemalamTumpuk1 = "0";
					var bobinSisaSemalamTumpuk1 = "0";
					var payungSisaSemalamTumpuk1 = "0";
					var payungKuningSisaSemalamTumpuk1 = "0";

					var beratPengambilan1 = $("#txtBeratPengambilan").val().replace(/,/g,"");
					var bobinPengambilan1 = $("#txtBobinPengambilan").val().replace(/,/g,"");
					var payungPengambilan1 = $("#txtPayungPengambilan").val().replace(/,/g,"");
					var payungKuningPengambilan1 = $("#txtPayungKuningPengambilan").val().replace(/,/g,"");
					var beratPengambilanTumpuk1 = "0";
					var bobinPengambilanTumpuk1 = "0";
					var payungPengambilanTumpuk1 = "0";
					var payungKuningPengambilanTumpuk1 = "0";

					var beratSisaHariIni1 = $("#txtSisa").val().replace(/,/g,"");
					var bobinSisaHariIni1 = $("#txtSisaBobin").val().replace(/,/g,"");
					var payungSisaHariIni1 = $("#txtSisaPayung").val().replace(/,/g,"");
					var payungKuningSisaHariIni1 = $("#txtSisaPayungKuning").val().replace(/,/g,"");
					var beratSisaHariIniTumpuk1 = "0";
					var bobinSisaHariIniTumpuk1 = "0";
					var payungSisaHariIniTumpuk1 = "0";
					var payungKuningSisaHariIniTumpuk1 = "0";

					var hasilLembar1 = $("#txtHasilLembar").val().replace(/,/g,"");
					var hasilBeratBersih1 = $("#txtHasilBeratBersih").val().replace(/,/g,"");
					var hasilBeratKotor1 = $("#txtHasilBeratKotor").val().replace(/,/g,"");
					var beratApal1 = $("#txtJumlahApal").val().replace(/,/g,"");
					var jnsRollPipa1 = $("#cmbRollPipa").val().replace(/,/g,"");
					var shift1 = $("#cmbShift").val().replace(/,/g,"");
					var keterangan1 = $("#txtKetarangan").val().replace(/,/g,"");
					var rollPipa1 = $("#txtJumlahRollPipa").val().replace(/,/g,"");
					var plusMinus1 = $("#txtPlusMinus").val().replace(/,/g,"");
					var kdGdRollTumpuk1 = "0";

					switch (jnsRollPipa1) {
						case "PAYUNG"								: var payung1 = $("#txtJumlahPayung").val().replace(/,/g, "");
													 								var payungKuning1 = "0";
													 								var bobin1 = "0";
													 								break;
						case "PAYUNG_KUNING" 				: var payung1 = "0";
													 				 				var payungKuning1 = $("#txtJumlahPayung").val().replace(/,/g, "");
													 				 				var bobin1 = "0";
													 				 				break;
						case "PAYUNG_KUNING_PAYUNG" : var payung1 = $("#txtJumlahPayung_PKP").val().replace(/,/g, "");
													 				 				var payungKuning1 = $("#txtJumlahPayungKuning_PKP").val().replace(/,/g, "");
													 				 				var bobin1 = "0";
													 				 				break;
						case "BOBIN" 								: var payung1 = "0";
													 								var payungKuning1 = "0"
													 								var bobin1 = $("#txtBanyaknyaPipa").val().replace(/,/g, "");
													 								break;
						case "BOBIN_PAYUNG" 				: var payung1 = $("#txtJumlahBobinPayung_Payung").val().replace(/,/g, "");
													 								var payungKuning1 = "0";
													 								var bobin1 = $("#txtJumlahBobinPayung_Bobin").val().replace(/,/g, "");
													 								break;
						case "BOBIN_PAYUNG_KUNING" 	: var payung1 = "0";
													 							 	var payungKuning1 = $("#txtJumlahBobinPayung_Payung").val().replace(/,/g, "");
													 						 	 	var bobin1 = $("#txtJumlahBobinPayung_Bobin").val().replace(/,/g, "");
													 						 	 	break;
						default											: var payung1 = "0";
										 											var payungKuning1 = "0";
										 											var bobin1 = "0";
										 											break;

					}

					if(tglRencana1 == "" 						 || merek1 == "" 									|| jnsPermintaan1 == "" 					|| warnaPlastik1 == "" 									||
						 beratBagian1 == "" 					 || bobinBagian1 == "" 						|| payungBagian1 == "" 						|| payungKuningBagian1 == "" 						||
						 beratBagianTumpuk1 == "" 		 || bobinBagianTumpuk1 == "" 			|| payungBagianTumpuk1 == "" 			|| payungKuningBagianTumpuk1 == "" 			||
						 beratSisaSemalam1 == "" 			 || bobinSisaSemalam1 == "" 			|| payungSisaSemalam1 == "" 			|| payungKuningSisaSemalam1 == "" 			||
						 beratSisaSemalamTumpuk1 == "" || bobinSisaSemalamTumpuk1 == "" || payungSisaSemalamTumpuk1 == "" || payungKuningSisaSemalamTumpuk1 == "" ||
						 beratPengambilan1 == "" 			 || bobinPengambilan1 == "" 			|| payungPengambilan1 == "" 			|| payungKuningPengambilan1 == "" 			||
						 beratPengambilanTumpuk1 == "" || bobinPengambilanTumpuk1 == "" || payungPengambilanTumpuk1 == "" || payungKuningPengambilanTumpuk1 == "" ||
						 beratSisaHariIni1 == "" 			 || bobinSisaHariIni1 == "" 			|| payungSisaHariIni1 == "" 			|| payungKuningSisaHariIni1 == "" 			||
						 beratSisaHariIniTumpuk1 == "" || bobinSisaHariIniTumpuk1 == "" || payungSisaHariIniTumpuk1 == "" || payungKuningSisaHariIniTumpuk1 == "" ||
						 hasilLembar1 == "" 					 || hasilBeratBersih1 == "" 			|| hasilBeratKotor1 == "" 				|| beratApal1 == "" 										||
						 jnsRollPipa1 == "" 					 || shift1 == "" 									|| keterangan1 == "" 							|| rollPipa1 == "" 											||
						 plusMinus1 == "" 						 || kdGdRollTumpuk1 == "" 				|| arrLembar1.length <= 0 				|| arrBerat1.length <= 0 				 				||
	 					 arrKdCutting1.length <= 0 		 || arrKdGdHasil1.length <= 0 		|| arrKdGdRoll1.length <= 0
					 ){
						 if(payung1=="" || payungKuning1=="" || bobin1==""){
							 validator = false;
						 }else{
							 validator = false;
						 }
					 }else{
						 var data = {
							 	idTransaksi										: idTransaksi1,
							 	ketBarang											: ketBarang1,
			 			 		ketMerek											: ketMerek1,
			 		 			tglRencana										: tglRencana1,
			 	 				merek													: merek1,
			 					jnsPermintaan									: jnsPermintaan1,
			 					warnaPlastik									: warnaPlastik1,
			 				// 	arrCustomer										: arrCustomer1,
			 					arrLembar											: arrLembar1,
			 					arrBerat											: arrBerat1,
			 				// 	arrTebal											: arrTebal1,
			 				// 	arrUkuran											: arrUkuran1,
			 				// 	arrJnsGudang									: arrJnsGudang1,
			 				// 	arrStrip											: arrStrip1,
			 				// 	arrNoMesin										: arrNoMesin1,
			 					arrKdCutting									: arrKdCutting1,
			 					arrKdGdHasil									: arrKdGdHasil1,
			 					arrKdGdRoll										: arrKdGdRoll1,
			 					beratBagian										: beratBagian1,
			 					bobinBagian										: bobinBagian1,
			 					payungBagian									: payungBagian1,
			 					payungKuningBagian						: payungKuningBagian1,
			 					beratBagianTumpuk							: beratBagianTumpuk1,
			 					bobinBagianTumpuk							: bobinBagianTumpuk1,
			 					payungBagianTumpuk						: payungBagianTumpuk1,
			 					payungKuningBagianTumpuk			: payungKuningBagianTumpuk1,
			 					beratSisaSemalam							: beratSisaSemalam1,
			 					bobinSisaSemalam							: bobinSisaSemalam1,
			 					payungSisaSemalam							: payungSisaSemalam1,
			 					payungKuningSisaSemalam				: payungKuningSisaSemalam1,
			 					beratSisaSemalamTumpuk				: beratSisaSemalamTumpuk1,
			 					bobinSisaSemalamTumpuk				: bobinSisaSemalamTumpuk1,
			 					payungSisaSemalamTumpuk				: payungSisaSemalamTumpuk1,
			 					payungKuningSisaSemalamTumpuk	: payungKuningSisaSemalamTumpuk1,
			 					beratPengambilan							: beratPengambilan1,
			 					bobinPengambilan							: bobinPengambilan1,
			 					payungPengambilan							: payungPengambilan1,
			 					payungKuningPengambilan				: payungKuningPengambilan1,
			 					beratPengambilanTumpuk				: beratPengambilanTumpuk1,
			 					bobinPengambilanTumpuk				: bobinPengambilanTumpuk1,
			 					payungPengambilanTumpuk				: payungPengambilanTumpuk1,
			 					payungKuningPengambilanTumpuk	: payungKuningPengambilanTumpuk1,
			 					beratSisaHariIni							: beratSisaHariIni1,
			 					bobinSisaHariIni							: bobinSisaHariIni1,
			 					payungSisaHariIni							: payungSisaHariIni1,
			 					payungKuningSisaHariIni				: payungKuningSisaHariIni1,
			 					beratSisaHariIniTumpuk				: beratSisaHariIniTumpuk1,
			 					bobinSisaHariIniTumpuk				: bobinSisaHariIniTumpuk1,
			 					payungSisaHariIniTumpuk				: payungSisaHariIniTumpuk1,
			 					payungKuningSisaHariIniTumpuk	: payungKuningSisaHariIniTumpuk1,
			 					hasilLembar										: hasilLembar1,
			 					hasilBeratBersih							: hasilBeratBersih1,
			 					hasilBeratKotor								: hasilBeratKotor1,
			 					beratApal											: beratApal1,
			 					jnsRollPipa										: jnsRollPipa1,
								payung												: payung1,
								payungKuning									: payungKuning1,
								bobin													: bobin1,
			 					shift													: shift1,
			 					keterangan										: keterangan1,
			 					rollPipa											: rollPipa1,
			 					plusMinus											: plusMinus1,
			 					kdGdRollTumpuk								: kdGdRollTumpuk1,
						 }
						 validator = true;
					 }
				}
				if(validator){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_cutting/main/saveInputHasilPotong'); ?>",
						dataType : "TEXT",
						data : data,
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Disimpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									window.close();
								},2000);
							}else if(jQuery.trim(response) === "Data Kosong"){
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-warning");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Data Ada"){
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Data Sudah Di Input Sebelumnya!");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-warning");
									$("#modalNotifContent").text("");
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
						},
						error : function(response){
							$("#modal-notif").addClass("modal-danger");
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

		 	function saveHasilJobPotong(param){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					var tglJadi1 = param;
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_cutting/main/saveHasilJobPotong'); ?>",
						dataType : "TEXT",
						data : {tglJadi : tglJadi1},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Disimpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									datatablesHasilJobPotongPending();
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
						},
						error : function(response){
							$("#modal-notif").addClass("modal-danger");
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

			function saveKirimBonHasilJadiGlobal(param1, param2){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					if(param1=="" || param2==""){
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
							url : "<?php echo base_url('_cutting/main/saveKirimBonHasilJadiGlobal'); ?>",
							dataType : "TEXT",
							data : {
								jnsBrg : param1,
								tglJadi : param2
							},
							success : function(response){
								if(jQuery.trim(response) === "Berhasil"){
									$("#modal-notif").addClass("modal-info");
									$("#modalNotifContent").text("Data Berhasil Disimpan");
									$("#modal-notif").modal("show");
									setTimeout(function(){
										$("#modal-notif").modal("hide");
										$("#modal-notif").removeClass("modal-info");
										$("#modalNotifContent").text("");
										searchListBonHasilJadiGlobal(param1, param2);
									},2000);
								}else if(jQuery.trim(response) === "Lock"){
									$("#modal-notif").addClass("modal-danger");
									$("#modalNotifContent").text("Gagal! Maaf Bulan Ini Sudah Dikunci");
									$("#modal-notif").modal("show");
									setTimeout(function(){
										$("#modal-notif").modal("hide");
										$("#modal-notif").removeClass("modal-danger");
										$("#modalNotifContent").text("");
									},2000);
								}else if(jQuery.trim(response) === "Gagal"){
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
			}

			function saveTambahBonApal(param){
				var kdGdApal1 = $("#cmbJenisApal").val();
				var jumlahApal1 = $("#txtJumlahApal").val().replace(/,/g,"");

				if(kdGdApal1=="" || jumlahApal1==""){
					$("#modal-notif").addClass("modal-warning");
 					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
 					$("#modal-notif").modal("show");
 					setTimeout(function(){
 						$("#modal-notif").modal("hide");
 						$("#modal-notif").removeClass("modal-warning");
 						$("#modalNotifContent").text("");
 					},2000);
				}else{
					var warna = $("#cmbJenisApal option:selected").text();
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_cutting/main/saveTambahBonApal') ?>",
						dataType : "TEXT",
						data : {
							kdGdApal		: kdGdApal1,
							merek				: warna,
							warna				: warna,
							jumlahApal	: jumlahApal1,
							tglTransaksi : param
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Disimpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#txtJumlahApal").val("");
									tableListDataBonApalPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Disimpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal! Bulan Ini Sudah Di Kunci");
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

			function saveTransaksiDetailHistoryApal(){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						url : "<?php echo base_url('_cutting/main/saveTransaksiDetailHistoryApal'); ?>",
						dataType : "TEXT",
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Dikirim");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#txtJumlahApal").val("");
									tableListDataBonApalPending();
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Dikirim");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#txtJumlahApal").val("");
								},2000);
							}
						}
					});
				}
			}
			//============================================SAVE METHOD (Finish)============================================//

			//============================================EDIT METHOD (Start)============================================//
			function editRencanaPotongPending(){
				var kdPotong1 = $("#txtKodeRencana").val();
				var kdGdRoll1 = $("#cmbKdGdRoll").val();
				var tglRencana1 = $("#txtTanggalRencana").val();
				var customer1 = $("#txtCustomer").val();
				var ukuran1 = $("#txtUkuran").val();
				var tebal1 = $("#txtTebal").val();
				var stokPermintaan1 = $("#txtJumlahPembuatan").val().replace(/,/g, "");
				var noMesin1 = $("#txtMesin").val();
				var jmlMesin1 = $("#txtJumlahMesin").val();
				var shift1 = $("#cmbShift").val();
				var ketBarang1 = $("#txtKeterangan").val();
				if ($("#cmbWarnaStrip").val()=="CUSTOM") {
					var strip1 = $("#txtWarnaStrip").val().toUpperCase();
				}else{
					var strip1 = $("#cmbWarnaStrip").val();
				}

				if(kdPotong1=="" || tglRencana1=="" || customer1=="" || ukuran1=="" ||
				 	 strip1=="" || stokPermintaan1=="" || noMesin1=="" ||
					 jmlMesin1=="" || shift1==""){
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
						url : "<?php echo base_url(); ?>_cutting/main/editRencanaPotongPending",
						dataType : "TEXT",
						data : {
							kdPotong 				: kdPotong1,
							kdGdRoll 				: kdGdRoll1,
							tglRencana 			: tglRencana1,
							customer 				: customer1,
							ukuran 					: ukuran1,
							strip 					: strip1,
							tebal 					: tebal1,
							stokPermintaan 	: stokPermintaan1,
							noMesin 				: noMesin1,
							jmlMesin 				: jmlMesin1,
							shift 					: shift1,
							ketBarang				: ketBarang1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Ubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormBuatRencanaPending();
									tableRencanaPotongPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Ubah");
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

			function editStatusPengerjaan(param, param2="", param3=""){
				var stsPengerjaan1 = $("#cmbStatus_Edit").val();
				if(stsPengerjaan1 == ""){
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
						url : "<?php echo base_url(); ?>_cutting/main/editStatusPengerjaan",
						dataType : "TEXT",
						data : {
							kdPpic : param,
							stsPengerjaan : stsPengerjaan1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Simpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									datatablesRencanaPpicPotong(param2, param3);
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Simpan");
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

			function editMesinRencanaPpic(param, param2="", param3=""){
				var noMesin1 = $("#txtNoMesin_Edit").val();
				if(noMesin1 == ""){
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
						url : "<?php echo base_url(); ?>_cutting/main/editMesinRencanaPpic",
						dataType : "TEXT",
						data : {
							kdPpic : param,
							noMesin : noMesin1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Ubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									datatablesRencanaPpicPotong(param2, param3);
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Ubah");
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

			function editMerekRencana(param1, param2=""){
				var kdGdHasil = $("#cmbKdGdHasil").val();
				var dataText = $("#cmbKdGdHasil").select2("data")[0]["text"];
				var arrDataText = dataText.split(" | ");
				if(kdGdHasil == ""){
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
						url : "<?php echo base_url(); ?>_cutting/main/editMerekRencana",
						dataType : "TEXT",
						data : {
							kdPotong : param1,
							kdPpic : param2,
							kdGdHasil : kdGdHasil,
							ukuran : arrDataText[1],
							jnsPermintaan : arrDataText[5],
							merek : arrDataText[2],
							warnaPlastik : arrDataText[3]
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Ubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									datatablesRencanaMandorPotong();
									$("#modalEditMerek").modal("hide");
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Ubah");
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
						}
					});
				}
			}

			function editTanggalRencanaMandor(param){
				var tglRencana1 = $("#txtTanggalRencana").val();
				if(tglRencana1 == ""){
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
						url : "<?php echo base_url(); ?>_cutting/main/editTanggalRencanaMandor",
						dataType : "TEXT",
						data : {
							kdPotong : param,
							tglRencana : tglRencana1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Ubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									datatablesRencanaMandorPotong();
									$("#modalEditTanggal").modal("hide");
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Ubah");
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
						}
					})
				}
			}

			function editGantiMesinMandor(param1, param2=""){
				var noMesin1 = $("#txtNoMesin_Edit").val();
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
						url : "<?php echo base_url(); ?>_cutting/main/editGantiMesinMandor",
						dataType : "TEXT",
						data : {
							kdPotong : param1,
							kdPpic : param2,
							noMesin : noMesin1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Ubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									datatablesRencanaMandorPotong();
									$("#modalEditMesin").modal("hide");
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Ubah");
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
						}
					});
				}
			}

			function editRencanaPotongSusulanPending(){
				var kdPotong1 = $("#txtKodePotong").val();
				var tglRencana1 = $("#txtTglRencana").val();
				var noMesin1 = $("#txtNoMesin").val();
				var jmlMesin1 = $("#txtJumlahMesin").val();
				var customer1 = $("#txtNamaCustomer").val();
				var kdGdHasil1 = $("#cmbKdHasil").val();
				var ketMerek1 = $("#txtKeteranganMerek").val();
				var kdGdRoll1 = $("#cmbKdBahan").val();
				var tebal1 = $("#txtTebalPlastik").val();
				var stokPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g, "");
				var satuan1 = $("#cmbSatuan").val();
				var shift1 = $("#cmbShiftRencana").val();
				var berat1 = $("#txtBeratRencana").val();
				var ketBarang1 = $("#txtKeterangan").val();
				if ($("#cmbWarnaStrip").val()=="CUSTOM") {
					var strip1 = $("#txtWarnaStrip").val().toUpperCase();
				}else{
					var strip1 = $("#cmbWarnaStrip").val();
				}

				if(kdGdHasil1 == null || kdGdHasil1 == "" || kdGdHasil1 == "null"){
					var ukuran1 = "";
					var merek1 = "";
					var warnaPlastik1 = "";
					var jnsPermintaan = "";
				}else{
					var dataText = $("#cmbKdHasil").select2("data")[0]["text"];
					var arrDataText = dataText.split(" | ");
					var ukuran1 = arrDataText[1];
					var merek1 = arrDataText[2];
					var warnaPlastik1 = arrDataText[3];
					var jnsPermintaan = arrDataText[5];
				}

				if(kdPotong1=="" || tglRencana1=="" || customer1=="" ||
				 	 strip1=="" || stokPermintaan1=="" || noMesin1=="" ||
					 jmlMesin1=="" || shift1==""){
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
						url : "<?php echo base_url(); ?>_cutting/main/editRencanaPotongSusulanPending",
						dataType : "TEXT",
						data : {
							kdPotong				: kdPotong1,
							tglRencana			: tglRencana1,
							noMesin					: noMesin1,
							jmlMesin				: jmlMesin1,
							customer				: customer1,
							kdGdHasil				: kdGdHasil1,
							ketMerek				: ketMerek1,
							kdGdRoll				: kdGdRoll1,
							tebal						: tebal1,
							stokPermintaan	: stokPermintaan1,
							satuan					: satuan1,
							shift						: shift1,
							berat						: berat1,
							ketBarang				: ketBarang1,
							ukuran					: ukuran1,
							warnaPlastik		: warnaPlastik1,
							jnsPermintaan		: jnsPermintaan,
							merek						: merek1,
							strip						: strip1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Ubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormBuatRencanaKerjaSusulan();
									tableRencanaMandoPotongSusulanPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Ubah");
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

			function editBonApal(param, param2){
				var kdGdApal1 = $("#cmbJenisApal").val();
				var jumlahApal1 = $("#txtJumlahApal").val().replace(/,/g,"");

				if(kdGdApal1=="" || jumlahApal1==""){
					$("#modal-notif").addClass("modal-warning");
 					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
 					$("#modal-notif").modal("show");
 					setTimeout(function(){
 						$("#modal-notif").modal("hide");
 						$("#modal-notif").removeClass("modal-warning");
 						$("#modalNotifContent").text("");
 					},2000);
				}else{
					var warna = $("#cmbJenisApal option:selected").text();
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_cutting/main/editTambahBonApal') ?>",
						dataType : "TEXT",
						data : {
							kdGdApal		: kdGdApal1,
							merek				: warna,
							warna				: warna,
							jumlahApal	: jumlahApal1,
							idTransaksi : param,
							tglTransaksi: param2,
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Ubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#txtJumlahApal").val("");
									tableListDataBonApalPending();
									resetTambahBonApalPending(param2);
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Ubah");
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

			function editHasilCutting(param, param2){
				var tglRencana = $("#txtTglRencana").val();
				var tglJadi = $("#txtTglInput").val();
				var kdGdHasil = $("#cmbMerek").val();
				var permintaan = $("#txtJnsPermintaan").val();
				var totalJumlahApalBaru = $("#txtJumlahApal").val().replace(/,/g, "");
				var totalJumlahBeratKotorBaru = $("#txtHasilBeratKotor").val().replace(/,/g, "");
				var totalJumlahBeratBersihBaru = $("#txtHasilBeratBersih").val().replace(/,/g, "");
				var totalJumlahLembarBaru = $("#txtJumlahLembar").val().replace(/,/g, "");
				var jumlahSubLembarBaru = $("#txtJumlahSubLembar").val().replace(/,/g, "");
				var jumlahSubBeratBaru = $("#txtJumlahSubBerat").val().replace(/,/g, "");
				var plusminusBaru = $("#txtPlusMinus").val().replace(/,/g, "");
				var rollPipa = $("#txtJumlahRollPipa").val().replace(/,/g, "");

				var bahan = $("#txtBahan").val().replace(/,/g, "");
				var bobin = $("#txtBobin").val().replace(/,/g, "");
				var payung = $("#txtPayung").val().replace(/,/g, "");
				var payungKuning = $("#txtPayungKuning").val().replace(/,/g, "");

				var beratSisaSemalam = $("#txtBeratSisaSemalam").val().replace(/,/g, "");
				var bobinSisaSemalam = $("#txtBobinSisaSemalam").val().replace(/,/g, "");
				var payungSisaSemalam = $("#txtPayungSisaSemalam").val().replace(/,/g, "");
				var payungKuningSisaSemalam = $("#txtPayungKuningSisaSemalam").val().replace(/,/g, "");

				var beratPengambilan = $("#txtBeratPengambilan").val().replace(/,/g, "");
				var bobinPengambilan = $("#txtBobinPengambilan").val().replace(/,/g, "");
				var payungPengambilan = $("#txtPayungPengambilan").val().replace(/,/g, "");
				var payungKuningPengambilan = $("#txtPayungKuningPengambilan").val().replace(/,/g, "");

				var sisa = $("#txtSisa").val().replace(/,/g, "");
				var bobinSisa = $("#txtSisaBobin").val().replace(/,/g, "");
				var payungSisa = $("#txtSisaPayung").val();
				var payungKuningSisa = $("#txtSisaPayungKuning").val().replace(/,/g, "");

				var bahanTumpuk = $("#txtBahanTumpuk").val().replace(/,/g, "");
				var bobinBahanTumpuk = $("#txtBobinTumpuk").val().replace(/,/g, "");
				var payungBahanTumpuk = $("#txtPayungTumpuk").val().replace(/,/g, "");
				var payungKuningBahanTumpuk = $("#txtPayungKuningTumpuk").val().replace(/,/g, "");

				var beratSisaSemalamTumpuk= $("#txtBeratSisaSemalamTumpuk").val().replace(/,/g, "");
				var bobinSisaSemalamTumpuk= $("#txtBobinSisaSemalamTumpuk").val().replace(/,/g, "");
				var payungSisaSemalamTumpuk= $("#txtPayungSisaSemalamTumpuk").val().replace(/,/g, "");
				var payungKuningSisaSemalamTumpuk= $("#txtPayungKuningSisaSemalamTumpuk").val().replace(/,/g, "");

				var beratPengambilanTumpuk = $("#txtBeratPengambilanTumpuk").val().replace(/,/g, "");
				var bobinPengambilanTumpuk = $("#txtBobinPengambilanTumpuk").val().replace(/,/g, "");
				var payungPengambilanTumpuk = $("#txtPayungPengambilanTumpuk").val().replace(/,/g, "");
				var payungKuningPengambilanTumpuk = $("#txtPayungKuningPengambilanTumpuk").val().replace(/,/g, "");

				var sisaTumpuk = $("#txtSisaTumpuk").val().replace(/,/g, "");
				var bobinSisaTumpuk = $("#txtSisaBobinTumpuk").val().replace(/,/g, "");
				var payungSisaTumpuk = $("#txtSisaPayungTumpuk").val().replace(/,/g, "");
				var payungKuningSisaTumpuk = $("#txtSisaPayungKuningTumpuk").val().replace(/,/g, "");

				var jnsRollPipa = $("#cmbRollPipa").val();
				switch (jnsRollPipa) {
					case "PAYUNG"											: var rollPayung = $("#txtJumlahPayung").val().replace(/,/g, "");
																							var rollPayungKuning = "0";
																							var rollBobin = "0";
																							break;

					case "PAYUNG_KUNING"							: var rollPayung = "0";
																							var rollPayungKuning = $("#txtJumlahPayung").val().replace(/,/g, "");
																							var rollBobin = "0";
																							break;

					case "PAYUNG_KUNING_PAYUNG"				: var rollPayung = $("#txtJumlahPayung_PKP").val().replace(/,/g, "");
																							var rollPayungKuning = $("#txtJumlahPayungKuning_PKP").val().replace(/,/g, "");
																							var rollBobin = "0";
																							break;

					case "BOBIN"											: var rollPayung = "0";
																							var rollPayungKuning = "0";
																							var rollBobin = $("#txtBanyaknyaPipa").val().replace(/,/g, "");
																							break;

					case "BOBIN_PAYUNG"								: var rollPayung = $("#txtJumlahBobinPayung_Payung").val().replace(/,/g, "");
																							var rollPayungKuning = "0";
																							var rollBobin = $("#txtJumlahBobinPayung_Bobin").val().replace(/,/g, "");
																							break;

					case "BOBIN_PAYUNG_KUNING"				: var rollPayung = "0";
																							var rollPayungKuning = $("#txtJumlahBobinPayung_Payung").val().replace(/,/g, "");
																							var rollBobin = $("#txtJumlahBobinPayung_Bobin").val().replace(/,/g, "");
																							break;

					case "BOBIN_PAYUNG_KUNING_PAYUNG"	: var rollPayung = $("#txtBPKP_JumlahPayung").val().replace(/,/g, "");
																							var rollPayungKuning = $("#txtBPKP_JumlahPayungKuning").val().replace(/,/g, "");
																							var rollBobin = $("#txtBPKP_BanyaknyaPipa").val().replace(/,/g, "");
																							break;

					default														: var rollPayung = "0";
																							var rollPayungKuning = "0";
																							var rollBobin = "0";
																							break;

				}

				if(tglRencana == "" 										||
					 tglJadi == "" 												||
					 permintaan == "" 						||
					 totalJumlahApalBaru == "" 			||
					 totalJumlahBeratKotorBaru == "" 		||
					 totalJumlahBeratBersihBaru == "" 					||
					 totalJumlahLembarBaru == "" 						||
					 jumlahSubLembarBaru == "" 						||
					 jumlahSubBeratBaru == "" 									||
					 plusminusBaru == "" 											||
					 rollPipa == "" 													||
					 bahan == "" 													||
					 bobin == "" 												||
					 payung == "" 									||
					 payungKuning == "" 							||
					 beratSisaSemalam == "" 							||
					 bobinSisaSemalam == "" 							||
					 payungSisaSemalam == "" 				||
					 payungKuningSisaSemalam == "" 							||
					 beratPengambilan == "" 							||
					 bobinPengambilan == "" 							||
					 payungPengambilan == "" 				||
					 payungKuningPengambilan == "" 													||
					 sisa == "" 											||
					 bobinSisa == "" 										||
					 payungSisa == "" 							||
					 payungKuningSisa == "" 										||
					 bahanTumpuk == "" 							||
					 bobinBahanTumpuk == "" 							||
					 payungBahanTumpuk == "" 				||
					 payungKuningBahanTumpuk == "" 				||
					 beratSisaSemalamTumpuk == "" 				||
					 bobinSisaSemalamTumpuk == "" 				||
					 payungSisaSemalamTumpuk == "" 	||
					 payungKuningSisaSemalamTumpuk == "" 				||
					 beratPengambilanTumpuk == "" 				||
					 bobinPengambilanTumpuk == "" 				||
					 payungPengambilanTumpuk == "" 	||
					 payungKuningPengambilanTumpuk == "" 										||
					 sisaTumpuk == "" 								||
					 bobinSisaTumpuk == "" 							||
					 payungSisaTumpuk == "" 				||
					 payungKuningSisaTumpuk == "" 										||
					 jnsRollPipa == "" 										||
					 rollPayung == "" 							||
					 rollPayungKuning == "" ||
					 rollBobin == ""
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
						url : "<?php echo base_url('_cutting/main/editHasilCutting'); ?>",
						dataType : "TEXT",
						data : {
							idTransaksi												: param,
							kdHasilPotong											: param2,
							tglRencana 												: tglRencana,
							tglJadi 													: tglJadi,
							kdGdHasil 												: kdGdHasil,
							permintaan 												: permintaan,
							totalJumlahApalBaru 							: totalJumlahApalBaru,
							totalJumlahBeratKotorBaru 				: totalJumlahBeratKotorBaru,
							totalJumlahBeratBersihBaru 				: totalJumlahBeratBersihBaru,
							totalJumlahLembarBaru 						: totalJumlahLembarBaru,
							jumlahSubLembarBaru 							: jumlahSubLembarBaru,
							jumlahSubBeratBaru 								: jumlahSubBeratBaru,
							plusminusBaru 										: plusminusBaru,
							rollPipa													: rollPipa,
							bahan															: bahan,
							bobin															: bobin,
							payung														: payung,
							payungKuning											: payungKuning,
							beratSisaSemalam									: beratSisaSemalam,
							bobinSisaSemalam									: bobinSisaSemalam,
							payungSisaSemalam									: payungSisaSemalam,
							payungKuningSisaSemalam						: payungKuningSisaSemalam,
							beratPengambilan									: beratPengambilan,
							bobinPengambilan									: bobinPengambilan,
							payungPengambilan									: payungPengambilan,
							payungKuningPengambilan						: payungKuningPengambilan,
							sisa															: sisa,
							bobinSisa													: bobinSisa,
							payungSisa												: payungSisa,
							payungKuningSisa									: payungKuningSisa,
							bahanTumpuk												: bahanTumpuk,
							bobinBahanTumpuk									: bobinBahanTumpuk,
							payungBahanTumpuk									: payungBahanTumpuk,
							payungKuningBahanTumpuk						: payungKuningBahanTumpuk,
							beratSisaSemalamTumpuk						: beratSisaSemalamTumpuk,
							bobinSisaSemalamTumpuk						: bobinSisaSemalamTumpuk,
							payungSisaSemalamTumpuk						: payungSisaSemalamTumpuk,
							payungKuningSisaSemalamTumpuk			: payungKuningSisaSemalamTumpuk,
							beratPengambilanTumpuk						: beratPengambilanTumpuk,
							bobinPengambilanTumpuk						: bobinPengambilanTumpuk,
							payungPengambilanTumpuk						: payungPengambilanTumpuk,
							payungKuningPengambilanTumpuk			: payungKuningPengambilanTumpuk,
							sisaTumpuk												: sisaTumpuk,
							bobinSisaTumpuk										: bobinSisaTumpuk,
							payungSisaTumpuk									: payungSisaTumpuk,
							payungKuningSisaTumpuk						: payungKuningSisaTumpuk,
							jnsRollPipa												: jnsRollPipa,
							rollPayung												: rollPayung,
							rollPayungKuning									: rollPayungKuning,
							rollBobin													: rollBobin
						},
						success : function(response){
							// console.log(response);
							if($.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Ubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#modalEditHasilCutting").modal("hide");
									$(".active a").trigger("click");
								},2000);
							}else if($.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Ubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if($.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal, Bulan Ini Sudah Dikunci!");
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

			function editPengambilanPotong(param, param2){
				var idTransaksi1 = param;
				var tglSisa1 = $("#txtTglPengambilan_Edit").val();
				var tglPotong1 = $("#txtTglPotong_Edit").val();
				var textKode= $("#cmbKdCutting_Edit").val();
				var berat1 = $("#txtBeratPengambilan_Edit").val().replace(/,/g, "");
				var payung1 = $("#txtPayung_Edit").val().replace(/,/g, "");
				var payungKuning1 = $("#txtPayungKuning_Edit").val().replace(/,/g,"");
				var bobin1 = $("#txtJumlahBobin_Edit").val().replace(/,/g, "");
				var keteranganWaktu1 = $("#cmbKetarangan_Edit").val();
				var doubleSingle1 = $("#txtDoubleSingle_Edit").val().replace(/,/g, "");

				if(textKode == "" || textKode == null){
					var kdCutting1 = "";
					var kdGdRoll1 = "";
					var ukuran1 = "";
					var panjangPlastik1 = "";
					var merek1 = "";
					var warnaPlastik1 = "";
					var jnsPermintaan1 = "";
				}else{
					arrKode = textKode.split("#");
					dataText = $("#cmbKdCutting_Edit").select2("data")[0]["text"];
					arrDataText = dataText.split(" | ");
					var kdCutting1 = arrKode[0];
					var kdGdRoll1 = arrKode[1];
					var ukuran1 = arrDataText[1];
					var panjangPlastik1 = arrDataText[1];
					var merek1 = arrDataText[3];
					var warnaPlastik1 = arrDataText[4];
					var jnsPermintaan1 = arrDataText[6];
				}
				if(idTransaksi1 == "" || tglSisa1 == "" || tglPotong1 == "" ||
					 berat1 == "" || payung1 == "" || payungKuning1 == "" ||
					 bobin1 == "" || keteranganWaktu1 == "" || doubleSingle1==""
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
						url : "<?php echo base_url('_cutting/main/editPengambilanPotong'); ?>",
						dataType : "TEXT",
						data : {
							idTransaksi 			: idTransaksi1,
							bagian						: param2,
							tglSisa 					: tglSisa1,
							tglPotong 				: tglPotong1,
							berat 						: berat1,
							payung 						: payung1,
							payungKuning 			: payungKuning1,
							bobin 						: bobin1,
							keteranganWaktu 	: keteranganWaktu1,
							kdCutting 				: kdCutting1,
							kdGdRoll 					: kdGdRoll1,
							ukuran 						: ukuran1,
							panjangPlastik 		: panjangPlastik1,
							merek 						: merek1,
							warnaPlastik 			: warnaPlastik1,
							jnsPermintaan 		: jnsPermintaan1,
							doubleSingle			: doubleSingle1
						},
						success : function(response){
							if($.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
			 					$("#modalNotifContent").text("Data Berhasil Di Ubah");
			 					$("#modal-notif").modal("show");
			 					setTimeout(function(){
			 						$("#modal-notif").modal("hide");
			 						$("#modal-notif").removeClass("modal-info");
			 						$("#modalNotifContent").text("");
			 					},2000);
							}else if($.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
			 					$("#modalNotifContent").text("Data Gagal Di Ubah!");
			 					$("#modal-notif").modal("show");
			 					setTimeout(function(){
			 						$("#modal-notif").modal("hide");
			 						$("#modal-notif").removeClass("modal-danger");
			 						$("#modalNotifContent").text("");
			 					},2000);
							}else if($.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal, Bulan Ini Sudah Dikunci!");
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

			function editStatusPrint(param,param2, param3,param4, param5, param6){
				if(param=="" || param2==""){
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
						url : "<?php echo base_url('_cutting/main/editStatusPrint'); ?>",
						dataType : "TEXT",
						data : {
							kdPotong : param3,
							stsPrint : param4
						},
						success : function(response){
							if($.trim(response) === "Berhasil"){
								window.open("<?php echo base_url(); ?>_cutting/main/printRencanaMandorPotong/"+param+"/"+param2,"_blank");
								datatablesRencanaMandorPotong(param2);
							}else{
								$("#modal-notif").addClass("modal-danger");
			 					$("#modalNotifContent").text("Data Gagal Di Print!");
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

			function editHistorySisa(param){
				var idTransaksi1 = param;
				var berat1 = $("#txtJumlahSisaPOLOS_Edit").val().replace(/,/g, "");
				var payung1 = $("#txtJumlahPayungPOLOS_Edit").val().replace(/,/g, "");
				var payungKuning1 = $("#txtJumlahPayungKuningPOLOS_Edit").val().replace(/,/g, "");
				var bobin1 = $("#txtJumlahBobinPOLOS_Edit").val().replace(/,/g, "");
				var doubleSingle1 = $("#txtJumlahDoubleSinglePOLOS_Edit").val().replace(/,/g, "");

				if(idTransaksi1=="" || berat1=="" || payung1=="" ||
					 payungKuning1=="" || bobin1=="" || doubleSingle1 == ""
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
						 url : "<?php echo base_url('_cutting/main/editHistorySisa'); ?>",
						 dataType : "TEXT",
						 data : {
							 idTransaksi 		: idTransaksi1,
							 berat 					: berat1,
							 payung 				: payung1,
							 payungKuning 	: payungKuning1,
							 bobin 					: bobin1,
							 doubleSingle 	: doubleSingle1
						 },
						 success : function(response){
							 if($.trim(response) === "Berhasil"){
 								$("#modal-notif").addClass("modal-info");
 			 					$("#modalNotifContent").text("Data Berhasil Di Ubah");
 			 					$("#modal-notif").modal("show");
 			 					setTimeout(function(){
 			 						$("#modal-notif").modal("hide");
 			 						$("#modal-notif").removeClass("modal-info");
 			 						$("#modalNotifContent").text("");
									$(".active a").trigger("click");
 			 					},2000);
 							}else if($.trim(response) === "Gagal"){
 								$("#modal-notif").addClass("modal-danger");
 			 					$("#modalNotifContent").text("Data Gagal Di Ubah!");
 			 					$("#modal-notif").modal("show");
 			 					setTimeout(function(){
 			 						$("#modal-notif").modal("hide");
 			 						$("#modal-notif").removeClass("modal-danger");
 			 						$("#modalNotifContent").text("");
 			 					},2000);
 							}else if($.trim(response) === "Lock"){
 								$("#modal-notif").addClass("modal-danger");
 								$("#modalNotifContent").text("Gagal, Bulan Ini Sudah Dikunci!");
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

			function editHasilCuttingTemp(param){
				var ketBarang1 = $("#ketBarang").val().toUpperCase();
				var ketMerek1 = $("#ketMerek").val().toUpperCase();
				var idTransaksi1 = $("#idTransaksi").val();
				var validator = false;
				if(ketBarang1.indexOf("TUMPUK") != -1 || ketMerek1.indexOf("TUMPUK") != -1){
					var tglRencana1 = $("#txtTglPengerjaan").val();
					var merek1 = $("#txtMerek").val().toUpperCase();
					var jnsPermintaan1 = $("#txtPermintaan").val();
					var warnaPlastik1 = $("#txtWarnaPlastik").val();

					// var arrCustomer1 = $("input[name='txtCustomer']").serializeArray();
					var arrLembar1 = $("input[name='txtLembar']").serializeArray();
					var arrBerat1 = $("input[name='txtBerat']").serializeArray();
					// var arrTebal1 = $("input[name='txtTebal']").serializeArray();
					// var arrUkuran1 = $("input[name='txtUkuran']").serializeArray();
					// var arrJnsGudang1 = $("input[name='txtGudang']").serializeArray();
					// var arrStrip1 = $("input[name='txtStrip']").serializeArray();
					// var arrNoMesin1 = $("input[name='txtNoMesin']").serializeArray();
					var arrKdCutting1 = $("input[name='txtKdCutting']").serializeArray();
					var arrKdGdHasil1 = $("input[name='txtKdGdHasil']").serializeArray();
					var arrKdGdRoll1 = $("input[name='txtKdGdRoll']").serializeArray();

					var beratBagian1 = $("#txtBahan").val().replace(/,/g,"");
					var bobinBagian1 = $("#txtBobin").val().replace(/,/g,"");
					var payungBagian1 = $("#txtPayung").val().replace(/,/g,"");
					var payungKuningBagian1 = $("#txtPayungKuning").val().replace(/,/g,"");
					var beratBagianTumpuk1 = $("#txtBahanTumpuk").val().replace(/,/g,"");
					var bobinBagianTumpuk1 = $("#txtBobinTumpuk").val().replace(/,/g,"");
					var payungBagianTumpuk1 = $("#txtPayungTumpuk").val().replace(/,/g,"");
					var payungKuningBagianTumpuk1 = $("#txtPayungKuningTumpuk").val().replace(/,/g,"");

					var beratSisaSemalam1 = $("#txtBeratSisaSemalam").val().replace(/,/g,"");
					var bobinSisaSemalam1 = $("#txtBobinSisaSemalam").val().replace(/,/g,"");
					var payungSisaSemalam1 = $("#txtPayungSisaSemalam").val().replace(/,/g,"");
					var payungKuningSisaSemalam1 = $("#txtPayungKuningSisaSemalam").val().replace(/,/g,"");
					var beratSisaSemalamTumpuk1 = $("#txtBeratSisaSemalamTumpuk").val().replace(/,/g,"");
					var bobinSisaSemalamTumpuk1 = $("#txtBobinSisaSemalamTumpuk").val().replace(/,/g,"");
					var payungSisaSemalamTumpuk1 = $("#txtPayungSisaSemalamTumpuk").val().replace(/,/g,"");
					var payungKuningSisaSemalamTumpuk1 = $("#txtPayungKuningSisaSemalamTumpuk").val().replace(/,/g,"");

					var beratPengambilan1 = $("#txtBeratPengambilan").val().replace(/,/g,"");
					var bobinPengambilan1 = $("#txtBobinPengambilan").val().replace(/,/g,"");
					var payungPengambilan1 = $("#txtPayungPengambilan").val().replace(/,/g,"");
					var payungKuningPengambilan1 = $("#txtPayungKuningPengambilan").val().replace(/,/g,"");
					var beratPengambilanTumpuk1 = $("#txtBeratPengambilanTumpuk").val().replace(/,/g,"");
					var bobinPengambilanTumpuk1 = $("#txtBobinPengambilanTumpuk").val().replace(/,/g,"");
					var payungPengambilanTumpuk1 = $("#txtPayungPengambilanTumpuk").val().replace(/,/g,"");
					var payungKuningPengambilanTumpuk1 = $("#txtPayungKuningPengambilanTumpuk").val().replace(/,/g,"");

					var beratSisaHariIni1 = $("#txtSisa").val().replace(/,/g,"");
					var bobinSisaHariIni1 = $("#txtSisaBobin").val().replace(/,/g,"");
					var payungSisaHariIni1 = $("#txtSisaPayung").val().replace(/,/g,"");
					var payungKuningSisaHariIni1 = $("#txtSisaPayungKuning").val().replace(/,/g,"");
					var beratSisaHariIniTumpuk1 = $("#txtSisaTumpuk").val().replace(/,/g,"");
					var bobinSisaHariIniTumpuk1 = $("#txtSisaBobinTumpuk").val().replace(/,/g,"");
					var payungSisaHariIniTumpuk1 = $("#txtSisaPayungTumpuk").val().replace(/,/g,"");
					var payungKuningSisaHariIniTumpuk1 = $("#txtSisaPayungKuningTumpuk").val().replace(/,/g,"");

					var hasilLembar1 = $("#txtHasilLembar").val().replace(/,/g,"");
					var hasilBeratBersih1 = $("#txtHasilBeratBersih").val().replace(/,/g,"");
					var hasilBeratKotor1 = $("#txtHasilBeratKotor").val().replace(/,/g,"");
					var beratApal1 = $("#txtJumlahApal").val().replace(/,/g,"");
					var jnsRollPipa1 = $("#cmbRollPipa").val().replace(/,/g,"");
					var shift1 = $("#cmbShift").val().replace(/,/g,"");
					var keterangan1 = $("#txtKetarangan").val().replace(/,/g,"");
					var rollPipa1 = $("#txtJumlahRollPipa").val().replace(/,/g,"");
					var plusMinus1 = $("#txtPlusMinus").val().replace(/,/g,"");
					var kdGdRollTumpuk1 = $("#cmbUkuranTumpuk").val();

					switch (jnsRollPipa1) {
						case "PAYUNG"								: var payung1 = $("#txtJumlahPayung").val().replace(/,/g, "");
													 								var payungKuning1 = "0";
													 								var bobin1 = "0";
													 								break;
						case "PAYUNG_KUNING" 				: var payung1 = "0";
													 				 				var payungKuning1 = $("#txtJumlahPayung").val().replace(/,/g, "");
													 				 				var bobin1 = "0";
													 				 				break;
						case "PAYUNG_KUNING_PAYUNG" : var payung1 = $("#txtJumlahPayung_PKP").val().replace(/,/g, "");
													 				 				var payungKuning1 = $("#txtJumlahPayungKuning_PKP").val().replace(/,/g, "");
													 				 				var bobin1 = "0";
													 				 				break;
						case "BOBIN" 								: var payung1 = "0";
													 								var payungKuning1 = "0"
													 								var bobin1 = $("#txtBanyaknyaPipa").val().replace(/,/g, "");
													 								break;
						case "BOBIN_PAYUNG" 				: var payung1 = $("#txtJumlahBobinPayung_Payung").val().replace(/,/g, "");
													 								var payungKuning1 = "0";
													 								var bobin1 = $("#txtJumlahBobinPayung_Bobin").val().replace(/,/g, "");
													 								break;
						case "BOBIN_PAYUNG_KUNING" 	: var payung1 = "0";
													 							 	var payungKuning1 = $("#txtJumlahBobinPayung_Payung").val().replace(/,/g, "");
													 						 	 	var bobin1 = $("#txtJumlahBobinPayung_Bobin").val().replace(/,/g, "");
													 						 	 	break;
						default											: var payung1 = "0";
										 											var payungKuning1 = "0";
										 											var bobin1 = "0";
										 											break;

					}

					if(tglRencana1 == "" 						 || merek1 == "" 									|| jnsPermintaan1 == "" 					|| warnaPlastik1 == "" 									||
						 beratBagian1 == "" 					 || bobinBagian1 == "" 						|| payungBagian1 == "" 						|| payungKuningBagian1 == "" 						||
						 beratBagianTumpuk1 == "" 		 || bobinBagianTumpuk1 == "" 			|| payungBagianTumpuk1 == "" 			|| payungKuningBagianTumpuk1 == "" 			||
						 beratSisaSemalam1 == "" 			 || bobinSisaSemalam1 == "" 			|| payungSisaSemalam1 == "" 			|| payungKuningSisaSemalam1 == "" 			||
						 beratSisaSemalamTumpuk1 == "" || bobinSisaSemalamTumpuk1 == "" || payungSisaSemalamTumpuk1 == "" || payungKuningSisaSemalamTumpuk1 == "" ||
						 beratPengambilan1 == "" 			 || bobinPengambilan1 == "" 			|| payungPengambilan1 == "" 			|| payungKuningPengambilan1 == "" 			||
						 beratPengambilanTumpuk1 == "" || bobinPengambilanTumpuk1 == "" || payungPengambilanTumpuk1 == "" || payungKuningPengambilanTumpuk1 == "" ||
						 beratSisaHariIni1 == "" 			 || bobinSisaHariIni1 == "" 			|| payungSisaHariIni1 == "" 			|| payungKuningSisaHariIni1 == "" 			||
						 beratSisaHariIniTumpuk1 == "" || bobinSisaHariIniTumpuk1 == "" || payungSisaHariIniTumpuk1 == "" || payungKuningSisaHariIniTumpuk1 == "" ||
						 hasilLembar1 == "" 					 || hasilBeratBersih1 == "" 			|| hasilBeratKotor1 == "" 				|| beratApal1 == "" 										||
						 jnsRollPipa1 == "" 					 || shift1 == "" 									|| keterangan1 == "" 							|| rollPipa1 == "" 											||
						 plusMinus1 == "" 						 || kdGdRollTumpuk1 == "" 				|| arrLembar1.length <= 0 				|| arrBerat1.length <= 0 				 				||
	 					 arrKdCutting1.length <= 0 		 || arrKdGdHasil1.length <= 0 		|| arrKdGdRoll1.length <= 0
					  ){
						 if(payung1=="" || payungKuning1=="" || bobin1==""){
							 validator = false;
						 }else{
							 validator = false;
						 }
					 }else{
						 var data = {
							 	idTransaksiTSHP								: param,
							 	idTransaksi										: idTransaksi1,
							 	ketBarang											: ketBarang1,
			 			 		ketMerek											: ketMerek1,
			 		 			tglRencana										: tglRencana1,
			 	 				merek													: merek1,
			 					jnsPermintaan									: jnsPermintaan1,
			 					warnaPlastik									: warnaPlastik1,
			 				// 	arrCustomer										: arrCustomer1,
			 					arrLembar											: arrLembar1,
			 					arrBerat											: arrBerat1,
			 				// 	arrTebal											: arrTebal1,
			 				// 	arrUkuran											: arrUkuran1,
			 				// 	arrJnsGudang									: arrJnsGudang1,
			 				// 	arrStrip											: arrStrip1,
			 				// 	arrNoMesin										: arrNoMesin1,
			 					arrKdCutting									: arrKdCutting1,
			 					arrKdGdHasil									: arrKdGdHasil1,
			 					arrKdGdRoll										: arrKdGdRoll1,
			 					beratBagian										: beratBagian1,
			 					bobinBagian										: bobinBagian1,
			 					payungBagian									: payungBagian1,
			 					payungKuningBagian						: payungKuningBagian1,
			 					beratBagianTumpuk							: beratBagianTumpuk1,
			 					bobinBagianTumpuk							: bobinBagianTumpuk1,
			 					payungBagianTumpuk						: payungBagianTumpuk1,
			 					payungKuningBagianTumpuk			: payungKuningBagianTumpuk1,
			 					beratSisaSemalam							: beratSisaSemalam1,
			 					bobinSisaSemalam							: bobinSisaSemalam1,
			 					payungSisaSemalam							: payungSisaSemalam1,
			 					payungKuningSisaSemalam				: payungKuningSisaSemalam1,
			 					beratSisaSemalamTumpuk				: beratSisaSemalamTumpuk1,
			 					bobinSisaSemalamTumpuk				: bobinSisaSemalamTumpuk1,
			 					payungSisaSemalamTumpuk				: payungSisaSemalamTumpuk1,
			 					payungKuningSisaSemalamTumpuk	: payungKuningSisaSemalamTumpuk1,
			 					beratPengambilan							: beratPengambilan1,
			 					bobinPengambilan							: bobinPengambilan1,
			 					payungPengambilan							: payungPengambilan1,
			 					payungKuningPengambilan				: payungKuningPengambilan1,
			 					beratPengambilanTumpuk				: beratPengambilanTumpuk1,
			 					bobinPengambilanTumpuk				: bobinPengambilanTumpuk1,
			 					payungPengambilanTumpuk				: payungPengambilanTumpuk1,
			 					payungKuningPengambilanTumpuk	: payungKuningPengambilanTumpuk1,
			 					beratSisaHariIni							: beratSisaHariIni1,
			 					bobinSisaHariIni							: bobinSisaHariIni1,
			 					payungSisaHariIni							: payungSisaHariIni1,
			 					payungKuningSisaHariIni				: payungKuningSisaHariIni1,
			 					beratSisaHariIniTumpuk				: beratSisaHariIniTumpuk1,
			 					bobinSisaHariIniTumpuk				: bobinSisaHariIniTumpuk1,
			 					payungSisaHariIniTumpuk				: payungSisaHariIniTumpuk1,
			 					payungKuningSisaHariIniTumpuk	: payungKuningSisaHariIniTumpuk1,
			 					hasilLembar										: hasilLembar1,
			 					hasilBeratBersih							: hasilBeratBersih1,
			 					hasilBeratKotor								: hasilBeratKotor1,
			 					beratApal											: beratApal1,
			 					jnsRollPipa										: jnsRollPipa1,
								payung												: payung1,
								payungKuning									: payungKuning1,
								bobin													: bobin1,
			 					shift													: shift1,
			 					keterangan										: keterangan1,
			 					rollPipa											: rollPipa1,
			 					plusMinus											: plusMinus1,
			 					kdGdRollTumpuk								: kdGdRollTumpuk1,
						 }
						 validator = true;
					 }
				}else{
					var tglRencana1 = $("#txtTglPengerjaan").val();
					var merek1 = $("#txtMerek").val().toUpperCase();
					var jnsPermintaan1 = $("#txtPermintaan").val();
					var warnaPlastik1 = $("#txtWarnaPlastik").val();

					// var arrCustomer1 = $("input[name='txtCustomer']").serializeArray();
					var arrLembar1 = $("input[name='txtLembar']").serializeArray();
					var arrBerat1 = $("input[name='txtBerat']").serializeArray();
					// var arrTebal1 = $("input[name='txtTebal']").serializeArray();
					// var arrUkuran1 = $("input[name='txtUkuran']").serializeArray();
					// var arrJnsGudang1 = $("input[name='txtGudang']").serializeArray();
					// var arrStrip1 = $("input[name='txtStrip']").serializeArray();
					// var arrNoMesin1 = $("input[name='txtNoMesin']").serializeArray();
					var arrKdCutting1 = $("input[name='txtKdCutting']").serializeArray();
					var arrKdGdHasil1 = $("input[name='txtKdGdHasil']").serializeArray();
					var arrKdGdRoll1 = $("input[name='txtKdGdRoll']").serializeArray();

					var beratBagian1 = $("#txtBahan").val().replace(/,/g,"");
					var bobinBagian1 = $("#txtBobin").val().replace(/,/g,"");
					var payungBagian1 = $("#txtPayung").val().replace(/,/g,"");
					var payungKuningBagian1 = $("#txtPayungKuning").val().replace(/,/g,"");
					var beratBagianTumpuk1 = "0";
					var bobinBagianTumpuk1 = "0";
					var payungBagianTumpuk1 = "0";
					var payungKuningBagianTumpuk1 = "0";

					var beratSisaSemalam1 = $("#txtBeratSisaSemalam").val().replace(/,/g,"");
					var bobinSisaSemalam1 = $("#txtBobinSisaSemalam").val().replace(/,/g,"");
					var payungSisaSemalam1 = $("#txtPayungSisaSemalam").val().replace(/,/g,"");
					var payungKuningSisaSemalam1 = $("#txtPayungKuningSisaSemalam").val().replace(/,/g,"");
					var beratSisaSemalamTumpuk1 = "0";
					var bobinSisaSemalamTumpuk1 = "0";
					var payungSisaSemalamTumpuk1 = "0";
					var payungKuningSisaSemalamTumpuk1 = "0";

					var beratPengambilan1 = $("#txtBeratPengambilan").val().replace(/,/g,"");
					var bobinPengambilan1 = $("#txtBobinPengambilan").val().replace(/,/g,"");
					var payungPengambilan1 = $("#txtPayungPengambilan").val().replace(/,/g,"");
					var payungKuningPengambilan1 = $("#txtPayungKuningPengambilan").val().replace(/,/g,"");
					var beratPengambilanTumpuk1 = "0";
					var bobinPengambilanTumpuk1 = "0";
					var payungPengambilanTumpuk1 = "0";
					var payungKuningPengambilanTumpuk1 = "0";

					var beratSisaHariIni1 = $("#txtSisa").val().replace(/,/g,"");
					var bobinSisaHariIni1 = $("#txtSisaBobin").val().replace(/,/g,"");
					var payungSisaHariIni1 = $("#txtSisaPayung").val().replace(/,/g,"");
					var payungKuningSisaHariIni1 = $("#txtSisaPayungKuning").val().replace(/,/g,"");
					var beratSisaHariIniTumpuk1 = "0";
					var bobinSisaHariIniTumpuk1 = "0";
					var payungSisaHariIniTumpuk1 = "0";
					var payungKuningSisaHariIniTumpuk1 = "0";

					var hasilLembar1 = $("#txtHasilLembar").val().replace(/,/g,"");
					var hasilBeratBersih1 = $("#txtHasilBeratBersih").val().replace(/,/g,"");
					var hasilBeratKotor1 = $("#txtHasilBeratKotor").val().replace(/,/g,"");
					var beratApal1 = $("#txtJumlahApal").val().replace(/,/g,"");
					var jnsRollPipa1 = $("#cmbRollPipa").val().replace(/,/g,"");
					var shift1 = $("#cmbShift").val().replace(/,/g,"");
					var keterangan1 = $("#txtKetarangan").val().replace(/,/g,"");
					var rollPipa1 = $("#txtJumlahRollPipa").val().replace(/,/g,"");
					var plusMinus1 = $("#txtPlusMinus").val().replace(/,/g,"");
					var kdGdRollTumpuk1 = "0";

					switch (jnsRollPipa1) {
						case "PAYUNG"								: var payung1 = $("#txtJumlahPayung").val().replace(/,/g, "");
													 								var payungKuning1 = "0";
													 								var bobin1 = "0";
													 								break;
						case "PAYUNG_KUNING" 				: var payung1 = "0";
													 				 				var payungKuning1 = $("#txtJumlahPayung").val().replace(/,/g, "");
													 				 				var bobin1 = "0";
													 				 				break;
						case "PAYUNG_KUNING_PAYUNG" : var payung1 = $("#txtJumlahPayung_PKP").val().replace(/,/g, "");
													 				 				var payungKuning1 = $("#txtJumlahPayungKuning_PKP").val().replace(/,/g, "");
													 				 				var bobin1 = "0";
													 				 				break;
						case "BOBIN" 								: var payung1 = "0";
													 								var payungKuning1 = "0"
													 								var bobin1 = $("#txtBanyaknyaPipa").val().replace(/,/g, "");
													 								break;
						case "BOBIN_PAYUNG" 				: var payung1 = $("#txtJumlahBobinPayung_Payung").val().replace(/,/g, "");
													 								var payungKuning1 = "0";
													 								var bobin1 = $("#txtJumlahBobinPayung_Bobin").val().replace(/,/g, "");
													 								break;
						case "BOBIN_PAYUNG_KUNING" 	: var payung1 = "0";
													 							 	var payungKuning1 = $("#txtJumlahBobinPayung_Payung").val().replace(/,/g, "");
													 						 	 	var bobin1 = $("#txtJumlahBobinPayung_Bobin").val().replace(/,/g, "");
													 						 	 	break;
						default											: var payung1 = "0";
										 											var payungKuning1 = "0";
										 											var bobin1 = "0";
										 											break;

					}

					if(tglRencana1 == "" 						 || merek1 == "" 									|| jnsPermintaan1 == "" 					|| warnaPlastik1 == "" 									||
						 beratBagian1 == "" 					 || bobinBagian1 == "" 						|| payungBagian1 == "" 						|| payungKuningBagian1 == "" 						||
						 beratBagianTumpuk1 == "" 		 || bobinBagianTumpuk1 == "" 			|| payungBagianTumpuk1 == "" 			|| payungKuningBagianTumpuk1 == "" 			||
						 beratSisaSemalam1 == "" 			 || bobinSisaSemalam1 == "" 			|| payungSisaSemalam1 == "" 			|| payungKuningSisaSemalam1 == "" 			||
						 beratSisaSemalamTumpuk1 == "" || bobinSisaSemalamTumpuk1 == "" || payungSisaSemalamTumpuk1 == "" || payungKuningSisaSemalamTumpuk1 == "" ||
						 beratPengambilan1 == "" 			 || bobinPengambilan1 == "" 			|| payungPengambilan1 == "" 			|| payungKuningPengambilan1 == "" 			||
						 beratPengambilanTumpuk1 == "" || bobinPengambilanTumpuk1 == "" || payungPengambilanTumpuk1 == "" || payungKuningPengambilanTumpuk1 == "" ||
						 beratSisaHariIni1 == "" 			 || bobinSisaHariIni1 == "" 			|| payungSisaHariIni1 == "" 			|| payungKuningSisaHariIni1 == "" 			||
						 beratSisaHariIniTumpuk1 == "" || bobinSisaHariIniTumpuk1 == "" || payungSisaHariIniTumpuk1 == "" || payungKuningSisaHariIniTumpuk1 == "" ||
						 hasilLembar1 == "" 					 || hasilBeratBersih1 == "" 			|| hasilBeratKotor1 == "" 				|| beratApal1 == "" 										||
						 jnsRollPipa1 == "" 					 || shift1 == "" 									|| keterangan1 == "" 							|| rollPipa1 == "" 											||
						 plusMinus1 == "" 						 || kdGdRollTumpuk1 == "" 				|| arrLembar1.length <= 0 				|| arrBerat1.length <= 0 				 				||
	 					 arrKdCutting1.length <= 0 		 || arrKdGdHasil1.length <= 0 		|| arrKdGdRoll1.length <= 0
					 ){
						 if(payung1=="" || payungKuning1=="" || bobin1==""){
							 validator = false;
						 }else{
							 validator = false;
						 }
					 }else{
						 var data = {
							 	idTransaksiTSHP								: param,
							 	idTransaksi										: idTransaksi1,
							 	ketBarang											: ketBarang1,
			 			 		ketMerek											: ketMerek1,
			 		 			tglRencana										: tglRencana1,
			 	 				merek													: merek1,
			 					jnsPermintaan									: jnsPermintaan1,
			 					warnaPlastik									: warnaPlastik1,
			 				// 	arrCustomer										: arrCustomer1,
			 					arrLembar											: arrLembar1,
			 					arrBerat											: arrBerat1,
			 				// 	arrTebal											: arrTebal1,
			 				// 	arrUkuran											: arrUkuran1,
			 				// 	arrJnsGudang									: arrJnsGudang1,
			 				// 	arrStrip											: arrStrip1,
			 				// 	arrNoMesin										: arrNoMesin1,
			 					arrKdCutting									: arrKdCutting1,
			 					arrKdGdHasil									: arrKdGdHasil1,
			 					arrKdGdRoll										: arrKdGdRoll1,
			 					beratBagian										: beratBagian1,
			 					bobinBagian										: bobinBagian1,
			 					payungBagian									: payungBagian1,
			 					payungKuningBagian						: payungKuningBagian1,
			 					beratBagianTumpuk							: beratBagianTumpuk1,
			 					bobinBagianTumpuk							: bobinBagianTumpuk1,
			 					payungBagianTumpuk						: payungBagianTumpuk1,
			 					payungKuningBagianTumpuk			: payungKuningBagianTumpuk1,
			 					beratSisaSemalam							: beratSisaSemalam1,
			 					bobinSisaSemalam							: bobinSisaSemalam1,
			 					payungSisaSemalam							: payungSisaSemalam1,
			 					payungKuningSisaSemalam				: payungKuningSisaSemalam1,
			 					beratSisaSemalamTumpuk				: beratSisaSemalamTumpuk1,
			 					bobinSisaSemalamTumpuk				: bobinSisaSemalamTumpuk1,
			 					payungSisaSemalamTumpuk				: payungSisaSemalamTumpuk1,
			 					payungKuningSisaSemalamTumpuk	: payungKuningSisaSemalamTumpuk1,
			 					beratPengambilan							: beratPengambilan1,
			 					bobinPengambilan							: bobinPengambilan1,
			 					payungPengambilan							: payungPengambilan1,
			 					payungKuningPengambilan				: payungKuningPengambilan1,
			 					beratPengambilanTumpuk				: beratPengambilanTumpuk1,
			 					bobinPengambilanTumpuk				: bobinPengambilanTumpuk1,
			 					payungPengambilanTumpuk				: payungPengambilanTumpuk1,
			 					payungKuningPengambilanTumpuk	: payungKuningPengambilanTumpuk1,
			 					beratSisaHariIni							: beratSisaHariIni1,
			 					bobinSisaHariIni							: bobinSisaHariIni1,
			 					payungSisaHariIni							: payungSisaHariIni1,
			 					payungKuningSisaHariIni				: payungKuningSisaHariIni1,
			 					beratSisaHariIniTumpuk				: beratSisaHariIniTumpuk1,
			 					bobinSisaHariIniTumpuk				: bobinSisaHariIniTumpuk1,
			 					payungSisaHariIniTumpuk				: payungSisaHariIniTumpuk1,
			 					payungKuningSisaHariIniTumpuk	: payungKuningSisaHariIniTumpuk1,
			 					hasilLembar										: hasilLembar1,
			 					hasilBeratBersih							: hasilBeratBersih1,
			 					hasilBeratKotor								: hasilBeratKotor1,
			 					beratApal											: beratApal1,
			 					jnsRollPipa										: jnsRollPipa1,
								payung												: payung1,
								payungKuning									: payungKuning1,
								bobin													: bobin1,
			 					shift													: shift1,
			 					keterangan										: keterangan1,
			 					rollPipa											: rollPipa1,
			 					plusMinus											: plusMinus1,
			 					kdGdRollTumpuk								: kdGdRollTumpuk1,
						 }
						 validator = true;
					 }
				}
				if(validator){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_cutting/main/editHasilPotongTemp'); ?>",
						dataType : "TEXT",
						data : data,
						success : function(response){
							if($.trim(response) === "Berhasil"){
							 $("#modal-notif").addClass("modal-info");
							 $("#modalNotifContent").text("Data Berhasil Di Ubah");
							 $("#modal-notif").modal("show");
							 setTimeout(function(){
								 $("#modal-notif").modal("hide");
								 $("#modal-notif").removeClass("modal-info");
								 $("#modalNotifContent").text("");
								 $(".active a").trigger("click");
								 $("input").val("");
								 $("#cmbRollPipa").val("").trigger("change");
								 $("#cmbShift").val("").trigger("change");
								 $("#cmbUkuranTumpuk").val("").trigger("change");
								 $("#modalInputHasil").modal("hide");
							 },2000);
						 }else if($.trim(response) === "Gagal"){
							 $("#modal-notif").addClass("modal-danger");
							 $("#modalNotifContent").text("Data Gagal Di Ubah!");
							 $("#modal-notif").modal("show");
							 setTimeout(function(){
								 $("#modal-notif").modal("hide");
								 $("#modal-notif").removeClass("modal-danger");
								 $("#modalNotifContent").text("");
							 },2000);
						 }else if($.trim(response) === "Lock"){
							 $("#modal-notif").addClass("modal-danger");
							 $("#modalNotifContent").text("Gagal, Bulan Ini Sudah Dikunci!");
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

			function editRencana(param){
				var kdPpic = $("#txtKdPPIC_Edit").val();
				var tglRencana = $("#txtTglRencana_Edit").val();
				var noMesin = $("#txtNoMesin_Edit1").val();
				var jumlahMesin = $("#txtJumlahMesin_Edit").val();
				var kdGdHasil = $("#cmbKdHasil_Edit").val();
				var kdGdRoll = $("#cmbKdBahan_Edit").val();
				var nmCust = $("#txtNamaCustomer_Edit").val();
				var tebal = $("#txtTebalPlastik_Edit").val();
				var ketMerek = $("#txtKeteranganMerek_Edit").val();
				var jumlahPermintaan = $("#txtJumlahPermintaan_Edit").val().replace(/,/g,"");
				var satuan = $("#cmbSatuan_Edit").val();
				var shift = $("#cmbShiftRencana_Edit").val();
				var beratRencana = $("#txtBeratRencana_Edit").val();
				var keterangan = $("#txtKeterangan_Edit").val();
				if($("#cmbWarnaStrip_Edit").val()=="CUSTOM"){
					var warnaStrip = $("#txtWarnaStrip_Edit").val();
				}else{
					var warnaStrip = $("#cmbWarnaStrip_Edit").val();
				}

				if(tglRencana==""||noMesin==""||jumlahMesin==""||nmCust==""||
					 tebal==""||jumlahPermintaan==""||satuan==""||shift==""||warnaStrip==""
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
						 url : "<?php echo base_url('_cutting/main/editRencana'); ?>",
						 dataType : "TEXT",
						 data : {
							 kdPpic						: kdPpic,
							 kdPotong					: param,
							 tglRencana				: tglRencana,
							 noMesin					: noMesin,
							 jumlahMesin			: jumlahMesin,
							 kdGdHasil				: kdGdHasil,
							 kdGdRoll					: kdGdRoll,
							 nmCust						: nmCust,
							 tebal						: tebal,
							 ketMerek					: ketMerek,
							 jumlahPermintaan	: jumlahPermintaan,
							 satuan						: satuan,
							 shift						: shift,
							 beratRencana			: beratRencana,
							 keterangan				: keterangan,
							 warnaStrip				: warnaStrip
						 },
						 success : function(response){
							 if($.trim(response) === "Berhasil"){
								 $("#modal-notif").addClass("modal-info");
								 $("#modalNotifContent").text("Data Berhasil Di Ubah");
								 $("#modal-notif").modal("show");
								 setTimeout(function(){
									 $("#modal-notif").modal("hide");
									 $("#modal-notif").removeClass("modal-info");
									 $("#modalNotifContent").text("");
									 $("#modalEditRencana").modal("hide");
									 $(".active a[aria-controls='tableDataRencanaMandor']").trigger("click");
								 },2000);
							 }else if($.trim(response) === "Gagal"){
								 $("#modal-notif").addClass("modal-danger");
								 $("#modalNotifContent").text("Data Berhasil Di Ubah");
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
			//============================================EDIT METHOD (Finish)============================================//

			//============================================DELETE METHOD (Start)============================================//
			function deleteAndRestoreRencanaPotongPending(param,param2){
				if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_cutting/main/deleteAndRestoreRencanaPotongPending",
						dataType : "TEXT",
						data : {
							kdPotong : param,
							deleted : param2
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Hapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormBuatRencanaPending();
									tableRencanaPotongPending();
									tableRencanaMandoPotongSusulanPending();
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Hapus");
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

			function deleteAndRestoreRencanaMandor(param1, param2){
				if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_cutting/main/deleteAndRestoreRencanaMandor",
						dataType : "TEXT",
						data : {
							kdPotong : param1,
							deleted  : param2
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								if(param2 == "TRUE"){
									$("#modal-notif").addClass("modal-info");
									$("#modalNotifContent").text("Data Berhasil Di Hapus");
									$("#modal-notif").modal("show");
									setTimeout(function(){
										$("#modal-notif").modal("hide");
										$("#modal-notif").removeClass("modal-info");
										$("#modalNotifContent").text("");
										datatablesRencanaMandorPotong();
									},2000);
								}else{
									$("#modal-notif").addClass("modal-info");
									$("#modalNotifContent").text("Data Berhasil Di Kembalikan");
									$("#modal-notif").modal("show");
									setTimeout(function(){
										$("#modal-notif").modal("hide");
										$("#modal-notif").removeClass("modal-info");
										$("#modalNotifContent").text("");
										datatablesRencanaMandorPotong();
									},2000);
								}
							}else{
								if(param2 == "TRUE"){
									$("#modal-notif").addClass("modal-danger");
									$("#modalNotifContent").text("Data Gagal Di Hapus");
									$("#modal-notif").modal("show");
									setTimeout(function(){
										$("#modal-notif").modal("hide");
										$("#modal-notif").removeClass("modal-danger");
										$("#modalNotifContent").text("");
									},2000);
								}else{
									$("#modal-notif").addClass("modal-danger");
									$("#modalNotifContent").text("Data Gagal Di Kembalikan");
									$("#modal-notif").modal("show");
									setTimeout(function(){
										$("#modal-notif").modal("hide");
										$("#modal-notif").removeClass("modal-danger");
										$("#modalNotifContent").text("");
									},2000);
								}
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

			function deleteAndRestoreTambahBonApal(param, param2){
				if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_cutting/main/deleteAndRestoreTambahBonApal') ?>",
						dataType : "TEXT",
						data : {
							idTransaksi : param,
							deleted : param2
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Hapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#txtJumlahApal").val("");
									tableListDataBonApalPending();
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Hapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#txtJumlahApal").val("");
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

			function deleteAndRestorePengambilanPotong(param,param2){
				if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_cutting/main/deleteAndRestorePengambilanPotong'); ?>",
						dataType : "TEXT",
						data : {
							idTransaksi : param,
							deleted : param2
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Hapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#txtJumlahApal").val("");
									$(".active a").trigger("click");
								},2000);
							}else if($.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Hapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#txtJumlahApal").val("");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Kunci");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-warning");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#txtJumlahApal").val("");
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

			function deleteAndRestoreSisaPotong(param,param2){
				if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_cutting/main/deleteAndRestoreSisaPotong'); ?>",
						dataType : "TEXT",
						data : {
							idTransaksi : param,
							deleted : param2
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Di Hapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#txtJumlahApal").val("");
									$(".active a").trigger("click");
								},2000);
							}else if($.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Di Hapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#txtJumlahApal").val("");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Kunci");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-warning");
									$("#modalNotifContent").text("");
									$("#cmbJenisApal").val("");
									$("#txtJumlahApal").val("");
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
			function resetFormBuatRencanaPending(param1="", param2=""){
				$("input").val("");
				$(".date").datepicker("setDate",null);
				$("#cmbKdGdRoll").val("").trigger("change")
				$("#cmbWarnaStrip").val("").trigger("change");
				$("#cmbShift").val("");
				$("#btnTambahRencanaPotong").attr("onclick","saveTambahRencanaPotongPending('"+param1+"','"+param2+"')").html("<i class='fa fa-plus'></i> Tambah").removeClass("btn-warning").addClass("btn-primary");
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_cutting/main/getGeneratePotongCode",
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
			}

			function resetFormBuatRencanaKerjaSusulan(){
				$("input").val("");
				$("#cmbKdHasil").val("").trigger("change");
				$("#cmbKdBahan").val("").trigger("change");
				$("#cmbKdHasil").val("").trigger("select2:unselect");
				$("#cmbKdBahan").val("").trigger("select2:unselect");
				$("#cmbSatuan").val("");
				$("#cmbShiftRencana").val("");
				$("#cmbStrip").val("");
				$(".date").datepicker("setDate",null);
				$("#btnTambahRencanaSusulanPending").attr("onclick","saveTambahRencanaPotongSusulanPending()").html("<i class='fa fa-plus'></i> Tambah").removeClass("btn-warning").addClass("btn-primary");
				$.ajax({
					url : "<?php echo base_url(); ?>_cutting/main/getGeneratePotongCode",
					dataType : "JSON",
					success : function(response){
						$("#txtKodePotong").val(response.Code);
					},
					error : function(response){
						$("#modal-notif").addClass("modal-danger");
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

			function resetFormSisaPengambilan(param){
				$("input").val("");
				$("#cmbKeterangan"+param).val("").trigger("change");
				$("#cmbUkuranTumpuk"+param).val("").trigger("change");
				$("#cmbUkuran"+param).val("").trigger("change");
				$(".date").datepicker("setDate",null);

				$("#trUkuranTumpuk"+param).css("display","none");
				$("#trSisaTumpuk"+param).css("display","none");
				$("#trPayungTumpuk"+param).css("display","none");
				$("#trPayungKuningTumpuk"+param).css("display","none");
				$("#trBobinTumpuk"+param).css("display","none");
			}

			function resetTambahBonApalPending(param){
				$("select").val("");
				$("input").val("");
				$("#btnTambahApalGlobalPerJenis").removeClass("btn-warning").addClass("btn-primary").html("<i class='fa fa-plus'></i> Tambah").attr("onclick","saveTambahBonApal('"+param+"')");
			}
			//============================================RESET METHOD (Finish)============================================//

			//============================================RELOAD METHOD (Start)============================================//
			//============================================RELOAD METHOD (Finish)============================================//

			//============================================RESTORE METHOD (Start)============================================//
			//============================================RESTORE METHOD (Finish)============================================//

			//============================================SEARCH METHOD (Start)============================================//
			function searchRencanaPpicPotong(){
				var tglAwal = $("#txtTglAwal").val();
				// var tglAkhir = $("#txtTglAkhir").val();

				if(tglAwal==""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					datatablesRencanaPpicPotong(tglAwal);
					// $("#btnSaveRencanaPotong").attr("onclick","saveRencanaPotong('"+tglAwal+"','"+tglAkhir+"')");
					$("#modalCariRencanaKerja").modal("hide");
					$("#txtTglAwal").val("");
					$("#txtTglAkhir").val("");
					$(".date").datepicker("setDate",null);
				}
			}

			function searchRencanaMandorPotong(){
				var tglRencana = $("#txtTglCariRencana").val();
				if(tglRencana==""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					datatablesRencanaMandorPotong(tglRencana);
					$("#modalSearchRencanaKerja").modal("hide");
				}
			}

			function searchLaporanRencanaPpic(){
				var tglRencana = $("#txtTanggalCari").val();
				if(tglRencana == ""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					datatablesLaporanRencanaPpic(tglRencana);
					$("#modalSearchLaporanRencanaPPIC").modal("hide");
					$("#laporanRencanaPPIC").css("display","block");
				}
				$("input").val("");
				$(".date").datepicker("setDate",null);
			}

			function searchHasilCutting(){
				var shift1 = $("#cmbShift").val();
				var tanggal1 = $("#txtTanggal").val();

				if(shift1 == "" || tanggal1 == ""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					var arrBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
					var date = new Date(tanggal1);
					var tanggal = date.getDate();
					var bulan = date.getMonth();
					var tahun = date.getFullYear();
					var dateFormat = tanggal + " " + arrBulan[bulan] + " " + tahun;
					$("#lblTglJadi").text("Tanggal : " + dateFormat);
					datatablesHasilJobPotong(shift1, tanggal1);
					$("#btnCetakHasilCutting").css("display","inline-block");
					$("#laporanHasilCuttingWrapper").css("display","block");
					$("#modalCariHasilCutting").modal("hide");
					$("#btnCetakHasilCutting").attr("href","<?php echo base_url('_cutting/main/printHasilPotong'); ?>"+"/"+shift1+"/"+tanggal1);
				}
			}

			function searchListHistoryPpicExtruder(){
				var bulan = $("#cmbBulan").val();
				var tahun = $("#cmbTahun").val();

				if(bulan=="" || tahun==""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					datatablesListHistoryPpicExtruder(bulan, tahun);
				}
			}

			function searchListBonHasilJadi(){
				var jnsBrg1 = $("#cmbJenisGudang").val();
				var merek1 = $("#cmbMerek").val();
				var tglJadi1 = $("#txtTanggal").val();
				if(jnsBrg1=="" || merek1=="" || tglJadi1==""){
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
						url : "<?php echo base_url('_cutting/main/getListBonHasilJadi') ?>",
						dataType : "JSON",
						data : {
							jnsBrg	: jnsBrg1,
							merek		: merek1,
							tglJadi	: tglJadi1
						},
						success : function(response){
							$("#tableListBonHasilJadi > tbody > tr").empty();
							$.each(response, function(AvIndex, AvValue){
								$("#tableListBonHasilJadi > tbody:last-child").append(
									"<tr>"+
										"<td>"+AvValue.merek+"</td>"+
										"<td>"+AvValue.tebal+"</td>"+
										"<td>"+AvValue.ukuran+"</td>"+
										"<td>"+AvValue.warna_plastik+"</td>"+
										"<td>"+AvValue.jumlah_berat+"</td>"+
										"<td>"+AvValue.jumlah_lembar+"</td>"+
										"<td>"+AvValue.jns_brg+"</td>"+
										"<td>"+AvValue.customer+"</td>"+
									"</tr>"
								);
							});
							$("input").val("");
							$("select").val("");
							$(".date").datepicker("setDate",null);
							$("#modalCariBonHasil").modal("hide");
							$("#btnCetakBonHasilCutting").attr("href","<?php echo base_url('_cutting/main/printListBonHasilJadi'); ?>/"+jnsBrg1+"/"+merek1+"/"+tglJadi1);
							$("#boxBonHasilJadi").css("display","block");
						},
						error : function(response){
							$("#modal-notif").addClass("modal-danger");
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

			function searchListBonHasilJadiGlobal(param1="", param2=""){
				if(param1=="" || param2==""){
					var jnsBrg1 = $("#cmbJenisGudang").val();
					var tglJadi1 = $("#txtTanggal").val();
				}else{
					var jnsBrg1 = param1;
					var tglJadi1 = param2;
				}
				if(jnsBrg1=="" || tglJadi1==""){
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
						url : "<?php echo base_url('_cutting/main/getListBonHasilJadiGlobal') ?>",
						dataType : "JSON",
						data : {
							jnsBrg	: jnsBrg1,
							tglJadi	: tglJadi1
						},
						success : function(response){
							var counter = 0;
							$("#tableListBonHasilJadiGlobal > tbody > tr").empty();
							$.each(response, function(AvIndex, AvValue){
								$("#tableListBonHasilJadiGlobal > tbody:last-child").append(
									"<tr>"+
									"<td>"+AvValue.tebal+"</td>"+
									"<td>"+AvValue.ukuran+"</td>"+
									"<td>"+AvValue.merek+"</td>"+
										"<td>"+AvValue.warna_plastik+"</td>"+
										"<td>"+AvValue.jumlah_berat+"</td>"+
										"<td>"+AvValue.jumlah_lembar+"</td>"+
										"<td>"+AvValue.jns_brg+"</td>"+
										"<td>"+AvValue.customer+"</td>"+
										"<td>"+(AvValue.status_bon == 'FALSE' ? 'Belum Dikirim' : 'Sudah Dikirim')+"</td>"+
									"</tr>"
								);
								if(AvValue.status_bon == 'FALSE'){
									counter++;
								}
							});
							$("input").val("");
							$("select").val("");
							$(".date").datepicker("setDate",null);
							$("#modalCariBonHasilGlobal").modal("hide");
							$("#btnPrintBonHasilJadiGlobal").attr("href","<?php echo base_url('_cutting/main/printListBonHasilJadiGlobal'); ?>/"+jnsBrg1+"/"+tglJadi1);
							$("#boxBonHasilJadi").css("display","block");
							$("#boxBody").css("display","block");
							$("#boxFooter").css("display","block");
							$("#btnKirimBonHasilJadiGlobal").attr("onclick","saveKirimBonHasilJadiGlobal('"+jnsBrg1+"','"+tglJadi1+"')");
							if(counter <= 0){
								$("#btnKirimBonHasilJadiGlobal").attr("disabled","disabled");
							}else{
								$("#btnKirimBonHasilJadiGlobal").removeAttr("disabled");
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

			function searchPengambilanPotong(param){
				var tglAwal = $("#txtTglAwal").val();
				var tglAkhir = $("#txtTglAkhir").val();
				var bagian = param;
				if(bagian=="" || tglAwal=="" || tglAkhir==""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					tableDataPengambilan(bagian, tglAwal, tglAkhir);
					$("input").val("");
					$(".date").datepicker("setDate",null);
					$("#modalCariHistory").modal("hide");
				}
			}

			function searchHistorySisa(){
				var tglAwal = $("#txtTanggalAwal").val();
				var tglAkhir = $("#txtTanggalAkhir").val();
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
					datatablestableListHistorySisa(tglAwal, tglAkhir);
					$("#txtTanggalAwal").val("");
					$("#txtTanggalAkhir").val("");
					$(".date").datepicker("setDate",null);
					$("#modalCariHistoriSisa").modal("hide");
				}
			}

			function searchTambahHistoryTertinggal(param){
				if(param=="POLOS"){
					var tglAwal = $("#txtTglAwal_Polos").val();
					var tglAkhir = $("#txtTglAkhir_Polos").val();
				}else{
					var tglAwal = $("#txtTglAwal_Cetak").val();
					var tglAkhir = $("#txtTglAkhir_Cetak").val();
				}
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
					resetFormSisaPengambilan(param);
					$("#cmbUkuran"+param).select2({
						placeholder : "Pilih Ukuran Plastik",
						dropdownParent: $("#modalSisaPengambilan_"+param),
						width : "100%",
						cache:false,
						allowClear:true,
						ajax:{
							url : "<?php echo base_url(); ?>_cutting/main/getUkuranPengembalianPotongTertinggal/"+param+"/"+tglAwal+"/"+tglAkhir,
							dataType : "JSON",
							delay : 0,
							processResults : function(data){
								return{
									results : $.map(data, function(item){
										if(item.ket_barang.toUpperCase().indexOf("TUMPUK") == -1){
											return{
												text:item.customer+" | "+item.panjang+" | "+item.ket_barang+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana+" | "+item.jns_permintaan,
												id:item.kd_potong+"#"+item.kd_gd_roll
											}
										}else{
											return{
												text:item.customer+" | "+item.ukuran+" | "+item.ket_barang+" | "+item.merek+" | "+item.warna_plastik+" | "+item.tgl_rencana+" | "+item.jns_permintaan,
												id:item.kd_potong+"#"+item.kd_gd_roll
											}
										}
									})
								};
							}
						}
					});

					$("#cmbUkuran"+param).on("select2:select", function(){
						var dataText = $("#cmbUkuran"+param).select2("data")[0]["text"];
						var arrDataText = dataText.split(" | ");
						$("#txtPanjangPlastik"+param).val(arrDataText[1]);
						$("#txtMerek"+param).val(arrDataText[3]);
						$("#txtWarnaPlastik"+param).val(arrDataText[4]);
						$("#txtPermintaan"+param).val(arrDataText[6]);
						$("#txtKetBarang"+param).val(arrDataText[2]);
						if(arrDataText[2].toUpperCase().indexOf("TUMPUK") == -1){
							$("#trUkuranTumpuk"+param).css("display","none");
						}else{
							var arrJenisPermintaanTumpuk = arrDataText[6].split("/");
							if(arrDataText[1].toUpperCase().indexOf("/") == -1){
								var arrPanjangSecondary = arrDataText[1].toLowerCase().replace(/ /g,"").split("x");
							}else{
								var arrUkuran = arrDataText[1].replace(/ /g,"").split("/");
								var arrPanjangSecondary = arrUkuran[1].toLowerCase().split("x");
							}
							$("#cmbUkuranTumpuk"+param).select2({
								placeholder : "Pilih Roll ("+arrDataText[6]+")",
								dropdownParent: $("#modalSisaPengambilan_"+param),
								width : "100%",
								cache:false,
								allowClear:true,
								ajax:{
									url : "<?php echo base_url(); ?>_cutting/main/getComboBoxValueGudangRoll/"+arrJenisPermintaanTumpuk[1]+"/"+arrPanjangSecondary[0],
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
							$("#trUkuranTumpuk"+param).css("display","table-row");
						}
						var arrKode = $("#cmbUkuran"+param).val().split("#");
						$("#txtKdGdRoll"+param).val(arrKode[1]);
					});

					$("#cmbUkuranTumpuk"+param).on("select2:select", function(){
						$("#trSisaTumpuk"+param).css("display","table-row");
						$("#trPayungTumpuk"+param).css("display","table-row");
						$("#trPayungKuningTumpuk"+param).css("display","table-row");
						$("#trBobinTumpuk"+param).css("display","table-row");
					});
					$("#cmbUkuranTumpuk"+param).on("select2:unselect", function(){
						$("#trSisaTumpuk"+param).css("display","none");
						$("#trPayungTumpuk"+param).css("display","none");
						$("#trPayungKuningTumpuk"+param).css("display","none");
						$("#trBobinTumpuk"+param).css("display","none");
					});

					$("#cmbUkuran"+param).on("select2:unselect", function(){
						$("#txtPanjangPlastik"+param).val("");
						$("#txtMerek"+param).val("");
						$("#txtWarnaPlastik"+param).val("");
						$("#txtPermintaan"+param).val("");
						$("#trUkuranTumpuk"+param).css("display","none");
						$("#trSisaTumpuk"+param).css("display","none");
						$("#trPayungTumpuk"+param).css("display","none");
						$("#trPayungKuningTumpuk"+param).css("display","none");
						$("#trBobinTumpuk"+param).css("display","none");
					});

					$("#cmbKeterangan"+param).on("change",function(){
						var value = this.value;
						if(value == "POTONG BESOK"){
							$("#trTanggalAwal"+param).css("display","table-row");
							$("#trTanggalAkhir"+param).css("display","table-row");
							$("#tdTanggalAkhir"+param).text("Tanggal Potong");
						}else if(value == "KEMBALI GUDANG"){
							$("#trTanggalAwal"+param).css("display","table-row");
							$("#trTanggalAkhir"+param).css("display","table-row");
							$("#tdTanggalAkhir"+param).text("Tanggal Kembali");
						}else{
							$("#trTanggalAwal"+param).css("display","none");
							$("#trTanggalAkhir"+param).css("display","none");
							$("#tdTanggalAkhir"+param).text("Tanggal Kembali");
						}
					});
					$("#btnTambahSisaPengambilan"+param).attr("onclick","saveTambahSisaPengambilanPotong('"+param+"')");
					$("#btnSimpanSisaPengambilan"+param).attr("onclick","saveSisaPengambilanPotong('"+param+"')");
					$("#modalSisaPengambilan_"+param).modal({backdrop:"static"});
					if(param=="POLOS"){
						$("#modalCariHistoryPolos").modal("hide");
					}else{
						$("#modalCariHistoryCetak").modal("hide");
					}
				}
			}

			function searchLaporanHasilPotong(){
				var tglJadi1 = $("#txtTanggal").val();
				if(tglJadi1==""){
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
						url : "<?php echo base_url('_cutting/main/getLaporanHasilPotongGlobal'); ?>",
						dataType : "JSON",
						data : {
							tglJadi : tglJadi1
						},
						success : function(response){
							$("#tableLaporanHasilCutting > tbody > tr").empty();
							$.each(response,function(AvIndex, AvValue){
								$("#tableLaporanHasilCutting > tbody:last-child").append(
									"<tr>"+
										"<td>"+ ++AvIndex +"</td>"+
										"<td>"+AvValue.jumlahLembarPolos+"</td>"+
										"<td>"+AvValue.jumlahBeratPolos+"</td>"+
										"<td>"+AvValue.jumlahLembarCetak+"</td>"+
										"<td>"+AvValue.jumlahBeratCetak+"</td>"+
									"</tr>"
								);
							});
							$("#modalCariLaporanHasilCutting").modal("hide");
						},
						error : function(response){
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

			function searchBonApal(){
				var tglJadi = $("#txtTanggal").val();
				var jnsPermintaan = $("#cmbJenis").val();

				if(tglJadi=="" || jnsPermintaan==""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					tableListApal(tglJadi, jnsPermintaan);
					$("#txtTanggal").val("");
					$("#cmbJenis").val("");
					$(".date").datepicker("setDate",null);
					$("#modalCariLaporan").modal("hide");
					$("#dataBonApalWrapper").css("display","block");
					$("#btnModalEditKeteranganApal").attr("onclick","modalTambahKeteranganApal('"+tglJadi+"','"+jnsPermintaan+"')");
					$("#btnBuatBon").attr("onclick","modalBuatBon('"+tglJadi+"','"+jnsPermintaan+"')");
				}
			}

			//============================================SEARCH METHOD (Finish)============================================//

			//============================================DATATABLE METHOD (Start)============================================//
			function datatablesRencanaPpicPotong(param1="", param2=""){
				$("#tableRencanaPpicPotong").dataTable().fnDestroy();
				$("#tableRencanaPpicPotong").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "700px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_cutting/main/getListRencanaPpicPotongDatatables",
          "columns":[
						{"data" : "kd_ppic","name":"kd_ppic"},
						{"data" : "tgl_rencana","name":"tgl_rencana"},
						{"data" : "nm_cust","name":"nm_cust"},
						{"data" : "merek","name":"merek"},
						{"data" : "ukuran","name":"ukuran"},
						{"data" : "warna_plastik","name":"warna_plastik"},
						{"data" : "permintaan_mesin","name":"permintaan_mesin"},
						{"data" : "tebal","name":"tebal"},
						{"data" : "berat","name":"berat"},
						{"data" : "jumlah_permintaan","name":"berat"},
						{"data" : "sisa","name":"jumlah_permintaan"},
						{"data" : "strip","name":"sisa"},
						{"data" : "ket_mandor","name":"ket_mandor"},
						{"data" : "no_mesin","name":"no_mesin"},
						{"data" : "kd_ppic","name":"kd_ppic"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"tglAwal","value":param1});
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
						$("td:eq(0)",nRow).text(++iDisplayIndex);
						$("td:eq(9)",nRow).text(aData["jumlah_permintaan"]+" "+aData["satuan"]);
						// if(aData["kd_ppic"]==null || aData["kd_ppic"]=="null"){
						// 	$("td:eq(0)").css({"backgroud-color":"rgba(0, 0, 118, 0.6)","color":"rgb(255, 255, 255)"});
						// }
						if(aData["satuan"]=="LEMBAR" || aData["satuan"] == "KG"){
							$("td:eq(10)",nRow).text(aData["sisa"]+" "+aData["satuan"]);
						}else{
							$("td:eq(10)",nRow).text(aData["sisa"]+" KG");
						}
						if(aData["foto_depan"] != null || aData["foto_depan"] != ""){
							if(aData["ket_mandor"] != null){
								$("td:eq(12)",nRow).html("<label class='text-yellow'>["+aData["keterangan"]+"]</label>"+
																				 "<img src='<?php echo base_url(); ?>assets/images/upload/"+aData["foto_depan"]+"' class='img-responsive gambar' width='72px' height='72px' onclick='showImage(this)'>"+
																			 	 "<label class='text-red'>["+aData["ket_mandor"]+"]</label>");
							}else{
								if (aData["foto_depan"] == null || aData["foto_depan"] == "") {
									$("td:eq(12)",nRow).html("<label class='text-yellow'>"+aData["keterangan"]+"</label>");
								}else{
									$("td:eq(12)",nRow).html("<label class='text-yellow'>["+aData["keterangan"]+"]</label>"+
																				 "<img src='<?php echo base_url(); ?>assets/images/upload/"+aData["foto_depan"]+"' class='img-responsive gambar' width='72px' height='72px' onclick='showImage(this)'>");
								}

							}
						}else{
							if(aData["ket_mandor"] != null){
								$("td:eq(12)",nRow).html("<label class='text-yellow'>["+aData["keterangan"]+"]</label>"+"<label class='text-red'>"+aData["ket_mandor"]+"</label>");
							}
						}
						if(
							 (aData["no_mesin"] != null || aData["no_mesin"] != "") &&
							 (aData["sts_pengerjaan"]!="PENDING")
						 	){
							$("td:eq(13)",nRow).css({"background-color":"#d81b60","color":"#FFF","opacity":".72"});
						}
						$("td:eq(14)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalBuatRencanaKerja('"+aData["kd_ppic"]+"','"+param1+"','"+param2+"')>Input Mesin</button>"+
																		//  "<button class='btn btn-md btn-flat btn-warning' onclick=modalKonversi('"+aData["kd_ppic"]+"')>Konversi Ke Kg</button>"+
																		 "<button class='btn btn-md btn-flat btn-success' onclick=modalInputKeterangan('"+aData["kd_ppic"]+"')>Input Keterangan</button>"+
																		 "<button class='btn btn-md btn-flat btn-info' onclick=modalEditStatus('"+aData["kd_ppic"]+"','"+param1+"','"+param2+"')>Edit Status</button>"+
																		 "<button class='btn btn-md btn-flat btn-danger' onclick=modalEditMesin('"+aData["kd_ppic"]+"')>Edit Mesin</button>");
						// if(aData["satuan"] == "BAL"){
						// 	$("td:eq(14)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalKonversi('"+aData["kd_ppic"]+"')>Konversi Ke Kg</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-info' onclick=modalEditStatus('"+aData["kd_ppic"]+"')>Edit Status</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-success' onclick=modalInputKeterangan('"+aData["kd_ppic"]+"')>Input Keterangan</button>");
						// }else if(aData["satuan"] == "LEMBAR"){
						// 	$("td:eq(14)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalBuatRencanaKerja('"+aData["kd_ppic"]+"')>Input Mesin</button>"+
						// 													 "<button class='btn btn-md btn-flat btn-warning' onclick=modalKonversi('"+aData["kd_ppic"]+"')>Konversi Ke Kg</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-info' onclick=modalEditStatus('"+aData["kd_ppic"]+"')>Edit Status</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-success' onclick=modalInputKeterangan('"+aData["kd_ppic"]+"')>Input Keterangan</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-danger' onclick=modalEditMesin('"+aData["kd_ppic"]+"')>Edit Mesin</button>");
						// }else{
						// 	$("td:eq(14)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalBuatRencanaKerja('"+aData["kd_ppic"]+"')>Input Mesin</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-info' onclick=modalEditStatus('"+aData["kd_ppic"]+"')>Edit Status</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-success' onclick=modalInputKeterangan('"+aData["kd_ppic"]+"')>Input Keterangan</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-danger' onclick=modalEditMesin('"+aData["kd_ppic"]+"')>Edit Mesin</button>");
						// }
          }
				});
			}

			function tableRencanaPotongPending(){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_cutting/main/getRencanaPotongPending",
					dataType : "JSON",
					success : function(response){
						$("#tableRencanaPotongPending > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tableRencanaPotongPending > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.no_mesin+"</td>"+
									"<td>"+AvValue.customer+"</td>"+
									"<td>"+AvValue.merek+"</td>"+
									"<td>"+AvValue.ukuran+"</td>"+
									"<td>"+AvValue.warna_plastik+"</td>"+
									"<td>"+AvValue.tebal+"</td>"+
									"<td>"+AvValue.stok_permintaan+"</td>"+
									"<td>"+AvValue.jml_permintaan+"</td>"+
									"<td>"+AvValue.strip+"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-warning' onclick=modalEditRencanaPotongPending('"+AvValue.kd_potong	+"')>Ubah</button>"+
										"<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRencanaPotongPending('"+AvValue.kd_potong+"','TRUE')>Hapus</button>"+
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

			function datatablesRencanaMandorPotong(param1=""){
				$("#tableDataRencanaMandor").dataTable().fnDestroy();
				$("#tableDataRencanaMandor").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : true,
					"bProcessing" : true,
					"bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "700px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_cutting/main/getRencanaMandorPotong",
          "columns":[
						{"data" : "kd_potong","name":"RC.ukuran"},
						{"data" : "tgl_rencana","name":"RC.merek"},
						{"data" : "no_mesin","name":"RC.warna_plastik"},
						{"data" : "customer","name":"RC.no_mesin"},
						{"data" : "merek","name":"RC.tgl_rencana"},
						{"data" : "ukuran","name":"RC.kd_potong"},
						{"data" : "warna_plastik","name":"RC.customer"},
						{"data" : "tebal","name":"RC.tebal"},
						{"data" : "strip","name":"RC.strip"},
						{"data" : "jml_permintaan","name":"RC.jml_permintaan"},
						{"data" : "stok_permintaan","name":"RC.stok_permintaan"},
						{"data" : "ket_merek","name":"RC.ket_merek"},
						{"data" : "gambar","name":"RC.gambar"},
						{"data" : "kd_potong","name":"RC.kd_potong"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"tglRencana","value":param1});
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
						$("td:eq(0)",nRow).text(++iDisplayIndex);
						if((aData["ket_merek"]==null && aData["ket_barang"]==null) || (aData["ket_merek"]=="" && aData["ket_barang"]=="")){
							$("td:eq(11)",nRow).text("");
						}else{
							$("td:eq(11)",nRow).text(aData["ket_merek"]+" / "+aData["ket_barang"]);
						}

						if(aData["gambar_dari_ppic"]==null || aData["gambar_dari_ppic"]==""){
							if(aData["gambar"]==null || aData["gambar"]==""){
								$("td:eq(12)",nRow).text("");
							}else{
								$("td:eq(12)",nRow).html("<img src='<?php echo base_url(); ?>assets/images/upload/"+aData["gambar"]+"' class='img-responsive gambar' onclick='showImage(this)' width='72px' height='72px'>");
							}
						}else{
							$("td:eq(12)",nRow).html("<img src='<?php echo base_url(); ?>assets/images/upload/"+aData["gambar_dari_ppic"]+"' class='img-responsive gambar' onclick='showImage(this)' width='72px' height='72px'>");
						}
						var arrUkuran = aData["ukuran"].split("x");
						if(aData["sts_print"] == "TRUE"){
							var btn = "btn-danger";
						}else{
							var btn = "btn-info";
						}
						$("td:eq(13)",nRow).html("<a href='#' onclick=editStatusPrint('"+aData["kd_gd_roll"]+"','"+aData["tgl_rencana"]+"','"+aData["kd_potong"]+"','TRUE') class='btn btn-md btn-flat "+btn+"'>Print</a>"+
																		 "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditMerek('"+aData["kd_potong"]+"','"+aData["kd_ppic"]+"')>Edit Merek</button>"+
																	 	 "<button class='btn btn-md btn-flat btn-primary' onclick=modalEditTanggal('"+aData["kd_potong"]+"')>Edit Tanggal</button>"+
																	 	 "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRencanaMandor('"+aData["kd_potong"]+"','TRUE')>Hapus Rencana</button>"+
																	 	 "<button class='btn btn-md btn-flat btn-info' onclick=modalEditRencana('"+aData["kd_potong"]+"')>Edit Rencana</button>"+
																	 	 "<a href='<?php echo base_url('_cutting/main/input_hasil/'); ?>"+
																		 					 arrUkuran[0].replace(/ /g,"_")+"/"+
																							 aData["warna_plastik"].replace(/ /g,"_")+"/"+
																							 aData["kd_gd_roll"].replace(/ /g,"_")+"/"+
																							 aData["tgl_rencana"].replace(/ /g,"_")+"' class='btn btn-md btn-flat btn-success' target='_blank'>Input Hasil</a>"+
																	 	 "<button class='btn btn-md btn-flat btn-primary' onclick=modalEditGantiMesinMandor('"+aData["kd_potong"]+"','"+aData["kd_ppic"]+"')>Ganti Mesin</button>");

						if(aData["kd_ppic"] == null){
							$("td:eq(0)",nRow).css({"background-color":"rgba(0, 0, 118, 0.6)","color":"rgb(255, 255, 255)"});
						}
						if(aData["satuan_ppic"] == "BAL"){
							$("td:eq(9)",nRow).text(aData["jml_permintaan"]+" BAL");
							$("td:eq(10)",nRow).text(aData["stok_permintaan"]+" KG");
						}else{
							$("td:eq(9)",nRow).text(aData["jml_permintaan"]+" "+aData["satuan"]);
							$("td:eq(10)",nRow).text(aData["stok_permintaan"]+" "+aData["satuan"]);
						}
          }
				});
			}

			function tableRencanaMandoPotongSusulanPending(){
				$.ajax({
					url : "<?php echo base_url() ?>_cutting/main/getRencanaMandorPotongSusulanPending",
					dataType : "JSON",
					success : function(response){
						$("#tableListRencanaKerjaSusulanPending > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tableListRencanaKerjaSusulanPending > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.no_mesin+"</td>"+
									"<td>"+AvValue.customer+"</td>"+
									"<td>"+AvValue.ukuran+"</td>"+
									"<td>"+AvValue.warna_plastik+"</td>"+
									"<td>"+AvValue.tebal+"</td>"+
									"<td>"+AvValue.stok_permintaan+" "+AvValue.satuan+"</td>"+
									"<td></td>"+
									"<td>"+AvValue.strip+"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-warning' onclick=modalEditRencanaPotongSusulanPending('"+AvValue.kd_potong+"')>Ubah</button>"+
										"<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRencanaPotongPending('"+AvValue.kd_potong+"','TRUE')>Hapus</button>"+
									"</td>"+
								+"</tr>"
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

			function tableListSisaPengembalian(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_cutting/main/getSisaPengambilan'); ?>",
					dataType : "JSON",
					data : {jnsPermintaan : param},
					success : function(response){
						$("#tableBeratPengambilanOperator"+param+" > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tableBeratPengambilanOperator"+param+" > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex+"</td>"+
									"<td>"+AvValue.ukuran+"</td>"+
									"<td>"+AvValue.merek+"</td>"+
									"<td>"+AvValue.warna_plastik+"</td>"+
									"<td>"+AvValue.sisa+"</td>"+
									"<td>"+AvValue.payung+"</td>"+
									"<td>"+AvValue.payung_kuning+"</td>"+
									"<td>"+AvValue.bobin+"</td>"+
									"<td>"+AvValue.keterangan+"</td>"+
									"<td>"+AvValue.shift+"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-warning' onclick=modalEditSisaPengambilanTemp('"+AvValue.id+"','"+AvValue.jns_permintaan+"')>Ubah</button>"+
										"<button class='btn btn-md btn-flat btn-danger' disabled title='Fitur Ini Sedang Dalam Pengembangan Lebih Lanjut'>Hapus</button>"+
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

			function tableDataPengambilan(param, param2="", param3=""){
				if(param == "EXTRUDER"){
					var idTable = "#tableDataPengambilanExtruder";
				}else{
					var idTable = "#tableDataPengambilanCetak";
				}
				$(idTable).dataTable().fnDestroy();
				$(idTable).dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : true,
					"bProcessing" : true,
					"bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "700px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_cutting/main/getPengambilanPotong",
          "columns":[
						{"data" : "id","name":"TDPP.id"},
						{"data" : "tgl_sisa","name":"TDPP.tgl_sisa"},
						{"data" : "tgl_potong","name":"TDPP.tgl_potong"},
						{"data" : "ukuran","name":"TDPP.ukuran"},
						{"data" : "warna_plastik","name":"TDPP.warna_plastik"},
						{"data" : "merek","name":"TDPP.merek"},
						{"data" : "berat","name":"TDPP.berat"},
						{"data" : "payung","name":"TDPP.payung"},
						{"data" : "payung_kuning","name":"TDPP.payung_kuning"},
						{"data" : "bobin","name":"TDPP.bobin"},
						{"data" : "status","name":"TDPP.status"},
						{"data" : "keterangan_waktu","name":"TGR.keterangan_waktu"},
						{"data" : "id","name":"TDPP.id"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"bagian","value":param},
					 							 {"name":"tglAwal","value":param2},
											 	 {"name":"tglAkhir","value":param3});
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
						$("td:eq(3)",nRow).text(aData["ukuran"]+ " ("+aData["kd_gd_roll"]+")");
						$("td:eq(12)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditPengambilanPotong('"+aData["id"]+"','"+param+"')>Ubah</button>"+
																		 "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestorePengambilanPotong('"+aData["id"]+"','TRUE')>Hapus</button>");
					}
				});
			}

			function datatablesLaporanRencanaPpic(param){
				$("#tableLaporanRencanaPPIC").dataTable().fnDestroy();
				$("#tableLaporanRencanaPPIC").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "700px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_cutting/main/getListLaporanRencanaPpic",
          "columns":[
						{"data" : "kd_ppic","name":"kd_ppic"},
						{"data" : "tgl_rencana","name":"tgl_rencana"},
						{"data" : "nm_cust","name":"nm_cust"},
						{"data" : "merek","name":"merek"},
						{"data" : "ukuran","name":"ukuran"},
						{"data" : "warna_plastik","name":"warna_plastik"},
						{"data" : "permintaan_mesin","name":"permintaan_mesin"},
						{"data" : "tebal","name":"tebal"},
						{"data" : "berat","name":"berat"},
						{"data" : "jumlah_permintaan","name":"jumlah_permintaan"},
						{"data" : "sisa","name":"jumlah_permintaan"},
						{"data" : "strip","name":"sisa"},
						{"data" : "keterangan","name":"keterangan"},
						{"data" : "no_mesin","name":"no_mesin"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"tglRencana","value":param});
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
						$("td:eq(0)",nRow).text(++iDisplayIndex);
						$("td:eq(9)",nRow).text(aData["jumlah_permintaan"]+" "+aData["satuan"]);
						// if(aData["kd_ppic"]==null || aData["kd_ppic"]=="null"){
						// 	$("td:eq(0)").css({"backgroud-color":"rgba(0, 0, 118, 0.6)","color":"rgb(255, 255, 255)"});
						// }
						if(aData["satuan"]=="LEMBAR" || aData["satuan"] == "KG"){
							$("td:eq(10)",nRow).text(aData["sisa"]+" "+aData["satuan"]);
						}else{
							$("td:eq(10)",nRow).text(aData["sisa"]+" KG");
						}
						if(!aData["foto_depan"] == null || !aData["foto_depan"] == ""){
							$("td:eq(12)",nRow).html(aData["keterangan"]+"<img src='<?php echo base_url(); ?>assets/images/upload/"+aData["foto_depan"]+"' class='img-responsive gambar' width='72px' height='72px' onclick='showImage(this)'>");
						}
						if(
							 (aData["no_mesin"] != null || aData["no_mesin"] != "") &&
							 (aData["sts_pengerjaan"]!="PENDING")
						 	){
							$("td:eq(13)",nRow).css({"background-color":"#d81b60","color":"#FFF","opacity":".72"});
						}
						// $("td:eq(14)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalBuatRencanaKerja('"+aData["kd_ppic"]+"','"+param1+"','"+param2+"')>Input Mesin</button>"+
						// 												//  "<button class='btn btn-md btn-flat btn-warning' onclick=modalKonversi('"+aData["kd_ppic"]+"')>Konversi Ke Kg</button>"+
						// 												 "<button class='btn btn-md btn-flat btn-success' onclick=modalInputKeterangan('"+aData["kd_ppic"]+"')>Input Keterangan</button>"+
						// 												 "<button class='btn btn-md btn-flat btn-info' onclick=modalEditStatus('"+aData["kd_ppic"]+"','"+param1+"','"+param2+"')>Edit Status</button>"+
						// 												 "<button class='btn btn-md btn-flat btn-danger' onclick=modalEditMesin('"+aData["kd_ppic"]+"')>Edit Mesin</button>");
						// if(aData["satuan"] == "BAL"){
						// 	$("td:eq(14)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalKonversi('"+aData["kd_ppic"]+"')>Konversi Ke Kg</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-info' onclick=modalEditStatus('"+aData["kd_ppic"]+"')>Edit Status</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-success' onclick=modalInputKeterangan('"+aData["kd_ppic"]+"')>Input Keterangan</button>");
						// }else if(aData["satuan"] == "LEMBAR"){
						// 	$("td:eq(14)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalBuatRencanaKerja('"+aData["kd_ppic"]+"')>Input Mesin</button>"+
						// 													 "<button class='btn btn-md btn-flat btn-warning' onclick=modalKonversi('"+aData["kd_ppic"]+"')>Konversi Ke Kg</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-info' onclick=modalEditStatus('"+aData["kd_ppic"]+"')>Edit Status</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-success' onclick=modalInputKeterangan('"+aData["kd_ppic"]+"')>Input Keterangan</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-danger' onclick=modalEditMesin('"+aData["kd_ppic"]+"')>Edit Mesin</button>");
						// }else{
						// 	$("td:eq(14)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalBuatRencanaKerja('"+aData["kd_ppic"]+"')>Input Mesin</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-info' onclick=modalEditStatus('"+aData["kd_ppic"]+"')>Edit Status</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-success' onclick=modalInputKeterangan('"+aData["kd_ppic"]+"')>Input Keterangan</button>"+
						// 												 	 "<button class='btn btn-md btn-flat btn-danger' onclick=modalEditMesin('"+aData["kd_ppic"]+"')>Edit Mesin</button>");
						// }
          }
				});
			}

			function datatablesHasilJobPotongPending(){
				$("#tableHasilJobPotong").dataTable().fnDestroy();
				$("#tableHasilJobPotong").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "700px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_cutting/main/getHasilJobPotongPending",
          "columns":[
						{"data" : "kd_hasil_potong","name":"THP.kd_hasil_potong"},
						{"data" : "tgl_rencana","name":"THP.tgl_rencana"},
						{"data" : "no_mesin","name":"RC.no_mesin"},
						{"data" : "customer","name":"RC.customer"},
						{"data" : "merek","name":"RC.merek"},
						{"data" : "tebal","name":"RC.tebal"},
						{"data" : "ukuran","name":"RC.ukuran"},
						{"data" : "berat","name":"RC.berat"},
						{"data" : "warna_plastik","name":"RC.warna_plastik"},
						{"data" : "jumlah_lembar","name":"TSHP.jumlah_lembar"},
						{"data" : "jumlah_berat","name":"TSHP.jumlah_berat"},
						{"data" : "jumlah_apal_global","name":"THP.jumlah_apal_global"},
						{"data" : "jumlah_roll_pipa","name":"THP.jumlah_roll_pipa"},
						{"data" : "berat_sisa_hari_ini","name":"TPHP.berat_sisa_hari_ini"},
						{"data" : "plusminus","name":"THP.plusminus"},
						{"data" : "shift","name":"THP.shift"},
						{"data" : "kd_hasil_potong","name":"THP.kd_hasil_potong"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             //aoData.push({"name":"tglRencana","value":param});
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
						$("td:eq(0)",nRow).text(++iDisplayIndex);

						$("td:eq(16)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditHasilCuttingTemp('"+aData["id_transaksi"]+"')>Ubah</button>"+
																		 "<button class='btn btn-md btn-flat btn-danger' disabled title='Fitur Ini Belum Tersedia'>Hapus</button>");
          }
				});
			}

			function datatablesHasilJobPotong(param1, param2){
				$("#tableLaporanHasilCutting").dataTable().fnDestroy();
				$("#tableLaporanHasilCutting").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "700px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_cutting/main/getHasilJobPotong",
          "columns":[
						{"data" : "no_mesin","name":"RC.no_mesin"},
						{"data" : "customer","name":"RC.customer"},
						{"data" : "merek","name":"RC.merek"},
						{"data" : "ukuran","name":"RC.ukuran"},
						{"data" : "warna_plastik","name":"RC.warna_plastik"},
						{"data" : "jns_permintaan","name":"RC.jns_permintaan"},
						{"data" : "hasil_lembar","name":"THP.hasil_lembar"},
						{"data" : "hasil_berat_bersih","name":"THP.hasil_berat_bersih"},
						{"data" : "hasil_berat_kotor","name":"THP.hasil_berat_kotor"},
						{"data" : "jumlah_apal_global","name":"THP.jumlah_apal_global"},
						{"data" : "jumlah_roll_pipa","name":"THP.jumlah_roll_pipa"},
						{"data" : "jumlah_lembar","name":"TSHP.jumlah_lembar"},
						{"data" : "jumlah_berat","name":"TSHP.jumlah_berat"},
						{"data" : "berat","name":"RC.berat"},
						{"data" : "plusminus","name":"THP.plusminus"},
						{"data" : "jns_brg","name":"RC.kd_potong"},
						{"data" : "kd_hasil_potong","name":"THP.kd_hasil_potong"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"shift","value":param1},
					 							 {"name":"tglJadi","value":param2});
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
          	$("td:eq(3)",nRow).html(aData["ukuran"]+" "+"<label class='text-blue'> ("+aData["kd_gd_hasil"]+")</label>");
						var arrUkuran = aData["ukuran"].split("x");
						$("td:eq(14)",nRow).html(aData["plusminus"]);
						$("td:eq(16)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditHasilCutting('"+aData["id_transaksi"]+"','"+arrUkuran[0].replace(/ /g,"_")+"','"+aData["merek"].replace(/ /g,"_")+"','"+aData["kd_hasil_potong"]+"')>Ubah</button>");
          }
				});
			}

			function datatablesListHistoryPpicExtruder(param1="<?php echo date('m'); ?>", param2="<?php echo date('Y'); ?>"){
				$("#tableListHistoryPPICExtruder").dataTable().fnDestroy();
				$("#tableListHistoryPPICExtruder").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "700px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url('_cutting/main/getListHistoryPPICExtruder'); ?>",
          "columns":[
						{"data" : "kd_ppic","name":"kd_ppic"},
						{"data" : "tgl_rencana","name":"tgl_rencana"},
						{"data" : "nm_cust","name":"nm_cust"},
						{"data" : "merek","name":"merek"},
						{"data" : "jns_permintaan","name":"jns_permintaan"},
						{"data" : "ukuran","name":"ukuran"},
						{"data" : "warna_plastik","name":"warna_plastik"},
						{"data" : "tebal","name":"tebal"},
						{"data" : "berat","name":"berat"},
						{"data" : "jumlah_permintaan","name":"jumlah_permintaan"},
						{"data" : "sisa","name":"sisa"},
						{"data" : "strip","name":"strip"},
						{"data" : "sts_pengerjaan","name":"sts_pengerjaan"},
						{"data" : "foto_depan","name":"foto_depan"},
						{"data" : "keterangan","name":"keterangan"},
						{"data" : "diperbarui","name":"diperbarui"},
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"bulan","value":param1},
					 							 {"name":"tahun","value":param2});
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
						$("td:eq(0)",nRow).text(++iDisplayIndex);
						$("td:eq(3)",nRow).html(aData["merek"]+" <label class='text-blue'>("+aData["ket_merek"]+")</label>");
						$("td:eq(12)",nRow).html(aData["sts_pengerjaan"]+" <label class='text-red'>["+aData["prioritas"]+"]</label>")
          }
				});
			}

			function datatablestableListHistorySisa(param1="", param2=""){
				$("#tableListHistorySisa").dataTable().fnDestroy();
				$("#tableListHistorySisa").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide"	: true,
					"scrollX" : "100%",
					"scrollY" : "700px",
          "sPaginationType": "full_numbers",
					"iDisplayStart" : 0,
          "sAjaxSource":"<?php echo base_url('_cutting/main/getHistorySisaPotong'); ?>",
          "columns":[
						{"data" : "id","name":"TDPP.id"},
						{"data" : "tgl_sisa","name":"TDPP.tgl_sisa"},
						{"data" : "tgl_potong","name":"TDPP.tgl_potong"},
						{"data" : "ukuran","name":"TDPP.ukuran"},
						{"data" : "warna_plastik","name":"TDPP.warna_plastik"},
						{"data" : "merek","name":"TDPP.merek"},
						{"data" : "berat","name":"TDPP.berat"},
						{"data" : "payung","name":"TDPP.payung"},
						{"data" : "payung_kuning","name":"TDPP.payung_kuning"},
						{"data" : "bobin","name":"TDPP.bobin"},
						{"data" : "status","name":"TDPP.status"},
						{"data" : "id","name":"TDPP.id"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"tglAwal","value":param1},
					 							 {"name":"tglAkhir","value":param2});
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
						$("td:eq(0)",nRow).text(++iDisplayIndex);
						$("td:eq(11)",nRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditHistorySisa('"+aData["id"]+"')>Ubah</button>"+
																		 "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreSisaPotong('"+aData["id"]+"','TRUE')>Hapus</button>");
          }
				});
			}

			function tableListApal(param1, param2){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_cutting/main/getLaporanBonApal'); ?>",
					dataType : "JSON",
					data : {
						tglJadi : param1,
						jnsPermintaan : param2
					},
					success : function(response){
						$("#tableListApal > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tableListApal > tbody:last-child").append(
								"<tr>"+
									"<td>"+AvValue.customer+"</td>"+
									"<td>"+AvValue.merek+"</td>"+
									"<td>"+AvValue.no_mesin+"</td>"+
									"<td>"+AvValue.apal+"</td>"+
									"<td>"+AvValue.warna_plastik+"</td>"+
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

			function tableListDataBonApalPending(){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_cutting/main/getListDataBonApalPending') ?>",
					dataType : "JSON",
					success : function(response){
						$("#tableListDataBonApalPending > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tableListDataBonApalPending > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.merek+"</td>"+
									"<td>"+AvValue.jumlah_apal+"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-warning' onclick=modalEditBonApalPending('"+AvValue.id+"','"+AvValue.tgl_transaksi+"')>Ubah</button>"+
										"<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreTambahBonApal('"+AvValue.id+"','TRUE')>Hapus</button>"+
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

			//============================================DATATABLE METHOD (Finish)============================================//
		</script>
		<script type="text/javascript">
			//============================================UNSPECIFIED METHOD (Start)============================================//
			function hitungRollPipa(param1="", param2=""){
				var jenisPipa = $("#cmbRollPipa").val();

				if(jenisPipa == "PAYUNG"){
					var payung = parseFloat($("#txtJumlahPayung").val().replace(/,/g,""));
					var rumusRoll = parseFloat($("#txtRumusRollPayung").val().replace(/,/g,""));
					var rollPipa = payung * rumusRoll;
				}else if(jenisPipa == "PAYUNG_KUNING"){
					var payung = parseFloat($("#txtJumlahPayung").val().replace(/,/g,""));
					var rumusRoll = parseFloat($("#txtRumusRollPayung").val().replace(/,/g,""));
					var rollPipa = payung * rumusRoll;
				}else if(jenisPipa == "PAYUNG_KUNING_PAYUNG"){
					var ketMerek = $("#ketMerek").val().toUpperCase();
					var ketBarang = $("#ketBarang").val().toUpperCase();
					var merek = $("#txtMerek").val().toUpperCase();
					var arrUkuran = $("input[name='txtUkuran']").val().replace(/ /g,"").split("x");
					var panjangTemp = arrUkuran[0].toUpperCase();
					if(merek.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1 || panjangTemp.indexOf("PON") != -1){
						var arrPanjangPlastik = arrUkuran[0].replace(/ |pon/gi, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
												 if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
												 }
											 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
												 if(arrPanjangPlastik[0].indexOf("in") != -1){
													var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
												}else{
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
												}
											 }else{
												 var TPanjangPlastik = 0;
											 }
											 break;

						 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
												if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
													if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
													}
												}else{
													if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
													}
												}
											}else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
												 if(arrPanjangPlastik[1] > 1){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
													}
												 }else{
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
													}
												 }
											 }else{
												 var TPanjangPlastik = 0;
											 }
											 break;
							default: var TPanjangPlastik = 0; break;
						}
					}else{
						var arrPanjangPlastik = arrUkuran[0].replace(/ |pon/gi, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
											 }
											 break;
							case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
											 }
											 break;
							default:if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
											 }
											 break;
						}
					}
					if(parseFloat(TPanjangPlastik) < 6){
						var rumusRollPayung = 5000;
					}else if(parseFloat(TPanjangPlastik) >=6 && parseFloat(TPanjangPlastik) <=40){
						var rumusRollPayung = 6000;
					}else{
						var rumusRollPayung = 7000;
					}

					if(parseFloat(TPanjangPlastik) <= 30){
						var rumusRollPayungKuning = 4000;
					}else{
						var rumusRollPayungKuning = 5000;
					}
					var jumlahPayung = parseFloat($("#txtJumlahPayung_PKP").val().replace(/,/g,""));
					var jumlahPayungKuning = parseFloat($("#txtJumlahPayungKuning_PKP").val().replace(/,/g,""));
					var rollPipa = (jumlahPayung*rumusRollPayung) + (jumlahPayungKuning*rumusRollPayungKuning);
				}else if(jenisPipa == "BOBIN"){
					var ketMerek = $("#ketMerek").val().toUpperCase();
					var ketBarang = $("#ketBarang").val().toUpperCase();
					var merek = $("#txtMerek").val().toUpperCase();
					var arrUkuran = $("#txtUkuranPlastik").val().replace(/ /g,"").split("x");

					var doubleSingle = $("#txtDoubleSingle").val().replace(/,/g, "");
					var jumlahBobin = $("#txtBanyaknyaPipa").val().replace(/,/g, "");
					var rumusRoll = $("#txtRumus").val().replace(/,/g, "");

					var panjangTemp = arrUkuran[0].toUpperCase();
					if(merek.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1 || panjangTemp.indexOf("PON") != -1){
						var arrPanjangPlastik = arrUkuran[0].replace(/ |pon/gi, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
												 if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
												 }
											 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
												 if(arrPanjangPlastik[0].indexOf("in") != -1){
													var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
												}else{
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
												}
											 }else{
												 var TPanjangPlastik = 0;
											 }
											 break;

						 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
												if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
													if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
													}
												}else{
													if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
													}
												}
											}else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
												 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
													}
												 }else{
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
													}
												 }
											 }else{
												 var TPanjangPlastik = 0;
											 }
											 break;
							default: var TPanjangPlastik = 0; break;
						}
					}else{
						var arrPanjangPlastik = arrUkuran[0].replace(/ |pon/gi, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
											 }
											 break;
							case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
											 }
											 break;
							default:if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
											 }
											 break;
						}
					}
					var rollPipa = (TPanjangPlastik * doubleSingle * rumusRoll * jumlahBobin);
				}else if(jenisPipa == "BOBIN_PAYUNG"){
					var ketMerek = $("#ketMerek").val().toUpperCase();
					var ketBarang = $("#ketBarang").val().toUpperCase();
					var merek = $("#txtMerek").val().toUpperCase();
					var arrUkuran = $("input[name='txtUkuran']").val().replace(/ /g,"").split("x");

					var doubleSingle = $("#txtDoubleSingleBobinPayung").val().replace(/,/g, "");
					var jumlahBobin = $("#txtJumlahBobinPayung_Bobin").val().replace(/,/g, "");
					var jumlahPayung = $("#txtJumlahBobinPayung_Payung").val().replace(/,/g, "");
					var rumusRoll = 30;

					var panjangTemp = arrUkuran[0].toUpperCase();
					if(merek.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1 || panjangTemp.indexOf("PON") != -1){
						var arrPanjangPlastik = arrUkuran[0].replace(/ |pon/gi, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
												 if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
												 }
											 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
												 if(arrPanjangPlastik[0].indexOf("in") != -1){
													var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
												}else{
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
												}
											 }else{
												 var TPanjangPlastik = 0;
											 }
											 break;

						 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
												if(parseFloat(arrPanjangPlastik[1]) > 1){
													if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
													}
												}else{
													if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
													}
												}
											}else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
												 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
													}
												 }else{
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
													}
												 }
											 }else{
												 var TPanjangPlastik = 0;
											 }
											 break;
							default: var TPanjangPlastik = 0; break;
						}
					}else{
						var arrPanjangPlastik = arrUkuran[0].replace(/ |pon/gi, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
											 }
											 break;
							case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
											 }
											 break;
							default:if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
											 }
											 break;
						}
					}
					if(parseFloat(TPanjangPlastik) < 6){
						var rumusRollPayung = 5000;
					}else if(parseFloat(TPanjangPlastik) >=6 && parseFloat(TPanjangPlastik) <=40){
						var rumusRollPayung = 6000;
					}else{
						var rumusRollPayung = 7000;
					}
					var rollPipaBobin = (TPanjangPlastik * doubleSingle * rumusRoll * jumlahBobin);
					var rollPipaPayung = (jumlahPayung * rumusRollPayung);
					var rollPipa = rollPipaBobin + rollPipaPayung;
				}else if(jenisPipa == "BOBIN_PAYUNG_KUNING"){
					var ketMerek = $("#ketMerek").val().toUpperCase();
					var ketBarang = $("#ketBarang").val().toUpperCase();
					var merek = $("#txtMerek").val().toUpperCase();
					var arrUkuran = $("input[name='txtUkuran']").val().replace(/ /g,"").split("x");

					var doubleSingle = $("#txtDoubleSingleBobinPayung").val().replace(/,/g, "");
					var jumlahBobin = $("#txtJumlahBobinPayung_Bobin").val().replace(/,/g, "");
					var jumlahPayung = $("#txtJumlahBobinPayung_Payung").val().replace(/,/g, "");
					var rumusRoll = 30;

					var panjangTemp = arrUkuran[0].toUpperCase();
					if(merek.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1 || panjangTemp.indexOf("PON") != -1){
						var arrPanjangPlastik = arrUkuran[0].replace(/ |pon/gi, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
												 if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
												 }
											 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
												 if(arrPanjangPlastik[0].indexOf("in") != -1){
													var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
												}else{
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
												}
											 }else{
												 var TPanjangPlastik = 0;
											 }
											 break;

						 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
												if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
													if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
													}
												}else{
													if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
													}
												}
											 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
												 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
													}
												 }else{
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
													}
												 }
											 }else{
												 var TPanjangPlastik = 0;
											 }
											 break;
							default: var TPanjangPlastik = 0; break;
						}
					}else{
						var arrPanjangPlastik = arrUkuran[0].replace(/ |pon/gi, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
											 }
											 break;
							case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
											 }
											 break;
							default:if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
											 }
											 break;
						}
					}
					if(parseFloat(TPanjangPlastik) <= 30){
						var rumusRollPayung = 4000;
					}else{
						var rumusRollPayung = 5000;
					}
					var rollPipaBobin = (TPanjangPlastik * doubleSingle * rumusRoll * jumlahBobin);
					var rollPipaPayung = (jumlahPayung * rumusRollPayung);
					var rollPipa = rollPipaBobin + rollPipaPayung;
				}else if(jenisPipa == "BOBIN_PAYUNG_KUNING_PAYUNG"){
					var ketMerek = $("#ketMerek").val().toUpperCase();
					var ketBarang = $("#ketBarang").val().toUpperCase();
					var merek = $("#txtMerek").val().toUpperCase();
					var arrUkuran = $("input[name='txtUkuran']").val().replace(/ /g,"").split("x");

					var doubleSingle = $("#txtBPKP_DoubleSingle").val().replace(/,/g, "");
					var jumlahBobin = $("#txtBPKP_BanyaknyaPipa").val().replace(/,/g, "");
					var jumlahPayung = $("#txtBPKP_JumlahPayung").val().replace(/,/g, "");
					var jumlahPayungKuning = $("#txtBPKP_JumlahPayungKuning").val().replace(/,/g, "");
					var rumusRoll = 30;

					var panjangTemp = arrUkuran[0].toUpperCase();
					if(merek.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1 || panjangTemp.indexOf("PON") != -1){
						var arrPanjangPlastik = arrUkuran[0].replace(/ |pon/gi, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
												 if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
												 }
											 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
												 if(arrPanjangPlastik[0].indexOf("in") != -1){
													var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
												}else{
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
												}
											 }else{
												 var TPanjangPlastik = 0;
											 }
											 break;

						 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
												if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
													if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
													}
												}else{
													if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
													}
												}
											 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
												 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
													}
												 }else{
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
													}
												 }
											 }else{
												 var TPanjangPlastik = 0;
											 }
											 break;
							default: var TPanjangPlastik = 0; break;
						}
					}else{
						var arrPanjangPlastik = arrUkuran[0].replace(/ |pon/gi, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,''));
											 }
											 break;
							case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,''));
											 }
											 break;
							default:if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54;
											 }else{
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,''));
											 }
											 break;
						}
					}
					if(parseFloat(TPanjangPlastik) <= 30){
						var rumusRollPayungKuning = 4000;
					}else{
						var rumusRollPayungKuning = 5000;
					}
					if(parseFloat(TPanjangPlastik) < 6){
						var rumusRollPayung = 5000;
					}else if(parseFloat(TPanjangPlastik) >=6 && parseFloat(TPanjangPlastik) <=40){
						var rumusRollPayung = 6000;
					}else{
						var rumusRollPayung = 7000;
					}
					var rollPipaBobin = (TPanjangPlastik * doubleSingle * rumusRoll * jumlahBobin);
					var rollPipaPayung = (jumlahPayung * rumusRollPayung);
					var rollPipaPayungKuning = (jumlahPayungKuning * rumusRollPayungKuning);
					var rollPipa = rollPipaBobin + rollPipaPayung + rollPipaPayungKuning;
				}else{
					var rollPipa = 0;
				}
				$("#txtJumlahRollPipa").val(rollPipa);
			}

			function hitungPlusMinus(){
				var ketMerek = $("#ketMerek").val().toUpperCase();
				var ketBarang = $("#ketBarang").val().toUpperCase();
				var merek = $("#txtMerek").val().toUpperCase();
				if(ketMerek.indexOf("TUMPUK") != -1 || ketBarang.indexOf("TUMPUK") != -1){
					var beratPengambilan = (parseFloat($("#txtBeratPengambilan").val().replace(/,| /g,""))*1000.0);
					var beratPengambilanBagian = (parseFloat($("#txtBahan").val().replace(/,| /g,""))*1000);
					var beratSisaSemalam = (parseFloat($("#txtBeratSisaSemalam").val().replace(/,| /g,""))*1000);
					var beratSisaHariIni = (parseFloat($("#txtSisa").val().replace(/,| /g,""))*1000);
					var beratBersih = (parseFloat($("#txtHasilBeratBersih").val().replace(/,| /g,""))*1000);
					var beratApal = (parseFloat($("#txtJumlahApal").val().replace(/,| /g,""))*1000);
					var beratRollPipa = (parseFloat($("#txtJumlahRollPipa").val().replace(/,| /g,"")));

					var beratPengambilanTumpuk = (parseFloat($("#txtBeratPengambilanTumpuk").val().replace(/,| /g,""))*1000);
					var beratPengambilanBagianTumpuk = (parseFloat($("#txtBahanTumpuk").val().replace(/,| /g,""))*1000);
					var beratSisaSemalamTumpuk = (parseFloat($("#txtBeratSisaSemalamTumpuk").val().replace(/,| /g,""))*1000);
					var beratSisaHariIniTumpuk = (parseFloat($("#txtSisaTumpuk").val().replace(/,| /g,""))*1000);

					var beratTotal = ((beratPengambilan + beratPengambilanTumpuk) + (beratPengambilanBagian + beratPengambilanBagianTumpuk) + (beratSisaSemalam + beratSisaSemalamTumpuk)) - (beratSisaHariIni + beratSisaHariIniTumpuk);
					var plusMinus = (beratBersih + beratApal + beratRollPipa) - beratTotal;

					$("#txtPlusMinus").val(plusMinus);
				}else{
					var beratPengambilan = (parseFloat($("#txtBeratPengambilan").val().replace(/,| /g,""))*1000);
					var beratPengambilanBagian = (parseFloat($("#txtBahan").val().replace(/,| /g,""))*1000);
					var beratSisaSemalam = (parseFloat($("#txtBeratSisaSemalam").val().replace(/,| /g,""))*1000);
					var beratSisaHariIni = (parseFloat($("#txtSisa").val().replace(/,| /g,""))*1000);
					var beratBersih = (parseFloat($("#txtHasilBeratBersih").val().replace(/,| /g,""))*1000);
					var beratApal = (parseFloat($("#txtJumlahApal").val().replace(/,| /g,""))*1000);
					var beratRollPipa = (parseFloat($("#txtJumlahRollPipa").val().replace(/,| /g,"")));

					var beratTotal = (beratPengambilan + beratPengambilanBagian + beratSisaSemalam) - beratSisaHariIni;
					var plusMinus = (beratBersih + beratApal + beratRollPipa) - beratTotal;

					$("#txtPlusMinus").val(plusMinus);
				}
			}

			function hitungUlangRollPipaDanPlusMinus(){
				var jnsRollPipa = $("#cmbRollPipa").val();
				if(jnsRollPipa.indexOf("BOBIN") != -1){
					switch (jnsRollPipa) {
						case "BOBIN"											: var doubleSingle = $("#txtDoubleSingle").val();
																								break;
						case "BOBIN_PAYUNG"								: var doubleSingle = $("#txtDoubleSingleBobinPayung").val();
																 								break;
						case "BOBIN_PAYUNG_KUNING"				: var doubleSingle = $("#txtDoubleSingleBobinPayung").val();
																								break;
						case "BOBIN_PAYUNG_KUNING_PAYUNG"	: var doubleSingle = $("#txtBPKP_DoubleSingle").val();
																								break;
						default														: var doubleSingle = "";
																								break;
					}
					if(doubleSingle != ""){
						hitungRollPipa();
						hitungPlusMinus();
						$("#btnEditHasilCutting").removeAttr("disabled");
					}else{
						alert("Kolom Double/Single Tidak Boleh Kosong!");
						$("#btnEditHasilCutting").attr("disabled","disabled");
					}
				}else{
					hitungRollPipa();
					hitungPlusMinus();
					$("#btnEditHasilCutting").removeAttr("disabled");
				}
			}

			function numberMasking(){
				$(".number").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 3,autoGroup: true});
				$(".numberFive").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 5,autoGroup: true});
			}

			function hitungHasilGlobalPotong(){
				var arrUkuranPlastik = $("input[name='txtUkuran']").val().replace(/,/g,".").toLowerCase().split("x");
				var ketBarang = $("#ketBarang").val().toUpperCase();
				var ketMerek = $("#ketMerek").val().toUpperCase();
				var merek = $("#txtMerek").val().toUpperCase();
				if(ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1 || merek.indexOf("PON") != -1){
					var arrPanjangPlastik = arrUkuranPlastik[0].replace(/ /g, "").replace(/,/g,".").split("+");
					switch (arrPanjangPlastik.length) {
						case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
											 var panjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
										 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
											 var panjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
										 }else{
											 var panjangPlastik = arrUkuranPlastik[0].replace(/in/gi,'');
										 }
										 break;

					 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
											if(arrPanjangPlastik[1].replace(/in/gi,'') > 1){
												var panjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
											}else{
												var panjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
											}
										}else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
											 if(arrPanjangPlastik[1].replace(/in/gi,'') > 1){
												 var panjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
											 }else{
												 var panjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
											 }
										 }else{
											 var panjangPlastik = parseFloat(arrUkuranPlastik[0].replace(/in/gi,''));
										 }
										 break;
						default: var panjangPlastik = parseFloat(arrUkuranPlastik[0].replace(/in/gi,'')); break;
					}
				}else{
					if(arrUkuranPlastik[0].replace(/,/g, ".").replace(/ /g, "").indexOf("+") != -1){
						var panjangPlastik = 0;
						var arrPanjang = arrUkuranPlastik[0].replace(/,/g, ".").replace(/in/gi,'').replace(/ /g, "").split("+");
						for (var i = 0; i < arrPanjang.length; i++) {
							panjangPlastik += parseFloat(arrPanjang[i].replace(/in/gi,''));
						}
					}else{
						var panjangPlastik = parseFloat(arrUkuranPlastik[0].replace(/in/gi,''));
					}
				}

				if(panjangPlastik >= 3.5 && panjangPlastik < 9){
					var multiplier = 1;
				}else if(panjangPlastik >= 9 && panjangPlastik < 13){
					var multiplier = 2;
				}else if(panjangPlastik >= 13 && panjangPlastik < 15){
					var multiplier = 2.5;
				}else if(panjangPlastik >= 15 && panjangPlastik < 17){
					var multiplier = 3;
				}else if(panjangPlastik >= 17 && panjangPlastik < 25){
					var multiplier = 4;
				}else if(panjangPlastik >= 25 && panjangPlastik < 40){
					var multiplier = 5;
				}else{
					var multiplier = 7;
				}

				if(panjangPlastik >= 3.5 && panjangPlastik <= 17){
					var divider = 1000;
				}else{
					var divider = 100;
				}


				var jumlahSubLembarBaru = parseFloat($("#txtJumlahSubLembar").val().replace(/,/g, ""));
				var jumlahSubBeratBaru = parseFloat($("#txtJumlahSubBerat").val().replace(/,/g, ""));
				//
				var jumlahSubLembarLama = parseFloat($("#txtSubLembarLama").val());
				var jumlahSubBeratLama = parseFloat($("#txtSubBeratLama").val());
				if(panjangPlastik >= 3.5 && panjangPlastik <= 17){
					var beratKemasanBaru = ((jumlahSubLembarBaru / divider * 5) + (jumlahSubLembarBaru / 100 * multiplier)) / 1000;
					var beratKemasanLama = ((jumlahSubLembarLama / divider * 5) + (jumlahSubLembarLama / 100 * multiplier)) / 1000;
				}else{
					var beratKemasanBaru = (jumlahSubLembarBaru / divider * multiplier) / 1000;
					var beratKemasanLama = (jumlahSubLembarLama / divider * multiplier) / 1000;
				}

				var totalJumlahBeratGlobalLama = parseFloat($("#txtJumlahBeratLama").val().replace(/,/g,""));
				var totalJumlahLembarGlobalLama = parseFloat($("#txtJumlahLembarLama").val().replace(/,/g,""));
				var totalJumlahBeratKotorGlobalLama = parseFloat($("#txtJumlahBeratKotor").val().replace(/,/g, ""));
				var totalJumlahApal = parseFloat($("#txtJumlahApal").val().replace(/,/g,""));
				var totalJumlahRollPipa = parseFloat($("#txtJumlahRollPipa").val().replace(/,/g,""));

				var jumlahBeratBersihLama = (jumlahSubBeratLama - ((totalJumlahRollPipa/1000) - totalJumlahApal) - (beratKemasanLama));
				var jumlahBeratBersihBaru = (jumlahSubBeratBaru - ((totalJumlahRollPipa/1000) - totalJumlahApal) - (beratKemasanBaru));
				//
				var totalJumlahBeratGlobalBaru = ((totalJumlahBeratGlobalLama - jumlahBeratBersihLama) + jumlahBeratBersihBaru);
				var totalJumlahLembarGlobalBaru = ((totalJumlahLembarGlobalLama - jumlahSubLembarLama) + jumlahSubLembarBaru);
				var totalJumlahBeratKotorGlobalBaru = ((totalJumlahBeratKotorGlobalLama - jumlahSubBeratLama) + jumlahSubBeratBaru);
				//
				$("#txtHasilBeratBersih").val(totalJumlahBeratGlobalBaru);
				$("#txtJumlahLembar").val(totalJumlahLembarGlobalBaru);
				$("#txtHasilBeratKotor").val(totalJumlahBeratKotorGlobalBaru);
			}

			function hitungHasilGlobalPotongInputHasil(){
				var arrUkuranPlastik = $("input[name='txtUkuran']").val().replace(/,/g,".").toLowerCase().split("x");
				var ketBarang = $("#ketBarang").val().toUpperCase();
				var ketMerek = $("#ketMerek").val().toUpperCase();
				var merek = $("#txtMerek").val().toUpperCase();
				if(merek.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
					var arrPanjangPlastik = arrUkuranPlastik[0].replace(/ |pon/gi, "").replace(/,/g,".").split("+");
					switch (arrPanjangPlastik.length) {
						case 2 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
											 if(arrPanjangPlastik[0].indexOf("in") != -1){
												 var panjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5;
											 }else{
												 var panjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5;
											 }
										 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
											 if(arrPanjangPlastik[0].indexOf("in") != -1){
												var panjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + 5.5;
											}else{
												var panjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + 5.5;
											}
										 }else{
											 var panjangPlastik = 0;
										 }
										 break;

					 case 3 : if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 14 && parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) < 26.5){
											if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
												if(arrPanjangPlastik[0].indexOf("in") != -1){
													var panjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
												}else{
													var panjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5;
												}
											}else{
												if(arrPanjangPlastik[0].indexOf("in") != -1){
													var panjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
												}else{
													var panjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5;
												}
											}
										 }else if(parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) >= 26.5){
											 if(parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) > 1){
												 if(arrPanjangPlastik[0].indexOf("in") != -1){
													var panjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,''))*2.54) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
												}else{
													var panjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[1].replace(/in/gi,'')) + 5.5;
												}
											 }else{
												 if(arrPanjangPlastik[0].indexOf("in") != -1){
													var panjangPlastik = (parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) * 2.54) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
												}else{
													var panjangPlastik = parseFloat(arrPanjangPlastik[0].replace(/in/gi,'')) + parseFloat(arrPanjangPlastik[2].replace(/in/gi,'')) + 5.5;
												}
											 }
										 }else{
											 var panjangPlastik = 0;
										 }
										 break;
						default: var panjangPlastik = 0; break;
					}
				}else{
					var arrPanjangPlastik = arrUkuranPlastik[0].replace(/ |pon/gi, "").replace(/,/g,".").split("+");
					switch (arrPanjangPlastik.length) {
						case 2 : if(arrPanjangPlastik[0].indexOf("in") != -1){
											 var panjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]);
										 }else{
											 var panjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]);
										 }
										 break;
						case 3 : if(arrPanjangPlastik[0].indexOf("in") != -1){
											 var panjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
										 }else{
											 var panjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + parseFloat(arrPanjangPlastik[2]);
										 }
										 break;
						default:if(arrPanjangPlastik[0].indexOf("in") != -1){
											 var panjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
										 }else{
											 var panjangPlastik = parseFloat(arrPanjangPlastik);
										 }
										 break;
					}
				}

				if(panjangPlastik >= 3.5 && panjangPlastik < 9){
					var multiplier = 1;
				}else if(panjangPlastik >= 9 && panjangPlastik < 13){
					var multiplier = 2;
				}else if(panjangPlastik >= 13 && panjangPlastik < 15){
					var multiplier = 2.5;
				}else if(panjangPlastik >= 15 && panjangPlastik < 17){
					var multiplier = 3;
				}else if(panjangPlastik >= 17 && panjangPlastik < 25){
					var multiplier = 4;
				}else if(panjangPlastik >= 25 && panjangPlastik < 40){
					var multiplier = 5;
				}else{
					var multiplier = 7;
				}

				if(panjangPlastik >= 3.5 && panjangPlastik <= 17){
					var divider = 1000;
				}else{
					var divider = 100;
				}

				var jumlahLembar = 0;
				var jumlahBerat = 0;
				var arrJumlahSubLembar = $("input[name='txtLembar']").serializeArray();
				var arrJumlahSubBerat = $("input[name='txtBerat']").serializeArray();
				var totalJumlahApal = parseFloat($("#txtJumlahApal").val().replace(/,/g,""));
				var totalJumlahRollPipa = parseFloat($("#txtJumlahRollPipa").val().replace(/,/g,""));

				$.each(arrJumlahSubLembar,function(AvIndex, AvValue){
					jumlahLembar += parseFloat(AvValue.value.replace(/,/gi,""));
				});
				$.each(arrJumlahSubBerat,function(AvIndex, AvValue){
					jumlahBerat += parseFloat(AvValue.value.replace(/,/gi,""));
				});

				if(panjangPlastik >= 3.5 && panjangPlastik <= 17){
					if(arrUkuranPlastik[0].indexOf("in") != -1){
						var beratKemasan = (jumlahLembar / 100 * multiplier) / 1000;
					}else{
						var beratKemasan = ((jumlahLembar / divider * 5) + (jumlahLembar / 100 * multiplier)) / 1000;
					}
				}else{
					if(arrUkuranPlastik[0].indexOf("in") != -1){
						var beratKemasan = (jumlahLembar / 100 * multiplier) / 1000;
					}else{
						var beratKemasan = (jumlahLembar / divider * multiplier) / 1000;
					}
				}

				var jumlahBeratBersih = (jumlahBerat - beratKemasan);
				$("#txtHasilLembar").val(jumlahLembar);
				$("#txtHasilBeratBersih").val(jumlahBeratBersih);
				$("#txtHasilBeratKotor").val(jumlahBerat);
			}

			function alertKirimanBalikGudangHasil(){
				$.ajax({
					type : "POST",
					url  : "<?php echo site_url('_cutting/main/countKirimanBalikGudangHasil'); ?>",
					success:function(response){
						if (response>0) {
							$("#alertKirimanBalikGudangHasil").show();
						}else{
							$("#alertKirimanBalikGudangHasil").hide();
						}
					}
				});
			}

			function modalKirimanBalik(){
				$("#modalKirimanBalikGudangHasil").modal({backdrop:"static"});
				tableListKirimanBalikGudangHasil();
			}

			function tableListKirimanBalikGudangHasil(){
	          $.ajax({
	            url : "<?php echo base_url() ?>_cutting/main/getDataKirimanBalikGudangHasil",
	            dataType : "JSON",
	            success : function(response){
	              $("#tableDataKirimanBalik > tbody > tr").empty();
	              $.each(response,function(AvIndex,AvValue){
	                $("#tableDataKirimanBalik > tbody:last-child").append(
	                  "<tr>"+
	                    "<td>"+ ++AvIndex +"</td>"+
	                    "<td>"+AvValue.tgl_transaksi+"</td>"+
	                    "<td>"+AvValue.customer+"</td>"+
	                    "<td>"+AvValue.ukuran+"</td>"+
	                    "<td>"+AvValue.merek+"</td>"+
	                    "<td>"+AvValue.warna+"</td>"+
	                    "<td>"+AvValue.jumlah_berat+"</td>"+
	                    "<td>"+AvValue.jumlah_lembar+"</td>"+
	                    "<td>"+AvValue.note_gudanghasil+"</td>"+
	                    "<td>"+
	                      "<button class='btn btn-sm btn-flat btn-primary' onclick=editListKirimanBalik('"+AvValue.id_permintaan_jadi+"')><i class='fa fa-edit'></i>  Edit</button>"
	                    +"</td>"+
	                  "</tr>"
	                );
	              });
	            }
	          });
	        }

	        function editListKirimanBalik(id){
	        	$.ajax({
	        		type : "POST",
	        		url  : "<?php echo site_url("_cutting/main/getListKirimanBalikPerId") ?>",
	        		data : {id:id},
	        		dataType : "JSON",
	        		success:function(response){
        			 	$("#modalEditListKirimanBalik").modal({backdrop:"static"});
						$("#id").val(response[0].id_permintaan_jadi);
						$("#tanggal").val(response[0].tgl_transaksi);
						$("#customer").val(response[0].customer);
						$("#nmBarang").val(response[0].ukuran+" "+response[0].merek+" "+response[0].warna);
						$("#berat").val(response[0].jumlah_berat);
						$("#lembar").val(response[0].jumlah_lembar);
						$("#stsBarang").val(response[0].sts_barang);
						$("#note").val(response[0].note_gudanghasil);
						$("#berat").focus();
	        		}
	        	});
	        }

	        function kirimUlangKiriman(){
	        	var berat  = $("#berat").val();
	        	var lembar = $("#lembar").val();
	        	var id = $("#id").val();

	        	if (!berat||!lembar) {
	        		$("#modal-notif").modal("show")
		            $("#modalNotifContent").html("<div style='text-align: center;'><b>Kolom Tidak Boleh Kosong..!</b></div>");
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
	        			url  : "<?php echo site_url('_cutting/main/kirimUlangKiriman'); ?>",
	        			data : {berat:berat, lembar:lembar, id:id},
	        			success:function(response){
							if (jQuery.trim(response)=="Success"){
							    modalKirimanBalik();
							    alertKirimanBalikGudangHasil();
							    $("#modalEditListKirimanBalik").modal("hide");
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
			//============================================UNSPECIFIED METHOD (Finish)============================================//
		</script>
	</body>
</html>
