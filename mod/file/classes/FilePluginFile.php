<?php

/**
 * Override the ElggFile
 */
class FilePluginFile extends ElggFile {
	protected function  initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "file";
	}

	public function __construct($guid = null) {
		parent::__construct($guid);
	}

	public function delete() {

		$thumbnails = array($this->thumbnail, $this->smallthumb,$this->mediumthumb, $this->largethumb);
		foreach ($thumbnails as $thumbnail) {
			if ($thumbnail) {
				$delfile = new ElggFile();
				$delfile->owner_guid = $this->owner_guid;
				$delfile->setFilename($thumbnail);
				$delfile->delete();
			}
		}

		return parent::delete();
	}
        
         public function getThumbnail($size) {
		switch ($size) {
			case 'thumb':
				$thumb = $this->thumbnail;
				break;
			case 'small':
				$thumb = $this->smallthumb;
				break;
			case 'medium':
				$thumb = $this->mediumthumb;
				break;
			case 'large':
				$thumb = $this->largethumb;
				break;
			default:
				return '';
				break;
		}

		if (!$thumb) {
			return '';
		}

		$file = new ElggFile();
		$file->owner_guid = $this->getOwnerGUID();
		$file->setFilename($thumb);
		return $file->grabFile();
	}

	public function getImage() {
		return $this->grabFile();
	}

}
