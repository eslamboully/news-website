@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('admin.ads')<small>@lang('admin.register')</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active"><a href="{{ route('ads.index') }}"><i class="fa fa-flag-o"></i> @lang('admin.ads')</a></li>
                <li class="active"><i class="fa fa-plus"></i> @lang('admin.add_ad')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('admin.add_ad')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('includes._session')
                    @include('includes._errors')
                        <form class="form-group" action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.name_ar')</label>
                            <input class="form-control" type="text" name="name_ar" value="{{ old('name_ar') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.name_en')</label>
                            <input class="form-control" type="text" name="name_en" value="{{ old('name_en') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">@lang('admin.started_at')</label>
                            <input class="form-control timepicker" type="text" name="started_at" value="{{ old('started_at') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">@lang('admin.ended_at')</label>
                            <input class="form-control timepicker" type="text" name="ended_at" value="{{ old('ended_at') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.status')</label>
                            <br/>
                            <select  class="form-control" name="status">
                                <option value="active">@lang('admin.active')</option>
                                <option value="pending">@lang('admin.pending')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.ad_logo')</label>
                            <br/>
                            <input type="image" id="blah" src="{{ url('AdminDesign') }}/uploads/upload_logo.png" style="height: 80px;width: 80px;">
                            <input type="file" name="file" id="imgInp" class="my_file" style="display: none;" />
                        </div>
                        <div class="form-group">
                            <input class="btn btn-info" type="submit" value="@lang('admin.add')">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection
@push('js')
    <script>
        $('#admins').addClass('active');
        $('.ac li').first().addClass('active');
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
        var isRTL= {{ App()->getLocale() == 'ar' ? true :false }}
        $('input.timepicker').datepicker({
            format:'yyyy-mm-dd',
        });
    </script>
@endpush
