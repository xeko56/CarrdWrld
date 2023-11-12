$(document).ready(function () {
    var originalDimensions = {};
    // Use event delegation for the hover event
    $(document).on('mouseenter', '.icon-wrapper i', function () {
        // Find the corresponding image box for the hovered camera icon
        var imageBox = $(this).closest('.icon-wrapper').find('.image-box');
        var image = imageBox.find('img');

        // Store the original dimensions before scaling
        originalDimensions.width = image.width();
        originalDimensions.height = image.height();
        // Show the image box
        imageBox.fadeIn();
        imageBox.width(250);
        // imageBox.height(image.height() * 0.3);
        image.width(250);
    });

    // Use event delegation for the hover event
    $(document).on('mouseleave', '.icon-wrapper i', function () {
        // Find the corresponding image box for the hovered camera icon
        var imageBox = $(this).closest('.icon-wrapper').find('.image-box');

        // Hide the image box
        imageBox.fadeOut();
    });

    console.log('Start');
    initProductTable()
});
var productTable = "";

function initProductTable() {
    productTable = $('#productTable').DataTable({
        "bSortCellsTop": true,
        "processing": true,
        "serverSide": false,
        "lengthMenu": [
            [11, 25, 50, -1],
            [11, 25, 50, "All"]
        ],
        "pageLength": 11,
        "bPaginate": true,
        "autoWidth": false,
        "ajax": {
            "url": "/site/get-product-table",
            "type": "POST",
            "data": function (d) { }
        },
        "order": [],
        "dom": "Zlfrtip",
        "deferRender": true,
        "colReorder": {},
        "columns": [
            { data: "card_nr", sClass: "input-large dt-head-left dt-body-left" },
            {
                data: "img_url", sClass: "input-large dt-head-left dt-body-left", searchable: false, orderable: false,
                render: function (data, type, row) {
                    return '<div class="icon-wrapper">' +
                        '<i class="fa-solid fa-camera" id="img_' + row.card_nr + '"></i>' +
                        '<div class="image-box">' +
                        '<img src="' + data + '" alt="Image">' +
                        '</div>' +
                        '</div>'
                }
            },
            {
                data: "card_name", sClass: "input-large dt-head-left dt-body-left",
                render: function (data, type, row) {
                    return '<a href="/">'+data+'</a>'
                }
            },
            { data: "exp_name", sClass: "input-large dt-head-left dt-body-left" },
            { data: "group_name", sClass: "input-large dt-head-left dt-body-left" },
            { data: "type_name", sClass: "input-large dt-head-left dt-body-left" },
            {
                data: "release_date", sClass: "input-large dt-head-left dt-body-left",
            }
        ],
        "drawCallBack": function (settings) {
        },
        "fnRowCallback": function () {
        },
        "initComplete": function () {
        }
    })
}