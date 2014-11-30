<?php
/**
 * @version     0.0.2
 * @package     com_comment
 * @copyright   © 2014. Все права защищены.
 * @license     GNU General Public License
 * @author      Anatoly Smirnov <tol171@yandex.ru> - http://mcentre.spb.ru
 */
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_comment', JPATH_ADMINISTRATOR);

?>

<div class="commentform-edit front-end-edit">
    
    <div class="alert alert-success">
        <h4>Your comment saved!</h4>
        We answer your later...
    </div>
    
</div>