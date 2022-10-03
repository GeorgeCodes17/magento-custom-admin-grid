<?php

namespace George\CustomGridAdmin\Controller\Adminhtml\GridView;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Items extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'George_CustomGridAdmin::custom_items_grid';
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context, PageFactory $resultPageFactory) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();

        $resultPage->setActiveMenu('George_CustomGridAdmin::custom_items_grid');
        $resultPage->addBreadcrumb(__("Grid"), __("Grid"));
        $resultPage->addBreadcrumb(__("Grid"), __("Grid"));
        $resultPage->getConfig()->getTitle()->prepend(__("Grid"));
            
        return $resultPage;
    }
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return true;
    }
}