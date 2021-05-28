<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\CachesRoutes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = User::where('role', 'user')->get();
        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => $user->transform(function ($user) {
                return [
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'displayName' => $user->displayName,
                    'username' => $user->username,
                    'user_image'=> $user->user_image
                ];
            })
        ]);
    }

    public function show(Request $request)
    {
        $user = User::find($request->user_id);
        //$user = User::where('id', $request->user_id)->get();
        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => //$user->transform(function ($user) {
                //return 
                [
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'displayName' => $user->displayName,
                    'username' => $user->username,
                    'email' => $user->email,
                    'password' => $user->password,
                    'phoneNumber' => $user->phoneNumber,
                    'hasShop' => $user->hasShop,
                    'user_image'=> $user->user_image
                ]
            //})
        ]);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $status = 401;
        $response = ['error' => 'Invalid email or password'];

        if (Auth::attempt($credentials)) {
            $status = 200;
            $user = Auth::User();

            $response = [
                'user' => $user,
                'token' => $user->createToken('eatly')->accessToken,
                
            ];
        }

        return response()->json($response, $status);
    }

    public function consumerRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|alpha_dash|unique:users',
            'email' => 'required|email|unique:users',
            'password'  => ['required', 'string', 'min:8', 'regex:/[0-9]/'],
            'confirmPassword'  => ['required','same:password'],
        ],[
            'password.regex' => 'The password must include alphanumeric characters [a-z and 0-9]'
        ]);

        if ($validator->fails()) {
            $valid = $validator->errors();
            return response()->json(['errors' => $valid]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        $user->role = "user";
        $user->hasShop = "No";

        $success = [
            'user' => $user,
            'token' => $user->createToken('eatly')->accessToken,
        ];

       // return response()->json($success);
        return response()->json([
            'status' => $success,
            'message' => '$success' ? 'Welcome to Eatly ' : 'Error creating account'
        ]);
    }

    public function vendorRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required|alpha_dash|unique:users',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        $user->role = "consumer";
        $user->hasShop = "Yes";

        $success = [
            'user' => $user,
            'token' => $user->createToken('eatly')->accessToken,
        ];

        return response()->json($success);
    }

    public function store(Request $request)
    {      
        $fileExt = $request->file("profile_image")->getClientOriginalExtension();
        $name = $request->username.'_'. date("Y-m-d").'_'.time().'.'.$fileExt;
       // $user_image = config('app.url').'/images/user/'.$name;

        $user = User::updateOrCreate([
            'id' => $request->id,
        ],[
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'displayName' => $request->displayName,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'phoneNumber' => $request->phoneNumber,
            'role' => 'user',
            'hasShop' => $request->hasShop,
            'user_image'=> $name
        ]);

        if (!$user) {
            return response()->json([
                'status' => (bool) $user,
                'message' => '$user' ? 'Profile saved' : 'Error saving profile'
            ]);
        }

        return response()->json([
            'error'=> false,
            'message'=> 'Profile saved successfully',
            'data' => $user
        ]);
    }

    public function update(Request $request)
    {      
            $fileExt = $request->file("masterImage")->getClientOriginalExtension();
            $name = $request->username.'_'. date("Y-m-d").'_'.time().'.'.$fileExt;
            $storeFile = $request->file("masterImage")->move(public_path('images/vendor'), $name);
        // $user_image = config('app.url').'/images/user/'.$name;
            
            $user = User::findOrFail($request->id);

            $updateUser = $user->update(
            [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'displayName' => $request->displayName,
                'username' => $request->username,
                'phoneNumber' => $request->phoneNumber,
                'user_image'=> $name
            ]);

            if (!$updateUser) {
                return response()->json([
                    'status' => (bool) $user,
                    'message' => '$user' ? 'Profile updated' : 'Error updating profile'
                ]);
            }

            return response()->json([
                'error'=> false,
                'message'=> 'Profile updated successfully',
                //'data' => $user
            ]);
    }

    public function liveStatus($user_id){
        $user = User::find($user_id);

        if (Cache::has('user-is-online-' . $user->id))
            $status = 'Online';
        else
            $status = 'offline';

        if ($user->last_seen != null)
            $last_seen = "Active " . Carbon::parse($user->last_seen)->diffForHumans();
        else
            $last_seen = "No data";

        return response()->json([
            'status' => $status,
            'last_seen' => $last_seen,
        ]);
    }



    public function showOrders(User $user)
    {
        return response()->json($user->orders()->with(['meal'])->get());
    }
    
   
}
