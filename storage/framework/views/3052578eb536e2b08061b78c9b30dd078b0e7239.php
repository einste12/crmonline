

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

  <form action="<?php echo e(route('devamedenupdate',$teklif->id)); ?>" method="POST">
    <?php echo e(csrf_field()); ?>

    <div class="form-group">
      <label for="exampleInputEmail1">İsim Ve Soyisim</label>
      <input type="text" class="form-control"  value="<?php echo e($teklif->isimSoyisim); ?>" name="isimSoyisim">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Telefon</label>
      <input type="number" class="form-control" value="<?php echo e($teklif->Telefon); ?>"  name="Telefon">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">E-mail</label>
      <input type="email" class="form-control" value="<?php echo e($teklif->Email); ?>"   name="Email">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Kaynak Dil</label>
        <select  name="KaynakDil" class="form-control">
            <?php $__currentLoopData = $diller; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dillers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option  <?php if($teklif->HedefDil ==$dillers->DilAdi ): ?> selected <?php endif; ?> value="<?php echo e($dillers->DilAdi); ?>"><?php echo e($dillers->DilAdi); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
     </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Hedef Dil</label>
        <select  name="HedefDil" class="form-control">
            <?php $__currentLoopData = $diller; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dillers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option <?php if($teklif->HedefDil ==$dillers->DilAdi ): ?> selected <?php endif; ?> value="<?php echo e($dillers->DilAdi); ?>"><?php echo e($dillers->DilAdi); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
        </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Kapora</label>
      <input type="number" class="form-control"  value="<?php echo e($teklif->Kapora); ?>"  name="Kapora">
    </div>
    <div class="form-group">
     <label class=" control-label">Noter Tasdiki </label>
      <select  name="TasdikSekli" class="form-control">
       <option <?php if($teklif->TastikSekli == 1): ?> selected <?php endif; ?>  value="1"> Yeminli Tercüme</option>
       <option <?php if($teklif->TastikSekli == 2): ?> selected <?php endif; ?>  value="2"> Noter Yeminli Tercüme</option>
       <option <?php if($teklif->TastikSekli == 3): ?> selected <?php endif; ?>  value="3"> Apostil Tasdikli Tercüme</option>
     </select>
   </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Müşteri Talebi</label>
      <textarea  class="form-control" name="MusteriTalebi"><?php echo e($teklif->MusteriTalebi); ?></textarea>
    </div>
    <div class="form-group hidden">
      <label for="exampleInputEmail1">Teklif Veren Temsilci</label>
      <input type="text" class="form-control"  value="<?php echo e($teklif->TeklifVerenTemsilci); ?>" name="TeklifVerenTemsilci">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Fiyat</label>
      <input type="number" class="form-control"  value="<?php echo e($teklif->Fiyat); ?>" name="Fiyat">
    </div>
    
    <div class="form-group">
      <label for="exampleInputEmail1">Temsilci İçin Not</label>
      <textarea  class="form-control" name="TemsilciProjeNot"><?php echo e($teklif->TemsilciProjeNot); ?></textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">TERCUMAN SEÇİNİZ</label>
          <select class="form-control" id="exampleFormControlSelect1" name="TercumanID">
            <?php $__currentLoopData = $tercumanmali; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tercumans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option <?php if($teklif->TercumanID ==$tercumans->id ): ?> selected <?php endif; ?> value="<?php echo e($tercumans->id); ?>"><?php echo e($tercumans->isimSoyisim); ?></option>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>

    <button type="submit" class="btn btn-success">GÜNCELLE</button>
  </form>






<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>