<x-profile :sharedData="$sharedData">
  <div class="list-group">
    {{-- var_dump($followers); --}}
    @foreach ($followers as $follow)
      {{-- <p>This is user {{ $user->id }}</p> --}}
      <a href="/profile/{{$follow->userDoingTheFollowing->username}}" class="list-group-item list-group-item-action">
        <img class="avatar-tiny" src="{{$follow->userDoingTheFollowing->avatar}}" />
        {{$follow->userDoingTheFollowing->username}}
      </a>
    @endforeach
  </div>
</x-profile>