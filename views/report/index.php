<script type="text/javascript" src="<?php echo URL; ?>/public/js/DataTables/Buttons-1.6.5/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>/public/js/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>/public/js/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>/public/js/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>/public/js/DataTables/Buttons-1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>/public/js/DataTables/Buttons-1.6.5/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>/public/js/DataTables/Buttons-1.6.5/js/buttons.colVis.min.js"></script>

<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Reports <b>List</b></h2></div>
                <div class="col-sm-4">
<!--                    <label>Raporty pomiędzy</label>-->
<!--                    <input type="text" class="form-control float-right"  placeholder="" id="range" aria-controls="reportTable">-->
                    <input type="hidden" id="hourlyRate" value="<?=$this->hourlyRate['hourlyRate'] ?>">

                </div>
            </div>
        </div>
        <table id="reportTable" style="width: 100%" class="table table-striped table-bordered" >

            <thead>
            <tr>
                <?php if ($_SESSION['role'] == 'admin') : ?>
                    <th>ID</th>
                    <!--                    <th>Zadania</th>-->
                    <th>Godziny</th>
                    <th>Imie</th>
                    <th>Nazwisko</th>
                    <th>Data Raportu</th>
                    <th>Data utworzenia</th>
                    <th>Data edycji</th>
                    <th>Action</th>

                <?php else: ?>
                    <th>ID</th>
<!--                    <th>Zadania</th>-->
                    <th>Godziny</th>
                    <th>Data Raportu</th>
                    <th>Data utworzenia</th>
                    <th>Data edycji</th>
                    <th>Action</th>
                <?php endif; ?>


            </tr>
            </thead>

            <tbody>

            </tbody>
            <tfoot>
                <?php if ($_SESSION['role'] == 'admin') : ?>
                    <th></th>
                    <!--                    <th>Zadania</th>-->
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                <?php else: ?>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                <?php endif; ?>
            </tfoot>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" >
                <form id="addReport" action="<?php echo URL; ?>Report/create" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title">Dodawanie: Raportu</h4>
                        <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Raport z dnia</label>
                            <input type="text" name="reportDate" class="form-control daterange"  placeholder="Nazwa">
                            <div class="invalid-feedback" id="EditError">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="itemsTable">Wykonane zadania</label>
                            <table id="itemsTable" class="table table-bordered itemsTable">
                                <thead class="thead-dark">
                                <tr style="background-color: #1a4d80;color: white;">
                                    <th scope="col">#</th>
                                    <th scope="col">Czas zadania</th>
                                    <th scope="col">Zadanie</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody id="append">
                                <tr>
                                    <td class="valuesIDWidth" >1</td>
                                    <td class="valuesInputWidth">
                                        <input type="text" class="form-control" name="completedTasks[0][time]">
                                        <div class="invalid-feedback" id="items0irpfPercentageError">
                                        </div>
                                    </td>
                                    <td class="valuesTaskWidth" >
                                        <input type="text" class="form-control autocomplete" name="completedTasks[0][task]">
                                        <div class="invalid-feedback" id="items0irpfPercentageError">
                                        </div>
                                        <div class="autocomplete-suggestions">
                                            <div class="autocomplete-group"><strong></strong></div>
                                            <div class="autocomplete-suggestion autocomplete-selected"></div>
                                            <div class="autocomplete-suggestion"></div>
                                            <div class="autocomplete-suggestion"></div>
                                        </div>
                                    </td>
                                    <td class="valueActionWidth"><button type="button"  class="btn btn-danger deleteItem">Delete</button></td>
                                </tr>
                                </tbody>
                            </table>
                            <input type="button" class="btn btn-info addItem float-left mb-1" value="+">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Dodaj">
                    </div>
                </form>
            </div>
        </div>
    </div>



