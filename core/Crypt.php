<?php
namespace Core;

use Illuminate\Encryption\Encrypter;

/**
 * Class Crypt
 * @package Core
 */
class Crypt
{

    /**
     * @return Encrypter
     */
    private static function init()
    {
        return new Encrypter($GLOBALS['config']['key']);
    }

    /**
     * @param $string
     * @return string
     */
    public static function encrypt($string)
    {
        $encrypter = self::init();
        
        return $encrypter->encrypt($string);
    }


    /**
     * @param $string
     * @return string
     */
    public static function decrypt($string)
    {
        $encrypter = self::init();
        return $encrypter->decrypt($string);
    }
}
