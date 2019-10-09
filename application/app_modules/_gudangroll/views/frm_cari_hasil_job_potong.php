<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?></h1>
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <table class="table table-responsive">
            <tr>
              <td width="18%">
                <div class="input-group date">
                  <input type="text" id="txtTglAwal" class="form-control" placeholder="Pilih Tanggal Awal">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </td>
              <td width="18%">
                <div class="input-group date">
                  <input type="text" id="txtTglAkhir" class="form-control" placeholder="Pilih Tanggal Akhir">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </td>
              <td width="17%">
                <select class="form-control" id="cmbJenisBarang" onchange="getGudangRoll(this);">
                  <option value="">--Pilih Jenis Barang--</option>
                  <option value="POLOS">POLOS</option>
                  <option value="CETAK">CETAK</option>
                  <option value="POLOS_CETAK">POLOS & CETAK</option>
                </select>
              </td>
              <td>
                <select class="form-control" id="cmbUkuran">

                </select>
              </td>
              <td width="5%">
                <button type="button" id="btnLihatHasilJobPotong" class="btn btn-md btn-flat btn-success" onclick="searchCariHasilJob();"><i class="fa fa-search"></i> Cari Hasil</button>
              </td>
            </tr>
          </table>
        </div>

        <div class="col-md-12" style="overflow-x : scroll; max-height:720px; overflow-y:scroll;">
          <table class="table table-responsive table-striped table-bordered" id="tableListCariHasilJob">
            <thead style="background-color:#00a65a;">
              <th style="vertical-align:middle;">No.</th>
              <th style="vertical-align:middle;">Tanggal</th>
              <th style="vertical-align:middle;">Customer</th>
              <th style="vertical-align:middle;">Ukuran</th>
              <th style="vertical-align:middle;">Permintaan</th>
              <th style="vertical-align:middle;">Warna</th>
              <th style="vertical-align:middle;">Jml. Selesai</th>
              <th style="vertical-align:middle;">Merek</th>
              <th style="vertical-align:middle;">Brt. Pengambilan</th>
              <th style="vertical-align:middle;">Payung</th>
              <th style="vertical-align:middle;">Payung Kuning</th>
              <th style="vertical-align:middle;">Bobin</th>
              <th style="vertical-align:middle;">Sisa</th>
              <th style="vertical-align:middle;">Sisa Payung</th>
              <th style="vertical-align:middle;">Sisa Payung Kuning</th>
              <th style="vertical-align:middle;">Sisa Bobin</th>
              <th style="vertical-align:middle;">Apal</th>
              <th style="vertical-align:middle;">Pipa</th>
              <th style="vertical-align:middle;">Berat Bersih</th>
              <th style="vertical-align:middle;">Plus/Minus</th>
              <th style="vertical-align:middle;">Persentase</th>
              <th style="vertical-align:middle;">Action</th>
            </thead>

            <tbody>
            </tbody>

            <tfoot style="background-color:#00c0ef;">
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th>Total</th>
              <th id="thTotalJumlahSelesai">0</th>
              <th></th>
              <th id="thTotalJumlahBrtPengambilan">0,0</th>
              <th id="thTotalJumlahPayung">0</th>
              <th id="thTotalJumlahPayungKuning">0</th>
              <th id="thTotalJumlahBobin">0</th>
              <th id="thTotalJumlahSisa">0,0</th>
              <th id="thTotalJumlahSisaPayung">0</th>
              <th id="thTotalJumlahSisaPayungKuning">0</th>
              <th id="thTotalJumlahSisaBobin">0</th>
              <th id="thTotalJumlahApal">0,0</th>
              <th id="thTotalJumlahPipa">0</th>
              <th id="thTotalJumlahBeratBersih">0</th>
              <th id="thTotalJumlahPlusMinus">0</th>
              <th id="thTotalPersentase">0,0</th>
              <th></th>
            </tfoot>
          </table>
        </div>
      </div>
    </section>

</div>
