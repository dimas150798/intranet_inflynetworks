<?php
defined('BASEPATH') or exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database', 'form_validation', 'session');

$autoload['drivers'] = array('session');

$autoload['helper'] = array('form', 'url');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('M_Login', 'M_DataPegawai', 'M_CRUD', 'M_DataCustomer', 'M_DataAktivasi', 'M_StockBarang');
