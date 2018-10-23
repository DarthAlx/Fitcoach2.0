function fnFormatDetails ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
    sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
    sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table').dataTable( {
        stateSave: true,
        "aaSorting": [[ 0, "desc" ]]
    } );
    $('#dynamic-table2').dataTable( {
        stateSave: true,
        "aaSorting": [[ 0, "desc" ]]
    } );
    $('.dynamic-table3').dataTable( {
        stateSave: true,
        "aaSorting": [[ 0, "desc" ]]
    } );
    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    /*nCloneTd.innerHTML = '<img src="images/details_open.png">';*/
    nCloneTd.innerHTML = '<img src="">';
    nCloneTd.className = "center";

    $('#hidden-table-info thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

    $('#hidden-table-info tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#hidden-table-info').dataTable( {
        stateSave: true,
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[0, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $(document).on('click','#hidden-table-info tbody td img',function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            /*this.src = "images/details_open.png";*/
            this.src = "";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
    } );

    $("#coachNuevo").change(function() {
        var coachId = $(this).val();
        $.get("/admin-condominio/clasesdeinstructor/"+coachId,
            function(data){
                var select = $('#clases_idNuevo').empty();
                select.append( '<option value="">Selecciona una clase</option>' );
                for(var i = 0;i< data.length;i++){
                    select.append( '<option value="'
                        + data[i].id
                        + '">'
                        + data[i].nombre
                        + '</option>' );
                }
            }, "json");
    });
    $(".select-coach").change(function() {
        var coachId = $(this).val();
        $.get("/admin-condominio/clasesdeinstructor/"+coachId,
            function(data){
                var select = $('.select-class').empty();
                select.append( '<option value="">Selecciona una clase</option>' );
                for(var i = 0;i< data.length;i++){
                    select.append( '<option value="'
                        + data[i].id
                        + '">'
                        + data[i].nombre
                        + '</option>' );
                }
            }, "json");
    });



} );
