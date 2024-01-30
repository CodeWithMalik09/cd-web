@extends('dashboard.layouts.dash')

@section('content')
    <div class="blog">
        <div class="blog__c">
            <div class="blog__c-h">
                <a href="{{ url('dashboard/createblog') }}">New Blog</a>
                <form action="{{ url('dashboard/search-blog') }}" method="POST">
                    @csrf
                    <input type="text" name="search" placeholder="heading..." value="{{ $search ?? '' }}">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="blog__c-blogs">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Created By</th>
                        <th>Heading</th>
                        <th>Type</th>
                        <th>Views</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($blogs as $blog)
                            <tr style="background-color:{{ $i % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                <td>{{ $i }}</td>
                                <td>{{ $blog->user->name ?? 'N/A' }}</td>
                                <td style="max-width: 260px;">{{ $blog->heading }}</td>
                                <td>{{ $blog->category == 'blog' ? 'Blog Post' : 'Job Post' }}</td>
                                <td>{{ $blog->views }}</td>
                                <td>{{ date('d F Y', strtotime($blog->created_at)) }}</td>
                                <td>
                                    <a data-type="blog" target="_blank" href="{{ url($blog->category) . '/' . $blog->slug }}">
                                        <span class="material-icons">preview</span>
                                    </a>
                                    <a onclick="editItem(this)" data-type="blog"
                                        data-href="{{ url('dashboard/editblog') . '/' . $blog->id }}">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    @if (auth()->user()->username != 'shubhangitq')
                                        <a onclick="deleteItem(this)" data-type="blog"
                                            data-href="{{ url('dashboard/deleteblog') . '/' . $blog->id }}">
                                            <span class="material-icons">delete</span>
                                        </a>
                                    @endif
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
