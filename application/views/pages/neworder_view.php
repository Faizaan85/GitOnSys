
<div class="container-fluid">
    <div class="row">
        <div id="something" class="hidden">
            <a href="<?php echo base_url(); ?>neworder" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Order Saved!.
        </div>
    </div>
    <div class="row">
        <form id="OrderForm" class="form-group">
            <div class="col-sm-4 col-md-4 col-lg-4">
                <label for="Qname">Customer Code:</label>
                <select  id="Qname" class="form-control selectpicker " data-live-search="true" onkeyup='whichButton(event.keyCode, "Lpo")'>
                    <?php foreach($clients as $client) :?>
                    <option value="<?php echo ($client['CLCONAME']); ?>" title="<?php echo ($client['CLCONAME']); ?>"> <?php echo ($client['CLCODE']); ?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="col-sm-4 col-md-4 col-lg-4">
                <label for="Lpo">LPO: </label>
                <input type="text" name="Lpo" id="Lpo" class="form-control" accesskey="l" onkeyup='whichButton(event.keyCode, "Part_no")'>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <label for="Cdate">Date: </label>
                <input type="date" name="Cdate" id="Cdate" class="form-control" tabindex="0" value="<?php echo date('Y-m-d'); ?>" />
            </div>
        </form>
    </div>
    <div>
        <hr>
    </div>
    <div class="row">
        <form id="AddRowForm">
            <div class="form-group">
                <div class="col-xs-1">
                    <label for="Add_Row">Select</label>
                    <input class="form-control" id="Add_Row" type="button" value="ADD" onclick="addRow('OutputBody')" onkeyup='whichButton(event.keyCode, "Part_no")'>
                </div>
                <div class="col-xs-2">
                    <label for="Part_no">Part No</label>
                    <input class="form-control" id="Part_no" type="text" placeholder="Part No (F9)" onfocus="clearInput()" accesskey="p"  onkeyup='whichButton(event.keyCode, "Qty_R")' required>
                </div>
                <div class="col-xs-2">
                    <label for="Supplier_no">Supplier No</label>
                    <input class="form-control" id="Supplier_no" type="text" onkeyup='whichButton(event.keyCode, "Qty_R")'minlength="2" required>
                </div>
                <div class="col-xs-3">
                    <label for="Desc_">Description</label>
                    <input type="text" class="form-control" id="Desc_" onkeyup='whichButton(event.keyCode, "Qty_R")' minlength="2" required>
                </div>
                <div class="col-xs-1">
                    <label for="Qty_R">Qty R</label>
                    <input type="number" class="form-control qty" id="Qty_R" value="0" min="0"  onkeyup='whichButton(event.keyCode, "Qty_L")'>
                </div>
                <div class="col-xs-1">
                    <label for="Qty_L">Qty L</label>
                    <input type="number" class="form-control qty" id="Qty_L" value="0" min="0" onkeyup='whichButton(event.keyCode, "Total_")'>
                </div>
                <div class="col-xs-1">
                    <label for="Total_">Total</label>
                    <input type="number" class="form-control" id="Total_" min="1" onkeyup='whichButton(event.keyCode, "Price_")' >
                </div>
                <div class="col-xs-1">
                    <label for="Price_">Price</label>
                    <input type="number" class="form-control" id="Price_" min="0" data-tgp="1" onkeyup='whichButton(event.keyCode, "Add_Row")'>
                </div>
            </div>
        </form>
    </div>
    <div>
        <hr>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-4">
            <input type="button" id="save" accesskey="s" class="btn btn-primary" value="Save (F2)">
            <input type="button" id="cancel" accesskey="c" class="btn btn-warning" value="Cancel (F4)" onclick="CancelOrder()">
            <input type="button" id="total" class="btn btn-info" value="0.00">
            <button type="button" id="print" class="btn btn-info hidden" value="Print">Print</button>
        </div>
    </div>
    <div>
        <hr>
    </div>
    <table id="Output" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Select</th>
                <th>Part No</th>
                <th>Supplier No</th>
                <th>Description</th>
                <th>Qty R</th>
                <th>Qty L</th>
                <th>Total</th>
                <th>Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody id="OutputBody">

        </tbody>
    </table>
</div>

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
