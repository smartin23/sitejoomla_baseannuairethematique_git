<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Get the user
$user =& JFactory::getUser();

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
 <head>
 
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/min/g=generalcss" />

	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/fontawesome/css/font-awesome.min.css" type="text/css" media="screen" />
	<!--[if IE 7]><link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/fontawesome/css/font-awesome-ie7.min.css" rel="stylesheet" /><![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Dosis:400,800' rel='stylesheet' type='text/css'>
		
	<!-- Le touch icons -->
	<link rel="apple-touch-icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/icons/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/icons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/icons/apple-touch-icon-114x114.png">
	
	<script src="<?php echo $this->baseurl ?>/min/g=jqueryjs"></script>	  
	<script type='text/javascript'>
		jQuery.noConflict();
	</script>
	
    <jdoc:include type="head" />
	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body class="site <?php echo $option . " view-" . $view . " layout-" . $layout . " task-" . str_replace('.','-',$task ). " itemid-" . $itemid . " ";?> <?php if ($this->params->get('fluidContainer')) { echo "fluid"; } ?>">

<div class="sheet container">
			
		<div class="centre row-fluid">
		
				<?php if (($task=='search.results') or ($task=='search.view')) {?>
				<div class="span4 zone-gauche on">
					<div id="onoff"><i class="icon-eye-close icon-large"></i></div>
					<header>					
						<div class="header on">												
							<jdoc:include type="modules" name="logo" />						
						</div>	
					</header>
					
					<div class="clear"></div>															
					<div class="contenu on">
						<jdoc:include type="component" />
					</div>
								
				</div>
				<?php } ?>
				
				<?php if (($task!='search.results') and ($task!='search.view')) {?>
				<div class="span10 offset1 zone-centre">

					<div class="contenuplus">
					<?php $backurl= $_SERVER['HTTP_REFERER'];
					//On fait un retour historique -1 si on vient de la page d'accueil ou d'une recherche
					if ((strcmp($backurl,juri::base())!=0) && (strpos($backurl,'search')===false)){?>
							<div class="retour"><a href="index.php"><i class="icon-remove-sign icon-large"></i></a></div>
					<?php } else {?>
							<div class="retour"><a href="javascript:history.go(-1)"><i class="icon-remove-sign icon-large"></i></a></div>
					<?php } ?>
						
						<div class="span6 header">
							<jdoc:include type="modules" name="logo" />			
						</div>
						<div class="clear"></div>
					
						<jdoc:include type="message" />
						<jdoc:include type="component" />	
						
					</div>
				</div>
				<?php } ?>							
		</div>
</div>

<div class="fullmap container">
	<div class="row-fluid">
		<div class="span12">
			<div class="mapgrip">
				<?php if ($task=='search.results') {?>
				<jdoc:include type="modules" name="map2" style="standard" />
				<?php } else { ?>
				<jdoc:include type="modules" name="map1" style="standard" />
				<?php } ?>				
			</div>		
		</div>
	</div>
</div>

<footer>
	<div class="container">	
		<div class="row-fluid">
			<div class="span12">
				<div class="row-fluid">		

						<div class="span3 menusecondaire <?php if ($user->id!=0) echo 'registered user_'.$user->id;?>">						
							<jdoc:include type="modules" name="footer1" style="standardlite" />
						</div>
						
						<div class="span5 theme">
							<div class="social">
								<div class="row-fluid">
									<jdoc:include type="modules" name="footer2" style="standardlite" />	
								</div>
								<div class="row-fluid">
									<div id="sociallinks" class="pull-left">
										<i class="icon-facebook-sign icon-large">&nbsp;</i><i class="icon-twitter-sign icon-large">&nbsp;</i><i class="icon-google-plus-sign icon-large">&nbsp;</i>
									</div>
									<div id="socialshare" class="pull-right">
										<div id="shareme" data-url="http://www.lagrangeweb.fr" data-text="Partagez Tous les apicluteurs sur vos réseaux sociaux" data-title="partagent cette page">&nbsp;</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="span4 misc">
							<jdoc:include type="modules" name="footer3" style="standardlite" />	
						</div>	
				</div>						
			</div>	
		</div>
		<div class="row-fluid">
			<div class="span12 links">
				<jdoc:include type="modules" name="seo"/>	
			</div>
		</div>
	</div>
</footer>

