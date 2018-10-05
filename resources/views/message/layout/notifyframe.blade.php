@extends('frame.indexframe')
@section('content')
    <div class="mdui-card content-card" style="margin-top: 10px">
        <h1 class="part-title-blue mdui-m-b-4" style="background: #fff;line-height: 28px;margin-top: 10px; margin-bottom: 10px !important; font-size: 24px">
            <i class="mdui-icon material-icons" style="font-size: 28px;">@yield('notifyframe-head-icon')</i>
            @yield('notifyframe-head-title')
        </h1>
        <div class="mdui-row">
            <div class="mdui-col-xs-12 mdui-col-sm-4 mdui-col-md-3">
                @include('message.layout.left-type-list')
            </div>
            <div class="mdui-col-xs-12 mdui-col-sm-8 mdui-col-md-9">
                @yield('right-content')
            </div>
        </div>
    </div>

@endsection