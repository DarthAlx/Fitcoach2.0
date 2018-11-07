function fnFormatDetails(oTable, nTr) {
    var aData = oTable.fnGetData(nTr);
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
    sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
    sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function () {

    $('#dynamic-table').dataTable({
        stateSave: true,
        "aaSorting": [[0, "desc"]]
    });
    $('#dynamic-table2').dataTable({
        stateSave: true,
        "aaSorting": [[0, "desc"]]
    });
    $('.dynamic-table3').dataTable({
        stateSave: true,
        "aaSorting": [[0, "desc"]]
    });
    $('.dynamic-table4').dataTable({
        stateSave: true,
        "ordering": false,
        aaSorting: []
    });
    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement('th');
    var nCloneTd = document.createElement('td');
    /*nCloneTd.innerHTML = '<img src="images/details_open.png">';*/
    nCloneTd.innerHTML = '<img src="">';
    nCloneTd.className = "center";

    $('#hidden-table-info thead tr').each(function () {
        this.insertBefore(nCloneTh, this.childNodes[0]);
    });

    $('#hidden-table-info tbody tr').each(function () {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
    });

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#hidden-table-info').dataTable({
        stateSave: true,
        "aoColumnDefs": [
            {"bSortable": false, "aTargets": [0]}
        ],
        "aaSorting": [[0, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $(document).on('click', '#hidden-table-info tbody td img', function () {
        var nTr = $(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr)) {
            /* This row is already open - close it */
            /*this.src = "images/details_open.png";*/
            this.src = "";
            oTable.fnClose(nTr);
        }
        else {
            /* Open this row */
            this.src = "images/details_close.png";
            oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        }
    });

    $("#coachNuevo").change(function () {
        var coachId = $(this).val();
        $.get("/admin-condominio/clasesdeinstructor/" + coachId,
            function (data) {
                var select = $('#clases_idNuevo').empty();
                select.append('<option value="">Selecciona una clase</option>');
                for (var i = 0; i < data.length; i++) {
                    select.append('<option value="'
                        + data[i].id
                        + '">'
                        + data[i].nombre
                        + '</option>');
                }
            }, "json");
    });
    $(".select-coach").change(function () {
        var coachId = $(this).val();
        $.get("/admin-condominio/clasesdeinstructor/" + coachId,
            function (data) {
                var select = $('.select-class').empty();
                select.append('<option value="">Selecciona una clase</option>');
                for (var i = 0; i < data.length; i++) {
                    select.append('<option value="'
                        + data[i].id
                        + '">'
                        + data[i].nombre
                        + '</option>');
                }
            }, "json");
    });
    $(".add-child-form").hide();
    $(".add-adult-form-1").hide();
    $(".add-adult-form-2").hide();
    $(".add-child").click(function () {
        $(".buttons-select").hide();
        $(".add-child-form").show();
    })

    $(".add-person").click(function () {
        $(".buttons-select").hide();
        $(".add-adult-form-1").show();
    })
    $(".add-adult-form").submit(function (e) {
        e.preventDefault();
        var value = $(this).serializeArray();
        var tel = value[0]['value'];
        $.get("/busquedaporcelular?tel=" + tel,
            function (data) {
                $(".add-adult-form-1").hide();
                if (data['name']) {
                    $('.add-adult-form-2').show();
                    $(".add-adult-form-nombre").val(data['name']);
                    $(".add-adult-form-email").val(data['email']);
                    $(".add-adult-form-telefono").val(data['tel']);
                    $(".add-adult-form-genero").val(data['genero']);

                    $(".add-adult-form-nombre").attr('readonly', true);
                    $(".add-adult-form-email").attr('readonly', true);
                    $(".add-adult-form-telefono").attr('readonly', true);
                    $(".add-adult-form-genero").attr('readonly', true);

                } else {
                    $('.add-adult-form-2').show();
                    $(".add-adult-form-telefono").attr('readonly', true);
                    $(".add-adult-form-telefono").val(tel);

                }
            }, "json");
    });


    $("#report_type").change(function () {
        var type = $(this).val();
        $("#condominio_id").hide();
        $("#clase_id").hide();
        $("#coach_id").hide();
        $("#client_id").hide();
        $("#type_id").hide();
        switch (type) {
            case '2':
                $("#type_id").show();
                break;
            case '6':
            case '7':
            case '10':
            case '14':
                $("#condominio_id").show();
                break;
            case '8':
                $("#type_id").show();
                break;
            case '9':
                $("#coach_id").show();
                break;
            case '12':
                $("#coach_id").show();
                break;
            case '13':
                $("#client_id").show();
                break;
        }
    });

    $('.btn-crear-grupo').click(function () {
        $('#admin-condominios-grupos').modal('hide')
        setTimeout(function () {
            $('#crear-grupo').modal('show');
        }, 500)
        //
    })
    $('.eliminar-grupo').click(function () {
        var id = $(this).attr("data-id");
        $('#admin-condominios-grupos').modal('hide');
        setTimeout(function () {
            $('#modal-eliminar-grupo' + id).modal('show');
        }, 500)
        //
    });
    $('.ver-grupo').click(function () {
        var id = $(this).attr("data-id");
        window.sessionStorage['GRUPO_ID'] = id;
        $('#admin-condominios-grupos').modal('hide')
        setTimeout(function () {
            $('#admin-condominios-grupos-ver' + id).modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        }, 500)
        //
    })

    $('.btn-crear-horario').click(function () {
        var id = $(this).attr("data-id");
        $('#admin-condominios-grupos-ver' + id).modal('hide');
        setTimeout(function () {
            $('#admin-condominios-grupos-crear' + id).modal('show');
        }, 500)
        //
    })
    $('.btn-actualizar-grupo').click(function () {
        var id = $(this).attr("data-id");
        $('#admin-condominios-grupos-ver' + id).modal('hide');
        setTimeout(function () {
            $('#admin-condominios-grupos-actualizar' + id).modal('show');
        }, 500)
        //
    })
    $('.btn-actualizar-grupo').click(function () {
        var id = $(this).attr("data-id");
        $('#admin-condominios-grupos-ver' + id).modal('hide');
        setTimeout(function () {
            $('#admin-condominios-grupos-actualizar' + id).modal('show');
        }, 500)
        //
    });

    clasesseleccionadas = 0;

    function agregaracarrito(valor, valor2, valor3) {
        if (document.getElementById('carrito' + valor).checked) {
            document.getElementById('carrito' + valor).checked = false;
            $('#carrito' + valor).removeClass('seleccionada');
            $('.fa' + valor).removeClass('fa-square');
            $('.fa' + valor).addClass('fa-square-o');
            if (clasesseleccionadas > 0) {
                clasesseleccionadas--;
            }
            $('#cantidad' + valor3).val(clasesseleccionadas);
            $('#clasesseleccionadas' + valor3).html(clasesseleccionadas + " clases seleccionadas.");
            if (clasesseleccionadas <= 0) {
                $('#reservar' + valor3).prop("disabled", true);
            }
        }
        else {
            document.getElementById('carrito' + valor).checked = true;
            $('#carrito' + valor).addClass('seleccionada');
            $('.fa' + valor).removeClass('fa-square-o');
            $('.fa' + valor).addClass('fa-square');
            clasesseleccionadas++;
            $('#cantidad' + valor3).val(clasesseleccionadas);
            $('#clasesseleccionadas' + valor3).html(clasesseleccionadas + " clases seleccionadas.");
            $('#reservar' + valor3).prop("disabled", false);
        }
    }

    function acero() {
        clasesseleccionadas = 0;
        $('.clasesseleccionadas').html("0 clases seleccionadas.");
        $('.faselect').removeClass('fa-square');
        $('.faselect').removeClass('fa-square-o');
        $('.faselect').addClass('fa-square-o');
        document.getElementsByClassName('carritocheck').checked = false;
    }

    if (window.sessionStorage['GRUPO_ID']) {
        var grupoId = window.sessionStorage['GRUPO_ID'];
        if ($('#admin-condominios-grupos-ver' + grupoId) != null) {
            $('#admin-condominios-grupos-ver' + grupoId).modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });

        }
    }
    $('.close-modal-horarios').click(function () {
        var id = $(this).attr("data-id");
        $('#admin-condominios-grupos-ver' + id).modal('hide');
        delete window.sessionStorage['GRUPO_ID'];
    })
    $('.nomina-metodo-pago').change(function () {
        $('.nomina-deducciones').hide();
        $('.nomina-iva').hide();
        $('.nomina-factura').hide();
        var val = $(this).val();
        if (val == 'Transferencia') {
            $('.nomina-iva').show();
            $('.nomina-factura').show();
        } else if (val == 'Asimilados') {
            $('.nomina-deducciones').show();
        }
    })
});
