@extends('dashboard.layouts.dash')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="crcoaching">
        <div class="crcoaching__c">
            <form action="{{ url('dashboard/updatelibrary') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $library->id }}">
                <div class="crcoaching__c-l">
                    <div class="form">
                        <h5>Edit Library</h5>
                        <div class="fr">
                            <div class="fi">
                                <label for="libraryname">Name *</label>
                                <input type="text" name="name" value="{{ $library->name }}" id="libraryname"
                                    required>
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="city">City *</label>
                                <select name="cities" id="cities" required>
                                    @foreach ($cities as $city)
                                        @if ($library->cities != null && $city->id == $library->cities ?? []))
                                            <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                        @else
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="fi">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="{{ $library->email }}" id="email">
                            </div>   
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" maxlength="24" name="phone" value="{{ $library->phone }}"
                                    id="phone" required>
                            </div>
                            <div class="fi">
                                <label for="altphone">Alternate Phone Number</label>
                                <input type="tel" maxlength="24" name="alternate_phone"
                                    value="{{ $library->alternate_phone }}" id="altphone">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="landmark">Landmark </label>
                                <input type="text" name="landmark" value="{{ $library->landmark }}" id="landmark">
                            </div>
                            <div class="fi">
                                <label for="address">Address * </label>
                                <input type="text" name="address" value="{{ $library->address }}" id="address" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="district">District *</label>
                                <input type="text" name="district" value="{{ $library->district }}" id="district" required>
                            </div>
                            <div class="fi">
                                <label for="state">State *</label>
                                <input type="text" name="state" value="{{ $library->state }}" id="state"
                                    required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="country">Country *</label>
                                <input type="text" name="country" value="{{ $library->country }}" id="country"
                                    required>
                            </div>
                            <div class="fi">
                                <label for="pincode">Pincode *</label>
                                <input type="number" max="999999" maxlength="6" name="pincode"
                                    value="{{ $library->pincode }}" id="pincode" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="latitude">Latitude</label>
                                <input type="text" name="latitude" value="{{ $library->latitude }}" id="latitude">
                            </div>
                            <div class="fi">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" value="{{ $library->longitude }}"
                                    id="longitude">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="website">Website</label>
                                <input type="url" name="website" value="{{ $library->website }}" id="website">
                            </div>
                            <div class="fi">
                                <label for="facebook">Facebook Link</label>
                                <input type="url" name="facebook_link" value="{{ $library->facebook_link }}"
                                    id="facebook">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="youtube">Youtube Link</label>
                                <input type="url" name="youtube_link" value="{{ $library->youtube_link }}"
                                    id="youtube">
                            </div>
                            <div class="fi">
                                <label for="twitter">Twitter Link</label>
                                <input type="url" name="twitter_link" value="{{ $library->twitter_link }}"
                                    id="twitter">
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="head">Head Organisation</label>
                                <input type="text" name="head_organisation"
                                    value="{{ $library->head_organisation }}" id="head">
                            </div>

                            <div class="fi">
                                <label for="establishment">Establishment</label>
                                <input type="text" name="establishment" value="{{ $library->establishment }}"
                                    id="establishment">
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="area">Total Area</label>
                                <input type="number" name="total_area" value="{{ $library->total_area }}"
                                    id="area">
                            </div>

                            <div class="fi">
                                <label for="cities">Fee Structure</label>
                                <select name="fee_structure" id="fee_structure">
                                    <option value="monthly" {{$library->fee_structure == 'monthly' ? 'selected' : ''}}>Monthly</option>
                                    <option value="weekly" {{$library->fee_structure == 'weekly' ? 'selected' : ''}}>Weekly</option>
                                </select>
                            </div>

                        </div>
                        
                        <div class="fr">
                            <div class="fi">
                                <label for="payment">Available Modes Of Payment</label>
                                <select class="js-example-basic-multiple" name="modes_of_payment[]" id="payment" style="width: 100%" data-placeholder="Choose Payment Mode.."  multiple>
                                    <option value="0">All</option>
                                    <option value="Debit and Credit card" {{ in_array('Debit and Credit card',explode(',',$library->modes_of_payment)) ? 'selected' : ''}} >Debit and Credit card</option>
                                    <option value="UPI" {{ in_array('UPI',explode(',',$library->modes_of_payment)) ? 'selected' : '' }}>UPI(GPay,Paytm,PhonePe)</option>
                                    <option value="Cash" {{ in_array('Cash',explode(',',$library->modes_of_payment))  ? 'selected' : ''  }}>Cash</option>
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="ac">AC Available</label>
                                <select name="ac_available" id="ac" required>
                                    @if ($library->ac_available)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>

                            <div class="fi">
                                <label for="cctv">CCTV with recording</label>
                                <select name="cctv_with_recording" id="cctv" required>
                                    @if ($library->cctv_with_recording)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>   
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="tandc">Term & Condition * </label>
                                <textarea name="tandc" id="tandc" cols="30" rows="6">{{ $library->tandc }}</textarea>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="about">About * </label>
                                <textarea name="about" id="about" cols="30" rows="6">{{ $library->about }}</textarea>
                            </div>
                        </div>

                          @include('dashboard.library.fee', ['fees' => $library->lib_fee_structures])
                        @include('dashboard.library.facility', ['facilities' => $library->lib_facility_structures])                        

                    </div>
                </div>
                <div class="crcoaching__c-r">
                    <div class="btn__c">
                        <button type="submit" class="btn__c-btn">Update Library</button>
                    </div>

                    <h2>Images</h2>
                    <div class="di">
                        @if ($library->thumbnail)
                            <img src="{{ url('storage') . '/' . $library->thumbnail }}" id="thumbnail-view">
                        @else
                            <img src="{{ asset('assets/img_placeholder.png') }}"
                                style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                        @endif
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail">
                    <label for="thumbnail">Select Thumbnail</label>
                    <div class="lic">
                        @if ($library->logo)
                            <img src="{{ url('storage') . '/' . $library->logo }}" id="thumbnail-view">
                        @else
                            <img src="{{ asset('assets/img_placeholder.png') }}"
                                style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                        @endif
                    </div>
                    <input type="file" name="logo" id="logo">
                    <label for="logo">Logo</label>
                    <div class="gc">
                        @if ($library->galleries->count() > 0)
                            @foreach ($library->galleries as $img)
                                <div class="img__c">
                                    <a href="{{ url("dashboard/delete-library-gallery-image/$img->id") }}">
                                        <div class="remove">
                                            <span>X</span>
                                        </div>
                                    </a>
                                    <img src="{{ url('storage') . '/' . $img->image }}" alt="">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <input type="file" name="gallery[]" multiple id="gallery">
                    <label for="gallery">Add Gallery</label>
                    <div class="vc">
                        @if ($library->video)
                            <video controls><source src="{{ url('storage') . '/' . $library->video }}" / type="video/mp4"></video>
                        @endif  
                    </div>   
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
            width:100% !important;
            border:0px !important;
            resize:inherit !important;
            padding: 0px !important;
        }

        .select2-container--focus {
            border: unset !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid rgba(255, 102, 0, 0.3) !important;
            outline: 0;
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
                    // $('.gc').append(`<img src="${re.target.result}"/>`);
                    $('.gc').append(
                        `
                        <div class="img__c">
                            <a onclick="removeGalleryImage(this)">
                                <div class="remove">
                                    <span>X</span>
                                </div>
                            </a>
                            <img src="${re.target.result}" alt="">
                        </div>
                        `
                    )
                }
                reader.readAsDataURL(element)

            });
        });

        $('#video').change((e) => {
            let fileSize = 0;
            fileSize = e.target.files[0].size / (1024*1024);
            if(fileSize > 25)
            {
                alert(fileSize);
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
                    $('.vc').empty()
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
                $('.select-multiple').select2({});
            });

            $('.js-example-basic-multiple').select2({
                'placholder' : "Select"
            });

        }
    </script>
@endsection
