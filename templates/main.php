<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories as $value): ?>
        <!--заполните этот список из массива категорий-->
        <li class="promo__item promo__item--<?=htmlspecialchars($value['simbolic_code']); ?>">
            <a class="promo__link" href="pages/all-lots.html"><?=htmlspecialchars($value['title']); ?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($lots as $value): ?>
            <?php $timerFinishing = get_dt_range($value['completion_dt']); ?>
            <!--заполните этот список из массива с товарами-->
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=htmlspecialchars($value['category_id']); ?></span>
                    <h3 class="lot__title">
                        <a class="text-link" href="
                            <?=getLink($value['id']); ?>
                        "><?=htmlspecialchars($value['title']); ?></a>
                    </h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount"><?=htmlspecialchars($value['starting_price']); ?></span>
                            <span class="lot__cost"><?=formatPrice(htmlspecialchars($value['starting_price'])); ?></span>
                        </div>
                        <div class="lot__timer timer
                            <?php if ($timerFinishing[0] == 0 && $timerFinishing[1] != 0): ?>
                                timer--finishing
                            <?php endif; ?>"
                        >
                            <?=implode(':', $timerFinishing); ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
