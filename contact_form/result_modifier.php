<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * @var array $arResult
 */
foreach ($arResult["QUESTIONS"] as $FIELD_SID => &$arQuestion) {
    if (!empty($arQuestion["HTML_CODE"])) {
        $arQuestion["HTML_CODE"] = str_replace(
            'class="inputtext"',
            'class="input__input"',
            $arQuestion["HTML_CODE"]
        );
        $arQuestion["HTML_CODE"] = str_replace(
            'class="inputtextarea"',
            'class="input__input"',
            $arQuestion["HTML_CODE"]
        );
    }
}
unset($arQuestion);
?>