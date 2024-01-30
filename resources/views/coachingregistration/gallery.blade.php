@extends('layouts.header')

@section('content')
    @include('components.pagetitle',['title'=>'Coaching Registration'])
    <div class="enrollnow">
        <div class="enrollnow__c">
            <div class="timeline">
                <div class="stop">
                    <p class="num">1</p>
                    <p class="text">Registration Details</p>
                </div>
                <div class="line" style="background-color: #253f94;"></div>
                <div class="stop" style="background-color: #253f94;">
                    <p class="num">2</p>
                    <p class="text">Gallery</p>
                </div>
                <div class="line"></div>
                <div class="stop">
                    <p class="num">3</p>
                    <p class="text">Confirmation</p>
                </div>
            </div>
            <form action="{{url('addcoachinggallery')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="coaching" value="2">
                <div class="form">
                    <div class="form__h">
                        <h4>Coaching Logo and Thumbnail</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-img">
                                <div class="display" id="displayimg">
                                    <p>Select 512px * 512px Logo Image</p>
                                </div>
                                <label for="logo">Select Logo</label>
                                <input type="file" id="logo" name="logo">
                            </div>
                            <div class="form__c-r-img">
                                <div class="display" id="displaythumbnail">
                                    <p>Select Thumbnail Image</p>
                                </div>
                                <label for="thumbnail">Select Thumbnail</label>
                                <input type="file" id="thumbnail" name="thumbnail">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form__h">
                        <h4>Gallery Images</h4>
                    </div>

                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="gallery" id="gallery">
                                <p>Images you select will appear here.</p>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <label class="form__c-r-label" for="galleryimage">Select Gallery Images</label>
                            <input class="form__c-r-in" type="file" name="gallery[]" id="galleryimage" multiple>
                        </div>
                    </div>

                    <div class="form__c">
                        <div class="btncontainer">
                            <button type="submit" class="btn">Submit</button>
                            <button type="submit" class="btn">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection