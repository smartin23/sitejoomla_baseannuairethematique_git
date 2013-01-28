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

    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/bootstrap-sources/less/bootstrap.css" type="text/css" media="screen" />
	
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/fontawesome/css/font-awesome.css" type="text/css" media="screen" />

	<link href='http://fonts.googleapis.com/css?family=Dosis:400,800' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/system.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/general.css" type="text/css" />
  	
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/template.css" />

	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/print.css" />
	
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/scripts/tabsandaccordion/css/tabs+accordion/tabs+accordion.css" />
	
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/scripts/jquery.mobile.custom.min.css" />
		
	<!-- Le touch icons -->
	<link rel="apple-touch-icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/icons/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/icons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/icons/apple-touch-icon-114x114.png">

	<jdoc:include type="head" />
	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<script src="<?php echo $this->baseurl ?>/scripts/modernizr-min.js"></script>
	<script src="<?php echo $this->baseurl ?>/scripts/jquery.easing.1.3.js"></script>
	<script src="<?php echo $this->baseurl ?>/scripts/jquery.mobile.custom.min.js"></script>
	
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
	  
</head>
<body class="site <?php echo $option . " view-" . $view . " layout-" . $layout . " task-" . str_replace('.','-',$task ). " itemid-" . $itemid . " ";?> <?php if ($this->params->get('fluidContainer')) { echo "fluid"; } ?>">

