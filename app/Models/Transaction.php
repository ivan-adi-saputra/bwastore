<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function details()
    {
        return $this->belongsTo(TransactionDetail::class, 'id', 'transactions_id');
    }
}
