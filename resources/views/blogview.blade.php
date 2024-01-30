@extends('layouts.blogHeader',['meta'=>$blog->meta,'title'=>$blog->title,'keyword'=>$blog->keywords])

@section('content')
<head>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<style>
.bv {
    border: 1px solid #ddd; /* Shady border color */
    border-radius: 8px; /* Optional: Adds rounded corners for a softer look */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adding a subtle box shadow for a shady effect */
}
.brc {
    border: 1px solid #ddd; /* Shady border color */
    border-radius: 8px; /* Optional: Adds rounded corners for a softer look */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adding a subtle box shadow for a shady effect */
}

</style>
</head>
 @include('social_media')

    @include('components.pagetitle', ['title' => $type])

    <div class="blogview">
        <div class="blogview__c">
            <div class="blogview__c-l">
                <div class="bv">
                  {{--  <img src="{{ url('storage') . '/' . $blog->thumbnail }}" alt="blog title">--}}
                    <div class="bv__cc">
                       <h1 style="font-size:44px;font-family:poppins;color:var(--title-color);">{{ $blog->heading }}</h1>
                        <div class="bv__cc-bd">
                            <img src="{{ asset('assets/logo.png') }}" alt="Coaching Detail Logo">
                            <p>CoachingDetail</p>
                            <p>{{ date('d F Y', strtotime($blog->created_at)) }}</p>
                        </div>
                        <article>{!! $blog->content !!}</article>


                        <div class="share-btn"onclick="shareMe('{{ urlencode(url($blog->category) . '/' . $blog->slug) }}')">
                            <span class="text">Share it on: </span>
                            <div class="share-container">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url("$blog->category/$blog->slug") }}" target="_blank">
                                    <i class="fab fa-facebook"></i>
                                    <span>Facebook</span>
                                </a>
                                <a href="http://twitter.com/share?text=ShareCoachingDetaile&url={{ url("$blog->category/$blog->slug") }}"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                    <span>Twitter</span>
                                </a>
                                <a href="https://wa.me/?text={{ url("$blog->category/$blog->slug") }}" target="_blank">
                                    <i class="fab fa-whatsapp"></i>
                                    <span>Whatsapp</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="blogview__c-r">
                <div class="brc">
                    <h5>Related Posts</h5>
                    @foreach ($relatedblogs as $rblog)
                        <div class="brc__rc">
                            <img src="{{ url('storage') . '/' . $rblog->thumbnail }}" alt="Post name">
                            <div class="brc__rc-tc">
                                <a
                                    href="{{ $rblog->category == 'job' ? url('job') . '/' . $rblog->slug : url('blog') . '/' . $rblog->slug }}">
                                    <h4>{{ $rblog->heading }}</h4>
                                </a>
                                <p>{{ date('d F Y', strtotime($rblog->created_at)) }}</p>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>


    </div>
@endsection
