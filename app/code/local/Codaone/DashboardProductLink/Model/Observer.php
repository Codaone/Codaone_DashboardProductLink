<?php
class Codaone_DashboardProductLink_Model_Observer {

	public function onBlockHtmlBefore(Varien_Event_Observer $observer) {
		$block = $observer->getBlock();
		if (!isset($block)) return;

		if($block->getType() == 'adminhtml/catalog_product_edit') {
			$_product = $block->getProduct();
			// If product is not visible don't show button
			if(!$_product->isVisibleInCatalog() || !$_product->isVisibleInSiteVisibility() ){
				return;
			}
			$url = $_product->getProductUrl();
			$_deleteButton = $block->getChild('delete_button');
			$block->setChild('product_view_button',
				$block->getLayout()
					->createBlock('core/text')
					->setText(
						"<a href='".$url."' target='_blank' class='form-button scalable' style='margin-left:5px;padding: 2px 7px 3px;text-decoration:none'>".
						"<span>".Mage::helper('catalog')->__('View Product Page')."</span>".
						"</a>"
					)
			);
			$_deleteButton->setBeforeHtml($block->getChild('product_view_button')->toHtml());

		}
	}
}