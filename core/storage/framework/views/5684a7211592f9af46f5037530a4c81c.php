<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(__("Invoice")); ?></title>

    <style>

    </style>

</head>
<body>
<center>
    <table align="center" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" role="presentation"
           style="max-width:550px;width:550px;background-color:#ffffff;background:#ffffff;border:2px solid #ececec"
           width="550">
        <tbody>
        <tr align="center">
            <td align="center">
                <table align="center" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" role="presentation"
                       style="width:100%;background-color:#ffffff;background:#ffffff" width="100%">
                    <tbody>
                    <tr align="center">
                        <td align="center">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                   style="width:100%" width="100%">
                                <tbody>
                                <tr>
                                    <td align="center" style="padding-top:25px" valign="middle">
                                        <a href="#0" style="display:block;text-decoration:none">
                                            <?php echo render_image_markup_by_attachment_id(get_static_option("site_logo")); ?>

                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr align="center">
                        <td align="center" style="padding-top:12px;padding-bottom:12px">
                            <table align="center" bgcolor="#ECECEC" border="0" cellpadding="0" cellspacing="0"
                                   role="presentation" style="width:100%;background-color:#ececec;background:#ececec"
                                   width="100%">
                                <tbody>
                                <tr>
                                    <td align="center"
                                        style="font-size:2px;font-style:normal;line-height:2px;font-weight:300;font-family:'Roboto','Arial',sans-serif;padding-bottom:2px;padding-top:2px"
                                        valign="middle">&nbsp;
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr align="center">
                        <td align="center" style="padding-right:20px;padding-left:20px">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                   style="width:100%" width="100%">
                                <tbody>
                                <tr>
                                    <td align="left"
                                        style="color:#3f3f3f;font-size:18px;font-style:normal;line-height:24px;font-weight:700;font-family:'Roboto','Arial',sans-serif;padding-bottom:16px"
                                        valign="middle">
                                        <?php echo e(__("Delivery Details")); ?>

                                    </td>
                                </tr>
                                <tr align="center">
                                    <td align="center">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                               role="presentation" style="width:100%" width="100%">
                                            <tbody>
                                            <tr>
                                                <td align="left" width="100"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:22px;font-weight:400;font-family:'Roboto','Arial',sans-serif;padding-bottom:8px;width:100px"
                                                    valign="top">
                                                    <?php echo e(__("Name:")); ?>

                                                </td>
                                                <td align="left"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:22px;font-weight:400;font-family:'Roboto','Arial',sans-serif;padding-bottom:8px"
                                                    valign="top">
                                                    <?php echo e($request["name"]); ?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" width="100"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:22px;font-weight:400;font-family:'Roboto','Arial',sans-serif;padding-bottom:8px;width:100px"
                                                    valign="top">
                                                    <?php echo e(__("Address:")); ?>

                                                </td>
                                                <td align="left"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:22px;font-weight:400;font-family:'Roboto','Arial',sans-serif;padding-bottom:8px"
                                                    valign="top">
                                                    <?php echo e($request["address"]); ?>,<?php echo e($request["city"]); ?>, <?php echo e($state?->name); ?>

                                                    ,
                                                    <?php echo e($country?->name); ?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" width="100"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:22px;font-weight:400;font-family:'Roboto','Arial',sans-serif;padding-bottom:8px;width:100px"
                                                    valign="top">
                                                    <?php echo e(__("Phone:")); ?>

                                                </td>
                                                <td align="left"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:22px;font-weight:400;font-family:'Roboto','Arial',sans-serif;padding-bottom:8px"
                                                    valign="top">
                                                    <?php echo e($request["phone"]); ?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" width="100"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:22px;font-weight:400;font-family:'Roboto','Arial',sans-serif;width:100px"
                                                    valign="top">
                                                    <?php echo e(__("Email:")); ?>

                                                </td>
                                                <td align="left"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:22px;font-weight:400;font-family:'Roboto','Arial',sans-serif"
                                                    valign="top">
                                                    <a href="#1"
                                                       style="color:#3f3f3f!important;text-decoration:none"><span
                                                                style="color:#3f3f3f"><?php echo e($request["email"]); ?></span></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr align="center">
                        <td align="center" style="padding-top:12px;padding-bottom:12px">
                            <table align="center" bgcolor="#ECECEC" border="0" cellpadding="0" cellspacing="0"
                                   role="presentation" style="width:100%;background-color:#ececec;background:#ececec"
                                   width="100%">
                                <tbody>
                                <tr>
                                    <td align="center"
                                        style="font-size:2px;font-style:normal;line-height:2px;font-weight:300;font-family:'Roboto','Arial',sans-serif;padding-bottom:2px;padding-top:2px"
                                        valign="middle">&nbsp;
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr align="center">
                        <td align="center" style="padding-right:20px;padding-left:20px">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                   style="width:100%" width="100%">
                                <tbody>
                                <tr>
                                    <td>
                                        <div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left"
                                        style="color:#3f3f3f;font-size:18px;font-style:normal;line-height:24px;font-weight:700;font-family:'Roboto','Arial',sans-serif;padding-bottom:16px"
                                        valign="middle">
                                        <?php echo e(__("Order Details")); ?>

                                    </td>
                                </tr>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr align="center">
                                        <td>
                                            <hr/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <table align="center" border="0" cellpadding="0" cellspacing="0"
                                                   role="presentation" style="width:100%" width="100%">
                                                <tbody>
                                                <tr>
                                                    <td align="left"
                                                        style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:24px;font-weight:400;font-family:'Roboto','Arial',sans-serif;padding-bottom:12px"
                                                        valign="middle">
                                                        <?php echo e(__("Order ID: ")); ?> <b><?php echo e(__('#').$mainOrder?->order_number); ?></b><br>
                                                        <?php echo e(__("ITEM")); ?> <?php echo e($order?->orderItem?->count()); ?> <br>
                                                        <?php echo e(__("Sold By:")); ?> <?php echo e($order->vendor?->business_name); ?>

                                                    </td>
                                                </tr>
                                                <tr align="center">
                                                    <td align="center" valign="middle">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0"
                                                               role="presentation" style="width:500px" width="500">
                                                            <tbody>
                                                            <?php
                                                                $order_sum = 0;
                                                            ?>
                                                            <?php $__currentLoopData = $order?->orderItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                <?php
                                                                    $prd_image = $orderItem->product->image;

                                                                    if(!empty($orderItem->variant?->attr_image)){
                                                                        $prd_image = $orderItem->variant->attr_image;
                                                                    }

                                                                    $order_sum += $orderItem->price * $orderItem->quantity;
                                                                ?>
                                                                <tr align="center">
                                                                    <td align="left"
                                                                        style="padding-bottom:10px;padding-top:10px"
                                                                        valign="middle">
                                                                        <table align="left" border="0" cellpadding="0"
                                                                               cellspacing="0" role="presentation"
                                                                               style="width:150px" width="180">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td align="left" valign="middle">
                                                                                    <a href="#1" style="display:block">
                                                                                        <img alt="" border="0"
                                                                                             src="<?php echo e(render_image($prd_image,render_type: 'path')); ?>"
                                                                                             style="width:110px;display:block;vertical-align:middle;border:0;height:auto;padding:0px;margin:0px"
                                                                                             width="110">
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table align="right" border="0" cellpadding="0"
                                                                               cellspacing="0" role="presentation"
                                                                               style="width:340px" width="340">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td align="left" height="90"
                                                                                    style="height:90px"
                                                                                    valign="middle">
                                                                                    <table align="left" border="0"
                                                                                           cellpadding="0"
                                                                                           cellspacing="0"
                                                                                           role="presentation"
                                                                                           width="100%">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td align="left"
                                                                                                style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:22px;font-weight:400;font-family:'Roboto','Arial',sans-serif;padding-bottom:20px"
                                                                                                valign="middle">
                                                                                                <b><?php echo e($orderItem?->product?->name); ?></b>
                                                                                                <br/>
                                                                                                <?php echo e($orderItem?->variant?->productColor ? __("Color:") . $orderItem?->variant?->productColor?->name . ' , ' : ""); ?>

                                                                                                <?php echo e($orderItem?->variant?->productSize ? __("Size:") . $orderItem?->variant?->productSize?->name . ' , ' : ""); ?>

                                                                                                <?php $__currentLoopData = $orderItem?->variant?->attribute ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                    <?php echo e($attr->attribute_name); ?>

                                                                                                    : <?php echo e($attr->attribute_value); ?>


                                                                                                    <?php if(!$loop->last): ?>
                                                                                                        ,
                                                                                                    <?php endif; ?>
                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="left"
                                                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:24px;font-weight:400;font-family:'Roboto','Arial',sans-serif"
                                                                                    valign="middle">
                                                                                    <?php echo e(float_amount_with_currency_symbol($orderItem?->price)); ?>

                                                                                    <br>
                                                                                    x <?php echo e($orderItem->quantity); ?>

                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr align="center">
                        <td align="center" style="padding-top:12px;padding-bottom:12px">
                            <table align="center" bgcolor="#ECECEC" border="0" cellpadding="0" cellspacing="0"
                                   role="presentation" style="width:100%;background-color:#ececec;background:#ececec"
                                   width="100%">
                                <tbody>
                                <tr>
                                    <td align="center"
                                        style="font-size:2px;font-style:normal;line-height:2px;font-weight:300;font-family:'Roboto','Arial',sans-serif;padding-bottom:2px;padding-top:2px"
                                        valign="middle">&nbsp;
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <?php
                        $paymentOrder = $orders?->first();
                    ?>

                    <tr align="center">
                        <td align="center" style="padding-right:20px;padding-left:20px">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                   style="width:100%" width="100%">
                                <tbody>
                                <tr align="center">
                                    <td align="center" valign="middle">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                               role="presentation" style="width:100%" width="100%">
                                            <tbody>
                                            <tr>
                                                <td align="left"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:24px;font-weight:400;font-family:'Roboto','Arial',sans-serif"
                                                    valign="middle">
                                                    <?php echo e(__("Order Total:")); ?>

                                                </td>
                                                <td align="center" valign="middle">
                                                    <table align="right" border="0" cellpadding="0" cellspacing="0"
                                                           role="presentation" style="width:105px" width="105">
                                                        <tbody>
                                                        <tr>
                                                            <td align="right"
                                                                style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:24px;font-weight:400;font-family:'Roboto','Arial',sans-serif"
                                                                valign="middle">
                                                                <?php echo e(float_amount_with_currency_symbol($paymentOrder?->total_amount)); ?>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:24px;font-weight:400;font-family:'Roboto','Arial',sans-serif"
                                                    valign="middle">
                                                    <?php echo e(__("Tax Amount:")); ?>

                                                </td>
                                                <td align="center" valign="middle">
                                                    <table align="right" border="0" cellpadding="0" cellspacing="0"
                                                           role="presentation" style="width:105px" width="105">
                                                        <tbody>
                                                        <tr>
                                                            <td align="right"
                                                                style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:24px;font-weight:400;font-family:'Roboto','Arial',sans-serif"
                                                                valign="middle">
                                                                <?php echo e(float_amount_with_currency_symbol($paymentOrder->tax_amount)); ?>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:24px;font-weight:400;font-family:'Roboto','Arial',sans-serif"
                                                    valign="middle">
                                                    <?php echo e(__("Shipping Cost:")); ?>

                                                </td>
                                                <td align="center" valign="middle">
                                                    <table align="right" border="0" cellpadding="0" cellspacing="0"
                                                           role="presentation" style="width:105px" width="105">
                                                        <tbody>
                                                        <tr>
                                                            <td align="right"
                                                                style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:24px;font-weight:400;font-family:'Roboto','Arial',sans-serif"
                                                                valign="middle">
                                                                <?php echo e(float_amount_with_currency_symbol($paymentOrder?->shipping_cost)); ?>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:24px;font-weight:700;font-family:'Roboto','Arial',sans-serif"
                                                    valign="middle">
                                                    <?php echo e(__("Total Payment:")); ?>

                                                </td>
                                                <td align="center" valign="middle">
                                                    <table align="right" border="0" cellpadding="0" cellspacing="0"
                                                           role="presentation" style="width:105px" width="105">
                                                        <tbody>
                                                        <tr>
                                                            <td align="right"
                                                                style="color:#0088dd;font-size:15px;font-style:normal;line-height:24px;font-weight:400;font-family:'Roboto','Arial',sans-serif"
                                                                valign="middle">
                                                                <?php echo e(float_amount_with_currency_symbol($paymentOrder?->total_amount + $paymentOrder?->tax_amount + $paymentOrder?->shipping_cost)); ?>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td align="center" valign="middle" style="padding-top:24px">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                               role="presentation" style="width:100%" width="100%">
                                            <tbody>
                                            <tr>
                                                <td align="left"
                                                    style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:24px;font-weight:400;font-family:'Roboto','Arial',sans-serif"
                                                    valign="middle">
                                                    Paid By:
                                                </td>
                                                <td align="center" valign="middle">
                                                    <table align="right" border="0" cellpadding="0" cellspacing="0"
                                                           role="presentation" style="width:105px" width="105">
                                                        <tbody>
                                                        <tr>
                                                            <td align="right"
                                                                style="color:#3f3f3f;font-size:15px;font-style:normal;line-height:24px;font-weight:400;font-family:'Roboto','Arial',sans-serif"
                                                                valign="middle">
                                                                <?php echo e($mainOrder->payment_gateway); ?>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</center>
</body>
</html><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Order\Resources/views/emails/orders/vendor_mail.blade.php ENDPATH**/ ?>