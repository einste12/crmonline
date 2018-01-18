<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teklifler;
use Session;
use Toastr;
use DB;
use App\AdliyeTakipCetveli;
use Carbon\Carbon;
use App\TercumanIsTakip;
use App\Tercumandilbilgileri;
use App\Temsilciler;
use App\TercumanVeritabani;
use App\Geribildirim;
use Auth;
use App\Subeler;
use App\User; 
use Alert;
use DateTime;
use Mail;

class DashBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


          $gelenteklif=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>0])
            ->whereYear('GelenTeklifTarihi','>','2017-12-31')
            ->orderBy('GelenTeklifTarihi','DESC')->get();
      
            return view('dashboard',['teklif'=>$gelenteklif]);
    }





    public function onaybekleyen()
    {
    
            $onaybekleyen=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>1])
            ->where('TeklifVerilenTarih','>',Carbon::now()->subDays(60))
            ->with('temsilci')
            ->with('tercuman')
            ->orderBy('TeklifVerilenTarih','DESC')->get();


      
        return view('admin.pages.onaybekleyen',['onaybekleyen'=>$onaybekleyen]);
    }



    public function onaygidenmail($id){
      
      $mail=Teklifler::find($id);
      return view('admin.pages.onaygidenmail',['maildetay'=>$mail]);

    }



//DEVAM EDEN TEKLİFLER//


    public function devameden()
    {
     

      $devamteklif=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>2])
    ->whereYear('TeklifVerilenTarih','>','2016-12-31')
    ->with('temsilci')
    ->with('tercuman')
    ->orderBy('TeklifVerilenTarih','desc')->get();



        return view('admin.pages.devamedenteklif',['devamteklif'=>$devamteklif]);
    }



//TAMAMLANAN

    public function tamamlanan()
    {
     
     $tamamlananteklif=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
    ->where('EvrakTeslimTarihi','>','2017-12-31')
    ->with('temsilci2')
    ->orderBy('EvrakTeslimTarihi','DESC')->get();

        return view('admin.pages.tamamlananteklif',['tamamlananteklif'=>$tamamlananteklif]);
    }




    public function iptalteklif()
    {




    $iptalteklif=Teklifler::where(['Silindi'=>1])
    ->where('iptalTarihi','>',Carbon::now()->subDays(30))
    ->with('temsilci_iptal')
    ->with('iptalneden')
    ->orderBy('iptalTarihi','DESC')->get();


    
        return view('admin.pages.iptalteklif',['iptalteklif'=>$iptalteklif]);
    }


    public function gelenteklifonayla(Request $request){
       $id = request()->input('bookId');

            $teklif = Teklifler::find($id);
            $teklif->OnaylayanTemsilciID=Auth::user()->id;
            $teklif->OnayDurumu =2;
           
           @rename("../crm/dosya/onaybekleyenler/".$id,"../crm/dosya/onaylananlar/$id");
         
            $teklif->update();
            return redirect()->route('devameden');


    }



    public function gelenteklifsil(Request $request){


        $id=$request->input('teklifsil');
        $teklifsil = Teklifler::find($id);
        $teklifsil->Silindi=1;
        $teklifsil->iptalEdenTemsilciID=Auth::user()->id;
        $teklifsil->iptalTarihi=date('Y-m-d H:i:s');
        $teklifsil->iptalNedeni=request()->input('iptalnedeni');
        $teklifsil->push();

        alert()->flash('Başarıyla Silindi', 'success');
        return redirect()->route('dashboard');

        }






  public function onaysil(Request $request){

    $id = $request->input('onaybekleyensil');
    $onaysil = Teklifler::find($id);
    $onaysil->iptalEdenTemsilciID=$request->input('OnayİptalEdenTemsilci');
    $onaysil->iptalNedeni=$request->input('Onayiptalnedeni');
    $onaysil->Silindi=1;
    $onaysil->update();

      alert()->flash('Başarıyla Silindi', 'success');
      return redirect()->route('onaybekleyen');

    }




    public function onaybekleyenedit($id)

    {

        $tercumanli = TercumanVeritabani::where('Silindi', 0)
                ->where(function($q) {
          $q->where('OnayDurumu', 2)
            ->orWhere('OnayDurumu', 3);
      })
      ->get();




      $teklif = Teklifler::find($id);
      return view('admin.pages.onaybekleyenedit',['teklif'=>$teklif,'tercumanli'=>$tercumanli]);



    }

    public function onaybekleyenupdate(Request $request,$id)

      {

        $update = Teklifler::find($id);
        $input = $request->all();
        $update->update($input);

         alert()->flash('Başarıyla Güncellenmiştir', 'success');
        return redirect()->back();

      }



      public function onaybekleyenyazdir($id)

      {

        $teklif = Teklifler::find($id);
        return view('admin.pages.onaybekleyenyazdir',['onay'=>$teklif]);

      }



