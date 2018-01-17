<div class="sidebar" data-color="orange" data-image="">

  <div class="sidebar-wrapper">
      <div class="logo">
          <a href="http://www.creative-tim.com" class="simple-text logo-mini">

          </a>
          <a href="http://www.creative-tim.com" class="simple-text logo-normal">
              <a href="{{ route('dashboard') }}" class="logo-text">
                  İş Takİp Sİstemİ V4.0
              </a>
          </a>
      </div>

      <div class="user">
          <div class="photo">
              <a style="padding: 0px;" href="{{ route('dashboard')  }}"><img src="{{ asset('img/logo.jpg')  }}" /></a>
         </div>
          <div class="info ">
              <a data-toggle="collapse" href="#collapseExample" class="" aria-expanded="true">
                            <span>  {{ strtoupper(Auth::user()->name) }}
                                <b class="caret"></b>
                            </span>
                  <span class="sube" >ŞUBE: {{ Auth::user()->sonsube->name }}</span>

              </a>
              <div class="collapse " id="collapseExample" style="">
                  <ul class="nav">
                      <li class="hidden">
                          <a class="profile-dropdown" href="#pablo">
                              <span class="sidebar-mini">MP</span>
                              <span class="sidebar-normal">My Profile</span>
                          </a>
                      </li>
                      <li class="hidden">
                          <a class="profile-dropdown" href="#pablo">
                              <span class="sidebar-mini">EP</span>
                              <span class="sidebar-normal">Edit Profile</span>
                          </a>
                      </li>
                      <li>
                          <a class="profile-dropdown" href="{{ route('logout') }}">
                              <span class="sidebar-mini">x</span>
                              <span class="sidebar-normal">Çıkış</span>
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>

        <ul class="nav">
            <li>
              <a href="{{ route('yeniisekle') }}">
                  
                  <i class="fa fa-plus" aria-hidden="true"></i><p>YENİ İŞ EKLE</p>
              </a>
             </li>
             <li> 
                <a href="{{ route('dashboard') }}">
                    
                    <i class="fa fa-commenting-o" aria-hidden="true"></i><p>GELEN TEKLİFLER ({{  $gelencount  }})</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples">
                    
                    <i class="fa fa-list-ul" aria-hidden="true"></i><p>PROJELER
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples">
                    <ul class="nav">
                        <li><a href="{{ route('onaybekleyen')}}"> Onay Bekleyen({{  $onaycount  }})</a></li>
                        <li><a href="{{ route('devameden') }}"> Devam Eden({{  $devamcount  }})</a></li>
                        <li><a href="{{ route('tamamlanan') }}"> Tamamlanan ({{  $tamamlananteklifcount  }})</a></li>
                        <li><a href="{{ route('iptalteklif') }}"> İptal Edilen({{  $iptalteklifcount  }}) </a></li>
                        
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples1">
                    <i class="pe-7s-plugin"></i>
                    <i class="fa fa-user-o" aria-hidden="true"></i><p>TERCÜMANLAR
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples1">
                    <ul class="nav">
                        <li><a href="{{ route('tercumanekle') }}">Yeni Tercüman Ekle</a></li>
                        <li><a href="{{ route('tercumanbasvurulari') }}">Tercüman Başvuruları({{  $tercumanbasvurucount  }})</a></li>
                        <li><a href="{{ route('tercumanmaliyet')}}">Tercüman Maliyet Tablosu</a></li>
                        <li><a href="{{ route('tumtercumanlar') }}">Tüm Tercümanlar({{ $tercumanlistcount }})</a></li>

                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples2">
                    <i class="pe-7s-plugin"></i>
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i><p>TERCÜMAN TAKİP
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples2">
                    <ul class="nav">
                        <li><a href="{{ route('tercumanistakipekle') }}">İş Ekle</a></li>
                        <li><a href="{{ route('tercumanistakipcetveli') }}">İş Takip Cetveli</a></li>
                        <li><a href="{{ route('lksyeeklenenler') }}">LKS ye Eklenenler</a></li>
                       
                    </ul>
                </div>
            </li>
            @if(\Auth::user()->role===2 or Auth::user()->role==99)
            <li>
                <a data-toggle="collapse" href="#componentsExamples3">
                    <i class="pe-7s-plugin"></i>
                    <i class="fa fa-university" aria-hidden="true"></i><p>ADLİYE
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples3">
                    <ul class="nav">
                        <li><a href="{{ url('adliyeisekle') }}">İş Ekle</a></li>
                        <li><a href="{{ url('adliyedevameden') }}">Devam Eden İşler</a></li>
                        <li><a href="{{ url('adliyetamamlanan')}}">Tamamlanan İşler</a></li>
                       
                    </ul>
                </div>
            </li>
            @endif
            <li> 
                <a href="{{ route('geribildirimformu') }}">
                    
                    <i class="fa fa-commenting-o" aria-hidden="true"></i><p>GERİ BİLDİRİM FORMU</p>
                </a>
            </li>




        </ul>
  </div>
</div>
