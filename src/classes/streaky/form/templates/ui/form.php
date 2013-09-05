
<form class="form-horizontal<?php \tpl::s("form-classes"); ?>" <?php \tpl::e("form-autocomplete"); ?> id="<?php \tpl::s("form-id"); ?>" method="<?php \tpl::s("form-method"); ?>" action="<?php \tpl::s("form-action"); ?>">
<?php \tpl::e("form-items"); ?>
<?php \tpl::e("buttons"); ?> 
</form>

<script type="text/javascript">

$('document').ready(function() {
	$("form#<?php \tpl::s("form-id"); ?> .validate-item:not(.no-auto-validate)").each(function(i, el) {
		$(el).blur(function(eventData) {
			var extra = <?php \tpl::e("form-items-extra"); ?>;
			var send_extra = {};
			var name = $(el).attr("name");
			if(name in extra) {
				var v;
				var index;
				for (index = 0; index < extra[name].length; ++index) {
					//console.log('form#<?php \tpl::s("form-id"); ?> [name="' + extra[name][index] + '"]');
					v = $('form#<?php \tpl::s("form-id"); ?> [name="' + extra[name][index] + '"]').val();
					//console.log(extra[name][index], v);
					send_extra[extra[name][index]] = v;
				}
				
			}
			formValidate(el, send_extra, '<?php \tpl::s("form-validate-url"); ?>');
		});
	});

<?php \tpl::e("form-messages"); ?>
	
});
</script>
