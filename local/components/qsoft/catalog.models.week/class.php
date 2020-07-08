<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class ModelList extends CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
	{
		if(!isset($arParams["CACHE_TIME"]))
			$arParams["CACHE_TIME"] = 3600;

		if(!is_array($arParams["IBLOCKS"]))
			$arParams["IBLOCKS"] = intval($arParams["IBLOCKS"]);
		
		return $arParams;
	}

	public function executeComponent()
	{
		$this->checkModules();
		$this->getResult();
		$this->IncludeComponentTemplate();
		
	}


	protected function checkModules()
	{
		if(!CModule::IncludeModule("iblock")) {
			$this->AbortResultCache();
			ShowError(Loc::getMessage("IBLOCK_MODULE_NOT_INSTALLED"));
			return;
		}
	}


	protected function getResult()
	{
		if($this->StartResultCache($this->arParams["CACHE_TIME"])) {
	

			$arParams = $this->arParams;
			$arResult = $this->arResult;

			//SELECT
			$arSelect = array(
				"ID",
				"IBLOCK_ID",
				"CODE",
				"NAME",
				"DETAIL_PICTURE",
				"PREVIEW_PICTURE",
				"DETAIL_PAGE_URL",
				"PROPERTY_MODEL_WEEKS",
				"PROPERTY_MODEL_NEW",
				"PROPERTY_MODEL_SALE",
				"CATALOG_GROUP_1",

			);


			//ORDER BY
			$arSort = array(
				$arParams['SORT_FIELD'] => $arParams['ORDER'],
			);

			//WHERE
			$arFilter = array(
				"IBLOCK_ID" => $arParams["IBLOCKS"],
				"ACTIVE"=>"Y",
				'PROPERTY_MODEL_WEEKS_VALUE' => 'Y',
			);

			

			//EXECUTE
			$rsIBlockElement = CIBlockElement::GetList($arSort, $arFilter, false, $arParams['ELEMENTS_QUANTITY'] ? array("nTopCount" => $arParams['ELEMENTS_QUANTITY']) : false, $arSelect);

			?>


			<?
			$i = 0;
			while ($item = $rsIBlockElement->GetNext(true, false))
			{


				$arButtons = CIBlock::GetPanelButtons(
					$arParams['IBLOCKS'],
					$item['ID'],
					0,
					array("SECTION_BUTTONS"=>false, "SESSID"=>false)
				);	

				if (!$arResult['ADD_LINK']) {
					$arResult["ADD_LINK"] = $arButtons["edit"]["add_element"]["ACTION_URL"];
				}
				$item["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
				$item["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
				

				//$arResult[$item['ID']] = $item;
				$arResult["ITEMS"][] = $item;
				if ($item['PREVIEW_PICTURE']) {
					//$imgIDs[] = $arResult[$item['ID']]["PREVIEW_PICTURE"];		
					$imgIDs[] = $arResult["ITEMS"][$i]["PREVIEW_PICTURE"];		
				} else {
					$imgIDs[] = $arResult["ITEMS"][$i]["DETAIL_PICTURE"];
				}

				$i++;
			}


			if (! empty($imgIDs)) {
				$res = CFile::GetList($arSort, array('@ID' => $imgIDs));
				while($res_arr = $res->GetNext())
				{
		    		$imgPath[$res_arr['ID']] = CFile::GetFileSRC($res_arr);
				}

					foreach ($arResult['ITEMS'] as $key => $item) {
						if ($item['PREVIEW_PICTURE']) {

							$arResult['ITEMS'][$key]['PICTURE']['SRC'] = $imgPath[$item['PREVIEW_PICTURE']];
						}

					}
			}





			$this->arResult = $arResult;
			$this->SetResultCacheKeys(array(
			));
		
	
		}
	}


}?>