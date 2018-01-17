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
            var chart = new google.charts.Bar(document.getElementById('chart_div10'));
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
           data.addColumn('number', 'Teklif Sayısı');
           data.addRows([
               ['OCAK', {{ $ocakcount }}],
               ['ŞUBAT', {{ $subatcount  }}],
               ['MART', {{$martcount}}],
               ['NİSAN', {{ $nisancount  }}],
                ['MAYIS', {{ $mayiscount    }}],
                ['HAZİRAN', {{ $hazirancount  }}],
                ['TEMMUZ', {{ $temmuzcount }}],
                ['AĞUSTOS', {{ $agustoscount }}],
                ['EYLÜL', {{ $eylulcount }}],
                ['EKİM', {{ $ekimcount }}],
                ['KASIM', {{ $kasimcount  }}],
                ['ARALIK', {{ $aralikcount  }}]

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
           var chart = new google.charts.Bar(document.getElementById('chart_div'));
           chart.draw(data, google.charts.Bar.convertOptions(options));
       }
   </script>


    {{-- TOPLAM ONAY BEKLEYEN AYLARA GÖRE --}}

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
            data.addColumn('number', 'Tamamlanan Teklifler');
            data.addRows([
                ['OCAK', {{ $ocakcountonay }}],
                ['ŞUBAT', {{ $subatcountonay  }}],
                ['MART', {{$martcountonay}}],
                ['NİSAN', {{ $nisancountonay  }}],
                ['MAYIS', {{ $mayiscountonay    }}],
                ['HAZİRAN', {{ $hazirancountonay  }}],
                ['TEMMUZ', {{ $temmuzcountonay }}],
                ['AĞUSTOS', {{ $agustoscountonay }}],
                ['EYLÜL', {{ $eylulcountonay }}],
                ['EKİM', {{ $ekimcountonay }}],
                ['KASIM', {{ $kasimcountonay  }}],
                ['ARALIK', {{ $aralikcountonay  }}]

            ]);
            var options={
                chart: {
                    title: '',
                    subtitle: '',
                },

                bars: 'vertical',
                vAxis: {format: 'decimal'},
                height: 400,
                colors: ['#3366cc']
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.charts.Bar(document.getElementById('chart_div4'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

    {{-- İPTAL SEBEPLERİ --}}

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
                ['Ay', 'Toplam', 'Onay Bekliyor', 'Devam Ediyor', 'Tamamlandı', 'İptal Edildi',],
                ['Ocak',  389,      217,         41,             139,           37,],
                ['Şubat',  289,      217,         41,             139,           37,],
                ['Mart',  289,      217,         41,             139,           37,],
                ['Nisan',  289,      117,         41,             139,           37,],
                ['Mayıs',  489,      317,         41,             139,           37,],
                ['Haziran',  189,      117,         41,             139,           37,],
                ['Temmuz',  229,      157,         41,             139,           37,],
                ['Ağustos',  229,      117,         41,             139,           37,],
                ['Eylül',  189,      107,         41,             139,           37,],
                ['Ekim',  329,      217,         41,             139,           37,],
                ['Kasım',  199,      87,         41,             139,           37,],
                ['Aralık',  389,      321,         41,             139,           37,],

            ]);

            var options = {
                title : 'Tüm Teklifler',
                vAxis: {title: ''},
                hAxis: {title: ''},
                seriesType: 'bars',
                series: {5: {type: 'line'}}
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_diva'));
            chart.draw(data, options);
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
            data.addColumn('number', 'İptal Sebepleri');
            data.addRows([
                ['Yapılmayacak', {{ $yapilmayacak1 }}],
                ['Fiyatı Yüksek Buldu', {{ $fiyatyuksek1  }}],
                ['Başka Firmaya Yaptırdılar', {{$baskafirma1}}],
                ['Geç Dönüş Yapıldığını Söyledi', {{ $gecdonus1}}],
                ['Mükerrer Yükleme', {{ $mukerrer1    }}],
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
            var chart = new google.charts.Bar(document.getElementById('chart_div5'));
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


                ['ŞULE', {{ $teklifsule1 }}],
                ['GÜRKAN', {{$teklifgurkan1}}],
                ['HANDAN', {{ $teklifhandan1  }}],
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
            var chart = new google.charts.Bar(document.getElementById('chart_div6'));
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
            var chart = new google.charts.Bar(document.getElementById('chart_div7'));
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
            data.addColumn('number', 'İptal Edilenler');
            data.addRows([
                ['OCAK', {{ $ocakcountiptal }}],
                ['ŞUBAT', {{ $subatcountiptal  }}],
                ['MART', {{$martcountiptal}}],
                ['NİSAN', {{ $nisancountiptal  }}],
                ['MAYIS', {{ $mayiscountiptal    }}],
                ['HAZİRAN', {{ $hazirancountiptal  }}],
                ['TEMMUZ', {{ $temmuzcountiptal }}],
                ['AĞUSTOS', {{ $agustoscountiptal }}],
                ['EYLÜL', {{ $eylulcountiptal }}],
                ['EKİM', {{ $ekimcountiptal }}],
                ['KASIM', {{ $kasimcountiptal  }}],
                ['ARALIK', {{ $aralikcountiptal  }}]

            ]);
            var options={
                chart: {
                    title: '',
                    subtitle: '',
                },

                bars: 'vertical',
                vAxis: {format: 'decimal'},
                height: 400,
                colors: ['#dc3912']
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.charts.Bar(document.getElementById('chart_div2'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>



    <div id="chart_diva" style="margin-bottom: 100px; height: 600px; width: auto !important;"></div>


<div class="container">
    <div id="chart_div" style="margin-bottom: 100px;"></div>
    <div id="chart_div2" style="margin-bottom: 100px;"></div>
    <div id="chart_div3" style="margin-bottom: 100px;"></div>
    <div id="chart_div4" style="margin-bottom: 100px;"></div>

   <div id="chart_div5" style="margin-bottom: 100px;"></div>
   <div id="chart_div6" style="margin-bottom: 100px;"></div>
   <div id="chart_div7" style="margin-bottom: 100px;"></div>
    <div id="chart_div10" style="margin-bottom: 100px;"></div>


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


    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
                ['1', 'Toplam', 'Onay Bekliyor', 'Devam Ediyor', 'Tamamlandı', 'İptal Edildi',],
                ['2',  389,      217,         41,             139,           37,],
                ['3',  289,      217,         41,             139,           37,],
                ['4',  289,      217,         41,             139,           37,],
                ['5',  289,      117,         41,             139,           37,],
                ['6',  489,      317,         41,             139,           37,],
                ['7',  189,      117,         41,             139,           37,],
                ['8',  229,      157,         41,             139,           37,],
                ['9',  229,      117,         41,             139,           37,],
                ['10',  189,      107,         41,             139,           37,],
                ['11',  329,      217,         41,             139,           37,],
                ['12',  199,      87,         41,             139,           37,],
                ['13',  389,      321,         41,             139,           37,],
                ['14',  389,      321,         41,             139,           37,],
                ['15',  389,      321,         41,             139,           37,],
                ['16',  389,      321,         41,             139,           37,],
                ['17',  389,      321,         41,             139,           37,],
                ['18',  389,      321,         41,             139,           37,],
                ['19',  389,      321,         41,             139,           37,],
                ['20',  389,      321,         41,             139,           37,],
                ['21',  389,      321,         41,             139,           37,],
                ['22',  389,      321,         41,             139,           37,],
                ['23',  389,      321,         41,             139,           37,],
                ['24',  389,      321,         41,             139,           37,],
                ['25',  389,      321,         41,             139,           37,],
                ['26',  389,      321,         41,             139,           37,],
                ['27',  389,      321,         41,             139,           37,],
                ['28',  389,      321,         41,             139,           37,],
                ['29',  389,      321,         41,             139,           37,],
                ['30',  389,      321,         41,             139,           37,],
                ['31',  389,      321,         41,             139,           37,],

            ]);

            var options = {
                title : 'Tüm Teklifler',
                vAxis: {title: ''},
                hAxis: {title: ''},
                seriesType: 'bars',
                series: {5: {type: 'line'}}
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_divs'));
            chart.draw(data, options);
        }
    </script>

    <div id="chart_divs" style="width: 100% !important; height: 500px;"></div>












@endsection