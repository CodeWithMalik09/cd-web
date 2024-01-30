<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Coaching;
use App\Models\Library;
use App\Models\Course;
use App\Models\VisitorDetail;
use App\Models\TutorCourse;
use App\Models\FacultyStaff;
use App\Models\FeeStructure;
use App\Models\OperationArea;
use App\Models\ResultAndAchivement;
use App\Models\Tutor;
use App\Models\Wishlist;
use App\Models\Locality;
use App\Models\SeoKeyword;
use App\Models\CoachingWorkingHours;
use App\traits\TrackCoachingStatistics;
use App\traits\TrackLibraryStatistics;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\LibFeeStructure;
use App\Models\LibFacilityStructure;

class FrontEndController extends Controller
{

    use TrackCoachingStatistics;
    use TrackLibraryStatistics;

    public function home()
    {
        $courses = Course::orderBy('name', 'asc')->get();
        $regcourses = Course::select('id','name','slug')->orderBy('name', 'asc')->get();
        $tutorCourses = TutorCourse::get();
        // echo "--ujjwal--<pre>"; print_r($tutorCourses); //print_r($courses);
        // $label_wise_courses = (object)['Engineering' => [], 'Medical' => [], 'MBA' => [], 'Law' => [], 'Design' => [], 'Others' => []];

        $cities = OperationArea::orderBy('name', 'asc')->get();
        $coachings = Coaching::orderBy('id', 'DESC')->limit(6)->get();

        foreach ($courses as $course) {

            // if (in_array($course->name, ['Jee'])) {
            //     array_push($label_wise_courses->Engineering, $course);
            // } else if (in_array($course->name, ['NEET', 'NEET(PG)', 'NEET(UG)', 'Biology (NEET)'])) {
            //     array_push($label_wise_courses->Medical, $course);
            // } else if (in_array($course->name, ['CAT(MBA)'])) {
            //     array_push($label_wise_courses->MBA, $course);
            // } else {
            //     array_push($label_wise_courses->Others, $course);
            // }


            $coaching = Coaching::where('main_course_id',  $course->id)->where('status','approved')->limit(6)->orderBy('id', 'desc')->get();
            $course->{'coachings'} = $coaching;
        }

        $data = [
            // 'label_courses' => $label_wise_courses,
            'cities' => $cities,
            'coachings' => $coachings,
            'courses' => $courses,
            'regcourses' => $regcourses,
            'tutorCourses'=>$tutorCourses
        ];

        if (session('recently_viewed')) {
            $recents = Coaching::whereIn('id', array_reverse(session('recently_viewed')))->limit(6)->get();
            $data['recents'] = $recents;
        }

        return view('home', $data);
    }


    public function blog()
    {
      $courses=Course::all();
        $blogs = Blog::where('category', 'blog')->orderBy('id', 'desc')->paginate(9);
        return view('blog', ['blogs' => $blogs, 'type' => 'Blog','courses'=>$courses]);
    }

   public function BlogSearch(Request $request)
    {
        $course = '';
        $last_visible_date = date('Y-m-d', strtotime(date('Y-m-d'). ' - 4 days'));
        if ($request->has('course')) {
            $course = $request->course;
            Session::put('job-search-course', $request->course);
        } else if (!$request->has('course') && session('job-search-course') !== null) {
            $course = session('job-search-course');
        }

        $blogs = Blog::where('category', 'blog')->where(function($query) use ($last_visible_date) 
        {
            $query->where('job_last_date','>',$last_visible_date)->orWhere('job_last_date','=',NULL);
        });

        if ($course != '') {
            $blogs->where('course', 'LIKE', "%" . str_replace('/', '-', $course) . "%");
        }


        $blogs = $blogs->orderBy('id', 'desc')
            ->paginate(9);
        return view('blog', ['blogs' => $blogs, 'type' => 'Blog', 'search' => $course]);
    }

    public function blogview($id)
    {
        Blog::where('slug', $id)->increment('views');
        $blog = Blog::where('slug', $id)->get()->first();
        $related_blogs = Blog::where('category', 'blog')->where('id', '<>', $blog->id)->where('course', $blog->course)->limit(10)->get();
        return view('blogview', ['blog' => $blog, 'relatedblogs' => $related_blogs, 'type' => 'Blog Post']);
    }

    public function coaching($slug)
    {
        $coaching = Coaching::where('slug', $slug)->get()->first();
        $feedisc = FeeStructure::where('coaching_id', $coaching->id)->first();
          $coachingList = Coaching::where('courses', $coaching['courses'])
        ->where('cities', $coaching['cities'])
        ->where('main_course_id', $coaching['main_course_id'])
        ->where('id', '<>', $coaching->id)
        ->where('categories', $coaching['categories'])
        ->limit(4)
        ->get();
         $othercourses = Coaching::where('name', $coaching->name)
         ->where('id', '<>', $coaching->id)
         ->where('cities', $coaching->cities)
    
    ->get();

        if ($coaching == null) {
            return redirect('/');
        }

        $this->coachingView($coaching->id);

        if (auth()->user()) {
            $wishlist =  Wishlist::where(
                [
                    ['user_id', '=', auth()->user()->id],
                    ['wish_id', '=', $coaching->id]
                ]
            )->count();

            if ($wishlist >= 1) {
                $coaching->{'wishlisted'} = true;
            } else {
                $coaching->{'wishlisted'} = false;
            }
        } else {
            $coaching->{'wishlisted'} = false;
        }

//for visitor details
if(session('user')){
        if (auth()->user()) {
            VisitorDetail::create([
                'coaching_visited' => $coaching->name,
                'coaching_course' =>$coaching->mainCourse->name,
                'phone' => auth()->user()->phone,
                'name' => auth()->user()->name,
            ]);
        } 
    }


        //RECENT VIEWED
        if (session('recently_viewed')) {
            $arr = session('recently_viewed');
            if (!in_array($coaching->id, $arr)) {
                array_push($arr, $coaching->id);
                Session::put("recently_viewed", $arr);
            };
        } else {
            Session::put("recently_viewed", array($coaching->id));
        }

        // $coursesList = Course::select(['name'])->whereIn('id', json_decode($coaching->courses) ?? [])->get();
        $categoriesList = Category::select(['name'])->whereIn('id', json_decode($coaching->categories) ?? [])->get();
        // $courses = "";
        $categories = "";
        // $isfirst = true;
        // foreach ($coursesList as $course) {
        //     if ($isfirst) {
        //         $courses .= $course->name;
        //     } else {
        //         $courses .= ',' . $course->name;
        //     }
        //     $isfirst = false;
        // }
        $isfirst = true;
        foreach ($categoriesList as $category) {
            if ($isfirst) {
                $categories .= $category->name;
            } else {
                $categories .= ', ' . $category->name;
            }
            $isfirst = false;
        }

        $cities = OperationArea::all();
        $allcategories = Category::all();
        $allcourses = Course::all();
        $localities=Locality::all();
        $newworkinghours=CoachingWorkingHours::all();


    //for visitor details
    


    



        return view('coaching', [
            'coaching' => $coaching,
            // 'courses' => $courses,
            'allcourses' => $allcourses,
            'allcategories' => $allcategories,
            'categories' => $categories,
            'localities' => $localities,
            'newworkinghours' => $newworkinghours,
            'coachingList' => $coachingList,
            'othercourses' => $othercourses,
            'feedisc'     => $feedisc,
            'cities' => $cities
        ]);



    }

    public function feestructure($id)
    {
        $id = Coaching::where('slug', $id)->first()->id;
        $fee_structures  = FeeStructure::where('coaching_id', $id)->get();
        $coaching = Coaching::find($id);
        return view('feestructure', ['fee_structures' => $fee_structures, 'coaching' => $coaching]);
    }

    public function libraryfeestructure($slug){

        $id = Library::where('slug', $slug)->first()->id;
        $lib_fee_structures  = LibFeeStructure::where('library_id', $id)->get();
        $library = Library::find($id);
        return view('lib_fee_structure', ['lib_fee_structures' => $lib_fee_structures, 'library' => $library]);

    }
    public function libraryfacilitystructure($slug){


        $id = Library::where('slug', $slug)->first()->id;
        $lib_facility_structures  = LibFacilityStructure::where('library_id', $id)->get();
        $library = Library::find($id);
        return view('lib_facility_structure', ['lib_facility_structures' => $lib_facility_structures, 'library' => $library]);
    }

    public function faculties($id)
    {
        $id = Coaching::where('slug', $id)->first()->id;
        $faculties =  FacultyStaff::where('coaching_id', $id)->get();
        $coaching = Coaching::find($id);
        return view('faculties', ['faculties' => $faculties, 'coaching' => $coaching]);
    }

    public function results($type, $id)
    {
        $id = Coaching::where('slug', $id)->first()->id;
        $results =  ResultAndAchivement::where('coaching_id', $id)->where('data_type', $type)->get();
        $coaching = Coaching::find($id);
        return view('results', ['type' => $type, 'results' => $results, 'coaching' => $coaching]);
    }

