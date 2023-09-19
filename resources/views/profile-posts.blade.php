<x-layout>
    <div class="container py-md-5 container--narrow">
        <h2>
          <img class="avatar-small" src="{{$avatar}}" /> {{$username}}
          <form class="ml-2 d-inline" action="/create-follow/{{$username}}" method="POST">
            @csrf
            <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>

            <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
            @if(auth()->user()->username == $username)
            <a href="/manage-avatar" class="btn btn-secondary btn-sm">Manage profile</a>
            @endif

          </form>
        </h2>
  
        <div class="profile-nav nav nav-tabs pt-2 mb-4">

          <a href="#" class="profile-nav-link nav-item nav-link active">Posts: {{$postCount}}</a>
          <a href="#" class="profile-nav-link nav-item nav-link">Followers: 3</a>
          <a href="#" class="profile-nav-link nav-item nav-link">Following: 2</a>
        </div>
  
        <div class="list-group">
          @foreach ($posts as $post)
            {{-- <p>This is user {{ $user->id }}</p> --}}
            <a href="/post/{{$post->id}}" class="list-group-item list-group-item-action">
              <img class="avatar-tiny" src="{{$post->user->avatar}}" />
              <strong>{{$post->title}}</strong> {{$post->created_at->format('d/m/Y')}}
            </a>
          @endforeach
         
          {{-- <a href="/post/5c3af3dcc7d0ad0004e53b3d" class="list-group-item list-group-item-action">
            <img class="avatar-tiny" src="https://gravatar.com/avatar/b9408a09298632b5151200f3449434ef?s=128" />
            <strong>Example Post #2</strong> on 0/13/2019
          </a>
          <a href="/post/5c3af3dcc7d0ad0004e53b3d" class="list-group-item list-group-item-action">
            <img class="avatar-tiny" src="https://gravatar.com/avatar/b9408a09298632b5151200f3449434ef?s=128" />
            <strong>Example Post #3</strong> on 0/13/2019
          </a> --}}
        </div>
      </div>
</x-layout>