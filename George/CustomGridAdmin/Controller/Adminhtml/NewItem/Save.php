<?php
 
namespace George\CustomGridAdmin\Controller\Adminhtml\NewItem;
 
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use George\CustomGridAdmin\Model\GridItemsFactory as ExtensionFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
 
class Save extends Action
{
    protected $resultPageFactory;
    protected $extensionFactory;

    const FORM_FIELDSET = 'item_details';
 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ExtensionFactory $extensionFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->extensionFactory = $extensionFactory;
        parent::__construct($context);
    }
 
    public function execute()
    {
        $jsonResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        try {
            $dataEntered = $this->getRequest()->getParam($this::FORM_FIELDSET);
            $data = $this->processFields($dataEntered);
            if ($data) {
                $model = $this->extensionFactory->create();
                $model->setData($data)->save();
                $this->messageManager->addSuccessMessage(__("Item saved successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/gridview/items');
        return $resultRedirect;
    }

    public function processFields($data)
    {
        $formKey = (array)$this->getRequest()->getPost('form_key');

        $data['form_key'] = $formKey[0];

        if(array_key_exists('path_to_image', $data)){
            $imgPathArr = explode('/', $data['path_to_image'][0]['path']);
            $imgPathArr = array_slice($imgPathArr, -3);
            $imgPath = implode('/', $imgPathArr) . '/' . $data['path_to_image'][0]['file'];
            $data['path_to_image'] = $imgPath;
        }

        if(array_key_exists('key_features', $data)) {
            $keyFeatures = explode(',', $data['key_features']);

            $keyFeatures = array_map(function($feature){
                $feature = trim($feature);
                return ucfirst($feature);
            }, $keyFeatures);

            $data['key_features'] = implode(',', $keyFeatures);

            return $data;
        }

        return $data;
    }
}