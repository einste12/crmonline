@extends('admin.master.master')

@section('title')
    LKS YE EKLENENLER SAYFASI
@endsection
@section('content')




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
 <table id="datatables" order-column="1" order-type="DESC" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
     <thead>
       <tr>
           <th data-sortable="true">ID</th>
           <th data-sortable="true">LKS EKLENME TARİHİ</th>
           <th data-sortable="true"> TERCUMAN İSİM SOYİSİM</th>
           <th data-sortable="true">PROJE ADI</th>
           <th data-sortable="true">DİL</th>
           <th data-sortable="true">KARAKTER</th>
           <th data-sortable="true">BİRİM FİYAT</th>
           <th data-sortable="true">TEMSİLCİ VE ŞUBEID</th>
           <th data-sortable="true">PROJE NOT</th>



       </tr>
     </thead>
     <tbody>



       @foreach ($lksekle as $lksekles)

	       	<tr>
		         <td>{{ $lksekles->id }}</td>
		         <td>{{ $lksekles->OnayTarihi }}</td>
		         <td>{{ $lksekles->TercumanAdi }}</td>
		         <td>{{ $lksekles->ProjeAdi }}</td>
		         <td>
              {{ $lksekles->KaynakDil }}></br>{{ $lksekles->HedefDil }}
             </td>

              <td>{{ $lksekles->Karakter }}TL</td>
		         <td>{{ $lksekles->BirimFiyat }}TL</td>


		         <td>{{ $lksekles->temsilci['isimSoyisim'] }}</br>{{ $lksekles->subeler['name'] }} </td>
		         <td>{{ $lksekles->TercumanTakipNot}}  </td>


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