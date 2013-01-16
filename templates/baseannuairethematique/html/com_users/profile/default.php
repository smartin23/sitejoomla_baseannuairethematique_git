<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 */

defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');
?>
<div class="profile<?php echo $this->pageclass_sfx?>">

<h3>
	<i class="icon-dashboard icon-large"></i> <?php echo JText::_('COM_USERS_PROFILE_MY_ACCOUNT'); ?>
</h3>


<?php echo $this->loadTemplate('core'); ?>

<!--<php echo $this->loadTemplate('params'); ?>-->

<?php echo $this->loadTemplate('custom'); ?>

<?php if (JFactory::getUser()->id == $this->data->id) : ?>
<a href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id='.(int) $this->data->id);?>">
	<button class="btn"><?php echo JText::_('COM_USERS_Edit_Profile'); ?></button></a>
<?php endif; ?>

<?php echo $this->loadTemplate('entry'); ?>

</div>
