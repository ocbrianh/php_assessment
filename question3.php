<?php
class Address {
    protected $line_1, $line_2, $city, $state, $zip;

    public function __construct($line_1, $line_2, $city, $state, $zip) {
        $this->line_1 = $line_1;
        $this->line_2 = $line_2;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
    }
    
    public function getLine1() {
        return $this->line_1;
    }
    
    public function getLine2() {
        return $this->line_2;
    }
    
    public function getCity() {
        return $this->city;
    }
    
    public function getState() {
        return $this->state;
    }
    
    public function getZip() {
        return $this->zip;
    }
}

class Customer {
    protected $first_name, $last_name;
    protected $addresses = [];

    public function __construct($first_name, $last_name, array $addresses = []) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->addresses = $addresses;
    }
    
    public function getAddresses() {
        return $this->addresses;
    }
    
    public function addAddress(Address $address) {
        $this->addresses[] = $address;
    }
    
    public function getFirstlName() {
        return $this->first_name;
    }
    
    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }
    
    public function getLastName() {
        return $this->last_name;
    }
    
    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }
}

class Item {
    protected $id, $name, $quantity, $price;

    public function __construct($id, $name, $quantity, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
    
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
    
    public function getPrice() {
        return $this->price;
    } 
    
    public function setPrice($price) {
        $this->price = $price;
    }
}

class Cart {
    private $customer;
    protected $items = [];
    private $tax_rate = 0.07;
    private $shipping_address;

    public function __construct(Customer $customer) {
        $this->customer = $customer;
    }

    public function addItem(Item $item) {
        $this->items[] = $item;
    }
    
    public function getItems() {
        return $this->items;
    }
    
    public function getCustomer() {
        return $this->customer;
    }
    
    public function setShippingAddress(Address $address) {
        $this->shipping_address = $address;
    }
    
    public function getShippingAddress() {
        return $this->shipping_address;
    }
    
    public function getSubTotal() {
        $subtotal = 0;
        foreach ($this->items as $item) {
            $subtotal += $item->getPrice() * $item->getQuantity();
        }
        
        return number_format((float)$subtotal, 2, '.', '');
    }

    public function calculateTotal() {
        $subtotal = $this->getSubTotal();
        
        $tax = $subtotal * $this->tax_rate;
        $shipping = $this->getShippingRate();
        // $shipping = 50;
        $total = $subtotal + $tax + $shipping;
        return number_format((float)$total, 2, '.', '');
    }
}

// Address Instances
$billing_address = new Address('123 Long St', '', 'Denver', 'CO', '80014');
$another_address = new Address('321 Test St', '', 'Boulder', 'CO', '80301');
$shipping_address = new Address('123 Test St', '', 'Boulder', 'CO', '80301');

// Item Instances
$item1 = new Item(1, 'Widget', 2, 9.99);
$item2 = new Item(2, 'Thing', 1, 5.99);
$item3 = new Item(3, 'Gadget', 3, 19.99);

// Customer Instance
$customer = new Customer('Test', 'Buyer', [$billing_address, $another_address]);

// Cart Instance
$myCart = new Cart($customer);

// Add Items to Cart
$myCart->addItem($item1);
$myCart->addItem($item2);
$myCart->addItem($item3);

// Set Cart Shipping Address
$myCart->setShippingAddress($shipping_address);

// Print Customer First And Last Name
echo $myCart->getCustomer()->getFirstlName() . " " . $myCart->getCustomer()->getLastName() . "\n";

// Retrieve Customer Addresses
$customerAddresses = $myCart->getCustomer()->getAddresses();
echo "Billing Addresses:\n";
foreach ($customerAddresses as $address) {
    echo $address->getLine1() . "\n";
    echo $address->getCity() . ", " . $address->getState() . " " . $address->getZip() . "\n";
}

// Print Shipping Address
echo "Shipping Address:\n";
echo $myCart->getShippingAddress()->getLine1() . "\n";
echo $myCart->getShippingAddress()->getCity() . ", " . $myCart->getShippingAddress()->getState() . " " . $myCart->getShippingAddress()->getZip() . "\n";

// Print Items in Cart
$myItems = $myCart->getItems();
echo "Items in Cart:\n";
foreach ($myItems as $item) {
    echo $item->getName() . " " . $item->getQuantity() . " " . $item->getPrice() . "\n";
}

// Total Cost
echo "Total: " . $myCart->calculateTotal() . "\n";

// Subtotal
echo "Subtotal: " . $myCart->getSubTotal() . "\n";

