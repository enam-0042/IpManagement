<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogHistory extends Model
{
    use HasFactory;
    public function user(){
        $this->belongsTo(User::class);
    }
    public function ip_list(){
        $this->belongsTo(IpList::class);
    }
}
