<div class="col-md-12">
            <div class="card card-primary ">
              <div class="card-header">
                <h3 class="card-title">Data Gambar Barang</h3>

                <div class="card-tools">
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <?php  
                  if ($this->session->flashdata('pesan')) {
                      echo'<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i> Success!';
                      echo $this->session->flashdata('pesan');
                      echo'</h5></div>';
                  }
                  
                  ?>
                <table class="table table-bordered" id="example1">
                    <thead class="text text-center">
                        <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Cover</th>
                        <th>Jumlah gambar</th>
                        <th>Action</th>
                        
                        </tr>
                    </thead>
                    <tbody class="text text-xl-center">
                        <?php $no=1;
                         foreach ($gambarbarang as $key => $value) {?>
                            <tr>
                        <td><?=$no++;?></td>
                        <td><?=$value->nama_barang?></td>
                        <td><img src="<?=base_url('assets/gambar/'. $value->gambar)?>" width="100px"></td>
                        <td><span class="bg-primary">
                           <?=$value->total_gambar?>
                    </span></td>
                        <td>
                           <a href="<?=base_url('gambarbarang/add/'.$value->id_barang)?>" class="btn btn-primary btn-sm"><i class="fa fas-plus"></i>ADD Gambar</a>

                        </td>
                        
                        </tr>
                    <?php } ?>
                    
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->  
          </div> 