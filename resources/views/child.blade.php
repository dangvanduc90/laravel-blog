@extends('layouts.primary')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

{{-- Passing Additional Data To Components, Aliasing Components --}}
@alert(['foo' => 'bar'])
@slot('title')
    Forbidden
@endslot
You are not allowed to access this resource!
@endalert

@section('content')
    <p>This is my body content.</p>
    {{ $title }}
    <br>
    {{ '$count from App\Http\ViewComposers\ProfileComposer: ' . $count }}
    @auth
        <p>The user is authenticated...</p>
    @endauth

    @guest
        <p>The user is not authenticated...</p>
    @endguest

    @env('local')
    <p>The application is in the local environment...</p>
    @elseenv('testing')
    <p>The application is in the testing environment...</p>
    @elseenv('production')
    <p>The application is in the production environment...</p>
    @else
        <p>The application is not in the local, production or testing environment...</p>
        @endenv

        @forelse($users as $user)
            {!! '<br>' . $user->name !!}
        @empty
            No users found.
        @endforelse
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endpush

@section('script')
    <script>
        let app = @json($array);
        console.log(app);
    </script>
@endsection