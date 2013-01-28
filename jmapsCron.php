<?php
/**
 * @version: $Id: jmapsCron.php $
 * @package: Jmaps Marker Field Application
 * ===================================================
 * @author
 * Name: Cindy Johnson, websolutionware.com
 * Email: cindy[at]websolutionware.com
 * Url: http://www.websolutionware.com
 * ===================================================
 * @copyright Copyright (C) 2006 - 2012 websolutionware.com (http://www.websolutionware.net). All rights reserved.
 * @license see http://www.gnu.org/licenses/gpl.html GNU/GPL Version 3.
 * You can use, redistribute this file and/or modify it under the terms of the GNU General Public License version 3
 * ===================================================
 * $Date: 2012-06-09 11:59:04 +0200 (Sat, 09 June 2012) $
 * $Revision: 1100 $
 * $Author: Cindy Johnson $
 */
define( '_JEXEC', 1 );
define('JPATH_BASE', str_replace('/j17cron','',dirname(__FILE__)) );
define( 'DS', DIRECTORY_SEPARATOR );
/* Required Files */
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
/* To use Joomla's Database Class */
require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'factory.php' );
/* Create the Application */
$mainframe =& JFactory::getApplication('site');
/* Create a database object */
$db =& JFactory::getDBO();
//Joomla is up and running now-------------------------------------------------------->

//Start SOBIpro processing    -------------------------------------------------------->
define('SOBI_ROOT', JPATH_BASE);
define('SOBI_PATH', SOBI_ROOT . DS . 'components' . DS . 'com_sobipro');
require_once (implode(DS, array(JPATH_BASE, 'components', 'com_sobipro', 'lib', 'sobi.php')));

//   Get sections

// Create a table called cron with one column `datetime`
$query = 'SELECT * FROM #__sobipro_object WHERE oType= "section" AND state=1';
$db->setQuery($query);
$sections = $db->loadObjectList();

// Die on error
if($db->getErrorMsg()) {
	die;
}

//echo '<br />Sections = <br />';
//print_r($sections);

