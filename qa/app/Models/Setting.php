<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Setting extends Model {

    protected $fillable = ['title'];

    public $datatable_fields = [
        'id'         => ['orderable' => true,'searchable' => false],
        'title'      => ['orderable' => true,'searchable' => true],
        'key'        => ['orderable' => true,'searchable' => true],
        'created_at' => ['orderable' => true,'searchable' => false],
        'updated_at' => ['orderable' => true,'searchable' => false],
    ];

    /**
     * Get the created date
     *
     * @return string
     */
    public function getCreatedAttribute()
    {
        return Date::parse($this->created_at)->format('d-m-Y');
    }
}