    public function homeonlinesearch($type, $course)
    {
        $type_id = Category::where('slug', $type)->get()->first()->id;
        $course = Course::where('slug', 'like', "%" . $course . "%")->first();        $coachings = array();
        $dbcoachings = Coaching::where('logo', '!=', null)->where('cities', '!=', null)->where('categories', '!=', null)->where('main_course_id', $course->id)->orderBy('id', 'desc')->get();
        $dbcoachings = Coaching::where('logo', '!=', null)->where('categories', 'LIKE', '%\"' . $type_id . '\"%')->where('main_course_id', $course->id)->where('cities', '!=', null)->orderBy('id', 'desc')->paginate(25);
        $courses = Course::all();
        $cities = OperationArea::all();
        $localities=Locality::all();
        return view('coachinglist', ['coachings' => $dbcoachings, 'courses' => $courses, 'cities' => $cities, 'coursename' => ucwords($course->name), "courseslug" => $course->slug, 'typename' => $type,'localities' => $localities]);
    }

    public function homesearch($type, $course, $city)
    {
        $city = OperationArea::select(['id', 'name'])->where('name', 'like', "%" . $city . "%")->first();
        $course_type = Category::where('slug', $type)->first();
        $course = Course::where('slug', 'like', "%" . $course . "%")->first();
        $pccs = Coaching::where('main_course_id', $course->id)
        ->select('cities')
        ->distinct()
        ->get();
        $SeoKeywords = SeoKeyword::all();

        if (!$city || !$course_type || !$course) {
            return view('coachinglist', ['coachings' => [], 'courses' => [], 'cities' => [], 'cityname' => '', 'coursename' => '', 'courseslug' => $course->slug, 'typename' => ucwords($type),'localities' => $localities]);
        }

        $coachings = array();
        // $dbcoachings = Coaching::where([['cities','LIKE','%'.$city->id.'%'],['categories','LIKE','%'.$course_type->id.'%'],['main_course_id',$course->id]])->orderBy('id','desc')->get();
        $dbcoachings = Coaching::where('logo', '!=', null)->where('main_course_id', $course->id)->where('cities', 'LIKE', '%\"' . $city->id . '\"%')->where('categories', 'LIKE', '%\"' . $course_type->id . '\"%')->orderBy('id', 'desc')->paginate(25);
        // foreach ($dbcoachings as $coaching) {
        //     if (in_array($city->id, json_decode($coaching->cities) ?? []) && in_array($course_type->id, json_decode($coaching->categories) ?? []) && ($course->id ==  $coaching->main_course_id)) {
        //         // array_push($coachings, $coaching);
        //         array_push($coachings, $coaching->id);
        //     }
        // }

        // $dbcoachings = $dbcoachings->filter(function ($val, $key) use ($coachings) {
        //     return !in_array($val->id, $coachings);
        // });


        $courses = Course::all();
        $cities = OperationArea::all();
         $localities=Locality::all();
         $citylocals = Locality::where('city', $city->id)->get();
        return view('coachinglist', ['coachings' => $dbcoachings, 'courses' => $courses, 'cities' => $cities, 'cityname' => ucwords($city->name), 'coursename' => ucwords($course->name), 'courseslug' => $course->slug, 'typename' => ucwords($type),'localities' => $localities,'SeoKeywords'=>$SeoKeywords,'city_id'=>$city->id,'course_id'=>$course->id,'pccs'=>$pccs,'course_slug'=>$course->slug,'citylocals'=>$citylocals]);
    }

    public function cityhomesearch($city){
        $city = OperationArea::select(['id', 'name'])->where('name', 'like', "%" . $city . "%")->first();
        $coachings = Coaching::where('cities', 'LIKE', '%\"' . $city->id . '\"%')->orderBy('id', 'desc')->paginate(25);
        // echo "<pre>"; 
        foreach ($coachings as $key => $coaching) {
            if (auth()->user()) {
                $wishlist =  Wishlist::where(
                    [
                        ['user_id', '=', auth()->user()->id],
                        ['wish_id', '=', $coaching->id]
                    ]
                )->count();
                if ($wishlist >= 1) {
                    $coaching->{'wishlisted'} = true;
                } else {
                    $coaching->{'wishlisted'} = false;
                }
            } else {
                $coaching->{'wishlisted'} = false;
            }
        }
        return view('coachinglist', ['coachings' => $coachings, 'courses' => Course::all(), 'cities' => OperationArea::all(),'localities'=>Locality::all()]);
    }

