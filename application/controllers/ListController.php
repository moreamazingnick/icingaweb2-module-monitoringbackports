<?php
/* Icinga Web 2 | (c) 2013 Icinga Development Team | GPLv2+ */

namespace Icinga\Module\Monitoringbackports\Controllers;

use Icinga\Application\Modules\Module;
use Icinga\Module\Monitoring\Object\Host;


class ListController extends \Icinga\Module\Monitoring\Controllers\ListController
{
    public function hostsAction()
    {
        parent::hostsAction();
        $hosts = $this->view->hosts;
        $this->view->addHelperPath(Module::get("monitoring")
                ->getBaseDir() . DIRECTORY_SEPARATOR . "application/views/helpers/");
        $summary = [];
        foreach (clone $hosts->getIterator() as $iter) {
            $dbHost = new Host($this->backend, $iter->host_name);
            $this->applyRestriction('monitoring/filter/objects', $dbHost);
            $dbHost->fetch();
            $dbHost = $dbHost->fetchStats();
            $value = intval($dbHost->stats->services_critical_unhandled)
                + intval($dbHost->stats->services_unknown_unhandled);
            if ($value > 0) {
                $summary[$iter->host_name] = $value;
            }
        }
        $this->view->summary = $summary;
    }
    public function getModuleName()
    {
        return "monitoring";
    }


}
