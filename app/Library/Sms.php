<?php


namespace App\Library;

use App\Models\GatewayTransaction;
use App\Models\Message;
use IPPanel\Client;
use IPPanel\Errors\Error;
use IPPanel\Errors\HttpException;
use IPPanel\Errors\ResponseCodes;

class Sms
{
    private string $apikey = "NiU_VaTd-NdStNvnO3n2yOGTzMSRJBdHBx09TnDRr-U=";
    private string $url = "http://rest.ippanel.com";
    private string $sender_number = "+98100020400";
    private string $mobile;
    public function __construct(string $mobile)
    {
        $this->mobile = $mobile;
    }
    public function send($mobile, $text)
    {
    }
    public function sendByPattern($pattern_code, $params)
    {
        try {
            $api_key = $this->apikey;
            $client = new Client($api_key);
            $response = $client->sendPattern(
                $pattern_code,    // pattern code
                $this->sender_number,      // originator
                $this->mobile,  // recipient
                $params,  // pattern values
            );

            return true;
        } catch (Error $e) { // ippanel error
            // var_dump($e->unwrap()); // get real content of error
            // echo $e->getCode();

            // // error codes checking
            // if ($e->code() == ResponseCodes::ErrUnprocessableEntity) {
            //     echo "Unprocessable entity";
            // }
            return false;
        } catch (HttpException $e) { // http error
            // var_dump($e->getMessage()); // get stringified error
            // echo $e->getCode();
            return false;
        }
    }

    public function isSmscounts($str)
    {
        if (strlen(utf8_decode($str)) == 0) //If Text Length == 0
            $smsCount = 1; //ِDefault Sms Counts
        //Check For Farsi Text
        $isPersian  = (!preg_match('/^[پچجحخهعغفقثصضشسیبلاتنمکگوئدذرزطظژؤإأءًٌٍَُِّ\s]+$/u', str_replace("\\", "", $str)));
        $maxLen     = 0; //Default Max Length
        $msgLen     = strlen(utf8_decode($str)); //Calculate Sms Length
        $fa_diff    = 3; //Diffrent Farsi page
        $en_diff    = 7; //ِDiffrent English page
        $unitLength = ($isPersian ? 70 : 160); //Uint Length
        //Check For Pages
        if ($msgLen > $unitLength) {
            if ($isPersian)
                $unitLength = $unitLength - $fa_diff;
            else
                $unitLength = $unitLength - $en_diff;
        }
        //Final Calculate
        $smsCount = ceil($msgLen / $unitLength);
        //Return
        return $smsCount;
    }

    public function countSent()
    {
        $messages = Message::orderBy('date_send', 'desc')->get();
        $i = 0;
        $length = 0;
        foreach ($messages as $message) {
            $i = 0;
            $text = $message->text;
            $len = $this->isSmscounts($text);

            $recpients = $message->recpients;
            foreach ($recpients as $row) {
                $i++;
            }
            $length += ($len * $i);
        }

        return $length;
    }
    public function countSMS()
    {
        $money = $this->creditSMS();
        $tax = $money * 0.09;
        $money = $money - $tax;
        $sms = round($money / 250);
        return $sms;
    }

    public function creditSMS()
    {
        $money = GatewayTransaction::where('status', 100)->sum('fee');
        $money .= '0';

        $length = $this->countSent();

        $money -= $length * 250;

        return $money;
    }
}