//DEVAM EDENLER BAŞLANGIÇ



    public function tekliftamamla(Request $request){

            $date = $request->input('EvrakTeslimTarihi');  
             $dt = new DateTime($date);
             $newdate=$dt->format('Y-m-d H:i:s');


            $id = request()->input('devamedenid');



            $temsilci = request()->input('devamionaylayantemsilci');


            $teklif = Teklifler::find($id);


                    
            $teklif->EvrakTeslimTarihi  =$newdate;
            $teklif->OnaylayanTemsilciID=Auth::user()->id;
            $teklif->OnayDurumu =3;
            
            @rename("../crm/dosya/onaylananlar/".$id,"../crm/dosya/tamamlananlar/$id");
            
            $teklif->update();
            alert()->flash('Başarıyla Onaylanmıştır', 'success');
            return redirect()->route('tamamlanan');


    }

    public function devamsil(Request $request){


      $id = $request->input('devamedensil');
      $devamsil = Teklifler::find($id);
      $devamsil->iptalEdenTemsilciID=Auth::user()->id;
      $devamsil->iptalNedeni=$request->input('Devamiptalnedeni');
      $devamsil->Silindi=1;
      $devamsil->update();


        alert()->flash('Başarıyla Silindi', 'success');
        return redirect()->route('devameden');

      }



      public function devamedenedit($id)

      {

           $tercumanli = TercumanVeritabani::where('silindi', 0)
                ->where(function($q) {
          $q->where('OnayDurumu', 2)
            ->orWhere('OnayDurumu', 3);
      })
      ->get();


        $teklif = Teklifler::find($id);
        return view('admin.pages.devamedenedit',['teklif'=>$teklif,'tercumanmali'=>$tercumanli]);



      }


      public function devamedenupdate(Request $request,$id)

        {

          $update = Teklifler::find($id);
          $input = $request->all();
          $update->update($input);
          alert()->flash('Başarıyla Güncellenmiştir', 'success');
          return redirect()->back();
        }


        public function devamedenyazdir($id)

        {

          $teklif = Teklifler::find($id);
          return view('admin.pages.devamedenyazdir',['onay'=>$teklif]);

        }

    public function devamgidenmail($id){
      
      $devammail=Teklifler::find($id);
      return view('admin.pages.devamgidenmail',['maildetay'=>$devammail]);

    }




//TAMAMLANAN BÖLÜMÜ

      public function tamamlananedit($id)

      {

        $teklif = Teklifler::find($id);
        return view('admin.pages.tamamlananedit',['teklif'=>$teklif]);



      }


      public function tamamlananupdate(Request $request,$id)

        {

          $update = Teklifler::find($id);
          $input = $request->all();
          $update->update($input);
          alert()->flash('Başarıyla Güncellenmiştir', 'success');
          return redirect()->back();
        }


        public function tamamlananyazdir($id)

        {

          $teklif = Teklifler::find($id);
          return view('admin.pages.tamamlananyazdir',['onay'=>$teklif]);

        }


        public function yeniisekle()
          {

            $tercumanlar = TercumanVeritabani::where(function ($query) {
            $query->where('OnayDurumu',2)
            ->orWhere('OnayDurumu',3);
          })->get();
              
            
            return view('admin.pages.yeniisekle',['tercumanlar'=>$tercumanlar]);
          }


        public function isekle(Request $request)

            {


                 $date = $request->input('GelenTeklifTarihi');  
              $dt = new DateTime($date);
             $newdate=$dt->format('Y-m-d H:i:s');




                $Teklifler = new Teklifler;
                $Teklifler->GelenTeklifTarihi = Carbon::now();
                $Teklifler->TeklifVerilenTarih = $newdate;
                $Teklifler->FormGelenTur="Panel";
                $Teklifler->MeslekiUzmanlik="Panel";
                $Teklifler->FormUrl="Panel";
                $Teklifler->Silindi=0;
                $Teklifler->isimSoyisim = $request->input('isimSoyisim');
                $Teklifler->Telefon = $request->input('Telefon');
                $Teklifler->Email = $request->input('Email');
                $Teklifler->KaynakDil = $request->input('KaynakDil');

                $Teklifler->HedefDil = implode(",",$request->input('HedefDil'));

                $Teklifler->Fiyat = $request->input('Fiyat');
                $Teklifler->Kapora = $request->input('Kapora');
                $Teklifler->TercumanID = $request->input('TercumanID');
                $Teklifler->TasdikSekli = $request->input('TasdikSekli');
                $Teklifler->OnayDurumu = $request->input('OnayDurumu');
                $Teklifler->SubeID=Auth::user()->sonsube->id;
                $Teklifler->TeklifVerenTemsilci = Auth::user()->id;
                $Teklifler->TemsilciProjeNot = $request->input('TemsilciGelenTeklifNot');
                $Teklifler->NeredenGeldi=$request->input('NeredenGeldi');

                $Teklifler->save();

                alert()->flash('Başarıyla Kayıt Edilmiştir', 'success');
                return redirect()->back();




            }




      public function tamamgidenmail($id){
      
         $tamammail=Teklifler::find($id);




         return view('admin.pages.tamamgidenmail',['tamammaildetay'=>$tamammail]);

       }


            // TERCUMANLAR FUNCTİON


            public function tercumanekle(){

                return view('admin.pages.tercumanekle');
            }

            public function vttercumanekle(Request $request)
              {

                $TercumanVeritabani = new TercumanVeritabani;
                $TercumanVeritabani->isimSoyisim = $request->input('isimSoyisim');
                $TercumanVeritabani->Telefon = $request->input('Telefon');
                $TercumanVeritabani->Mail=$request->input('Email');
                $TercumanVeritabani->Locasyon = $request->input('Lokasyon');
                $TercumanVeritabani->Hesapsahibi = $request->input('HesapSahibi');
                $TercumanVeritabani->KayitTuru =2;
                $TercumanVeritabani->Silindi =0;
                $TercumanVeritabani->OnayDurumu=0;



                $TercumanVeritabani->ibanno = $request->input('ibanno');
                $TercumanVeritabani->temsilciNot = $request->input('TemsilciNot');
                $TercumanVeritabani->BasvuruTarihi = date('Y-m-d H:i:s');

                $TercumanVeritabani->save();

                if($TercumanVeritabani->save()){

                $last_id = $TercumanVeritabani->id;


                          $index = 0;
                          while(true){
                            if($request->input('kaynakdil'.$index)){

                              $Tercumandilbilgileri = new Tercumandilbilgileri;
                              $Tercumandilbilgileri->TercumanID = $last_id;
                              $Tercumandilbilgileri->Tercume_Turu = $request->input('tercumeturu'.$index);
                              $Tercumandilbilgileri->KaynakDil = $request->input('kaynakdil'.$index);
                              $Tercumandilbilgileri->HedefDil = $request->input('hedefdil'.$index);
                              $Tercumandilbilgileri->BirimFiyat = $request->input('birimfiyat'.$index);
                              $Tercumandilbilgileri->save();

                          }else{
                             break;
                         }
                         $index +=1;

                          }

                }else{

                    echo "BİR HATA OLUŞTU";

                }

                   alert()->flash('Başarıyla Kayıt Edilmiştir', 'success');
                  return redirect()->back();
              }




