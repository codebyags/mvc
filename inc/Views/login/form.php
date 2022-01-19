<div class="container">
	<div class="row justify-content-md-center">
		<div class="p-4 col-4">
			<div class="p-4 d-flex justify-content-md-center">
				<img style="width: 120px" src="<?= $template ?>/img/Logo.svg" alt="">
			</div>

			<form method="post" action="/login/">
				<div class="p-2">
					<input name="login" type="text" class="form-control" id="exampleFormControlInput1"
						   placeholder="Логин">
				</div>
				<div class="p-2">
					<input name="password" type="password" class="form-control" id="exampleFormControlInput2"
						   placeholder="Пароль">
				</div>

				<div class="p-2">
					<? foreach ($errors as $error) { ?>
						<? $this->render('samples/message', $error, true) ?>
					<? } ?>
				</div>

				<div class="p-2 d-flex justify-content-md-center">
					<button type="submit" class="btn btn-primary">Войти</button>
				</div>
			</form>
		</div>
	</div>
</div>