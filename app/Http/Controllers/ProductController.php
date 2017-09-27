<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Order;
use Auth;

use Illuminate\Http\Request;
use App\http\Requests;
use Session;
use Stripe\Stripe;
use Stripe\Charge;

class ProductController extends Controller
{
    public function getIndex(){
    	$products = Product::all();
    	return view('shop.index', ['products' => $products ]);
    }

    public function getAddToCart(Request $request, $id){
    	$product = Product::find($id);
    	$oldcart = Session::has('cart') ? Session::get('cart') : null;
    	$cart = new Cart($oldcart);
    	$cart->add($product, $product->id);

    	$request->session()->put('cart', $cart);
    	/*dd($request->session());*/
    	return redirect()->route('product.index');
    }

    public function getCart(){
    	if(!Session::has('cart')) {
    		return view('shop.shopping-cart', ['products' => null]);
    	}

    	$oldcart = Session::get('cart');
    	$cart = new Cart($oldcart);
    	return view('shop.shopping-cart', ['products' => $cart->items, 
    									   'totalPrice' => $cart->totalPrice ] );
    }

    public function getCheckout(){
        if(!Session::has('cart')) {
            return view('shop.shopping-cart', ['products' => null]);
        }

        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request){

        if(!Session::has('cart')){
            return redirect()->route('shop.shoppingCart');
        }
        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);

        Stripe::setApikey('sk_test_yoSF1395fwhJ1L7HtPmKdzKY');

        try {
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice *100 ,
                "currency" => "usd",
                "description" => "Test Charge",
                "source" => $request->input('stripeToken'),
            ));

            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;

            Auth::user()->orders()->save($order);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('checkout')->with('error', $error);
        }
        Session::forget('cart');
        return redirect()->route('product.index')->with('sucess','Sucessfully Purchased');
    }
}
