<?php

namespace ToptalVirendra\CurrencyConverter\Helper;

use Magento\Contact\Model\ConfigInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{	
	/**
     * Currency converter url
     */
	const CURRENCY_CONVERTER_URL = 	'https://free.currencyconverterapi.com/api/v6/convert?q={{FROM}}_{{TO}}&compact=ultra';
    /**
     * @var array
     */
    private $postData = null;
 
 	/**
     * get converted currency
     *
     * @return float|null
     */
    public function getCurrencyRate($amount , $from , $to)
    {
		$url = str_replace(	array('{{FROM}}' , '{{TO}}'),
							array($from,$to) , self::CURRENCY_CONVERTER_URL ); 
    	$currData = file_get_contents($url);
    	$currencyRate = json_decode($currData);
		if(isset($currencyRate->{$from."_".$to}))
		{
	    	return $currencyRate->{$from."_".$to} * floatval($amount);
	    }
	    return null;
    }
}