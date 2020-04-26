<!DOCTYPE html>
<html>
    <head>
        <title><?= $global_data['page_title'].' | '.$global_data['company_name']; ?></title>
        <?php $this->load->view('includes/top-header'); ?>
    </head>
    <body class="pace-done mini-navbar">
        <div id="wrapper">
            <?php $this->load->view('includes/left-menu'); ?>
            <div id="page-wrapper" class="gray-bg">
                <?php $this->load->view('includes/top-navbar'); ?>
                <div class="wrapper wrapper-content">
                    <form class="form-horizontal form-custom" method="post" id="form">
                        <input type="hidden" name="invoiceId" value="<?= $invoice_detail->invoiceId; ?>" />
                        <input type="hidden" name="itemCount" value="<?= COUNT($invoice_detail->OrderItems); ?>" disabled>
                        <input type="hidden" name="partyId" value="<?= $invoice_detail->partyId; ?>" >
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="ibox">
                                    <div class="ibox-title">
                                        <h5><?= $global_data['page_title']; ?></h5>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="form-group row"> 
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="hidden" name="pageType" >
                                                    <span class="input-group-addon">Invoice No <span class="text-danger">*</span></span>
                                                    <input type="text" name="OD_No" class="form-control form-control-sm" value="<?= $invoice_detail->invoiceNumber; ?>" required >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Invoice Date <span class="text-danger">*</span></span>
                                                    <input type="text" name="OD_Date" class="form-control form-control-sm date" value="<?= date('d-m-Y', strtotime($invoice_detail->invoiceDate)); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Customer/Firm Name <span class="text-danger">*</span></span>
                                                    <input autocomplete="new-password" type="text" name="OD_CustomerName" class="form-control form-control-sm getCustomers hindi" value="<?= $invoice_detail->partyName; ?>" placeholder="Enter Customer/Firm Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Mobile Number </span>
                                                    <input type="text" name="OD_MobileNo" class="form-control form-control-sm" placeholder="Enter Customer/Firm Mobile Number" value="<?= $invoice_detail->phone; ?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">City</span>
                                                    <input type="text" name="OD_City" class="form-control form-control-sm" placeholder="Enter Customer/Firm Address" value="<?= $invoice_detail->city; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Email</span>
                                                    <input type="text" name="OD_Email" class="form-control form-control-sm" placeholder="Enter Customer/Firm Email" value="<?= $invoice_detail->email; ?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Address</span>
                                                    <input type="text" name="OD_Address" class="form-control form-control-sm" placeholder="Enter Customer/Firm Address" value="<?= $invoice_detail->address; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div>
                                                    <table class="table table-bordered table-min-pad inventory">
                                                        <thead>
                                                            <th class="text-center" width="2%">S.No</th>
                                                            <th class="text-center" width="2%"></th>
                                                            <th class="text-center" width="15%">Product Name</th>
                                                            <th class="text-center" width="10%">Unit</th>
                                                            <th class="text-center" width="8%">Qty</th>
                                                            <th class="text-center" width="10%">Price</th>
                                                            <th class="text-center" width="10%">Item Discount</th>
                                                            <th class="text-center" width="10%">Amount</th>
                                                            <th class="text-center" width="1%"></th>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $i = 1;
                                                            foreach($invoice_detail->OrderItems as $OrderItem){
                                                            ?>
                                                            <tr>
                                                                <input type="hidden" name="OI_ID[]" value="<?= $OrderItem['invoiceItemId']; ?>" />
                                                                <td class="text-center" valign="middle"><?= $i; ?>.</td>
                                                                 <td class="text-center"><div class="i-checks"> <input type="checkbox" value=""></div></td>
                                                                <td>
                                                                    <select name="PD_IDs[]" id="PD_IDs<?= $i; ?>" class="form-control form-control-sm chosen-select no-borders item" data-placeholder="Choose a Product...">
                                                                        <option value=""></option>
                                                                        <?php foreach($products as $product) { ?>
                                                                        <option value="<?= $product['productId']; ?>" data-U_ID="<?= $product['unitId']; ?>" data-PD_Rate="<?= $product['productRate']; ?>" <?= ($OrderItem['productId'] == $product['productId'] ? 'selected' : ''); ?> ><?= $product['productName']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="U_IDs[]" class="form-control form-control-sm chosen-select no-borders" data-placeholder="Choose a Unit...">
                                                                        <option value=""></option>
                                                                        <?php foreach($units as $unit) { ?>
                                                                        <option value="<?= $unit['unitId']; ?>" <?= ($OrderItem['unitId'] == $unit['unitId'] ? 'selected' : ''); ?> ><?= $unit['unitName']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="number" min="0" step="0.001" name="qty[]" id="qty<?= $i; ?>" class="form-control form-control-sm no-borders text-center quantity" onchange="totalcal_final();" value="<?= $OrderItem['quantity']; ?>" >
                                                                </td>
                                                                <td>
                                                                    <input type="number" min="0" step="0.001" name="price[]" id="price<?= $i; ?>" class="form-control form-control-sm no-borders text-center" onchange="totalcal_final();" value="<?= $OrderItem['itemRate']; ?>" >
                                                                </td>
                                                                <td>
                                                                    <input type="text"  name="item_discount[]" data-type="item_discount" id="item_discount<?= $i; ?>" class="form-control form-control-sm no-borders text-center calper"  value="<?= $OrderItem['itemDiscount']; ?>" onchange="totalcal();">
                                                                </td>
                                                                <td>
                                                                    <input type="number" min="0" step="0.001" name="amount[]" id="amount<?= $i; ?>" class="form-control form-control-sm no-borders text-center" value="" readonly />
                                                                </td>
                                                                <td>
                                                                    <button class="form-control form-control-sm no-borders btn btn-danger btn-circle removeTr" type="button"><i class="fa fa-minus"></i></button>
                                                                </td>
                                                            </tr>
                                                            <?php $i++; } ?>
                                                        </tbody>
                                                    </table>
                                                    <button class="btn btn-primary btn-circle add" type="button"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Invoice Summary</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="form-group row"> 
                                            <table class="table table-bordered table-min-pad otherCharges1">
                                                <thead>
                                                    <th class="text-center" width="40%">Type</th>
                                                    <th class="text-center" width="20%">%</th>
                                                    <th class="text-center" width="40%">Value</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>Order Amount</th>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm no-borders text-right" value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" min="0" step="0.01" name="totalAmount" class="form-control form-control-sm no-borders text-right" value="0" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount</th>
                                                        <td>
                                                            <input type="number" min="0" step="0.01" name="discount_per" class="form-control form-control-sm no-borders text-right" value="<?= $invoice_detail->invoiceDiscount['Percentage']; ?>" onchange="discountper();">
                                                        </td>
                                                        <td>
                                                            <input type="number" min="0" step="0.01" name="discount_val" class="form-control form-control-sm no-borders text-right" value="<?= $invoice_detail->invoiceDiscount['Amount']; ?>" onchange="discountcal1();">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Net Amount</th>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm no-borders text-right" value="0" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="taxableAmt" class="form-control form-control-sm no-borders text-right" value="0" readonly>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <table class="table table-bordered table-min-pad additional_charges">
                                                <tbody>
                                                    <tr class="packing_charges">
                                                        <th>Packing Charges</th>
                                                        <td width="20%"><input type="number" step="0.01" name="packing_charge_per" id="packing_charge_per" class="form-control form-control-sm no-borders text-right no-padding" value="<?= $invoice_detail->packingCharge['Percentage']; ?>"onchange="calper('1');"></td>
                                                        <td width="40%"><input type="number" step="0.01" name="packing_charge_val" class="form-control form-control-sm no-borders text-right no-padding" value="<?= $invoice_detail->packingCharge['Amount']; ?>" onchange="calper2('1');" ></td>
                                                    </tr>
                                                    <tr class="transportation_charges">
                                                        <th>Transport Charges</th>
                                                        <td width="20%"><input type="number" step="0.01" name="transport_charge_per" id="transport_charge_per" class="form-control form-control-sm no-borders text-right no-padding" value="<?= $invoice_detail->transportCharge['Percentage']; ?>" onchange="calper('2');"></td>
                                                        <td width="40%"><input type="number" step="0.01" name="transport_charge_val" class="form-control form-control-sm no-borders text-right no-padding" value="<?= $invoice_detail->transportCharge['Amount']; ?>" onchange="calper2('2');" >
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Invoice Amount</th>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm no-borders text-right" value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="Net_Amount" class="form-control form-control-sm no-borders text-right" value="0" onchange="totalcal();" readonly>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <!--<a href="#" class="btn btn-primary btn-xs float-right addCharges">Add Charges</a>-->
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3 offset-3">
                                                <button  type="submit" onclick="Print();" class="ladda-button btn btn-success no-margins float-right" data-style="slide-left">Print</button>
                                            </div>
                                            <div class="col-md-3 offset-1">
                                                <button type="submit" onclick="Update();" class="ladda-button btn btn-primary no-margins float-right" data-style="slide-left">Update</button>
                                            </div>   
                                        </div>
                                    </div>
                                </div>

                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Remark</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <textarea class="hindi" name="remark" id="remark" cols="38" rows="4.9"><?= $invoice_detail->remark ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php $this->load->view('includes/footer'); ?>
            </div>
        </div> <?php $this->load->view('includes/bot-footer'); ?>
        <script>
            $(document).ready(function() {
                Layout.chosen_select();
                Layout.scroll_content();
                Layout.date();
                $(window).on('load', function() {
                    totalcal_final();
                });
            });
            var	customers = [];
            $.get('<?= base_url('Invoice/Customer1'); ?>', function(data){
                data = JSON.parse(data);
                $.each(data, function(key,value){
                    customers.push(value);
                });
                $('.getCustomers').typeahead({
                    source: customers
                });
            });

            $('input[name=OD_CustomerName]').on('change', function(event){
                var name = $(this).val();
                for(var $i=0; $i< customers.length; $i++){
                    if(customers[$i].name == name){
                        $('input[name=OD_MobileNo]').val(customers[$i].phone);
                        $('input[name=OD_Email]').val(customers[$i].email);
                        $('input[name=OD_Address]').val(customers[$i].address);
                        $('input[name=OD_City]').val(customers[$i].city);
                        $('input[name=partyId]').val(customers[$i].partyId);
                        break;
                    } else {
                        $('input[name=OD_MobileNo]').val('');
                        $('input[name=OD_Email]').val('');
                        $('input[name=OD_Address]').val('');
                        $('input[name=OD_City]').val('');
                        $('input[name=partyId]').val('');
                    }
                }
            });


            function totalcal(){
                var totalAmount = 0, j=1;
                for(a = document.querySelectorAll('table.inventory tbody tr'),i = 0 ; a [i] ; ++i){
                    cells = a[i].querySelectorAll('input');
                    console.log(cells);
                    qty = cells[4].value;
                    console.log(qty);
                    if(qty > 0){
                        price = parseFloat(cells[5].value)-parseFloat(cells[6].value);+3
                        amount = parseFloat(qty) * parseFloat(price);
                        checkAmount(amount);
                        Amount = parseFloat(amount);
                        cells[parseFloat(cells.length)-1].value = parseFloat(Amount).toFixed(2);
                        totalAmount = parseFloat(totalAmount) + parseFloat(Amount);
                    }
                }
                $('input[name=totalAmount]').val(parseFloat(totalAmount).toFixed(2));
                totalAmount = $('input[name=totalAmount]').val();
                discount_val = $('input[name=discount_val]').val();
                $('input[name=discount_val]').val(parseFloat(discount_val).toFixed(2));
                totalAmount = parseFloat(totalAmount) - parseFloat(discount_val);
                $('input[name=taxableAmt]').val(parseFloat(totalAmount).toFixed(2));
            }
            function discountcal1(){
                totalAmount = $('input[name=totalAmount]').val();
                discount_val = $('input[name=discount_val]').val();
                discount_per = parseFloat(discount_val) / parseFloat(totalAmount)*100;
                $('input[name=discount_per]').val(parseFloat(discount_per).toFixed(2));
                totalcal();
            }

            function discountper(){
                totalAmount = $('input[name=totalAmount]').val();
                discount_per = $('input[name=discount_per]').val();
                discount_val = parseFloat(totalAmount) * parseFloat(discount_per)/100;
                $('input[name=discount_val]').val(parseFloat(discount_val).toFixed(2));
            }
            function totalcal_final(){
                totalcal();
                NetAmt = $('input[name=taxableAmt]').val();
                packingCharge= $("input[name='packing_charge_val']").val();
                transportCharge= $("input[name='transport_charge_val']").val();
                NetAmt = parseFloat(NetAmt) + parseFloat(packingCharge);
                NetAmt = parseFloat(NetAmt) + parseFloat(transportCharge);
                NetAmt= Math.round(NetAmt);
                $('input[name=Net_Amount]').val(parseFloat(NetAmt).toFixed(2));
            }
            $('.calper').on('change', function(event){
                var format = /%/;
                var input_val = $(this).val();
                var get_type = $(this).attr('data-type');
                if(get_type == 'item_discount'){
                    var item_rate_input = $(this).closest('td').prev('td').find('input');
                    var item_rate = item_rate_input.val();
                    if(format.test(input_val)){
                        item_rate1 =  parseFloat(item_rate) * parseFloat(input_val)/100;
                        $(this).val(parseFloat(item_rate1).toFixed(2));
                    } 
                } 
                totalcal();
            });

            function calper(val){
                taxableAmt = $('input[name=taxableAmt]').val();
                taxableAmt1 = $('input[name=taxableAmt]').val();
                var b=0, i=0, k=0;
                for(b = document.querySelectorAll('table.additional_charges tbody tr'),i = 0 ; b [i] ; ++i){
                    k++;
                    cells1 = b[i].querySelectorAll('input');
                    var input_nature = $('option:selected', '#invoice_input'+k).attr('data-Nature');
                    if(cells1[1].value <= 0 || val == k){
                        temp_amt = parseFloat(taxableAmt) * parseFloat(cells1[0].value)/100;
                        cells1[1].value = parseFloat(temp_amt).toFixed(2);
                        console.log(cells1[1].value);
                    } else {
                        temp_amt = parseFloat(cells1[0].value);
                    }
                    $('input[name=Net_Amount]').val(parseFloat(taxableAmt).toFixed(2));
                }
            }
            function calper2(val){
                taxableAmt = $('input[name=taxableAmt]').val();
                packing_charge_val = $('input[name=packing_charge_val]').val();
                packing_charge_per = parseFloat(packing_charge_val) / parseFloat(taxableAmt)*100;
                $('input[name=packing_charge_per]').val(parseFloat(packing_charge_per).toFixed(2));
                transport_charge_val = $('input[name=transport_charge_val]').val();
                transport_charge_per = parseFloat(transport_charge_val) / parseFloat(taxableAmt)*100;
                $('input[name=transport_charge_per]').val(parseFloat(transport_charge_per).toFixed(2));
                totalcal_final();
            }
            $('.item').on('change', function(event){
                var tr = $(this).closest('tr');
                var U_ID = $('option:selected',this).attr('data-U_ID');
                var PD_Rate = $('option:selected',this).attr('data-PD_Rate');
                tr.find("input[name='price[]']").val(PD_Rate);
                tr.find("select[name='U_IDs[]'] option[value="+U_ID+"]").attr('selected', true);
                tr.find("select[name='U_IDs[]']").trigger('chosen:updated');
                totalcal_final();
            });

            $('.quantity').on('change', function(event){
                if($(this).val() > 0){
                    var tr = $(this).closest('tr');
                    var itemval = tr.find("option:selected", "select[name='PD_IDs[]']").val();
                    if(itemval == ''){
                        swal("Warning!", "Please Select Product.", "error");
                        $(this).val('0');
                    }
                }
                if($(this).val() < 0){  
                    swal("Warning!", "Quantity cannot be Negative", "error");
                    $(this).val('0');
                }
            });
            function checkAmount(amount){
                if(amount < 0){
                    swal("Warning!", "Amount is in Negative Figure", "error");
                }
            }

            $('.removeTr').click(function(event){
                var tr = $(this).closest('tr');
                tr.remove();
                var TableLength = $('table.inventory tbody tr').length;
                if(TableLength > 0){
                    for($tableCount=1;$tableCount<=TableLength;$tableCount++){
                        $('table.inventory tbody tr:nth-child('+$tableCount+') td:first-child').html($tableCount);
                    }
                }
                totalcal_final();
            }); 
            i=5;
            $('.add').click(function(event){
                document.querySelector('table.inventory tbody').appendChild(generateTableRow(++i));
                Layout.chosen_select();
                $('.item').on('change', function(event){
                    var tr = $(this).closest('tr');
                    var U_ID = $('option:selected',this).attr('data-U_ID');
                    var PD_Rate = $('option:selected',this).attr('data-PD_Rate');
                    tr.find("input[name='price[]']").val(PD_Rate);
                    tr.find("select[name='U_IDs[]'] option[value="+U_ID+"]").attr('selected', true);
                    tr.find("select[name='U_IDs[]']").trigger('chosen:updated');
                    totalcal();
                });
                $('.removeTr').click(function(event){
                    var tr = $(this).closest('tr');
                    tr.remove();
                    var TableLength = $('table.inventory tbody tr').length;
                    if(TableLength > 0){
                        for($tableCount=1;$tableCount<=TableLength;$tableCount++){
                            $('table.inventory tbody tr:nth-child('+$tableCount+') td:first-child').html($tableCount);
                        }
                    }
                    totalcal_final();
                }); 

                $('.quantity').on('change', function(event){
                    if($(this).val() > 0){
                        var tr = $(this).closest('tr');
                        var itemval = tr.find("option:selected", "select[name='PD_IDs[]']").val();
                        if(itemval == ''){
                            swal("Warning!", "Please Select Product.", "error");
                            $(this).val('0');
                        }
                    }
                    if($(this).val() < 0){  
                        swal("Warning!", "Quantity cannot be Negative", "error");
                        $(this).val('0');
                    }
                });
            });


            function generateTableRow(countId){
                n = countId;				
                var emptyColumn = document.createElement('tr');
                emptyColumn.innerHTML = '<input type="hidden" /><td class="text-center" valign="middle">'+n+'.</td>  <td class="text-center"><div class="i-checks"> <input type="checkbox" value=""></div></td> <td> <select name="PD_IDs[]" class="form-control form-control-sm chosen-select no-borders item" data-placeholder="Choose a Product..." required> <option value=""></option> <?php foreach($products as $product) { ?> <option value="<?= $product['productId']; ?>" data-U_ID="<?= $product['unitId']; ?>" data-PD_Rate="<?= $product['productRate']; ?>"><?= $product['productName']; ?></option> <?php } ?> </select> </td><td> <select name="U_IDs[]" class="form-control form-control-sm chosen-select no-borders"  data-placeholder="Choose a Unit..." required> <option value=""></option> <?php foreach($units as $unit) { ?> <option value="<?= $unit['unitId']; ?>"><?= $unit['unitName']; ?></option> <?php } ?> </select> </td> <td> <input type="number" min="0" step="0.01" id="qty'+n+'" name="qty[]" class="form-control form-control-sm no-borders text-center quantity" value="0" onchange="totalcal();"></td><td><input type="number" min="0" step="0.001" name="price[]" id="price'+n+'" class="form-control form-control-sm no-borders text-center" value="0" onchange="totalcal();"> </td> <td> <input type="text"  name="item_discount[]" data-type="item_discount" id="item_discount'+n+'" class="form-control form-control-sm no-borders text-center calper" value="0" onchange="totalcal();"> </td> <td> <input type="number" min="0" step="0.01" name="amount[]" class="form-control form-control-sm no-borders text-center" value="0" readonly> </td><td><button class="form-control form-control-sm no-borders btn btn-danger btn-circle removeTr" type="button"><i class="fa fa-minus"></i></button></td>';
                return emptyColumn;
            }

            function Update(){
                var isValidForm = document.forms['form'].checkValidity();
                if (!isValidForm)
                {
                    return false;
                }
                totalcal_final();
                var l = $('.ladda-button-demo').ladda();
                l.ladda( 'start' );
                event.preventDefault();
                if($('input[name=Net_Amount]').val() <= 0 || $('input[name=totalAmount]').val() <= 0 || $('input[name=taxableAmt]').val() <= 0){
                    swal("Warning!", "Amount is Invalid", "error");
                } else{
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to update this Order?",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonText: "Yes, Update it!",
                        cancelButtonText: "Cancel!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, function (isConfirm) {
                        if (isConfirm){		
                            $.post('<?= base_url('Invoice/update_submit'); ?>',$('#form').serialize(),function(response){
                                l.ladda('stop');
                                res = JSON.parse(response);
                                if(res.status == 'success'){
                                    swal("Updated!", res.msg, "success");
                                    setTimeout(function(){ window.location = "<?= base_url('Invoice'); ?>"; }, 1000);
                                } else {
                                    swal("Error!", res.msg, "error");
                                    $('button[type="submit"]').attr('disabled',false);
                                }
                            })
                                .fail(function(response) {
                                console.log('Error: ' + response.responseText);
                            });
                        } else {
                            swal.close();
                            return false;
                        }
                    });
                }
            }
            function Print(){
                var isValidForm = document.forms['form'].checkValidity();
                if (!isValidForm)
                {
                    return false;
                }
                totalcal_final();
                print_page="";
                $('input[name=pageType]').val('Print');
                var l = $('.ladda-button-demo').ladda();
                l.ladda( 'start' );
                event.preventDefault();
                if($('input[name=Net_Amount]').val() <= 0 || $('input[name=totalAmount]').val() <= 0 || $('input[name=taxableAmt]').val() <= 0){
                    swal("Warning!", "Amount is Invalid", "error");
                }
                else{
                    $.post('<?= base_url('Invoice/update_submit'); ?>',$('#form').serialize(),function(response){
                        var win = window.open('<?= base_url() ?>'+response);
                        if (win) {
                            //Browser has allowed it to be opened
                            win.focus();
                        } else {
                            //Browser has blocked it
                            alert('Please allow popups for this website');
                        }
                    })
                        .fail(function(response) {
                        console.log('Error: ' + response.responseText);
                    });
                }
            }       

        </script>
    </body>
</html>
