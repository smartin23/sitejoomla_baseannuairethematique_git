
function changeDetailsStackingOrder() {

    if (jQuery(window).width() <= 640){

		//Logo
		jQuery('.spField#logo').css('float', 'left').css('width','40%').css('margin-right', '3%').removeClass('block').insertBefore('.spField#resume_activite');
		
		//Resume et gallerie
		jQuery('.SPDE-Resume').insertAfter('.spField#activite_detaillee');
		jQuery('.SPDE-Galery').insertAfter('.spField#activite_detaillee');
		
		//Tag
		jQuery('.spField#tags').insertBefore('.SPDE-Socialshare');
	}
}

function addBootstrapTags() {

	//Ajout du style btn sur les boutons
	//jQuery('input.button').addClass('btn');
	//jQuery('button').addClass('btn');
	
	//Carousel : on affiche les boutons de navigation Carousel si il y a des résultats!
	/*if  (jQuery('#spdecarousel .carousel-inner').children('div').length>1) {
		jQuery('#spdecarousel .carousel-control').show();
	}*/

}

jQuery(document).ready(function() {

	//Réorganisation de l'ordre des blocs selon la résolution		
	changeDetailsStackingOrder();
		
	//Ajout des tags Bootstrap (hors des templates et views modifiables)
	addBootstrapTags();
	
	//Tabs & accordion
	jQuery(".tabbable.responsive").resptabs(); 
	/*jQuery('#tabaccordion').children('li').first().children('span.tabaccordionitem').addClass('active').next().addClass('is-open').show();     
    jQuery('#tabaccordion').on('click', 'li > span.tabaccordionitem', function() {
        
      if (!jQuery(this).hasClass('active')) 
	  {
		if (jQuery(window).width() > 980) jQuery('#tabaccordion .is-open').removeClass('is-open').hide();
		
		//Pour eviter de se retrouver en bas de page...on remonte
		if (jQuery(window).width() <= 980) jQuery('html, body').animate({
            scrollTop: jQuery(this).offset().top
        }, 500);
		
        jQuery(this).next().toggleClass('is-open').toggle();
          
        jQuery('#tabaccordion').find('.active').removeClass('active');
        jQuery(this).addClass('active');	
      } else 
	  {
           if (jQuery(window).width() <= 980) jQuery('#tabaccordion .is-open').removeClass('is-open').hide();
		   jQuery(this).removeClass('active');
      }	  
    });*/
	
			
	//Carousel photos (description)
	jQuery('#spdecarousel').carousel({  
	  interval: 8000 // autoplay à 8s
	});
	
	//Support Swipe pour le carousel photos
	jQuery('#spdecarousel.carousel').each(function () {
		
		jQuery(this).swiperight(function() {  
			jQuery(this).carousel('prev');			
		}); 
		
		jQuery(this).swipeleft(function() {  
			jQuery(this).carousel('next');  
		}); 
		
	});
	
	//Entry social share
	//Share entry
	jQuery('.SPDetails #entryshareme').sharrre({
		share: {
		googlePlus: true,
		facebook: true,
		twitter: true,
		digg: false,
		delicious: false,
		stumbleupon: false,
		linkedin: false,
		pinterest: false
		},
		buttons: {
		googlePlus: {size: 'tall', lang: 'fr-FR'},
		facebook: {layout: 'box_count', lang: 'fr-FR'},
		twitter: {count: 'vertical', lang: 'fr-FR'},
		digg: {type: 'DiggMedium'},
		delicious: {size: 'tall'},
		stumbleupon: {layout: '5'},
		linkedin: {counter: 'top'},
		pinterest: {media: 'http://sharrre.com/img/example1.png', description: jQuery('#entryshareme').data('text'), layout: 'vertical'}
		},
		enableHover: false,
		enableCounter: false,
		enableTracking: true
	});
	
	//Si le formulaire de direction est affiché, on gélocalise...
	googlemapdirections();
	
});