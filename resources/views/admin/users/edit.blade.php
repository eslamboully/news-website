@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('admin.users')<small>@lang('admin.edit')</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active"><a href="{{ route('admins.index') }}"><i class="fa fa-users"></i> @lang('admin.users')</a></li>
                <li class="active"><i class="fa fa-edit"></i> @lang('admin.edit_user')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('admin.edit_user')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('includes._session')
                    @include('includes._errors')
                    <form class="form-group" action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.name')</label>
                            <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.profile')</label>
                            <br/>
                            <input type="image" id="blah" src="{{ url('AdminDesign') }}/uploads/users/{{ $file->file_name }}" style="height: 80px;width: 80px;">
                            <input type="file" name="file" id="imgInp" class="my_file" style="display: none;" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.email')</label>
                            <input class="form-control" type="email" name="email" value="{{ $user->email }}">
                            <small id="emailHelp" class="form-text text-muted">@lang('admin.email_message')</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.password')</label>
                            <input class="form-control" type="password" name="password" placeholder="@lang('admin.blank_password')">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.repassword')</label>
                            <input class="form-control" type="password" name="password_confirmation">
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
