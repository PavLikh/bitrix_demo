<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_MODEL_LIST"),
	"DESCRIPTION" => GetMessage("T_IBLOCK_DESC_MODEL_DESC"),
	"ICON" => "/images/photo_view.gif",
	"CACHE_PATH" => "Y",
	"SORT" => 40,
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "salon",
			"NAME" => GetMessage("T_IBLOCK_DESC_MODEL"),
			"SORT" => 20,
		)
	),
);

?>
