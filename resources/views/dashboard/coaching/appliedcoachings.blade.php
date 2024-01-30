@extends('dashboard.layouts.dash')

@section('content')
    <div class="coaching">
        <div class="coaching__c">
            <div class="blog__c-h">
                <a href="{{ url('dashboard/createcoaching') }}">New Coaching</a>
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
                        <th>Name</th>
                        <th>Course</th>
                        <th>Phone</th>
                        <th>District</th>
                        <th>State</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($coachings as $coaching)
                            <tr style="background-color:{{ $i % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                <td>{{ $i }}</td>
                                <td style="max-width:160px;">{{ $coaching->name }}</td>
                                <td>{{ $coaching->mainCourse->name ?? "N/A" }}</td>
                                <td>{{ $coaching->phone }}</td>
                                <td>{{ $coaching->district }}</td>
                                <td>{{ $coaching->state }}</td>
                                {{-- <td>{{date('d F Y',strtotime($coaching->created_at))}}</td> --}}
                                <td>
                                    @if (isset($type) && $type == 'unapproved')
                                        <a href="{{ url('dashboard/approve-coaching') . '/' . $coaching->id }}"
                                            title="Approve">
                                            <span class="material-icons">check</span>
                                        </a>
                                    @endif

                                    <a target="_blank" href="{{ url('coaching') . '/' . $coaching->slug }}" title="preview">
                                        <span class="material-icons">preview</span>
                                    </a>
                                    @if($coaching->is_verified == null)
                                    <a onclick="ApproveItem(this)" data-type="coaching" data-href="{{ url('dashboard/approve') . '/' . $coaching->id }}" title="Edit">
                                        <span class="material-icons">close</span>
                                    </a>
                                    @else
                                    <a onclick="unApproveItem(this)" data-type="coaching" data-href="{{ url('dashboard/unapprove') . '/' . $coaching->id }}" title="Edit">
                                        <span class="material-icons">done</span>
                                    </a>
                                    @endif
                                    <a onclick="editItem(this)" data-type="coaching" data-href="{{ url('dashboard/editappliedcoaching') . '/' . $coaching->id }}" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </a>

                                    <a onclick="deleteItem(this)" data-type="coaching" data-href="{{ url('dashboard/deleteappliedcoaching') . '/' . $coaching->id }}" title="Delete">
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
                @include('dashboard.components.pagination', ['data' => $coachings])
            @endif
        </div>
    </div>
@endsection
