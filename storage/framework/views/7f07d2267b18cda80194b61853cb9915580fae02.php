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
         <th>İD</th>
         <th>GELEN TEKLİF TARİHİ</th>
         <th>MÜŞTERİ BİLGİLERİ</th>
         <th>DİLLER</th>
         <th>TASDİK ŞEKLİ</th>
         <th>MESLEKİ UZMANLIK</th>
         <th>DOSYA</th>
         <th>MÜŞTERİ NOT</th>
         <th>İŞLEMLER</th>
       </tr>
     </thead>
     <tbody>
       <?php $__currentLoopData = $teklif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teklifler): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <tr>
         <td><?php echo e($teklifler->id); ?></td>
         <td><?php echo e($teklifler->GelenTeklifTarihi); ?></td>
         <td>
          <?php echo e($teklifler->isimSoyisim); ?></br>
          <?php echo e($teklifler->Email); ?></br>
          <?php echo e($teklifler->Telefon); ?>

       </td>
         <td>
          <?php echo e($teklifler->KaynakDil); ?> > </br>
          <?php echo e($teklifler->HedefDil); ?>

       </td>
         
       <td><?php if($teklifler->TastikSekli==1): ?> Yeminli Tercume  <?php elseif($teklifler->TastikSekli==2): ?> Noter Tasdikli Tercume <?php else: ?> Apostil Tercume <?php endif; ?></td>
       <td><?php if(empty($teklifler->MeslekiUzmanlik)): ?>? '' : $teklifler->MeslekiUzmanlik <?php endif; ?></td>
         <td>
            <?php 
                $url="https://portakaltercume.net/crm/dosya/";
             ?> 
          <?php $__currentLoopData = $teklifler->oftdosya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosya): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
          <?php 
               
               $dosyaurl = $url.'gelenteklifler'.'/'.$dosya->oftid.'/'.$dosya->orjisim;
          
           ?>
          
             <a target="_blank" href="<?php echo e($dosyaurl); ?>"><?php echo e($dosya->orjisim.''.$dosya->uzanti); ?>  </a> 
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </td>
         <td><?php echo e($teklifler->MusteriTalebi); ?></td>
         <td>
           <a href="#myModal" data-toggle="modal" id="<?php echo e($teklifler->id); ?>" data-target="#edit-modal6" class="fa fa-fw fa-2x fa-check-square-o"> </a>
           <a href="#myModal" data-toggle="modal" id="<?php echo e($teklifler->id); ?>" data-target="#edit-modal7" class="fa fa-fw fa-2x fa-remove"></a>
         </td>
       </tr>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </tbody>
   </table>
</div>   






<div id="edit-modal6" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Teklife Fiyat Verin</h4>
               </div>


  <script type="text/javascript">
    

    function setForm(){

      var type = document.getElementById('evraktipi').value=='1'?'evrakli':'evraksiz';


      document.getElementById('mailMetin').value = document.getElementById(type).innerHTML;

      return true;


    }




  </script>



<form action="<?php echo e(route('gelentekliffiyatver')); ?>" onSubmit="return setForm()" method="POST"/>
<?php echo e(csrf_field()); ?>




  <input type="hidden" name="mailMetin" id="mailMetin">

              <div class="form-group">
                <label>Evrak tipi</label>
                <select name="evraktipi" id="evraktipi" class="form-control" required="">
                    <option value="" selected="">Evrak Tipi Seçiniz</option>
                    <option value="1">Evraklı</option>
                    <option value="2">Evraksız</option>
                    

              </select>

              </div>

      

            <div class="form-group" id="temsilcinot">
                <label>Bu Bölüm sadece Temsilci Tarafından görüntülenir.</label>
            <textarea name="temsilcinot" class="form-control"></textarea>   
           </div>

                
              <div class="hidden form-group" id="tastiksekli">
                <label>Evrak tipi</label>
                <select name="tastiksekli" id="tastiksekli" class="form-control">
                    
                    <option value="1">Tasdikli</option>
                    <option value="2">Tasdiksiz</option>
                    

              </select>

              </div>

              <div class="hidden form-group" id="teslimzamani1">
                <label>Teslimat Zamanı</label>
                <select name="teslimzamani" id="teslimzamani" class="form-control">
                    <option value="" selected="">Seçiniz</option>
                    <option value="1">Gün</option>
                    <option value="2">Saat</option>
                    

              </select>

              </div>

            <div class="hidden form-group" id="isgunu">
               <label>Kaç İş Günü İçinde Verilecek?</label>
   
                  <input type="text" id="gun" name="isgunu" class="form-control">            
    
              </div>


            <div class='printchatbox' id='printchatbox'></div>

              <div class="hidden form-group" id="issaati">
               <label>Kaç Saat İçinde Verilecek?</label>
   
                  <input type="text" id="saat" name="issaati" class="form-control">            
    
              </div>



              <div class="hidden form-group" id="fiyat">
               <label>Fiyat</label>
   
                  <input type="text" id="evrakfiyati" name="fiyat" class="form-control">            
    
              </div>
          
         

              <div class="hidden form-group fiyatverbox" id="evraksiz">
                
            
    

Sayın <span class="ilkisim"></span>,<br /> 
Çevirisini yaptırmak istediğiniz dosyalarınızı bize maille gönderebilirseniz inceleyip size fiyat ve süre hakkında bilgi verebiliriz.<br /> <br />  

​1- ​Hızlı teklif almak için https://www.portakaltercume.com/fiyat-teklifi-al/ adresinden belgelerinizi bize gönderebilirsiniz.<br />

