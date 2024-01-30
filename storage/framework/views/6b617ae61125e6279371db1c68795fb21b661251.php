<?php if(isset($SeoKeywords) && isset($city_id) && isset($course_id)): ?>

<?php $__currentLoopData = $SeoKeywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if($keyword->course == $course_id && $keyword->city == $city_id): ?>
<?php
    $ktitlez=$keyword->title;
    $meta=$keyword->meta;
    $ogtitle=$keyword->ogtitle;
    $ogtype=$keyword->ogtype;
    $ogurl=$keyword->ogurl;
    $ogdesc=$keyword->ogdesc;
    $canonicals=$keyword->canonical;
?>

<?php break; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php $__env->startSection('content'); ?>
<head>
<style>
lhover:hover{
color:#253f94;
}
.button-container {
            display: flex;
            justify-content: space-around;

        }

        .button {
            padding: 10px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
            cursor: pointer;
            border-radius: 5px;
           font-family:nunito;
        }

        .button-primary {
            background-color: #253f94;
            color: #fff;
        }

        .button-secondary {
            background-color: rgba(255,102,0,0.8);
            color: #fff;
        }
.pop:hover{
         color:blue;
        }

/*mapsearch*/
#msearchresponsive{
            display:none;
        }
        @media(max-width:700px){
            #msearch{
                display:none;
            }
            #msearchresponsive{
                display:block;
                width: 100%;
            }
        }
     #keyhover:hover{
         color:blue;
        }
