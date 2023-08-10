<?php
namespace App\Repositories\Interfaces;

use App\Models\IpList;

Interface IpListRepositoryInterface{
  public function allIpList();
  public function storeIpList($data);
  public function findIpList(IpList $ipList);
  public function updateIpList($data, IpList $ipList);
}