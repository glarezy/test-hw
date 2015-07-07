<?php
	class Helper {
		public static function langSel($lang) {
			$url = Yii::app()->request->hostInfo.Yii::app()->request->baseUrl;
			if( preg_match('/\/en\/*$/', $url) ) {
				if( $lang == 'en' )
					return $url;
				if( $lang == 'zh_cn' )
					return preg_replace('/\/en\/*$/', '', $url);
				return preg_replace('/\/en\/*$/', '/'.$lang.'/', $url);
			} else if( preg_match('/\/ru\/*$/', $url) ) {
				if( $lang == 'ru' )
					return $url;
				if( $lang == 'zh_cn' )
					return preg_replace('/\/ru\/*$/', '', $url);
				return preg_replace('/\/ru\/*$/', '/'.$lang.'/', $url);
			} else {
				if( $lang == 'en' )
					return substr($url,-1) == '/' ? $url.'en/' : $url.'/en/';
				if( $lang == 'ru' )
					return substr($url,-1) == '/' ? $url.'ru/' : $url.'/ru/';
				return $url;
			}
		}

		public static function size($path, $channel) {
			$filename = Helper::shortImg2RealPathImg($path, $channel);
			if( !file_exists($filename) )
				return 0;
			$info = lstat($filename);
			$number = 0;
			$unit = array(
				'T' => 1024*1024*1024*1024,
				'G' => 1024*1024*1024,
				'M' => 1024*1024,
				'K' => 1024,
				'B' => 1,
			);
			foreach($unit as $U => $n) {
				if( $info['size'] > $n ) {
					$number = $info['size'] / $n;
					break;
				}
			}
			return number_format($number, 2, '.', '').' '.$U;
		}

		public static function m($src,$w=0,$h=0,$alt='') {
			$src = $src == '' || substr($src,0,1)=='.' ? 'images/nopic.gif' : $src;
			if( substr($src,0,1) != '/' )
				$src = '/'.$src;
			$base = dirname(Yii::app()->basePath);
			if( basename($base) != 'zh_cn' )
				$base = dirname($base);
			$src = file_exists($base.$src) ? $src : 'images/nopic.gif';
			return CHtml::image(Helper::resUrl($src),$alt,array('width'=>$w,'height'=>$h));
		}

		public static function meta2arr($meta) {
			if( !preg_match_all('/<meta name="([^<>"]*)" content="([^<>"]*)"[^<>]*>/i', $meta, $matched)
				|| !isset($matched[1]) || !isset($matched[2]) )
				return array();
			$data = array();
			foreach($matched[1] as $n => $val)
				$data[] = array(
					'name' => $val,
					'content' => $matched[2][$n],
				);
			return $data;
		}

		public static function regMeta($meta) {
			if( is_array($meta) )
			foreach($meta as $entry) {
				if( !isset($entry['content']) || !isset($entry['name']) )
					continue;
				Yii::app()->clientScript->registerMetaTag($entry['content'],$entry['name']);
			}
		}

		public static function resUrl($src) {
			if( preg_match('/^http/i', $src) )
				return $src;
			if( substr($src,0,1) != '/' )
				$src = '/'.$src;
			if( $src == '/' )
				return Yii::app()->request->hostInfo.Yii::app()->request->baseUrl;
			return CHtml::normalizeUrl(array($src));
			//return Yii::app()->request->hostInfo.Yii::app()->request->baseUrl.$src;
		}

		public static function attachmentImgSrc() {
			return CHtml::normalizeUrl(array('/images/attachment.jpg'));
			//return Yii::app()->request->hostInfo.Yii::app()->request->baseUrl.'/images/attachment.jpg';
		}

		public static function yesOrNo($flag) {
			return $flag ? Yii::t('common','yes') : Yii::t('common','no');
		}

		public static function getSubChannelName($channel, $value) {
			$channels = Helper::getChannel();
			return isset($channels[$channel][$value]) ? $channels[$channel][$value] : '';
		}

		public static function getImgSize() {
			return array(
				array('width'=>50, 'height'=>50),
				array('width'=>90, 'height'=>90),
			);
		}

		public static function deleteImg($filename) {
			$imgSet = Helper::getImgSet($filename);
			if( @unlink($filename) ) {
				foreach($imgSet as $f)
					@unlink($f);
				return true;
			}
			return false;
		}

		public static function deleteTmpIdx($shortImpIdx,$channel) {
			$idxFile = Helper::getAttachmentRealPath().'/'.$channel.'/tmp/'.basename($shortImpIdx);
			return @unlink($idxFile);
		}

		public static function clearTmp($channel) {
			$lifetime = 3600*24;
			if( ! in_array($channel, Helper::getTopChannel()) )
				return false;
			$dname = Helper::getAttachmentRealPath().'/'.$channel.'/tmp';
			if( $dname == '//tmp' )
				return false;
			$d = dir($dname);
			while (false !== ($entry = $d->read())) {
				if( $entry == '.' || $entry == '..' )
					continue;
				$filename = $dname.'/'.$entry;
				$info = lstat($filename);
				if( $info['ctime'] + $lifetime > time() )
					continue;
				$imgfile = Helper::tmp2img($filename);
				Helper::deleteImg($imgfile);
			}
			$d->close();
			return true;
		}

		public static function shortImg2RealPathImg($shortImg, $channel) {
			return Helper::getAttachmentRealPath().'/'.$channel.$shortImg;
		}

		public static function shortImg2ImgUrl($shortImg, $channel) {
			$internalDir = Helper::getAttachmentPath().'/'.$channel.$shortImg;
			return str_replace(array('/en/','/ru/'),'/',CHtml::normalizeUrl(array($internalDir)));
			//return Yii::app()->request->hostInfo.$internalDir;
		}

		public static function shortImg2BaseTmp($shortImg) {
			$name = basename($shortImg);
			$dir = basename(dirname($shortImg));
			return $dir.'_'.$name.'.idx';
		}

		public static function shortImg2Preview($shortImg, $channel, $width=50, $height=50) {
			if( ! preg_match('/^([^\x0D\x0A]+)\.([^\.]+)$/', $shortImg, $matched) )
				return '';
			$prefix = substr($matched[1],0,1) == '/' ? substr($matched[1],1) : $matched[1];
			$postfix = $matched[2];
			$preview = '/'.basename(Helper::getAttachmentRealPath()).'/'.$channel.'/'.$prefix.'_'.$width.'_'.$height.'.'.$postfix;
			return str_replace(array('/en/','/ru/'),'/',CHtml::normalizeUrl(array($preview)));
			//return Yii::app()->request->hostInfo.$preview;
		}

		public static function shortTmp2ShortImg($shortFileName, $channel) {
			$tf = Helper::getRealPath4Tmp($shortFileName, $channel);
			$if = Helper::tmp2img($tf);
			return str_replace(Helper::getAttachmentRealPath(), '', $if);
		}

		public static function getRealPath4Tmp($shortFileName, $channel) {
			if( ! in_array($channel, Helper::getTopChannel()) )
				return '';
			return Helper::getAttachmentRealPath().'/'.$channel.'/'.$shortFileName;
		}

		public static function img2tmp($filename) {
			return dirname(dirname($filename)).'/tmp/'.basename(dirname($filename)).'_'.basename($filename).'.idx';
		}

		public static function tmp2img($filename) {
			$filename = substr($filename, 0, strlen($filename)-strlen('.idx'));
			$td = preg_match('/^([^_]+)_/', basename($filename), $matched) ? $matched[1] : '';
			return dirname(dirname($filename)).'/'.$td.'/'.substr(basename($filename),strlen($td)+1);
		}

		public static function getImgSet($filename) {
			$size = Helper::getImgSize();
			$files = array();
			if( ! preg_match('/^([^\x0D\x0A]+)\.([^\.]+)$/', $filename, $matched) )
				return $files;
			$prefix = $matched[1];
			$postfix = $matched[2];
			foreach($size as $entry) {
				$files[] = $prefix.'_'.$entry['width'].'_'.$entry['height'].'.'.$postfix;
			}
			return $files;
		}

		public static function getAttachmentRealPath() {
			return str_replace("\\","/",dirname(dirname(Yii::app()->basePath))).'/attachment';
		}

		public static function getAttachmentUrl($filename) {
			$prefix = str_replace("\\","/",dirname(Yii::app()->basePath));
			if( basename($prefix) != 'zh_cn' )
				$prefix = dirname($prefix);
			$filename = str_replace($prefix, '', $filename);
			return str_replace(array('/en/','/ru/'),'/',CHtml::normalizeUrl(array($filename)));
			//return Yii::app()->request->hostInfo.$filename;
		}

		public static function getTopChannel() {
			return array('product', 'project', 'download', 'news');
		}

		public static function getChannel($lang='') {
			return Channel::get($lang);
		}

		public static function getBusiness() {
			return Yii::app()->language == 'en' || Yii::app()->language == 'ru' ? array(
				'retail' => 'retail',
				'medical' => 'medical',
				'logistics' => 'logistics',
				'warehouse management' => 'warehouse management',
				'others' => 'others',
			) : array(
				'retail' => '零售',
				'medical' => '医疗',
				'logistics' => '物流',
				'warehouse management' => '仓库管理',
				'others' => '其他',
			);
		}

		public static function getNav() {
			return array(
				array(
					'label' => Yii::t('home','home'),
					'link' => Helper::resUrl('/'),
					'key' => 'home',
				),
				array(
					'label' => Yii::t('product','product'),
					'link' => Helper::resUrl('/products'),
					'key' => 'product',
				),
				array(
					'label' => Yii::t('project','project'),
					'link' => Helper::resUrl('/solutions'),
					'key' => 'project',
				),
				array(
					'label' => Yii::t('download','download'),
					'link' => Helper::resUrl('/download'),
					'key' => 'download',
				),
				array(
					'label' => Yii::t('news','news'),
					'link' => Helper::resUrl('/news'),
					'key' => 'news',
				),
				array(
					'label' => Yii::t('about','about'),
					'link' => Helper::resUrl('/about'),
					'key' => 'about',
				),
				array(
					'label' => Yii::t('contact','contact'),
					'link' => Helper::resUrl('/support'),
					'key' => 'support',
				),
			);
		}

		public static function getLeftTree($channelName='') {
			$nav = Helper::getNav();
			if( $channelName == '' )
				return $nav;
			$channel = Helper::getChannel();
			foreach($nav as $n => $entry) {
				if( !isset($channel[$entry['key']])
					|| !is_array($channel[$entry['key']])
					|| $channelName != $entry['key'] )
					continue;
				$l1 = $entry['key'];
				switch( $entry['key'] ) {
					case 'project': $l1 = 'solutions';break;
					case 'product': $l1 = 'products';break;
				}
				if( $l1 == 'solutions' ) {
					$nav[$n]['sub'] = array();
					continue;
				}
				foreach($channel[$entry['key']] as $subtype => $subentry) {
					$l2 = CHtml::encode($subtype);
					$urlDirt = '';
					if( $entry['key'] == 'about' ) {
						if( $subtype == 'partner' )
							$l2 = 'partners';
						if( $subtype == 'cooperation' )
							$l2 = 'apply_a_partner';
						if( $subtype == 'patents' )
							$urlDirt = 'http://www.hsmpats.com';
					}
					if( $entry['key'] == 'support' ) {
						if( $subtype == 'qanda' )
							$l2 = 'FAQ';
						if( $subtype == 'question' )
							$l2 = 'online_support';
						if( $subtype == 'aftermarket' )
							$l2 = 'repair';
						if( $subtype == 'warranty' )
							$l2 = 'warranty';
					}
					//if( $subtype == 'cooperation' || $subtype == 'question' )
					//	$link = Helper::resUrl($subtype);
					//else
						$link = Helper::resUrl($l1.'/'.$l2);
					if( $urlDirt != '' )
						$link = $urlDirt;
					$nav[$n]['sub'][$subtype] = array(
						'label' => $subentry,
						'link' => $link,
						'target' => $urlDirt == '' ? '' : '_blank',
					);
				}
			}
			return $nav;
		}

		public static function getAttachmentPath() {
			return '/attachment';
		}

		public static function getStoragePath() {
			$p = Helper::getAttachmentPath();
			return array(
				'product' => array(
					'cur' => $p.'/product',
					'tmp' => $p.'/product/tmp',
				),
				'project' => array(
					'cur' => $p.'/project',
					'tmp' => $p.'/project/tmp',
				),
				'download' => array(
					'cur' => $p.'/download',
					'tmp' => $p.'/download/tmp',
				),
				'news' => array(
					'cur' => $p.'/news',
					'tmp' => $p.'/news/tmp',
				),
			);
		}

		public static function getProvince() {
			return Yii::app()->language == 'en' || Yii::app()->language == 'ru' ? array(
				"Select Region",
				"Beijing"=>"Beijing",
				"Shanghai"=>"Shanghai",
				"Tianjin"=>"Tianjin",
				"chongqing"=>"chongqing",
				"guangdong"=>"guangdong",
				"sichuan"=>"sichuan",
				"zhejiang"=>"zhejiang",
				"guizhou"=>"guizhou",
				"liaoning"=>"liaoning",
				"jiangsu"=>"jiangsu",
				"fujian"=>"fujian",
				"hebei"=>"hebei",
				"henan"=>"henan",
				"jilin"=>"jilin",
				"heilongjiang"=>"heilongjiang",
				"shandong"=>"shandong",
				"anhui"=>"anhui",
				"guangxi"=>"guangxi",
				"hainan"=>"hainan",
				"neimenggu"=>"neimenggu",
				"shanxi2"=>"shanxi",
				"ningxia"=>"ningxia",
				"gansu"=>"gansu",
				"shanxi"=>"shanxi",
				"qinghai"=>"qinghai",
				"hubei"=>"hubei",
				"hunan"=>"hunan",
				"jiangxi"=>"jiangxi",
				"yunnan"=>"yunnan",
				"xinjiang"=>"xinjiang",
				"xizang"=>"xizang",
			) : array(
				"请选择地区",
				"北京"=>"北京",
				"上海"=>"上海",
				"天津"=>"天津",
				"重庆"=>"重庆",
				"广东"=>"广东",
				"四川"=>"四川",
				"浙江"=>"浙江",
				"贵州"=>"贵州",
				"辽宁"=>"辽宁",
				"江苏"=>"江苏",
				"福建"=>"福建",
				"河北"=>"河北",
				"河南"=>"河南",
				"吉林"=>"吉林",
				"黑龙江"=>"黑龙江",
				"山东"=>"山东",
				"安徽"=>"安徽",
				"广西"=>"广西",
				"海南"=>"海南",
				"内蒙古"=>"内蒙古",
				"山西"=>"山西",
				"宁夏"=>"宁夏",
				"甘肃"=>"甘肃",
				"陕西"=>"陕西",
				"青海"=>"青海",
				"湖北"=>"湖北",
				"湖南"=>"湖南",
				"江西"=>"江西",
				"云南"=>"云南",
				"新疆"=>"新疆",
				"西藏"=>"西藏",
			);
		}
	}