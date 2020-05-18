
<div class="content">
            <div class="content-header">
                <div class="content-header__title">
                    Все дизайны
                </div>
                <div class="content-header__btn">
                    <a class="btn btn-primary" href="/template">Добавить дизайн</a>
                </div>
            </div>

                <?php if (isset($this->getParams()['templates'])) : ?>
                <div class="templates-wrapper">
                    <?php foreach($this->getParams()['templates'] as $template):?>
                    <form action="/template/getTemplateByID" method="post">
                        <input type="hidden" name="idTemplate" value=<?php echo ($template->templateId); ?>>
                        <div class="template-box" >
                                <button type="submit" class="template-box__image" style="background-image: url(<?php echo ($template->pages[0]); ?>)">

                                </button>
                                <div class="template-box__info">
                                    <div class="info-number">
                                        <?php echo ($template->number); ?>
                                    </div>
                                    <div class="info-name">
                                        <?php echo ($template->title); ?>
                                    </div>
                                </div>
                        </div>
                    </form>

                    <?php endforeach?>
                </div>
                <?php endif; ?>


            <?php if (!isset($this->getParams()['templates'])) : ?>
                <div class="content-notfound">
                    В базе данных нет шаблонов!
                </div>

            <?php endif; ?>
        </div>
