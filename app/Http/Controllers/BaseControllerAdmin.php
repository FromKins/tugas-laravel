<?php
/**
 * Created by PhpStorm.
 * User: faerulsalamun
 * Date: 20/06/18
 * Time: 17.26
 */

namespace App\Http\Controllers;


class BaseControllerAdmin extends Controller
{
    /**
     * BaseControllerAdmin constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
}