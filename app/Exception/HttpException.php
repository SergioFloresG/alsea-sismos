<?php
/**
 * Created by PhpStorm.
 * User: SFGenis
 * Date: 30/10/2018
 * Time: 21:46
 */

namespace App\Exception;

use Throwable;

class HttpException extends \Exception
{

    /**
     * HttpException constructor.
     *
     * @param int            $status
     * @param string         $message
     * @param Throwable|null $previous
     */
    public function __construct($status, $message = "", $previous = null)
    {
        parent::__construct($message, $status, $previous);
    }

}