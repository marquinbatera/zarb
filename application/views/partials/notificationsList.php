<?php date_default_timezone_set('Europe/London'); ?>
<?php foreach($notificatons as $message) : ?>
    <?php if ($message['customer_id']) { ?>
        <li>
            <a href="<?php echo base_url('dispatch/processingOrder/'.$message['order_id']).'?message_from=customer' ?>">
                <div class="media">
                    <div class="media-left">
                        <img src="<?php echo base_url($message['user_imagepath']) ?>" data-holder-rendered="true" style="width: 40px; height: 40px; border-radius: 50%"> 
                    </div> 
                    <div class="media-body"> 
                        <strong><?php echo $message['user_name'] ?></strong>
                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> <?php echo $message['ordermessage_datetime_fmt'] ?></small></p>
                        <?php echo $message['ordermessage_content'] ?>
                    </div>
                </div>
            </a>
         </li>
    <?php } else { ?>
        <li>
            <a href="<?php echo base_url('dispatch/processingOrder/'.$message['order_id']).'/?message_from=driver' ?>">
                <div class="media">
                    <div class="media-left">
                        <img src="<?php echo base_url($message['user_imagepath']) ?>" data-holder-rendered="true" style="width: 40px; height: 40px; border-radius: 50%"> 
                    </div> 
                    <div class="media-body"> 
                        <strong><?php echo $message['user_name'] ?></strong>
                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> <?php echo $message['ordermessage_datetime_fmt'] ?></small></p>
                        <?php echo $message['ordermessage_content'] ?>
                    </div>
                </div>
            </a>
         </li>
     <?php } ?>    
 <?php endforeach; ?>
 <?php if (count($notificatons) === 0){ ?>
    <p class="text-center" style="padding: 10px 0 5px 0">No new message<p>
 <?php } ?>