# Magento 1 Module for Easy Checkout #

This is the Magento 1 module for NETS Easy Checkout, for more information see the following

[Easy Checkout](http://tech.dibspayment.com/easy/)


### Setting up ###

* Go to your Magento administration
* Go to ```System > Configuration > Payment Methods```
* Find ``` Easy Checkout``` in the list of checkout options
* Set enable Easy Checkout to ```Yes```
* Set Live/Test secret/checkout keys and select an order status to new orders (Note orders are fully paid once they appear in the system) 

### Disabling Standard checkout ###

If you wish to disable the standard checkout you can do this in the following way

* Go to your Magento administration
* Go to ```System > Configuration > Checkout```
* Under Checkout Options, in the field: ```Enable Onepage Checkout``` choose ```No```
