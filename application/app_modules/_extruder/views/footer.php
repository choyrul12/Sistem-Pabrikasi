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
			$(function(){
				datatablesListRencanaKerjaPPIC();
				if($("#tableRencanaMandorExtruder_KP").length){
					datatablesListRencanaKerjaExtruder("#tableRencanaMandorExtruder_KP","PROGRESS","KLIP");
				}
				if($("#tableRencanaMandorExtruder_ZP").length){
					datatablesListRencanaKerjaExtruder("#tableRencanaMandorExtruder_ZP","PROGRESS","ZP");
				}
				if($("#txtJumlahPenambahanBahanBaku").length && $("#txtSisaBijiKemarin").length){
					reloadJumlahPenambahanBahanBaku();
				}
				if($("#tableListBijiWarna").length){
					tableListBijiWarna();
				}
				if($("#tableHasilJobExtruder_Lokal").length){
					tableListHasilJobExtruder("LOKAL");
					reloadDataHasilJobExtruderFinal("LOKAL");
				}
				if($("#tableHasilJobExtruder_Export").length){
					tableListHasilJobExtruder("EXPORT");
					reloadDataHasilJobExtruderFinal("EXPORT");
				}

				if($("#tableListDataKirimanApal").length){
					tableDataBonApal();
				}

				setInterval(function(){
					if($("#txtJumlahPenambahanBahanBaku").length > 0 && $("#txtSisaBijiKemarin").length > 0){
						reloadJumlahPenambahanBahanBaku();
					}
					if($("#tableHasilJobExtruder_Lokal").length){
						tableListHasilJobExtruder("LOKAL");
						reloadDataHasilJobExtruderFinal("LOKAL");
					}
				},5000);
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

				if($("#rowBuatRencanaKerjaExtruder").length){
					$("body").removeClass("sidebar-mini").addClass("sidebar-collapse");
					modalBuatRencanaExtruder("<?php echo $this->uri->rsegment(3); ?>");
				}

				if($("#fileInputHasil").length){
					$("body").removeClass("sidebar-mini").addClass("sidebar-collapse");
					modalInputHasil("<?php echo $this->uri->rsegment(3); ?>");
				}

				if($("#fileInputHasilTertinggal").length){
					$("body").removeClass("sidebar-mini").addClass("sidebar-collapse");
					modalInputHasilTertinggal("<?php echo $this->uri->rsegment(3); ?>");
				}
				//======= Inisialisasi Komponen (End) =======
			});

		</script>
		<!--===============================================On Load Function (Finish) ===============================================-->

		<!--===============================================General Function (Start) ===============================================-->
		<script type="text/javascript">
			//============================================MODAL METHOD (Start)============================================//
			function modalKonversiBerat(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDetailRencanaPPIC",
					dataType : "JSON",
					data : {kdPpic : param},
					success : function(response){
						$.each(response,function(AvIndex, AvValue){
							$("#txtPermintaan").val(AvValue.jumlah_permintaan);
							$("#txtUkuran").val(AvValue.ukuran);
							$("#txtBerat").val(AvValue.berat);
							$("#txtTebal").val(AvValue.tebal);
							$("#txtSatuanKilo").val(AvValue.satuan_kilo);
							$("#btnKonversi").attr("onclick","saveKonversiBerat('"+AvValue.kd_ppic+"')");
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

			function modalEditStatusPpic(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDetailRencanaPPIC",
					dataType : "JSON",
					data : {kdPpic : param},
					success : function(response){
						$.each(response,function(AvIndex, AvValue){
							$("#cmbStatus").val(AvValue.sts_pengerjaan);
							$("#btnEditStatusRencana").attr("onclick","saveStatusPengerjaan('"+AvValue.kd_ppic+"')");
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

			function modalBuatRencanaExtruder(param){
				resetFormBuatRencanaBaru(param);
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getComboBoxValueMesin",
					dataType : "JSON",
					success : function(response){
						$("#cmbNoMesin").empty();
						$.each(response,function(AvIndex, AvValue){
							$("#cmbNoMesin").append(
								"<option value='"+AvValue.kd_mesin+"'>"+AvValue.no_mesin+" | ("+AvValue.ukuran_min+"-"+AvValue.ukuran_maks+") | "+AvValue.tebal+" | "+AvValue.sts_mesin+"</option>"
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

				$("#cmbStrip").on("change",function(){
					if($("#cmbStrip").val() == "CUSTOM"){
						$("#cmbStripWrapper").css("display","none");
						$("#txtStripWrapper").css("display","block");
					}else{
						$("#cmbStripWrapper").css("display","block");
						$("#txtStripWrapper").css("display","none");
					}
				});

				$("#closeTxtStrip").click(function(){
					$("#cmbStripWrapper").css("display","block");
					$("#txtStripWrapper").css("display","none");
					$("#cmbStrip").val("LOSE").trigger("change");
					$("#txtStrip").val("");
				});

				$("#cmbNoMesin").on("change",function(){
					var arrText = $("#cmbNoMesin option:selected").text().split(" | ");
					if(arrText[3] == "KP"){
						$("#cmbJenisMesin").val("KLIP");
					}else{
						$("#cmbJenisMesin").val("ZP");
					}
				});

				$("#cmbBahan").on("change", function(){
					if(this.value == "CUSTOM") {
						$("#comboWrapper").css("display","none");
						$("#textWrapper").css("display","block");
						$("#txtBahan").val("");
					}
				});
				$("#removeTextWrapper").click(function(){
					$("#comboWrapper").css("display","block");
					$("#textWrapper").css("display","none");
					$("#cmbBahan").val("TITAN VANE + PETLIN");
				});

				tableRencanaExtruderPending();
			}

			function modalUbahRencanaExtruderTemp(param,param2){
				var arrayStrip = new Array("LOSE","MERAH","PINK","MERAH ORAGE");
				var arrayBahan = ["TITAN VANE + PETLIN","PETLIN + EXXON"];
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDetailRencanaExtruder",
					dataType : "JSON",
					data : {kdExtruder : param},
					success : function(response){
						$.each(response, function(AvIndex, AvValue) {
							$("#txtKodeExtruder").val(AvValue.kd_extruder);
							$("#txtTglPengerjaan").val(AvValue.tgl_rencana);
							$("#cmbNoMesin").val(AvValue.kd_mesin).trigger("change");
							$("#txtNamaCustomer").val(AvValue.nm_cust);
							$("#cmbJenisMesin").val(AvValue.jns_mesin);
							$("#txtUkuranOrder").val(AvValue.ukuran);
							$("#txtWarna").val(AvValue.warna);
							$("#txtTebalOrder").val(AvValue.tebal);
							$("#txtPrioritasOrder").val(AvValue.prioritas);
							$("#txtJumlahRencanaPembuatan").val(AvValue.jml_permintaan);
							var strip = AvValue.strip;
							if(arrayStrip.indexOf(strip) != -1){
								$("#cmbStrip").val(AvValue.strip);
							}else{
								$("#cmbStrip").val("CUSTOM").trigger("change");
								$("#txtStrip").val(AvValue.strip);
							}
							$("#txtMotoran").val(AvValue.motoran);
							$("#txtExtruder").val(AvValue.extruder);
							if(arrayBahan.indexOf(AvValue.bahan) != -1){
								$("#cmbBahan").val(AvValue.bahan);
							}else{
								$("#cmbBahan").val("CUSTOM").trigger("change");
								$("#txtBahan").val(AvValue.bahan);
							}
							$("#txtBeratOrder").val(AvValue.berat);
							$("#btnTambahRencana").attr("onclick","editRencanaExtruderPending()").html("<i class='fa fa-pencil'></i> Ubah")
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

				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDetailRencanaPPIC",
					dataType : "JSON",
					data : {kdPpic : param2},
					success : function(response){
						$("#tableDetailRencanaPpic > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tableDetailRencanaPpic > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.nm_cust+"</td>"+
									"<td>"+AvValue.jns_permintaan+"</td>"+
									"<td>"+AvValue.merek+"</td>"+
									"<td>"+AvValue.ukuran+"</td>"+
									"<td>"+AvValue.warna_plastik+"</td>"+
									"<td>"+AvValue.tebal+"</td>"+
									"<td>"+AvValue.berat+"</td>"+
									"<td>"+AvValue.jumlah_permintaan+" "+AvValue.satuan+"</td>"+
									"<td>"+AvValue.sisa+" KG"+"</td>"+
									"<td>"+AvValue.strip+"</td>"+
									"<td>"+AvValue.prioritas+"</td>"+
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

			function modalEditStatus(param, param2, param3){
				if(param=="" || param2==""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Parameter Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					$("#txtKodeRencana").val(param);
					$("#cmbStatusRencana").val(param2);
					$("#btnUbahStatusRencana").attr("onclick","editStatusRencanaExtruder('"+param3+"')");
				}
			}

			function modalGantiMesin(param1, param2, param3){
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getComboBoxValueMesin",
					dataType : "JSON",
					success : function(response){
						$("#cmbNoMesin").empty();
						$.each(response,function(AvIndex, AvValue){
							$("#cmbNoMesin").append(
								"<option value='"+AvValue.kd_mesin+"'>"+AvValue.no_mesin+" | ("+AvValue.ukuran_min+"-"+AvValue.ukuran_maks+") | "+AvValue.tebal+" | "+AvValue.sts_mesin+"</option>"
							);
						});
						$("#cmbNoMesin").val(param2);
					},
					error : function(response){
						$("#modal-notif").addClass("modal-danger");
						$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-danger");
							$("#modalNotifContent").text("");
						},2000);
					}
				});
				$("#txtKodeRencana2").val(param1);
				$("#txtJenisMesin").val(param3);
				$("#btnEditGantiMesin").attr("onclick","editGantiMesin()");
			}

			function modalBuatRencanaSusulan(){
				resetFormBuatRencanaSusulanBaru();
				$("#cmbMerekGudangRoll").select2({
          placeholder : "Pilih Roll (POLOS)",
          dropdownParent: $("#modalBuatRencanaSusulan"),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_extruder/main/getComboBoxValueGudangRoll/POLOS",
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

				$("#cmbMerekGudangRoll").on("select2:select", function(){
					var dataText = $("#cmbMerekGudangRoll").select2("data")[0]["text"];
					var arrDataText = dataText.split(" | ");
					$("#txtUkuranPlastik").val(arrDataText[1]+"x");
				});

				$("#cmbMerekGudangRoll").on("select2:unselect",function(){
					$("#txtUkuranPlastik").val("");
				});

				$("#cmbBahan").on("change", function(){
					if(this.value == "CUSTOM") {
						$("#comboWrapper").css("display","none");
						$("#textWrapper").css("display","block");
						$("#txtBahan").val("");
					}
				});
				$("#removeTextWrapper").click(function(){
					$("#comboWrapper").css("display","block");
					$("#textWrapper").css("display","none");
					$("#cmbBahan").val("TITAN VANE + PETLIN");
				});

				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getComboBoxValueMesin",
					dataType : "JSON",
					success : function(response){
						$("#cmbNoMesin3").empty();
						$.each(response,function(AvIndex, AvValue){
							$("#cmbNoMesin3").append(
								"<option value='"+AvValue.kd_mesin+"'>"+AvValue.no_mesin+" | ("+AvValue.ukuran_min+"-"+AvValue.ukuran_maks+") | "+AvValue.tebal+" | "+AvValue.sts_mesin+"</option>"
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

				$("#cmbStrip").on("change",function(){
					if($("#cmbStrip").val() == "CUSTOM"){
						$("#cmbStripWrapper").css("display","none");
						$("#txtStripWrapper").css("display","block");
					}else{
						$("#cmbStripWrapper").css("display","block");
						$("#txtStripWrapper").css("display","none");
					}
				});

				$("#closeTxtStrip").click(function(){
					$("#cmbStripWrapper").css("display","block");
					$("#txtStripWrapper").css("display","none");
					$("#cmbStrip").val("LOSE").trigger("change");
					$("#txtStrip").val("");
				});

				$("#cmbNoMesin3").on("change",function(){
					var dataText = $("#cmbNoMesin3 option:selected").text();
					var arrDataText = dataText.split(" | ");
					if(arrDataText[3] == "KP"){
						$("#txtJenisMesin2").val("KLIP");
					}else{
						$("#txtJenisMesin2").val("ZP");
					}
				});
				tableRencanaExtruderSusulanPending();
			}

			function modalUbahRencanaSusulanExtruderTemp(param){
				var arrayStrip = new Array("LOSE","MERAH","PINK","MERAH ORAGE");
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDetailRencanaExtruder",
					dataType : "JSON",
					data : {kdExtruder : param},
					success : function(response){
						$.each(response, function(AvIndex, AvValue) {
							$("#txtKodeExtruder2").val(AvValue.kd_extruder);
							$("#cmbNoMesin3").val(AvValue.kd_mesin);
							$("#txtNamaCustomer2").val(AvValue.nm_cust);
							$("#txtJenisMesin2").val(AvValue.jns_mesin);
							$("#cmbMerekGudangRoll").val(AvValue.kd_gd_roll).trigger("change");
							$("#txtUkuranPlastik").val(AvValue.ukuran);
							//$("#txtWarna").val(AvValue.warna);
							$("#txtTebal1").val(AvValue.tebal);
							$("#cmbStatus").val(AvValue.prioritas);
							$("#txtJumlahRencanaPembuatan").val(AvValue.jml_permintaan);
							var strip = AvValue.strip;
							if(arrayStrip.indexOf(strip) != -1){
								$("#cmbStrip").val(AvValue.strip);
							}else{
								$("#cmbStrip").val("CUSTOM").trigger("change");
								$("#txtStrip").val(AvValue.strip);
							}
							$("#txtMotoran").val(AvValue.motoran);
							$("#txtExtruder").val(AvValue.extruder);
							$("#txtBahan").val(AvValue.bahan);
							$("#txtBeratOrder").val(AvValue.berat);
							$("#btnAddRencanaSusulan").attr("onclick","editRencanaExtruderSusulanPending()").html("<i class='fa fa-pencil'></i> Ubah")
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

			function modalInputHasil(param){
				$("input").val("");
				$(".date").datepicker("setDate",null);
				$("#txtJenisBarang").val("LOKAL");
				$("#cmbBijiWarna").val("");
				$("#cmbRollPipa").val("");
				$("#cmbShift").val("1");
				$("#cmbKeterangan").val("TS").trigger("change");
				$("#txtKodeExtruder3").val(param);
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getRencanaExtruderUntukInputHasil",
					dataType : "JSON",
					data : {
						idTransaksi : param
					},
					success : function(response) {
						$.each(response, function(AvIndex, AvValue){
							$("#txtKdGdRoll").val(AvValue.kd_gd_roll);
							$("#txtWarnaPlastik").val(AvValue.warna);
							$("#txtNoMesin").val(AvValue.mesin);
							$("#txtMerek").val(AvValue.merek);
							$("#txtJenisBarang").val(AvValue.jns_brg);
							if(AvValue.jns_permintaan==null){
								$("#txtJnsPermintaan").val(AvValue.jns_permintaan_roll);
							}else{
								$("#txtJnsPermintaan").val(AvValue.jns_permintaan);
							}
							$("#txtJumlahPermintaan").val(AvValue.jml_permintaan);
							$("#txtUkuranHasil").val(AvValue.ukuran);
							$("#txtTebalHasil").val(AvValue.tebal);
							$("#txtBeratHasil").val(AvValue.berat);
							$("#txtStripHasil").val(AvValue.strip);
							$("#lblSisa").text(AvValue.jml_permintaan +" Kg");
							if(AvValue.ket_merek_ppic == null || AvValue.ket_merek_ppic==""){
								$("#txtKetMerekHasil").val(AvValue.ket_merek);
							}else{
								$("#txtKetMerekHasil").val(AvValue.ket_merek_ppic);
							}
							$("#btnSaveHasilExtruder").attr("onclick","saveInputHasilExtruder()");
						});
						if(response[0].warna.indexOf(" muda")){
							var arrWarnaPlastik1 = response[0].warna.split(" muda");
							var warnaPlastik1 = arrWarnaPlastik1[0];
						}else{
							var warnaPlastik1 = response[0].warna;
						}
						$.ajax({
							type : "POST",
							url : "<?php echo base_url(); ?>_extruder/main/getBijiWarnaGudangBufferExtruder",
							dataType : "JSON",
							data : {warnaPlastik : warnaPlastik1},
							success : function(response){
								$("#cmbBijiWarna").empty();
								if(warnaPlastik1 != "" || warnaPlastik1 != "PUTIH" || warnaPlastik1 != "putih"){
									$("#cmbBijiWarna").append("<option value='putih'>PUTIH</option>");
									// $("#cmbBijiWarna").append("<option value=''>--Pilih Biji Warna--</option>");
									$.each(response, function(AvIndex,AvValue){
										$("#cmbBijiWarna").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.warna+" | "+AvValue.nm_barang+" | "+AvValue.status+"</option>");
									});
								}else{
									$("#cmbBijiWarna").append("<option value='putih'>PUTIH</option>");
									// $("#cmbBijiWarna").append("<option value=''>--Pilih Biji Warna--</option>");
									$.each(response, function(AvIndex,AvValue){
										$("#cmbBijiWarna").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.warna+" | "+AvValue.nm_barang+" | "+AvValue.status+"</option>");
									});
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
					},
					error : function(response){
						$("#modal-notif").addClass("modal-danger");
						$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-danger");
							$("#modalNotifContent").text("");
						},2000);
					}
				});
				$("#cmbBijiWarna").on("change",function(){
					var arrText = $("#cmbBijiWarna option:selected").text().split(" | ");
					switch (arrText[1]) {
						case "MERAH.FD.403"			: $("#txtKomposisi").val(200);
																 			break;
						case "BIRU.2643"					: $("#txtKomposisi").val(350);
														 					break;
						case "KUNINIG969"				: $("#txtKomposisi").val(600);
							 							 					break;
						case "silver.MBA8035"		: $("#txtKomposisi").val(900);
														 					break;
					  case "HIJAU.MB.4247"		: $("#txtKomposisi").val(600);
														 					break;
						case "PS"								: $("#txtKomposisi").val(1400);
															 				break;
					  case "HITAM.1203.M"			: $("#txtKomposisi").val(900);
															 				break;

						default: $("#txtKomposisi").val(0); break;
					}
				});

				$("#cmbKeterangan").on("change",function(e){
					var keterangan = $("#cmbKeterangan").val();
					if(keterangan == "STRIP"){
						var warnaStrip = $("#txtStripHasil").val();
						$("#tableStripWrapper").css("display","block");
						$.ajax({
							type : "POST",
							url : "<?php echo base_url(); ?>_extruder/main/getComboBoxValueBijiWarna",
							dataType : "JSON",
							data : {warna : warnaStrip},
							success : function(response){
								$("#cmbWarnaStrip").empty();
								$("#cmbWarnaStrip").append("<option value='PUTIH'>LOSE</option>"+
																					 "<option value='MP'>Merah Putih Susu</option>"+
																				 	 "<option value='MO'>Merah Orange</option>"+
																				   "<option value='MB'>Merah Biru</option>"+
																				 	 "<option value='MERAH / TS'>Merah / LOSE</option>"+
                                           "<option value='ORANGE / TS'>Orange / LOSE</option>");
								$.each(response, function(AvIndex,AvValue){
									$("#cmbWarnaStrip").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.warna+" | "+AvValue.nm_barang+"</option>");
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
					}else{
						$("#tableStripWrapper").css("display","none");
					}
				});

				$("#cmbRollPipa").on("change",function(){
					var rollPipa = $("#cmbRollPipa").val();
					if(rollPipa == "BOBIN"){
						$("#fieldRollPipaBobin").css("display","block");
						$("#fieldRollPayung").css("display","none");
						$("#txtPanjangPlastik").val("");
						$("#txtDoubleSingle").val("");
						$("#txtRumusRoll").val("");
						$("#txtJumlahBobin").val("");
						var ukuran = $("#txtUkuranHasil").val();
						var arrUkuran = ukuran.split("x");

						$("#txtPanjangPlastik").val(arrUkuran[0]);
						$("#txtRumusRoll").val("30");
					}else if(rollPipa == "PAYUNG"){
						$("#fieldRollPipaBobin").css("display","none");
						$("#fieldRollPayung").css("display","block");
						$("#tdPayung").text("Payung");
						$("#txtPayung").val("").attr("placeholder","Masukan Jumlah Payung");
						$("#txtRumusRollPayung").val("");
						var ukuran = $("#txtUkuranHasil").val();
						var ketMerek = $("#txtKetMerekHasil").val().toUpperCase();
						var arrUkuran = ukuran.split("x");
						var panjang = arrUkuran[0].replace(",",".");
						var arrPanjangPlastik = panjang.split("+");
						if(ketMerek.indexOf("PON") != -1){
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
													}
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;

							}
						}else{
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
								default:if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
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
					}else if(rollPipa == "PAYUNG_KUNING"){
						$("#fieldRollPipaBobin").css("display","none");
						$("#fieldRollPayung").css("display","block");
						$("#tdPayung").text("Payung Kuning");
						$("#txtPayung").val("").attr("placeholder","Masukan Jumlah Payung Kuning");
						$("#txtRumusRollPayung").val("");
						var ukuran = $("#txtUkuranHasil").val();
						var ketMerek = $("#txtKetMerekHasil").val().toUpperCase();
						var arrUkuran = ukuran.split("x");
						var panjang = arrUkuran[0].replace(",",".");
						var arrPanjangPlastik = panjang.split("+");
						if(ketMerek.indexOf("PON") != -1){
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
													}
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;

							}
						}else{
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
								default:if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
												 }
												 break;
							}
						}

						if(TPanjangPlastik <= 30){
							$("#txtRumusRollPayung").val(4000);
						}else{
							$("#txtRumusRollPayung").val(5000);
						}
					}else{
						$("#fieldRollPipaBobin").css("display","none");
						$("#fieldRollPayung").css("display","none");
						$("#txtPanjangPlastik").val("");
						$("#txtDoubleSingle").val("");
						$("#txtRumusRoll").val("");
						$("#txtRumusRollPayung").val("");
						$("#txtJumlahBobin").val("");
						$("#tdPayung").text("Payung");
						$("#txtPayung").val("").attr("placeholder","Masukan Jumlah Payung");
						$("#txtRumusRoll").val("");
					}
				});
			}

			function modalInputHasilTertinggal(param){
				$("input").val("");
				$(".date").datepicker("setDate",null);
				$("#txtJenisBarang").val("LOKAL");
				$("#cmbBijiWarna").val("");
				$("#cmbRollPipa").val("");
				$("#cmbShift").val("1");
				$("#cmbKeterangan").val("TS").trigger("change");
				$("#txtKodeExtruder3").val(param);
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getRencanaExtruderUntukInputHasil",
					dataType : "JSON",
					data : {
						idTransaksi : param
					},
					success : function(response) {
						$.each(response, function(AvIndex, AvValue){
							$("#txtKdGdRoll").val(AvValue.kd_gd_roll);
							$("#txtWarnaPlastik").val(AvValue.warna);
							$("#txtNoMesin").val(AvValue.mesin);
							$("#txtMerek").val(AvValue.merek);
							$("#txtJenisBarang").val(AvValue.jns_brg);
							if(AvValue.jns_permintaan==null){
								$("#txtJnsPermintaan").val(AvValue.jns_permintaan_roll);
							}else{
								$("#txtJnsPermintaan").val(AvValue.jns_permintaan);
							}
							$("#txtJumlahPermintaan").val(AvValue.jml_permintaan);
							$("#txtUkuranHasil").val(AvValue.ukuran);
							$("#txtTebalHasil").val(AvValue.tebal);
							$("#txtBeratHasil").val(AvValue.berat);
							$("#txtStripHasil").val(AvValue.strip);
							$("#lblSisa").text(AvValue.jml_permintaan +" Kg");
							if(AvValue.ket_merek_ppic == null || AvValue.ket_merek_ppic==""){
								$("#txtKetMerekHasil").val(AvValue.ket_merek);
							}else{
								$("#txtKetMerekHasil").val(AvValue.ket_merek_ppic);
							}
							$("#btnSaveHasilExtruder").attr("onclick","saveInputHasilExtruderTertinggal()");
						});
						var warnaPlastik1 = response[0].warna;
						$.ajax({
							type : "POST",
							url : "<?php echo base_url(); ?>_extruder/main/getBijiWarnaGudangBufferExtruder",
							dataType : "JSON",
							data : {warnaPlastik : warnaPlastik1},
							success : function(response){
								$("#cmbBijiWarna").empty();
								if(warnaPlastik1 != "" || warnaPlastik1 != "PUTIH" || warnaPlastik1 != "putih"){
									$("#cmbBijiWarna").append("<option value='putih'>PUTIH</option>");
									// $("#cmbBijiWarna").append("<option value=''>--Pilih Biji Warna--</option>");
									$.each(response, function(AvIndex,AvValue){
										$("#cmbBijiWarna").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.warna+" | "+AvValue.nm_barang+" | "+AvValue.status+"</option>");
									});
								}else{
									$("#cmbBijiWarna").append("<option value='putih'>PUTIH</option>");
									// $("#cmbBijiWarna").append("<option value=''>--Pilih Biji Warna--</option>");
									$.each(response, function(AvIndex,AvValue){
										$("#cmbBijiWarna").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.warna+" | "+AvValue.nm_barang+" | "+AvValue.status+"</option>");
									});
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
					},
					error : function(response){
						$("#modal-notif").addClass("modal-danger");
						$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-danger");
							$("#modalNotifContent").text("");
						},2000);
					}
				});
				$("#cmbBijiWarna").on("change",function(){
					var arrText = $("#cmbBijiWarna option:selected").text().split(" | ");
					switch (arrText[1]) {
						case "MERAH.FD.403"			: $("#txtKomposisi").val(200);
																 			break;
						case "BIRU.974"					: $("#txtKomposisi").val(350);
														 					break;
						case "KUNINIG969"				: $("#txtKomposisi").val(600);
							 							 					break;
						case "silver.MBA8035"		: $("#txtKomposisi").val(900);
														 					break;
					  case "HIJAU.MB.4247"		: $("#txtKomposisi").val(600);
														 					break;
						case "PS"								: $("#txtKomposisi").val(1400);
															 				break;
					  case "HITAM.1203.M"			: $("#txtKomposisi").val(900);
															 				break;

						default: $("#txtKomposisi").val(0); break;
					}
				});

				$("#cmbKeterangan").on("change",function(e){
					var keterangan = $("#cmbKeterangan").val();
					if(keterangan == "STRIP"){
						var warnaStrip = $("#txtStripHasil").val();
						$("#tableStripWrapper").css("display","block");
						$.ajax({
							type : "POST",
							url : "<?php echo base_url(); ?>_extruder/main/getComboBoxValueBijiWarna",
							dataType : "JSON",
							data : {warna : warnaStrip},
							success : function(response){
								$("#cmbWarnaStrip").empty();
								$("#cmbWarnaStrip").append("<option value='PUTIH'>LOSE</option>"+
																					 "<option value='MP'>Merah Putih Susu</option>"+
																				 	 "<option value='MO'>Merah Orange</option>"+
																				   "<option value='MB'>Merah Biru</option>"+
																				 	 "<option value='MERAH / TS'>Merah / LOSE</option>"+
                                           "<option value='ORANGE / TS'>Orange / LOSE</option>");
								$.each(response, function(AvIndex,AvValue){
									$("#cmbWarnaStrip").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.warna+" | "+AvValue.nm_barang+"</option>");
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
					}else{
						$("#tableStripWrapper").css("display","none");
					}
				});

				$("#cmbRollPipa").on("change",function(){
					var rollPipa = $("#cmbRollPipa").val();
					if(rollPipa == "BOBIN"){
						$("#fieldRollPipaBobin").css("display","block");
						$("#fieldRollPayung").css("display","none");
						$("#txtPanjangPlastik").val("");
						$("#txtDoubleSingle").val("");
						$("#txtRumusRoll").val("");
						$("#txtJumlahBobin").val("");
						var ukuran = $("#txtUkuranHasil").val();
						var arrUkuran = ukuran.split("x");

						$("#txtPanjangPlastik").val(arrUkuran[0]);
						$("#txtRumusRoll").val("30");
					}else if(rollPipa == "PAYUNG"){
						$("#fieldRollPipaBobin").css("display","none");
						$("#fieldRollPayung").css("display","block");
						$("#tdPayung").text("Payung");
						$("#txtPayung").val("").attr("placeholder","Masukan Jumlah Payung");
						$("#txtRumusRollPayung").val("");
						var ukuran = $("#txtUkuranHasil").val();
						var ketMerek = $("#txtKetMerekHasil").val().toUpperCase();
						var arrUkuran = ukuran.split("x");
						var panjang = arrUkuran[0].replace(",",".");
						var arrPanjangPlastik = panjang.split("+");
						if(ketMerek.indexOf("PON") != -1){
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
													}
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;

							}
						}else{
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
								default:if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
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
					}else if(rollPipa == "PAYUNG_KUNING"){
						$("#fieldRollPipaBobin").css("display","none");
						$("#fieldRollPayung").css("display","block");
						$("#tdPayung").text("Payung Kuning");
						$("#txtPayung").val("").attr("placeholder","Masukan Jumlah Payung Kuning");
						$("#txtRumusRollPayung").val("");
						var ukuran = $("#txtUkuranHasil").val();
						var ketMerek = $("#txtKetMerekHasil").val().toUpperCase();
						var arrUkuran = ukuran.split("x");
						var panjang = arrUkuran[0].replace(",",".");
						var arrPanjangPlastik = panjang.split("+");
						if(ketMerek.indexOf("PON") != -1){
							switch (arrPanjangPlastik.length) {
								case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
													}else{
														var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
													}
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;

							 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
													 }
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
													 }
												 }else{
													 var TPanjangPlastik = 0;
												 }
												 break;
								default: var TPanjangPlastik = 0; break;

							}
						}else{
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
								default:if(arrPanjangPlastik[0].indexOf("in") != -1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
												 }
												 break;
							}
						}
						if(TPanjangPlastik <= 30){
							$("#txtRumusRollPayung").val(4000);
						}else{
							$("#txtRumusRollPayung").val(5000);
						}
					}else{
						$("#fieldRollPipaBobin").css("display","none");
						$("#fieldRollPayung").css("display","none");
						$("#txtPanjangPlastik").val("");
						$("#txtDoubleSingle").val("");
						$("#txtRumusRoll").val("");
						$("#txtRumusRollPayung").val("");
						$("#txtJumlahBobin").val("");
						$("#tdPayung").text("Payung");
						$("#txtPayung").val("").attr("placeholder","Masukan Jumlah Payung");
						$("#txtRumusRoll").val("");
					}
				});
			}

			function modalMintaBahanBaku(){
				resetFormMintaBahanBaku();
				tableListPermintaanExtruder("BAHAN BAKU","LOKAL");
			}

			function modalEditPermintaanExtruderPending(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDetailTransaksiGudangBahan",
					dataType : 'JSON',
					data : {idTransaksi:param},
					success : function(response){
						$.each(response,function(AvIndex, AvValue){
							$("#txtTanggal").val(AvValue.tgl_permintaan);
							$("#txtBahan").val(AvValue.kd_gd_bahan);
							$("#txtJumlahPermintaan").val(AvValue.jumlah_permintaan);
							$("#btnTambahPermintaanBahanBaku").attr("onclick","editPermintaanExtruderPending('"+AvValue.id+"')").html("<i class='fa fa-pencil'></i> Ubah");
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

			function modalMintaBijiWarna(){
				resetFormMintaBijiWarna();
				tableListPermintaanBijiWarnaPending();
			}

			function modalTambahBijiWarna(){
				resetFormTambahBijiWarna();
				tableListTambahBijiWarnaPending();
			}

			function modalEditTambahBijiWarnaPending(param1, param2){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDetailTransaksiGudangBahan",
					dataType : "JSON",
					data : {
						idTransaksi : param1
					},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#txtTanggalTambah").val(AvValue.tgl_permintaan);
							$("#cmbBijiWarnaBaru").val(AvValue.kd_gd_bahan);
							$("#txtJumlahPermintaanBaru").val(AvValue.jumlah_permintaan);
							$("#btnTambahStokBijiWarnaPending").attr("onclick","editBijiWarnaBaru('"+AvValue.id+"','"+param2+"')").html("<i class='fa fa-pencil'></i> Ubah");
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

			function modalEditPermintaanBijiWarnaPending(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDetailTransaksiGudangBahan",
					dataType : "JSON",
					data : {idTransaksi : param},
					success : function(response) {
						$.each(response,function(AvIndex, AvValue){
							$("#txtTanggal").val(AvValue.tgl_permintaan);
							$("#cmbBijiWarna").val(AvValue.kd_gd_bahan);
							$("#txtJumlahPermintaan").val(AvValue.jumlah_permintaan);
							$("#btnTambahPermintaanBijiWarna").attr("onclick","editPermintaanBijiWarnaPending('"+AvValue.id+"')").html("<i class='fa fa-pencil'></i> Ubah");
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

			function modalEditHasilJobExtruder(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDetailTransaksiHasilJobExtruder",
					dataType : "JSON",
					data : {idTransaksi : param},
					success : function(response){
						$("#cmbRollPipa_Edit").on("change",function(){
							var rollPipa = $("#cmbRollPipa_Edit").val();
							if(rollPipa == "BOBIN"){
								$("#fieldRollPipaBobin_Edit").css("display","block");
								$("#fieldRollPayung_Edit").css("display","none");

								$("#txtPanjangPlastik_Edit").val("");
								$("#txtDoubleSingle_Edit").val("");
								$("#txtRumusRoll_Edit").val("");
								$("#txtJumlahBobin_Edit").val("");

								var ukuran = $("#txtUkuranPlastik_Edit").val();
								var arrUkuran = ukuran.split("x");

								$("#txtPanjangPlastik_Edit").val(response[0].panjang);
								$("#txtRumusRoll_Edit").val("30");
								$("#txtJumlahBobin_Edit").val(response[0].roll_lembar);
							}else if(rollPipa == "PAYUNG"){
								$("#fieldRollPipaBobin_Edit").css("display","none");
								$("#fieldRollPayung_Edit").css("display","block");
								$("#tdPayung_Edit").text("Payung");
								$("#txtPayung_Edit").val(response[0].roll_lembar).attr("placeholder","Masukan Jumlah Payung");
								$("#txtRumusRollPayung_Edit").val("");
								var ukuran = $("#txtUkuranPlastik_Edit").val();
								var ketMerek = $("#txtKetMerekHasil_Edit").val().toUpperCase();
								var arrUkuran = ukuran.split("x");
								var panjang = arrUkuran[0].replace(",",".");
								var arrPanjangPlastik = panjang.split("+");
								if(ketMerek.indexOf("PON") != -1){
									switch (arrPanjangPlastik.length) {
										case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
																if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
															}else{
																var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
															}
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;

									 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;
										default: var TPanjangPlastik = 0; break;

									}
								}else{
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
										default:if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
														 }
														 break;
									}
								}

								if(TPanjangPlastik < 6){
									$("#txtRumusRollPayung_Edit").val(5000);
								}else if(TPanjangPlastik >= 6 && TPanjangPlastik < 40){
									$("#txtRumusRollPayung_Edit").val(6000);
								}else{
									$("#txtRumusRollPayung_Edit").val(7000);
								}
							}else if(rollPipa == "PAYUNG_KUNING"){
								$("#fieldRollPipaBobin").css("display","none");
								$("#fieldRollPayung").css("display","block");
								$("#tdPayung_Edit").text("Payung Kuning");
								$("#txtPayung_Edit").val(response[0].roll_lembar).attr("placeholder","Masukan Jumlah Payung Kuning");
								$("#txtRumusRollPayung_Edit").val("");
								var ukuran = $("#txtUkuranPlastik_Edit").val();
								var ketMerek = $("#txtKetMerekHasil_Edit").val().toUpperCase();
								var arrUkuran = ukuran.split("x");
								var panjang = arrUkuran[0].replace(",",".");
								var arrPanjangPlastik = panjang.split("+");
								if(ketMerek.indexOf("PON") != -1){
									switch (arrPanjangPlastik.length) {
										case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
																if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
															}else{
																var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
															}
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;

									 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;
										default: var TPanjangPlastik = 0; break;

									}
								}else{
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
										default:if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
														 }
														 break;
									}
								}
								if(TPanjangPlastik <= 30){
									$("#txtRumusRollPayung_Edit").val(4000);
								}else{
									$("#txtRumusRollPayung_Edit").val(5000);
								}
							}else{
								$("#fieldRollPipaBobin_Edit").css("display","none");
								$("#fieldRollPayung_Edit").css("display","none");
								$("#txtPanjangPlastik_Edit").val("");
								$("#txtDoubleSingle_Edit").val("");
								$("#txtRumusRoll_Edit").val("");
								$("#txtRumusRollPayung_Edit").val("");
								$("#txtJumlahBobin_Edit").val("");
								$("#tdPayung_Edit").text("Payung");
								$("#txtPayung_Edit").val("").attr("placeholder","Masukan Jumlah Payung");
								$("#txtRumusRoll_Edit").val("");
							}
						});

						$("#cmbKeterangan_Edit").on("change",function(e){
							var keterangan = $("#cmbKeterangan_Edit").val();
							var warnaStrip = $("#txtWarnaStrip").val();
							if(keterangan == "STRIP"){
								$("#tableStripWrapper_Edit").css("display","block");
								$.ajax({
									type : "POST",
									url : "<?php echo base_url(); ?>_extruder/main/getComboBoxValueBijiWarna",
									dataType : "JSON",
									data : {warna : warnaStrip},
									success : function(response){
										$("#cmbWarnaStrip_Edit").empty();
										$("#cmbWarnaStrip_Edit").append("<option value=''>--Pilih Warna Strip--</option>"+
																										"<option value='PUTIH'>Putih</option>"+
																							 			"<option value='MP'>Merah Putih Susu</option>"+
																						 	 			"<option value='MO'>Merah Orange</option>"+
																						   			"<option value='MB'>Merah Biru</option>"+
																						 	 			"<option value='MERAH / TS'>Merah / TS</option>"+
		                                           			"<option value='ORANGE / TS'>Orange / TS</option>");
										$.each(response, function(AvIndex,AvValue){
											$("#cmbWarnaStrip_Edit").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.warna+" | "+AvValue.nm_barang+"</option>");
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
							}else{
								$("#tableStripWrapper_Edit").css("display","none");
							}
						});

						var warnaPlastik1 = response[0].warna_plastik;
						$.ajax({
							type : "POST",
							url : "<?php echo base_url(); ?>_extruder/main/getBijiWarnaGudangBufferExtruder",
							dataType : "JSON",
							data : {warnaPlastik : warnaPlastik1},
							success : function(response){
								$("#cmbBijiWarna_Edit").empty();
								if(warnaPlastik1 != "" || warnaPlastik1 != "PUTIH" || warnaPlastik1 != "putih"){
									$("#cmbBijiWarna_Edit").append("<option value=''>--Pilih Biji Warna--</option>");
									$.each(response, function(AvIndex,AvValue){
										$("#cmbBijiWarna_Edit").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.warna+" | "+AvValue.nm_barang+" | "+AvValue.status+"</option>");
									});
									$("#cmbBijiWarna_Edit").append("<option value='putih'>PUTIH</option>");
								}else{
									$("#cmbBijiWarna_Edit").append("<option value=''>--Pilih Biji Warna--</option>");
									$("#cmbBijiWarna_Edit").append("<option value='putih'>PUTIH</option>");
									$.each(response, function(AvIndex,AvValue){
										$("#cmbBijiWarna_Edit").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.warna+" | "+AvValue.nm_barang+" | "+AvValue.status+"</option>");
									});
								}
							}
						});

						$("#cmbBijiWarna_Edit").on("change",function(){
							var arrText = $("#cmbBijiWarna_Edit option:selected").text().split(" | ");
							switch (arrText[1]) {
								case "MERAH.FD.403"			: $("#txtKomposisi_Edit").val(200);
																		 			break;
								case "BIRU.974"					: $("#txtKomposisi_Edit").val(350);
																 					break;
								case "KUNINIG969"				: $("#txtKomposisi_Edit").val(600);
									 							 					break;
								case "silver.MBA8035"		: $("#txtKomposisi_Edit").val(900);
																 					break;
							  case "HIJAU.MB.4247"		: $("#txtKomposisi_Edit").val(600);
																 					break;
								case "PS"								: $("#txtKomposisi_Edit").val(1400);
																	 				break;
							  case "HITAM.1203.M"			: $("#txtKomposisi_Edit").val(900);
																	 				break;

								default: $("#txtKomposisi_Edit").val(0); break;
							}
						});

						$.each(response,function(AvIndex, AvValue){
							$("#txtKodeExtruder_Edit").val(AvValue.kd_extruder);
							$("#txtJenisBarang_Edit").val(AvValue.jns_brg);
							$("#txtNoMesin_Edit").val(AvValue.no_mesin);
							$("#txtUkuranPlastik_Edit").val(AvValue.hasil_ukuran);
							$("#txtBeratHasil_Edit").val(AvValue.hasil_berat);
							$("#cmbShift_Edit").val(AvValue.shift);
							$("#txtWarnaStrip").val(AvValue.warna_strip);
							$("#cmbKeterangan_Edit").val(AvValue.keterangan).trigger("change");
							$("#txtJumlahHasil_Edit").val(AvValue.jumlah_selesai);
							$("#cmbRollPipa_Edit").val(AvValue.jenis_roll).trigger("change");
							$("#txtJumlahBijiWarna").val(AvValue.jumlah_biji_warna);
							$("#txtTglRencana").val(AvValue.tgl_rencana);
							$("#txtJumlahPemakaianStrip").val(AvValue.pemakaian_strip);
							if(AvValue.ket_merek_ppic=="" || AvValue.ket_merek_ppic==null){
								$("#txtKetMerekHasil_Edit").val(AvValue.ket_merek);
							}else{
								$("#txtKetMerekHasil_Edit").val(AvValue.ket_merek_ppic);
							}
						});
						$("#btnEditHasilJobExtruder").attr("onclick","editHasilJobExtruder('"+param+"')");
					},
					error : function(response){
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

			function modalTambahBonApal(){
				resetFormTambahBonApal();
			}

			function modalEditDataBonApal(param,param2){
				resetFormTambahBonApal();
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDataBonApalPending",
					dataType : "JSON",
					data : {idTransaksi : param},
					success : function(response){
						$("#btnTambahBarangApal").attr("onclick","editDataBonApal('"+param+"','"+param2+"')").html("<i class='fa fa-pencil'></i> Ubah").removeClass("btn-primary").addClass("btn-warning");
						$("#modalTambahKirimanApal").modal("show");
						$.each(response,function(AvIndex, AvValue){
							$("#txtJumlahApal").val(AvValue.jumlah_apal);
							$("#cmbJenisApal").val(AvValue.kd_gd_apal);
							$("#txtShift").val(AvValue.shift);
							$("#txtTanggal").val(AvValue.tgl_transaksi);
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

			function modalTambahKembalianBahanBaku(){
				resetFormKembalianBahanBaku();
			}

			function modalEditKembalianBahanBaku(param){
				//resetFormKembalianBahanBaku();
				$.ajax({
					type : "POST",
					url  : "<?php echo base_url(); ?>_extruder/main/getDetailKembalianBahanBaku",
					dataType : "JSON",
					data : {idTransaksi : param},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#cmbBahanBaku").val(AvValue.kd_gd_bahan);
							$("#txtJumlahKembalian").val(AvValue.jumlah_permintaan);
							$("#btnTambahKembalianBahanBakuPending").removeClass("btn-primary").addClass("btn-warning").html("<i class='fa fa-pencil'></i> Ubah").attr("onclick","editKembalianBahanBaku('"+AvValue.id+"')");
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

			function modalCariHistoryBijiWarna(){
				$("input").val("");
				$(".date").datepicker("setDate",null);

				$.ajax({
					url : '<?php echo base_url(); ?>_extruder/main/getComboBoxValueBijiWarna',
					dataType : "JSON",
					success : function(response){
						$("#cmbBijiWarna_History").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#cmbBijiWarna_History").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.nm_barang+"("+AvValue.warna+")</option>")
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

			function modalTambahKembalianBijiWarna(){
				resetFormKembalianBijiWarna();
			}

			function modalEditKembalianBijiWarna(param){
				//resetFormKembalianBijiWarna();
				$.ajax({
					type : "POST",
					url  : "<?php echo base_url(); ?>_extruder/main/getDetailKembalianBijiWarna",
					dataType : "JSON",
					data : {idTransaksi : param},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#cmbBijiWarna").val(AvValue.kd_gd_bahan);
							$("#txtJumlah").val(AvValue.jumlah_permintaan);
							$("#txtTanggal").val(AvValue.tgl_permintaan);
							$("#btnTambahPengembalianBijiWarnaPending").removeClass("btn-primary").addClass("btn-warning").html("<i class='fa fa-pencil'></i> Ubah").attr("onclick","editKembalianBijiWarna('"+AvValue.id+"')");
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

			function modalEditHasilExtruder(param, param2, param3, param4){
				$("#cmbKeterangan").on("click",function(){
					var keterangan = $(this).val();
					var warnaStrip = $("#txtStripHasil").val();
					if(keterangan == "STRIP"){
						$("#tableStripWrapper").css("display","block");
						$.ajax({
							type : "POST",
							url : "<?php echo base_url(); ?>_extruder/main/getComboBoxValueBijiWarna",
							dataType : "JSON",
							data : {warna : warnaStrip},
							success : function(response){
								$("#cmbWarnaStrip").empty();
								$("#cmbWarnaStrip").append("<option value=''>--Pilih Warna Strip--</option>"+
																								"<option value='PUTIH'>Putih</option>"+
																								"<option value='MP'>Merah Putih Susu</option>"+
																								"<option value='MO'>Merah Orange</option>"+
																								"<option value='MB'>Merah Biru</option>"+
																								"<option value='MERAH / TS'>Merah / TS</option>"+
																								"<option value='ORANGE / TS'>Orange / TS</option>");
								$.each(response, function(AvIndex,AvValue){
									$("#cmbWarnaStrip").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.warna+" | "+AvValue.nm_barang+"</option>");
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
					}else{
						$("#tableStripWrapper").css("display","none");
					}
				});

				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDetailTransaksiHasilJobExtruder",
					dataType : "JSON",
					data : {idTransaksi : param},
					success : function(response){
						var warnaPlastik1 = response[0].warna_plastik;
						$.ajax({
							type : "POST",
							url : "<?php echo base_url(); ?>_extruder/main/getBijiWarnaGudangBufferExtruder",
							dataType : "JSON",
							data : {warnaPlastik : warnaPlastik1},
							success : function(response){
								$("#cmbBijiWarna").empty();
								if(warnaPlastik1 != "" || warnaPlastik1 != "PUTIH" || warnaPlastik1 != "putih"){
									$("#cmbBijiWarna").append("<option value=''>--Pilih Biji Warna--</option>");
									$.each(response, function(AvIndex,AvValue){
										$("#cmbBijiWarna").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.warna+" | "+AvValue.nm_barang+" | "+AvValue.status+"</option>");
									});
									$("#cmbBijiWarna").append("<option value='putih'>PUTIH</option>");
								}else{
									$("#cmbBijiWarna").append("<option value=''>--Pilih Biji Warna--</option>");
									$("#cmbBijiWarna").append("<option value='putih'>PUTIH</option>");
									$.each(response, function(AvIndex,AvValue){
										$("#cmbBijiWarna").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.warna+" | "+AvValue.nm_barang+" | "+AvValue.status+"</option>");
									});
								}
							}
						});
						$("#cmbRollPipa").on("change",function(){
							var rollPipa = $("#cmbRollPipa").val();
							if(rollPipa == "BOBIN"){
								$("#fieldRollPipaBobin").css("display","block");
								$("#fieldRollPayung").css("display","none");

								$("#txtPanjangPlastik").val("");
								$("#txtDoubleSingle").val("");
								$("#txtRumusRoll").val("");
								$("#txtJumlahBobin").val("");

								var ukuran = $("#txtUkuranHasil").val();
								var arrUkuran = ukuran.split("x");

								$("#txtPanjangPlastik").val(response[0].panjang);
								$("#txtRumusRoll").val("30");
								$("#txtJumlahBobin").val(response[0].roll_lembar);
							}else if(rollPipa == "PAYUNG"){
								$("#fieldRollPipaBobin").css("display","none");
								$("#fieldRollPayung").css("display","block");
								$("#tdPayung").text("Payung");
								$("#txtPayung").val(response[0].roll_lembar).attr("placeholder","Masukan Jumlah Payung");
								$("#txtRumusRollPayung").val("");
								var ukuran = $("#txtUkuranHasil").val();
								var ketMerek = $("#txtKetMerekHasil").val().toUpperCase();
								var arrUkuran = ukuran.split("x");
								var panjang = arrUkuran[0].replace(",",".");
								var arrPanjangPlastik = panjang.split("+");
								if(ketMerek.indexOf("PON") != -1){
									switch (arrPanjangPlastik.length) {
										case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
																if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
															}else{
																var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
															}
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;

									 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;
										default: var TPanjangPlastik = 0; break;

									}
								}else{
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
										default:if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
														 }
														 break;
									}
								}

								if(TPanjangPlastik < 6){
									$("#txtRumusRollPayung").val(5000);
								}else if(TPanjangPlastik >= 6 && TPanjangPlastik < 40){
									$("#txtRumusRollPayung").val(6000);
								}else{
									$("#txtRumusRollPayung").val(7000);
								}
							}else if(rollPipa == "PAYUNG_KUNING"){
								$("#fieldRollPipaBobin").css("display","none");
								$("#fieldRollPayung").css("display","block");
								$("#tdPayung").text("Payung Kuning");
								$("#txtPayung").val(response[0].roll_lembar).attr("placeholder","Masukan Jumlah Payung Kuning");
								$("#txtRumusRollPayung").val("");
								var ukuran = $("#txtUkuranHasil").val();
								var ketMerek = $("#txtKetMerekHasil").val().toUpperCase();
								var arrUkuran = ukuran.split("x");
								var panjang = arrUkuran[0].replace(",",".");
								var arrPanjangPlastik = panjang.split("+");
								if(ketMerek.indexOf("PON") != -1){
									switch (arrPanjangPlastik.length) {
										case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
																if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + 5.5;
															}else{
																var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
															}
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;

									 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
															 }
														 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
															 if(arrPanjangPlastik[0].indexOf("in") != -1){
																 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
															 }else{
																 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
															 }
														 }else{
															 var TPanjangPlastik = 0;
														 }
														 break;
										default: var TPanjangPlastik = 0; break;

									}
								}else{
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
										default:if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik) * 2.54;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik);
														 }
														 break;
									}
								}
								console.log(TPanjangPlastik);
								if(TPanjangPlastik <= 30){
									$("#txtRumusRollPayung").val(4000);
								}else{
									$("#txtRumusRollPayung").val(5000);
								}
							}else{
								$("#fieldRollPipaBobin").css("display","none");
								$("#fieldRollPayung").css("display","none");
								$("#txtPanjangPlastik").val("");
								$("#txtDoubleSingle").val("");
								$("#txtRumusRoll").val("");
								$("#txtRumusRollPayung").val("");
								$("#txtJumlahBobin").val("");
								$("#tdPayung").text("Payung");
								$("#txtPayung").val("").attr("placeholder","Masukan Jumlah Payung");
								$("#txtRumusRoll").val("");
							}
						});


						$("#cmbBijiWarna").on("change",function(){
							var arrText = $("#cmbBijiWarna option:selected").text().split(" | ");
							switch (arrText[1]) {
								case "MERAH.FD.403"			: $("#txtKomposisi").val(200);
																		 			break;
								case "BIRU.974"					: $("#txtKomposisi").val(350);
																 					break;
								case "KUNINIG969"				: $("#txtKomposisi").val(600);
									 							 					break;
								case "silver.MBA8035"		: $("#txtKomposisi").val(900);
																 					break;
							  case "HIJAU.MB.4247"		: $("#txtKomposisi").val(600);
																 					break;
								case "PS"								: $("#txtKomposisi").val(1400);
																	 				break;
							  case "HITAM.1203.M"			: $("#txtKomposisi").val(900);
																	 				break;

								default: $("#txtKomposisi").val(0); break;
							}
						});

							$("#txtKodeExtruder3").val(response[0].kd_extruder);
							$("#txtJenisBarang").val(response[0].jns_brg);
							$("#txtNoMesin").val(response[0].no_mesin);
							$("#txtUkuranHasil").val(response[0].hasil_ukuran);
							$("#txtBeratHasil").val(response[0].hasil_berat);
							$("#cmbShift").val(response[0].shift);
							$("#txtStripHasil").val(response[0].warna_strip);
							$("#txtJumlahHasil").val(response[0].jumlah_selesai);
							$("#cmbRollPipa").val(response[0].jenis_roll).trigger("change");
							$("#cmbKeterangan").val(response[0].keterangan);
							//$("#txtJumlahBijiWarna").val(AvValue.jumlah_biji_warna);
							$("#txtTglHasil").val(response[0].tgl_rencana);
							$("#txtJumlahPemakaianStrip").val(response[0].pemakaian_strip);
							$("#txtMerek").val(response[0].merek);
							$("#txtWarnaPlastik").val(response[0].warna_plastik);
							$("#txtJnsPermintaan").val(response[0].jns_permintaan);
							$("#txtTebalHasil").val(response[0].tebal);
							$("#lblSisa").text(response[0].jml_permintaan + " KG");
							$("#txtKdGdRoll").val(response[0].kd_gd_roll);
							$("#txtJumlahPermintaan").val(response[0].jml_permintaan);
							if(response[0].ket_merek_ppic=="" || response[0].ket_merek_ppic==null){
								$("#txtKetMerekHasil").val(response[0].ket_merek);
							}else{
								$("#txtKetMerekHasil").val(response[0].ket_merek_ppic);
							}
						$("#btnSaveHasilExtruder").attr("onclick","editHasilExtruder('"+param+"','"+param2+"','"+param3+"','"+param4+"')");
						$("#modalEditHasil").modal({backdrop : "static"});
						$("#cmbMerek").select2({
		          placeholder : "Pilih Roll (POLOS)",
		          dropdownParent: $("#modalEditHasil"),
		          width : "100%",
		          cache:false,
		          allowClear:true,
		          ajax:{
		            url : "<?php echo base_url(); ?>_extruder/main/getComboRencanaMandorExtruder",
		            dataType : "JSON",
		            delay : 0,
		            processResults : function(data){
		              return{
		                results : $.map(data, function(item){
		                  return{
		                    text:item.nm_cust+" | "+item.ukuran+" | "+item.merek+" | "+item.warna+" | "+item.strip,
		                    id:item.kode
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

			//============================================MODAL METHOD (Finish)============================================//

			//============================================SAVE METHOD (Start)============================================//
			function saveKonversiBerat(param){
				var satuanKilo1 = $("#txtSatuanKilo").val().replace(/,/g, "");
				if(param=="" || satuanKilo1==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/saveKonversiBerat",
						dataType : "TEXT",
						data : {kdPpic : param, satuanKilo : satuanKilo1},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Konversi Berhasil Disimpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									$(".active a[aria-controls='tableRencanaPpic']").trigger('click');
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Konversi Gagal Disimpan");
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

			function saveStatusPengerjaan(param){
				var status = $("#cmbStatus").val();
				if(param=="" || status==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/saveStatusPengerjaan",
						dataType : "TEXT",
						data : {kdPpic : param, statusPengerjaan : status},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Perubahan Status Berhasil Disimpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									$("#modalEditStatus").modal("hide");
									$(".active a").trigger("click");
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Perubahan Status Gagal Disimpan");
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

			function saveAddRencanaExtruder(param1, param2, param3){
				var kdExtruder1 = $("#txtKodeExtruder").val();
				var kdPpic1 = param1;
				var kdGdRoll1 = param2;
				var kdMesin1 = $("#cmbNoMesin").val();
				var nmCust1 = $("#txtNamaCustomer").val();
				var jnsMesin1 = $("#cmbJenisMesin").val();
				var merek1 = param3;
				var ukuran1 = $("#txtUkuranOrder").val();
				var warna1 = $("#txtWarna").val();
				var tebal1 = $("#txtTebalOrder").val().replace(/,/g, "");
				var jumlahPermintaan1 = $("#txtJumlahRencanaPembuatan").val().replace(/,/g, "");
				if($("#cmbStrip").val() == "CUSTOM"){
					var strip1 = $("#txtStrip").val().toUpperCase();
				}else{
					var strip1 = $("#cmbStrip").val().toUpperCase();
				}
				var tglRencana1 = $("#txtTglPengerjaan").val();
				var motoran1 = $("#txtMotoran").val();
				var extruder1 = $("#txtExtruder").val();
				var berat1 = $("#txtBeratOrder").val();
				if($("#cmbBahan").val() == "CUSTOM"){
					var bahan1= $("#txtBahan").val();
				}else{
					var bahan1= $("#cmbBahan").val();
				}
				var prioritas1 = $("#txtPrioritasOrder").val();

				if(kdExtruder1=="" || kdPpic1=="" || kdGdRoll1=="" || kdMesin1=="" || nmCust1=="" ||
					 jnsMesin1=="" || merek1=="" || ukuran1=="" || warna1=="" || tebal1=="" ||
				 	 jumlahPermintaan1=="" || strip1=="" || tglRencana1=="" || berat1=="" || bahan1==""
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
						url : "<?php echo base_url(); ?>_extruder/main/saveAddRencanaExtruder",
						dataType : "TEXT",
						data : {
							kdExtruder 				: kdExtruder1,
							kdPpic 						: kdPpic1,
							kdGdRoll 					: kdGdRoll1,
							kdMesin 					: kdMesin1,
							nmCust 						: nmCust1,
							jnsMesin 					: jnsMesin1,
							merek 						: merek1,
							ukuran 						: ukuran1,
							warna 						: warna1,
							tebal 						: tebal1,
							jumlahPermintaan 	: jumlahPermintaan1,
							strip 						: strip1,
							tglRencana 				: tglRencana1,
							motoran 					: motoran1,
							extruder 					: extruder1,
							berat 						: berat1,
							bahan 						: bahan1,
							prioritas					: prioritas1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Rencana Berhasil Ditambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									tableRencanaExtruderPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Rencana Gagal Ditambahkan");
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

			function saveAddRencanaExtruderSusulan(){
				var kdExtruder1 = $("#txtKodeExtruder2").val();
				var kdGdRoll1 = $("#cmbMerekGudangRoll").val();
				var kdMesin1 = $("#cmbNoMesin3").val();
				var nmCust1 = $("#txtNamaCustomer2").val();
				var jnsMesin1 = $("#txtJenisMesin2").val();
				var dataText = $("#cmbMerekGudangRoll").select2("data")[0]["text"];
				var arrDataText = dataText.split(" | ");
				var merek1 = arrDataText[2];
				var ukuran1 = $("#txtUkuranPlastik").val();
				var warna1 = arrDataText[3];
				var tebal1 = $("#txtTebal1").val();
				var jumlahPermintaan1 = $("#txtJumlahRencanaPembuatan	").val().replace(/,/g, "");
				if($("#cmbStrip").val() == "CUSTOM"){
					var strip1 = $("#txtStrip").val().toUpperCase();
				}else{
					var strip1 = $("#cmbStrip").val().toUpperCase();
				}
				var tglRencana1 = $("#txtTglPengerjaan").val();
				var motoran1 = $("#txtMotoran").val();
				var extruder1 = $("#txtExtruder").val();
				var keteranganMerek1 = $("#txtKetMerek").val();
				var berat1 = $("#txtBeratOrder").val().replace(/,/g, "");
				if($("#cmbBahan").val() == "CUSTOM"){
					var bahan1= $("#txtBahan").val();
				}else{
					var bahan1= $("#cmbBahan").val();
				}
				var prioritas1 = $("#cmbStatus").val();

				if(kdExtruder1=="" || kdGdRoll1=="" || kdMesin1=="" || nmCust1=="" ||
					 jnsMesin1=="" || merek1=="" || ukuran1=="" || warna1=="" || tebal1=="" ||
				 	 jumlahPermintaan1=="" || strip1=="" || tglRencana1==""|| bahan1==""
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
						url : "<?php echo base_url(); ?>_extruder/main/saveAddRencanaExtruderSusulan",
						dataType : "TEXT",
						data : {
							kdExtruder 				: kdExtruder1,
							kdGdRoll 					: kdGdRoll1,
							kdMesin 					: kdMesin1,
							nmCust 						: nmCust1,
							jnsMesin 					: jnsMesin1,
							merek 						: merek1,
							ukuran 						: ukuran1,
							warna 						: warna1,
							tebal 						: tebal1,
							jumlahPermintaan 	: jumlahPermintaan1,
							strip 						: strip1,
							tglRencana 				: tglRencana1,
							motoran 					: motoran1,
							extruder 					: extruder1,
							ketMerek					: keteranganMerek1,
							berat 						: berat1,
							bahan 						: bahan1,
							prioritas					: prioritas1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Rencana Berhasil Ditambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									tableRencanaExtruderSusulanPending();
									resetFormBuatRencanaSusulanBaru();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Rencana Gagal Ditambahkan");
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

			function saveRencanaExtruder(){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						url : "<?php echo base_url(); ?>_extruder/main/saveRencanaExtruder",
						dataType : "TEXT",
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Rencana Berhasil Disimpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									tableRencanaExtruderPending();
								},2000);
								setTimeout(function(){
									document.location='<?php echo base_url("_extruder/main/data_rencana_mandor") ?>';
								},2500);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Beberapa Rencana Gagal Disimpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Gagal, Tidak Ada Data Untuk Dikirim!");
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

			function saveRencanaExtruderSusulan(){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						url : "<?php echo base_url(); ?>_extruder/main/saveRencanaExtruderSusulan",
						dataType : "TEXT",
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Rencana Berhasil Disimpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									tableRencanaExtruderSusulanPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Beberapa Rencana Gagal Disimpan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Gagal, Tidak Ada Data Untuk Dikirim!");
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

			function saveAddPermintaanBahanBaku(){
				var kdBahan1 = $("#txtBahan").val();
				var tglPermintaan1 = $("#txtTanggal").val();
				var jumlahPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g, "");
				var shift1 = $("#cmbShift").val();

				if(kdBahan1 =="" || tglPermintaan1=="" || jumlahPermintaan1=="" || shift1==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/saveAddPermintaanBahanBaku",
						dataType : "TEXT",
						data : {
							kdGdBahan 				: kdBahan1,
							tglPermintaan 		: tglPermintaan1,
							jumlahPermintaan 	: jumlahPermintaan1,
							shift							:	shift1
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
									resetFormMintaBahanBaku();
									tableListPermintaanExtruder("BAHAN BAKU", "LOKAL");
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Ditambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Bulan Tersebut Sudah Di Lock!");
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

			function savePermintaanBahanBaku(param1, param2){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_extruder/main/savePermintaanBahanBaku",
						dataType : "TEXT",
						data : {
							jenis : param1,
							status : param2
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
									resetFormMintaBahanBaku();
									tableListPermintaanExtruder(param1, param2);
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Ditambahkan");
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

			function saveAddBijiWarnaBaru(){
				var tanggal = $("#txtTanggalTambah").val();
				var kdGdBahan1 = $("#cmbBijiWarnaBaru").val();
				var jumlahPermintaan1 = $("#txtJumlahPermintaanBaru").val().replace(/,/g,"");

				if(tanggal==""||kdGdBahan1==""||jumlahPermintaan1==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/saveAddBijiWarnaPending",
						dataType : "TEXT",
						data : {
							kdGdBahan 				: kdGdBahan1,
							jumlahPermintaan 	: jumlahPermintaan1,
							tglPermintaan 		: tanggal
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
									resetFormTambahBijiWarna();
									tableListTambahBijiWarnaPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal1"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Transaksi Gudang Bahan Gagal Ditambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Gagal2") {
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Stok Jiji Warna Extruder Gagal Ditambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal!, Bulan Tersebut Sudah Di Lock");
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

			function saveBijiWarnaBaru(){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						url : "<?php echo base_url(); ?>_extruder/main/saveBijiWarnaBaru",
						dataType : "TEXT",
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Ditambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormTambahBijiWarna();
									tableListTambahBijiWarnaPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Error!, Sebagian Data Tidak Terkirim Ke Gudang Bahan");
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

			function saveAddPermintaanBijiWarna(){
				var kdGdBahan1 = $("#cmbBijiWarna").val();
				var tglPermintaan1 = $("#txtTanggal").val();
				var jumlahPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g, "");

				if(kdGdBahan1=="" || tglPermintaan1=="" || jumlahPermintaan1==""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
						resetFormMintaBijiWarna();
						tableListPermintaanBijiWarnaPending();
					},2000);
				}else{
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_extruder/main/saveAddPermintaanBijiWarna",
						dataType : "TEXT",
						data : {
							kdGdBahan : kdGdBahan1,
							tglPermintaan : tglPermintaan1,
							jumlahPermintaan : jumlahPermintaan1
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
									resetFormMintaBijiWarna();
									tableListPermintaanBijiWarnaPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Ditambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response)==="Lock"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal!, Bulain Ini Sudah Di Lock");
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

			function savePermintaanBijiWarna(){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						url : "<?php echo base_url(); ?>_extruder/main/savePermintaanBijiWarna",
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
									resetFormMintaBijiWarna();
									tableListPermintaanBijiWarnaPending();
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
								$("#modalNotifContent").text("Item Masih Kosong");
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

			function saveInputHasilExtruder(){
				var kdExtruder1 = $("#txtKodeExtruder3").val();
				var kdGdRoll1 = $("#txtKdGdRoll").val();
				var warnaPlastik1 = $("#txtWarnaPlastik").val();
				var tglPengerjaan1 = $("#txtTglHasil").val();
				var noMesin1 = $("#txtNoMesin").val();
				var merek1 = $("#txtMerek").val();
				var jnsBarang1 = $("#txtJenisBarang").val();
				var jnsPermintaan1 = $("#txtJnsPermintaan").val();
				var bijiWarna1 = $("#cmbBijiWarna").val();
				var namaBijiWarna1 = $("#cmbBijiWarna option:selected").text();
				var arrNamaBijiWarna = namaBijiWarna1.split(" | ");
				namaBijiWarna1 = arrNamaBijiWarna[0];
				var komposisi1 = $("#txtKomposisi").val().replace(/,/g,"");
				var keterangan1 = $("#cmbKeterangan").val();
				var keteranganMerek1 = $("#txtKetMerekHasil").val();
				var ukuran1 = $("#txtUkuranHasil").val();
				var tebal1 = $("#txtTebalHasil").val();
				var berat1 = $("#txtBeratHasil").val();
				var strip1 = $("#txtStripHasil").val();
				var warnaStrip1 = $("#cmbWarnaStrip").val();
				var jenisRoll1 = $("#cmbRollPipa").val();
				switch (jenisRoll1) {
					case "BOBIN"				 : var panjangPlastik1 = $("#txtPanjangPlastik").val().replace(/,/g,"");
																 var doubleSingle1 = $("#txtDoubleSingle").val().replace(/,/g,"");
																 var rumusRoll1 = $("#txtRumusRoll").val().replace(/,/g,"");
																 var jumlahBobin1 = $("#txtJumlahBobin").val().replace(/,/g,"");
																 break;

					case "PAYUNG" 			 : var rumusRoll1 = $("#txtRumusRollPayung").val().replace(/,/g,"");
																 var payung1 = $("#txtPayung").val().replace(/,/g,"");
																 break;

					case "PAYUNG_KUNING" : var rumusRoll1 = $("#txtRumusRollPayung").val().replace(/,/g,"");
																 var payungKuning1 = $("#txtPayung").val().replace(/,/g,"");
																 break;
					default: break;
				}
				var shift1 = $("#cmbShift").val();
				var hasil1 = $("#txtJumlahHasil").val().replace(/,/g,"");
				var jumlahPermintaan1 = $("#txtJumlahPermintaan").val();

				if(kdExtruder1=="" || kdGdRoll1=="" || warnaPlastik1=="" || tglPengerjaan1=="" ||
					 noMesin1=="" || merek1=="" || jnsBarang1=="" || jnsPermintaan1=="" ||
				 	 bijiWarna1=="" || komposisi1=="" || keterangan1=="" || ukuran1=="" || strip1=="" || jenisRoll1=="" ||
				 	 shift1=="" || hasil1=="" || jumlahPermintaan1==""){
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
							 url : "<?php echo base_url(); ?>_extruder/main/saveHasilExtruder",
							 dataType : "TEXT",
							 data : {
								 kdExtruder 			: kdExtruder1,
								 kdGdRoll 				: kdGdRoll1,
								 warnaPlastik 		: warnaPlastik1,
								 tglPengerjaan 		: tglPengerjaan1,
								 noMesin 					: noMesin1,
								 merek 						: merek1,
								 jnsBarang 				: jnsBarang1,
								 jnsPermintaan 		: jnsPermintaan1,
								 bijiWarna 				: bijiWarna1,
								 namaBijiWarna 		: namaBijiWarna1,
								 komposisi 				: komposisi1,
								 keterangan 			: keterangan1,
								 ketMerek					: keteranganMerek1,
								 ukuran 					: ukuran1,
								 tebal 						: tebal1,
								 berat 						: berat1,
								 strip 						: strip1,
								 warnaStrip				: warnaStrip1,
								 jenisRoll 				: jenisRoll1,
								 shift 						: shift1,
								 hasil 						: hasil1,
								 jumlahPermintaan : jumlahPermintaan1,
								 panjangPlastik		: panjangPlastik1,
								 doubleSingle			: doubleSingle1,
								 rumusRoll				: rumusRoll1,
								 jumlahBobin			: jumlahBobin1,
								 payung						: payung1,
								 payungKuning			: payungKuning1
							 },
							 success : function(response) {
							 	if(jQuery.trim(response) === "Berhasil"){
									$("#modal-notif").addClass("modal-info");
									$("#modalNotifContent").text("Data Berhasil Ditambahkan");
									$("#modal-notif").modal("show");
									setTimeout(function(){
										$("#modal-notif").modal("hide");
										$("#modal-notif").removeClass("modal-info");
										$("#modalNotifContent").text("");
										if($("#tableHasilJobExtruder_Lokal").length){
											tableListHasilJobExtruder("LOKAL");
											reloadDataHasilJobExtruderFinal("LOKAL");
										}
										// if($("#tableHasilJobExtruder_Export").length){
										// 	tableListHasilJobExtruder("EXPORT");
										// 	reloadDataHasilJobExtruderFinal("EXPORT");
										// }
										$("#modalInputHasil").modal("hide");

										if($("#tableRencanaMandorExtruder_KP").length){
											datatablesListRencanaKerjaExtruder("#tableRencanaMandorExtruder_KP","PROGRESS","KLIP");
										}
										if($("#tableRencanaMandorExtruder_ZP").length){
											datatablesListRencanaKerjaExtruder("#tableRencanaMandorExtruder_ZP","PROGRESS","ZP");
										}

									},2000);
									setTimeout(function(){
										window.close();
									},5000);
								}else if(jQuery.trim(response) === "Gagal"){
									$("#modal-notif").addClass("modal-danger");
									$("#modalNotifContent").text("Data Gagal Ditambahkan Atau Bulan Ini Sudah Di Kunci");
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

			function saveInputHasilExtruderTertinggal(){
				var kdExtruder1 = $("#txtKodeExtruder3").val();
				var kdGdRoll1 = $("#txtKdGdRoll").val();
				var warnaPlastik1 = $("#txtWarnaPlastik").val();
				var tglPengerjaan1 = $("#txtTglHasil").val();
				var noMesin1 = $("#txtNoMesin").val();
				var merek1 = $("#txtMerek").val();
				var jnsBarang1 = $("#txtJenisBarang").val();
				var jnsPermintaan1 = $("#txtJnsPermintaan").val();
				var bijiWarna1 = $("#cmbBijiWarna").val();
				var namaBijiWarna1 = $("#cmbBijiWarna option:selected").text();
				var arrNamaBijiWarna = namaBijiWarna1.split(" | ");
				namaBijiWarna1 = arrNamaBijiWarna[0];
				var komposisi1 = $("#txtKomposisi").val().replace(/,/g,"");
				var keterangan1 = $("#cmbKeterangan").val();
				var keteranganMerek1 = $("#txtKetMerekHasil").val();
				var ukuran1 = $("#txtUkuranHasil").val();
				var tebal1 = $("#txtTebalHasil").val();
				var berat1 = $("#txtBeratHasil").val();
				var strip1 = $("#txtStripHasil").val();
				var warnaStrip1 = $("#cmbWarnaStrip").val();
				var jenisRoll1 = $("#cmbRollPipa").val();
				switch (jenisRoll1) {
					case "BOBIN"				 : var panjangPlastik1 = $("#txtPanjangPlastik").val().replace(/,/g,"");
																 var doubleSingle1 = $("#txtDoubleSingle").val().replace(/,/g,"");
																 var rumusRoll1 = $("#txtRumusRoll").val().replace(/,/g,"");
																 var jumlahBobin1 = $("#txtJumlahBobin").val().replace(/,/g,"");
																 break;

					case "PAYUNG" 			 : var rumusRoll1 = $("#txtRumusRollPayung").val().replace(/,/g,"");
																 var payung1 = $("#txtPayung").val().replace(/,/g,"");
																 break;

					case "PAYUNG_KUNING" : var rumusRoll1 = $("#txtRumusRollPayung").val().replace(/,/g,"");
																 var payungKuning1 = $("#txtPayung").val().replace(/,/g,"");
																 break;
					default: break;
				}
				var shift1 = $("#cmbShift").val();
				var hasil1 = $("#txtJumlahHasil").val().replace(/,/g,"");
				var jumlahPermintaan1 = $("#txtJumlahPermintaan").val();

				if(kdExtruder1=="" || kdGdRoll1=="" || warnaPlastik1=="" || tglPengerjaan1=="" ||
					 noMesin1=="" || merek1=="" || jnsBarang1=="" || jnsPermintaan1=="" ||
				 	 bijiWarna1=="" || komposisi1=="" || keterangan1=="" || ukuran1=="" || strip1=="" || jenisRoll1=="" ||
				 	 shift1=="" || hasil1=="" || jumlahPermintaan1==""){
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
							 url : "<?php echo base_url(); ?>_extruder/main/saveHasilExtruderTertinggal",
							 dataType : "TEXT",
							 data : {
								 kdExtruder 			: kdExtruder1,
								 kdGdRoll 				: kdGdRoll1,
								 warnaPlastik 		: warnaPlastik1,
								 tglPengerjaan 		: tglPengerjaan1,
								 noMesin 					: noMesin1,
								 merek 						: merek1,
								 jnsBarang 				: jnsBarang1,
								 jnsPermintaan 		: jnsPermintaan1,
								 bijiWarna 				: bijiWarna1,
								 namaBijiWarna 		: namaBijiWarna1,
								 komposisi 				: komposisi1,
								 keterangan 			: keterangan1,
								 ketMerek					: keteranganMerek1,
								 ukuran 					: ukuran1,
								 tebal 						: tebal1,
								 berat 						: berat1,
								 strip 						: strip1,
								 warnaStrip				: warnaStrip1,
								 jenisRoll 				: jenisRoll1,
								 shift 						: shift1,
								 hasil 						: hasil1,
								 jumlahPermintaan : jumlahPermintaan1,
								 panjangPlastik		: panjangPlastik1,
								 doubleSingle			: doubleSingle1,
								 rumusRoll				: rumusRoll1,
								 jumlahBobin			: jumlahBobin1,
								 payung						: payung1,
								 payungKuning			: payungKuning1
							 },
							 success : function(response) {
							 	if(jQuery.trim(response) === "Berhasil"){
									$("#modal-notif").addClass("modal-info");
									$("#modalNotifContent").text("Data Berhasil Ditambahkan");
									$("#modal-notif").modal("show");
									setTimeout(function(){
										$("#modal-notif").modal("hide");
										$("#modal-notif").removeClass("modal-info");
										$("#modalNotifContent").text("");
										if($("#tableHasilJobExtruder_Lokal").length){
											tableListHasilJobExtruder("LOKAL");
											reloadDataHasilJobExtruderFinal("LOKAL");
										}
										// if($("#tableHasilJobExtruder_Export").length){
										// 	tableListHasilJobExtruder("EXPORT");
										// 	reloadDataHasilJobExtruderFinal("EXPORT");
										// }
										$("#modalInputHasil").modal("hide");

										if($("#tableRencanaMandorExtruder_KP").length){
											datatablesListRencanaKerjaExtruder("#tableRencanaMandorExtruder_KP","PROGRESS","KLIP");
										}
										if($("#tableRencanaMandorExtruder_ZP").length){
											datatablesListRencanaKerjaExtruder("#tableRencanaMandorExtruder_ZP","PROGRESS","ZP");
										}

									},2000);
									setTimeout(function(){
										window.close();
									},5000);
								}else if(jQuery.trim(response) === "Gagal"){
									$("#modal-notif").addClass("modal-danger");
									$("#modalNotifContent").text("Data Gagal Ditambahkan Atau Bulan Ini Sudah Di Kunci");
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

			function saveHasilJobExtruderFinal(param,param2){
				if(param=="LOKAL"){
					var sisaBijiKemarin1 = $("#txtSisaBijiKemarin_Lokal").val().replace(/,/g, "");
					var penambahanBijiBaru1 = $("#txtPenambahanBijiBaru_Lokal").val().replace(/,/g, "");
					var penguranganBiji1 = $("#txtPenguranganBiji_Lokal").val().replace(/,/g, "");
					var bijiWarna1 = $("#txtBijiWarna_Lokal").val().replace(/,/g, "");
					var corong1 = $("#txtCorong_Lokal").val().replace(/,/g, "");
					var sisaBahan1 = $("#txtSisabahan_Lokal").val().replace(/,/g, "");
					var sisa1 = $("#txtSisa_Lokal").val().replace(/,/g, "");
					var total1 = $("#txtTotal_Lokal").val().replace(/,/g, "");
					var berat1 = $("#txtBerat2_Lokal").val().replace(/,/g, "");
					var apal1 = $("#txtApal_Lokal").val().replace(/,/g, "");
					var rollPipa1 = $("#txtRollPipa_Lokal").val().replace(/,/g, "");
					var plusMinus1 = $("#txtPlusMinus_Lokal").val().replace(/,/g, "");
					var jnsBrg1 = param;
				}else{
					var sisaBijiKemarin1 = $("#txtSisaBijiKemarin_Export").val().replace(/,/g, "");
					var penambahanBijiBaru1 = $("#txtPenambahanBijiBaru_Export").val().replace(/,/g, "");
					var penguranganBiji1 = $("#txtPenguranganBiji_Export").val().replace(/,/g, "");
					var bijiWarna1 = $("#txtBijiWarna_Export").val().replace(/,/g, "");
					var corong1 = $("#txtCorong_Export").val().replace(/,/g, "");
					var sisaBahan1 = $("#txtSisabahan_Export").val().replace(/,/g, "");
					var sisa1 = $("#txtSisa_Export").val().replace(/,/g, "");
					var total1 = $("#txtTotal_Export").val().replace(/,/g, "");
					var berat1 = $("#txtBerat2_Export").val().replace(/,/g, "");
					var apal1 = $("#txtApal_Export").val().replace(/,/g, "");
					var rollPipa1 = $("#txtRollPipa_Export").val().replace(/,/g, "");
					var plusMinus1 = $("#txtPlusMinus_Export").val().replace(/,/g, "");
					var jnsBrg1 = param;
				}

				if(sisaBijiKemarin1=="" || penambahanBijiBaru1=="" || penguranganBiji1=="" ||
					 bijiWarna1=="" || corong1=="" || sisaBahan1=="" || sisa1=="" || total1=="" ||
				 	 berat1=="" || apal1=="" || rollPipa1=="" || plusMinus1=="" || jnsBrg1==""
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
		 					url : "<?php echo base_url(); ?>_extruder/main/saveHasilJobExtruderFinal",
		 					dataType : "TEXT",
		 					data : {
		 						sisaBijiKemarin 		: sisaBijiKemarin1,
		 						penambahanBijiBaru 	: penambahanBijiBaru1,
		 						penguranganBiji 		: penguranganBiji1,
		 						bijiWarna 					: bijiWarna1,
		 						corong 							: corong1,
		 						sisaBahan 					: sisaBahan1,
		 						sisa 								: sisa1,
		 						total 							: total1,
		 						berat 							: berat1,
		 						apal 								: apal1,
		 						rollPipa 						: rollPipa1,
		 						plusMinus 					: plusMinus1,
		 						jnsBrg 							: jnsBrg1,
								shift								: param2
		 					},
							success : function(response){
								if(jQuery.trim(response) === "Berhasil"){
									$("#modal-notif").addClass("modal-info");
									$("#modalNotifContent").text("Data Berhasil Dikirim");
									$("#modal-notif").modal("show");
									setTimeout(function(){
										$("#modal-notif").modal("hide");
										$("#modal-notif").removeClass("modal-info");
										$("#modalNotifContent").text("");
										reloadDataHasilJobExtruderFinal("LOKAL");
										reloadDataHasilJobExtruderFinal("EXPORT");
										tableListHasilJobExtruder(param);
									},2000);
								}else if(jQuery.trim(response) === "Gagal"){
									$("#modal-notif").addClass("modal-danger");
									$("#modalNotifContent").text("Data Gagal Dikirim");
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

			function saveKirimHasilKePpic(param1, param2, param3, param4, param5){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_extruder/main/saveKirimHasilKePpic",
						dataType : "TEXT",
						data : {
							idData : param1,
							kirimKePpic : param2
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Dikirim Ke PPIC");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									$.ajax({
										type : "POST",
										url : "<?php echo base_url(); ?>_extruder/main/getDataKirimHasilExtruderKePpic",
										dataType : "JSON",
										data : {
											tglRencana : param3,
											jnsBrg : param4,
											shift : param5
										},
										success : function(response){
											if(response[0].kirim_ke_ppic == "FALSE"){
												$("#btnKirimHasilExtruder").attr("onclick","saveKirimHasilKePpic('"+response[0].id_data+"','TRUE','"+param3+"','"+param4+"','"+param5+"');").removeClass("btn-danger").addClass("btn-success").html("<i class='fa fa-send'></i> Kirim");
											}else{
												$("#btnKirimHasilExtruder").attr("onclick","saveKirimHasilKePpic('"+response[0].id_data+"','FALSE','"+param3+"','"+param4+"','"+param5+"');").removeClass("btn-success").addClass("btn-danger").html("<i class='fa fa-undo'></i> Batal Kirim");;
											}
											$("#tabelKirimHasilExtruder > tbody").empty();
											$.each(response, function(AvIndex, AvValue){
												if(AvValue.kirim_ke_ppic == "TRUE"){
													var x = "<label class='text-green'>Terkirim</label>";
												}else{
													var x = "<label class='text-Red'>Belum Terkirim</label>";
												}
												$("#tabelKirimHasilExtruder > tbody:last-child").append(
													"<tr>"+
														"<td>"+AvValue.tgl_rencana+"</td>"+
														"<td>"+AvValue.total+"</td>"+
														"<td>"+AvValue.jumlah_apal+"</td>"+
														"<td>"+AvValue.shift+"</td>"+
														"<td>"+AvValue.jns_brg+"</td>"+
														"<td>"+ x +"</td>"+
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
									})
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Dikirim Ke PPIC");
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

			function saveKirimDataBonRollPolos(param){
				if(confirm("Apakah Anda Yakin Ingin Mengirim Hasil Ini?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_extruder/main/saveKirimDataBonRollPolos",
						dataType : "TEXT",
						data : {tanggal : param},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Dikirim");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									searchDataBonRollPolos(param);
								},2000);
							}else if(jQuery.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal!, Maaf Bulan Tersebut Sudah Dikunci");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Dikirim");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Item Masih Kosong");
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

			function saveTambahApalPending(){
				var jumlahApal1 = $("#txtJumlahApal").val().replace(/,/g, "");
				var kdGdApal1 = $("#cmbJenisApal").val();
				var shift1 = $("#txtShift").val();
				var tglTransaksi1 = $("#txtTanggal").val();
				var jnsApal1 = $("#cmbJenisApal option:selected").text();

				if(jumlahApal1=="" || kdGdApal1=="" || shift1=="" || tglTransaksi1==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/saveTambahApalPending",
						dataType : "TEXT",
						data : {
							jumlahApal : jumlahApal1,
							kdGdApal : kdGdApal1,
							shift : shift1,
							tglTransaksi : tglTransaksi1,
							jnsApal : jnsApal1
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
									resetFormTambahBonApal();
									tableDataBonApal();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Ditambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal!, Maaf Bulan Tersebut Sudah Dikunci");
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

			function saveKirimDataBonApal(param="<?php echo date('Y-m-d'); ?>"){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_extruder/main/saveKirimDataBonApal",
						dataType : "TEXT",
						data : {tanggal : param},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Dikirim Ke Gudang Apal");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									tableDataBonApal(param);
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Dikirim Ke Gudang Apal");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Data Masih Kosong");
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

			function saveAddKembalianBahanBaku(){
				var kdGdBahan1 = $("#cmbBahanBaku").val();
				var tgl = $("#txtTgl").val();
				var jumlahPermintaan1 = $("#txtJumlahKembalian").val().replace(/,/g,"");

				if(kdGdBahan1=="" || jumlahPermintaan1=="" || tgl==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/saveAddKembalianBahanBaku",
						dataType : "TEXT",
						data : {
							kdGdBahan : kdGdBahan1,
							jumlahPermintaan : jumlahPermintaan1,
							tgl : tgl
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
									resetFormKembalianBahanBaku();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Ditambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal!, Maaf Bulan Tersebut Sudah Dikunci");
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

			function saveKirimKembalianBahanBaku(){
				if (confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah")) {
					$.ajax({
						url : "<?php echo base_url() ?>_extruder/main/saveKirimKembalianBahanBaku",
						dataType : "TEXT",
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Dikirim Ke Gudang Bahan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormKembalianBahanBaku();
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Dikirim Ke Gudang Bahan");
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

			function saveAddKembalianBijiWarna(){
				var kdGdBahan1 = $("#cmbBijiWarna").val();
				var jumlahPermintaan1 = $("#txtJumlah").val().replace(/,/g,"");
				var tglTransaksi1 = $("#txtTanggal").val();

				if(kdGdBahan1=="" || jumlahPermintaan1=="" || tglTransaksi1==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/saveAddKembalianBijiWarna",
						dataType : "TEXT",
						data : {
							kdGdBahan : kdGdBahan1,
							jumlahPermintaan : jumlahPermintaan1,
							tglTransaksi : tglTransaksi1
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
									resetFormKembalianBijiWarna();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Ditambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal!, Maaf Bulan Tersebut Sudah Dikunci");
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

			function saveKirimKembalianBijiWarna(){
				if (confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah")) {
					$.ajax({
						url : "<?php echo base_url() ?>_extruder/main/saveKirimKembalianBijiWarna",
						dataType : "TEXT",
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Dikirim Ke Gudang Bahan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormKembalianBijiWarna();
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Dikirim Ke Gudang Bahan");
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
			//============================================SAVE METHOD (Finish)============================================//

			//============================================EDIT METHOD (Start)============================================//
			function editRencanaExtruderPending(){
				var kdExtruder1 = $("#txtKodeExtruder").val();
				var kdMesin1 = $("#cmbNoMesin").val();
				var nmCust1 = $("#txtNamaCustomer").val();
				var jnsMesin1 = $("#cmbJenisMesin").val();
				var merek1 = $("#txtWarna").val();
				var ukuran1 = $("#txtUkuranOrder").val();
				var warna1 = $("#txtWarna").val();
				var tebal1 = $("#txtTebalOrder").val().replace(/,/g, "");
				var jumlahPermintaan1 = $("#txtJumlahRencanaPembuatan").val().replace(/,/g, "");
				if($("#cmbStrip").val() == "CUSTOM"){
					var strip1 = $("#txtStrip").val().toUpperCase();
				}else{
					var strip1 = $("#cmbStrip").val().toUpperCase();
				}
				var tglRencana1 = $("#txtTglPengerjaan").val();
				var motoran1 = $("#txtMotoran").val();
				var extruder1 = $("#txtExtruder").val();
				var berat1 = $("#txtBeratOrder").val().replace(/,/g, "");
				if($("#cmbBahan").val()=="CUSTOM"){
					var bahan1= $("#txtBahan").val();
				}else{
					var bahan1= $("#cmbBahan").val();
				}
				var prioritas1 = $("#txtPrioritasOrder").val();

				if(kdExtruder1=="" || kdMesin1=="" || nmCust1=="" ||
					 jnsMesin1=="" || merek1=="" || ukuran1=="" || warna1=="" || tebal1=="" ||
				 	 jumlahPermintaan1=="" || strip1=="" || tglRencana1=="" || berat1=="" || bahan1==""
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
						url : "<?php echo base_url(); ?>_extruder/main/editRencanaExtruderPending",
						dataType : "TEXT",
						data : {
							kdExtruder 				: kdExtruder1,
							kdMesin 					: kdMesin1,
							nmCust 						: nmCust1,
							jnsMesin 					: jnsMesin1,
							merek 						: merek1,
							ukuran 						: ukuran1,
							warna 						: warna1,
							tebal 						: tebal1,
							jumlahPermintaan 	: jumlahPermintaan1,
							strip 						: strip1,
							tglRencana 				: tglRencana1,
							motoran 					: motoran1,
							extruder 					: extruder1,
							berat 						: berat1,
							bahan 						: bahan1,
							prioritas					: prioritas1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Rencana Berhasil Diubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									tableRencanaExtruderPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Rencana Gagal Diubah");
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

			function editRencanaExtruderSusulanPending(){
				var kdExtruder1 = $("#txtKodeExtruder2").val();
				var kdGdRoll1 = $("#cmbMerekGudangRoll").val();
				var kdMesin1 = $("#cmbNoMesin3").val();
				var nmCust1 = $("#txtNamaCustomer2").val();
				var jnsMesin1 = $("#txtJenisMesin2").val();
				if(kdGdRoll1 == "" || kdGdRoll1==null){
					var merek1 = "";
					var warna1 = "";
				}else{
					var dataText = $("#cmbMerekGudangRoll").select2("data")[0]["text"];
					var arrDataText = dataText.split(" | ");
					var merek1 = arrDataText[2];
					var warna1 = arrDataText[3];
				}
				var ukuran1 = $("#txtUkuranPlastik").val();
				var tebal1 = $("#txtTebal1").val();
				var jumlahPermintaan1 = $("#txtJumlahRencanaPembuatan	").val().replace(/,/g, "");
				if($("#cmbStrip").val() == "CUSTOM"){
					var strip1 = $("#txtStrip").val().toUpperCase();
				}else{
					var strip1 = $("#cmbStrip").val().toUpperCase();
				}
				var tglRencana1 = $("#txtTglPengerjaan").val();
				var motoran1 = $("#txtMotoran").val();
				var extruder1 = $("#txtExtruder").val();
				var berat1 = $("#txtBeratOrder").val().replace(/,/g, "");
				var keteranganMerek1 = $("#txtKetMerek").val();
				var bahan1= $("#txtBahan").val();
				var prioritas1 = $("#cmbStatus").val();

				if(kdExtruder1=="" || kdMesin1=="" || nmCust1=="" ||
					 jnsMesin1=="" || ukuran1=="" || tebal1=="" ||
				 	 jumlahPermintaan1=="" || strip1=="" || tglRencana1==""|| bahan1==""
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
						url : "<?php echo base_url(); ?>_extruder/main/editRencanaExtruderSusulanPending",
						dataType : "TEXT",
						data : {
							kdExtruder 				: kdExtruder1,
							kdGdRoll 					: kdGdRoll1,
							kdMesin 					: kdMesin1,
							nmCust 						: nmCust1,
							jnsMesin 					: jnsMesin1,
							merek 						: merek1,
							ukuran 						: ukuran1,
							warna 						: warna1,
							tebal 						: tebal1,
							jumlahPermintaan 	: jumlahPermintaan1,
							strip 						: strip1,
							tglRencana 				: tglRencana1,
							motoran 					: motoran1,
							extruder 					: extruder1,
							ketMerek					: keteranganMerek1,
							berat 						: berat1,
							bahan 						: bahan1,
							prioritas					: prioritas1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Rencana Berhasil Ditambahkan");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									tableRencanaExtruderSusulanPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Rencana Gagal Ditambahkan");
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

			function editStatusRencanaExtruder(param=""){
				var kdExtruder1 = $("#txtKodeRencana").val();
				var stsPengerjaan1 = $("#cmbStatusRencana").val();
				if(kdExtruder1 =="" || stsPengerjaan1 ==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/editStatusRencanaExtruder",
						dataType : "TEXT",
						data : {
							kodeExtruder : kdExtruder1,
							stsPengerjaan : stsPengerjaan1,
							kdPpic : param
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Status Rencana Berhasil Diubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Status Rencana Gagal Diubah");
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

			function editGantiMesin(){
				var kdExtruder1 = $("#txtKodeRencana2").val();
				var kdMesin1 = $("#cmbNoMesin").val();
				var jnsMesin1 = $("#txtJenisMesin").val();

				if(kdExtruder1=="" || kdMesin1=="" || jnsMesin1==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/editGantiMesin",
						dataType : "TEXT",
						data : {
							kdExtruder : kdExtruder1,
							kdMesin : kdMesin1,
							jnsMesin : jnsMesin1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Mesin Berhasil Diubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Mesin Gagal Diubah");
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

			function editPermintaanExtruderPending(param){
				var tanggal = $("#txtTanggal").val();
				var kdBahan = $("#txtBahan").val();
				var jumlah = $("#txtJumlahPermintaan").val().replace(/,/g,"");

				if(tanggal == "" || kdBahan == "" || jumlah == ""){
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
						url : "<?php echo base_url(); ?>_extruder/main/editPermintaanExtruderPending",
						dataType : "TEXT",
						data : {
							idTransaksi 			: param,
							tglPermintaan 		: tanggal,
							kdGdBahan 				: kdBahan,
							jumlahPermintaan	: jumlah
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Diubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormMintaBahanBaku();
									tableListPermintaanExtruder("BAHAN BAKU","LOKAL");
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

			function editBijiWarnaBaru(param1, param2){
				var idTransaksi1 = param1;
				var idGudangBuffer1 = param2;
				var tanggal = $("#txtTanggalTambah").val();
				var kdGdBahan1 = $("#cmbBijiWarnaBaru").val();
				var jumlahPermintaan1 = $("#txtJumlahPermintaanBaru").val().replace(/,/g,"");

				if(kdGdBahan1=="" || tanggal=="" || jumlahPermintaan1==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/editBijiWarnaBaru",
						dataType : "TEXT",
						data : {
							idTransaksi 			: idTransaksi1,
							idGudangBuffer 		: idGudangBuffer1,
							tglPermintaan 		: tanggal,
							kdGdBahan 				: kdGdBahan1,
							jumlahPermintaan 	: jumlahPermintaan1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Diubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormTambahBijiWarna();
									tableListTambahBijiWarnaPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal1"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Transaksi Gagal Diubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Gagal2") {
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Stok Extruder Gagal Diubah");
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

			function editPermintaanBijiWarnaPending(param){
				var kdGdBahan1 = $("#cmbBijiWarna").val();
				var tglPermintaan1 = $("#txtTanggal").val();
				var jumlahPermintaan1 = $("#txtJumlahPermintaan").val().replace(/,/g,"");
				var idTransaksi1 = param;

				if(kdGdBahan1=="" || tglPermintaan1=="" || jumlahPermintaan1=="" || idTransaksi1==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/editPermintaanBijiWarnaPending",
						dataText : "TEXT",
						data : {
							idTransaksi : idTransaksi1,
							kdGdBahan : kdGdBahan1,
							tglPermintaan : tglPermintaan1,
							jumlahPermintaan : jumlahPermintaan1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Diubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormMintaBijiWarna();
									tableListPermintaanBijiWarnaPending();
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

			function editHasilJobExtruder(param){
				var idTransaksi1 = param;
				var kdExtruder1 = $("#txtKodeExtruder_Edit").val();
				var jnsBrg1 = $("#txtJenisBarang_Edit").val();
				var bijiWarna1 = $("#cmbBijiWarna_Edit").val();
				var komposisi1 = $("#txtKomposisi_Edit").val();
				var jenisRoll1 = $("#cmbRollPipa_Edit").val();
				var jumlahBijiWarna1 = $("#txtJumlahBijiWarna").val();
				var tglRencana1 = $("#txtTglRencana").val();
				var pemakaianStrip1 = $("#txtJumlahPemakaianStrip").val();
				var ketMerek1 = $("#txtKetMerekHasil_Edit").val();
				switch (jenisRoll1) {
					case "BOBIN"				 : var panjangPlastik1 = $("#txtPanjangPlastik_Edit").val().replace(/,/g,"");
																 var doubleSingle1 = $("#txtDoubleSingle_Edit").val().replace(/,/g,"");
																 var rumusRoll1 = $("#txtRumusRoll_Edit").val().replace(/,/g,"");
																 var jumlahBobin1 = $("#txtJumlahBobin_Edit").val().replace(/,/g,"");
																 break;

					case "PAYUNG" 			 : var rumusRoll1 = $("#txtRumusRollPayung_Edit").val().replace(/,/g,"");
																 var payung1 = $("#txtPayung_Edit").val().replace(/,/g,"");
																 break;

					case "PAYUNG_KUNING" : var rumusRoll1 = $("#txtRumusRollPayung_Edit").val().replace(/,/g,"");
																 var payung1 = $("#txtPayung_Edit").val().replace(/,/g,"");
																 break;
					default: break;
				}
				var shift1 = $("#cmbShift_Edit").val();
				var keterangan1 = $("#cmbKeterangan_Edit").val();
				var hasil1 = $("#txtJumlahHasil_Edit").val().replace(/,/g, "");
				var arrNamaBijiWarna1 = $("#cmbBijiWarna_Edit option:selected").text().split(" | ");
				var namaBijiWarna1 = arrNamaBijiWarna1[0];
				var ukuran1 = $("#txtUkuranPlastik_Edit").val();

				if(idTransaksi1=="" || kdExtruder1=="" || jnsBrg1=="" || jenisRoll1=="" ||
					 rumusRoll1=="" || shift1=="" || keterangan1=="" || hasil1=="" || bijiWarna1==""
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
						url : "<?php echo base_url(); ?>_extruder/main/editHasilJobExtruder",
						dataType : "TEXT",
						data : {
							idTransaksi  		: idTransaksi1,
							kdExtruder 			: kdExtruder1,
							jnsBrg					: jnsBrg1,
							bijiWarna 			: bijiWarna1,
							namaBijiWarna		: namaBijiWarna1,
							jumlahBijiWarna	: jumlahBijiWarna1,
							pemakaianStrip	: pemakaianStrip1,
							ukuran					: ukuran1,
							komposisi 			: komposisi1,
							jenisRoll 			: jenisRoll1,
							panjangPlastik 	: panjangPlastik1,
							doubleSingle 		: doubleSingle1,
							rumusRoll 			: rumusRoll1,
							jumlahBobin 		: jumlahBobin1,
							jumlahPayung 		: payung1,
							shift 					: shift1,
							keterangan 			: keterangan1,
							ketMerek				: ketMerek1,
							tglTransaksi		: tglRencana1,
							jumlahHasil 		: hasil1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Diubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									if($("#tableHasilJobExtruder_Lokal").length){
										tableListHasilJobExtruder("LOKAL");
										reloadDataHasilJobExtruderFinal("LOKAL");
									}
									if($("#tableHasilJobExtruder_Export").length){
										tableListHasilJobExtruder("EXPORT");
										reloadDataHasilJobExtruderFinal("EXPORT");
									}
									$("#modalInputHasil").modal("hide");

									if($("#tableRencanaMandorExtruder_KP").length){
										datatablesListRencanaKerjaExtruder("#tableRencanaMandorExtruder_KP","PROGRESS","KLIP");
									}
									if($("#tableRencanaMandorExtruder_ZP").length){
										datatablesListRencanaKerjaExtruder("#tableRencanaMandorExtruder_ZP","PROGRESS","ZP");
									}
								},2000);
								$("#modalInputHasil").modal("hide");
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

			function editDataBonApal(param,param2){
				var jumlahApal1 = $("#txtJumlahApal").val().replace(/,/g, "");
				var kdGdApal1 = $("#cmbJenisApal").val();
				var shift1 = $("#txtShift").val();
				var tglTransaksi1 = $("#txtTanggal").val();
				var jnsApal1 = $("#cmbJenisApal option:selected").text();

				if(jumlahApal1=="" || kdGdApal1=="" || shift1=="" || tglTransaksi1==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/editApalPending",
						dataType : "TEXT",
						data : {
							idTransaksi 	: param,
							jumlahApal 		: jumlahApal1,
							kdGdApal 			: kdGdApal1,
							shift 				: shift1,
							tglTransaksi 	: tglTransaksi1,
							jnsApal 			: jnsApal1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Diubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									tableDataBonApal(param2);
								},2000);
								$("#modalTambahKirimanApal").modal("hide");
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Diubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else if(jQuery.trim(response) === "Lock"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal!, Maaf Bulan Tersebut Sudah Dikunci");
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

			function editKembalianBahanBaku(param){
				var kdGdBahan1 = $("#cmbBahanBaku").val();
				var jumlahPermintaan1 = $("#txtJumlahKembalian").val().replace(/,/g,"");

				if(kdGdBahan1=="" || jumlahPermintaan1==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/editKembalianBahanBaku",
						dataType : "TEXT",
						data : {
							idTransaksi : param,
							kdGdBahan : kdGdBahan1,
							jumlahPermintaan : jumlahPermintaan1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Diubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormKembalianBahanBaku();
									tableListKembalianBahanBakuExtruderPending();
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

			function editKembalianBijiWarna(param){
				var kdGdBahan1 = $("#cmbBijiWarna").val();
				var jumlahPermintaan1 = $("#txtJumlah").val().replace(/,/g,"");
				var tglTransaksi1 = $("#txtTanggal").val();

				if(kdGdBahan1=="" || jumlahPermintaan1=="" || tglTransaksi1==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/editKembalianBahanBaku",
						dataType : "TEXT",
						data : {
							idTransaksi : param,
							kdGdBahan : kdGdBahan1,
							jumlahPermintaan : jumlahPermintaan1,
							tglTransaksi : tglTransaksi1
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Diubah");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									resetFormKembalianBijiWarna();
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

			function editHasilExtruder(param, param2, param3, param4){
				var idHasilExtruder1 = param;
				var kdExtruder1 = $("#txtKodeExtruder3").val();
				var kdGdRoll1 = $("#txtKdGdRoll").val();
				var warnaPlastik1 = $("#txtWarnaPlastik").val();
				var tglPengerjaan1 = $("#txtTglHasil").val();
				var noMesin1 = $("#txtNoMesin").val();
				// var merek1 = $("#txtMerek").val();
				var jnsBarang1 = $("#txtJenisBarang").val();
				var jnsPermintaan1 = $("#txtJnsPermintaan").val();
				var bijiWarna1 = $("#cmbBijiWarna").val();
				if(bijiWarna1 =="" || bijiWarna1==null){
					var namaBijiWarna1 = "";
					var arrNamaBijiWarna = "";
					namaBijiWarna1 = "";
				}else{
					var namaBijiWarna1 = $("#cmbBijiWarna option:selected").text();
					var arrNamaBijiWarna = namaBijiWarna1.split(" | ");
					namaBijiWarna1 = arrNamaBijiWarna[0];
				}
				var komposisi1 = $("#txtKomposisi").val().replace(/,/g,"");
				var keterangan1 = $("#cmbKeterangan").val();
				var keteranganMerek1 = $("#txtKetMerekHasil").val();
				var ukuran1 = $("#txtUkuranHasil").val();
				var tebal1 = $("#txtTebalHasil").val();
				var berat1 = $("#txtBeratHasil").val();
				var strip1 = $("#txtStripHasil").val();
				var warnaStrip1 = $("#cmbWarnaStrip").val();
				var jenisRoll1 = $("#cmbRollPipa").val();
				var shift1 = $("#cmbShift").val();
				var hasil1 = $("#txtJumlahHasil").val().replace(/,/g,"");
				var jumlahPermintaan1 = $("#txtJumlahPermintaan").val();
				var kodeBaru1 = $("#cmbMerek").val();
				if(kodeBaru1=="" || kodeBaru1==null){
					var kdExtruderBaru1 = "";
					var kdPpicBaru1 = "";
					var kdGdRollBaru1 ="";
					var ukuranBaru1 = "";
					var merekBaru1 = "";
					var warnaPlastikBaru1 = "";
				}else{
					var arrKdBaru1 = kodeBaru1.split("#");
					var kdExtruderBaru1 = arrKdBaru1[0];
					var kdPpicBaru1 = arrKdBaru1[1];
					var kdGdRollBaru1 = arrKdBaru1[2];
					var dataTextBarang = $("#cmbMerek").select2("data")[0]["text"];
					var arrDataTextBarang = dataTextBarang.split(" | ");
					var ukuranBaru1 = arrDataTextBarang[1];
					var merekBaru1 = arrDataTextBarang[2];
					var warnaPlastikBaru1 = arrDataTextBarang[3];
				}

				switch (jenisRoll1) {
					case "BOBIN"				 : var panjangPlastik1 = $("#txtPanjangPlastik").val().replace(/,/g,"");
																 var doubleSingle1 = $("#txtDoubleSingle").val().replace(/,/g,"");
																 var rumusRoll1 = $("#txtRumusRoll").val().replace(/,/g,"");
																 var jumlahBobin1 = $("#txtJumlahBobin").val().replace(/,/g,"");
																 break;

					case "PAYUNG" 			 : var rumusRoll1 = $("#txtRumusRollPayung").val().replace(/,/g,"");
																 var payung1 = $("#txtPayung").val().replace(/,/g,"");
																 break;

					case "PAYUNG_KUNING" : var rumusRoll1 = $("#txtRumusRollPayung").val().replace(/,/g,"");
																 var payungKuning1 = $("#txtPayung").val().replace(/,/g,"");
																 break;
					default: break;
				}

				// if()

				if(kdExtruder1=="" || kdGdRoll1=="" || warnaPlastik1=="" || tglPengerjaan1=="" ||
					 noMesin1=="" || jnsBarang1=="" || jnsPermintaan1=="" ||
				 	 bijiWarna1=="" || komposisi1=="" || keterangan1=="" || ukuran1=="" || strip1=="" || jenisRoll1=="" ||
				 	 shift1=="" || hasil1=="" || jumlahPermintaan1==""){
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
							 url : "<?php echo base_url(); ?>_extruder/main/editHasilExtruder",
							 dataType : "TEXT",
							 data : {
								 idHasilExtruder	: idHasilExtruder1,
								 kdExtruder 			: kdExtruder1,
								 kdGdRoll 				: kdGdRoll1,
								 warnaPlastik 		: warnaPlastik1,
								 tglPengerjaan 		: tglPengerjaan1,
								 noMesin 					: noMesin1,
								 // merek 						: merek1,
								 jnsBarang 				: jnsBarang1,
								 jnsPermintaan 		: jnsPermintaan1,
								 bijiWarna 				: bijiWarna1,
								 namaBijiWarna 		: namaBijiWarna1,
								 komposisi 				: komposisi1,
								 keterangan 			: keterangan1,
								 ketMerek					: keteranganMerek1,
								 ukuran 					: ukuran1,
								 tebal 						: tebal1,
								 berat 						: berat1,
								 strip 						: strip1,
								 warnaStrip				: warnaStrip1,
								 jenisRoll 				: jenisRoll1,
								 shift 						: shift1,
								 hasil 						: hasil1,
								 jumlahPermintaan : jumlahPermintaan1,
								 panjangPlastik		: panjangPlastik1,
								 doubleSingle			: doubleSingle1,
								 rumusRoll				: rumusRoll1,
								 jumlahBobin			: jumlahBobin1,
								 payung						: payung1,
								 payungKuning			: payungKuning1,
								 kdExtruderBaru		: kdExtruderBaru1,
								 kdPpicBaru				: kdPpicBaru1,
								 kdGdRollBaru			: kdGdRollBaru1,
								 ukuranBaru				: ukuranBaru1,
			 				 	 merekBaru				: merekBaru1,
			 					 warnaPlastikBaru	: warnaPlastikBaru1
							 },
							 success : function(response) {
							 	if(jQuery.trim(response) === "Berhasil"){
									$("#modal-notif").addClass("modal-info");
									$("#modalNotifContent").text("Data Berhasil Diubah");
									$("#modal-notif").modal("show");
									setTimeout(function(){
										$("#modal-notif").modal("hide");
										$("#modal-notif").removeClass("modal-info");
										$("#modalNotifContent").text("");
										searchDataLaporanRencanaMandor(param2, param3, param4);
										$("input").empty();
										$("#cmbKeterangan").val("TS").trigger("click");
										$("#modalEditHasil").modal("hide");
										// if($("#tableHasilJobExtruder_Lokal").length){
										// 	tableListHasilJobExtruder("LOKAL");
										// 	reloadDataHasilJobExtruderFinal("LOKAL");
										// }
										// if($("#tableHasilJobExtruder_Export").length){
										// 	tableListHasilJobExtruder("EXPORT");
										// 	reloadDataHasilJobExtruderFinal("EXPORT");
										// }
										// $("#modalInputHasil").modal("hide");
										//
										// if($("#tableRencanaMandorExtruder_KP").length){
										// 	datatablesListRencanaKerjaExtruder("#tableRencanaMandorExtruder_KP","PROGRESS","KLIP");
										// }
										// if($("#tableRencanaMandorExtruder_ZP").length){
										// 	datatablesListRencanaKerjaExtruder("#tableRencanaMandorExtruder_ZP","PROGRESS","ZP");
										// }

									},2000);
								}else if(jQuery.trim(response) === "Gagal"){
									$("#modal-notif").addClass("modal-danger");
									$("#modalNotifContent").text("Data Gagal Ditambahkan");
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

			function editDataJobExtruder(param, param2, param3, param4){
				var bijiWarna1 = $("#txtJumlahBijiWarna").val().replace(/,/g, "");
				var total1 = $("#txtTotal").val().replace(/,/g, "");
				var berat1 = $("#txtJumlahBerat").val().replace(/,/g, "");
				var apal1 = $("#txtJumlahApal").val().replace(/,/g, "");
				var rollPipa1 = $("#txtJumlahRollPipa").val().replace(/,/g, "");
				var plusminus1 = $("#txtPlusMinus").val().replace(/,/g, "");
				var sisaBahan1 = $("#txtJumlahSisaBahan").val().replace(/,/g, "");
				var penambahanBiji1 = $("#txtPenambahanBijiBaru").val().replace(/,/g, "");
				var penguranganBiji1 = $("#txtPenguranganBijiBaru").val().replace(/,/g, "");
				var jumlahSisa = $("#txtJumlahSisa").val().replace(/,/g, "");

				if(bijiWarna1=="" || total1=="" || berat1=="" || apal1=="" ||
					 rollPipa1=="" || plusminus1=="" || sisaBahan1=="" || penambahanBiji1 == "" ||
	 			 	 penguranganBiji1 == "" || jumlahSisa==""){
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
						url : "<?php echo base_url('_extruder/main/editDataJobExtruder'); ?>",
						dataType : "TEXT",
						data : {
							idTransaksi	: param,
							bijiWarna 	: bijiWarna1,
							total 			: total1,
							berat 			: berat1,
							apal 				: apal1,
							rollPipa 		: rollPipa1,
							plusminus 	: plusminus1,
							sisaBahan 	: sisaBahan1,
							penambahanBiji  : penambahanBiji1,
							penguranganBiji : penguranganBiji1,
							sisa : jumlahSisa
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
									searchDataLaporanRencanaMandor(param2, param3, param4);
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
			//============================================EDIT METHOD (Finish)============================================//

			//============================================DELETE METHOD (Start)============================================//
			function deleteAndRestoreRencanaExtruderPending(param1, param2){
				if(param2 == "TRUE"){
					var text = "Apakah Anda Yakin Ingin Menghapus Data Ini?";
				}else{
					var text = "Apakah Anda Yakin Ingin Mengembalikan Data Ini?";
				}
				if(confirm(text)){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_extruder/main/deleteAndRestoreRencanaExtruderPending",
						dataType : "TEXT",
						data : {
							kdExtruder : param1,
							deleted : param2
						},
						success : function(response){
							if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Rencana Berhasil Dihapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
									tableRencanaExtruderPending();
									tableRencanaExtruderSusulanPending();
								},2000);
							}else if(jQuery.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Rencana Gagal Dihapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Parameter Kosong Kosong!");
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

			function deleteAndRestorePermintaanExtruder(param1, param2){
				if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_extruder/main/deleteAndRestorePermintaanExtruder",
						dataType : "TEXT",
						data : {
							idTransaksi : param1,
							deleted : param2
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
									tableListPermintaanExtruder("BAHAN BAKU","LOKAL");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Data Gagal Dihapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-danger");
									$("#modalNotifContent").text("");
									tableListPermintaanExtruder("BAHAN BAKU","LOKAL");
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

			 function deleteAndRestoreTambahBijiWarnaPending(param1, param2, param3){
				 if(param3=="TRUE"){
					 textConfirm = "Apakah Anda Yakin Ingin Menghapus Data Ini?";
					 textDialogSuccess = "Data Berhasil Dihapus";
					 textDialogFailed_1 = "Data Transaksi Gagal Dihapus";
					 textDialogFailed_2 = "Data Stok Biji Warna Extruder Gagal Dihapus";
				 }else{
					 textConfirm = "Apakah Anda Yakin Ingin Mengembalikan Data Ini?";
					 textDialogSuccess = "Data Berhasil Dikembalikan";
					 textDialogFailed_1 = "Data Transaksi Gagal Dikembalikan";
					 textDialogFailed_2 = "Data Stok Biji Warna Extruder Gagal Dikembalikan";
				 }
				 if(confirm(textConfirm)){
					 $.ajax({
						 type : "POST",
						 url : "<?php echo base_url(); ?>_extruder/main/deleteAndRestoreTambahBijiWarnaPending",
						 dataType : "TEXT",
						 data : {
							 idTransaksi : param1,
							 idGudangBuffer : param2,
							 deleted : param3
						 },
						 success : function(response){
							 if(jQuery.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
 								$("#modalNotifContent").text(textDialogSuccess);
 								$("#modal-notif").modal("show");
 								setTimeout(function(){
 									$("#modal-notif").modal("hide");
 									$("#modal-notif").removeClass("modal-info");
 									$("#modalNotifContent").text("");
									tableListTambahBijiWarnaPending();
 								},2000);
							 }else if(jQuery.trim(response) === "Gagal1"){
								 $("#modal-notif").addClass("modal-danger");
  							 $("#modalNotifContent").text(textDialogFailed_1);
  							 $("#modal-notif").modal("show");
  							 setTimeout(function(){
  								 $("#modal-notif").modal("hide");
  								 $("#modal-notif").removeClass("modal-danger");
  								 $("#modalNotifContent").text("");
  							 },2000);
							 }else{
								 $("#modal-notif").addClass("modal-danger");
  							 $("#modalNotifContent").text(textDialogFailed_2);
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

			 function deleteDataBonApal(param,param2){
				 if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
					 $.ajax({
						 type : "POST",
						 url : "<?php echo base_url(); ?>_extruder/main/deleteAndRestoreDataBonApal",
						 dataType : "TEXT",
						 data : {
							 idTransaksi : param,
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
 									 tableDataBonApal(param2);
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

			 function deleteKembalianBahanBaku(param){
				 if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
					 $.ajax({
						 type : "POST",
						 url : "<?php echo base_url(); ?>_extruder/main/deletedAndRestoreKembalianBahanBaku",
						 dataType : "TEXT",
						 data : {idTransaksi:param, deleted:"TRUE"},
						 success : function(response){
							 if(jQuery.trim(response) === "Berhasil"){
								 $("#modal-notif").addClass("modal-info");
  							 $("#modalNotifContent").text("Data Berhasil Dihapus");
  							 $("#modal-notif").modal("show");
  							 setTimeout(function(){
  								 $("#modal-notif").modal("hide");
  								 $("#modal-notif").removeClass("modal-info");
  								 $("#modalNotifContent").text("");
 									 resetFormKembalianBahanBaku();
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

			 function deleteKembalianBijiWarna(param){
				 if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
					 $.ajax({
						 type : "POST",
						 url : "<?php echo base_url(); ?>_extruder/main/deletedAndRestoreKembalianBijiWarna",
						 dataType : "TEXT",
						 data : {idTransaksi:param, deleted:"TRUE"},
						 success : function(response){
							 if(jQuery.trim(response) === "Berhasil"){
								 $("#modal-notif").addClass("modal-info");
  							 $("#modalNotifContent").text("Data Berhasil Dihapus");
  							 $("#modal-notif").modal("show");
  							 setTimeout(function(){
  								 $("#modal-notif").modal("hide");
  								 $("#modal-notif").removeClass("modal-info");
  								 $("#modalNotifContent").text("");
 									 resetFormKembalianBijiWarna();
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
			//============================================DELETE METHOD (Finish)============================================//

			//============================================RESET METHOD (Start)============================================//
			function resetFormBuatRencanaBaru(param){
				$("input").val("");
				$("textarea").val("");
				$("#cmbNoMesin").val("MSN170612001");
				$("#cmbJenisMesin").val("KLIP");
				$("#cmbStrip").val("LOSE")
				$(".date").datepicker("setDate",null);
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getGenerateExtruderCode",
					dataType : "JSON",
					success : function(response){
						$("#txtKodeExtruder").val(response.Code);
						tableDetailRencanaPpic(param);
					},
					error : function(response){
						$("#modal-notif").addClass("modal-danger");
						$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-danger");
							$("#modalNotifContent").text("");
						},2000);
					}
				});
				tableRencanaExtruderPending();
			}

			function resetFormBuatRencanaSusulanBaru(){
				$("input").val("");
				$("textarea").val("");
				$("#cmbNoMesin3").val("MSN170612001");
				$("#cmbJenisMesin2").val("KLIP");
				$("#cmbStrip").val("LOSE").trigger("change");
				$("#cmbMerekGudangRoll").val("").trigger("change");
				// $("#txtStripWrapper").css("display","none");
				// $("#cmbStripWrapper").css("display","block");
				$(".date").datepicker("setDate",null);
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getGenerateExtruderCode",
					dataType : "JSON",
					success : function(response){
						$("#txtKodeExtruder2").val(response.Code);
						$("#btnAddRencanaSusulan").attr("onclick","saveAddRencanaExtruderSusulan()").html("<i class='fa fa-plus'></i> Tambah");
					},
					error : function(response){
						$("#modal-notif").addClass("modal-danger");
						$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-danger");
							$("#modalNotifContent").text("");
						},2000);
					}
				});
				tableRencanaExtruderSusulanPending();
			}

			function resetFormMintaBahanBaku(){
				$("input").val("");
				$(".date").datepicker("setDate",null);
				$("txtBahan").val("");
				$("#btnTambahPermintaanBahanBaku").attr("onclick","saveAddPermintaanBahanBaku()").html("<i class='fa fa-plus'></i> Tambah");
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getComboBoxValueBahanBaku",
					dataType : "JSON",
					success : function(response){
						$("#txtBahan").empty();
						$.each(response,function(AvIndex, AvValue){
							$("#txtBahan").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.nm_barang+"</option>")
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

			function resetFormMintaBijiWarna(){
				$("input").val("");
				$("select").val("");
				$(".date").datepicker("setDate",null);
				$("#btnTambahPermintaanBijiWarna").attr("onclick","saveAddPermintaanBijiWarna()").html("<i class='fa fa-plus'></i> Tambah");
				$.ajax({
					url : '<?php echo base_url(); ?>_extruder/main/getBijiWarnaGudangBufferExtruder',
					dataType : "JSON",
					success : function(response){
						$("#cmbBijiWarna").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#cmbBijiWarna").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.nm_barang+"("+AvValue.warna+")</option>")
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

			function resetFormTambahBijiWarna(){
				$("input").val("");
				$("select").val("");
				$(".date").datepicker("setDate",null);
				$("#btnTambahStokBijiWarnaPending").attr("onclick","saveAddBijiWarnaBaru()").html("<i class='fa fa-plus'></i> Tambah");
				$.ajax({
					url : '<?php echo base_url(); ?>_extruder/main/getComboBoxValueBijiWarna',
					dataType : "JSON",
					success : function(response){
						$("#cmbBijiWarnaBaru").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#cmbBijiWarnaBaru").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.nm_barang+"("+AvValue.warna+")</option>")
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

			function resetFormTambahBonApal(){
				$("#btnTambahBarangApal").attr("onclick","saveTambahApalPending();").html("<i class='fa fa-plus'></i> Tambah").removeClass("btn-warning").addClass("btn-primary");
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getComboBoxGudangApal",
					dataType : "JSON",
					success : function(response){
						$("#cmbJenisApal").empty();
						$.each(response, function(AvIndex, AvValue){
							if(AvValue.sub_jenis == "" || AvValue.sub_jenis==null){
								$("#cmbJenisApal").append("<option value='"+AvValue.kd_gd_apal+"'>"+AvValue.jenis+"</option>");
							}else{
								$("#cmbJenisApal").append("<option value='"+AvValue.kd_gd_apal+"'>"+AvValue.sub_jenis+"</option>");
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
				$("input").val("");
				$(".date").datepicker("setDate",null);
			}

			function resetFormKembalianBahanBaku(){
				$("input").val("");
				$("cmbBahanBaku").val("");
				tableListKembalianBahanBakuExtruderPending();
				$("#btnTambahKembalianBahanBakuPending").removeClass("btn-warning").addClass("btn-primary").attr("onclick","saveAddKembalianBahanBaku()").html("<i class='fa fa-plus'></i> Tambah");
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getComboBoxValueBahanBaku",
					dataType : "JSON",
					success : function(response){
						$("#cmbBahanBaku").empty();
						$.each(response,function(AvIndex, AvValue){
							$("#cmbBahanBaku").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.nm_barang+"</option>")
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

			function resetFormKembalianBijiWarna(){
				$("input").val("");
				$("select").val("");
				$(".date").datepicker("setDate",null);
				tableListKembalianBijiWarnaExtruderPending();
				$("#btnTambahPengembalianBijiWarnaPending").removeClass("btn-warning").addClass("btn-primary").attr("onclick","saveAddKembalianBijiWarna()").html("<i class='fa fa-plus'></i> Tambah");
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getComboBoxValueBijiWarna",
					dataType : "JSON",
					success : function(response){
						$("#cmbBijiWarna").empty();
						$.each(response,function(AvIndex, AvValue){
							$("#cmbBijiWarna").append("<option value='"+AvValue.kd_gd_bahan+"'>"+AvValue.nm_barang+"</option>")
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
			//============================================RESET METHOD (Finish)============================================//

			//============================================RELOAD METHOD (Start)============================================//
			function reloadJumlahPenambahanBahanBaku(){
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getJumlahPenambahanBahanBaku",
					dataType : "JSON",
					success : function(response){
						$.each(response.permintaan, function(AvIndex, AvValue){
							if(AvValue.jumlah_permintaan == null){
								$("#txtJumlahPenambahanBahanBaku").text("(+ 0) NOTE : Penambahan Bahan Baku Hari Ini");
							}else{
								$("#txtJumlahPenambahanBahanBaku").text("(+ "+parseFloat(AvValue.jumlah_permintaan).toLocaleString()+") NOTE : Penambahan Bahan Baku Hari Ini");
							}
						});
						$.each(response.bahanBaku, function(AvIndex, AvValue){
							$("#txtSisaBijiKemarin").text(parseFloat(AvValue.sisa_biji_kemarin).toLocaleString());
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

			function reloadDataHasilJobExtruderFinal(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDataHasilJobExtruderFinal",
					dataType : "JSON",
					data : {jnsBrg : param},
					success : function(response){
						// $("#txtPenambahanBijiBaru_Lokal").val(Math.round(response.penambahanBijiBaru));
						$("#txtPenguranganBiji_Lokal").val(Math.round(response.penguranganBijiBaru));
						$.each(response.resultSisaBijiKemarin,function(AvIndex, AvValue){
							if(param=="LOKAL"){
								$("#txtSisaBijiKemarin_Lokal").val(Math.round(AvValue.sisa_biji_kemarin));
							}else{
								$("#txtSisaBijiKemarin_Export").val(Math.round(AvValue.sisa_biji_kemarin));
							}
						});
						$.each(response.resultDataJumlah, function(AvIndex, AvValue){
							if(param == "LOKAL"){
								$("#txtBijiWarna_Lokal").val(AvValue.jumlah_biji_warna);
								$("#txtBerat2_Lokal").val(AvValue.jumlah_selesai);
								$("#txtRollPipa_Lokal").val(AvValue.roll_pipa);
							}else{
								$("#txtBijiWarna_Export").val(AvValue.jumlah_biji_warna);
								$("#txtBerat2_Export").val(AvValue.jumlah_selesai);
								$("#txtRollPipa_Export").val(AvValue.roll_pipa);
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
			//============================================RELOAD METHOD (Finish)============================================//

			//===========================================RESTORE METHOD (Start)============================================//
			function deleteAndRestoreHasilJobExtruder(param, param2){
				if(confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_extruder/main/deleteAndRestoreHasilExtruderTemp'); ?>",
						dataType : "TEXT",
						data : {
							idTransaksi	: param,
							deleted			: param2,
						},
						success : function(response){
							if($.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Data Berhasil Dihapus");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-info");
									$("#modalNotifContent").text("");
								},2000);
							}else if($.trim(response) === "Gagal"){
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
			//============================================RESTORE METHOD (Finish)============================================//

			//============================================SEARCH METHOD (Start)============================================//
			function searchSpkPPIC(){
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
					datatablesListRencanaKerjaPPIC(tglAwal1, tglAkhir1);
					$("#modalCariDataRencanaKerjaPpic").modal("hide");
					$("input").val("");
					$(".date").datepicker("setDate",null);
				}
			}

			function searchDataLaporanRencanaMandor(param1="", param2="", param3=""){
				if(param1=="" || param2=="" || param3==""){
					var shift1 = $("#cmbPilihShift").val();
					var jenisMesin1 = $("#cmbPilihMesin").val();
					var tglRencana1 = $("#txtTanggal").val();
				}else{
					var shift1 = param1;
					var jenisMesin1 = param2;
					var tglRencana1 = param3;
				}

				if(shift1=="" || jenisMesin1=="" || tglRencana1==""){
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
						url : "<?php echo base_url(); ?>_extruder/main/getDataLaporanRencanaMandor",
						dataType : "JSON",
						data : {
							shift 		 : shift1,
							jnsMesin 	 : jenisMesin1,
							tglRencana : tglRencana1
						},
						success : function(response){
							var arrTanggal = tglRencana1.split("-");
							$("#lblTanggal").text("Tanggal : " +arrTanggal[2] +"-"+ arrTanggal[1] +"-"+arrTanggal[0]);
							$("#tableDataLaporanRencanaMandor > tbody > tr").empty();
							var hasil_berat = 0;
							var roll_pipa = 0;
							var totalData = response.tableDataExtruder.length;
							var totalBijiWarna = 0;
							var totalStrip = 0;
							if(totalData <= 0){
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Hasil Pencarian Tidak Ditemukan!");
								$("#modal-notif").modal("show");
								setTimeout(function(){
									$("#modal-notif").modal("hide");
									$("#modal-notif").removeClass("modal-warning");
									$("#modalNotifContent").text("");
								},2000);
								$("#rowHasilPencarian").css("display","none");
							}else{
								$("#rowHasilPencarian").css("display","block");
								$("#modalCariLaporanRencanaMandor").modal("hide");
								$("input").val("");
								$(".date").datepicker("setDate",null);
								$.each(response.tableDataExtruder,function(AvIndex, AvValue){
									$("#tableDataLaporanRencanaMandor > tbody:last-child").append(
										"<tr>"+
										"<td>"+AvValue.mesin+"</td>"+
										"<td>"+AvValue.biji_warna+"</td>"+
										"<td>"+AvValue.hasil_ukuran+"</td>"+
										"<td>"+AvValue.jumlah_selesai+"</td>"+
										"<td>"+AvValue.roll_pipa+"</td>"+
										"<td>"+AvValue.shift+"</td>"+
										"<td>"+AvValue.merek+"</td>"+
										"<td><button class='btn btn-md btn-flat btn-warning' onclick=modalEditHasilExtruder('"+AvValue.id_hasil_extruder+"','"+shift1+"','"+jenisMesin1+"','"+tglRencana1+"')>Ubah</button></td>"+
										"</tr>"
									);
									hasil_berat = hasil_berat + parseFloat(AvValue.jumlah_selesai);
									roll_pipa = roll_pipa + parseFloat(AvValue.roll_pipa);
									totalBijiWarna += parseFloat(AvValue.jumlah_biji_warna);
									if(AvValue.pemakaian_strip == null || AvValue.pemakaian_strip == ""){
										var x = "0";
									}else{
										var x = AvValue.pemakaian_strip;
									}
									if(x.indexOf("#") > 0){
										var pemakaianStripTemp = x.split("#");
										totalStrip += (parseFloat(pemakaianStripTemp[0]) + parseFloat(pemakaianStripTemp[1]));
									}else{
										totalStrip += parseFloat(x);
									}
									$("#txtJumlahBerat").val(hasil_berat);
									$("#txtJumlahRollPipa").val(roll_pipa);
								});

								$.each(response.sisaBijiKemarin, function(AvIndex, AvValue){
									$("#txtSisaBijiKemarin").val(parseFloat(AvValue.sisa_biji_kemarin));
									// $("#txtPenambahanBijiBaru").val(AvValue.penambahan_biji);
									// $("#txtPenguranganBijiBaru").val(AvValue.pengurangan_biji);
									// $("#txtJumlahCorong").val(parseFloat(AvValue.corong));
									// $("#txtJumlahSisaBahan").val(AvValue.sisa_bahan);
									// $("#txtPlusMinus").val(AvValue.plusminus);
									// $("#txtJumlahBijiWarna").val(parseFloat(AvValue.total_biji_warna));
									// $("#txtTotal").val(AvValue.total);
									// $("#txtJumlahApal").val(AvValue.jumlah_apal);
									// $("#txtJumlahSisa").val(parseFloat(AvValue.corong) + parseFloat(AvValue.sisa_bahan));
								});
								$.each(response.dataJobExtruder, function(AvIndex, AvValue){
									$("#txtPenambahanBijiBaru").val(parseFloat(AvValue.penambahan_biji));
									$("#txtPenguranganBijiBaru").val(parseFloat(AvValue.pengurangan_biji));
									$("#txtJumlahCorong").val(parseFloat(AvValue.corong));
									$("#txtJumlahSisaBahan").val(parseFloat(AvValue.sisa_bahan));
									$("#txtPlusMinus").val(parseFloat(AvValue.plusminus));
									$("#txtJumlahBijiWarna").val(parseFloat(totalBijiWarna + totalStrip).toFixed(3));
									$("#txtTotal").val(parseFloat(AvValue.total));
									$("#txtJumlahApal").val(parseFloat(AvValue.jumlah_apal));
									$("#txtJumlahSisa").val(parseFloat(AvValue.corong) + parseFloat(AvValue.sisa_bahan));
								});
								if($("#btnSimpanLaporanRencanaMandor").length > 0){
									$("#btnSimpanLaporanRencanaMandor").attr("onclick","editDataJobExtruder('"+response.dataJobExtruder[0].id_data+"','"+shift1+"','"+jenisMesin1+"','"+tglRencana1+"')");
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

			function searchHasilExtruder(){
					var shift1 = $("#cmbPilihShift").val();
					var jnsBrg1 = $("#cmbPilihMesin").val();
					var tglRencana1 = $("#txtTanggal").val();

					if(shift1=="" || jnsBrg1=="" || tglRencana1==""){
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
								url : "<?php echo base_url(); ?>_extruder/main/getDataHasilExtruder",
							dataType : "JSON",
							data : {
								shift 			: shift1,
								jnsBrg 			: jnsBrg1,
								tglRencana 	: tglRencana1
							},
							success : function(response){
								var arrBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
								var arrTanggal = tglRencana1.split("-");
								$("#h4Tanggal").text("Hasil Global " +arrTanggal[2] +"-"+ arrBulan[(parseFloat(arrTanggal[1])-1)] +"-"+arrTanggal[0]);
								$("#lblTanggal").text("Tanggal : "+tglRencana1);
								$("#tableHasilExtruder > tbody > tr").empty();
								$("#modalCariHasilExtruder").modal("hide");
								var totalHasilBerat = 0;
								var totalBeratRoll = 0;
								var totalJumlahBijiWarna = 0;
								var merek = "";
								var pemakaianStrip = 0;
								var bijiWarna = "";
								$.each(response.dataHasilExtruder, function(AvIndex, AvValue){
									var jnsRoll = AvValue.jenis_roll == "PAYUNG_KUNING" ? "PAYUNG KUNING" : AvValue.jenis_roll;
									var ketMerek1 = AvValue.ket_merek;
									if(ketMerek1 != null && ketMerek1.toUpperCase().indexOf("PON")!= -1){
										var ketMerek = " ("+ketMerek1.toUpperCase()+")";
									}else{
										var ketMerek = "";
									}
									$("#tableHasilExtruder > tbody:last-child").append(
										"<tr>"+
											"<td>"+AvValue.tebal+"</td>"+
											"<td>"+AvValue.biji_warna+" / "+AvValue.keterangan+"</td>"+
											"<td>"+AvValue.hasil_ukuran+"</td>"+
											"<td>"+parseFloat(AvValue.jumlah_selesai).toLocaleString()+"</td>"+
											"<td>"+AvValue.roll_lembar+"</td>"+
											"<td>"+AvValue.roll_pipa+"</td>"+
											"<td>"+jnsRoll+"</td>"+
											"<td>"+AvValue.shift+"</td>"+
											"<td>"+AvValue.merek + ketMerek +"</td>"+
										"</tr>"
									);
									totalHasilBerat += parseFloat(AvValue.jumlah_selesai);
									totalBeratRoll += parseFloat(AvValue.roll_pipa);
									merek = AvValue.merek;
									bijiWarna = AvValue.biji_warna;
									if(AvValue.pemakaian_strip == null || AvValue.pemakaian_strip == ""){
										var x = "0";
									}else{
										var x = AvValue.pemakaian_strip;
									}
									if(x.indexOf("#") > 0){
										var pemakaianStripTemp = x.split("#");
										pemakaianStrip += (parseFloat(pemakaianStripTemp[0]) + parseFloat(pemakaianStripTemp[1]));
									}else{
										pemakaianStrip += parseFloat(x);
									}
									// if(AvValue.keterangan == "STRIP"){
									// 	if(merek.toUpperCase() == "KP" || merek.toUpperCase() == "MP"){
									// 		if(bijiWarna.toUpperCase() == "PUTIH"){
									// 			pemakaianStrip += (parseFloat(AvValue.jumlah_selesai) - parseFloat(AvValue.roll_pipa)) * 0.0015;
									// 		}else{
									// 			pemakaianStrip += (parseFloat(AvValue.jumlah_selesai) - parseFloat(AvValue.roll_pipa) - parseFloat(AvValue.jumlah_biji_warna)) * 0.0015;
									// 		}
									// 	}else{
									// 		if(bijiWarna.toUpperCase() == "PUTIH"){
									// 			pemakaianStrip += (parseFloat(AvValue.jumlah_selesai) - parseFloat(AvValue.roll_pipa)) * 0.0015;
									// 		}else{
									// 			pemakaianStrip += (parseFloat(AvValue.jumlah_selesai) - parseFloat(AvValue.roll_pipa) - parseFloat(AvValue.jumlah_biji_warna)) * 0.0015;
									// 		}
									// 	}
									// }
								});

								if(response.dataBijiWarna.length > 0){
									var j = parseInt($("#tableBijiWarna tr").length) - 3;
									for (var i = 0; i < j; i++) {
										$("#tr"+i).remove();
									}
									$.each(response.dataBijiWarna, function(AvIndex, AvValue){
										$("#tableBijiWarna > tbody > tr:first").before(
											"<tr id='tr"+AvIndex++ +"'>"+
											"<td>"+AvValue.biji_warna+"</td>"+
											"<td>:</td>"+
											"<td>"+parseFloat(AvValue.jumlah_biji_warna).toFixed(3)+"</td>"+
											"</tr>"
										);
										// totalJumlahBijiWarna += parseFloat(AvValue.jumlah_biji_warna).toFixed(3);
									});
									for (var i = 0; i < response.dataBijiWarna.length; i++) {
										totalJumlahBijiWarna += parseFloat(response.dataBijiWarna[i].jumlah_biji_warna);
									}
								}else{
									var j = parseInt($("#tableBijiWarna tr").length) - 3;
									for (var i = 0; i < j; i++) {
										$("#tr"+i).remove();
									}
								}

								$("#tdSisaShiftSebelumnya").text(parseFloat(response.sisaBijiKemarin[0].sisa_biji_kemarin).toLocaleString());
								$("#tdBerat").text(parseFloat(totalHasilBerat).toLocaleString());
								$("#tdRoll").text(parseFloat(totalBeratRoll).toLocaleString());
								$("#tdPenggunaanStrip").text(parseFloat(pemakaianStrip).toLocaleString());

								if(response.dataJobExtruder.length > 0){
									$.each(response.dataJobExtruder, function(AvIndex, AvValue){
										$("#tdSisa").text(parseFloat(AvValue.sisa_biji_kemarin).toLocaleString());
										$("#tdApal").text(parseFloat(AvValue.jumlah_apal).toLocaleString());
										$("#tdTotal").text(parseFloat(AvValue.total).toLocaleString());
										$("#tdJumlahBijiWarna").text(parseFloat(AvValue.total_biji_warna).toFixed(3));
										$("#tdPlusMinus").text(parseFloat(AvValue.plusminus).toLocaleString());
										$("#tdPenambahanBiji").text(parseFloat(AvValue.penambahan_biji).toLocaleString());
										$("#tdPenguranganBiji").text(parseFloat(AvValue.pengurangan_biji).toLocaleString());
									});
								}else{
									$("#tdSisa").text(Math.round(0));
									$("#tdApal").text(parseFloat(0.00).toFixed(2));
									$("#tdTotal").text(Math.round(0));
									$("#tdJumlahBijiWarna").text(parseFloat(parseFloat(0) + 0).toFixed(3));
									$("#tdPlusMinus").text(0.000);
									$("#tdPenambahanBiji").text(Math.round(0));
									$("#tdPenguranganBiji").text(Math.round(0));
								}
								$("#rowHasilExtruder").css("display","block");
								$("#btnPrintHasilExtruder").attr("href","<?php echo base_url('_extruder/main/printHasilExtruder'); ?>/"+shift1+"/"+jnsBrg1+"/"+tglRencana1);
							},
							error : function(response){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
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

			function searchKirimanHasilExtruder(){
					var tglRencana1 = $("#txtTanggal").val();
					var jnsBrg1 = $("#cmbPilihJenis").val();
					var shift1 = $("#cmbPilihShift").val();

					if(tglRencana1=="" || jnsBrg1=="" || shift1==""){
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
							url : "<?php echo base_url(); ?>_extruder/main/getDataKirimHasilExtruderKePpic",
							dataType : "JSON",
							data : {
								tglRencana : tglRencana1,
								jnsBrg : jnsBrg1,
								shift : shift1
							},
							success : function(response){
								$("#lblTanggal").text("Tanggal Laporan : "+tglRencana1);
								$("#rowLaporanHasilExtruder").css("display","block");
								if(response[0].kirim_ke_ppic == "FALSE"){
									$("#btnKirimHasilExtruder").attr("onclick","saveKirimHasilKePpic('"+response[0].id_data+"','TRUE','"+tglRencana1+"','"+jnsBrg1+"','"+shift1+"');").removeClass("btn-danger").addClass("btn-success").html("<i class='fa fa-send'></i> Kirim");
								}else{
									$("#btnKirimHasilExtruder").attr("onclick","saveKirimHasilKePpic('"+response[0].id_data+"','FALSE','"+tglRencana1+"','"+jnsBrg1+"','"+shift1+"');").removeClass("btn-success").addClass("btn-danger").html("<i class='fa fa-undo'></i> Batal Kirim");;
								}
								$("#modalCariKirimanHasil").modal("hide");
								$("#tabelKirimHasilExtruder > tbody").empty();
								$.each(response, function(AvIndex, AvValue){
									if(AvValue.kirim_ke_ppic == "TRUE"){
										var x = "<label class='text-green'>Terkirim</label>";
									}else{
										var x = "<label class='text-Red'>Belum Terkirim</label>";
									}
									$("#tabelKirimHasilExtruder > tbody:last-child").append(
										"<tr>"+
											"<td>"+AvValue.tgl_rencana+"</td>"+
											"<td>"+parseFloat(AvValue.total).toFixed(2)+"</td>"+
											"<td>"+parseFloat(AvValue.jumlah_apal).toFixed(2)+"</td>"+
											"<td>"+AvValue.shift+"</td>"+
											"<td>"+AvValue.jns_brg+"</td>"+
											"<td>"+ x +"</td>"+
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
				}

			function searchRencacanaKerjaMandorExtruderSelesai(){
					var tglAwal1 = $("#txtTanggalAwal").val();
					var tglAkhir1 = $("#txtTanggalAkhir").val();

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
						$("#lblTglAwal").text(tglAwal1);
						$("#lblTglAkhir").text(tglAkhir1);
						datatablesListRencanaKerjaExtruderSelesai(tglAwal1, tglAkhir1);
						$("#rowListRencanaKerjaMandorExtruder").css("display","block");
						setTimeout(function(){
							$("#modalCariRencanaKerjaMandor").modal("hide");
							$("input").val("");
							$(".date").datepicker("setDate",null);
						},500);
					}
				}

			function searchDataBonRollPolos(param="") {
					if($("#txtTanggal").val() == "" || $("#txtTanggal").val() == null){
						var tanggal1 = param;
					}else{
						var tanggal1 = $("#txtTanggal").val();
					}
					if(tanggal1 == ""){
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
							url : "<?php echo base_url(); ?>_extruder/main/getDataBonRollPolos",
							dataType : "JSON",
							data : {tanggal : tanggal1},
							success : function(response){
								$("#tableDataBonRollPolos > tbody > tr").empty();
								if(response.length > 0){
									// $("#rowBonRollPolosMesin").css("display","block");
									// if(response[0]["sts_pengiriman"] == "TRUE"){
									// 	$("#btnKirimDataBonRollPolos").attr({"onclick":"saveKirimDataBonRollPolos('"+tanggal1+"')","disabled":"disabled"});
									// }else{
									// 	$("#btnKirimDataBonRollPolos").attr("onclick","saveKirimDataBonRollPolos('"+tanggal1+"')").removeAttr("disabled");
									// }
									$("#btnKirimDataBonRollPolos").attr("onclick","saveKirimDataBonRollPolos('"+tanggal1+"')").removeAttr("disabled");
									$("#btnPrintDataBonRollPolos").attr({"href":"<?php echo base_url(); ?>_extruder/main/printDataBonRollPolos/"+tanggal1, "target":"_blank"});
									$.each(response, function(AvIndex, AvValue){
										var jnsRoll = AvValue.jenis_roll == "PAYUNG_KUNING" ? "PAYUNG KUNING" : AvValue.jenis_roll;
										var statusBon = AvValue.sts_pengiriman == "FALSE" ? "<label class='text-red'>BELUM DIKIRIM</label>" : "<label class='text-green'>SUDAH DIKIRIM</label>";
										$("#tableDataBonRollPolos > tbody:last-child").append(
											"<tr>"+
												"<td>"+AvValue.tebal+" <label class='text-blue'>("+AvValue.kd_gd_roll+")</label>"+"</td>"+
												"<td>"+AvValue.hasil_ukuran+" <label class='text-green'>("+AvValue.merek+")</label>"+"</td>"+
												"<td>"+AvValue.jumlah_selesai+"</td>"+
												"<td>"+AvValue.warna_plastik+"</td>"+
												"<td>"+AvValue.roll_pipa+"</td>"+
												"<td>"+jnsRoll+"</td>"+
												"<td>"+AvValue.jns_brg+"</td>"+
												"<td>"+AvValue.shift+"</td>"+
												"<td>"+statusBon+"</td>"+
											"</tr>"
										);
									});
									$("#txtTanggal").val("");
									$(".date").datepicker("setDate",null);
									$("#modalCariDataBonRollPolos").modal("hide");
								}else{
									$("#modal-notif").addClass("modal-warning");
									$("#modalNotifContent").text("Laporan Tidak Ditemukan!");
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

			function searchDetailBonRollPolos(param="",param2="",param3="") {
					if(param!="" || param2!="" || param3!=""){
						var tanggal1 = param;
						var merek1 = param2;
						var shift1 = param3
					}else{
						var tanggal1 = $("#txtTanggal").val();
						var merek1 = $("#cmbMerek").val();
						var shift1 = $("#cmbShift").val();
					}
					if(tanggal1 == ""){
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
							url : "<?php echo base_url(); ?>_extruder/main/getDetailBonRollPolos",
							dataType : "JSON",
							data : {tglRencana : tanggal1,
											merek : merek1,
											shift : shift1},
							success : function(response){
								$("#tableListDetailBonRollPolos > tbody > tr").empty();
								if(response.length > 0){
									$("#rowDetailBonRollPolos").css("display","block");
									$("#btnPrintDetailBonRollPolos").attr({"href":"<?php echo base_url(); ?>_extruder/main/printDetailBonRollPolos/"+tanggal1+"/"+merek1+"/"+shift1, "target":"_blank"});
									$.each(response, function(AvIndex, AvValue){
										var jnsRoll = AvValue.jenis_roll == "PAYUNG_KUNING" ? "PAYUNG KUNING" : AvValue.jenis_roll;
										var statusBon = AvValue.sts_pengiriman == "FALSE" ? "<label class='text-red'>BELUM DIKIRIM</label>" : "<label class='text-green'>SUDAH DIKIRIM</label>";
										$("#tableListDetailBonRollPolos > tbody:last-child").append(
											"<tr>"+
												"<td>"+AvValue.tebal+" <label class='text-blue'>("+AvValue.kd_gd_roll+")</label>"+"</td>"+
												"<td>"+AvValue.hasil_ukuran+" <label class='text-green'>("+AvValue.merek+")</label>"+"</td>"+
												"<td>"+AvValue.jumlah_selesai+"</td>"+
												"<td>"+AvValue.warna_plastik+"</td>"+
												"<td>"+AvValue.roll_pipa+"</td>"+
												"<td>"+jnsRoll+"</td>"+
												"<td>"+AvValue.jns_brg+"</td>"+
												"<td>"+AvValue.shift+"</td>"+
												"<td>"+statusBon+"</td>"+
											"</tr>"
										);
									});
									$("input").val("");
									$(".date").datepicker("setDate",null);
									$("#modalCariDetailBonRollPolos").modal("hide");
								}else{
									$("#modal-notif").addClass("modal-warning");
									$("#modalNotifContent").text("Laporan Tidak Ditemukan!");
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

			function searchDataBonApal(){
					var tanggal = $("#txtTanggalCari").val();
					if(tanggal == ""){
						$("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
					}else{
						tableDataBonApal(tanggal);
						$("input").val("");
						$(".date").datepicker("setDate",null);
						$("#modalCariDataBarangApal").modal("hide");
					}
				}

			function searchHistoryBahanBaku(){
					var tglAwal = $("#txtTglAwal").val();
					var tglAkhir = $("#txtTglAkhir").val();

					if(tglAwal == "" || tglAkhir == ""){
						$("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
					}else{
						$("#modalCariBahanBaku").modal("hide");
						$("#jumalahBahanBakuWrapper").css("display","none");
						$("#historyBahanBakuWrapper").css("display","block");
						var arrBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"]
						var formatedTglAwal = new Date(tglAwal);
						var DTglAwal = formatedTglAwal.getDate();
						var MTglAwal = arrBulan[formatedTglAwal.getMonth()];
						var YTglAwal = formatedTglAwal.getFullYear();
						var FTglAwal = DTglAwal + " " + MTglAwal + " " + YTglAwal;

						var formatedTglAkhir = new Date(tglAkhir);
						var DTglAkhir = formatedTglAkhir.getDate();
						var MTglAkhir = arrBulan[formatedTglAkhir.getMonth()];
						var YTglAkhir = formatedTglAkhir.getFullYear();
						var FTglAkhir = DTglAkhir + " " + MTglAkhir + " " + YTglAkhir;

						$("#txtDetailBahan").text("Detail Bahan Baku Yang Diambil Extruder Tanggal "+FTglAwal+" - "+FTglAkhir);
						datatablesListHistoryBahanBakuExtruder(tglAwal,tglAkhir);
					}
				}

			function searchHistoryKembalianBahanBaku(){
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
						$("#modalCariHistoryKembalianBahanBaku").modal("hide");
						$("input").val("");
						$(".date").datepicker("setDate",null);
						$("#historyKembalianBahanBakuWrapper").css("display","block");
						datatablesListHistoryKembalianBahanBakuExtruder(tglAwal,tglAkhir);
					}
				}

			function searchHistoryBijiWarna(){
					var tglAwal1 = $("#txtTanggalAwal").val();
					var tglAkhir1 = $("#txtTanggalAkhir").val();
					var kdGdBahan1 = $("#cmbBijiWarna_History").val();

					if(tglAwal1=="" || tglAkhir1=="" || kdGdBahan1==""){
						$("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
					}else{
						$("#modalHistoryBijiWarna").modal("hide");
						$("#bijiWarnaWrapper").css("display","none");
						$("#historyBijiWarnaWrapper").css("display","block");
						datatablesListHistoryBijiWarnaExtruder(tglAwal1, tglAkhir1, kdGdBahan1);
						datatablesListHistoryBijiWarnaExtruder_GudangBahan(tglAwal1, tglAkhir1, kdGdBahan1);
					}
				}

			function searchHistoryKembalianBijiWarna(){
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
						$("#modalCariPengembalianBijiWarna").modal("hide");
						$("input").val("");
						$(".date").datepicker("setDate",null);
						$("#historyKembalianBijiWarnaWrapper").css("display","block");
						datatablesListHistoryKembalianBijiWarnaExtruder(tglAwal,tglAkhir);
					}
				}

				function searchPengambilanPotongExtruder(){
					var tanggal = $("#txtTanggal").val();
					if(tanggal==""){
						$("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
					}else{
						tablePengambilanPotongExtruder(tanggal);
						$("#modalCariBarang").modal("hide");
						$("input").empty();
						$(".date").datepicker("setDate",null);
					}
				}

				function searchPengambilanCetakExtruder(){
					var tanggal = $("#txtTanggal").val();
					if(tanggal==""){
						$("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
					}else{
						tablePengambilanCetakExtruder(tanggal);
						$("#modalCariBarang").modal("hide");
						$("input").empty();
						$(".date").datepicker("setDate",null);
					}
				}
			//============================================SEARCH METHOD (Finish)============================================//

			//============================================DATATABLE METHOD (Start)============================================//
			function datatablesListRencanaKerjaPPIC(param1="",param2=""){
				$("#tableRencanaPpic").dataTable().fnDestroy();
				$("#tableRencanaPpic").dataTable({
					// "fixedHeader" : true,
					"pageLength" : 100,
					"autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
					// "sWidth" : "100%",
					// "scrollX" : "90%",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_extruder/main/getListDataRencanaPPIC",
          "columns":[
            {"data" : "kd_ppic","name":"RP.kd_ppic","sWidth":"25px"},
            {"data" : "tgl_rencana","name":"RP.tgl_rencana","sWidth":"65px"},
            {"data" : "nm_cust","name":"RP.nm_cust","sWidth":"69px"},
            {"data" : "merek","name":"RP.merek","sWidth":"44px"},
            {"data" : "ket_merek","name":"RP.ket_merek","sWidth":"45px"},
            {"data" : "jns_permintaan","name":"RP.jns_permintaan","sWidth":"50px"},
            {"data" : "ukuran","name":"RP.ukuran","sWidth":"55px"},
            {"data" : "warna_plastik","name":"RP.warna_plastik","sWidth":"50px"},
            {"data" : "tebal","name":"RP.tebal","sWidth":"40px"},
						{"data" : "berat","name":"RP.berat","sWidth":"40px"},
						{"data" : "jumlah_permintaan","name":"RP.jumlah_permintaan","sWidth":"60px"},
						{"data" : "sisa","name":"RP.sisa","sWidth":"60px"},
						{"data" : "strip","name":"RP.strip","sWidth":"40px"},
						{"data" : "prioritas","name":"RP.prioritas","sWidth":"45px"},
						{"data" : "keterangan","name":"RP.keterangan","sWidth":"100px"},
						{"data" : "kd_ppic","name":"RP.kd_ppic","sWidth":"100px"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"tglAwal","value":param1},
					 							 {"name":"tglAkhir","value":param2},);
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
						$("td",nRow).css("background-color","")
						$("td:eq(10)",nRow).text(aData["jumlah_permintaan"]+" "+aData["satuan"]);
						if(aData["sts_pengerjaan"] == "progress"){
							$("td:eq(13)",nRow).html("<label style='color:#FFF;'>["+aData["prioritas"]+"]<label>").css("background-color","rgba(255, 0, 131, 0.5)");
						}else{
							if(aData["prioritas"] == "URGENT"){
								$("td:eq(13)",nRow).html("<label class='text-red'>["+aData["prioritas"]+"]<label>");
							}else if(aData["prioritas"] == "TUNDA"){
								$("td:eq(13)",nRow).html("<label class='text-yellow'>["+aData["prioritas"]+"]<label>");
							}else{
								$("td:eq(13)",nRow).html("<label class='text-blue'>["+aData["prioritas"]+"]<label>");
							}
						}

						if(aData["satuan"] !="KG" && (aData["satuan_kilo"] == null || aData["satuan_kilo"] == "" || aData["satuan_kilo"] == "null" || aData["satuan_kilo"] == "NULL")){
							$("td:eq(15)",nRow).html("<button class='btn btn-md btn-flat btn-warning' data-toggle='modal' data-target='#modalKonversiBerat' data-backdrop='static' onclick=modalKonversiBerat('"+aData["kd_ppic"]+"')>Konversi Ke Kg</button>"+
																			 "<button class='btn btn-md btn-flat btn-danger' data-toggle='modal' data-target='#modalEditStatus' data-backdrop='static' onclick=modalEditStatusPpic('"+aData["kd_ppic"]+"')>Edit Status</button>");
						}else{
							if(aData["sts_pengerjaan"] == "progress"){
								$("td:eq(15)",nRow).html(
																				// "<button class='btn btn-md btn-flat btn-success' data-toggle='modal' data-target='#modalBuatRencanaExtruder' data-backdrop='static' onclick=modalBuatRencanaExtruder('"+aData["kd_ppic"]+"')>Buat Rencana Kerja</button>"+
																				// "<a class='btn btn-md btn-flat btn-success' href='<?php #echo base_url('_extruder/main/buat_rencana_extruder'); ?>/"+aData["kd_ppic"]+"'>Buat Rencana Kerja</a>"+
																				 "<button class='btn btn-md btn-flat btn-warning' data-toggle='modal' data-target='#modalKonversiBerat' data-backdrop='static' onclick=modalKonversiBerat('"+aData["kd_ppic"]+"')>Edit Konversi Ke Kg</button>"+
																				 "<button class='btn btn-md btn-flat btn-danger' data-toggle='modal' data-target='#modalEditStatus' data-backdrop='static' onclick=modalEditStatusPpic('"+aData["kd_ppic"]+"')>Edit Status</button>");
							}else{
								$("td:eq(15)",nRow).html(
																				// "<button class='btn btn-md btn-flat btn-success' data-toggle='modal' data-target='#modalBuatRencanaExtruder' data-backdrop='static' onclick=modalBuatRencanaExtruder('"+aData["kd_ppic"]+"')>Buat Rencana Kerja</button>"+
																				"<a class='btn btn-md btn-flat btn-success' href='<?php echo base_url('_extruder/main/buat_rencana_extruder'); ?>/"+aData["kd_ppic"]+"'>Buat Rencana Kerja</a>"+
																				 "<button class='btn btn-md btn-flat btn-warning' data-toggle='modal' data-target='#modalKonversiBerat' data-backdrop='static' onclick=modalKonversiBerat('"+aData["kd_ppic"]+"')>Edit Konversi Ke Kg</button>"+
																				 "<button class='btn btn-md btn-flat btn-danger' data-toggle='modal' data-target='#modalEditStatus' data-backdrop='static' onclick=modalEditStatusPpic('"+aData["kd_ppic"]+"')>Edit Status</button>");
							}
						}
						var jumlahPermintaan = aData["jumlah_permintaan"];
						$("td:eq(10)",nRow).text(parseFloat(jumlahPermintaan.replace(/,/g,"")).toLocaleString() +" "+ aData["satuan"]);
						if(aData["satuan_kilo"] == null || aData["satuan_kilo"] =="" || aData["satuan_kilo"] =="null" || aData["satuan_kilo"] == "NULL"){
							$("td:eq(11)",nRow).text(parseFloat(aData["sisa"]).toLocaleString() +" "+ aData["satuan"]);
						}else{
							if(aData["sts_pengerjaan"] == "progress"){
								$("td:eq(11)",nRow).text("0 KG");
							}else{
								$("td:eq(11)",nRow).text(parseFloat(aData["sisa"]).toLocaleString() +" KG");
							}
						}
          }
				});
			}

			function tableRencanaExtruderPending(){
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getListRencanaExtruderPending",
					dataType : "JSON",
					success : function(response){
						$("#tableListRencanaExtruder > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tableListRencanaExtruder > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+ AvValue.mesin +"</td>"+
									"<td>"+ AvValue.motoran +"</td>"+
									"<td>"+ AvValue.nm_cust +"</td>"+
									"<td>"+ AvValue.ukuran +"</td>"+
									"<td>"+ AvValue.warna +"</td>"+
									"<td>"+ AvValue.tebal +"</td>"+
									"<td>"+ AvValue.jml_permintaan +"</td>"+
									"<td>"+ AvValue.strip +"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-warning' onclick=modalUbahRencanaExtruderTemp('"+AvValue.kd_extruder+"','"+AvValue.kd_ppic+"')>Ubah</button>"+
										"<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRencanaExtruderPending('"+AvValue.kd_extruder+"','TRUE')>Hapus</button>"+
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

			function tableRencanaExtruderSusulanPending(){
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getListRencanaExtruderSusulanPending",
					dataType : "JSON",
					success : function(response){
						$("#tableRencanaSusulanPending > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tableRencanaSusulanPending > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+ AvValue.mesin +"</td>"+
									"<td>"+ AvValue.motoran +"</td>"+
									"<td>"+ AvValue.nm_cust +"</td>"+
									"<td>"+ AvValue.ukuran +"</td>"+
									"<td>"+ AvValue.warna +"</td>"+
									"<td>"+ AvValue.tebal +"</td>"+
									"<td>"+ AvValue.jml_permintaan +"</td>"+
									"<td>"+ AvValue.strip +"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-warning' onclick=modalUbahRencanaSusulanExtruderTemp('"+AvValue.kd_extruder+"')>Ubah</button>"+
										"<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRencanaExtruderPending('"+AvValue.kd_extruder+"','TRUE')>Hapus</button>"+
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

			function tableDetailRencanaPpic(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDetailRencanaPPIC",
					dataType : "JSON",
					data : {kdPpic : param},
					success : function(response){
						var arrStrip = ["LOSE","MERAH","PINK","MERAH ORANGE","PUTIH SUSU","BIRU","HITAM"];
						$("#tableDetailRencanaPpic > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tableDetailRencanaPpic > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.nm_cust+"</td>"+
									"<td>"+AvValue.jns_permintaan+"</td>"+
									"<td>"+AvValue.merek+"</td>"+
									"<td>"+AvValue.ukuran+"</td>"+
									"<td>"+AvValue.warna_plastik+"</td>"+
									"<td>"+AvValue.tebal+"</td>"+
									"<td>"+AvValue.berat+"</td>"+
									"<td>"+AvValue.jumlah_permintaan+" "+AvValue.satuan+"</td>"+
									"<td>"+AvValue.sisa+" KG"+"</td>"+
									"<td>"+AvValue.strip+"</td>"+
									"<td>"+AvValue.prioritas+"</td>"+
								"</tr>"
							);
							$("#txtNamaCustomer").val(AvValue.nm_cust);
							$("#txtUkuranOrder").val(AvValue.ukuran);
							$("#txtWarna").val(AvValue.warna_plastik);
							$("#txtPrioritasOrder").val(AvValue.prioritas);
							$("#txtBeratOrder").val(AvValue.berat);
							$("#btnTambahRencana").attr("onclick","saveAddRencanaExtruder('"+AvValue.kd_ppic+"','"+AvValue.kd_gd_roll+"','"+AvValue.merek+"')").html("<i class='fa fa-plus'></i> Tambah");
							$("#btnResetRencana").attr("onclick","resetFormBuatRencanaBaru('"+AvValue.kd_ppic+"')");
							$("#txtTebalOrder").val(AvValue.tebal);
							$("#txtTglPengerjaan").val("<?php echo date('Y-m-d'); ?>");
							if(arrStrip.indexOf(AvValue.strip.toUpperCase()) != -1){
								$("#cmbStrip").val(AvValue.strip.toUpperCase());
							}else{
								$("#cmbStrip").val("CUSTOM").trigger("change");
								$("#txtStrip").val(AvValue.strip.toUpperCase());
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

			function datatablesListRencanaKerjaExtruder(param1, param2="",param3="", param4="", param5=""){
				if(param1 == "#tableRencanaMandorExtruder_ZP"){
					var searching = false;
				}else{
					var searching = true;
				}
				$(param1).dataTable().fnDestroy();
				$(param1).dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"pageLength" : 100,
	        "ordering" : false,
	        "bProcessing" : true,
	        "bServerSide" : true,
					"searching"	: searching,
					"scrollX" : "100%",
	        "sPaginationType": "full_numbers",
	        "bLengthChange": false,
	        "sAjaxSource":"<?php echo base_url(); ?>_extruder/main/getListRencanaExtruder",
	        "columns":[
			     	{"data" : "tgl_rencana","name":"EX.tgl_rencana","sWidth":"65px"},
			      {"data" : "mesin","name":"MSN.no_mesin","sWidth":"50px"},
			      {"data" : "nm_cust","name":"EX.nm_cust","sWidth":"50px"},
			      {"data" : "merek","name":"EX.merek","sWidth":"50px"},
			      {"data" : "ukuran","name":"EX.ukuran","sWidth":"55px"},
			      {"data" : "warna","name":"EX.warna","sWidth":"50px"},
			      {"data" : "tebal","name":"EX.tebal","sWidth":"50px"},
			      {"data" : "berat","name":"EX.berat","sWidth":"50px"},
			      {"data" : "strip","name":"EX.strip","sWidth":"50px"},
						{"data" : "stok_permintaan","name":"EX.stok_permintaan","sWidth":"55px"},
						{"data" : "jml_permintaan","name":"EX.jml_permintaan","sWidth":"50px"},
						{"data" : "sts_pengerjaan","name":"EX.sts_pengerjaan","sWidth":"52px"},
						{"data" : "keterangan","name":"PPIC.keterangan","sWidth":"55px"},
						{"data" : "shift","name":"EX.shift","sWidth":"1px"},
						{"data" : "kd_extruder","name":"EX.kd_extruder","sWidth":"127px"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"stsPengerjaan","value":param2},
					 							 {"name":"jnsMesin","value":param3},
											 	 {"name":"tglAwal","value":param4},
											 	 {"name":"tglAkhir","value":param5});
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
						if(aData["prioritas"] == "URGENT"){
							$("td:eq(11)",nRow).html(aData["sts_pengerjaan"] +" "+"<label class='text-red'>["+aData["prioritas"]+"]<label>");
						}else if(aData["prioritas"] == "TUNDA"){
							$("td:eq(11)",nRow).html(aData["sts_pengerjaan"] +" "+"<label class='text-yellow'>["+aData["prioritas"]+"]<label>");
						}else{
							$("td:eq(11)",nRow).html(aData["sts_pengerjaan"] +" "+"<label class='text-blue'>["+aData["prioritas"]+"]<label>");
						}
						if(aData["sts_pengerjaan"] != "COMPLETE"){
							if(parseFloat(aData["jml_permintaan"].replace(/,/gi,"")) >= parseFloat(aData["stok_permintaan"].replace(/,/gi,""))){
								$("td:eq(14)",nRow).html("<button class='btn btn-md btn-flat btn-success' data-toggle='modal' data-target='#modalEditStatus' data-backdrop='static' onclick=modalEditStatus('"+aData["kd_extruder"]+"','"+aData["sts_pengerjaan"]+"','"+aData["kd_ppic"]+"')>Edit Status</button><br>"+
																				 // "<button class='btn btn-md btn-flat btn-info' data-toggle='modal' data-target='#modalInputHasil' data-backdrop='static' onclick=modalInputHasil('"+aData["kd_extruder"]+"')>Input Hasil</button>"+
																				 "<a href=<?php echo base_url('_extruder/main/input_hasil'); ?>/"+aData["kd_extruder"]+" target='_blank' class='btn btn-md btn-flat btn-info'>Input Hasil</a><br>"+
																				 "<button class='btn btn-md btn-flat btn-warning' data-toggle='modal' data-target='#modalGantiMesin' data-backdrop='static' onclick=modalGantiMesin('"+aData["kd_extruder"]+"','"+aData["kd_mesin"]+"','"+aData["jns_mesin"]+"')>Ganti Mesin</button><br>"+
																			 	 "<button class='btn btn-md btn-flat btn-primary' data-toggle='modal' data-target='#modalBuatRencanaSusulan' data-backdrop='static' onclick=modalBuatRencanaSusulan()>Rencana Susulan</button><br>" +
																			 	 // "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRencanaExtruderPending('"+aData["kd_extruder"]+"','TRUE')>Hapus Rencana</button><br>"+
																			 	 "<a href=<?php echo base_url('_extruder/main/input_hasil_tertinggal'); ?>/"+aData["kd_extruder"]+" target='_blank' class='btn btn-md btn-flat bg-purple'>Input Hasil Tertinggal</a><br>" +
																			 	 "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRencanaExtruderPending('"+aData["kd_extruder"]+"','TRUE')>Hapus Rencana</button><br>");
							}else{
								$("td:eq(14)",nRow).html("<button class='btn btn-md btn-flat btn-success' data-toggle='modal' data-target='#modalEditStatus' data-backdrop='static' onclick=modalEditStatus('"+aData["kd_extruder"]+"','"+aData["sts_pengerjaan"]+"','"+aData["kd_ppic"]+"')>Edit Status</button><br>"+
																				 // "<button class='btn btn-md btn-flat btn-info' data-toggle='modal' data-target='#modalInputHasil' data-backdrop='static' onclick=modalInputHasil('"+aData["kd_extruder"]+"')>Input Hasil</button>"+
																				 "<a href=<?php echo base_url('_extruder/main/input_hasil'); ?>/"+aData["kd_extruder"]+" target='_blank' class='btn btn-md btn-flat btn-info'>Input Hasil</a><br>"+
																				 "<button class='btn btn-md btn-flat btn-warning' data-toggle='modal' data-target='#modalGantiMesin' data-backdrop='static' onclick=modalGantiMesin('"+aData["kd_extruder"]+"','"+aData["kd_mesin"]+"','"+aData["jns_mesin"]+"')>Ganti Mesin</button><br>"+
																			 	 "<button class='btn btn-md btn-flat btn-primary' data-toggle='modal' data-target='#modalBuatRencanaSusulan' data-backdrop='static' onclick=modalBuatRencanaSusulan()>Rencana Susulan</button><br>" +
																			 	 // "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRencanaExtruderPending('"+aData["kd_extruder"]+"','TRUE')>Hapus Rencana</button><br>"+
																			 	 "<a href=<?php echo base_url('_extruder/main/input_hasil_tertinggal'); ?>/"+aData["kd_extruder"]+" target='_blank' class='btn btn-md btn-flat bg-purple'>Input Hasil Tertinggal</a><br>");
							}
						}else{
							$("td:eq(14)",nRow).html("<label class='btn btn-md btn-flat btn-danger disabled'>Tidak Ada Action</label>");
							$("td:eq(11)",nRow).css({"background-color":"rgba(0, 156, 255, 0.7)","vertical-align":"middle"}).html("<span class='info-box-icon' style='background:transparent;'><i class='fa fa-check' style='color:#FFF;'></i></span>");
						}
						// if(aData["kd_ppic"] == null){
						// 	$("td:eq(0)",nRow).css({"background-color":"rgba(0, 0, 118, 0.6)",
						// 													"color":"#FFF"});
						// }
						$("td:eq(9)",nRow).text(parseFloat(aData["stok_permintaan"]).toLocaleString()+" KG");
						$("td:eq(10)",nRow).text(parseFloat(aData["jml_permintaan"]).toLocaleString()+" KG");
						switch (aData["shift"]) {
							case "1": $("td:eq(13)",nRow).css("background-color","#00a65a").text("");break;
							case "2": $("td:eq(13)",nRow).css("background-color","#3c8dbc").text("");break;
							case "3": $("td:eq(13)",nRow).css("background-color","#f39c12").text("");break;
							default: $("td:eq(13)",nRow).css("background-color","transparent");break;

						}
          }
				});
			}

			function tableListPermintaanExtruder(param1, param2){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getPermintaanExtruderPending",
					dataType : "JSON",
					data : {
						jenis : param1,
						status : param2,
					},
					success : function(response){
						$("#tabelPermintaanExtruderPending > tbody > tr").empty();
						$.each(response,function(AvIndex, AvValue){
							$("#tabelPermintaanExtruderPending > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.tgl_permintaan+"</td>"+
									"<td>"+AvValue.nm_barang+"</td>"+
									"<td>"+AvValue.jumlah_permintaan+"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-warning' onclick=modalEditPermintaanExtruderPending('"+AvValue.id+"')>Edit</button>"+
										"<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestorePermintaanExtruder('"+AvValue.id+"','TRUE')>Hapus</button>"+
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

			function tableListTambahBijiWarnaPending(){
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getTambahBijiWarnaPending",
					dataType : "JSON",
					success : function(response){
						$("#tableListStokBijiWarna > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tableListStokBijiWarna > tbody:last-child").append(
								"<tr>"+
									"<td>"+AvValue.nm_barang+"</td>"+
									"<td>"+AvValue.jumlah_permintaan+"</td>"+
									"<td>"+AvValue.warna+"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-warning' onclick=modalEditTambahBijiWarnaPending('"+AvValue.id+"','"+AvValue.idGudangBuffer+"')>Ubah</button>"+
										"<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreTambahBijiWarnaPending('"+AvValue.id+"','"+AvValue.idGudangBuffer+"','TRUE')>Hapus</button>"+
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

			function tableListBijiWarna(){
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getBijiWarna",
					dataType : "JSON",
					success : function(response){
						$("#tableListBijiWarna > tbody > tr").empty();
						$.each(response,function(AvIndex, AvValue){
							$("#tableListBijiWarna > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.warna+"("+AvValue.nm_barang+")</td>"+
									"<td>"+AvValue.jumlah_stok+"</td>"+
								"</tr>"
							);
						});
					},
					error : function(response) {
						$("#modal-notif").addClass("modal-danger");
						$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-danger");
							$("#modalNotifContent").text("");
						},2000);
					}
				});
			}

			function tableListPermintaanBijiWarnaPending(){
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getPermintaanBijiWarnaPending",
					dataType : "JSON",
					success : function(response){
						$("#tableListPermintaanBijiWarna > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tableListPermintaanBijiWarna > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.tgl_permintaan+"</td>"+
									"<td>"+AvValue.nm_barang+"</td>"+
									"<td>"+AvValue.jumlah_permintaan+"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-warning' onclick=modalEditPermintaanBijiWarnaPending('"+AvValue.id+"')>Ubah</button>"+
										"<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreTambahBijiWarnaPending('"+AvValue.id+"','"+AvValue.idGudangBuffer+"','TRUE')>Hapus</button>"+
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

			function tableListHasilJobExtruder(param){
				if(param == "LOKAL"){
					var idTable = "#tableHasilJobExtruder_Lokal";
				}else{
					var idTable = "#tableHasilJobExtruder_Export";
				}

				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getHasilJobExtruder",
					dataType : "JSON",
					data : {jnsBrg : param},
					success : function(response){
						if(response.length > 0){
							var tanggalPengerjaan = response[0].tgl_rencana;
							var shift = response[0].shift;
							getPenambahanBahanBakuUntukJob(tanggalPengerjaan,shift);
						}
						$(idTable+" > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							$(idTable + " > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.no_mesin+"</td>"+
									"<td>"+AvValue.biji_warna+"</td>"+
									"<td>"+AvValue.hasil_ukuran+"</td>"+
									"<td>"+AvValue.berat+"</td>"+
									"<td>"+AvValue.roll_pipa+"</td>"+
									"<td>"+AvValue.jumlah_selesai+"</td>"+
									"<td>"+AvValue.merek+"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-warning' onclick=modalEditHasilJobExtruder('"+AvValue.id_hasil_extruder+"') data-toggle='modal' data-target='#modalEditJobExtruder'>Ubah</button>"+
										"<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreHasilJobExtruder('"+AvValue.id_hasil_extruder+"','TRUE')>Hapus</button>"+
									"</td>"+
								"</tr>"
							);
							if(param=="LOKAL"){
								$("#btnSimpanHasilJob_Lokal").attr("onclick","saveHasilJobExtruderFinal('"+param+"','"+AvValue.shift+"')");
							}else{
								$("#btnSimpanHasilJob_Export").attr("onclick","saveHasilJobExtruderFinal('"+param+"','"+AvValue.shift+"')");
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

			function datatablesListRencanaKerjaExtruderSelesai(param1, param2){
				$("#tableListRencanaExtruderSelesai").dataTable().fnDestroy();
				$("#tableListRencanaExtruderSelesai").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_extruder/main/getDataRencanaMandorSelesai",
          "columns":[
            {"data" : "tgl_rencana","name":"RE.tgl_rencana","sWidth":"70px"},
            {"data" : "no_mesin","name":"MSN.no_mesin","sWidth":"60px"},
            {"data" : "nm_cust","name":"RE.nm_cust","sWidth":"100px"},
            {"data" : "merek","name":"RE.merek","sWidth":"100px"},
						{"data" : "ket_merek","name":"RP.ket_merek","sWidth":"100px"},
            {"data" : "ukuran","name":"RE.ukuran","sWidth":"70px"},
            {"data" : "warna","name":"RE.warna","sWidth":"70px"},
            {"data" : "tebal","name":"RE.tebal","sWidth":"50px"},
            {"data" : "berat","name":"RE.berat","sWidth":"50px"},
            {"data" : "strip","name":"RE.strip","sWidth":"50px"},
						{"data" : "stok_permintaan","name":"RE.stok_permintaan","sWidth":"80px"},
						{"data" : "jml_permintaan","name":"RE.jml_permintaan","sWidth":"80px"},
						{"data" : "sts_pengerjaan","name":"RE.sts_pengerjaan","sWidth":"80px"},
						{"data" : "keterangan","name":"RP.keterangan","sWidth":"100px"}
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

          }
				});
			}

			function tableDataBonApal(param="<?php echo date('Y-m-d'); ?>"){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_extruder/main/getDataBonApal",
					dataType : "JSON",
					data : {tanggal : param},
					success : function(response){
						$("#tableListDataKirimanApal > tbody > tr").empty();
						if(response.length > 0){
							$("#btnPrintDataBonApal").attr("href","<?php echo base_url() ?>_extruder/main/printDataBonApal/"+param);
						}else{
							$("#btnPrintDataBonApal").attr("href","#");
						}
						if(response.length > 0 && response[0].sts_transaksi == "PENDING"){
							$("#btnKirimApal").attr("onclick","saveKirimDataBonApal('"+param+"')").removeAttr("disabled");
						}else{
							$("#btnKirimApal").removeAttr("onclick").attr("disabled","disabled");
						}
						var totalApal=0;
						$.each(response, function(AvIndex,AvValue){
							if(AvValue.sts_transaksi == "PENDING"){
								var action = "<button class='btn btn-md btn-flat btn-warning' onclick=modalEditDataBonApal('"+AvValue.id+"','"+param+"')>Ubah</button>"+
														 "<button class='btn btn-md btn-flat btn-danger' onclick=deleteDataBonApal('"+AvValue.id+"','"+param+"')>Hapus</button>"
							}else{
								var action = "<button class='btn btn-md btn-flat btn-default btn-block' disabled>Sudah Dikirim</button>";
							}
							$("#tableListDataKirimanApal > tbody:last-child").append(
								"<tr>"+
									"<td>"+AvValue.tgl_transaksi+"</td>"+
									"<td>"+AvValue.warna+"</td>"+
									"<td>"+parseFloat(AvValue.jumlah_apal).toLocaleString()+"</td>"+
									"<td>"+AvValue.shift+"</td>"+
									"<td>"+action+"</td>"+
								"</tr>"
							);
						});
						for (var i = 0; i < response.length; i++) {
							totalApal += parseFloat(response[i].jumlah_apal);
						}
						$("#h4Total").text("Total Apal : "+parseFloat(totalApal).toLocaleString());
					},
					error : function(response){
						$("#modal-notif").addClass("modal-danger");
						$("#modalNotifContent").text("Server Fault Error Code ( "+response.status+" ) "+response.statusText);
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-danger");
							$("#modalNotifContent").text("");
						},2000);
					}
				});
			}

			function datatablesListHistoryBahanBakuExtruder(param1, param2){
				$("#tableListHistoryBahanBakuExtruder").dataTable().fnDestroy();
				$("#tableListHistoryBahanBakuExtruder").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_extruder/main/getHistoryPermintaanBahanBaku",
          "columns":[
            {"data" : "id","name":"TGB.id"},
            {"data" : "tgl_permintaan","name":"TGB.tgl_permintaan"},
            {"data" : "nm_barang","name":"GB.nm_barang"},
            {"data" : "warna","name":"GB.warna"},
            {"data" : "jumlah_permintaan","name":"TGB.jumlah_permintaan"}
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
          }
				});
			}

			function tableListKembalianBahanBakuExtruderPending(){
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getKembalianBahanBakuPending",
					dataType : "JSON",
					success : function(response){
						$("#tableListKembalianExtruderPending > tbody").empty();
						$.each(response,function(AvIndex, AvValue){
							$("#tableListKembalianExtruderPending > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.tgl_permintaan+"</td>"+
									"<td>"+AvValue.nm_barang+"</td>"+
									"<td>"+AvValue.jumlah_permintaan+"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-warning' onclick=modalEditKembalianBahanBaku('"+AvValue.id+"')>Ubah</button>"+
										"<button class='btn btn-md btn-flat btn-danger' onclick=deleteKembalianBahanBaku('"+AvValue.id+"')>Hapus</button>"+
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

			function datatablesListHistoryKembalianBahanBakuExtruder(param1, param2){
				$("#tableHistoryKembalianBahanBaku").dataTable().fnDestroy();
				$("#tableHistoryKembalianBahanBaku").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_extruder/main/getHistoryKembalianBahanBaku",
          "columns":[
            {"data" : "id","name":"TGB.id"},
            {"data" : "tgl_permintaan","name":"TGB.tgl_permintaan"},
            {"data" : "nm_barang","name":"GB.nm_barang"},
						{"data" : "jumlah_permintaan","name":"TGB.jumlah_permintaan"}
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
          }
				});
			}

			function datatablesListHistoryBijiWarnaExtruder(param1, param2, param3){
				var totalPemakaian = 0;
				$("#tableListHistoryBijiWarna").dataTable().fnDestroy();
				$("#tableListHistoryBijiWarna").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_extruder/main/getHistoryBijiWarna",
          "columns":[
						{"data" : "tgl_transaksi","name":"TGBE.tgl_transaksi"},
						{"data" : "nm_barang","name":"GB.nm_barang"},
						{"data" : "jumlah","name":"TGBE.jumlah"},
            {"data" : "keterangan_history","name":"TGBE.keterangan_history"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"tglAwal","value":param1},
					 							 {"name":"tglAkhir","value":param2},
                         {"name":"kdGdBahan","value":param3});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
						totalPemakaian += parseFloat(aData["jumlah"]);
						$("#spanTotalPemakaian").text("Total Pemakaian : " +totalPemakaian);
          }
				});
			}

			function datatablesListHistoryBijiWarnaExtruder_GudangBahan(param1, param2, param3){
				var totalPermintaan = 0;
				$("#tableListHistoryBijiWarna_GudangBahan").dataTable().fnDestroy();
				$("#tableListHistoryBijiWarna_GudangBahan").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_extruder/main/getHistoryBijiWarna_GudangBahan",
          "columns":[
						{"data" : "tgl_permintaan","name":"TGB.tgl_permintaan"},
						{"data" : "nm_barang","name":"GB.nm_barang"},
						{"data" : "jumlah_permintaan","name":"TGB.jumlah_permintaan"},
            {"data" : "keterangan_history","name":"TGB.keterangan_history"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"tglAwal","value":param1},
					 							 {"name":"tglAkhir","value":param2},
                         {"name":"kdGdBahan","value":param3});
            $.ajax({
                     "dataType": "json",
                     "type": "POST",
                     "url": sSource,
                     "data": aoData,
                     "success": fnCallback
                 });
          },
          "fnRowCallback":function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
						totalPermintaan += parseFloat(aData["jumlah_permintaan"]);
						$("#spanTotalPermintaan").text("Total Permintaan : " +totalPermintaan);
          }
				});
			}

			function tableListKembalianBijiWarnaExtruderPending(){
				$.ajax({
					url : "<?php echo base_url(); ?>_extruder/main/getKembalianBijiWarnaPending",
					dataType : "JSON",
					success : function(response){
						$("#tableListPengembalianBijiWarnaPending > tbody").empty();
						$.each(response,function(AvIndex, AvValue){
							$("#tableListPengembalianBijiWarnaPending > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.tgl_permintaan+"</td>"+
									"<td>"+AvValue.nm_barang+"</td>"+
									"<td>"+AvValue.jumlah_permintaan+"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-warning' onclick=modalEditKembalianBijiWarna('"+AvValue.id+"')>Ubah</button>"+
										"<button class='btn btn-md btn-flat btn-danger' onclick=deleteKembalianBijiWarna('"+AvValue.id+"')>Hapus</button>"+
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

			function datatablesListHistoryKembalianBijiWarnaExtruder(param1, param2){
				$("#tableHistoryKembalianBijiWarna").dataTable().fnDestroy();
				$("#tableHistoryKembalianBijiWarna").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
					"scrollX" : "100%",
					"scrollY" : "500px",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_extruder/main/getHistoryKembalianBijiWarna",
          "columns":[
            {"data" : "id","name":"TGB.id"},
            {"data" : "tgl_permintaan","name":"TGB.tgl_permintaan"},
            {"data" : "nm_barang","name":"GB.nm_barang"},
						{"data" : "jumlah_permintaan","name":"TGB.jumlah_permintaan"}
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
          }
				});
			}

			function tablePengambilanPotongExtruder(param1){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_extruder/main/getPengambilanPotongExtruder') ?>",
					dataType : "JSON",
					data : {
						tanggal : param1
					},
					success : function(response){
						$("#tablePengambilanPotong > tbody").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tablePengambilanPotong > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.tgl_sisa+"</td>"+
									"<td>"+AvValue.merek+"</td>"+
									"<td>"+AvValue.warna_plastik+"</td>"+
									"<td>"+AvValue.ukuran+"</td>"+
									"<td>"+AvValue.berat+"</td>"+
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

			function tablePengambilanCetakExtruder(param1){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_extruder/main/getPengambilanCetakExtruder') ?>",
					dataType : "JSON",
					data : {
						tanggal : param1
					},
					success : function(response){
						$("#tablePengambilanCetak > tbody").empty();
						$.each(response, function(AvIndex, AvValue){
							$("#tablePengambilanCetak > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+AvValue.tgl_pengambilan+"</td>"+
									"<td>"+AvValue.merek+"</td>"+
									"<td>"+AvValue.warna_plastik+"</td>"+
									"<td>"+AvValue.ukuran+"</td>"+
									"<td>"+AvValue.berat+"</td>"+
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
			//============================================DATATABLE METHOD (Finish)============================================//
		</script>

		<script type="text/javascript">
			function hitungJumlahTotalExtruder(param=""){
				if(param=="LOKAL"){
					var sisaBijiKemarin = $("#txtSisaBijiKemarin_Lokal").val().replace(/,/g,"");
					var penambahanBiji = $("#txtPenambahanBijiBaru_Lokal").val().replace(/,/g,"");
					var penguranganBiji = $("#txtPenguranganBiji_Lokal").val().replace(/,/g,"");
					var jumlahBijiWarna = $("#txtBijiWarna_Lokal").val().replace(/,/g,"");
					var jumlahCorong = $("#txtCorong_Lokal").val().replace(/,/g,"");
					var jumlahSisaBahan = $("#txtSisabahan_Lokal").val().replace(/,/g,"");
					var jumlahBerat = $("#txtBerat2_Lokal").val().replace(/,/g,"");
					var jumlahApal = $("#txtApal_Lokal").val().replace(/,/g,"");
					var jumlahRollPipa = $("#txtRollPipa_Lokal").val().replace(/,/g,"");

					var jumlahSisa = (parseFloat(jumlahCorong) + parseFloat(jumlahSisaBahan));
					$("#txtSisa_Lokal").val(jumlahSisa);

					var jumlahTotal = (parseFloat(sisaBijiKemarin)+parseFloat(penambahanBiji)-parseFloat(penguranganBiji)-jumlahSisa);
					$("#txtTotal_Lokal").val(jumlahTotal);

					var totalPlusMinus = ((parseFloat(jumlahBerat) + parseFloat(jumlahApal))-(parseFloat(jumlahRollPipa) + parseFloat(jumlahBijiWarna))) - jumlahTotal
					$("#txtPlusMinus_Lokal").val(totalPlusMinus);
				}else if(param=="EXPORT"){
					var sisaBijiKemarin = $("#txtSisaBijiKemarin_Export").val().replace(/,/g,"");
					var penambahanBiji = $("#txtPenambahanBijiBaru_Export").val().replace(/,/g,"");
					var penguranganBiji = $("#txtPenguranganBiji_Export").val().replace(/,/g,"");
					var jumlahBijiWarna = $("#txtBijiWarna_Export").val().replace(/,/g,"");
					var jumlahCorong = $("#txtCorong_Export").val().replace(/,/g,"");
					var jumlahSisaBahan = $("#txtSisabahan_Export").val().replace(/,/g,"");
					var jumlahBerat = $("#txtBerat2_Export").val().replace(/,/g,"");
					var jumlahApal = $("#txtApal_Export").val().replace(/,/g,"");
					var jumlahRollPipa = $("#txtRollPipa_Export").val().replace(/,/g,"");

					var jumlahSisa = (parseFloat(jumlahCorong) + parseFloat(jumlahSisaBahan));
					$("#txtSisa_Export").val(jumlahSisa);

					var jumlahTotal = (parseFloat(sisaBijiKemarin)+parseFloat(penambahanBiji)-parseFloat(penguranganBiji)-jumlahSisa);
					$("#txtTotal_Export").val(jumlahTotal);

					var totalPlusMinus = ((parseFloat(jumlahBerat) + parseFloat(jumlahApal))-(parseFloat(jumlahRollPipa) + parseFloat(jumlahBijiWarna))) - jumlahTotal
					$("#txtPlusMinus_Export").val(totalPlusMinus);
				}else{
					var sisaBijiKemarin = $("#txtSisaBijiKemarin").val().replace(/,/g,"");
					var penambahanBiji = $("#txtPenambahanBijiBaru").val().replace(/,/g,"");
					var penguranganBiji = $("#txtPenguranganBijiBaru").val().replace(/,/g,"");
					var jumlahBijiWarna = $("#txtJumlahBijiWarna").val().replace(/,/g,"");
					var jumlahCorong = $("#txtJumlahCorong").val().replace(/,/g,"");
					var jumlahSisaBahan = $("#txtJumlahSisaBahan").val().replace(/,/g,"");
					var jumlahBerat = $("#txtJumlahBerat").val().replace(/,/g,"");
					var jumlahApal = $("#txtJumlahApal").val().replace(/,/g,"");
					var jumlahRollPipa = $("#txtJumlahRollPipa").val().replace(/,/g,"");

					var jumlahSisa = (parseFloat(jumlahCorong) + parseFloat(jumlahSisaBahan));
					$("#txtJumlahSisa").val(jumlahSisa);

					var jumlahTotal = (parseFloat(sisaBijiKemarin)+parseFloat(penambahanBiji)-parseFloat(penguranganBiji)-jumlahSisa);
					$("#txtTotal").val(jumlahTotal);

					var totalPlusMinus = ((parseFloat(jumlahBerat) + parseFloat(jumlahApal))-(parseFloat(jumlahRollPipa) + parseFloat(jumlahBijiWarna))) - jumlahTotal
					$("#txtPlusMinus").val(totalPlusMinus);
				}

			}

			function getPenambahanBahanBakuUntukJob(param, param2){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_extruder/main/getPenambahanBahanBakuUntukJob'); ?>",
					dataType : "JSON",
					data : {
						tanggal : param,
						shift : param2
					},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							if(AvValue.jumlah_permintaan != null){
								$("#txtPenambahanBijiBaru_Lokal").val(parseFloat(AvValue.jumlah_permintaan).toLocaleString());
							}else{
								$("#txtPenambahanBijiBaru_Lokal").val(0);
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
		</script>
		<!--===============================================General Function (Finish) ===============================================-->
	</body>
</html>
