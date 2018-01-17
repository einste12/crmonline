

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
    <table id="datatables" class="table table-striped table-no-bordered table-hover deneme" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
         <th>ID</th>
         <th>EKLENME TARİHİ</th>
         <th>TERCUMAN</th>
         <th>PROJE ADI</th>
         <th>DİL</th>
         <th>KARAKTER</th>
         <th>BİRİM FİYAT</th>
         <th>TEMSİLCİ</th>
         <th>PROJE NOT</th>
         <th>İŞLEMLER</th>




       </tr>
     </thead>
     <tbody>



       <?php $__currentLoopData = $tercumantakipcetveli; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tercumantakipcetvelis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	       	<tr>
		         <td><?php echo e($tercumantakipcetvelis->id); ?></td>
		         <td><?php echo e($tercumantakipcetvelis->EklenmeTarih); ?></td>
		         <td><?php echo e($tercumantakipcetvelis->TercumanAdi); ?></td>
		         <td><?php echo e($tercumantakipcetvelis->ProjeAdi); ?></td>
		         <td>
              <?php echo e($tercumantakipcetvelis->KaynakDil); ?>><?php echo e($tercumantakipcetvelis->HedefDil); ?>

             </td>

              <td><?php echo e($tercumantakipcetvelis->Karakter); ?></td>
		         <td><?php echo e($tercumantakipcetvelis->BirimFiyat); ?>TL</td>
		            
		        
		         <td><?php echo e($tercumantakipcetvelis->temsilci['isimSoyisim']); ?></br><?php echo e($tercumantakipcetvelis->SubeID); ?> </td>
		         <td><?php echo e($tercumantakipcetvelis->TercumanTakipNot); ?>  </td>
		         <td>
		         	<a class="fa fa-fw fa-2x fa-check-square-o" href="#myModal" data-toggle="modal" id="<?php echo e($tercumantakipcetvelis->id); ?>" data-target="#edit-modal5"></a>
                                <a class="fa fa-fw fa-2x fa-pencil-square" href="<?php echo e(route('tercumantakipduzenle',['id'=>$tercumantakipcetvelis->id])); ?>"></a>
                                <a class="fa fa-fw fa-2x fa-remove" href="<?php echo e(route('tercumanistakipcetvelisil',['id'=>$tercumantakipcetvelis->id])); ?>" ></a>
		         </td>

	




       		</tr>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </tbody>
   </table>
 </div>







<div id="edit-modal5" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">LKS ye Ekle</h4>
               </div>
<form action="<?php echo e(route('lksekle')); ?>" method="POST"/>
<?php echo e(csrf_field()); ?>

           
           	<h3>LKS ye Eklemek İstiyor Musunuz ?</h3>

               <div class="modal-body edit-content">
                    <input type="hidden" name="lksonay" id="lksonay" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success">LKS ye Ekle</button>
               </div>

</form>

           </div>
       </div>
</div>











	



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>