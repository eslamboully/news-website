<?php
namespace App\DataTables;
use App\Admin\News;
use Yajra\DataTables\Services\DataTable;
class NewsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'admin.news.btn.checkbox')
            ->addColumn('status', 'admin.news.btn.status')
            ->addColumn('edit', 'admin.news.btn.edit')
            ->addColumn('delete', 'admin.news.btn.delete')
            ->rawColumns(['checkbox','status','edit','delete']);
    }
    public function query()
    {
        return News::query()
        ->with('admin')
        ->select('news.*')
        ->with('country')
        ->select('news.*')
        ->with('category')
        ->select('news.*');
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
                    $permission = auth()->guard('admin')->user()->can('add_news') ? [
                        'text'=>'<i class="fa fa-plus"></i>'.__('admin.add_new'),'action'=>'function(){window.location.href = "'.route('news.create').'" }','className'=>'btn btn-info','init' => 'function(api, node, config) {$(node).removeClass("dt-button")}'
                    ] :[
                        'text'=>'<i class="fa fa-plus"></i>'.__('admin.add_new'),'className'=>'btn btn-info disabled','init' => 'function(api, node, config) {$(node).removeClass("dt-button")}'
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
                'name'=>'title',
                'data'=>'title',
                'title'=>__('admin.title'),
            ],
            [
                'name'=>'admin.name',
                'data'=>'admin.name',
                'title'=>__('admin.admin_name'),
            ],
            [
                'name'=>'country.name_'.session('lang'),
                'data'=>'country.name_'.session('lang'),
                'title'=>__('admin.country'),
            ],
            [
                'name'=>'category.name_'.session('lang'),
                'data'=>'category.name_'.session('lang'),
                'title'=>__('admin.category'),
            ],
            [
                'name'=>'started_at',
                'data'=>'started_at',
                'title'=>__('admin.started_at'),
            ],
            [
                'name'=>'ended_at',
                'data'=>'ended_at',
                'title'=>__('admin.ended_at'),
            ],
            [
                'name'=>'status',
                'data'=>'status',
                'title'=>__('admin.status'),
                'sortable'=>false,
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
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
        return 'News_' . date('YmdHis');
    }
}
