<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreate;
use App\Http\Requests\ProductUpdate;
use App\Product;
use App\ProductType;
use App\Repository\Contracts\ProductRepositoryInterface;
use App\Services\Impl\ProductServices;
use App\Services\Services;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkadmin');
    }

    public function index()
    {
        $products = Product::paginate(8);
        return view('admin.product.list', compact('products'));
    }


    public function create()
    {
        $category = ProductType::all();
        return view('admin.product.create', compact('category'));
    }


    public function store(ProductCreate $request)
    {
//        $file = new Filesystem();
//        $file->delete('storage/images/m7beCDrGg7EpFQtuZB48WNldeLvXGuCHIE4Mtgwi.png');

        $product = new Product();
        $product->name = $request->name;
        $product->id_type = $request->id_type;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->promotion_price = $request->promotion_price;
        $product->unit = $request->unit;
        $product->new = $request->new;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $file->store('source/image/product', 'public');
            $product->image = $file->hashName();
        }
        $product->save();
        return redirect()->route('admin.product.index');
    }

    public function show($id)
    {
        //
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $total = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->paginate(8);
        return view('admin.product.search', compact('total', 'products'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = ProductType::all();
        return view('admin.product.edit', compact('product', 'category'));
    }

    public function update(ProductUpdate $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->id_type = $request->id_type;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->promotion_price = $request->promotion_price;
        $product->unit = $request->unit;
        $product->new = $request->new;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $file->store('source/image/product', 'public');
            $product->image = $file->hashName();
        }
        $product->save();
        return redirect()->route('admin.product.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->deleteFile("storage/source/image/product/$product->image");
        $product->delete();
        return redirect()->route('admin.product.index');
    }

    public function deleteFile($url)
    {
        $file = new Filesystem();
        $file->delete($url);
    }
}
