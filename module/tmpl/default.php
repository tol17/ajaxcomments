<?php
/**
 * @copyright	Copyright (c) 2014 tol. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$document = JFactory::getDocument();
   
$document->addScript(JURI::root(true) . "/modules/mod_comment/js/ajaxcomment.js");
$document->addStyleSheet(JURI::root(true) . "/modules/mod_comment/css/ajaxcomment.css");

?>

<div class="modcomment">
     <a class="servicebtn" id="comment" href="" title="<?php echo JText::_('MOD_COMMENT'); ?>">
         <span class="glyphicon glyphicon-edit"></span>
         <?php echo JText::_('MOD_COMMENT'); ?>
     </a>
</div>
