<?php

/** @var \Icinga\Application\Modules\Module $this */

?>


<?php


$this->provideConfigTab('config/moduleconfig', array(
    'title' => $this->translate('Module Configuration'),
    'label' => $this->translate('Module Configuration'),
    'url' => 'moduleconfig'
));

$this->providePermission('monitoringbackports/config/moduleconfig', $this->translate('allow changes in the monitoring backports settings'));

?>

