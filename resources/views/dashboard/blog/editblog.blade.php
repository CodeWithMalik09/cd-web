@extends('dashboard.layouts.dash')

@section('content')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="newblog">
        <div class="newblog__c">
            <form action="{{ url('dashboard/updateblog') }}" method="post" enctype="multipart/form-data">
                <div class="newblog__c-l card">
                    <h2>Edit Blog</h2>
                    @csrf
                    <input type="hidden" name="id" value="{{ $blog->id }}">
                    <div class="form">
                        <input type="file" name="thumbnail" id="fileinput">
                        <div class="brow">
                            <div class="fi">
                                <label for="type">Type</label>
                                <select name="type" id="type">
                                    @if ($blog->category == 'job')
                                        <option value="blog">Blog Post</option>
                                        <option value="job" selected>Job Post</option>
                                    @else
                                        <option value="blog" selected>Blog Post</option>
                                        <option value="job">Job Post</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div style="display: {{ $blog->category == 'job' ? 'block' : 'none' }};" id="jobfields">
                            <div class="fi">
                                <label for="course">Course</label>
                                @php
                                    $exam_course = ['All India Govt. Jobs', 'Bank Jobs', 'Teaching Jobs', 'Technical Jobs(GATE/ESE/State PSUs)', 'Technical Jobs(Upto JE)', 'Railway Jobs', 'SSC Jobs', 'UPSC Jobs', 'Police/Defence Jobs', 'Andhra Pradesh Jobs', 'Assam Jobs', 'Bihar Jobs', 'Chhattisgarh Jobs', 'Delhi Jobs', 'Gujarat Jobs', 'Himachal Jobs', 'Haryana Jobs', 'Jharkhand Jobs', 'Karnataka Jobs', 'Kerala Jobs', 'Maharashtra Jobs', 'Madhya Pradesh Jobs', 'Odisha Jobs', 'Punjab Jobs', 'Rajasthan Jobs', 'Tamil Nadu Jobs', 'Telangana Jobs', 'Uttarakhand Jobs', 'Uttar Pradesh Jobs', 'West Bengal Jobs','Meghalaya Jobs','Arunachal Pradesh','Other State'];
                                @endphp

                                <select name="course_id[]" id="jobcourse" class="select-multiple" multiple>
                                    @if($blog->course)
                                        @foreach ($exam_course as $course)
                                            @if (in_array($course, json_decode(str_replace('-', '/', $blog->course))))
                                                <option value="{{ $course }}" selected>{{ $course }}</option>
                                            @else
                                                <option value="{{ $course }}">{{ $course }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($exam_course as $course)
                                            <option value="{{ $course }}">{{ $course }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="fi">
                                <label for="job_last_date">Job Last Date</label>
                                <input type="date" id="job_last_date" name="job_last_date" value="{{ $blog->job_last_date }}">
                            </div>
                        </div>

                       {{--blogfield--}}
                       <div style="display: {{ $blog->category == 'blog' ? 'block' : 'none' }};" id="jobfields">
                            <div class="fi">
                                <label for="course">Course</label>
                                @php
                                    $exam_course = ['JEE(Main & Adv)KVPY/Olympiad', 'Bank/IBPS', 'Railway', 'SSC', 'Technical Jobs(Upto JE)','Police/Defence Jobs', 'Civil Services/State PSC','Technical(Gate/ESE/PSUS)','NEET(UG)','NEET(PG)','CAT/MAT(MBA)','CLAT(LAW)','CA/CS(Commerce)','NIFT(NID)','Interview/GD','Music/Dance/Acting','Karate/Yoga/Sports','GMAT/GRE(Foreign Study)','JRF/NET/CSIR(UGC)/TET','6th-12th'];
                                @endphp

                                <select name="course_id[]" id="blogcourse" class="select-multiple" multiple>
                                    @if($blog->course)
                                        @foreach ($exam_course as $course)
                                            @if (in_array($course, json_decode( $blog->course)))
                                                <option value="{{ $course }}" selected>{{ $course }}</option>
                                            @else
                                                <option value="{{ $course }}">{{ $course }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($exam_course as $course)
                                            <option value="{{ $course }}">{{ $course }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            
                        </div>


                        <div class="fi">
                            <label for="heading">Heading</label>
                            <input type="text" id="heading" name="heading" value="{{ $blog->heading }}">
                        </div>
                         <div class="fi">
                            <label for="blogurl">Blog Url</label>
                            <input type="text" id="blogurl" name="blog_url" value="{{ $blog->blog_url}}">
                        </div>

                        <div class="fi">
                            <label for="blogtitle">Title </label>
                            <input type="text" id="blogtitle" name="title" value="{{$blog->title}}">
                        </div>
                        <div class="fi">
                            <label for="blogmeta">Meta </label>
                            <input type="text" id="blogmeta" name="meta" value="{{$blog->meta}}">
                        </div>
                        <div class="fi">
                            <label for="blogkeywords">Keywords </label>
                            <input type="text" id="blogkeywords" name="keywords" value="{{$blog->keywords}}">
                        </div>
                           <div class="fi">
                            <label for="content">Short Description</label>
                            <textarea id="short_description" class="short_description" name="short_description">{!! $blog->short_description !!}</textarea>
                        </div>
                        <div class="fi">
                            <label for="content">Content</label>
                            <textarea id="content" class="summernote" name="content">{!! $blog->content !!}</textarea>
                        </div>

                    </div>
                </div>
                <div class="newblog__c-r">
                    <h2>Blog Details</h2>
                    <div class="bdc">
                        <p><b>Date:</b>{{ date('d F Y', strtotime($blog->created_at)) }}</p>
                        <p><b>Time:</b>{{ date('h:i A', strtotime($blog->created_at)) }}</p>
                        <p><b>Author:</b>{{ 'Admin' }}</p>
                    </div>
                    <div class="scontainer">
                        <label for="slug">Post Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ $blog->slug }}">
                    </div>
                    <div class="dthumbnail">
                        <img class="thumbnail-view" src="{{ asset('storage/' . $blog->thumbnail) }}">
                        <label for="fileinput" class="ffi"><span class="material-icons">add_to_photos</span></label>
                    </div>
                    <button type="submit" class="create-blog-btn">Update Blog</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('#blogurl').on('input', (e) => {
            let slug = e.target.value.toLowerCase();
            slug = slug.split(" ").join("-")
            $("#slug").val(slug);
        })

        $('#fileinput').change((e) => {
            console.log(e.target.files[0]);
            let reader = new FileReader();
            reader.onload = (re) => {
                console.log(re.target);
                $('.thumbnail-view').attr('src', re.target.result)
            }
            reader.readAsDataURL(e.target.files[0])
        })

        $('#type').on('change', (e) => {
            if (e.target.value === "job") {
                $("#jobfields").show();
            } else {
                $("#jobfields").hide();
            }
        })

     $('.short_description').summernote({
            height: 150,
            toolbar: [
        ['style', ['style']],
        ['font', ['strikethrough', 'bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['link', ['link']],
        ['image', ['picture']],
        ['video', ['video']],
        ['fullscreen', ['fullscreen']],
        ['codeview', ['codeview']],
        ['help', ['help']],
        ['fontname', ['fontname']], // Add fontname to the toolbar
    ],
    fontSizes: ['8', '10', '12', '14', '16', '18', '24', '36','38','40','42','44','46','48','50','52','54','56','58','60'],
    fontNames: [
        'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Georgia',
        'Helvetica', 'Impact', 'Lucida Grande', 'Tahoma', 'Times New Roman',
        'Verdana', 'Roboto', 'Lato', 'Open Sans', 'Montserrat', 'Source Sans Pro',
        'Playfair Display', 'Nunito', 'Poppins', 'Merriweather', 'Raleway'
    ],

        });

        $('.summernote').summernote({
            height: 300,
         toolbar: [
        ['style', ['style']],
        ['font', ['strikethrough', 'bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['link', ['link']],
        ['image', ['picture']],
        ['video', ['video']],
        ['fullscreen', ['fullscreen']],
        ['codeview', ['codeview']],
        ['help', ['help']],
        ['fontname', ['fontname']], // Add fontname to the toolbar
    ],
    fontSizes: ['8', '10', '12', '14', '16', '18', '24', '36','38','40','42','44','46','48','50','52','54','56','58','60'],
    fontNames: [
        'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Georgia',
        'Helvetica', 'Impact', 'Lucida Grande', 'Tahoma', 'Times New Roman',
        'Verdana', 'Roboto', 'Lato', 'Open Sans', 'Montserrat', 'Source Sans Pro',
        'Playfair Display', 'Nunito', 'Poppins', 'Merriweather', 'Raleway'
    ],
        });
        $(document).ready(function() {
            $('.select-multiple').select2({
                //   theme:"classic"
            });
        });
    </script>
@endsection
