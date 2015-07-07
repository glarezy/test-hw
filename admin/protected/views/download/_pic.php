<li><?php
echo CHtml::link(
	CHtml::image(Helper::shortImg2Preview($data->path, 'download', 90, 90)),
	array('download/'.$data->id)
);
?></li>
