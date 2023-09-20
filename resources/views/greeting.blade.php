@extends('layouts.master')
@section('content')
<div>
    <div class="">
        <a href="{{route('greeting','en')}}" class="btn btn-primary">English</a>
        <a href="{{route('greeting','tr')}}" class="btn btn-danger">Turkish</a>
    </div>
    <div class="display-3">{{__('frontend.Welcome to our app')}}</div>
    <p>{{__('frontend.How to do Localization?')}}</p>
    <div class="row">
        <ul class="row">
            <li>{{__('frontend.Home')}}</li>
            <li>{{__('frontend.About')}}</li>
            <li>{{__('frontend.Contact')}}</li>
            <li>{{__('frontend.More')}}</li>
        </ul>
    </div>
</div>
@endsection
