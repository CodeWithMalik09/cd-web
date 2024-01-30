@extends('coaching.layouts.dash')

@section('content')
    <div class="cgallery">
        <div class="cgallery__c">
            @if ($images)
                @foreach ($images as $img)
                    @if ($img)
                        <div class="imgc">
                            <img src="{{url('storage').'/'.$img}}">
                            <div class="imgc__trash" data-img="{{$img}}">
                                <span class="material-icons">delete</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="empty">
                    <img src="{{asset('img/hidden.svg')}}" alt="">
                    <p>No any images in your gallery</p>
                </div>
            @endif
            <div class="upload">
                <div class="displayimg">

                </div>
                <form action="{{url('coachingcms/uploadgalleryimage')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" id="image">
                    <label for="image">Select Image</label>
                    <button type="submit">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#image').on('change',(e)=>{
            console.log(e.target.files[0]);
            let reader = new FileReader();
            reader.onload = (res)=>{
                $('.displayimg').html(`<img src="${res.target.result}">`);
            }
            reader.readAsDataURL(e.target.files[0]);
        })

        Array.of($('.imgc__trash')).forEach((item)=>{
            item.on('click',(ele)=>{
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    'url':"{{url('coachingcms/deletegalleryimage')}}",
                    'method':'POST',
                    'data': {'img':ele.currentTarget.dataset.img},
                    'success':(res)=>{
                        if(res['message'] == 'success'){
                            window.location.reload();
                        }else{
                            alert('Something went wrong!!!');
                        }
                    }
                })
            })
        })
    </script>
@endsection