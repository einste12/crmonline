@extends('admin.master.master')
@section('title')
 Onay Bekleyenler - Panel
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

  <div class="fresh-datatables">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
           <th data-sortable="true">İD</th>
           <th data-sortable="true">GELEN TEKLİF TARİHİ</th>
           <th data-sortable="true">TEKLİF VERİLEN TARİH</th>
           <th data-sortable="true">MÜŞTERİ BİLGİLERİ</th>
           <th data-sortable="true">DİLLER</th>
           <th data-sortable="true">DOSYA</th>
           <th data-sortable="true">FİYAT VE KAPORA</th>
           <th data-sortable="true">MÜŞTERİ TALEBİ</th>
           <th data-sortable="true">TEMSİLCİ PROJE NOT</th>
           <th data-sortable="true">İŞLEMLER</th>

       </tr>
     </thead>
     <tbody>
       @foreach ($onaybekleyen as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->GelenTeklifTarihi }}</td>
         <td class="col-md-2">
             {{ $teklifler->TeklifVerilenTarih }}</br>
            {{ $teklifler->temsilci['isimSoyisim']}}
         </td>

         <td>
         {{ $teklifler->isimSoyisim }}</br>
         {{ $teklifler->Telefon }}</br>
         {{ $teklifler->Email }}
       </td>


         <td class="col-md-2">{{ $teklifler->KaynakDil }}</br>
             {{ $teklifler->HedefDil }}</br>
            @if($teklifler->TasdikSekli==1) Yeminli Tercume  @elseif ($teklifler->TasdikSekli==2) Noter Tasdikli Tercume @elseif($teklifler->TasdikSekli==3) Apostil Tercume  @elseif($teklifler->TasdikSekli==9) Bilmiyorum @endif
         </td>
       <td>  @php
                $url="https://portakaltercume.net/crm/dosya/";
            @endphp 
          @foreach($teklifler->oftdosya as $dosya)
          
          @php

               $dosyaurl = $url.'onaybekleyenler'.'/'.$dosya->oftid.'/'.$dosya->orjisim;
          
          @endphp          
             <a target="_blank" href="{{ $dosyaurl.'.'.$dosya->uzanti }}">{{ $dosya->orjisim.''.$dosya->uzanti  }}</a><br/>
           @endforeach
         <td class="col-md-1">
        Fiyat: {{ (!empty($teklifler->Fiyat))? $teklifler->Fiyat : '0'}}TL</br>
        Kapora: {{ (!empty($teklifler->Kapora))?  $teklifler->Kapora : '0'}} TL

         </td>

         <td class="col-md-2">{{ $teklifler->MusteriTalebi }}</td>


         <td>
          {{ $teklifler->TemsilciProjeNot }}</br>
          Tercüman:{{ (!empty($teklifler->tercuman['isimSoyisim']))? $teklifler->tercuman['isimSoyisim'] : 'BELİRTİLMEDİ'}} 
        </td>
         <td>
           <a  title="Onayla" href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal" class="fa fa-fw fa-2x fa-check-circle-o"></a>
             @if(Auth::user()->id==$teklifler->TeklifVerenTemsilci or Auth::user()->role==99)
                <a  title="Güncelle" href="{{ route('onaybekleyenedit',['id'=>$teklifler->id]) }}" class="fa fa-fw fa-2x fa-pencil"></a>
             @endif
           <a  title="Yazdır" target="_blank" href="{{ route('onaybekleyenyazdir',['id'=>$teklifler->id]) }}" class="fa fa-fw fa-2x fa-print hidden"></a>
           <a  title="Giden Mail" href="{{ route('onaygidenmail',['id'=>$teklifler->id]) }}" class="fa fa-fw fa-2x fa-envelope-o"> </a>
           <a  title="Sil" href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal8" class="fa fa-fw fa-2x fa-trash-o"></a>
         </td>
       </tr>
    @endforeach
     </tbody>
   </table>
 </div>



<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Bu Projeyi Devam Edenlere Taşı</h4>
               </div>
<form action="{{ route('gelenteklifonayla') }}" method="POST"/>
{{ csrf_field() }}
       {{--         <div class="form-group">
                 <label for="sel1">Bu İşi Onaylamak İstiyor Musunuz?</label>
                 <select class="form-control" name="onaylayantemsilci">
                  @foreach($temsilci as $temsilcis)
                   <option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
                 @endforeach
                 </select>
               </div> --}}

               BU PROJEYE ONAY VERMEK İSTİYOR MUSUNUZ ?

               <div class="modal-body edit-content">
                    <input type="hidden" name="bookId" id="bookId" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default btn-fill" data-dismiss="modal"><i class="fa fa-close"></i>Hayır</button>
                   <button type="submit" class="btn btn-success btn-fill"><i class="fa fa-check"></i>Evet</button>
               </div>

</form>

           </div>
       </div>
</div>

{{-- Silme Modalı --}}

<div id="edit-modal8" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Teklifi İptal Et</h4>
               </div>
<form action="{{ route('onaysil') }}" method="POST"/>
{{ csrf_field() }}
               <div class="form-group hidden">
                 <label for="sel1">İptal Eden  Temsilciyi Seçiniz:</label>
                 <select class="form-control" name="OnayİptalEdenTemsilci">
                  @foreach($temsilci as $temsilcis)
                   <option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
                 @endforeach
                 </select>
               </div>
               <div class="form-group">
                 <label for="sel1">İptal Sebepleri:</label>
                 <select class="form-control" name="Onayiptalnedeni">
                  @foreach($iptalnedeni as $iptalnedenis)
                   <option value="{{ $iptalnedenis->id }}">{{ $iptalnedenis->IptalSebebi }}</option>
                 @endforeach
                 </select>
               </div> 
            


               <div class="modal-body edit-content">
                    <input type="hidden" name="onaybekleyensil" id="onaybekleyensil" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default btn-fill" data-dismiss="modal"><i class="fa fa-close"></i>Hayır</button>
                   <button type="submit" class="btn btn-success btn-fill"><i class="fa fa-check"></i>Evet</button>
               </div>

</form>

           </div>
       </div>
</div>




<script type="text/javascript">
  

    $(document).ready(function() {
     
      $('#datatables').DataTable({
          "order": [[ 2, "desc" ]],
          "ordering": true,
          "stateSave": true,

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


    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <style>

        .col-md-2 {
            width: 15.666667% !important;
        }

    </style>


@endsection
