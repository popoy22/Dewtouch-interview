<div id="message1">



    <?php  echo $alert; ?>




    <?php echo $this->Form->create('Type',array('id'=>'form_type','type'=>'file','class'=>'','method'=>'POST','autocomplete'=>'off','inputDefaults'=>array(
				
				'label'=>false,'div'=>false,'type'=>'text','required'=>false)))?>

    <?php echo __("Hi, please choose a type below:")?>
    <br><br>

    <?php $options_new = array(
		 'Type1' => __('<span class="showDialog"  style="color:blue" 
		 data-toggle="tooltip" data-placement="right" data-html="true"
		 title = "<ul><li>Description .......</li>
		 <li>Description 2</li></ul>">Type1</span>
		 '),
		'Type2' => __('
				<span class="showDialog"  style="color:blue" 
				data-toggle="tooltip" data-placement="right" data-html="true"
				title = "<ul><li>Desc 1 .....</li>
				<li>Desc 2...</li></ul>"
                >Type2</span>'),

                'Type3' => __('
				<span class="showDialog"  style="color:blue" 
				data-toggle="tooltip" data-placement="right" data-html="true"
				title = "<ul><li>Desc 1 .....</li>
				<li>Desc 2...</li></ul>"
				>Type2</span>')   


		);?>

    <?php echo $this->Form->input('type', array('legend'=>false, 'type' => 'radio', 'options'=>$options_new,'before'=>'<label class="radio line notcheck">','after'=>'</label>' ,'separator'=>'</label><label class="radio line notcheck">'));?>
    <?php echo $this->Form->submit();?>
    <?php echo $this->Form->end();?>

</div>


<style>
.showDialog:hover {
    text-decoration: underline;
}

#message1 .radio {
    vertical-align: top;
    font-size: 13px;
    margin-left: 20px;
}

.control-label {
    font-weight: bold;
}

.wrap {
    white-space: pre-wrap;
}
</style>

<?php $this->start('script_own')?>
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip()

    /* 
    $(".dialog").dialog({
        autoOpen: false,
        width: '500px',
        modal: true,
        dialogClass: 'ui-dialog-blue'
    });


    $(".showDialog").click(function() {
        var id = $(this).data('id');
        $("#" + id).dialog('open');
    });

	*/

})
</script>
<?php $this->end()?>