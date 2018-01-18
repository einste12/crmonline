
    $('#edit-modal').on('show.bs.modal', function(e) {

            var $modal = $(this),
                esseyId = e.relatedTarget.id;

                 $(".modal-body #bookId").val( esseyId );


});

$('#edit-modal2').on('show.bs.modal', function(e) {

    var $modal = $(this),
        esseyId = e.relatedTarget.id;

         $(".modal-body #devamedenid").val( esseyId );


});







$('#edit-modal4').on('show.bs.modal', function(e) {

    var $modal = $(this),
        esseyId = e.relatedTarget.id;

         $(".modal-body #basvuruonay").val( esseyId );


});


$('#edit-modal5').on('show.bs.modal', function(e) {

    var $modal = $(this),
        esseyId = e.relatedTarget.id;

         $(".modal-body #lksonay").val( esseyId );

});


$('#edit-modal7').on('show.bs.modal', function(e) {

    var $modal=$(this),
        Id5=e.relatedTarget.id;


         $(".modal-body #gelenteklifsil1").val( Id5 );

});

//FİYAT TEKLİFİ VER MODALA ID YOLLAMA
$('#edit-modal6').on('show.bs.modal', function(e) {
    var $modal = $(this),
        data = e.relatedTarget.id;

$(".modal-body #tekliffiyat1").val( data );

         $.ajax({
            url: 'idgonder/'+data,
            type: 'GET',
            dataType: "json",
            success:function(data) {
               
              

               $("#isimSoyisim").text(data.user.isimSoyisim);
               $(".ilkisim").text(data.user.isimSoyisim);
             
               
            }
        });







});




    $(document).on("change","#TercumanAdi",function(){
        var id = ($(this).children(":selected").attr("id"));


        $.ajax({
            url: 'tercumanidgonder/'+id,
            type: 'GET',
            dataType: "json",
            success:function(data) {

                itemLength = data.user4.length;
                $('.kaynakdil1').html('');
                $('.hedefdil1').html('');
                for (i = 0; i < itemLength; i++){

                    $('.kaynakdil1').append($('<option>', {
                        value: data.user4[i].KaynakDil,
                        text: data.user4[i].KaynakDil
                    }));

                    $('.hedefdil1').append($('<option>', {
                        value: data.user4[i].HedefDil,
                        text: data.user4[i].HedefDil+-+data.user4[i].BirimFiyat+'TL'
                    }));

                   // console.log(data.user4[i].HedefDil);
                }







            }
        });

    });












//Onay bekleyen sil id yollama
$('#edit-modal8').on('show.bs.modal', function(e) {

    var $modal = $(this),
        Id2 = e.relatedTarget.id;

         $(".modal-body #onaybekleyensil").val( Id2 );

});

//Devam Sil
$('#edit-modal9').on('show.bs.modal', function(e) {

    var $modal = $(this),
        Id3 = e.relatedTarget.id;

         $(".modal-body #devamedensil").val( Id3 );

});


//TERCUMAN SİLME MODALI
$('#edit-modal10').on('show.bs.modal', function(e) {

    var $modal = $(this),
        Id4 = e.relatedTarget.id;



         $(".modal-body #tercumansil").val( Id4 );

});

//TERCUMANSONUCSİL
    $('#edit-modal20').on('show.bs.modal', function(e) {

        var $modal = $(this),
           gelen = e.relatedTarget.id;



        $(".modal-body #tercumansil2").val( gelen );

    });


//TERCUMAN BASVURU SİLME MODALI
    $('#edit-modal30').on('show.bs.modal', function(e) {

        var $modal = $(this),
            Id30 = e.relatedTarget.id;



        $(".modal-body #basvurusil").val( Id30 );

    });
//TERCUMAN TAKİP SİL
    $('#edit-modal40').on('show.bs.modal', function(e) {

        var $modal = $(this),
            Id40 = e.relatedTarget.id;



        $(".modal-body #tercumanistakipsil").val( Id40 );

    });







//ADLİYE İŞ ONAYLA
$('#edit-modal11').on('show.bs.modal', function(e) {

    var $modal = $(this),
        Id11 = e.relatedTarget.id;

         $(".modal-body #adliyedevamid").val( Id11 );

});



