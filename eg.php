<?php
$options =[
    "account_number" => "123456",
    "pin" => "1234",
    "account_id" => "07",
    "currency_code" => "TZS",
    "redirect_url" => "https://app.com/pay",
    "callback_url" => "https://app.com/cb",
    "lang" => "SW",
];
$customerFirstName = "John";
$customerLastName = "Doe";
$customerEmail = "johndoe@email.com";
$amount = "40000";
$referenceId = "123123";
$subAccount = "0747991498";
$paymentJson = [
    "MasterMerchant"=> [
      "account"=>  $options['account_number'] ,
      "pin"=>  $options['pin'] ,
      "id"=>  $options['account_id']
    ],
    "Merchant"=> [
      "reference"=> "",
      "fee"=> "0.00",
      "currencyCode"=> ""
    ],
    "Subscriber"=> [
      "account"=> $subAccount,
      "countryCode"=> "255",
      "country"=> "TZA",
      "firstName"=>  $customerFirstName ,
      "lastName"=>  $customerLastName ,
      "emailId"=>  $customerEmail
    ],
    "redirectUri"=> $options['redirect_url'] ,
    "callbackUri"=>  $options['callback_url'] ,
    "language"=>  $options['lang'] ,
    "terminalId"=> "",
    "originPayment"=> [
      "amount"=>  $amount ,
      "currencyCode"=>  $options['currency_code'] ,
      "tax"=> "0.00",
      "fee"=> "0.00"
    ],
    "exchangeRate"=> "1",
    "LocalPayment"=> [
      "amount"=>  $amount ,
      "currencyCode"=>  $options['currency_code']
    ],
    "transactionRefId"=>  $referenceId
  ];

  $str = json_encode($paymentJson,JSON_UNESCAPED_SLASHES);
  
//   try {
//   } catch (\Throwable $th) {

//   } finally {
//     echo "Failed";
//   }
