<?php
namespace App\Services\sms\smsStrategy\parsasms;

use App\Services\sms\smsStrategy\AdapterInterface;
use App\Traits\Response\ApiResponse;
use Illuminate\Http\JsonResponse;

class ParsasmsAdapter implements AdapterInterface
{
    use ApiResponse;


    /** send single message
     * @param $params
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function sendSimple($params): JsonResponse
    {
        return $this->successResponse(null, __("message.send"), 200);

        //TODO uncomment call api of parsasms with GuzzleHttp\Client instead of return success
//        try {
        //        $client = new Client();
//            $response = $client->post(config("ParsasmsConfig.base_uri") . '/sms/send/simple', [
//                "headers" => [
//                    "Content-Type" => "application/x-www-form-urlencoded",
//                    "apikey" => config("ParsasmsConfig.api_key"),
//                ],
//                "form_params" => [
//                    "message" => $params->message,
//                    "receptor" => $params->receiver_id,
//                ]
//            ]);
//            $response->getBody()->getContents();
//            if ($response->result == "success") {
//                return $this->successResponse(null, __("message.send"), 200);
//            }
//            return $this->errorResponse(__ ('dashboard.sth_happen'), 500);
//
//        } catch (Exception) {
//            return $this->errorResponse(__ ('dashboard.sth_happen'), 500);
//        }

    }
}
