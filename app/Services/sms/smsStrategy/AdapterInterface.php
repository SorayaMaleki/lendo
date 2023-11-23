<?php

namespace App\Services\sms\smsStrategy;

interface AdapterInterface
{
    public function sendSimple(string $params);
}
