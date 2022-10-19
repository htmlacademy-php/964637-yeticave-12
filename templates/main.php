<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories as $value) : ?>
            <!--заполните этот список из массива категорий-->
            <li class="promo__item promo__item--<?= strip_tags($value['symbolic_code']); ?>">
                <a class="promo__link" href="pages/all-lots.html"><?= strip_tags($value['title']); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($lots as $value) : ?>
            <?php $timerFinishing = get_dt_range($value['lot_date']); ?>
            <?php $zeroTime = 0; ?>
            <!--заполните этот список из массива с товарами-->
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="../<?= $value['lot_img']; ?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= strip_tags($value['category_title']); ?></span>
                    <h3 class="lot__title">
                        <a class="text-link" href="
                            <?= getLink($value['id']); ?>
                        "><?= strip_tags($value['lot_name']); ?></a>
                    </h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount"><?= strip_tags($value['lot_rate']); ?></span>
                            <span class="lot__cost"><?= formatPrice(strip_tags($value['current_bet'] ?? $value['lot_rate'])); ?></span>
                        </div>
                        <div class="lot__timer timer
                            <?php if ($timerFinishing[0] === $zeroTime && $timerFinishing[1] !== $zeroTime) : ?>
                                timer--finishing
                            <?php endif; ?>">
                            <?= implode(':', $timerFinishing); ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>