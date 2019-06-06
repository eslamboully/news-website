@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('admin.news')<small>@lang('admin.register')</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active"><a href="{{ route('news.index') }}"><i class="fa fa-flag-o"></i> @lang('admin.news')</a></li>
                <li class="active"><i class="fa fa-plus"></i> @lang('admin.add_new')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('admin.add_new')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('includes._session')
                    @include('includes._errors')
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-list"></i> @lang('admin.main_info')</a></li>
                        <li><a data-toggle="tab" href="#menu1"><i class="fa fa-gears"></i> @lang('admin.settings')</a></li>
                        <li><a data-toggle="tab" href="#menu2"><i class="fa fa-database"></i> @lang('admin.categories_countries')</a></li>
                    </ul>
                    <form class="form-group" action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="tab-content">
                            @include('admin.news.tabs.content')
                            @include('admin.news.tabs.setting')
                            @include('admin.news.tabs.categories_countries')
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" type="submit"><i class='fa fa-plus'></i> @lang('admin.add_and_continue')</button>
                        <button name="save_close" class="btn btn-success"><i class='fa fa-plus'></i> @lang('admin.add_and_close')</button>
                    </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
    <script>
        $("input[type='image']").click(function() {
            $(".my_file").click();
            return false;
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function() {
            readURL(this);
        });

        $('.parent_id').on('change',function () {
            parent_id=$(this).val();
            $.ajax({
                url : '{{ route("news.create") }}',
                dataType : 'html',
                type:'get',
                data : { parent:$(this).val() },
                success: function (data) {
                    $('.foo').removeClass('hidden');
                    $('.sub_category').html(data);
                    $('.nothing').append('<option value="'+ parent_id +'">@lang('admin.no_sub_category')</option>');
                },
                error:function (e,z) {
                    alert(e.xhr.responseText);
                }
            });
        });
        var isRTL= {{ App()->getLocale() == 'ar' ? true :false }}
        $('input.timepicker').datepicker({
            format:'yyyy-mm-dd',
        });
    </script>
@endpush
