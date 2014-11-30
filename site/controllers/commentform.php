<?php

/**
 * @version     0.0.2
 * @package     com_comment
 * @copyright   © 2014. Все права защищены.
 * @license     GNU General Public License
 * @author      Anatoly Smirnov <tol171@yandex.ru> - http://mcentre.spb.ru
 */
// No direct access
defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/controller.php';

/**
 * Commentform controller class.
 */
class CommentControllerCommentForm extends CommentController {

    /**
     * Method to check out an item for editing and redirect to the edit form.
     *
     * @since	1.6
     */
    public function edit() {
        $app = JFactory::getApplication();

        // Get the previous edit id (if any) and the current edit id.
        $previousId = (int) $app->getUserState('com_comment.edit.commentform.id');
        $editId = JFactory::getApplication()->input->getInt('id', null, 'array');

        // Set the user id for the user to edit in the session.
        $app->setUserState('com_comment.edit.commentform.id', $editId);

        // Get the model.
        $model = $this->getModel('CommentForm', 'CommentModel');

        // Check out the item
        if ($editId) {
            $model->checkout($editId);
        }

        // Check in the previous user.
        if ($previousId) {
            $model->checkin($previousId);
        }

        // Redirect to the edit screen.
        $this->setRedirect(JRoute::_('index.php?option=com_comment&view=commentform&layout=edit', false));
    }

    /**
     * Method to save a user's profile data.
     *
     * @return	void
     * @since	1.6
     */
    public function save() {
        // Check for request forgeries.
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Initialise variables.
        $app = JFactory::getApplication();
        $model = $this->getModel('CommentForm', 'CommentModel');

        // Get the user data.
        $data = JFactory::getApplication()->input->get('jform', array(), 'array');

        // Validate the posted data.
        $form = $model->getForm();
        if (!$form) {
            JError::raiseError(500, $model->getError());
            return false;
        }

        // Validate the posted data.
        $data = $model->validate($form, $data);

        // Check for errors.
        if ($data === false) {
            // Get the validation messages.
            $errors = $model->getErrors();

            // Push up to three validation messages out to the user.
            for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
                if ($errors[$i] instanceof Exception) {
                    $app->enqueueMessage($errors[$i]->getMessage(), 'warning');
                } else {
                    $app->enqueueMessage($errors[$i], 'warning');
                }
            }

            $input = $app->input;
            $jform = $input->get('jform', array(), 'ARRAY');

            // Save the data in the session.
            $app->setUserState('com_comment.edit.commentform.data', $jform, array());

            // Redirect back to the edit screen.
            $id = (int) $app->getUserState('com_comment.edit.commentform.id');
            $this->setRedirect(JRoute::_('index.php?option=com_comment&view=commentform&format=raw&layout=edit&id=' . $id, false));
            return false;
        }

        // Attempt to save the data.
        $return = $model->save($data);

        // Check for errors.
        if ($return === false) {
            // Save the data in the session.
            $app->setUserState('com_comment.edit.commentform.data', $data);

            // Redirect back to the edit screen.
            $id = (int) $app->getUserState('com_comment.edit.commentform.id');
            $this->setMessage(JText::sprintf('Save failed', $model->getError()), 'warning');
            $this->setRedirect(JRoute::_('index.php?option=com_comment&view=commentform&format=raw&layout=edit&id=' . $id, false));
            return false;
        }

        // Check in the profile.
        if ($return) {
            $model->checkin($return);
        }

        // Clear the profile id from the session.
        $app->setUserState('com_comment.edit.commentform.id', null);

        
        $this->setMessage(JText::_('COM_COMMENT_ITEM_SAVED_SUCCESSFULLY'));
        $url = ('index.php?option=com_comment&view=commentform&format=raw&layout=result');
        $this->setRedirect(JRoute::_($url, false));

        // Flush the data from the session.
        $app->setUserState('com_comment.edit.commentform.data', null);
        
        $app->setUserState('com_comment.edit.errors', null);
                        
    }
    
    public function  result() {
         
        $view = & $this->getView( 'commentform', 'raw' );  
        $view->setLayout( 'result' );  
    }  
 
}
