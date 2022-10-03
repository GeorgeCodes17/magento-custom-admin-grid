<?php

namespace George\CustomGridAdmin\Controller\Adminhtml\NewItem;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \George\CustomGridAdmin\Model\GridItems
     */
    private $gridFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \George\CustomGridAdmin\Model\GridItems $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \George\CustomGridAdmin\Model\GridItems $gridFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->gridFactory = $gridFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->gridFactory;
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getEntityId()) {
                $this->messageManager->addError(__('Row data no longer exists.'));
                $this->_redirect('*/gridview/items');
                return;
            }
        }

        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Row Data ').$rowTitle : __('Add Item');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('George_CustomGridAdmin::items');
    }
}