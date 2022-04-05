<div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Tambah Barang</h3>
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

                
                
                echo form_open_multipart('barang/add')?>
                <div class="form-group">
                        <label>Nama Barang</label>
                        <input name="nama_barang" class="form-control" placeholder="Input Nama Barang" value="<?=set_value('nama_barang') ?>">
                      </div>
                  <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <select name="id_kategori" class="form-control">
                        <option value="">--Pilih Kategori--</option>
                          <?php foreach ($kategori as $key => $value) { ?>
                            <option value="<?=$value->id_kategori ?>"><?=$value->nama_kategori ?></option>
                         <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                    <div class="form-group">
                        <label>Harga Barang</label>
                        <input name="harga" class="form-control" placeholder="Input Harga Barang" value="<?=set_value('harga') ?>">
                      </div>
                    </div>
                    <div class="col-sm-4">
                    <div class="form-group">
                        <label>Berat Barang(Gram(Gr))</label>
                        <input type="number" name="berat" class="form-control" min="0" placeholder="Input Berat Barang Dalam Gram" value="<?=set_value('berat') ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                        <label>Deskripsi Barang</label>
                        <textarea name="deskripsi" class="form-control" rows="5"placeholder="Input Deskripsi Barang"><?=set_value('deskripsi') ?></textarea>
                      </div>
                      <div class="row">
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Gambar Barang</label>
                        <input type="file" name="gambar"  class="form-control"id="preview_gambar" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <img src="<?= base_url('assets/gambar/no-image.png')?>"id="gambar_load" width="200px">
                      </div>
                    </div>
                  </div> 
                      <div class="form-group">
                        <label>Stok Barang</label>
                        <input name="stok_barang" class="form-control" placeholder="Input Stok Barang" value="<?=set_value('stok_barang') ?>">
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