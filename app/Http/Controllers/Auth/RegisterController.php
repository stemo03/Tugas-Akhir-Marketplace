<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Category;
use App\Models\User_roles;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Store;
// App\Http\Controllers\Auth\RegisterController
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
    protected $redirectTo = RouteServiceProvider::REGISTER;

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
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {   
        $categories = Category::all();

        $type = DB::select(DB::raw('SHOW COLUMNS FROM stores WHERE Field = "type"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        // passing data ke view
        return view('auth.register', [
            'categories' => $categories,
            'values' => $values,
        ]);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'store_name' => ['nullable', 'string', 'max:255'],
            'categories_id' => ['nullable', 'integer', 'exists:categories,id'],
            'is_store_open' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if($data['is_store_open'] == "true") {

            User_roles::create([
                'role_id' => 2,
                'user_id' => $user->id
            ]);
            
            User_roles::create([
                'role_id' => 3,
                'user_id' => $user->id,
            ]);;

            Store::create([
                'store_name' => isset($data['store_name']) ? $data['store_name'] : '',
                'categories_id' => isset($data['categories_id']) ? $data['categories_id'] : NULL,
                // 'store_status' => $data['is_store_open'] == "true" ? 1 : 0,
                'store_status' => 0,
                'id_card' => isset($data['id_card']) ? $data['id_card'] : '',
                'type' => isset($data['type']) ? $data['type'] : '',
                'file' => isset($data['file']) ? $data['file'] : '',
                'user_id' => $user->id,
            ]);
        

        }
        elseif($data['is_store_open'] == 0){
            
            User_roles::create([
                'role_id' => 2,
                'user_id' => $user->id,
            ]);
        }
        
        return $user;
    }

    public function success()
    {
        return view('auth.success');
    }

    public function check(Request $request)
    { 
        // $data = "arisurantatarigan01@gmail.com";
        return User::where('email', request()->email)->count() > 0 ? 'Unavailable' :"Available" ;
    }
}
