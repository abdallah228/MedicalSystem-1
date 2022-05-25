<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mobile\OrderdsResource;
use App\Models\Ad;
use App\Models\Delivery;
use App\Models\Reservation;
use Illuminate\Support\Facades\Log;
use App\Models\User  as Model;
use App\Models\User;
use Illuminate\Http\Request;

// use App\Http\Requests\Admin\  as CreateRequest;
// use App\Http\Requests\Admin\  as UpdateRequest;

class ClientController extends Controller
{

    public $loginAfterSignUp = true;

    public function register(Request $request)
    {
      $user = User::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'password' => bcrypt($request->password),
      ]);
      $token = auth()->login($user);
      return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
      $credentials = $request->only(['phone', 'password']);

      if (!$token = auth('client')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }

      return $this->respondWithToken($token);
    }


    public function logout()
    {
        auth('client')->logout();
        return response()->json(['message'=>'Successfully logged out']);
    }
    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'data' => auth('client')->user(),
      ]);
    }


    /**
     * ClientProfil
     */

    public function profile()
     {
         $records = auth('client')->user();
         return response()->json([
             'success'=>true,
             'data'=>$records,
         ]);
     }

    public function deliviries(Request $request)
    {
        $paginate = $request->itemPerPage ?? 10;
        $records = Delivery::paginate($paginate);
        return response()->json([
            'success'=>true,
            'data'=>$records,
        ]);
    }

    public function ads()
    {
        $records = Ad::latest()->take(5)->whereActive(true)->get();
        return response()->json([
            'success'=>true,
            'data'=>$records,
        ]);
    }

    public function orders()
    {
       $client = auth('client')->user()->id;
       $orders =Reservation::whereUserId($client)->get();

       return response()->json([
        'success' => true,
        'data' => OrderdsResource::collection($orders),
    ]);

       return response()->json([
            'success'=>true,
            'data'=>$orders,
       ]);
    }
}
