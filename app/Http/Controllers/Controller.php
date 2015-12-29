<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index(Request $request) {
        return view('main', [
            'title'   => 'Main',
            'request' => $request,
        ]);
    }

    public function get($id) {

    }

    public function edit($id) {

    }

    public function delete($id) {

    }

    public function create(Request $request) {

    }
}