<!--<script src="?php echo $this->baseurl ?>/scripts/jquery.defer.js"></script>
<script type='text/javascript'>
jQuery.deferSettings.delayDomReady = true;
jQuery.defer( "/scripts/jquery.tinyscrollbar.min.js" )
    .done( function () {
		jQuery('#SPExtSearch').tinyscrollbar();
	});
</script>-->

<script src="<?php echo $this->baseurl ?>/min/g=generaltoolsjs"></script>

<!--Accordion collapse-->
<!---Patch pour eviter l'ajout d'un display:none sur le collapse apres fermeture (hide);
cf. http://stackoverflow.com/questions/12715254/twitter-bootstrap-transition-conflict-prototypejs-->
<script type='text/javascript'>
	jQuery.noConflict();
    jQuery.fn.collapse.Constructor.prototype.transition = function (method, startEvent, completeEvent) {
      var that = this
        , complete = function () {
            if (startEvent.type == 'show') that.reset();
            that.transitioning = 0;
            that.$element.trigger(completeEvent);
          }

      //this.$element.trigger(startEvent);
      //if (startEvent.isDefaultPrevented()) return;
      this.transitioning = 1;
      this.$element[method]('in');
      (jQuery.support.transition && this.$element.hasClass('collapse')) ?
    this.$element.one(jQuery.support.transition.end, complete) :
        complete();
    };
</script>

<!--Carousel-->
<script type='text/javascript'>
	jQuery.noConflict();
	if (jQuery('.carousel')) {
		//Desactivation du conflit avec Mootools (encore utilisé par SobiPro!)
		window.addEvent('domready', function(){
			if (typeof jQuery != 'undefined' && typeof MooTools != 'undefined' ) {

			Element.implement({
			slide: function(how, mode){
			return this;
			}
			});
			}
		});
	}
</script>

<script type='text/javascript'>
function SPCSendMessage( form )
{
	jQuery.noConflict();
	jQuery.ajax( {
		url:SobiProUrl.replace( '%task%', 'contact.send' ),
		data:form.serialize(),
		type:'POST',
		dataType:'json',
		success:function ( data ) {

			if ( data.status == 'error' ) {
				if ( data.require ) {
					/*jQuery('#system-message-container').html('<dl id="system-message"><dt class="warning">Avertissement</dt><dd><ul><li>Veuillez saisir tous les champs requis</li></ul></dd></dl>');*/
					jQuery( '[name="' + data.require + '"]' ).addClass('invalid');
				}
			}
			else {
				form.find( 'input:text, input:password, input:file, select, textarea' ).val( '' );
				form.find( 'input:radio, input:checkbox' ).removeAttr( 'checked' ).removeAttr( 'selected' );
				try { jQuery( form.spDialogId ).dialog( 'close' ); } catch ( x ) {}
			}
		}
	} );
}
</script>

<script type="text/javascript">
jQuery.noConflict();
jQuery.extend({
  getUrlVars: function(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  },
  getUrlVar: function(name){
    return jQuery.getUrlVars()[name];
  }
});
//var val = jQuery.getUrlVar('name');

function changeStackingOrder() {

	 if (jQuery(window).width() < 768){

		jQuery('footer .misc').insertBefore('footer .theme');	
	}
}

function addBootstrapTags() {
	//Ajout du style btn sur les boutons
	jQuery('input.button').addClass('btn');
	jQuery("input[type='submit']").addClass('btn');
	jQuery('button').addClass('btn');
}

function adaptOnResize() {

	var usedHeight = window.innerHeight ? window.innerHeight : jQuery(window).height();
	
	//La partie centrale s'affiche sur la hauteur totale - la hauteur des titres du footer.
	jQuery('.centre').css('min-height', usedHeight-jQuery('footer h3').outerHeight(true)); 
	
	//Les cartes doivent s'afficher sur la hauteur disponible
	jQuery('#JmapsHome').height(usedHeight);
	jQuery('#JmapsSearch').height(usedHeight);	
}

jQuery.fn.scrollView = function () {
    return this.each(function () {
        jQuery('html, body').animate({
            scrollTop: jQuery(this).offset().top
        }, 1000);
    });
}

