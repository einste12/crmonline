<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teklifler extends Model
{
public $timestamps = false;


protected $fillable = [
    'id', 'isimSoyisim', 'Email','Telefon','FormGelenTur','iptalNedeni','TeklifVerenTemsilci','OnayDurumu','Silindi',
    'KaynakDil','HedefDil','MeslekiUzmanlik','MusteriTalebi','TercumanID','TastikSekli','Fiyat',
    'Kapora','TemsilciProjeNot','OnaylayanTemsilciID','OnayVerilenTarih','EvrakTeslimTarihi','TeklifVerilenTarih','iptalEdenTemsilciID','PaneldenEklendi','CustomerType',
    'GonderilenGun','GonderilenSaat','GonderilenMailEvrakTuru','FormUrl','SurekliMusteri','SubeID','iptalTarihi','GelenTeklifTarihi',
];

  protected $table = 'teklifler';




public function tercuman()
{
  return $this->hasOne('App\TercumanVeritabani','id','TercumanID');
}


public function temsilci()
{
  return $this->hasOne('App\Temsilciler','id','TeklifVerenTemsilci');
}


public function temsilci2()
{
  return $this->hasOne('App\Temsilciler','id','OnaylayanTemsilciID');
}



public function temsilci_iptal()
{
  return $this->hasOne('App\Temsilciler','id','iptalEdenTemsilciID');
}



public function iptalneden()
{
  return $this->hasOne('App\IptalNedenleri','id','iptalNedeni');
}


public function  oftdosya()
        
{
     return $this->hasMany('App\OftDosya','oftid','id');
}




}
