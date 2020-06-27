<div class="row-fluid">

    <div class="tabbable tabbable-custom tabbable-full-width">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#migrate" data-toggle="tab"><?php echo __('Migrate Data')?></a></li>
            <li><a href="#tables" data-toggle="tab"><?php echo __('mySQL Tables')?></a></li>
        </ul>
    </div>

    <div class="tab-content">
        <div class="tab-pane row-fluid active" id="migrate">

            <div class="alert alert-info">
                <h3>Migration Tool</h3>
                <p> The File Format from Customer:<br>
                    <a href="/dewtouch/files/migration_sample_1.xls"><i class="icon-share"></i> xls file</a><br>
                    <a href="/dewtouch/files/migration_sample_1.xlsx"><i class="icon-share"></i> xlsx file</a><br>
                    <a href="/dewtouch/files/migration_sample_1.csv"><i class="icon-share"></i> csv file</a>
                </p>
            </div>

            <?php if($message != ""): ?>
            <div class="alert alert-<?php echo $message['type']; ?>">
                <p><?php echo $message['content']; ?></p>
            </div>
            <?php endif; ?>

            <?php
                echo $this->Form->create('FileUpload', array( 'type' => 'file'));
                echo $this->Form->input('file', array('label' => 'File Upload', 'type' => 'file'));
                echo $this->Form->submit('Upload', array('class' => 'btn btn-primary'));
                echo $this->Form->end();
            ?>


        </div>

        <div class="tab-pane row-fluid " id="tables">

            <div id="accordion">
                <?php foreach($members as $member): ?>
                <h3><?php echo $member['Member']['name'] ?></h3>
                <div>
                    <table class="table table-bordered table-small" style="background-color:white">
                        <tr>
                            <th>Members</th>
                        </tr>
                        <tr>
                            <th>id</th>
                            <th>type</th>
                            <th>no</th>
                            <th>name</th>
                            <th>company</th>
                            <th>valid</th>
                            <th>created</th>
                            <th>modified</th>
                        </tr>
                        <tr>
                            <td><?php echo $member['Member']['id'] ?></td>
                            <td><?php echo $member['Member']['type'] ?></td>
                            <td><?php echo $member['Member']['no'] ?></td>
                            <td><?php echo $member['Member']['name'] ?></td>
                            <td><?php echo $member['Member']['company'] ?></td>
                            <td><?php echo $member['Member']['valid'] ?></td>
                            <td><?php echo $member['Member']['created'] ?></td>
                            <td><?php echo $member['Member']['created'] ?></td>
                        </tr>
                    </table>

                    <table class="table table-bordered table-small" style="background-color:white">
                        <tr>
                            <th>Transaction</th>
                        </tr>
                        <tr>
                            <th>id</th>
                            <th>member_id</th>
                            <th>member_name</th>
                            <th>member_paytype</th>
                            <th>member_company</th>
                            <th>date</th>
                            <th>year</th>
                            <th>month</th>
                            <th>ref_no</th>
                            <th>receipt_no</th>
                            <th>batch_no</th>
                            <th>cheque_no</th>
                            <th>payment_type</th>
                            <th>renewal_year</th>
                            <th>remarks</th>
                            <th>subtotal</th>
                            <th>tax</th>
                            <th>total</th>
                            <th>valid</th>
                            <th>created</th>
                            <th>modified</th>
                        </tr>
                        <tr>
                            <td><?php echo $member['Transaction']['id'] ?></td>
                            <td><?php echo $member['Transaction']['member_id'] ?></td>
                            <td><?php echo $member['Transaction']['member_name'] ?></td>
                            <td><?php echo $member['Transaction']['member_paytype'] ?></td>
                            <td><?php echo $member['Transaction']['member_company'] ?></td>
                            <td><?php echo $member['Transaction']['date'] ?></td>
                            <td><?php echo $member['Transaction']['year'] ?></td>
                            <td><?php echo $member['Transaction']['month'] ?></td>
                            <td><?php echo $member['Transaction']['ref_no'] ?></td>
                            <td><?php echo $member['Transaction']['receipt_no'] ?></td>
                            <td><?php echo $member['Transaction']['batch_no'] ?></td>
                            <td><?php echo $member['Transaction']['cheque_no'] ?></td>
                            <td><?php echo $member['Transaction']['payment_type'] ?></td>
                            <td><?php echo $member['Transaction']['renewal_year'] ?></td>
                            <td><?php echo $member['Transaction']['remarks'] ?></td>
                            <td><?php echo $member['Transaction']['subtotal'] ?></td>
                            <td><?php echo $member['Transaction']['tax'] ?></td>
                            <td><?php echo $member['Transaction']['total'] ?></td>
                            <td><?php echo $member['Transaction']['valid'] ?></td>
                            <td><?php echo $member['Transaction']['created'] ?></td>
                            <td><?php echo $member['Transaction']['modified'] ?></td>
                        </tr>
                    </table>

                    <table class="table table-bordered table-small" style="background-color:white">
                        <tr>
                            <th>Transaction Items</th>
                        </tr>
                        <tr>
                            <th>id</th>
                            <th>transaction_id</th>
                            <th>description</th>
                            <th>quantity</th>
                            <th>unit_price</th>
                            <th>uom</th>
                            <th>sum</th>
                            <th>valid</th>
                            <th>created</th>
                            <th>modified</th>
                            <th>table</th>
                            <th>table_id</th>

                        </tr>
                        <tr>
                            <td><?php echo $member['TransactionItem']['id'] ?></td>
                            <td><?php echo $member['TransactionItem']['transaction_id'] ?></td>
                            <td><?php echo $member['TransactionItem']['description'] ?></td>
                            <td><?php echo $member['TransactionItem']['quantity'] ?></td>
                            <td><?php echo $member['TransactionItem']['unit_price'] ?></td>
                            <td><?php echo $member['TransactionItem']['uom'] ?></td>
                            <td><?php echo $member['TransactionItem']['sum'] ?></td>
                            <td><?php echo $member['TransactionItem']['valid'] ?></td>
                            <td><?php echo $member['TransactionItem']['created'] ?></td>
                            <td><?php echo $member['TransactionItem']['modified'] ?></td>
                            <td><?php echo $member['TransactionItem']['table'] ?></td>
                            <td><?php echo $member['TransactionItem']['table_id'] ?></td>

                        </tr>
                    </table>


                </div>
                <?php endforeach; ?>
            </div>

        </div>

    </div>


</div>





<?php $this->start('script_own')?>
<script>
$(function() {
    $("#accordion").accordion({
        collapsible: true,
        heightStyle: "content"
    });
});
</script>
<?php $this->end()?>