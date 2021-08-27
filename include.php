<?php

define('_DB_CONFIG_', require_once dirname(__FILE__) .'/config/db_config.php');
require_once dirname(__FILE__) .'/controllers/DataBaseManager.php';

$dbManager = new DataBaseManager(_DB_CONFIG_);