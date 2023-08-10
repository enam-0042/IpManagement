<?php
namespace App\Repositories;

use App\Repositories\Interfaces\IpListRepositoryInterface;
use App\Models\IpList;
class IpListRepository implements IpListRepositoryInterface
{

    public function allIpList(){
        return IpList::latest()->take(10)->get();
    }
    public function storeIpList($data){

    }
    public function findIpList(IpList $ipList){}
    public function updateIpList($data, IpList $ipList){}
}