jQuery(document).ready(function() {

	//Réorganisation de l'ordre des blocs selon la résolution		
	changeStackingOrder();
	
	//Ajout des tags Bootstrap (hors des templates et views modifiables)
	addBootstrapTags();

	//Hauteur initiale minimale utilisée
	adaptOnResize();
	
	//Association des classes de reception des evenements customs
	jQuery('#JmapsHome').addClass('userposregistered').addClass('recentermapregistered');
	jQuery('#JmapsSearch').addClass('userposregistered').addClass('recentermapregistered');
	
	//Remontée du footer 
	var footer = jQuery('footer');
	footer.find('h3').addClass('down').click(function() {
		if (jQuery(this).hasClass('up')) {
			
			jQuery(this).removeClass('up');
			jQuery(this).addClass('down');
			
			jQuery('.centre').scrollView();
		}
		else
		{
			jQuery(this).removeClass('down');
			jQuery(this).addClass('up');
			
			footer.scrollView();
		}		
	});
	
	//On/off
	var contenu = jQuery('.contenu');
	var header = jQuery('.header');
	var zonegauche = jQuery('.zone-gauche');
	jQuery("#onoff").click(function() {
		if (contenu.hasClass('on')) {
			jQuery(this).html('<i class="icon-eye-open icon-large"></i>');
			contenu.removeClass('on');
			contenu.addClass('off');
			
			//On cache/montre aussi le header
			header.removeClass('on');
			header.addClass('off');
			zonegauche.removeClass('on');
			zonegauche.addClass('off');
		}
		else
		{
			jQuery(this).html('<i class="icon-eye-close icon-large"></i>');
			contenu.removeClass('off');
			contenu.addClass('on');
			
			//On cache/montre aussi le header
			header.removeClass('off');
			header.addClass('on');
			zonegauche.removeClass('off');
			zonegauche.addClass('on');
		}
	});
							
	//Entry edit form 
	//Ajout des classes Bootstrap hors template (ne pas modifier le coeur de sobipro)
	jQuery("#spEntryForm").addClass("form-horizontal");
	jQuery("#spEntryForm").find(".required").parent().parent().children("label").after("*");
	//Hack pour required manquant..
	jQuery("#spEntryForm").find("#field_activite_detailleeContainer").find(".control-group").children("label").after("*");
		
	//Activation des tooltips Bootstrap sur les labels du fomulaire d'édition des entrées
	//jQuery('.hasBootstrapTip').tooltip();
	//Ou affichage sous le champs de saisie
	var ctrlgrp=jQuery('.SPEntryEdit').find('.control-group').each(function () {
		title=jQuery(this).find('span').attr('title');
		if (title && title!='Article') jQuery(this).find(".controls").after('<div class="hasCustomLegend">'+title+'</div>');
	});		
});

