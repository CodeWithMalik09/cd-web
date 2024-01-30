@extends('layouts.header')

@section('content')
    @include('components.pagetitle',['title'=>"Not Found"])
    <div class="staticpage">
        <div class="staticpage__c">
            <div class="notfound">
                <img src="{{asset('img/empty-tree.svg')}}" alt="">
                <p>
                    {{$message}}
                </p>
            </div>
        </div>
    </div>
   
@endsection