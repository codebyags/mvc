<div class="container">

	<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
					aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
					aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
					aria-label="Slide 3"></button>
		</div>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="<?= $template ?>/img/slider/1.jpg" class="d-block w-100" alt="Лучшие меню 2021">
				<div class="carousel-caption d-none d-md-block">
					<h2>READY2EAT</h2>
					<p>Новый бренд готовой еды выходит на российский рынок. Первые обзоры еды.</p>
				</div>
			</div>
			<div class="carousel-item">
				<img src="<?= $template ?>/img/slider/2.jpg" class="d-block w-100" alt="Лучшие меню 2021">
				<div class="carousel-caption d-none d-md-block">
					<h2>Подборка самых вкусных готовых блюд</h2>
					<p>Невероятные и необычные вкуснейшие готовые блюда, делимся нашими впечатлениями.</p>
				</div>
			</div>
			<div class="carousel-item">
				<img src="<?= $template ?>/img/slider/3.jpg" class="d-block w-100" alt="Лучшие меню 2021">
				<div class="carousel-caption d-none d-md-block">
					<h2>Обзор производственных мощностей</h2>
					<p>Рассказываем как готовят вашу пищу ведущие бренды готовых рационов.</p>
				</div>
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
				data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
				data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>


	<div class="pt-4">
		<h2>Готовые программы</h2>
	</div>

	<div class="pt-4">
		<h2>Все предложения</h2>
	</div>
	<? foreach ($offers as $offer) {
		include "samples/offer.php";
	} ?>

	<a href="/offers/" class="btn btn-light btn-lg">Все предложения</a>


</div>