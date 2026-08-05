<?php
/**
 * The sort and filter sidebar, shared by the product list, shop, manufacturer
 * and product group pages. Expects $sort_options, $filter_groups,
 * $price_filter_labels, $price_min, $price_max and $stock_only from the
 * controller. Sorting sits inside the same form as the filters so that
 * changing one keeps the other.
 */
?>
<div class="col-12">
	<h3><?php echo $translation[$page_language]['sort_by']; ?></h3>
	<select name="sort" id="sort" class="form-control" onchange="this.form.submit();">
		<?php foreach($sort_options as $sort_option) { ?>
		<option value="<?php echo htmlspecialchars($sort_option['value'], ENT_QUOTES); ?>" <?php echo $sort_option['selected'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($sort_option['label']); ?></option>
		<?php } ?>
	</select>
	<hr/>
</div>

<div class="col-12">
	<h3><?php echo $translation[$page_language]['do_filter']; ?></h3>
</div>

<div class="col-12">
	<h4><?php echo htmlspecialchars($price_filter_labels['heading']); ?></h4>
	<div class="row">
		<div class="col-6">
			<input type="number" min="0" step="1" class="form-control" name="price_min" id="price_min"
				placeholder="<?php echo htmlspecialchars($price_filter_labels['from'], ENT_QUOTES); ?>"
				value="<?php echo ($price_min !== false) ? htmlspecialchars($price_min, ENT_QUOTES) : ''; ?>" />
		</div>
		<div class="col-6">
			<input type="number" min="0" step="1" class="form-control" name="price_max" id="price_max"
				placeholder="<?php echo htmlspecialchars($price_filter_labels['to'], ENT_QUOTES); ?>"
				value="<?php echo ($price_max !== false) ? htmlspecialchars($price_max, ENT_QUOTES) : ''; ?>" />
		</div>
	</div>
	<hr/>
</div>

<?php foreach($filter_groups as $filter_group) { ?>
<div class="col-12">
	<h4><?php echo htmlspecialchars($filter_group['label']); ?></h4>
	<div style="max-height:220px;overflow-y:auto;">
	<?php foreach($filter_group['options'] as $option) {
		$option_id = $filter_group['name'] . '_' . preg_replace('/[^A-Za-z0-9_]/', '_', $option['value']);
	?>
		<div class="form-check">
			<input class="form-check-input" type="checkbox"
				name="<?php echo $filter_group['name']; ?>[]"
				id="<?php echo $option_id; ?>"
				value="<?php echo htmlspecialchars($option['value'], ENT_QUOTES); ?>"
				<?php echo $option['checked'] ? 'checked' : ''; ?> />
			<label class="form-check-label" for="<?php echo $option_id; ?>">
				<?php echo htmlspecialchars($option['label']); ?>
				<span class="filter-count"><?php echo (int) $option['count']; ?></span>
			</label>
		</div>
	<?php } ?>
	</div>
	<hr/>
</div>
<?php } ?>

<?php if(!empty($stock_only)) { ?>
<div class="col-12">
	<p>
	<div class="form-check">
		<?php echo $stock_only; ?>
		<label class="form-check-label" for="stock_only">
			<?php echo $translation[$page_language]['in_stock_only']; ?>
		</label>
	</div>
	</p>
</div>
<?php } ?>
