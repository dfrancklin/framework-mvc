<table>
	<thead>
		<tr>
			<th>#ID</th>
			<th>Title</th>
			<th>Text</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($newsList as $news): ?>
			<tr>
				<td><?=$news->id?></td>
				<td><?=$news->title?></td>
				<td><?=$news->text?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
