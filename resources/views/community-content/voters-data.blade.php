@foreach($voters as $voter)
    <a href="{{route('showPersonalCenter',$voter->id)}}" mdui-tooltip="{content: '{{$voter->name}}',position:'top'}">
        <img class="user-avatar mdui-hoverable" src="{{$voter->info->avatar_url}}">
    </a>
@endforeach
