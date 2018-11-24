@extends('layout')
@section('content')

<h1>403</h1>
<h2>アクセス権限がありません</h2>
<a class="btn btn-link" href="{{ route('posts.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>

@endsection
