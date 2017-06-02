<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Zone extends Model
{
    protected $table = "zone";

    protected $fillable = ['polygon'];

    protected $hidden = ['polygon'];

    public function setPolygonAttribute($polygon)
    {
        $this->attributes['polygon'] = \DB::raw("GeomFromText('$polygon')");
    }

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery()->addSelect('*',DB::raw('asText(polygon) wkt'));
    }

}
