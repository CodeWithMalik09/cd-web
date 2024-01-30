@extends('layouts.header')

@section('content')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/themes/fontawesome-stars.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"></script>
    {{-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> --}}

    @include('components.pagetitle', ['title' => $coaching->name, 'subtitle' => 'Write your review'])
    <div class="wr">
        <div class="wr__c">
            <form action="{{url('store-review')}}" method="POST">
                @csrf
                <input type="hidden" name="rate" value="{{base64_encode($coaching->id)}}">
                <div class="ff">
                    <label for="review">Your Review</label>
                    <textarea name="review" id="review" cols="30" rows="10" required></textarea>
                </div>
                <div class="fr">
                    <label for="rate_faculties">Rate Faculties</label>
                    <select id="rate_faculties" name="rate_faculties" required>
                        <option value="1">faculties</option>
                        <option value="2">faculties</option>
                        <option value="3">faculties</option>
                        <option value="4">faculties</option>
                        <option value="5">faculties</option>
                    </select>
                </div>
                <div class="fr">
                    <label for="rate_fees">Rate Fees</label>
                    <select id="rate_fees" name="rate_fees" required>
                        <option value="1">fees</option>
                        <option value="2">fees</option>
                        <option value="3">fees</option>
                        <option value="4">fees</option>
                        <option value="5">fees</option>
                    </select>
                </div>

                <div class="fr">
                    <label for="rate_study_materials">Rate Study Materials</label>
                    <select id="rate_study_materials" name="rate_study_materials" required>
                        <option value="1">materials</option>
                        <option value="2">materials</option>
                        <option value="3">materials</option>
                        <option value="4">materials</option>
                        <option value="5">materials</option>
                    </select>
                </div>

                <div class="fr">
                    <label for="rate_results">Rate Results</label>
                    <select id="rate_results" name="rate_results" required>
                        <option value="1">results</option>
                        <option value="2">results</option>
                        <option value="3">results</option>
                        <option value="4">results</option>
                        <option value="5">results</option>
                    </select>
                </div>

                <button type="submit" class="cta">Submit Review</button>

            </form>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#rate_faculties,#rate_fees,#rate_study_materials,#rate_results').barrating({
                theme: 'fontawesome-stars',
                onSelect: function(value, text, event) {
                    $('#rate_faculties').val(value);
                }
            });
        });
    </script>
    <style>
        .br-theme-fontawesome-stars .br-widget a {
            font-size: 30px;
        }
    </style>
@endsection
