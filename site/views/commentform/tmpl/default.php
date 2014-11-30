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
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_comment/assets/js/form.js');

$scr = <<<EOD
        jQuery(document).ready(function() {
            jQuery('#form-commentform').submit(function(event) {
                
		if(jQuery('#jform_file').val() != ''){
			jQuery('#jform_file_hidden').val(jQuery('#jform_file').val());
		}
            });

            
        });
EOD;

$doc->addScriptDeclaration($scr);

?>

<div class="commentform-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1>
    <?php else: ?>
        <h1>Add comment</h1>
    <?php endif; ?>
    <?php 
        if (!empty($this->msg)){
            foreach($this->msg as $k=>$msg) {
                echo '<div class="alert alert-block">';
                    echo "<h4>".$msg['message']."</h4>";
                echo '</div>';
            }
        }
    
    ?>    

    <form id="form-commentform" action="<?php echo JRoute::_('index.php?option=com_comment&task=commentform.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
        
	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />

	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('name'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('name'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('email'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('email'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('tel'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('tel'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('comment'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('comment'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('file'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('file'); ?></div>
	</div>
	<?php if (!empty($this->item->file)) : ?>
		<a href="<?php echo JRoute::_(JUri::base() . 'administrator' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_comment' . DIRECTORY_SEPARATOR . 'download' .DIRECTORY_SEPARATOR . $this->item->file, false);?>"><?php echo JText::_("COM_COMMENT_VIEW_FILE"); ?></a>
	<?php endif; ?>
	<input type="hidden" name="jform[file]" id="jform_file_hidden" value="<?php echo $this->item->file ?>" />
	<input type="hidden" name="jform[answer]" value="0" />
				<?php echo $this->form->getInput('date'); ?>
        <div class="control-group">
            <div class="controls">
                <button type="submit" id="btnsave" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
                <a class="btn" id="btnclose" href="" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            </div>
        </div>
        
        <input type="hidden" name="option" value="com_comment" />
        <input type="hidden" name="task" value="commentform.save" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>
