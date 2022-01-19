<div class="container">

	<div class="pt-4">
		<h2>Поиск предложений</h2>
	</div>

	<div class="filters mb-4" id="filter">
		<? foreach($filters as $filter) {
			echo $filter;
		}?>
		<script src="/templates/include/filter.js"></script>
		<button class="btn btn-primary" onclick="filter('/offers/filter/')">Найти</button>
	</div>

	<? foreach ($offers as $offer) {
		include "samples/offer.php";
	} ?>


</div>