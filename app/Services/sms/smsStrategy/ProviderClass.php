<?php

namespace App\Services\sms\smsStrategy;

class ProviderClass
{
    /**
     * ProviderClass constructor.
     * @param AdapterInterface $providerAdapter
     */
    public function __construct (private AdapterInterface $providerAdapter)
    {
    }

    /** call send method
     * @param object $params
     * @return mixed
     */
    public function send (array $params): mixed
    {
        if ($params['type'] == "simple") {
            return $this->providerAdapter->sendSimple ($params);
        }
//        if ($params['type'] == "otp") {
//            return $this->providerAdapter->sendOtp ($params);
//        }
//        if ($params['type'] == "bulk") {
//            return $this->providerAdapter->sendBulk ($params);
//        }
//        if ($params['type'] == "bulk_approval") {
//            return $this->providerAdapter->sendApprovalBulk ($params);
//        }
        return null;
    }
}
