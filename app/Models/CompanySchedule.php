<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanySchedule extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public function companyId(){
        return $this->belongsTo('App\Models\Company','company_id','id');
    }
}
