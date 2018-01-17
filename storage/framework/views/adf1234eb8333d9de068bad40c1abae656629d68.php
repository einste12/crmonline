

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

  
  
<div class="toolbar">
                                  <!--        Here you can write extra buttons/actions for the toolbar              -->
</div>
  <div class="fresh-datatables">
     <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
        <th>Çoklu Sil</th>    
         <th>Başvuru Tarihi</th>
         <th>Başvuru Amacı</th>
         <th>İSİM SOYİSİM</th>
         <th>E-POSTA</th>
         <th>TELEFON</th>
         <th>ÇEVİRİ YAPTIĞI DİL</th>
         <th>SİMULTANE</th>
         <th>LOKASYON</th>
         <th>İŞLEMLER</th>



       </tr>
     </thead>
     <tbody>


 <form id="secili" method="POST" action="<?php echo e(URL::action('DashBoardController@coklutercumansil')); ?>"> 
    <?php echo e(csrf_field()); ?>

       <?php $__currentLoopData = $tercumanbasvurulari; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tercumans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	       	<tr>
             <td><input type="checkbox" value="<?php echo e($tercumans->id); ?>" name="checked[]"></label><br /></td>
		         <td><?php echo e($tercumans->BasvuruTarihi); ?></td>
<td>
 <?php if($tercumans->BasvuruAmaci==1): ?> Hobi Amaçlı
    <?php elseif($tercumans->BasvuruAmaci==2): ?> Kendimi Geliştirmek İstiyorum
    <?php elseif($tercumans->BasvuruAmaci==3): ?> Ek Gelir Elde Etmek İstiyorum
    <?php elseif($tercumans->BasvuruAmaci==4): ?> Öğrenciyim Tecrube Kazanmak İstiyorum
    <?php elseif($tercumans->BasvuruAmaci==5): ?> Bu benim mesleğim ve iş yaptığım network büyütmek istiyorum
    <?php elseif($tercumans->BasvuruAmaci==""): ?>AMAÇ BELİRTİLMEMİŞ
    
 <?php endif; ?>
                             
</td>
		         <td><?php echo e(mb_strtoupper($tercumans->isimSoyisim)); ?></td>
		         <td><?php echo e($tercumans->Mail); ?>  </td>
		         <td><?php echo e($tercumans->Telefon); ?>  </td>
		         <td>
		            <?php $__currentLoopData = $tercumans->tercumandilbilgileri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($data->KaynakDil); ?>><?php echo e($data->HedefDil); ?>=<?php echo e($data->BirimFiyat); ?>TL</br> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		         </td>
		         <td><?php $__currentLoopData = $tercumans->tercumandilbilgileri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($data->Tercume_Turu==1): ?> Var <?php else: ?> Yok <?php endif; ?></br>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </td>
		         <td> <?php echo e(mb_strtoupper($tercumans->Locasyon)); ?> </td>
		         <td>
                            <a class="fa fa-fw fa-2x fa-check-square-o" href="#myModal" data-toggle="modal" id="<?php echo e($tercumans->id); ?>" data-target="#edit-modal4"></a>
                            <a class="fa fa-fw fa-2x fa-remove" href="<?php echo e(route('tercumanbasvurusil',['id'=>$tercumans->id])); ?>"></a>
		         </td>
       		</tr>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

           </tbody>
         </table>
            <button class="btn btn-danger seciliSil" type="button">SEÇİLENLERİ SİL</button>
      </form>
   
 </div>





<div id="edit-modal4" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Onayla</h4>
               </div>
<form action="<?php echo e(route('tercumanbasvuruonayla')); ?>" method="POST"/>
<?php echo e(csrf_field()); ?>

           
           	<h3>Tercuman Basvuruyu Onaylamak İstiyor Musunuz ?</h3>

               <div class="modal-body edit-content">
                    <input type="hidden" name="basvuruonay" id="basvuruonay" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success">Tercumanı Onayla</button>
               </div>

</form>

           </div>
       </div>
</div>


<script type="text/javascript">
  
  
$(document).ready(function() {

$("td").click(function(e) {
    var chk = $(this).closest("tr").find("input:checkbox").get(0);
    if(e.target != chk)
    {
        
        chk.checked = !chk.checked;
    }
});

});




  
</script>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>