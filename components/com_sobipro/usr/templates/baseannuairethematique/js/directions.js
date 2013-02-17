function geolocalisation(){
	var gc = new google.maps.Geocoder();
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function (po) {
			gc.geocode({"latLng":  new google.maps.LatLng(po.coords.latitude, po.coords.longitude) }, function(results, status) {
				if(status == google.maps.GeocoderStatus.OK) {
					jQuery("input#saddr").val(results[0]["formatted_address"]);
					//jQuery("#saddr-msg").html('Votre position a été localisée');
				} else {
					//jQuery("#saddr-msg").html('Erreur lors de la géolocalisation : '+ status);
				}
			});
		},
		function(error) {},
		{maximumAge:60000, timeout:10000, enableHighAccuracy:false} );
	}
	else{
		//jQuery("#saddr-msg").html('Partage de position non autorisé.');
	}
}

function googlemapdirections () {

	//Si le formulaire de directions est affiché par la map....
	if (jQuery('form.mapdirform').length>0) {
		
		//Ajout d'un champ de message (a utilser ?)
		jQuery("input#saddr").after('<div class="small text-info" id="saddr-msg"></div>');
		
		//Localisation de l'utilisateur
		geolocalisation();
	
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