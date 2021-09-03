<?php $__env->startPush('script-page'); ?>

    <script src="<?php echo e(asset('assets/js/dragula.min.js')); ?>"></script>

    <script>
        !function (a) {
            "use strict";
            var t = function () {
                this.$body = a("body")
            };
            t.prototype.init = function () {
                a('[data-plugin="dragula"]').each(function () {
                    var t = a(this).data("containers"), n = [];
                    if (t) for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]); else n = [a(this)[0]];
                    var r = a(this).data("handleclass");
                    r ? dragula(n, {
                        moves: function (a, t, n) {
                            return n.classList.contains(r)
                        }
                    }) : dragula(n).on('drop', function (el, target, source, sibling) {

                        var order = [];
                        $("#" + target.id + " > div").each(function () {
                            order[$(this).index()] = $(this).attr('data-id');
                        });

                        var id = $(el).attr('data-id');
                        var stage_id = $(target).attr('data-id');

                        $("#" + source.id).parent().find('.count').text($("#" + source.id + " > div").length);
                        $("#" + target.id).parent().find('.count').text($("#" + target.id + " > div").length);

                        $.ajax({
                            url: '<?php echo e(route('leads.order')); ?>',
                            type: 'POST',
                            data: {lead_id: id, stage_id: stage_id, order: order, "_token": $('meta[name="csrf-token"]').attr('content')},
                            success: function (data) {
                                toastrs('Success', 'Lead successfully updated', 'success');
                            },
                            error: function (data) {
                                data = data.responseJSON;
                                toastrs('Error', data.error, 'error')
                            }
                        });
                    });
                })
            }, a.Dragula = new t, a.Dragula.Constructor = t
        }(window.jQuery), function (a) {
            "use strict";

            a.Dragula.init()

        }(window.jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php
    $profile=asset(Storage::url('avatar/'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Lead')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Lead')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Lead')); ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4><?php echo e(__('Manage Lead')); ?></h4>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create lead')): ?>
                                <span class="create-btn">
                                    <a href="#" data-url="<?php echo e(route('leads.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Lead')); ?>" class="btn btn-sm btn-warning">
                                        <i class="fa fa-plus"></i> &nbsp;<?php echo e(__('Create')); ?>

                                    </a>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                        $json = [];
                        foreach ($stages as $stage){
                            $json[] = 'lead-list-'.$stage->id;
                        }
                    ?>

                    <div class="board" data-plugin="dragula" data-containers='<?php echo json_encode($json); ?>'>
                        <div class="card-body">
                            <div class="lead-wrap">
                                <div class="row">
                                    <div class="custom-scroll-horizontal">
                                        <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(\Auth::user()->type == 'company'): ?>
                                                <?php ($leads = $stage->leads); ?>
                                            <?php else: ?>
                                                <?php ($leads = $stage->user_leads()); ?>
                                            <?php endif; ?>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="lead-grp">
                                                    <div class="lead-grp-title"><?php echo e($stage->name); ?> (<?php echo e(count($leads)); ?>)</div>

                                                    <div class="custom-scroll" id="lead-list-<?php echo e($stage->id); ?>" data-id="<?php echo e($stage->id); ?>">
                                                        <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="lead lead-grid-view" data-id="<?php echo e($lead->id); ?>">
                                                                <div class="more-action">
                                                                    <div class="dropdown">
                                                                        <a href="" class="btn dropdown-toggle" data-toggle="dropdown">
                                                                            <svg width="18" height="4" viewBox="0 0 18 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M1.13672 0.804688C1.42318 0.518229 1.7526 0.375 2.125 0.375C2.4974 0.375 2.8125 0.518229 3.07031 0.804688C3.35677 1.0625 3.5 1.3776 3.5 1.75C3.5 2.1224 3.35677 2.45182 3.07031 2.73828C2.8125 2.99609 2.4974 3.125 2.125 3.125C1.7526 3.125 1.42318 2.99609 1.13672 2.73828C0.878906 2.45182 0.75 2.1224 0.75 1.75C0.75 1.3776 0.878906 1.0625 1.13672 0.804688ZM8.01172 0.804688C8.29818 0.518229 8.6276 0.375 9 0.375C9.3724 0.375 9.6875 0.518229 9.94531 0.804688C10.2318 1.0625 10.375 1.3776 10.375 1.75C10.375 2.1224 10.2318 2.45182 9.94531 2.73828C9.6875 2.99609 9.3724 3.125 9 3.125C8.6276 3.125 8.29818 2.99609 8.01172 2.73828C7.75391 2.45182 7.625 2.1224 7.625 1.75C7.625 1.3776 7.75391 1.0625 8.01172 0.804688ZM14.8867 0.804688C15.1732 0.518229 15.5026 0.375 15.875 0.375C16.2474 0.375 16.5625 0.518229 16.8203 0.804688C17.1068 1.0625 17.25 1.3776 17.25 1.75C17.25 2.1224 17.1068 2.45182 16.8203 2.73828C16.5625 2.99609 16.2474 3.125 15.875 3.125C15.5026 3.125 15.1732 2.99609 14.8867 2.73828C14.6289 2.45182 14.5 2.1224 14.5 1.75C14.5 1.3776 14.6289 1.0625 14.8867 0.804688Z"
                                                                                    fill="#778CA2"></path>
                                                                            </svg>
                                                                        </a>
                                                                        <div class="dropdown-menu">
                                                                            <?php if(Gate::check('edit lead') || Gate::check('delete lead')): ?>
                                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit lead')): ?>
                                                                                    <a class="dropdown-item" data-url="<?php echo e(route('leads.edit',$lead->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Lead')); ?>" href="#">Edit</a>
                                                                                <?php endif; ?>
                                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete lead')): ?>
                                                                                    <a class="dropdown-item" href="#" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($lead->id); ?>').submit();">Delete</a>

                                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['leads.destroy', $lead->id],'id'=>'delete-form-'.$lead->id]); ?>

                                                                                    <?php echo Form::close(); ?>

                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="title mb-1">
                                                                    <a class="dropdown-item p-0 task-inner-title" data-toggle="modal" data-target="#task-inner-Modal" href="#">
                                                                        <?php echo e($lead->name); ?>

                                                                    </a>
                                                                </div>
                                                                <div class="meta-info mb-1">
                                                                    <p><?php echo e($lead->notes); ?>

                                                                    </p>
                                                                </div>
                                                                <div class="footer-wrap">
                                                                    <div class="date">
                                                                        <i class="far fa-clock"></i>
                                                                        <span class="pl-1"> <?php echo e(\Auth::user()->dateFormat($lead->created_at)); ?> </span>
                                                                    </div>
                                                                    <div class="date">

                                                                        <span class="pl-1"> <?php echo e(\Auth::user()->priceFormat($lead->price)); ?> </span>
                                                                    </div>

                                                                    <div class="avatar">
                                                                        <?php if(\Auth::user()->type=='company'): ?>
                                                                            <a href="#" class="" data-toggle="tooltip" title="" data-original-title="<?php echo e((!empty($lead->user())?$lead->user()->name:'')); ?>">
                                                                                <img src="<?php echo e((!empty($lead->user()->avatar))? $profile.'/'.$lead->user()->avatar : asset(Storage::url("avatar/avatar.png"))); ?>" class="">
                                                                            </a>
                                                                        <?php else: ?>
                                                                            <a href="#" class="" data-toggle="tooltip" title="" data-original-title="<?php echo e((!empty($lead->client())?$lead->client()->name:'')); ?>">
                                                                                <img src="<?php echo e((!empty($lead->user()->avatar))? $profile.'/'.$lead->user()->avatar : asset(Storage::url("avatar/avatar.png"))); ?>" class="">
                                                                            </a>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/leads/index.blade.php ENDPATH**/ ?>