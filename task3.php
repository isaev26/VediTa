<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("task3");

$arSelect = Array("ID", "NAME", "PRICE", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
$PRICE_TYPE_ID = 1;
?>
<table class="task3 table table-bordered">
    <thead>
        <tr>
            <th>Наименование товара</th>
            <th>Стоимость, руб.</th>
        </tr>
    </thead>
    <tbody>
        <?while($ob = $res->GetNextElement()):
            $arFields = $ob->GetFields();?>
        <tr>
            <td>
                <a href="<?= $arFields["DETAIL_PAGE_URL"] ?>"><?= $arFields["NAME"] ?></a>
            </td>
            <td>
        <?$db_res = CPrice::GetList(array(),array("PRODUCT_ID" => $arFields["ID"], 'CATALOG_GROUP_ID' => $PRICE_TYPE_ID));
        if ($ar_res = $db_res->Fetch()):?>
            <?=CurrencyFormat($ar_res["PRICE"], $ar_res["CURRENCY"]);?>
        <?endif?>
            </td>
        </tr>
        <?endwhile?>
    </tbody>
</table>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>