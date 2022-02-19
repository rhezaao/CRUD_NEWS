<?php $pager->setSurroundCount(2); ?>
 
<ul class="pagination pagination-rounded justify-content-center mt-3 mb-4 pb-1">
    <?php
        $disabledPrev = $pager->hasPrevious()?'':'disabled';
        $disabledNext = $pager->hasNext()?'':'disabled';
    ?>
    <li class="page-item <?= $disabledPrev ?>">
        <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
        </a>
    </li>
 
    <li class="page-item <?= $disabledPrev ?>">
        <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Previous">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </a>
    </li>
 
    <?php
        foreach ($pager->links() as $link) {
            $activeclass = $link['active']?'active':'';
    ?>
    <li class="page-item <?= $activeclass ?>">
        <a class="page-link" href="<?= $link['uri'] ?>" aria-label="Page <?= $link['title'] ?>">
            <?= $link['title'] ?>
        </a>
    </li>
    <?php } ?>
 
    <li class="page-item <?= $disabledNext ?>">
        <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="Next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </a>
    </li>
 
    <li class="page-item <?= $disabledNext ?>">
        <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        </a>
    </li>
</ul>