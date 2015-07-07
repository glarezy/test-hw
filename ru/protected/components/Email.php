<?php
	class Email {

		var $localhost;
		var $smtp_accname;
		var $smtp_password;
		var $smtp_host;
		var $smtp_port;
		var $from;
		var $lang;

		function log($str) {
			return;
		}

		function send($to, $msg) {
			$localhost = $this->localhost;
			$smtp_accname = $this->smtp_accname;
			$smtp_password = $this->smtp_password;
			$smtp_host = $this->smtp_host;
			$from = $this->from;
			$port = intval($this->smtp_port);
			if( $port == '' )
				$port = 25;

			$lb = "\r\n";

			$smtp[] = array("EHLO ".$localhost.$lb, "220,250", "EHLO error: ");
			$smtp[] = array("AUTH LOGIN".$lb, "334", "AUTH error: ");
			$smtp[] = array(base64_encode($smtp_accname).$lb, "334", "AUTHENTIFICATION error: ");
			$smtp[] = array(base64_encode($smtp_password).$lb, "235", "AUTHENTIFICATION error: ");
			$smtp[] = array("MAIL FROM: <".$from.">".$lb, "250", "MAIL FROM error: ");
			$tos = explode(",", $to);
			foreach($tos as $val)
			   $smtp[] = array("RCPT TO: <".trim($val).">".$lb, "250", "RCPT TO error: ");
			$smtp[] = array("DATA".$lb, "354", "DATA error: ");
			$arr = explode("\n", trim($msg));
			foreach($arr as $val)
				$smtp[] = array(rtrim($val).$lb, "", "");
			$smtp[] = array(".".$lb, "250", "DATA(end)error: ");
			$smtp[] = array("QUIT".$lb, "", "");

			ini_set('max_execution_time', 0);

			$fp = @fsockopen($smtp_host, $port);
			$this->log("smtp connect ".$smtp_host.":".$port);
			if (!$fp) {
				$this->log("Error: connect failed");
				return false;
			}

			while ($result = @fgets($fp, 1024)) {
				$this->log('==>>'.$result);
				if (substr($result, 3, 1) == " ") {
					break;
				}
			}

			$result_str = array();
			foreach ($smtp as $req) {
				if( strlen($req[1]) )
					$this->log('<<=='.$req[0]);
				@fputs($fp, $req[0]);
				if ($req[1]) {
					while ($result = @fgets($fp, 1024)) {
						if (substr($result, 3, 1) == " ") {
							break;
						}
					};
					$this->log('==>>'.$result);
					if (!strstr($req[1], substr($result, 0, 3))) {
						$result_str[] = $req[2].$result;
					}
				}
			}
			@fclose($fp);
			$this->log(implode("\n", $result_str));
			return true;
		}

		function setSmtp_port($port) {
			$this->smtp_port = $port;
		}

		function setLocalhost($localhost) {
		   $this->localhost = $localhost;
		}

		function setSmtp_accname($smtp_accname) {
		   $this->smtp_accname = $smtp_accname;
		}

		function setSmtp_password($smtp_password) {
		   $this->smtp_password = $smtp_password;
		}

		function setSmtp_host($smtp_host) {
		   $this->smtp_host = $smtp_host;
		}

		function setFrom($from) {
		   $this->from = $from;
		}

		function setTo($to) {
		   $this->to = explode(',', $to);
		}
	}
