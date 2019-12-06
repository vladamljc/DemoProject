<?php

namespace Catalog\Controllers;

class DashboardController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        echo 'Dashboard controller constructed...';
    }

    public function getDashBoardView()
    {

    }
}