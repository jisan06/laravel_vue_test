<?php

namespace App\Http\Controllers;

use App\cr;
use Illuminate\Http\Request;
use App\Service;
use App\ServiceData;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = \App\Service::paginate(10);

        return $services->toJson();
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
       $service = Service::create( [
            'name' => $request->name,          
        ]);

       if($service){
            $service_data_list = count($request->service_data);
            for ($i= 1; $i < $service_data_list ; $i++) {
                $service_data = ServiceData::create( [
                    'service_id' => $service->id,                
                    'title' => $request->service_data[$i]['service_data_title'],               
                ]);
            }
        }

        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = \App\Service::find($id);
        if(!empty($service)){
            $service->delete();
            $msg = [
                'success' => true,
                'message' => 'Service deleted successfully!'
            ];
            return response()->json($msg);
        } else {
            $msg = [
                'success' => false,
                'message' => 'Service deleted failed!'
            ];
            return response()->json($msg);
        }
    }
}
