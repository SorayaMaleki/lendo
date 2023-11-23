<?php

namespace App\Services\sms\smsStrategy\kavehnegar;

use App\Services\sms\smsStrategy\AdapterInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class KavehnegarAdapter implements AdapterInterface
{
    /** send single message
     * @param $params
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function sendSimple ($params): JsonResponse
    {
        //TODO call api of kavehnegar with GuzzleHttp\Client instead of return success
        return $this->apiResponse->successResponse(null, __("message.send"), 200);
    }
}
