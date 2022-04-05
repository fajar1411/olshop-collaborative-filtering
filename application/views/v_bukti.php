<div class="row">
<div class="col-sm-6">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">No Rekening Beli Kuy</h3>
              </div>
            <div class="card-body">
                    
                     <table class="table">
                         <tr>
                             
                             <th>Alamat Toko</th>
                             <th>Nama Toko</th>

                         </tr>
                       <?php foreach ($alamat_toko as $key => $value){?>
                        <tr>
                             <td><b><?=$value->alamat_toko?></b></td>
                             <td><b><?=$value->nama_toko?></b></td>
                            
                         </tr>
                       <?php } ?>


                     </table>
        </div>
    </div>  
</div>
<div class="col-sm-6">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Bukti Transfer</h3>
              

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
              echo form_open_multipart('admin/kirim_bukti/'.$pesanan->id_transaksi);
               ?>
                <div class="card-body">
                 
                  
                  <div class="form-group">
                    <label for="exampleInputFile">Bukti Pembayaran</label>
                        <input type="file"name="bukti_debit" class="form-control" required>
                  </div>
                </div>
                <label for="comment">Comment : </label>
                <textarea id="komentar" name="komentar_balasan" placeholder="Write something.." style="height:200px"></textarea>

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="<?=base_url('admin/retur_masuk/')?>" class="btn btn-dark">Kembali</a>
                </div>
          <?php echo 
          form_close();
           ?>
            </div>
        </div>
</div>