<?php
// Pic
$pic_desktop = get_field('desktop_banner');
$pic_mobile = get_field('mobile_banner');

// start-end Date
$start_date = get_field('start_date');
$end_date = get_field('end_date') ? get_field('end_date') : get_field('start_date');

// Block ID
$block_id = $block['id'];
$block_id = str_replace('block_', 'banner_', $block['id']);

// Link?
if (get_field('has_link')) {
    $link_begin = '<a href="' . get_field('link') . '" target="_blank">';
    $link_end = '</a>';
} else {
    $link_begin = '';
    $link_end = '';
}

// Position Choice
$choice = get_field('display');
if($choice == 'lightbox') {
    ?>
<script>
    const modalEvent = localStorage.getItem('<?php echo $block_id; ?>');
    if (modalEvent == null) {
        document.body.classList.add('modal-active');
        setTimeout(() => {
            let banner = document.querySelector('#<?php echo $block_id; ?>');
            banner.style.display = 'block';
        }, 300);
    } else {
        setTimeout(() => {
            let banner = document.querySelector('#<?php echo $block_id; ?>');
            banner.remove();
        }, 300);
    }
</script>
<?php
}

// Check logic
if($start_date) {
    $now = intval(strtotime(date_i18n('Y-m-d')));
    $start = intval(strtotime($start_date));
    $end = intval(strtotime($end_date));

    if(($now >= $start) && ($now <= $end)) {
        $show = true;
    } else {
        $show = false;
    }
} else {
    $show = true;
}
?>
<!-- Display Banners -->
<?php if($show == true):  ?>
<?php if($choice == 'block'): ?>
<div class="p-banner-block">
    <?php echo $link_begin; ?>
    <div class="_mobile">
        <?php echo wp_get_attachment_image($pic_mobile, 'full'); ?>
    </div>
    <div class="_desktop">
        <?php echo wp_get_attachment_image($pic_desktop, 'full'); ?>
    </div>
    <?php echo $link_end; ?>
</div>
<?php else: ?>
<div class="p-banner-modal" id="<?php echo $block_id; ?>">
    <a href="#" class="modal-close" title="Close" onclick="sCloseBanner('<?php echo $block_id; ?>')">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
        </svg>
    </a>
    <?php echo $link_begin; ?>
    <div class="p-banner-event _mobile">
        <?php echo wp_get_attachment_image($pic_mobile, 'full'); ?>
    </div>
    <div class="p-banner-event _desktop">
        <?php echo wp_get_attachment_image($pic_desktop, 'full'); ?>
    </div>
    <?php echo $link_end; ?>
</div>
<?php endif; ?>
<?php endif; ?>
<style>
    .p-banner-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        width: 100%;
        max-width: 720px;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        overflow-y: auto;
        max-height: 100vh;
    }

    .modal-close {
        background: #000;
        color: #999;
        display: flex;
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        border-radius: 100px;
        width: 32px;
        height: 32px;
        justify-content: center;
        align-items: center;
        z-index: 10;
    }

    .modal-close:hover {
        color: #fff;
    }

    .p-banner-block img,
    .p-banner-modal img {
        width: 100%;
    }
</style>