
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


<form  id="teklifform" name="teklifform" action="<?php echo e(route('tercumanformistakipekle')); ?>"class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
<div class=" col-md-6 col-md-offset-3" style="padding-top:40px; padding-bottom: 50px;">

<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
<legend>Tercuman İş Takip Ekle</legend>

        

       <div class="col-md-12  form-group">
         <label class="control-label" for="KaynakDil">Kaynak Dil</label>
                 <select name="KaynakDil" class="form-control">
                <?php $__currentLoopData = $diller; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dillers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($dillers->DilAdi); ?>"><?php echo e($dillers->DilAdi); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
              </select>
       </div>

      <div class="col-md-12  form-group">
         <label class="control-label" for="HedefDil">Hedef Dil  </label>
            <select name="HedefDil" class="form-control">
                <?php $__currentLoopData = $diller; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dillers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($dillers->DilAdi); ?>"><?php echo e($dillers->DilAdi); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
              </select>
              
       </div>

  

    
        <div class="col-md-12  form-group">
           <label class="control-label">Tercuman İsmi</label>
              <select name="tercumanismi" class="form-control" id="TercumanAdi">
                <?php $__currentLoopData = $tercumanlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tercumanlist1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option   <?php $__currentLoopData = $tercumanlist1->tercumandilbilgileri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> karakterfiyati="<?php echo e($data2->BirimFiyat); ?>" <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="<?php echo e($tercumanlist1->isimSoyisim); ?>"><?php echo e($tercumanlist1->isimSoyisim); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
              </select>
        </div>
       
        <div class="col-md-12  form-group">
         <label class="control-label" for="BirimFiyat">Birim Fiyat  </label>  
            <input required="true" id="BirimFiyats" name="BirimFiyat" type="number" placeholder="Birim Fiyat Giriniz" class="sayi form-control input-md">

             <script>
                $(document).on("change","#TercumanAdi",function(){
                    $("#BirimFiyats").val($(this).children(":selected").attr("karakterfiyati"));
                });
            </script>
          
        </div>
      
        
                                           
        
                                       <div class="row" >
                                        <div class="col-md-12">
                                              <div class="form-group">
                                              <label class=" control-label" for="tarih">Evrak Alma Tarihi <star>*</star></label>  
                                              <div class='input-group date'>
                                                  <input id="tarih" required="true" placeholder="Evrak Tarihi Giriniz" name='EvrakAlmaTarihi' type='text' class="datetimepicker form-control" />
                                                  <label for="tarih" class="input-group-addon">
                                                      <span class="fa fa-calendar"></span>
                                                  </label>
                                              </div>
                                              </div>
                                           </div>
                                        </div>
                                    
        

        <div class="col-md-12  form-group">
         <label class="control-label" for="ProjeAdi">Proje Adı </label>  
             <input required="true" id="AdSoyad" name="ProjeAdi" type="text" placeholder="Proje Adı Giriniz" class="form-control input-md">
        </div>

       <div class="col-md-12  form-group">
            <label class="control-label" for="Karakter">Karakter </label>  
            <input required="true" id="Karakters" name="Karakter" type="number" placeholder="Karakter Sayısını Giriniz" class=" form-control input-md">
       </div>


   


    


       <div class="col-md-12  form-group">
         <label class="control-label" for="TercumanTakipNot">Proje Hakkında Not Ekle  </label>
        
          <textarea type="text" name="TercumanTakipNot" id="TercumanTakipNot" rows="4" class="form-control input-md" placeholder="" tabindex="7"></textarea>
        
       </div>

       <div class="col-md-12" style="">
               <button type="submit" name="kayit" class="btn btn-warning btn-fill btn-wd">Kaydet</button>
       </div>

    </div>
</form>


 <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>