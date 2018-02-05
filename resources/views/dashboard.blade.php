@extends('admin.master.master')
@section('title')
    Gelen Teklifler - Panel
@endsection


@section('content')


  @if (alert()->ready())
    <script>
        swal({
          title: "{!! alert()->message() !!}",
          text: "{!! alert()->option('text') !!}",
          type: "{!! alert()->type() !!}"
        });
    </script>
@endif
  <div class="col-md-12">
      <div class="col-md-12">
          <button class="btn btn-danger btn-fill seciliSil2" type="button" style="margin-bottom: 20px;" ><i class="fa fa-2x fa-trash"></i>Toplu  Sil</button>
      </div>
  </div>

  <form id="secili2" method="POST" action="{{ URL::action('DashBoardController@toplugelenteklifsil') }}">
      {{ csrf_field() }}
      <div class="toolbar">

      </div>
  <div class="fresh-datatables">
     <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
         <th>Toplu Sil</th>
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
       @foreach($teklif as $teklifler)
       <tr>
         <td> <input type="checkbox" value="{{$teklifler->id}}" name="checked2[]"></td>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->GelenTeklifTarihi }}</td>
         <td>
          {{ empty($teklifler->isimSoyisim)? "isim girilmemiş": $teklifler->isimSoyisim }}</br>
          {{ $teklifler->Email }}</br>
          {{ $teklifler->Telefon }}
       </td>
         <td>
          {{ $teklifler->KaynakDil }} > </br>
          {{ $teklifler->HedefDil }}
       </td>

       <td>@if($teklifler->TasdikSekli==1) Yeminli Tercume  @elseif ($teklifler->TasdikSekli==2) Noter Tasdikli Tercume @elseif($teklifler->TasdikSekli==3) Apostil Tercume @elseif($teklifler->TasdikSekli==9) Bilmiyorum @endif</td>
       <td>{{(empty($teklifler->MeslekiUzmanlik))? '' : $teklifler->MeslekiUzmanlik }}</td>
         <td>
            @php
                $url="https://portakaltercume.net/crm/dosya/";
            @endphp
          @foreach($teklifler->oftdosya as $dosya)

          @php

               $dosyaurl = $url.'gelenteklifler'.'/'.$dosya->oftid.'/'.$dosya->orjisim;

          @endphp

                 <a target="_blank" href="{{ $dosyaurl.'.'.$dosya->uzanti }}">{{ $dosya->orjisim.'.'.$dosya->uzanti  }}  </a> <br/>
           @endforeach
         </td>
         <td>{{ $teklifler->MusteriTalebi }}</td>
         <td>
           <a title="Teklif Ver" href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal6" class="fa fa-fw fa-2x fa-check-circle-o"> </a>
           <a title="Sil" href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal7" class="fa fa-fw fa-2x fa-trash-o"></a>
         </td>
       </tr>
       @endforeach
     </tbody>
   </table>
</div>
  </form>





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



<form action="{{ route('gelentekliffiyatver') }}" onSubmit="return setForm()" method="POST"/>
{{ csrf_field() }}



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
                <select name="tastiksekli" id="tastiksekli1" class="form-control" required="">

                    <option value="" disabled="" selected>Tasdik Tipini Seçiniz</option>
                    <option value="2">Yeminli Tercüme</option>
                    <option value="1">Noter Tasdikli</option>
                    <option value="3">Apostil Tasdikli</option>



              </select>

              </div>

              <div class="hidden form-group col-md-6" id="teslimzamani1" style="padding:0px;">
                <label>Teslimat Zamanı</label>
                    <select name="teslimzamani" id="teslimzamani" class="form-control">
                        <option value="" selected="">Seçiniz</option>
                        <option value="1">Gün</option>
                        <option value="2">Saat</option>
                  </select>
              </div>





            <div class="hidden form-group col-md-6" id="isgunu">
               <label>Kaç İş Günü İçinde Verilecek?</label>

                  <input placeholder="Gün Giriniz" type="number" id="gun" name="isgunu" class="form-control">

              </div>


            <div class='printchatbox' id='printchatbox'></div>

              <div class="hidden form-group col-md-6" id="issaati">
               <label>Kaç Saat İçinde Verilecek?</label>

                  <input placeholder="Saat Giriniz" type="number" id="saat" name="issaati" class="form-control">

              </div>

               <div class="row">
                   <div class="hidden form-group col-md-12" id="fiyat">
                       <label>Fiyat</label>

                       <input placeholder="... tl" type="number" id="evrakfiyati" name="fiyat" class="form-control">

                   </div>
               </div>




               <div class="hidden form-group fiyatverbox" id="evraksiz">

