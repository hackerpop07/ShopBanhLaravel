<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category as CategoryResources;
use App\ProductType;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        try {
            $categories = ProductType::all();
            return response()->json([
                'status' => 'success',
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $category = $request->isMethod('post') ? new  ProductType :
                ProductType::findOrFail($request->id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->image = $request->image;
            if ($category->save()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $category
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        try {
            $categories = ProductType::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $categories = ProductType::findOrFail($id);
            if ($categories->delete()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $categories
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function search(Request $request)
    {
        try {
            $keyword = $request->keyword;
            $categories = ProductType::where('name', 'LIKE', '%' . $keyword . '%')->get();
            if (count($categories) !== 0) {
                return response()->json([
                    'status' => 'success',
                    'data' => $categories
                ]);
            } else {
                return response()->json([
                    'status' => 'Lỗi',
                    'message' => 'Không Có Giá Trị Này'
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }
}
