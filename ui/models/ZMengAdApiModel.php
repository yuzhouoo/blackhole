<?php
class ZMengAdApiModel extends CI_Model {
    public function __construct() {
        parent::__construct();
		$this->load->library('Curl');
		$this->config->load('zhimeng_conf');
	}

	public function getZMengAd($jsonParams, $test = 1) {
		$arrConfig = $test == 1 ? $this->config->item('zhimeng')['test'] : $this->config->item('zhimeng')['online'];
		if($test != 1) {
			$arrParams = json_decode($jsonParams, true);
			if (!in_array($arrParams['reqInfo']['accessToken'], $this->config->item('zhimeng')['valid_access_token'])) {
				return '{"errorCode":100000}';			
			} else {
				$arrParams['reqInfo']['accessToken'] = $arrConfig['token']; 
				$jsonParams = json_encode($arrParams);
			}
		}

		$url = sprintf('http://%s%s', $arrConfig['host'], $arrConfig['url_path']);
		$this->curl->create($url);
		$this->curl->http_header('content-type', 'application/json;charset=utf-8');
		$this->curl->option('POST', 1);
		$this->curl->option('POSTFIELDS', $jsonParams);
		$jsonRes = $this->curl->execute();
		return $jsonRes;
	}
}
