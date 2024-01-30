@extends('dashboard.layouts.dash')

@section('content')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="newblog">
        <div class="newblog__c">
            <form action="{{ url('dashboard/insertblog') }}" method="post" enctype="multipart/form-data">
                <div class="newblog__c-l card">
                    <h2>New Blog</h2>
                    @csrf
                    <div class="form">
                        <input type="file" name="thumbnail" id="fileinput" required>
                        <div class="fi">
                            <label for="type">Type *</label>
                            <select name="type" id="type">
                                <option value="">Select Type</option>
                                <option value="blog">Blog Post</option>
                                <option value="job">Job Post</option>
                            </select>
                        </div>
                        <div style="display: none;" id="jobfields">
                            <div class="fi">
                                <label for="course">Course</label>
                                <select name="course_id[]" id="jobcourse" class="courses-select2" multiple>
                                    @php
                                        $exam_course = ['All India Govt. Jobs', 'Bank Jobs', 'Teaching Jobs', 'Technical Jobs(GATE/ESE/State PSUs)', 'Technical Jobs(Upto JE)', 'Railway Jobs', 'SSC Jobs', 'UPSC Jobs', 'Police/Defence Jobs', 'Andhra Pradesh Jobs', 'Assam Jobs', 'Bihar Jobs', 'Chhattisgarh Jobs', 'Delhi Jobs', 'Gujarat Jobs', 'Himachal Jobs', 'Haryana Jobs', 'Jharkhand Jobs', 'Karnataka Jobs', 'Kerala Jobs', 'Maharashtra Jobs', 'Madhya Pradesh Jobs', 'Odisha Jobs', 'Punjab Jobs', 'Rajasthan Jobs', 'Tamil Nadu Jobs', 'Telangana Jobs', 'Uttarakhand Jobs', 'Uttar Pradesh Jobs', 'West Bengal Jobs','Meghalaya Jobs','Arunachal Pradesh','Other State'];
                                    @endphp
                                    @foreach ($exam_course as $course)
                                        <option value="{{ $course }}">{{ $course }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="fi">
                                <label for="job_last_date">Job Last Date</label>
                                <input type="date" id="job_last_date" name="job_last_date">
                            </div>
                        </div>

                    {{--blogfield--}}
                    <div style="display: none;" id="blogfields">
                            <div class="fi">
                                <label for="course">Course</label>
                                <select name="course_id[]" id="blogcourse" class="courses-select2" multiple>
                                    @php
                                        $exam_course = ['JEE(Main & Adv)KVPY/Olympiad', 'Bank/IBPS', 'Railway', 'SSC', 'Technical Jobs(Upto JE)','Police/Defence Jobs', 'Civil Services/State PSC','Technical(Gate/ESE/PSUS)','NEET(UG)','NEET(PG)','CAT/MAT(MBA)','CLAT(LAW)','CA/CS(Commerce)','NIFT(NID)','Interview/GD','Music/Dance/Acting','Karate/Yoga/Sports','GMAT/GRE(Foreign Study)','JRF/NET/CSIR(UGC)/TET','6th-12th'];
                                    @endphp
                                    @foreach ($exam_course as $course)
                                        <option value="{{ $course }}">{{ $course }}</option>
                                    @endforeach
                                </select>
                            </div>

                            
                        </div>



                            
                        <div class="fi">
                            <label for="heading">Heading *</label>
                            <input type="text" id="heading" name="heading" required>
                        </div>
                         <div class="fi">
                            <label for="blogurl">Blog Url *</label>
                            <input type="text" id="blogurl" name="blog_url" required>
                        </div>
                        <div class="fi">
                            <label for="blogtitle">Title </label>
                            <input type="text" id="blogtitle" name="title">
                        </div>
                        <div class="fi">
                            <label for="blogmeta">Meta </label>
                            <input type="text" id="blogmeta" name="meta">
                        </div>
                        <div class="fi">
                            <label for="blogkeywords">Keywords </label>
                            <input type="text" id="blogkeywords" name="keywords">
                        </div>
                         <div class="fi">
                            <label for="content">Short Description *</label>
                            <textarea id="short_description" class="short_description" name="short_description"></textarea>
                        </div>
                        <div class="fi">
                            <label for="content">Content *</label>
                            <textarea id="content" class="summernote" name="content" required></textarea>
                        </div>

                    </div>
                </div>
                <div class="newblog__c-r">
                    <h2>Blog Details</h2>
                    <div class="bdc">
                        <p><b>Date:</b>{{ date('d F Y', time()) }}</p>
                        <p><b>Time:</b>{{ date('h:i A', time()) }}</p>
                        <p><b>Author:</b>{{ 'Admin' }}</p>
                    </div>
                    <div class="scontainer">
                        <label for="slug">Post Slug</label>
                        <input type="text" name="slug" id="slug">
                    </div>
                    <div class="dthumbnail">
                        <img class="thumbnail-view">
                        <label for="fileinput" class="ffi"><span class="material-icons">add_to_photos</span></label>
                    </div>
                    <button type="submit" class="create-blog-btn">Create Blog</button>
                </div>
            </form>
        </div>
    </div>

    <script>

        $('.courses-select2').select2({
            placeholder: 'Select Course',
            allowClear: false
        });

        $('#blogurl').on('input',(e)=>{
            let slug = e.target.value.toLowerCase();
            slug = slug.split(" ").join("-")
            $("#slug").val(slug);
        })

        $('#fileinput').change((e) => {
            console.log(e.target.files[0]);
            let reader = new FileReader();
            reader.onload = (re) => {
                $('.thumbnail-view').attr('src', re.target.result)
            }
            reader.readAsDataURL(e.target.files[0])
        })

        $('#type').on('change', (e) => {
            if (e.target.value === "job") {
                $("#jobfields").show();
            } else {
                $("#jobfields").hide();
                $("#blogfields").show();
            }
        })

        window.onload = () => {

            // ClassicEditor
            // .create( document.querySelector( '.summernote' ) ,{
            // } )
            // .then( editor => {
            //         console.log( editor );
            // } )
            // .catch( error => {
            //         console.error( error );
            // } );

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
        }

    </script>
@endsection
