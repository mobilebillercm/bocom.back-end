<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06/11/18
 * Time: 13:50
 */

namespace App;


class Contact
{
    public function __construct($tel = null, $bp = null, $address = null, $quarter = null)
    {
        $this->phones = $tel;
        $this->bp = $bp;
        $this->address = $address;
        $this->quarter = $quarter;
    }
}