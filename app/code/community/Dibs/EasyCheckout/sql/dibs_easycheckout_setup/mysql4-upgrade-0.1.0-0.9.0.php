<?php

$installer = $this;
$installer->startSetup();

$path = 'payment/dibs_easy_checkout/active';

/**
 * Corrects bug where DIBS easy would appear in
 * onepage checkout which it shouldn't
 */
Mage::getConfig()->saveConfig($path, '0', 'default', 0);

$stores = Mage::getResourceModel('core/store_collection');
foreach ($stores as $store) {
    Mage::getConfig()->saveConfig($path, '0', 'stores', $store->getId());
}

$installer->endSetup();
