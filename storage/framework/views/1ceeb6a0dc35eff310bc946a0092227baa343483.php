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


<form action="<?php echo e(route('tercumanara')); ?>" method="POST">
    <?php echo e(csrf_field()); ?>


    
  
    <div class="col-md-3">
        <div class="form-group ">
        <select class="form-control" id="exampleFormControlSelect1" name="dil">
          <?php $__currentLoopData = $diller; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dillers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($dillers->DilAdi); ?>"><?php echo e($dillers->DilAdi); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
    </div>


    <div class="col-md-3">
        <select name="calisilan" class="form-control">
        <option value="3">Sık Çalıştığımız Tercumanlar</option>
        <option value="2">Onaylanan Tercumanlar</option>
    </select>
    </div>

<input type="submit" class="btn btn-fill btn-success" value="Ara">

</form>




<div class="fresh-datatables">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
         <th>İD</th>
         <th>ADI VE SOYADI</th>
         <th>EPOSTA</th>
         <th>TELEFON</th>
         <th>ÇEVİRİ YAPTIĞI DİLLER</th>
         <th>SİMULTANE</th>
         <th>TEMSİLCİ NOT</th>
         <th>İŞLEMLER</th>



       </tr>
     </thead>
     <tbody>



       <?php $__currentLoopData = $tercumanlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tercumans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

       <tr>
         <td><?php echo e($tercumans->id); ?></td>
         <td><?php echo e($tercumans->isimSoyisim); ?></td>
         <td><?php echo e($tercumans->Mail); ?></td>
         <td><?php echo e($tercumans->Telefon); ?>  </td>
         <td>
            <?php $__currentLoopData = $tercumans->tercumandilbilgileri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($data->KaynakDil); ?>><?php echo e($data->HedefDil); ?>=<?php echo e($data->BirimFiyat); ?>TL<br> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </td>
         <td><?php $__currentLoopData = $tercumans->tercumandilbilgileri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($data->Tercume_Turu==1): ?> Var <?php else: ?> Yok <?php endif; ?></br>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </td>
         <td> <?php echo e($tercumans->temsilciNot); ?> </td>

    <td>
      <a class="fa fa-fw fa-2x fa-pencil-square" href="<?php echo e(route('tercumanduzenle',['id'=>$tercumans->id])); ?>" ></a>
      <a class="fa fa-fw fa-2x fa-remove" href="#myModal" data-toggle="modal" id="<?php echo e($tercumans->id); ?>" data-target="#edit-modal10"></a>
    </td>



       </tr>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </tbody>
   </table>
 </div>


<div id="edit-modal10" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Tercuman Sil</h4>
               </div>
<form action="<?php echo e(route('tercumansil')); ?>" method="POST"/>
<?php echo e(csrf_field()); ?>

           
            <h3>Seçilen Tercumanı Silmek İstiyor Musunuz ?</h3>

               <div class="modal-body edit-content">
                    <input type="hidden" name="tercumansil" id="tercumansil" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success">Tercumanı Sil</button>
               </div>

</form>

           </div>
       </div>
</div>










<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>