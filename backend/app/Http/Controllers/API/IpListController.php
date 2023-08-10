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
use App\Repositories\Interfaces\LogHistoryRepositoryInterface;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

class IpListController extends BaseController
{
    private $ipListRepository;
    private $logHistoryRepository;

    public function __construct(IpListRepositoryInterface $ipListRepository, LogHistoryRepositoryInterface $logHistoryRepository)
    {
        $this->ipListRepository = $ipListRepository;
        $this->logHistoryRepository = $logHistoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $records = $this->ipListRepository->allIpList();
            return $this->sendResponse($records, 'All IP address with corresponding label.');
        } catch (\Exception $e) {
            Log::error("Database query failed: {$e->getMessage()}");
            return $this->sendError('Failed to retrive ip lists', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(IpListRequest $request)
    {
        $payloadData = $request->all();
        $user = auth('sanctum')->user();

        try {
            $message = 'Ip created at ' . Carbon::now()->toDayDateTimeString();
            $ipList = $this->ipListRepository->storeIpList($payloadData);
            $this->logHistoryRepository->storeIpListLog($message, $ipList, $user);
            return $this->sendResponse($ipList, 'Ip created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Error at ip creation', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(IpList $ipList)
    {
        //
        try {
            $ipList = $this->ipListRepository->findIpList($ipList);
            return $this->sendResponse($ipList, 'All IP address with corresponding label.');
        } catch (\Exception $e) {
            Log::error("Database query failed: {$e->getMessage()}");
            return $this->sendError('Failed to retrive ip lists', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(IpListRequest $request, IpList $ipList)
    {
        $payloadData = $request->all();
        $user = auth('sanctum')->user();
        $prev_label = $ipList->label;

        try {

            $ipList = $this->ipListRepository->updateIpList($payloadData, $ipList);

            if ($prev_label != $ipList->label) {
                $message = "Change label  {$prev_label}  to  {$ipList->label}";
                $this->logHistoryRepository->storeIpListLog($message, $ipList, $user);
            }
            return $this->sendResponse($ipList, 'IP Label updated successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Ip label updation failed'.$e, 500);
        }
    }
}
