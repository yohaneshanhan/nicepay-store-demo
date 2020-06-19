<?php
namespace App\Library\Nicepay;

use Illuminate\Support\Facades\Log;
use App\Library\Nicepay\NicepayRequestor;
use App\Library\Nicepay\NicepayLogger;
// include_once(app_path() . '/Library/NicepayConfig.php');
class NicepayLib {
    public $tXid;
    public $authNo;
    public $bankVacctNo;
    public $resultCd;
    public $resultMsg;
    public $iMid = NICEPAY_IMID;
    public $merchantKey = NICEPAY_MERCHANT_KEY;
    public $callBackUrl = NICEPAY_CALLBACK_URL;
    public $dbProcessUrl = NICEPAY_DBPROCESS_URL;
    public $cartData;

    public $requestData = array ();
    public $resultData = array ();
    public $log;
    public $debug;

    public $request;

    public function __construct() {
        $this->request = new NicepayRequestor();
        $this->log = new NicepayLogger();
        Log::info('NicepayLib. Start 1');   
    }

    // Set POST parameter name and its value
    public function set($name, $value) {
        $this->requestData[$name] = $value;
    }

    // Retrieve POST parameter value
    public function get($name)
    {
        if (isset($this->requestData[$name])) {
            return $this->requestData[$name];
        }
        return "";
    }

    // Virtual Account
    public function requestVA() {
        Log::info('requestVA. Populate Data');
        // Populate data
        if ($this->get('iMid')  != "") {
            $this->set('iMid', $this->get('iMid'));
        }else {
            $this->set('iMid', $this->iMid);
        }
        
        $this->set('merchantKey', $this->merchantKey);
        $this->set('timeStamp', $this->get('timeStamp'));
        
        if($this->get('apiVersion') == "V1_PRO"){
            $this->set('merchantToken', $this->merchantToken());
        }else if ($this->get('apiVersion') == "V1_ENT"){
            $this->set('merchantToken', $this->merchantTokenV1Ent());
        }else if($this->get('apiVersion') == "V2"){
            $this->set('merchantToken', $this->merchantTokenV2());
        }

        Log::info('NicepayLib. timeStamp : '.$this->get('timeStamp'));
        Log::info('NicepayLib. iMid : '.$this->iMid);
        Log::info('NicepayLib. referenceNo : '.$this->get('referenceNo'));
        Log::info('NicepayLib. amount : '.$this->get('amt'));
        Log::info('NicepayLib. merchantKey : '.$this->merchantKey);
        Log::info('NicepayLib. merchantToken : '.$this->get('merchantToken'));

        unset($this->requestData['merchantKey']);
        
        $this->set('dbProcessUrl', $this->dbProcessUrl);
        //$this->set('callBackUrl', $this->callBackUrl);
        $this->set('userIP', $this->getUserIP());
        $this->set('goodsNm', $this->get('description'));
        $this->set('notaxAmt', '0');
        $this->set('reqDomain', 'http://localhost/');
        $this->set('fee', '0');
        $this->set('vat', '0');
        
        if ($this->get('cartData')  == "") {
            $this->set('cartData', "{\"count\": \"1\",\"item\": [{\"img_url\": \"https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone11-select-2019-family?wid=882&amp;hei=1058&amp;fmt=jpeg&amp;qlt=80&amp;op_usm=0.5,0.5&amp;.v=1567022175704\",\"goods_name\": \" iPhone 11 \",\"goods_detail\": \"A new dual‑camera system captures more of what you see and love. The fastest chip ever in a smartphone and all‑day battery life let you do more and charge less. And the highest‑quality video in a smartphone, so your memories look better than ever.\",\"goods_amt\":" . "\"" . $this->get('amt') . "\"}]}");
        }

        Log::info('requestVA. cartData : '.$this->cartData );

        // Send Request
        Log::info('requestVA. Set Request Url API');
        $this->request->operation($this->get('env') , $this->get('apiVersion'));
        Log::info('requestVA. Url API Request : ' .$this->request->apiUrl);
        
        $this->request->openSocket();
        Log::info('requestVA. Open Socket Success');
        
        unset($this->requestData['env']);
        unset($this->requestData['apiVersion']);
        $this->resultData = $this->request->apiRequest($this->requestData);
        Log::info('requestVA. resultData');
        
        unset($this->requestData);
        return $this->resultData;
    }

    // Check Payment Status
    public function checkPaymentStatus($timeStamp, $iMid, $tXid, $referenceNo, $amt) {
        // Populate data
        $this->set('timeStamp', $timeStamp);

        $this->set('tXid', $tXid);
        $this->set('iMid', $iMid);
        $this->set('referenceNo', $referenceNo);
        $this->set('amt', $amt);
        $this->set('merchantToken', $this->merchantToken());
        unset($this->requestData['merchantKey']);

        // Check Parameter
        $this->checkParam('timeStamp', '01');
        $this->checkParam('tXid', '30');
        $this->checkParam('iMid', '02');
        $this->checkParam('referenceNo', '06');
        $this->checkParam('amt', '05');
        $this->checkParam('merchantToken', '28');

        // Send Request
        $this->request->operation('checkPaymentStatus','a');
        $this->request->openSocket();
        $this->resultData = $this->request->apiRequest($this->requestData);
        unset($this->requestData);
        return $this->resultData;
    }

