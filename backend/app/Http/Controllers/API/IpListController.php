<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Response;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\IpListRequest;
use App\Models\IpList;
use Illuminate\Http\Request;
use Validator;
use App\Models\LogHistory;
use App\Repositories\Interfaces\IpListRepositoryInterface;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

class IpListController extends BaseController
{
    private $ipListRepository;

    public function __construct(IpListRepositoryInterface $ipListRepository)
    {
        $this->ipListRepository = $ipListRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $records = $this->ipListRepository->allIpList();
            return $this->sendResponse($records, 'All IP address with corresponding label.');
        } catch(\Exception $e){
             Log::error("Database query failed: {$e->getMessage()}");
            return $this->sendError('Failed to retrive ip lists', Response::HTTP_INTERNAL_SERVER_ERROR  );
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(IpListRequest $request)
    {


        try {
            $input = $request->all();
            $user = auth('sanctum')->user();

            $newIp = IpList::create($input);
            // $newLog = new Log();
            // $newLog->description = 'Ip created at ' . Carbon::now()->toDayDateTimeString();
            // ;
            // $newLog->user_id = $user->id;
            // $newLog->ip_list_id = $newIp->id;
            // $newLog->save();

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
    public function update(IpListRequest $request, IpList $ipList)
    {
        $input = $request->all();
   
        
        try {
            $user = auth('sanctum')->user();
            $prev_label = $ipList->label;
            $ipList->label = $input['label'];
            $ipList->update();

            if($prev_label != $ipList->label){
                // $newLog = new Log();
                // $newLog->ip_list_id = $ipList->id;
                // $newLog->description="Change label  {$prev_label}  to  {$ipList->label}";
                // $newLog->user_id=$user->id;
                // $newLog->save();
            }
            return $this->sendResponse($ipList, 'IP Label updated successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Ip label updation failed',500);
        }
    }

}