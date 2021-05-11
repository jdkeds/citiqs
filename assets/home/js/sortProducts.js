'use strict';
$(document).ready( function () {
    $("select option:nth-child(1)").attr("selected", true);
    var table = $('#products').DataTable({
        processing: true,
        colReorder: true,
        rowReorder: true,
        fixedHeader: true,
        deferRender: true,
        scroller: true,
        ordering: true,
        lengthMenu: [[200, 500, -1], [200, 500, 'All']],
        pageLength: 200,
        ajax: {
            type: 'get',
            url: globalVariables.baseUrl + 'getproducts',
            dataSrc: '',
        },
        rowReorder: {
            selector: 'tr',
            dataSrc: 'orderNo'
        },
        columnDefs: [
            {orderable: false, targets: 0, visible: false }
        ],
        columns:[
            {
                title: 'Order',
                data: 'orderNo',
            },
            {
                title: 'ID',
                data: 'productId'
            },
            {
                title: 'Name',
                data: 'name'
            },
            {
                title: 'Category',
                data: 'category'
            }
        ],
    });

    var category = $('#category').val();
        table
        .columns( 3 )
        .search( category )
        .draw();

    $('#category').change(function() {
        var category = this.value;
        table.columns(3).search(category).draw();
    });

    table.on( 'row-reordered', function ( e, diff, edit ) {
        let products = [];
        table.one( 'draw', function () {
            table.rows({search:'applied'}).every(function (rowIdx, tableLoop, rowLoop) {
                products.push(this.data().productId);
            });
            sortProducts(products) 
        });
    });
});


function sortProducts(products) {
    let url = globalVariables.ajax + 'sortProducts';
    console.dir(products);
    let post = {
        'products': products,
    }
    sendAjaxPostRequestImproved(post, url, alertifyAjaxResponse);
}