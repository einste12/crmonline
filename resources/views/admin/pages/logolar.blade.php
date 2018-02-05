@extends('admin.master.master')

@section('title')

    Logolar

@endsection

@section('content')


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Logolar </h4>
                        </div>
                        <div class="content row">


                            <div class="col-xs-6 col-md-3">
                                <a href="https://www.portakaltercume.net/crm/assets/img/logolar/portakal-medya-duz.png" class="thumbnail" target="_blank">
                                    <img  src="{{ asset('img/portakal-medya-duz.png') }}"/>
                                </a>

                                <a href="https://www.portakaltercume.net/crm/assets/img/logolar/portakal-medya-2.png" class="thumbnail" target="_blank" >
                                    <img  src="{{ asset('img/portakal-medya-2.png') }}"/>
                                </a>
                            </div>

                            <div class="col-xs-6 col-md-3">
                                <a href="https://www.portakaltercume.net/crm/assets/img/logolar/portakal-tercume-duz.png" class="thumbnail"target="_blank">
                                    <img  src="{{ asset('img/portakal-tercume-duz.png') }}"/>
                                </a>

                                <a href="https://www.portakaltercume.net/crm/assets/img/logolar/portakal-tercume-kare.png" class="thumbnail"target="_blank">
                                    <img  src="{{ asset('img/portakal-tercume-kare.png') }}"/>
                                </a>
                            </div>



                            <div class="col-xs-6 col-md-3">
                                <a href="https://www.portakaltercume.net/crm/assets/img/logolar/udiced.png" class="thumbnail"target="_blank">
                                    <img  src="{{ asset('img/udiced.png') }}"/>
                                </a>

                                <a href="https://www.portakaltercume.net/crm/assets/img/logolar/udiced-3.jpg" class="thumbnail"target="_blank">
                                    <img  src="{{ asset('img/udiced-3.jpg') }}"/>
                                </a>
                            </div>




                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection