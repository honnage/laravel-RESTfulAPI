<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $table = 'officers';

    // เพิ่ม getter ไปยัง json
    protected $appends = ['fullname','age','picture_url'];

    protected $hidden = ['picture'];

    //getter (Accessor)
    public function getFullnameAttribute(){
        return $this->firstname.' '.$this->lastname;
    }

    public function getAgeAttribute(){
        return now()->diffInYears($this->dob);
    }

    public function getPictureUrlAttribute(){
        return asset('storage/upload').'/'.$this->picture;
    }

    //many to one
    public function department(){
        //return $this->belongsTo(Department::class);
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
