<h1><?=$pageTitle?></h1>

<hr>

<table border="1" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>#ID</th>
			<th>Title</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($newsList as $news): ?>
			<tr>
				<td><?=$news->id?></td>
				<td><?=$news->title?></td>
			</tr>
			
			<tr>
				<th>Text</th>
				<td><?=$news->text?></td>
			</tr>
			
			<tr>
				<td colspan="2"></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
