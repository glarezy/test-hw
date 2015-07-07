<?php
	class Eml {
		var $from = 'honeywell_admin@163.com';
		var $to = '';

		function getMessage($to, $area,$email,$question, $type='') {
			switch($type) {
				default:
				case 'question':
					$title = '提交了以下问题';
					$subject = '优解网站在线提问';
					break;
				case 'buy':
					$title = '提交了以下购买需求信息';
					$subject = '优解网购买需求信息';
					break;
			}
			$html = '<html><head><style>div{padding:20px; font-size:12pt;}</style></head><body>';
			$html.= '<p style="font-size:12pt;margin:25px;line-height:30px;">用户 '.htmlspecialchars($email,ENT_QUOTES,'utf-8').' '.$title.'：</p>';
			$html.= '<p style="font-size:12pt;margin:25px;line-height:30px;">'.htmlspecialchars($question,ENT_QUOTES,'utf-8').'</p>';
			$html.= '</body></html>';
			$html = wordwrap(base64_encode($html), 76, "\r\n", true);

			$header = array();
			$header[] = 'Message-ID: <'.md5(time()).'@'.substr(md5('simen'), 0, 12).'>';
			$header[] = 'From: '.$this->from;
			$header[] = 'To: '.$to;
			$header[] = 'Subject: =?UTF-8?B?'.base64_encode($subject.'---来自< '.$email.' >').'?=';
			$header[] = 'Date: '.date('r');
			$header[] = 'Content-Type: text/html;';
			$header[] = '	charset="utf-8"';
			$header[] = 'Content-Transfer-Encoding: base64';

			return implode("\r\n", $header)."\r\n\r\n".$html;
		}

		function send($area,$email,$question,$type='') {
			$this->to = array(
				'huabei' => 'Marcom@youjieaidc.com',
				'huadong' => 'Marcom@youjieaidc.com',
				'huanan' => 'Marcom@youjieaidc.com',
			);
			if( !isset($this->to[$area]) )
				$area = 'huabei';

			$mail = new Email();
			$mail->setSmtp_accname($this->from);
			$mail->setSmtp_password('21232f297a');
			$mail->setLocalhost('www.honeywell.com');
			$mail->setSmtp_host('smtp.163.com');
			$mail->setSmtp_port('25');
			$mail->setFrom($this->from);
			$msg = $this->getMessage('Derek.Wong@Honeywell.com', $area,$email,$question,$type);
			return $mail->send($this->to[$area], $msg);
		}

	}
