

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


   <div class="content">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="card">

                                  <div class="content">

                                       <legend>Yeni Müşteri Ekle </legend>



                                       <form action="<?php echo e(route('isekle')); ?>" method="POST">
                                         <?php echo e(csrf_field()); ?>

                                   
                                       <div class="row" >
                                        <div class="col-md-12">
                                              <div class="form-group">
                                              <label class=" control-label" for="tarih">Evrak Alma Tarihi <star>*</star></label>  
                                              <div class='input-group date'>
                                                  <input id="tarih" required="true" placeholder="Evrak Tarihi Giriniz" name='GelenTeklifTarihi' type='text' class="datetimepicker form-control" />
                                                  <label for="tarih" class="input-group-addon">
                                                      <span class="fa fa-calendar"></span>
                                                  </label>
                                              </div>
                                              </div>
                                           </div>
                                        </div>



                                       <div class="row">

                                           <div class="col-md-12 form-group">
                                            <label class=" control-label" for="AdSoyad">Müşteri Adı </label>
                                            <div class="">
                                                  <input  required="true"  id="AdSoyad" name="isimSoyisim" type="text" placeholder="Müşteri  Adını Giriniz" class="form-control input-md">
                                            </div>
                                          </div>
                                        </div>
                                          <div class="row">
                                          <div class="col-md-12 form-group">
                                            <label class=" control-label" for="Telefon">Telefon  </label>
                                            <div class="">
                                                  <input  type="number"  maxlength="25" name="Telefon" id="Telefon" class="form-control input-md" placeholder="Telefon Giriniz " >
                                            </div>
                                          </div>
                                          </div>
                                          <div class="row">
                                         <div class="col-md-12 form-group">
                                            <label class=" control-label" for="Eposta">Email  </label>
                                            <div class="">
                                             <input type="email" name="Email" id="Eposta" class="form-control input-md" placeholder="Email Giriniz">
                                            </div>
                                          </div>
                                        </div>



                                       <div class="row">
                                            <div class="col-md-6 form-group">
                                            <label class=" control-label" for="KaynakDil">Kaynak Dil </label>
                                            <div class="">
 
                                              <select id="KaynakDil" name="KaynakDil" class="form-control" required="">
                                                    <?php $__currentLoopData = $diller; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dillers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <option value="<?php echo e($dillers->DilAdi); ?>"><?php echo e($dillers->DilAdi); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </select>

                                            </div>
                                          </div>
                                          <div class="col-md-6 form-group">
                                            <label class=" control-label" for="HedefDil">Hedef Dil </label>
                                            <div class="">


                                    <select id="hedefdil1" name="HedefDil[]" class="form-control selectpicker" multiple onchange="deneme();" required="">
                                          <?php $__currentLoopData = $diller; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dillers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($dillers->DilAdi); ?>"><?php echo e($dillers->DilAdi); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>



                                            </div>
                                          </div>

                                       </div>



                                       <div class="row">
                                           <div class="col-md-6 form-group">
                                              <label class=" control-label" for="Fiyat">Toplam Fiyat  </label>
                                              <div class="">
                                               <input type="number" name="Fiyat" id="Fiyat" class="form-control input-md" placeholder="..TL">
                                              </div>
                                            </div>

                                           <div class="col-md-6 form-group">
                                              <label class=" control-label" for="Kaparo">Kapora </label> <br />

                                                    <input type="number" id="Kaparo" class="form-control input-md" name="Kapora"/>

                                            </div>


                                       </div>



                                       <div class="row">
                                             <div class="col-md-12 form-group">
                                            <label class=" control-label" for="Tercuman">Tercuman </label>
                                                <select name="TercumanID" class="form-control">
                                                  <?php $__currentLoopData = $tercumanlar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tercumanlars): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($tercumanlars->id); ?>"><?php echo e($tercumanlars->isimSoyisim); ?></option>}
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                                </select>
                                            </div>
                                          </div>
                                       </div>



                                       <div class="row">
                                             <div class="col-md-6 form-group">
                                                  <label class=" control-label">Tastik Sekli</label>
                                                   <select id="TastikSekli1" name="TasdikSekli" class="form-control">
                                                          <option value="1">Yeminli Tercume</option>
                                                          <option value="2">Noter Tasdikli Tercume</option>
                                                          <option value="3">Apostil Tasdikli Tercume</option>
                                                  </select>
                                          </div>



                                             <div class="col-md-6 form-group">
                                                  <label class=" control-label">Onay Durumu</label>
                                                   <select id="TastikSekli" name="OnayDurumu" class="form-control">
                                                          <option value="1">Onay Bekleyen İşlere Ekle</option>
                                                          <option value="2">Devam Eden İşlere Ekle</option>
                                                          <option value="3">Tamamlanan İşlere Ekle</option>
                                                  </select>
                                          </div>
                                       </div>
                                        <div class="row">

                                             <div class="col-md-12 form-group">
                                                      <label class=" control-label">Müşteri Nereden Geldi? </label>
                                                      <div class="">
                                                              <select id="musterituru" name="NeredenGeldi" class="form-control">
                                                                      <option value="1">İnternet</option>
                                                                      <option value="2">Sürekli Olan</option>
                                                                      <option value="3"> Referans-Tavsiye</option>
                                                                      <option value="4"> Noter Yönlendirmesi</option>
                                                              </select>
                                                      </div>
                                              </div>
                                       </div>
                                         

                                       <div class="row">
                                          <div class="col-md-12 form-group">
                                            <label class=" control-label" for="temsilcinot">BU MÜŞTERİ İÇİN NOT GİRMEK İSTER MİSİNİZ?</label>
                                            <div class="">
                                             <textarea type="text" name="TemsilciGelenTeklifNot" id="temsilcinot" class="form-control input-md" placeholder=""></textarea>
                                            </div>
                                          </div>
                                       </div>
                                 

                                  <div class="footer">
                                      <button type="submit" class="btn btn-success btn-fill pull-right">Kaydet</button>


                                      <div class="clearfix"></div>
                                  </div>
                              </form>
                          </div>
                      </div>
                
                   <div class="col-md-6">
                          <div class="card">
                              <form id="loginFormValidation" action="" method="" novalidate="">
                                  <div class="header text-center">Müşteri Önizlemesi</div>
                                  <div class="content">

                                       <div class="form-group"><strong>Evrak Alma Tarihi: </strong><span id="evrakalmatarihi"></span></div>

                                      <div class="form-group">Müşteri Adı: </strong><span id="madi"></span></div>
                                      <div class="form-group">Telefon: </strong><span id="tel"></span></div>
                                      <div class="form-group">E-Mail: </strong><span id="mail"></span></div>
                                      <div class="form-group">Kaynak Dil: </strong><span id="kaynakdil"></span></div>
                                      <div class="form-group">Hedef Diller: </strong><span id="hedefdil"></span></div>

                                      <div class="form-group">Toplam Fiyat: </strong><span id="fiyat"></span></div>
                                      
                                      <div class="form-group">Kaparo: </strong><span id="kaparo"></span></div>
                                      <div class="form-group">Noter Tasdiki: </strong><span id="tastiksekli"></span></div>
                                      
                                      <div class="form-group">Not: </strong><span id="not"></span></div>
                                      
                                  </div>


                              </form>
                          </div>
                      </div>


                  </div>

              </div>
          </div>




