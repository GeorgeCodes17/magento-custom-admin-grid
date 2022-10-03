<?php

namespace George\CustomGridAdmin\Controller\Adminhtml\GridActions;
 
use Magento\Backend\App\Action;
 
class Delete extends Action
{
    protected $_model;
 
    /**
     * @param Action\Context $context
     * @param \George\CustomGridAdmin\Model\GridItems $model
     */
    public function __construct(
        Action\Context $context,
        \George\CustomGridAdmin\Model\GridItems $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }


    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Item deleted'));
                return $resultRedirect->setPath('*/gridview/items');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/gridview/items');
            }
        }
        $this->messageManager->addError(__('Item does not exist'));
        return $resultRedirect->setPath('*/gridview/items');
    }
}