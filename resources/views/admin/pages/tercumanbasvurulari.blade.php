@extends('admin.master.master')
@section('title')
   TERCUMAN BAŞVURU SAYFASI
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


<form id="secili" method="POST" action="{{ URL::action('DashBoardController@coklutercumansil') }}">
    {{ csrf_field() }}

<div class="toolbar">
    <button class="btn btn-danger btn-fill seciliSil" type="button" style="margin-bottom: 20px;" ><i class="fa fa-2x fa-trash-o"></i>Toplu Sil</button>
</div>
  <div class="fresh-datatables">
     <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
        <th>Çoklu Sil</th>
           <th data-sortable="true">Başvuru Tarihi</th>
           <th data-sortable="true">Başvuru Amacı</th>
           <th data-sortable="true">İSİM SOYİSİM</th>
           <th data-sortable="true">E-POSTA</th>
           <th data-sortable="true">TELEFON</th>
           <th data-sortable="true">ÇEVİRİ YAPTIĞI DİL</th>
           <th data-sortable="true">SİMULTANE</th>
           <th data-sortable="true">REFERANSLAR</th>
           <th data-sortable="true">LOKASYON</th>
           <th data-sortable="true">İŞLEMLER</th>



       </tr>
     </thead>
     <tbody>




       @foreach ($tercumanbasvurulari as $tercumans)

	       	<tr>
             <td><input type="checkbox" value="{{$tercumans->id}}" name="checked[]"><br /></td>
		         <td>{{ $tercumans->BasvuruTarihi }}</td>
<td>
 @if($tercumans->BasvuruAmaci==1) Hobi
    @elseif ($tercumans->BasvuruAmaci==2) Kendimi Geliştirmek
    @elseif($tercumans->BasvuruAmaci==3) Ek Gelir
    @elseif($tercumans->BasvuruAmaci==4) Öğrenci
    @elseif($tercumans->BasvuruAmaci==5) Profesyonel Tercuman
    @elseif($tercumans->BasvuruAmaci=="")Temsilci Ekledi
    
 @endif
                             
</td>
		         <td>{{ mb_strtoupper($tercumans->isimSoyisim) }}</td>
		         <td>{{ $tercumans->Mail}}  </td>
		         <td>{{ $tercumans->Telefon}}  </td>
		         <td>
		            @foreach($tercumans->tercumandilbilgileri as $data) {{ $data->KaynakDil}}>{{$data->HedefDil}}={{ $data->BirimFiyat }}TL</br> @endforeach
		         </td>
                <td>@foreach($tercumans->tercumandilbilgileri as $data) @if($data->Tercume_Turu==1) Var @else Yok @endif</br>  @endforeach </td>
                <td>{{ $tercumans->Referanslar  }}</td>
		         <td> {{ mb_strtoupper($tercumans->Locasyon)}} </td>
		         <td>

                     <a title="Onayla" class="fa fa-fw fa-2x fa-check-circle-o" href="#myModal" data-toggle="modal" id="{{ $tercumans->id }}" data-target="#edit-modal4"></a>
                     <a title="Sil" class="fa fa-fw fa-2x fa-trash-o" href="#myModal" data-toggle="modal" id="{{ $tercumans->id }}" data-target="#edit-modal30"></a>

		         </td>
       		</tr>
     @endforeach
           </tbody>

         </table>


   
 </div>
</form>




<div id="edit-modal4" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Seçilen Tercümanı  Onayla</h4>
               </div>
<form action="{{ route('tercumanbasvuruonayla') }}" method="POST"/>
{{ csrf_field() }}
           
           	<h4>Basvuruyu Onaylamak İstiyor Musunuz ?</h4>

               <div class="modal-body edit-content">
                    <input type="hidden" name="basvuruonay" id="basvuruonay" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default btn-fill" data-dismiss="modal"><i class="fa fa-close"></i>Hayır</button>
                   <button type="submit" class="btn btn-success btn-fill"><i class="fa fa-check"></i>Evet</button>
               </div>

</form>

           </div>
       </div>
</div>

{{-- TERCUMAN BASVURU SİLME MODALI --}}
<div id="edit-modal30" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Seçilen Tercümanı Sil</h4>
            </div>
            <form action="{{ route('tercumanbasvurusil') }}" method="POST"/>
            {{ csrf_field() }}

            <h4> Basvuruyu Silmek İstiyor Musunuz ?</h4>

            <div class="modal-body edit-content">
                <input type="hidden" name="basvurusil" id="basvurusil" value=""/>
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

$("td").click(function(e) {
    var chk = $(this).closest("tr").find("input:checkbox").get(0);
    if (e.target != chk)
}
        chk.checked = !chk.checked;
    }
});

});

</script>

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