// création du copyright
var date = new Date();
var year = date.getFullYear();
$('#footer3').append('&copy;' + year);

// affichage de Home au démarrage
window.onload=showHome;

// affichage du Home
function showHome(){
    $("#home1").hide();
    $("#home2").hide();
    $("#take-picture").hide();
    $("#map").hide();
    $("#album").hide();
    $("#detail").hide();
    $("#footer1").hide();
    $("#footer2").hide();
    $("#footer3").hide();

    $("#titre").delay(200).fadeIn(800);
    $("#home1").delay(500).hide().fadeIn(800);
    $("#home2").delay(1000).css("display", "flex").hide().fadeIn(800);
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
    $("#album").fadeIn(800);
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


$("#home-btn").on("click", showHome)
$("#take-picture-btn").on("click", showTakePicture)
$("#map-btn").on("click", showMap)
$("#album-btn").on("click", showAlbum)
$("#detail-btn").on("click", showDetail)