<div id="myEditModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header">
                <h1 class="text-dark">Report: Edit</h1>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label>Raport z dnia</label>
                        <input type="hidden" name="getId">
                        <input type="text" name="reportDate" class="form-control daterange"  placeholder="Nazwa">
                        <div class="invalid-feedback" id="EditError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="itemsEditTable">Wykonane zadania</label>
                        <table id="itemsEditTable" class="table table-bordered itemsTable">
                            <thead class="thead-dark">
                            <tr style="background-color: #1a4d80;color: white;">
                                <th scope="col">#</th>
                                <th scope="col">Czas zadania</th>
                                <th scope="col">Zadanie</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody id="append">
                            </tbody>
                        </table>
                        <input type="button" class="btn btn-info addItem float-left mb-1" value="+">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <input type="submit" value="Save" id="saveModalButton" class="btn btn-primary">
            </div>
            </form>
        </div>
    </div>

</div>


<div id="myDeleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <h4 class="modal-title w-100">Are you sure?</h4>
                <button type="button" class="close closeButton" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="deleteForm">
                    <div class="form-group">
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                        <input type="hidden" name="getId"/>
                    </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <input type="submit" value="DELETE" id="deleteModalButton" class="btn btn-danger">
            </div>
            </form>
            </div>
        </div>
    </div>

</div>


