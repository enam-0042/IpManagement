<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IpListRepositoryInterface;
use App\Models\IpList;

class IpListRepository implements IpListRepositoryInterface
{

    public function allIpList()
    {
        return IpList::latest()->take(10)->get();
    }
    public function storeIpList($data)
    {
        return IpList::create($data);
    }
    public function findIpList(IpList $ipList)
    {
     return    $ipList->with('log_histories')->find($ipList->id);
    }
    public function updateIpList($data, IpList $ipList)
    {
        $ipList->label = $data['label'];
        $ipList->save();
        return $ipList;
    }
}
