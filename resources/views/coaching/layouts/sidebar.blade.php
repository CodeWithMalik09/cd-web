<div class="sidebar">
    <div class="sidebar__c">
        <ul class="sciul">
            <li class="sciul__li">
                <a href="{{url('coachingcms/home')}}">
                    <span class="material-icons">home</span>
                    <p>Home</p>
                </a>
            </li>
            <li class="sciul__li">
                <a class="sciul__li-click">
                    <span class="material-icons">people</span>
                    <p>Faculties</p>
                    <span class="material-icons">keyboard_arrow_down</span>
                </a>
                <ul class="sciul__li-ul">
                    <li>
                        <a href="{{url('coachingcms/faculties')}}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>All</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('coachingcms/createfaculty')}}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>Add New</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sciul__li">
                <a class="sciul__li-click">
                    <span class="material-icons">payments</span>
                    <p>Fees</p>
                    <span class="material-icons">keyboard_arrow_down</span>
                </a>
                <ul class="sciul__li-ul">
                    <li>
                        <a href="{{url('coachingcms/fees')}}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>All</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('coachingcms/createfeestructure')}}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>Add New</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sciul__li">
                <a class="sciul__li-click">
                    <span class="material-icons">military_tech</span>
                    <p>Results</p>
                    <span class="material-icons">keyboard_arrow_down</span>
                </a>
                <ul class="sciul__li-ul">
                    <li>
                        <a href="{{url('coachingcms/results')}}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>All</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('coachingcms/createresults')}}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>Add New</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sciul__li">
                <a href="{{url('coachingcms/gallery')}}">
                    <span class="material-icons">collections</span>
                    <p>Gallery</p>
                </a>
            </li>
            <li class="sciul__li">
                <a href="#">
                    <span class="material-icons">people</span>
                    <p>Enrollment</p>
                </a>
            </li>
            {{-- <li class="sciul__li">
                <a class=" sciul__li-click">
                    <span class="material-icons">menu_book</span>
                    <p>Blogs</p>
                    <span class="material-icons">keyboard_arrow_down</span>
                </a>
                <ul class="sciul__li-ul">
                    <li>
                        <a href="{{url('dashboard/blogs')}}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>All Blogs</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('dashboard/createblog')}}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>New Blog</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sciul__li">
                <a href="{{url('dashboard/courses')}}">
                    <span class="material-icons">list</span>
                    <p>Courses</p>
                </a>
            </li>
            <li class="sciul__li">
                <a href="{{url('dashboard/categories')}}">
                    <span class="material-icons">category</span>
                    <p>Category</p>
                </a>
            </li>
            <li class="sciul__li">
                <a href="{{url('dashboard/cities')}}">
                    <span class="material-icons">business</span>
                    <p>Cities</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
<script>
    $('.sciul__li-click').each((i,ele) => {
        ele.onclick = ()=>{
            if(ele.nextElementSibling.style.display === "none" || ele.nextElementSibling.style.display === ""){
                ele.nextElementSibling.style.display = "block"
            }else{
                ele.nextElementSibling.style.display = "none";
            }
        }
    });
</script>