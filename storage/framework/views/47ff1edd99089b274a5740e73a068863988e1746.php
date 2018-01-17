<?php $__env->startSection('content'); ?>


<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="orange" data-image="../../assets/img/full-screen-image-1.jpg">

    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <form method="POST" action="<?php echo e(route('login')); ?>">
                       <?php echo e(csrf_field()); ?>

                        <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                            <div class="card card-hidden">
                                <div class="header text-center">Giriş Ekranı</div>
                                <div class="content">
                                  <div class="form-group">
                                      <label for="exampleFormControlSelect1">ŞUBE SEÇİNİZ</label>
                                      <select class="form-control" id="exampleFormControlSelect1" name="sube" required="">
                                            <option value="">Seçiniz..</option>
                                          <?php $__currentLoopData = $subeler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subelers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($subelers->id); ?>"><?php echo e($subelers->name); ?></option>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>


                                    <div class="form-group">
                                        <label>Email Adresiniz</label>
                                        <input type="email" placeholder="E-mail Adresiniz" class="form-control" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label>Şifreniz</label>
                                        <input type="password" placeholder="Şifreniz" class="form-control"name="password">
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-fill btn-warning btn-wd">Giriş Yap</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>