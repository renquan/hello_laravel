@extends('layouts.default')
@section('title','主页')
@section('content')
<div class="jumbotron">
<h1>Hello Laravel</h1>
<p class="lead">你现在所看到的是 <a href="www.baidu.com">百度百度</a></p>
<p>一切，将从这里开始1。</p>
<a href="{{ route('signup') }}" class="btn btn-success btn-lg" tabindex="-1" role="button" >现在注册</a>
</div>
@stop
