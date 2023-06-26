<?php if (isset($flash['toast'])) :  ?>
  <span id="toastify" class="d-none" data-type="<?= $flash['toast']['type'] ?>" data-msg="<?= $flash['toast']['msg'] ?>"></span>
<?php endif; ?>