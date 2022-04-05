 <!-- Default box -->
 <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
            <h3 class="d-inline-block d-sm-none"><?=$barang->nama_barang ?></h3>
              <div class="col-10">
              <img src="<?= base_url('assets/gambar/'.$barang->gambar) ?>"class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="<?= base_url('assets/gambar/'.$barang->gambar) ?>" alt="Product Image"></div>
                <?php foreach ($gambar as $key =>$value) { ?>
                    <div class="product-image-thumb" ><img src="<?= base_url('assets/gambarbarang/'.$value->gambar) ?>" alt="Product Image"></div>
                <?php }?>
              </div>
            </div>
            <div class="col-12 col-sm-6">
            <p class="text-muted text-sm"><h4>Nama Barang : <?= $barang->nama_barang ?></h4>  </p>
              <hr>
              <p class="text-muted text-sm"><h4>Stok Barang : <?= $barang->stok_barang ?></h4>  </p>
              <hr>
              <p><?=$barang->deskripsi ?></p>
              <hr>
              <div class="bg-white py-2 px-3 mt-4">
                <h2 class="mb-0">
                <h2><span class="badge bg-primary" >Rp. <?=number_format( $barang->harga,0,'.','.') ?></span></h2>
                </h2>
              </div>
              <hr>
              <?php 
             
             if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
              </div>
              <?php endif; 
           echo form_open('belanja/add');
         
           echo form_hidden('id',$barang->id_barang);
           echo form_hidden('price',$barang->harga);
           echo form_hidden('name',$barang->nama_barang);
           echo form_hidden('redirect_page',str_replace('index.php/','',current_url()));
           
               ?>
              <div class="mt-4">
               <div class="row">
               <div class="col-sm-2">
                <input type="number"name="qty" class="form-control" value="1" min="1">
               </div>

                 <div class="col-sm-8">
                 <button type="submit" class="btn btn-primary btn-flat swalDefaultSuccess">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i> 
                  Add to Cart
                </button>
                 </div>
              
               </div>
              </div>
                    
            
         
              <?php 
              echo form_close();
               ?>
               
               <div class="container">
               <?php  
               if ($this->session->flashdata('success')) {
                      echo'<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i>';
                      echo $this->session->flashdata('success');
                      echo'</h5></div>';
                  }
                  
                  ?>
              
              <h3>What do you think about this item?</h3>
              <?php  echo form_open_multipart('barang/addrating/'.$barang->id_barang)?>
            
              
                <label>Rating</label>
                <br>
              <input type="radio" name="rating" value="5">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>

                <br>
                <br>

               <input type="radio" name="rating" value="4">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>

                <br>
                <br>

               <input type="radio" name="rating" value="3">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>    

                <br>
                <br>

               <input type="radio" name="rating" value="2">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>

                <br>
                <br>

               <input type="radio" name="rating" value="1">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span> 


        
                <br>
                <br>
                <label for="comment">Comment : </label>
                <textarea id="komentar" name="komentar" placeholder="Write something.." style="height:200px"></textarea>

                <input type="submit" value="Submit">
          
                <?php echo form_close()?>
               </div>
              
      <!-- /.card -->
<!-- jQuery -->
<script src="<?=base_url()?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>/template/dist/js/demo.js"></script>
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
