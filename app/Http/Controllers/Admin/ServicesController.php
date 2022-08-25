<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\ServicesRepository;
use App\Http\Requests\ServiceRequest;
use App\Http\Services\Image\ImageService;

class ServicesController extends Controller
{
    public $repo;

    public function __construct(ServicesRepository $repo)
    {
        $this->repo=$repo;
    }

    public function index()
    {
        $result=$this->repo->index();
        return view('admin.service.index')->with(['users1'=>$result['users1'], 'users'=>$result['users']]);
    }


    public function create($user_id)
    {
        $result=$this->repo->create();
        return view('admin.service.create')->with(['users1'=>$result['users1'],'type_services'=> $result['type_services'], 'provinces'=>$result['provinces'],'user_id'=> $user_id]);
    }

    public function store(ServiceRequest $request, ImageService $imageservice)
    {
        $users1=$this->repo->store($request, $imageservice);
        return redirect()->route('admin.user', compact('users1'));
    }


    public function edit($id)
    {
        $result=$this->repo->edit($id);
        return view('admin.service.edit')
            ->with([
                'users1'=>$result['users1'],'data'=> $result['data'],
                'type_services'=>$result['type_services'], 'provinces'=>$result['provinces'],
                'counties'=>$result['counties'], 'cities'=>$result['cities']
            ]);
    }


    public function update(ServiceRequest $request, Service $service)
    {
        $result=$this->repo->update($request,$service);
        return redirect()->route('admin.service')->with(['users1'=>$result['users1']]);
    }


    public function destroy($id)
    {
        $users1=$this->repo->destroy($id);
        return redirect()->route('admin.service.index', compact('users1'));
    }
}
