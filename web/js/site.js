const gridDataInput = document.getElementById('gridData');
const { data, columns } = JSON.parse(gridDataInput.value);
console.log('gridada', data, columns);

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

    new gridjs.Grid({
        columns: [{
            id: 'card_nr',
            name: ''
        },
        {
            id: 'card_name',
            name: 'Name'
        }, 
        {
            id: 'group_name',
            name: 'Group'
        }, 
        {
            id: 'exp_name',
            name: 'Expansion'
        },
        {
            id: 'type_name',
            name: 'Type'
        },
        {
            id: 'release_date',
            name: 'Release date'
        },
        {
            id: 'img_url',
            formatter: (cell) => gridjs.html(`<img src="${cell}" alt="Card Image" width="100">`),
            name: ''
        },    
    ],
        data: data,
        sort: true,
        resizable: true,
    })
        .render(document.getElementById("trending-table"));


});

