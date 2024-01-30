<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Preview</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20mm;
        }

        .portrait-border {
            border: 2px solid #000;
            padding: 20px;
            width: 210mm;
            height: 280mm;
            margin: auto;
            box-sizing: border-box;
        }

        img {
            max-height: 300px;
            width: auto;
            width:100%;
            display: block;
            margin: 0 auto 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 5px;
        }

        .declaration {
            font-style: italic;
            margin-bottom: 15px;
        }

        .contact-details {
            margin-top: 20px;
        }

        .data-row {
            display: flex;
            justify-content: space-between;
        }
        #printBtn{
            margin-left:90%;
            padding:4px 6px;
            border-radius:5px;
            background-color:blue;
            color:#fff;
            cursor:pointer;
        }
        @media print{
            #printBtn{
                display:none;
            }
        }
    </style>
</head>
<body>
    @foreach($enrollments as $enrollment)
    
    <div class="portrait-border">
        <img src="{{asset('assets/cdfeatures.jpeg')}}" alt="Your Image" />
        <h1>{{$enrollment->coaching->name}}</h1>
        <p>Name: {{$enrollment->name}}</p>
        <div class="data-row">
        <p>Date Of Birth: {{$enrollment->dob}}</p>
         
        </div>
        <div class="data-row">
            <p>Course: {{$enrollment->course->name}}</p>
            <p>Course Category: {{$enrollment->courseCategory->name}}</p>
            <p>Session: {{$enrollment->session}}</p>
        </div>
        <div class="data-row">
            <p>Center: {{$enrollment->centre}}</p>
            <p>Batch Type: {{$enrollment->batch_type}}</p>
            <p>Exam: {{$enrollment->exam}}</p>
        </div>
        <div class="data-row">
            <p><b>Applied on {{date('d F Y',strtotime($enrollment->created_at))}}</b></p>
        </div>
        <h3>Declaration</h3>
        <p class="declaration">This is to declare that the student, {{$enrollment->name}}, has successfully enrolled in the {{$enrollment->course->name}} coaching program at {{$enrollment->coaching->name}}. The details provided in this declaration are accurate and true to the best of the student's knowledge.</p>
        <p class="declaration">
        This declaration serves as confirmation of the student's enrollment, and they are aware of the responsibilities associated with participating in the coaching program.
        </p>
        <p class="declaration">
        We appreciate the opportunity for {{$enrollment->name}} to be part of {{$enrollment->coaching->name}} and look forward to a fruitful learning experience.
        </p>
        <h3 id="hh3">Digitally Signed By : <span style="text-decoration:underline">{{$enrollment->name}}</span></h3>
        <div class="contact-details">
        <p><b>Contact Details:</b></p>
            <p>Location:  1st Floor, Rajhans Niketan, Bailey Rd, near Canal, Rukanpura, Patna, Bihar 800014</p>
           
            <p>Email: contact@coachingdetail.com</p>
            <p>Phone:+91 9153921663</p>
        </div>
        <button id="printBtn"  onclick="printPage()">print/pdf</button>
    </div>
    @endforeach
    <script>
        function printPage(){
            window.print();
        }
    </script>
</body>
</html>
