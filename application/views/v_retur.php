<div class="row">
<div class="col-sm-12">
<?php  
                  if ($this->session->flashdata('pesan')) {
                      echo'<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i> Success!';
                      echo $this->session->flashdata('pesan');
                      echo'</h5></div>';
                  }
                  
                  ?>
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Proses</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Dikirim</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Selesai</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-five-normal-tab" data-toggle="pill" href="#custom-tabs-five-normal" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false">Normal Tab</a>
                  </li>

                 
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                 <!-- /.proses data pesanan -->
                  <table class="table">
                          <tr>
                              <th>No Order</th>
                          
                              <th>Expedisi</th>
                              <th>Total pengembalian</th>
                          </tr>
                          <?php foreach($proses_retur as $key=>$value){?>
                            <tr>
                              <td><?=$value->no_order?></td>
                              <td><?=$value->tgl_order?></td>
                              
                              <td>
                                  <b>Rp <?=$value->total_bayar?></b><br>

                               
                                  <span class="badge badge-dark">Barang sedang proses retur</span><br>
                                  <span class="badge badge-success">sudah diverifikasi</span>
                                
                                
                              </td>
                          </tr>
                        <?php   } ?>
                          
                     </table> 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                  <table class="table">
                          <tr>
                              <th>No Order</th>
                  
                              <th>Total pengembalian</th>
                            
                              <th>Action</th>
                          </tr>
                          <?php foreach($bukti_retur as $key=>$value){?>
                            <tr>
                              <td><?=$value->no_order?></td>
                        
                            
                              <td>
                                  <b>Rp <?=$value->total_bayar?></b><br>

                               
                                  <span class="badge badge-warning">bukti retur</span><br>              
                                  <td><span class="badge badge-dark"><h6><?=$value->no_resi?></h6></span></td>
                              </td>
                              
                            <td>
                            <button class="btn btn-sm btn-warning btn-flat"data-toggle="modal" data-target="#cek<?= $value->id_transaksi ?>">Bukti transfer</button>
                              <button data-toggle="modal" data-target="#diterima<?=$value->id_transaksi?>" class="btn btn-success"> <i class="fas fa-clipboard-check"></i> Di Terima</button></td>
                          </tr>
                        <?php   } ?>
                          
                     </table> 
                </div>
                  <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                  <table class="table">
                          <tr>
                              <th>No Order</th>
                            
                              <th>Total pengembalian</th>
                    
                            
                          </tr>
                          <?php foreach($diterima_refund as $key=>$value){?>
                            <tr>
                              <td><?=$value->no_order?></td>
                           
                              <td>
                                  <b>Rp <?=$value->total_bayar?></b><br>

                               
                                  <?php if($value->status_order==6){?>
                                  <span class="badge badge-danger">sudah terima</span>
                                <?php }else{ ?>
                                  <span class="badge badge-success">belum_upload</span><br>
                                  <span class="badge badge-dark">sudah upload</span>
                                
                                  <?php }?> 
                                  
                                 
                          </td>
                          </tr>
                        <?php   } ?>
                          
                     </table> 
                  </div>
                  
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          </div>

          <?php foreach($bukti_retur as $key=>$value){?>
    <div class="modal fade" id="diterima<?=$value->id_transaksi ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pesanan Diterima</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Apakah uang pengembalian Sudah Di Terima ??
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-thumbs-down"> </i> Tidak</button>
              <a href="<?=base_url('pesanan_saya/diterima_refund/'.$value->id_transaksi)?>"class="btn btn-primary"> <i class="fas fa-thumbs-up"></i> Ya </a>
            </div>
            <?php echo form_close() ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <?php } ?>

      <?php foreach($bukti_retur as $key =>$value){ ?>
          <div class="modal fade" id="cek<?= $value->id_transaksi ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><?= $value->no_order ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <table class="table">
                
                <tr>
                    <th>Komentar</th>
                    <th>:</th>
                    <td><?= $value->komentar_balasan ?></td>
                    
                </tr>
                <tr>
                    <th>Total pengembalian</th>
                    <th>:</th>
                    <td>Rp <?= $value->total_bayar ?></td>
                    
                </tr>
            </table> 
            <img class="img-fluid pad" src="<?=base_url('assets/bukti_debit/'.$value->bukti_debit)  ?>" alt="">

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    <?php }?>

