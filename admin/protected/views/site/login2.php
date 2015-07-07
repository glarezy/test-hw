<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('login','login');
$this->breadcrumbs=array(
	Yii::t('login','login'),
);

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
));
?>

<!-- START CONTENT -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tblWrapBody">
<tr>
    <td class="tdCellBody">

<div id="content">
        <div class="login">
            <div class="header"><h1><?php echo Yii::t('login','login');?></h1></div>
<table border="0" cellpadding="0" cellspacing="0" class="tbl2Column">
<tr>
<td class="tdLeft" width="600">
            <div class="section">

                <table border="0" cellspacing="0" cellpadding="0" class="tblLogin">
                    <tr>
                        <td class="lblCell" nowrap width="200" align="right"><?php echo $form->labelEx($model,'username'); ?></td>
                        <td class="txtCell"><?php echo $form->textField($model,'username',array('class'=>'txtBox')); ?></td>
                    </tr>
                    <tr><td colspan=2><?php echo $form->error($model,'username'); ?></td></tr>
                    <tr>
                        <td class="lblCell" align="right" nowrap><?php echo $form->labelEx($model,'password'); ?></td>
                        <td class="txtCell"><?php echo $form->passwordField($model,'password',array('class'=>'txtBox')); ?></td>
                    </tr>
                    <tr><td colspan=2><?php echo $form->error($model,'password'); ?></td></tr>
                    <?php if(CCaptcha::checkRequirements()): ?>
                    <tr>
                        <td class="lblCell" align="right" nowrap><?php echo $form->labelEx($model,'verifyCode'); ?></td>
                        <td class="txtCell">
                        	<div>
							<?php $this->widget('CCaptcha'); ?>
							<?php echo $form->textField($model,'verifyCode',array('class'=>'txtBox')); ?>
							</div>
							<div class="hint"><?php echo Yii::t('login','authcodetip',array('{n}'=>'</br>'));?></div>
							<?php echo $form->error($model,'verifyCode'); ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="lblCell" align="right" nowrap>选择语种 ( Language )</td>
                        <td class="txtCell">
                        	<span ><a href="<?php echo Yii::app()->request->baseUrl; ?>/lang/zh_cn">中文</a></span>
                        	&nbsp;&nbsp;&nbsp;
							<span><a href="<?php echo Yii::app()->request->baseUrl; ?>/lang/en">English</a></span></div>
						</td>
                    </tr>
                    <tr>
                        <td class="lblCell">&nbsp;</td>
                        <td class="txtCell">
                        	<?php echo $form->checkBox($model,'rememberMe'); ?>
							<?php echo $form->label($model,'rememberMe'); ?>
							<?php echo $form->error($model,'rememberMe'); ?>
						</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="btnCell">
                        <input type="submit" value="<?php echo Yii::t('login','login');?>" id="btnLogin" class="button btnHand" />
                        </td>
                    </tr>

                </table>
            </div>

</td>
</tr>
</table>
        </div>
    </div>

	</td>
</tr>
</table>
<?php $this->endWidget(); ?>
<!-- END CONTENT -->