<script type="text/javascript">
  
    function deneme()

      {

            var values = $('#hedefdil1').val(); 
             $("#hedefdil").html(values+',');
              

      }



//İSİMSOYİSİM YAZDIRMA
    var inputBox1=document.getElementById('AdSoyad');

inputBox1.onkeyup=function(){
    
    var test = document.getElementById('madi').innerHTML = inputBox1.value;

}

//TELEFON ALMA

    var inputBox2=document.getElementById('Telefon');

inputBox2.onkeyup=function(){
    
    var test = document.getElementById('tel').innerHTML = inputBox2.value;

}


//EMAİL ALMA


var inputBox3=document.getElementById('Eposta');

    inputBox3.onkeyup=function(){
    
    var test = document.getElementById('mail').innerHTML = inputBox3.value;

}



//TOPLAM FİYAT

var inputBox4=document.getElementById('Fiyat');

    inputBox4.onkeyup=function(){
    
    var test = document.getElementById('fiyat').innerHTML = inputBox4.value;

}



//KAPARO ALMA
var inputBox5=document.getElementById('Kaparo');

    inputBox5.onkeyup=function(){
    
    var test = document.getElementById('kaparo').innerHTML = inputBox5.value;

}


//NOT ALMA
var inputBox6=document.getElementById('temsilcinot');

    inputBox6.onkeyup=function(){
    
    var test = document.getElementById('not').innerHTML = inputBox6.value;

}




</script>






<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>