</style>
</head>
    <div class="clh">
        <div class="clh__c">
            <?php if(isset($searchtext)): ?>
                <h2 class="clh__c-t">Searched for: <?php echo e($searchtext); ?> </h2>
            <?php endif; ?>
            <?php if(isset($cityname)): ?>
                <p class="clh__c-t"><?php echo e($coursename); ?> Exam in <?php echo e($cityname); ?>, List of top <?php echo e($coursename); ?> Coaching
                    Institutes in <?php echo e($cityname); ?></p>
                <div class="ch__c-f" style="padding-left:12px;padding-right:12px">
                        <div class="form">
                            <form>
                                <?php
                                    $types = ['Regular', 'Test Series', 'Correspondance', 'Online', 'Tutor', 'Library'];
                                ?>,
                                <select name="type" id="type">
                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type); ?>"><?php echo e($type); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <select name="category" id="course">
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($course_id == $course->id): ?>
                                            <option value="<?php echo e($course->slug); ?>" selected><?php echo e($course->name); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($course->slug); ?>"><?php echo e($course->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <select name="city" id="city">
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($city_id == $city->id): ?>
                                            <option value="<?php echo e($city->name); ?>" selected><?php echo e($city->name); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($city->name); ?>"><?php echo e($city->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="button-container">
                                    <!-- First Button -->
                                    <a class="button button-primary" href="#" id="searchbtn" style="margin-right:5px">Search</a>

                                    <!-- Second Button with Link -->
                                    <a class="button button-secondary" href="<?php echo e(url('mapsearch') . '/' . $typename . '/' . $courseslug . '/' . $cityname); ?>" id="msearch">MapSearch</a>
                                </div>


                            </form>
                        </div>
                        <script>
                            $('#searchbtn').click((e) => {
                                e.preventDefault();
                                window.open(`<?php echo e(url('homesearch')); ?>/${$('#type').val()}/${$('#course').val()}/${$('#city').val()}`,
                                    '_self');
                            })
                        </script>

                    </div>    
              <a class="button button-secondary" href="<?php echo e(url('mapsearch') . '/' . $typename . '/' . $courseslug . '/' . $cityname); ?>"id="msearchresponsive">MapSearch</a>       
                   <?php else: ?>
                <?php if(isset($course)): ?>
                    <div class="course">
                        <h2><?php echo e($course->name); ?></h2>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
        $('.type-btn').click(() => {
            if ($('.type-btn-dropdown').css('height') === "0px") {
                $('.course-btn-dropdown').css({
                    'height': '0px',
                    'overflow-y': 'hidden',
                    'transition': 'all 0.5s'
                });
                $('.city-btn-dropdown').css({
                    'height': '0px',
                    'overflow-y': 'hidden',
                    'transition': 'all 0.5s'
                });
                $('.type-btn-dropdown').css({
                    'max-height': '22rem',
                    'height': 'auto',
                    'overflow-y': 'auto',
                    'transition': 'all 0.5s'
                });
            } else {
                $('.type-btn-dropdown').css({
                    'height': '0px',
                    'overflow-y': 'hidden',
                    'transition': 'all 0.5s'
                });
            }
        })
        $('.course-btn').click(() => {
            if ($('.course-btn-dropdown').css('height') === "0px") {
                $('.city-btn-dropdown').css({
                    'height': '0px',
                    'overflow-y': 'hidden',
                    'transition': 'all 0.5s'
                });
                $('.course-btn-dropdown').css({
                    'max-height': '22rem',
                    'height': 'auto',
                    'overflow-y': 'auto',
                    'transition': 'all 0.5s'
                });
            } else {
                $('.course-btn-dropdown').css({
                    'height': '0px',
                    'overflow-y': 'hidden',
                    'transition': 'all 0.5s'
                });
            }
        })
        $('.city-btn').click(() => {
            if ($('.city-btn-dropdown').css('height') === "0px") {
                $('.course-btn-dropdown').css({
                    'height': '0px',
                    'overflow-y': 'hidden',
                    'transition': 'all 0.5s'
                });
                $('.city-btn-dropdown').css({
                    'max-height': '22rem',
                    'height': 'auto',
                    'overflow-y': 'auto',
                    'transition': 'all 0.5s'
                });
            } else {
                $('.city-btn-dropdown').css({
                    'height': '0px',
                    'overflow-y': 'hidden',
                    'transition': 'all 0.5s'
                });
            }
        })

        $(document).on("click", function(event) {
            if ($(event.target).closest(".city-btn").length === 0) {
                $('.city-btn-dropdown').css({
                    'height': '0px',
                    'overflow-y': 'hidden',
                    'transition': 'all 0.5s'
                });;
            }
            if ($(event.target).closest(".course-btn").length === 0) {
                $('.course-btn-dropdown').css({
                    'height': '0px',
                    'overflow-y': 'hidden',
                    'transition': 'all 0.5s'
                });;
            }
        });

        let citySelected;
        let courseSelected;
        let typeSelected;

        Array.of($('.type-btn-dropdown').children()).forEach((city) => {
            city.on("click", (e) => {
                $('.type-selected').text(e.target.innerText);
                typeSelected = e.target.innerText;
                if (typeSelected) {
                    // $('#mapview').attr('href',`<?php echo e(url('mapsearch') . '/'); ?>${e.target.innerText}`);
                    $('#mapview').attr('href',
                        `<?php echo e(url('mapsearch') . '/'); ?>${typeSelected}/${courseSelected}/${citySelected}`
                        );
                } else {
                    $('#mapview').attr('href', `<?php echo e(url('mapsearch') . '/'); ?>${e.target.innerText}`);
                }
            })
        })

        Array.of($('.city-btn-dropdown').children()).forEach((city) => {
            city.on("click", (e) => {
                $('.city-selected').text(e.target.innerText);
                citySelected = e.target.innerText;
                if (courseSelected) {
                    // $('#mapview').attr('href',`<?php echo e(url('mapsearch') . '/'); ?>${e.target.innerText}`);
                    $('#mapview').attr('href',
                        `<?php echo e(url('mapsearch') . '/'); ?>${typeSelected}/${courseSelected}/${citySelected}`
                        );
                } else {
                    $('#mapview').attr('href', `<?php echo e(url('mapsearch') . '/'); ?>${e.target.innerText}`);
                }
            })
        })
        Array.of($('.course-btn-dropdown').children()).forEach((city) => {
            city.on("click", (e) => {
                $('.course-selected').text(e.target.innerText);
                courseSelected = e.target.dataset.slug;
                if (citySelected) {
                    $('#mapview').attr('href',
                        `<?php echo e(url('mapsearch') . '/'); ?>${typeSelected}/${courseSelected}/${citySelected}`
                        );
                } else {
                    $('#mapview').attr('href', `<?php echo e(url('mapsearch') . '/'); ?>${e.target.innerText}`);
                }
            })
        })
    </script>

    <div class="bc">
        <div class="bc__c">
            <a href="<?php echo e(url('/')); ?>">
                <p>Home</p>
            </a>
            <p>&nbsp; > <?php echo e(isset($typename) ? $typename : ''); ?><?php echo e(isset($coursename) ? ' > ' . $coursename : ''); ?>

                <?php echo e(isset($cityname) ? ' > ' . $cityname : ''); ?></p>
        </div>
    </div>

    <div class="cl">
        <div class="cl__c">
            <div class="cl__c-f">
                <div class="cl__c-f-c">
                    <h5 class="cl__c-f-c-h">FILTERS</h5>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">ESTABLISHED</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem establish_checkbox" name="established" value="asc"
                                id="old-1">
                            <label for="old-1">Old To New</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem establish_checkbox" name="established" value="desc"
                                id="old-2">
                            <label for="old-2">New To Old</label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">FEE STRUCTURE</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem feestructure_checkbox" name="fees" value="desc"
                                id="old-3">
                            <label for="old-3">High To Low</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem feestructure_checkbox" name="fees" value="asc"
                                id="old-4">
                            <label for="old-4">Low To High</label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">RATING & REVIEWS</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem rating_checkbox" name="rating" value="4"
                                id="old-5">
                            <label for="old-5">4 <i class="fa fa-star"></i> &amp; Above</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem rating_checkbox" name="rating" value="3"
                                id="old-6">
                            <label for="old-6">3 <i class="fa fa-star"></i> &amp; Above </label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem rating_checkbox" name="rating" value="2"
                                id="old-7">
                            <label for="old-7">2 <i class="fa fa-star"></i> &amp; Above </label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem rating_checkbox" name="rating" value="1"
                                id="old-8">
                            <label for="old-8">1 <i class="fa fa-star"></i> &amp; Above </label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">TOTAL BRANCH ACROSS INDIA</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem branch_checkbox" name="branches" value="desc"
                                id="old-9">
                            <label for="old-9">Maximum To Minimum</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem branch_checkbox" name="branches" value="asc"
                                id="old-10">
                            <label for="old-10">minimum to Maximum</label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">SELECTED STUDENTS</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem students_checkbox" name="student_selection"
                                value="desc" id="old-11">
                            <label for="old-11">High To Low</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem students_checkbox" name="student_selection"
                                value="asc" id="old-12">
                            <label for="old-12">Low To High</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem students_checkbox" name="student_selection"
                                value="n/a" id="old-13">
                            <label for="old-13">N/A</label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">VIEW</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem view_checkbox" name="views" value="desc"
                                id="old-14">
                            <label for="old-14">High To Low</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem view_checkbox" name="views" value="asc"
                                id="old-15">
                            <label for="old-15">Low To High</label>
                        </div>
                    </div>
                      
                      <div class="cl__c-f-c-i">
                    <p class="cl__c-f-c-sh">LOCALITIES</p>
                    <?php if(isset($citylocals)): ?>
                    <?php $__currentLoopData = $citylocals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $citylocal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="locality_filter" style="margin-left:10px;font-size:1.4rem;font-family:nunito;margin-bottom:10px;">
                        <label>
                            <input type="checkbox" class="filteritem localities_checkbox" name="selected_citylocals" value="<?php echo e($citylocal->id); ?>">
                            <?php echo e($citylocal->name); ?>

                        </label>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">LIKE</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem like_checkbox" name="likes" value="desc"
                                id="old-16">
                            <label for="old-16">High To Low</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem like_checkbox" name="likes" value="asc"
                                id="old-17">
                            <label for="old-17">Low To High</label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">DISLIKE</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem dislike_checkbox" name="dislikes" value="desc"
                                id="old-18">
                            <label for="old-18">High To Low</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem dislike_checkbox" name="dislikes" value="asc"
                                id="old-19">
                            <label for="old-19">Low To High</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cl__c-cl">
        <?php if(isset($SeoKeywords) && isset($city_id) && isset($course_id)): ?>
               <?php $__currentLoopData = $SeoKeywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $SeoKeyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

               <?php if($SeoKeyword->course == $course_id && $SeoKeyword->city == $city_id): ?>


                <p style="width:100%;margin-bottom:10px;padding:6px 8px;background-color:white;font-size:15px;font-family:nunito;text-align:center" ><b><?php echo e($SeoKeyword->key1); ?> <a href="<?php echo e(url('/')); ?>" class="keyword" id="keyhover"><?php echo e($SeoKeyword->key2); ?></a> <?php echo e($SeoKeyword->key3); ?></b></p>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
               
                <div class="cl__c-cl-c">
                    <?php if(count($coachings) == 0): ?>
                        <div class="empty">
                            <img src="<?php echo e(asset('img/empty-tree.svg')); ?>" alt="">
                            <p>Oops! it seem coaching you are looking for isn't available</p>
                        </div>
                    <?php else: ?>
                        <?php $__currentLoopData = $coachings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coaching): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('components.coachingcard', [
                                'coaching' => $coaching,
                                'localities' => $localities,
                                'cities'     => $cities
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!isset($actionType)): ?>
                            <?php echo $__env->make('components.pagination', ['data' => $coachings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="comparewidget">
        <a href="<?php echo e(url('compare')); ?>" class="comparewidget__a">
            <div class="comparewidget__c">
                <p>Compare</p>
                <span class="comparewidget__c-count">1</span>
            </div>
        </a>
        <div class="comparewidget__ic">
            <div class="comparewidget__ic-cc">
                
            </div>
            <div class="remove">Remove All</div>
        </div>
    </div>
    <script src="<?php echo e(asset('js/coachingFilter.js')); ?>"></script>
<?php if(isset($pccs)): ?>
    <div class="popular" style="margin-left:5%;background-color:#fff;margin-right:5%;margin-bottom:10px;">
        <h2 style="padding:4px 6px;font-family:nunito;font-size:20px"><?php echo e($coursename?? null); ?> Coachings in Popular Cities</h2>
        <p style="font-size:1.4rem;font-family:nunito;padding-left:10px;padding-top:5px;padding-bottom:5px;padding-right:10px;  text-align: justify;text-justify: inter-word;" >
        <?php $__currentLoopData = $pccs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    <?php if(in_array($city->id,json_decode($pcc->cities))): ?>

    <a href="<?php echo e(url("homesearch/{$typename}/{$course_slug}/{$city->name}")); ?>" class="pop">


      <?php echo e($coursename?? null); ?> coaching classes in  <?php echo e($city->name.' '.'|'.' '); ?>  </a>


    <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</p>
</div>
<?php endif; ?>
<script>
    var assetPath = "<?php echo e(asset('img/empty-tree.svg')); ?>";
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header',[$ktitlez?? null,$meta?? null, $ogtitle??null, $ogtype??null, $ogurl??null, $ogdesc??null, $canonicals??null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/coachinglist.blade.php ENDPATH**/ ?>