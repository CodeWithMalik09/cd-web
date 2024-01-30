@extends('dashboard.layouts.dash')

@section('content')
    <div class="blog">
        <div class="blog__c">
            <div class="blog__c-h">
                <form action="{{ url('dashboard/blog-upload-media') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="media" placeholder="select file to upload" required>
                    <button type="submit" class="btn">Upload</button>
                </form>
            </div>
            <div class="blog__c-blogs">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Media</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($media as $key => $file)
                            <tr style="background-color:{{ ($key + 1) % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                <td>{{ $key + 1 }}</td>
                                <td style="max-width: 260px;">
                                    {{ explode('/', $file->path)[count(explode('/', $file->path)) - 1] }}</td>
                                <td>{{ $file->type }}</td>
                                <td>{{ date('d F Y', strtotime($file->created_at)) }}</td>
                                <td>
                                    <a onclick="copyLink('{{ asset('storage/' . $file->path) }}')">
                                        <span class="material-icons">file_copy</span>
                                    </a>
                                    <a href="{{ asset('storage/' . $file->path) }}" target="_blank">
                                        <span class="material-icons">preview</span>
                                    </a>
                                    <a onclick="deleteItem(this)" data-type="blog"
                                        data-href="{{ url('dashboard/blog-delete-media') . '/' . $file->id }}">
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

    <script>
        function copyLink(link) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(link).select();
            document.execCommand("copy");
            $temp.remove();
            alert("File link copied");
        }
    </script>
@endsection
