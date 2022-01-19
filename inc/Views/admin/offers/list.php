<div class="">
	<a href="edit/" type="button" class="btn btn-primary">Добавить предложение</a>
	<div class="filters mb-4 mt-4" id="filter">
		<? foreach($filters as $filter) {
			echo $filter;
		}?>
		<script src="/templates/include/filter.js"></script>
		<button class="btn btn-primary" onclick="filter('/admin/offers/filter/')">Найти</button>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Компания</th>
				<th scope="col">Предложение</th>
				<th scope="col">Калорийность</th>
				<th scope="col">Дней</th>
				<th scope="col">Скидка</th>
				<th scope="col">Цена</th>

			</tr>
		</thead>
		<tbody>
			<? foreach($offers as $offer) {?>
			<tr>
				<th scope="row">
					<a href="/admin/offers/edit/<?=$offer['_id']?>/"><?=$offer['_id']?></a>
				</th>
				<td><?=$offer['company']?></td>
				<td><?=$offer['name']?></td>
				<td><?=$offer['calories']?></td>
				<td>
					<? if( !empty($offer['days']) ) {?>
						<?=$offer['days']?> д.
					<? } else { ?>
						<?=$offer['weeks']?> н.
						<? if(!empty($offer['weekdays'])) { ?>
							(<?=implode(',', (array)$offer['weekdays'])?>)
						<? } ?>
					<? } ?>
				</td>
				<td><?if(!empty($offer['percent'])){?>-<?=$offer['percent']?>%<?}?></td>
				<td  style="white-space: nowrap"><?=priceFormat($offer['price'])?></td>
			</tr>
			<? } ?>
		</tbody>
	</table>
</div>