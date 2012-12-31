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
	
	<script src="<?php echo $this->baseurl ?>/scripts/tabsandaccordion/js/min/modernizr.js"></script>
	<script src="<?php echo $this->baseurl ?>/scripts/jquery.easing.1.3.js"></script>
	<script src="<?php echo $this->baseurl ?>/scripts/jquery.mobile.custom.min.js"></script>
	  
</head>
<body class="site <?php echo $option . " view-" . $view . " layout-" . $layout . " task-" . str_replace('.','-',$task ). " itemid-" . $itemid . " ";?> <?php if ($this->params->get('fluidContainer')) { echo "fluid"; } ?>">

<div class="topborder"></div>

<div class="sheet container">
		<header>
			
			<div class="introduction row-fluid">
									
					<div class="introduction-titre span12">
	
								<div class="page-header">
									<h1><a class="brand" href="<?php echo $this->baseurl; ?>"><?php echo $app->getCfg('sitename');?></a></h1>
									<h2>Fusce ut nibh turpis, quis imperdiet elit</h2>
								</div>
					
					</div>
					
					
			</div>	
		</header>
				
		<div class="centre row-fluid">
	
				<?php if (($task!='search.results') and ($task!='search.view')) {?>
				<div class="span6 offset3 pull-left">	
				<?php } else {?>
				<div class="span4 pull-left">
				<?php }?>
				
					<jdoc:include type="modules" name="breadcrumbs" />				
					<div class="contenu" style="overflow:hidden; position:relative;"><jdoc:include type="component" /></div>
				
					<div class="sidebar1">
						<jdoc:include type="modules" name="left" style="standard" />
					</div>
								
					<jdoc:include type="message" />
				
				</div>
							
				<?php if (($task=='search.results') or ($task=='search.view')) {?>
					<div class="span8 middle">
									
						
							<div class="mapgrip">
								<jdoc:include type="modules" name="map" style="standard" />
							</div>
						
						
						<jdoc:include type="modules" name="bottom1" style="standard" />
						
						<div class="liens row-fluid">

								<?php $counter=0; 
								if ( $this->countModules( 'bottom2-left' )) $counter++;
								if ( $this->countModules( 'bottom2-right' )) $counter++;
								if ($counter>0) {
								?>

									<?php if ( $this->countModules( 'bottom2-left' )) { ?>
									<div class="liensblock span<?php echo 12/$counter;?>"><jdoc:include type="modules" name="bottom2-left"  /></div>
									<?php } ?>
									
									<?php if ( $this->countModules( 'bottom2-right' )) { ?>
									<div class="liensblock span<?php echo 12/$counter;?>"><jdoc:include type="modules" name="bottom2-right"  /></div>
									<?php } ?>
									
								<?php } ?>

						</div>
					
						
					</div>
				<?php } ?>
				
		</div>

</div>

<footer>

	<!--<p class="pull-right"><a href="#">Haut de la page</a></p>-->
	
	<div class="footer container">
		<div class="colors row-fluid">
			<div class="span6 offset6">
				<div class="color1"></div>
				<div class="color2"></div>
				<div class="color3"></div>
				<div class="color4"></div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="basdepage row-fluid">		

						<div class="span4 menusecondaire">						
							<jdoc:include type="modules" name="footer1" style="standardlite" />	
						</div>
						<div class="span4 login">
							<jdoc:include type="modules" name="footer2" style="standardlite" />	
						</div>
						<div class="span4 social">
							<jdoc:include type="modules" name="footer3" style="standardlite" />	
						</div>	

				</div>
				
				<div class="copyright row-fluid">		
					<div class="span12">
						<jdoc:include type="modules" name="copyright" style="none" />	
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

