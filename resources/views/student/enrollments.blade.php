
@extends('student.layout.dash')

@section('profilecontent')
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
    <style>
        #printbtn{
            font-size:1.7rem;
            background-color:blue;
            padding:4px 6px;
            border-radius:5px;
            color:#fff;
            margin-top:25px;
        }
        .contact{
            display:none;
        }
        #thumbnail{
            display:none;
        }
         .printf{
                display:none;
            }
            .basicdetails{
                display:none;
            }
            .declaration{
                display:none;
            }
        @media print{
         
        .contact{
            display:block;
            margin-top:15px;
            font-family:nunito;
          
        }
        .contact h2{
            font-size:2rem;

        }
            #thumbnail{
            display:block;
        }
          #sname{
           display:none;
               }
            .pagetitle{
                display:none;
            }
            .declaration{
                display:block;
                margin-top:20px;
            }
            .declaration p{
             font-size:14px;
             font-family:nunito;
            }
            #hh3{
                margin-top:18px;
            }
            #hh3 span{
                font-size:18px;
                font-weight:normal;
            }
            .basicdetails{
                display:block;
            }
            .basicdetails p{
                font-size:1.7rem;
                margin:5px;
                font-family:nunito;

            }
           
            .h{
                display:none;
            }
            .f{
                display:none;
            }
            .studash__c-l{
                display:none;
            }
            .studash__c-r{
                width:100%;
                margin:0;
                padding:0;
            }
            .printf{
                display:block;
                width:100%;
            }
        }
    </style>
</head>
    @if ($enrollments->count() == 0)
        <div class="empty">
            <img src="{{asset('img/empty-tree.svg')}}" alt="">
            <p>Oops! It seems you are not enrolled in any coaching. </p>
        </div>
    @else
        @if ($enrollments->count() != 0)
           <img src="{{asset('img/printback.jpeg')}}" alt=""  width="100%" id="thumbnail">
          
            @foreach ($enrollments as $enrollment)
                 <div class="printf">
                <h1 style="font-size:24px;color:white;font-family:nunito;background-color:#f60;padding:10px 14px;"id="titleofprint"><img src="{{asset('assets/logo.png')}}" alt="" style="height:25px;width:25px;margin-right:8px;margin-top:5px">Coaching Detail</h1>
                </div>
                <h4>Enrollments</h4>
                
                <div class="row basicdetails">
                        <p>Student Name: {{$enrollment->name}}</p>
                        <p>Date Of Birth: {{$enrollment->dob}}</p>
                        <p>Session: {{$enrollment->session}}</p>
                    </div>
              
                <div class="enrollment__card">
                    <h1 style="color:darkgray;font-family:nunito" id="sname">{{$enrollment->name}}</h1>
                    <h3>{{$enrollment->coaching->name}}</h3>
                    <div class="row">
                        <p>Course: {{$enrollment->course->name}}</p>
                        <p>Course Category: {{$enrollment->courseCategory->name}}</p>
                        <p>Session: {{$enrollment->session}}</p>
                    </div>
                    <div class="row">
                        <p>Centre: {{$enrollment->centre}}</p>
                        <p>Batch Type: {{$enrollment->batch_type}}</p>
                        <p>Exam: {{$enrollment->exam}}</p>
                    </div>
                    <div class="row mt-4">
                        <p>Applied On: {{date('d F Y',strtotime($enrollment->created_at))}}</p>
                        <span class="badge">Status: {{$enrollment->verification_status == 1 ? "verified" : "Under Verification"}}</span>
                    </div>
                    <div class="declaration">
                        <h3>Declaration</h3>
                        <p>This is to declare that the student, {{$enrollment->name}}, has successfully enrolled in the {{$enrollment->course->name}} coaching program at {{$enrollment->coaching->name}}. The details provided in this declaration are accurate and true to the best of the student's knowledge.</p>
                       <p>
                       This declaration serves as confirmation of the student's enrollment, and they are aware of the responsibilities associated with participating in the coaching program.
                       </p>
                       <p>
                       We appreciate the opportunity for {{$enrollment->name}} to be part of {{$enrollment->coaching->name}} and look forward to a fruitful learning experience.
                       </p>
                       <h3 id="hh3">Digitally Signed By : <span style="text-decoration:underline">{{$enrollment->name}}</span></h3>
                    </div>
                    
                    <div class="contact">
                    <h2 id="contact">Contact Us</h2>
                        <p style="font-size:14px">
                            Location:  1st Floor, Rajhans Niketan, Bailey Rd, near Canal, Rukanpura, Patna, Bihar 800014
                        </p>
                       
                       
                       
                       <p style="font-size:14px">
                           Email: contact@coachingdetail.com
                       </p>
                      
                      
                       
                       <p style="font-size:14px">
                           Phone:  9153921663
                       </p>
                      </div>
              <a class="btn btn-primary" href="{{url('user/print-page').'/'.$enrollment->id}}" id="printbtn">Print</a>
                </div>
            @endforeach
        @endif
    @endif
    
@endsection
{{--9153921663--}}