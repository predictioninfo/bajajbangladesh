<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
       //$this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function login(Request $request){
    // 	$validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required|string|min:6',
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }
    //     if (! $token = auth()->attempt($validator->validated())) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }
    //     return $this->createNewToken($token);
    // }

    public function login(Request $request){
        
        //echo "ok"; exit;

        $word = '@';
        $mystring = $request->emailPhone;
        // Test if string contains the letter 
        if(strpos($mystring, $word) !== false){
         ######################### Login With Email Code Starts From Here ####################### 

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
 
             if(User::where('email',$request->emailPhone)->where('is_active',1)->where('users_bulk_deleted','No')->exists()){
 
                 $stored = User::where('email',$request->emailPhone)->get();
 
                 foreach($stored as $stored_data){
 
                     if(password_verify($request->password, $stored_data->password)){

                                $credentials = ['email' => $request->emailPhone, 'password'=>$request->password];

                                if (! $token = auth('api')->attempt($credentials)) {
                                    return response()->json(['error' => 'Unauthorized'], 401);
                                }
                                return $this->createNewToken($token);
                         }else{
             
                         return response()->json([
                             'success' => false,
                             'message' => 'Incorrect Password',
                         ])->setStatusCode(200);
                         }                              
                 }
 
             }else{
                 return response()->json([
                     'success' => false,
                     'message' => 'These credentials do not match our records. Or you are not an active user!!!',
                 ])->setStatusCode(200);
             }
             
         ######################### Login With Email Code Ends Here ####################### 
 
        }else{
 
        ######################### Login With Phone Number Code Starts From Here ####################### 

            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'password' => 'required',
            ]);
 
             if(User::where('phone',$request->emailPhone)->where('is_active',1)->where('users_bulk_deleted','No')->exists()){
 
                 $stored = User::where('phone',$request->emailPhone)->get();
 
                 foreach($stored as $stored_data){

                     if(password_verify($request->password, $stored_data->password)){

                                $credentials = ['phone' => $request->emailPhone, 'password'=>$request->password];

                                if (! $token = auth('api')->attempt($credentials)) {
                                    return response()->json(['error' => 'Unauthorized'], 401);
                                }
                                return $this->createNewToken($token);
             
                         }else{
             
                         return response()->json([
                             'success' => false,
                             'message' => 'Incorrect Password',
                         ])->setStatusCode(200);
                         }
                 }
 
             }else{
                 return response()->json([
                     'success' => false,
                     'message' => 'These credentials do not match our records. Or you are not an active user!!!',
                 ])->setStatusCode(200);
             }
             
         ######################### Login With Phone Number Code Ends Here ####################### 
         
        }

    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|between:2,100',
        //     'email' => 'required|string|email|max:100|unique:users',
        //     'password' => 'required|string|confirmed|min:6',
        // ]);
        // if($validator->fails()){
        //     return response()->json($validator->errors()->toJson(), 400);
        // }
        // $user = User::create(array_merge(
        //             $validator->validated(),
        //             ['password' => bcrypt($request->password)]
        //         ));
        // return response()->json([
        //     'message' => 'User successfully registered',
        //     'user' => $user
        // ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth('api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => auth()->factory()->getTTL() * 60,
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }
}
