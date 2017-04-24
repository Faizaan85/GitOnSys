<!-- order details page.
I realise the name is crappy but not gonna change as it is gonna be difficult. -->
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-6 col-md-6 col-lg-6" >
            <h3 id="omid" class="row1" data-omid="<?php echo ($orderinfo['OmId']); ?>">Order #: <?php echo ($orderinfo['OmId']); ?>
                </h3>
        </div>
        <div class="col-xs-6 col-md-6 col-lg-6">
            <h3 class="row1">Date: <?php echo date("d-m-Y",strtotime($orderinfo['OmCreatedOn'])); ?></h3>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <h3 class="row2">Name: <?php echo $orderinfo['OmCompanyName']; ?></h3>
        </div>
        <div class="col-xs-6">
            <h3 class="row2">LPO: <?php echo $orderinfo['OmLpo']; ?></h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <button type="button" id="print" class="btn btn-info hidden-print" value="Print">Print</button>
        <button type="button" id="test">Test</button>
    </div>
    <div class="row">
        <table class="table table-striped table-bordered">
        <thead >
            <tr>
                <th>Sr.</th>
                <th>Part #</th>
                <th>Supplier #</th>
                <th>Description</th>
                <th>R-Qty</th>
                <th>L-Qty</th>
                <th>T-Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;?>
            <?php foreach($items as $item): ?>

            <tr id="<?php echo ($item['OiId']); ?>"
                <?php
                    switch ($item['OiStatus']) {
                        case "0":
                            echo "class='default'";
                            break;
                        case "1":
                            echo "class='success'";
                            break;
                        case "2":
                            echo "class='danger'";
                            break;
                        default:
                            echo "class='warning'";
                    }
                ?>
            >
                <td  class="done">
                    <?php echo ($i); ?>
                    <span class="pull-right"><span class="fa fa-check fa-lg hidden-print"></span></span>
                </td>
                <td class="edit"><?php echo $item['OiPartNo']; ?> <span class="pull-right"><span class="fa fa-pencil-square-o fa-lg hidden-print"></span></span></td>
                <td class="delete"><?php echo $item['OiSupplierNo']; ?><span class="pull-right"><span class="fa fa-times fa-lg hidden-print" aria-hidden="true"></span></span></td>
                <td><?php echo $item['OiDescription']; ?></td>
                <td class="RQty" type='number'><?php echo $item['OiRightQty']; ?></td>
                <td class="LQty"><?php echo $item['OiLeftQty']; ?></td>
                <td class="TQty"><?php echo $item['OiTotalQty']; ?></td>
            </tr>
        <?php $i++;?>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
