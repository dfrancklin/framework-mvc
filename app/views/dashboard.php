<h1><?=$pageTitle?></h1>

<hr>

<?php
$this->form->id = 'form-login';
$this->form->name = 'form-login';
$this->form->action = '/authentication';
$this->form->method = 'POST';

$this->form
		->input([
			'type' => 'email',
			'value' => 'dfrancklin23@gmail.com',
			'name' => 'email',
			'title' => 'E-mail',
			'showLabel' => false,
			'required' => true,
			'autofocus' => true,
			'size' => 'l',
			'width' => '1/2',
			'icon' => 'account_circle',
		])
		->input([
			'type' => 'password',
			'value' => '123',
			'name' => 'password',
			'showLabel' => false,
			'required' => true,
			'size' => 'l',
			'width' => '1/2',
			'icon' => 'lock',
		])
		->button([
			'name' => 'submit',
			'title' => 'Login',
			'type' => 'submit',
			'style' => 'dark',
			'icon' => 'keyboard_return',
		])
		->button([
			'name' => 'submit2',
			'title' => 'Login2',
			'type' => 'submit2',
			'style' => 'dark',
			'icon' => 'keyboard_return',
		])
		->button([
			'name' => 'submit3',
			'title' => 'Login3',
			'type' => 'submit3',
			'style' => 'dark',
			'icon' => 'keyboard_return',
		])
		->render();
