<?php

	class UploadAttachment extends UploadBase {
		public $filetype;

		function allowFileType($type) {
			$this->filetype = $type;
			return true;
		}

		function getFilename() {
			return $this->filename ? $this->filename : '';
		}
/*
		function getNewFileName($filename) {
			$filename = preg_replace('/[\x5c\x2f\x2a\x22\x3c\x3e\x7c\x3a]+/', '', $filename);
			$filename = str_replace(' ', '_', $filename);
			return preg_match('/^([^\x0a]+)\.([^\.]+)$/', $filename, $m) ? $m[1].'.'.$m[2] : mt_rand(1000, 9999).mt_rand(1000, 9999).'.dat';
		}
*/
		function isPicture() {
			return substr($this->filetype, 0, strlen('image')) == 'image';
		}

	}