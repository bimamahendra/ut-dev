<?php
class Pusherjs {
    public function push(){
        require 'vendor/autoload.php';
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '8cf91b33222fdfca79e1',
            '2008802539094dc08bbc',
            '1162342',
            $options
        );

        $data['testMessage'] = 'hello world';
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