    public function search($search)
    {
        $course = Course::where('name', $search)->get();
        $category = Category::where('name', $search)->get();

        $courses = Course::all();
        $cities = OperationArea::all();

        $coachingArr = array();

        if ($search == "recent") {
            $recents = Coaching::whereIn('id', array_reverse(session('recently_viewed')))->limit(6)->get();
            foreach ($recents as $coaching) {
                if (session('user')) {
                    $check_wishlist = Wishlist::where([['type', '=', 'coaching'], ['user_id', '=', session('user')->id], ['wish_id', '=', $coaching->id]])->get();
                    if ($check_wishlist->count() == 1) {
                        $coaching->{'in_wishlist'} = true;
                    }
                }
                array_push($coachingArr, $coaching);
            }
              $localities=Locality::all();

            return view('coachinglist', ['coachings' => $coachingArr, 'courses' => $courses, 'cities' => $cities, 'courseslug' => '', 'coursename' => $search, 'actionType' => 'search','localities' => $localities]);
        }

        $coachings = Coaching::where('logo', '!=', null)->get();
        if ($category->count() > 0) {
            foreach ($coachings as $coaching) {
                if (in_array($category[0]->id, json_decode($coaching->categories))) {
                    if (session('user')) {
                        $check_wishlist = Wishlist::where([['type', '=', 'coaching'], ['user_id', '=', session('user')->id], ['wish_id', '=', $coaching->id]])->get();
                        if ($check_wishlist->count() == 1) {
                            $coaching->{'in_wishlist'} = true;
                        }
                    }
                    array_push($coachingArr, $coaching);
                }
            }
        } else if ($course->count() > 0) {
            foreach ($coachings as $coaching) {
                if (in_array($course[0]->id, json_decode($coaching->courses))) {
                    if (session('user')) {
                        $check_wishlist = Wishlist::where([['type', '=', 'coaching'], ['user_id', '=', session('user')->id], ['wish_id', '=', $coaching->id]])->get();
                        if ($check_wishlist->count() == 1) {
                            $coaching->{'in_wishlist'} = true;
                        }
                    }
                    array_push($coachingArr, $coaching);
                }
            }
        }

       $localities=Locality::all();

        return view('coachinglist', ['coachings' => $coachingArr, 'courses' => $courses, 'cities' => $cities, 'courseslug' => $course->first()->slug, 'coursename' => $search, 'actionType' => 'search','localities' => $localities]);
    }


    public function compare($coachings)
    {
        $coachingArr = explode('-', $coachings);
        $coachings = Coaching::whereIn('id', $coachingArr)->get();
        foreach ($coachings as $coaching) {
            $categoriesList = Category::select(['name'])->whereIn('id', json_decode($coaching->categories))->get();
            $categories = "";
            $isfirst = true;
            foreach ($categoriesList as $category) {
                if ($isfirst) {
                    $categories .= $category->name;
                } else {
                    $categories .= ',' . $category->name;
                }
                $isfirst = false;
            }
            $coaching->{'course_types'} = $categories;
        }
        return view('compare', ['coachings' => $coachings]);
    }

    public function comparetutor($tutors)
    {
        $tutorArr = explode('-', $tutors);
        $arr = array();
        foreach ($tutorArr as $item) {
            array_push($arr, Crypt::decryptString($item));
        }
        $tutors = Tutor::whereIn('id', $arr)->get();
        return view('comparetutor', ['tutors' => $tutors]);
    }

    public function mapSearch($type, $course, $city)
    {
        $category_id = Category::where('name', $type)->get()->first()->id;
        $course_id = Course::where('slug', $course)->get()->first()->id;
        $city_id = OperationArea::where('name', $city)->get()->first()->id;
        $coachings = Coaching::where([['logo', '<>', null], ['categories', 'like', "%\"" . $category_id . "\"%"], ['main_course_id',  $course_id], ['cities', 'like', "%\"" . $city_id . "\"%"], ['latitude', '<>', 'NULL']])->get();
        // dd($coachings->count());
        foreach ($coachings as $coaching) {
            $course_names = $coaching->mainCourse->name;
            $coaching->{'course_names'} = $course_names;
        }
        return view('mapsearch', ['coachings' => $coachings]);
    }

    public function mapview($id)
    {
        $id =  Crypt::decrypt($id);
        $coaching = Coaching::find($id);
        return view('mapview', ['coaching' => $coaching]);
    }

