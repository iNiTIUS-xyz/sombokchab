<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

<script>
    class LiveChat {
        pusher;
        channel;
        logEnable;
        appCluster;
        appKey;
        appUrl;

        constructor() {
            this.appKey ="<?php echo e(env('PUSHER_APP_KEY')); ?>";
            this.appCluster ="<?php echo e(env('PUSHER_APP_CLUSTER')); ?>";
            this.appUrl ="<?php echo e(env('APP_URL')); ?>";
            this.pusher = this.createInstance();
            this.channel = null;
        }

        createInstance(){
            this.pusher = null;
            return new Pusher(this.appKey, {
                cluster: this.appCluster,
                channelAuthorization: { endpoint: `${this.appUrl}/broadcasting/auth` }
            });
        }

        enableLog(){
            Pusher.logToConsole = true;
        }

        createChannel(user_id, vendor_id, type) {
            if(type === 'user')
                this.channel = this.pusher.subscribe(`private-livechat-vendor-channel.${user_id}.${vendor_id}`);
            else
                this.channel = this.pusher.subscribe(`private-livechat-user-channel.${vendor_id}.${user_id}`);
        }

        removeChannel(user_id, vendor_id, type){
            if(type === 'user')
                this.channel = this.pusher.unsubscribe(`private-livechat-vendor-channel.${user_id}.${vendor_id}`);
            else
                this.channel = this.pusher.unsubscribe(`private-livechat-user-channel.${vendor_id}.${user_id}`);
        }

        bindEvent(eventName, callback) {
            this.channel.bind(eventName, callback);
        }
    }
</script><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Chat\Resources/views/components/livechat-js.blade.php ENDPATH**/ ?>