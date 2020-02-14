<?php

class Dibs_EasyCheckout_Block_Cart_Sidebar extends Mage_Checkout_Block_Cart_Sidebar {
    
    
    public function getCheckoutUrl() {
        return $this->getUrl('dibseasy/checkout');
    }
    
}