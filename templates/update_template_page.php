<script defer src="../public/js/main.js" ></script>
<?php if (isset($this->getParams()['template'])) : ?>
<div class="add-content">

    <div class="add-content__top">
        <div class="add-content__inputs">
            <div class="inputs-back">
                <a href="/">
                    <img src="../public/images/Union.png" alt="">
                </a>

            </div>
            <div class="inputs-number">
                <input id="number" type="text" name="number" value=<?php echo ($this->getParams()['template']->number); ?> placeholder="###">
                <input id="id" type="hidden" value="<?php echo ($this->getParams()['template']->templateId); ?>">
            </div>
            <div class="inputs-title">
                <input id="title" type="text" value=<?php echo ($this->getParams()['template']->title); ?> name="title" placeholder="Design Title">
            </div>
        </div>
        <div class="add-content__btns">
            <div class="btns-remove">
                Удалить
            </div>
            <div id="UpdateButton" class="content-header__btn">
                Сохранить и закрыть
            </div>
        </div>
    </div>
    <div class="template-add">
        <input id="current-page" multiple type="file" value="<?php echo $this->getParams()['template']->pages;?>">
        <?php foreach($this->getParams()['template']->pages as $page):?>
            <div class="show">
                <img id="image" src="/public/<?php echo ($page); ?>" alt="">
                <img id="del" src="../public/images/delete.png" alt="" />
            </div>
        <?php endforeach?>
        <div class="template-add__btn">
            <input id="photo" multiple  type="file" name="photos[]">
            <label for="photo"><img src="../public/images/plus.png" alt=""></label>
        </div>
    </div>
    <div class="add-content_link">
        <input id="link" readonly type="text" value=<?php echo ($this->getParams()['template']->link); ?> placeholder="https://design###.horoshop.ua/">
    </div>

</div>
<?php endif; ?>
