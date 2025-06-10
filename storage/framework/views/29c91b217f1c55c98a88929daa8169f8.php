<?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(isset($msg['fields']['userId2']['stringValue']) && $msg['fields']['userId2']['stringValue'] == $data['ticketId']): ?>
        <div class="chat__box__text-box flex items-end float-left mb-4">
            <div class="bg-slate-100 dark:bg-darkmode-400 px-4 py-3 text-slate-500 rounded-r-md rounded-t-md">
                <?php echo e($msg['fields']['message']['stringValue'] ?? ''); ?>

            </div>
        </div>
        <div class="clear-both"></div>
    <?php else: ?>
        <div class="chat__box__text-box flex items-end mb-4" style="float: right">
            <div class="bg-primary px-4 py-3 text-white rounded-l-md rounded-t-md ">
                <?php echo e($msg['fields']['message']['stringValue'] ?? ''); ?>

            </div>
        </div>
        <div class="clear-both"></div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home2/drodifyt/astromatch.drodifytechnology.com/resources/views/pages/chat_live.blade.php ENDPATH**/ ?>