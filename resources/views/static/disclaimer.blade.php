@extends('layouts.header')

@section('content')
    @include('components.pagetitle',['title'=>"Disclaimer"])
    <body bgcolor="white">


    <div class="staticpage">
        <div class="staticpage__c">

            <div class="contact">
                <div class="contact__l">
                    <div class="contact__l-c">
                        <h3>Disclaimer</h3>
                        <div class="paragraph">
                        -------------------------------->
                        </div>
                    </div>
                </div>

                <div class="contact__r">
                    <p>
                        CoachingDetail has made diligent efforts to ensure the accuracy and reliability of the information presented on their website. However, it is important to note that they do not provide any warranty for the information provided. As a result, CoachingDetail cannot be held responsible or liable for any potential problems or inaccuracies that may arise when using the information from their website. Users are advised to exercise their own judgment and discretion when relying on the information and should not hold CoachingDetail accountable for any issues that may occur.
                    </p>
                </div>

            </div>

        </div>
    </div>

</body>
@endsection
