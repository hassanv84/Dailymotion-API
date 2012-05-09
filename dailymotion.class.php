<?php
/**
 * Unofficial Dailymotion API 
 *
 *
 * @copyright  Copyright (c) 2012, Antoine Bagnaud
 * @license    http://www.gnu.org/licenses/gpl.txt	GPL
 * @author     Antoine Bagnaud <ipodtouchpro44@gmail.com>
 * @version    1.0 2012-05-08  
 */
class Dailymotion{
	private $_id;
	private $_infos;

	public function __construct($id){
    	$this->_id = $id;
    	if(empty($this->_id)){
    		die('Invalid video ID');
    	}
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, "http://www.dailymotion.com/sequence/full/".$this->_id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	    
		$this->_infos = json_decode(curl_exec($ch));
		if($this->_infos == false){
			die('Invalid video ID');
		}
    }

	public function getVideoPreviewUrl(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoPreviewURL)?$this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoPreviewURL:false;
	}

	public function getVideoId(){
		return $this->_id;
	}

	public function getVideoTitle(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoTitle)?$this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoTitle:false;
	}

	public function getVideoDescription(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoDescription)?$this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoDescription:false;
	}

	public function getVideoTags(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoTags)?$this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoTags:false;
	}

	public function getVideoUniqueUrl(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoUniqueURL)?$this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoUniqueURL:false;
	}

	public function getVideoOwnerLogin(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoOwnerLogin)?$this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoOwnerLogin:false;
	}

	public function getVideoLang(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoLang)?$this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoLang:false;
	}

	public function getVideoUploadDateTime(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoUploadDateTime)?$this->_infos[0]->layerList[0]->sequenceList[0]->layerList[0]->param->extraParams->videoUploadDateTime:false;
	}

	public function getVideoDuration(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[1]->layerList[0]->param->metadata->duration)?$this->_infos[0]->layerList[0]->sequenceList[1]->layerList[0]->param->metadata->duration:false;
	}

	public function getVideoCategory(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[1]->layerList[0]->param->metadata->category)?$this->_infos[0]->layerList[0]->sequenceList[1]->layerList[0]->param->metadata->category:false;
	}

	public function getSdMediaUrl(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[1]->layerList[2]->param->sdURL)?$this->_infos[0]->layerList[0]->sequenceList[1]->layerList[2]->param->sdURL:false;
	}

	public function getHdMediaUrl(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[1]->layerList[2]->param->hqURL)?$this->_infos[0]->layerList[0]->sequenceList[1]->layerList[2]->param->hqURL:false;
	}
	
	public function getHd720MediaUrl(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[1]->layerList[2]->param->hd720URL)?$this->_infos[0]->layerList[0]->sequenceList[1]->layerList[2]->param->hd720URL:false;
	}
	
	public function getHd1080MediaUrl(){
		return isset($this->_infos[0]->layerList[0]->sequenceList[1]->layerList[2]->param->hd1080URL)?$this->_infos[0]->layerList[0]->sequenceList[1]->layerList[2]->param->hd1080URL:false;
	}

	public function getBestQuality(){
		if($this->getHd1080MediaUrl()){
			return $this->getHd1080MediaUrl();
		}elseif($this->getHd720MediaUrl()){
			return $this->getHd720MediaUrl();
		}elseif($this->getHdMediaUrl()){
			return $this->getHdMediaUrl();
		}else{
			return $this->getSdMediaUrl();
		}
	}

	public function downloadVideo($video){
			$e = explode('?', $video);
			header("Cache-Control: no-cache");
			header("Content-type: video/mp4");
			header('Content-Disposition: attachment; filename="'.utf8_decode(basename($e[0])));
			readfile($video);	
	}

    public function getVideoTimeConverted(){
	    if($this->getVideoDuration() < 86400 && $this->getVideoDuration()>=3600){
		    $h = floor($this->getVideoDuration()/3600);
		    $re = $this->getVideoDuration()%3600;
		    $m = floor($re/60);
		    $s = $re%60;
		    $ret = $h.':'.$m.':'.$s;
	    }elseif ($this->getVideoDuration()<3600 && $this->getVideoDuration()>=60){
		    $m = floor($this->getVideoDuration()/60);
		    $s = $this->getVideoDuration()%60;
		    $ret = $m.':'.$s;
	    }elseif ($this->getVideoDuration() < 60){
	    	$ret = $this->getVideoDuration().'s';
	    }
	    return $ret;
    }

    public function getVideoUploadDateTimeRelative() {
    $time = time() - strtotime($this->getVideoUploadDateTime());
    if ($time > 0) {
        $when = "there are";
    }else{
        return "there was less than a second";
    }
    $time = abs($time);
    $times = array( 31104000 => 'year{s}',
                    2592000 => 'months{s}',
                    86400 => 'day{s}',
                    3600 => 'hour{s}',
                    60 => 'minute{s}',
                    1 => 'second{s}');

    foreach ($times as $seconds => $unit) {
        $delta = round($time / $seconds);

        if ($delta >= 1) {
            if ($delta == 1) {
                $unit = str_replace('{s}', '', $unit);
            } else {
                $unit = str_replace('{s}', 's', $unit);
            }
            return $when." ".$delta." ".$unit;
        }
    }
}

	public function insertPlayImage($img){
		header("Content-type: image/jpg"); 
		$thumb = imagecreatefromjpeg($this->getVideoPreviewURL());
		imagealphablending($thumb, true);
		$play = imagecreatefrompng($img);
		$logoW = imagesx($play);
		$logoH = imagesy($play);
		imagecopy($thumb, $play, ((imagesx($thumb)/2)-($logoW/2)), ((imagesy($thumb)/2)-($logoH/2)), 0, 0, $logoW, $logoH);
		imagejpeg($thumb);
		imagedestroy($thumb);
		imagedestroy($play);
	}

}