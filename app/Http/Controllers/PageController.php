<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Cart;
use App\Customer;
use App\Http\Requests\postCheckOut;
use App\Product;
use App\ProductType;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{

    public function index()
    {
        $slide = Slide::all();
        $new_product = Product::where('new', 1)->paginate(4);
        $total_new_product = Product::where('new', 1)->get();
        $sale_product = Product::where('promotion_price', '<>', 0)->paginate(8);
        $total_sale_product = Product::where('promotion_price', '<>', 0)->get();
        $cart = Session::get('cart');
        $product_type = ProductType::all();
        return view('layout.index', compact('slide', 'new_product',
            'sale_product', 'cart', 'product_type', 'total_new_product', 'total_sale_product'));
    }

    public function getProductType($type)
    {
        $product_type = Product::where('id_type', $type)->get();
        $product_khac = Product::where('id_type', '<>', $type)->paginate(3);
        $type = ProductType::all();
        $type_sp = ProductType::findOrFail($type);
        return view('layout.ProductType', compact('product_type', 'product_khac', 'type', 'type_sp'));
    }

    public function getProductDetail($id)
    {
        $product = Product::findOrFail($id);
        $products = Product::where("id_type", $product->id_type)->paginate(3);
        return view('layout.ProductDetail', compact('product', 'products'));
    }

    public function getContact()
    {
        return view('layout.contact');
    }

    public function getAbout()
    {
        return view('layout.about');
    }

    public function getAdCart($productId)
    {
        $product = Product::findOrFail($productId);
        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
        } else {
            $oldCart = null;
        }
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        Session::put('cart', $cart);
        Session::flash('success', 'Thêm sản phẩm khỏi giỏ hàng thành công');
        return redirect()->back();
    }

    public function getShoppingCart()
    {
        $cart = Session::get('cart');
        return view('layout.shopping_cart', compact('cart'));
    }

    public function getCheckOut()
    {
        $cart = Session::get('cart');
        return view('layout.checkout', compact('cart'));
    }

    public function postCheckOut(postCheckOut $request)
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->phone_number = $request->phone;
            $customer->note = $request->note;
            $customer->save();

            $bill = new  Bill();
            $bill->id_customer = $customer->id;
            $bill->date_order = date('Y-m-d');
            $bill->total = $cart->totalPrice;
            $bill->payment = $request->payment;
            $bill->note = $request->note;
            $bill->save();

            foreach ($cart->items as $key => $value) {
                $bill_detail = new BillDetail();
                $bill_detail->id_bill = $bill->id;
                $bill_detail->id_product = $key;
                $bill_detail->quantity = $value['qty'];
                $bill_detail->unit_price = ($value['price'] / $value['qty']);
                $bill_detail->save();
            }
            Session::forget('cart');
        }
        return redirect()->back()->with('thongbao', 'Đã đặt hàng thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $total = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->paginate(8);
        return view('layout.Search', compact('products', 'total'));
    }


}
