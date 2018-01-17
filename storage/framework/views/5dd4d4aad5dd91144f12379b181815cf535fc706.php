<div class="sidebar" data-color="orange" data-image="">
    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="logo">
        <a href="" class="logo-text">
           İş Takİp Sİstemİ V4.0
        </a>
    </div>
<div class="logo logo-mini">
  <a href="" class="logo-text">
    Ct
  </a>
</div>

  <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
          
                <img src="<?php echo e(asset('img/logo.jpg')); ?>" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                  HOŞGELDİN <?php echo e(strtoupper(Auth::user()->name)); ?>

                </a>
                  <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                 GİRDİĞİN ŞUBE: <span class="sube" ><?php echo e(Auth::user()->sonsube->name); ?></span>
                  </a>

                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        
                        <li><a href="<?php echo e(route('logout')); ?>">Çıkış Yap</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <ul class="nav">
            <li class="active">
              <a href="<?php echo e(route('yeniisekle')); ?>">
                  
                  <i class="fa fa-plus" aria-hidden="true"></i><p>YENİ İŞ EKLE</p>
              </a>
             </li>
             <li> 
                <a href="<?php echo e(route('dashboard')); ?>">
                    
                    <i class="fa fa-commenting-o" aria-hidden="true"></i><p>GELEN TEKLİFLER</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples">
                    
                    <i class="fa fa-list-ul" aria-hidden="true"></i><p>PROJELER
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples">
                    <ul class="nav">
                        <li><a href="<?php echo e(route('onaybekleyen')); ?>">Onay Bekleyen</a></li>
                        <li><a href="<?php echo e(route('devameden')); ?>">Devam Eden</a></li>
                        <li><a href="<?php echo e(route('tamamlanan')); ?>">Tamamlanan </a></li>
                        <li><a href="<?php echo e(route('iptalteklif')); ?>">İptal Edilen </a></li>
                        
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples1">
                    <i class="pe-7s-plugin"></i>
                    <i class="fa fa-user-o" aria-hidden="true"></i><p>TERCUMANLAR
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples1">
                    <ul class="nav">
                        <li><a href="<?php echo e(route('tercumanekle')); ?>">Yeni Tercuman Ekle</a></li>
                        <li><a href="<?php echo e(route('tercumanbasvurulari')); ?>">Tercuman Başvuruları</a></li>
                        <li><a href="<?php echo e(route('tercumanmaliyet')); ?>">Tercuman Maliyet Tablosu</a></li>
                        <li><a href="<?php echo e(route('tumtercumanlar')); ?>">Tüm Tercumanlar</a></li>

                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples2">
                    <i class="pe-7s-plugin"></i>
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i><p>TERCUMAN TAKİP
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples2">
                    <ul class="nav">
                        <li><a href="<?php echo e(route('tercumanistakipekle')); ?>">İş Ekle</a></li>
                        <li><a href="<?php echo e(route('tercumanistakipcetveli')); ?>">İş Takip Cetveli</a></li>
                        <li><a href="<?php echo e(route('lksyeeklenenler')); ?>">LKS ye Eklenenler</a></li>
                       
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples3">
                    <i class="pe-7s-plugin"></i>
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i><p>ADLİYE
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples3">
                    <ul class="nav">
                        <li><a href="<?php echo e(url('adliyeisekle')); ?>">İş Ekle</a></li>
                        <li><a href="<?php echo e(url('adliyedevameden')); ?>">Devam Eden İşler</a></li>
                        <li><a href="<?php echo e(url('adliyetamamlanan')); ?>">Tamamlanan İşler</a></li>
                       
                    </ul>
                </div>
            </li>
            <li> 
                <a href="<?php echo e(route('geribildirimformu')); ?>">
                    
                    <i class="fa fa-commenting-o" aria-hidden="true"></i><p>GERİ BİLDİRİM FORMU</p>
                </a>
            </li>




        </ul>
  </div>
</div>
