<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreate;
use App\Http\Requests\CategoryUpdate;
use App\Product;
use App\ProductType;
use App\Repository\Contracts\CategoryRepositoryInterface;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use function Sodium\compare;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->middleware('auth');
        $this->middleware('checkadmin');
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $category = $this->categoryRepository->getAll();
        return view('admin.category.list', compact('category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryCreate $request)
    {
//        $file = new Filesystem();
//        $file->delete('storage/images/m7beCDrGg7EpFQtuZB48WNldeLvXGuCHIE4Mtgwi.png');

        $category = new ProductType();
        $category->name = $request->name;
        $category->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $file->store('source/image/product', 'public');
            $category->image = $file->hashName();
        }
        $this->categoryRepository->create($category);
        return redirect()->route('admin.category.index');
    }


    public function show($id)
    {
        //
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $total = ProductType::where('name', 'LIKE', '%' . $keyword . '%')->get();
        $products = ProductType::where('name', 'LIKE', '%' . $keyword . '%')->paginate(8);
        return view('admin.category.search', compact('total', 'products'));
    }

    public function edit($id)
    {
        $category = ProductType::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

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
