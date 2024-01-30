@extends('dashboard.layouts.dash')

@section('content')
    <div class="city">
        <div class="city__c">
            <div class="city__c-l">
                <h2>Add New City</h2>
                <form action="{{url('dashboard/createcity')}}" method="post">
                    @csrf
                    <div class="fi">
                        <label for="name">City Name</label>
                        <input type="text" id="name" name="cityname" placeholder="ex. Patna">
                    </div>
                    <button type="submit" class="btn">Add</button>
                </form>
            </div>
            <div class="city__c-r">
                <div class="rheader">
                    <h2>Operation Areas</h2>
                    <p>Total Areas : {{count($cities)}}</p>
                </div>
                <div class="city__c-r-oac">
                    @foreach ($cities as $city)
                        <div class="oa">
                            <h3>{{$city->name}}</h3>
                            <div class="oa__controls">
                                {{-- <span class="material-icons">edit</span> --}}
                                <a onclick="deleteItem(this)" data-type="city" data-href="{{url('dashboard/deletecity').'/'.$city->id}}">
                                    <span class="material-icons">delete</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection