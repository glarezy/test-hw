
<div class="view">

<?php
	foreach($fields as $n => $entry) {
		echo '<b>'.CHtml::encode($entry['label']).':</b><br />';
		$field = 'field'.($n+1);
		switch($entry['type']) {
			case '单项选择题':
			case 'radio':
				foreach($entry['options'] as $option) {
					$elementId = $field.'_'.mt_rand(1000,9999).mt_rand(1000,9999);
					echo '<input id='.$elementId.' type=radio name='.$elementId;
					if( $data->$field == $option['value'] )
						echo ' checked=checked';
					echo '><label for='.$elementId.'>'.CHtml::encode($option['label']).'</label>';
					if( in_array($entry['arrange'], array('竖排','vertical')) )
						echo '<br />';
					else
						echo '&nbsp;&nbsp;';
				}
				break;
			case '多项选择题':
			case 'checkbox':
				$v = explode('|', $data->$field);
				foreach($entry['options'] as $option) {
					$elementId = $field.'_'.mt_rand(1000,9999).mt_rand(1000,9999);
					echo '<input id='.$elementId.' type=checkbox name='.$elementId;
					if( in_array($option['value'],$v) )
						echo ' checked=checked';
					echo '><label for='.$elementId.'>'.CHtml::encode($option['label']).'</label>';
					if( in_array($entry['arrange'], array('竖排','vertical')) )
						echo '<br />';
					else
						echo '&nbsp;&nbsp;';
				}
				break;
			case '单行输入':
			case 'text':
			case '多行输入':
			case 'textarea':
				echo CHtml::encode($data->$field);
				break;
		}
		if( $n < count($fields) - 1 )
			echo '<br /><br />';
	}
?>
</div>