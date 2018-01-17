@extends('admin.master.master')
@section('title')
    İPTAL EDİLEN GÜNCELLEME SAYFASI
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


  <form action="{{route('istakipupdate',$istakip->id)}}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="exampleInputEmail1">Evrak Alma Tarihi</label>
      <input type="datetime" class="form-control"  value="{{ $istakip->EklenmeTarih }}" name="EklenmeTarih">
    </div>
      <div class="form-group">
          <label for="exampleInputEmail1">Proje Adi</label>
          <input type="textarea" class="form-control"  value="{{ $istakip->ProjeAdi }}" name="ProjeAdi">
      </div>
      <div class="form-group">
     <label class=" control-label">Tercuman Seçiniz </label>
      <select class="form-control" name="TercumanAdi">
        @foreach($tercumanlar as $tercumans)
          <option value="{{ $tercumans->isimSoyisim }}">{{ $tercumans->isimSoyisim }}</option>
        @endforeach
     </select>
   </div>

      <div class="row">
   <div class="form-group col-md-6">
    <label class=" control-label">Kaynak Dil</label>
     <select class="form-control" name="KaynakDil">
     
        @foreach($diller as $dillers)
          <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
        @endforeach
     </select>
   </div>
   <div class="form-group col-md-6">
    <label class=" control-label">Hedef Dil</label>
     <select class="form-control" name="HedefDil">
        @foreach($diller as $dillers)
          <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
        @endforeach
     </select>
   </div>
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">Birim Fiyat</label>
          <input type="text" class="form-control"   value="{{ $istakip->BirimFiyat }}"  name="BirimFiyat">
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">Karakter</label>
          <input type="text" class="form-control" pattern=".{3,}" title="En 3 Karakter Girmeniz Gerekmektedir!" value="{{ $istakip->Karakter }}"  name="Karakter">
      </div>

      <div class="form-group">
      <label for="exampleInputPassword1">Gönderen Yer</label>
      <input type="text" class="form-control"  placeholder="{{ $istakip->subeler['name'] }}" value=""  name="" readonly>
    </div>



      <div class="form-group">
          <label for="exampleInputEmail1">Temsilci</label>
          <input type="text" class="form-control"  placeholder="{{ $istakip->temsilci['isimSoyisim'] }}" value=""  name="" readonly>
      </div>



    <div class="form-group">
      <label for="exampleInputEmail1">Not Ekle</label>
        <textarea name="TercumanTakipNot" class="form-control" id="" cols="15" rows="5">{{ $istakip->TercumanTakipNot }} </textarea>
    </div>


    <button type="submit" class="btn btn-success btn-fill">GÜNCELLE</button>
  </form>






@endsection
