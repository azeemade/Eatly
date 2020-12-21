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
    public function show(User $user)
    {
        return response()->json($user, 200);

    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $status = 401;
        $response = ['error' => 'Unauthorized'];

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
            'phoneNumber' => 'required|numeric|unique:users|max:11',
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
        $user->hasShop = "No";

        $success = [
            'user' => $user,
            'token' => $user->createToken('eatly')->accessToken,
        ];

        return response()->json($success);
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

    public function showOrders(User $user)
    {
        return response()->json($user->orders()->with(['meal'])->get());
    }

    public function update(Request $request, User $user)
    {
        $status = $user->update(
            $request->only(['firstname', 'lastname', 'phoneNumber'])
        );

        return response()->json([
            'status' => $status, 
            'message' => $status ? 'User updated!' : 'Error updating user data'
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
    
   
}
