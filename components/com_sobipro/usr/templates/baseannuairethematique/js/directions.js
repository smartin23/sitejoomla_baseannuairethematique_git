function googlemapdirections () {

	//Si le formulaire de directions est affiché par la map....
	if (jQuery('form.mapdirform').length>0) {
		
		//Ajout d'un champ de message (a utilser ?)
		jQuery("input#saddr").after('<div class="small text-info" id="saddr-msg"></div>');
		
		//Afficher le detail de l'itinéraire
		jQuery('form.mapdirform').find('.button').click(function() {

			dirslink = jQuery('.directions-show');
			dirslink.css('visibility', 'visible');
			
			dirslink.click(function() {
				dirs=jQuery('.directions');
				sectiondiv = jQuery(this).parents('section').children('div');
				if (jQuery(this).hasClass('closed')) {
					dirs.show();
					jQuery(this).removeClass('closed');
					jQuery(this).addClass('open');
				}
				else
				{
					//Mise a jour de la hauteur de la section pour affichage de l'itinéraire
					//sectiondiv.height(sectiondiv.height()-dirs.height());
					dirs.hide();
					jQuery(this).removeClass('open');
					jQuery(this).addClass('closed');
					
					//sectiondiv.css('height','auto');
					
				}
				
			});		
		});	
	}
}