
<?php
/**
 * @version		1.1
 * @package		Joomla.Site
 * @subpackage	com_users
 */
defined('_JEXEC') or die ('Restricted access');
// Get the user id.
$user =& JFactory::getUser();
$usrid = $user->id;

// Activate the ToolTip function
JHTML::_('behavior.tooltip');

			   
$db = JFactory::getDBO();
$query = "Select
  #__sobipro_object.id,
  #__sobipro_object.name,
  #__sobipro_object.approved,
  #__sobipro_object.counter,
  #__sobipro_object.validUntil
From
  #__sobipro_object
  Where
#__sobipro_object.owner= $usrid and
#__sobipro_object.oType= 'entry'
";
$db->setQuery($query);

$rows = $db->loadRowList();
$nbrows = count($rows) ;

?>
<fieldset id="users-profile-sobipro" class="users-profile-sobipro-<?php echo $group;?>">
	<legend>
	<?php if ($nbrows <= 1) 	
	echo JText::_('COM_USERS_SOBIPRO_MYENTRY');
	if ($nbrows > 1) 	
	echo JText::_('COM_USERS_SOBIPRO_MYENTRIES');
	?></legend>
	
	
	<div id ="sobipro-entries">
<?php

if ($nbrows > 0) :?>
	
		<?php foreach($rows as $row) 
		 {
		 		
			if ($row['2'] == 0) echo '<i class="icon-exclamation-sign"></i> ';
			if ($row['2'] == 1) echo '<i class="icon-ok-sign"></i> ';	
            echo '<a href="index.php?option=com_sobipro&sid='.$row['0'].'">'.$row['1'].'</a>, ';		
			echo JText::_('COM_USERS_SOBIPRO_SINCE')." ".JHtml::_('date', $row['4']);
			echo " (".$row['3']." ".JText::_('COM_USERS_SOBIPRO_COUNTER').")";
			echo ' | <a href="index.php?option=com_sobipro&task=entry.edit&sid='.$row['0'].'">'.JText::_('COM_USERS_SOBIPRO_EDIT_ENTRY').'</a>';
			}
		?>
	<?php endif;?>
	
	<?php if ($nbrows == 0) :?>
	<p><?php echo JText::_('COM_USERS_SOBIPRO_NO_ENTRIES');?></p>
	<?php endif;?>	
	</div>
	
	<p><a href="index.php?option=com_sobipro&task=entry.add&sid=55"><button class="btn"><?php echo JText::_('COM_USERS_SOBIPRO_NEW_ENTRY');?></button></a></p>	
	
</fieldset>
