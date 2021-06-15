<?php

namespace App\Http\Controllers;


use Validator;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  //


  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['login', 'register']]);
  }


  public function test(){
    return response()->json(['data' => 'hello world']);
  }

  /**
   * Get a JWT via given credentials.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request){

    $validator = Validator::make($request->all(), [
      'email' => 'required|max:50',
      'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }


    if (! $token = auth()->attempt($validator->validated())) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
    // dd($request->email);
    return $this->respondWithToken($token);
    
  }


  /**
   * Register a User.
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function register(Request $request) {
  // return response()->json($request['name']);
    // $validator = Validator::make($request->all(), [
    //   'name' => 'required|string|max:90',
      // 'last_name' => 'required|string|max:90',
    //   'username' => 'required|string|unique:users|max:90',
    //   'phone' => 'required|max:15',
    //  'email' => 'email|unique:users',
    //   'gender' => 'required|in:m,f',
      // 'country' => 'string|max:60',
//      'state' => 'string|max:60',
//      'lga' => 'string|max:60',
//      'address' => 'string|max:150',
    //   'password' => 'required|string|min:6'
    // ]);

    // if($validator->fails()){
    //   return response()->json($validator->errors()->toJson(), 400);
    // }

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->save();
    // $user = User::create(array_merge(
    //   $validator->validated(),
    //   [
    //     'password' => bcrypt($request->password),
    //     'referral' => $this->setReferral($request->input('first_name'))
    //   ]
    // ));

    return response()->json([
      'message' => 'User successfully registered',
      'data' => $user,
      'success' => true
    ], 201);
  }




  /**
   * Get the authenticated User.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function me()
  {
    return response()->json(new UserResource(auth()->user()));
  }

  /**
   * Log the user out (Invalidate the token).
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function logout()
  {
    auth()->logout();

    return response()->json(['message' => 'Successfully logged out']);
  }

  /**
   * Refresh a token.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function refresh()
  {
    return $this->respondWithToken(auth()->refresh());
  }

  /**
   * Get the token array structure.
   *
   * @param  string $token
   *
   * @return \Illuminate\Http\JsonResponse
   */
  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60,
      // 'user' => new UserResource(auth()->user())
     'user' => auth()->user()
    ]);
  }

  public function setReferral($fullName){
    $initial = strtoupper(substr($fullName, 0, 3));
    $randomNumber = '';
    for($i = 0; $i < 3; $i++) {
      $randomNumber .= mt_rand(0, 9);
    }
    $referral = $initial.$randomNumber;

    $user = User::where('referral', $referral)->first();
    if ($user === null) {
      // user doesn't exist.
      return $referral;
    }
    $this->setReferral($fullName);

  }
}
