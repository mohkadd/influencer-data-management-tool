<script>
// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
      initComplete: function () {
          var r = $('#dataTable tfoot tr');
          r.find('th').each(function(){
            $(this).css('padding', 5);
          });
          $('#dataTable thead').append(r);
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' );
                } );
            } );
        },
//        pageLength: 10,
        
        order: [[ 0, 'desc']],
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, 100, -1 ],
            [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
        ],
      buttons: [
            'pageLength',
          <?php 
          if($_SESSION['admintype'] == 3 || $_SESSION['admintype'] == 1){
              echo "
                {
        extend: 'excel',
        exportOptions: {
            columns: [ 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35 ]
          },
        text: 'Download Excel'
          }
              ";
          }
          ?>
          <?php 
          if($_SESSION['admintype'] == 2){
              echo "
                {
        extend: 'excel',
        exportOptions: {
          columns: [ 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,24,25,26,27,28,29,30,31,32,33,34,35 ]
          },
        text: 'Download Excel'
          }
              ";
          }
          ?>
        ],
      "bLengthChange": true,
    });
//   $('#dataTable').DataTable(
//       {
//         dom: 'Bfrtip',
//         buttons: [
//             'copy', 'csv', 'excel', 'pdf', 'print'
//         ]
//       });
});        
</script>