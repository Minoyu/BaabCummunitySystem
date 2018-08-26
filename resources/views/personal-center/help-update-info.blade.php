@if(!$user->info->motto)
    <div class="mdui-card  mdui-m-b-2 mdui-hoverable">
        <form method="post" action="{{route('helpEditUserMotto',$user->id)}}">
            {{csrf_field()}}
            <div class="side-card-header info-helper-card-header">
                <div class="side-card-header-text">
                    {{__('user.mottoHelperHeader')}}
                    <br>
                    <small>
                        {{__('user.mottoHelperHeaderTip')}}
                    </small>
                </div>
                <button type="button" onclick="handleCloseHelpUpdateInfo('{{route('closeHelpEditUserInfo',$user->id)}}')" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-color-theme-accent mdui-ripple mdui-float-right mdui-text-color-grey-800"><i class="mdui-icon material-icons">close</i></button>

            </div>
            <div class="side-card-content-with-p-x">
                <div class="mdui-textfield mdui-p-y-0">
                    <label class="mdui-textfield-label">{{__('user.motto')}}</label>
                    <input class="mdui-textfield-input" name="motto" type="text" required/>
                </div>
            </div>
            <div class="side-card-action">
                <button type="submit" class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-pink-accent mdui-ripple mdui-hoverable">提交</button>
            </div>
        </form>
    </div>
@elseif(!$user->info->nation)
    <div class="mdui-card  mdui-m-b-2 mdui-hoverable">
        <form method="post" action="{{route('helpEditUserNation',$user->id)}}">
            {{csrf_field()}}
            <div class="side-card-header info-helper-card-header">
                <div class="side-card-header-text">
                    {{__('user.nationHelperHeader')}}？
                    <br>
                    <small>
                        {{__('user.notShowTip')}}
                    </small>
                </div>
                <button type="button" onclick="handleCloseHelpUpdateInfo('{{route('closeHelpEditUserInfo',$user->id)}}')" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-color-theme-accent mdui-ripple mdui-float-right mdui-text-color-grey-800"><i class="mdui-icon material-icons">close</i></button>

            </div>
            <div class="side-card-content-with-p-x">
                <div class="mdui-textfield mdui-p-y-0">
                    <label class="mdui-textfield-label">{{__('user.nation')}}</label>
                    <input class="mdui-textfield-input" name="nation" type="text" required/>
                </div>
            </div>
            <div class="side-card-action">
                <label class="mdui-switch mdui-p-r-1">
                    <input type="checkbox" name="nation_open" checked/>
                    <i class="mdui-switch-icon"></i>
                    {{__('user.publicDisplay')}}
                </label>
                <button type="submit" class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-pink-accent mdui-ripple mdui-hoverable">提交</button>
            </div>
        </form>
    </div>
@elseif(!$user->info->engaged_in)
    <div class="mdui-card  mdui-m-b-2 mdui-hoverable">
        <form method="post" action="{{route('helpEditUserEngaged',$user->id)}}">
            {{csrf_field()}}
            <div class="side-card-header info-helper-card-header">
                <div class="side-card-header-text">
                    {{__('user.engagedInHelperHeader')}}？
                    <br>
                    <small>
                        {{__('user.notShowTip')}}
                    </small>
                </div>
                <button type="button" onclick="handleCloseHelpUpdateInfo('{{route('closeHelpEditUserInfo',$user->id)}}')" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-color-theme-accent mdui-ripple mdui-float-right mdui-text-color-grey-800"><i class="mdui-icon material-icons">close</i></button>

            </div>
            <div class="side-card-content-with-p-x">
                <div class="mdui-textfield mdui-p-y-0">
                    <label class="mdui-textfield-label">{{__('user.engagedIn')}}</label>
                    <input class="mdui-textfield-input" name="engaged_in" type="text" required/>
                </div>
            </div>
            <div class="side-card-action">
                <label class="mdui-switch mdui-p-r-1">
                    <input type="checkbox" name="engaged_in_open" checked/>
                    <i class="mdui-switch-icon"></i>
                    {{__('user.publicDisplay')}}
                </label>
                <button type="submit" class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-pink-accent mdui-ripple mdui-hoverable">提交</button>
            </div>
        </form>
    </div>
@elseif(!$user->info->living_city)
    <div class="mdui-card  mdui-m-b-2 mdui-hoverable">
        <form method="post" action="{{route('helpEditUserLivingCity',$user->id)}}">
            {{csrf_field()}}
            <div class="side-card-header info-helper-card-header">
                <div class="side-card-header-text">
                    {{__('user.livingCityHelperHeader')}}？
                    <br>
                    <small>
                        {{__('user.notShowTip')}}
                    </small>
                </div>
                <button type="button" onclick="handleCloseHelpUpdateInfo('{{route('closeHelpEditUserInfo',$user->id)}}')" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-color-theme-accent mdui-ripple mdui-float-right mdui-text-color-grey-800"><i class="mdui-icon material-icons">close</i></button>

            </div>
            <div class="side-card-content-with-p-x">
                <div class="mdui-textfield mdui-p-y-0">
                    <label class="mdui-textfield-label">{{__('user.livingCity')}}</label>
                    <input class="mdui-textfield-input" name="living_city" type="text" required/>
                </div>
            </div>
            <div class="side-card-action">
                <label class="mdui-switch mdui-p-r-1">
                    <input type="checkbox" name="living_city_open" checked/>
                    <i class="mdui-switch-icon"></i>
                    {{__('user.publicDisplay')}}
                </label>
                <button type="submit" class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-pink-accent mdui-ripple mdui-hoverable">提交</button>
            </div>
        </form>
    </div>
@elseif(!$user->info->wechat)
    <div class="mdui-card  mdui-m-b-2 mdui-hoverable">
        <form method="post" action="{{route('helpEditUserWechat',$user->id)}}">
            {{csrf_field()}}
            <div class="side-card-header info-helper-card-header">
                <div class="side-card-header-text">
                    {{__('user.wechatHelperHeader')}}？
                    <br>
                    <small>
                        {{__('user.wechatHelperHeaderTip')}}
                    </small>
                </div>
                <button type="button" onclick="handleCloseHelpUpdateInfo('{{route('closeHelpEditUserInfo',$user->id)}}')" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-color-theme-accent mdui-ripple mdui-float-right mdui-text-color-grey-800"><i class="mdui-icon material-icons">close</i></button>

            </div>
            <div class="side-card-content-with-p-x">
                <div class="mdui-textfield mdui-p-y-0">
                    <label class="mdui-textfield-label">{{__('user.wechatId')}}</label>
                    <input class="mdui-textfield-input" name="wechat" type="text" required/>
                </div>
            </div>
            <div class="side-card-action">
                <label class="mdui-switch mdui-p-r-1">
                    <input type="checkbox" name="wechat_open" checked/>
                    <i class="mdui-switch-icon"></i>
                    {{__('user.publicDisplay')}}
                </label>
                <button type="submit" class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-pink-accent mdui-ripple mdui-hoverable">提交</button>
            </div>
        </form>
    </div>
@endif