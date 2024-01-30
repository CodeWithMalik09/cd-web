<div class="sidebar">
    <div class="sidebar__c">
        <ul class="sciul">
            <li class="sciul__li">
                <a href="{{ url('dashboard') }}">
                    <span class="material-icons">home</span>
                    <p>Home</p>
                </a>
            </li>

                 <li class="sciul__li">
                <a class="sciul__li-click">
                    <span class="material-icons">school</span>
                    <p>Students</p>
                    <span class="material-icons">keyboard_arrow_down</span>
                </a>
                <ul class="sciul__li-ul">
                    <li>
                        <a href="{{ url('dashboard/students') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>Accounts</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('dashboard/latest_loggedin_students') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>Just Logged In</p>
                        </a>
                    </li>
                  </ul>
                  </li>

            <li class="sciul__li">
                <a class="sciul__li-click">
                    <span class="material-icons">school</span>
                    <p>Coachings</p>
                    <span class="material-icons">keyboard_arrow_down</span>
                </a>
                <ul class="sciul__li-ul">
                    <li>
                        <a href="{{ url('dashboard/coachings') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>All</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('dashboard/createcoaching') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>Add New</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('dashboard/unapproved-coachings') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>Unapproved</p>
                        </a>
                    </li>
                      <li>
                        <a href="{{ url('dashboard/applied') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>Applied</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('dashboard/seokeywords') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>SEO</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('dashboard/new-fee-structure') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>Create Fee Structure</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('dashboard/new-result-achivement') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>Add Achivements</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sciul__li">
                <a class="sciul__li-click">
                    <span class="material-icons">person</span>
                    <p>Tutors</p>
                    <span class="material-icons">keyboard_arrow_down</span>
                </a>
                <ul class="sciul__li-ul">
                    <li>
                        <a href="{{ url('dashboard/tutors') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>All</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('dashboard/createtutor') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>Add New</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="sciul__li">
                <a class="sciul__li-click">
                    <span class="material-icons">person</span>
                    <p>Libraries</p>
                    <span class="material-icons">keyboard_arrow_down</span>
                </a>
                <ul class="sciul__li-ul">
                    <li>
                        <a href="{{ url('dashboard/libraries') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>All</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('dashboard/createlibrary') }}">
                            <span class="material-icons">keyboard_arrow_right</span>
                            <p>Add New</p>
                        </a>
                    </li>
                </ul>
            </li>

            @if (in_array(auth()->user()->phone, ['6200552573', '7970707321','8757033525','8217489441','8686934803','8851595704']) || auth()->user()->role === 'admin')
                <li class="sciul__li">
                    <a class=" sciul__li-click">
                        <span class="material-icons">menu_book</span>
                        <p>Blogs</p>
                        <span class="material-icons">keyboard_arrow_down</span>
                    </a>
                    <ul class="sciul__li-ul">
                        <li>
                            <a href="{{ url('dashboard/blogs') }}">
                                <span class="material-icons">keyboard_arrow_right</span>
                                <p>All Blogs</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('dashboard/createblog') }}">
                                <span class="material-icons">keyboard_arrow_right</span>
                                <p>New Blog</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('dashboard/blog-media') }}">
                                <span class="material-icons">keyboard_arrow_right</span>
                                <p>Media</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->user()->role === 'admin')
                <li class="sciul__li">
                    <a href="{{ url('dashboard/siteusers') }}">
                        <span class="material-icons">people</span>
                        <p>Users</p>
                    </a>
                </li>

                <li class="sciul__li">
                    <a href="{{ url('dashboard/courses') }}">
                        <span class="material-icons">list</span>
                        <p>Courses</p>
                    </a>
                </li>
                <li class="sciul__li">
                    <a href="{{ url('dashboard/categories') }}">
                        <span class="material-icons">category</span>
                        <p>Category</p>
                    </a>
                </li>
                <li class="sciul__li">
                    <a href="{{ url('dashboard/cities') }}">
                        <span class="material-icons">business</span>
                        <p>Cities</p>
                    </a>
                </li>
                <li class="sciul__li">
                    <a href="{{ url('dashboard/posts') }}">
                        <span class="material-icons">pages</span>
                        <p>Posts</p>
                    </a>
                </li>
                <li class="sciul__li">
                    <a href="{{ url('dashboard/enrollments') }}">
                        <span class="material-icons">description</span>
                        <p>Enrollments</p>
                    </a>
                </li>
            @endif

              @if(auth()->user()->email === 'surabhi@taquino.in' || auth()->user()->email === 'zaid.taquino@gmail.com' || auth()->user()->email === 'asmitasinha1123@gmail.com')
            <li class="sciul__li">
                    <a href="{{ url('dashboard/enrollments') }}">
                        <span class="material-icons">description</span>
                        <p>Enrollments</p>
                    </a>
                </li>
            @endif             


            @if (auth()->user()->role != 'operator')
                <li class="sciul__li">
                    <a class="sciul__li-click">
                        <span class="material-icons">group</span>
                        <p>CMS Users</p>
                        <span class="material-icons">keyboard_arrow_down</span>
                    </a>
                    <ul class="sciul__li-ul">
                        <li>
                            <a href="{{ url('dashboard/cms-users') }}">
                                <span class="material-icons">keyboard_arrow_right</span>
                                <p>All</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('dashboard/new-cms-user') }}">
                                <span class="material-icons">keyboard_arrow_right</span>
                                <p>Add New User</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="sciul__li">
                <a href="{{ url('dashboard/localities') }}">
                    <span class="material-icons">apartment</span>
                    <p>Localities</p>
                </a>
            </li>
        </ul>
    </div>
</div>
<script>
    $('.sciul__li-click').each((i, ele) => {
        ele.onclick = () => {
            if (ele.nextElementSibling.style.display === "none" || ele.nextElementSibling.style.display ===
                "") {
                ele.nextElementSibling.style.display = "block"
            } else {
                ele.nextElementSibling.style.display = "none";
            }
        }
    });
</script>
