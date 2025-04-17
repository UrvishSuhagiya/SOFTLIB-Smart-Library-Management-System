(function ($) {
    "use strict";
    var mainApp = {
        slide_fun: function () {

            $('#carousel-example').carousel({
                interval: 3000
            })

        },
        dataTable_fun: function () {
            if ($.fn.dataTable.isDataTable('#dataTables-example')) {
                $('#dataTables-example').DataTable().destroy(); // Destroy existing instance
            }

            $('#dataTables-example').DataTable({
                "dom": "<'row'<'col-sm-12 text-end'f>>" +
                    "t" +
                    "<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "lengthChange": false
            });
        },
        custom_fun: function () {
            },

    }

    $(document).ready(function () {
        mainApp.slide_fun();
        mainApp.dataTable_fun();
        mainApp.custom_fun();
    });
}(jQuery));
