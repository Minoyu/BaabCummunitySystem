@if(!$user->info->motto)
    <div class="mdui-card  mdui-m-b-1 mdui-hoverable">
        <form method="post" action="{{route('helpEditUserMotto',$user->id)}}">
            {{csrf_field()}}
            <div class="side-card-header">
                <div class="side-card-header-text">
                    用一句话介绍下自己吧
                    <small>
                        让大家更了解你
                    </small>
                </div>
                <button type="button" onclick="handleCloseHelpUpdateInfo('{{route('closeHelpEditUserInfo',$user->id)}}')" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-color-theme-accent mdui-ripple mdui-float-right mdui-text-color-grey-800"><i class="mdui-icon material-icons">close</i></button>

            </div>
            <div class="side-card-content-with-p-x">
                <div class="mdui-textfield mdui-p-y-0">
                    <label class="mdui-textfield-label">一句话介绍</label>
                    <input class="mdui-textfield-input" name="motto" type="text" required/>
                </div>
            </div>
            <div class="side-card-action">
                <button type="submit" class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-pink-accent mdui-ripple mdui-hoverable">提交</button>
            </div>
        </form>
    </div>
@elseif(!$user->info->nation)
    <div class="mdui-card  mdui-m-b-1 mdui-hoverable">
        <form method="post" action="{{route('helpEditUserNation',$user->id)}}">
            {{csrf_field()}}
            <div class="side-card-header">
                <div class="side-card-header-text">
                    你来自哪里？
                    <small>
                        若选择不展示此信息，我们会保护您的隐私
                    </small>
                </div>
                <button type="button" onclick="handleCloseHelpUpdateInfo('{{route('closeHelpEditUserInfo',$user->id)}}')" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-color-theme-accent mdui-ripple mdui-float-right mdui-text-color-grey-800"><i class="mdui-icon material-icons">close</i></button>

            </div>
            <div class="side-card-content-with-p-x">
                <div class="mdui-textfield mdui-p-y-0">
                    <label class="mdui-textfield-label">国家/国籍</label>
                    <input class="mdui-textfield-input" name="nation" type="text" required/>
                </div>
            </div>
            <div class="side-card-action">
                <label class="mdui-switch mdui-p-r-1">
                    <input type="checkbox" name="nation_open" checked/>
                    <i class="mdui-switch-icon"></i>
                    <span class="mdui-hidden-xs">在个人页面</span>公开展示
                </label>
                <button type="submit" class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-pink-accent mdui-ripple mdui-hoverable">提交</button>
            </div>
        </form>
    </div>
@elseif(!$user->info->engaged_in)
    <div class="mdui-card  mdui-m-b-1 mdui-hoverable">
        <form method="post" action="{{route('helpEditUserEngaged',$user->id)}}">
            {{csrf_field()}}
            <div class="side-card-header">
                <div class="side-card-header-text">
                    你现在所从事的行业？
                    <small>
                        若选择不展示此信息，我们会保护您的隐私
                    </small>
                </div>
                <button type="button" onclick="handleCloseHelpUpdateInfo('{{route('closeHelpEditUserInfo',$user->id)}}')" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-color-theme-accent mdui-ripple mdui-float-right mdui-text-color-grey-800"><i class="mdui-icon material-icons">close</i></button>

            </div>
            <div class="side-card-content-with-p-x">
                <div class="mdui-textfield mdui-p-y-0">
                    <label class="mdui-textfield-label">职业/从事行业</label>
                    <input class="mdui-textfield-input" name="engaged_in" type="text" required/>
                </div>
            </div>
            <div class="side-card-action">
                <label class="mdui-switch mdui-p-r-1">
                    <input type="checkbox" name="engaged_in_open" checked/>
                    <i class="mdui-switch-icon"></i>
                    <span class="mdui-hidden-xs">在个人页面</span>公开展示
                </label>
                <button type="submit" class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-pink-accent mdui-ripple mdui-hoverable">提交</button>
            </div>
        </form>
    </div>
@elseif(!$user->info->living_city)
    <div class="mdui-card  mdui-m-b-1 mdui-hoverable">
        <form method="post" action="{{route('helpEditUserLivingCity',$user->id)}}">
            {{csrf_field()}}
            <div class="side-card-header">
                <div class="side-card-header-text">
                    你现居哪座城市？
                    <small>
                        若选择不展示此信息，我们会保护您的隐私
                    </small>
                </div>
                <button type="button" onclick="handleCloseHelpUpdateInfo('{{route('closeHelpEditUserInfo',$user->id)}}')" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-color-theme-accent mdui-ripple mdui-float-right mdui-text-color-grey-800"><i class="mdui-icon material-icons">close</i></button>

            </div>
            <div class="side-card-content-with-p-x">
                <div class="mdui-textfield mdui-p-y-0">
                    <label class="mdui-textfield-label">现居城市</label>
                    <input class="mdui-textfield-input" name="living_city" type="text" required/>
                </div>
            </div>
            <div class="side-card-action">
                <label class="mdui-switch mdui-p-r-1">
                    <input type="checkbox" name="living_city_open" checked/>
                    <i class="mdui-switch-icon"></i>
                    <span class="mdui-hidden-xs">在个人页面</span>公开展示
                </label>
                <button type="submit" class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-pink-accent mdui-ripple mdui-hoverable">提交</button>
            </div>
        </form>
    </div>
@elseif(!$user->info->wechat)
    <div class="mdui-card  mdui-m-b-1 mdui-hoverable">
        <form method="post" action="{{route('helpEditUserWechat',$user->id)}}">
            {{csrf_field()}}
            <div class="side-card-header">
                <div class="side-card-header-text">
                    你拥有微信账号吗？
                    <small>
                        微信是一个中国的即时交流APP
                    </small>
                </div>
                <button type="button" onclick="handleCloseHelpUpdateInfo('{{route('closeHelpEditUserInfo',$user->id)}}')" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-color-theme-accent mdui-ripple mdui-float-right mdui-text-color-grey-800"><i class="mdui-icon material-icons">close</i></button>

            </div>
            <div class="side-card-content-with-p-x">
                <div class="mdui-textfield mdui-p-y-0">
                    <label class="mdui-textfield-label">微信号</label>
                    <input class="mdui-textfield-input" name="wechat" type="text" required/>
                </div>
            </div>
            <div class="side-card-action">
                <label class="mdui-switch mdui-p-r-1">
                    <input type="checkbox" name="wechat_open" checked/>
                    <i class="mdui-switch-icon"></i>
                    <span class="mdui-hidden-xs">在个人页面</span>公开展示
                </label>
                <button type="submit" class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-pink-accent mdui-ripple mdui-hoverable">提交</button>
            </div>
        </form>
    </div>
@endif