<div class="sheet container">
			
		<div class="centre row-fluid">
		
				<?php if (($task=='search.results') or ($task=='search.view')) {?>
				<div class="span4 zone-gauche">
					<div id="onoff"><i class="icon-eye-close icon-large"></i></div>
					<header>
						
						<div class="header">					
								
							<div class="logo">
								<a href="<?php echo $this->baseurl; ?>">
								<div class="icon"><i class="icon-map-marker"></i></div>
								<div class="titresite">
									<h1><div class="titresite1"><span class="brand">TOUS LES</span></div>
									<div class="titresite2"><span class="brand">APICULTEURS</span></div>
									</h1>
									
								</div>
								</a>
								<h2><div class="soustitre">je trouve ce que je cherche sur ma-carte-locale.eu</div>
									<div class="soustitre-small">sur ma-carte-locale.eu</div>
									<div class="accroche">en France, en Suisse, en Belgique et au Luxembourg</div>
								</h2>
																
							</div>
										
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
					if ((strcmp($backurl,juri::base())!=0) && (strpos($backurl,'rechercher')===false)){?>
							<div class="retour"><a href="index.php"><i class="icon-remove-sign icon-large"></i></a></div>
					<?php } else {?>
							<div class="retour"><a href="javascript:history.go(-1)"><i class="icon-remove-sign icon-large"></i></a></div>
					<?php } ?>
						
						<div class="span6 header">
							<div class="logo">
								<div class="icon"><i class="icon-map-marker"></i></div>
								<div class="titresite">
									<h1><div class="titresite1"><span class="brand">TOUS LES</span></div>
									<div class="titresite2"><span class="brand">APICULTEURS</span></div></h1>
								</div>
								<h2><div class="soustitre">je trouve ce que je cherche sur ma-carte-locale.eu</div>
									<div class="accroche">en France, en Suisse, en Belgique et au Luxembourg</div>
								</h2>
								
							</div>
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
						
						<div class="span6 theme">
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
						<div class="span3 links">
							<jdoc:include type="modules" name="footer3" style="standardlite" />	
						</div>	

				</div>
							
			</div>	
		</div>
	</div>
</footer>

<script src="<?php echo $this->baseurl ?>/scripts/sharrre/jquery.sharrre.min.js"></script>
<script type='text/javascript'>
jQuery('#shareme').sharrre({
share: {
googlePlus: true,
facebook: true,
twitter: true
},
enableTracking: true,
buttons: {
googlePlus: {size: 'tall'},
facebook: {layout: 'box_count'},
twitter: {count: 'vertical'}
},
hover: function(api, options){
jQuery(api.element).find('.buttons').show();
},
hide: function(api, options){
jQuery(api.element).find('.buttons').hide();
}
});
</script>

<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/bootstrap-sources/js/bootstrap-button.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/bootstrap-sources/js/bootstrap-collapse.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/bootstrap-sources/js/bootstrap-dropdown.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/bootstrap-sources/js/bootstrap-transition.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/bootstrap-sources/js/bootstrap-carousel.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/bootstrap-sources/js/bootstrap-tooltip.js"></script>
<script type='text/javascript'>

	jQuery('.carousel').carousel({  
	  interval: 8000 // in milliseconds  
	})  

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

<!---Patch pour eviter l'ajout d'un display:none sur le collapse apres fermeture (hide);
cf. http://stackoverflow.com/questions/12715254/twitter-bootstrap-transition-conflict-prototypejs-->
<script type='text/javascript'>
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
    
    //jQuery.noConflict();
</script>

<script src="<?php echo $this->baseurl ?>/scripts/tabsandaccordion/js/min/index.js"></script>
<script src="<?php echo $this->baseurl ?>/scripts/tabsandaccordion/js/min/jquery-ba-resize.js"></script>
<script src="<?php echo $this->baseurl ?>/scripts/tabsandaccordion/js/jquery-tabs-accordion.js"></script>
<script type='text/javascript'>
jQuery('.taa-accordion, .taa-tabs').TabsAccordion({
		responsiveSwitch: 'taa-tablist'
	});
</script>

<script type='text/javascript'>
function SPCSendMessage( form )
{
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

<script src="<?php echo $this->baseurl ?>/scripts/jquery.tinyscrollbar.min.js"></script>

<script type="text/javascript">

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

	/*if (jQuery(window).width() <= 600){
	
		//On etend le bloc social à la disparition du bloc login
		jQuery('.footer').find('.social').removeClass('span5').addClass('span9');
	}
	else
	{
		jQuery('.footer').find('.social').removeClass('span9').addClass('span5');
	}*/
}

function addBootstrapTags() {

	//Ajout du style btn sur les boutons
	jQuery('input.button').addClass('btn');
	jQuery("input[type='submit']").addClass('btn');
	jQuery('button').addClass('btn');
	
	//Carousel : En général, on affiche le carousel et les boutons de navigation Carousel si il y a des résultats!
	jQuery('.carousel-inner').each(function () {
		var nbitems = jQuery(this).children('.item').length;		
		if  (nbitems>1) {
			jQuery(this).parent().find('.carousel-control').show();
		}		
	});
	
}

function adaptOnResize() {

	//var usedHeight =  jQuery(window).height();
	var usedHeight = window.innerHeight ? window.innerHeight : jQuery(window).height();
	
	jQuery('.centre').css('min-height', usedHeight-jQuery('footer h3').outerHeight(true)); 
	//jQuery(window).height()-jQuery('footer h3').outerHeight(true));
	
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

jQuery(window).load(function(){ 

	//Ouverture du bloc Extended Search en page d'accueil
	//if (jQuery(".task-search-view").length >0) jQuery('#SPExtSearch').show();	
	
	//Affichage du contenu en Colorbox
	/*jQuery(".sitemap").find('a').each(function( index ) {
		cbref=jQuery(this).attr('href')+'&tmpl=component';
		//jQuery(this).addClass('iframe').attr('href', cbref).colorbox({iframe:true, maxWidth:"900px", width:"100%", height:"80%", opacity:0.4});	
		jQuery(this).attr('href', cbref).colorbox({href:cbref});
	});

	//Idem formulaires de login
	jQuery(".lock #login-form").find('a').each(function( index ) {
		cbref=jQuery(this).attr('href')+'&tmpl=component';
		jQuery(this).addClass('iframe').attr('href', cbref).colorbox({iframe:true, maxWidth:"900px", width:"100%", height:"80%", opacity:0.4});	
	});
	*/
	
	//Hauteur initiale minimale utilse
	adaptOnResize();
	
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
	
	//On montre les Résultat de recherche si il y en a
	var entrieslist = jQuery('.spEntriesListContainer');
	if  (entrieslist.find('.carousel-inner').children('.item').length>0) {
			entrieslist.show();
	}
	
});

jQuery(document).ready(function() {

	//Réorganisation de l'ordre des blocs selon la résolution		
	changeStackingOrder();
	
	//Ajout des tags Bootstrap (hors des templates et views modifiables)
	addBootstrapTags();
		
	//Scrollbar custom dans le bloc de recherche étendue : beurk, on l'affiche pour génére la barre correctement sous Safari puis on la masque....
	jQuery('#SPExtSearch').show();
	jQuery('#SPExtSearch').tinyscrollbar();
	jQuery('#SPExtSearch').hide();
	
	
	
	//Gestion du recentrage de la carte Search selon l'item affiché (version1 : sur clic sur marker)
	jQuery("img.jmapsInfoMarker").each(function () {		
		jQuery(this).click(function() {
			jQuery('#JmapsSearch').trigger('recentermap', [jQuery(this).attr("data-lat"), jQuery(this).attr("data-lon")]);
		});
	});
		
	//version2:
	jQuery('.spEntriesListContainer').find('.carousel-control').each(function () {
		jQuery(this).click(function() {
			setTimeout(centerActiveMarker,1000);
		});
	});
	function centerActiveMarker(){
		var activemarker = jQuery('.spEntriesListContainer').find('.item.active').find('img.jmapsInfoMarker');
		jQuery('#JmapsSearch').trigger('recentermap', [activemarker.attr("data-lat"), activemarker.attr("data-lon")]);
	}
	
	//On/off
	var contenu = jQuery('.contenu');
	jQuery("#onoff").click(function() {
	
		if (contenu.hasClass('on')) {
			jQuery(this).html('<i class="icon-eye-open icon-large"></i>');
			contenu.removeClass('on');
			contenu.addClass('off');
		}
		else
		{
			jQuery(this).html('<i class="icon-eye-close icon-large"></i>');
			contenu.removeClass('off');
			contenu.addClass('on');
		}
	});
						
	//Contact Form : ajout des classes Bootstrap hors template (ne pas modifier le coeur de contact form)
	//jQuery(".contact-form").find("form").find("label").addClass('control-label').removeClass("hasTip");
	
	//Entry edit form : ajout des classes Bootstrap hors template (ne pas modifier le coeur de sobipro)
	jQuery("#spEntryForm").addClass("form-horizontal");
	//jQuery("#spEntryForm").find(".spFormRowFooter input").addClass("btn");//donc pas la peine de le mettre en primary...
	jQuery("#spEntryForm").find(".required").parent().parent().children("label").after("*");
	//Hack pour required manquant..
	jQuery("#spEntryForm").find("#field_activite_detailleeContainer").find(".control-group").children("label").after("*");
	
	//jQuery("form#spEntryForm").find('.controls input').addClass("input-large");
	//jQuery("form#spEntryForm").find('.controls textarea').addClass("input-large");
	
	//Activation des tooltips Bootstrap sur les labels du fomullaire d'édition des entrées
	//jQuery('.hasBootstrapTip').tooltip();
	
	//Ou affichage sous le champs de saisie
	var ctrlgrp=jQuery('.SPEntryEdit').find('.control-group').each(function () {
		title=jQuery(this).find('span').attr('title');
		if (title && title!='Article') jQuery(this).find(".controls").after('<div class="hasCustomLegend">'+title+'</div>');
	});

		
	//Support Swipe pour le carousel
	jQuery('.carousel-inner').each(function () {
		jQuery(".carousel").swiperight(function() {  
			jQuery(".carousel").carousel('prev');  
		});  
		jQuery(".carousel").swipeleft(function() {  
			jQuery(".carousel").carousel('next');  
		});  
	});
	
	
	
});

jQuery(window).resize(function () {

	adaptOnResize();

	changeStackingOrder();
	
});


// Listen for orientation changes
window.addEventListener("orientationchange", function() {

  adaptOnResize();
  
}, false);


</script>



</body> 
</html>