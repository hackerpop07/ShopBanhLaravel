<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $storedItem = ['qty' => 0, 'price' => $item->unit_price,
            'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $this->totalQty++;
        if ($item->promotion_price == 0) {
            $storedItem['price'] = $item->unit_price * $storedItem['qty'];
            $this->totalPrice += $item->unit_price;
        } else {
            $storedItem['price'] = $item->promotion_price * $storedItem['qty'];
            $this->totalPrice += $item->promotion_price;
        }
        $this->items[$id] = $storedItem;
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        if ($this->totalQty == 0) {
            $this->totalPrice = 0;
        }
        unset($this->items[$id]);
    }


    public function update(Request $request, $id)
    {
        if ($this->items && $request->qty > 0) {
            $itemsIntoCart = $this->items;
            if (array_key_exists($id, $itemsIntoCart)) {
                $itemUpdate = $itemsIntoCart[$id];
                $qtyUpdate = $request->qty - $itemUpdate['qty'];
                $this->totalQty += $qtyUpdate;
                if ($itemUpdate['item']['promotion_price'] == 0) {
                    $priceUpdate = $itemUpdate['item']['unit_price'] * $request->qty - $itemUpdate['price'];
                    $this->totalPrice += $priceUpdate;
                    $itemUpdate['price'] = $itemUpdate['item']['unit_price'] * $request->qty;
                } else {
                    $priceUpdate = $itemUpdate['item']['promotion_price'] * $request->qty - $itemUpdate['price'];
                    $this->totalPrice += $priceUpdate;
                    $itemUpdate['price'] = $itemUpdate['item']['promotion_price'] * $request->qty;
                }
                $itemUpdate['qty'] = $request->qty;
                $this->items[$id] = $itemUpdate;
            }
        }
    }
}
