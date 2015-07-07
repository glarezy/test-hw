<?php
	class Channel {
		public static function keyValid($key) {
			return preg_match('/^[a-zA-Z][0-9a-zA-Z]*$/', $key);
		}

		public static function addSub($l1,$info) {
			if( !Channel::keyValid($info['key']) )
				return 'validkey';
			$res = Channel::get('all');
			if( !isset($res['zh_cn'][$l1]) || !isset($res['en'][$l1]) )
				return 'paraerror';

			if( isset($res['zh_cn'][$l1][$info['key']]) || isset($res['en'][$l1][$info['key']]) )
				return 'keyexists';

			$res['zh_cn'][$l1][$info['key']] = $info['cnname'];
			$res['en'][$l1][$info['key']] = $info['enname'];

			return Channel::save($res);
		}

		public static function modSub($l1,$l2,$info) {
			if( !Channel::keyValid($info['key']) )
				return 'validkey';
			$res = Channel::get('all');

			if( !isset($res['zh_cn'][$l1]) || !isset($res['en'][$l1])
				|| !isset($res['zh_cn'][$l1][$l2]) || !isset($res['en'][$l1][$l2]) )
				return 'paraerror';

			if( $info['key'] != $l2 ) {
				if( isset($res['zh_cn'][$l1][$info['key']]) || isset($res['en'][$l1][$info['key']]) )
					return 'keyexists';
				unset($res['zh_cn'][$l1][$l2]);
				unset($res['en'][$l1][$l2]);
				$l2 = $info['key'];
			}

			$res['zh_cn'][$l1][$l2] = $info['cnname'];
			$res['en'][$l1][$l2] = $info['enname'];

			return Channel::save($res);
		}

		public static function delSub($l1,$l2) {
			$res = Channel::get('all');
			if( !isset($res['zh_cn'][$l1]) || !isset($res['en'][$l1])
				|| !isset($res['zh_cn'][$l1][$l2]) || !isset($res['en'][$l1][$l2]) )
				return 'paraerror';
			unset($res['zh_cn'][$l1][$l2]);
			unset($res['en'][$l1][$l2]);

			return Channel::save($res);
		}

		public static function save($info) {
			$filename = Channel::storePath().'/info.dat';
			if (!$handle = fopen($filename, 'w')) {
				return false;
		    }

		    if (fwrite($handle, serialize($info)) === FALSE) {
		        return false;
		    }

		    fclose($handle);
		    return true;
		}

		public static function get($lang='') {
			$default = Channel::getDefault();
			$filename = Channel::storePath().'/info.dat';
			$info = file_exists($filename) ? unserialize(file_get_contents($filename)) : $default;
			if( $lang == '' )
				$lang = Yii::app()->language;
			if( !isset($info[$lang]) && isset($default[$lang]) ) {
				$info[$lang] = $default[$lang];
				Channel::save($info);
			}
			//$info['ru'] = $info['en'];
			//Channel::save($info);
			$info['zh_cn']['about'] = $default['zh_cn']['about'];
			$info['zh_cn']['support'] = $default['zh_cn']['support'];
			$info['en']['about'] = $default['en']['about'];
			$info['en']['support'] = $default['en']['support'];
			$info['ru']['about'] = $default['ru']['about'];
			$info['ru']['support'] = $default['ru']['support'];
			if( $lang == 'all' )
				return $info;
			if( isset($info[$lang]) )
				return $info[$lang];
			return $info['zh_cn'];
		}

		public static function storePath() {
			return str_replace("\\","/",dirname(dirname(Yii::app()->basePath))).'/channel';
		}

		public static function getDefault() {
			return array(
				'ru' => array(
					'product' => array(
						'p1' => 'Handheld barcode scanner',
						'p2' => 'Hands Free barcode Scanner',
						'p3' => '2D Area Imaging Scanner',
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
						'aboutus' => 'О компании',
						'patents' => 'Patents link',
						'partner' => 'Partner',
						'cooperation' => 'Cooperation',
					),
					'support' => array(
						'contactus' => 'Контакты',
						//'qanda' => 'FAQ',
						//'question' => 'Online Support',
						//'aftermarket' => 'Repair Contact',
					),
					'questionnaire' => array(

					),
				),
				'en' => array(
					'product' => array(
						'p1' => 'Handheld barcode scanner',
						'p2' => 'Hands Free barcode Scanner',
						'p3' => '2D Area Imaging Scanner',
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
						'patents' => 'Patents link',
						'partner' => 'Partner',
						'cooperation' => 'Become a Partner',
					),
					'support' => array(
						'contactus' => 'Contact us',
						//'qanda' => 'FAQ',
						//'question' => 'Online Support',
						//'aftermarket' => 'Repair Contact',
					),
					'questionnaire' => array(

					),
				),
				'zh_cn' => array(
					'product' => array(
						'p1' => '手持式条码扫描枪',
						'p2' => '固定式条码扫描器',
						'p3' => '手持二维码扫描枪',
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
						'patents' => '专利技术',
						'partner' => '合作伙伴',
						'cooperation' => '合作申请',
					),
					'support' => array(
						'contactus' => '联系我们',
						//'qanda' => '常见问题',
						'question' => '在线提问',
						'aftermarket' => '产品维修',
						'warranty' => '产品保修',
					),
					'questionnaire' => array(

					),
				)
			);
		}

	}