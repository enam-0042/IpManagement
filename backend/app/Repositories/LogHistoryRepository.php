<?php
namespace App\Repositories;
use App\Models\User;
use App\Repositories\Interfaces\LogHistoryRepositoryInterface;
use App\Models\IpList;
use App\Models\LogHistory;

class LogHistoryRepository implements LogHistoryRepositoryInterface
{


    public function allLogListByUser($userId){

    }
    public function storeAuthLog($message, User $user){
        $logHistory= new LogHistory();
        $logHistory->description= $message;
       $user->log_histories()->save($logHistory);
        return $logHistory;
    }
    public function storeIpListLog($data, IpList $ipList, User $user){}
}