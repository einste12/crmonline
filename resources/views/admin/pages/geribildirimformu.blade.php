@extends('admin.master.master')
@section('title')
  Geri Bildirim Formu - Panel
@endsection
@section('content')


 
  <div class="fresh-datatables">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
           <th data-sortable="true">İD</th>
           <th data-sortable="true">İSİM SOYİSİM</th>
           <th data-sortable="true">TELEFON</td>
           <th data-sortable="true">MAİL</th>
           <th data-sortable="true">KATEGORİ</th>
           <th data-sortable="true">MESAJ</th>
           <th data-sortable="true">NEDEN</th>
           <th data-sortable="true">CEVAP</td>
           <th data-sortable="true">TARİH</td>
       </tr>
     </thead>
     <tbody>
       @foreach ($gb as $gbs)
       <tr>
         <td>{{ $gbs->id }}</td>
         <td>{{ $gbs->isimSoyisim }}</td>
         <td> {{$gbs->Telefon }}</td>
         <td>{{ $gbs->Mail }}</td>
         <td>{{ $gbs->Kategori }}</td>
         <td>{{ $gbs->Mesaj }}</td>
         <td>{{ $gbs->Neden }}</td>
         <td>{{ $gbs->Cevap }}</td>
         <td>{{ $gbs->Tarih }}</td>
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