<script type="text/javascript">

    $(document).ready(function () {
        var role = '<?php echo $_SESSION['role'];?>';
        var columns = [{"data": "reportid"},
                       // {"data": "tasks"},
                       {"data": "numberOfHours"},

        ];
        if (role === 'admin') {
            columns.push({"data": "name"});
            columns.push({"data": "lastName"});
        }
        columns = [...columns,
            ...[
                {"data": "reportDate"},
                {"data": "createdAt"},
                {"data": "updatedAt"},
                {
                    "data": '',
                    "defaultContent": "<a class=\"add\" title=\"Add\" data-toggle=\"tooltip\"><i class=\"material-icons\">&#xE03B;</i></a>\n" +
                        "                        <a href=\"#\" class=\"edit\" title=\"Edit\" data-toggle=\"modal\" data-target=\"#myEditModal\" id=\"Editbutton\"><i class=\"material-icons\">&#xE254;</i></a>\n" +
                        "                        <a class=\"delete\" title=\"Delete\" data-toggle=\"modal\" data-target=\"#myDeleteModal\"><i class=\"material-icons\">&#xE872;</i></a>"
                }]];

        $("#reportTable").DataTable({
            ajax: '<?php echo URL; ?>Report/listJson',
            dom: 'B<"br"><<"toolbar">frtip>',
            buttons: [
                {

                    extend: 'csvHtml5',
                    text:'<span class="glyphicon glyphicon-export"></span>CSV',
                    className: 'btn btn-info btn-lg',
                    footer: true
                    // exportOptions: {
                    //     columns: [ 0, 1, 2, 3, 6, 7, 8, 9, 10],
                    //     format: {
                    //         body: function (data, row, column, node) {
                    //             // Strip $ from salary column to make it numeric
                    //             return column === 2 ?
                    //                 data.replace(/\<br\/\>/g, ", ") :
                    //                 data;
                    //         }
                    //     }
                    // }
                },
                {
                    extend: 'excelHtml5',
                    text:'<span class="glyphicon glyphicon-export"></span>Excel',
                    className: 'btn btn-info btn-lg',
                    footer: true,
                    exportOptions: {
                        columns: [1, 2, 3],
                        format: {
                            body: function (data, row, column, node) {
                                // Strip $ from salary column to make it numeric
                                return column === 2 ?
                                    data.replace(/\<br\/\>/g, ", ") :
                                    data;
                            }
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text:'<span class="glyphicon glyphicon-export"></span>PDF',
                    className: 'btn btn-info btn-lg',
                    footer: true
                    // exportOptions: {
                    //     columns: [ 0, 1, 2, 3, 6, 7, 8],
                    //     format: {
                    //         body: function (data, row, column, node) {
                    //             // Strip $ from salary column to make it numeric
                    //             return column === 2 ?
                    //                 data.replace(/\<br\/\>/g, "\n") :
                    //                 data;
                    //         }
                    //     }
                    // }
                },
                // 'colvis'
            ],
            columns: columns,
            initComplete: function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var total = api
                    .column(1)
                    .data()
                    .reduce( function (a, b) {
                        return (intVal(a) + intVal(b));
                    }, 0 );

                var hourlyRate = $('#hourlyRate').val();

                var roleOfUser = '<?php echo $_SESSION['role'];?>';

                if(roleOfUser !== 'admin')
                {
                    $( api.column( 3 ).footer() ).html(
                        'Netto: '+(total*hourlyRate - total*hourlyRate*0.18)
                    );

                    $( api.column( 2 ).footer() ).html(
                        'Brutto: '+total*hourlyRate
                    );

                    $( api.column( 1 ).footer() ).html(
                        'Godziny: '+total
                    );
                }


            },
            "drawCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var total = api
                    .column(1,{search: 'applied'})
                    .data()
                    .reduce( function (a, b) {
                        return (intVal(a) + intVal(b));
                    }, 0 );

                var hourlyRate = $('#hourlyRate').val();

                var roleOfUser = '<?php echo $_SESSION['role'];?>';

                if(roleOfUser !== 'admin')
                {
                    $( api.column( 3 ).footer() ).html(
                        'Netto: '+(total*hourlyRate - total*hourlyRate*0.18)
                    );

                    $( api.column( 2 ).footer() ).html(
                        'Brutto: '+total*hourlyRate
                    );

                    $( api.column( 1 ).footer() ).html(
                        'Godziny: '+total
                    );
                }
            },
        });
        $("div.toolbar").html('<div class="dataTables_filter" style="float: left" ><label>Okres raportów:<input type="text" class=""  placeholder="" id="range" aria-controls="listOfExpenses"></label></div>');
        $("div.br").html('<div style="float: right">\n' +
            '                            <a href="#" data-toggle="modal" data-target="#myModal">\n' +
            '                        <button type="button" class="btn btn-primary add-new"><i class="fa fa-plus"></i> Add New\n' +
            '                        </button>\n' +
            '                    </a>' +
            '    </div><br/><br/>');

    });

    $(document).ready(function () {
        $('.daterange').daterangepicker({
            "singleDatePicker": true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            },
            "startDate": moment(),
            "endDate": moment(),
            locale : {
                    format : 'YYYY-MM-DD'
                    }
        }, function(start, end, label) {
        });
    });



    $(document).on('submit', '#addReport', function (e) {
            e.preventDefault();

            var form = $(this);

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function (data) {
                    $('#myModal').modal('toggle');
                    $('#reportTable').DataTable().ajax.reload();
                },
                error: function (data) {

                },
            });
        });

    $(document).on('click', '.addItem', function () {
        let td = $('.itemsTable tbody tr:last').children("td:first").html();
        if(td === undefined)
        {
            td = '0';
        }
        let item = parseInt(td);

        let tr = `<tr>
                    <td class="valuesIDWidth">${item + 1}</td>
                    <td class="valuesInputWidth">
                        <input type="text" class="form-control" name="completedTasks[${item}][time]">
                        <div class="invalid-feedback" id="items${item}irpfPercentageError">
                        </div>
                    </td>
                    <td class="valuesTaskWidth">
                        <input type="text" class="form-control autocomplete" name="completedTasks[${item}][task]">
                        <div class="invalid-feedback" id="items${item}irpfPercentageError">
                        </div>
                          <div class="autocomplete-suggestions">
                                <div class="autocomplete-group"><strong></strong></div>
                                <div class="autocomplete-suggestion autocomplete-selected"></div>
                                <div class="autocomplete-suggestion"></div>
                                <div class="autocomplete-suggestion"></div>
                           </div>
                    </td>
                    <td class="valueActionWidth"><button type="button"  class="btn btn-danger deleteItem">Delete</button></td>
                  </tr>`;

        let tableBody = $(".itemsTable tbody");
        tableBody.append(tr);

        $(".autocomplete").autocomplete({
            serviceUrl: window.location+'/getJSONTasks',
            onSearchComplete: function (query, suggestions) {
            },
            minLength: 1,
            onSelect: function (suggestion) {
            }
        });
    });

    $(document).on('click','.deleteItem',function () {
        $(this).closest("tr").remove();
    });



    $(document).on('click', '.edit', function () {

        var parent = $(this).parents('tr');
        var td = parent.find('td');
        var id = td[0].textContent;

        $('input[name="getId"]').val(id);

        var getID = $('input[name="getId"]').val();

        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>Report/editJSON/" + getID,
            data: '',
            success: function (data) {
                var form = JSON.parse(data).data;
                var tasks = form.tasks;
                var report = form.report;

                $('input[name="reportDate"]').val(report[0].reportDate);

                $('.itemsTable tbody').empty();


                $.each(tasks, function (index,value) {
                    let tr = ` <tr>
                                <td class="valuesIDWidth" >${index + 1}</td>
                                <td class="valuesInputWidth">
                                    <input type="text" class="form-control" value="${value.timeForTask}" name="completedTasks[${index}][time]">
                                    <div class="invalid-feedback" id="completedTasks${index}time">
                                    </div>
                                </td>
                                <td class="valuesTaskWidth" >
                                    <input type="text" class="form-control autocomplete" value="${value.name}" name="completedTasks[${index}][task]">
                                    <div class="invalid-feedback" id="completedTasks${index}task">
                                    </div>
                                    <div class="autocomplete-suggestions">
                                        <div class="autocomplete-group"><strong></strong></div>
                                        <div class="autocomplete-suggestion autocomplete-selected"></div>
                                        <div class="autocomplete-suggestion"></div>
                                        <div class="autocomplete-suggestion"></div>
                                    </div>
                                </td>
                                <td class="valueActionWidth"><button type="button"  class="btn btn-danger deleteItem">Delete</button></td>
                            </tr>`;
                    let tableBody = $(".itemsTable tbody");
                    tableBody.append(tr);

                    $(".autocomplete").autocomplete({
                        serviceUrl: window.location+'/getJSONTasks',
                        onSearchComplete: function (query, suggestions) {
                        },
                        minLength: 1,
                        onSelect: function (suggestion) {
                        }
                    });
                });
            },
            error: function (data) {

            },
        });

    });

    $(document).on('submit', '#editForm', function (e) {


        var id = $('input[name="getId"]').val();

            e.preventDefault();

            var form = $(this);

            $.ajax({
                type: 'POST',
                url: "<?php echo URL; ?>Report/edit/" + id,
                data: form.serialize(),
                success: function (data) {
                    $('#myEditModal').modal('toggle');
                    $('#reportTable').DataTable().ajax.reload();
                },
                error: function (data) {

                },
            });
        });

    $(document).on('click', '.delete', function () {

        var test = $(this).parents('tr');
        var tds = test.find('td');

        var id = tds[0].textContent;

        $('input[name="getId"]').val(id);

    });

    $(document).on('submit', '#deleteForm', function (e) {


        var id = $('input[name="getId"]').val();

        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>Report/delete/" + id,
            data: form.serialize(),
            success: function (data) {
                $('#myDeleteModal').modal('toggle');
                $('#reportTable').DataTable().ajax.reload();
            },
            error: function (data) {

            },
        });
    });
    $(document).ready(function () {
        $('#range').daterangepicker({
            "showDropdowns": true,
            "autoApply": false,
            locale: {
                format: 'YYYY-MM-DD'
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            "alwaysShowCalendars": true,
            "startDate": moment().startOf('month'),
            "endDate": moment().endOf('month')
        }, function(start, end, label) {

            var from = start.format('YYYY-MM-DD');
            var to = end.format('YYYY-MM-DD');
            var range = {'from':from,'to':to};

            $(document).off('change').on('change','input',function (e) {
                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: window.location+'/getFromRange',
                    data:range,
                    cache: false,
                    success: function (data) {
                        var newData = JSON.parse(data).data;

                        if(jQuery.isEmptyObject(newData))
                        {
                            newData = [];
                        }
                        var table;
                        if ($.fn.dataTable.isDataTable('#reportTable')) {
                            table = $('#reportTable').DataTable();
                            table.clear();
                            table.rows.add(newData).draw();
                        }
                        else {
                            table = $('#reportTable').DataTable({
                                "data": newData,
                                "deferRender": true,
                                "pageLength": 25,
                                "retrieve": true,
                            });
                        }
                    },
                    error: function (data) {
                    },
                });
            });

        });

    });

</script>


