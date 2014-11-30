<?php
/**
 * @version     0.0.1
 * @package     com_comment
 * @copyright   © 2014. Все права защищены.
 * @license     GNU General Public License
 * @author      Anatoly Smirnov <tol171@yandex.ru> - http://mcentre.spb.ru
 */


// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_comment')) 
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

$controller	= JControllerLegacy::getInstance('Comment');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
