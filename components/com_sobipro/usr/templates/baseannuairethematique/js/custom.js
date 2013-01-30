function changeDetailsStackingOrder() {

    if (jQuery(window).width() <= 640){

		//Logo
		jQuery('.spField#logo').css('float', 'left').css('width','40%').css('margin-right', '3%').removeClass('block').insertBefore('.spField#resume_activite');
		
		//Tagq
		jQuery('.spField#tags').insertAfter('.SPDE-More');
	
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
	
	//Support swipe dans le défilé d'images dans la vue détail 
	/*jQuery("#spdecarousel").swiperight(function() {  
		jQuery("#spdecarousel").carousel('prev');  
	});  
	jQuery("#spdecarousel").swipeleft(function() {  
		jQuery("#spdecarousel").carousel('next');  
	}); */
	
	//Carousel photos (description)
	jQuery('#spdecarousel').carousel({  
	  interval: 8000 // autoplay à 8s
	})  
	
	//Support Swipe pour le carousel photos
	jQuery('#spdecarousel.carousel').each(function () {
		
		jQuery(this).swiperight(function() {  
			jQuery(this).carousel('prev');			
		}); 
		
		jQuery(this).swipeleft(function() {  
			jQuery(this).carousel('next');  
		}); 
	
	//Si le formulaire de direction est affiché, on gélocalise...
	googlemapdirections();
	
});
 
jQuery(window).load(function(){ 
	
});