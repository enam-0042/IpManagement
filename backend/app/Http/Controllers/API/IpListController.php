<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\IpList;
use Illuminate\Http\Request;
use Validator;
use App\Models\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;

class IpListController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //next line is extra
        //  return $this->sendResponse(['msg'=>'heelooo']);
        // return "hello";
        $ip_lists = IpList::paginate(2);
        return $this->sendResponse($ip_lists, 'All IP address with corresponding label.');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ip_address' => 'required|ip|max:64',
            'label' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        try {
            $input = $request->all();
            $user = auth('sanctum')->user();

            $newIp = IpList::create($input);
            $newLog = new Log();
            $newLog->description = 'Ip created at ' . Carbon::now()->toDayDateTimeString();
            ;
            $newLog->user_id = $user->id;
            $newLog->ip_list_id = $newIp->id;
            $newLog->save();

            return $this->sendResponse($newIp, 'Ip created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Error at ip creation', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $input = IpList::where('id', $id)->first();
        if (is_null($input)) {
            return $this->sendError('This id is not found');
        } else {
            return $this->sendResponse($input, 'This is the Ip details');
        }

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IpList $ipList)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'ip_address' => 'required|ip|max:64',
            'label' => 'required|max:100',
        ]);
        // dd($input);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
         dd($ipList->get());
        try {
            $user = auth('sanctum')->user();            
           //$ipList= IpList::where('ip_address', 'Paris')->get(); 
           
            $ipList->label = $input['label'];
           
            $ipList->update();
           
            $newLog = new Log();
            $newLog->ip_list_id = $ipList->id;
            $newLog->description="Change label  {$prev_label}  to  {$ipList->label}";
            $newLog->user_id=$user->id;
            $newLog->save();
            return $this->sendResponse($prev_label, 'IP Label updated successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Ip label updation failed', 500);
        }
    }

}