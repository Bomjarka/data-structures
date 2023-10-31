<?php

use App\Structures\CustomList;

require_once './vendor/autoload.php';

$customList = new CustomList();
print_r($customList->getList());
