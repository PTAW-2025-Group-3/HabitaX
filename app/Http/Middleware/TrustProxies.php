<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class TrustProxies
{
    protected $proxies = '*';

    protected $headers = Request::HEADER_X_FORWARDED_ALL;

}
