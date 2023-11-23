<?php
namespace App\Helpers;


interface SmsTextInterface{
    public static function generateText( array $customer) ;
}
