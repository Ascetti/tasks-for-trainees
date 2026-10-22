<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @var array $arResult
 */
?>
<?php if ($arResult["isFormErrors"] == "Y"): ?>
    <?= $arResult["FORM_ERRORS_TEXT"]; ?>
<?php endif; ?>
<?= $arResult["FORM_NOTE"] ?? ''; ?>
<?php if ($arResult["isFormNote"] != "Y"): ?>
    <?= $arResult["FORM_HEADER"] ?>
    <div class="contact-form">
        <?php if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y"): ?>
            <div class="contact-form__head">
                <?php if ($arResult["isFormTitle"] == "Y"): ?>
                    <div class="contact-form__head-title">
                        <?= $arResult["FORM_TITLE"] ?>
                    </div>
                <?php endif; ?>
                <?php if ($arResult["isFormDescription"] == "Y"): ?>
                    <div class="contact-form__head-text">
                        <?= $arResult["FORM_DESCRIPTION"] ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="contact-form__form">
            <div class="contact-form__form-inputs">
                <?php foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
                    <?php
                    // Скрытые поля
                    if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "hidden") {
                        echo $arQuestion["HTML_CODE"];
                        continue;
                    }
                    // Текстовые поля
                    if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "textarea") {
                        continue;
                    }
                    ?>
                    <div class="input contact-form__input">
                        <label class="input__label">
                            <div class="input__label-text">
                                <?= $arQuestion["CAPTION"] ?>
                                <?php if ($arQuestion["REQUIRED"] == "Y"): ?>
                                    <?= $arResult["REQUIRED_SIGN"]; ?>
                                <?php endif; ?>
                            </div>
                            <?= $arQuestion["HTML_CODE"] ?>
                            <?php if (isset($arResult["FORM_ERRORS"][$FIELD_SID])): ?>
                                <div class="input__notification">
                                    <?= htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID]) ?>
                                </div>
                            <?php endif; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="contact-form__form-message">
                <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
                    <? if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'textarea'): ?>
                        <div class="input">
                            <label class="input__label" for="<?= $FIELD_SID ?>">
                                <div class="input__label-text">
                                    <?= $arQuestion["CAPTION"] ?>
                                    <? if ($arQuestion["REQUIRED"] == "Y"): ?><?= $arResult["REQUIRED_SIGN"] ?><? endif; ?>
                                </div>
                                <?= $arQuestion["HTML_CODE"] ?>
                                <? if (isset($arResult["FORM_ERRORS"][$FIELD_SID])): ?>
                                    <div class="input__notification">
                                        <?= htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID]) ?>
                                    </div>
                                <? endif; ?>
                            </label>
                        </div>
                    <? endif; ?>
                <? endforeach; ?>
            </div>
            <?php if ($arResult["isUseCaptcha"] == "Y"): ?>
                <div class="input contact-form__input">
                    <label class="input__label">
                        <div class="input__label-text"> <?= GetMessage("FORM_CAPTCHA_TABLE_TITLE") ?></div>
                        <input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]) ?>">
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]) ?>"
                            width="180" height="40" alt="">
                        <div class="input__label-text"><?= GetMessage("FORM_CAPTCHA_FIELD_TITLE") ?><?= $arResult["REQUIRED_SIGN"] ?></div>
                        <input type="text" name="captcha_word" class="input__input" value="">
                        <? if (isset($arResult["FORM_ERRORS"][0])): ?>
                            <div class="input__notification">
                                <?= htmlspecialcharsbx($arResult["FORM_ERRORS"][0]) ?>
                            </div>
                        <? endif; ?>
                    </label>
                </div>
            <?php endif; ?>
            <div class="contact-form__bottom">
                <div class="contact-form__bottom-policy">
                    Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
                    ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных
                    данных&raquo;.
                </div>
                <button class="form-button contact-form__bottom-button" type="submit"
                    name="web_form_submit"
                    value="<?= htmlspecialcharsbx(
                                trim($arResult["arForm"]["BUTTON"]) == ''
                                    ? GetMessage("FORM_ADD")
                                    : $arResult["arForm"]["BUTTON"]
                            ); ?>"
                    <?= (intval($arResult["F_RIGHT"]) < 10)
                        ? 'disabled="disabled"'
                        : ''; ?>>
                    <div class="form-button__title">
                        <?= htmlspecialcharsbx(
                            trim($arResult["arForm"]["BUTTON"]) == ''
                                ? GetMessage("FORM_ADD")
                                : $arResult["arForm"]["BUTTON"]
                        ); ?>
                    </div>
                </button>
            </div>
        </div>
    </div>
    <?= $arResult["FORM_FOOTER"] ?>
<?php endif; ?>