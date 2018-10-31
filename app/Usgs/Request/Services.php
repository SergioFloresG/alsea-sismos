<?php
/**
 * Created by PhpStorm.
 * User: SFGenis
 * Date: 30/10/2018
 * Time: 21:40
 */

namespace App\Usgs\Request;

use App\Exception\HttpException;
use Curl\Curl;

class Services extends RequestJson
{

    /**
     * @param float  $magnitude
     * @param string $starttime
     * @param string $endtime
     *
     * @return mixed
     * @throws HttpException
     * @throws \ErrorException
     */
    public static function featureCollection($magnitude, $starttime, $endtime)
    {
        $starttime = date_create_from_format('Y-m-d', $starttime);
        $endtime = date_create_from_format('Y-m-d', $endtime);

        /// Validaciones de fechas.
        if (!$starttime || !$endtime) {
            throw new  HttpException(400, 'La fecha inicial o final no tienen el formato valido YYYY-MM-DD');
        }
        $diff = $endtime->diff($starttime);
        if ($diff->days > 0 && $diff->invert) {
            throw new HttpException(400, 'La fecha final no debe de ser mayor a la inicial');
        }

        if (!is_numeric($magnitude)) {
            throw new HttpException(400, 'Se espera un numero decimal para la magnitud');
        }

        $url = "https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&starttime=%s&endtime=%s&minmagnitude=%f";
        return self::sendGet(sprintf($url, $endtime->format('Y-m-d'), $starttime->format('Y-m-d'), $magnitude));

    }

    /**
     * @param string $eventid
     *
     * @return mixed
     * @throws HttpException
     * @throws \ErrorException
     */
    public static function featureDetail($eventid)
    {

        $url = "https://earthquake.usgs.gov/fdsnws/event/1/query?eventid=%s&format=geojson";
        return self::sendGet(sprintf($url, $eventid));
    }
}