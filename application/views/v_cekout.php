<!-- Main content -->
<div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                  <i><img src="<?php echo base_url('assets/slider/BeliKuy.png') ?>"height="30" width="100"></i> Payment
                    <small class="float-right">Date: <?= date('d/m/Y') ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th >Harga</th>
                      <th>Barang</th>
                      <th style="text-align:left" >Total Harga</th>
                      <th  style="text-align:left">Berat</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                         $i = 1;
                         $tot_berat = 0;
                        foreach($this->cart->contents() as $items) { 
                            $barang = $this->m_home->detail_barang($items['id']);
                            $berat = $items['qty'] * $barang->berat;
                            $tot_berat =   $tot_berat + $berat;

                            ?>

                        <tr>
                        <td><?php echo $items['qty']; ?></td>
                        <td style="text-align:left">Rp <?php echo number_format($items['price'],0,',','.'); ?></td>
                        <td><?php echo $items['name']; ?></td>
                        <td style="text-align:left">Rp <?php echo number_format($items['subtotal'],0,',','.'); ?></td>
                        <td style="text-align:left"><?= $berat ?> gr </td>
                            </tr>
                        <?php } ?>
                    
                   
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <?php 
                  echo validation_errors(' <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i>','</h5></div>');
                
                ?>
              <!-- /.row -->
                          <?php
                          echo form_open('belanja/cekout');
                          $no_order= date('Ymd').strtoupper(random_string('alnum',8));
                        
                          ?>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-sm-8 invoice-col">
                  Tujuan
                  <div class="row">
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Provinsi</label>
                        <select name="provinsi" class="form-control"></select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <label>Kota</label>
                      <select name="kota" class="form-control"></select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <label>Expedisi Pengiriman</label>
                      <select name="expedisi" class="form-control"></select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <label>Paket</label>
                      <select name="paket" class="form-control"></select>
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <div class="form-group">
                      <label>Alamat</label>
                          <input type="text"name="alamat" class="form-control"required>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                      <label>Kode Pos</label>
                          <input name="kode_pos" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <label>Nama Penerima</label>
                          <input name="nama_penerima" class="form-control"required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <label>No Handphone Penerima</label>
                          <input name="hp_penerima" class="form-control"required>
                      </div>
                    </div>
                  </div> 
                </div>
                <!-- /.col -->
                <div class="col-4">
                

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Grand total:</th>
                        <th>Rp <?php echo number_format($this->cart->total(),0,',','.'); ?></th>
                      </tr>
                      <tr>
                        <th>Berat:</th>
                        <th><?=  $tot_berat ?> gr</th>
                      </tr>
                      <tr>
                        <th>Ongkir:</th>
                        <th><label id="ongkir"></label></th>
                      </tr>
                      <tr>
                        <th>Total Bayar:</th>
                        <th><label id="total_bayar"></label></th>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Simpan Transaksi -->
                  <input name="no_order"value="<?=$no_order ?>"hidden>
                  <input name="estimasi"hidden>
                  <input name="ongkir"hidden>
                  <input name="berat" value="<?=  $tot_berat ?>"hidden><br>
                  <input name="grand_total" value="<?=  $this->cart->total() ?>"hidden>
                  <input name="total_bayar"hidden>
              <!-- akhir Transaksi -->
               <!-- simpan keterangan Transaksi -->
               <?php
               $i=1; 
              foreach($this->cart->contents() as $items) {
                echo form_hidden("qty".$i++,$items['qty']);
               }
               ?>
                <!-- akhir Transaksi -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="<?=base_url('belanja')?>" class="btn btn-dark"><i class="fas fa-long-arrow-alt-left"></i>Kembali Ke Keranjang</a>
                  <button type="submit" class="btn btn-danger float-right"><i class="fab fa-amazon-pay"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
              <?php echo form_close() ?>
            </div>

            <script>

$(document).ready(function(){
    //Data Provinsi
    $.ajax({
       type:"POST",
        url:"<?= base_url('rajaongkir/provinsi')?>",
        success: function(hasil_provinsi){
            //console.log(hasil_provinsi);
            $("select[name=provinsi]").html(hasil_provinsi);
        }
    });
    //Data Kota
    $("select[name=provinsi]").on("change", function(){
        var id_provinsi_pilihan =$("option:selected",this).attr("id_provinsi");

        $.ajax({
            type:"POST",
            url:"<?= base_url('rajaongkir/kota')?>",
            data : 'id_provinsi='+ id_provinsi_pilihan,
            success : function(hasil_kota){
                $("select[name=kota]").html(hasil_kota);
            }
        });
    });
    $("select[name=kota]").on("change", function(){
        $.ajax({
            type:"POST",
            url:"<?= base_url('rajaongkir/expedisi')?>",
            success : function(hasil_expedisi){
                $("select[name=expedisi]").html(hasil_expedisi);
            }
         });
      });
        //data paket
      $("select[name=expedisi]").on("change", function(){

        var expedisi_terpilih = $("select[name=expedisi]").val()

        //id Kota Tujuan Terpilih
        var id_kota_tujuan_terpilih =$("option:selected","select[name=kota]").attr('id_kota');
        //Ongkir
        var total_berat = <?= $tot_berat ?>;
        
        $.ajax({
            type:"POST",
            url:"<?= base_url('rajaongkir/paket')?>",
            data :'expedisi='+ expedisi_terpilih + '&id_kota='+ id_kota_tujuan_terpilih +'&berat='+total_berat,
            success : function(hasil_paket){
               // console.log(hasil_paket);
               $("select[name=paket]").html(hasil_paket);
            }
         });
      });

      //
      $("select[name=paket]").on("change", function(){
        //data ongkir
        var data_ongkir =$("option:selected",this).attr('ongkir');
        var reverse =  data_ongkir.toString().split('').reverse().join(''),
                rupiah_ongkir = reverse.match(/\d{1,3}/g);
                rupiah_ongkir = rupiah_ongkir.join('.').split('').reverse().join('');


        $("#ongkir").html("Rp " + rupiah_ongkir)
        ///data total bayar
        var data_total_bayar = parseInt(data_ongkir) + parseInt(<?= $this->cart->total() ?>);
        var reverse =  data_total_bayar.toString().split('').reverse().join(''),
                rupiah_total_bayar = reverse.match(/\d{1,3}/g);
                rupiah_total_bayar = rupiah_total_bayar.join('.').split('').reverse().join('');


        $("#total_bayar").html("Rp " +  rupiah_total_bayar);
        //data estimasi dan ongkir
        var estimasi =$("option:selected",this).attr('estimasi');
        $("input[name=estimasi]").val(estimasi);
        $("input[name=ongkir]").val( rupiah_ongkir);
        $("input[name=total_bayar]").val(rupiah_total_bayar);
      });

   });
</script>