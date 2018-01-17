@extends('admin.master.master')
@section('title')
    ONAY BEKLEYEN TEKLİFLER GÜNCELLEME SAYFASI
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


  <form action="{{route('onaybekleyenupdate',$teklif->id)}}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="exampleInputEmail1">İsim Ve Soyisim</label>
      <input type="text" class="form-control"  value="{{ $teklif->isimSoyisim }}" name="isimSoyisim" readonly>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Telefon</label>
      <input type="number" class="form-control" value="{{ $teklif->Telefon   }}"  name="Telefon" readonly>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">E-mail</label>
      <input type="email" class="form-control" value="{{  $teklif->Email  }}"   name="Email" readonly>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Kaynak Dil</label>
        <select  name="KaynakDil" class="form-control" readonly="">
            @foreach($diller as $dillers)
              <option  @if($teklif->KaynakDil==$dillers->DilAdi ) selected @endif value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
            @endforeach  
     </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Hedef Dil</label>
        <select  name="HedefDil" class="form-control" readonly="">
            @foreach($diller as $dillers)
              <option @if($teklif->HedefDil==$dillers->DilAdi ) selected @endif value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
            @endforeach  
        </select>
    </div>
    <div class="form-group">
     <label class=" control-label">Tastik Şekli </label>
      <select  name="TasdikSekli" class="form-control" readonly="">
       <option @if($teklif->TastikSekli == 1) selected @endif  value="1"> Yeminli Tercüme</option>
       <option @if($teklif->TastikSekli == 2) selected @endif  value="2"> Noter Yeminli Tercüme</option>
       <option @if($teklif->TastikSekli == 3) selected @endif  value="3"> Apostil Tasdikli Tercüme</option>
     </select>
   </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Kapora</label>
      <input type="number" class="form-control"  value="{{ $teklif->Kapora }}"  name="Kapora">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Fiyat</label>
      <input type="number" class="form-control"  value="{{ $teklif->Fiyat }}" name="Fiyat">
    </div>
   <div class="form-group">
      <label for="exampleInputEmail1">Tercuman Seçiniz</label>
            <select  name="TercumanID" class="form-control">
            @foreach($tercumanli as $tercumanlis)
              <option @if($tercumanlis->id==$teklif->tercuman['id'] ) selected @endif value="{{ $tercumanlis->id }}">{{ $tercumanlis->isimSoyisim }}</option>
            @endforeach  
        </select>
    </div>




    <div class="form-group">
      <label for="exampleInputEmail1">Müşterinin Talebi</label>
      <textarea  class="form-control"    name="MusteriTalebi" readonly="">{{ $teklif->MusteriTalebi }}</textarea>
    </div>
  
    
    <div class="form-group">
      <label for="exampleInputEmail1">Temsilci Gelen Not</label>
      <textarea  class="form-control"    name="TemsilciProjeNot" readonly>{{ $teklif->TemsilciProjeNot }}</textarea>
    </div>
    <div class="form-group hidden">
      <label for="exampleInputEmail1">Teklif Veren Temsilci</label>
            <select  name="TeklifVerenTemsilci" class="form-control">
            @foreach($temsilci as $temsilcis)
              <option @if($temsilcis->id==$teklif->temsilci['id'] ) selected @endif value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
            @endforeach  
        </select>
    </div>

    <button type="submit" class="btn btn-success btn-fill">GÜNCELLE</button>
  </form>






@endsection
