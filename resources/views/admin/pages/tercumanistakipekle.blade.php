@extends('admin.master.master')
@section('title')
    Tercüman iş Takip Ekle - Panel
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


<form  id="teklifform" name="teklifform" action="{{ route('tercumanformistakipekle') }}"class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
<div class="col-md-6 col-md-offset-3" style="padding-left: 10px !important;">

    <div class="form-group">

        <label class="control-label">Tercüme Türü Seçiniz</label>
        <select name="TercumeTuru" class="form-control" id="TercumeTuru">
            <option value="" selected>Tercüme Türü Seçiniz...</option>
            <option value="1">Yazılı Tercüme</option>
            <option value="2">Sözlü Tercüme</option>
        </select>
    </div>

</div>



<div class=" col-md-6 col-md-offset-3 genel hidden" style="padding-top:40px; padding-bottom: 50px;">






<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
<div class="row"><legend>Yeni İş Takibi Ekle</legend></div>

    <div class="form-group">

        <label class="control-label" for="tarih">Tarih<star>*</star></label>
        <div class='input-group date'>
            <input id="tarih" required="true" placeholder="Evrak Tarihi Giriniz" name='EvrakAlmaTarihi' type='text' class="datetimepicker form-control" />
            <label for="tarih" class="input-group-addon">
                <span class="fa fa-calendar"></span>
            </label>
        </div>

    </div>
    <div class="form-group">
        <label class="control-label" for="ProjeAdi">Proje Adı </label>
        <input required="true" id="AdSoyad" name="ProjeAdi" type="text" placeholder="Proje Adı Giriniz" class="form-control input-md">
    </div>
    <div class="form-group">
        <label class="control-label">Tercuman Seçiniz</label>
        <select name="tercumanismi" class="form-control" id="TercumanAdi" required>
            <option value="" selected>Tercüman Seçiniz...</option>
            @foreach($tercumanlist as $tercumanlist1)
                <option   id="{{ $tercumanlist1->id  }}"  value="{{ $tercumanlist1->isimSoyisim  }}">{{ $tercumanlist1->isimSoyisim  }}</option>
            @endforeach
        </select>
    </div>


<div class="row">
    <div class="form-group">
        <div class="col-md-6">
            <label class="control-label" for="KaynakDil">Kaynak Dil</label>
            <select name="KaynakDil" class="form-control kaynakdil1">
                @foreach($diller as $dillers)
                    <option value="{{ $dillers->DilAdi  }}">{{ $dillers->DilAdi  }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="control-label" for="HedefDil">Hedef Dil  </label>
            <select name="HedefDil" class="form-control hedefdil1">
                @foreach($diller as $dillers)
                    <option value="{{ $dillers->DilAdi  }}">{{ $dillers->DilAdi  }}</option>
                @endforeach
            </select>

        </div>
    </div>


</div>


        <div class="form-group">
            <label class="control-label" for="BirimFiyat"><span class="hidden" id="birim">Birim</span> Fiyat  </label>
            <input required="true" id="BirimFiyats" name="BirimFiyat" type="text" placeholder="Birim Fiyat Giriniz" class="sayi form-control input-md">

          
        </div>

       <div class="form-group  hidden" id="karakters">
            <label class="control-label" for="Karakter">Karakter </label>  
            <input  required  pattern=".{3,}" title="En 3 Karakter Girmeniz Gerekmektedir!" name="Karakter" type="text" placeholder="Karakter Sayısını Giriniz" class=" form-control input-md" id="kar2">
       </div>
    <div class="form-group hidden" id="adets">
        <label class="control-label" for="Karakter">Adet</label>
        <input  name="Adet" type="number" placeholder="Adet Sayısını Giriniz" class="form-control input-md" required id="kar" >
    </div>

   {{--       
         <div class="form-group">
            <label class=" control-label" for="GonderenYer">Gönderen Yer </label>
            <select required="true" id="GonderenYer" name="GonderenYer" class="form-control">
                    @foreach($subeler as $subelers)
                          <option value="{{ $subelers->name  }}">{{ $subelers->name  }}</option>
                        @endforeach 
              </select>
            </select>
        </div> --}}


    {{--     <div class="form-group">
            <label class=" control-label" for="Temsilci">Temsilci</label>
               <select name="Temsilci" class="form-control">
                @foreach($temsilci as $temsilcis)
                  <option value="{{ $temsilcis->id  }}">{{ $temsilcis->isimSoyisim  }}</option>
                 @endforeach 
              </select>
  
       </div> --}}


       <div class="form-group">
         <label class="control-label" for="TercumanTakipNot">Not Ekle</label>
        
          <textarea type="text" name="TercumanTakipNot" id="TercumanTakipNot" rows="4" class="form-control input-md" placeholder="" tabindex="7"></textarea>
        
       </div>

       <div class="form-group" style="">
               <button type="submit" name="kayit" class="btn btn-warning btn-fill btn-wd btn-fill">Kaydet</button>
       </div>

    </div>
</form>



 @endsection