public function tercumanguncelle(Request $request,$id)
{


                

                $TercumanVeritabani =TercumanVeritabani::find($id);
                $TercumanVeritabani->isimSoyisim = $request->input('isimSoyisim');
                $TercumanVeritabani->Telefon = $request->input('Telefon');
                $TercumanVeritabani->Mail = $request->input('Email');
                $TercumanVeritabani->Locasyon = $request->input('Lokasyon');
                $TercumanVeritabani->Hesapsahibi = $request->input('HesapSahibi');
                $TercumanVeritabani->ibanno = $request->input('ibanno');
                $TercumanVeritabani->temsilciNot = $request->input('TemsilciNot');

                

                $TercumanVeritabani->update();

                if($TercumanVeritabani->update()){


                    if (is_array($_POST['kaynakdil']) || is_object($_POST['kaynakdil'])) {
                        foreach ($_POST['kaynakdil'] AS $key => $val)
                        {

                            $Tercumandilbilgileri = new Tercumandilbilgileri;
                            $Tercumandilbilgileri->TercumanID = $id;
                            $Tercumandilbilgileri->Tercume_Turu = $_POST['tercumeturu'][$key];
                            $Tercumandilbilgileri->KaynakDil = $_POST['kaynakdil'][$key];
                            $Tercumandilbilgileri->HedefDil = $_POST['hedefdil'][$key];
                            $Tercumandilbilgileri->BirimFiyat = $_POST['birimfiyat'][$key];
                            $Tercumandilbilgileri->save();

                        }

                    }

                }else{

                    echo "BİR HATA OLUŞTU";

                }

                  alert()->flash('Başarıyla Güncellenmiştir', 'success');
                  return redirect()->back();





}





public function coklutercumansil(Request $request)

{

   $checked = Request()->input('checked',[]);
   foreach ($checked as $id) {
       TercumanVeritabani::where("id",$id)->update(['Silindi'=>1]);
   }
  
 TercumanVeritabani::whereIn('id', $checked)->update(['Silindi'=>1]);
   
 alert()->flash('Başarıyla Silinmiştir', 'success');
 return redirect()->back();


}

    public function toplulkstasi(Request $request)



    {
        $onaytarihi = date('Y-m-d H:i:s');

        $checked = Request()->input('checked1',[]);
        foreach ($checked as $id) {
            TercumanIsTakip::where("id",$id)->update(['Silindi'=>1,'OnayTarihi'=>$onaytarihi]);
        }

        TercumanIsTakip::whereIn('id', $checked)->update(['OnayDurumu'=>1]);

        alert()->flash('Seçilenler LKS ye Taşınmıştır.', 'success');
        return redirect()->back();


    }



    public function  toplugelenteklifsil()
    {
        $iptaltarihi = date('Y-m-d H:i:s');

        $checked = Request()->input('checked2',[]);
        foreach ($checked as $id) {
            Teklifler::where("id",$id)->update(['Silindi'=>1,'iptalTarihi'=>$iptaltarihi]);
        }

        Teklifler::whereIn('id', $checked)->update(['OnayDurumu'=>0]);

        alert()->flash('Seçilenler Silinmiştir.', 'success');
        return redirect()->back();

    }







public function tumtercumanlar(){


  $tercumanlist = TercumanVeritabani::where('Silindi', 0)
                ->where(function($q) {
          $q->where('OnayDurumu', 2)
            ->orWhere('OnayDurumu', 3);
      })->with('tercumandilbilgileri')
      ->get();




  return view('admin.pages.tumtercumanlar',['tercumanlist'=>$tercumanlist]);
}



public function tercumanduzenle($id)
{

     $tercumanduzenle = TercumanVeritabani::find($id);
     return view('admin.pages.tercumanduzenle',['tercumand'=>$tercumanduzenle]);



}






