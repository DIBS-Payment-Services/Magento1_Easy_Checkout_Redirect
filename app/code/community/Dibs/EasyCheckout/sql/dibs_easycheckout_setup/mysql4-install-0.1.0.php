<?php

$installer = $this;
$installer->startSetup();

$connection = $installer->getConnection();

$orderTable = $installer->getTable('sales_flat_order');
$connection->addColumn($orderTable, 'dibs_easy_payment_id',
    array(
        'type'=>Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => '255',
        'unsigned' => true,
        'nullable' => true,
        'default' => NULL,
        'comment' => 'Dibs Easy Payment Id'
    )
);

$quoteTable = $installer->getTable('sales_flat_quote');
$connection->addColumn($quoteTable, 'dibs_easy_payment_id',
    array(
        'type'=>Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => '255',
        'unsigned' => true,
        'nullable' => true,
        'default' => NULL,
        'comment' => 'Dibs Easy Payment Id'
    )
);

$connection->addColumn($quoteTable, 'dibs_easy_grand_total',
    array(
        'type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,
        'scale'     => 4,
        'precision' => 12,
        'length' => '255',
        'unsigned' => true,
        'nullable' => true,
        'default' => NULL,
        'comment' => 'Dibs Easy Grand Total'
    )
);
$installer->endSetup();
