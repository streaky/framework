<div class="control-group <?php \tpl::s("item-outer-classes"); ?>">
	<label class="control-label" for="<?php \tpl::s("item-id"); ?>"><?php \tpl::s("item-label"); ?></label>
	<div class="controls">
		<select class="<?php \tpl::s("item-input-classes"); ?>" id="<?php \tpl::s("item-id"); ?>" name="<?php \tpl::s("item-name"); ?>">
<?php self::e("select-options"); ?>
<option value="te">Test</option>
		</select>
		<!--<input  value="<?php \tpl::s("item-value"); ?>">-->
		<span class="help-text"><?php \tpl::s("item-help"); ?></span>
	</div>
</div>
