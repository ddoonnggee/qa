<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Article extends Model {

    protected $fillable = ['name','description','content','author'];

    //className参考：https://datatables.net/extensions/responsive/examples/display-control/classes.html
    public $datatable_fields = [
        'id'          => ['orderable' => true,'searchable' => false],
        'name'        => ['orderable' => true,'searchable' => true],
        'description' => ['orderable' => true,'searchable' => true, 'className' => "desktop"],
        'author'      => ['orderable' => true,'searchable' => true],
        'created_at'  => ['orderable' => true,'searchable' => false, 'className' => "desktop"],
        'updated_at'  => ['orderable' => true,'searchable' => false, 'className' => "desktop" ],
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }

}