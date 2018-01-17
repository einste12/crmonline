<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TercumanIsTakip extends Model
{
  public $timestamps =false;

  protected $table = 'tercumantakipcetveli';


    protected $fillable = [
        'EklenmeTarih', 'TercumanAdi', 'ProjeAdi','KaynakDil','HedefDil','Karakter','BirimFiyat','TemsilciID','SubeID','TercumanTakipNot','OnayDurumu','Silindi','OnayTarihi','Adet',
  ];





public function temsilci()
{

  return $this->hasOne('App\Temsilciler','id','TemsilciID');

}


    public function subeler()
    {

        return $this->hasOne('App\Subeler','id','SubeID');

    }


}
