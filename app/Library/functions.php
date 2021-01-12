<?php

class Config {
    static private $instance;
    private        $config;

    private function __construct() {

    }

    private function __clone() {

    }

    static public function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConfig() {
        return $this->config;
    }

    public function setConfig($config) {
        $this->config = $config;
    }
}



function p($array) {
    echo PHP_EOL;
    $text = dump($array, 0, '', 0);
    echo $text;
    echo PHP_EOL;
}

function getRandChar($length) {
    $str    = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max    = strlen($strPol) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str .= $strPol[rand(0, $max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
    }
    return $str;
}

function getRandNumber($length) {
    $str    = null;
    $strPol = "0123456789";
    $max    = strlen($strPol) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str .= $strPol[rand(0, $max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
    }
    return $str;
}

function objtoarr($obj) {
    return json_decode(json_encode($obj), true);
}

