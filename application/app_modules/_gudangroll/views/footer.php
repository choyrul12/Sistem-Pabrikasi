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
				if($("#tableDataMasterGudangRollPolos").length == 1){
					datatablesListGudangRoll("#tableDataMasterGudangRollPolos","POLOS");
				}else{
					datatablesListGudangRoll("#tableDataMasterGudangRollCetak","CETAK");
				}
				reloadTrash();

				if($("#tableHasilJobPotong").length == 1){
					datatablesListHasilJobPotong();
				}
				if($("#alertPermintaanRollPolos").length){
					alertPermintaanRoll("Polos");
				}
				if($("#alertPermintaanRollCetak").length){
					alertPermintaanRoll("Cetak");
				}
				if ($("#alertHasilCetak").length) {
					alertHasilCetak();
				}
				if ($("#alertHasilExtruder").length) {
					alertHasilExtruder()
				}
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
			});
		</script>
<!--===============================================On Load Function (Finish) ===============================================-->

<!--===============================================General Function (Start) ===============================================-->
		<script type="text/javascript">
			//============================================MODAL METHOD (Start)============================================//
			function modalTambahBarangBaru(param) {
				resetFormTambahBarangBaru(param);
			}

			function modalCariHistory(param1){
				$("input").val("");
				$(".date").datepicker("setDate",null);
				$("#cmbUkuran").val("").trigger("change");
				$("#cmbUkuran").select2({
          placeholder : "Pilih Roll ("+param1+")",
          dropdownParent: $("#modalCariHistoryGudangRoll"),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangroll/main/getComboBoxValueGudangRoll/"+param1,
            dataType : "JSON",
            delay : 0,
            processResults : function(data){
              return{
                results : $.map(data, function(item){
                  return{
                    text:item.kd_gd_roll+" | "+item.ukuran+" | "+item.merek+" | "+item.warna_plastik+" | "+item.jns_brg+" | "+item.jns_permintaan,
                    id:item.kd_gd_roll+","+item.ukuran+","+item.merek+","+item.warna_plastik
                  }
                })
              };
            }
          }
        });
			}

			function modalTambahDataAwal(param1){
				resetFormTambahDataAwal(param1);
				tableListDataAwalTemp(param1);
				$("#cmbUkuran2").select2({
          placeholder : "Pilih Roll ("+param1+")",
          dropdownParent: $("#modalTambahDataAwal"),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangroll/main/getComboBoxValueGudangRoll/"+param1,
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

				$("#cmbUkuran2").on("select2:select",function(){
					var kdGdRoll = $("#cmbUkuran2").val();
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_gudangroll/main/checkDataAwal",
						dataType : "TEXT",
						data : {kdGdRoll : kdGdRoll},
						success : function(response){
							if(jQuery.trim(response) === "Ada"){
								$("#txtJumlahStok").attr("disabled","disabled");
								$("#txtJumlahBobin").attr("disabled","disabled");
								$("#txtJumlahPayung").attr("disabled","disabled");
								$("#txtJumlahStok").val("");
								$("#txtJumlahBobin").val("");
								$("#txtJumlahPayung").val("");
							}else{
								$("#txtJumlahStok").removeAttr("disabled");
								$("#txtJumlahBobin").removeAttr("disabled");
								$("#txtJumlahPayung").removeAttr("disabled");
								$("#txtJumlahStok").val("");
								$("#txtJumlahBobin").val("");
								$("#txtJumlahPayung").val("");
							}
						}
					});
				});

				$("#cmbUkuran2").on("select2:unselect",function(){
					$("#txtJumlahStok").removeAttr("disabled");
					$("#txtJumlahBobin").removeAttr("disabled");
					$("#txtJumlahPayung").removeAttr("disabled");
					$("#txtJumlahStok").val("");
					$("#txtJumlahBobin").val("");
					$("#txtJumlahPayung").val("");
				});
			}

			function modalEditGudangRoll(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_gudangroll/main/getGudangRollDetail",
					dataType : "JSON",
					data : {kdGdRoll : param},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#txtKdGdRoll").val(AvValue.kd_gd_roll);
							$("#txtKdAccurate").val(AvValue.kd_accurate);
							$("#txtStrip").val(AvValue.strip);
							$("#txtTanggal").val(AvValue.tgl_buat);
							$("#cmbJenisBarang").val(AvValue.jns_brg);
							$("#cmbJenisPermintaan").val(AvValue.jns_permintaan);
							$("#txtWarnaPlastik").val(AvValue.warna_plastik);
							$("#txtTebal").val(AvValue.tebal);
							$("#txtUkuran").val(AvValue.ukuran);
							$("#txtStok").val(AvValue.stok).attr("readonly","readonly");
							$("#txtBobin").val(AvValue.bobin).attr("readonly","readonly");
							$("#txtPayung").val(AvValue.payung).attr("readonly","readonly");
							$("#cmbMerek").val(AvValue.merek);
							$("#btnSaveBarangGudangRoll").attr("onclick","editGudangRoll('"+param+"')").html("<i class='fa fa-pencil'></i> Ubah");
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

			function modalTambahSelisihBarang(param){
				resetFormTambahSelisihBarang(param);
				$("#cmbMerek2").select2({
          placeholder : "Pilih Roll ("+param+")",
          dropdownParent: $("#modalTambahSelisihBarang"),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangroll/main/getComboBoxValueGudangRoll/"+param,
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
			}

			function modalTrashSpk(){
				datatablesListTrashGudangRoll();
				datatablesListTrashTransaksiGudangRoll();
			}

			function modalEditTransaksiPengembalianPotong(param,param2){
				$("#cmbMerekEditSisa").select2({
          placeholder : "Pilih Roll ("+param2+")",
          dropdownParent: $("#modalEditPengembalianPotong"),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangroll/main/getComboBoxValueGudangRoll/"+param2,
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

				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_gudangroll/main/getDetailPengembalianPotong') ?>",
					dataType : "JSON",
					data : {idTransaksi : param},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#txtJnsPermintaanEditSisa").val(AvValue.jns_permintaan);
							$("#txtSisaEditSisa").val(AvValue.berat);
							$("#txtBobinEditSisa").val(AvValue.bobin);
							$("#txtPayungEditSisa").val(AvValue.payung);
							$("#txtPayungKuningEditSisa").val(AvValue.payung_kuning);
							$("#txtKeteranganEditSisa").val(AvValue.keterangan_history);
							$("#cmbMerekEditSisa").val(AvValue.kd_gd_roll);
							$("#txtKdGdRollHide").val(AvValue.kd_gd_roll);
							$("#txtKdCuttingHide").val(AvValue.kd_potong);
							$("#txtSisaHide").val(AvValue.berat);
							$("#txtBobinHide").val(AvValue.bobin);
							$("#txtPayungHide").val(AvValue.payung);
							$("#txtPayungKuningHide").val(AvValue.payung_kuning);
							$("#txtTglSisaHide").val(AvValue.tgl_sisa);
							$("#txtTglPotongHide").val(AvValue.tgl_potong);
							$("#txtUkuranHide").val(AvValue.ukuran);
							$("#txtJnsPermintaanHide").val(AvValue.jns_permintaan);
							$("#txtMerekHide").val(AvValue.merek);
							$("#txtWarnaPlastikHide").val(AvValue.warna_plastik);
						});
					}
				});
				$("#btnEditSisaPotong").attr("onclick","editSisaPotong('"+param+"')");
				$("#modalEditPengembalianPotong").modal({backdrop:"static"}).css("z-index","1051");
			}

			function modalEditTransaksiPengambilanCetak(param,param2){
				$("#cmbMerekEditSisa").select2({
          placeholder : "Pilih Roll ("+param2+")",
          dropdownParent: $("#modalEditPengembalianPotong"),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangroll/main/getComboBoxValueGudangRoll/"+param2,
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

				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_gudangroll/main/getDetailPengambilanCetak') ?>",
					dataType : "JSON",
					data : {idTransaksi : param},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#txtJnsPermintaanEditSisa").val(AvValue.jns_permintaan);
							$("#txtSisaEditSisa").val(AvValue.berat);
							$("#txtBobinEditSisa").val(AvValue.bobin);
							$("#txtPayungEditSisa").val(AvValue.payung);
							$("#txtPayungKuningEditSisa").val(AvValue.payung_kuning);
							$("#txtKeteranganEditSisa").val(AvValue.keterangan_history);
							$("#cmbMerekEditSisa").val(AvValue.kd_gd_roll);
							$("#txtKdGdRollHide").val(AvValue.kd_gd_roll);
							$("#txtSisaHide").val(AvValue.berat);
							$("#txtBobinHide").val(AvValue.bobin);
							$("#txtPayungHide").val(AvValue.payung);
							$("#txtPayungKuningHide").val(AvValue.payung_kuning);
							$("#txtTglSisaHide").val(AvValue.tgl_transaksi);
							$("#txtTglPotongHide").val(AvValue.keterangan_pengambilan);
							$("#txtUkuranHide").val(AvValue.ukuran);
							$("#txtJnsPermintaanHide").val(AvValue.jns_permintaan);
							$("#txtMerekHide").val(AvValue.merek);
							$("#txtWarnaPlastikHide").val(AvValue.warna_plastik);
						});
					}
				});
				$("#btnEditSisaPotong").attr("onclick","editSisaPotong('"+param+"')");
				$("#modalEditPengembalianPotong").modal({backdrop:"static"}).css("z-index","1051");
			}

			function modalInputHasil(param1, param2, param3, param4){
				$("#modalInputHasil").modal({backdrop:"static"});
				$("input").val("");
				$("select").val("").trigger("change");
				$(".number").val(0);
				$(".numberFive").val(0);
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_gudangroll/main/getDataInputHasil'); ?>",
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
							$("#ketMerek").val((AvValue.ket_merek==null || AvValue.ket_merek=="") ? "0" : AvValue.ket_merek);
							$("#ketBarang").val((AvValue.ket_barang==null || AvValue.ket_barang=="") ? "0" : AvValue.ket_barang);
							$("#txtJumlahRollPipa").val(AvValue.jumlah_roll_pipa);
							$("#txtPlusMinus").val(AvValue.plusminus);
							$("#txtKetarangan").val(AvValue.keterangan);
							$("#txtHasilLembar").val(AvValue.hasil_lembar);
							$("#txtHasilBeratBersih").val(AvValue.hasil_berat_bersih);
							$("#txtHasilBeratKotor").val(AvValue.hasil_berat_kotor);
							$("#txtJumlahApal").val(AvValue.jumlah_apal_global);
							$("#cmbRollPipa").val(AvValue.jenis_roll_pipa).trigger("change");
							$("#cmbShift").val(AvValue.shift);
							$("#txtBeratPengambilan").val(AvValue.berat_pengambilan_gudang);
							$("#txtBobinPengambilan").val(AvValue.bobin_pengambilan_gudang);
							$("#txtPayungPengambilan").val(AvValue.payung_pengambilan_gudang);
							$("#txtPayungKuningPengambilan").val(AvValue.payung_kuning_pengambilan_gudang);
							$("#txtBeratPengambilanTumpuk").val(AvValue.berat_pengambilan_gudang_tumpuk);
							$("#txtBobinPengambilanTumpuk").val(AvValue.bobin_pengambilan_gudang_tumpuk);
							$("#txtPayungPengambilanTumpuk").val(AvValue.payung_pengambilan_gudang_tumpuk);
							$("#txtPayungKuningPengambilanTumpuk").val(AvValue.payung_kuning_pengambilan_gudang_tumpuk);
							switch (AvValue.jenis_roll_pipa) {
								case "PAYUNG" 											: $("#txtJumlahPayung").val(AvValue.jumlah_payung);
															 												break;
							  case "PAYUNG_KUNING" 								: $("#txtJumlahPayung").val(AvValue.jumlah_payung_kuning);
															 												break;
								case "PAYUNG_KUNING_PAYUNG" 				: $("#txtJumlahPayung_PKP").val(AvValue.jumlah_payung);
																											$("#txtJumlahPayungKuning_PKP").val(AvValue.jumlah_payung_kuning);
																											break;
								case "BOBIN" 												: $("#txtBanyaknyaPipa").val(AvValue.jumlah_bobin);
																											break;
								case "BOBIN_PAYUNG" 								: $("#txtJumlahBobinPayung_Payung").val(AvValue.jumlah_payung);
																											$("#txtJumlahBobinPayung_Bobin").val(AvValue.jumlah_bobin);
																											break;
								case "BOBIN_PAYUNG_KUNING" 					: $("#txtJumlahBobinPayung_Payung").val(AvValue.jumlah_payung);
																											$("#txtJumlahBobinPayung_Bobin").val(AvValue.jumlah_bobin);
																											break;
								case "BOBIN_PAYUNG_KUNING_PAYUNG" 	: $("#txtBPKP_BanyaknyaPipa").val(AvValue.jumlah_bobin);
																											$("#txtBPKP_JumlahPayung").val(AvValue.jumlah_payung);
																											$("#txtBPKP_JumlahPayungKuning").val(AvValue.jumlah_payung_kuning);
																											break;
								default															: $("#txtJumlahPayung").val("");
												 															$("#txtJumlahPayung_PKP").val("");
												 															$("#txtJumlahPayungKuning_PKP").val("");
												 															$("#txtBanyaknyaPipa").val("");
												 															$("#txtJumlahBobinPayung_Payung").val("");
												 															$("#txtJumlahBobinPayung_Bobin").val("");
												 															$("#txtBPKP_BanyaknyaPipa").val("");
												 															$("#txtBPKP_JumlahPayung").val("");
												 															$("#txtBPKP_JumlahPayungKuning").val("");
																											break;

							}

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
											'<input type="text" class="form-control number" name="txtLembar" placeholder="Masukan Jumlah Lembar" value="'+AvValue.jumlah_lembar+'" readonly>'+
										'</div>'+
									'</td>'+
									'<td width="5%">Berat</td>'+
									'<td width="1%">:</td>'+
									'<td>'+
										'<div class="form-group has-warning">'+
											'<input type="text" class="form-control number" name="txtBerat" placeholder="Masukan Jumlah Berat" value="'+AvValue.jumlah_berat+'" readonly>'+
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
							var jnsPermintaan = $("#txtPermintaan").val();
							var arrUkuran = response.DetailRencana[0].ukuran.replace(/ /g,"").split("/");
							var arrUkuranPlastikSecondary = arrUkuran[1].split("x");
							$("#cmbUkuranTumpuk").select2({
								placeholder : "Pilih Roll ("+jnsPermintaan+")",
								dropdownParent: $("#modalInputHasil"),
								width : "100%",
								cache:false,
								allowClear:true,
								ajax:{
									url : "<?php echo base_url(); ?>_gudangroll/main/getComboBoxValueGudangRoll/"+jnsPermintaan+"/"+arrUkuranPlastikSecondary[0],
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
							$.ajax({
								type : "POST",
								url : "<?php echo base_url('_gudangroll/main/getDataInputHasil'); ?>",
								dataType : "JSON",
								data : {
									panjangPlastik 	: arrUkuranPlastikSecondary[0].replace(/_/g," "),
									warnaPlastik 		: param2.replace(/_/g," "),
									kdGdRoll 				: param3.replace(/_/g," "),
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
							$("#tumpuk").css("display","block");
						}else{
							$("#tumpuk").css("display","none");
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
						if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
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
								 					if(arrPanjangPlastik[1] > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
														}else{
															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
														}
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5;
														}else{
															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
														}
													}
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[1] > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
 															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0])*2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
 														}else{
 															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
 														}
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
 															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5.5;
 														}else{
 															var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
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
						if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
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
								 					if(arrPanjangPlastik[1] > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
 													 }
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
 													 }
													}
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[1] > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
														 }
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
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

						if(TPanjangPlastik <= 40){
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
						$("#txtRumusBobinPayung").val(30);
						if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
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
								 					if(arrPanjangPlastik[1] > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
 													 }
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
 													 }
													}
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[1] > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
														 }
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
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
						if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
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
								 					if(arrPanjangPlastik[1] > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
 													 }
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
															var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
 													 }
													}
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[1] > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
														 }
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
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

						if(TPanjangPlastik <= 40){
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
						if(param3.toUpperCase().indexOf("PON") != -1 || ketBarang.indexOf("PON") != -1 || ketMerek.indexOf("PON") != -1){
							var arrPanjangPlastik = param1.replace(/ /g, "").replace(/,/g,".").split("+");
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
								 					if(arrPanjangPlastik[1] > 1){
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
 													 }
													}else{
														if(arrPanjangPlastik[0].indexOf("in") != -1){
 														 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5;
 													 }else{
														 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
 													 }
													}
												 }else if(parseFloat(arrPanjangPlastik[0]) > 26.5){
													 if(arrPanjangPlastik[1] > 1){
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[1]) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
														 }
													 }else{
														 if(arrPanjangPlastik[0].indexOf("in") != -1){
															 var TPanjangPlastik = (parseFloat(arrPanjangPlastik[0]) * 2.54) + parseFloat(arrPanjangPlastik[2]) + 5.5;
														 }else{
															 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
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

						if(TPanjangPlastik <= 40){
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

				$("#cmbRollPipa").val("").trigger("change");
			}

			function modalEditTransaksiGudangRoll(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_gudangroll/main/getDetailTransaksiGudangRoll'); ?>",
					dataType : "JSON",
					data : {
						id : param
					},
					success : function(response){
						$.each(response, function(AvIndex, AvValue){
							$("#txtTanggalTransaksi").val(AvValue.tgl_transaksi);
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

				$("#btnUpdate").attr("onclick","editTransaksiGudangRoll('"+param+"')");
			}

			function modalCetakKartuStok(){
				var jenis = $("#cmbJenis").val();

				$("#cmbJenis").on("change", function(){
					$("#cmbUkuran").select2({
	          placeholder : "Pilih Roll ("+this.value+")",
	          dropdownParent: $("#modalCariDataKartuStok"),
	          width : "100%",
	          cache:true,
	          allowClear:true,
	          ajax:{
	            url : "<?php echo base_url(); ?>_gudangroll/main/getComboBoxValueGudangRoll/"+this.value,
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
				})
				$("#cmbUkuran").select2({
          placeholder : "Pilih Roll ("+jenis+")",
          dropdownParent: $("#modalCariDataKartuStok"),
          width : "100%",
          cache:true,
          allowClear:true,
          ajax:{
            url : "<?php echo base_url(); ?>_gudangroll/main/getComboBoxValueGudangRoll/"+jenis,
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
				$("#modalCariDataKartuStok").modal({
					backdrop : "static"
				});
			}
			//============================================MODAL METHOD (Finish)============================================//

			//============================================SAVE METHOD (Start)============================================//
			function saveGudangRoll(){
				var kdGdRoll1 = $("#txtKdGdRoll").val();
				var kdAccurate1 = $("#txtKdAccurate").val();
				var strip1 = $("#txtStrip").val();
				var jnsPermitaan1 = $("#cmbJenisPermintaan").val();
				var warnaPlastik1 = $("#txtWarnaPlastik").val();
				var tebal1 = $("#txtTebal").val();
				var ukuran1 = $("#txtUkuran").val();
				var stok1 = $("#txtStok").val().replace(/,/g, "");
				var bobin1 = $("#txtBobin").val().replace(/,/g, "");
				var payung1 = $("#txtPayung").val().replace(/,/g, "");
				var merek1 = $("#cmbMerek").val();
				var tglBuat1 = $("#txtTanggal").val();
				var jnsBarang1 = $("#cmbJenisBarang").val();

				if(kdGdRoll1=="" || jnsPermitaan1=="" || warnaPlastik1==""||
					 tebal1=="" || ukuran1=="" || stok1=="" || bobin1=="" || payung1=="" ||
				 	 merek1=="" || tglBuat1=="" || jnsBarang1==""
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
						url : "<?php echo base_url(); ?>_gudangroll/main/saveGudangRoll",
						dataType : "TEXT",
						data : {
							kdGdRoll 				: kdGdRoll1,
							kdAccurate 			: kdAccurate1,
							strip 					: strip1,
							jnsPermintaan 	: jnsPermitaan1,
							warnaPlastik 		: warnaPlastik1,
							tebal 					: tebal1,
							ukuran 					: ukuran1,
							stok 						: stok1,
							bobin 					: bobin1,
							payung 					: payung1,
							merek 					: merek1,
							tglBuat 				: tglBuat1,
							jnsBarang 			: jnsBarang1
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
									resetFormTambahBarangBaru(jnsPermitaan1);
									datatablesListGudangRoll(jnsPermitaan1);
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

			function saveAddDataAwalGudangRoll(param){
				var kdGdRoll1 = $("#cmbUkuran2").val();
				var jnsPermintaan1 = param;
				var tglTransaksi1 = $("#txtTglTransaksi").val();
				var berat1 = $("#txtJumlahStok").val().replace(/,/g, "");
				var bobin1 = $("#txtJumlahBobin").val().replace(/,/g, "");
				var payung1 = $("#txtJumlahPayung").val().replace(/,/g, "");

				if(kdGdRoll1=="" || jnsPermintaan1=="" || tglTransaksi1=="" ||
					 berat1=="" || bobin1=="" || payung1==""
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
						 url : "<?php echo base_url(); ?>_gudangroll/main/saveAddDataAwalGudangRoll",
						 dataType : "TEXT",
						 data : {
							 kdGdRoll 			: kdGdRoll1,
							 jnsPermintaan 	: jnsPermintaan1,
							 tglTransaksi 	: tglTransaksi1,
							 berat 					: berat1,
							 bobin 					: bobin1,
							 payung 				: payung1
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
 									resetFormTambahDataAwal(param);
									tableListDataAwalTemp(param);
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

			function saveTambahSelisihBarang(param){
				var kdGdRoll1 = $("#cmbMerek2").val();
				var jnsPermintaan1 = param;
				var tglTransaksi1 = $("#txtTglTransaksi1").val();
				var jnsBarang1 = $("#cmbJenisBarang2").val();
				var jnsSelisih1 = $("#cmbJenisSelisih").val();
				var berat1 = $("#txtJumlahSelisihBerat").val();
				var bobin1 = $("#txtJumlahSelisihBobin").val();
				var payung1 = $("#txtJumlahSelisihPayung").val();
				var payungKuning1 = $("#txtJumlahSelisihPayungKuning").val();
				var keterangan1 = $("#txtKeteranganSelisih").val();

				if(kdGdRoll1=="" || tglTransaksi1=="" || jnsBarang1==""||
					 jnsSelisih1=="" || berat1=="" || bobin1=="" || payung1=="" || keterangan1==""||payungKuning1==""
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
						 url : "<?php echo base_url() ?>_gudangroll/main/saveTambahSelisihBarang",
						 dataType : "TEXT",
						 data : {
							 kdGdRoll 			: kdGdRoll1,
							 jnsPermintaan 	: jnsPermintaan1,
							 tglTransaksi 	: tglTransaksi1,
							 jenisSelisih 	: jnsSelisih1,
							 berat 					: berat1,
							 bobin 					: bobin1,
							 payung 				: payung1,
							 payungKuning 	: payungKuning1,
							 ketarangan 		: keterangan1
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

			function saveApprovePengembalianPotong(param){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					if(param=="" || param==null){
						$("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Parameter Tidak Boleh Kosong");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
					}else{
						$.ajax({
							type : "POST",
							url : "<?php echo base_url('_gudangroll/main/saveApprovePengembalianPotong'); ?>",
							dataType : "TEXT",
							data : {jnsPermintaan : param},
							success : function(response){
								if($.trim(response) === "Berhasil"){
									$("#modal-notif").addClass("modal-info");
									$("#modalNotifContent").text("Approve Transaksi Berhasil");
									$("#modal-notif").modal("show");
									setTimeout(function(){
									 $("#modal-notif").modal("hide");
									 $("#modal-notif").removeClass("modal-info");
									 $("#modalNotifContent").text("");
									},2000);
								}else if($.trim(response) === "Berhasil Beberapa"){
									$("#modal-notif").addClass("modal-warning");
									$("#modalNotifContent").text("Beberapa Transaksi Sudah Terkunci Dan Tidak Bisa Untuk Di Approve!");
									$("#modal-notif").modal("show");
									setTimeout(function(){
									 $("#modal-notif").modal("hide");
									 $("#modal-notif").removeClass("modal-warning");
									 $("#modalNotifContent").text("");
								 	},3000);
								}else if($.trim(response) === "Gagal"){
									$("#modal-notif").addClass("modal-danger");
									$("#modalNotifContent").text("Approve Transaksi Gagal!");
									$("#modal-notif").modal("show");
									setTimeout(function(){
									 $("#modal-notif").modal("hide");
									 $("#modal-notif").removeClass("modal-danger");
									 $("#modalNotifContent").text("");
									},2000);
								}else{
									$("#modal-notif").addClass("modal-danger");
									$("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
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
			}

			function saveApproveHasilExtruder(){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						url : "<?php echo base_url('_gudangroll/main/saveApproveHasilExtruder'); ?>",
						dataType : "TEXT",
						success : function(response){
							if($.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Approve Transaksi Berhasil");
								$("#modal-notif").modal("show");
								setTimeout(function(){
								 $("#modal-notif").modal("hide");
								 $("#modal-notif").removeClass("modal-info");
								 $("#modalNotifContent").text("");
								 datatablesApproveHasilExtruder();
								},2000);
							}else if($.trim(response) === "Setengah"){
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Beberapa Transaksi Sudah Terkunci Dan Tidak Bisa Untuk Di Approve!");
								$("#modal-notif").modal("show");
								setTimeout(function(){
								 $("#modal-notif").modal("hide");
								 $("#modal-notif").removeClass("modal-warning");
								 $("#modalNotifContent").text("");
								 datatablesApproveHasilExtruder();
								},3000);
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
								$("#modalNotifContent").text("Approve Transaksi Gagal!");
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

			function saveApprovePengambilanCetak(){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						url : "<?php echo base_url('_gudangroll/main/saveApprovePengambilanCetak'); ?>",
						dataType : "TEXT",
						success : function(response){
							if($.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Approve Transaksi Berhasil");
								$("#modal-notif").modal("show");
								setTimeout(function(){
								 $("#modal-notif").modal("hide");
								 $("#modal-notif").removeClass("modal-info");
								 $("#modalNotifContent").text("");
								 datatablesApprovePermintaanCetak('POLOS');
								},2000);
							}else if($.trim(response) === "Berhasil Beberapa"){
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Beberapa Transaksi Sudah Terkunci Dan Tidak Bisa Untuk Di Approve!");
								$("#modal-notif").modal("show");
								setTimeout(function(){
								 $("#modal-notif").modal("hide");
								 $("#modal-notif").removeClass("modal-warning");
								 $("#modalNotifContent").text("");
								 datatablesApprovePermintaanCetak('POLOS');
							 	},3000);
							}else if($.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Approve Transaksi Gagal!");
								$("#modal-notif").modal("show");
								setTimeout(function(){
								 $("#modal-notif").modal("hide");
								 $("#modal-notif").removeClass("modal-danger");
								 $("#modalNotifContent").text("");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
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

			function saveApproveHasilCetak(){
				if(confirm("Apakah Anda Yakin Sudah Tidak Ada Yang Salah?")){
					$.ajax({
						url : "<?php echo base_url('_gudangroll/main/saveApproveHasilCetak'); ?>",
						dataType : "TEXT",
						success : function(response){
							if($.trim(response) === "Berhasil"){
								$("#modal-notif").addClass("modal-info");
								$("#modalNotifContent").text("Approve Transaksi Berhasil");
								$("#modal-notif").modal("show");
								setTimeout(function(){
								 $("#modal-notif").modal("hide");
								 $("#modal-notif").removeClass("modal-info");
								 $("#modalNotifContent").text("");
								 datatablesApproveHasilCetak();
								},2000);
							}else if($.trim(response) === "Berhasil Beberapa"){
								$("#modal-notif").addClass("modal-warning");
								$("#modalNotifContent").text("Beberapa Transaksi Sudah Terkunci Dan Tidak Bisa Untuk Di Approve!");
								$("#modal-notif").modal("show");
								setTimeout(function(){
								 $("#modal-notif").modal("hide");
								 $("#modal-notif").removeClass("modal-warning");
								 $("#modalNotifContent").text("");
								 datatablesApproveHasilCetak();
							 	},3000);
							}else if($.trim(response) === "Gagal"){
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Approve Transaksi Gagal!");
								$("#modal-notif").modal("show");
								setTimeout(function(){
								 $("#modal-notif").modal("hide");
								 $("#modal-notif").removeClass("modal-danger");
								 $("#modalNotifContent").text("");
								},2000);
							}else{
								$("#modal-notif").addClass("modal-danger");
								$("#modalNotifContent").text("Gagal, Bulan Ini Sudah Di Lock!");
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
			function editGudangRoll(param){
				var kdGdRoll1 = param;
				var kdAccurate1 = $("#txtKdAccurate").val();
				var strip1 = $("#txtStrip").val();
				var jnsPermitaan1 = $("#cmbJenisPermintaan").val();
				var warnaPlastik1 = $("#txtWarnaPlastik").val();
				var tebal1 = $("#txtTebal").val();
				var ukuran1 = $("#txtUkuran").val();
				var merek1 = $("#cmbMerek").val();
				var tglBuat1 = $("#txtTanggal").val();
				var jnsBarang1 = $("#cmbJenisBarang").val();

				if(kdGdRoll1=="" || strip1=="" || jnsPermitaan1=="" || warnaPlastik1==""||
					 tebal1=="" || ukuran1=="" || merek1=="" || tglBuat1=="" || jnsBarang1==""
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
						url : "<?php echo base_url(); ?>_gudangroll/main/editGudangRoll",
						dataType : "TEXT",
						data : {
							kdGdRoll 				: kdGdRoll1,
							kdAccurate 			: kdAccurate1,
							strip 					: strip1,
							jnsPermintaan 	: jnsPermitaan1,
							warnaPlastik 		: warnaPlastik1,
							tebal 					: tebal1,
							ukuran 					: ukuran1,
							merek 					: merek1,
							tglBuat 				: tglBuat1,
							jnsBarang 			: jnsBarang1
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
									resetFormTambahBarangBaru(jnsPermitaan1);
									datatablesListGudangRoll(jnsPermitaan1);
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

			function editSisaPotong(param){
				var kdGdRollHide1 = $("#txtKdGdRollHide").val();
				var kdPotongHide1 = $("#txtKdCuttingHide").val();
				var sisaHide1 = $("#txtSisaHide").val();
				var bobinHide1 = $("#txtBobinHide").val();
				var payungHide1 = $("#txtPayungHide").val();
				var payungKuningHide1 = $("#txtPayungKuningHide").val();
				var tglSisaHide1 = $("#txtTglSisaHide").val();
				var tglPotongHide1 = $("#txtTglPotongHide").val();
				var ukuranHide1 = $("#txtUkuranHide").val();
				var jnsPermintaanHide1 = $("#txtJnsPermintaanHide").val();
				var merekHide1 = $("#txtMerekHide").val();
				var warnaPlastikHide1 = $("#txtWarnaPlastikHide").val();

				var idTransaksi1 = param;
				var kdGdRoll1 = $("#cmbMerekEditSisa").val();
				var jnsPermintaan1 = $("#txtJnsPermintaanEditSisa").val
				var sisa1 = $("#txtSisaEditSisa").val().replace(/,/g,"");
				var bobin1 = $("#txtBobinEditSisa").val().replace(/,/g,"");
				var payung1 = $("#txtPayungEditSisa").val().replace(/,/g,"");
				var payungKuning1 = $("#txtPayungKuningEditSisa").val().replace(/,/g, "");
				var keterangan1 = $("#txtKeteranganEditSisa").val();

				if(kdGdRoll1=="" || kdGdRoll1==null){
					var ukuran1 = "";
					var panjang1 = "";
					var merek1 = "";
					var warnaPlastik1 = "";
				}else{
					var dataText = $("#cmbMerekEditSisa").select2("data")[0]["text"];
					var arrDataText = dataText.split(" | ");
					var ukuran1 = arrDataText[1];
					var panjang1 = arrDataText[1];
					var merek1 = arrDataText[2];
					var warnaPlastik1 = arrDataText[3];
				}

				if(jnsPermintaan1=="" || sisa1=="" || bobin1=="" || payung1=="" || payungKuning1=="" || keterangan1==""){
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
						url : "<?php echo base_url('_gudangroll/main/editTransaksiPengembalianPotong') ?>",
						dataType : "TEXT",
						data : {
							kdGdRollHide			 : kdGdRollHide1,
							kdPotongHide			 : kdPotongHide1,
							sisaHide					 : sisaHide1,
							bobinHide					 : bobinHide1,
							payungHide				 : payungHide1,
							payungKuningHide	 : payungKuningHide1,
							tglSisaHide				 : tglSisaHide1,
							tglPotongHide			 : tglPotongHide1,
							ukuranHide				 : ukuranHide1,
							jnsPermintaanHide  : jnsPermintaanHide1,
							merekHide					 : merekHide1,
							warnaPlastikHide 	 : warnaPlastikHide1,
							idTransaksi				 : idTransaksi1,
							kdGdRoll					 : kdGdRoll1,
							jnsPermintaan			 : jnsPermintaan1,
							sisa							 : sisa1,
							bobin					  	 : bobin1,
							payung						 : payung1,
							payungKuning			 : payungKuning1,
							keterangan				 : keterangan1,
							ukuran						 : ukuran1,
							panjang						 : panjang1,
							merek							 : merek1,
							warnaPlastik			 : warnaPlastik1
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
								},2000);
							}else if ($.trim(response) === "Gagal"){
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

			function editTransaksiGudangRoll(param){
				var tanggal = $("#txtTanggalTransaksi").val();
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_gudangroll/main/editTransaksiGudangRoll') ?>",
					dataType : "TEXT",
					data : {
						id : param,
						tanggal : tanggal
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
								$(".active a").trigger("click");
								$(".date").datepicker("setDate",null);
								$("#modalEditTransaksi").modal("hide");
							},2000);
						}else if ($.trim(response) === "Gagal"){
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
			//============================================EDIT METHOD (Finish)============================================//

			//============================================DELETE METHOD (Start)============================================//
			function deleteAndRestoreGudangRoll(param1, param2, param3){
				if(param2 == "TRUE"){
					var confirmText = "Apakah Anda Yakin Ingin Menghapus Data Ini?";
					var textSuccess = "Data Berhasil Dihapus";
					var textFailed = "Data Gagal Dihapus";
				}else{
					var confirmText = "Apakah Anda Yakin Ingin Mengembalikan Data Ini?";
					var textSuccess = "Data Berhasil Dipulihkan";
					var textFailed = "Data Gagal Dipulihkan";
				}
				if(confirm(confirmText)){
					var kdGdRoll1 = param1;
					var deleted1 = param2;
					if(kdGdRoll1 == "" || deleted1==""){
						$("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Parameter Tidak Boleh Kosong");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
					}else{
						$.ajax({
							type : "POST",
							url : "<?php echo base_url(); ?>_gudangroll/main/deleteAndRestoreGudangRoll",
							dataType : "TEXT",
							data : {
								kdGdRoll : kdGdRoll1,
								deleted : deleted1
							},
							success : function(response){
								if(jQuery.trim(response) === "Berhasil"){
									$("#modal-notif").addClass("modal-info");
									$("#modalNotifContent").text(textSuccess);
									$("#modal-notif").modal("show");
									setTimeout(function(){
										$("#modal-notif").modal("hide");
										$("#modal-notif").removeClass("modal-info");
										$("#modalNotifContent").text("");
										if($("#tableDataMasterGudangRollPolos").length == 1){
											datatablesListGudangRoll("#tableDataMasterGudangRollPolos","POLOS");
										}else{
											datatablesListGudangRoll("#tableDataMasterGudangRollCetak","CETAK");
										}
										datatablesListTrashGudangRoll();
										reloadTrash();
									},2000);
								}else if(jQuery.trim(response) === "Gagal"){
									$("#modal-notif").addClass("modal-danger");
									$("#modalNotifContent").text(textFailed);
									$("#modal-notif").modal("show");
									setTimeout(function(){
										$("#modal-notif").modal("hide");
										$("#modal-notif").removeClass("modal-danger");
										$("#modalNotifContent").text("");
									},2000);
								}else{
									$("#modal-notif").addClass("modal-warning");
									$("#modalNotifContent").text("Parameter Tidak Boleh Kosong");
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

			function deleteListDataAwalTemp(param1, param2, param3){
				if(confirm("Apakah Anda Yakin Ingin Menghapus Item Ini?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url(); ?>_gudangroll/main/deleteAndRestoreListDataAwalTemp",
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
									tableListDataAwalTemp(param3);
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
								$("#modalNotifContent").text("Parameter Tidak Boleh Kosong");
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

			function deleteAndRestorePengembalianPotong(param,param2){
				if(param2=="TRUE"){
					var confirmationText = "Apakah Anda Yakin Ingin Menghapus Data Ini?";
				}else{
					var confirmationText = "Apakah Anda Yakin Ingin Mengembalikan Data Ini?";
				}

				if(confirm(confirmationText)){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_gudangroll/main/deleteAndRestorePengembalianPotong'); ?>",
						dataType : "TEXT",
						data : {
							idTransaksi : param,
							deleted : param2
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
								$("#modalNotifContent").text("Parameter Tidak Boleh Kosong");
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

			function deleteAndRestoreRoll(param,param2){
				if(confirm("Apakah Anda Yakin Ingin Menghapus Transaksi Ini?")){
					$.ajax({
						type : "POST",
						url : "<?php echo base_url("_gudangroll/main/deleteAndRestoreRoll"); ?>",
						dataType : "TEXT",
						data : {
							idTransaksi : param,
							deleted : param2
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
									$(".active a").trigger("click");
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
					})
				}
			}
			//============================================DELETE METHOD (Finish)============================================//

			//============================================RESET METHOD (Start)============================================//
			function resetFormTambahBarangBaru(param){
				$("input").val("");
				$("#cmbMerek").val("");
				$(".date").datepicker("setDate",null);
				$("#cmbJenisBarang").val("LOKAL");
				$("#cmbJenisPermintaan").val("POLOS");
				$("#btnSaveBarangGudangRoll").attr("onclick","saveGudangRoll()").html("<i class='fa fa-check'></i> Simpan");
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_gudangroll/main/generateCodeGudangRoll",
					dataType : "JSON",
					data : {jnsPermintaan : param},
					success : function(response){
						$("#txtKdGdRoll").val(response.Code);
					}
				});
			}

			function resetFormTambahDataAwal(param){
				$("input").val("");
				$("#cmbUkuran2").val("").trigger("change");
				$(".date").datepicker("setDate",null);
				$("#btnTambahDataAwal").attr("onclick","saveAddDataAwalGudangRoll('"+param+"')");
				$("#txtJumlahStok").removeAttr("disabled");
				$("#txtJumlahBobin").removeAttr("disabled");
				$("#txtJumlahPayung").removeAttr("disabled");
			}

			function resetFormTambahSelisihBarang(param){
				$("input").val("");
				$(".date").datepicker("setDate",null);
				$("#cmbJenisBarang2").val("LOKAL");
				$("cmbJenisSelisih").val("PENAMBAHAN");
				$("#cmbMerek2").val("").trigger("change");
			}
			//============================================RESET METHOD (Finish)============================================//

			//============================================RELOAD METHOD (Start)============================================//
			function reloadTrash(){
        $.ajax({
          url : "<?php echo base_url(); ?>_gudangroll/main/getCountTrashGudangRoll",
          dataType : "JSON",
          success : function(response){
            $("#count-trash").text(response.Total);
          },
          error : function(response){
            $("#modal-notif").addClass("modal-danger");
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

			function reloadHistoryGudangRoll(param1, param2, param3){
				var tglAwal1 = param1;
				var tglAkhir1 = param2;
				var kdGdRoll1 = param3;

				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_gudangroll/main/getSaldoGudangRoll'); ?>",
					dataType : "JSON",
					data : {
						tglAwal : tglAwal1,
						tglAkhir : tglAkhir1,
						kdGdRoll : kdGdRoll1
					},
					success : function(response){
						datatablesHistoryGudangRoll(tglAwal1, tglAkhir1, kdGdRoll1);

						$("#textSaldoAwalBerat").text("BERAT : " + response.saldoAwalBerat);
						$("#textSaldoAwalBobin").text("BOBIN : " + response.saldoAwalBobin);
						$("#textSaldoAwalPayung").text("PAYUNG : " + response.saldoAwalPayung);
						$("#textSaldoAwalPayungKuning").text("PAYUNG KUNING : " + response.saldoAwalPayungKuning);

						$("#textSaldoAkhirBerat").text("BERAT : " + response.saldoAkhirBerat);
						$("#textSaldoAkhirBobin").text("BOBIN : " + response.saldoAkhirBobin);
						$("#textSaldoAkhirPayung").text("PAYUNG : " + response.saldoAkhirPayung);
						$("#textSaldoAkhirPayungKuning").text("PAYUNG KUNING : " + response.saldoAkhirPayungKuning);

						$("#textMasukBerat").text("BERAT : " + response.totalBeratMasukPerPeriode);
						$("#textMasukBobin").text("BOBIN : " + response.totalBobinMasukPerPeriode);
						$("#textMasukPayung").text("PAYUNG : " + response.totalPayungMasukPerPeriode);
						$("#textMasukPayungKuning").text("PAYUNG KUNING : " + response.totalPayungKuningMasukPerPeriode);

						$("#textKeluarBerat").text("BERAT : " + response.totalBeratKeluarPerPeriode);
						$("#textKeluarBobin").text("BOBIN : " + response.totalBobinKeluarPerPeriode);
						$("#textKeluarPayung").text("PAYUNG : " + response.totalPayungKeluarPerPeriode);
						$("#textKeluarPayungKuning").text("PAYUNG KUNING : " + response.totalPayungKuningKeluarPerPeriode);

						if(kdGdRoll1.indexOf("RLP") != -1){
							datatablesHistoryGudangRollExtruder(tglAwal1, tglAkhir1, kdGdRoll1);
							$("#textMasukBeratExtruder").text("BERAT : " + response.totalBeratMasukPerPeriodeBagian);
							$("#textMasukBobinExtruder").text("BOBIN : " + response.totalBobinMasukPerPeriodeBagian);
							$("#textMasukPayungExtruder").text("PAYUNG : " + response.totalPayungMasukPerPeriodeBagian);
							$("#textMasukPayungKuningExtruder").text("PAYUNG KUNING : " + response.totalPayungKuningMasukPerPeriodeBagian);
						}else{
							datatablesHistoryGudangRollPotongCetak(tglAwal1, tglAkhir1, kdGdRoll1);
							$("#textMasukBeratCetak").text("BERAT : " + response.totalBeratMasukPerPeriodeBagian);
							$("#textMasukBobinCetak").text("BOBIN : " + response.totalBobinMasukPerPeriodeBagian);
							$("#textMasukPayungCetak").text("PAYUNG : " + response.totalPayungMasukPerPeriodeBagian);
							$("#textMasukPayungKuningCetak").text("PAYUNG KUNING : " + response.totalPayungKuningMasukPerPeriodeBagian);
						}

						$("#textMasterBerat").text("BERAT : " + response.stokMasterBerat);
						$("#textMasterBobin").text("BOBIN : " + response.stokMasterBobin);
						$("#textMasterPayung").text("PAYUNG : " + response.stokMasterPayung);
						$("#textMasterPayungKuning").text("PAYUNG KUNING : " + response.stokMasterPayungKuning);
					},
					error : function(response){
						$("#modal-notif").addClass("modal-danger");
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

			//============================================RESTORE METHOD (Start)============================================//
			//============================================RESTORE METHOD (Finish)============================================//

			//============================================SEARCH METHOD (Start)============================================//
			function searchHasilJob(){
				var tanggal = $("#txtTanggal").val();
				if(tanggal=="" || tanggal==null){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Tanggal Tidak Boleh Kosong");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					datatablesListHasilJobPotong(tanggal);
					var fullDate = new Date(tanggal);
					var tanggal = fullDate.getDate();
					var bulan = fullDate.getMonth()+1;
					var tahun = fullDate.getFullYear();
					var tglUtuh = tanggal+"-"+bulan+"-"+tahun;
					$("#h4TitleHasilJob").text("Hasil Job Tanggal : "+tglUtuh);
				}
			}

			function searchCariHasilJob(){
				var tglAwal1 = $("#txtTglAwal").val();
				var tglAkhir1 = $('#txtTglAkhir').val();
				var jnsBrg1 = $("#cmbJenisBarang").val();
				var kdGdRoll1 = $("#cmbUkuran").val();

				if(tglAwal1=="" || tglAkhir1=="" || jnsBrg1==""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Kolom Tidak Boleh Kosong");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					if(jnsBrg1==""){
						$("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Kolom Boleh Kosong");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
					}else if(jnsBrg1 !="" && kdGdRoll1==""){
						$("#modal-notif").addClass("modal-warning");
						$("#modalNotifContent").text("Kolom Tidak Boleh Kosong");
						$("#modal-notif").modal("show");
						setTimeout(function(){
							$("#modal-notif").modal("hide");
							$("#modal-notif").removeClass("modal-warning");
							$("#modalNotifContent").text("");
						},2000);
					}else{
						datatablesListCariHasilJobPotong(tglAwal1, tglAkhir1, jnsBrg1, kdGdRoll1);
					}
				}
			}

			function searchHistoryRoll(param){
				var tglAwal1 = $("#txtTanggalAwal").val();
				var tglAkhir1 = $("#txtTanggalAkhir").val();
				var barang    = $("#cmbUkuran").val().split(",");;
				var kdGdRoll1 = barang[0];
				var title  = barang[1]+" - "+barang[2]+" - "+barang[3];
				if(tglAwal1=="" || tglAkhir1=="" || kdGdRoll1==""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					$("#titleTgl").text(tglAwal1+" s/d "+tglAkhir1);
					reloadHistoryGudangRoll(tglAwal1, tglAkhir1, kdGdRoll1);
					$("#modalCariHistoryGudangRoll").modal("hide");
					$("#title").text(" ("+title+" )");
					$("#btnRefreshTableHistory").attr("onclick","reloadHistoryGudangRoll('"+tglAwal1+"', '"+tglAkhir1+"', '"+kdGdRoll1+"')");
					$("#masterContainerRoll").css("display","none");
					$("#alertWrapper").css("display","none");
					$("#historyContainerRoll").css("display","block");
				}

			}

			function searchDataKartuStok(){
				var tglAwal = $("#txtTglAwal").val();
				var tglAkhir = $("#txtTglAkhir").val();
				var jnsPermintaan = $("#cmbJenis").val();

				if(tglAwal=="" || tglAkhir=="" || jnsPermintaan==""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					tableListDataKartuStok(tglAwal, tglAkhir, jnsPermintaan);
					$("#btnSortir").attr("onclick","searchDataKartuStokSort('"+tglAwal+"','"+tglAkhir+"','"+jnsPermintaan+"')");
					$("#modalCariKartuStok").modal("hide");
				}
			}

			function searchDataKartuStokSort(param, param2, param3){
				var tglAwal = param;
				var tglAkhir = param2;
				var jnsPermintaan = param3;

				if(tglAwal=="" || tglAkhir=="" || jnsPermintaan==""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					tableListDataKartuStokSort(tglAwal, tglAkhir, jnsPermintaan);
					$("#modalCariKartuStok").modal("hide");
				}
			}

			function searchCetakDataKartuStok(){
				var tglAwal = $("#txtTanggalAwal").val();
				var tglAkhir = $("#txtTanggalAkhir").val();
				var jenis = $("#cmbJenis").val();
				var kdGdRoll = $("#cmbUkuran").val();

				if(tglAwal==""||tglAkhir==""||jenis==""||kdGdRoll==""){
					$("#modal-notif").addClass("modal-warning");
					$("#modalNotifContent").text("Semua Kolom Berwarna Kuning Tidak Boleh Kosong!");
					$("#modal-notif").modal("show");
					setTimeout(function(){
						$("#modal-notif").modal("hide");
						$("#modal-notif").removeClass("modal-warning");
						$("#modalNotifContent").text("");
					},2000);
				}else{
					var dataText = $("#cmbUkuran").select2("data")[0]["text"];
					var arrDataText = dataText.split(" | ");
					$("#tdNamaBarang").text(arrDataText[1]+" "+arrDataText[2]+" "+arrDataText[3]);
					$("#tdStatusBarang").text(arrDataText[4]+" "+arrDataText[5]);

					tableListCetakDataKartuStok(tglAwal,tglAkhir,kdGdRoll);
				}
			}
			//============================================SEARCH METHOD (Finish)============================================//

			//============================================DATATABLE METHOD (Start)============================================//
			function datatablesListGudangRoll(param1,param2){
				$(param1).dataTable().fnDestroy();
				$(param1).dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangroll/main/getListGudangRoll",
          "columns":[
            {"data" : "kd_gd_roll","name":"kd_gd_roll"},
            {"data" : "warna_plastik","name":"warna_plastik"},
            {"data" : "jns_permintaan","name":"jns_permintaan"},
            {"data" : "tebal","name":"tebal"},
            {"data" : "ukuran","name":"ukuran"},
            {"data" : "stok","name":"stok"},
            {"data" : "bobin","name":"bobin"},
            {"data" : "payung","name":"payung"},
						{"data" : "payung_kuning","name":"payung_kuning"},
            {"data" : "merek","name":"merek"},
						{"data" : "jns_brg","name":"jns_brg"},
						{"data" : "kd_gd_roll","name":"kd_gd_roll"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
             aoData.push({"name":"jnsPermintaan","value":param2});
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
						$("td:eq(0)",nRow).html(aData["kd_gd_roll"]+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>");

            $("td:eq(11)",nRow).html("<button class='btn btn-md btn-flat btn-warning' data-toggle='modal' data-target='#modalTambahBarangBaru' onclick=modalEditGudangRoll('"+aData["kd_gd_roll"]+"')><i class='fa fa-edit'></i> Edit</button>"+
                                     "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreGudangRoll('"+aData["kd_gd_roll"]+"','TRUE','"+aData["jns_permintaan"]+"')><i class='fa fa-trash'></i> Hapus</button>");
          }
				});
			}

			function tableListDataAwalTemp(param){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>_gudangroll/main/getListDataAwalTemp",
					dataType : "JSON",
					data : {jnsPermintaan : param},
					success : function(response){
						$("#tableListDataAwalTemp > tbody > tr").empty();
						$.each(response,function(AvIndex, AvValue){
							$("#tableListDataAwalTemp > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+ AvValue.tgl_transaksi +"</td>"+
									"<td>"+ AvValue.ukuran +"</td>"+
									"<td>"+ AvValue.warna_plastik +"</td>"+
									"<td>"+ AvValue.berat +"</td>"+
									"<td>"+ AvValue.payung +"</td>"+
									"<td>"+ AvValue.bobin +"</td>"+
									"<td>"+ AvValue.merek +"</td>"+
									"<td>"+ AvValue.jns_brg +"</td>"+
									"<td>"+
										"<button class='btn btn-md btn-flat btn-danger' onclick=deleteListDataAwalTemp('"+AvValue.id+"','TRUE','"+AvValue.jns_permintaan+"')><i class='fa fa-trash'></i> Hapus</button>"+
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

			function datatablesListTrashGudangRoll(){
				$("#tableTrashGudangRoll").dataTable().fnDestroy();
				$("#tableTrashGudangRoll").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangroll/main/getListTrashGudangRoll",
          "columns":[
            {"data" : "kd_gd_roll","name":"kd_gd_roll"},
						{"data" : "ukuran","name":"ukuran"},
						{"data" : "merek","name":"merek"},
						{"data" : "jns_permintaan","name":"jns_permintaan"},
            {"data" : "warna_plastik","name":"warna_plastik"},
						{"data" : "kd_gd_roll","name":"kd_gd_roll"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            //  aoData.push({"name":"jnsPermintaan","value":param2});
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
						$("td:eq(0)",nRow).html(aData["kd_gd_roll"]+"<label class='text-red'>["+aData["kd_accurate"]+"]</label>");
						$("td:eq(3)",nRow).html(aData["jns_permintaan"]+"<label class='text-red'>["+aData["jns_brg"]+"]</label>")
            $("td:eq(5)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=deleteAndRestoreGudangRoll('"+aData["kd_gd_roll"]+"','FALSE','"+aData["jns_permintaan"]+"')><i class='fa fa-undo'></i> Pulihkan</button>");
          }
				});
			}

			function datatablesListTrashTransaksiGudangRoll() {
				$("#tableTrashTransaksi").dataTable().fnDestroy();
				$("#tableTrashTransaksi").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url(); ?>_gudangroll/main/getListTrashTransaksiGudangRoll",
          "columns":[
            {"data" : "tgl_transaksi","name":"TGR.tgl_transaksi"},
						{"data" : "ukuran","name":"GR.ukuran"},
						{"data" : "berat","name":"TGR.berat"},
						{"data" : "payung","name":"TGR.payung"},
            {"data" : "bobin","name":"TGR.bobin"},
						{"data" : "keterangan_history","name":"GR.merek"},
						{"data" : "id","name":"TGR.id"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            //  aoData.push({"name":"jnsPermintaan","value":param2});
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
						if(aData["status_history"] == "MASUK"){
							$("td",nRow).css("background-color","rgba(0, 150, 238, 0.7)");
						}else if(aData["status_history"] == "KELUAR"){
							$("td",nRow).css("background-color","rgba(255, 130, 0, 0.7)");
						}else{

						}
						$("td:eq(1)",nRow).text(aData["ukuran"]+" "+aData["merek"]+" "+aData["warna_plastik"]);
						$("td:eq(5)",nRow).html(aData["keterangan_history"]+" <label class='text-danger'>["+aData["keterangan_transaksi"]+"]</label>")
            $("td:eq(6)",nRow).html("<button class='btn btn-md btn-flat btn-success' onclick=deleteAndRestoreRoll('"+aData["id"]+"','FALSE')><i class='fa fa-undo'></i> Pulihkan</button>");
          }
				});
			}

			function datatablesListHasilJobPotong(param='<?php echo date("Y-m-d"); ?>') {
				var persentase = 0;
				var tPersentase = 0;
				var tPlusminus = 0;
				var tBeratBersih = 0;
				var tBeratPipa = 0;
				var tApal = 0;
				var tSisaBobin = 0;
				var tSisaPayungKuning = 0;
				var tSisaPayung = 0;
				var tBeratSisa = 0;
				var tBobinPengambilan = 0;
				var tPayungKuningPengambilan = 0;
				var tPayungPengambilan = 0;
				var tBeratPengambilan = 0;
				var tJumlahSelesai = 0;
				$("#tableHasilJobPotong").dataTable().fnDestroy();
				$("#tableHasilJobPotong").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
					"scrollX" : "100%",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url('_gudangroll/main/getHasilJob'); ?>",
          "columns":[
            {"data" : "kd_hasil_potong","name":"THP.kd_hasil_potong"},
						{"data" : "tgl_rencana","name":"THP.tgl_rencana"},
						{"data" : "customer","name":"RC.customer"},
						{"data" : "ukuran","name":"RC.ukuran"},
						{"data" : "jns_permintaan","name":"RC.jns_permintaan"},
            {"data" : "warna_plastik","name":"RC.warna_plastik"},
						{"data" : "jumlah_lembar","name":"TSHP.jumlah_lembar"},
						{"data" : "merek","name":"RC.merek"},
						{"data" : "berat_pengambilan","name":"(TPHP.berat_pengambilan_bagian + TPHP.berat_pengambilan_gudang)"},
						{"data" : "payung_pengambilan","name":"(TPHP.payung_pengambilan_bagian + TPHP.payung_pengambilan_gudang)"},
						{"data" : "payung_kuning_pengambilan","name":"(TPHP.payung_kuning_pengambilan_bagian + TPHP.payung_kuning_pengambilan_gudang)"},
						{"data" : "bobin_pengambilan","name":"(TPHP.bobin_pengambilan_bagian + TPHP.bobin_pengambilan_gudang)"},
						{"data" : "berat_sisa","name":"(TPHP.berat_sisa_semalam + TPHP.berat_sisa_hari_ini)"},
						{"data" : "payung_sisa","name":"(TPHP.payung_sisa_semalam + TPHP.payung_sisa_semalam)"},
						{"data" : "payung_kuning_sisa","name":"(TPHP.payung_kuning_sisa_semalam + TPHP.payung_kuning_sisa_hari_ini)"},
						{"data" : "bobin_sisa","name":"(TPHP.bobin_sisa_semalam + TPHP.bobin_sisa_hari_ini)"},
						{"data" : "jumlah_apal_global","name":"THP.jumlah_apal_global"},
						{"data" : "jumlah_roll_pipa","name":"THP.jumlah_roll_pipa"},
						{"data" : "hasil_berat_bersih","name":"THP.hasil_berat_bersih"},
						{"data" : "plusminus","name":"THP.plusminus"},
						{"data" : "plusminus","name":"THP.plusminus"},
						{"data" : "plusminus","name":"THP.plusminus"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tanggal","value":param});
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
						if(aData["tgl_rencana"].indexOf("#") != -1){
							$("td:eq(1)",nRow).html(aData["tgl_rencana"].replace(/#/g,"<br>"));
						}
						if(aData["customer"].indexOf("#") != -1){
							$("td:eq(2)",nRow).html(aData["customer"].replace(/#/g,"<br>"));
						}

						if(aData["ukuran"].indexOf("#") != -1){
							$("td:eq(3)",nRow).html(aData["ukuran"].replace(/#/g,"<br>"));
						}

						if(aData["jns_permintaan"].indexOf("#") != -1){
							$("td:eq(4)",nRow).html(aData["jns_permintaan"].replace(/#/g,"<br>"));
						}

						if(aData["jumlah_lembar"].indexOf("#") != -1){
							$("td:eq(6)",nRow).html(aData["jumlah_lembar"].replace(/#/g,"<br>"));
						}
						$("td:eq(8)",nRow).text(parseFloat(aData["berat_pengambilan"]).toLocaleString());
						$("td:eq(12)",nRow).text(parseFloat(aData["berat_sisa"]).toLocaleString());
						$("td:eq(16)",nRow).text(parseFloat(aData["jumlah_apal_global"]).toLocaleString());
						$("td:eq(17)",nRow).text(parseFloat(aData["jumlah_roll_pipa"]).toLocaleString());
						$("td:eq(18)",nRow).text(parseFloat(aData["hasil_berat_bersih"]).toLocaleString());
						$("td:eq(19)",nRow).text(parseFloat(aData["plusminus"]).toLocaleString());
						var arrUkuranTemp = aData["ukuran"].split("#");
						var arrUkuran = arrUkuranTemp[0].split("x");
						$("td:eq(21)",nRow).html("<button class='btn btn-md btn-flat btn-primary' onclick=modalInputHasil('"+arrUkuran[0].replace(/ /g,"_")+"','"+aData["warna_plastik"].replace(/ /g,"_")+"','"+aData["kd_gd_roll"].replace(/ /g,"_")+"','"+param.replace(/ /g,"_")+"');>Edit</button>");

						var x = (parseFloat(aData["berat_pengambilan"]) - parseFloat(aData["berat_sisa"]));
						// var y = (parseFloat(aData["hasil_berat_bersih"]) + parseFloat(aData["jumlah_roll_pipa"]) + parseFloat(aData["jumlah_apal_global"]));
						// var z = (x-y);
						persentase = ((parseFloat(aData["plusminus"]) / 1000) / x) * 100;
						tPersentase += persentase;
						tPlusminus += parseFloat(aData["plusminus"]);
						tBeratBersih += parseFloat(aData["hasil_berat_bersih"]);
						tBeratPipa += parseFloat(aData["jumlah_roll_pipa"]);
						tApal += parseFloat(aData["jumlah_apal_global"]);
						tSisaBobin += parseFloat(aData["bobin_sisa"]);
						tSisaPayungKuning += parseFloat(aData["payung_kuning_sisa"]);
						tSisaPayung += parseFloat(aData["payung_sisa"]);
						tBeratSisa += parseFloat(aData["berat_sisa"]);
						tBobinPengambilan += parseFloat(aData["bobin_pengambilan"]);
						tPayungKuningPengambilan += parseFloat(aData["payung_kuning_pengambilan"]);
						tPayungPengambilan += parseFloat(aData["payung_pengambilan"]);
						tBeratPengambilan += parseFloat(aData["berat_pengambilan"]);
						if(aData["jumlah_lembar"].indexOf("#") != -1){
							var arrJumlahLembar = aData["jumlah_lembar"].split("#");
							for (var i = 0; i < arrJumlahLembar.length; i++) {
								tJumlahSelesai += parseFloat(arrJumlahLembar[i]);
							}
						}else{
							tJumlahSelesai += parseFloat(aData["jumlah_lembar"]);
						}

						$("td:eq(20)",nRow).text(persentase.toFixed(2).toLocaleString());
						var txPersentase = parseFloat(tPlusminus.toFixed(2)) / (parseFloat(tBeratPengambilan.toFixed(2)) - parseFloat(tBeratSisa.toFixed(2)));
						$("#thTotalPersentase").text(parseFloat(txPersentase).toLocaleString());
						// $("#thTotalPersentase").text(tPersentase.toFixed(2));
						$("#thTotalJumlahBeratBersih").text(tBeratBersih.toLocaleString());
						$("#thTotalJumlahPipa").text(tBeratPipa.toLocaleString());
						$("#thTotalJumlahApal").text(tApal.toLocaleString());
						$("#thTotalJumlahSisaBobin").text(tSisaBobin.toLocaleString());
						$("#thTotalJumlahSisaPayungKuning").text(tSisaPayungKuning.toLocaleString());
						$("#thTotalJumlahSisaPayung").text(tSisaPayung.toLocaleString());
						$("#thTotalJumlahSisa").text(tBeratSisa.toLocaleString());
						$("#thTotalJumlahBobin").text(tBobinPengambilan.toLocaleString());
						$("#thTotalJumlahPayungKuning").text(tPayungKuningPengambilan.toLocaleString());
						$("#thTotalJumlahPayung").text(tPayungPengambilan.toLocaleString());
						$("#thTotalJumlahBrtPengambilan").text(tBeratPengambilan.toLocaleString());
						$("#thTotalJumlahSelesai").text(tJumlahSelesai.toLocaleString());
          }
				});
			}

			function datatablesListCariHasilJobPotong(param, param2, param3, param4) {
				var persentase = 0;
				var tPersentase = 0;
				var tPlusminus = 0;
				var tBeratBersih = 0;
				var tBeratPipa = 0;
				var tApal = 0;
				var tSisaBobin = 0;
				var tSisaPayungKuning = 0;
				var tSisaPayung = 0;
				var tBeratSisa = 0;
				var tBobinPengambilan = 0;
				var tPayungKuningPengambilan = 0;
				var tPayungPengambilan = 0;
				var tBeratPengambilan = 0;
				var tJumlahSelesai = 0;
				$("#tableListCariHasilJob").dataTable().fnDestroy();
				$("#tableListCariHasilJob").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"pageLength" : 100,
          "ordering" : false,
          "bProcessing" : true,
          "bServerSide" : true,
					"scrollX" : "100%",
          "sPaginationType": "full_numbers",
          "sAjaxSource":"<?php echo base_url('_gudangroll/main/getCariHasilJob'); ?>",
          "columns":[
            {"data" : "kd_hasil_potong","name":"THP.kd_hasil_potong"},
						{"data" : "tgl_rencana","name":"THP.tgl_rencana"},
						{"data" : "customer","name":"RC.customer"},
						{"data" : "ukuran","name":"RC.ukuran"},
						{"data" : "jns_permintaan","name":"RC.jns_permintaan"},
            {"data" : "warna_plastik","name":"RC.warna_plastik"},
						{"data" : "jumlah_lembar","name":"TSHP.jumlah_lembar"},
						{"data" : "merek","name":"RC.merek"},
						{"data" : "berat_pengambilan","name":"(TPHP.berat_pengambilan_bagian + TPHP.berat_pengambilan_gudang)"},
						{"data" : "payung_pengambilan","name":"(TPHP.payung_pengambilan_bagian + TPHP.payung_pengambilan_gudang)"},
						{"data" : "payung_kuning_pengambilan","name":"(TPHP.payung_kuning_pengambilan_bagian + TPHP.payung_kuning_pengambilan_gudang)"},
						{"data" : "bobin_pengambilan","name":"(TPHP.bobin_pengambilan_bagian + TPHP.bobin_pengambilan_gudang)"},
						{"data" : "berat_sisa","name":"(TPHP.berat_sisa_semalam + TPHP.berat_sisa_hari_ini)"},
						{"data" : "payung_sisa","name":"(TPHP.payung_sisa_semalam + TPHP.payung_sisa_semalam)"},
						{"data" : "payung_kuning_sisa","name":"(TPHP.payung_kuning_sisa_semalam + TPHP.payung_kuning_sisa_hari_ini)"},
						{"data" : "bobin_sisa","name":"(TPHP.bobin_sisa_semalam + TPHP.bobin_sisa_hari_ini)"},
						{"data" : "jumlah_apal_global","name":"THP.jumlah_apal_global"},
						{"data" : "jumlah_roll_pipa","name":"THP.jumlah_roll_pipa"},
						{"data" : "hasil_berat_bersih","name":"THP.hasil_berat_bersih"},
						{"data" : "plusminus","name":"THP.plusminus"},
						{"data" : "plusminus","name":"THP.plusminus"},
						{"data" : "plusminus","name":"THP.plusminus"}
          ],
          "fnServerData": function (sSource, aoData, fnCallback){
            aoData.push({"name":"tglAwal","value":param},
												{"name":"tglAkhir","value":param2},
												{"name":"jnsBrg","value":param3},
												{"name":"kdGdRoll","value":param4});
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
						if(aData["tgl_rencana"].indexOf("#") != -1){
							$("td:eq(1)",nRow).html(aData["tgl_rencana"].replace(/#/g,"<br>"));
						}

						if(aData["customer"].indexOf("#") != -1){
							$("td:eq(2)",nRow).html(aData["customer"].replace(/#/g,"<br>"));
						}

						if(aData["ukuran"].indexOf("#") != -1){
							$("td:eq(3)",nRow).html(aData["ukuran"].replace(/#/g,"<br>"));
						}

						if(aData["jns_permintaan"].indexOf("#") != -1){
							$("td:eq(4)",nRow).html(aData["jns_permintaan"].replace(/#/g,"<br>"));
						}

						if(aData["jumlah_lembar"].indexOf("#") != -1){
							$("td:eq(6)",nRow).html(aData["jumlah_lembar"].replace(/#/g,"<br>"));
						}

						$("td:eq(21)",nRow).html("<button class='btn btn-md btn-flat btn-primary'>Edit</button>");

						var x = (parseFloat(aData["berat_pengambilan"].replace(/,/g, "")) - parseFloat(aData["berat_sisa"].replace(/,/g, "")));
						var y = (parseFloat(aData["hasil_berat_bersih"]) + (parseFloat(aData["jumlah_roll_pipa"])/1000) + parseFloat(aData["jumlah_apal_global"]));
						var z = (x-y);
						persentase = ((parseFloat(aData["plusminus"].replace(/,/g, "")) / 1000) / x) * 100;
						// tPersentase += persentase;
						tPlusminus += parseFloat(aData["plusminus"].replace(/,/g, ""));
						tBeratBersih += parseFloat(aData["hasil_berat_bersih"].replace(/,/g, ""));
						tBeratPipa += parseFloat(aData["jumlah_roll_pipa"].replace(/,/g, ""));
						tApal += parseFloat(aData["jumlah_apal_global"].replace(/,/g, ""));
						tSisaBobin += parseFloat(aData["bobin_sisa"].replace(/,/g, ""));
						tSisaPayungKuning += parseFloat(aData["payung_kuning_sisa"].replace(/,/g, ""));
						tSisaPayung += parseFloat(aData["payung_sisa"].replace(/,/g, ""));
						tBeratSisa += parseFloat(aData["berat_sisa"].replace(/,/g, ""));
						tBobinPengambilan += parseFloat(aData["bobin_pengambilan"].replace(/,/g, ""));
						tPayungKuningPengambilan += parseFloat(aData["payung_kuning_pengambilan"].replace(/,/g, ""));
						tPayungPengambilan += parseFloat(aData["payung_pengambilan"].replace(/,/g, ""));
						tBeratPengambilan += parseFloat(aData["berat_pengambilan"].replace(/,/g, ""));
						if(aData["jumlah_lembar"].indexOf("#") != -1){
							var arrJumlahLembar = aData["jumlah_lembar"].split("#");
							for (var i = 0; i < arrJumlahLembar.length; i++) {
								tJumlahSelesai += parseFloat(arrJumlahLembar[i]);
							}
						}else{
							tJumlahSelesai += parseFloat(aData["jumlah_lembar"]);
						}

						$("td:eq(8)",nRow).text(parseFloat(aData["berat_pengambilan"].replace(/,/g,"")).toLocaleString());
						$("td:eq(12)",nRow).text(parseFloat(aData["berat_sisa"].replace(/,/g,"")).toLocaleString());
						$("td:eq(16)",nRow).text(parseFloat(aData["jumlah_apal_global"].replace(/,/g,"")).toLocaleString());
						$("td:eq(17)",nRow).text(parseFloat(aData["jumlah_roll_pipa"].replace(/,/g,"")).toLocaleString());
						$("td:eq(18)",nRow).text(parseFloat(aData["hasil_berat_bersih"].replace(/,/g,"")).toLocaleString());
						$("td:eq(19)",nRow).text(parseFloat(aData["plusminus"].replace(/,/g,"")).toLocaleString());

						$("td:eq(20)",nRow).text((isNaN(persentase) ? 0 : persentase.toLocaleString()));
						$("#thTotalJumlahBeratBersih").text(tBeratBersih.toLocaleString());
						$("#thTotalJumlahPipa").text(tBeratPipa.toLocaleString());
						$("#thTotalJumlahApal").text(tApal.toLocaleString());
						$("#thTotalJumlahSisaBobin").text(tSisaBobin.toLocaleString());
						$("#thTotalJumlahSisaPayungKuning").text(tSisaPayungKuning.toLocaleString());
						$("#thTotalJumlahSisaPayung").text(tSisaPayung.toLocaleString());
						$("#thTotalJumlahSisa").text(tBeratSisa.toLocaleString());
						$("#thTotalJumlahBobin").text(tBobinPengambilan.toLocaleString());
						$("#thTotalJumlahPayungKuning").text(tPayungKuningPengambilan.toLocaleString());
						$("#thTotalJumlahPayung").text(tPayungPengambilan.toLocaleString());
						$("#thTotalJumlahBrtPengambilan").text(tBeratPengambilan.toLocaleString());
						$("#thTotalJumlahSelesai").text(tJumlahSelesai.toLocaleString());
						$("#thTotalJumlahPlusMinus").text(tPlusminus.toLocaleString());
						var txPersentase = (parseFloat(tPlusminus)/1000) / (parseFloat(tBeratPengambilan) - parseFloat(tBeratSisa).toLocaleString());
						$("#thTotalPersentase").text(parseFloat(txPersentase*100).toLocaleString());
          }
				});
			}

			function datatablesHistoryGudangRoll(param1, param2, param3){
				$("#tableHistoryGudangRoll").dataTable().fnDestroy();
				$("#tableHistoryGudangRoll").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : true,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType" : "full_numbers",
					"scrollX" : "100%",
					"scrollY" : "500px",
					"sAjaxSource" : "<?php echo base_url('_gudangroll/main/getListHistoryGudangRoll') ?>",
					"columns" : [
						{"data":"tgl_transaksi", "name":"TGR.tgl_transaksi"},
						{"data":"berat", "name":"TGR.berat"},
						{"data":"payung", "name":"TGR.payung"},
						{"data":"payung_kuning", "name":"TGR.payung_kuning"},
						{"data":"bobin", "name":"TGR.bobin"},
						{"data":"keterangan_transaksi", "name":"TGR.keterangan_transaksi"},
						{"data":"keterangan_history", "name":"TGR.keterangan_history"},
						{"data":"id", "name":"TGR.id"},
					],
					"fnServerData" : function(AvSource, AvData, AvCallBack){
						AvData.push({"name":"tglAwal", "value":param1},
												{"name":"tglAkhir", "value":param2},
												{"name":"kdGdRoll", "value":param3});
						$.ajax({
							type : "POST",
							url : AvSource,
							dataType : "JSON",
							data : AvData,
							success : AvCallBack
						});
					},
					"fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
						if(AvData["status_lock"] == "TRUE"){
							$("td:eq(7)",AvRow).html("<button class='btn btn-md btn-flat btn-block btn-default'><i class='fa fa-lock'></i> Bulan Ini Sudah Dikunci</button>");
						}else{
							$("td:eq(7)",AvRow).html("<button class='btn btn-md btn-flat btn-warning' data-toggle='modal' data-target='#modalEditTransaksi' onclick=modalEditTransaksiGudangRoll('"+AvData["id"]+"')>Ubah</button>"+
																			 "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRoll('"+AvData["id"]+"','TRUE')>Hapus</button>");
						}

						if(AvData["status_history"] == "MASUK"){
							$("td",AvRow).css("background-color","rgba(216, 0, 0, 0.7)");
							$("td:eq(7)",AvRow).css("background-color","transparent");
						}else{
							$("td",AvRow).css("background-color","rgba(255, 130, 0, 0.7)","color","#fff");
							$("td:eq(7)",AvRow).css("background-color","transparent");
						}
					}
				});
			}

			function datatablesHistoryGudangRollExtruder(param1, param2, param3){
				$("#tableHistoryGudangRollExtruder").dataTable().fnDestroy();
				$("#tableHistoryGudangRollExtruder").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : true,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType" : "full_numbers",
					"scrollX" : "100%",
					"scrollY" : "500px",
					"sAjaxSource" : "<?php echo base_url('_gudangroll/main/getListHistoryGudangRollExtruder') ?>",
					"columns" : [
						{"data":"tgl_transaksi", "name":"TGR.tgl_transaksi"},
						{"data":"berat", "name":"TGR.berat"},
						{"data":"payung", "name":"TGR.payung"},
						{"data":"payung_kuning", "name":"TGR.payung_kuning"},
						{"data":"bobin", "name":"TGR.bobin"},
						{"data":"shift", "name":"TGR.shift"},
						{"data":"keterangan_history", "name":"TGR.keterangan_history"},
						{"data":"id", "name":"TGR.id"},
					],
					"fnServerData" : function(AvSource, AvData, AvCallBack){
						AvData.push({"name":"tglAwal", "value":param1},
												{"name":"tglAkhir", "value":param2},
												{"name":"kdGdRoll", "value":param3});
						$.ajax({
							type : "POST",
							url : AvSource,
							dataType : "JSON",
							data : AvData,
							success : AvCallBack
						});
					},
					"fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
						if(AvData["status_lock"] == "TRUE"){
							$("td:eq(7)",AvRow).html("<button class='btn btn-md btn-flat btn-block btn-default'><i class='fa fa-lock'></i> Bulan Ini Sudah Dikunci</button>");
						}else{
							$("td:eq(7)",AvRow).html("<button class='btn btn-md btn-flat btn-warning' data-toggle='modal' data-target='#modalEditTransaksi' onclick=modalEditTransaksiGudangRoll('"+AvData["id"]+"')>Ubah</button>"+
																			 "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRoll('"+AvData["id"]+"','TRUE')>Hapus</button>");
						}

						if(AvData["status_history"] == "MASUK"){
							$("td",AvRow).css("background-color","rgba(0, 150, 238, 0.7)");
							$("td:eq(7)",AvRow).css("background-color","transparent");
						}else{
							$("td",AvRow).css("background-color","rgba(255, 130, 0, 0.7)");
							$("td:eq(7)",AvRow).css("background-color","transparent");
						}
					}
				});
			}

			function datatablesHistoryGudangRollPotongCetak(param1, param2, param3){
				$("#tableHistoryGudangRoll_Cetak").dataTable().fnDestroy();
				$("#tableHistoryGudangRoll_Cetak").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : true,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType" : "full_numbers",
					"scrollX" : "100%",
					"scrollY" : "500px",
					"sAjaxSource" : "<?php echo base_url('_gudangroll/main/getListHistoryGudangRollPotongCetak') ?>",
					"columns" : [
						{"data":"tgl_transaksi", "name":"TGR.tgl_transaksi"},
						{"data":"berat", "name":"TGR.berat"},
						{"data":"payung", "name":"TGR.payung"},
						{"data":"payung_kuning", "name":"TGR.payung_kuning"},
						{"data":"bobin", "name":"TGR.bobin"},
						{"data":"keterangan_transaksi", "name":"TGR.keterangan_transaksi"},
						{"data":"keterangan_history", "name":"TGR.keterangan_history"},
						{"data":"id", "name":"TGR.id"},
					],
					"fnServerData" : function(AvSource, AvData, AvCallBack){
						AvData.push({"name":"tglAwal", "value":param1},
												{"name":"tglAkhir", "value":param2},
												{"name":"kdGdRoll", "value":param3});
						$.ajax({
							type : "POST",
							url : AvSource,
							dataType : "JSON",
							data : AvData,
							success : AvCallBack
						});
					},
					"fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
						if(AvData["status_lock"] == "TRUE"){
							$("td:eq(7)",AvRow).html("<button class='btn btn-md btn-flat btn-block btn-default'><i class='fa fa-lock'></i> Bulan Ini Sudah Dikunci</button>");
						}else{
							$("td:eq(7)",AvRow).html("<button class='btn btn-md btn-flat btn-warning' data-toggle='modal' data-target='#modalEditTransaksi' onclick=modalEditTransaksiGudangRoll('"+AvData["id"]+"')>Ubah</button>"+
																			 "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestoreRoll('"+AvData["id"]+"','TRUE')>Hapus</button>");
						}

						if(AvData["status_history"] == "MASUK"){
							$("td",AvRow).css("background-color","rgba(0, 150, 238, 0.7)");
							$("td:eq(7)",AvRow).css("background-color","transparent");
						}else{
							$("td",AvRow).css("background-color","rgba(255, 130, 0, 0.7)");
							$("td:eq(7)",AvRow).css("background-color","transparent");
						}
					}
				});
			}

			function datatablesApprovePermintaan(param){
				$("#tableApprovePermintaanPOTONG").dataTable().fnDestroy();
				$("#tableApprovePermintaanPOTONG").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType" : "full_numbers",
					"sAjaxSource" : "<?php echo base_url('_gudangroll/main/getPengembalianPotong') ?>",
					"columns" : [
						{"data":"ukuran", "name":"GR.ukuran"},
						{"data":"merek", "name":"GR.merek"},
						{"data":"warna_plastik", "name":"GR.warna_plastik"},
						{"data":"berat", "name":"TGR.berat"},
						{"data":"bobin", "name":"TGR.bobin"},
						{"data":"payung", "name":"TGR.payung"},
						{"data":"payung_kuning", "name":"TGR.payung_kuning"},
						{"data":"tgl_transaksi", "name":"TGR.tgl_transaksi"},
						{"data":"keterangan_history", "name":"TGR.keterangan_history"},
						{"data":"id", "name":"TGR.id"}
					],
					"fnServerData" : function(AvUrl, AvData, AvResponse){
						AvData.push({"name":"jnsPermintaan", "value":param});
						$.ajax({
							type : "POST",
							url : AvUrl,
							dataType : "JSON",
							data : AvData,
							success : AvResponse
						});
					},
					"fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
						$("td:eq(9)",AvRow).html("<button class='btn btn-md btn-flat btn-warning' disabled onclick=modalEditTransaksiPengembalianPotong('"+AvData["id"]+"','"+AvData["jns_permintaan"]+"')>Ubah</button>"+
																		 "<button class='btn btn-md btn-flat btn-danger' disabled onclick=deleteAndRestorePengembalianPotong('"+AvData["id"]+"','TRUE')>Hapus</button>");
					}
				});
			}

			function datatablesApproveSisaPotongHariIni(param){
				$("#tableApproveSisaHariIniPOTONG").dataTable().fnDestroy();
				$("#tableApproveSisaHariIniPOTONG").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType" : "full_numbers",
					"sAjaxSource" : "<?php echo base_url('_gudangroll/main/getSisaPotongHariIni') ?>",
					"columns" : [
						{"data":"ukuran", "name":"GR.ukuran"},
						{"data":"merek", "name":"GR.merek"},
						{"data":"warna_plastik", "name":"GR.warna_plastik"},
						{"data":"berat", "name":"TGR.berat"},
						{"data":"bobin", "name":"TGR.bobin"},
						{"data":"payung", "name":"TGR.payung"},
						{"data":"payung_kuning", "name":"TGR.payung_kuning"},
						{"data":"tgl_transaksi", "name":"TGR.tgl_transaksi"},
						{"data":"keterangan_history", "name":"TGR.keterangan_history"},
						{"data":"id", "name":"TGR.id"}
					],
					"fnServerData" : function(AvUrl, AvData, AvResponse){
						AvData.push({"name":"jnsPermintaan", "value":param});
						$.ajax({
							type : "POST",
							url : AvUrl,
							dataType : "JSON",
							data : AvData,
							success : AvResponse
						});
					},
					"fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
						$("td:eq(9)",AvRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditTransaksiPengembalianPotong('"+AvData["id"]+"','"+AvData["jns_permintaan"]+"')>Ubah</button>"+
																		 "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestorePengembalianPotong('"+AvData["id"]+"','TRUE')>Hapus</button>");
					}
				});
			}

			function datatablesApprovePermintaanCetak(param){
				$("#tableApprovePermintaanCETAK").dataTable().fnDestroy();
				$("#tableApprovePermintaanCETAK").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType" : "full_numbers",
					"sAjaxSource" : "<?php echo base_url('_gudangroll/main/getPengambilanCetak') ?>",
					"columns" : [
						{"data":"ukuran", "name":"GR.ukuran"},
						{"data":"merek", "name":"GR.merek"},
						{"data":"warna_plastik", "name":"GR.warna_plastik"},
						{"data":"berat", "name":"TGR.berat"},
						{"data":"bobin", "name":"TGR.bobin"},
						{"data":"payung", "name":"TGR.payung"},
						{"data":"payung_kuning", "name":"TGR.payung_kuning"},
						{"data":"tgl_transaksi", "name":"TGR.tgl_transaksi"},
						{"data":"keterangan_history", "name":"TGR.keterangan_history"},
						{"data":"id", "name":"TGR.id"}
					],
					"fnServerData" : function(AvUrl, AvData, AvResponse){
						AvData.push({"name":"jnsPermintaan", "value":param});
						$.ajax({
							type : "POST",
							url : AvUrl,
							dataType : "JSON",
							data : AvData,
							success : AvResponse
						});
					},
					"fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
						$("td:eq(9)",AvRow).html("<button class='btn btn-md btn-flat btn-warning' disabled onclick=modalEditTransaksiPengambilanCetak('"+AvData["id"]+"','"+AvData["jns_permintaan"]+"') disabled>Ubah</button>"+
																		 "<button class='btn btn-md btn-flat btn-danger' disabled disabled onclick=deleteAndRestorePengembalianPotong('"+AvData["id"]+"','TRUE')>Hapus</button>");
					}
				});
			}

			function datatablesApproveHasilExtruder(){
				$("#tableApproveHasilExtruder").dataTable().fnDestroy();
				$("#tableApproveHasilExtruder").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"scrollX" : "100%",
					"sPaginationType" : "full_numbers",
					"sAjaxSource" : "<?php echo base_url('_gudangroll/main/getHasilExtruder') ?>",
					"columns" : [
						{"data":"tgl_transaksi", "name":"TGR.tgl_transaksi"},
						{"data":"tebal", "name":"RE.tebal"},
						{"data":"hasil_ukuran", "name":"THE.hasil_ukuran"},
						{"data":"panjang", "name":"THE.panjang"},
						{"data":"warna_plastik", "name":"THE.warna_plastik"},
						{"data":"berat", "name":"TGR.berat"},
						{"data":"bobin", "name":"TGR.bobin"},
						{"data":"payung", "name":"TGR.payung"},
						{"data":"payung_kuning", "name":"TGR.payung_kuning"},
						{"data":"shift", "name":"TGR.shift"},
						{"data":"merek", "name":"THE.merek"},
						{"data":"id", "name":"TGR.kd_gd_roll"}
					],
					"fnServerData" : function(AvUrl, AvData, AvResponse){
						//AvData.push({"name":"jnsPermintaan", "value":param});
						$.ajax({
							type : "POST",
							url : AvUrl,
							dataType : "JSON",
							data : AvData,
							success : AvResponse
						});
					},
					"fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
						$("td:eq(1)",AvRow).html(AvData["tebal"]+"<label class='text-blue'>("+AvData["kd_gd_roll"]+")</label>");
						$("td:eq(11)",AvRow).html("<button class='btn btn-md btn-flat btn-warning')>Ubah</button>"+
																		  "<button class='btn btn-md btn-flat btn-danger')>Hapus</button>");
					}
				});
			}

			function datatablesApproveHasilCetak(){
				$("#tableApproveHasilCetak").dataTable().fnDestroy();
				$("#tableApproveHasilCetak").dataTable({
					// "fixedHeader" : true,
					"autoWidth" : false,
					"ordering" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"sPaginationType" : "full_numbers",
					"sAjaxSource" : "<?php echo base_url('_gudangroll/main/getHasilCetak') ?>",
					"columns" : [
						{"data":"ukuran", "name":"GR.ukuran"},
						{"data":"merek", "name":"GR.merek"},
						{"data":"warna_plastik", "name":"GR.warna_plastik"},
						{"data":"berat", "name":"TGR.berat"},
						{"data":"bobin", "name":"TGR.bobin"},
						{"data":"payung", "name":"TGR.payung"},
						{"data":"payung_kuning", "name":"TGR.payung_kuning"},
						{"data":"tgl_transaksi", "name":"TGR.tgl_transaksi"},
						{"data":"keterangan_history", "name":"TGR.keterangan_history"},
						{"data":"id", "name":"TGR.id"}
					],
					"fnServerData" : function(AvUrl, AvData, AvResponse){
						// AvData.push({"name":"jnsPermintaan", "value":param});
						$.ajax({
							type : "POST",
							url : AvUrl,
							dataType : "JSON",
							data : AvData,
							success : AvResponse
						});
					},
					"fnRowCallback" : function(AvRow, AvData, AvDisplayIndex, AvDisplayIndexFull){
						$("td:eq(9)",AvRow).html("<button class='btn btn-md btn-flat btn-warning' onclick=modalEditTransaksiPengembalianPotong('"+AvData["id"]+"','"+AvData["jns_permintaan"]+"') disabled>Ubah</button>"+
																		 "<button class='btn btn-md btn-flat btn-danger' onclick=deleteAndRestorePengembalianPotong('"+AvData["id"]+"','TRUE') disabled>Hapus</button>");
					}
				});
			}

			function tableListDataKartuStok(param1, param2, param3){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_gudangroll/main/getDataKartuStok'); ?>",
					dataType : "JSON",
					data : {
						tglAwal : param1,
						tglAkhir : param2,
						jnsPermintaan : param3
					},
					success : function(response){
						var kdGdRoll = "";
						var saldoAwal = 0;
						var totalMasukBeratPerPeriodeBagian = 0;
						var totalMasukBeratPerPeriode = 0;
						var totalKeluarBeratPerPeriode = 0;
						$("#tableDataKartuStok > tbody > tr").empty();
						$.each(response.dataStokMaster, function(AvIndex, AvValue){
							var saldoAkhir = 0;
							kdGdRoll = AvValue.kd_gd_roll;
							$.each(response.saldoAwal, function(AvIndex2, AvValue2){
								if(AvValue2.kd_gd_roll == kdGdRoll){
									saldoAwal = AvValue2.saldoAwalBerat;
									saldoAkhir += parseFloat(saldoAwal);
									return false;
								}else{
									saldoAwal = 0;
								}
							});

							$.each(response.totalPerPeriode, function(AvIndex2, AvValue2){
								if(AvValue2.kd_gd_roll == kdGdRoll){
									totalMasukBeratPerPeriode = AvValue2.totalMasukBeratPerPeriode;
									totalKeluarBeratPerPeriode = AvValue2.totalKeluarBeratPerPeriode;
									saldoAkhir += parseFloat(totalMasukBeratPerPeriode);
									saldoAkhir -= parseFloat(totalKeluarBeratPerPeriode);
									return false;
								}else{
									totalMasukBeratPerPeriode = 0;
									totalKeluarBeratPerPeriode = 0;
								}
							});

							$.each(response.totalPerPeriodeBagian, function(AvIndex2, AvValue2){
								if(AvValue2.kd_gd_roll == kdGdRoll){
									totalMasukBeratPerPeriodeBagian = AvValue2.totalMasukBeratPerPeriodeBagian;
									saldoAkhir += parseFloat(totalMasukBeratPerPeriodeBagian)
									return false;
								}else{
									totalMasukBeratPerPeriodeBagian=0;
								}
							});
							$("#tableDataKartuStok > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+ AvValue.nm_barang +"</td>"+
									"<td>"+ parseFloat(AvValue.stok).toLocaleString() +"</td>"+
									"<td>"+ parseFloat(saldoAwal).toLocaleString() +"</td>"+
									"<td>"+ parseFloat(totalMasukBeratPerPeriodeBagian).toLocaleString() +"</td>"+
									"<td>"+ parseFloat(totalMasukBeratPerPeriode).toLocaleString() +"</td>"+
									"<td>"+ parseFloat(totalKeluarBeratPerPeriode).toLocaleString() +"</td>"+
									"<td>"+ parseFloat(saldoAkhir).toLocaleString() +"</td>"+
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

			function tableListDataKartuStokSort(param1, param2, param3){
				var stokMaster = $("#cmbStokMaster").val();
				var stokAwal = $("#cmbStokAwal").val();
				var stokAkhir = $("#cmbStokAkhir").val();

				if(stokMaster=="" && stokAwal=="" && stokAkhir==""){
					tableListDataKartuStok(param1, param2, param3);
				}else{
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('_gudangroll/main/getDataKartuStokSort'); ?>",
						dataType : "JSON",
						data : {
							tglAwal : param1,
							tglAkhir : param2,
							jnsPermintaan : param3,
							stokMaster : stokMaster,
							stokAwal : stokAwal,
							stokAkhir : stokAkhir
						},
						success : function(response){
							$("#tableDataKartuStok > tbody > tr").empty();
							$.each(response.saldoAkhir, function(AvIndex, AvValue){
								$("#tableDataKartuStok > tbody:last-child").append(
								"<tr>"+
									"<td>"+ ++AvIndex +"</td>"+
									"<td>"+ AvValue.nm_barang +"</td>"+
									"<td>"+ parseFloat(AvValue.stok).toLocaleString() +"</td>"+
									"<td>"+ parseFloat(AvValue.saldoAwalBerat).toLocaleString() +"</td>"+
									"<td>"+ parseFloat(AvValue.totalMasukBeratPerPeriodeBagian).toLocaleString() +"</td>"+
									"<td>"+ parseFloat(AvValue.totalMasukBeratPerPeriode).toLocaleString() +"</td>"+
									"<td>"+ parseFloat(AvValue.totalKeluarBeratPerPeriode).toLocaleString() +"</td>"+
									"<td>"+ parseFloat(AvValue.saldoAkhir).toLocaleString() +"</td>"+
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

			function tableListCetakDataKartuStok(param1, param2, param3){
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('_gudangroll/main/getCetakKartuStok'); ?>",
					dataType : "JSON",
					data : {
						tglAwal : param1,
						tglAkhir : param2,
						kdGdRoll : param3
					},
					success : function(response){
						var totalJumlahMasukBerat = 0;
						var totalJumlahMasukBobin = 0;
						var totalJumlahMasukPayung = 0;
						var totalJumlahMasukPayungKuning = 0;

						var totalJumlahKeluarBerat = 0;
						var totalJumlahKeluarBobin = 0;
						var totalJumlahKeluarPayung = 0;
						var totalJumlahKeluarPayungKuning = 0;
						$("#tableDataKartuStok > tbody > tr").empty();
						$.each(response, function(AvIndex, AvValue){
							totalJumlahMasukBerat += parseFloat(AvValue.beratMasuk);
							totalJumlahMasukBobin += parseFloat(AvValue.bobinMasuk);
							totalJumlahMasukPayung += parseFloat(AvValue.payungMasuk);
							totalJumlahMasukPayungKuning += parseFloat(AvValue.payungKuningMasuk);

							totalJumlahKeluarBerat += parseFloat(AvValue.beratKeluar);
							totalJumlahKeluarBobin += parseFloat(AvValue.bobinKeluar);
							totalJumlahKeluarPayung += parseFloat(AvValue.payungKeluar);
							totalJumlahKeluarPayungKuning += parseFloat(AvValue.payungKuningKeluar);

							$("#tableDataKartuStok > tbody:last-child").append(
								"<tr>"+
									"<td>"+AvValue.tgl_transaksi+"</td>"+
									"<td>"+AvValue.keterangan_history+"</td>"+
									"<td>"+parseFloat(AvValue.beratMasuk).toLocaleString()+"</td>"+
									"<td>"+parseFloat(AvValue.bobinMasuk).toLocaleString()+"</td>"+
									"<td>"+parseFloat(AvValue.payungMasuk).toLocaleString()+"</td>"+
									"<td>"+parseFloat(AvValue.payungKuningMasuk).toLocaleString()+"</td>"+
									"<td>"+parseFloat(AvValue.beratKeluar).toLocaleString()+"</td>"+
									"<td>"+parseFloat(AvValue.bobinKeluar).toLocaleString()+"</td>"+
									"<td>"+parseFloat(AvValue.payungKeluar).toLocaleString()+"</td>"+
									"<td>"+parseFloat(AvValue.payungKuningKeluar).toLocaleString()+"</td>"+
									"<td>"+""+"</td>"+
									"<td>"+""+"</td>"+
									"<td>"+""+"</td>"+
									"<td>"+""+"</td>"+
									"<td>"+""+"</td>"+
									"<td>"+""+"</td>"+
									"<td>"+""+"</td>"+
									"<td>"+""+"</td>"+
								"</tr>"
							);
						});

						$("#totalJumlahMasukBerat").text(totalJumlahMasukBerat.toLocaleString());
						$("#totalJumlahMasukBobin").text(totalJumlahMasukBobin.toLocaleString());
						$("#totalJumlahMasukPayung").text(totalJumlahMasukPayung.toLocaleString());
						$("#totalJumlahMasukPayungKuning").text(totalJumlahMasukPayungKuning.toLocaleString());

						$("#totalJumlahKeluarBerat").text(totalJumlahKeluarBerat.toLocaleString());
						$("#totalJumlahKeluarBobin").text(totalJumlahKeluarBobin.toLocaleString());
						$("#totalJumlahKeluarPayung").text(totalJumlahKeluarPayung.toLocaleString());
						$("#totalJumlahKeluarPayungKuning").text(totalJumlahKeluarPayungKuning.toLocaleString());
					}
				});
			}
			//============================================DATATABLE METHOD (Finish)============================================//

			//============================================UNSPECIFIED METHOD (Start)============================================//
			function getGudangRoll(param){
				if(param.value=="" || param.value=="POLOS_CETAK"){
					$("#cmbUkuran").select2();
					$("#cmbUkuran").select2("destroy");
					$("#cmbUkuran").empty();
				}else{
					var jnsBarang1 = param.value;
					$("#cmbUkuran").select2({
						placeholder : "Pilih Roll ("+jnsBarang1+")",
						width : "100%",
						cache:true,
						allowClear:true,
						ajax:{
							url : "<?php echo base_url(); ?>_gudangroll/main/getComboBoxValueGudangRoll/"+jnsBarang1,
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
				}
			}

			function numberMasking(){
				$(".number").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 3,autoGroup: true});
				$(".numberFive").inputmask("decimal",{rightAlign: false,radixPoint: ".",groupSeparator: ",",digits: 5,autoGroup: true});
			}

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
					if(merek.indexOf("PON") > 0 || ketBarang.indexOf("PON") > 0 || ketMerek.indexOf("PON") > 0 || panjangTemp.indexOf("PON") > 0 ){
						var arrPanjangPlastik = arrUkuran[0].replace(/ /g, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
											 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
											 }else{
												 var TPanjangPlastik = arrUkuran[0];
											 }
											 break;

						 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
												if(arrPanjangPlastik[1] > 1){
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
												}else{
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
												}
											}else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
												 if(arrPanjangPlastik[1] > 1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
												 }
											 }else{
												 var TPanjangPlastik = arrUkuran[0];
											 }
											 break;
							default: var TPanjangPlastik = arrUkuran[0]; break;
						}
					}else{
						if(arrUkuran[0].replace(/,/g, ".").replace(/ /g, "").indexOf("+") != -1){
							var TPanjangPlastik = 0;
							var arrPanjang = arrUkuran[0].replace(/,/g, ".").replace(/ /g, "").split("+");
							for (var i = 0; i < arrPanjang.length; i++) {
								TPanjangPlastik += arrPanjang[i];
							}
						}else{
							var TPanjangPlastik = arrUkuran[0];
						}
					}
					if(parseFloat(TPanjangPlastik) < 6){
						var rumusRollPayung = 5000;
						var rumusRollPayungKuning = 4000;
					}else if(parseFloat(TPanjangPlastik) >=6 && parseFloat(TPanjangPlastik) <=40){
						var rumusRollPayung = 6000;
						var rumusRollPayungKuning = 4000;
					}else{
						var rumusRollPayung = 7000;
						var rumusRollPayungKuning = 5000;
					}
					var jumlahPayung = parseFloat($("#txtJumlahPayung_PKP").val().replace(/,/g,""));
					var jumlahPayungKuning = parseFloat($("#txtJumlahPayungKuning_PKP").val().replace(/,/g,""));
					var rollPipa = (jumlahPayung*rumusRollPayung) + (jumlahPayungKuning*rumusRollPayungKuning);
				}else if(jenisPipa == "BOBIN"){
					var ketMerek = $("#ketMerek").val().toUpperCase();
					var ketBarang = $("#ketBarang").val().toUpperCase();
					var merek = $("#txtMerek").val().toUpperCase();
					var arrUkuran = $("input[name='txtUkuran']").val().replace(/ /g,"").split("x");

					var doubleSingle = $("#txtDoubleSingle").val().replace(/,/g, "");
					var jumlahBobin = $("#txtBanyaknyaPipa").val().replace(/,/g, "");
					var rumusRoll = $("#txtRumus").val().replace(/,/g, "");

					var panjangTemp = arrUkuran[0].toUpperCase();
					if(merek.indexOf("PON") > 0 || ketBarang.indexOf("PON") > 0 || ketMerek.indexOf("PON") > 0 || panjangTemp.indexOf("PON") > 0 ){
						var arrPanjangPlastik = arrUkuran[0].replace(/ /g, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
											 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
											 }else{
												 var TPanjangPlastik = arrUkuran[0];
											 }
											 break;

						 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
												if(arrPanjangPlastik[1] > 1){
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
												}else{
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
												}
											}else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
												 if(arrPanjangPlastik[1] > 1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
												 }
											 }else{
												 var TPanjangPlastik = arrUkuran[0];
											 }
											 break;
							default: var TPanjangPlastik = arrUkuran[0]; break;
						}
					}else{
						if(arrUkuran[0].replace(/,/g, ".").replace(/ /g, "").indexOf("+") != -1){
							var TPanjangPlastik = 0;
							var arrPanjang = arrUkuran[0].replace(/,/g, ".").replace(/ /g, "").split("+");
							for (var i = 0; i < arrPanjang.length; i++) {
								TPanjangPlastik += arrPanjang[i];
							}
						}else{
							var TPanjangPlastik = arrUkuran[0];
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
					if(merek.indexOf("PON") > 0 || ketBarang.indexOf("PON") > 0 || ketMerek.indexOf("PON") > 0 || panjangTemp.indexOf("PON") > 0 ){
						var arrPanjangPlastik = arrUkuran[0].replace(/ /g, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
											 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
											 }else{
												 var TPanjangPlastik = arrUkuran[0];
											 }
											 break;

						 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
												if(arrPanjangPlastik[1] > 1){
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
												}else{
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
												}
											}else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
												 if(arrPanjangPlastik[1] > 1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
												 }
											 }else{
												 var TPanjangPlastik = arrUkuran[0];
											 }
											 break;
							default: var TPanjangPlastik = arrUkuran[0]; break;
						}
					}else{
						if(arrUkuran[0].replace(/,/g, ".").replace(/ /g, "").indexOf("+") != -1){
							var TPanjangPlastik = 0;
							var arrPanjang = arrUkuran[0].replace(/,/g, ".").replace(/ /g, "").split("+");
							for (var i = 0; i < arrPanjang.length; i++) {
								TPanjangPlastik += arrPanjang[i];
							}
						}else{
							var TPanjangPlastik = arrUkuran[0];
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
					if(merek.indexOf("PON") > 0 || ketBarang.indexOf("PON") > 0 || ketMerek.indexOf("PON") > 0 || panjangTemp.indexOf("PON") > 0 ){
						var arrPanjangPlastik = arrUkuran[0].replace(/ /g, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
											 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
											 }else{
												 var TPanjangPlastik = arrUkuran[0];
											 }
											 break;

						 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
												if(arrPanjangPlastik[1] > 1){
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
												}else{
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
												}
											}else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
												 if(arrPanjangPlastik[1] > 1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
												 }
											 }else{
												 var TPanjangPlastik = arrUkuran[0];
											 }
											 break;
							default: var TPanjangPlastik = arrUkuran[0]; break;
						}
					}else{
						if(arrUkuran[0].replace(/,/g, ".").replace(/ /g, "").indexOf("+") != -1){
							var TPanjangPlastik = 0;
							var arrPanjang = arrUkuran[0].replace(/,/g, ".").replace(/ /g, "").split("+");
							for (var i = 0; i < arrPanjang.length; i++) {
								TPanjangPlastik += arrPanjang[i];
							}
						}else{
							var TPanjangPlastik = arrUkuran[0];
						}
					}
					if(parseFloat(TPanjangPlastik) <= 40){
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
					if(merek.indexOf("PON") > 0 || ketBarang.indexOf("PON") > 0 || ketMerek.indexOf("PON") > 0 || panjangTemp.indexOf("PON") > 0 ){
						var arrPanjangPlastik = arrUkuran[0].replace(/ /g, "").replace(/,/g,".").split("+");
						switch (arrPanjangPlastik.length) {
							case 2 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5;
											 }else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
												 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + 5.5;
											 }else{
												 var TPanjangPlastik = arrUkuran[0];
											 }
											 break;

						 case 3 : if(parseFloat(arrPanjangPlastik[0]) >= 20 && parseFloat(arrPanjangPlastik[0]) < 26.5){
												if(arrPanjangPlastik[1] > 1){
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5;
												}else{
													var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5;
												}
											}else if(parseFloat(arrPanjangPlastik[0]) >= 26.5){
												 if(arrPanjangPlastik[1] > 1){
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[1]) + 5.5;
												 }else{
													 var TPanjangPlastik = parseFloat(arrPanjangPlastik[0]) + parseFloat(arrPanjangPlastik[2]) + 5.5;
												 }
											 }else{
												 var TPanjangPlastik = arrUkuran[0];
											 }
											 break;
							default: var TPanjangPlastik = arrUkuran[0]; break;
						}
					}else{
						if(arrUkuran[0].replace(/,/g, ".").replace(/ /g, "").indexOf("+") != -1){
							var TPanjangPlastik = 0;
							var arrPanjang = arrUkuran[0].replace(/,/g, ".").replace(/ /g, "").split("+");
							for (var i = 0; i < arrPanjang.length; i++) {
								TPanjangPlastik += arrPanjang[i];
							}
						}else{
							var TPanjangPlastik = arrUkuran[0];
						}
					}
					if(parseFloat(TPanjangPlastik) <= 40){
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
					var beratPengambilan = (parseFloat($("#txtBeratPengambilan").val().replace(/,| /g,""))*1000.0);
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

			function alertPermintaanRoll(param){
				$.ajax({
					type : "POST",
					url  : "<?php echo site_url('_gudangroll/main/countPermintaanRoll'); ?>",
					data : {jenis:param},
					success:function(response){
						if (response>0) {
							$("#alertPermintaanRoll"+param+"").show();
						}else{
							$("#alertPermintaanRoll"+param+"").hide();
						}
					}
				});
			}

			function alertHasilCetak(){
				$.ajax({
					type : "POST",
					url  : "<?php site_url('_gudangroll/main/countHasilCetak'); ?>",
					success:function(response){
						if ($.trim(response)==="0") {
							$("#alertHasilCetak").hide();
						}else{
							$("#alertHasilCetak").show();
						}
					}
				});
			}

			function alertHasilExtruder(){
				$.ajax({
					type : "POST",
					url  : "<?php echo site_url('_gudangroll/main/countHasilExtruder') ?>",
					success:function(response){
						if ($.trim(response)==="0") {
							$("#alertHasilExtruder").hide();
						}else{
							$("#alertHasilExtruder").show();
						}
					}
				});
			}
			//============================================UNSPECIFIED METHOD (Finish)============================================//
		</script>
<!--===============================================General Function (Finish) ===============================================-->

	</body>
</html>
