@extends('admin.master.master')
@section('title')
    TERCUMAN İŞ TAKİP EKLE
@endsection
@section('content')

    <?php
    echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

    $browser = get_browser(null, true);
    print_r($browser);
    ?>

@endsection