    // Cancel Transaction
    public function cancelTrans() {

        // Populate data
        $this->set('merchantToken', $this->merchantTokenCancel());
        unset($this->requestData['merchantKey']);

        // Check Parameter
        $this->checkParam('timeStamp', '01');
        $this->checkParam('tXid', '47');
        $this->checkParam('iMid', '02');
        $this->checkParam('referenceNo', '06');
        $this->checkParam('amt', '05');
        $this->checkParam('merchantToken', '28');

        // Send Request
        $this->request->operation('cancel', 'a');
        $this->request->openSocket();
        $this->resultData = $this->request->apiRequest($this->requestData);
        unset($this->requestData);
        return $this->resultData;
    }

    public function checkParam($requestData, $errorNo){
        if (null == $this->get($requestData)){
            Log::error('checkParam. errorNo : '.$this->getError($errorNo));
            die($this->getError($errorNo));
        }
    }

    public function merchantToken() {
        return hash('sha256', $this->get('iMid').$this->get('referenceNo').$this->get('amt').$this->get('merchantKey'));
    }

    public function merchantTokenV1Ent() {
        return hash('sha256', $this->get('iMid').$this->get('referenceNo').$this->get('amt').$this->get('merchantKey'));
    }

    public function merchantTokenV2() {
        return hash('sha256', $this->get('timeStamp').$this->get('iMid').$this->get('referenceNo').$this->get('amt').$this->get('merchantKey'));
    }

    public function merchantTokenCancel() {
        return hash('sha256',
            $this->get('timeStamp').
            $this->get('iMid').
            $this->get('tXid').
            $this->get('amt').
            $this->get('merchantKey')
        );
    }