    public function tutorslist($course, $city)
    {
        $courses = TutorCourse::all();
        $cities = OperationArea::all();
        $city_id = OperationArea::where('name', 'like', "%" . $city . "%")->get()->first()->id;
        $course_id = TutorCourse::where('slug', $course)->get()->first()->id;
        $tutors = Tutor::where([['course', 'like', "%\"" . $course_id . "\"%"], ['city', '=', $city_id]])->get();
        foreach ($courses as $courselist) {
            $courseList[$courselist->id] = $courselist->name;
        }

        return view('tutorlist', ['tutors' => $tutors, 'courses' => $courses, 'cities' => $cities, 'cityname' => ucwords($city), 'coursename' => ucwords($course), 'tutorcourselist' => $courseList]);
    }

        public function librarylist($city)
    {
        $city = OperationArea::select(['id','name'])->where('name', 'like', "%" . $city . "%")->get()->first();
        $libraries = array();
        $dblibraries = Library::where('logo', '!=', null)->where('cities', '!=', null)->where('cities','=',$city->id)->orderBy('id', 'desc')->paginate(25);
        $cities = OperationArea::all();
        return view('librarylist', ['libraries' => $dblibraries, 'cities' => $cities,'cityname' => ucwords($city->name),'typename' => 'Library']);
    }

    public function tutor($slug)
    {
        $tutor = Tutor::where('slug', $slug)->get()->first();
        if ($tutor == null) {
            return redirect('/');
        }

        if (auth()->user()) {
            $wishlist =  Wishlist::where(
                [
                    ['user_id', '=', auth()->user()->id],
                    ['wish_id', '=', $tutor->id]
                ]
            )->count();

            if ($wishlist >= 1) {
                $tutor->{'wishlisted'} = true;
            } else {
                $tutor->{'wishlisted'} = false;
            }
        } else {
            $tutor->{'wishlisted'} = false;
        }

        //RECENT VIEWED
        if (session('recently_viewed')) {
            $arr = session('recently_viewed');
            if (!in_array($tutor->id, $arr)) {
                array_push($arr, $tutor->id);
                Session::put("recently_viewed", $arr);
            };
        } else {
            Session::put("recently_viewed", array($tutor->id));
        }

        $cities = OperationArea::all();

        return view('tutor', [
            'tutor' => $tutor,
            'cities' => $cities
        ]);
    }

    public function library($slug)
    {
        $library = Library::where('slug', $slug)->get()->first();
        if ($library == null) {
            return redirect('/');
        }

        $this->libraryView($library->id);

        if (auth()->user()) {
            $wishlist =  Wishlist::where(
                [
                    ['user_id', '=', auth()->user()->id],
                    ['wish_id', '=', $library->id]
                ]
            )->count();

            if ($wishlist >= 1) {
                $library->{'wishlisted'} = true;
            } else {
                $library->{'wishlisted'} = false;
            }
        } else {
            $library->{'wishlisted'} = false;
        }

        //RECENT VIEWED
        if (session('recently_viewed')) {
            $arr = session('recently_viewed');
            if (!in_array($library->id, $arr)) {
                array_push($arr, $library->id);
                Session::put("recently_viewed", $arr);
            };
        } else {
            Session::put("recently_viewed", array($library->id));
        }

        $cities = OperationArea::all();

        return view('library', [
            'library' => $library,
            'cities' => $cities
        ]);
    }
    
    public function mapLibrarySearch($city)
    {
        $city_id = OperationArea::where('name', $city)->get()->first()->id;
        $libraries = Library::where([['logo', '<>', null], ['cities', $city_id], ['latitude', '<>', NULL]])->get();
        return view('maplibrarysearch', ['libraries' => (object)$libraries]);
    }

    public function mapLibraryview($id)
    {
        $id =  Crypt::decrypt($id);
        $library = Library::find($id);
        return view('maplibraryview', ['library' => $library]);
    }

    public function contactUs()
    {
        return view('static.contact');
    }

    public function aboutUs()
    {
        return view('static.about');
    }

    public function disclaimer()
    {
        return view('static.disclaimer');
    }

    public function privacyPolicy()
    {
        return view('static.privacyPolicy');
    }
     public function getCoachingData(Request $request){
        $city=$request->city;
        $operation_area = OperationArea::where('name', 'like', '%' . $city . '%')->first();
        $coachingData = Coaching::select('id','name')->where('cities', 'like', '%' . "\"" . $operation_area->id . "\"" . '%')->get();
       //id,name select in cd
     return response()->json($coachingData);
 
    }
}
