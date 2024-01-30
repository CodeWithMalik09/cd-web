@extends('dashboard.layouts.dash')

@section('content')
    <div class="locality">
        <div class="locality__c-h">
            <form action="{{ url('dashboard/search-locality') }}" method="POST">
            @csrf
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search Locality...">
            <button type="submit" class="btn">Search</button>
            </form>
        </div>
        <div class="locality__c">
            <div class="locality__c-l">
                <h2>Add New Locality</h2>
                <form action="{{url('dashboard/createlocality')}}" method="post">
                    @csrf
                    <div class="fi">
                        <label for="city">City *</label>
                        <select name="city" id="city" required>
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fi">
                        <label for="name">Locality *</label>
                        <input type="text" id="name" name="localityname" placeholder="ex. Boring Road" required>
                    </div>

                    <button type="submit" class="btn">Add</button>
                </form>
            </div>
            <div class="locality__c-r">
                <div class="rheader">
                    <h2>Localities</h2>
                    <p>Total Localities : {{count($localities)}}</p>
                </div>
                <!-- <div class="locality__c-r-oac"> -->
                    <div class="table__c">
                        <table>
                            <thead>
                                <th>Locality</th>
                                <th>City</th>
                                <th>Action</th>
                                <tbody>
                                    @foreach ($localities as $locality)
                                        <tr>
                                            <td>{{$locality->name}}</td>
                                            <td>{{$locality->cityName->name}}</td>
                                            <td>
                                                <a onclick="deleteItem(this)" data-type="locality" data-href="{{url('dashboard/deletelocality').'/'.$locality->id}}">
                                                    <span class="material-icons">delete</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </thead>
                        </table>
                </div>
                @if (!isset($search))
                    @include('dashboard.components.pagination', ['data' => $localities])
                @endif
            </div>
        </div>
    </div>
@endsection