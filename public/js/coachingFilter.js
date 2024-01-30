const checkboxGroup = [
    ".establish_checkbox",
    ".feestructure_checkbox",
    ".rating_checkbox",
    ".branch_checkbox",
    ".students_checkbox",
    ".view_checkbox",
    ".localities_checkbox",
    ".like_checkbox",
    ".locality_checkbox",
    ".dislike_checkbox"
];

window.onload = () => {
    checkboxGroup.forEach((group) => {
        $(group).prop('checked', false);
    })
}


checkboxGroup.forEach((group) => {
    $(group).on('change', (e) => {
        $(group).not(e.target).prop('checked', false);

        let formData = new Object();

        formData['url'] = window.location.href;
        formData['category'] = window.location.href.split('/')[window.location.href.split('/').length - 1];

        $("input[type='checkbox']").each((index, field) => {
            if (field.checked) {
                formData[field.name] = field.value;
            }
        })


        $.ajax(
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "method": "POST",
                'url': '/filtercoachings',
                'data': formData,
                'success': (res) => {
                    $('.cl__c-cl-c').empty();
                    if (res.coachings.length === 0) {
                        // Display an image when there is no coaching data
                        $('.cl__c-cl-c').append('<img src="' + assetPath + '" alt="No Coaching Data" style="height:50%px;width:50%;margin-left:20%">');
                        $('.cl__c-cl-c').append('<h2 style="margin-left:25%; font-family:nunito">Oops! The Coaching you are looking for is not available</h2>');

                    } else {
                    res.coachings.forEach((coaching) => {

                        $('.cl__c-cl-c').append(
                            `
                            <div class="cc">
                                <div class="cc__l">
                                    <img src="${rootlink}/storage/${coaching.logo}" alt="Coaching Logo">
                                    <div class="cc__l-cbtn">
                                        <input type="checkbox" class="comparebtn" value="${coaching.localval}" data-id="${coaching.id}" id="comparebtn_${coaching.id}">
                                        <label for="comparebtn_${coaching.id}">Add To Compare</label>
                                    </div>
                                </div>
                                <a href="${rootlink}/coaching/${coaching.slug}">
                                    <div class="cc__m">
                                        <div class="cc__m-h">
                                            ${coaching.name}
                                        </div>
                                        <div class="cc__m-r">
                                            <div class="cc__m-r-rc">
                                                <i class="fa fa-star"></i>
                                                <p>${coaching.average_rating}</p>
                                            </div>
                                            <p>${coaching.likes} Likes & ${coaching.dislikes} Dislikes</p>
                                        </div>
                                        <ul>
                                            <li>Establishment: ${coaching.establishment} | Head Of the Institute: ${coaching.head_organisation}</li>
                                            <li>Total Branch across India: ${coaching.total_branches}</li>
                                            <li>Course Type: 
                                                ${coaching.courses
                            }
                                            </li>
                                            <li>Contact Number: ${coaching.phone}</li>
                                            <li>Email: ${coaching.email}</li>
                                            <li>Address: ${coaching.address}, ${coaching.state}, ${coaching.country}, ${coaching.pincode}</li>
                                        </ul>
                                        <div class="cc__m-bg">
                                            <a href="${rootlink}/feestructure/${coaching.slug}">
                                                <div class="cc__m-bg-btn">FEE</div>
                                            </a>
                                            <a href="${rootlink}/faculties/${coaching.slug}">
                                                <div class="cc__m-bg-btn">FACULITY</div>
                                            </a>
                                            <a href="${rootlink}/results/achivement/${coaching.slug}">
                                                <div class="cc__m-bg-btn">ACHIVEMENT</div>
                                            </a>
                                            <a href="${rootlink}/results/result/${coaching.slug}">
                                                <div class="cc__m-bg-btn">RESULTS</div>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                                <div class="cc__r">
                                    ${res.is_session_set
                                ?
                                `<i class="fa fa-share" onclick="shareMe('${rootlink}/coaching/${coaching.name}')"></i>
                                        <i class="fa fa-heart wishbtn" style="cursor: pointer;${coaching.in_wishlist ? 'color:red;' : 'color:grey;'}" data-id="${coaching.slug}" data-type="coaching"></i>
                                        <a class="cc__r-btn" href="${rootlink}/onlineadmission">
                                            <div><p>Enroll Now</p></div>
                                        </a>`
                                :
                                `
                                        <a href="${rootlink}/login">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                        <a class="cc__r-btn" href="${rootlink}/login">
                                            <div><p>Enroll Now</p></div>
                                        </a>`
                            } 
                                </div>
                            </div>
                            `
                        )
                    })
                    }
                }
            }
        )
    })
})