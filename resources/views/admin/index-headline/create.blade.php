@extends('frame.adminframe')
@section('title','首页头条管理')
@section('subtitleUrl',route('adminIndexHeadlinesList'))
@section('adminDrawerActiveVal','drawer-indexItem')

@section('content')
        <form id="createIndexHeadlineForm" method="post" action="{{route('adminIndexHeadlineStore')}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">创建首页头条</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.头条标题</h3>
                    <label class="mdui-textfield-label">请输入头条的标题</label>
                    <input class="mdui-textfield-input" name="title" required/>
                </div>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">2.头条超链接
                    <br><small class="show-file-title-sub">请输入链接用于跳转</small>
                </h3>
                <input class="mdui-textfield-input" name="url" placeholder="http(s)://" required>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">3.头条副标题</h3>
                <label class="mdui-textfield-label">请输入头条副标题用于展示</label>
                <input class="mdui-textfield-input" name="subtitle" required>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">4.副头条超链接
                    <br><small class="show-file-title-sub">请输入链接用于跳转</small>
                </h3>
                <input class="mdui-textfield-input" name="subUrl" placeholder="http(s)://" required>
            </div>


            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-3">5.头条位置
            </h3>
            <select name="position" class="mdui-select" required mdui-select>
                <option value="left">left——首页左侧头条</option>
                <option value="right">right——首页右侧头条</option>
            </select>


            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">6.优先级
                <br><small class="show-file-title-sub">优先级范围0-20，从左到右递增，推荐默认为0</small>
                <br><small class="show-file-title-sub">头条将先依照优先级排序，相同优先级下依照发布时间排序</small></h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="0" max="20" value="0" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="formPublicSubmit('#createIndexHeadlineForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>发布</button>
            <button onclick="formHiddenSubmit('#createIndexHeadlineForm')" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>暂存</button>
            <a href="{{route('adminIndexHeadlinesList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>返回</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
