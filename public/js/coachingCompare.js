let storage = localStorage.getItem('coachings_id');

if (storage !== null) {
    let storageArr = Array.from(JSON.parse(storage));
    storageArr.forEach((id) => {    
        $('.comparebtn').each((index, item) => {
            if (item.dataset.id.toString() === id.toString()) {
                item.checked = true;
            } else {
                item.checked = false;
            }
        })
    })

    handleRenderOfCompareWidget();
}

//Remove All
$('.remove').on('click', () => {
    localStorage.clear();
    $('.comparewidget').css('display', 'none');
    $('.comparewidget__ic-cc').empty();
    Array.from($('.comparebtn')).forEach((checkbox) => {
        checkbox.checked = false;
    })
})

$('.cl__c,.ch__c-mc-r').on('change', '.comparebtn', (e) => {
    if (e.target.checked) {
        let localCoachingsId = localStorage.getItem('coachings_id');
        if (localCoachingsId == null) {
            let idsArray = new Array();
            idsArray.push(e.target.dataset.id);
            let coachingsArray = new Array();
            coachingsArray.push(e.target.value)
            localStorage.setItem('coachings_id', JSON.stringify(idsArray));
            localStorage.setItem('coachings', JSON.stringify(coachingsArray));
        } else {
            let ids = Array.from(JSON.parse(localCoachingsId));
            if (!ids.includes(e.target.dataset.id)) {
                if(ids.length < 3 ){
                    ids.push(e.target.dataset.id);
                    let coachingsArray = Array.from(JSON.parse(localStorage.getItem('coachings')));
                    coachingsArray.push(e.target.value);
                    localStorage.setItem('coachings_id', JSON.stringify(ids));
                    localStorage.setItem('coachings', JSON.stringify(coachingsArray));
                }else{
                    e.target.checked = false;
                }
            } else {
                ids = ids.filter((id) => { return id != e.target.dataset.id });
                let coachingsArray = Array.from(JSON.parse(localStorage.getItem('coachings')));
                coachingsArray = coachingsArray.filter((coaching) => { return coaching != e.target.value });
                localStorage.setItem('coachings_id', JSON.stringify(ids));
                localStorage.setItem('coachings', JSON.stringify(coachingsArray));
            }
        }
    } else {
        let localCoachingsId = localStorage.getItem('coachings_id');
        if (localCoachingsId != null) {
            let ids = Array.from(JSON.parse(localCoachingsId));
            ids = ids.filter((id) => { return id != e.target.dataset.id });
            let coachingsArray = Array.from(JSON.parse(localStorage.getItem('coachings')));
            coachingsArray = coachingsArray.filter((coaching) => { return coaching != e.target.value });
            localStorage.setItem('coachings_id', JSON.stringify(ids));
            localStorage.setItem('coachings', JSON.stringify(coachingsArray));
        }
    }

    handleRenderOfCompareWidget();
})

function handleRenderOfCompareWidget() {
    $('.comparewidget__ic-cc').empty()
    let coachingsArray = Array.from(JSON.parse(localStorage.getItem('coachings')));

    if (coachingsArray.length != 0) {
        $('.comparewidget').css('display', 'block');
    } else {
        $('.comparewidget').css('display', 'none');
    }

    coachingsArray.forEach((coaching) => {
        let coachingObj = JSON.parse(coaching);

        $('.comparewidget__ic-cc').append(`
            <div class="cwcoaching data-handle-${coachingObj['id']}">
                <img src="${rootlink}/storage/${coachingObj['logo']}" alt="">
                <p>${coachingObj['name']}</p>
                <span><i class="fa fa-times removebtn" data-id='${coachingObj.id}'></i></span>
            </div>`
        );
    })

    $('.comparewidget__c-count').text($('.comparewidget__ic-cc').children().length);
}


$('.comparewidget').on('click', '.removebtn', (e) => {
    $(`input[data-id='${e.target.dataset.id}']`).attr('checked',false)
    $('.comparebtn').each((index, item) => {
        if (item.dataset.id.toString() === e.target.dataset.id.toString()) {
            item.checked = false;
        }
    })

    let ids = Array.from(JSON.parse(localStorage.getItem('coachings_id')));
    ids = ids.filter((id) => { return id != e.target.dataset.id });
    let coachingsArray = Array.from(JSON.parse(localStorage.getItem('coachings')));
    // coachingsArray = coachingsArray.filter((coaching) => { return JSON.parse(coaching).id != e.target.dataset.id });
    let newCoachingsArray = new Array();
    coachingsArray.forEach((coaching)=>{
        let coachingObj = JSON.parse(coaching);

        if(coachingObj.id.toString() !== e.target.dataset.id.toString()){
            newCoachingsArray.push(coaching);
        }
    })

    localStorage.setItem('coachings_id', JSON.stringify(ids));
    localStorage.setItem('coachings', JSON.stringify(newCoachingsArray));

    handleRenderOfCompareWidget();
})



$('.comparewidget__a').on('click', (e) => {
    e.preventDefault();
    let param = Array();

    let storage = localStorage.getItem('coachings');
    let compareList = JSON.parse(storage);
    let list = Array.from(compareList);
    list.forEach((item) => {
        item = JSON.parse(item);
        param.push(item['id']);
    })
    let url = new URL($('.comparewidget__a').attr('href'))
    let search = new URLSearchParams(url.search);
    search.set('coachings', param);
    window.open(url + '/' + param.toString().split(',').join('-'), '_self');
    // $('.comparewidget__a').attr('href',url+'/'+param)
})