<?php
/* Icinga Web 2 | (c) 2018 Icinga Development Team | GPLv2+ */

/** @var $this \Icinga\Application\Modules\Module */

use Icinga\Application\Config;

$hostlist = Config::module('monitoringbackports', "config")
    ->get('settings', 'hostlist') == 1 ? true : false;

if($hostlist){
    $this->addRoute('monitoring/list/hosts',
        new Zend_Controller_Router_Route_Static(
            'monitoring/list/hosts',
            [
                'controller' => 'list',
                'action' => 'hosts',
                'module' => 'monitoringbackports'
            ]
        )
    );
}
