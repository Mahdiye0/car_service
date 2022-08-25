<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use function PHPUnit\Framework\isEmpty;

use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $input = $request->all();

        $this->validate($request, [
            'user_name' => 'required',
            'password' => 'required',
        ]);

        $temp = User::where(['user_name' => $input['user_name'], 'verification' => 1])->with('roles')->get();

        if (Hash::check($input['password'], $temp[0]->password)) {
            if (count($temp) == 1 && $temp[0]['roles'][0]->id == 3) {
                Auth::loginUsingId($temp[0]->id);

                return redirect()->route('admin.home');
            } elseif ($temp->count()) {

                Auth::loginUsingId($temp[0]->id);
                return redirect()->route('home');
            } else {
                throw ValidationException::withMessages([
                    'password' => [trans('auth.failed')],
                ]);
                return redirect()->route('login')
                    ->with('خطا', 'نام کاربری یا کلمه عبور اشتباه است');
            }
        }
    }
}