​2- Evraklarınızı ​ <?php echo e(Auth::user()->number); ?> nolu telefona WhatsApp programı üzerinden belgenizin resmini çekerek gönderebilirsiniz​.<br /> <br /> 

3- ​info@portakaltercume.com.tr adresine mail atabilirsiniz.<br /> <br /> 

Değerlendirmenize sunar, <br /> 
İyi çalışmalar dileriz.<br /> <br />

<b style="color:red;"><?php echo e(Auth::user()->name); ?></b> / Proje Koordinatörü<br /> 
Temsilci Gsm:  <b style="color:red;"><?php echo e(Auth::user()->number); ?></b><br /> 
Çağrı Merkezi:  444 82 86<br /> 
www.portakaltercume.com.tr
                      
          

              </div> 

        
    <div class="hidden form-group fiyatverbox" id="evrakli">
               


Sayın <span id="isimSoyisim"></span>,<br /> 
Göndermiş olduğunuz belgenin yeminli tercüme ücreti​ <span style="color:red; font-weight:bold;" id="evraklifiyat"></span> TL + %18 KDV’ dir.
Ödemenin yapılması halinde belge/belgelerinizin tercümesi <span id="isgosterme"></span> <span  class="gunText" style="display:none; font-weight:bold;">iş günü</span><span id="saatgosterme" ></span> <span class="saatText" style="display:none; font-weight:bold;">saat</span> içerisinde teslim edilecektir.<br /> 
Değerlendirmenize sunar, 
İyi çalışmalar dileriz.<br /> <br /> 

<b style="color:red;"><?php echo e(Auth::user()->name); ?></b> / Proje Koordinatörü<br /> 
Temsilci Gsm: <b style="color:red;"><?php echo e(Auth::user()->number); ?></b><br /> 
Çağrı Merkezi:  <a href="tel:4448286">444 82 86</a><br /> 
www.portakaltercume.com.tr<br /><br />  

FİRMAMIZIN TÜM ÖDEME KANALLARI AŞAĞIDA Kİ GİBİDİR. <br /> 

1- EFT YA DA HAVALE<br />  
HESAP ADI: PORTAKAL TERCÜME VE MEDYA A.Ş. KUVEYTTÜRK KATILIM BANKASI<br />  
<b style="color:red;">IBAN NO: TR170020500009380768500001</b>

HESAP ADI: PORTAKAL TERCÜME VE MEDYA A.Ş. ZİRAAT BANKASI
IBAN NO: TR860001000485758944095001<br />  
2- İNTERNET SİTEMİZ ÜZERİNDEN VISA-MASTERCARD YA DA AMERICAN EXPRESS KREDİ KARTLARIYLA ÖDEME YAPABİLİRSİNİZ. https://www.portakaltercume.com/online-odeme/ 
<br />  
3- MAİL ORDER SİSTEMİ İLE ÖDEME YAPABİLİRSİNİZ.(FİRMAMIZDAN FORMU TALEP EDİNİZ)
              
                      
              </div> 




               <div class="modal-body edit-content">
                    <input type="hidden" name="tekliffiyat" id="tekliffiyat1" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Kapat</button>
                   <button type="submit" disabled="false"  class="btn btn-success btn-fill disa">Gönder</button>
               </div>

</form>

           </div>
       </div>
</div>




<div id="edit-modal7" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Gelen Teklifi İptal Et</h4>
               </div>
<form action="<?php echo e(route('gelenteklifsil')); ?>" method="POST"/>
<?php echo e(csrf_field()); ?>

               <div class="form-group">
                 <label for="sel1">İptal Sebepleri</label>
                 <select class="form-control" name="iptalnedeni">
                  <?php $__currentLoopData = $iptalnedeni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iptalnedenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option value="<?php echo e($iptalnedenis->id); ?>"><?php echo e($iptalnedenis->IptalSebebi); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
               </div> 
            
                <div class="modal-body edit-content">
                    <input type="hidden" name="teklifsil" id="gelenteklifsil1" value=""/>
               </div>

               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                   <button type="submit" class="btn btn-success">Onayla</button>
               </div>

</form>

           </div>
       </div>
</div>






<script type="text/javascript">
  

var inputBox1=document.getElementById('gun');

inputBox1.onkeyup=function(){
    
    var test = document.getElementById('isgosterme').innerHTML = inputBox1.value;

}




var inputBox2=document.getElementById('saat');


inputBox2.onkeyup=function(){
    var test2=document.getElementById('saatgosterme').innerHTML = inputBox2.value;

}







var inputBox= document.getElementById('evrakfiyati');


inputBox.onkeyup = function(){
    var test = document.getElementById('evraklifiyat').innerHTML = inputBox.value;

}

$(function(){
  $('#teslimzamani').change(function(){
      if( $(this).val() == '2'){
          $('#isgosterme').html('');
          $('input[name="isgunu"]').val('');


        $('.saatText').show();
        $('.gunText').hide();
      }
      if( $(this).val() == '1'){
        $('#saatgosterme').html('');
        $('input[name="issaati"]').val('');

         $('.saatText').hide();
         $('.gunText').show();

      }
      console.log($(this).val());
  })
})



</script>






<script type="text/javascript">
  

    $(document).ready(function() {
     
      $('#datatables').DataTable({
          "ordering": false,
          "stateSave": false,

          "pagingType": "full_numbers",
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          responsive: true,
          // dom: 'Bfrtip',
          // buttons: [
              
          //       {
          //       extend: 'excelHtml5',
          //       exportOptions: {
          //           columns: [0,1,2,3,4,5,6,7,8,9]
          //       }
          //   },




          // ],
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