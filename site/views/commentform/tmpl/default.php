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

<div class="commentform">
    <?php if (!empty($this->item->id)): ?>
        <h2>Редактировать <?php echo $this->item->id; ?></h2>
    <?php else: ?>
        <h2><span class="glyphicon glyphicon-edit"></span>&nbsp;ОСТАВИТЬ ОТЗЫВ</h2>
    <?php endif; ?>
    <?php 
        if (!empty($this->msg)){
            foreach($this->msg as $k=>$msg) {
                echo '<div class="bg-warning">';
                    echo "<h4>".$msg['message']."</h4>";
                echo '</div>';
            }
        }
    
    ?>    

    <form id="form-commentform" action="<?php echo JRoute::_('index.php?option=com_comment&task=commentform.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
        <fieldset>
            
                <input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />

                <div class="form-group">
                        <div class="col-md-12">
                        <input name="jform[name]" id="jform_name" value="" placeholder="Ваше имя или название компании" class="required form-control input-lg" required="" aria-required="true" type="text"/>
                        </div>
                </div>
                <div class="form-group">
                        <div class="col-md-6">
                            <input name="jform[email]" class="validate-email required form-control" id="jform_email" value="" placeholder="e-mail" required="" aria-required="true" type="email"/>
                        </div>
                </div>
                <div class="form-group">
                        <div class="col-md-6">
                            <input name="jform[tel]" class="form-control" id="jform_tel" placeholder="Телефон" value="" type="text"/>
                        </div>
                </div>
                <div class="form-group">
                        <div class="col-md-12">
                            <textarea name="jform[comment]" class="form-control" placeholder="Напишите отзыв" id="jform_comment" cols="100" rows="8"></textarea>
                        </div>
                </div>
                <div class="form-group">
                        <div class="col-md-9">
                            <input name="jform[file]" id="jform_file" value="" accept="image/jpeg, image/gif, image/png, image/bmp, application/msword, application/excel, application/pdf, application/powerpoint, text/plain, application/x-zip" type="file"/>
                        </div>
                </div>
                <?php if (!empty($this->item->file)) : ?>
                        <a href="<?php echo JRoute::_(JUri::base() . 'administrator' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_comment' . DIRECTORY_SEPARATOR . 'download' .DIRECTORY_SEPARATOR . $this->item->file, false);?>"><?php echo JText::_("COM_COMMENT_VIEW_FILE"); ?></a>
                <?php endif; ?>
                <input type="hidden" name="jform[file]" id="jform_file_hidden" value="<?php echo $this->item->file ?>" />
                <input type="hidden" name="jform[answer]" value="0" />
                                        <?php echo $this->form->getInput('date'); ?>
                <div class="form-group">
                    <div class="col-md-9">
                        <button type="submit" id="btnsave" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
                        <a class="btn" id="btnclose" href="" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
                    </div>
                </div>

                <input type="hidden" name="option" value="com_comment" />
                <input type="hidden" name="task" value="commentform.save" />
                <?php echo JHtml::_('form.token'); ?>
        </fieldset>
    </form>
</div>
