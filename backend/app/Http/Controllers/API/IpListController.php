<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\IpList;
use Illuminate\Http\Request;
use Validator;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'ip_address' => 'required|ip|max:64',
            'label' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $newIp = IpList::create($input);


        return $this->sendResponse($newIp, 'Ip created successfully.');
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
     * Show the form for editing the specified resource.
     */
    public function edit(IpList $ipList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IpList $ipList,$id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'ip_address' => 'required|ip|max:64',
            'label' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $updatedIp=IpList::find($id);
        $updatedIp->update([
            'ip_address' => $request->ip_address,
            'label' => $request->label,
        ]);
        //$ipList->label = $input['label'];
        $res=$updatedIp->save();
        if($res)
        return $this->sendResponse($updatedIp, 'IP Label updated successfully.');
        else 
         //return "flsfs";
        return $this->sendError('IP address is not updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IpList $ipList)
    {
        //
    }
}