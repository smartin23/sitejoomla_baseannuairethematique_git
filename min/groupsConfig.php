<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/** 
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 *
 * See http://code.google.com/p/minify/wiki/CustomSource for other ideas
 **/

return array(
    // 'js' => array('//js/file1.js', '//js/file2.js'),
    // 'css' => array('//css/file1.css', '//css/file2.css'),
		'generalcss' => array('//templates/baseannuairethematique/bootstrap-sources/less/bootstrap.css',
		'//templates/system/css/system.css', 
		'//templates/system/css/general.css',
		'//templates/baseannuairethematique/css/template.css'),
		'basejs' => array('//scripts/jquery-1.8.3.min.js',
		'//scripts/jquery.easing.1.3.js',
		'//scripts/modernizr.custom.js'),
		'generaljs' => array('//templates/baseannuairethematique/bootstrap-sources/js/bootstrap-button.js', '//templates/baseannuairethematique/bootstrap-sources/js/bootstrap-collapse.js', '//templates/baseannuairethematique/bootstrap-sources/js/bootstrap-dropdown.js', '//templates/baseannuairethematique/bootstrap-sources/js/bootstrap-transition.js', '//templates/baseannuairethematique/bootstrap-sources/js/bootstrap-carousel.js', '//templates/baseannuairethematique/bootstrap-sources/js/bootstrap-tooltip.js',
		'//templates/baseannuairethematique/bootstrap-sources/js/bootstrap-tab.js',
		'//scripts/responsive-tabs/responsive-tabs.js',
		'//scripts/pajinate/jquery.pajinate.min.js',
		'//scripts/jquery.tinyscrollbar.min.js',
		'//scripts/sharrre/jquery.sharrre.min.js'),
		'mobilejs' => array('//scripts/jquery.mobile.custom.min.js'),
		'ielte8js' => array('//scripts/respond/respond.min.js',
		'//scripts/selectivizr/selectivizr-min.js',
		'//scripts/pie20/PIE_IE678.js'),
		'ielte9js' => array('//scripts/pie20/PIE_IE9.js'),
		'jmapsjs' => array('//modules/mod_jmaps/js/jquery.jmap.min.js',
		'//modules/mod_jmaps/js/markerclusterer_packed.js',
		'//modules/mod_jmaps/js/mapiconmaker.min.js',
		'//modules/mod_jmaps/js/jquery.colorbox-min.js'),		
);