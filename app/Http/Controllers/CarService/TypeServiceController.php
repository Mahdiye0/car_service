<?php

namespace App\Http\Controllers\CarService;

use App\Models\TypeService;
use Illuminate\Http\Request;
use App\CustomClass\CheckRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeServiceRequest;

class TypeServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function contact()
    {

        return view('carservice.contact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       return view('carservice.typeservice');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeServiceRequest $request)
    {
        date_default_timezone_set('asia/tehran');
        $inputs = $request->all();
        // dd($inputs);
        TypeService::create($inputs);
        return redirect()->route('car-service.home')->with('swal-success','درخواست شما توسط مدیریت بررسی میشود.در صورت تمایل میتوانید با شماره اضطراری زیر تماس بگیرید: 091334839849');

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
