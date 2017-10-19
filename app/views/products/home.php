<h1>
	<?=$pageTitle?>
	<a href="/products/form" class="btn btn-primary">
		<span class="material-icons">add_circle</span> New
	</a>
</h1>

<table class="table table-bordered table-striped table-responsive table-hover">
	<thead class="thead-default">
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Actions</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($products as $product): ?>
			<tr>
				<th scope="row"><?=$product->id?></th>
				<td><?=$product->name?></td>
				<td>$ <?=number_format($product->price, 2)?></td>
				<td><?=$product->quantity?></td>
				<td>
					<a href="/products/form/<?=$product->id?>" class="btn btn-sm btn-success">
						<span class="material-icons">edit</span> Edit
					</a>
					<a href="#" class="btn btn-sm btn-danger">
						<span class="material-icons">delete</span> Delete
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

pages