//ADLİYE İŞ SİL
$('#edit-modal12').on('show.bs.modal', function(e) {

    var $modal = $(this),
        Id12 = e.relatedTarget.id;

         $(".modal-body #adliyekayitsil").val( Id12 );

});










    // İŞ EKLERKEN YANA YAZDIRMA KODU

    $(document).ready(function(){
 


        $("[name='KaynakDil']").change(function(){
            $("#kaynakdil").html($(this).val());
        });

        $("[name='TercumanID']").change(function(){
            var e = document.getElementById("Tercumanlar");
            var strUser = e.options[e.selectedIndex].text;

            $("#tercuman").html(strUser);
        });


        $("[name='TasdikSekli']").change(function(){
            var e = document.getElementById("TastikSekli1");
            var strUser = e.options[e.selectedIndex].text;

            $("#tastiksekli").html(strUser);
        });


        $("[name='SubeID'").focusout(function(){
           $("#subeid").html($(this).val());
        });

        $("[name='GelenTeklifTarihi']").focusout(function(){
            $("#evrakalmatarihi").html($(this).val());
        });
    });



    $(document).ready(function(){

        $("#tastiksekli1").change(function() {

            var secilen = $(this).val();



            if(secilen==2)
            {


                document.getElementById("tasdiksiz").innerHTML = "Verilen fiyat noter yeminli tercüme hizmeti içindir.\n" +
                    "Noter tasdik ücreti ve Apostil hizmeti verilen fiyata dahil değildir.";

            }else{
                document.getElementById("tasdiksiz").innerHTML = "";

            }

        });
    });









    //İŞ TAKİP EKLE FORM GİZLEME OLAYLARI
    $(document).ready(function(){

        $("#TercumeTuru").change(function() {

            var secilen = $(this).val();

            if(secilen==1)
            {
                $(".genel").removeClass("hidden");
                $("#karakters").removeClass("hidden");
                $("#adets").addClass('hidden');
                $("#kar").attr('type','hidden').appendTo('form');
                $("#birim").removeClass("hidden");
            }
            if(secilen=="")
            {
                $(".genel").addClass("hidden");
            }

            if(secilen==2)
            {
                $(".genel").removeClass("hidden");
                $("#karakters").addClass("hidden");
                $("#adets").removeClass('hidden');
                $("#kar2").attr('type','hidden').appendTo('form');
                $("#birim").addClass("hidden");

            }

        });
        });


  // TEKLİFE FİYAT VERME KODLARI
$(document).ready(function(){

    $("#evraktipi").change(function(){

        var secilen = $(this).val();


        if(secilen==2)
        {
             $('.disa').prop('disabled', false);   
             $("#evraksiz").removeClass("hidden");
             $("#evrakli").addClass("hidden");
             $("#tastiksekli").addClass("hidden");
             $("#teslimzamani1").addClass("hidden");
             $("#fiyat").addClass("hidden");
            $("#isgunu").addClass("hidden");


        }


          if(secilen==1)
        {
            $('.disa').prop('disabled', false);
             $("#evrakli").removeClass("hidden");
             $("#evraksiz").addClass("hidden");
             $("#tastiksekli").removeClass("hidden");
             $("#teslimzamani1").removeClass("hidden");
             $("#fiyat").removeClass("hidden");


        }

              if(secilen=="")
        {
             // $('.disa').prop('disabled', true);
             $("#evraksiz").addClass("hidden");
             $("#evrakli").addClass("hidden");
             $("#tastiksekli").addClass("hidden");
             $("#teslimzamani1").addClass("hidden");
             $("#fiyat").addClass("hidden");
             $("#sube").addClass("hidden");

        }
  




});

//FİYAT TEFLİFİ VER TESLİM ZAMANINI GÖSTERME GİZLEME

$("select#teslimzamani").change(function(){


    var teslimzamani = $(this).val();
  
    $("#isgunu").removeClass("hidden");

    if (teslimzamani==''){
        $("#isgunu").addClass("hidden");
        $("#issaati").addClass("hidden");
    

    }else if(teslimzamani==1){


    $("#isgunu").removeClass("hidden");
    $("#issaati").addClass("hidden");
    
    



}else{

    $("#issaati").removeClass("hidden");
    $("#isgunu").addClass("hidden");

}

});




});




$(document).ready(function(){

    $('.selectpicker').selectpicker();


    });






//TERCUMAN BASVURULARI FORM YOLLAMA KODU
    $( document ).ready(function() {
       $('.seciliSil').click(function(){
           if (confirm('Seçilen Teklifleri Silmek İstediğinize Emin Misiniz?')) {
               $("#secili").submit();
           }
       });
    });

//İSTAKİP CETVELİ TOPLU LKS EKLEME FORMU YOLLAMA KODU.
    $( document ).ready(function() {
        $('.seciliSil1').click(function(){

                $("#secili1").submit();

        });
    });

    //GELEN TEKLİFLER TOPLU SİLME İŞLEMİ
    $( document ).ready(function() {
        $('.seciliSil2').click(function(){
            if (confirm('Seçilen Teklifleri Silmek İstediğinize Emin Misiniz?')) {
                $("#secili2").submit();

            }
        });
    });


