<?php

namespace App\Jobs;

use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class TestMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->user->email == 'xhirokawa@example.net') {
            throw new \Exception('エラーテスト');
        }
        Mail::to($this->user->email)
            // ->cc($this->cc)
            ->send(new TestMail($this->user));
    }

    public function failed(\Throwable $exception): void
    {
        // 失敗したときの処理
        \Log::error('メールの送信に失敗しました: ', [
            'user_id' => $this->user->id,
            'email' => $this->user->email,
            'error_message' => $exception->getMessage(),
        ]);
    }
}
