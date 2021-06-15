<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsField extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public function smsId(){
        return $this->belongsTo('App\Models\SMSTemplate','sms_id','id');
    }
    public function columnId(){
        return $this->belongsTo('App\Models\ColumnSelect','column_id','id');
    }
    public function createdBy(){
        return $this->belongsTo('App\Models\User','created_by','id')->select('id','name','email');
    }
    public function updatedBy(){
        return $this->belongsTo('App\Models\User','updated_by','id')->select('id','name','email');
    }
    public function deletedBy(){
        return $this->belongsTo('App\Models\User','deleted_by','id')->select('id','name','email');
    }
}
