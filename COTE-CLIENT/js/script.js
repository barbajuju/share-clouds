// création du copyright
var date = new Date();
var year = date.getFullYear();
$('#footer3').append('&copy;' + year);

// Lancement du Slider
$(function(){
    $('.slider-container').loopslider({
        autoplay: true,
        visibleItems: 1,
        step: 1,
        pagination: true,
        responsive:true,
        slideDuration:1200
    });
});

// affichage de Home au démarrage
window.onload=showHome;

// affichage du Home
function showHome(){
    $("#slider").hide();
    $("#take-picture").hide();
    $("#map").hide();
    $("#album").hide();
    $("#detail").hide();
    $("#footer1").hide();
    $("#footer2").hide();
    $("#footer3").hide();

    $("#titre").delay(200).fadeIn(800);
    $("#footer1").delay(1200).css("display", "flex").hide().fadeIn(800);
    $("#footer2").delay(1700).css("display", "flex").hide().fadeIn(800);
    $("#footer3").delay(2000).fadeIn(800);
}

// affichage de TakePicture
function showTakePicture(){
    $("#home").fadeOut();
    $("#footer").fadeOut();
    $("#album").fadeOut();
    $("#map").fadeOut();
    $("#take-picture").delay(300).fadeIn(800);
    $("#footer").delay(400).fadeIn(800);
}

// affichage de showMap
function showMap(){
    $("#home").fadeOut();
    $("#take-picture").fadeOut();
    $("#map").fadeIn(800);
    $("#album").hide();
    $("#detail").hide();
    $("#footer").hide();
    $("#footer").delay(400).fadeIn(800);

}

// affichage de showAlbum
function showAlbum(){
    $("#home").fadeOut();
    $("#take-picture").fadeOut();
    $("#map").hide();
    $("#album").show();
    $("#detail").hide();
    $("#footer").hide();
    $("#footer").delay(400).fadeIn(800);
}

// affichage de showDetail
function showDetail(){
    $("#take-picture").fadeOut();
    $("#map").hide();
    $("#album").hide();
    $("#detail").fadeIn(800);
    $("#footer").hide();
    $("#footer").delay(400).fadeIn(800);
}


$("#home-btn").on("click", showHome);
$("#take-picture-btn").on("click", showTakePicture);
$("#map-btn").on("click", showMap);
$("#album-btn").on("click", showAlbum);
$("#detail-btn").on("click", showDetail);


// Gestion des fonctions:

// Les faire exectuer uniquement au clic du bouton

// ALBUM - affichage de toutes les photos + titres
$.getJSON('http://localhost/share-clouds/public/picture/',
    function(pictures){
        //console.log(pictures.data[0]);
        //console.log(pictures.data[0]['title']);
        for(var i= 0; i < pictures.data.length; i++)
        {
            $("#images").append('<img src="uploads/images/'+pictures.data[i]['image']+'">');
            $("#images").append(pictures.data[i]['title']);
        }
    }
    );

// DETAIL - affichage d'une photo et son détail
$.getJSON('http://localhost/share-clouds/public/picture/',
    function(detail){
        $("#detail_title").append(detail.data[2]['title']);
        $("#detail_image").append('<img src="uploads/images/'+detail.data[2]['image']+'">');
        $("#detail_geolocalisation").append(detail.data[2]['geolocalisation']);
        $("#detail_comment").append(detail.data[2]['comment']);




    }
);