jQuery(window).load(function(){ 

	//Scrollbar custom dans le bloc de recherche étendue 
	jQuery('#SPExOptBt').click(function() {
		jQuery('#SPExtSearch').tinyscrollbar();
	});
		
	//Et en attendantmieux (ordre d'appels de app ?) : on cache le champs Publication pendant un an en le cochant (js)
	var dpub = jQuery('#field_duree_de_publication'); 
	dpub.parent().parent().hide();
	dpub.attr('checked', true);
	
	//Attention : fonctionne pour le moment avec un seul carousel / page !	
	//Losque le premier item active est detecté, on affiche le carousel
	/*var itemslist = jQuery('#entriescarousel.carousel');
	var timerActiveItem;
	if (itemslist.length>0) {
			var nbitems = itemslist.find('.item').length;		
			if  (nbitems>=1) {
				itemslist.show();
				timerActiveItem=setInterval(showActiveItem,100);
			}
	}
	
	function showActiveItem(){
		if (itemslist.find('.active').length>0) {		
			itemslist.parent().addClass('skin');
			
			if (itemslist.find('.item').length>1) {
				itemslist.carousel('pause');
				itemslist.find('.carousel-control').show();
				clearInterval(timerActiveItem);
			}
		}
	}*/
		
	
	//Gestion du recentrage de la carte Search selon l'item affiché ( methode 1 : sur clic sur titre et marker)
	jQuery("img.jmapsInfoMarker").each(function () {		
		jQuery(this).click(function() {
			jQuery('#JmapsSearch').trigger('recentermap', [jQuery(this).attr("data-lat"), jQuery(this).attr("data-lon")]);
		});
	});
	/*jQuery(".spEntriesListContainer .spField#titre").each(function () {		
		jQuery(this).click(function() {
			jQuery('#JmapsSearch').trigger('recentermap', [jQuery(this).siblings("img.jmapsInfoMarker").attr("data-lat"), jQuery(this).siblings("img.jmapsInfoMarker").attr("data-lon")]);
		});
	});*/
		
	//methode 2:
	jQuery('#entriesaccordion .accordion-body').on('shown', function () {
		var activemarker = jQuery(this).siblings('.accordion-heading').find('img.jmapsInfoMarker');
		jQuery('#JmapsSearch').trigger('recentermap', [activemarker.attr("data-lat"), activemarker.attr("data-lon")]);
    })
	
	/*jQuery('.spEntriesListContainer').find('.carousel-control').each(function () {
		jQuery(this).click(function() {
			setTimeout(centerActiveMarker,1000);
		});
	});
	function centerActiveMarker(){
		var activemarker = jQuery('.spEntriesListContainer').find('.item.active').find('img.jmapsInfoMarker');
		jQuery('#JmapsSearch').trigger('recentermap', [activemarker.attr("data-lat"), activemarker.attr("data-lon")]);
	}*/
	
	//On remplit le champs code postal du formulaire d'iscription à la newsletter a partir de l'event venu de mjradius
	jQuery(".module.newsletter").on('userposzip', function (event, param1, param2) {
		jQuery(this).find('td.acyfield_name input').val(param1);
    })
	//Si pas d'event, on fait la demande à mjradius
	//Beurk: bout de code pris a manGeocode de mjradius....
	var centerselector = jQuery("#mj_rs_center_selector");
	if (centerselector.length>0) {
		var entry = jQuery("#mj_rs_center_selector").val();
		if (entry.length>0){
			geocoder = new google.maps.Geocoder();
			geocoder.geocode( { address:entry}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
				
					var elt = results[0]["address_components"];
					
					for(i in elt){					
						if(elt[i].types[0] == "postal_code") {
							jQuery('td.acyfield_name input').val(elt[i].long_name);
							break;
						}
					}				
				}
			});
		}
	}
		
	//General share plugin
	jQuery('#shareme').sharrre({
	share: {
	googlePlus: true,
	facebook: true,
	twitter: true
	},
	enableTracking: true,
	buttons: {
	googlePlus: {size: 'tall', lang: 'fr-FR'},
	facebook: {layout: 'box_count', lang: 'fr-FR'},
	twitter: {count: 'vertical', lang: 'fr-FR'}
	},
	hover: function(api, options){
	jQuery(api.element).find('.buttons').show();
	},
	hide: function(api, options){
	jQuery(api.element).find('.buttons').hide();
	}
	});
	
	adaptOnResize();

});

//Listen for resize 
jQuery(window).resize(function () {

	adaptOnResize();

	changeStackingOrder();
});

// Listen for orientation changes
window.addEventListener("orientationchange", function() {

  adaptOnResize();
  
  changeStackingOrder();
  
}, false);

//Defer js loading!
// Add a script element as a child of the body
/*function downloadJSAtOnload() {
var element_tinyscrollbar = document.createElement("script");
element_tinyscrollbar.src = "/scripts/jquery.tinyscrollbar.min.js";
document.body.appendChild(element_tinyscrollbar);*/

/*var element_sharrre = document.createElement("script");
element_sharrre.src = "/scripts/sharrre/jquery.sharrre.min.js";
document.body.appendChild(element_sharrre);*/
/*}*/

// Check for browser support of event handling capability
/*if (window.addEventListener)
	window.addEventListener("load", downloadJSAtOnload, false);
else if (window.attachEvent)
	window.attachEvent("onload", downloadJSAtOnload);
else 
	window.onload = downloadJSAtOnload;*/

//Gestion du pb d'obtention de la bonne hauteur du navigateur, lorsque la bar url est affichée. On l'enleve donc.
//Source : http://mobile.tutsplus.com/tutorials/mobile-web-apps/remove-address-bar/
function hideAddressBar()
{
    if(!window.location.hash)
    {
        if(document.height <= window.outerHeight + 10)
        {
            document.body.style.height = (window.outerHeight + 50) +'px';
            setTimeout( function(){ window.scrollTo(0, 1); }, 50 );
        }
        else
        {
            setTimeout( function(){ window.scrollTo(0, 1); }, 0 );
        }
    }
}
window.addEventListener("load", hideAddressBar );
window.addEventListener("orientationchange", hideAddressBar );
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38008134-1']);
  _gaq.push(['_setDomainName', 'ma-carte-locale.eu']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body> 
</html>