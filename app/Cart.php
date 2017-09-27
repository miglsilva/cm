<?php

namespace App;
 

class Cart  
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldcart){
		if($oldcart){
			$this->items = $oldcart->items;
			$this->totalQty = $oldcart->totalQty;
			$this->totalPrice = $oldcart->totalPrice;
		}
	}

	public function add($item, $id){
		$storeItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$storeItem = $this->items[$id];
			}
		}
		$storeItem['qty']++;
		$storeItem['price'] = $item->price * $storeItem['qty'];
		$this->items[$id] = $storeItem;
		$this->totalQty++;
		$this->totalPrice += $item->price;
	}

}
