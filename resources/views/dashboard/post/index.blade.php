@extends('dashboard.layouts.dash')

@section('content')
    <div class="blog">
        <div class="blog__c">
            <div class="blog__c-h">
                <form action="{{url('/')}}" method="POST">
                    <input type="text" name="search" placeholder="search...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="blog__c-blogs">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Posted By</th>
                        <th>Content</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($posts as $post)
                            <tr style="background-color:{{$i % 2 == 0 ? 'rgba(242,242,242)' : 'white'}};">
                                <td>{{$i}}</td>
                                <td style="max-width: 220px;">{{$post->user->name ?? ""}}</td>
                                <td style="max-width: 220px;">{{$post->content}}</td>
                                <td>{{date('g:i A d M Y',strtotime($post->created_at))}}</td>
                                <td>
                                   
                                    <a href="{{url('dashboard/delete-post').'/'.$post->id}}" title="delete">
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