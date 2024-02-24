<?php

namespace arashrasoulzadeh\Zal\Templates;

use Illuminate\Http\Request;

define('GET', 'GET');
define('POST', 'POST');
define('PUT', 'PUT');
define('DELETE', 'DELETE');

abstract class ZalBase
{
    public function __construct(private Request $request, private $id)
    {
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function id()
    {
        return $this->id;
    }

    public function method()
    {
        return $this->getRequest()->getMethod();
    }
}
