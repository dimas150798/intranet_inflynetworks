<?php
defined('BASEPATH') or exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database', 'form_validation', 'session');

$autoload['drivers'] = array('session');

$autoload['helper'] = array('form', 'url');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('M_CRUD', 'M_DataStatus', 'M_DataAktivasi', 'M_DataCustomer', 'M_DataPegawai', 'M_Kecamatan', 'M_Kelurahan', 'M_Kota', 'M_Login', 'M_Paket', 'M_StockBarang', 'M_NamaBarang', 'M_DataSatuan', 'M_DataPeralatan', 'M_StockRincian', 'M_DataKeadaanBarang', 'M_LaporanKeluar', 'M_LaporanMasuk', 'M_DataPeminjaman', 'M_DataRequest', 'M_DataOrder');
