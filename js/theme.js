// Variables globales modifiées à chaque changement d'orientation
var width;
var height;
var theme;

$(document).on('mobileinit', function() { // Lorsque JQuery Mobile a fini de charger mais que la page n'est pas encore chargée
    
    // Initialisation des variables globales
    width = $(window).width();
    height = $(window).height();
        
    // Lecture du thème dans les cookies et modification de celui-ci
    theme = readCookie('theme');
    var existingThemes = ['a', 'b', 'c', 'd', 'e', 'f'];
    if(existingThemes.indexOf(theme) < 0)
    {
        theme = 'd';
    }
    
    $.mobile.page.prototype.options.theme = theme;
});

$(document).on('pagecreate', function() { // pageinit est obsolète depuis la version 1.4 de JQuery mobile

    // Evenement de changement de thème :
    $('#theme-parameter').on('change', 'input:radio', function(event, ui) {
        var theme = event.target.defaultValue;
        createCookie("theme", theme, 7);
        location.reload();
    });
    
    switch(theme) {
        case 'a':
            $('.circle').css('border-color', '#00a99d');
        break;
        
        case 'b':
            $('.circle').css('border-color', '#652c91');
        break;
        
        case 'c':
            $('.circle').css('border-color', 'black');
        break;
        
        case 'd':
            $('.circle').css('border-color', '#e9e9e9');
        break;
        
        case 'e':
            $('.circle').css('border-color', '#0070bc');
        break;
        
        case 'f':
            $('.circle').css('border-color', '#ed1b24');
        break;
    }
});