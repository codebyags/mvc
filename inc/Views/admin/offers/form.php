<form method="post" action="/admin/offers/save/">

	<input name="_id" type="hidden" class="form-control" value="<?= $_id ?>">

	<h3>Предложение</h3>

	<div class="p-2">
		<label for="">Компания</label>
		<select name="_id_company" class="form-select" size="3">
			<? foreach($companies as $company) { ?>
				<option value="<?=$company['value']?>" <?=($company['current']?'selected':'')?>><?=$company['text']?></option>
			<? } ?>
		</select>
	</div>

	<div class="p-2">
		<label for="">Название предложения</label>
		<input name="name" type="text" class="form-control" value="<?=$name?>">
	</div>

	<div class="p-2">
		<label for="">Описание</label>
		<textarea class="form-control" name="about" id="" cols="30" rows="4"><?=$about?></textarea>
	</div>

	<div class="p-2">
		<div class="form-check">
			<input name="vegan_meal" type="checkbox" min="0" class="form-check-input" <?=( $vegan_meal?'checked':'')?>>
			<label class="form-check-label">
				Подходит вегетарианцам
			</label>
		</div>
	</div>

	<div class="p-2">
		<label for="">Заявленная калорийность (ккал)</label>
		<input name="calories" type="number" min="0" class="form-control" value="<?=$calories?>">
	</div>

	<div class="p-2">
		<label for="">Количество приёмов пищи</label>
		<div class="d-flex flex-row">

			<div class="form-check m-1">
				<input name="meals[0]" class="form-check-input" type="checkbox" value="breakfast" <?=( isset($meals[0])?'checked':'')?>>
				<label class="form-check-label">
					Завтрак
				</label>
			</div>

			<div class="form-check m-1">
				<input name="meals[1]" class="form-check-input" type="checkbox" value="snack" <?=( isset($meals[1])?'checked':'')?>>
				<label class="form-check-label" >
					Перекус
				</label>
			</div>

			<div class="form-check m-1">
				<input name="meals[2]" class="form-check-input" type="checkbox" value="lunch" <?=( isset($meals[2])?'checked':'')?>>
				<label class="form-check-label" >
					Обед
				</label>
			</div>

			<div class="form-check m-1">
				<input name="meals[3]" class="form-check-input" type="checkbox" value="dinner" <?=( isset($meals[3])?'checked':'')?>>
				<label class="form-check-label" >
					Полдник
				</label>
			</div>

			<div class="form-check m-1">
				<input name="meals[4]" class="form-check-input" type="checkbox" value="supper" <?=( isset($meals[4])?'checked':'')?>>
				<label class="form-check-label" >
					Ужин
				</label>
			</div>

		</div>
	</div>

	<div class="p-2">
		<label for="">Количество блюд в одном дне</label>
		<input name="meals_count" type="number" min="0" class="form-control" value="<?=$meals_count?>">
	</div>

	<h3>Продолжительность предложения</h3>

	<div class="p-2">
		<label for="">Продолжительность питания в неделях</label>
		<input name="weeks" type="number" min="0" class="form-control" value="<?=$weeks?>">
	</div>

	<div class="p-2">
		<label for="">Дни питания если предусмотрены недели</label>
		<div class="d-flex flex-row">

			<div class="form-check m-1">
				<input name="weekdays[0]" class="form-check-input" type="checkbox" value="mon" <?=( isset($weekdays[0])?'checked':'')?>>
				<label class="form-check-label" >
					Пн
				</label>
			</div>

			<div class="form-check m-1">
				<input name="weekdays[1]" class="form-check-input" type="checkbox" value="tue" <?=( isset($weekdays[1])?'checked':'')?>>
				<label class="form-check-label" >
					Вт
				</label>
			</div>

			<div class="form-check m-1">
				<input name="weekdays[2]" class="form-check-input" type="checkbox" value="wen" <?=( isset($weekdays[2])?'checked':'')?>>
				<label class="form-check-label" >
					Ср
				</label>
			</div>

			<div class="form-check m-1">
				<input name="weekdays[3]" class="form-check-input" type="checkbox" value="thu" <?=( isset($weekdays[3])?'checked':'')?>>
				<label class="form-check-label" >
					Чт
				</label>
			</div>

			<div class="form-check m-1">
				<input name="weekdays[4]" class="form-check-input" type="checkbox" value="fri" <?=( isset($weekdays[4])?'checked':'')?>>
				<label class="form-check-label" >
					Пт
				</label>
			</div>

			<div class="form-check m-1">
				<input name="weekdays[5]" class="form-check-input" type="checkbox" value="sat" <?=( isset($weekdays[5])?'checked':'')?>>
				<label class="form-check-label" >
					Сб
				</label>
			</div>

			<div class="form-check m-1">
				<input name="weekdays[6]" class="form-check-input" type="checkbox" value="sun" <?=( isset($weekdays[6])?'checked':'')?>>
				<label class="form-check-label" >
					Вс
				</label>
			</div>

		</div>
	</div>

	<b>или</b>

	<div class="p-2">
		<label for="">Продолжительность питания в днях (если не предусмотрены недели)</label>
		<input name="days" type="number" min="0" class="form-control" value="<?=$days?>">
	</div>


	<h3>Цена</h3>
	<div class="p-2">
		<label for="">Стоимость предложения</label>
		<input name="price" type="number" min="0" class="form-control" value="<?=$price?>">
	</div>
	<div class="p-2">
		<label for="">Процент скидки (не влияет на цену)</label>
		<input name="percent" type="number" min="0" class="form-control" value="<?=$percent?>">
	</div>

	<h3>Промокод</h3>
	<div class="p-2">
		<label for="">Для получения этого предложения нужен промокод</label>
		<input name="promocode" type="text" min="0" class="form-control" value="<?=$promocode?>">
	</div>

	<h3>Возврат бонусов</h3>
	<div class="p-2">
		<label for="">Начисление бонусных баллов за покупку (при оплате 100%)</label>
		<input name="bonus" type="number" min="0" class="form-control" value="<?=$bonus?>">
	</div>


	<h3>Кешбэк</h3>
	<div class="p-2">
		<label for="">Возврат кешбэком на карту(счёт) в процентах (при оплате 100%)</label>
		<input name="cacheback" type="number" min="0" class="form-control" value="<?=$cacheback?>">
	</div>

	<div class="p-2">
		<? foreach ($errors as $error) { ?>
			<? $this->render('samples/message', $error, true) ?>
		<? } ?>
	</div>

	<input name="date_create" type="hidden" value="<?=$date_create?$date_create:date('Y-m-d H:i:s')?>">
	<input name="date_edit" type="hidden" value="<?=date('Y-m-d H:i:s')?>">

	<div class="pt-2">

		<? if(!empty($_id)) { ?>
			<button type="submit" class="btn btn-primary">Сохранить</button>
			<a href="/admin/offers/copy/<?=$_id?>/" class="btn btn-primary">Копировать</a>
			<a href="/admin/offers/remove/<?=$_id?>/" class="btn btn-danger">Удалить</a>
		<? } else { ?>
			<button type="submit" class="btn btn-primary">Добавить</button>
		<? } ?>
	</div>
</form>

