$(document).on('pagecreate', function() { // pageinit est obsolète depuis la version 1.4 de JQuery mobile
    
    // Ajout d'un bouton retour et d'un bouton home
    //$('div:jqmData(role="header")').prepend('<a href="index.php" data-ajax="false" class="btn-nav ui-link ui-btn-right ui-btn ui-shadow ui-corner-all"><img src="images/icones/home.png" width="35" height="35" /></a>');
    //$('div:jqmData(role="header")').prepend('<a data-rel="back" class="btn-nav ui-link ui-btn-left ui-btn ui-shadow ui-corner-all"><img src="images/icones/back.png" width="35" height="35" /></a>');

    // Ajout factorisé du contenu du footer
    $('div:jqmData(role="footer")').html('<p align="center"><font size="1">&copy; Copyright (c) 2015 Thomas Neyraut. All rights reserved.</font></p>');
    
    function resizeAll()
    {
        width = $(window).width();
        height = $(window).height();

        // Permet à l'image de ne jamais dépasser la taille de l'écran
        $('section:jqmData(role="page")').on('popupbeforeposition', 'div:jqmData(role="popup")', function() {
            var maxHeight = height - 60 + "px";
            var maxWidth = width - 60 + "px";
            $('div:jqmData(role="popup") img').css('max-height', maxHeight);
            $('div:jqmData(role="popup") img').css('max-width', maxWidth);
        });

        var circleSize = width * 25/100;
        $('.circle').css('width', circleSize+"px");
        $('.circle').css('height', circleSize+"px");
        $('.circle').css('background-size', circleSize+"px "+circleSize+"px");
        $('.circle a').css('font-size', circleSize/7+"px");
   
        $('.circle').css('margin-top', (-1 * circleSize / 3) +"px");
        $('.circle:first-child').css('margin-top', "10px");
        
        $('.circle a').each(function(index, elt) {
            var padding = '';
            
            if($(elt).text().length > 14) {
                padding = '25%';
            } else {
                padding = '45%';
            }
            
            $(elt).css('padding-top', padding);
        });
    }
    
    resizeAll();
    
    // Modification des tailles lorsque l'orientation change
    $(window).on('orientationchange', resizeAll);
    
});