<script>
	$(document).ready(function() {
		$('#btnq').bind('click',function(){
				$('#questionnairebody').dialog('open');
		});

			$('#questionnairebody').dialog({
			    title: '<?php echo CHtml::encode($title);?>',
			    closed: true,
			    cache: false,
			    modal: true,
			    draggable: false,
			    shadow: false,
			    width: 500,
			    height: 400
			});

		jQuery_1_2_6(function($){
			$('#btnQImg').scrollFollow();
		});
	});
</script>
<div id="btnQImg" class="q"><a id=btnq href="javascript:void(0);"><?php echo H::m('q.gif');?></a></div>
<?php
		echo '<div id="questionnairebody" class="form qbody">';
		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'questionnaire-form',
			/*'enableAjaxValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
			'action'=>CHtml::normalizeUrl(array('/questionnaire/submit')),*/
		));

		foreach($fields as $n => $entry) {
			$field = 'field'.($n+1);
			switch($entry['type']) {
				case '单项选择题':
				case 'radio':
					echo '<div class="qrow">';
					echo '<label><b>'.CHtml::encode($entry['label']).'</b></label><br />';
					/*foreach($entry['options'] as $m => $option) {
						if( $entry['arrange'] == '横排' )
							echo '&nbsp;&nbsp;';
						else if( $m > 0 )
							echo '<br />&nbsp;&nbsp;';
						else
							echo '&nbsp;&nbsp;';
						echo '<input type=radio name="'.$field.'" id="'.$field.'" value="'.CHtml::encode($option['value']).'"><label for="'.$field.'">'.CHtml::encode($option['label']).'</label>';
					}*/
					$radioVal = array();
					foreach($entry['options'] as $option) {
					$radioVal[$option['value']] = $option['label'];
					}
					echo '&nbsp;&nbsp;'.$form->radioButtonList($model,$field,$radioVal,array('separator'=>$entry['arrange'] == '横排'?'&nbsp;&nbsp;':'<br />&nbsp;&nbsp;'));
					echo '</div>';
					break;
				case '多项选择题':
				case 'checkbox':
					echo '<div class="qrow">';
					echo '<label><b>'.CHtml::encode($entry['label']).'</b></label><br />';
					/*foreach($entry['options'] as $m => $option) {
						if( $entry['arrange'] == '横排' )
							echo '&nbsp;&nbsp;';
						else if( $m > 0 )
							echo '<br />&nbsp;&nbsp;';
						else
							echo '&nbsp;&nbsp;';
						//echo '<input type=checkbox name="'.$field.'_'.$m.'" id="'.$field.'_'.$m.'" value="'.CHtml::encode($option['value']).'"><label for="'.$field.'_'.$m.'">'.CHtml::encode($option['label']).'</label>';
						echo $form->checkBox($model,$field);
					}*/
					$radioVal = array();
					foreach($entry['options'] as $option) {
					$radioVal[$option['value']] = $option['label'];
					}
					echo '&nbsp;&nbsp;'.$form->checkBoxList($model,$field,$radioVal,array('separator'=>$entry['arrange'] == '横排'?'&nbsp;&nbsp;':'<br />&nbsp;&nbsp;'));
					echo '</div>';
					break;
				case '单行输入':
				case 'text':
					echo '<div class="qrow">';
					echo '<label><b>'.CHtml::encode($entry['label']).'</b></label><br>';
					echo '&nbsp;&nbsp;';//<input type=text name="'.$field.'" id="'.$field.'" size=50>';
					echo $form->textField($model,$field,array('size'=>50,'maxlength'=>255));
					echo '</div>';
					break;
				case '多行输入':
				case 'textarea':
					echo '<div class="qrow">';
					echo '<label><b>'.CHtml::encode($entry['label']).'</b></label><br>';
					echo '&nbsp;&nbsp;';
					//<textarea type=text name="'.$field.'" id="'.$field.'" rows=10 cols=60></textarea>';
					echo $form->textArea($model,$field,array('id'=>$field, 'rows'=>10));
					echo '</div>';
					break;
					break;
			}
		}
/*
	if(CCaptcha::checkRequirements()){
		echo '<div class="qrow">';
		echo $form->labelEx($model,'verifyCode');
		echo '<div>';
		$this->widget('CCaptcha');
		echo $form->textField($model,'verifyCode');
		echo '</div>';
		echo '<div class="hint">'.Yii::t('login','authcodetip',array('{n}'=>'</br>')).'</div>';
		echo $form->error($model,'verifyCode');
		echo '</div>';
	}*/

	//echo $form->errorSummary($model);

	echo '<div style="text-align:center;">';
	//echo CHtml::submitButton(Yii::t('common','submit'));
	echo CHtml::ajaxSubmitButton(
        Yii::t('common','submit'),
        CHtml::normalizeUrl(array('/questionnaire/submit')),
        array(
            'beforeSend'=>'function(){

            }',
            'success'=>'function(data){
            	var res = jQuery.parseJSON(data);
            	if( res.close == 1 ) {
	            	$("#questionnairebody").dialog("close");
	            	$("#btnQImg").hide();
	            }
            	if( res.code != "success" ) {
            		alert(res.msg);
            		return;
            	}
            	alert(res.msg);
            }',
        )
    );
	echo '</div>';
	$this->endWidget();
	echo '</div>';
?>
