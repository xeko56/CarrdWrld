$(document).ready(function () {
    $('#category_card_table').DataTable({
        ajax: {
            url: "/site/get-category-cards",
            type: "POST",
            data: {
                "category_nr": $("#category_nr").val()
            }
        },
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
                    return type === 'display'
                        ? `<a class="text-dark text-hover-primary" href="/card/${row['card_nr']}">${data}</a>`
                        : data;
                }                 
            },
            { 
                data: 'card_nr',              
            },       
            { 
                data: null,
                render: function (data, type, row, meta) {
                    return type === 'display'
                        ? `Ultra rare`
                        : data;
                }                 
            }, 
            { 
                data: null,
                render: function (data, type, row, meta) {
                    return type === 'display'
                        ? `100`
                        : data;
                }                 
            },
            { 
                data: null,
                render: function (data, type, row, meta) {
                    return type === 'display'
                        ? `100 €`
                        : data;
                }                     
            },
        ]
    });
})
