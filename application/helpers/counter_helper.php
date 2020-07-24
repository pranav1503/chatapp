<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if ( ! function_exists('count_visitor')) {
    function count_visitor()
    {
        $filecounter=(APPPATH . 'logs/counter.txt');
        $kunjungan=file($filecounter);
        $inc = intval($kunjungan[0]) + 1;
        $file=fopen($filecounter, 'w');
        fputs($file, $inc);
        fclose($file);
        return $inc;
    }

    function count_show()
    {
        $filecounter=(APPPATH . 'logs/counter.txt');
        $kunjungan=file($filecounter);
        return $kunjungan[0];
    }
}
