@extends('admin.master.master')
@section('title')
   Online Ödeme
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
           <th data-sortable="true">ÖDEME TARİHİ</th>
           <th data-sortable="true">MÜŞTERİ BİLGİLERİ</th>
           <th data-sortable="true">TELEFON</th>
           <th data-sortable="true">MAİL</th>
           <th data-sortable="true">ADRES</th>
           <th data-sortable="true">KART BİLGİLERİ</th>
           <th data-sortable="true">ÖDEME TUTARI</th>
           <th data-sortable="true">DURUM</th>
       </tr>
     </thead>
     <tbody> 
       @foreach ($data as $datas)
       <tr>
         <td>{{ $datas->id }}</td>
         <td> {{ $datas->payment_date}}</td>
         <td class="col-md-2">{{ $datas->user_name }}
           {{ $datas->user_surname}}</td>
           <td> {{ $datas->user_phone}}</td>
           <td> {{ $datas->user_email}}</td>
           <td class="col-md-2"> {{ $datas->user_address}}</td>
           <td> {{ $datas->user_card_info}}</td>
           <td> {{ $datas->amount}} TL</td>
          <td> @if($datas->	is_success==1) Başarılı @else($datas->is_success==0)  Başarısız @endif</td>

       @endforeach
     </tbody>
   </table>
</div>



<script type="text/javascript">
  

    $(document).ready(function() {
     
      $('#datatables').DataTable({
          "order": [[ 0, "desc" ]],
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
