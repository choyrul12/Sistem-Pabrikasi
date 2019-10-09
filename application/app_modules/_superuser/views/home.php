<section class="content-wrapper" style=" padding-top: 5%; padding-right: 5%; padding-left: 5%;">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <?php
          $arrBgBox = array("bg-aqua","bg-green","bg-blue","bg-navy","bg-maroon","bg-yellow","bg-gray","bg-red","bg-purple","bg-teal");
        ?>
        <div class="col-lg-3 col-xs-6">
         <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
           <div class="inner">
             <h3>Marketing</h3>
             <p></p>
           </div>
           <div class="icon">
             <i class="ion ion-ios-paper"></i>
           </div>
           <a href="<?php echo base_url(); ?>_marketing/main" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
         </div>
       </div>

       <div class="col-lg-3 col-xs-6">
        <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
          <div class="inner">
            <h3>Cabang</h3>
            <p></p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-paper"></i>
          </div>
          <a href="<?php echo base_url(); ?>_cabang/main" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>PPIC</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="<?php echo base_url(); ?>_ppic/main" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>Pengiriman</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="<?php echo base_url(); ?>_pengiriman/main" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>Acounting</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="<?php echo base_url('_accounting/main'); ?>" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>Gd. Bahan</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="<?php echo base_url(); ?>_gudangbahan/main" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>Gd. Roll</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="<?php echo base_url(); ?>_gudangroll/main" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>Gd. Hasil</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="<?php echo base_url(); ?>_gudanghasil/main" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

         <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>Potong</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="<?php echo base_url(); ?>_cutting/main" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>Extruder</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="<?php echo base_url(); ?>_extruder/main" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

         <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>Cetak</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="<?php echo base_url('_cetak/main'); ?>" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

         <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>Sablon</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="<?php echo base_url(); ?>_sablon/main" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>Purchasing</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="<?php echo base_url(); ?>_purchasing/main" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>Pajak</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="<?php echo base_url(); ?>_pajak/main" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

         <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $arrBgBox[array_rand($arrBgBox,1)]; ?>" style="height: 110px;">
            <div class="inner">
              <h3>Lock</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-locked-outline"></i>
            </div>
            <a href="<?php echo base_url('_locking/main'); ?>" target="_blank" class="small-box-footer" style="padding: 10px">ENTRY  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>
      <!-- /.row (main row) -->

    </section>
