<?php

$installer = $this;
$installer->startSetup();

/** @var Mage_Sales_Model_Resource_Quote_Collection $quoteCollection */
$quoteCollection = Mage::getModel('sales/quote')->getCollection();
$quoteCollection->join(array('order'=> 'sales/order'),'order.quote_id=main_table.entity_id', array('order_id' =>'order.entity_id'));
$quoteCollection->addFieldToFilter('main_table.dibs_easy_payment_id',array('notnull' => true));

$items = $quoteCollection->getItems();

if (!empty($items)){
    $orderPaymentIds = array();
    foreach ($items as $item){
        $orderPaymentIds[$item->getOrderId()] = $item->getDibsEasyPaymentId();
    }

    $orderCollection = Mage::getModel('sales/order')->getCollection()->addFieldToFilter('entity_id',array('in'=>array_keys($orderPaymentIds)));
    $orders = $orderCollection->getItems();
    foreach ($orders as $order){
        if (isset($orderPaymentIds[$order->getId()])){
            $order->setDibsEasyPaymentId($orderPaymentIds[$order->getId()]);
            $order->save();
        }
    }
}

$installer->endSetup();

