<div class="card mb-3">
	<div class="row g-0">
		<div class="col-md-4">
			<img loading="lazy" src="<?= $template ?>/img/eat.jpg" class="img-fluid rounded-start" alt="...">
		</div>
		<div class="col-md-8">
			<div class="card-body card-mealgear">
				<h5 class="card-title"><?= $offer['name'] ?></h5>
				<p class="card-text mb-1"><?= $offer['about'] ?></p>
				<p class="card-text mb-1"><?= $offer['calories'] ?> калл</p>

				<p class="card-text mb-1">
					<? if ($offer['weeks']) { ?>
						<?= declOfNum(count($offer['meals']), ['%d приём пищи', '%d приёма пищи', '%d приёмов пищи']) ?>
						<?= declOfNum(+$offer['weeks'], ['%d неделю', '%d недели', '%d недель']) ?> по <br>
						<?= weekdaysToRus($offer['weekdays'], true) ?>
					<? } ?>
				</p>

				<div class="pt-4">
					<div>
						<? if (empty($offer['percent'])) { ?>
							<h4 class="card-title"><?= priceFormat($offer['price']) ?></h4>
						<? } else { ?>
							<p class="card-text  mb-1"><small class="text-muted">-<?= $offer['percent']?>%
									<s><?=priceFormat( round(($offer['price'] / (100 - $offer['percent'])) * 100) )?></s></small></p>
							<h4 class="card-title" style="white-space: nowrap"><?=priceFormat($offer['price'])?></h4>
						<? } ?>
					</div>
				</div>

				<div class="btn-buy">
					<a href="/" class="btn btn-primary">Купить</a>
				</div>
			</div>
		</div>
	</div>
</div>