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
     * SaveUserJob constructor.
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return User
     */
    public function handle(): User
    {
        $attributes = [
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make($this->password),
        ];

        return tap(new User($attributes))->save();
    }
}
