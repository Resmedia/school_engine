<?

use app\models\Product;

include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

// TODO to test add refresh this page
// TODO to test update uncomment 15, 29
// TODO to test delete uncomment 38-42 and comment 29-36

$attributes = [
    //'id' => 30,
    'name' => 'Donec sollicitudin molestie malesuada!',
    'full_desc' => 'Donec sollicitudin molestie malesuada. Donec rutrum congue leo eget malesuada. 
            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec 
            velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur non nulla sit 
            amet nisl tempus convallis quis ac lectus.Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Nulla porttitor accumsan tincidunt.',
    'price' => 3004,
    'views' => 12,
    'time_create' => time(),
    'time_update' => time(),
];

$product = new Product();
//$product->id = $attributes['id'];
$product->name = $attributes['name'];
$product->full_desc = $attributes['full_desc'];
$product->price = $attributes['price'];
$product->views = $attributes['views'];
$product->time_create = $attributes['time_create'];
$product->time_update = $attributes['time_update'];
$product->save();

/*$attrToDel = [
    'id' => 26
];
$product->id = $attrToDel['id'];
$product->remove();*/

echo '<br/> getAll() - массив<br/><br/>';
foreach ($product->getAll() as $productItem){
    echo "<div>ID = {$productItem['id']}</div>
<div>NAME = {$productItem['name']}</div>
<div>FULL_DESC = {$productItem['full_desc']}</div>
<div>PRICE = {$productItem['price']}</div>
<div>VIEWS = {$productItem['views']}</div>
<div>TIME_CREATE = {$productItem['time_create']}</div>
<div>TIME_UPDATE = {$productItem['time_update']}</div>
<br/>";
}

echo '<br/>';
echo '<br/> getOne() - объект<br/><br/>';
$item = $product->getOne(8);
/** @var $item \app\models\Product */
print_r('ID = ' . $item->id . '<br/>');
print_r('NAME = ' . $item->name . '<br/><br/>');
print_r('FULL_DESC = ' . $item->full_desc . '<br/><br/>');
print_r('PRICE = ' . $item->price . '<br/><br/>');
print_r('VIEWS = ' . $item->views . '<br/>');
echo '<br/>';
echo 'Категории: ';
foreach ($product->getItemCategories($item->id) as $category) {
    echo $category['name'] . ', ';
}