    public function getError($id) {
        $error = array(

            // That always Unknown Error :)
            '00' => array(
                'errorCode' => '00000',
                'errorMsg' => 'Unknown error. Contact it.support@ionpay.net.'
            ),
            // General Mandatory parameters
            '01' => array(
                'error' => '10001',
                'errorMsg' => '(timeStamp) is not set. Please set (timeStamp).'
            ),
            '02' => array(
                'error' => '10002',
                'errorMsg' => '(iMid) is not set. Please set (iMid).'
            ),
            '03' => array(
                'error' => '10003',
                'errorMsg' => '(payMethod) is not set. Please set (payMethod).'
            ),
            '04' => array(
                'error' => '10004',
                'errorMsg' => '(currency) is not set. Please set (currency).'
            ),
            '05' => array(
                'error' => '10005',
                'errorMsg' => '(amt) is not set. Please set (amt).'
            ),
            '06' => array(
                'error' => '10006',
                'errorMsg' => '(referenceNo) is not set. Please set (referenceNo).'
            ),
            '07' => array(
                'error' => '10007',
                'errorMsg' => '(goodsNm) is not set. Please set (goodsNm).'
            ),
            '08' => array(
                'error' => '10008',
                'errorMsg' => '(billingNm) is not set. Please set (billingNm).'
            ),
            '09' => array(
                'error' => '10009',
                'errorMsg' => '(billingPhone) is not set. Please set (billingPhone).'
            ),
            '10' => array(
                'error' => '10010',
                'errorMsg' => '(billingEmail) is not set. Please set (billingEmail).'
            ),
            '11' => array(
                'error' => '10011',
                'errorMsg' => '(billingAddr) is not set. Please set (billingAddr).'
            ),
            '12' => array(
                'error' => '10012',
                'errorMsg' => '(billingCity) is not set. Please set (billingCity).'
            ),
            '13' => array(
                'error' => '10013',
                'errorMsg' => '(billingState) is not set. Please set (billingState).'
            ),
            '14' => array(
                'error' => '10014',
                'errorMsg' => '(billingPostCd) is not set. Please set (billingPostCd).'
            ),
            '15' => array(
                'error' => '10015',
                'errorMsg' => '(billingCountry) is not set. Please set (billingCountry).'
            ),
            '16' => array(
                'error' => '10016',
                'errorMsg' => '(deliveryNm) is not set. Please set (deliveryNm).'
            ),
            '17' => array(
                'error' => '10017',
                'errorMsg' => '(deliveryPhone) is not set. Please set (deliveryPhone).'
            ),
            '18' => array(
                'error' => '10018',
                'errorMsg' => '(deliveryAddr) is not set. Please set (deliveryAddr).'
            ),
            '19' => array(
                'error' => '10019',
                'errorMsg' => '(deliveryCity) is not set. Please set (deliveryCity).'
            ),
            '20' => array(
                'error' => '10020',
                'errorMsg' => '(deliveryState) is not set. Please set (deliveryState).'
            ),
            '21' => array(
                'error' => '10021',
                'errorMsg' => '(deliveryPostCd) is not set. Please set (deliveryPostCd).'
            ),
            '22' => array(
                'error' => '10022',
                'errorMsg' => '(deliveryCountry) is not set. Please set (deliveryCountry).'
            ),
            '23' => array(
                'error' => '10023',
                'errorMsg' => '(dbProcessUrl) is not set. Please set (dbProcessUrl).'
            ),
            '24' => array(
                'error' => '10024',
                'errorMsg' => '(vat) is not set. Please set (vat).'
            ),
            '25' => array(
                'error' => '10025',
                'errorMsg' => '(fee) is not set. Please set (fee).'
            ),
            '26' => array(
                'error' => '10026',
                'errorMsg' => '(notaxAmt) is not set. Please set (notaxAmt).'
            ),
            '27' => array(
                'error' => '10027',
                'errorMsg' => '(description) is not set. Please set (description).'
            ),
            '28' => array(
                'error' => '10028',
                'errorMsg' => '(merchantToken) is not set. Please set (merchantToken).'
            ),
            '29' => array(
                'error' => '10029',
                'errorMsg' => '(reqDt) is not set. Please set (reqDt).'
            ),
            '30' => array(
                'error' => '10030',
                'errorMsg' => '(reqTm) is not set. Please set (reqTm).'
            ),
            // '31' => array(
            // 'error' => '10031',
            // 'errorMsg' => '(reqDomain) is not set. Please set (reqDomain).'
            // ),
            // '32' => array(
            // 'error' => '10032',
            // 'errorMsg' => '(reqServerIP) is not set. Please set (reqServerIP).'
            // ),
            // '33' => array(
            // 'error' => '10033',
            // 'errorMsg' => '(reqClientVer) is not set. Please set (reqClientVer).'
            // ),
            '34' => array(
                'error' => '10034',
                'errorMsg' => '(userIP) is not set. Please set (userIP).'
            ),
            // '35' => array(
            // 'error' => '10035',
            // 'errorMsg' => '(userSessionID) is not set. Please set (userSessionID).'
            // ),
            // '36' => array(
            // 'error' => '10036',
            // 'errorMsg' => '(userAgent) is not set. Please set (userAgent).'
            // ),
            // '37' => array(
            // 'error' => '10037',
            // 'errorMsg' => '(userLanguage) is not set. Please set (userLanguage).'
            // ),
            '38' => array(
                'error' => '10038',
                'errorMsg' => '(cartData) is not set. Please set (cartData).'
            ),
            // '39' => array(
            // 'error' => '10039',
            // 'errorMsg' => '(instmntType) is not set. Please set (instmntType).'
            // ),
            // '40' => array(
            // 'error' => '10040',
            // 'errorMsg' => '(instmntMon) is not set. Please set (instmntMon).'
            // ),
            // '41' => array(
            // 'error' => '10041',
            // 'errorMsg' => '(recurrOpt) is not set. Please set (recurrOpt).'
            // ),
            '42' => array(
                'error' => '10042',
                'errorMsg' => '(mitraCd) is not set. Please set (mitraCd).'
            ),
            '43' => array(
                'error' => '10043',
                'errorMsg' => '(paymentExpDt) is not set. Please set (paymentExpDt).'
            ),
            '44' => array(
                'error' => '10044',
                'errorMsg' => '(paymentExpTm) is not set. Please set (paymentExpTm).'
            ),
            // '45' => array(
            // 'error' => '10045',
            // 'errorMsg' => '(merFixAcctId) is not set. Please set (merFixAcctId).'
            // ),
            // '46' => array(
            // 'error' => '10046',
            // 'errorMsg' => '(mitraCd) is not set. Please set (mitraCd).'
            // ),
            '47' => array(
                'error' => '10047',
                'errorMsg' => '(tXid) is not set. Please set (tXid).'
            ),
        );

        return (json_encode($this->oneLiner($error[$id])));
    }

    public function getUserIP() {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }
        return $ip;
    }

    public function oneLiner($string) {
        // Return string in one line, remove new lines and white spaces
        return preg_replace(array('/\n/','/\n\r/','/\r\n/','/\r/','/\s+/','/\s\s*/'), ' ', $string);
    }

    public function extractNotification($name) {
        if (is_array($name))
        {
            foreach($name as $value)
            {
                if (isset($_REQUEST[$value]))
                {
                    $this->notification[$value] = $_REQUEST[$value];
                }
                else
                {
                    $this->notification[$value] = null;
                }
            }

        }
        elseif (isset($_REQUEST[$name]))
        {
            $this->notification[$name] = $_REQUEST[$name];
        }
        else
        {
            $this->notification[$name] = null;
        }
    }

    public function getNotification($name) {
        return $this->notification[$name];
    }

}