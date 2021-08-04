<?php

namespace App\Mail;

use App\Models\Album;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
class NotifyAdminNewAlbum extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( public User $admin, public  Album $album)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('mails.notifyadminnewalbum')->with(
            [
                'admin' => $this->admin,
            'album' => $this->album]
        );
    }
}
