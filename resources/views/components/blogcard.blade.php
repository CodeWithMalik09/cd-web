<div class="blogcard">
    <a href="{{ $type == 'Job' ? url('job/' . $blog->slug) : url('blog/' . $blog->slug) }}" class="blogcard__a">
        <div class="blogcard__c">
            <img src="{{ url('storage') . '/' . $blog->thumbnail }}" alt="Blog Title">
            <div class="blogcard__c-bd">
                <img src="{{ asset('assets/logo.jpeg') }}" alt="Coaching Detail Logo">
                <p>CoachingDetail</p>
                <p>{{ date('d F Y', strtotime($blog->created_at)) }}</p>
            </div>
            <h4>{{ $blog->heading }}</h4>

            <div class="blogcard__c-ec">
                <p>{{ substr(strip_tags(str_replace(['&nbsp;', '&amp;'], [' ', '&'], $blog->content)), 0, 240) }}
                </p>
            </div>
        </div>
    </a>
</div>
