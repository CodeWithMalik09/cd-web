@extends('dashboard.layouts.dash')

@section('content')
    <div class="blog">
        <div class="blog__c">
            <div class="blog__c-h">
                <form action="{{ url('/') }}" method="POST">
                    <input type="text" name="search" placeholder="heading...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="blog__c-blogs">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
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
                                <td style="max-width: 220px;">{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ date('d M Y', strtotime($user->created_at)) }}</td>
                                <td>
                                    <a onclick="deleteItem(this)" data-type="user"
                                        data-href="{{ url('dashboard/delete-user') . '/' . $user->id }}" title="delete">
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
