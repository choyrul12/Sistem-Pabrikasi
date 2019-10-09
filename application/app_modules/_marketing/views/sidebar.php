<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/dist/img/avatar_2x.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata("fabricationUsername"); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <?php
        foreach ($parentMenu as $arrParentMenu) {
          if($arrParentMenu["Status"]=="Parent"){
      ?>
      <li class="treeview">
        <a href="<?php echo $arrParentMenu['Link']; ?>">
          <i class="<?php echo $arrParentMenu['Icon']; ?>"></i> <span><?php echo $arrParentMenu['Content']; ?></span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <?php
            foreach ($childMenu as $arrChildMenu) {
              if($arrChildMenu["Parent"] == $arrParentMenu["Name"]){
          ?>
          <li><a href="<?php echo base_url().$arrChildMenu['Link']; ?>"><?php echo $arrChildMenu["Content"]; ?></a></li>
            <?php
              }
            }
          ?>
        </ul>
      </li>
      <?php
          }else if($arrParentMenu["Status"]=="Single"){
      ?>
      <li>
        <a href="<?php echo base_url().$arrParentMenu['Link']; ?>">
          <i class="<?php echo $arrParentMenu['Icon']; ?>"></i>
          <span><?php echo $arrParentMenu["Content"]; ?></span>
        </a>
      </li>
      <?php
          }else{
      ?>
      <li>
        <a href="#"><span>Isi Status Pada Array Menu Anda</span></a>
      </li>
      <?php
          }
        }
      ?>
    </ul>
  </section>
</aside>
