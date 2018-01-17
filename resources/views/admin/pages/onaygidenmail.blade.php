,@extends('admin.master.master')
@section('title')
    ONAY GİDEN MAİL SAYFASI
@endsection
@section('content')


    <div class="form-group">
      <label for="exampleInputEmail1">Teklif Verilen Tarih</label>
      <input type="text" class="form-control"  value="{{ $maildetay->TeklifVerilenTarih }}" name="isimSoyisim" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Müşteri Adı</label>
      <input type="text" class="form-control" value="{{ $maildetay->isimSoyisim   }}"  name="Telefon" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">E-POSTA</label>
      <input type="email" class="form-control" value="{{  $maildetay->Email  }}"   name="Email" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Telefon</label>
      <input type="text" class="form-control"  value="{{ $maildetay->Telefon }}" name="KaynakDil" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">TeklifVerenTemsilci</label>
      <input type="text" class="form-control"  value="{{ $maildetay->temsilci['isimSoyisim'] }}"  name="HedefDil" readonly="">
    </div>

    <div class="form-group">
  <label for="comment">Giden Mail</label>
  <textarea class="form-control" rows="12" id="comment" readonly="">
@if($maildetay->GonderilenMailEvrakTuru==1)
Sayın {{ $maildetay->isimSoyisim }},
Göndermiş olduğunuz belgenin yeminli tercüme ücreti​ {{ $maildetay->Fiyat }}TL + %18 KDV'dir.
Verilen fiyat yeminli tercüme hizmeti içindir.
Noter tasdik ücreti ve Apostil hizmeti verilen fiyata dahil değildir.
Değerlendirmenize sunar, iyi çalışmalar dileriz.

{{ $maildetay->temsilci['isimSoyisim'] }} / Proje Koordinatörü
Temsilci Gsm: {{ $maildetay->temsilci['Telefon']  }}
Çağrı Merkezi:  444 82 86
www.portakaltercume.com.tr


@else

Sayın {{ $maildetay->isimSoyisim }}, 
Çevirisini yaptırmak istediğiniz dosyalarınızı bize maille gönderebilirseniz inceleyip size fiyat ve süre hakkında bilgi verebiliriz.</br>

1- ​Hızlı teklif almak için https://www.portakaltercume.com/fiyat-teklifi-al/ adresinden belgelerinizi bize gönderebilirsiniz.</br>

​2- Evraklarınızı ​ +90 543 953 21 75 nolu telefona WhatsApp programı üzerinden belgenizin resmini çekerek gönderebilirsiniz​.<br /> <br />

3- ​info@portakaltercume.com.tr adresine mail atabilirsiniz.<br /> <br />

Değerlendirmenize sunar,</br>
İyi çalışmalar dileriz.</br></br>

{{ $maildetay->temsilci['isimSoyisim'] }} / Proje Koordinatörü</br>
Temsilci Gsm:  {{ $maildetay->temsilci['Telefon']  }}</br>
Çağrı Merkezi:  444 82 86</br>
www.portakaltercume.com.tr</br>


@endif

  </textarea>



</div>




<a href="{{ url('onaybekleyen') }}" role="button" class="btn btn-warning btn-fill"><i class="fa fa-angle-left"></i>Geri Dön</a>
@endsection
