<?php
class ApiGetQuestion extends MY_Controller {

    const ARR_TYPES = [
        '历史文艺',
        '疯狂科学',
        '清奇脑洞',
        '趣问八卦',
    ];

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->config('activity_question');
        $strType = self::ARR_TYPES[mt_rand(0,3)];
        $arrQuestions = $this->config->item('activity_question');
        $arrQuestions = $arrQuestions[$strType];
        $arrQuestion = $arrQuestions[mt_rand(0,count($arrQuestions)-1)];
        if (mt_rand(0,1)) {
            $arrRes = [
                'type' => $strType,
                'question' => $arrQuestion[0],
                'A' => $arrQuestion[2],
                'B' => $arrQuestion[1],
                'search_url' => 'https://m.baidu.com/s?wd=' . urlencode($arrQuestion[3]) . '&ref=www_colorful&tn=iphone&from=1018279e',
                'r' => 'B',
            ];
        } else {
            $arrRes = [
                'type' => $strType,
                'question' => $arrQuestion[0],
                'A' => $arrQuestion[1],
                'B' => $arrQuestion[2],
                'search_url' => 'https://m.baidu.com/s?wd=' . urlencode($arrQuestion[3]) . '&ref=www_colorful&tn=iphone&from=1018279e',
                'r' => 'A',
            ];
        }
        echo $this->input->get('callback', true) . '(' . json_encode($arrRes) . ')';
    }
}
