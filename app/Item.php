<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    protected $table = ['items'];
    protected $fillable = ['title','location'];
//    protected $geofields = array('location');
//
//
//    public function setLocationAttribute($value) {
//        $this->attributes['location'] = DB::raw("POINT($value)");
//    }
//
//    public function getLocationAttribute($value){
//
//        $loc =  substr($value, 6);
//        $loc = preg_replace('/[ ,]+/', ',', $loc, 1);
//
//        return substr($loc,0,-1);
//    }
//
//    public function newQuery($excludeDeleted = true)
//    {
//        $raw='';
//        foreach($this->geofields as $column){
//            $raw .= ' astext('.$column.') as '.$column.' ';
//        }
//
//        return parent::newQuery($excludeDeleted)->addSelect('*',DB::raw($raw));
//    }
//    public function scopeDistance($query, $dist, $location)
//    {
//        return $query->whereRaw('ST_Distance_Sphere(location,POINT(' . $location . ')) < ' . $dist);
//    }
//
//    public function scopeWithDistance($query, $location)
//    {
//        return $query->selectRaw('ST_Distance_Sphere(location,POINT(' . $location . ')) AS distance');
//    }
}
