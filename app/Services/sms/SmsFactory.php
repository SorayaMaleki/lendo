<?php

namespace App\Services\sms;

use App\Services\sms\smsStrategy\kavehnegar\KavehnegarAdapter;
use App\Services\sms\smsStrategy\parsasms\ParsasmsAdapter;
use App\Services\sms\smsStrategy\ProviderClass;
use Exception;

class SmsFactory implements SmsInterface
{
    const PARSASMS = 'parsasms';
    const KAVEHNEGAR = 'kavehnegar';

    /** set provider
     * @param string $provider
     * @return ProviderClass|null
     * @throws Exception
     */
    public static function setProviderInstance(string $provider): ?ProviderClass
    {
        return match ($provider) {
            self::PARSASMS => new ProviderClass(new ParsasmsAdapter()),
            self::KAVEHNEGAR => new ProviderClass(new KavehnegarAdapter()),
            default => throw new Exception("Invalid strategy type."),
        };
    }
}
