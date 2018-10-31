<?php
/**
 * Created by PhpStorm.
 * User: SFGenis
 * Date: 30/10/2018
 * Time: 23:15
 */

namespace App\Usgs\Request;


use App\Exception\HttpException;
use Curl\Curl;

abstract class RequestJson
{

    /**
     * Envia una peticion cURL mediante GET
     *
     * @param string $uri
     *
     * @return mixed
     * @throws HttpException
     * @throws \ErrorException
     */
    protected static function sendGet($uri)
    {
        $curl = new Curl();
        $curl->get(sprintf($uri));

        if ($curl->curl_error) {
            throw new HttpException($curl->http_status_code, $curl->curl_error_message);
        }
        else if ($curl->error) {
            throw new HttpException(500, $curl->error_message);
        }

        $response = $curl->response;
        return json_decode($response, true);
    }

}