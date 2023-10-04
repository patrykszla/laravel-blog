<x-profile :sharedData="$sharedData" doctitle="{{$sharedData['username']}}'s profile">
  <div class="list-group">
    @foreach ($posts as $post)
      {{-- <p>This is user {{ $user->id }}</p> --}}
      <x-post :post="$post" :hideAuthor="true"/>
    @endforeach
  </div>
</x-profile>