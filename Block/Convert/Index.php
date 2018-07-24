<?php


namespace ToptalVirendra\CurrencyConverter\Block\Convert;
use Magento\Framework\App\RequestInterface;


class Index extends \Magento\Framework\View\Element\Template
{	
	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \ToptalVirendra\CurrencyConverter\Helper\Data $helperData,
        RequestInterface $_request,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $request = $_request->getParams();
    	if (isset($request['amount'])) {
			/* get currency "PLN" Value */
    	    $convertedAmount = $helperData->getCurrencyRate($request['amount'] , 'RUB',  'PLN');
    	    $this->setAmount($request['amount']);
    	    $this->setConvertedAmount($convertedAmount);
    	}
    }
}
