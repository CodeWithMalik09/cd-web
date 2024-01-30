@extends('dashboard.layouts.dash')

@section('content')
    <div class="blog">
        <div class="blog__c">
            <div class="blog__c-h">
                {{-- <form action="{{ url('/') }}" method="POST">
                    <input type="text" name="search" placeholder="heading...">
                    <button type="submit" class="btn">Search</button>
                </form> --}}
                <a href="{{ url('dashboard/new-cms-user') }}" class="btn" style="margin-left:auto;">Add New CMS User</a>
            </div>
            <div class="blog__c-blogs">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Listing Count</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($users as $user)
                            <tr style="background-color:{{ $i % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                <td>{{ $i }}</td>
                                <td style="max-width: 220px;">{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{$user->operatorListings->count()}}</td>
                                <td>{{ date('d M Y', strtotime($user->created_at)) }}</td>
                                <td>
                                    <a href="{{ url('dashboard/cms-user-view/' . $user->id) }}" title="View Account">
                                        <span class="material-icons">
                                            visibility
                                        </span>
                                    </a>
                                    <a href="{{ url('dashboard/cms-user-edit/' . $user->id) }}" title="View Account">
                                        <span class="material-icons">
                                            edit
                                        </span>
                                    </a>
                                    <a onclick="deleteItem(this)" data-type="user"
                                        data-href="{{ url('dashboard/change-cms-user-role') . '/' . $user->id }}"
                                        title="delete">
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
        </div>
    </div>
@endsection
