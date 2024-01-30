@extends('dashboard.layouts.dash')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="crlibrary">
        <div class="crlibrary__c">
            <form action="{{ url('dashboard/insertlibrary') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="crlibrary__c-l">
                    <div class="form">
                        <h5>Add New Library</h5>
                        <div class="fr">
                            <div class="fi">
                                <label for="libraryname">Name *</label>
                                <input type="text" name="name" id="libraryname" required>
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="cities">City *</label>
                                <select name="cities" id="cities" required>
                                    <option value="">Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fi">
                                <label for="email">Email </label>
                                <input type="email" name="email" id="email">
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" maxlength="24" name="phone" id="phone" required>
                            </div>
                            <div class="fi">
                                <label for="altphone">Alternate Phone Number</label>
                                <input type="tel" maxlength="24" name="alternate_phone" id="altphone">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="landmark">Landmark</label>
                                <input type="text" name="landmark" id="landmark">
                            </div>
                            
                            <div class="fi">
                                <label for="address">Address *</label>
                                <input type="text" name="address" id="address" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="district">District *</label>
                                <input type="text" name="district" id="district" required>
                            </div>
                            <div class="fi">
                                <label for="state">State *</label>
                                <input type="text" name="state" id="state" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="country">Country *</label>
                                <input type="text" name="country" id="country" required>
                            </div>
                            <div class="fi">
                                <label for="pincode">Pincode *</label>
                                <input type="number" max="999999" maxlength="6" name="pincode" id="pincode" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="latitude">Latitude (take it from google map)</label>
                                <input type="text" name="latitude" id="latitude">
                            </div>
                            <div class="fi">
                                <label for="longitude">Longitude (take it from google map)</label>
                                <input type="text" name="longitude" id="longitude">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="website">Website (Leave empty if not found)</label>
                                <input type="url" name="website" id="website">
                            </div>
                            <div class="fi">
                                <label for="facebook">Facebook Link (Leave empty if not found)</label>
                                <input type="url" name="facebook_link" id="facebook">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="youtube">Youtube Link (Leave empty if not found)</label>
                                <input type="url" name="youtube_link" id="youtube">
                            </div>
                            <div class="fi">
                                <label for="twitter">Twitter Link (Leave empty if not found)</label>
                                <input type="url" name="twitter_link" id="twitter">
                            </div>
                        </div>
                        
                        <div class="fr">
                            <div class="fi">
                                <label for="head">Head of Organisation</label>
                                <input type="text" name="head_organisation" id="head">
                            </div>

                            <div class="fi">
                                <label for="establishment">Establishment</label>
                                <input type="text" name="establishment" id="establishment">
                            </div> 
                        </div>

                        <div class="fr">

                            <div class="fi">
                                <label for="area">Total Area</label>
                                <input type="number" name="total_area" id="area">
                            </div>

                            <div class="fi">
                                <label for="cities">Fee Structure</label>
                                <select name="fee_structure" id="fee_structure">
                                    <option value="monthly">Monthly</option>
                                    <option value="weekly">Weekly</option>
                                </select>
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="payment">Available Modes Of Payment</label>
                                 <select class="js-example-basic-multiple" name="modes_of_payment[]" id="payment" style="width: 100%" data-placeholder="Choose Payment Mode.."  multiple>
                                    <option value="0">All</option>
                                    <option value="Debit and Credit card" selected>Debit and Credit card</option>
                                    <option value="UPI" selected>UPI(GPay,Paytm,PhonePe)</option>
                                    <option value="Cash" selected>Cash</option>
                                
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="ac">AC Available</label>
                                <select name="ac_available" id="ac" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="cctv">CCTV with recording</label>
                                <select name="cctv_with_recording" id="cctv" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>   
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="tandc">Term & Condition</label>
                                <textarea name="tandc" id="tandc" cols="30" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="about">About * </label>
                                <textarea name="about" id="about" cols="30" rows="6" required></textarea>
                            </div>
                        </div>

                         @include('dashboard.library.fee')
                        @include('dashboard.library.facility')

                    </div>
                </div>
                <div class="crlibrary__c-r">
                    <div class="btn__c">
                        <button type="submit" class="btn__c-btn">Add Library</button>
                    </div>
                    <h2>Images</h2>
                    <div class="di">
                        <img src="{{ asset('assets/img_placeholder.png') }}"
                            style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail">
                    <label for="thumbnail">Select Thumbnail</label>
                    <div class="lic">
                        <img src="{{ asset('assets/img_placeholder.png') }}"
                            style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                    </div>
                    <input type="file" name="logo" id="logo" required>
                    <label for="logo">Logo *</label>
                    <div class="gc"></div>
                    <input type="file" name="gallery[]" multiple id="gallery">
                    <label for="gallery">Add Gallery</label>
                    <div class="vc"></div>
                    <input type="file" name="video" id="video" accept="video/*">
                    <label for="video">Add Video</label>
                </div>
            </form>
        </div>
    </div>

    <style>
        .select2-container--default .select2-selection--multiple {
            background-color: white;
            border: 1px solid rgba(255, 102, 0, 0.3);
            border-radius: 10px; 
            cursor: text;
            padding-bottom: 0px; 
            padding-right: 5px;
            position: relative;
        }

        .select2-container .select2-search--inline .select2-search__field {
            height:25px !important;
        }

        .select2-search__field
        {
/*            width:100% !important;*/
            border:0px !important;
            resize:inherit !important;
            padding: 0px !important;
        }
        
    </style>

    <script>

        $("#payment").on('change', function(e) {

            var selectedPaymentMode = jQuery(this).val();
            if (jQuery.inArray("0", selectedPaymentMode) != -1) {
                $("#payment option").prop('selected',true);
                $("#payment option[value='0']").prop('selected',false);
            }
        });


        $('#logo').change((e) => {
            let reader = new FileReader();
            reader.onload = (re) => {
                $('.lic').empty()
                $('.lic').append(`<img src="${re.target.result}"/>`);
            }
            reader.readAsDataURL(e.target.files[0])
        })
        $('#thumbnail').change((e) => {
            $('.di').empty()
            let reader = new FileReader();
            reader.onload = (re) => {
                $('.di').append(`<img src="${re.target.result}"/>`);
            }
            reader.readAsDataURL(e.target.files[0])
        })
        $('#gallery').change((e) => {
            Array.from(e.target.files).forEach(element => {
                console.log(element);
                let reader = new FileReader();
                reader.onload = (re) => {
                    $('.gc').append(`
                        <div class="img__c">
                            <a onclick="removeGalleryImage(this)">
                                <div class="remove">
                                    <span>X</span>
                                </div>
                            </a>
                            <img src="${re.target.result}" alt="">
                        </div>
                    `);
                }
                reader.readAsDataURL(element)

            });
        });

        $('#video').change((e) => {
            let fileSize = 0;
            fileSize = e.target.files[0].size / (1024*1024);
            $('.vc').empty();
            if(fileSize > 25)
            {
                swal({
                    title: "Limit Exceeded!",
                    text: `Size of video is greater than maximum allowed size of 25 MB !`,
                    icon: "warning",
                    dangerMode: true,
                });
            }
            else
            {
                let reader = new FileReader();
                reader.onload = (re) => {
                    $('.vc').append(`<video id= "videoFile" controls><source src="${re.target.result}"/ type="video/mp4"></video>`);
                }
                reader.readAsDataURL(e.target.files[0])
            }
        });


        function removeGalleryImage(e) {
            e.parentNode.remove();
        }

        window.onload = () => {
            $(document).ready(function() {
                $('.select-multiple').select2({
                    //   theme:"classic"
                });

                $('.js-example-basic-multiple').select2({
                    'placholder' : "Select"
                });
            });
        }
    </script>
@endsection
