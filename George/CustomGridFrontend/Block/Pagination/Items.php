<?php

namespace George\CustomGridFrontend\Block\Pagination;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use George\CustomGridAdmin\Model\GridItems as Extension;
use Magento\Framework\Pricing\Helper\Data as priceHelper;

class Items extends Template
{
    protected $customCollection;
    protected $priceHepler;

    public function __construct(Context $context, Extension $customCollection, priceHelper $priceHepler)
    {
        $this->customCollection = $customCollection;
        $this->priceHepler = $priceHepler;
        parent::__construct($context);
    }
    
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__("Custom Grid Items"));
        if ($this->getCustomCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'custom.history.pager'
            )->setAvailableLimit([5 => 5, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)->setCollection(
                    $this->getCustomCollection()
                );
            $this->setChild('pager', $pager);
            $this->getCustomCollection()->load();
        }
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function getCustomCollection()
    {
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest(
            
        )->getParam('limit') : 5;
        $collection = $this->customCollection->getCollection();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }

    public function getFormattedPrice($price)
    {
        return $this->priceHepler->currency($price, true, false);
    }
}