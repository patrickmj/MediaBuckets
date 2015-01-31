
<div class="field">
    <div class="two columns alpha">
        <label><?php echo __('Ignore Buckets?'); ?></label>    
    </div>
    <div class="inputs five columns omega">
        <p class="explanation"><?php echo __('Omeka will ignore bucket items in browse pages.'); ?></p>
        <div class="input-block">
         <?php echo get_view()->formCheckbox('media_buckets_ignore_buckets', null,
            array('checked'=> (bool) get_option('media_buckets_ignore_buckets') ? 'checked' : ''
        
            )
        ); ?>
        </div>
    </div>
</div>