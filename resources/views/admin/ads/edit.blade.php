@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('admin.ads')<small>@lang('admin.edit')</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active"><a href="{{ route('ads.index') }}"><i class="fa fa-flag-o"></i> @lang('admin.ads')</a></li>
                <li class="active"><i class="fa fa-edit"></i> @lang('admin.edit_ad')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('admin.edit_ad')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('includes._session')
                    @include('includes._errors')
                    <form class="form-group" action="{{ route('ads.update',$ad->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.name_ar')</label>
                            <input class="form-control" type="text" name="name_ar" value="{{ $ad->name_ar }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.name_en')</label>
                            <input class="form-control" type="text" name="name_en" value="{{ $ad->name_en }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">@lang('admin.started_at')</label>
                            <input class="form-control timepicker" type="text" name="started_at" value="{{ $ad->started_at }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">@lang('admin.ended_at')</label>
                            <input class="form-control timepicker" type="text" name="ended_at" value="{{ $ad->ended_at }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.status')</label>
                            <br/>
                            <select  class="form-control" name="status">
                                <option {{ $ad->status == 'active' ? 'selected':'' }} value="active">@lang('admin.active')</option>
                                <option {{ $ad->status == 'pending' ? 'selected':'' }} value="pending">@lang('admin.pending')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.ad_logo')</label>
                            <br/>
                            <input type="image" id="blah" src="{{ url('AdminDesign') }}/uploads/upload_logo.png" style="height: 80px;width: 80px;">
                            <input type="file" name="file" id="imgInp" class="my_file" style="display: none;" />
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="@lang('admin.edit')">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection
@push('js')
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
        var isRTL= {{ App()->getLocale() == 'ar' ? true :false }}
        $('input.timepicker').datepicker({
            format:'yyyy-mm-dd',
        });
    </script>
@endpush
