<?php

namespace App\Http\Repositories\Admin;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;

class UserRepository
{


    public function pay($user, $request)
    {
        $input = $request->validated();
        $subscription_type = $input['f'];

        $expire_date = $user->getOriginal('expire_date') ? $user->getOriginal('expire_date')->addMonths($subscription_type) : Carbon::now()->addMonths($subscription_type);

        $amount = 0;
        switch ($input['f']) {
            case '1':
                $amount = 1000;
                break;
            case '6':
                $amount = 5000;
                break;
            case '12':
                $amount = 10000;
                break;
        }
        $invoice = new Invoice;
        $invoice->amount($amount);
        $invoice->detail(['detailName' => 'your detail goes here']);
        return Payment::purchase($invoice, function ($driver, $transactionId) use ($amount, $input, $user, $subscription_type, $expire_date) {
            Session::put('transactionId', $transactionId);
            Session::put('amount', $amount);
            DB::transaction(function () use ($amount, $input, $user, $subscription_type, $transactionId, $expire_date) {
                DB::table('payments')->insert([
                    'amount' => $amount,
                    'transactionId' => $transactionId,
                    'subscription_type' => $subscription_type,
                    'user_id' => $user->id,
                    'created_at' => now(),
                ]);

                DB::table('users')->where('id', $user->id)->update(['expire_date' => $expire_date->toDateTimeString()]);
            });
        })->pay()->render();
    }


    public function verifyy()
    {
        try {
            $receipt = Payment::amount(Session::get('amount'))->transactionId(Session::get('transactionId'))->verify();
            $referenceId = $receipt->getReferenceId();
            return ['status' => true, 'referenceId' => $referenceId];
        } catch (InvalidPaymentException $exception) {
            return ['status' => false, 'swal' => $exception->getMessage()];
        }
    }


    public function message($id, $type)
    {
        if ($type == '2' || $type == '3') {
            $results = Order::where('user_id', $id)->Where(function ($query) {
                $query->Orwhere(['status' => null, 'rate' => null]);
            })->with('services.TypeService', 'services.user')->simplePaginate(3);
            return $results;
        }
    }


    public function status($id, $status)
    {
        $order = Order::find($id);
        $order->status = $status;
        $result = $order->save();
        return $result;
    }

    public function rate($id, $rate)
    {
        $order = Order::find($id);
        $order->rate = $rate;
        $result = $order->save();
        return $result;
    }

    public function reportorder()
    {
        $users1 = User::where('verification', 0)->get();
        $orders = Order::with('user', 'services.TypeService')->simplePaginate(10);
        return ['orders' => $orders, 'users1' => $users1];
    }

    public function customer($request)
    {
        $users1 = User::where('verification', 0)->get();

        // البته کدهای زیر هم کار میکنن
        $users = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->where('roles.id', 2);
            })->simplePaginate(10);
        return ['users1' => $users1, 'users' => $users];
    }

    public function index($request)
    {
        //لیست خدمت دهنده رو میاره
        try {
            $users1 = User::where('verification', 0)->get();
            $role = Role::find(1);
            $users = $role->users;
            return ['users1' => $users1, 'users' => $users,'status'=>true];
        } catch (\Exception $e) {
            return ['status' => false, 'swal' => $e->getMessage()];
        }
    }


    public function store($request)
    {
        $users1 = User::where('verification', 0)->get();
        $inputs = $request->validated();

        $user =  DB::transaction(function ()  use ($inputs) {
            $user =  User::create([
                'first_name' => $inputs['first_name'],
                'last_name' => $inputs['last_name'],
                'user_name' => $inputs['user_name'],
                'mobile' => $inputs['mobile'],
                'password' => Hash::make($inputs['password']),
            ]);
            if ($inputs['role'] == '3') {
                $user->roles()->attach(array('1', '2'));
            } else
                $user->roles()->attach($inputs['role']);
        });
        return ['users1'=>$users1,'swal'=>'عضو جدید اضافه شد'];
    }


    public function update($request,$user)
    {
        $users1 = User::where('verification', 0)->get();
        // استفاده از روت مدل بایدینگ
        $inputs = $request->validated();
        $inputs['password'] = Hash::make($inputs['password']);
        $user->update($inputs);
        return $users1;
    }


    public function updateuser($request,$imageservice,$user)
    {
        // استفاده از روت مدل بایدینگ
        $inputs = $request->validated();
        if ($request->hasFile('image'))
            $inputs['image'] = $imageservice->save($request->file('image'));
        $user->update($inputs);
        return ['swal'=>'پروفایل ویرایش شد'];
    }


    public function destroy($user)
    {
        $users1 = User::where('verification', 0)->get();
        $user_id = $user->id;

        DB::transaction(function () use ($user_id) {
            User::where('id',  $user_id)->delete();
            Service::where('id',  $user_id)->delete();
        });
        return $users1;
    }

    public function verify($user)
    {
        $user->verification = $user->verification == 0 ? 1 : 0;
        $result = $user->save();
        return $result;
    }
}
