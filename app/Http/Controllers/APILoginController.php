<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class APILoginController extends Controller {

    use \App\Traits\WebServicesDoc;
    /**
     * Get a token via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
    public function login(Request $request) {

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if($validator->fails()){
            abort(400,$validator->errors()->first());
        }

        $credentials = request(['email', 'password']);

        $user = User::where('email',$credentials['email'])->first();

        if(!$user){
            abort(401,__('Invalid username or password.'));
        }


        if (!Hash::check($credentials['password'], $user->password)) {
            abort(401,__('Invalid username or password.'));
        }
        
        if (auth()->attempt($credentials)) {
   
            $oResponse['token'] = auth()->user()->createToken('user')->accessToken;
            $oResponse['user'] = auth()->user();

            $oResponse = responseBuilder()->success(__('Logged in successfully',["mod"=>"User"]), $oResponse, true);
            $this->urlRec(0, 0, $oResponse);
            return $oResponse;  
            
        } else {
            abort(401,__('Invalid username or password.'));
        }
    }

    public function register(Request $request){

        $input = $request->all();

        $validator = Validator::make($input,[
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            abort(400,$validator->errors()->first());
        }

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password'])
        ]);

        $oResponse['token'] = $user->createToken('user')->accessToken;
        $oResponse['user'] = $user;
        
        $oResponse = responseBuilder()->success(__('User Created Successfully',["mod"=>"User"]), $oResponse, true);
        $this->urlRec(0, 1, $oResponse);
        return $oResponse;
    }

    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();
        $oResponse = responseBuilder()->success(__('Successfully logged out'));
        $this->urlRec(0, 2, $oResponse);
        return $oResponse;
    }
}