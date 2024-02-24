<?php

namespace arashrasoulzadeh\Zal\Controllers;

use arashrasoulzadeh\Zal\Facades\Zal;
use Illuminate\Http\Request;

class ZalController
{
    public function serve(Request $request, $action, $id = null)
    {
        if (! isset(Zal::getActions()[$action])) {
            abort(404);
        }
        $action = Zal::getActions()[$action];
        $action = new ($action)($request, $id);

        return $action->render($request, $id);
    }
}
