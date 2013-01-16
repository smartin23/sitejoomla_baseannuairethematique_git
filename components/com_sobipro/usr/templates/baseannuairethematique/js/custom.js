function changeStackingOrder() {

}

function addBootstrapTags() {

	//Ajout du style btn sur les boutons
	jQuery('input.button').addClass('btn');
	jQuery('button').addClass('btn');
	
	//Carousel : on affiche les boutons de navigation Carousel si il y a des résultats!
	if  (jQuery('#spdecarousel .carousel-inner').children('div').length>1) {
		jQuery('#spdecarousel .carousel-control').show();
	}

}

jQuery(document).ready(function() {

	//Réorganisation de l'ordre des blocs selon la résolution		
	changeStackingOrder();
		
	//Ajout des tags Bootstrap (hors des templates et views modifiables)
	addBootstrapTags();
	
	//Support swipe dans le défilé d'images dans la vue détail 
	jQuery("#spdecarousel").swiperight(function() {  
		jQuery("#spdecarousel").carousel('prev');  
	});  
	jQuery("#spdecarousel").swipeleft(function() {  
		jQuery("#spdecarousel").carousel('next');  
	}); 
	
	//Si le formulaire de direction est affiché, on gélocalise...
	googlemapdirections();
	
});
 
jQuery(window).load(function(){ 
	
});