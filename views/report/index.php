
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Reports <b>List</b></h2></div>
                <div class="col-sm-4">
                    <label>Raporty pomiędzy</label>
                    <input type="text" class="form-control float-right"  placeholder="" id="range" aria-controls="reportTable">
                    <a href="#" data-toggle="modal" data-target="#myModal">
                        <button type="button" class="btn btn-primary add-new"><i class="fa fa-plus"></i> Add New
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <table id="reportTable" style="width: 100%" class="table table-striped table-bordered" >

            <thead>
            <tr>
                <?php if ($_SESSION['role'] == 'admin') : ?>
                    <th>ReportId</th>
                    <th>Content</th>
                    <th>Userid</th>
                    <th>Login</th>
                    <th>CreatedAt</th>
                    <th>Action</th>

                <?php else: ?>
                    <th>ID</th>
                    <th>Zadania</th>
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
                            <table id="itemsTable" class="table table-bordered">
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
    <div class="modal-dialog">
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
                        <label class="text-white" for="Report">Report</label>
                        <textarea id="textarea1" class="form-control" name="content" rows="8"></textarea>
                        <div class="invalid-feedback" id="contentEditError">
                        </div>
                        <input type="hidden" id="button1">
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

                        <input type="hidden" id="button2"/>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <input type="submit" value="DELETE" id="deleteModalButton" class="btn btn-danger">
            </div>
            </form>
        </div>
    </div>

</div>


<script type="text/javascript">

    $(document).ready(function () {
        var role = '<?php echo $_SESSION['role'];?>';
        var columns = [{"data": "reportid"},
                       {"data": "tasks"},
                       {"data": "numberOfHours"},

        ];
        if (role === 'admin') {
            columns.push({"data": "userid"});
            columns.push({"data": "login"});
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

            columns: columns,
            "drawCallback": function ( row, data, start, end, display ) {

            },
        });


    });

    // $.fn.myfunction = function () {
    //     $('.daterange').daterangepicker({
    //         timePicker : true,
    //         timePicker24Hour : true,
    //         timePickerIncrement : 1,
    //         timePickerSeconds : false,
    //         locale : {
    //             format : 'HH:mm'
    //         }
    //     }).on('show.daterangepicker', function(ev, picker) {
    //         picker.container.find(".calendar-table").hide();
    //     });
    // };
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
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    });



    $(document).on('submit', '#addReport', function () {
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
        let td = $('#itemsTable tbody tr:last').children("td:first").html();
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

        let tableBody = $("#itemsTable tbody");
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

        var test = $(this).parents('tr');
        var tds = test.find('td');
        var id = tds[0].textContent;
        var content = tds[1].textContent;

        $('#button1').val(id);
        $('#textarea1').val(content);

    });

    $(document).on('click', '#saveModalButton', function () {

        var frm = $('#myEditModal');

        var content = $('textarea#textarea1').val();

        var id = $('input#button1').val();



        frm.submit(function (e) {

            e.preventDefault();


            $.ajax({
                type: 'POST',
                url: "<?php echo URL; ?>report/edit/" + id,
                data: {
                    'content': content
                },
                success: function (data) {
                    $('#myEditModal').modal('toggle');
                    $('#reportTable').DataTable().ajax.reload();
                },
                error: function (data) {
                    var error = JSON.parse(data.responseText);
                    var errors = error.errors;
                    var contentError = errors.content;

                    $.each(errors, function (index, value) {

                        $('textarea[name="' + index + '"]').addClass("is-invalid");

                        $('#' + index + "EditError").html(value);
                    });

                    if(contentError === undefined)
                    {
                        $('textarea[name="content"]').removeClass("is-invalid");
                    }
                },
            });


        });


    });

    $(document).on('click', '.delete', function () {

        var test = $(this).parents('tr');
        var tds = test.find('td');

        var id = tds[0].textContent;

        $('#button2').val(id);

    });

    $(document).on('click', '#deleteModalButton',
        function () {

            var frm = $('#myDeleteModal');


            var id = $('input#button2').val();


            frm.submit(function (e) {

                e.preventDefault();


                $.ajax({
                    type: 'POST',
                    url: "<?php echo URL; ?>report/delete/" + id,
                    data: '',
                    success: function (data) {
                        $('#myDeleteModal').modal('toggle');
                        $('#reportTable').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        console.log('An error occurred.');
                        console.log(data);
                    },
                });


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
        }, function(start, end, label) {

            var from = start.format('YYYY-MM-DD');
            var to = end.format('YYYY-MM-DD');
            var range = {'from':from,'to':to};

            $.ajax({
                type: "GET",
                url: window.location+'/getFromRange',
                data:range,
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


</script>


