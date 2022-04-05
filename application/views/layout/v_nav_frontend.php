 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="<?= base_url()?>" class="navbar-brand">
      <i><img src="<?php echo base_url('assets/slider/indri.png') ?>"height="100" width="200"></i>
        
      </a>
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


     
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?= base_url()?>" class="nav-link">Home</a>
          </li>

          <?php $kategori = $this->m_home->get_all_data_kategori(); ?>

         

          <?php echo form_open('home/search') ?>
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="keyword">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
      <?php echo form_close() ?>


          <li class="nav-item">
            <a href="<?=base_url('pesanan_saya/retur/') ?>" class="nav-link">history</a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('Barang/recommended/')?>" class="nav-link">rekomendasi</a>
          </li>
      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
        <?php if ($this->session->userdata('email')==""){ ?>
          <a class="nav-link" href="<?=base_url('pelanggan/register')?>">
        <span class="brand-text font-weight-light">Login/Register</span>
        <img src="<?=base_url()?>template/dist/img/user1-128x128.jpg"  alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
      </a>

        <?php }else{?>
            <a class="nav-link" data-toggle="dropdown" href="#">
        <span class="brand-text font-weight-light"><?=$this->session->userdata('nama_pelanggan')?></span>
        <img src="<?=base_url('assets/foto/'.$this->session->userdata('foto'))?>"  class="brand-image img-circle elevation-3"
             style="opacity: .8">
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('pelanggan/akun')?>" class="dropdown-item">
              <i class="fas fa-users mr-2"></i>akun 
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?=base_url('pesanan_saya') ?>" class="dropdown-item">
              <i class="fas fa-cart-plus mr-2"></i>Pesanan Saya
             
            </a>
            
            <div class="dropdown-divider"></div>
            <a href="<?=base_url('pelanggan/logout')?>" class="dropdown-item dropdown-footer">Logout</a>
          </div>
        <?php } ?>
       </li>
       <?php 
        
        $keranjang = $this->cart->contents(); 
        $jml_item = 0; 
          foreach( $keranjang as $key => $value){
            $jml_item = $jml_item + $value['qty'];
          }
        ?>
        <!-- Barang awal-->

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge badge-danger navbar-badge"><?= $jml_item ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <?php if(empty($keranjang)) { ?>
              <a href="#" class="dropdown-item"><p>Keranjang kosong</p> </a>

          <?php  }else{ 
          foreach(  $keranjang as $key => $value) {
               $barang = $this->m_home->detail_barang($value['id']);
               
               ?>
            <a href="#" class="dropdown-item"> 
              <div class="media">
                <img src="<?=base_url('assets/gambar/'.$barang->gambar)?>" alt="User Avatar" class="img-size-50 mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    <?= $value['name'] ?>
                  </h3>
                  <p class="text-sm"><?=$value['qty']?>x Rp <?=number_format($value['price'],0,',','.')?></p>
                  <p class="text-sm text-muted">
                    <i class="fab fa-amazon-pay"></i>
                     Rp <?=$this->cart->format_number($value['subtotal']) ?>
                    </p>
                </div>
              </div>
            </a>
            <div class="dropdown-divider"></div>
        <?php }?>
        <!-- Barang End -->
        <a href="#" class="dropdown-item"> 
              <div class="media">
                <div class="media-body">

                <tr>
                  <td colspan="2"> </td>
                  <td class="right"><strong>Total : </strong></td>
                  <td class="right">Rp <?php echo $this->cart->format_number($this->cart->total()); ?></td>
                </tr>
                </div>
              </div>
            </a>

            <div class="dropdown-divider"></div>
            <a href="<?=base_url('belanja') ?>" class="dropdown-item dropdown-footer">Liat Keranjang</a>
            <div class="dropdown-divider"></div>
            <a href="<?=base_url('belanja/cekout') ?>" class="dropdown-item dropdown-footer">Pembayaran</a>
      
      <?php } ?>
            
          </div>
        </li>
      </ul>
    </div>
  </nav>

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <?= $title ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


   <!-- Main content -->
   <div class="content">
      <div class="container">