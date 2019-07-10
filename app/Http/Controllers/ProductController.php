<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreate;
use App\Product;
use App\ProductType;
use App\Repository\Contracts\ProductRepositoryInterface;
use App\Services\Impl\ProductServices;
use App\Services\Services;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $total = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->paginate(8);
        return view('admin.category.search', compact('total', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ProductType::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdate $request, $id)
    {
        $category = ProductType::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        if ($request->hasFile('image')) {
            $this->deleteFile('source/image/product/' . $category->image);
            $file = $request->image;
            $file->store('source/image/product', 'public');
            $category->image = $file->hashName();
        }
        $this->categoryRepository->create($category);
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->findById($id);
        $products = Product::where('id_type', $id)->get();
        foreach ($products as $key => $value) {
            $product = Product::findOrFail($value->id);
            $this->deleteFile("storage/source/image/product/$value->image");
            $product->delete();
        }
        $this->deleteFile("storage/source/image/product/$category->image");
        $this->categoryRepository->delete($category);
        return redirect()->route('admin.category.index');
    }

    public function deleteFile($url)
    {
        $file = new Filesystem();
        $file->delete($url);
    }
}
