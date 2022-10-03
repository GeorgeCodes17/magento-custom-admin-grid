<?php

namespace George\CustomGridAdmin\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
/**
 * 
 */
class GridItems extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Block grid items table
     *
     * @var string
     */
    protected $_blockProductTable;
    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param string|null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
    }
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('george_customgrid_items', 'id');
    }
}