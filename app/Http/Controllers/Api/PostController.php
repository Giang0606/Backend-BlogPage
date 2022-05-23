<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str; 
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->middleware('auth');
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->getAllPost();

        return response()->json([
            'data' => $posts,
        ]);
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
    public function store(PostRequest $request)
    {
        $title = $request['title']; 
        if(empty($title)) {
            $title = Str::limit($request['content'], $limit = 50, $end = '...'); 
        }

        $url = $request['url']; 
        if(empty($url)) {
            $url = Str::replace(' ', '-', $title);
        }

        $dataInsert = [
            'title' => $title, 
            'author' => JWTAuth::user()->username_login, 
            'url' => $url,
            'category' => $request->category,
            'content' => $request['content'],
        ];

        if($request->hasFile('image')) { 
            $image = $request->image; 
            $image_name = $image->hashName(); 
            $image->move(public_path('/images'), $image_name); 
            $dataInsert['image'] = $image_name; 
        }

        $this->postRepository->createPost($dataInsert);

        return response()->json([
            'message' => "Post created successfully",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($postUrl)
    {
        $post = $this->postRepository->findPostByUrl($postUrl);

        if (empty($post)) {
            return response()->json([
                'message' => "Post not found",
            ], 404);
        }

        return response()->json([
            'post' => $post,
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
    public function update(PostRequest $request, $postUrl)
    {
        $post = $this->postRepository->findPostByUrl($postUrl);

        if (empty($post)) {
            return response()->json([
                'message' => "Post not found",
            ], 404);
        }

        else {
            $title = $request['title']; 
            if(empty($title)) {
                $title = Str::limit($request['content'], $limit = 50, $end = '...'); 
            }

            $url = $request['url']; 
            if(empty($url)) {
                $url = Str::replace(' ', '-', $title);
            } else {
                $url = Str::replace(' ', '-', $url);
            }

            $dataUpdate = [
                'id' => $post->id,
                'title' => $title, 
                'author' => JWTAuth::user()->username_login, 
                'url' => $url,
                'category' => $request->category,
                'content' => $request['content'],
            ];

            if($request->hasFile('image')) { 
                $oldPhoto = $post->image; 
                if ($oldPhoto != '')
                    File::delete(public_path().'/images/'. $oldPhoto); 
    
                $image = $request->image; 
                $image_name = $image->hashName(); 
                $image->move(public_path('/images'), $image_name); 
                $dataUpdate['image'] = $image_name; 
            }

            $this->postRepository->updatePost($dataUpdate);

            return response()->json([
                'data' => $dataUpdate,
                'message' => "Post updated successfully",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($postUrl)
    {
        if (empty($this->postRepository->findPostByUrl($postUrl))) {
            return response()->json([
                'message' => "Post not found",
            ], 404);
        }

        $this->postRepository->deletePost($postUrl);

        return response()->json([
            'message' => "Post deleted successfully",
        ]);
    }
}
