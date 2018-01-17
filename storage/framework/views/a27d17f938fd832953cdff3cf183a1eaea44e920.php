<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Portakal Medya Giriş Ekranı')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/light-bootstrap-dashboard.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/prtkl.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/pe-icon-7-stroke.css')); ?>" rel="stylesheet">
</head>
<body>



        <?php echo $__env->yieldContent('content'); ?>


    <!-- Scripts -->
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-selectpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-checkbox-radio-switch-tags.js')); ?>"></script>
    <script src="<?php echo e(asset('js/chartist.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-notify.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-jvectormap.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.bootstrap.wizard.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-table.js')); ?>"></script>
    <script src="<?php echo e(asset('js/fullcalendar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/light-bootstrap-dashboard.js')); ?>"></script>

      

    <script type="text/javascript">
    $().ready(function(){
        lbd.checkFullPageBackgroundImage();

        setTimeout(function(){
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>


</body>
</html>
