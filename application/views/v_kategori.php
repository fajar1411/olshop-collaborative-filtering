<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Kategori</h3>

                <div class="card-tools">
                  <button data-toggle="modal" data-target="#add" type="button" class="btn btn-primary btn-xs"><i class="fas fa-plus"></i>
                  ADD</button>
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
                    <thead class="text text-xl-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        
                        </tr>
                    </thead>
                    <tbody class="text text-xl-center">
                        <?php $no = 1;
                         foreach($kategori as $key => $value){ ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value->nama_kategori ?></td>
                            <td>
                                <button class="btn btn-success btn-sm"data-toggle="modal" data-target="#edit<?= $value->id_kategori?>"><i class="fas fa-pen"></i></button>
                                <button class="btn btn-danger btn-sm"data-toggle="modal" data-target="#delete<?= $value->id_kategori?>"><i class="fas fa-trash"></i></button>
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


           <!-- /.modal Tambah -->
           <div class="modal fade" id="add">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Kategori</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <?php 
             echo form_open('kategori/add');
             
             ?>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text"  name="nama_kategori"class="form-control"placeholder="Nama Kategori" required>
                </div>
                
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
              
            </div>
            <?php 
             echo form_close();
             
             ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

       <!-- /.modal Edit Kategori -->
       <?php foreach($kategori as $key => $value){ ?>
          <div class="modal fade" id="edit<?= $value->id_kategori?>">  
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit kategori</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <?php 
             echo form_open('kategori/edit/'.$value->id_kategori);
             
             ?>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text"  name="nama_kategori"value="<?= $value->nama_kategori?>" class="form-control"placeholder="Nama Kategori" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
              
            </div>
            <?php 
             echo form_close();
             
             ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <?php } ?>


        <!-- /.modal Delete Kategori -->
        <?php foreach($kategori as $key => $value){ ?>
          <div class="modal fade" id="delete<?= $value->id_kategori?>">  
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Delete <?= $value->nama_kategori ?> </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h6>anda yakin untuk menghapus kategori ini??</h6>
           
             

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?=base_url('kategori/delete/'.$value->id_kategori) ?>" class="btn btn-primary">Delete</a>
              
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <?php } ?>