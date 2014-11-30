<?php
/**
 * @version     0.0.1
 * @package     com_comment
 * @copyright   © 2014. Все права защищены.
 * @license     GNU General Public License
 * @author      Anatoly Smirnov <tol171@yandex.ru> - http://mcentre.spb.ru
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Commentform controller class.
 */
class CommentControllerCommentform extends JControllerForm
{

    function __construct() {
        $this->view_list = 'comments';
        parent::__construct();
    }

}