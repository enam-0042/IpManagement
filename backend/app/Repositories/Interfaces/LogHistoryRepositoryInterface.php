<?php
namespace App\Repositories\Interfaces;

use App\Models\IpList;
use App\Models\User;

Interface LogHistoryRepositoryInterface{
  public function allLogListByUser($userId);
  public function storeAuthLog($data, User $user);
  public function storeIpListLog($data, IpList $ipList, User $user);
}