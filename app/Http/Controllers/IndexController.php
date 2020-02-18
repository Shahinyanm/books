<?php

namespace App\Http\Controllers;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('index');
    }
}
