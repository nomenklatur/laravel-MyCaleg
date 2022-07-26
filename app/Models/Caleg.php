<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caleg extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['dapil', 'party'];

    public function dapil(){
        return $this->belongsTo(Dapil::class);
    }

    public function party(){
        return $this->belongsTo(Party::class);
    }

    public function scopeFilter($query, array $filters){
        if(isset($filters['cari'])? $filters['cari']: false){
             return $query->where('nama', 'like', '%'.$filters['cari'].'%');
        }
    }

    public function getRouteKeyName(){
        return 'uri';
    }

}
