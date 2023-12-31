<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $date = ['deleted_at'];

    protected $guarded = ['id'];

    public function user()
    {
    return $this->belongsTo(User::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('count');
    }

    public function factor()
    {
        return $this->hasOne(Factor::class);
    }

}
