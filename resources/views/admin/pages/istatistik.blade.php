@extends('admin.master.master')
@section('title')
   iSTATİSTİK SAYFASI
@endsection
@section('content')
    {{--<P align="center">2 TARİH ARASINDA RAPORLARI ARAMA SAYFASI</P>--}}
{{--<form action="{{ route('raporara') }}" method="POST" >--}}
    {{--<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />--}}
        {{--<div class="col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<label class=" control-label" for="tarih">Rapor Almak İstediğniz İlk Tarih<star>*</star></label>--}}
                {{--<div class='input-group date'>--}}
                    {{--<input id="tarih" required="true" placeholder="Rapor Alma Tarihini Giriniz" name='RaporAlmaTarihi' type='text' class="datetimepicker form-control" />--}}
                    {{--<label for="tarih" class="input-group-addon">--}}
                        {{--<span class="fa fa-calendar"></span>--}}
                    {{--</label>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--<div class="col-md-12">--}}
        {{--<div class="form-group">--}}
            {{--<label class=" control-label" for="tarih">Rapor Almak İstediğniz ikinci Tarih<star>*</star></label>--}}
            {{--<div class='input-group date'>--}}
                {{--<input id="tarih" required="true" placeholder="Rapor Alma Tarihini Giriniz" name='RaporAlmaTarihi2' type='text' class="datetimepicker form-control" />--}}
                {{--<label for="tarih" class="input-group-addon">--}}
                    {{--<span class="fa fa-calendar"></span>--}}
                {{--</label>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-12">--}}
        {{--<div class="form-group">--}}
                {{--<label class="control-label" for="KaynakDil">Rapor Tipi</label>--}}
                {{--<select name="RaporTipi" class="form-control" required>--}}
                    {{--<option value="" selected>Rapor Tipini Seçiniz</option>--}}
                        {{--<option value="1">Dillere Göre</option>--}}
                        {{--<option value="2">Müşteri Tipine Göre</option>--}}
                        {{--<option value="3">Temsilcilere Göre</option>--}}
                {{--</select>--}}
            {{--</div>--}}
    {{--</div>--}}
    {{--<input type="submit" role="button" class="form-control btn btn-fill btn-success" value="ARA">--}}
{{--</form>--}}












   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

{{-- GÜNLERE GÖRE SIRALAMA --}}
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['bar']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', '{{Carbon\Carbon::now()->formatLocalized('%B %Y') }}');
            data.addColumn('number', 'Günlere Göre Teklif Sayısı');
            data.addRows([
                ['1', {{ $bircount }}],
                ['2', {{ $ikicount  }}],
                ['3', {{$uccount}}],
                ['4', {{ $dortcount  }}],
                ['5', {{ $bescount    }}],
                ['6', {{ $alticount  }}],
                ['7', {{ $yedicount }}],
                ['8', {{ $sekizcount }}],
                ['9', {{ $dokuzcount }}],
                ['10', {{ $oncount }}],
                ['11', {{ $onbircount  }}],
                ['12', {{ $onikicount  }}],
                ['13', {{ $onuccount  }}],
                ['14', {{ $ondortcount  }}],
                ['15', {{ $onbescount  }}],
                ['16', {{ $onalticount  }}],
                ['17', {{ $onyedicount  }}],
                ['18', {{ $onsekizcount  }}],
                ['19', {{ $ondokuzcount  }}],
                ['20', {{ $yirmicount }}],
                ['21', {{ $yirmibircount  }}],
                ['22', {{ $yirmiikicount  }}],
                ['23', {{ $yirmiuccount  }}],
                ['24', {{ $yirmidortcount  }}],
                ['25', {{ $yirmibescount  }}],
                ['26', {{ $yirmialticount  }}],
                ['27', {{ $yirmiyedicount  }}],
                ['28', {{ $yirmisekizcount  }}],
                ['29', {{ $yirmidokuzcount  }}],
                ['30', {{ $otuzcount  }}],
                ['31', {{ $otuzbircount  }}]

            ]);
            var options={
                chart: {
                    title: '',
                    subtitle: '',
                },

                bars: 'vertical',
                vAxis: {format: 'decimal'},
                height: 400,
                colors: ['#f80']
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.charts.Bar(document.getElementById('gunleregoreteklif'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>













    {{-- TOPLAM ONAY BEKLEYEN AYLARA GÖRE --}}


    {{-- İPTAL SEBEPLERİ --}}








    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['bar']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', '');
            data.addColumn('number', 'İptal Sebepleri');
            data.addRows([
                ['Yapılmayacak', {{ $yapilmayacak1 }}],
                ['Geç Dönüş Yaptığımızı Söyledi', {{ $gecdonus2 }}],
                ['Ulaşılamadı', {{ $ulasilamadi }}],
                ['Fiyatı Yüksek Buldu', {{ $fiyatyuksek1  }}],
                ['Başka Firmaya Ypt.', {{$baskafirma1}}],
                ['Geç Dönüldü', {{ $gecdonus1}}],
                ['Mükerrer Yükleme', {{ $mukerrer1  }}],
                ['Tercuman', {{ $tercuman1  }}],
                ['Mailden Teklif Verildi', {{ $maildenteklifverildi1}}],
                ['Diğer', {{ $diger1 }}]
            ]);
            var options={
                chart: {
                    title: '',
                    subtitle: '',
                },

                bars: 'vertical',
                vAxis: {format: 'decimal'},
                height: 400,
                colors: ['#f1ca3a']
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.charts.Bar(document.getElementById('iptalsebepleri'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>


    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['bar']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', '');
            data.addColumn('number', 'Temsilci Raporları');
            data.addRows([

                ['GÜRKAN BEY', {{$teklifgurkan1}}],
                ['HANDAN', {{ $teklifhandan1  }}],
                ['ŞULE', {{ $teklifsule1 }}],
                ['AHMET', {{ $teklifahmet1    }}],
                ['SÜMEYYE', {{ $teklifsumeyye1  }}],
                ['YEŞİM', {{ $teklifyesim1 }}],
                ['KÜBRA', {{ $teklifkubra1 }}]
            ]);
            var options={
                chart: {
                    title: '',
                    subtitle: '',
                },

                bars: 'vertical',
                vAxis: {format: 'decimal'},
                height: 400,
                colors: ['#53a8fb']
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.charts.Bar(document.getElementById('temsilcileriraporlari'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['bar']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', '');
            data.addColumn('number', 'Müşteri Nereden Geldi?');
            data.addRows([
                ['İNTERNET', {{ $internetgelen1 }}],
                ['SÜREKLİ MÜŞTERİ', {{ $surekligelen1  }}],
                ['REFERANS İLE GELEN', {{$referansgelen1}}],
                ['NOTER YÖNLENDİRMESİ İLE', {{$notergelen1  }}]
            ]);
            var options={
                chart: {
                    title: '',
                    subtitle: '',
                },

                bars: 'vertical',
                vAxis: {format: 'decimal'},
                height: 400,
                colors: ['#109618']
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.charts.Bar(document.getElementById('musterineredengeldi'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>



    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
                ['Ay',           'Toplam',                           'Tamamlandı',                        'İptal Edildi'],
                ['Ocak',         {{$ocakcount}},                  {{$ocakcountonay}},                    {{$ocakcountiptal}}],
                ['Şubat',        {{$subatcount}},                 {{$subatcountonay}},                    {{$subatcountiptal}}],
                ['Mart',         {{$martcount}},                  {{$martcountonay}},                    {{$martcountiptal}}],
                ['Nisan',        {{$nisancount}},                 {{$nisancountonay}},                    {{$nisancountiptal}}],
                ['Mayıs',        {{$mayiscount}},                 {{$mayiscountonay}},                    {{$mayiscountiptal}}],
                ['Haziran',      {{$hazirancount}},               {{$hazirancountonay}},                    {{$hazirancountiptal}}],
                ['Temmuz',       {{$temmuzcount}},                {{$temmuzcountonay}},                    {{$temmuzcountiptal}}],
                ['Ağustos',      {{$agustoscount}},               {{$agustoscountonay}},                    {{$agustoscountiptal}}],
                ['Eylül',        {{$eylulcount}},                 {{$eylulcountonay}},                    {{$eylulcountiptal}}],
                ['Ekim',         {{$ekimcount}},                  {{$ekimcountonay}},                    {{$ekimcountiptal}}],
                ['Kasım',        {{$kasimcount}},                 {{$kasimcountonay}},                    {{$kasimcountiptal}}],
                ['Aralık',       {{$aralikcount}},                {{$aralikcountonay}},                    {{$aralikcountiptal}}]
            ]);

            var options = {
                title : 'Tüm Teklifler',
                vAxis: {title: ''},
                hAxis: {title: ''},
                seriesType: 'bars',
                series: {5: {type: 'line'}}
            };

            var chart = new google.visualization.ComboChart(document.getElementById('aylaragoreteklifler'));
            chart.draw(data, options);
        }
    </script>

    {{--  ŞUBEYE GÖRE  --}}

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
                ['Ay',           'Merkez',                               'Kartal',                        'Maltepe' ,                        'Ataşehir',                      'Kadıköy'],
                ['Ocak',          {{ $merkezocak1 }},                     {{$kartalocak1}},              {{$maltepeocak1}},                 {{$atasehirocak1}},              {{$kadikoyocak1}}],
                ['Şubat',         {{ $merkezsubat1 }},                   {{$kartalsubat1}},              {{$maltepesubat1}},                {{$atasehirsubat1}},                {{$kadikoysubat1}}],
                ['Mart',           {{$merkezmart1}},                     {{$kartalmart1}},               {{$maltepemart1}},                 {{$atasehirmart1}},                {{$kadikoymart1}}],
                ['Nisan',          {{$merkeznisan1}},                    {{$kartalnisan1}},               {{$maltepenisan1}},               {{$atasehirnisan1}},                {{$kadikoynisan1}}],
                ['Mayıs',          {{$merkezmayis1}},                     {{$kartalmayis1}},              {{$maltepemayis1}},               {{$atasehirmayis1}},                {{$kadikoymayis1}}],
                ['Haziran',        {{$merkezhaziran1}},                     {{$kartalhaziran1}},          {{$maltepehaziran1}},             {{$atasehirhaziran1}},                 {{$kadikoyhaziran1}}],
                ['Temmuz',        {{$merkeztemmuz1}},                    {{$kartaltemmuz1}},              {{$maltepetemmuz1}},              {{$atasehirtemmuz1}},                 {{$kadikoytemmuz1}}],
                ['Ağustos',       {{$merkezagustos1}},                     {{$kartalagustos1}},           {{$maltepeagustos1}},             {{$atasehiragustos1}},                {{$kadikoyagustos1}}],
                ['Eylül',          {{$merkezeylul1}},                    {{$kartaleylul1}},               {{$maltepeeylul1}},               {{$atasehireylul1}},                 {{$kadikoyeylul1}}],
                ['Ekim',          {{$merkezekim1}},                    {{$kartalekim1}},                  {{$maltepeekim1}},                {{$atasehirekim1}},                {{$kadikoyekim1}}],
                ['Kasım',         {{$merkezkasim1}},                     {{$kartalkasim1}},               {{$maltepekasim1}},               {{$atasehirkasim1}},                {{$kadikoykasim1}}],
                ['Aralık',       {{$merkezaralik1}},                   {{ $kartalaralik1 }},              {{$maltepearalik1}},             {{$atasehiraralik1}},                 {{$kadikoyaralik1}}]
            ]);

            var options = {
                title : 'Şubelere  Göre Toplam Teklifler',
                vAxis: {title: ''},
                hAxis: {title: ''},
                seriesType: 'bars',
                series: {5: {type: 'line'}}
            };

            var chart = new google.visualization.ComboChart(document.getElementById('subeleregore'));
            chart.draw(data, options);
        }
    </script>



    <div id="aylaragoreteklifler" style="margin-bottom: 100px; height: 500px;"></div>

        <div id="subeleregore" style="margin-bottom: 100px; height:500px;"></div>
        <div class="container">
        <div id="gunleregoreteklif" style="margin-bottom: 100px;"></div>

   <div id="iptalsebepleri" style="margin-bottom: 100px;"></div>
   <div id="temsilcileriraporlari" style="margin-bottom: 100px;"></div>
   <div id="musterineredengeldi" style="margin-bottom: 100px;"></div>






</div>

    {{--<div class="row" style="margin-top:50px;">--}}

        {{--<div class="col-md-2">--}}
            {{--<h5 for="">Gelen Teklifler <br>{{ $gelencount1 }} </h5>--}}


        {{--</div>--}}

        {{--<div class="col-md-2">--}}
            {{--<h5 for="">Onay Bekleyen Teklifler</h5>--}}
            {{--{{ $onaycount1 }}--}}

        {{--</div>--}}

        {{--<div class="col-md-2">--}}
            {{--<h5 for="">Devam Eden Teklifler</h5>--}}
            {{--{{ $devamcount1 }}--}}

        {{--</div>--}}

        {{--<div class="col-md-2">--}}
            {{--<h5 for="">Tamamlanan Teklifler</h5>--}}
            {{--{{ $tamamlanancount1 }}--}}

        {{--</div>--}}

        {{--<div class="col-md-2">--}}
            {{--<h5 for="">İptal Edilen Teklifler</h5>--}}
            {{--{{ $iptalteklifcount1 }}--}}
        {{--</div>--}}
    {{--</div>--}}




















@endsection