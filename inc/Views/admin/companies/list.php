<div class="">
	<a href="edit/" type="button" class="btn btn-primary">Добавить копанию</a>

	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Логотип</th>
				<th scope="col">Название</th>
				<th scope="col">Предложений</th>
				<th scope="col">Блюд</th>
			</tr>
		</thead>
		<tbody>
			<? foreach($companies as $company) {?>
			<tr>
				<th scope="row">
					<a href="edit/<?=$company['_id']?>/"><?=$company['_id']?></a>
				</th>
				<td><?=$company['logo']?></td>
				<td><a href="https://<?=$company['site']?>" target="_blank"><?=$company['name']?></a></td>
				<td><?=$company['offers']?></td>
				<td><?=$company['name']?></td>
			</tr>
			<? } ?>
		</tbody>
	</table>
</div>