@extends('layout')
@section('content')

<h1>404</h1>
<h2>ページが存在しません</h2>
<a class="btn btn-link" href="{{ route('posts.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
@endsection
