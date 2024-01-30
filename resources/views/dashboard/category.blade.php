@extends('dashboard.layouts.dash')

@section('content')
    <div class="city">
        <div class="city__c">
            <div class="city__c-l">
                <h2>Add New Category</h2>
                <form action="{{url('dashboard/createcategory')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="fi">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="categoryname">
                    </div>
                    <div class="fi">
                        <label for="name">Description</label>
                        <textarea type="text" id="name" name="description"></textarea>
                    </div>
                    <div class="fi">
                        <label for="name">Thumbnail</label>
                        <input type="file" id="name" name="thumbnail">
                    </div>
                    <button type="submit" class="btn">Add</button>
                </form>
            </div>
            <div class="city__c-r">
                <div class="rheader">
                    <h2>Categories</h2>
                    <p>Total Categories : {{count($categories)}}</p>
                </div>
                <div class="city__c-r-oac">
                    @foreach ($categories as $category)
                        <div class="oa">
                            <div class="oa-tc">
                                <h3>{{$category->name}}</h3>
                            </div>
                            <div class="oa__controls">
                                <span class="material-icons">edit</span>
                                <a href="{{url('dashboard/deletecategory').'/'.$category->id}}">
                                    <span class="material-icons">delete</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection