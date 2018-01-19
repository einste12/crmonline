@extends('admin.master.master')
@section('title')
   Tamamlananlar - Panel
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
         <th   data-sortable="true">İD</th>
           <th data-sortable="true">EVRAK TESLİM TARİHİ</th>
           <th data-sortable="true">Müşteri Bilgileri</th>
           <th data-sortable="true">DİLLER</th>
           <th data-sortable="true">Tasdik Şekli</th>
           <th data-sortable="true">Fiyat Ve Kapora</th>
           <th data-sortable="true">DOSYA</th>
           <th data-sortable="true">MÜŞTERİ TALEBİ</th>
           <th data-sortable="true">Mesleki Uzmanlik</th>
           <th data-sortable="true">ONAY VEREN TEMSİLCİ</th>
           <th data-sortable="true">TEMSİLCİ NOT</th>
           <th data-sortable="true">İŞLEMLER</th>
       </tr>
     </thead>
     <tbody>
       @foreach ($tamamlananteklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>

         <td>
           {{ $teklifler->EvrakTeslimTarihi }}
         </td>
          <td>
             {{ $teklifler->isimSoyisim }}
             {{ $teklifler->Telefon }}
             {{ $teklifler->Email }}
         </td>
         <td>
           {{ $teklifler->KaynakDil }} > </br>
           {{ $teklifler->HedefDil }}
       </td>
         <td>@if($teklifler->TasdikSekli==1) Yeminli Tercume  @elseif ($teklifler->TasdikSekli==2) Noter Tasdikli Tercume @elseif($teklifler->TasdikSekli==3) Apostil Tercume @else($teklifler->TasdikSekli==9) Bilmiyorum @endif</td>

           <td class="col-md-1">
               Fiyat: {{ (!empty($teklifler->Fiyat))? $teklifler->Fiyat : '0'}}TL</br>
               Kapora: {{ (!empty($teklifler->Kapora))?  $teklifler->Kapora : '0'}} TL

           </td>

          <td>

              @php
                  $url="https://portakaltercume.net/crm/dosya/";
              @endphp
              @foreach($teklifler->oftdosya as $dosya)

                  @php

                      $dosyaurl = $url.'tamamlananlar'.'/'.$dosya->oftid.'/'.$dosya->orjisim;

                  @endphp
                  <a target="_blank" href="{{ $dosyaurl }}">{{ $dosya->orjisim.''.$dosya->uzanti  }}</a>@endforeach


          </td>
         <td>{{ $teklifler->MusteriTalebi }}</td>
         <td>{{(!empty($teklifler->MeslekiUzmanlik))? $teklifler->MeslekiUzmanlik : ''}}</td>
         <td>{{ $teklifler->temsilci2['isimSoyisim']  }}  </td>

         <td>{{ $teklifler->TemsilciProjeNot }}</td>
         <td>
           <a  title="Güncelle" class="fa fa-fw fa-2x fa-pencil" href="{{ route('tamamlananedit',['id'=>$teklifler->id]) }}" ></a>
           <a  title="Güncelle" class="fa fa-fw fa-2x fa-print hidden" target="_blank" href="{{ route('tamamlananyazdir',['id'=>$teklifler->id]) }}" ></a>
           <a  title="Giden Mail" class="fa fa-fw fa-2x fa-envelope-o" href="{{ route('tamamgidenmail',['id'=>$teklifler->id]) }}" > </a>
           
         </td>
       </tr>
       @endforeach
     </tbody>
   </table>
 </div>




<script type="text/javascript">
  

    $(document).ready(function() {
     
      $('#datatables').DataTable({
          "order": [[ 1, "desc" ]],
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



@endsection
