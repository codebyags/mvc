<div class="filter-field mb-2" data-type="select-checkbox-weekdays" data-name="weekdays">
	<label class="form-label"><?=$label?></label>

	<div class="d-flex flex-row">
		<div class="d-flex flex-row">

			<div class="form-check m-1">
				<input name="weekdays[0]" class="form-check-input" type="checkbox" value="mon" <?=( isset($value['mon'])?'checked':'')?>>
				<label class="form-check-label" >
					Пн
				</label>
			</div>

			<div class="form-check m-1">
				<input name="weekdays[1]" class="form-check-input" type="checkbox" value="tue" <?=( isset($value['tue'])?'checked':'')?>>
				<label class="form-check-label" >
					Вт
				</label>
			</div>

			<div class="form-check m-1">
				<input name="weekdays[2]" class="form-check-input" type="checkbox" value="wen" <?=( isset($value['wen'])?'checked':'')?>>
				<label class="form-check-label" >
					Ср
				</label>
			</div>

			<div class="form-check m-1">
				<input name="weekdays[3]" class="form-check-input" type="checkbox" value="thu" <?=( isset($value['thu'])?'checked':'')?>>
				<label class="form-check-label" >
					Чт
				</label>
			</div>

			<div class="form-check m-1">
				<input name="weekdays[4]" class="form-check-input" type="checkbox" value="fri" <?=( isset($value['fri'])?'checked':'')?>>
				<label class="form-check-label" >
					Пт
				</label>
			</div>

			<div class="form-check m-1">
				<input name="weekdays[5]" class="form-check-input" type="checkbox" value="sat" <?=( isset($value['sat'])?'checked':'')?>>
				<label class="form-check-label" >
					Сб
				</label>
			</div>

			<div class="form-check m-1">
				<input name="weekdays[6]" class="form-check-input" type="checkbox" value="sun" <?=( isset($value['sun'])?'checked':'')?>>
				<label class="form-check-label" >
					Вс
				</label>
			</div>

		</div>
	</div>
</div>