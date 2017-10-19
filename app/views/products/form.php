<h1><?=$pageTitle?></h1>
<label class="custom-file">
	<input type="file" id="file2" class="custom-file-input">
	<span class="custom-file-control"></span>
</label>

<hr>

<?php
	$this->form->action = '/products';
	$this->form->method = 'POST';

	$this->form
			->hidden([
				'name' => 'id',
				'value' => !is_null($this->product) ? $this->product->id : ''
			])
			->input([
				'name' => 'name',
				'hideLabel' => true,
				'required' => true,
				'value' => !is_null($this->product) ? $this->product->name : ''
			])
			->input([
				'name' => 'price',
				'hideLabel' => true,
				'required' => true,
				'value' => !is_null($this->product) ? $this->product->price : '',
				'width' => '1/2'
			])
			->input([
				'name' => 'quantity',
				'hideLabel' => true,
				'required' => true,
				'value' => !is_null($this->product) ? $this->product->quantity : '',
				'width' => '1/2'
			])
			->text([
				'name' => 'description',
				'hideLabel' => true,
				'value' => !is_null($this->product) ? $this->product->description : ''
			])
			->button([
				'name' => 'save',
				'style' => 'primary',
				'icon' => 'add_circle',
				'type' => 'submit',
			])
			->button([
				'name' => 'cancel',
				'style' => 'warning',
				'icon' => 'cancel',
				'type' => 'link',
				'action' => '/products'
			])
			->render();
?>
