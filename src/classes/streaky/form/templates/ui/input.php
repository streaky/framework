<div class="control-group <?php \tpl::s("item-outer-classes"); ?>">
	<label class="control-label" for="<?php \tpl::s("item-id"); ?>"><?php \tpl::s("item-label"); ?></label>
	<div class="controls">
		<input class="<?php \tpl::s("item-input-classes"); ?>" placeholder="<?php \tpl::s("item-placeholder"); ?>" type="<?php \tpl::s("item-type"); ?>" id="<?php \tpl::s("item-id"); ?>" name="<?php \tpl::s("item-name"); ?>" value="<?php \tpl::s("item-value"); ?>">
		<span class="help-text"><?php \tpl::s("item-help"); ?></span>
	</div>
</div>
