@extends('admin.master.master')
@section('title')
    TERCÜMAN SONUÇ SAYFASI
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





<form action="{{ route('tercumanara')  }}" method="POST" class="pl0">
    {{ csrf_field() }}



    <div class="col-md-3">
        <div class="form-group ">
            <select class="form-control" id="exampleFormControlSelect1" name="dil2">
                @foreach($diller as $dillers)
                    <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-md-3">
        <select name="calisilan2" class="form-control">
            <option value="3">Sık Çalıştığımız Tercumanlar</option>
            <option value="2">Onaylanan Tercumanlar</option>
        </select>
    </div>

    <input type="submit" class="btn btn-fill btn-success" value="Ara">

</form>



<div class="fresh-datatables">
  <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
     <thead>
       <tr>
           <th data-sortable="true">İD</th>
           <th data-sortable="true">İSİM SOYİSİM</th>
           <th data-sortable="true">E-POSTA</th>
           <th data-sortable="true">TELEFON</th>
           <th data-sortable="true">DİL</th>
           <th data-sortable="true">FİYAT</th>
           <th data-sortable="true">REFERANSLAR</th>
           <th data-sortable="true">TEMSİLCİ NOT</th>
           <th data-sortable="true">İŞLEMLER</th>

       </tr>
     </thead>
     <tbody>


       @foreach ($result as $results)

	       	<tr>
		         <td>{{ $results->id    }}</td>
		         <td>{{ mb_strtoupper($results->isimSoyisim) }}</td>
             <td>{{ mb_strtoupper($results->Mail) }}</td>
             <td>{{ $results->Telefon }}</td>
		         <td>
		          {{$results->KaynakDil}}>{{$results->HedefDil}}</br>
	 	         </td>
               <td>
                
              {{ $results->BirimFiyat }}TL

              </td>
                <td>{{ $results->Referanslar  }}</td>
              <td>
                
              {{ $results->temsilciNot}}

              </td>
              <td><a href="#myModal" data-toggle="modal" id="{{ $results->id }}" data-target="#edit-modal20"><i class="fa fa-trash-o">SİL</a></td>
       		</tr>
     @endforeach
     </tbody>
   </table>
</div>





<div id="edit-modal20" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Sonuç Tercuman Sil</h4>
               </div>
<form action="{{ route('tercumansil2') }}" method="POST"/>
{{ csrf_field() }}
           
            <h3>Seçilen Tercumanı Silmek İstiyor Musunuz ?</h3>

               <div class="modal-body edit-content">
                    <input type="hidden" name="tercumansil2" id="tercumansil2" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                   <button type="submit" class="btn btn-success btn-fill">Tercumanı Sil</button>
               </div>

</form>

           </div>
       </div>
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