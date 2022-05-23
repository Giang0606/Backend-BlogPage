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

        $this->categoryRepository->createCategory($dataInsert);

        return response()->json([
            'message' => "Category created successfully",
        ], 200);
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
                'message' => "Category not found",
            ], 404);
        }

        return response($category, 200);
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
    public function update(Request $request, $id)
    {
        $category = $this->categoryRepository->findCategory($id);

        if (empty($category)) {
            return response()->json([
                'message' => "Category not found",
            ], 404);
        } 

        else {
            $category_name = is_null($request->category_name) ? $category['category_name'] : $request['category_name'];
            $description = is_null($request->description) ? $category['description'] : $request['description'];

            $dataUpdate = [
                'id' => $id,
                'category_name' => $category_name,
                'description' => $description,
            ];

            $this->categoryRepository->updateCategory($dataUpdate);

            return response()->json([
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
                'message' => "Category not found",
            ], 404);
        }

        $this->categoryRepository->deleteCategory($id);

        return response()->json([
            'message' => "Category deleted successfully",
        ], 200);
    }

    public function search($key)
    {
        $data = $this->categoryRepository->findByKey($key);

        if (empty($data)) {
            return response()->json([
                'message' => "Not found",
            ], 200);
        } 

        else {
            return response()->json([
                'data' => $data,
            ], 200);
        }
    }
}
