$(document).ready(function () {
    $(".autocomplete").autocomplete({
        serviceUrl: window.location+'/getJSONTasks',
        onSearchComplete: function (query, suggestions) {
        },
        minLength: 1,
        onSelect: function (suggestion) {

        }
        });
});
