<?php $__env->startSection('content'); ?>


  <?php if(alert()->ready()): ?>
    <script>
        swal({
          title: "<?php echo alert()->message(); ?>",
          text: "<?php echo alert()->option('text'); ?>",
          type: "<?php echo alert()->type(); ?>"
        });
    </script>
<?php endif; ?>


  <div class="fresh-datatables">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
         <th>İD</th>
         <th>GELEN TEKLİF TARİHİ</th>
         <th>TEKLİF VERİLEN TARİH VE TEMSİLCİ</th>
         <th>MÜŞTERİ BİLGİLERİ</th>
          <th>DİLLER</th>
         <th>TASDİK ŞEKLİ</th>
         <th>FİYAT ve KAPORA </th>
         <th>TEMSİLCİ NOT</th>
         <th>TERCUMAN</th>
         <th>İŞLEMLER</th>
       </tr>
     </thead>
     <tbody> 
       <?php $__currentLoopData = $devamteklif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teklifler): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <tr>
         <td><?php echo e($teklifler->id); ?></td>
         <td><?php echo e($teklifler->GelenTeklifTarihi); ?></td>
         <td>
          <?php echo e($teklifler->TeklifVerilenTarih); ?></br>
          <?php echo e($teklifler->temsilci['isimSoyisim']); ?>

         </td>
         <td>
          <?php echo e($teklifler->isimSoyisim); ?></br>
          <?php echo e($teklifler->Telefon); ?></br>
          <?php echo e($teklifler->Email); ?>

         </td>
         <td>
          <?php echo e($teklifler->KaynakDil); ?> > </br>
          <?php echo e($teklifler->HedefDil); ?>

        </td>
         <td>
           <?php if($teklifler->TasdikSekli==1): ?> Yeminli Tercume  <?php elseif($teklifler->TasdikSekli==2): ?> Noter Tasdikli Tercume <?php else: ?> Apostil Tercume <?php endif; ?>
         </td>


         <td><?php echo e($teklifler->Fiyat); ?>TL</br>
              <?php echo e($teklifler->Kapora); ?>TL
          </td>
         <td><?php echo e($teklifler->TemsilciProjeNot); ?></td>
         <td><?php echo e($teklifler->tercuman['isimSoyisim']); ?></td>
         <td>
           <a class="fa fa-fw fa-2x fa-check-square" href="#myModal" data-toggle="modal" id="<?php echo e($teklifler->id); ?>" data-target="#edit-modal2"></a>
           <a class="fa fa-fw fa-2x fa-pencil-square" href="<?php echo e(route('devamedenedit',['id'=>$teklifler->id])); ?>" ></a>
           <a class="fa fa-fw fa-2x fa-print" target="_blank" href="<?php echo e(route('devamedenyazdir',['id'=>$teklifler->id])); ?>"></a>
           <a class="fa fa-fw fa-2x fa-envelope" href="<?php echo e(route('devamgidenmail',['id'=>$teklifler->id])); ?>" > </a><a class="fa fa-fw fa-2x fa-check-remove" href="#myModal" data-toggle="modal" id="<?php echo e($teklifler->id); ?>" data-target="#edit-modal9"></a> 
           <a class="fa fa-fw fa-2x fa-remove" href="#myModal" data-toggle="modal" id="<?php echo e($teklifler->id); ?>" data-target="#edit-modal9"></a>
         </td>

       </tr>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </tbody>
   </table>
</div>




<div id="edit-modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Projeyi Tamamla</h4>
               </div>
<form action="<?php echo e(route('tekliftamamla')); ?>" method="POST"/>
<?php echo e(csrf_field()); ?>


            <div class="row" >
                                        <div class="col-md-12">
                                              <div class="form-group">
                                              <label class=" control-label" for="tarih">Evrak Teslim Tarihi <star>*</star></label>  
                                              <div class='input-group date'>
                                                  <input id="tarih" required="true" placeholder="Evrak Teslim Tarihini Giriniz." name='EvrakTeslimTarihi' type='text' class="datetimepicker form-control" />
                                                  <label for="tarih" class="input-group-addon">
                                                      <span class="fa fa-calendar"></span>
                                                  </label>
                                              </div>
                                              </div>
                                           </div>
                                        </div>


          

               <div class="modal-body edit-content">
                    <input type="hidden" name="devamedenid" id="devamedenid" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                   <button type="submit" class="btn btn-success">Onayla</button>
               </div>

</form>

           </div>
       </div>
</div>



<div id="edit-modal9" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Devam Eden Teklifi İptaL Et</h4>
               </div>
<form action="<?php echo e(route('devamsil')); ?>" method="POST"/>
<?php echo e(csrf_field()); ?>

            
               <div class="form-group">
                 <label for="sel1">İptal Sebepleri:</label>
                 <select class="form-control" name="Devamiptalnedeni">
                  <?php $__currentLoopData = $iptalnedeni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iptalnedenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option value="<?php echo e($iptalnedenis->id); ?>"><?php echo e($iptalnedenis->IptalSebebi); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
               </div> 
            


               <div class="modal-body edit-content">
                    <input type="hidden" name="devamedensil" id="devamedensil" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                   <button type="submit" class="btn btn-success">SİL</button>
               </div>

</form>

           </div>
       </div>
</div>


<script type="text/javascript">
  

    $(document).ready(function() {
     
      $('#datatables').DataTable({
          "ordering": false,
          "stateSave": false,  
          "pagingType": "full_numbers",
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          responsive: true,
          dom: 'Bfrtip',
               buttons: [
              
                {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                }
            },




          ],

          language: {
          search: "_INPUT_",
          searchPlaceholder: "Arama Yapınız",
          }


      });
        var table = $('#datatables').DataTable();     
      });

</script>











<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>