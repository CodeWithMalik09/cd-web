@extends('dashboard.layouts.dash')

@section('content')
    <div class="tutor">
        <div class="tutor__c">
            <div class="tutor__c-h">
                <a href="{{ url('dashboard/createtutor') }}">New Tutor</a>
                <form action="{{ url('/dashboard/search-tutor') }}" method="POST">
                    @csrf
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="tutor__c-tutors">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Experience</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($tutors as $tutor)
                            <tr style="background-color:{{ $i % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                <td>{{ $i }}</td>
                                <td>{{ $tutor->name }}</td>
                                <td>{{ $tutor->phone }}</td>
                                <td>{{ $tutor->email }}</td>
                                <td>{{ $tutor->gender }}</td>
                                <td>{{ $tutor->teaching_experience }}</td>
                                <td>
                                    <a target="_blank" href="{{ url('tutor') . '/' . $tutor->slug }}" title="Preview">
                                        <span class="material-icons">preview</span>
                                    </a>

                                    <a onclick="editItem(this)" data-type="tutor" data-href="{{ url('dashboard/edittutor') . '/' . $tutor->id }}" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <a onclick="deleteItem(this)" data-type="tutor" data-href="{{ url('dashboard/deletetutor') . '/' . $tutor->id }}" title="Delete">
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
