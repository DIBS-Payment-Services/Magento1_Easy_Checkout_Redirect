<?php

$installer = $this;
$installer->startSetup();
$connection = $installer->getConnection();
$orderTable = $installer->getTable('sales_flat_order_payment');
$connection->addColumn($orderTable, 'dibs_easy_cc_masked_pan',
    array(
        'type'=>Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => '16',
        'unsigned' => true,
        'nullable' => true,
        'default' => NULL,
        'comment' => 'Dibs Easy Credit Card Masked Pan'
    )
);
$quoteTable = $installer->getTable('sales_flat_quote_payment');
$connection->addColumn($quoteTable, 'dibs_easy_cc_masked_pan',
    array(
        'type'=>Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => '16',
        'unsigned' => true,
        'nullable' => true,
        'default' => NULL,
        'comment' => 'Dibs Easy Credit Card Masked Pan'
    )
);
$installer->endSetup();