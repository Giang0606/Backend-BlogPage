<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAllUser();

        return response()->json([
            'data' => $users,
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findUser($id);

        if (empty($user)) {
            return response()->json([
                'message' => "User not found",
            ], 404);
        }

        return response()->json([
            'user' => $user,
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
    public function update(UserRequest $request, $id)
    {
        $user = $this->userRepository->findUser($id);

        if (empty($user)) {
            return response()->json([
                'message' => "User not found",
            ], 404);
        }
        
        else {
            $dataUpdate = [
                'id' => $id,
            ];

            foreach ($request->all() as $f => $f_value) {
                $dataUpdate[$f] = $f_value;
            }

            if($request->hasFile('photo_url')) {
                $oldPhoto = $user->photo_url; 
                if($oldPhoto != "default-profile.png")
                    File::delete(public_path().'/images/'. $oldPhoto); 
    
                $image = $request->photo_url; 
                $image_name = $image->hashName(); 
                $image->move(public_path('/images'), $image_name); 
                $dataUpdate['photo_url'] = $image_name; 
            }

            $this->userRepository->updateUser($dataUpdate);

            return response()->json([
                'message' => "User update successfully",
            ]);
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
        if (empty($this->userRepository->findUser($id))) {
            return response()->json([
                'message' => "User not found",
            ], 404);
        }

        $this->userRepository->deleteUser($id);

        return response()->json([
            'message' => "User deleted successfully",
        ], 200);
    }
}
