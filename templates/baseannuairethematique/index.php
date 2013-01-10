<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

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
	
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/template.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/admin.css" />

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
	  
</head>
<body class="site <?php echo $option . " view-" . $view . " layout-" . $layout . " task-" . str_replace('.','-',$task ). " itemid-" . $itemid . " ";?> <?php if ($this->params->get('fluidContainer')) { echo "fluid"; } ?>">

<div class="sheet container">
			
		<div class="centre row-fluid">
		
				<div class="span4 left pull-left">
					
					<header>
						<div class="header row-fluid">

							<div class="span12">

								<div class="row-fluid">
									<div class="icon">
										<a href="<?php echo $this->baseurl; ?>"><i class="icon-map-marker icon-large"></i></a>
									</div>
									<div class="brand">
										&nbsp;<a href="<?php echo $this->baseurl; ?>"><?php echo $app->getCfg('sitename');?></a>
									</div>
								</div>
								
								<div class="row-fluid">
									<div class="span12">
										<div class="soustitre">sur la carte.eu</div>
									</div>
								</div>
								
							</div>
										
						</div>	
					</header>
				
					<jdoc:include type="modules" name="breadcrumbs" />
					<div class="recherche" style="overflow:hidden; position:relative;">
							<jdoc:include type="modules" name="search" />
					</div>
					<?php if (($task=='search.results') or ($task=='search.view')) {?>
						
						<div class="contenu" style="overflow:hidden; position:relative;">
							<jdoc:include type="component" />
						</div>
					<?php } ?>
					
				
				</div>
				
				<?php if (($task!='search.results') and ($task!='search.view')) {?>
				<div class="span8 middle">

							<div class="contenuplus">
								<jdoc:include type="component" />	
								<jdoc:include type="message" />
							</div>

				</div>
				<?php } ?>
				
				<!-- Pour plus tard : insertion publicité Google
				<div class="span2 right pull-right">
					<div class="googleads">
					</div>
					<div class="publicite">
						<jdoc:include type="modules" name="advertising" style="standard" />
					</div>
				</div>-->
				
		</div>

</div>

<div class="fullmap container-fluid" style="position:fixed;top:0;left:0;width:100%;z-index:0;">
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

	<!--<p class="pull-right"><a href="#">Haut de la page</a></p>-->
	
	<div class="container">
		<!--<div class="colors row-fluid">
			<div class="span6 offset6">
				<div class="color1"></div>
				<div class="color2"></div>
				<div class="color3"></div>
				<div class="color4"></div>
			</div>
		</div>-->
		<div class="row-fluid">
			<div class="span12">
				<div class="row-fluid">		

						<div class="span3 menusecondaire">						
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
										<div id="shareme" data-url="http://sharrre.com/" data-text="Make your sharing widget with Sharrre (jQuery Plugin)" data-title="partagent cette page">&nbsp;</div>
									</div>
								</div>
							</div>
						</div>
						<div class="span3 login">
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

<!--<script src="<php echo $this->baseurl ?>/templates/<php echo $this->template; ?>/bootstrap/js/bootstrap.min.js"></script>-->
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/bootstrap-sources/js/bootstrap-button.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/bootstrap-sources/js/bootstrap-collapse.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/bootstrap-sources/js/bootstrap-dropdown.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/bootstrap-sources/js/bootstrap-transition.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/bootstrap-sources/js/bootstrap-carousel.js"></script>
<script type='text/javascript'>

	jQuery('.carousel').carousel({  
	  interval: 5000 // in milliseconds  
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

<!--<script src="<php echo $this->baseurl ?>/scripts/tabsandaccordion/js/min/index.js"></script>
<script src="<php echo $this->baseurl ?>/scripts/tabsandaccordion/js/min/jquery_ba_resize.js"></script>
<script src="<php echo $this->baseurl ?>/scripts/tabsandaccordion/js/jquery_tabs_accordion.js"></script>
<script type='text/javascript'>
jQuery('.taa-accordion, .taa-tabs').TabsAccordion({
		responsiveSwitch: 'taa-tablist'
	});
</script>-->

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
	jQuery('button').addClass('btn');
	
	//Carousel : on affiche le carousel et les boutons de navigation Carousel si il y a des résultats!
	if  (jQuery('#entriescarousel .carousel-inner').children('div').length>0) {
		jQuery('.spEntriesListContainer').show();
		if  (jQuery('#entriescarousel .carousel-inner').children('div').length>1) {
			jQuery('#entriescarousel .carousel-control').show();
		}
	}
	
	//Reporté dans la vue detail
	/*if  (jQuery('#spdecarousel .carousel-inner').children('div').length>1) {
		jQuery('#spdecarousel .carousel-control').show();
	}*/
	
}

jQuery(window).load(function(){ 

	//Ouverture du bloc Extended Search en page d'accueil
	//if (jQuery(".task-search-view").length >0) jQuery('#SPExtSearch').show();	
		
});

jQuery(document).ready(function() {
	
	//Réorganisation de l'ordre des blocs selon la résolution		
	changeStackingOrder();
	
	//Ajout des tags Bootstrap (hors des templates et views modifiables)
	addBootstrapTags();
	
	//Taille initiale minimale du bloc centre
	jQuery('.centre').css('min-height', jQuery(window).height()-jQuery('footer h3').outerHeight(true));
	
	//Scrollbar custom dans le bolc de recherche étendue
	jQuery('#SPExtSearch').tinyscrollbar();
					
	//Contact Form : ajout des classes Bootstrap hors template (ne pas modifier le coeur de contact form)
	jQuery(".contact-form").find("form").find("label").addClass('control-label').removeClass("hasTip");
	
	//Entry edit form : ajout des classes Bootstrap hors template (ne pas modifier le coeur de sobipro)
	jQuery("#spEntryForm").addClass("form-horizontal");
	jQuery("#spEntryForm").find(".spFormRowFooter button").addClass("btn");
	jQuery("#spEntryForm").find(".spFormRowFooter input").addClass("btn btn-primary");
	//jQuery("form#spEntryForm").find('.controls input').addClass("input-large");
	//jQuery("form#spEntryForm").find('.controls textarea').addClass("input-large");
	
	//Support Swipe pour le carousel Liste des entrées
	jQuery("#entriescarousel").swiperight(function() {  
		jQuery("#entriescarousel").carousel('prev');  
	});  
	jQuery("#entriescarousel").swipeleft(function() {  
		jQuery("#entriescarousel").carousel('next');  
	});  
	
});

jQuery(window).resize(function () {

	changeStackingOrder();
	
});
</script>

</body> 
</html>