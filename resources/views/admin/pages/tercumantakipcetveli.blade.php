@extends('admin.master.master')
@section('title')
    Tercüman İş Takip Cetveli - Panel
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

<form id="secili1" method="POST" action="{{ URL::action('DashBoardController@toplulkstasi') }}">
    {{ csrf_field() }}
    <div class="toolbar">
        @if(Auth::user()->role===2 or Auth::user()->role==99)
         <button class="btn btn-success btn-fill seciliSil1" type="button" style="margin-bottom: 20px;" ><i class="fa fa-2x fa-check-square-o"></i> Toplu Taşı</button>
        @endif
    </div>
  <div class="fresh-datatables">
    <table id="datatables" class="table table-striped table-no-bordered table-hover deneme" cellspacing="0" width="100%" style="width:100%">
     <thead>
       <tr>
           <th>Çoklu Sil</th>
           <th data-sortable="true">ID</th>
           <th data-sortable="true">EKLENME TARİHİ</th>
           <th data-sortable="true">TERCUMAN</th>
           <th data-sortable="true">PROJE ADI</th>
           <th data-sortable="true">DİL</th>
           <th data-sortable="true">KARAKTER</th>
           <th data-sortable="true">BİRİM FİYAT</th>
           <th data-sortable="true">TEMSİLCİ</th>
           <th data-sortable="true">PROJE NOT</th>
           <th data-sortable="true">İŞLEMLER</th>




       </tr>
     </thead>
     <tbody>



       @foreach ($tercumantakipcetveli as $tercumantakipcetvelis)

	       	<tr>
               <td> <input type="checkbox" value="{{$tercumantakipcetvelis->id}}" name="checked1[]"></td>
		         <td>{{ $tercumantakipcetvelis->id }}</td>
		         <td>{{ $tercumantakipcetvelis->EklenmeTarih }}</td>
		         <td>{{ $tercumantakipcetvelis->TercumanAdi }}</td>
		         <td>{{ $tercumantakipcetvelis->ProjeAdi }}</td>
		         <td>
              {{ $tercumantakipcetvelis->KaynakDil }}>{{ $tercumantakipcetvelis->HedefDil }}
             </td>

              <td>{{ $tercumantakipcetvelis->Karakter }}</td>
		         <td>{{ $tercumantakipcetvelis->BirimFiyat }}TL</td>
		            
		        
		         <td>{{ $tercumantakipcetvelis->temsilci['isimSoyisim'] }}</br>{{ $tercumantakipcetvelis->subeler['name'] }} </td>
		         <td>{{ $tercumantakipcetvelis->TercumanTakipNot}}  </td>
		         <td>
		         	<a  title="Onayla" class="fa fa-fw fa-2x fa-check-circle-o" href="#myModal" data-toggle="modal" id="{{ $tercumantakipcetvelis->id }}" data-target="#edit-modal5"></a>
                     @if(Auth::user()->role===2)
                      <a title="Güncelle" class="fa fa-fw fa-2x fa-pencil" href="{{ route('tercumantakipduzenle',['id'=>$tercumantakipcetvelis->id]) }}"></a>
                     @endif
                     <a title="Sil" class="fa fa-fw fa-2x fa-trash-o" href="#myModal" data-toggle="modal" id="{{ $tercumantakipcetvelis->id }}" data-target="#edit-modal40"></a>
		         </td>

       		</tr>
     @endforeach
     </tbody>
   </table>
 </div>
</form>






<div id="edit-modal5" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">LKS'ye Taşı</h4>
               </div>
<form action="{{ route('lksekle') }}" method="POST"/>
{{ csrf_field() }}
           
           	<h3>Bu İşi LKS'ye Eklemek İstiyor Musunuz ?</h3>

               <div class="modal-body edit-content">
                    <input type="hidden" name="lksonay" id="lksonay" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default btn-fill" data-dismiss="modal"><i class="fa fa-close"></i>Hayır</button>
                   <button type="submit" class="btn btn-success btn-fill"><i class="fa fa-check"></i>Evet</button>
               </div>

</form>

           </div>
       </div>
</div>

{{--  SİLME MODALI  --}}
<div id="edit-modal40" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Sil</h4>
            </div>
            <form action="{{ route('tercumanistakipcetvelisil') }}" method="POST"/>
            {{ csrf_field() }}

            <h3>Bu İşi Silmek İstiyor Musunuz ?</h3>

            <div class="modal-body edit-content">
                <input type="hidden" name="tercumanistakipsil" id="tercumanistakipsil" value=""/>
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