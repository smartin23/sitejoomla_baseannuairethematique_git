<?php
/**
 * @version		$Id: modules.php 14276 2010-01-18 14:20:28Z louis $
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the sliders style, you would use the following include:
 * <jdoc:include type="module" name="test" style="slider" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 *
 * This module chrome file creates custom output for modules used with the Atomic template.
 * The first function wraps modules using the "container" style in a DIV. The second function
 * uses the "bottommodule" style to change the header on the bottom modules to H6. The third
 * function uses the "sidebar" style to change the header on the sidebar to H3. 
 */
 
 function modChrome_standardlite( $module, $params, $attribs )
{
	$headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;

	// Add module class suffix and unique class name
	$moduleClassSfx = '';
    $moduleUniqueClass = ' mod-'. $module->id ;
	$modulePos = ' '.$module->position ;
	if ( $params->get( 'moduleclass_sfx' ) != NULL )
		{
			$moduleClassSfx = $params->get( 'moduleclass_sfx' );
		}

	if (!empty ($module->content)) { ?>
		<div class="module <?php echo $moduleClassSfx; echo $moduleUniqueClass; echo $modulePos?>">
		<?php if ($module->showtitle) { ?> <h<?php echo $headerLevel; ?>>
		<?php echo $module->title; ?></h<?php echo $headerLevel; ?>>
	<?php }; ?> <?php echo $module->content; ?></div>
	<?php };
}
 
 function modChrome_standard( $module, $params, $attribs )
{
	$headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;

	// Add module class suffix and unique class name
	$moduleClassSfx = '';
	$moduleClassSfxList = Array();
    $moduleUniqueClass = ' mod-'. $module->id ;
	$modulePos = ' '.$module->position ;
	if ( $params->get( 'moduleclass_sfx' ) != NULL )
		{
			$moduleClassSfx = $params->get( 'moduleclass_sfx' );
			$moduleClassSfxList = explode(" ",$moduleClassSfx);
		}

	if (!empty ($module->content)) { ?>
		<div class="module <?php echo $moduleClassSfx; echo $moduleUniqueClass; echo $modulePos?>">
		<?php if ($module->showtitle) { ?> <h<?php echo $headerLevel; ?>>
		<i class="icon-<?php echo $moduleClassSfxList[0]; ?> icon-large"></i>&nbsp;
		<?php echo $module->title; ?></h<?php echo $headerLevel; ?>>
	<?php }; ?> <?php echo $module->content; ?></div>
	<?php };
}

function modChrome_container($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<div class="container">
			<?php echo $module->content; ?>
		</div>
	<?php endif;
}
function modChrome_bottommodule($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<?php if ($module->showtitle) : ?>
			<h6><?php echo $module->title; ?></h6>
		<?php endif; ?>
		<?php echo $module->content; ?>
	<?php endif;
}
function modChrome_sidebar($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<?php if ($module->showtitle) : ?>
			<h3><?php echo $module->title; ?></h3>
		<?php endif; ?>
		<?php echo $module->content; ?>
	<?php endif;
}
function modChrome_cadre($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<div class="Block">
			<div class="Block-tl"></div>
			<div class="Block-tr"><div></div></div>
			<div class="Block-bl"><div></div></div>
			<div class="Block-br"><div></div></div>
			<div class="Block-tc"><div></div></div>
			<div class="Block-bc"><div></div></div>
			<div class="Block-cl"><div></div></div>
			<div class="Block-cr"><div></div></div>
			<div class="Block-cc"></div>
			<div class="Block-body">

				<?php if ($module->showtitle != 0) : ?>
				<div class="BlockHeader">
					
						<div class="BlockHeader-text <?php echo $params->get('moduleclass_sfx'); ?>">
							<?php echo $module->title; ?>
						</div>
					
					
				</div>
				<?php endif; ?>
				
				<div class="BlockContent">
					<div class="BlockContent-body">

						<?php echo $module->content; ?>

					</div>
				</div>

			</div>
		</div>
	<?php endif;
}
?>