<?php 
require_once APPPATH . 'reports/Vatreport.php';

$vatreport = new Vatreport([
    'vendorId' => $vendorId
]);
$vatreport->run()->render();

require_once APPPATH . 'reports/Visitors.php';

