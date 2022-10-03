<?php

namespace George\CustomGridFrontend\Block\FooterLink;

class ItemsLink extends \Magento\Framework\View\Element\Template
{
    public function getFooterLinkName()
    {
        return "Custom Grid";
    }

    public function getFooterLink()
    {
        return "/custom-grid/griditems/home";
    }
}

?>
