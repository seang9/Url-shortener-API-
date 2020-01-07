//url
var rooturl = "http://localhost:4006/url/findall/";
var currenturl;
var table = null;

//all urls and statistics
var findAllstat = function () {
    console.log('findAllstat');
    $.ajax({
        type: 'GET', //Request type
        url: rooturl + "statistics/",
        dataType: "json", // data type of response
        success: renderListurls // if successful render table
    });
}

//render table
function renderListurls(data) {
    console.log("renderListurls");

    var lists = data.urls;
    $.each(lists, function (index, urls) {
        $('#tableBodys').append('<tr><td>' + urls.id + '</td><td>' + urls.url + '</td><td>' + urls.short_code +
            '</td><td>' + urls.hits + '</td><td>' + urls.added_date + '</td><td>' + urls.user_ip + '</td><td>' + urls.browser + '</td><td>' +
            urls.referer + '</td><td>' + urls.lastused + '</td><td><a href="#" id="' + urls.id + '"class="btn btn-primary" data-toggle="modal" data-target="#optionsModal">edit</a> </td></tr>');
        console.log(index, urls);
    });
    table = $('#dataTables').DataTable({
        responsive: true,
        "pageLength": 10,
    });
}


//popular data card
var findpopcard = function () {
    console.log(findpopcard);
    $.ajax({
        type: 'GET',
        url: rooturl + "popular/",
        dataType: "json", // data type of response
        success: renCardpop
    });
}

function renCardpop(dataplayer) {
    lists = dataplayer;

    console.log("renderCard2");
    $.each(lists, function (index, url) {
        $('#card2').append('<div class="d-flex justify-content-between">' +
            '<i class="fas fa-at fa-3x text-success"></i>' +
            '<div class="text-right text-secondary">' +
            '<h5>Most Popular </h5>' + '<h3><a>' + url.urls + '</a></h3></div></div>'
        );
    });
}

//count number of urls
var Counturlcard = function () {
    console.log(Counturlcard);
    $.ajax({
        type: 'GET',
        url: rooturl + "counturls/",
        dataType: "json", // data type of response
        success: renCardcount // if the query success render the data card
    });
}

function renCardcount(dataplayer) {
    lists = dataplayer;

    console.log("renCardcount");
    $.each(lists, function (index, url) {
        $('#card3').append('<div class="d-flex justify-content-between">' +
            '<i class="fas fa-link fa-3x text-primary"></i>' +
            '<div class="text-right text-secondary">' +
            '<h5>Number of Urls</h5>' + '<h3>' + url.urls + '</h3></div></div></div>'
        );
    });
}

//Top browser card
var topbrowser = function () {
    console.log(topbrowser);
    $.ajax({
        type: 'GET',
        url: rooturl + "topbrowser/",
        dataType: "json", // data type of response
        success: renderCard4
    });
}

function renderCard4(dataplayer) {
    lists = dataplayer;
    console.log("renderCard4");
    $.each(lists, function (index, url) {
        $('#card4').append('<div class="d-flex justify-content-between">' +
            '<i class="fab fa-chrome fa-3x text-warning"></i>' +
            '<div class="text-right text-secondary">' +
            '<h5>Top Browser</h5>' + '<h3>' + url.urls + '</h3></div></div>'
        );
    });
}

//find a specific  url
function findurlById(id) {
    console.log('findPlayerById: ' + id);
    $.ajax({
        type: 'GET',
        url: rooturl + "stat/" + id,
        dataType: "json",
        success: function (url) {
            console.log('findById success: ' + url.id);

            currenturl = url;
            renderDetailsurls(currenturl);
        }
    });
}

// render data to the modal
function renderDetailsurls(url) {
    $('#id').val(url.id);
    $('#url').val(url.url);
    $('#short_code').val(url.short_code);
    $('#hits').val(url.hits);
    $('#added_date').val(url.added_date);
    $('#user_ip').val(url.user_ip);
    $('#browser').val(url.browser);
    $('#referer').val(url.referer);
    $('#lastused').val(url.lastused);

}

//update a url
var updateurl = function () {
    console.log('updateUrl');
    console.log("Updating This Url: " + $('#url').val());
    console.log(JSON.stringify(formToJSON())); //format the data for put
    $.ajax({
        type: 'PUT',
        url: rooturl + 'updateurl/' + $('#id').val(),
        dataType: "json",
        data: formToJSON(),
        success: function (data, textStatus, jqXHR) {
            alert('Url updated successfully');
            resettable();
            resetcardtable();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Url update error');
        }
    });
};
var formToJSON = function () {
    return JSON.stringify({
        "id": $('#id').val(),
        "url": $('#url').val(),
        "short_code": $('#short_code').val(),
        "hits": $('#hits').val(),
        "added_date": $('#added_date').val(),
        "user_ip": $('#user_ip').val(),
        "browser": $('#browser').val(),
        "referer": $('#referer').val(),
        "lastused": $('#lastused').val()
    });
}
//Delete a url
var deleteurl = function () {

    $.ajax({
        type: 'DELETE',
        url: rooturl + 'deleteurl/' + $('#id').val(), //get id for url
        success: function (data, textStatus, jqXHR) {
            alert('Url deleted successfully');
            resettable();
            resetcardtable();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Delete url  error');
        }
    });
};

//clear table for update
function resettable() {
    table
        .clear()
        .destroy();
}

//Empty cards and query the new information
var resetcardtable = function () {
    $('#card4').empty();
    $('#card5').empty();
    $('#card2').empty();
    $('#card3').empty();
    $('#date2').html(new Date());
    $('#date3').html(new Date());
    $('#last-date').html(new Date());
    $('#date').html(new Date());
    findAllstat();
    findpopcard();
    Counturlcard();
    topbrowser();
}
$(document).ready(function () {
    $(document).on("click", "#tableBodys a", function () {
        findurlById(this.id);
    });
    $(document).on("click", "#updateButton", function () {
        updateurl();
    });
    $(document).on("click", "#deleteButton", function () {
        deleteurl();
    });
    //top browser card
    $(document).on("click", "#update3", function () {
        $('#card4').empty();
        topbrowser();
        $('#date2').html(new Date())
    });
    //count num url card
    $(document).on("click", "#update2", function () {
        $('#card3').empty();
        Counturlcard();
        $('#date').html(new Date());
    });
    //Top browser card
    $(document).on("click", "#refresh", function () {
        $('#card2').empty();
        findpopcard();
        $('#last-date').html(new Date());
    });
    resetcardtable();
});
