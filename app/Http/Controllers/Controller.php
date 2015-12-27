<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index(Request $request) {
        print_r($request->all());
        print_r($request->decodedPath());
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
