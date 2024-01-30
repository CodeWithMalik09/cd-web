@extends('dashboard.layouts.dash')

@section('content')
    <div class="coaching">
        <div class="coaching__c">
            <div class="blog__c-h">
                <a href="{{ url('dashboard/addkeywords') }}"> Add SEO Keywords</a>
                <form action="{{ url('dashboard/search-coaching') }}" method="POST">
                    @csrf
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="table__c">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Course Type</th>
                        <th>Course</th>
                        <th>City</th>
                        <th>Key1</th>
                        <th>Key2</th>
                        <th>Key3</th>
                        <th>Title</th>
                        <th>Meta</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($keywords as $keyword)
                            <tr style="background-color:{{ $i % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                <td>{{ $i }}</td>
                                <td style="max-width:160px;">

                                    @foreach ($categories as $category)
                                        @if($category->id == $keyword->category)

                                    {{ $category->name }}
                                    @break
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($courses as $course)
                                        @if($course->id == $keyword->course)

                                    {{ $course->name ?? "N/A" }}
                                    @break;
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($cities as $city)
                                        @if($city->id == $keyword->city)

                                    {{ $city->name }}
                                    @break;
                                    @endif
                                    @endforeach
                                </td>
                                <td>{{ $keyword->key1}}</td>
                                <td>{{ $keyword->key2}}</td>
                                <td>{{ $keyword->key3}}</td>
                                <td>{{ $keyword->title}}</td>
                                <td>{{ $keyword->meta}}</td>

                                {{-- <td>{{date('d F Y',strtotime($coaching->created_at))}}</td> --}}
                                <td>
                                <a onclick="deleteItem(this)" data-type="coaching" data-href="{{ url('dashboard/deletekeyword') . '/' . $keyword->id }}" title="Delete">
                                    <span class="material-icons">delete</span>
                                </a>

                                <a onclick="deleteItem(this)" data-type="coaching" data-href="{{ url('dashboard/editkeyword') . '/' . $keyword->id }}" title="Edit">
                                    <span class="material-icons">edit</span>
                                </a>
                            </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
