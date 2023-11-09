<?php
/* Originally from Icinga Web 2 Reporting Module (c) Icinga GmbH | GPLv2+ */

namespace Icinga\Module\Monitoringbackports\Controllers;


use Icinga\Application\Config;
use Icinga\Web\Controller;
use Icinga\Module\Monitoringbackports\Forms\ModuleconfigForm;

class ModuleconfigController extends Controller
{



    public function init()
    {
        $this->assertPermission('config/modules');


        parent::init();
    }


    public function indexAction()
    {
        $this->assertPermission('monitoringbackports/config');

        $form = (new ModuleconfigForm())
            ->setIniConfig(Config::module('monitoringbackports', "config"));

        $form->handleRequest();

        $this->view->tabs = $this->Module()->getConfigTabs()->activate('config/moduleconfig');
        $this->view->form = $form;
    }


    public function createTabs()
    {
        $tabs = $this->getTabs();

        $tabs->add('monitoringbackports/config', [
            'label' => $this->translate('Configure Monitoringbackports'),
            'url' => 'monitoringbackports/config'
        ]);

        return $tabs;

    }

}