<?php
	class H extends Helper {

		public static function img($src,$w=0,$h=0,$alt='',$usemap='') {
			$src = $src == '' || substr($src,0,1)=='.' ? 'images/nopic.gif' : $src;
			if( basename($src) == $src )
				$src = 'images/'.$src;
			if( substr($src,0,1) != '/' )
				$src = '/'.$src;
			$base = dirname(Yii::app()->basePath);
//echo '<div>'.$base.$src.'</div>';
			if( basename($src) != 'nopic.gif' && preg_match('/^([^\x0a]+)(\.[^\.]+)$/', $src, $matched) )
				$src = $matched[1].'-'.Yii::app()->language.$matched[2];
			$src = file_exists($base.$src) ? $src : 'images/nopic.gif';
			$attr = array('border'=>0);
			if( $w > 0 ) $attr['width'] = $w;
			if( $h > 0 ) $attr['height'] = $h;
			if( $usemap != '' ) $attr['usemap'] = $usemap;
			return CHtml::image(Helper::resUrl($src),$alt,$attr);
		}

		public static function m($src,$w=0,$h=0,$alt='',$usemap='') {
			$src = $src == '' || substr($src,0,1)=='.' ? 'images/nopic.gif' : $src;
			if( basename($src) == $src )
				$src = 'images/'.$src;
			if( substr($src,0,1) != '/' )
				$src = '/'.$src;
			$base = dirname(Yii::app()->basePath);
			$src = file_exists($base.$src) ? $src : 'images/nopic.gif';
			$attr = array('border'=>0);
			if( $w > 0 ) $attr['width'] = $w;
			if( $h > 0 ) $attr['height'] = $h;
			if( $usemap != '' ) $attr['usemap'] = $usemap;
			return CHtml::image(Helper::resUrl($src),$alt,$attr);
		}

	}