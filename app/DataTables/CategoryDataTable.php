<?php
namespace App\DataTables;
use App\Admin\Category;
use Yajra\DataTables\Services\DataTable;
class CategoryDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'admin.categories.btn.checkbox')
            ->addColumn('edit', 'admin.categories.btn.edit')
            ->addColumn('delete', 'admin.categories.btn.delete')
            ->rawColumns(['checkbox','edit','delete']);
    }
    public function query()
    {
        return Category::query()
        ->where('id','>',1)
        ->with('category')
        ->select('categories.*');
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
                    $permission = auth()->guard('admin')->user()->can('add_categories') ? [
                        'text'=>'<i class="fa fa-plus"></i>'.__('admin.add_category'),'action'=>'function(){window.location.href = "'.route('categories.create').'" }','className'=>'btn btn-info','init' => 'function(api, node, config) {$(node).removeClass("dt-button")}'
                    ] :[
                        'text'=>'<i class="fa fa-plus"></i>'.__('admin.add_category'),'className'=>'btn btn-info disabled','init' => 'function(api, node, config) {$(node).removeClass("dt-button")}'
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
                'name'=>'name_ar',
                'data'=>'name_ar',
                'title'=>__('admin.name_ar'),
            ],
            [
                'name'=>'name_en',
                'data'=>'name_en',
                'title'=>__('admin.name_en'),
            ],
            [
                'name' =>'category.name_'.session('lang'),
                'data' =>'category.name_'.session('lang'),
                'title'=>__('admin.parent'),
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
        return 'Category_' . date('YmdHis');
    }
}
