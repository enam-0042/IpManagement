<?php
namespace App\Repositories;
use App\Models\User;
use App\Repositories\Interfaces\LogHistoryRepositoryInterface;
use App\Models\IpList;

use App\Models\LogHistory;

class LogHistoryRepository implements LogHistoryRepositoryInterface
{


    public function allLogListByUser($userId){
        $user=User::findOrFail($userId);
       // dd($user);
        return    $user->log_histories()->get();
    }
    public function storeAuthLog($message, User $user){
        $logHistory= new LogHistory();
        $logHistory->description= $message;
        $user->log_histories()->save($logHistory);
        return $logHistory;
    }
    public function storeIpListLog($message, IpList $ipList, User $user){
        $logHistory= new LogHistory();
        $logHistory->description= $message;
        
        $user->log_histories()->save($logHistory);
        $ipList->log_histories()->save($logHistory);
        return $logHistory;
    }
}