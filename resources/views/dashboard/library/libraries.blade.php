@extends('dashboard.layouts.dash')

@section('content')
    <div class="coaching">
        <div class="coaching__c">
            <div class="blog__c-h">
                <a href="{{ url('dashboard/createlibrary') }}">New Library</a>
                <form action="{{ url('dashboard/search-library') }}" method="POST">
                    @csrf
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="table__c">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>District</th>
                        <th>State</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($libraries as $library)
                            <tr style="background-color:{{ $i % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                <td>{{ $i }}</td>
                                <td style="max-width:160px;">{{ $library->name }}</td>
                                <td>{{ $library->email}}</td>
                                <td>{{ $library->phone }}</td>
                                <td>{{ $library->district }}</td>
                                <td>{{ $library->state }}</td>
                                <td>
                                    <a target="_blank" href="{{ url('library') . '/' . $library->slug }}" title="Preview">
                                        <span class="material-icons">preview</span>
                                    </a>
                                    <a onclick="editItem(this)" data-type="library" data-href="{{ url('dashboard/editlibrary') . '/' . $library->id }}" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <a onclick="deleteItem(this)" data-type="library" data-href="{{ url('dashboard/deletelibrary') . '/' . $library->id }}" title="Delete">
                                        <span class="material-icons">delete</span>
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
            @if (!isset($search))
                @include('dashboard.components.pagination', ['data' => $libraries])
            @endif
        </div>
    </div>
@endsection
