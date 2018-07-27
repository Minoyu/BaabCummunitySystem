<div>
    @if ($errors->any())
        <div class=" mdui-color-pink-50 admin-error-tip mdui-text-color-red">
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if (session('tips'))
        <div class=" mdui-color-green-50 admin-error-tip">
            <div>
                <ul>
                    @foreach (session('tips') as $tip)
                        <li>{{$tip}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>