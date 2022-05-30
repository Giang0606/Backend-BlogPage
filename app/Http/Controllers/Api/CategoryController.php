<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAllCategory();

        return response()->json([
            'code' => 200,
            'status' => "success",
            'data' => $categories,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $dataInsert = [
            'category_name' => $request->category_name,
            'description' => $request->description,
        ];

        if (!empty($this->categoryRepository->findCategoryByName($request['category_name']))) {
            return response()->json([
                'code' => 409,
                'status' => "error",
                'message' => "Category name exists",
            ]);
        }

        $this->categoryRepository->createCategory($dataInsert);

        return response()->json([
            'code' => 201,
            'status' => "success",
            'message' => "Category created successfully",
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->findCategory($id);

        if (empty($category)) {
            return response()->json([
                'code' => 204,
                'status' => "error",
                'message' => "Category not found",
            ], 204);
        }

        return response()->json([
            'code' => 200,
            'status' => "success",
            'data' => $category,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryRepository->findCategory($id);

        if (empty($category)) {
            return response()->json([
                'code' => 204,
                'status' => "error",
                'message' => "Category not found",
            ], 204);
        } 

        else {
            $dataUpdate = [
                'id' => $id,
                'category_name' => $request->category_name,
                'description' => $request->description,
            ];

            if (!empty($this->categoryRepository->checkExistName($dataUpdate))) {
                return response()->json([
                    'code' => 409,
                    'status' => "error",
                    'message' => "Category name exists",
                ]);
            }

            $this->categoryRepository->updateCategory($dataUpdate);

            return response()->json([
                'code' => 200,
                'status' => "success",
                'message' => "Category updated successfully",
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($this->categoryRepository->findCategory($id))) {
            return response()->json([
                'code' => 204,
                'status' => "error",
                'message' => "Category not found",
            ], 204);
        }

        $this->categoryRepository->deleteCategory($id);

        return response()->json([
            'code' => 200,
            'status' => "success",
            'message' => "Category deleted successfully",
        ], 200);
    }

    public function search($key)
    {
        $data = $this->categoryRepository->findByKey($key);

        if (empty($data)) {
            return response()->json([
                'code' => 204,
                'status' => "error",
                'message' => "No content",
            ], 204);
        } 

        else {
            return response()->json([
                'code' => 200,
                'status' => "success",
                'data' => $data,
            ], 200);
        }
    }
}
