@extends('admin.master.master')
@section('title')
    MALİYET SONUÇ SAYFASI
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




<form action="{{ route('maliyetara')  }}" method="POST" class="pl0">
    {{ csrf_field() }}



    <div class="col-md-3">
        <div class="form-group ">
            <select class="form-control" id="exampleFormControlSelect1" name="dil">
                @foreach($diller as $dillers)
                    <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-md-3">
        <select name="calisilan" class="form-control">
            <option value="3">Sık Çalıştığımız Tercumanlar</option>
            <option value="2">Onaylanan Tercumanlar</option>
        </select>
    </div>

    <input type="submit" class="btn btn-fill btn-success btn-fill" value="Ara">

</form>



<div class="fresh-datatables">
  <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
         <th data-sortable="true">İSİM SOYİSİM</th>
         <th data-sortable="true">ÇEVİRİ YAPTIĞI DİL</th>
         <th data-sortable="true">FİYAT</th>
         
       </tr>
     </thead>
     <tbody>



       @foreach ($result as $results)

	       	<tr>
		         
		         <td>{{ mb_strtoupper($results->isimSoyisim) }}</td>
		         <td>
		          {{$results->KaynakDil}}>{{$results->HedefDil}}</br>
	 	         </td>
              <td>
                
              {{ $results->BirimFiyat }}TL

              </td>
       		</tr>
     @endforeach
     </tbody>
   </table>




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








@endsection