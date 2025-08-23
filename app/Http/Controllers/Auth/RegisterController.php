<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            'image'=>['image','mimes:jpeg,png,jpg','max:1080'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        $request = request();

        $verificationHash = Str::random(64);
        $path = 'profile/img.png';

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/profile');
        }
        if (!$this->emailExists($request->email)) {
            return redirect()->back()
                ->withErrors(['email' => 'Email не существует или недоступен.'])
                ->withInput();
        }

        $user = User::create([
            'name' => $data['name'],
            'image'=>$path,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'verification_hash' => $verificationHash,
        ]);

        // Триггерим событие Registered
        event(new Registered($user));

        // Возвращаем созданного пользователя
        return $user;
    }
    protected function emailExists($email)
    {
        // Здесь должна быть логика обращения к стороннему API или SMTP
        // Для примера — возвращаем true или false
        // Реальный вызов API:
        // $response = Http::post('https://api.someemailchecker.com/check', ['email' => $email]);
        // return $response->json()['exists'];

        // В простом варианте — просто возвращаем true для демонстрации
        return true; // или false, если email недоступен
    }
}
