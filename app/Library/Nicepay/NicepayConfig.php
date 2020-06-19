<?php
namespace App\Library\Nicepay;
/*
 * ____________________________________________________________
 *
 * Copyright (C) 2016 NICE IT&T
 *
 *
 * This config file may used as it is, there is no warranty.
 *
 * @ description : PHP SSL Client module.
 * @ name        : NicepayLite.php
 * @ author      : NICEPAY I&T (tech@nicepay.co.kr)
 * @ date        :
 * @ modify      : 12.06.2020
 *
 * 09.03.2016 Update Log
 * 12.06.2020 Nicepay Payments Demo (Yohanes)
 * ____________________________________________________________
 */

// Please set the following
define("NICEPAY_IMID", "IONPAYTEST"); // Merchant ID
define("NICEPAY_MERCHANT_KEY", "33F49GnCMS1mFYlGXisbUDzVf2ATWCl9k3R++d5hDd3Frmuos/XLx8XhXpe+LDYAbpGKZYSwtlyyLOtS/8aD7A=="); // API Key Merchant Key

// define("NICEPAY_CALLBACK_URL", "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF'])."/resultGate.php"); // Merchant's result page URL
define("NICEPAY_CALLBACK_URL", "https://pluto.nicepay.co.id/result"); // Merchant's result page URL
define("NICEPAY_DBPROCESS_URL", "https://ptsv2.com/t/yohanes/post"); // Merchant's notification handler URL

/* TIMEOUT - Define as needed (in seconds) */
define( "NICEPAY_TIMEOUT_CONNECT", 15 );
define( "NICEPAY_TIMEOUT_READ", 25 );

// Please do not change
define("NICEPAY_PROGRAM",           "NicepayLite");
define("NICEPAY_VERSION",           "2.0");
define("NICEPAY_BUILDDATE",         "20200612");

define("NICEPAY_LOC_ENV", "http://127.0.0.1:8080");
define("NICEPAY_DEV_ENV", "https://dev.nicepay.co.id");
define("NICEPAY_STG_ENV", "https://staging.nicepay.co.id");
define("NICEPAY_PROD_ENV", "https://www.nicepay.co.id");

// FOR PRODUCTION
// define("NICEPAY_REQ_URL",        	"https://www.nicepay.co.id/nicepay/direct/v2/registration");     // Registration URL
// define("NICEPAY_CANCEL_URL",     	"https://www.nicepay.co.id/nicepay/direct/v2/cancel");       	// Cancel API URL
// define("NICEPAY_ORDER_STATUS_URL",  "https://www.nicepay.co.id/nicepay/direct/v2/inquiry");         // Check payment status URL
// define("NICEPAY_ORDER_STATUS_URL",  "https://dev.nicepay.co.id/nicepay/direct/v2/payment");         // Check payment status URL

// FOR DEVELOPMENT
define("NICEPAY_REQ_URL",        "https://dev.nicepay.co.id/nicepay/direct/v2/registration");            	// Registration URL
define("NICEPAY_CANCEL_URL",     	  "https://dev.nicepay.co.id/nicepay/direct/v2/cancel");			// Cancel API URL
define("NICEPAY_ORDER_STATUS_URL",  "https://dev.nicepay.co.id/nicepay/direct/v2/inquiry");          	// Check payment status URL

// CREATE ORDER
define("NICEPAY_V1PRO",  "/nicepay/api/orderRegist.do");
define("NICEPAY_V1ENT",  "/nicepay/api/onePass.do");
define("NICEPAY_V1ENT_EWALLET",  "/nicepay/api/ewalletTrans.do");
define("NICEPAY_V2_REGISTRATION",  "/nicepay/direct/v2/registration");

define("NICEPAY_V2_PAYMENT",  "/nicepay/direct/v2/payment");

// CHECK & CANCEL ORDER
define("NICEPAY_V1_CHECK_STATUS",  "/nicepay/api/onePassStatus.do");
define("NICEPAY_V1_CANCEL",  "/nicepay/api/onePassAllCancel.do");
define("NICEPAY_V2_CHECK_STATUS",  "/nicepay/direct/v2/inquiry");
define("NICEPAY_V2_CANCEL",  "/nicepay/direct/v2/cancel");

define("NICEPAY_READ_TIMEOUT_ERR",  "10200");

/* LOG LEVEL */
define("NICEPAY_LOG_CRITICAL", 1);
define("NICEPAY_LOG_ERROR", 2);
define("NICEPAY_LOG_NOTICE", 3);
define("NICEPAY_LOG_INFO", 5);
define("NICEPAY_LOG_DEBUG", 7);