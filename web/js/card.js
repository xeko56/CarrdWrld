$(document).ready(function () {
    $('#available_list_table').DataTable({
        ajax: {
            url: "/site/get-sale-cards",
            type: "POST",
            data: {
                "card_nr": $("#card_nr").val()
            }
        },
        columns: [
            {
                data: 'username',
                render: function (data, type, row, meta) {
                    console.log(row);
                    return type === 'display'
                        ? `<a class="text-dark text-hover-primary" href="#">${data}</a>`
                        : data;
                }                    
            },
            {
                data: 'status_abbre',
            },
            { 
                data: 'price',
                render: function (data, type, row, meta) {
                    return type === 'display'
                        ? `${data} €`
                        : data;
                }                     
            },
            { data: 'amount' }
        ]
    });
})
