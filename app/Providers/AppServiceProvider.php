<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Temsilciler;
use App\Teklifler;
use App\Subeler;
use Carbon\Carbon;
use App\Diller;
use App\AdliyeTakipMahkemeler;
use App\IptalNedenleri;
use App\TercumanIsTakip;
use App\TercumanVeritabani;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);



        setlocale(LC_TIME, 'tr_TR');
        Carbon::setLocale('tr');



        $temsilci = Temsilciler::orderBy('id', 'ASC')->get();
        view()->share('temsilci',$temsilci);

        $iptalsebepleri =IptalNedenleri::whereNotIn('id',[1,8,4,99])->orderBy('sirala','asc')->get();
        view()->share('iptalnedeni',$iptalsebepleri);


        $tercuman = TercumanVeritabani::where(['Silindi'=>0,'OnayDurumu'=>0]);
        view()->share('tercuman',$tercuman);


         $tercumanmali = TercumanVeritabani::where(['Silindi'=>0,'OnayDurumu'=>3]);
        view()->share('tercumanmali',$tercumanmali);

        $diller =Diller::orderBy('sirala', 'ASC')->get();
        view()->share('diller',$diller);

        $mahkemeler =AdliyeTakipMahkemeler::all();
        view()->share('mahkemeler',$mahkemeler);   

        $subeler =Subeler::all();
        view()->share('subeler',$subeler);

        //GELEN BEKLEYENLER COUNT


        $gelenteklif=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>0])
            ->whereYear('GelenTeklifTarihi','>','2017-12-31')->get();


        $gelencount = count($gelenteklif);
        view()->share('gelencount',$gelencount);



        //ONAY BEKLEYENLER


        $onaybekleyen=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>1])
            ->where('TeklifVerilenTarih','>',Carbon::now()->subDays(60))->get();



            $onaycount = count($onaybekleyen);
        view()->share('onaycount',$onaycount);


        //DEVAM EDENLER

        $devamteklif=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>2])
            ->whereYear('TeklifVerilenTarih','>','2016-12-31')->get();



        $devamcount = count($devamteklif);
        view()->share('devamcount',$devamcount);

    //TAMAMLANAN TEKLİFLER COUNT

        $tamamlananteklif=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
            ->where('EvrakTeslimTarihi','>',Carbon::now()->subDays(30))->get();


        $tamamlanancount = count($tamamlananteklif);
        view()->share('tamamlananteklifcount',$tamamlanancount);



//İPTAL TEKLİFLER

        $iptalteklif=Teklifler::where(['Silindi'=>1])
            ->where('iptalTarihi','>',Carbon::now()->subDays(30))->get();


        $iptalteklifcount = count($iptalteklif);
        view()->share('iptalteklifcount',$iptalteklifcount);


//TERCUMAN BASVURU COUNT

        $tercumanbasvurulari=TercumanVeritabani::where(['Silindi'=>0,'OnayDurumu'=>0])
            ->whereYear('BasvuruTarihi','>','2016-12-31')->get();

        $tercumanbasvurucount = count($tercumanbasvurulari);
        view()->share('tercumanbasvurucount',$tercumanbasvurucount);


//TUM TERCUMANLAR
        $tercumanlist = TercumanVeritabani::where('Silindi', 0)
            ->where(function($q) {
                $q->where('OnayDurumu', 2)
                    ->orWhere('OnayDurumu', 3);
            })->with('tercumandilbilgileri')
            ->get();

        $tercumanlistcount = count($tercumanlist);
        view()->share('tercumanlistcount',$tercumanlistcount);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
