@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('admin.settings')<small>@lang('admin.register')</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active"><i class="fa fa-edit"></i> @lang('admin.edit_setting')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('admin.edit_setting')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('includes._session')
                    @include('includes._errors')
                    <form class="form-group" action="{{ route('settings') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.name_ar')</label>
                            <input class="form-control" type="text" name="name_ar" value="{{ $setting->name_ar }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.name_en')</label>
                            <input class="form-control" type="text" name="name_en" value="{{ $setting->name_en }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.email')</label>
                            <input class="form-control" type="email" name="email" value="{{ $setting->email }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.phone')</label>
                            <input class="form-control" type="text" name="phone" value="{{ $setting->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.status')</label>
                            <br/>
                            <select  class="form-control" name="status">
                                <option {{ $setting->status == 'active' ? 'selected' : '' }} value="active">@lang('admin.active')</option>
                                <option {{ $setting->status == 'pending' ? 'selected' : '' }} value="pending">@lang('admin.pending')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.logo')</label>
                            <br/>
                            <input type="image" id="blah" src="{{ url('AdminDesign') }}/uploads/settings/{{ $setting->logo }}" style="height: 80px;width: 80px;">
                            <input type="file" name="file" id="imgInp" class="my_file" style="display: none;" />
                        </div>
                        <div class="form-group">
                            <input class="btn btn-info" type="submit" value="@lang('admin.edit')">
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
    </script>
@endpush

