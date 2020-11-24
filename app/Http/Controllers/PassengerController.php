<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Passenger;
use App\Service;
use App\ServiceData;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $passenger = \App\Passenger::paginate(10);

        return $passenger->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
       $passenger = Passenger::create( [
            'service_id' => $request->service_id,          
            'name' => $request->passenger['name'],          
            'passport' => $request->passenger['passport'],      
            'email' => $request->passenger['email'],      
            'mobile' => $request->passenger['mobile'],      
        ]);


       /*if($passenger){
            $service_data_list = count($request->service_data);
            for ($i= 1; $i < $service_data_list ; $i++) {
                $service_data = ServiceData::create( [
                    'service_id' => $passenger->id,                
                    'title' => $request->service_data[$i]['service_data_title'],               
                ]);
            }
        }*/

        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function show(Passenger $passenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passenger $passenger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $passenger = \App\Passenger::find($id);
        if(!empty($passenger)){
            $passenger->delete();
            $msg = [
                'success' => true,
                'message' => 'Passenger deleted successfully!'
            ];
            return response()->json($msg);
        } else {
            $msg = [
                'success' => false,
                'message' => 'Passenger deleted failed!'
            ];
            return response()->json($msg);
        }
    }

    public function getServices(){
        $services = Service::all();

        return $services->toJson();
    }

    public function getServicesInfo(){
        $services_info = ServiceData::where('service_id',request()->service_id)->get();

        return $services_info->toJson();
    }
}
