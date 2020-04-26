<!DOCTYPE html>
<html>
    <head>
        <title><?= $global_data['page_title'].' | '.$global_data['company_name']; ?></title>
        <?php $this->load->view('includes/top-header'); ?>
    </head>
    <body>
        <div id="wrapper">
            <?php $this->load->view('includes/left-menu'); ?>
            <div id="page-wrapper" class="gray-bg">
                <?php $this->load->view('includes/top-navbar'); ?>
                <div class="wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $global_data['page_title']; ?></h5>
                                    <a href="<?= base_url(''); ?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Add Invoice</a>
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-Total">
                                            <thead>
                                                <tr>
                                                    <th>Invoice No</th>
                                                    <th>Invoice Date</th>
                                                    <th>Customer Name</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(is_array($invoice)){
                                                    $counter = 0;
                                                    foreach($invoice as $row){
                                                ?>
                                                <tr>
                                                    <td><?= $row['invoiceNumber']; ?></td>
                                                    <td><span class="hidden"><?= date('YmdHis', strtotime($row['invoiceDate'])); ?></span><?= date('d.m.Y', strtotime($row['invoiceDate'])); ?></td>
                                                    <td><?= $row['partyName']; ?></td>
                                                    <td><?= number_format($row['totalAmount'],2); ?></td>
                                                    <td>
                                                        <a href="<?= base_url('Invoice/Edit/'.$row['invoiceId']); ?>" data-toggle="tooltip" data-placement="top" data-original-title="Edit" class="btn btn-success btn-xs no-margins"><i class="fa fa-pencil-square-o"></i></a>
                                                        <a href="#" onclick="doaction('Invoice','Delete', <?= $row['invoiceId']; ?>)" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-danger btn-xs no-margins"><i class="fa fa-trash"></i></a>
                                                        <a href="<?= base_url('Invoice/Print_page/'.$row['invoiceId']); ?>" target="_blank"  data-toggle="tooltip" data-placement="top" data-original-title="Print" class="btn btn-primary btn-xs no-margins"><i class="fa fa-print"></i></a>
                                                    </td>
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                            <tfoot>
                                                <th>Invoice No</th>
                                                <th>Invoice Date</th>
                                                <th>Customer Name</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer -->
                <?php $this->load->view('includes/footer'); ?>
            </div>
        </div>
        <?php $this->load->view('includes/bot-footer'); ?>
        <script>
            $('.dataTables-Total').DataTable({
                pageLength: 25,
                responsive: true,
                stateSave: true,
                dom: '<"html5buttons"B>lTfgitp', 
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel'},
                    {extend: 'pdf'},
                    {extend: 'print',
                     customize: function (win){
                         $(win.document.body).addClass('white-bg');
                         $(win.document.body).css('font-size', '10px');

                         $(win.document.body).find('table')
                             .addClass('compact')
                             .css('font-size', 'inherit');
                     }
                    }
                ],
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                    };
                    for(count = 3; count < data[0].length-1; count++){
                        // Total over all pages
                        total = api
                            .column( count )
                            .data()
                            .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                        // Total over this page
                        pageTotal = api
                            .column( count, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                        // Update footer
                        $( api.column( count ).footer() ).html(
                            ''+pageTotal.toFixed(2)
                        );
                    }
                }
            });
        </script>
    </body>
</html>