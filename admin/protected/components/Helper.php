<?php
	class Helper {

		public static function resUrl($src) {
			if( preg_match('/^http/i', $src) )
				return $src;
			if( substr($src,0,1) != '/' )
				$src = '/'.$src;
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
				array('width'=>500, 'height'=>500),
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
			return str_replace('/admin/','/',CHtml::normalizeUrl(array($internalDir)));
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
			return str_replace('/admin/','/',CHtml::normalizeUrl(array($preview)));
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
			if( basename($prefix) == 'admin' )
				$prefix = dirname($prefix);
			$filename = str_replace($prefix, '', $filename);
			return str_replace('/admin/','/',CHtml::normalizeUrl(array($filename)));
			//return Yii::app()->request->hostInfo.$filename;
		}

		public static function getTopChannel() {
			return array('product', 'project', 'download', 'news');
		}

		public static function getChannel($lang='') {
			return Channel::get($lang);
			$lang = $lang == '' ? Yii::app()->language : $lang;
			if( !in_array($lang, array('zh_cn','en','all')) )
				$lang = 'zh_cn';
			$res = array(
				'en' => array(
					'product' => array(
						'p1' => 'Handheld barcode scanner',
						'p3' => '2D Area Imaging Scanner',
						'p2' => 'Hands Free barcode Scanner',
					),
					'project' => array(
						'j1' => 'Retail Terminal',
						'j2' => 'Logistics Management',
						'j3' => 'Medical',
						'j4' => 'Manufacturing',
					),
					'download' => array(
						'picture' => 'Picture',
						'manual' => 'Manual',
						'driver' => 'Driver',
						'adpage' => 'AD Page',
					),
					'news' => array(
						'n1' => 'Corporate News',
						'n2' => 'Product News',
						'n3' => 'Events and exhibitions',
					),
					'about' => array(
						'aboutus' => 'About us',
						'partner' => 'Partner',
						'cooperation' => 'Cooperation',
					),
					'support' => array(
						'contactus' => 'Contact us',
						'qanda' => 'Q & A',
						'question' => 'Ask question',
					),
					'questionnaire' => array(

					),
				),
				'zh_cn' => array(
					'product' => array(
						'p1' => '手持式条码扫描枪',
						'p3' => '手持二维码扫描枪',
						'p2' => '固定式条码扫描器',
					),
					'project' => array(
						'j1' => '零售',
						'j2' => '物流',
						'j3' => '医疗',
						'j4' => '制造',
					),
					'download' => array(
						'picture' => '图片',
						'manual' => '手册',
						'driver' => '驱动',
						'adpage' => '彩页',
					),
					'news' => array(
						'n1' => '公司新闻',
						'n2' => '行业新闻',
						'n3' => '活动与展览',
					),
					'about' => array(
						'aboutus' => '关于我们',
						'partner' => '合作伙伴',
						'cooperation' => '合作申请',
					),
					'support' => array(
						'contactus' => '联系我们',
						'qanda' => '常见问题',
						'question' => '在线提问',
					),
					'questionnaire' => array(

					),
				)
			);
			return $lang=='all' ? $res : $res[$lang];
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
					'link' => Helper::resUrl('/product'),
					'key' => 'product',
				),
				array(
					'label' => Yii::t('project','project'),
					'link' => Helper::resUrl('/project'),
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

		public static function getProvince() {
			return array(
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

		public static function getBusiness() {
			return Yii::app()->language == 'en' ? array(
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
	}