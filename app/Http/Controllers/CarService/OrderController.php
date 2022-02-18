<?php

namespace App\Http\Controllers\CarService;

use App\Models\City;
use App\Models\Order;
use App\Models\County;
use App\Models\Service;
use App\Models\Province;
use App\Models\TypeService;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\CustomClass\CheckPage;
use App\CustomClass\CheckRole;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportorder(Request $request ,$user_id)
    {

        $orders=Order::where('user_id',$user_id)->with('services.TypeService')->simplePaginate(3);
        // return($orders[0]->services->TypeService->name);
        return view('carservice.report',compact('orders'));


    }

    public  function reportservice(Request $request ,$user_id)
    {

        //  جواب میده ولی شرط یوزر آیدی رو نداره
        //  $service=Order::with('services.TypeService')->get();

        // اینم درسته فقط رکوردها تو در تو هستند.
        // $services=Service::where('user_id',23)
        //   ->with('TypeService','order')
        //   ->get();

// این دستور نام خدمت رونداره
        //  $service=Order::with(['services'=>function ($query) use ($user_id) {
        //     $query->where('user_id', 23);
        // }])->get();

        // کد امیر
        $orders=Order::with('services.TypeService')
            ->whereHas('services',function($q)use($user_id){
                $q->where('user_id',$user_id);
            })->simplePaginate(3);

            // if (empty($orders) ) {
            //     dd('asa');
            //     Session::flash('no-results', 'Your search produced no results');
            // }

            return view('carservice.report',compact('orders'));
    }
    public function index()
    {

        $provinces=Province::all();
        return view('carservice.order',compact('provinces'));
    }

    public function search_type_service($city_id,$type_service)
    {
        $users=Service::where('city_id',$city_id)
        ->whereHas('TypeService', function ($query) use($type_service){
        $query->where('name','like', '%'.$type_service.'%');
         })
          ->with('TypeService','User')
          ->get();

        //    dd($type_service[0] );
    //    dd( $type_service[0]->Services[0]->TypeService->name);
       return ( $users);

    }
    public function search_report_service($user_id,$type_service)
    {


if($type_service!='a')
{
    $orders=Order::with('services.TypeService')
    ->whereHas('services',function($q) use($user_id){
        $q->where('user_id',$user_id);
    })->whereHas('services.TypeService',function($q1) use ($type_service){
        $q1->where('name','like', '%'.$type_service.'%');
    })->get();
  return ( $orders);


}
else
{
    $orders=Order::with('services.TypeService')
    ->whereHas('services',function($q) use($user_id){
        $q->where('user_id',$user_id);
    })->get();
  return ( $orders);

}




    }



    public function order_type_service($city_id)
    {
//  این دستور زیر کار میکنه البته بدون شرط اکسپایر دیت برای کاربران
        // $users=Service::with('User','City.Province','TypeService')
        // ->where('city_id',$city_id)
        // ->get();

        $users=Service::where('city_id',$city_id)
        ->with('User', function ($query) {
            $query->where('expire_date','>=', Carbon::now());
        })
        ->with('City.Province','TypeService')
        ->get();

            // $type_service=Service::with('TypeService','City.County.Province')
            // ->where('igd',$city_id)
            //  ->get();

        //    dd($type_service[0] );
    //    dd( $type_service[0]->Services[0]->TypeService->name);
       return ( $users);

    }

    public function county($id)
    {

        $county=County::find($id);
        $data=$county->cities()->get();
        // return response()->json($province->countie, 200);
        return $data;



    }
    public function province($id)
    {
// dd($id);
        $province=Province::find($id);
        $data=$province->counties()->get();
        // return response()->json($province->countie, 200);
        return $data;



    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('asia/tehran');
        $inputs = $request->all();
        // dd($inputs);
        Order ::create($inputs);
        return redirect()->route('car-service.home')->with('swal-success','سفارش شما ثبت شد ،منتظر تماس کارشناسان ما باشید.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
