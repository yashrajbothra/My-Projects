<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <style> 
            html{
                width:10.5cm;
                height:14.8cm;
            }
            .text-center
            {
                text-align: center;
            }
            .text-right
            {
                text-align: right;
            }
            .bg-alice{
                background-color: aliceblue;
            }
            .bg-grey{
                background-color: #eee;
            }
            .bg-pink{
                background-color: #f2dddc;
            }
            .main-title{
                font-size: 22px;
                background-color: aliceblue;
                text-align: center;
                font-weight: bold;
            }
            .company-title{
                font-size: 16px;
                font-weight: bold;
                text-align: center;
            }
            .company-info{
                font-size: 14px;
                font-weight: bold;
                text-align: center;
            }

            td {
                border: 1px solid black;
                padding: 4px 8px;

            }
            tbody tr td{
                border-top:0px solid black;
                border-bottom:0px solid black;
                border-left:1px solid black;
                border-right:1px solid black;
            }
            table {
                border-collapse: collapse;
            }

            .border,th{
                border: 1px solid black;
                padding: 4px 8px;

            }
            p{
                margin : 5px;
            }

            td span{
                font-size: 14px;
                font-weight: 600;
            }

            td.colNoBorder {
                border: 0;
            }

            .first-page {
                margin: 3% 1%;
                padding: 0px !important;
                color: black;
                max-height: 28cm;
                width: 90%;
                position:absolute;
            }

            .footer {
                position: fixed; 
                bottom: 0px; 
            } 

            .noRow{
                height:21.600px !important; 
            }

            .bottomcorner{
                position:absolute;
                bottom:0;
                left:0;
            }
            @media all {
                .page-break	{ display: none; }
            }
            @media print{
                width:10.5cm;
                height:14.8cm;

                .page-break-before	{ display: block; page-break-before: always; }
                .page-break-after	{ display: block; page-break-after: always; }

                .table-blue-fotter {
                    position: static;
                    bottom: 20px;
                    left: 0px;
                    width: 100%;
                    background: gray;
                }
                html {float: none !important;}
            }
            @page { 
                size: A6;
                margin: 6px 5px 5px 5px; 
            }
            body { 
                margin: 6px 5px 5px 5px; 
                font-size: 12px;
            }

        </style>
    </head>

    <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8" />
    <?php
    $rows = count($invoice_detail->OrderItems); 
    $pages=1;
    $row=0;
    $total_amount = 0;
    $flag_itemDiscount=0;
    $flag_invoiceDiscount=0;
    $flag_packingCharge=0;
    $flag_transportCharge=0;
    $flag_city=0;
    $total_flag=1;
    foreach($invoice_detail->OrderItems as $OrderItem){
        if($OrderItem['itemDiscount']!= 0){
            $flag_itemDiscount=1;
        }}
    if($invoice_detail->invoiceDiscount['Amount']!= 0){
        $flag_invoiceDiscount=1;
    }
    if($invoice_detail->packingCharge['Amount']!= 0){
        $flag_packingCharge=1;
    }
    if($invoice_detail->transportCharge['Amount']!= 0){
        $flag_transportCharge=1;
    }
    if(!empty($invoice_detail->city)){
        $flag_city=1;
    }
    ?>
    <body onload="window.print();">
        <h3 style="margin:0;" class="text-center"><?= $flag_city==1 ? $invoice_detail->partyName."(".ucfirst($invoice_detail->city).")":$invoice_detail->partyName; ?></h3>
        <span style="float: left;" class="text-left">Invoice No: <?= $invoice_detail->invoiceNumber ?></span>
        <span style="float: right;" class="text-right">Date: <?= date('d-m-Y', strtotime($invoice_detail->invoiceDate)) ?></span>
        <table class="summary" width="100%">
            <thead class="bg-grey">
                <th <?= $flag_itemDiscount == 1 ? "width='52%'" :" width='47%'" ?>>Description</th>
                <th width="13%">Qty</th>
                <th width="14%">Rate</th>
                <?php if($flag_itemDiscount == 1){ ?>
                <th width="5%">Discount</th>
                <?php }?>
                <th width="20%">Amount</th>
            </thead>
            <tbody>
                <?php     
                $i=0;
                foreach($invoice_detail->OrderItems as $OrderItem){?>
                <tr>
                    <?php 
                    $product = $this->Product_model->get_product($OrderItem['productId']); 
                    $unit = $this->Unit_model->get_unit($OrderItem['unitId']); 
                    ?>
                    <td ><?= $product->productName?></td>
                    <td class="text-right"><?= $OrderItem['quantity']; ?></td>
                    <td class="text-right"><?= floatval($OrderItem['itemRate']); ?></td>
                    <?php if($flag_itemDiscount == 1){ ?>
                    <td class="text-right"><?= floatval($OrderItem['itemDiscount'])?></td>
                    <?php } ?>
                    <td class="text-right"><?= floatval($OrderItem['itemAmount']); ?></td>
                </tr>
                <?php 
                    $i++; 
                    $total_amount += $OrderItem['itemAmount'];
                    $row++;
                    if($row%19==0){
                ?>
<!--                    <caption style="bottom-0; position:absolute;">Page <?= $pages ?></caption>-->
                <tr class="text-center">
                    <td <?= $flag_itemDiscount == 0 ? "colspan='2'":"colspan='3'" ?> rowspan="<?= $total_flag ?>" class="text-right border page-break-before"><b>Total</b></td>
                    <td colspan="2" class="border text-right" ><?= $total_amount ?></td>
                </tr>
                <tr class="text-center">
                    <td <?= $flag_itemDiscount == 0 ? "colspan='2'":"colspan='3'" ?> rowspan="<?= $total_flag ?>" class="text-right border page-break-before"><b>Total</b></td>
                    <td colspan="2" class="border text-right" ><?= $total_amount ?></td>
                </tr>
                <?php
                    $pages++;
                    } 
//                    elseif($pages!=1 && $row/19==$pages){
                ?>
<!--
                <caption style="position:absolute;">Page <?= $pages ?></caption>
                <tr class="text-center">
                    <td <?= $flag_itemDiscount == 0 ? "colspan='2'":"colspan='3'" ?> rowspan="<?= $total_flag ?>" class="text-right border page-break-before"><b>Total</b></td>
                    <td colspan="2" class="border text-right" ><?= $total_amount ?></td>
                </tr>
                <tr class="text-center">
                    <td <?= $flag_itemDiscount == 0 ? "colspan='2'":"colspan='3'" ?> rowspan="<?= $total_flag ?>" class="text-right border page-break-before"><b>Total</b></td>
                    <td colspan="2" class="border text-right" ><?= $total_amount ?></td>
                </tr>
-->
                <?php
//                    $pages++;
//                    }
                }
                $remark_flag=2;
                $flag_invoiceDiscount==1 ? $remark_flag++: $i--;
                $flag_packingCharge==1 ? $remark_flag++ : $i--;
                $flag_transportCharge==1 ? $remark_flag++ : $i-- ; 
                $remark_string = strlen($invoice_detail->remark);
                if($remark_string >30){
                    $i++;
                    $remark_flag++;
                    $total_flag++;
                }
                for( ;$i<=15;$i++){?>
                <tr class="noRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php if($flag_itemDiscount == 1){ ?>
                    <td></td>
                    <?php } ?>
                    <td></td>
                </tr>
                <?php }
                ?>
            </tbody>
            <div class="table-blue-footer">
                <tr class="bg-grey">
                    <td style="vertical-align: top;" <?= $flag_itemDiscount == 0 ? "colspan='1'":"colspan='2'" ?> width="30.25%" rowspan="<?= $remark_flag ?>" class="text-left border"><b>Remarks: </b><?= $invoice_detail->remark ?></td>
                </tr>
                <?php if($flag_invoiceDiscount == 1){ ?>
                <tr>
                    <td colspan="2" width="15.6%" class="text-right border"><b>Discount: </b></td>
                    <td width="4.5%" class="text-right border"><?= $invoice_detail->invoiceDiscount['Amount'] ?></td>
                </tr>
                <?php } ?> 
                <?php if($flag_packingCharge == 1){ ?>
                <tr>
                    <td colspan="2" width="15.6%" class="text-right border"><b>Packing Charge:</b></td>
                    <td width="4.5%" class="text-right border"><?= $invoice_detail->packingCharge['Amount'] ?></td>
                </tr>
                <?php } ?> 
                <?php if($flag_transportCharge == 1){ ?>
                <tr>
                    <td colspan="2" width="15.6%" class="text-right border"><b>Trans. Charge:</b></td>
                    <td width="4.5%" class="text-right border"><?= $invoice_detail->transportCharge['Amount'] ?></td>
                </tr>
                <?php } ?> 
                <tr class="text-center">
                    <td colspan="1" rowspan="<?= $total_flag ?>" class="text-right border"><b>Total</b></td>
                    <td colspan="2" class="border text-right" rowspan="<?= $total_flag ?>"><?= $invoice_detail->totalAmount ?></td>
                </tr>
<!--                <caption style="position:absolute;">Page <?= $pages ?></caption>-->
            </div>
        </table>
    </body>
</html>