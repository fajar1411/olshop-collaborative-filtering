<div class="container-fluid">

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo base_url('assets/slider/slider1.jpg') ?>" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
     <img src="<?php echo base_url('assets/slider/slider2.jpg') ?>" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
     <img src="<?php echo base_url('assets/slider/indri.png') ?>" class="d-block w-100" alt="..."width="400" height="400">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">
          <?php foreach($barang as $key => $value) {
          
            ?>
          <div class="col-sm-4">
            
            <?php
            echo form_open('belanja/add');
            echo form_hidden('id',$value->id_barang);
            echo form_hidden('qty',1);
            echo form_hidden('price',$value->harga);
            echo form_hidden('name',$value->nama_barang);
            echo form_hidden('redirect_page',str_replace('index.php/','',current_url()));
            
            ?>

              <div class="card bg-white">
                <div class="card-header text-muted border-bottom-0">
                <h2 class="lead"><b><?= $value->nama_barang ?></b></h2>
                
                
                
                  
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12 text-center">
                      <img src="<?= base_url('assets/gambar/'. $value->gambar)?>"  width="300px" height="300px">
                      </h4>

                      <span class="fa fa-star  <?php if($value->avg_rat >=1){echo 'checked';}?>"></span>
                      <span class="fa fa-star <?php if($value->avg_rat >=2){echo 'checked';}?>"></span>
                      <span class="fa fa-star <?php if($value->avg_rat >=3){echo 'checked';}?>"></span>
                      <span class="fa fa-star <?php if($value->avg_rat >=4){echo 'checked';}?>"></span>
                      <span class="fa fa-star <?php if($value->avg_rat >=5){echo 'checked';}?>"></span>
                    </div>
                    <th>Similarity : <?=  $value->avg_rat ?></th>

                  </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                  <div class="col sm-6">
                  <div class="text-left">
                  
                  <h3><span class="badge bg-primary" >Rp. <?=number_format( $value->harga,0,'.','.') ?></span></h3>

                  <a href="<?= base_url('home/detail_barang/'.$value->id_barang)  ?>" class="btn btn-sm btn-warning btn-block ">
                    <i class="fas fa-comments"></i>
                    </a>
                    </div>
                  </div>
                  <div class="col sm-6">
                  <div class="text-right">
                    <button type="submit" class="btn btn-sm btn-danger btn-block  swalDefaultSuccess">
                      <i class="fas fa-cart-plus"> Tambah </i>
                    </button>
                    <a href="<?= base_url('home/detail_barang/'.$value->id_barang)  ?>" class="btn btn-sm btn-warning btn-block ">
                      <i class="fas fa-eye"></i>
                    </a>
                  </div>
                  </div>
                  </div>
                </div>
              </div>
              <?php echo form_close();?>
            </div> 
          <?php }  ?>
        </div>
    </div>
</div>

<script src="<?=base_url()?>template/plugins/sweetalert2/sweetalert2.min.js"></script>

<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Barang Berhasil Masuk Ke Keranjang Belanja'
      })
    });
  });
    </script>

<script>
$(document).ready(function(){

 
 $(document).on('mouseenter', '.rating', function(){
  var index = $(this).data('index');
  var id_barang = $(this).data('id_barang');
  remove_background(id_barang);
  for(var count = 1; count <= index; count++)
  {
   $('#'+id_barang+'-'+count).css('color', '#ffcc00');
  }
 });

 function remove_background(id_barang)
 {
  for(var count = 1; count <= 5; count++)
  {
   $('#'+id_barang+'-'+count).css('color', '#ccc');
  }
 }

 $(document).on('click', '.rating', function(){
  var index = $(this).data('index');
  var id_barang = $(this).data('id_barang');
  $.ajax({
   url:"<?php echo base_url(); ?>home/insert",
   method:"POST",
   data:{index:index, id_barang:id_barang},
   success:function(data)
   {
    load_data();
    alert("You have rate "+index +" out of 5");
   }
  })
 });

 $(document).on('mouseleave', '.rating', function(){
  var index = $(this).data('index');
  var id_barang = $(this).data('id_barang');
  var rating = $(this).data('rating');
  remove_background(id_barang);
  for(var count = 1; count <= rating; count++)
  {
   $('#'+id_barang+'-'+count).css('color', '#ffcc00');
  }
 });

});

     // Initialize
     $('.ratingbar').rating({
        showCaption:false,
        showClear: false,
        size: 'sm'
      });

</script>