public function tercumanbasvurulari()
  {


     $tercumanbasvurulari=TercumanVeritabani::where(['Silindi'=>0,'OnayDurumu'=>0])
    ->whereYear('BasvuruTarihi','>','2016-12-31')
    ->with('tercumandilbilgileri')
    ->orderBy('BasvuruTarihi','DESC')->get();
    return view('admin.pages.tercumanbasvurulari',['tercumanbasvurulari'=>$tercumanbasvurulari]);

  }




  public function tercumanbasvurusil(Request $request)
  {
    $id=request()->input('basvurusil');

    $tercumanveritabani = TercumanVeritabani::findOrFail($id);
    $tercumanveritabani->Silindi = 1;
    $tercumanveritabani->push(); 

    alert()->flash('Başarıyla Silinmiştir.', 'success');
    return redirect()->route('tercumanbasvurulari');

  }


  public function tercumanbasvuruonayla(Request $request)

    {
      
            $id = request()->input('basvuruonay');

            $tercumanveritabani = TercumanVeritabani::find($id); 
            $tercumanveritabani->OnayDurumu=2;
            $tercumanveritabani->push(); 
            alert()->flash('Başarıyla Güncellenmiştir', 'success');
            return redirect()->route('tercumanbasvurulari');

    }



    public function tercumanmaliyet()
      {


        $tercumanmali=TercumanVeritabani::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->with('tercumandilbilgileri')
        ->orderBy('BasvuruTarihi','DESC')->get();  

        return view('admin.pages.tercumanmaliyet',['tercumali'=>$tercumanmali]);


      }



    public function maliyetara(Request $request){

        $ara = $request->input('ara');
        $dil = $request->input('dil');
        $calisilan = $request->input('calisilan');


         $results = DB::select(DB::raw("SELECT tercumanveritabani.isimSoyisim, tercumandilbilgileri.KaynakDil, tercumandilbilgileri.HedefDil,tercumandilbilgileri.BirimFiyat
                               FROM tercumanveritabani
                               INNER JOIN tercumandilbilgileri ON tercumanveritabani.id=tercumandilbilgileri.TercumanID WHERE tercumanveritabani.OnayDurumu=$calisilan AND tercumandilbilgileri.HedefDil='$dil' OR tercumandilbilgileri.KaynakDil='$dil'"));

         
         return view('admin.pages.maliyetsonuc',['result'=>$results]);

    }  




       public function tercumanara(Request $request){

        $dil = $request->input('dil2');
        $calisilan = $request->input('calisilan2');


         $results = DB::select(DB::raw("SELECT tercumanveritabani.Referanslar,tercumanveritabani.isimSoyisim,tercumanveritabani.id,tercumanveritabani.Mail,tercumanveritabani.Telefon, tercumandilbilgileri.KaynakDil, tercumandilbilgileri.HedefDil,tercumandilbilgileri.Tercume_Turu,tercumandilbilgileri.BirimFiyat,tercumanveritabani.temsilciNot
                               FROM tercumanveritabani
                               INNER JOIN tercumandilbilgileri ON 
                               tercumanveritabani.id=tercumandilbilgileri.TercumanID 
                               WHERE tercumanveritabani.OnayDurumu=$calisilan 
                               AND   tercumanveritabani.Silindi=0
                               AND tercumandilbilgileri.HedefDil='$dil' 
                               OR tercumandilbilgileri.KaynakDil='$dil'"));


         return view('admin.pages.tercumansonuc',['result'=>$results]);

    }  




    //TERCUMAN TAKİP 

public function tercumanistakipekle()

{


  $tercumanlist = TercumanVeritabani::where('Silindi', 0)
                ->where(function($q) {
          $q->where('OnayDurumu', 2)
            ->orWhere('OnayDurumu', 3);
      })->with('tercumandilbilgileri')
      ->get();

  
return view('admin.pages.tercumanistakipekle',['tercumanlist'=>$tercumanlist]);


}


public function tercumanformistakipekle(Request $request)

{
              $date = $request->input('EvrakAlmaTarihi');  
              $dt = new DateTime($date);
             $newdate=$dt->format('Y-m-d H:i:s');


                              $TercumanIsTakip = new TercumanIsTakip;
                              $TercumanIsTakip->EklenmeTarih = $newdate;
                              $TercumanIsTakip->TercumanAdi = $request->input('tercumanismi');
                              $TercumanIsTakip->ProjeAdi = $request->input('ProjeAdi');
                              $TercumanIsTakip->KaynakDil = $request->input('KaynakDil');
                              $TercumanIsTakip->HedefDil = $request->input('HedefDil');
                              $TercumanIsTakip->Karakter = $request->input('Karakter');
                              $TercumanIsTakip->BirimFiyat = $request->input('BirimFiyat');
                              $TercumanIsTakip->Adet = $request->input('Adet');
                              $TercumanIsTakip->TemsilciID = Auth::user()->id;
                              $TercumanIsTakip->SubeID =Auth::user()->sonsube->id;
                              $TercumanIsTakip->TercumanTakipNot = $request->input('TercumanTakipNot');
                              $TercumanIsTakip->OnayDurumu = 0;
                              $TercumanIsTakip->Silindi = 0;
                              $TercumanIsTakip->save();





 alert()->flash('Başarıyla Kayıt Edilmiştir', 'success');                             
return redirect()->back();
}




public function tercumanistakipcetveli()
{



   $tercumanistakipcetveli=TercumanIsTakip::where(['Silindi'=>0,'OnayDurumu'=>0])
        ->with('temsilci')
        ->orderBy('id','DESC')->get();
   return  view('admin.pages.tercumantakipcetveli',['tercumantakipcetveli'=>$tercumanistakipcetveli]);

}



public function tercumanistakipcetvelisil(Request $request)
{

   $id=request()->input('tercumanistakipsil');

  TercumanIsTakip::find($id)->update(['Silindi' => 1]);

  alert()->flash('Başarıyla Silindi', 'success');
  return redirect()->back();

}

public function tercumansil(Request $request)

{


  $id=$request->input('tercumansil');

   $tercumansil = TercumanVeritabani::find($id);
   $tercumansil->Silindi=1;
   $tercumansil->update();  

   alert()->flash('Başarıyla Silindi', 'success');
   return redirect()->back();

}


    public function tercumansil2(Request $request)

    {

        $id=$request->input('tercumansil2');

        $tercumansil2 = TercumanVeritabani::find($id);
        $tercumansil2->Silindi=1;
        $tercumansil2->update();

        alert()->flash('Başarıyla Silindi', 'success');
        return redirect()->route('tumtercumanlar');

    }



public function lksekle(Request $request)
{


  $id = request()->input('lksonay');
  $onaytarihi = date('Y-m-d H:i:s');


  TercumanIsTakip::find($id)->update(['OnayDurumu' => 1,'OnayTarihi'=>$onaytarihi]);

    alert()->flash('LKS ye Taşınmıştır', 'success');
   return redirect()->back();

}


public function tercumantakipduzenle($id)

{


    $tercumanlar = TercumanVeritabani::where(function ($query) {
        $query->where('OnayDurumu',2)
            ->orWhere('OnayDurumu',3);
    })->get();


  $istakip = TercumanIsTakip::find($id);
  return view('admin.pages.istakipedit',compact('istakip','tercumanlar'));

}

public function istakipupdate(Request $request,$id)

{


          $teklif = TercumanIsTakip::find($id);
          $input = $request->all();
          $teklif->update($input);
          alert()->flash('Başarıyla Güncellenmiştir', 'success');
          return redirect()->back();

}



public function lksyeeklenenler()
{


 

   $lksyeeklenenler=TercumanIsTakip::where(['Silindi'=>0,'OnayDurumu'=>1])
        ->whereYear('EklenmeTarih','>','2017-12-31')
        ->orderBy('EklenmeTarih','DESC')->get();
  return view('admin.pages.lksyeeklenenler',['lksekle'=>$lksyeeklenenler]);
}

public function dilsil($id)
{




  $dilbilgisisil=Tercumandilbilgileri::find($id);
  $dilbilgisisil->delete();

  return redirect()->back();


}


public function lksara(Request $request)
{

  $dil2=$request->input('dil3');
  $temsilci2=$request->input('temsilci3');


      $results=DB::select(DB::raw("SELECT
       tercumantakipcetveli.id,
       tercumantakipcetveli.TercumanAdi,
       tercumantakipcetveli.EklenmeTarih,
       tercumantakipcetveli.ProjeAdi, 
       tercumantakipcetveli.Karakter, 
       tercumantakipcetveli.BirimFiyat, 
       tercumantakipcetveli.KaynakDil,
       tercumantakipcetveli.HedefDil, 
       tercumantakipcetveli.TercumanTakipNot, 
       temsilciler.isimSoyisim 
   
                               FROM tercumantakipcetveli
                               INNER JOIN temsilciler ON 
                               tercumantakipcetveli.TemsilciID=temsilciler.id 
                               WHERE tercumantakipcetveli.OnayDurumu=1 
                               AND   tercumantakipcetveli.TemsilciID=$temsilci2
                               AND tercumantakipcetveli.HedefDil='$dil2'
                               OR tercumantakipcetveli.KaynakDil='$dil2'"));

         
         return view('admin.pages.lkssonuc',['result'=>$results]);




}



public function idgonder(Request $request)
{

  
  $id= $request->id;
  $user = Teklifler::find($id);


  

  return response()->json( ['user'=>$user]);

}


    public function tercumanidgonder(Request $request)
    {


        $id= $request->id;

        $user = TercumanVeritabani::find($id);

        $user4=$user->tercumandilbilgileri()->get();

        return response()->json( ['user4'=>$user4]);

    }










public function gelentekliffiyatver(Request $request)
{
            $id=request()->input('tekliffiyat');



            $yazi=$request->mailMetin;

            $data = strip_tags($yazi);



            $teklif = Teklifler::find($id);

            Mail::raw($data, function($message) use($teklif)
              {
                $message->from('info@portakaltercume.com.tr', 'Portakal Tercüme A.Ş.')->subject('Portakal Tercüme Fiyat Teklifi');
                $message->to($teklif->Email);
              });


            $teklif->GonderilenMailEvrakTuru=request()->input('evraktipi');
            $teklif->TeklifVerenTemsilci =Auth::user()->id;
            $teklif->TeklifVerilenTarih=Carbon::now();
            $teklif->SubeID = Auth::user()->sonsube->id;
            $teklif->TasdikSekli=request()->input('tastiksekli');
            $teklif->GonderilenGun=request()->input('isgunu');
            $teklif->GonderilenGun=request()->input('issaati');
            $teklif->Fiyat=request()->input('fiyat');
            $teklif->TemsilciProjeNot=request()->input('temsilcinot');
            
            
           @rename("../crm/dosya/gelenteklifler/".$id,"../crm/dosya/onaybekleyenler/$id");
            
            $teklif->OnayDurumu=1;

            $teklif->update();

            alert()->flash('Teklif Verilmiştir.', 'success');  
            return redirect()->route('dashboard');


}


//ADLİYE FONKSİYONLARI


public function adliyeisekle()

{
  return view('admin.pages.adliyeisekle');
}


  public function adliyeiseklepost(Request $request)

            {

             $date = $request->input('EvrakAlmaTarihi');  
             $dt = new DateTime($date);
             $newdate=$dt->format('Y-m-d H:i:s');

         


                $AdliyeTakipCetveli = new AdliyeTakipCetveli;
                $AdliyeTakipCetveli->EvrakAlmaTarihi =$newdate;
                $AdliyeTakipCetveli->MahkemeNo = $request->input('MahkemeNo');
                $AdliyeTakipCetveli->MahkemeID = $request->input('MahkemeID');
                $AdliyeTakipCetveli->EsasNo = $request->input('EsasNo');
                $AdliyeTakipCetveli->KaynakDil = $request->input('KaynakDil');
                $AdliyeTakipCetveli->HedefDil =$request->input('HedefDil');
                $AdliyeTakipCetveli->TalepEdilenFiyat = $request->input('TalepEdilenFiyat');
                $AdliyeTakipCetveli->AlinanOdeme= $request->input('AlinanOdeme');
                $AdliyeTakipCetveli->TemsilciNot= $request->input('TemsilciNot');
                $AdliyeTakipCetveli->TemsilciID = $request->input('TemsilciID');
                $AdliyeTakipCetveli->OnayDurumu =1;
                $AdliyeTakipCetveli->Silindi = 0;

                

                $AdliyeTakipCetveli->save();

                alert()->flash('Başarıyla Kayıt Edilmiştir', 'success');
                return redirect()->back();




            }



public function adliyedevameden()
{


     $adliyedevam = AdliyeTakipCetveli::where(['Silindi'=>0,'OnayDurumu'=>1])->get();

     return view('admin.pages.adliyedevam',['adliyedevam'=>$adliyedevam]);


}


public function adliyedevamonayla(Request $request)
{


  $id = $request->input('adliyedevamid');

             $date = $request->input('EvrakAlmaTarihi');  
             $dt = new DateTime($date);
             $newdate=$dt->format('Y-m-d H:i:s');


            $adliyedevamonayla = AdliyeTakipCetveli::find($id);
            $adliyedevamonayla->OnaylayanTemsilci=$request->input('onaylayantemsilci');
            $adliyedevamonayla->EvrakAlmaTarihi=$newdate;
            $adliyedevamonayla->AlinanOdeme=$request->input('AlinanOdeme');
            $adliyedevamonayla->OnayDurumu =2;
            $adliyedevamonayla->update();

            alert()->flash('Başarıyla Onaylanmıştır', 'success');
            return redirect()->back();



}


public function adliyekayitsil(Request $request)
{



 $id = $request->input('adliyekayitsil');

 $adliyekayitsil = AdliyeTakipCetveli::find($id);

 $adliyekayitsil->Silindi = 1;
 $adliyekayitsil->update();

  alert()->flash('Başarıyla Silinmiştir', 'success');
  return redirect()->back();





}

public function adliyeedit($id)
{



  $data = AdliyeTakipCetveli::find($id);

  return view('admin.pages.adliyeedit',['adliyedata'=>$data]);


}


public function adliyeupdate(Request $request,$id)

{

      $date = $request->input('EvrakAlmaTarihi');  
      $dt = new DateTime($date);
      $newdate=$dt->format('Y-m-d H:i:s');



      $date = $request->input('EvrakTeslimTarihi');  
      $dt = new DateTime($date);
      $newdate1=$dt->format('Y-m-d H:i:s');







          $update = AdliyeTakipCetveli::find($id);
          $update->EvrakAlmaTarihi =$newdate;
          $update->EvrakTeslimTarihi =$newdate;
          $update->MahkemeNo = $request->input('MahkemeNo');
          $update->MahkemeID = $request->input('MahkemeID');
          $update->EsasNo = $request->input('EsasNo');
          $update->KaynakDil = $request->input('KaynakDil');
          $update->HedefDil =$request->input('HedefDil'); 
          $update->TalepEdilenFiyat = $request->input('TalepEdilenFiyat');
          $update->AlinanOdeme= $request->input('AlinanOdeme');
          $update->TemsilciNot= $request->input('TemsilciNot');
          $update->TemsilciID = $request->input('TemsilciID');
  

          $update->update();
          










          alert()->flash('Başarıyla Güncellenmiştir', 'success');
          return redirect()->route('adliyedevameden');



}



public function adliyetamamlanan()


{


     $adliyetamam = AdliyeTakipCetveli::where(['Silindi'=>0,'OnayDurumu'=>2])->get();

     return view('admin.pages.adliyetamam',['adliyetamam'=>$adliyetamam]);






}




public function geribildirimformu()
{



  $gb=Geribildirim::all();
  return view('admin.pages.geribildirimformu',['gb'=>$gb]);

}






public function  istatistik()
{







    //AYLAR COUNT
    $ocak=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-01%')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $ocakcount = count($ocak);

    $subat=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-02%')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $subatcount = count($subat);

    $mart=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-03%')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $martcount = count($mart);

    $nisan=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-04%')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $nisancount = count($nisan);

    $mayis=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-05%')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $mayiscount = count($mayis);

    $haziran=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-06%')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $hazirancount = count($haziran);

    $temmuz=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-07%')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $temmuzcount = count($temmuz);


    $agustos=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-08%')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $agustoscount = count($agustos);

    $eylul=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-09%')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $eylulcount = count($eylul);

    $ekim=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-10%')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $ekimcount = count($ekim);

    $kasim=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-11%')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $kasimcount = count($kasim);

    $aralik=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-12%')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $aralikcount = count($aralik);
    //AYLAR COUNT BİTİŞ









    //ONAY BEKLEYENLER AYLARA GÖRE DİZİLİM
    $ocakonay=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('GelenTeklifTarihi','LIKE','%2018-01%')->get();
    $ocakcountonay = count($ocakonay);

    $subatonay=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('GelenTeklifTarihi','LIKE','%2018-02%')->get();
    $subatcountonay = count($subatonay);

    $martonay=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('GelenTeklifTarihi','LIKE','%2018-03%')->get();
    $martcountonay = count($martonay);

    $nisanonay=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('GelenTeklifTarihi','LIKE','%2018-04%')->get();
    $nisancountonay = count($nisanonay);

    $mayisonay=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('GelenTeklifTarihi','LIKE','%2018-05%')->get();
    $mayiscountonay = count($mayisonay);

    $haziranonay=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('GelenTeklifTarihi','LIKE','%2018-06%')->get();
    $hazirancountonay = count($haziranonay);

    $temmuzonay=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('GelenTeklifTarihi','LIKE','%2018-07%')->get();
    $temmuzcountonay = count($temmuzonay);


    $agustosonay=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('GelenTeklifTarihi','LIKE','%2018-08%')->get();
    $agustoscountonay = count($agustosonay);

    $eylulonay=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('GelenTeklifTarihi','LIKE','%2018-09%')->get();
    $eylulcountonay = count($eylulonay);

    $ekimonay=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('GelenTeklifTarihi','LIKE','%2018-10%')->get();
    $ekimcountonay = count($ekimonay);

    $kasimonay=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('GelenTeklifTarihi','LIKE','%2018-11%')->get();
    $kasimcountonay = count($kasimonay);

    $aralikonay=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('GelenTeklifTarihi','LIKE','%2018-12%')->get();
    $aralikcountonay = count($aralikonay);

    //İPTAL TEKLİFLER AYLARA GÖRE

    $ocakiptal=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','LIKE','%2018-01%')->get();
    $ocakcountiptal = count($ocakiptal);

    $subatiptal=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','LIKE','%2018-02%')->get();
    $subatcountiptal = count($subatiptal);

    $martiptal=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','LIKE','%2018-03%')->get();
    $martcountiptal = count($martiptal);

    $nisaniptal=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','LIKE','%2018-04%')->get();
    $nisancountiptal = count($nisaniptal);

    $mayisiptal=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','LIKE','%2018-05%')->get();
    $mayiscountiptal = count($mayisiptal);

    $haziraniptal=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','LIKE','%2018-06%')->get();
    $hazirancountiptal = count($haziraniptal);

    $temmuziptal=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','LIKE','%2018-07%')->get();
    $temmuzcountiptal = count($temmuziptal);


    $agustosiptal=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','LIKE','%2018-08%')->get();
    $agustoscountiptal = count($agustosiptal);

    $eyluliptal=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','LIKE','%2018-09%')->get();
    $eylulcountiptal = count($eyluliptal);

    $ekimiptal=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','LIKE','%2018-10%')->get();
    $ekimcountiptal = count($ekimiptal);

    $kasimiptal=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','LIKE','%2018-11%')->get();
    $kasimcountiptal = count($kasimiptal);

    $aralikiptal=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','LIKE','%2018-12%')->get();
    $aralikcountiptal = count($aralikiptal);



//İPTAL SEBEPLERİ TOPLAM

    $yapilmayacak=Teklifler::where(['Silindi'=>1,'OnayDurumu'=>0,'iptalNedeni'=>1])
    ->where('iptalTarihi','>','2017-12-31')->get();

    $yapilmayacak1 = count($yapilmayacak);

    $fiyatyuksek=Teklifler::where(['Silindi'=>1,'OnayDurumu'=>0,'iptalNedeni'=>2])
        ->where('iptalTarihi','>','2017-12-31')->get();

    $fiyatyuksek1 = count($fiyatyuksek);

    $baskafirma=Teklifler::where(['Silindi'=>1,'OnayDurumu'=>0,'iptalNedeni'=>3])
    ->where('iptalTarihi','>','2017-12-31')->get();

    $baskafirma1 = count($baskafirma);

    $gecdonus=Teklifler::where(['Silindi'=>1,'OnayDurumu'=>0,'iptalNedeni'=>4])
        ->where('iptalTarihi','>','2017-12-31')->get();

    $gecdonus1 = count($gecdonus);

    $mukerrer=Teklifler::where(['Silindi'=>1,'OnayDurumu'=>0,'iptalNedeni'=>5])
        ->where('iptalTarihi','>','2017-12-31')->get();

    $mukerrer1 = count($mukerrer);


    $tercuman=Teklifler::where(['Silindi'=>1,'OnayDurumu'=>0,'iptalNedeni'=>6])
        ->where('iptalTarihi','>','2017-12-31')->get();

    $tercuman1 = count($tercuman);



    $maildenteklifverildi=Teklifler::where(['Silindi'=>1,'OnayDurumu'=>0,'iptalNedeni'=>7])
        ->where('iptalTarihi','>','2017-12-31')->get();

    $maildenteklifverildi1 = count($maildenteklifverildi);

    $diger=Teklifler::where(['Silindi'=>1,'OnayDurumu'=>0,'iptalNedeni'=>99])
        ->where('iptalTarihi','>','2017-12-31')->get();

    $diger1 = count($diger);

    //TEMSİLCİLERİN VERDİĞİ TOPLAM TEKLİFLER


    //ŞULENİN VERDİĞİ TEKLİF SAYISI
    $teklifsule=Teklifler::where(['TeklifVerenTemsilci'=>1])
        ->whereYear('TeklifVerilenTarih','>','2017-12-31')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $teklifsule1 = count($teklifsule);



    $teklifhandan=Teklifler::where(['TeklifVerenTemsilci'=>2])
        ->whereYear('TeklifVerilenTarih','>','2017-12-31')->whereNotIn('iptalNedeni', [0])->get();

    $teklifhandan1 = count($teklifhandan);


    $teklifgurkan=Teklifler::where(['TeklifVerenTemsilci'=>3])
        ->whereYear('GelenTeklifTarihi','>','2017-12-31')->whereNotIn('iptalNedeni', [5,6,99])->get();
    $teklifgurkan1= count($teklifgurkan);




    $teklifahmet=Teklifler::where(['TeklifVerenTemsilci'=>5])
        ->whereYear('TeklifVerilenTarih','>','2017-12-31')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $teklifahmet1= count($teklifahmet);

    $teklifsumeyye=Teklifler::where(['TeklifVerenTemsilci'=>6])
        ->whereYear('TeklifVerilenTarih','>','2017-12-31')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $teklifsumeyye1= count($teklifsumeyye);


    $teklifyesim=Teklifler::where(['TeklifVerenTemsilci'=>10])
        ->whereYear('TeklifVerilenTarih','>','2017-12-31')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $teklifyesim1= count($teklifyesim);

    $teklifkubra=Teklifler::where(['TeklifVerenTemsilci'=>11])
        ->whereYear('TeklifVerilenTarih','>','2017-12-31')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $teklifkubra1= count($teklifkubra);


    //NEREDEN GELDİ TOPLAM


    $internetgelen=Teklifler::where(['NeredenGeldi'=>1])
        ->whereYear('GelenTeklifTarihi','>','2017-12-31')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $internetgelen1= count($internetgelen);

    $surekligelen=Teklifler::where(['NeredenGeldi'=>2])
        ->whereYear('GelenTeklifTarihi','>','2017-12-31')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $surekligelen1= count($surekligelen);

    $referansgelen=Teklifler::where(['NeredenGeldi'=>3])
        ->whereYear('GelenTeklifTarihi','>','2017-12-31')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $referansgelen1= count($referansgelen);

    $notergelen=Teklifler::where(['NeredenGeldi'=>4])
        ->whereYear('GelenTeklifTarihi','>','2017-12-31')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $notergelen1= count($notergelen);






    //GELEN BEKLEYENLER COUNT

    $gelenteklif=Teklifler::where(['Silindi'=>0])
        ->whereYear('GelenTeklifTarihi','>','2017-12-31')->get();

    $gelencount1 = count($gelenteklif);

    //ONAY BEKLEYENLER


    $onaybekleyen=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>1])
        ->where('TeklifVerilenTarih','>','2017-12-31')->get();

    $onaycount1 = count($onaybekleyen);



    //DEVAM EDENLER

    $devamteklif=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>2])
        ->whereYear('TeklifVerilenTarih','>','2017-12-31')->get();


    $devamcount1 = count($devamteklif);


    //TAMAMLANAN TEKLİFLER COUNT

    $tamamlananteklif=Teklifler::where(['Silindi'=>0,'OnayDurumu'=>3])
        ->where('EvrakTeslimTarihi','>','2017-12-31')->get();


    $tamamlanancount1 = count($tamamlananteklif);




//İPTAL TEKLİFLER

    $iptalteklif=Teklifler::where(['Silindi'=>1])
        ->where('iptalTarihi','>','2017-12-31')->get();


    $iptalteklifcount1 = count($iptalteklif);


    //GÜNLERE GÖRE VERİLER //////////////////////////////////////////////////////////////////////////////////////////////
    $now =Carbon::now();
    $month = $now->format('m');


    $bir=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-01%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $bircount = count($bir);


    $iki=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-02%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $ikicount = count($iki);

    $uc=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-03%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $uccount = count($uc);

    $dort=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-04%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $dortcount = count($dort);



    $bes=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-05%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $bescount = count($bes);


    $alti=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-06%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $alticount = count($alti);


    $yedi=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-07%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $yedicount = count($yedi);


    $sekiz=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-08%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $sekizcount = count($sekiz);


    $dokuz=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-09%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $dokuzcount = count($dokuz);


    $on=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-10%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $oncount = count($on);



    $onbir=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-11%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $onbircount = count($onbir);


    $oniki=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-12%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $onikicount = count($oniki);


    $onuc=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-13%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $onuccount = count($onuc);


    $ondort=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-14%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $ondortcount = count($ondort);


    $onbes=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-15%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $onbescount = count($onbes);


    $onalti=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-16%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $onalticount = count($onalti);


    $onyedi=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-17%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $onyedicount = count($onyedi);


    $onsekiz=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-18%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $onsekizcount = count($onsekiz);


    $ondokuz=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-19%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $ondokuzcount = count($ondokuz);


    $yirmi=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-20%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $yirmicount = count($yirmi);


    $yirmibir=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-21%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $yirmibircount = count($yirmibir);


    $yirmiiki=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-22%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $yirmiikicount = count($yirmiiki);



    $yirmiuc=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-23%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $yirmiuccount = count($yirmiuc);


    $yirmidort=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-24%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $yirmidortcount = count($yirmidort);


    $yirmibes=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-25%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $yirmibescount = count($yirmibes);


    $yirmialti=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-26%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $yirmialticount = count($yirmialti);

    $yirmiyedi=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-27%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $yirmiyedicount = count($yirmiyedi);


    $yirmisekiz=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-28%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $yirmisekizcount = count($yirmisekiz);

    $yirmidokuz=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-29%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $yirmidokuzcount = count($yirmidokuz);

    $otuz=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-30%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $otuzcount = count($otuz);

    $otuzbir=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-30%')->whereNotIn('iptalNedeni', [5,6,99])->get();

    $otuzbircount = count($otuzbir);




    return view('admin.pages.istatistik',compact('gelencount1','onaycount1','devamcount1', 'tamamlanancount1','iptalteklifcount1', 'ocakcount','subatcount','martcount',
        'nisancount','mayiscount','hazirancount','tezmmucount','hazirancount','temmuzcount','agustoscount','eylulcount','ekimcount','kasimcount','aralikcount','ocakcountonay','subatcountonay','martcountonay',
        'nisancountonay','mayiscountonay','hazirancountonay','temmuzcountonay','agustoscountonay','eylulcountonay','ekimcountonay','kasimcountonay','aralikcountonay','yapilmayacak1','fiyatyuksek1',
        'baskafirma1','gecdonus1','mukerrer1','tercuman1','maildenteklifverildi1','diger1','teklifsule1','teklifhandan1','teklifgurkan1','teklifahmet1','teklifsumeyye1','teklifyesim1','teklifkubra1',
        'internetgelen1','surekligelen1','referansgelen1','notergelen1','ocakcountiptal','subatcountiptal','martcountiptal','nisancountiptal','mayiscountiptal','hazirancountiptal','temmuzcountiptal',
        'agustoscountiptal','eylulcountiptal','ekimcountiptal','kasimcountiptal','aralikcountiptal','bircount','ikicount','uccount','dortcount','bescount','alticount','yedicount','sekizcount',
        'dokuzcount','oncount','onbircount','onikicount','onuccount','ondortcount','onbescount','onalticount','onyedicount','onsekizcount','ondokuzcount','yirmicount','yirmibircount',
        'yirmiikicount','yirmiuccount','yirmidortcount','yirmibescount','yirmialticount','yirmiyedicount','yirmisekizcount','yirmidokuzcount','otuzcount','otuzbircount'));

}


public function  taslaklar()
{
    return view('admin.pages.taslaklar');
}

    public function  hesapno()
    {
        return view('admin.pages.hesapno');
    }

    public function  subeiletisim()
    {
        return view('admin.pages.subeiletisim');
    }

    public function  logolar()
    {
        return view('admin.pages.logolar');
    }


    public function  denememetin()
    {
        return view('admin.pages.denememetin');
    }




    public  function raporara(Request $request)
    {
        $tarih=$request->input('RaporAlmaTarihi');

        $dt = new DateTime($tarih);
        $newdate=$dt->format('Y-m-d H:i:s');

        $tarih2=$request->input('RaporAlmaTarihi2');

        $dt2 = new DateTime($tarih2);
        $newdate2=$dt2->format('Y-m-d H:i:s');



    }



public function  test2()
{

    return view('admin.pages.test');

}









public function test()
{

    $now =Carbon::now();
    $month = $now->format('m');

    $bir=Teklifler::where('GelenTeklifTarihi','LIKE','%2018-'.$month.'-01%')->get();

    $bircount = count($bir);

    return $bircount;

}










}
