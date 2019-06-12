<?php
class ApiSdkModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('DbUtil');
    }

    public function getSdkCfgByAppId($arrParams) {
        $arrWhere = [
            'select' => '*',
            'where' => "app_id='".$arrParams['app_id']."'",
        ];
        $arrRet = $this->dbutil->getSdkData($arrWhere);
        if($arrRet) {
            return json_decode($arrRet[0]['data'], true);
        }
        return false;
	}

	public function getMediaInfo($arrParams){
		$arrWhere = [
			'select' => 'app_id_map,app_secret',
			'where' => 'app_id = "'.$arrParams['appId'].'" AND media_delivery_method = "API"',
			'limit' => '0,1',
		];
		$arrRes = $this->dbutil->getMedia($arrWhere);
		if($arrRes){
			$appKey = json_decode($arrRes[0]['app_id_map'],true);
			$arrRes[0]['app_key'] = $appKey['TUIA'];
			unset($arrRes[0]['app_id_map']);
			return $arrRes;
		}
		return false;
	}

	public function getUpstreamSlotId($arrParams){
		$arrWhere = [
			'select' => 'upstream_slot_id',
			'where' => 'app_id = "'.$arrParams['appId'].'" AND slot_id = "'.$arrParams['adslotId'].'"',
			'limit' => '0,1',
		];
		$arrRes = $this->dbutil->getAdslotMap($arrWhere);
		if($arrRes){
			return $arrRes[0]['upstream_slot_id'];
		}
		return false;
	}
}
