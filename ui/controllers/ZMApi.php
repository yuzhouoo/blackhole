<?php
class ZMApi extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ZMengAdApiModel');
    }

    public function index() {
		$test = intval($this->input->get('test'));
		$jsonParams = file_get_contents("php://input");
		$jsonRes = $this->ZMengAdApiModel->getZMengAd($jsonParams, $test);
		echo $jsonRes;
    }
}
