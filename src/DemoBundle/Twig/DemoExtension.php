<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DemoBundle\Twig;

class DemoExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('newDateFormat', array($this, 'newDateFormatFilter')),
        );
    }

    public function newDateFormatFilter($date)
    {
        return $date->format('Y-m-d');
    }
}
