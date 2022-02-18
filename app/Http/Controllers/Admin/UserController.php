<?php

namespace App\Http\Controllers\Admin;

use Image;
use SoapClient;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use App\CustomClass\CheckPage;
use App\CustomClass\CheckRole;
use Shetabit\Multipay\Invoice;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

    }
    public function receipt( $referenceId)
    {
        return view('carservice.recharge.receipt',compact('referenceId'));
    }
    public function pay(User $user,Request $request)
    {

       $input=$request->all();
       $subscription_type=$input['f'];

       $expire_date=$user->getOriginal('expire_date')? $user->getOriginal('expire_date')->addMonths($subscription_type): Carbon::now()->addMonths($subscription_type);

       $amount=0;
       switch ($input['f']) {
           case '1':
            $amount=1000;
               break;
            case '6':
            $amount=5000;
                break;
            case '12':
            $amount=10000;
                break;


       }
        $invoice = new Invoice;
        $invoice->amount($amount);
        $invoice->detail(['detailName' => 'your detail goes here']);
        return Payment::purchase($invoice, function($driver, $transactionId)use($amount,$input,$user,$subscription_type,$expire_date){
            Session::put('transactionId', $transactionId);
            Session::put('amount', $amount);
            DB::transaction(function() use($amount,$input,$user,$subscription_type,$transactionId,$expire_date){
                DB::table('payments')->insert([
                    'amount'=>$amount,
                    'transactionId'=>$transactionId,
                    'subscription_type'=>$subscription_type,
                    'user_id'=>$user->id,
                    'created_at' => now(),

                ]);

                DB::table('users')->where('id',$user->id)->update(['expire_date'=>$expire_date->toDateTimeString()]);
            });


        })->pay()->render();


    }
    public function verifyy()
    {

        try {
            // $payment=ModelsPayment::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->first();
            // dd($payment->user->expire_date);

            $receipt = Payment::amount(Session::get('amount'))->transactionId( Session::get('transactionId'))->verify();

            // You can show payment referenceId to the user.
            // echo $receipt->getReferenceId();
            $referenceId=$receipt->getReferenceId();
            // $payment->referenceId = $referenceId;

            // $result=$payment->save();
            return redirect()->route('car-service.user.receipt', $referenceId);


        } catch (InvalidPaymentException $exception) {

            echo $exception->getMessage();
        }
    }
    public function recharge()
    {
        return view('carservice.recharge.index');
    }
    public function message($id,$type)
    {
        if($type=='2' || $type=='3')
        {
            $results=Order::where('user_id',$id)->Where(function ($query) {
                $query->Orwhere(['status'=>null,'rate'=>null]);

            })->with('services.TypeService','services.user')->simplePaginate(3);

               return view('carservice.message',compact('results'));
        }

    }
    public function status($id,$status)
    {
            $order = Order::find($id);

            $order->status = $status;

            $result=$order->save();

            if($result)
            {
                 return response()->json(['status'=>true]);
            }

        else
        {
            return response()->json(['status'=>false]);
        }

    }
    public function rate($id,$rate)
    {
            $order = Order::find($id);

            $order->rate = $rate;

            $result=$order->save();

            if($result)
            {
                 return response()->json(['status'=>true]);
            }

        else
        {
            return response()->json(['status'=>false]);
        }

    }
    public function reportorder()
    {
        $users1=User::where('verification',0)->get();

        $orders=Order::with('user','services.TypeService')->simplePaginate(10);
        // dd($orders);
        return view('admin.report.report',compact('orders','users1'));


    }

    public function customer(Request $request)
    {
        $users1=User::where('verification',0)->get();

        // البته کدهای زیر هم کار میکنن
        $users=User::with('roles')
        ->whereHas('roles',function($q) {
            $q->where('roles.id',2);
        })->simplePaginate(10);

        return view('admin.customer.index',compact('users1','users'));
    }
    public function index(Request $request )
    {
        //لیست خدمت دهنده رو میاره
        try
        {

            $users1=User::where('verification',0)->get();
            $role=Role::find(1);
            $users=$role->users;

            return view('admin.user.index',compact('users1','users'));
        }
        catch (\Exception $e) {

           echo  $e->getMessage();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users1=User::where('verification',0)->get();
        return view('admin.user.create',compact('users1'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $users1=User::where('verification',0)->get();

        $inputs=$request->all();
        // dd($inputs);
        $user =  DB::transaction(function ()  use ($inputs){
            $user =  User::create([
                'first_name' => $inputs['first_name'],
                'last_name' => $inputs['last_name'],
                'user_name' => $inputs['user_name'],
                'mobile' => $inputs['mobile'],
                // 'email' => $inputs['email'],
                'password' => Hash::make($inputs['password']),
            ]);
           if($inputs['role']=='3')
           {
                $user->roles()->attach(array('1','2'));

           }
           else
            $user ->roles()->attach($inputs['role']);

        });
        return redirect()->route('admin.user',compact('users1'))->with('swal-success','عضو جدید اضافه شد');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users1=User::where('verification',0)->get();

        $data=User::find($id);

        return view('admin.user.edit',compact('users1','data'));
    }
    public function edituser()
    {
        $users1=User::where('verification',0)->get();


        if(Auth::check())

             return view('carservice.edituser',compact('users1'));
    }
    public function edit_profile()
    {


        if(Auth::check())
              $users1=User::where('verification',0)->get();
             return view('admin.user.edituser',compact('users1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request,User $user)
    {
        $users1=User::where('verification',0)->get();
        // استفاده از روت مدل بایدینگ
        $inputs=$request->all();
        $inputs['password']= Hash::make($inputs['password']);

        $user->update($inputs);
        return redirect()->route('admin.user',compact('users1'));
    }
    public function updateuser(ProfileUserRequest $request,ImageService $imageservice, User  $user)
    {

        // استفاده از روت مدل بایدینگ
        $inputs=$request->all();
        if($request->hasFile('image'))
            $inputs['image']=$imageservice->save($request->file('image'));

        $user->update($inputs);
        return redirect()->route('car-service.home')->with('swal-success','پروفایل ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $users1=User::where('verification',0)->get();
        $user_id=$user->id;

        DB::transaction(function () use($user_id) {
            User::where('id',  $user_id)->delete();
             Service::where('id',  $user_id)->delete();
        });
        return redirect()->route('admin.user',compact('users1'));



    }
    public function verify(User $user)
    {
        $user->verification=$user->verification==0?1:0;

        $result=$user->save();
        if($result)
        {
            if($user->verification==0)
            {
                 return response()->json(['status'=>true,'checked'=>false]);
            }
            else
            {
                 return response()->json(['status'=>true,'checked'=>true]);
            }

        }
        else
        {
            return response()->json(['status'=>false]);
        }

    }
}
