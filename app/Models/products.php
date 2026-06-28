<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
        //
        protected $fillable=['nama_barang','harga','stok','deskripsi','category_id'];

        public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
