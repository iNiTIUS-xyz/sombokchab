<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <title><?php echo e(__('Inventory Stock Warning')); ?> <?php echo e(get_static_option('site_title')); ?></title>
        <style>
            *{
                font-family: 'Montserrat', sans-serif;
            }
            body {
                background-color: #fdfdfd;
            }
            .mail-container {
                max-width: 650px;
                margin: 50px auto;
                text-align: center;
            }

            .mail-container .logo-wrapper {
                padding: 20px 0 20px;
                border-bottom: 5px solid <?php echo e(get_static_option('site_color')); ?>;
            }
            table {
                margin: 0 auto;
            }
            table {

                border-collapse: collapse;
                width: 100%;
            }

            table td, table th {
                border: 1px solid rgba(0,0,0,.05);
                padding: 10px 20px;
                background-color: #fafafa;
                text-align: left;
                font-size: 14px;
            }

            table tr:nth-child(even){background-color: #f2f2f2;}

            table tr:hover {background-color: #ddd;}

            table th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: <?php echo e(get_static_option('site_color')); ?>;
                color: white;
            }
            footer {
                margin: 20px 0;
                font-size: 14px;
            }
            .main-content-wrap {
                background-color: #fff;
                box-shadow: 0 0 15px 0 rgba(0,0,0,.05);
                padding: 30px;
            }

            .main-content-wrap p {
                margin: 0;
                text-align: left;
                font-size: 14px;
                line-height: 26px;
            }

            .main-content-wrap p:first-child {
                margin-bottom: 10px;
            }
            table {
                margin-bottom: 30px;
            }
            .logo-wrapper img{
                max-width: 200px;
            }
        </style>
    </head>
    <body>
        <div class="mail-container">
            <div class="logo-wrapper">
                <a href="<?php echo e(url('/')); ?>">
                    <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                </a>
            </div>
            <div class="main-content-wrap">
                <p><?php echo e(__('Hello')); ?></p>
                <p><?php echo e(get_static_option('stock_warning_message') ?? __('Following products stock are running low,')); ?></p>

                <table style="margin-top: 10px">
                    <?php $__currentLoopData = $stock_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                                <td><strong><?php echo e(__('Product Name')); ?></strong></td>
                                <td>
                                    <a href="<?php echo e(route('admin.products.edit', $item->id)); ?>"> <?php echo e($item->name); ?> </a>
                                </td>

                                <td><strong><?php echo e(__('Stock')); ?></strong></td>
                                <td><?php echo e($item->stock); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>

            <footer>
                <?php echo get_footer_copyright_text(); ?>

            </footer>
        </div>
    </body>
</html>

<?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Inventory\Resources/views/emails/stock_out.blade.php ENDPATH**/ ?>