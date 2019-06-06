@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('admin.users')<small>@lang('admin.register')</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active"><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> @lang('admin.users')</a></li>
                <li class="active"><i class="fa fa-plus"></i> @lang('admin.add_user')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('admin.add_user')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('includes._session')
                    @include('includes._errors')
                        <form class="form-group" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.name')</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.email')</label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                            <small id="emailHelp" class="form-text text-muted">@lang('admin.email_message')</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.password')</label>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.repassword')</label>
                            <input class="form-control" type="password" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <label>@lang('admin.choose_image')</label>
                            <br>
                            <input type="image" src="{{ url('AdminDesign') }}/uploads/upload_logo.png" width="80px"/>
                            <input type="file" name="file" id="my_file" style="display: none;" />
                        </div>
                            <!-- end permission -->
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
            $("#my_file").click();
            return false;
        });
    </script>
@endpush
