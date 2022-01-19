<div class="filter-field mb-2" data-type="select">
	<label class="form-label"><?=$label?></label>
	<select class="form-select" name="<?=$name?>">
		<option value="">Показать все</option>
		<?foreach($value as $item) {?>
			<option value="<?=$item['value']?>" <?=$item['selected']?'selected':''?>><?=$item['name']?></option>
		<?}?>
	</select>
</div>