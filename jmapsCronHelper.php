<?php
/**
 * @version: $Id: helper.php $
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
defined( '_JEXEC' ) || die( 'Direct Access to this location is not allowed.' );
SPLoader::loadController('section');

/**
 * @author Cindy Johnson
 * @version 1.1
 * @created 2012-06-09
 */
class jmapsCronHelper extends SPSectionCtrl {
	public function GetEntries($section)
	{
		static $instance = null;
		if(!($instance)) {
			$instance = new self();
		}
		$entries = $instance->buildEntries($section);
		return $entries;
	}

	public function buildEntries($section) {
		$entries = $this->entries($section);
		return $entries;
	}

	/**
	 * @return array
	 */
	private function entries($section)
	{
		$entriesRecursive = true;
		/* var SPDb $db */
		$db =& SPFactory::db();
		$entries = array();
		$conditions = array();

		$pid = $section;
		$this->setModel('section');
		$this->_model->init($pid);
		if($entriesRecursive) {
			$pids = $this->_model->getChilds('category', true);
			if(is_array($pids)) {
				$pids = array_keys($pids);
			}
			$conditions['sprl.pid'] = $pids;
		} else {
				$conditions['sprl.pid'] = $pid;
				}
		if($pid == -1) {
			unset($conditions['sprl.pid']);
		}

		$table = $db->join(array(
			array('table'=>'spdb_relations', 'as'=>'sprl', 'key'=>'id'),
			array('table'=>'spdb_object', 'as'=>'spo', 'key'=>'id')
		));
		$conditions['spo.oType'] = 'entry';
		$eOrder = 'createdTime.asc';
		$oPrefix = 'spo.';

		/* check user permissions for the visibility */
		if(Sobi::My('id')) {
			$this->userPermissionsQuery($conditions, $oPrefix);
		} else {
				$conditions = array_merge($conditions, array($oPrefix.'state'=>'1', '@VALID'=>$db->valid($oPrefix.'validUntil', $oPrefix.'validSince')));
				}
		$conditions['sprl.copy'] = '0';
		
//		echo '<br />$conditions = <br />';
//		print_r($conditions);
//		echo '<br /><br />End of $conditions = <br />';

		try {
			$db->select($oPrefix.'id', $table, $conditions, $eOrder, 0, 0, true );
			$results = $db->loadResultArray();
		}
		catch (SPException $x) {
			Sobi::Error($this->name(), SPLang::e('DB_REPORTS_ERR', $x->getMessage()), SPC::WARNING, 0, __LINE__, __FILE__);
		}
		if( count($results)) {
			foreach ($results as $i=>$sid) {
				$entries[$i] = $sid;
			}
		}
		return $entries;
	}
}
?>