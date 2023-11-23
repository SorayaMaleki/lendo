<?php

namespace Tests;

trait TestHelper
{
    /**
     * Returns the expected api response in case of validation error
     *
     * @param array $message
     * @return array
     */
    protected function getValidationErrorResponse(array $message): array
    {
        return $this->getStandardResponse(null, false,$message, 422);
    }

    /**
     * Returns the expected api response in case of error
     *
     * @param array $message
     * @param integer $code
     * @return array
     */
    protected function getStandardErrorResponse(array $message, int $code): array
    {
        return $this->getStandardResponse(null,false , $message, $code);
    }



    /**
     * Returns the expected api respose
     *
     * @param array|null $data
     * @param integer $code
     * @param array $message
     * @param string $type
     * @return array
     */
    protected function getStandardResponse(
        ?array $data,
        bool $status,
        array $message,
        int $code
    ): array {
        return [
            "status" => $status,
            "status_code"=>$code,
            "message"=>$message,
            "body"=>$data,
        ];
    }
}
