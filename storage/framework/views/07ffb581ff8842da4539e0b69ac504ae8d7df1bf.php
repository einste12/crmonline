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

         <th>EVRAK TESLİM TARİHİ</th>
         <th>Müşteri Bilgileri</th>
         <th>DİLLER</th>
         <th>Tasdik Şekli</th> 
         <th>Fiyat Ve Kapora</th>
        <th>DOSYA</th>
         <th>MÜŞTERİ TALEBİ</th>
         <th>ONAY VEREN TEMSİLCİ</th>
         <th>TEMSİLCİ NOT</th>
         <th>İŞLEMLER</th>
       </tr>
     </thead>
     <tbody>
       <?php $__currentLoopData = $tamamlananteklif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teklifler): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <tr>
         <td><?php echo e($teklifler->id); ?></td>

         <td>
           <?php echo e($teklifler->EvrakTeslimTarihi); ?>

         </td>
          <td>
             <?php echo e($teklifler->isimSoyisim); ?>

             <?php echo e($teklifler->Telefon); ?>

             <?php echo e($teklifler->Email); ?>

         </td>
         <td>
           <?php echo e($teklifler->KaynakDil); ?> > </br>
           <?php echo e($teklifler->HedefDil); ?>

       </td>
         <td><?php if($teklifler->TasdikSekli==1): ?> Yeminli Tercume  <?php elseif($teklifler->TasdikSekli==2): ?> Noter Tasdikli Tercume <?php else: ?> Apostil Tercume <?php endif; ?></td>
        
          <td>
            <?php echo e($teklifler->Kapora); ?>TL
            <?php echo e($teklifler->Fiyat); ?>TL
          </td>

          <td>DENEME DOSYA</td>
         <td><?php echo e($teklifler->MusteriTalebi); ?></td>
         <td><?php echo e($teklifler->temsilci2['isimSoyisim']); ?>  </td>

         <td><?php echo e($teklifler->TemsilciGelenTeklifNot); ?></td>
         <td>
           <a class="fa fa-fw fa-2x fa-pencil-square" href="<?php echo e(route('tamamlananedit',['id'=>$teklifler->id])); ?>" ></a>
           <a class="fa fa-fw fa-2x fa-print" target="_blank" href="<?php echo e(route('tamamlananyazdir',['id'=>$teklifler->id])); ?>" ></a>
           <a class="fa fa-fw fa-2x fa-envelope" href="<?php echo e(route('tamamgidenmail',['id'=>$teklifler->id])); ?>" > </a>
           
         </td>
       </tr>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </tbody>
   </table>
 </div>




<script type="text/javascript">
  

    $(document).ready(function() {
     
      $('#datatables').DataTable({
          "ordering": false,
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