<script defer src="../public/js/main.js" ></script>
<div class="add-content">

    <div class="add-content__top">
        <div class="add-content__inputs">
            <div class="inputs-back">
                <a href="/">
                    <img src="../public/images/Union.png" alt="">
                </a>

            </div>
            <div class="inputs-number">
                <input id="number" type="text" name="number" placeholder="###">
            </div>
            <div class="inputs-title">
                <input id="title" type="text" name="title" placeholder="Design Title">
            </div>
        </div>
        <div class="add-content__btns">
            <div id="remove_new" class="btns-remove">
                Удалить
            </div>
            <div id="AddButton" class="content-header__btn">
                Сохранить и закрыть
            </div>
        </div>
    </div>
    <div class="template-add">
        <div class="template-add__btn">
            <input id="photo" multiple type="file" name="photos[]">
            <label for="photo"><img src="../public/images/plus.png" alt=""></label>
        </div>
    </div>
    <div class="add-content_link">
        <input id="link" readonly type="text" placeholder="https://design###.horoshop.ua/">
    </div>

</div>

