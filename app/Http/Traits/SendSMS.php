<?php

namespace App\Http\Traits;

use GuzzleHttp\Client;

/**
 * Class used to send push notification to android and iOS for FireBase.
 * @author  Nagesh Badgujar
 */
class SendSMS
{

    /**
     * Vodafone API Credentails
     * @var array
     */
    protected $credentials;
    /**
     * Soap Client
     * @var obj
     */
    protected $client;

    /**
     * API Endpont
     * @var string
     */
    protected $api = "https://smsvas.vlserv.com/KannelSending/service.asmx/SendSMS";

    /**
     * Request Params
     * @var string
     */
    protected $params = "";

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
        // dd($credentials);
    }

    /**
     * Send SMS
     * @param  array  $data message details
     * @return VictoryLinkAdapter
     */
    public function send(array $data)
    {
        $this->buildRequestParams($data);

        $client = new Client();
        $response = $client->request('GET', "{$this->api}{$this->params}", [
            'headers'  => ['Content-Type' => 'application/x-www-form-urlencoded'],
        ]);

        return $this->responseMessage($response->getBody()->getContents());

    }

    /**
     * Build GET Request Params
     * @param  array  $data requesr parameters
     * @return string       request parameters for the get request
     */
    protected function buildRequestParams(array $data): string
    {
        $guid = createGUID();
        return $this->params = "?UserName={$this->credentials['username']}&Password={$this->credentials['password']}&SMSText={$data['message']}&SMSLang={$this->credentials['language']}&SMSSender={$this->credentials['sender']}&SMSReceiver={$data['to']}&SMSID={$guid}";
        // return $this->params = "?UserName=ALNasser&Password=7LB9McJJ99&SMSText={$data['message']}&SMSLang=e&SMSSender=AlNASSER&SMSReceiver={$data['to']}&SMSID={$guid}";
    }

    private function responseMessage($code)
    {
        switch ((int) $code) {
            case '0':
                $msg = 'Message Sent Succesfully';
                break;

            case '-1':
                $msg = 'User is not subscribed';
                break;

            case '-5':
                $msg = 'Out of credit.';
                break;

            case '-10':
                $msg = 'Queued Message, no need to send it again.';
                break;

            case '-11':
                $msg = 'Invalid language.';
                break;

            case '-12':
                $msg = 'SMS is empty.';
                break;

            case '-13':
                $msg = 'Invalid fake sender exceeded 12 chars or empty.';
                break;

            case '-25':
                $msg = 'Sending rate greater than receiving rate (only for send/receive accounts).';
                break;

            case '-100':
                $msg = 'Other error';
                break;

            default:
                $msg = 'Unknown Error Code';
                break;
        }

        return $msg;
    }
}
