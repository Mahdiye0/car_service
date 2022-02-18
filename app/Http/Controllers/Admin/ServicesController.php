<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\City;
use App\Models\User;
use App\Models\County;
use App\Models\Service;
use App\Models\Province;
use App\Models\TypeService;
use Illuminate\Http\Request;
use App\CustomClass\CheckRole;
use App\Http\Controllers\Controller;
use App\Models\Type_Service_Service;
use App\Models\TypeServicesServices;
use App\Http\Requests\ServiceRequest;
use App\Http\Services\Image\ImageService;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        $users1=User::where('verification',0)->get();
        $users=Service::with('User','City.Province','TypeService')->simplePaginate(6);
        // dd($users['service']['id']);
        // dd($users);
    // $q=$services[0]->city_id;
//  dd($q);

        // $cities = Province::with(['cities' => function ($query) {
        //     $query->where('id','=', 1);
        // }])->get();
        // dd($cities);



        return view('admin.service.index',compact('users1','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        // dd($user_id);
        $users1=User::where('verification',0)->get();
        $type_services=TypeService::orderBy('name')->get();
        $provinces=Province::orderBy('name')->get();

        return view('admin.service.create',compact('users1','type_services','provinces','user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request,ImageService $imageservice)
    {
        $users1=User::where('verification',0)->get();
        $inputs = $request->all();
        if($request->hasFile('image'))
        {

            $result=$imageservice->save($request->file('image'));

        }
        $inputs['image'] = $result;
            // dd($inputs['image']);

        Service::create($inputs);




        return redirect()->route('admin.user',compact('users1'));



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
    //public function edit($id)
    public function edit($id)
    {
        // $data=Service::with(['TypeService','City' => function ($query)use($id) {
        //         $query->where('id',$id);
        //     }])->get();
        $users1=User::where('verification',0)->get();
            $type_services=TypeService::all();
            $provinces=Province::all();
            // $counties=County::all();
            $data=Service::with('TypeService','City.County.Province')
           ->where('id',$id)
            ->get();
            $counties=County::where('province_id',$data[0]->City->province_id)->get();
            $cities=City::where('county_id',$data[0]->City->county_id)->get();

            // dd($cities);
            // $data[0]->City->County->county_id
            // dd($data[0]->id);
            // dd($data[0]->City->County->Province->name);
            // dd($data[0]->City->County->name);
        return view('admin.service.edit',compact('users1','data','type_services','provinces','counties','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $users1=User::where('verification',0)->get();
        $inputs = $request->all();

        $service->update($inputs);
        return redirect()->route('admin.service',compact('users1'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users1=User::where('verification',0)->get();
        $res=Service::where('id',$id)->delete();
        return redirect()->route('admin.service',compact('users1'));
    }
}
