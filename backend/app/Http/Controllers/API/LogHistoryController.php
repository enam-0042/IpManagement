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

class LogHistoryController extends BaseController
{
    private $logHistoryRepository;

    public function __construct( LogHistoryRepositoryInterface $logHistoryRepository)
    {
        $this->logHistoryRepository = $logHistoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth('sanctum')->user();

        try {
         //   dd($user);
            $records = $this->logHistoryRepository->allLogListByUser($user->id);
            return $this->sendResponse($records, 'All IP address with corresponding label.');
        } catch (\Exception $e) {
            Log::error("Database query failed: {$e->getMessage()}");
            return $this->sendError('Failed to retrive ip lists', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
