<?php

namespace App\Library;

use Illuminate\Support\Facades\Http;

class UddoktaPay {
    
    /**
     * Send payment request
     *
     * @param array $requestData
     * @return void
     */
    public static function init_payment($requestData) {
        $response = Http::withHeaders( [
            'Content-Type'          => 'application/json',
            'RT-UDDOKTAPAY-API-KEY' => env( "UDDOKTAPAY_API_KEY" ),
        ] )
            ->asJson()
            ->withBody( json_encode( $requestData ), "JSON" )
            ->post( env( "UDDOKTAPAY_PAYMENT_DOMAIN" ) . "/api/checkout" );
            
        if ( $response->successful() ) {
            return $response->collect()['payment_url'];
        } else {
            dd( $response->body() );
        }
    }
}
