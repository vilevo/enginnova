<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

use DB;
use Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    // public function register(Request $request)
    // {
    //     $input = $request->all();
    //     $validator = $this->validator($input);

    //     if ($validator->passes()) {
    //         $user = $this->create($input)->toArray();
    //         $user['link'] = str_random(30);

    //         DB::table('verify_users')->insert(['user_id' => $user['id'], 'token' => $user['link']]);
    //         Mail::send('email.activation', $user, function($message) use ($user) {
    //             $message->to($user['email']);
    //             $message->subject('message activation');
    //         });
    //         return redirect()->to('login')->with('info', 'we sent an email');
    //     }
    //     return back()->with('Error', $validator->errors());
    // }

    // public function userActivation($token)
    // {
    //     $check = DB::table('verify_users')->where('token', $token)->first();
    //     if (is_null($check)) {
    //         $user = User::find($check->user_id);
    //         if ($user->status == 1) {
    //              return redirect()->to('login')->with('info', 'user deja active');
    //         }
    //         $user->update(['status' => TRUE]);
    //     DB::table('status')->where('token',$token)->delete();
    //     return redirect()->to('login')->with('info','user active youpi');
    //     }
    //     return redirect()->to('login')->with('info','token invalid');
        
    // }

}
