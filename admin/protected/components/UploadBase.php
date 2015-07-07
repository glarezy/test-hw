<?php

	class UploadBase {
		public $inputName;
		public $channel;
		public $attachment;
		public $filename;

		function UploadBase($channel) {
			$this->channel = $channel;
			$this->inputName = 'upload_file';
			$this->attachment = Helper::getAttachmentRealPath();
		}

		function getStoragePath() {
			return $this->attachment.'/'.$this->channel.'/'.date('Ymd',time());
		}

		function getNewFileName($filename) {
			$type = preg_match('/\.([^\.]+)$/', $filename, $matched) ? $matched[1] : 'jpg';
			return mt_rand(1000, 9999).mt_rand(1000, 9999).'.'.$type;
		}

		function paraValid() {
			return $this->inputName != '' && in_array($this->channel, Helper::getTopChannel());
		}

		function fmove($from , $to) {
			if( ! file_exists($from) )
				return false;
			$dname = explode('/', dirname($to));
			$cur = '';
			$start = 0;

			foreach($dname as $d) {
				if( $d == 'attachment' )
					$start = 1;
				if( $d == '' )
					continue;
				if( $cur == '' && strstr($d, ':') ) {
					$cur = $d;
					continue;
				}
				$cur.= '/'.$d;
				if( $start == 0 )
					continue;
				if( file_exists($cur) )
					continue;

				if( mkdir($cur) === false)
					return false;
			}

			if (!$handle = fopen($to, 'w'))
				return false;

			if (fwrite($handle, file_get_contents($from)) === FALSE) {
				fclose($handle);
				return false;
			}
			fclose($handle);

			return file_exists($to);
		}

		function fcreate($filename) {
			$dname = explode('/', dirname(realpath($filename)));
			$cur = '';
			foreach($dname as $d) {
				if( $d == '' )
					continue;
				$cur.= '/'.$d;
				if( file_exists($cur) )
					continue;
				if( mkdir($cur) === false)
					return false;
			}
			return touch($filename);
		}

		function save() {
			if( ! $this->paraValid() )
				return false;

			foreach($_FILES as $name => $file) {
				if( $name == $this->inputName ) {
					if( $file['size'] == 0 || $file['error']
						|| !$this->allowFileType($file['type']) )
						continue;
					$this->filename = $file['name'];
					$filedir = $this->getStoragePath();
					$filename = $this->getNewFileName($file['name']);
					$filepath = $filedir.'/'.$filename;
					if( $this->fmove($file['tmp_name'], $filepath) === false )
						return false;
					$this->fcreate(Helper::img2tmp($filepath));
					return $filepath;
					break;
				}
			}

			return false;
		}

		function allowFileType($type) {
			return substr($type, 0, strlen('image')) == 'image';
		}

		function createTmpIndex() {

		}
	}