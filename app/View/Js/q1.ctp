<div class="alert  ">

    <button class="close" data-dismiss="alert"></button>
    Question: Advanced Input Field</div>

<p>
    1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input
    field for use to edit. Refer to the following video.

</p>


<p>
    2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty
    value. Pay attention to the input field name. For example the quantity field

    <?php echo htmlentities('<input name="data[1][quantity]" class="">')?> , you have to change the data[1][quantity] to
    other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
    <button class="close" data-dismiss="alert"></button>
    The table you start with</div>

<table class="table table-striped table-bordered table-hover" id="table_record">
    <thead>
        <th><span id="add_item_button" class="btn mini green addbutton" onclick="addToObj=true">
                <i class="icon-plus"></i></span></th>
        <th width="50%">Description</th>
        <th width="25%">Quantity</th>
        <th width="25%">Unit Price</th>
    </thead>

    <tbody>

    </tbody>
</table>


<p></p>
<div class="alert alert-info ">
    <button class="close" data-dismiss="alert"></button>
    Video Instruction</div>

<p style="text-align:left;">
    <video width="78%" controls>
        <source src="<?php echo $this->webroot; ?>/video/q3_2.mov">
        Your browser does not support the video tag.
    </video>
</p>





<?php $this->start('script_own');?>
<script>
let lineNo = 1;

$(document).on('click', '#add_item_button', function(e) {
    additionalRow =
        "<tr class = 'editable_row'><td><span class = 'btn mini red removebutton'><i class='icon-trash'></i></span></td><td class = 'editable_col' ><textarea name='data[" +
        lineNo +
        "][description]' class='m-wrap editable_element  description required' rows='2' ></textarea><div class = 'editable_label'></div></td><td class = 'editable_col'><input name='data[" +
        lineNo +
        "][quantity]' class='editable_element' ><div class = 'editable_label'></div></td><td class = 'editable_col'><input name='data[" +
        lineNo +
        "][unit_price]' class='editable_element' ><div class = 'editable_label'></div></td></tr>";
    tableBody = $("table tbody");
    tableBody.append(additionalRow);
    lineNo++;
});

$(document).on('click', '.editable_col', function(e) {
    $(this).find(".editable_label").hide();
    $(this).find('.editable_element').show();
    $(this).find('.editable_element').focus();
});


$(document).on('click', '.removebutton', function(e) {
    var x = confirm("Are you sure you want to delete this row?");
    if (x == true) {
        $(this).closest("tr").remove();
    }
    return false;
});


$(document).on('blur', '.editable_col .editable_element', function(e) {

    $(this).parent().find('.editable_element').hide();
    $(this).parent().find(".editable_label").html($(this).val());
    $(this).parent().find(".editable_label").show();

});

$(document).ready(function() {

});
</script>
<?php $this->end();?>