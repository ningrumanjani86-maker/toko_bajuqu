<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    //
    protected $fillable=['no_nota','total_harga'];
    public function details(){
        return $this->hasMany(transaction_detail::class,'transaction_id');
    }
}
