<?php

namespace arashrasoulzadeh\Zal\Templates;

use Illuminate\Http\Response;

interface ZalActionInterface
{
    public function method();

    public function action(): Response;

    public function validation(): array;
}
