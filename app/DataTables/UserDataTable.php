<?php
namespace App\DataTables;
use App\User;
use Yajra\DataTables\Services\DataTable;
class UserDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'admin.users.btn.checkbox')
            ->addColumn('edit', 'admin.users.btn.edit')
            ->addColumn('delete', 'admin.users.btn.delete')
            ->rawColumns(['checkbox','edit','delete']);
    }
    public function query()
    {
        return User::query()
            ->with('file')
            ->select('users.*');
    }
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [[10,25,50,100],[10,25,50,100,]],
                'buttons'      => [
                    $permission = auth()->guard('admin')->user()->can('add_users') ? [
                        'text'=>'<i class="fa fa-plus"></i>'.__('admin.add_user'),'action'=>'function(){window.location.href = "'.route('users.create').'" }','className'=>'btn btn-info','init' => 'function(api, node, config) {$(node).removeClass("dt-button")}'
                    ] :[
                        'text'=>'<i class="fa fa-plus"></i>'.__('admin.add_user'),'className'=>'btn btn-info disabled','init' => 'function(api, node, config) {$(node).removeClass("dt-button")}'
                    ],
                    [
                        'extend'=>'export','text'=>'<i class="fa fa-file-archive-o"></i>'.__('admin.export'),'className'=>'btn btn-primary','init' => 'function(api, node, config) {$(node).removeClass("dt-button")}'
                    ],
                    [
                        'extend'=>'print','text'=>'<i class="fa fa-print"></i>'.__('admin.print'),'className'=>'btn btn-success','init' => 'function(api, node, config) {$(node).removeClass("dt-button")}'
                    ],
                    [
                        'extend'=>'reset','text'=>'<i class="fa fa-refresh"></i>','className'=>'btn btn-info','init' => 'function(api, node, config) {$(node).removeClass("dt-button")}'
                    ],
                    [
                        'text'=>'<i class="fa fa-trash-o"></i>'.__('admin.delete_all'),'className'=>'btn btn-danger delBtn','init' => 'function(api, node, config) {$(node).removeClass("dt-button")}'
                    ],
                ],
                'language'=>yajra_lang(),
            ]);
    }
    protected function getColumns()
    {
        return [
            [
                'name'=>'checkbox',
                'data'=>'checkbox',
                'title'=>'<input type="checkbox" name="check_all" class="form-check check_all">',
                'sortable'=>false,
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
            ],
            [
                'name'=>'id',
                'data'=>'id',
                'title'=>'#',
            ],
            [
                'name'=>'name',
                'data'=>'name',
                'title'=>__('admin.name'),
            ],
            [
                'name'=>'email',
                'data'=>'email',
                'title'=>__('admin.email'),
            ],
            [
                'name'=>'created_at',
                'data'=>'created_at',
                'title'=>__('admin.created_at'),
            ],
            [
                'name'=>'updated_at',
                'data'=>'updated_at',
                'title'=>__('admin.updated_at'),
            ],
            [
                'name'=>'edit',
                'data'=>'edit',
                'title'=>__('admin.edit'),
                'sortable'=>false,
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
            ],
            [
                'name'=>'delete',
                'data'=>'delete',
                'title'=>__('admin.delete'),
                'sortable'=>false,
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
            ],
        ];
    }
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