Sayın <span class="ilkisim"></span>,<br />
Çevirisini yaptırmak istediğiniz dosyalarınızı bize maille gönderebilirseniz inceleyip size fiyat ve süre hakkında bilgi verebiliriz.<br /> <br />

​1- ​Hızlı teklif almak için https://www.portakaltercume.com/teklif-al/ adresinden belgelerinizi bize gönderebilirsiniz.<br />

​2- Evraklarınızı ​ {{Auth::user()->number}} nolu telefona WhatsApp programı üzerinden belgenizin resmini çekerek gönderebilirsiniz​.<br /> <br />

3- ​info@portakaltercume.com.tr adresine mail atabilirsiniz.<br /> <br />

Değerlendirmenize sunar, iyi çalışmalar dileriz.


<b style="color:red;">{{Auth::user()->name}}</b> / Proje Koordinatörü<br />
Temsilci Gsm:  <b style="color:red;">{{Auth::user()->number}}</b><br />
Çağrı Merkezi:  444 82 86<br />
www.portakaltercume.com.tr



              </div>


    <div class="hidden form-group fiyatverbox" id="evrakli">



Sayın <span id="isimSoyisim"></span>,<br />
Göndermiş olduğunuz belgenin <span id="ucret"> </span><span id="yeminli"></span><span id="notertasdik"></span><span style="color:red; font-weight:bold;" id="evraklifiyat"></span> <span style="color:red; font-weight:bold;" >TL</span> + %18 KDV’ dir.<span id="tasdikli"></span><span id="apostiltasdik"></span>
<span id="tasdiksiz"></span>
Ödemenin yapılması halinde belge/belgelerinizin tercümesi <span style="color:red; font-weight:bold;" id="isgosterme"></span> <span  class="gunText" style="color:red; display:none; font-weight:bold;">iş günü</span><span style="color:red; font-weight:bold;" id="saatgosterme" ></span> <span class="saatText" style="color:red;  display:none; font-weight:bold;">saat</span> içerisinde teslim edilecektir.<br />
Değerlendirmenize sunar, iyi çalışmalar dileriz.<br /><br/>

<span class="hidden">FİRMAMIZIN TÜM ÖDEME KANALLARI AŞAĞIDAKİ GİBİDİR. <br />

1- EFT YA DA HAVALE<br />
PORTAKAL TERCÜME VE MEDYA A.Ş. KUVEYTTÜRK KATILIM BANKASI<br />
IBAN NO: TR170020500009380768500001<br/>

PORTAKAL TERCÜME VE MEDYA A.Ş. ZİRAAT BANKASI<br/>
IBAN NO: TR860001000485758944095001<br />
2- İNTERNET SİTEMİZ ÜZERİNDEN VISA-MASTERCARD YA DA AMERICAN EXPRESS KREDİ KARTLARIYLA ÖDEME YAPABİLİRSİNİZ.
https://www.portakaltercume.com/online-odeme/
<br />
3- MAİL ORDER SİSTEMİ İLE ÖDEME YAPABİLİRSİNİZ.(FİRMAMIZDAN FORMU TALEP EDİNİZ)</span>
<br/>
{{Auth::user()->name}}</b> / Proje Koordinatörü<br />
Temsilci Gsm: <b style="color:red;">{{Auth::user()->number}}</b><br />
Çağrı Merkezi: <a href="tel:4448286">444 82 86</a><br />
www.portakaltercume.com.tr<br /><br />


    </div>




               <div class="modal-body edit-content">
                    <input type="hidden" name="tekliffiyat" id="tekliffiyat1" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Kapat</button>
                   <button type="submit"  class="btn btn-success btn-fill disa">Gönder</button>
               </div>

</form>

           </div>
       </div>
</div>


{{-- SiLME MODALI --}}

<div id="edit-modal7" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Gelen Teklifi İptal Et</h4>
               </div>
<form action="{{ route('gelenteklifsil') }}" method="POST"/>
{{ csrf_field() }}
               <div class="form-group">
                 <label for="sel1">İptal Sebepleri</label>
                 <select class="form-control" name="iptalnedeni">
                  @foreach($iptalnedeni as $iptalnedenis)
                   <option value="{{ $iptalnedenis->id }}">{{ $iptalnedenis->IptalSebebi }}</option>
                 @endforeach
                 </select>
               </div>

                <div class="modal-body edit-content">
                    <input type="hidden" name="teklifsil" id="gelenteklifsil1" value=""/>
               </div>

               <div class="modal-footer">
                   <button type="button" class="btn btn-default btn-fill" data-dismiss="modal"><i class="fa fa-close"></i> Hayır</button>
                   <button type="submit" class="btn btn-success btn-fill"><i class="fa fa-check"></i> Onayla</button>
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

@endsection
