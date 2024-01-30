@extends('dashboard.layouts.dash')

@section('content')
    <div class="coaching">
        <div class="coaching__c">
            <div class="blog__c-h">
                <form action="{{ url('dashboard/search-coaching') }}" method="POST">
                    @csrf
                    <input type="text" name="search" value="" placeholder="Search...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="table__c">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Coaching</th>
                        <th>Course</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($enrollments as $key => $enrollment)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$enrollment->name}}</td>
                                <td>{{$enrollment->mobile}}</td>
                                <td>{{$enrollment->coaching->name ?? 'N/A'}}</td>
                                <td>{{$enrollment->course->name}}</td>
                                <td>{{date('g:i A d M Y',strtotime($enrollment->created_at))}}</td>
                                <td>
                                    <a target="_blank" href="{{ url('dashboard/view-enrollment') . '/' . $enrollment->slug }}" title="Edit">
                                        <span class="material-icons">preview</span>
                                    </a>
                                    <a onclick="editItem(this)" data-type="enrollment" data-href="{{ url('dashboard/edit-enrollment') . '/' . $enrollment->id }}" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </a>
                                     @if($enrollment->verification_status == 0)
                                    <a onclick="editItem(this)" data-type="enrollment" data-href="{{ url('dashboard/verify-enrollment') . '/' . $enrollment->id }}" title="Verify">
                                        <span class="material-icons">done</span>
                                    </a>
                                    @else
                                    <a onclick="editItem(this)" data-type="enrollment" data-href="{{ url('dashboard/unverify-enrollment') . '/' . $enrollment->id }}" title="Disapprove">
                                    <span class="material-icons">close</span>
                                    @endif                                    
                                       <a onclick="deleteItem(this)" data-type="enrollment" data-href="{{ url('dashboard/delete-enrollment') . '/' . $enrollment->id }}" title="Delete">
                                        <span class="material-icons">delete</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
@endsection
