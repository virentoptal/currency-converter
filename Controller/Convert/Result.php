<?php
namespace ToptalVirendra\CurrencyConverter\Controller\Convert;
use Magento\Framework\Controller\ResultFactory;


class Result extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;

    protected $_helper;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
         \ToptalVirendra\CurrencyConverter\Helper\Data $helperData
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_helper = $helperData;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
    	/* set response type = JSON  */
    	$response = $this->resultFactory
		->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
    	$postData = $this->getRequest()->getPost();
    	if(!empty($postData['amount'])){
    		$converted_amount = $this->_helper->getCurrencyRate($postData['amount'], 'RUB',  'PLN');
    	
			$response->setData([
				'status'  => "success",
				'amount' => $postData['amount'],
				'converted_amount' => number_format((float)$converted_amount, 2, '.', '')
			]);
		
		
		}
		else{
			$response->setData([
				'status'  => "error"
			]);
		}
        return $response;
    }
}
