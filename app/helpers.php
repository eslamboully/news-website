<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
if (!function_exists('vali')){
    function vali(Request $request,$rules){

    }
}
if (!function_exists('successCode')){
    function successCode(){
        return [200,201,202];
    }
}
if (!function_exists('res_api')){
    function res_api($data=null,$status=null,$errors=null){

        $array = [
            'data'=>$data,
            'status'=> in_array($status,successCode()) ? true :false,
            'errors'=>$errors,
        ];
        return response($array,$status);
    }
}
if (!function_exists('yajra_lang')){
    function yajra_lang(){
        return [
            "sProcessing"=> __('admin.download'),
                "sLengthMenu"=> __('admin.show')." _MENU_".__('admin.records'),
                "sZeroRecords"=> __('admin.zero_record'),
                "sEmptyTable"=> __('admin.none_record_table'),
                "sInfo"=> __('admin.showing')." ".__('admin.records').__('admin.ofthe')." _START_ ".__('admin.of')." _END_ ".__('admin.ofatotalof')." _TOTAL_ ".__('admin.records'),
                "sInfoEmpty"=> __('admin.zero_records'),
                "sInfoFiltered"=> "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix"=> "",
                "sSearch"=> __('admin.search'),
                "sUrl"=> "",
                "sInfoThousands"=> ",",
                "sLoadingRecords"=> "Cargando...",
                "oPaginate"=> [
                    "sFirst"=> __('admin.first'),
                    "sLast"=> __('admin.last'),
                    "sNext"=> __('admin.next'),
                    "sPrevious"=> __('admin.previous'),
                ],
                "oAria"=> [
                    "sSortAscending"=> "=> Activar para ordenar la columna de manera ascendente",
                    "sSortDescending"=> "=> Activar para ordenar la columna de manera descendente"
                ],
            ];
        }
    }
