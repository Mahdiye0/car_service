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
use App\Http\Repositories\Admin\TypeServicesRepository;
use App\Http\Requests\TypeServiceRequest;

class TypeServicesController extends Controller
{

    public $repo;

    public function __construct(TypeServicesRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $result = $this->repo->index();
        return view('admin.type-service.index')
            ->with(['users1' => $result['user1'], 'type_services' => $result['type_services']]);
    }


    public function create()
    {
        $users1 = $this->repo->create();
        return view('admin.type-service.create', compact('users1'));
    }


    public function province($id)
    {
        return $this->repo->province($id);
    }

    public function county($id)
    {
        return $this->repo->county($id);
    }


    public function store(TypeServiceRequest $request)
    {
        $users1 = $this->repo->store($request);
        return redirect()->route('admin.type-service', compact('users1'));
    }


    public function edit($id)
    {
        $result = $this->repo->store($id);
        return view('admin.type-service.edit')->with(['users1'=>$result['users1'], 'data'=>$result['data']]);
    }


    public function update(TypeServiceRequest $request, TypeService $type_service)
    {
        $users1 = $this->repo->update($request,$type_service);
        return redirect()->route('admin.type-service', compact('users1'));
    }

    // to do
    public function destroy($id)
    {
        $users1 = User::where('verification', 0)->get();
        $res = TypeService::where('id', $id)->delete();

        return redirect()->route('admin.type-service', 'users1');
    }
}
