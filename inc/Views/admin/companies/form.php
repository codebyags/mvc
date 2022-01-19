<form method="post" action="/admin/companies/save/">

	<input name="_id" type="hidden" class="form-control" value="<?=$_id?>">

	<h3>О компании</h3>

	<div class="p-2">
		<label for="">Название компании</label>
		<input name="name" type="text" class="form-control" value="<?=$name?>">
	</div>

	<div class="p-2">
		<label for="">Логотип компании</label>
		<input name="logo" type="text" class="form-control file-manager" value="<?=$logo?>">
	</div>

	<div class="p-2">
		<label for="">Описание</label>
		<textarea class="form-control" name="about" id="" cols="30" rows="4"><?=$about?></textarea>
	</div>



	<h3 class="pt-4">Контакты</h3>

	<div class="p-2">
		<label for="">Сайт</label>
		<input name="site" type="text" class="form-control" value="<?=$site?>">
	</div>

	<div class="p-2">
		<label for="">Телефон для заказов</label>
		<input name="manager_phone" type="text" class="form-control" value="<?=$manager_phone?>">
	</div>

	<div class="p-2">
		<label for="">Почта</label>
		<input name="email" type="email" class="form-control" value="<?=$email?>">
	</div>

	<h3 class="pt-4">Юридическая информация</h3>

	<div class="p-2">
		<label for="">Телефон для связи по юр. вопросам</label>
		<input name="u_phone" type="text" class="form-control" value="<?=$u_phone?>">
	</div>

	<div class="p-2">
		<label for="">Контакт для связи по юр. вопросам</label>
		<input name="u_contact" type="text" class="form-control" value="<?=$u_contact?>">
	</div>


	<div class="p-2">
		<? foreach ($errors as $error) { ?>
			<? $this->render('samples/message', $error, true) ?>
		<? } ?>
	</div>

	<div class="pt-2">
		<button type="submit" class="btn btn-primary">Сохранить</button>
	</div>
</form>

