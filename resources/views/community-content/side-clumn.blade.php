@hasanyrole('Founder|Maintainer')
    @include('community-content.manage-tool')
@endhasanyrole
@if(Auth::check() && $topic->user->id == Auth::id())
    @include('community-content.auth-tool')
@endif
@include('community-content.right-author-info')