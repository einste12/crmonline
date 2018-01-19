
@extends('admin.master.master')
@section('title')
    Adliye Tamamlanan İşler - Panel
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
           <th data-sortable="true">EVRAK ALMA TARİHİ</th>
           <th data-sortable="true">MAHKEME ADI</th>
           <th data-sortable="true">ESAS NO</th>
           <th data-sortable="true">DİLLER</th>
           <th data-sortable="true">TALEP EDİLEN FİYAT</th>
           <th data-sortable="true">TEMSİLCİ</th>
           <th data-sortable="true">NOT</th>
        {{--<th>İŞLEMLER</th>  --}}
       </tr>
     </thead>
     <tbody>
       @foreach ($adliyetamam as $adliyetamams)
       <tr>
         <td>{{ $adliyetamams->id }}</td>
         <td>{{ $adliyetamams->EvrakAlmaTarihi }}</td>
         <td>{{ $adliyetamams->mahkeme['MahkemeAdi']}}</td>
         <td>{{ $adliyetamams->EsasNo }}</td>
         <td>{{ $adliyetamams->KaynakDil }}>{{ $adliyetamams->HedefDil }}</td>
         <td>{{ $adliyetamams->TalepEdilenFiyat }}TL</td>
         <td>{{ $adliyetamams->temsilci['isimSoyisim']}}</td>
         <td>{{ $adliyetamams->TemsilciNot }}</td>
      {{--    <td>
           <a href="#myModal" data-toggle="modal" id="{{ $adliyedevams->id }}" data-target="#edit-modal11" class="btn btn-danger">ONAYLA</a>
           <a href="#myModal" data-toggle="modal" id="{{ $adliyedevams->id }}" data-target="#edit-modal12" class="btn btn-danger">SİL</a>
           <a href="{{ route('adliyeedit',['id'=>$adliyedevams->id]) }}" class="btn btn-danger">GÜNCELLE</a>

         </td> --}}
       </tr>
    @endforeach
     </tbody>
   </table>
</div>


{{-- <div id="edit-modal11" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Adliye İşine Onay Ver</h4>
               </div>
<form action="{{ route('adliyedevamonayla') }}" method="POST"/>
{{ csrf_field() }}



                   <div class="row" >
              <div class="col-md-12">
            <div class="form-group">
            <label class=" control-label" for="tarih">Evrak Alma Tarihi<star>*</star></label>  
            <div class='input-group date'>
            <input id="tarih" required="true" placeholder="Evrak Tarihi Giriniz" name='EvrakAlmaTarihi' type='text' class="datetimepicker form-control" />
                <label for="tarih" class="input-group-addon">
                  <span class="fa fa-calendar"></span>
                </label>
                </div>
              </div>
              </div>
          </div>


              <div class="col-md-12  form-group">
         <label class="control-label" for="ProjeAdi">Alınan Ödeme</label>  
          <input required="true" id="AdSoyad" name="AlinanOdeme" type="number" placeholder="Esas Numarasını Giriniz" class="form-control input-md" required="">
        </div>



            <div class="form-group">
                 <label for="sel1">Onaylayan Temsilci</label>
                 <select class="form-control" name="onaylayantemsilci">
                  @foreach($temsilci as $temsilcis)
                   <option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
                 @endforeach
                 </select>
               </div> 


               <div class="modal-body edit-content">
                    <input type="hidden" name="adliyedevamid" id="adliyedevamid" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                   <button type="submit" class="btn btn-success">Onay Ver</button>
               </div>

</form>

           </div>
       </div>
</div>

{{-- Silme Modalı --}}

{{-- <div id="edit-modal12" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Adliye Kaydını Sil</h4>
               </div>
<form action="{{ route('adliyekayitsil') }}" method="POST"/>
{{ csrf_field() }}
               <div class="form-group hidden">
                 <label for="sel1">İptal Eden  Temsilciyi Seçiniz:</label>
                 <select class="form-control" name="OnayİptalEdenTemsilci">
                  @foreach($temsilci as $temsilcis)
                   <option value="{{ $temsilcis->id }}">{{ $temsilcis->isimSoyisim }}</option>
                 @endforeach
                 </select>
               </div>
               <div class="form-group">
                 <label for="sel1">İptal Sebepleri:</label>
                 <select class="form-control" name="Onayiptalnedeni">
                  @foreach($iptalnedeni as $iptalnedenis)
                   <option value="{{ $iptalnedenis->id }}">{{ $iptalnedenis->IptalSebebi }}</option>
                 @endforeach
                 </select>
               </div> 
            

              Adliye Kaydını Silmek İstiyor Musunuz ?
    

               <div class="modal-body edit-content">
                    <input type="hidden" name="adliyekayitsil" id="adliyekayitsil" value=""/>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                   <button type="submit" class="btn btn-success">SİL</button>
               </div>

</form>

           </div>
       </div>
</div>

 --}}









<script type="text/javascript">


    $(document).ready(function() {

        $('#datatables').DataTable({
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





