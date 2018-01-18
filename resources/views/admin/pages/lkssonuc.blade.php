@extends('admin.master.master')
@section('title')
    LKS ARAMA SONUÇLARI
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




<form action="{{ route('lksara')  }}" method="POST" class="pl0">
    {{ csrf_field() }}



    <div class="col-md-3">
        <div class="form-group">

            <select class="form-control" id="exampleFormControlSelect1" name="dil3">
                @foreach($diller as $dillers)
                    <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            <select name="temsilci3" class="form-control col-md-3">
                <label for="exampleFormControlSelect1">Temsilciler</label>
                @foreach($temsilci as $temsilcis)
                    <option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
                @endforeach

            </select>
        </div>
    </div>

    <input type="submit" class="btn btn-success btn-fill" value="Ara">

</form>



<div class="fresh-datatables">
  <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
     <thead>
       <tr>
           <th data-sortable="true">ID</th>
           <th data-sortable="true">EKLENME TARİHİ</th>
           <th data-sortable="true">TERCUMAN İSİM SOYİSİM</th>
           <th data-sortable="true">PROJE ADI</th>
           <th data-sortable="true">ÇEVİRİ YAPTIĞI DİL</th>
           <th data-sortable="true">KARAKTER</th>
           <th data-sortable="true">BİRİM FİYAT </th>
           <th data-sortable="true">TEMSİLCİ</th>
           <th data-sortable="true">PROJE NOT</th>
         
       </tr>
     </thead>
     <tbody>



       @foreach ($result as $results)

	       	<tr>
		         <td>{{ $results->id }}</td>
             <td>{{ $results->EklenmeTarih }}</td>
             <td>{{ $results->TercumanAdi }}</td>
             <td>{{ $results->ProjeAdi }}</td>
		         <td>
		          {{$results->KaynakDil}}>{{$results->HedefDil}}</br>
	 	         </td>
             <td>{{ $results->Karakter }}</td>
              <td>
              {{ $results->BirimFiyat }}TL
              </td>
              <td>{{ $results->isimSoyisim }}</td>
              <td>{{ $results->TercumanTakipNot}}</td>
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