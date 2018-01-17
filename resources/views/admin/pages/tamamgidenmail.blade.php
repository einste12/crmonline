@extends('admin.master.master')
@section('title')
    TAMAMLANAN TEKLİF GİDEN MAİL SAYFASI
@endsection
@section('content')


    <div class="form-group">
      <label for="exampleInputEmail1">Teklif Verilen Tarih</label>
      <input type="text" class="form-control"  value="{{ $tamammaildetay->TeklifVerilenTarih }}" name="isimSoyisim" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Müşteri Adı</label>
      <input type="text" class="form-control" value="{{ $tamammaildetay->isimSoyisim   }}"  name="Telefon" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">E-POSTA</label>
      <input type="email" class="form-control" value="{{  $tamammaildetay->Email  }}"   name="Email" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Telefon</label>
      <input type="text" class="form-control"  value="{{ $tamammaildetay->Telefon }}" name="KaynakDil" readonly="">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">TeklifVerenTemsilci</label>
      <input type="text" class="form-control"  value="{{ $tamammaildetay->temsilci['isimSoyisim'] }}"  name="HedefDil" readonly="">
    </div>
 

 <div class="form-group">
<label for="exampleInputPassword1">NOT EKLE</label><textarea name="" class="form-control" readonly="">{{ $tamammaildetay->TemsilciProjeNot }}</textarea>
​</div>



    <div class="form-group">
  <label for="comment">Giden Mail</label>
  <textarea class="form-control" rows="5" id="comment" readonly="">
@if($tamammaildetay->GonderilenMailEvrakTuru==1)
Sayın {{ $maildetay->isimSoyisim }},
Göndermiş olduğunuz belgenin yeminli tercüme ücreti​ {{ $maildetay->Fiyat }}TL + %18 KDV'dir.
Verilen fiyat yeminli tercüme hizmeti içindir.
Noter tasdik ücreti ve Apostil hizmeti verilen fiyata dahil değildir.
Değerlendirmenize sunar, iyi çalışmalar dileriz.



{{ $tamammaildetay->temsilci['isimSoyisim'] }} / Proje Koordinatörü
Temsilci Gsm: {{ $tamammaildetay->temsilci['Telefon']  }}
Çağrı Merkezi:  444 82 86
www.portakaltercume.com.tr

FİRMAMIZIN TÜM ÖDEME KANALLARI AŞAĞIDA Kİ GİBİDİR.

1- EFT YA DA HAVALE</br>
HESAP ADI: PORTAKAL TERCÜME VE MEDYA A.Ş. KUVEYTTÜRK KATILIM BANKASI</br>
IBAN NO: TR170020500009380768500001</br>

HESAP ADI: PORTAKAL TERCÜME VE MEDYA A.Ş. ZİRAAT BANKASI</br>
IBAN NO: TR860001000485758944095001</br>

2- İNTERNET SİTEMİZ ÜZERİNDEN VISA-MASTERCARD YA DA AMERICAN EXPRESS KREDİ KARTLARIYLA ÖDEME YAPABİLİRSİNİZ. https://www.portakaltercume.com/online-odeme/
</br>
3- MAİL ORDER SİSTEMİ İLE ÖDEME YAPABİLİRSİNİZ.(FİRMAMIZDAN FORMU TALEP EDİNİZ)

      @else

Sayın {{ $tamammaildetay->isimSoyisim }},
Çevirisini yaptırmak istediğiniz dosyalarınızı bize maille gönderebilirseniz inceleyip size fiyat ve süre hakkında bilgi verebiliriz.</br>
1- ​Hızlı teklif almak için https://www.portakaltercume.com/fiyat-teklifi-al/ adresinden belgelerinizi bize gönderebilirsiniz.</br>

2- Evraklarınızı ​ +90 543 953 21 75 nolu telefona WhatsApp programı üzerinden belgenizin resmini çekerek gönderebilirsiniz​.<br /> <br />

3- ​info@portakaltercume.com.tr adresine mail atabilirsiniz.<br /> <br />

Değerlendirmenize sunar,</br>
İyi çalışmalar dileriz.</br></br>

{{ $tamammaildetay->temsilci['isimSoyisim'] }} / Proje Koordinatörü</br>
Temsilci Gsm:  {{ $tamammaildetay->temsilci['Telefon']  }}</br>
Çağrı Merkezi:  444 82 86</br>
www.portakaltercume.com.tr</br>


      @endif

  </textarea>
</div>
   




<a href="{{ url('tamamlanan') }}" role="button" class="btn btn-warning btn-fill"><i class="fa fa-angle-left"></i>Geri Dön</a>


@endsection
