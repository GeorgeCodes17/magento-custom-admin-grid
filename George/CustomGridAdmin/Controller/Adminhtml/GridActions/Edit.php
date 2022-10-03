<?php
 
namespace George\CustomGridAdmin\Controller\Adminhtml\GridActions;
 
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use George\CustomGridAdmin\Model\GridItems as Model;
 
class Edit extends Action
{
    protected $jsonFactory;
    protected $model;
 
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        Model $model
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->model = $model;
    }
 
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (empty($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $entityId) {
                    $modelData = $this->model->load($entityId);
                    try {
                        $modelData->setData(array_merge($modelData->getData(), $postItems[$entityId]));
                        $modelData->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }
 
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}