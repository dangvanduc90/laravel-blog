@extends('layouts.app')

@section('content')
    <form method="post" accept-charset="UTF-8" action="{{ route('upload.file.storage') }}" enctype="multipart/form-data">
        @csrf
        File:<br>
        <input type="file" name="avatar"><br>
        <button>Submit</button>
    </form>
@endsection