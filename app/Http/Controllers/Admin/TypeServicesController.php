<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\County;
use App\Models\Province;
use Mockery\Matcher\Type;
use App\Models\TypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeServiceRequest;

class TypeServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users1=User::where('verification',0)->get();
        // $type_services = DB::table('type_services')
        // ->select('type_services.id','type_services.name','type_services.description','cities.name as city','counties.name as county','provinces.name as province')
        // ->join('cities', 'cities.id', '=', 'type_services.city_id')
        // ->join('counties', 'counties.id', '=', 'cities.county_id')
        // ->join('provinces', 'provinces.id', '=', 'counties.province_id')
        // ->where('type_services.deleted_at', null)
        // ->get();
        $type_services=TypeService::all();

        return view('admin.type-service.index',compact('users1','type_services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  $provinces=Province::orderBy('name')->get();
        $users1=User::where('verification',0)->get();
         return view('admin.type-service.create',compact('users1'));

    }
    public function province($id)
    {

        $province=Province::find($id);
        $data=$province->counties()->get();
        // return response()->json($province->countie, 200);
        return $data;



    }

    public function county($id)
    {

        $county=County::find($id);
        $data=$county->cities()->get();
        // return response()->json($province->countie, 200);
        return $data;



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeServiceRequest $request)
    {

        $users1=User::where('verification',0)->get();
        $inputs = $request->all();
        TypeService::create($inputs);

        // $name = $request->input('name');
        // $city_id = $request->input('city');
        // $description = $request->input('description');
        // DB::insert('insert into type_services (city_id,name,description) values(?,?,?)',[$city_id,$name,$description]);

        return redirect()->route('admin.type-service',compact('users1'));

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
        $data=TypeService::find($id);
       return view('admin.type-service.edit',compact('users1','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeServiceRequest $request, TypeService $type_service)
    {
        $users1=User::where('verification',0)->get();
            // 1-$type_service = TypeService::find($id);
            // $type_service->name = $request->input('name');
            // $type_service->description = $request->input('description');
            // $type_service->save();

// استفاده از روت مدل بایدینگ
            $inputs=$request->all();
            $type_service->update($inputs);
            return redirect()->route('admin.type-service',compact('users1'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // 1-$type=TypeService::find($id);
        // dd($type);
        // $type->delete();
        $users1=User::where('verification',0)->get();
        $res=TypeService::where('id',$id)->delete();

        // DB::delete('delete from type_services where id = ?', [$id]);
        // return redirect()->route('admin.type-service')->with(['success'=>'عملیات حذف انجام شد','icon'=>"danger"]);
        return redirect()->route('admin.type-service','users1');
    }
}