//   Get all entries for each section
foreach ($sections as $section) {

	echo '<br />Section id = ' . $section->id . '<br />';
	echo '<br />Section nid = ' . $section->nid . '<br />';
	echo '<br />Section name = ' . $section->name . '<br /><br />';
	
	Sobi::Init(JPATH_BASE, JFactory::getConfig()->getValue('config.language'), $section->id);
	echo 'lg='.JFactory::getConfig()->getValue('config.language');
	
	require_once dirname(__FILE__).'/jmapsCronHelper.php';
	SPLoader::loadController('section');
	SPLang::load('SpApp.jmapsmarker');
	
	$spdb =& SPFactory::db();
	$fieldData = array();
	try {
		$jmapsmarker = $spdb->select('*', 'spdb_field', array('section'=>$section->id, 'fieldType'=>'jmapsmarker', 'enabled'=>1))->loadObject();
	}
	catch (SPException $x) {
		continue;
	}
	
	if (empty($jmapsmarker)) {
		continue;
	}
	$params = SPConfig::unserialize($jmapsmarker->params);

//	echo '<br />$params = <br />';
//	print_r($params);
//	echo '<br /><br />End of $params = <br />';
	$jmfaDefaultMarkerImage = $params['jmfaDefaultMarkerImage'];
	$jmfaDefaultMarkerColor = $params['jmfaDefaultMarkerColor'];
	
	$jmfaTitleField = $params['jmfaTitleField'];
	$jmfaStreetField = $params['jmfaStreetField'];
	$jmfaCityField = $params['jmfaCityField'];
	$jmfaStateField = $params['jmfaStateField'];
	$jmfaPostcodeField = $params['jmfaPostcodeField'];
	$jmfaFeaturedField = $params['jmfaFeaturedField'];
	$jmfaCountryField = $params['jmfaCountryField'];
	$jmfaCustomField1 = $params['jmfaCustomField1'];
	$jmfaCustomField2 = $params['jmfaCustomField2'];
	$jmfaCustomField3 = $params['jmfaCustomField3'];
	$jmfaCustomField4 = $params['jmfaCustomField4'];
	$jmfaCustomField5 = $params['jmfaCustomField5'];

	$jmfaBubbleLayout = $params['jmfaBubbleLayout'];
	
	/*$fieldNames = $spdb->select('*', 'spdb_field', array('section' => $section->id, 'nid' => array($jmfaTitleField, 'field_logo', $jmfaStreetField, $jmfaCityField, $jmfaStateField, $jmfaPostcodeField, $jmfaFeaturedField, $jmfaCountryField, $jmfaCustomField1, $jmfaCustomField2, $jmfaCustomField3, $jmfaCustomField4, $jmfaCustomField5), 'enabled' => 1))->loadObjectList();*/
	
//	echo '<br />$fieldNames = <br />';
//	print_r($fieldNames);
//	echo '<br /><br />End of $fieldNames <br />';

	$entries = jmapsCronHelper::GetEntries($section->id);
	
//	echo '<br />$entries = <br />';
//	print_r($entries);
//	echo '<br /><br />End of $entries <br />';
	
	foreach ($entries as $eid) {
		$data = $spdb->select('*', 'spdb_field_jmapsmarker', array('sid'=>$eid, 'section'=>$section->id), 'copy')->loadObject();
		
//		echo '<br />$data = <br />';
//		print_r($data);
//		echo '<br /><br />End of $data <br />';
		
	//   Get all data for each entry required to create the XML markers
		if(isset($data->jmlatitude) && isset($data->jmlongitude) && ($data->jmlatitude + $data->jmlongitude) != 0) {
//			echo '<br />Got this far!!!<br />';
			$fieldNames = $spdb->select('*', 'spdb_field', array('section' => $data->section, 'nid' => array($jmfaTitleField, 'field_logo', $jmfaStreetField, $jmfaCityField, $jmfaStateField, $jmfaPostcodeField, $jmfaFeaturedField, $jmfaCountryField, $jmfaCustomField1, $jmfaCustomField2, $jmfaCustomField3, $jmfaCustomField4, $jmfaCustomField5), 'enabled' => 1))->loadObjectList();
			foreach($fieldNames as $fieldName) {
				$fieldDataObj = $spdb->select('*', 'spdb_field_data', array('sid' => $data->sid, 'fid' => $fieldName->fid))->loadObject();
				if (isset($fieldDataObj->baseData)) {
					$fieldData[$fieldName->nid] = $fieldDataObj->baseData;
					
					
					if ($fieldName->fieldType == 'radio') {
						$fieldNumber[$fieldName->nid] = $fieldDataObj->fid;
						$fieldOptionObj = $spdb->select('*', 'spdb_field_option_selected', array('sid' => $data->sid, 'fid' => $fieldName->fid))->loadObject();
						if (isset($fieldOptionObj->optValue)) {
							$fieldData[$fieldName->nid] = $fieldOptionObj->optValue;
						}
					}
					
					//LGW: extended to checkoxes too!
					if ($fieldName->fieldType == 'chbxgroup') {
						$fieldNumber[$fieldName->nid] = $fieldDataObj->fid;				
						$fieldOptionObjs = $spdb->select('*', 'spdb_field_option_selected', array('sid' => $data->sid, 'fid' => $fieldName->fid,  'copy' => 0))->loadObjectList();
						$fieldData[$fieldName->nid]='';
						
						$nbFieldOptions = count($fieldOptionObjs);
						if ($nbFieldOptions>0) {
							//On cherche le label du champ...
							$fieldLabel  = $spdb->select('*', 'spdb_language', array('sKey' => 'name', 'fid' => $fieldDataObj->fid, 'language' =>Sobi::Lang()))->loadObject();
							$fieldData[$fieldName->nid]='<strong>'.$fieldLabel->sValue.'</strong> : ';
							
							
							$i=1;
							foreach ($fieldOptionObjs as $fieldOptionObj) {
											
								//On recherche le libelle valeur 
								$optValueLib = $spdb->select('*', 'spdb_language', array('sKey' => $fieldOptionObj->optValue))->loadObject();
								if (isset($optValueLib->sValue)) {
									$fieldData[$fieldName->nid] .= $optValueLib->sValue;
									if ($i<$nbFieldOptions) $fieldData[$fieldName->nid] .= ', ';
									else $fieldData[$fieldName->nid] .= '.';
									$i++;
								}
							}
						}
					}
				}
			}
		//			$entry = SPFactory::Entry($data->sid);
			$obj = SPFactory::object($data->sid);
			try {
				$c = array('id'=>$data->sid, 'oType'=>'entry') ;
				$spdb->select(array('pid', 'position', 'validSince', 'validUntil'), 'spdb_relations', $c, 'position');
				$categories = $db->loadAssocList('pid');
	//	validate categories - case some of them have been deleted
				$cats = array_keys($categories);
				if(count($cats)) {
					$cats = $spdb->select('id', 'spdb_object', array('id'=>$cats))->loadResultArray();
				}
				if(count($categories)) {
					foreach ($categories as $i=>$c) {
						if(!(in_array($i, $cats))) {
							unset($categories[$i]);
						}
					}
				}
	//	push the main category to the top of this array
				if(isset($categories [$obj->parent])) {
					$main = $categories [$obj->parent];
					unset($categories[$obj->parent]);
					$work_categories[$obj->parent] = $main;
				}
				foreach ($categories as $cid=>$cat ) {
					$work_categories[$cid] = $cat;
				}
				if($work_categories) {
					$labels = SPLang::translateObject(array_keys($work_categories), 'name', 'category' );
					foreach ($labels as $t) {
						$work_categories[$t['id']]['name'] = $t['value'];
					}
				}
			}
			catch (SPException $x) {
				Sobi::Error('spdb_object', SPLang::e('CANNOT_GET_RELATIONS_DB_ERR', $x->getMessage()), SPC::ERROR, 500, __LINE__, __FILE__ );
			}
//			echo '<br />$main (category)= <br />';
//			print_r($main);
//			echo '<br /><br />End of $main (category)= <br />';
		// Modify the next 2 lines to use parameters instead of hard coding
		
			//LGW:
			/*$jmfaLink = 'index.php?option=com_sobipro&sid=' . $data->sid . ':' . $fieldData[$jmfaTitleField].'&tmpl=component';*/
			$jmfaLink = 'index.php?option=com_sobipro&sid=' . $data->sid . ':' . $fieldData[$jmfaTitleField];
			
			//LGW : on ajoute un champ fixe : field_logo
			$imageArray = SPConfig::unserialize($fieldData['field_logo']);
			$logosrc = $imageArray['ico']; //ico, thumb, image,original
			$jmfaLogo = '<img style="float:left" src="'.JURI::base().$logosrc.'">';
	
			//LGW:Modification de l'entete
			$jmfaTitle = $jmfaLogo.'<b>' . $fieldData[$jmfaTitleField] . '</b><br/>';
			$jmfaDetails = '<div class="SOBIproDetailsDIV"><a href="' . $jmfaLink . '" class="SOBIproDetails" onclick="if(!parent.jQuery.browser.opera) {var linkData = \'' . $jmfaLink . '\'; var returnData = openColorbox(linkData); return returnData;}" target="_blank"><i class="icon-plus-sign"></i> ' . Sobi::Txt('JMFA_DETAILS_LABEL') . '</a></div>';
			
			$XMLname = $fieldData[$jmfaTitleField];
			$XMLID = $data->sid;
			$XMLstreet = $fieldData[$jmfaStreetField];
			$XMLcity = $fieldData[$jmfaCityField];
			$XMLstate = $fieldData[$jmfaStateField];
			$XMLpostal = $fieldData[$jmfaPostcodeField];
			$XMLcountry = $fieldData[$jmfaCountryField];
			$XMLfeatured = '';
			$XMLcustom1 = '';
			$XMLcustom2 = '';
			$XMLcustom3 = '';
			$XMLcustom4 = '';
			$XMLcustom5 = '';
			if ($jmfaFeaturedField && !empty($fieldData[$jmfaFeaturedField])) {
				$XMLfeatured = 'No';
				if ($fieldData[$jmfaFeaturedField] == '1') {
					$XMLfeatured = '1';
				}
			}
			if ($jmfaCustomField1 && !empty($fieldData[$jmfaCustomField1])) {
				$XMLcustom1 = $fieldData[$jmfaCustomField1];
			}
			if ($jmfaCustomField2 && !empty($fieldData[$jmfaCustomField2])) {
				$XMLcustom2 = $fieldData[$jmfaCustomField2];
			}
			if ($jmfaCustomField3 && !empty($fieldData[$jmfaCustomField3])) {
				$XMLcustom3 = $fieldData[$jmfaCustomField3];
			}
			if ($jmfaCustomField4 && !empty($fieldData[$jmfaCustomField4])) {
				$XMLcustom4 = $fieldData[$jmfaCustomField4];
			}
			if ($jmfaCustomField5 && !empty($fieldData[$jmfaCustomField5])) {
				$XMLcustom5 = $fieldData[$jmfaCustomField5];
			}
		
			$addressHTML = $XMLstreet . ',<br />';
			$addressHTML .= $XMLcity;
			$addressHTML .= ', ' . $XMLstate;
			$addressHTML .= '. ' . $XMLpostal . ' ';
			$XMLhtml = '';
			
			$HTMLwork = nl2br($jmfaBubbleLayout);
			$titleStart = strpos($HTMLwork, 'title');
			if ($titleStart === false) {
				$titleStart = 999;
			}
			$detailsStart = strpos($HTMLwork, 'details');
			if ($detailsStart === false) {
				$detailsStart = 999;
			}
			$streetStart = strpos($HTMLwork, 'street');
			if ($streetStart === false) {
				$streetStart = 999;
			}
			$cityStart = strpos($HTMLwork, 'city');
			if ($cityStart === false) {
				$cityStart = 999;
			}
			$stateStart = strpos($HTMLwork, 'state');
			if ($stateStart === false) {
				$stateStart = 999;
			}
			$postalStart = strpos($HTMLwork, 'postal');
			if ($postalStart === false) {
				$postalStart = 999;
			}
			$countryStart = strpos($HTMLwork, 'country');
			if ($countryStart === false) {
				$countryStart = 999;
			}
			$featuredStart = strpos($HTMLwork, 'featured');
			if ($featuredStart === false) {
				$featuredStart = 999;
			}
			$custom1Start = strpos($HTMLwork, 'custom1');
			if ($custom1Start === false) {
				$custom1Start = 999;
			}
			$custom2Start = strpos($HTMLwork, 'custom2');
			if ($custom2Start === false) {
				$custom2Start = 999;
			}
			$custom3Start = strpos($HTMLwork, 'custom3');
			if ($custom3Start === false) {
				$custom3Start = 999;
			}
			$custom4Start = strpos($HTMLwork, 'custom4');
			if ($custom4Start === false) {
				$custom4Start = 999;
			}
			$custom5Start = strpos($HTMLwork, 'custom5');
			if ($custom5Start === false) {
				$custom5Start = 999;
			}
			for ($bl=0;$bl<500;$bl++) {
				if ($bl >= $titleStart) {
					$HTMLarray = explode('title', $HTMLwork);
					if (count($HTMLarray) == 1) {
						$HTMLwork = $jmfaTitle . $HTMLarray[0];
					} else {
							$HTMLwork = $HTMLarray[0] . $jmfaTitle . $HTMLarray[1];
							}
					$titleStart = 998;
					continue;
				}
				if ($bl >= $detailsStart) {
					$HTMLarray = explode('details', $HTMLwork);
					if (count($HTMLarray) == 1) {
						$HTMLwork = $jmfaDetails . $HTMLarray[0];
					} else {
							$HTMLwork = $HTMLarray[0] . $jmfaDetails . $HTMLarray[1];
							}
					$detailsStart = 998;
					continue;
				}
				if ($bl >= $streetStart) {
					$HTMLarray = explode('street', $HTMLwork);
					$workCount = count($HTMLarray);
					if (count($HTMLarray) == 1) {
						$HTMLwork = $XMLstreet . $HTMLarray[0];
					} else {
							$HTMLwork = $HTMLarray[0] . $XMLstreet . $HTMLarray[1];
							}
					$streetStart = 998;
					continue;
				}
				if ($bl >= $cityStart) {
					$HTMLarray = explode('city', $HTMLwork);
					if (count($HTMLarray) == 1) {
						$HTMLwork = $XMLcity . $HTMLarray[0];
					} else {
							$HTMLwork = $HTMLarray[0] . $XMLcity . $HTMLarray[1];
							}
					$cityStart = 998;
					continue;
				}
				if ($bl >= $stateStart) {
					$HTMLarray = explode('state', $HTMLwork);
					if (count($HTMLarray) == 1) {
						$HTMLwork = $XMLstate . $HTMLarray[0];
					} else {
							$HTMLwork = $HTMLarray[0] . $XMLstate . $HTMLarray[1];
							}
					$stateStart = 998;
					continue;
				}
				if ($bl >= $postalStart) {
					$HTMLarray = explode('postal', $HTMLwork);
					if (count($HTMLarray) == 1) {
						$HTMLwork = $XMLpostal . $HTMLarray[0];
					} else {
							$HTMLwork = $HTMLarray[0] . $XMLpostal . $HTMLarray[1];
							}
					$postalStart = 998;
					continue;
				}
				if ($bl >= $countryStart) {
					$HTMLarray = explode('country', $HTMLwork);
					if (count($HTMLarray) == 1) {
						$HTMLwork = $XMLcountry . $HTMLarray[0];
					} else {
							$HTMLwork = $HTMLarray[0] . $XMLcountry . $HTMLarray[1];
							}
					$countryStart = 998;
					continue;
				}
				if ($bl >= $featuredStart) {
					$HTMLarray = explode('featured', $HTMLwork);
					if (count($HTMLarray) == 1) {
						$HTMLwork = $XMLfeatured . $HTMLarray[0];
					} else {
							$HTMLwork = $HTMLarray[0] . $XMLfeatured . $HTMLarray[1];
							}
					$featuredStart = 998;
					continue;
				}
				if ($bl >= $custom1Start) {
					$HTMLarray = explode('custom1', $HTMLwork);
					$XMLcustom = $XMLcustom1;
					if ($jmfaCustomField1 == 'field_email') {
						$XMLcustom = '<a target="_blank" title="' . urlencode($XMLcustom1) . '" href="mailto:' . $XMLcustom1 . '">Email</a>' . ' ';
					}
					if ($jmfaCustomField1 == 'field_website') {
						$urlArray = SPConfig::unserialize($XMLcustom1);
	
//						echo '<br />$urlArray = <br />';
//						print_r($urlArray);
//						echo '<br /><br />End of $urlArray <br />';
	
						$websiteLabel = $urlArray['label'];
						$websiteURL = $urlArray['url'];
						$XMLcustom = '<a target="_blank" title="' . urlencode($websiteLabel) . '" href="' . $websiteURL . '">Website</a>' . ' ';
					}
					
							
					//LGW: si le champ est vide, on saute....
					if ($XMLcustom!='') {
						//LGW: on ajoute le br en dynamique pour prévoir les champs custom vides
						if (count($HTMLarray) == 1) {
							$HTMLwork = $XMLcustom . '</br>' . $HTMLarray[0];
						} 
						else {
							$HTMLwork = $HTMLarray[0] . $XMLcustom . '</br>' . $HTMLarray[1];
						}
					}
					else $HTMLwork = $HTMLarray[0] . $HTMLarray[1];
					$custom1Start = 998;
				}
				if ($bl >= $custom2Start) {
					$HTMLarray = explode('custom2', $HTMLwork);
					$XMLcustom = $XMLcustom2;
					if ($jmfaCustomField2 == 'field_email') {
						$XMLcustom = '<a target="_blank" title="' . urlencode($XMLcustom2) . '" href="mailto:' . $XMLcustom2 . '">Email</a>' . ' ';
					}
					if ($jmfaCustomField2 == 'field_website') {
						$urlArray = SPConfig::unserialize($XMLcustom2);
						$websiteLabel = $urlArray['label'];
						$websiteURL = $urlArray['url'];
						$XMLcustom = '<a target="_blank" title="' . urlencode($websiteLabel) . '" href="' . $websiteURL . '">Website</a>' . ' ';
					}
					
					//LGW: si le champ est vide, on saute....
					if ($XMLcustom!='') {
						//LGW: on ajoute le br en dynamique pour prévoir les champs custom vides
						if (count($HTMLarray) == 1) {
							$HTMLwork = $XMLcustom . '</br>' . $HTMLarray[0];
						} 
						else {
							$HTMLwork = $HTMLarray[0] . $XMLcustom . '</br>' . $HTMLarray[1];
						}
					}
					else $HTMLwork = $HTMLarray[0] . $HTMLarray[1];
					$custom2Start = 998;
					continue;
				}
				if ($bl >= $custom3Start) {
					$HTMLarray = explode('custom3', $HTMLwork);
					$XMLcustom = $XMLcustom3;
					if ($jmfaCustomField3 == 'field_email') {
						$XMLcustom = '<a target="_blank" title="' . urlencode($XMLcustom3) . '" href="mailto:' . $XMLcustom3 . '">Email</a>' . ' ';
					}
					if ($jmfaCustomField3 == 'field_website') {
						$urlArray = SPConfig::unserialize($XMLcustom3);
						$websiteLabel = $urlArray['label'];
						$websiteURL = $urlArray['url'];
						$XMLcustom = '<a target="_blank" title="' . urlencode($websiteLabel) . '" href="' . $websiteURL . '">Website</a>' . ' ';
					}
					
					//LGW: si le champ est vide, on saute....
					if ($XMLcustom!='') {
						//LGW: on ajoute le br en dynamique pour prévoir les champs custom vides
						if (count($HTMLarray) == 1) {
							$HTMLwork = $XMLcustom . '</br>' . $HTMLarray[0];
						} 
						else {
							$HTMLwork = $HTMLarray[0] . $XMLcustom . '</br>' . $HTMLarray[1];
						}
					}
					else $HTMLwork = $HTMLarray[0] . $HTMLarray[1];
							
							
					$custom3Start = 998;
					continue;
				}
				if ($bl >= $custom4Start) {
					$HTMLarray = explode('custom4', $HTMLwork);
					$XMLcustom = $XMLcustom4;
					if ($jmfaCustomField4 == 'field_email') {
						$XMLcustom = '<a target="_blank" title="' . urlencode($XMLcustom4) . '" href="mailto:' . $XMLcustom4 . '">Email</a>' . ' ';
					}
					if ($jmfaCustomField4 == 'field_website') {
						$urlArray = SPConfig::unserialize($XMLcustom4);
						$websiteLabel = $urlArray['label'];
						$websiteURL = $urlArray['url'];
						$XMLcustom = '<a target="_blank" title="' . urlencode($websiteLabel) . '" href="' . $websiteURL . '">Website</a>' . ' ';
					}
					
					//LGW: si le champ est vide, on saute....
					if ($XMLcustom!='') {
						//LGW: on ajoute le br en dynamique pour prévoir les champs custom vides
						if (count($HTMLarray) == 1) {
							$HTMLwork = $XMLcustom . '</br>' . $HTMLarray[0];
						} 
						else {
							$HTMLwork = $HTMLarray[0] . $XMLcustom . '</br>' . $HTMLarray[1];
						}
					}
					else $HTMLwork = $HTMLarray[0] . $HTMLarray[1];
							
							
					$custom4Start = 998;
					continue;
				}
				if ($bl >= $custom5Start) {
					$HTMLarray = explode('custom5', $HTMLwork);
					$XMLcustom = $XMLcustom5;
					if ($jmfaCustomField5 == 'field_email') {
						$XMLcustom = '<a target="_blank" title="' . urlencode($XMLcustom5) . '" href="mailto:' . $XMLcustom5 . '">Email</a>' . ' ';
					}
					if ($jmfaCustomField5 == 'field_website') {
						$urlArray = SPConfig::unserialize($XMLcustom5);
						$websiteLabel = $urlArray['label'];
						$websiteURL = $urlArray['url'];
						$XMLcustom = '<a target="_blank" title="' . urlencode($websiteLabel) . '" href="' . $websiteURL . '">Website</a>' . ' ';
					}
					
					//LGW: si le champ est vide, on saute....
					if ($XMLcustom!='') {
						//LGW: on ajoute le br en dynamique pour prévoir les champs custom vides
						if (count($HTMLarray) == 1) {
							$HTMLwork = $XMLcustom . '</br>' . $HTMLarray[0];
						} 
						else {
							$HTMLwork = $HTMLarray[0] . $XMLcustom . '</br>' . $HTMLarray[1];
						}
					}
					else $HTMLwork = $HTMLarray[0] . $HTMLarray[1];
							
							
					$custom5Start = 998;
					continue;
				}
			}
			
			//LGW : On ajoute la categorie		
			$nbcats = count($labels);
			$i=1;
			$cats = '<br/><br/>Catégorie(s) : '; //A faire : gerer la traduction !
			foreach ($labels as $label ) {
				$cats .= $label['value'];
				if ($i<$nbcats) $cats .= ', ';
				$i++;
			}
			
			$XMLhtml .= $HTMLwork.$cats;			
			$XMLcatID = 0;
			if (!empty($main)) {
				$XMLcatID = $main['pid'];
			}
			$XMLcatOrdering = 0;
			$XMLlatitude = 0;
			$XMLminZoom = 0;
			$XMLmaxZoom = 20;
			if (!empty($data->jmlatitude)) {
				$XMLlatitude = $data->jmlatitude;
			}
			$XMLlongitude = 0;
			if (!empty($data->jmlongitude)) {
				$XMLlongitude = $data->jmlongitude;
			}
			$XMLiconImage = '';
			if (!empty($data->jmcolor)) {
				$XMLiconImage = $data->jmcolor;
			}
			if (!empty($data->jmimage) && $data->jmimage != 'none') {
				$XMLiconImage = $data->jmimage;
			}
		
		//			$addressHTML = '<br />';				
			$addressHTML = $XMLstreet . ',<br />';
			$addressHTML .= $XMLcity;
			$addressHTML .= ', ' . $XMLstate;
			$addressHTML .= '. ' . $XMLpostal . ' ';
			$XMLoutAddress = $XMLstreet.', '.$XMLcity.', '.$XMLstate.'. '.$XMLpostal;
			$jmapsMarkerObject = new stdClass();
			$jmapsMarkerObject->Name = $XMLname;
			$jmapsMarkerObject->Address = $XMLoutAddress;
			$jmapsMarkerObject->CatID = $XMLcatID;
			$jmapsMarkerObject->CatOrdering = $XMLcatOrdering;
			$jmapsMarkerObject->HTML = $XMLhtml;
			$jmapsMarkerObject->Latitude = $XMLlatitude;
			$jmapsMarkerObject->Longitude = $XMLlongitude;
			$jmapsMarkerObject->Featured = $XMLfeatured;
			$jmapsMarkerObject->IconLabel = 0;
			$jmapsMarkerObject->iconImage = addslashes($XMLiconImage);
			$jmapsMarkerObject->minZoom = intval($XMLminZoom);
			$jmapsMarkerObject->maxZoom = intval($XMLmaxZoom);
	
//			echo '<br />$jmapsMarkerObject = <br />';
//			print_r($jmapsMarkerObject);
//			echo '<br /><br />End of $jmapsMarkerObject <br />';
			$JmapsMapMarkerArray[0][] = $jmapsMarkerObject;
			if ($XMLcatID > 0) {
				$JmapsMapMarkerArray[$XMLcatID][] = $jmapsMarkerObject;
			}
		}
	}
//   Create XML file for the entire section and each category
	$XMLpointer = 0;
	$XMLkeys = array_keys($JmapsMapMarkerArray);

	foreach ($JmapsMapMarkerArray as $XMLitem) {
		buildXML($XMLitem, $section->id, $XMLkeys[$XMLpointer]);
		$XMLpointer++;
	}
}
//   Function to create the XML files 
function buildXML ($JmapsMapMarkerArray, $thisSectionID, $thisCategoryID) {
//	echo '<br />*** Build XML *** CatID = '.$thisCatID.'<br />';
	$XMLcount = 0;
	$XMLuserID = 0;
	$XMLfirstName = '';
	$XMLlastName = '';
	$XMLaddress = '';
	$XMLcity = '';
	$XMLcatID = '';
	$XMLcatOrdering = '';
	$XMLstate = '';
	$XMLzipCode = '';
	$XMLcountry = '';
	$doc = new DOMDocument('1.0', 'UTF-8');
	$root = $doc->createElement('sgmMarkers');
	$doc->appendChild($root);
	for ($i = 0; $i < count($JmapsMapMarkerArray); $i++) {
		$jmapsMarkerObject = $JmapsMapMarkerArray[$i];
		
		$XMLname = $jmapsMarkerObject->Name;
		$XMLaddress = $jmapsMarkerObject->Address;
		$XMLcatID = $jmapsMarkerObject->CatID;
		$XMLcatOrdering = $jmapsMarkerObject->CatOrdering;
		$XMLhtml = $jmapsMarkerObject->HTML;
		$XMLlatitude = 0;
		if (!empty($jmapsMarkerObject->Latitude)) {
			$XMLlatitude = $jmapsMarkerObject->Latitude;
		}
		$XMLlongitude = 0;
		if (!empty($jmapsMarkerObject->Longitude)) {
			$XMLlongitude = $jmapsMarkerObject->Longitude;
		}
		$XMLfeatured = $jmapsMarkerObject->Featured;
		$XMLiconImage = $jmapsMarkerObject->iconImage;
		$XMLminZoom = $jmapsMarkerObject->minZoom;
		$XMLmaxZoom = $jmapsMarkerObject->maxZoom;

		$root_child = $doc->createElement('sgmMarker');
		$root->appendChild($root_child);
		
		$root_attr1 = $doc->createAttribute('Address');
		$root_child->appendChild($root_attr1);
		$root_text = $doc->createTextNode($XMLaddress);
		$root_attr1->appendChild($root_text);
		
		$outName = $XMLname;
		$root_attr2= $doc->createAttribute('Name');
		$root_child->appendChild($root_attr2);
		$root_text = $doc->createTextNode($outName);
		$root_attr2->appendChild($root_text);
		
		$root_attr3 = $doc->createAttribute('HTML');
		$root_child->appendChild($root_attr3);
		$root_text = $doc->createTextNode($XMLhtml);
		$root_attr3->appendChild($root_text);
	
		$root_attr4 = $doc->createAttribute('Latitude');
		$root_child->appendChild($root_attr4);
		$root_text = $doc->createTextNode($XMLlatitude);
		$root_attr4->appendChild($root_text);
	   
		$root_attr5 = $doc->createAttribute('Longitude');
		$root_child->appendChild($root_attr5);
		$root_text = $doc->createTextNode($XMLlongitude);
		$root_attr5->appendChild($root_text);
	   
		$root_attr6 = $doc->createAttribute('Featured');
		$root_child->appendChild($root_attr6);
		$root_text = $doc->createTextNode($XMLfeatured);
		$root_attr6->appendChild($root_text);
	   
		$root_attr7 = $doc->createAttribute('CatID');
		$root_child->appendChild($root_attr7);
		$root_text = $doc->createTextNode($XMLcatID);
		$root_attr7->appendChild($root_text);
	   
		$root_attr8 = $doc->createAttribute('CatOrdering');
		$root_child->appendChild($root_attr8);
		$root_text = $doc->createTextNode($XMLcatOrdering);
		$root_attr8->appendChild($root_text);
	   
		$XMLcount++;
		$root_attr9 = $doc->createAttribute('IconLabel');
		$root_child->appendChild($root_attr9);
		$root_text = $doc->createTextNode($XMLcount);
		$root_attr9->appendChild($root_text);
	
		$root_attr10 = $doc->createAttribute('iconImage');
		$root_child->appendChild($root_attr10);
		$root_text = $doc->createTextNode($XMLiconImage);
		$root_attr10->appendChild($root_text);
	   
		$root_attr11 = $doc->createAttribute('minZoom');
		$root_child->appendChild($root_attr11);
		$root_text = $doc->createTextNode($XMLminZoom);
		$root_attr11->appendChild($root_text);
	   
		$root_attr12 = $doc->createAttribute('maxZoom');
		$root_child->appendChild($root_attr12);
		$root_text = $doc->createTextNode($XMLmaxZoom);
		$root_attr12->appendChild($root_text);
			
	}
	if ($thisCategoryID > 0) {
		$XMLFileName = 'sobipro_section'.$thisSectionID.'_category'.$thisCategoryID.'File.xml';
		$doc->save($XMLFileName);
		echo 'Successful build of Jmaps XML file for Section - ' . $thisSectionID . ' Category - ' . $thisCategoryID . '. File name = ' . $XMLFileName . '<br />';
	} else {
			$XMLFileName = 'sobipro_section'.$thisSectionID.'File.xml';
			$doc->save($XMLFileName);
			echo 'Successful build of Jmaps XML file for Section ' . $thisSectionID . '(All). File name = ' . $XMLFileName . '<br />';
			}
}
?>