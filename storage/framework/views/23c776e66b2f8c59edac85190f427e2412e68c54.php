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
         <th>TEKLİF VERİLEN TARİH</th>
         <th>TEKLİF VEREN TEMSİLCİ</th>
         <th>MÜŞTERİ BİLGİLERİ</th>
         <th>DİLLER</th>
         <th>TASTİK ŞEKLİ</th>
         <th>DOSYA</th>
         <th>FİYAT VE KAPORA</th>
         <th>MÜŞTERİ TALEBİ</th>
         <th>TEMSİLCİ GELEN NOT</th>
         <th>İŞLEMLER</th>

       </tr>
     </thead>
     <tbody>
       <?php $__currentLoopData = $onaybekleyen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teklifler): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <tr>
         <td><?php echo e($teklifler->id); ?></td>
         <td><?php echo e($teklifler->GelenTeklifTarihi); ?></td>
         <td><?php echo e($teklifler->TeklifVerilenTarih); ?></td>
         <td><?php echo e($teklifler->temsilci['isimSoyisim']); ?>  </td>

         <td>
         <?php echo e($teklifler->isimSoyisim); ?></br>
         <?php echo e($teklifler->Telefon); ?></br>
         <?php echo e($teklifler->Email); ?>

       </td>


         <td><?php echo e($teklifler->KaynakDil); ?></br>
             <?php echo e($teklifler->HedefDil); ?>

       </td>
       <td><?php if($teklifler->TasdikSekli==1): ?> Yeminli Tercume  <?php elseif($teklifler->TasdikSekli==2): ?> Noter Tasdikli Tercume <?php else: ?> Apostil Tercume <?php endif; ?></td>
       <td>  <?php 
                $url="https://portakaltercume.net/crm/dosya/";
             ?> 
          <?php $__currentLoopData = $teklifler->oftdosya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosya): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
          <?php 
               
               $dosyaurl = $url.'onaybekleyenler'.'/'.$dosya->oftid.'/'.$dosya->orjisim;
          
           ?>          
             <a target="_blank" href="<?php echo e($dosyaurl); ?>"><?php echo e($dosya->orjisim.''.$dosya->uzanti); ?></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <td>
         <?php echo e($teklifler->Kapora); ?>TL</br>
         <?php echo e($teklifler->Fiyat); ?>TL</td>

         <td class="col-md-2"><?php echo e($teklifler->MusteriTalebi); ?></td>


         <td>
          <?php echo e($teklifler->TemsilciGelenTeklifNot); ?></br>
          Tercüman:<?php echo e((!empty($teklifler->tercuman['isimSoyisim']))? $teklifler->tercuman['isimSoyisim'] : 'BELİRTİLMEDİ'); ?> 
        </td>
         <td>
           <a href="#myModal" data-toggle="modal" id="<?php echo e($teklifler->id); ?>" data-target="#edit-modal" class="fa fa-fw fa-2x fa-check-square"></a>
           <a href="<?php echo e(route('onaybekleyenedit',['id'=>$teklifler->id])); ?>" class="fa fa-fw fa-2x fa-pencil-square"></a>
           <a target="_blank" href="<?php echo e(route('onaybekleyenyazdir',['id'=>$teklifler->id])); ?>" class="fa fa-fw fa-2x fa-print"></a>
           <a href="<?php echo e(route('onaygidenmail',['id'=>$teklifler->id])); ?>" class="fa fa-fw fa-2x fa-envelope"> </a>
           <a href="#myModal" data-toggle="modal" id="<?php echo e($teklifler->id); ?>" data-target="#edit-modal8" class="fa fa-fw fa-2x fa-remove"></a>
         </td>
       </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </tbody>
   </table>
 </div>



<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Bu Projeyi Devam Edenlere Taşı</h4>
               </div>
<form action="<?php echo e(route('gelenteklifonayla')); ?>" method="POST"/>
<?php echo e(csrf_field()); ?>

       

               BU PROJEYE ONAY VERMEK İSTİYOR MUSUNUZ ?

               <div class="modal-body edit-content">
                    <input type="hidden" name="bookId" id="bookId" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success">Devam Edenlere Ekle</button>
               </div>

</form>

           </div>
       </div>
</div>



<div id="edit-modal8" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Onay Bekleyen Teklifi İptaL Et</h4>
               </div>
<form action="<?php echo e(route('onaysil')); ?>" method="POST"/>
<?php echo e(csrf_field()); ?>

               <div class="form-group hidden">
                 <label for="sel1">İptal Eden  Temsilciyi Seçiniz:</label>
                 <select class="form-control" name="OnayİptalEdenTemsilci">
                  <?php $__currentLoopData = $temsilci; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temsilcis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option value="<?php echo e($temsilcis->id); ?>"><?php echo e($temsilcis->isimSoyisim); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
               </div>
               <div class="form-group">
                 <label for="sel1">İptal Sebepleri:</label>
                 <select class="form-control" name="Onayiptalnedeni">
                  <?php $__currentLoopData = $iptalnedeni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iptalnedenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option value="<?php echo e($iptalnedenis->id); ?>"><?php echo e($iptalnedenis->IptalSebebi); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
               </div> 
            


               <div class="modal-body edit-content">
                    <input type="hidden" name="onaybekleyensil" id="onaybekleyensil" value=""/>
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
          "stateSave": true,

          "pagingType": "full_numbers",
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          responsive: true,
          dom: 'Bfrtip',
          buttons: [
              
                {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9]
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