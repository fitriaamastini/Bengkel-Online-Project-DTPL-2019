<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Model\PhoneCodes;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $phone_codes = PhoneCodes::getAllPhoneCodes(65);
        return view('auth.register', compact('phone_codes'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        Session::flash('message', [ 'message' => 'Selamat, anda sudah teregistrasi',
             'action'=>'success' ]);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $customMessage = array(
            'name.required' => "Nama Lengkap Harus Diisi",
            'name.max' => "Panjang Maksimal untuk Masukkan Nama Lengkap adalah 100",
            'email.required' => "Email Harus Diisi",
            'email.email' => "Email Tidak Diisi sesuai format email yang seharusnya (contoh xxxx@xx.xx)",
            'email.unique' => "Email Yang Anda Masukkan Sudah Diregistrasikan. Silahkan Memilih Alamat Email Lain...",
            'email.max' => "Email Yang Anda Masukkan Dibatasi Maksimal 255 Karakter",
            'password.required' => "Password Harus Diisi",
            'password.confirmed' => "Password dan Konfirmasi Password yang anda masukkan tidak sama....",
            'password.min' => "Password minimal 8 Huruf",
            'password.regex' => "Password harus terdiri dari Alphabet dan Angka",
        );

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'user_name' => ['required', 'string', 'max:100', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'regex:/^([0-9]+[a-zA-Z]+|[a-zA-Z]+[0-9]+)[0-9a-zA-Z]*$/', 'confirmed'],
        ], $customMessage);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $phone_number =  $data['phone_code']. $data['phone_number'];

        return User::create([
            'user_name' => $data['user_name'],
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone_number' => $phone_number,
            'password' => Hash::make($data['password']),
            'role_id' => 2
        ]);
    }
}
