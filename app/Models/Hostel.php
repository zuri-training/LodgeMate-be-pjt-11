<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    use HasFactory;
        
    protected $fillable=
    [
          'user_id',
          'institution_id',
          'hosteltype_id',
          'name',
          'description',
          'address',
          'utilities',
          'price',
          
    ];

    public function hosteltype()
    {
        return $this->belongsTo(Hosteltype::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function institutions()
    {
        return $this->belongsTo(Institution::class) ;
    }

}
