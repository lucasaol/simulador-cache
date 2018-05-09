<?php

/**
 * Description of HomeCtrl
 *
 * @author lucas
 */
class HomeCtrl extends Controller
{

    //put your code here

    public function __construct()
    {
        parent::__construct();
    }

    public function getHome()
    {
        $this->view();
    }

}