?>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi lectus arcu, egestas id eleifend quis, consequat ac enim. Etiam mattis, diam non lobortis lacinia, metus ligula accumsan felis, sed porttitor dolor nulla convallis odio. Ut tortor nisl, blandit in arcu sed, porta consequat ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi quis nunc vel dui fringilla ullamcorper. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse mattis nulla ac blandit dapibus. Nulla semper aliquam porta. Suspendisse facilisis, nibh vel rutrum porttitor, ligula odio facilisis ante, sagittis hendrerit enim lectus vel quam. Aliquam elementum id lorem faucibus volutpat. Ut in dictum leo. Sed ligula ipsum, iaculis eu augue in, faucibus aliquam nibh.</p>
<p>Curabitur vulputate luctus feugiat. Suspendisse eget blandit nisl. Proin non magna sodales quam sollicitudin elementum ac a diam. Curabitur id massa quis sem iaculis interdum eget sit amet ligula. Integer fringilla dictum mauris ac pellentesque. Praesent suscipit lorem a eleifend consectetur. Mauris porta dui magna, et finibus justo fringilla vitae. Donec vel neque faucibus, commodo arcu eu, molestie lacus. Curabitur lobortis, urna in vehicula eleifend, massa mauris tincidunt purus, id rutrum diam dui ut ex. Praesent vitae turpis nec elit sodales porttitor a non eros. Praesent vel fringilla mi, eget suscipit sem. Morbi in fringilla eros.</p>
<p>Suspendisse bibendum leo nec libero tincidunt hendrerit. Pellentesque ultricies, orci eget ultricies cursus, purus augue scelerisque mi, ac rhoncus nisi velit id quam. Donec suscipit vehicula nisl vitae bibendum. Fusce ac lectus quis libero scelerisque accumsan. Donec fermentum mollis lectus, sit amet mollis libero lobortis eu. Nunc vitae tristique mauris. Nunc dui odio, varius vel varius lacinia, cursus at dolor. Vivamus varius arcu tempus tortor porttitor auctor. Proin nec gravida sem. Suspendisse vel ipsum ac risus imperdiet lobortis. Vestibulum luctus suscipit ex, in eleifend tellus malesuada vel. Morbi cursus sed mi a blandit. Praesent non erat et mauris lacinia ornare.</p>
<p>Integer convallis augue venenatis ultrices dictum. Aliquam at tellus consequat, varius mauris at, interdum risus. Sed et erat at orci tristique bibendum. Integer sagittis bibendum eros et venenatis. Sed fringilla felis a porttitor pellentesque. Fusce tristique turpis id ante porta posuere. Nam ac eleifend nisi. Nullam diam mi, vulputate quis felis id, feugiat pellentesque nunc. Praesent et feugiat nibh, a fermentum arcu. Donec ut dictum dolor, eget ullamcorper sapien. In vel velit at magna feugiat blandit.</p>
<p>Maecenas eget ex a eros tincidunt blandit. Praesent ut mi ipsum. In et blandit massa. Vivamus ornare orci eu arcu volutpat auctor. Nulla sed cursus diam. Donec nec elit sed libero lobortis iaculis eu id risus. Donec metus eros, volutpat eu porttitor et, dignissim eu nunc.</p>
<p>Integer semper dignissim varius. Phasellus rhoncus elit in molestie ultrices. Vivamus scelerisque sem in mauris bibendum, a pharetra turpis aliquam. Phasellus nec eros id tortor tincidunt tristique ac ac metus. Suspendisse at felis porta, tristique dui vel, varius nisi. Nullam laoreet facilisis ligula vitae viverra. Quisque tempor mi dui, at volutpat turpis sagittis sit amet. Quisque eu lectus vestibulum, blandit augue vitae, lobortis nisi. Fusce iaculis dolor vel lacinia consequat. Nullam nisl arcu, porta nec porttitor id, pretium nec sapien. Maecenas commodo tristique blandit. Mauris pharetra feugiat massa, nec iaculis metus tincidunt sagittis.</p>
<p>Aliquam erat volutpat. In molestie quam id lorem feugiat, id faucibus magna vestibulum. Suspendisse dignissim urna orci, in lacinia felis varius a. Aenean dignissim ligula at condimentum molestie. Aenean mattis neque ut massa scelerisque, in vehicula justo suscipit. Curabitur mi sapien, fringilla a libero a, consequat pharetra mauris. Aliquam vitae pellentesque leo. Fusce congue aliquam arcu, ut porta nulla scelerisque fermentum.</p>
<p>Integer suscipit ligula in sem venenatis euismod. Suspendisse quis iaculis leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eu porta lorem, sed semper magna. Aliquam quis aliquet diam, id interdum sapien. Mauris eget purus finibus, scelerisque lacus non, consectetur turpis. Nullam venenatis accumsan interdum. Vivamus non magna elit. Mauris quis diam semper, vehicula lectus non, vehicula felis.</p>
<p>Sed nec dapibus augue. Vivamus vehicula, nulla vitae aliquam ullamcorper, felis nibh vehicula orci, nec aliquet tortor nisl aliquam elit. Aenean nec porta magna. Vivamus sit amet mauris gravida, laoreet mauris non, consectetur massa. Ut et libero ullamcorper orci pulvinar venenatis suscipit nec eros. Suspendisse in eros sapien. Quisque urna lorem, rhoncus eget tincidunt quis, feugiat nec arcu. Phasellus eleifend, dui at pellentesque pharetra, felis nibh rhoncus ante, ac lobortis dui est eget nibh.</p>
<p>Integer commodo convallis magna sed fringilla. Fusce mauris tortor, placerat eget est consequat, lacinia scelerisque velit. Fusce posuere varius est sed vulputate. Nam ullamcorper ullamcorper augue, vel aliquet neque maximus vitae. In hac habitasse platea dictumst. Praesent imperdiet, elit et aliquet elementum, tellus tortor lacinia arcu, vel porta velit leo nec nisl. Duis efficitur egestas volutpat. Praesent a eros sed ante ullamcorper ultrices. Donec non hendrerit elit. Nam dui libero, tincidunt nec mollis vitae, consectetur eu dolor. Duis condimentum, augue finibus mattis congue, sem sem porta lorem, eget pretium tortor ex in dolor. Maecenas tempor est ex, et faucibus purus facilisis at.</p>
