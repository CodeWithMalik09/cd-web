@php
    $slugs="";
    $ktitlez=null;
    $meta=null;
    $ogtitle=null;
    $ogdesc=null;
    if($type=="Blog"){
        $slugs='blogs';
    }
    else{
        $slugs='jobs';
        $ktitlez='CoachingDetail : Latest notifications for all state government jobs';
        $meta='Discover the latest recruitment jobs in India for BANK,RAILWAY,SSC,PSU,etc. Get latest updates about eligibility, and application details for central jobs.';
        $ogdesc='Discover the latest recruitment jobs in India for BANK,RAILWAY,SSC,PSU,etc. Get latest updates about eligibility, and application details for central jobs.';
        $ogtitle='CoachingDetail : Latest notifications for all state government jobs';
    }
@endphp
@extends('layouts.header', ['slugs' => $slugs,$ktitlez,$meta])

<link rel="stylesheet" href="{{asset('css/blog.css')}}">
@section('content')
    @include('components.pagetitle', ['title' => $type == "Job" ? "Jobs" : $type])
  @include('social_media')

    @if($type=="Job")
    <center>
    <div class="keycontent1" style="width:90%; background-color:white; font-family:nunito; margin-top:20px; margin-right:10px;text-align:left">
     <h1 style="padding:10px;">Govt Jobs in India After Graduation - Discover High-Income Opportunities at CoachingDetail</h1>
     <div class="texts">
     <p>Are you a recent graduate exploring the maze of career choices in India? The persuasion of a stable and prestigious government job might nod you. In this complete guide, we'll scrabble about into the myriad opportunities awaiting graduates in the Indian govt. sector. From the significance of coaching to the complicacies of the application process, we'll resolve the secrets to landing your dream government job.
</p>
<h2>
Flying Government Job Opportunities
</h2>
<p>
Starting on a journey towards government jobs in India after graduation at CoachingDetail opens the doors for stability and career security. This extensive guide will help you to understand the significance of govt. jobs, the role of coaching, and how to helm the complex but rewarding path.
</p>
<h2>Compassionate the Importance of Government Jobs</h2>
<p>
Government jobs are desired for their stability, job security, and attractive compensation packages. For graduates seeking a fulfilling career, these opportunities provide the best chance to serve the nation state while enjoying countless benefits.
</p>
</div>
    </div>
   
      <h2 style=""id="jobtitletext">Latest Government Jobs In India</h2>
   
    </center>
    @endif


    <div class="blog">
        <div class="blog__c">
            <div class="blog__c-bcc" style="width:100%">
                @foreach ($blogs as $blog)
                    @include('components.blogcard', ['blog' => $blog])
                @endforeach
            </div>
            <div class="blog__c-pag">
                @if (!$blogs->onFirstPage())
                    <a href="{{ $blogs->previousPageUrl() }}">
                        <span class="material-icons">chevron_left</span>
                    </a>
                @endif
                @php
                    $start = $blogs->currentPage() < 3 ? 1 : $blogs->currentPage() - 2;
                    $end = $blogs->lastPage() < 3 ? $blogs->lastPage() :  ( $blogs->currentPage() + 3 >  $blogs->lastPage() ?  $blogs->lastPage() : $blogs->currentPage() + 3 );
                @endphp
                @for ($i = $start; $i <= $end; $i++)
                    @if (request('page') == $i || (request('page') == null && $i == 1))
                        <a href="{{ $blogs->url($i) }}" class="active-page">{{ $i }}</a>
                    @else
                        <a href="{{ $blogs->url($i) }}">{{ $i }}</a>
                    @endif
                @endfor
                @if ($blogs->hasMorePages())
                    <a href="{{ $blogs->nextPageUrl() }}">
                        <span class="material-icons">chevron_right</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <center>
   @if($type=="Job")
    <div class="keycontent2" style="width:90%; background-color:white; font-family:nunito; margin-top:20px; margin-right:10px;text-align:left">
    <div class="texts">
    <h2 style="padding-top:20px">The Part of Coaching in Your Success</h2>
<p>The Best Coaching Institute in Patna plays an important role in guiding applicants through the complications of government exams. From providing assemble study plans to offering professional guidance, CoachingDetail markedly enhances your chances of success.

</p>
   <h2>
   Where to Apply for Jobs in India?
   </h2>
   <h2>
   The Fascinate of Government Jobs
   </h2>
   <p>
   Government jobs offer a level of steadiness and reliability unmatched by most private sector roles. Additionally, the attractive compensation packages make them a lucrative choice for graduates looking to build a secure future.
   </p>
   <h2>
   Stability and Security
   </h2>
   <p>
   Job security is a major draw for the government positions. The assurance of a secure income and the knowledge that your efforts contribute to the country's growth make these roles highly desirable.
   </p>
   <h2>
   Attractive Compensation Packages
   </h2>
   <p>
   Government jobs come with competitive pay scales, allowances, and perks. This financial stability, integrated with job security, creates a fulfilling and beneficial career path.
   </p>
   <h2>
   Overview of Government Exams
   </h2>
   <h2>
   Various Realm of Exams
   </h2>
   <p>
   Government exams cover a broad scope, ranging from the UPSC Civil Services Exam to the SSC Combined Graduate Level Exam. Understanding the varied exams available allows you to couturier your preparation to your career goals.
   </p>
   <h2>
   UPSC Civil Exam Services
   </h2>
   <p>
   One of the most prestigious exams in India, the UPSC Civil Services Exam opens doors to top administrative positions. It demands extensive knowledge and a strategic approach to preparation.
   </p>
   <h2>
   SSC Combined Graduate Level Exam
   </h2>
   <p>
   Conducted by the Staff Selection Commission, this exam evaluates candidates for various Group B and C posts. Applicants need to master subjects like English, Quantitative Faculty, and General Awareness.
   </p>
   <h2>
   Eligibility Criteria
   </h2>
   <p>
   To qualify for government jobs, candidates must meet specific eligibility criteria. These criteria typically include educational qualifications and age limitations, ensuring that candidates possess the mandatory skills and maturity for the roles.
   </p>
   <h2>
   Educational Qualifications
   </h2>
   <p>
   Government jobs often require a minimum educational qualification, assorted from a bachelor's degree to specific professional degrees. Applicants need to carefully assess the eligibility criteria for their chosen exams.
   </p>
   <h2>
   Age Limitations
   </h2>
   <p>
   Government exams usually have age restrictions to ensure a balance between experience and youthful energy. Understanding and clinging to these limitations is crucial for a successful application.
   </p>
</div>
    </div>
    </center>
@endif
@endsection
