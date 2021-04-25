<?php

namespace App\Domains\User\Jobs;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Lucid\Units\Job;

class SaveUserJob extends Job
{
    /**
     * @var string
     */
    private string $name;
    private string $password;
    private string $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $name, string $password, string $email)
    {
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $attributes = [
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make($this->password),
        ];

        return tap(new User($attributes))->save();
    }
}
