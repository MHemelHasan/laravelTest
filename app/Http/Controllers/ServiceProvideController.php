<?php

namespace App\Http\Controllers;

use App\DataTables\EServiceDataTable;
use Illuminate\Http\Request;
use App\Models\ServiceProvide;
use App\Repositories\EServiceRepository;
use App\Http\Requests\CreateEServiceRequest;
use App\Models\EProvider;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Flash;

class ServiceProvideController extends Controller
{
    //
    public function __construct(ServiceProvide $serviceProvide, EProvider $eProvider, EServiceRepository $serviceRepo)
    {
        $this->serviceProvide = $serviceProvide;
        $this->serviceRepo = $serviceRepo;
        $this->eProvider = $eProvider;
    }

    public function create()
    {
        $service = $this->serviceRepo->pluck('name', 'id');
        // dd($service);
        $serviceSelected = [];
        return view('e_services.provider_create')->with("service", $service)->with("serviceSelected", $serviceSelected);
    }

    public function show()
    {
        $provider = User::find(auth()->user()->id);
        $services = $provider->services()->select('name')->get();
        // dd($services[0]->name);

        // $provider = $this->serviceProvide->where('provider_id',auth()->user()->id)->get();
        // dd($provider);
        // dd($this->serviceProvide->getService()->get());


        return view('e_services.my_services_table')->with("provider_services", $services);
    }

    public function store(Request $request)
    {
        // dd(json_encode($request->services));

        $service_provide = new ServiceProvide();
        $input = $request->all();
        $services = $input['services'];
        // dd($services);

        foreach($request->services as $key=>$service)
        {
          $insertdata = 
            [
               'user_id' => auth()->user()->id,
               'e_service_id' => $request->services[$key],
            ];

            // dd($insertdata);
    
        DB::table('service_provides')->updateOrInsert($insertdata);
        }
    
        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.e_service')]));

        return redirect('eServices/my_services_table');
    }
    
}
