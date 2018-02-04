<?php namespace App\Models\Traits;

trait DatatableAttribute {
    public $datatable_addtions =  [
        "checkbox" => "{ data: null,title:'<input type=\"checkbox\" name=\"select_all\"/>',render: function (data){var permisson = (data.action.toLowerCase().indexOf(\"data-id\") >= 0) ? \"\" : \"disabled=disabled\";return '<input type=\"checkbox\" name=\"ids[]\" value=\"' + data.id + '\" '+permisson+' />'},className:'dt-center',width:'25px',orderable: false, searchable: false},",
        "action"   => "{ data: 'action', name: 'action',className:'dt-center min-tablet-l',title:'#', orderable: false, searchable: false}",
    ];

    public function queryColumns()
    {
        $array = $this->model->datatable_fields;
        foreach (array_divide($array)[0] as $value) {
            if(isset(array_dot($array)[$value.'.except']))
                $array = array_except($array,$value);
        }
        return array_divide($array)[0];
    }

    public function all()
    {
        return $this->model->select($this->queryColumns());
    }

    public function columns(){
        $checkbox_str = '';
        if (auth()->user()->can($this->getRouteName().'_delete')) {
            $checkbox_str =$this->datatable_addtions['checkbox'];
        }
        $str = "";
        $array = array_dot($this->model->datatable_fields);
        foreach (array_divide($this->model->datatable_fields)[0] as $value) {
            $className = isset($array[$value.'.className'])?'className: "'.$array[$value.'.className'].'", ':'';
            $str .= "{ data: '".$value."', name: '".$value."',".$className." title:'".trans('messages.'.$value)."', orderable: ".strbool($array[$value.'.orderable']).", searchable: ".strbool($array[$value.'.searchable'])." },";
        }
        return "[".$checkbox_str.$str.$this->datatable_addtions['action']."]";
    }

    public function actionButttons($model) {
        $buttons =  [];
        if (auth()->user()->can($this->getRouteName().'_view')) {
            $buttons['show'] = '<a class="btn btn-warning btn-xs" href="'.$this->getRouteName().'/'.$model->id.'" data-toggle="tooltip" title="'.trans('messages.show').'" data-original-title="'.trans('messages.show').'"><i class="fa fa-eye"></i></a>';
        }
        if (auth()->user()->can($this->getRouteName().'_update',$model)) {
            $ajaxedit = (isset($this->model->datatable_attributes) && $this->model->datatable_attributes['ajax_edit'] ===false)?'false':'true';
            $buttons['edit'] = '<a class="btn btn-primary btn-xs btn-edit" href="'.$this->getRouteName().'/'.$model->id.'/edit" data-id="'.$model->id.'" data-ajaxedit="'.$ajaxedit.'" data-toggle="tooltip" title="'.trans('messages.edit').'" data-original-title="'.trans('messages.edit').'"><i class="fa fa-pencil"></i></a>';
        }
        if (auth()->user()->can($this->getRouteName().'_delete',$model)) {
            $buttons['delete'] = '<a class="btn btn-danger btn-xs btn-delete" data-toggle="tooltip"  data-id="'.$model->id.'" title="'.trans('messages.delete').'" data-original-title="'.trans('messages.delete').'"><i class="fa fa-trash"></i></a>';
        }
        return implode("\n",$buttons);
    }
}