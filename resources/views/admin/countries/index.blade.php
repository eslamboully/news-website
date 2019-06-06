@extends('layouts.admin.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @lang('admin.countries')
                <small>@lang('admin.dashboard')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active"><i class="fa fa-flag-checkered"></i> @lang('admin.countries')</li>
            </ol>
        </section>


        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('admin.dashboard')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('includes._session')
                    <form class="form_del" action="{{ route('delete_all_countries') }}">
                        @method('delete')
                        @csrf
                        {!!
                            $dataTable->table([
                                'class'=>'dataTable table table-striped table-hover table-bordered',
                            ]);
                         !!}
                    </form>
                </div>
            </div>
            <div class="modal" id="modalAll" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('admin.warn_message')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="alert alert-danger">@lang('admin.warn_message_del')</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success del_all">@lang('admin.yes')</button>
                            <button type="button" class="btn btn-info" data-dismiss="modal">@lang('admin.no')</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@push('js')
    <script src="{{url('AdminDesign')}}/dist/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $('.check_all').click(function(){
            $('.check_this').not(this).prop('checked', this.checked);
        });// end of twxr
    $('.delBtn').on('click',function () {
        $('#modalAll').modal('show');
        return false;
    });
    $('.del_all').on('click',function () {
        $('.form_del').submit();
    });

    </script>
@endpush
