@extends('frame.adminframe')
@section('title',__('admin.indexHeadlines'))
@section('subtitleUrl',route('adminIndexHeadlinesList'))
@section('adminDrawerActiveVal','drawer-indexItem')

@section('content')
        <form id="createIndexHeadlineForm" method="post" action="{{route('adminIndexHeadlineStore')}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">{{__('admin/index.createIndexHeadline')}}</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.{{__('admin/index.headlineTitle')}}</h3>
                    <input class="mdui-textfield-input" name="title" required/>
                </div>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">2.{{__('admin/index.headlineTitleLink')}}
                    <br><small class="show-file-title-sub">{{__('admin/index.headlineTitleLinkTip')}}</small>
                </h3>
                <input class="mdui-textfield-input" name="url" placeholder="http(s)://" required>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">3.{{__('admin/index.headlineSubtitle')}}</h3>
                <input class="mdui-textfield-input" name="subtitle" required>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">4.{{__('admin/index.headlineSubtitleLink')}}
                    <br><small class="show-file-title-sub">{{__('admin/index.headlineSubtitleLinkTip')}}</small>
                </h3>
                <input class="mdui-textfield-input" name="subUrl" placeholder="http(s)://" required>
            </div>


            <h3 class="admin-index-title mdui-text-color-indigo">5.{{__('admin/index.headlinePosition')}}
            </h3>
            <select name="position" class="mdui-select" required mdui-select>
                <option value="left">left // {{__('admin/index.headlinePositionLeftTip')}}</option>
                <option value="right">right // {{__('admin/index.headlinePositionRightTip')}}</option>
            </select>


            <h3 class="admin-index-title mdui-text-color-indigo">6.{{__('admin.priority')}}
                <br><small class="show-file-title-sub">{{__('admin/index.headlinePriorityTip1')}}</small>
                <br><small class="show-file-title-sub">{{__('admin/index.headlinePriorityTip2')}}</small></h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="0" max="20" value="0" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="formPublicSubmit('#createIndexHeadlineForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.publish')}}</button>
            <button onclick="formHiddenSubmit('#createIndexHeadlineForm')" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>{{__('community.save')}}</button>
            <a href="{{route('adminIndexHeadlinesList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>{{__('index.back')}}</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
