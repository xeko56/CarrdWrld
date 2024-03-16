$(document).ready(function () {

    // Hide dropdown by default
    $(".user-dropdown").hide();

    // Toggle dropdown on button click
    $("#user-menu-button").click(function () {
        $(".user-dropdown").toggle();
    });

    // Close dropdown on click outside
    $(document).click(function (event) {
        if (!$(event.target).closest("#user-menu-button, .user-dropdown").length) {
            $(".user-dropdown").hide();
        }
    });

    var data = JSON.parse($('#gridData').val());

    $('#trending_table').DataTable({
        data: data?.data,
        columns: [
            { 
                data: 'img_url',
                render: function (data, type, row, meta) {
                    return type === 'display'
                        ? `<img src="${data}" alt="Card Image" width="100">`
                        : data;
                } 
            },
            { 
                data: 'card_name',
                render: function (data, type, row, meta) {
                    console.log(row);
                    return type === 'display'
                        ? `<a class="text-dark text-hover-primary" href="/card/${row['card_nr']}">${data}</a>`
                        : data;
                }                 
            },
            { data: 'group_name' },
            { data: 'exp_name' },
            { data: 'type_name' },
            { data: 'release_date' }
        ]
    });

});

