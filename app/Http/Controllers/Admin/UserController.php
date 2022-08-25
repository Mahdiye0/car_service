<?php

namespace App\Http\Controllers\Admin;

use Image;
use SoapClient;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Shetabit\Payment\Facade\Payment;
use Illuminate\Support\Facades\Session;
use App\Models\Payment as ModelsPayment;
use App\Http\Requests\ProfileUserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Role;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class UserController extends Controller
{
    public $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function receipt($referenceId)
    {
        return view('carservice.recharge.receipt', compact('referenceId'));
    }

    public function pay(User $user, Request $request)
    {
        return $this->repo->pay($user, $request);
    }


    public function verifyy()
    {
        $result=$this->repo->verifyy();
        if($result['status']){
            return redirect()->route('car-service.user.receipt', $result['referenceId']);
        }else{
            return $result;
        }
    }


    public function recharge()
    {
        return view('carservice.recharge.index');
    }


    public function message($id, $type)
    {
        $results=$this->repo->message($id, $type);
        return view('carservice.message', compact('results'));
    }


    public function status($id, $status)
    {
        $result=$this->repo->status($id, $status);
        if ($result) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }


    public function rate($id, $rate)
    {
        $result=$this->repo->rate($id, $rate);

        if ($result) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }


    public function reportorder()
    {
        $result=$this->repo->reportorder();
        return view('admin.report.report')
            ->with(['orders'=>$result['orders'], 'users1'=>$result['users1']]);
    }


    public function customer(Request $request)
    {
        $result=$this->repo->customer($request);
        return view('admin.customer.index')->with(['users1'=>$result['users1'], 'users'=>$result['users']]);
    }


    public function index(Request $request)
    {
        $result=$this->repo->index($request);
        if($result['status']){
            return view('admin.user.index', compact(['users1'=>$result['users1'], 'users'=>$result['users']]));
        }else{
            return redirect()->back()->with('swal-error',$result['swal']);
        }
    }


    public function create()
    {
        $users1 = User::where('verification', 0)->get();
        return view('admin.user.create', compact('users1'));
    }


    public function store(UserRequest $request)
    {
        $result=$this->repo->store($request);
        return redirect()->route('admin.user')->with(['users1'=>$result['users1'],'swal-success', $result['swal']]);
    }


    public function edit($id)
    {
        $users1 = User::where('verification', 0)->get();
        $data = User::find($id);
        return view('admin.user.edit', compact('users1', 'data'));
    }


    public function edituser()
    {
        $users1 = User::where('verification', 0)->get();
        if (Auth::check()) {
            return view('carservice.edituser', compact('users1'));
        }
    }


    public function edit_profile()
    {
        if (Auth::check())
            $users1 = User::where('verification', 0)->get();
        return view('admin.user.edituser', compact('users1'));
    }


    public function update(UserRequest $request, User $user)
    {
        $users1=$this->repo->update($request,$user);
        return redirect()->route('admin.user', compact('users1'));
    }


    public function updateuser(ProfileUserRequest $request, ImageService $imageservice, User  $user)
    {
        $result=$this->repo->updateuser($request,$imageservice,$user);
        return redirect()->route('car-service.home')->with('swal-success', $result['swal']);
    }


    public function destroy(User $user)
    {
        $users1=$this->repo->destroy($user);
        return redirect()->route('admin.user', compact('users1'));
    }


    public function verify(User $user)
    {
        $result=$this->repo->verify($user);
        if ($result) {
            if ($user->verification == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
