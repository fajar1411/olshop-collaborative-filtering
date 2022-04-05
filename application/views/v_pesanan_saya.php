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
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Order Barang</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Proses</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Dikirim</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Selesai</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                     <!-- /.data belum bayar -->
                  <table class="table">
                          <tr>
                              <th>No Order</th>
                              <th>Tanggal</th>
                              <th>Expedisi</th>
                              <th>Total Bayar</th>
                              <th>Action</th>
                          </tr>
                          <?php foreach($belum_bayar as $key=>$value){?>
                            <tr>
                              <td><?=$value->no_order?></td>
                              <td><?=$value->tgl_order?></td>
                              <td>
                                 <b><?=$value->expedisi?></b> <br>
                                  Paket : <?=$value->paket?><br>
                                  Ongkir :  <?=$value->ongkir?>
                            </td>
                              <td>
                                  <b>Rp <?=$value->total_bayar?></b><br>

                                 <?php if($value->status_bayar==0){?>
                                  <span class="badge badge-danger">Belum Bayar</span>
                                <?php }else{ ?>
                                  <span class="badge badge-success">Sudah Bayar</span><br>
                                  <span class="badge badge-dark">Tunggu verifikasi</span>
                                
                                  <?php }?>

                              </td>
                              <td>
                              <?php if($value->status_bayar==0){?>
                                    <a href="<?= base_url('pesanan_saya/bayar/'.$value->id_transaksi)?>" class="btn btn-sm  btn-flat btn-primary">Bayar</a> 
                                  <?php }?>

                              
                              </td>
                          </tr>
                        <?php   } ?>
                          
                     </table> 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                 <!-- /.proses data pesanan -->
                  <table class="table">
                          <tr>
                              <th>No Order</th>
                              <th>Tanggal</th>
                              <th>Expedisi</th>
                              <th>Total Bayar</th>
                          </tr>
                          <?php foreach($diproses as $key=>$value){?>
                            <tr>
                              <td><?=$value->no_order?></td>
                              <td><?=$value->tgl_order?></td>
                              <td>
                                 <b><?=$value->expedisi?></b> <br>
                                  Paket :<?=$value->paket?><br>
                                  Ongkir :<?=$value->ongkir?>
                            </td>
                              <td>
                                  <b>Rp <?=$value->total_bayar?></b><br>

                               
                                  <span class="badge badge-dark">Barang Sedang di Kemas</span><br>
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
                              <th>Tanggal</th>
                              <th>Expedisi</th>
                              <th>Total Bayar</th>
                              <th>No Resi</th>
                              <th>Action</th>
                          </tr>
                          <?php foreach($dikirim as $key=>$value){?>
                            <tr>
                              <td><?=$value->no_order?></td>
                              <td><?=$value->tgl_order?></td>
                              <td>
                                 <b><?=$value->expedisi?></b> <br>
                                  Paket :<?=$value->paket?><br>
                                  Ongkir :<?=$value->ongkir?>
                            </td>
                              <td>
                                  <b>Rp <?=$value->total_bayar?></b><br>

                               
                                  <span class="badge badge-warning">Barang Sedang di Kirim</span><br>              
                                  <td><span class="badge badge-dark"><h6><?=$value->no_resi?></h6></span></td>
                              </td>
                            <td><button data-toggle="modal" data-target="#diterima<?=$value->id_transaksi?>" class="btn btn-success"> <i class="fas fa-clipboard-check"></i> Di Terima</button></td>
                          </tr>
                        <?php   } ?>
                          
                     </table> 
                </div>
                  <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                  <table class="table">
                          <tr>
                              <th>No Order</th>
                              <th>Tanggal</th>
                              <th>Expedisi</th>
                              <th>Total Bayar</th>
                              <th>No Resi</th>
                              <th>Action</th>
                            
                          </tr>
                          <?php foreach($diterima as $key=>$value){?>
                            <tr>
                              <td><?=$value->no_order?></td>
                              <td><?=$value->tgl_order?></td>
                              <td>
                                 <b><?=$value->expedisi?></b> <br>
                                  Paket :<?=$value->paket?><br>
                                  Ongkir :<?=$value->ongkir?>
                            </td>
                              <td>
                                  <b>Rp <?=$value->total_bayar?></b><br>

                               
                                  <?php if($value->status_refund==0){?>
                                  <span class="badge badge-danger">tidak retur dan barang sudah diterima oleh pelanggan</span>
                                <?php }else{ ?>
                                  <span class="badge badge-success">Sudah upload bukti retur dan sedang proses</span><br>
                                  <span class="badge badge-dark">Tunggu verifikasi</span>
                                
                                  <?php }?>          
                                  <td><span class="badge badge-dark"><h6><?=$value->no_resi?></h6></span></td>
                          </td>
                          <td>
                              <?php if($value->status_refund==0){?>
                                    <a href="<?= base_url('pesanan_saya/pengembalian/'.$value->id_transaksi)?>" class="btn btn-sm  btn-flat btn-primary">Retur</a> 
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

          <?php foreach($dikirim as $key=>$value){?>
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
              Apakah Pesanan Anda Sudah datang Dan Sudah Di Terima ??
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-thumbs-down"> </i> Tidak</button>
              <a href="<?=base_url('pesanan_saya/diterima/'.$value->id_transaksi)?>"class="btn btn-primary"> <i class="fas fa-thumbs-up"></i> Ya </a>
            </div>
            <?php echo form_close() ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <?php } ?>
