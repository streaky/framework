	$("#<?php \tpl::s("item-id"); ?>").popover({
		content: '<div class="<?php \tpl::s("popover-classes"); ?>"></div><?php self::s("popover-message"); ?>',
		html: true,
		placement: 'right',
		container: $("#<?php \tpl::s("item-id"); ?>").parent(),
		trigger: 'manual'
	});
	$("#<?php \tpl::s("item-id"); ?>").popover('show');