<script src="<?php echo $this->baseurl ?>/scripts/tabsandaccordion/js/min/index.js"></script>
<script src="<?php echo $this->baseurl ?>/scripts/tabsandaccordion/js/min/jquery.ba-resize.js"></script>
<script src="<?php echo $this->baseurl ?>/scripts/tabsandaccordion/js/jquery.tabs+accordion.js"></script>
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

<script type="text/javascript">
function changeStackingOrder() {

	//on déplace les categories et les news (les cartes ne peuvent pas etre déplacées)
	if (jQuery(window).width() <= 600){
	
		//On déplace le breadcrumb
		jQuery(".breadcrumb").insertAfter(jQuery(".introduction"));
	
		if (jQuery(".SPListing").length>0) {
			jQuery(".categories").insertAfter(jQuery(".SPListing"));
		}
		else if (jQuery(".SPSearch").length>0) {
			jQuery(".categories").insertAfter(jQuery(".SPSearch"));
		}
		else {
			jQuery(".categories").insertAfter(jQuery(".contenu"));
		}
		
		jQuery(".calendar").insertBefore(jQuery(".news"));
		
		//Sidebar1 n'est plus utilisé
		jQuery('.sidebar1').hide();
	}
	else 
	{
		//Sidebar1 est utilisé
		jQuery('.sidebar1').show();
		
		jQuery(".breadcrumb").insertBefore(jQuery("#system-message-container"));
		
		if (jQuery('.categories').length>0) {
			if (jQuery('.mod-88').length>0) jQuery(".categories").insertAfter(jQuery(".mod-88"));
			else if (jQuery('.mod-98').length>0) jQuery(".categories").insertAfter(jQuery(".mod-98"));
			else if (jQuery('.sidebar1').length>0) jQuery(".sidebar1").prepend(jQuery(".categories"));
		}
		
		jQuery(".calendar").insertBefore(jQuery(".promotion1"));
	}
}

function addBootstrapTags() {

	//Ajout du style btn sur les boutons
	jQuery('input.button').addClass('btn');
	jQuery('button').addClass('btn');
	
	//Carousel : on affiche les boutons de navigation Carousel si il y a des résultats!
	if  (jQuery('#entriescarousel .carousel-inner').children('div').length>1) {
		jQuery('#entriescarousel .carousel-control').show();
	}
	
	if  (jQuery('#spdecarousel .carousel-inner').children('div').length>1) {
		jQuery('#spdecarousel .carousel-control').show();
	}
	
}

jQuery(window).load(function(){ 
	
		//Réorganisation de l'ordre des blocs selon la résolution		
		changeStackingOrder();
		
		//Ajout des tags Bootstrap (hors des templates et views modifiables)
		addBootstrapTags();
	
						
		//Contact Form : ajout des classes Bootstrap hors template (ne pas modifier le coeur de contact form)
		jQuery(".contact-form").find("form").find("label").addClass('control-label').removeClass("hasTip");
		
		//Entry edit form : ajout des classes Bootstrap hors template (ne pas modifier le coeur de sobipro)
		jQuery("#spEntryForm").addClass("form-horizontal");
		jQuery("#spEntryForm").find(".spFormRowFooter button").addClass("btn");
		jQuery("#spEntryForm").find(".spFormRowFooter input").addClass("btn btn-primary");
		//jQuery("form#spEntryForm").find('.controls input').addClass("input-large");
		//jQuery("form#spEntryForm").find('.controls textarea').addClass("input-large");
		
});

jQuery(document).ready(function() {
	
	//Support Swipe pour le carousel Liste des entrées
	jQuery("#entriescarousel").swiperight(function() {  
		jQuery("#entriescarousel").carousel('prev');  
	});  
	jQuery("#entriescarousel").swipeleft(function() {  
		jQuery("#entriescarousel").carousel('next');  
	});  
	
});

jQuery(window).resize(function () {

	//On pousse le contenu sous le header fixe
	//jQuery("body").css("padding-top", jQuery(".header").height());

	changeStackingOrder();
	
});
</script>

</body> 
</html>