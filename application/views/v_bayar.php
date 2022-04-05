<div class="row">
<div class="col-sm-6">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">No Rekening Beli Kuy</h3>
              </div>
            <div class="card-body">
                    <p> <b> Silahkan Transfer Uang  Ke No Rekening Kami  dengan Jumlah </b><h2 class="text-danger">RP <?=$pesanan->total_bayar?></h2></p> <br>
                     <table class="table">
                         <tr>
                             <th>Bank</th>
                             <th>No Rekening</th>
                             <th>Atas Nama</th>

                         </tr>
                       <?php foreach ($rekening as $key => $value){?>
                        <tr>
                             <td><b><?=$value->nama_bank?></b></td>
                             <td><b><?=$value->no_rekening?></b></td>
                             <td><b><?=$value->atas_nama?></b></td>
                            
                         </tr>
                       <?php } ?>


                     </table>
        </div>
    </div>  
</div>
<div class="col-sm-6">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Bukti Pembayaran</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
              echo form_open_multipart('pesanan_saya/bayar/'.$pesanan->id_transaksi);
               ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Atas Nama</label>
                    <input class="form-control" name="atas_nama" placeholder="Atas Nama"required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Bank</label>
                    <input class="form-control" name="nama_bank" placeholder="Nama Bank"required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">No Rekening</label>
                    <input class="form-control" name="no_rekening" placeholder="No Rekening Anda"required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputFile">Bukti Pembayaran</label>
                        <input type="file"name="bukti_bayar" class="form-control" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="<?=base_url('pesanan_saya')?>" class="btn btn-dark">Kembali</a>
                </div>
          <?php echo 
          form_close();
           ?>
            </div>
        </div>
</div>