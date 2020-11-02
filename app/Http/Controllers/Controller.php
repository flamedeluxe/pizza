<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Send mail
     * @param $to
     * @param $subject
     * @param $message
     */
    public function email($to, $subject, $message)
    {

        $from = env('EMAIL_FROM');

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headers .= "To: $to";
        $headers .= "From: $from";

        mail($to, $subject, $message, $headers);
    }
}
