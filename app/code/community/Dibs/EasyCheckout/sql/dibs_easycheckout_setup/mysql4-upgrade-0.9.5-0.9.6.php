<?php

$installer = $this;
$installer->startSetup();
$connection = $installer->getConnection();
$orderTable = $installer->getTable('sales_flat_order_payment');
$connection->addColumn($orderTable, 'dibs_easy_payment_type',
    array(
        'type'=>Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => '200',
        'unsigned' => true,
        'nullable' => true,
        'default' => NULL,
        'comment' => 'Dibs Easy Payment Type'
    )
);
$quoteTable = $installer->getTable('sales_flat_quote_payment');
$connection->addColumn($quoteTable, 'dibs_easy_payment_type',
    array(
        'type'=>Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => '200',
        'unsigned' => true,
        'nullable' => true,
        'default' => NULL,
        'comment' => 'Dibs Easy Payment Type'
    )
);
$installer->endSetup();