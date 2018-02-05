@extends('admin.master.master')
@section('title')
    Yeni Tercüman Ekle - Panel
@endsection
@section('content')
    @if (alert()->ready())
        <script>
            swal({
                    title: "{!! alert()->message() !!}",
                    text: "{!! alert()->option('text') !!}",
                    type: "{!! alert()->type() !!}"
                }
            );
        </script>
    @endif
    <div class="content">
        <div class="container-fluid">
            <div class="card row">
                <form method="POST" action="{{ route('vttercumanekle') }}">
                    {{ csrf_field() }}
                    <div class="container" style="padding-top:40px; padding-bottom: 50px;">
                        <div class="col-md-6">
                            <legend>YENİ TERCÜMAN EKLE
                            </legend>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class=" control-label" for="adsoyad">Tercüman Adı Soyadı
                                        <span
                                                class="red">*
                  </span>
                                    </label>
                                    <div class="">
                                        <input required="true" id="ceptelefon" name="isimSoyisim" type="text"
                                               placeholder="Tercüman Adını Giriniz" class="form-control input-md"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class=" control-label" for="email">E-Posta Adresi
                                        <span class="red">*
                  </span>
                                    </label>
                                    <div class="">
                                        <input id="email" name="Email" type="email" placeholder="E-Posta Adresi Giriniz"
                                               class="form-control input-md">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class=" control-label" for="ceptelefon"> Telefon Numarası
                                        <span
                                                class="red">*
                  </span>
                                    </label>
                                    <div class="">
                                        <input id="ceptelefon" name="Telefon" type="number"
                                               placeholder="Telefon Numarası Giriniz" class="form-control input-md">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class=" control-label" for="Lokasyon">Lokasyon
                                        <span
                                                class="red">*
                  </span>
                                    </label>
                                    <div class="">
                                        <input id="Lokasyon" name="Lokasyon" type="text" placeholder="Lokasyon Giriniz"
                                               class="form-control input-md">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>Hesap Sahibi Giriniz
                                    </label>
                                    <input id="HesapSahibi" name="HesapSahibi" type="text"
                                           placeholder="Hesap Sahibinin Adını Giriniz" class=" form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>IBAN Numarası Giriniz
                                    </label>
                                    <input id="ibanno" name="ibanno" type="text" placeholder="IBAN Numarası Giriniz"
                                           class=" form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>TERCÜMAN HAKKINDA KISACA BİLGİ
                                    </label>
                                    <textarea id="TemsilciNot" name="TemsilciNot" type="text" placeholder=""
                                              class=" form-control">
                </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <section id="DilTablosu">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="fresh-datatables">
                                            <table id="diltablosu"
                                                   class="table table-striped table-no-bordered table-hover"
                                                   cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>Kaynak Dil
                                                    </th>
                                                    <th>Hedef Dil
                                                    </th>
                                                    <th>BİRİM FİYAT
                                                    </th>
                                                    <th>TERCÜME TÜRÜ
                                                    </th>
                                                    <th>İŞLEMLER
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top:20px;">
                                    <a title="Ekle" href="#myModal" data-toggle="modal" role="button"
                                       class="btn btn-warning btn-fill" data-target="#edit-modal8">
                                        <i
                                                class="fa fa-fw  fa-plus">
                                        </i>Yeni Dil Ekleyiniz
                                    </a>
                                </div>
                        </div>
                        </section>
                    </div>
                    <button id="submit" name="submit" class="btn btn-md btn-fill btn-wd btn-success"> Tercumanı Kaydet
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div id="edit-modal8" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 400px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Yeni Dİl Ekle
                    </h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3 form-group">
                            <label class=" control-label" for="">Tercüme Türü Seçiniz
                            </label>
                            <select id="TercumeTuru" name="TercumeTuru" class="form-control">
                                <option value="0">Yazılı Tercüme
                                </option>
                                <option value="1">Sözlü Tercüme
                                </option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3 form-group">
                                    <label class="control-label" for="kaynakdil">Kaynak Dil
                                    </label>
                                    <select id="kaynakdil" name="kaynakdil" class="form-control">
                                        @foreach($diller as $dillers)
                                            <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="control-label" for="hedefdil">Hedef Dil
                                    </label>
                                    <select id="hedefdil" name="hedefdil" class="form-control">
                                        @foreach($diller as $dillers)
                                            <option value="{{ $dillers->DilAdi }}">{{ $dillers->DilAdi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="control-label" for="adsoyad"> Birim Fiyat
                                    </label>
                                    <div class="">
                                        <input ="true" id="KarakterFiyati" name="birimfiyat" type="number" placeholder="
                                                                                                  Fiyat" class="sayi form-control input-md" >
                                    </div>
                                </div>
                                <div class="col-md-3 form-group" style="margin-top:23px !important;">
                                    <label class="control-label" for="">
                                    </label>
                                    <a id="dilekle" class="btn btn-md  btn-fill btn-success">Uygula
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $("#dilekle").click(function () {
                    var kaynakdil = $("[name='kaynakdil']").val();
                    var hedefdil = $("[name='hedefdil']").val();
                    var karakterFiyati = $("[name='birimfiyat']").val();
                    var tercumeTuru = $("[name='TercumeTuru']").val();
                    if (kaynakdil == "" || hedefdil == "") return;
                    var appendText = '<tr><td><input type="hidden" id="kaynakdil" name="kaynakdil1" value="' + kaynakdil + '">' + kaynakdil + '</td><td><input type="hidden" id="hedefdil" name="hedefdil1" value="' + hedefdil + '">' + hedefdil + '</td><td><input type="hidden" id="birimfiyat" name="birimfiyat1" value="' + karakterFiyati + '">' + karakterFiyati + ' TL</td><td><input type="hidden" id="tercumeturu" name="tercumeturu1" value="' + tercumeTuru + '">' + $("[name='TercumeTuru'] option:selected").text() + '</td><td class="td-actions text-left"><a id="dilsil" rel="tooltip" title="" class="btn btn-simple btn-danger btn-icon table-action view" data-original-title="Sil">SİL<i class="fa fa-remove"></i></a></td></tr>';
                    $("#diltablosu tbody").append(appendText);
                    tabloDuzenle();
                }
            );
            $(document).ready(function () {
                    $(document).on("click", "#diltablosu tbody #dilsil", function () {
                            $(this).parent().parent().remove();
                            tabloDuzenle();
                        }
                    );
                }
            );
            function tabloDuzenle() {
                $("#diltablosu tr").each(function () {
                        var index = $(this).index();
                        $(this).find("#kaynakdil").attr("name", "kaynakdil" + index);
                        $(this).find("#hedefdil").attr("name", "hedefdil" + index);
                        $(this).find("#birimfiyat").attr("name", "birimfiyat" + index);
                        $(this).find("#tercumeturu").attr("name", "tercumeturu" + index);
                    }
                );
            }
        </script>
@endsection
