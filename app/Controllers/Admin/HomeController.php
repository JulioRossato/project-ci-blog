<?php

namespace App\Controllers\Admin;

class HomeController extends \App\Controllers\BaseController
{

    public function index()
    {


        # =================================
        # Config Controller
        # =================================

        $data['page_title']      = 'Home';
        $data['page_controller'] = (new \ReflectionClass(__CLASS__))->getShortName();
        $data['page_method']     = __FUNCTION__;

        # =================================
        $data['data_list'] = [];

        return $this->viewAdmin($data['page_controller'].'/index', $data);
    }
}