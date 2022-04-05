<div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Edit Barang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <?php 
                //pesan form kosong
                echo validation_errors(' <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i>','</h5></div>');
                 //pesan kesalahan gagal upload gambar barang

                 if (isset($error_upload)) {
                  echo'<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i>'.$error_upload.'</h5></div>';
                 }

                
                
                echo form_open_multipart('barang/edit/'.$barang->id_barang)?>
                <div class="form-group">
                        <label>Nama Barang</label>
                        <input name="nama_barang" class="form-control" placeholder="Input Nama Barang" value="<?=$barang->nama_barang ?>">
                      </div>
                  <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <select name="id_kategori" class="form-control">
                        <option value="<?=$barang->id_kategori ?>"><?=$barang->nama_kategori ?></option>
                          <?php foreach ($kategori as $key => $value) { ?>
                            <option value="<?=$value->id_kategori ?>"><?=$value->nama_kategori ?></option>
                         <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                    <div class="form-group">
                        <label>Harga Barang</label>
                        <input name="harga" class="form-control" placeholder="Input Harga Barang" value="<?=$barang->harga ?>">
                      </div>
                    </div>
                    <div class="col-sm-4">
                    <div class="form-group">
                        <label>Berat Barang(Gram(Gr))</label>
                        <input type="number"name="berat" class="form-control"min="0" placeholder="Input Harga Barang" value="<?=$barang->berat ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                        <label>Deskripsi Barang</label>
                        <textarea name="deskripsi" class="form-control" rows="5"placeholder="Input Deskripsi Barang"><?=$barang->deskripsi  ?></textarea>
                      </div>
                      <div class="row">
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Gambar Gambar</label>
                        <input type="file" name="gambar"  class="form-control"id="preview_gambar" >
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <img src="<?= base_url('assets/gambar/'.$barang->gambar )?>"id="gambar_load" width="200px">
                      </div>
                    </div>
                  </div> 
                      <div class="form-group">
                        <label>Stok Barang</label>
                        <input name="stok_barang" class="form-control" placeholder="Input Stok Barang" value="<?=$barang->stok_barang  ?>">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm ">Simpan</button>
                        <a href="<?=base_url('barang') ?>" class="btn btn-warning btn-sm ">Kembali</a>
                      </div>



                <?php echo form_close()?>
        </div>
    </div>
</div>
<script>

  function reviewGambar(input){
if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload=function(e){
    $('#gambar_load').attr('src',e.target.result);
  }
  reader.readAsDataURL(input.files[0]);
  
    }
}
$("#preview_gambar").change(function(){
reviewGambar(this);
});

</script>