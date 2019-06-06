@if(Session::has('message'))
    <h2 style="height: 100px;font-size: 50px;" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</h2>
@endif
