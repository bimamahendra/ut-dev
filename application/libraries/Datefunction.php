<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Datefunction{
        public function getMonth(){
            return array(
                '1'     => 'Januari',
                '2'     => 'Februari',
                '3'     => 'Maret',
                '4'     => 'April',
                '5'     => 'Mei',
                '6'     => 'Juni',
                '7'     => 'Juli',
                '8'     => 'Agustus',
                '9'     => 'September',
                '10'    => 'Oktober',
                '11'    => 'November',
                '12'    => 'Desember'
            );
        }
        public function getMonthRomawi(){
            return array(
                '1'     => 'I',
                '2'     => 'II',
                '3'     => 'III',
                '4'     => 'IV',
                '5'     => 'V',
                '6'     => 'VI',
                '7'     => 'VII',
                '8'     => 'VIII',
                '9'     => 'IX',
                '10'    => 'X',
                '11'    => 'XI',
                '12'    => 'XII'
            );
        }
        public function getRomawiMonth(){
            return array(
                'I'     => '1',
                'II'    => '2',
                'III'   => '3',
                'IV'    => '4',
                'V'     => '5',
                'VI'    => '6',
                'VII'   => '7',
                'VIII'  => '8',
                'IX'    => '9',
                'X'     => '10',
                'XI'    => '11',
                'XII'   => '12'
            );
        }
    }
?>