@extends('admin.master.master')
@section('title')
   Devam Edenler - Panel
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
           <th data-sortable="true">TEKLİF VERİLEN TARİH VE TEMSİLCİ</th>
           <th data-sortable="true">MÜŞTERİ BİLGİLERİ</th>
           <th data-sortable="true">DİLLER</th>
           <th data-sortable="true">FİYAT ve KAPORA </th>
           <th data-sortable="true">TERCUMAN</th>
           <th data-sortable="true">DOSYA</th>
           <th data-sortable="true">TEMSİLCİ PROJE NOT</th>
           <th data-sortable="true">İŞLEMLER</th>
       </tr>
     </thead>
     <tbody> 
       @foreach ($devamteklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->GelenTeklifTarihi }}</td>
         <td>
          {{ $teklifler->TeklifVerilenTarih}}</br>
          {{ $teklifler->temsilci['isimSoyisim']}}
         </td>
         <td>
          {{ $teklifler->isimSoyisim }}</br>
          {{ $teklifler->Telefon }}</br>
          {{ $teklifler->Email }}
         </td>
         <td>
          {{$teklifler->KaynakDil}} > </br>
             {{$teklifler->HedefDil}}</br>

           @if($teklifler->TasdikSekli==1) Yeminli Tercume  @elseif ($teklifler->TasdikSekli==2) Noter Tasdikli Tercume @elseif($teklifler->TasdikSekli==3) Apostil Tercume @else($teklifler->TasdikSekli==9) Bilmiyorum @endif
         </td>


           <td class="col-md-1">
               Fiyat: {{ (!empty($teklifler->Fiyat))? $teklifler->Fiyat : '0'}}TL</br>
               Kapora: {{ (!empty($teklifler->Kapora))?  $teklifler->Kapora : '0'}} TL

           </td>

         <td>{{ $teklifler->tercuman['isimSoyisim'] }}</td>
         <td>

             @php
                 $url="https://portakaltercume.net/crm/dosya/";
             @endphp
             @foreach($teklifler->oftdosya as $dosya)

                 @php

                     $dosyaurl = $url.'onaylananlar'.'/'.$dosya->oftid.'/'.$dosya->orjisim;

                 @endphp
                 <a target="_blank" href="{{ $dosyaurl }}">{{ $dosya->orjisim.''.$dosya->uzanti  }}</a><br/>
             @endforeach


         </td>
         <td>{{ $teklifler->TemsilciProjeNot }}</td>
         <td>
           <a  title="Onayla" class="fa fa-fw fa-2x fa-check-circle-o" href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal2"></a>
           <a  title="Güncelle" class="fa fa-fw fa-2x fa-pencil" href="{{ route('devamedenedit',['id'=>$teklifler->id]) }}" ></a>
           <a  title="Yazdır" class="fa fa-fw fa-2x fa-print hidden" target="_blank" href="{{ route('devamedenyazdir',['id'=>$teklifler->id]) }}"></a>
           <a  title="Giden Mail" class="fa fa-fw fa-2x fa-envelope-o" href="{{ route('devamgidenmail',['id'=>$teklifler->id]) }}" > </a>
           <a  title="Sil"class="fa fa-fw fa-2x fa-trash-o" href="#myModal" data-toggle="modal" id="{{ $teklifler->id }}" data-target="#edit-modal9"></a>
         </td>
       </tr>
       @endforeach
     </tbody>
   </table>
</div>




<div id="edit-modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Projeyi Tamamla</h4>
               </div>
<form action="{{ route('tekliftamamla') }}" method="POST"/>
{{ csrf_field() }}

            <div class="row" >
                                        <div class="col-md-12">
                                              <div class="form-group">
                                              <label class=" control-label" for="tarih">Evrak Teslim Tarihi <star>*</star></label>  
                                              <div class='input-group date'>
                                                  <input id="tarih" required="true" placeholder="Evrak Teslim Tarihini Giriniz." name='EvrakTeslimTarihi' type='text' class="datetimepicker form-control" />
                                                  <label for="tarih" class="input-group-addon">
                                                      <span class="fa fa-calendar"></span>
                                                  </label>
                                              </div>
                                              </div>
                                           </div>
                                        </div>


          {{--      <div class="form-group">
                 <label for="sel1">Onaylayan Temsilciyi Seçiniz:</label>
                 <select class="form-control" name="devamionaylayantemsilci">
                  @foreach($temsilci as $temsilcis)
                   <option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
                 @endforeach
                 </select>
               </div> --}}

               <div class="modal-body edit-content">
                    <input type="hidden" name="devamedenid" id="devamedenid" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default btn-fill" data-dismiss="modal"><i class="fa fa-close"></i>Hayır</button>
                   <button type="submit" class="btn btn-success btn-fill"><i class="fa fa-check"></i>Evet</button>
               </div>

</form>

           </div>
       </div>
</div>


{{-- DEVAM EDEN SİL  --}}
<div id="edit-modal9" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Teklifi İptal Et</h4>
               </div>
<form action="{{ route('devamsil') }}" method="POST"/>
{{ csrf_field() }}
            {{--    <div class="form-group">
                 <label for="sel1">İptal Eden  Temsilciyi Seçiniz:</label>
                 <select class="form-control" name="DevamİptalEdenTemsilci">
                  @foreach($temsilci as $temsilcis)
                   <option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
                 @endforeach
                 </select>
               </div> --}}
               <div class="form-group">
                 <label for="sel1">İptal Sebepleri:</label>
                 <select class="form-control" name="Devamiptalnedeni">
                  @foreach($iptalnedeni as $iptalnedenis)
                   <option value="{{ $iptalnedenis->id }}">{{ $iptalnedenis->IptalSebebi }}</option>
                 @endforeach
                 </select>
               </div> 
            


               <div class="modal-body edit-content">
                    <input type="hidden" name="devamedensil" id="devamedensil" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default btn-fill" data-dismiss="modal"><i class="fa fa-close"></i> Hayır</button>
                   <button type="submit" class="btn btn-success btn-fill"><i class="fa fa-check"></i> Evet</button>
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
          "stateSave": false,  
          "pagingType": "full_numbers",
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          responsive: true,
          dom: 'Bfrtip',
               buttons: [
              
                {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
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
