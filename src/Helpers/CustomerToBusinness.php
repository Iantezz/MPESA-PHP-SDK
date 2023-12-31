<?php

namespace Foofyian\MpesaSdkPhp\Helpers;

class CustomerToBusiness extends \Kemboielvis\MpesaSdkPhp\Mpesa
{
    public string $confirmation_url = "";
    public string $validation_url = "";
    public string $response_type = "";
    private string $command_id = "";
    private string $bill_ref_number = "";

    public function registerUrl($confirmation_url = null, $validation_url = null, $response_type = null): static
    {
        if($response_type != null){ $this->responseType($response_type); }
        if($confirmation_url != null) { $this->confirmationUrl($confirmation_url) ; }
        if ($response_type != null) { $this->validationUrl($validation_url); }
        $array_data = [
            "ShortCode" => $this->business_code,
            "ResponseType" => $this->response_type ,
            "ConfirmationURL" => $this->confirmation_url,
            "ValidationURL" => $this->validation_url
        ];
        $this->response = $this->curls($array_data, "/mpesa/c2b/v1/registerurl");
        return $this;

    }

    public function confirmationUrl($confirmation_url): static
    {
        $this->confirmation_url = $confirmation_url;
        return $this;
    }
    public function validationUrl($validation_url): static
    {
        $this->validation_url = $validation_url;
        return $this;
    }

    public function responseType($response_type): static
    {
        $this->response_type = $response_type;
        return $this;
    }

    public function __construct($consumer_key, $consumer_secret, $baseUrl)
    {
        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
        $this->baseUrl = $baseUrl;
    }

    public function simulate($business_code = "", $command_id = "", $amount = "", $phone_number = "", $bill_ref_number = ""): static
    {
        if ($business_code != "") $this->businessCode($business_code);
        if ($command_id != "") $this->commandId($command_id);
        if ($amount != "") $this->amount($amount);
        if ($phone_number != "") $this->phoneNumber($phone_number);
        if ($bill_ref_number != "") $this->billRefNumber($bill_ref_number);
        $array_data = [
            "ShortCode" =>  $this->business_code,
            "CommandID" => $this->command_id,
            "Amount" => $this->amount,
            "Msisdn" => $this->phone_number,
            "BillRefNumber" => $this->bill_ref_number,
        ];
        $this->response = $this->curls($array_data, "/mpesa/c2b/v1/simulate");
        return $this;
    }

    public function commandId($command_id): static
    {
        $this->command_id = $command_id;
        return $this;
    }

    public function billRefNumber($bill_ref_number): static
    {
        $this->bill_ref_number = $bill_ref_number;
        return $this;
    }


}