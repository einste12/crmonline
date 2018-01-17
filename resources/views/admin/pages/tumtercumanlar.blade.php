@extends('admin.master.master')
@section('title')
    TÜM TERCUMANLAR
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

    <input type="submit" class="btn btn-fill btn-success btn-fill" value="Ara">

</form>




<div class="fresh-datatables">
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
           <th data-sortable="true">İD</th>
           <th data-sortable="true">İSİM SOYİSİM</th>
           <th data-sortable="true">EPOSTA</th>
           <th data-sortable="true">TELEFON</th>
           <th data-sortable="true">ÇEVİRİ YAPTIĞI DİLLER</th>
           <th data-sortable="true">SİMULTANE</th>
           <th data-sortable="true">TEMSİLCİ NOT</th>
           <th data-sortable="true">REFERANSLAR</th>
           <th data-sortable="true">İŞLEMLER</th>



       </tr>
     </thead>
     <tbody>



       @foreach ($tercumanlist as $tercumans)

       <tr>
         <td>{{ $tercumans->id }}</td>
         <td>{{ $tercumans->isimSoyisim }}</td>
         <td>{{ $tercumans->Mail }}</td>
         <td>{{ $tercumans->Telefon}}  </td>
         <td>
            @foreach($tercumans->tercumandilbilgileri as $data) {{ $data->KaynakDil}}>{{$data->HedefDil}}={{ $data->BirimFiyat }}TL<br> @endforeach
         </td>
         <td>@foreach($tercumans->tercumandilbilgileri as $data) @if($data->Tercume_Turu==1) Var @else Yok @endif</br>  @endforeach </td>
         <td> {{$tercumans->temsilciNot}} </td>
         <td>{{ $tercumans->Referanslar  }}</td>

    <td>
      <a title="Güncelle" class="fa fa-fw fa-2x fa-pencil" href="{{ route('tercumanduzenle',['id'=>$tercumans->id]) }}" ></a>
      <a title="Sil" class="fa fa-fw fa-2x fa-trash-o" href="#myModal" data-toggle="modal" id="{{ $tercumans->id }}" data-target="#edit-modal10"></a>
    </td>



       </tr>
     @endforeach
     </tbody>
   </table>
 </div>


<div id="edit-modal10" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Seçilen Tercümanı Sil</h4>
               </div>
<form action="{{ route('tercumansil') }}" method="POST"/>
{{ csrf_field() }}
           
            <h3>Tercümanı Silmek İstiyor Musunuz ?</h3>

               <div class="modal-body edit-content">
                    <input type="hidden" name="tercumansil" id="tercumansil" value=""/>
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
