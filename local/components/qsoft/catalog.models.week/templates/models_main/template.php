<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

?>
<pre>
	<?//var_dump($arResult)?>
</pre>



<h2 class="push_right">Модели недели</h2>
<section class="product_line">

	<?foreach ($arResult['ITEMS'] as $key => $item):?>
		<figure class="product_item">
			<?if ($item['PROPERTY_SALE_VALUE'] == 'Y'):?>
				<div class="product_item_label sale"></div>
			<?elseif ($item['PROPERTY_NEW_VALUE'] == 'Y'):?>
				<div class="product_item_label new"></div>
			<?endif?>
			<div class="product_item_pict">
				<a href="<?=$item['DETAIL_PAGE_URL']?>">
					<img 
						alt="<?=$item['NAME']?>"
						src="<?=$item["PICTURE"]["SRC"] ?? NO_IMAGE_PATH ?>" title="<?=$item['NAME']?>">
				</a>
			</div>
			<figcaption>
				<h3><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$item["NAME"]?></a></h3>

			 	<span class="product_item_price dark_grey old_price"><?=$item['CATALOG_PRICE_1']?> руб.</span>
				<p class="product_item_price dark_grey">
				 2 230 000 руб.
				</p>
			 	<a class="buy_button inverse inline-block pie" href="#">В корзину</a>
			</figcaption>
		</figure> 


	<?endforeach?>

</section>