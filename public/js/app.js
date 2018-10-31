function renderSearch(data, table) {

    function cellColor(magnitud) {
        if (magnitud <= 4) return 'green';
        else if (magnitud <= 6) return 'yellow';
        else if (magnitud <= 7) return 'orange';
        else return 'red';
    }

    table.empty();
    var features = data.features;
    features.forEach(function (element, idx) {
        var mag   = element.properties.mag,
            place = element.properties.place,
            time  = new Date(element.properties.time),
            color = cellColor(mag);

        var row = jQuery('<tr>', {'data-id': element.id}).append(
            jQuery('<td>', {css: {background: color}}),
            jQuery('<td>', {html: place}),
            jQuery('<td>', {html: mag}),
            jQuery('<td>', {html: time.toISOString()})
        );
        table.append(row);
    });
}

(function () {
    setTimeout(function () {
        var banner           = document.getElementById('banner');
        banner.style.display = 'none';
    }, 5000);

    var STORAGE_SEARCH = 'search';
    var formSearch     = jQuery('#form-search');
    var tableSearch    = jQuery('#table-search');

    formSearch.on('submit', function (e) {
        e.preventDefault();
        var formData = formSearch.serialize();
        axios.get('/search.php?' + formData).then(function (response) {
            localStorage.setItem(STORAGE_SEARCH, response.request.responseText);
            renderSearch(response.data, tableSearch);
        }).catch(function (err) {
            alert(err.response.data.message);
        });
    });


    let prevSearch = localStorage.getItem(STORAGE_SEARCH);
    if (null !== prevSearch) {
        prevSearch = JSON.parse(prevSearch);
        renderSearch(prevSearch, tableSearch);
    }

})();