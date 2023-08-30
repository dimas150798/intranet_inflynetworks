<?php
defined('BASEPATH') or exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database', 'form_validation', 'session');

$autoload['drivers'] = array('session');

$autoload['helper'] = array('form', 'url');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('M_CRUD', 'M_DataAktivasi', 'M_DataCustomer', 'M_DataPegawai', 'M_Kecamatan', 'M_Kelurahan', 'M_Kota', 'M_Login', 'M_Paket', 'M_StockBarang');
