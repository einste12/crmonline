@extends('admin.master.master')
@section('title')
    İPTAL EDİLEN TEKLİFLER
@endsection
@section('content')

<p>İPTAL TEKLİF</p>

 
  <div class="fresh-datatables">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
           <th data-sortable="true">İD</th>
           <th data-sortable="true">İPTAL EDİLEN TARİH</th>
           <th data-sortable="true">İPTAL EDEN TEMSİLCİ</td>
           <th data-sortable="true">DİLLER</th>
           <th data-sortable="true">TASDİK ŞEKLİ</th>
           <th data-sortable="true">MÜŞTERİ BİLGİLERİ</th>
           <th data-sortable="true">FİYAT VE KAPORA</th>
           <th data-sortable="true">İPTAL NEDENİ</td>
       </tr>
     </thead>
     <tbody>
       @foreach ($iptalteklif as $teklifler)
       <tr>
         <td>{{ $teklifler->id }}</td>
         <td>{{ $teklifler->iptalTarihi }}</td>
         <td> {{$teklifler->temsilci_iptal['isimSoyisim']  }}</td>
         <td>
           {{ $teklifler->KaynakDil }} > </br>
           {{ $teklifler->HedefDil }}
         </td>
         <td>@if($teklifler->TasdikSekli==1) Yeminli Tercume  @elseif ($teklifler->TasdikSekli==2) Noter Tasdikli Tercume @elseif($teklifler->TasdikSekli==3) Apostil Tercume @else($teklifler->TasdikSekli==9) Bilmiyorum @endif</td>
         <td>
          {{ $teklifler->isimSoyisim }}</br>
          {{ $teklifler->Telefon }}</br>
          {{ $teklifler->Email }}
        </td>

           <td class="col-md-1">
               Fiyat: {{ (!empty($teklifler->Fiyat))? $teklifler->Fiyat : '0'}}TL</br>
               Kapora: {{ (!empty($teklifler->Kapora))?  $teklifler->Kapora : '0'}} TL

           </td>
         
         <td>{{ $teklifler->iptalneden['IptalSebebi']  }}  </td>
       </tr>
       @endforeach
     </tbody>
   </table>
</div>






<script type="text/javascript">
  

    $(document).ready(function() {
     
      $('#datatables').DataTable({
          "ordering": true,
          "stateSave": true,  
          "pagingType": "full_numbers",
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          responsive: true,
          dom: 'Bfrtip',
          buttons: [
              'excelHtml5',

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
