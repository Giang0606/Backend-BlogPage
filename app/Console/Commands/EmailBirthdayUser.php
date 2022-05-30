<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\NotifyBirthdayUser;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class EmailBirthdayUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email on birthday of user';

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now()->isoFormat('MM-DD');
        $users = $this->userRepository->findUserByBirthday($today);
        // Log:info($users);
        foreach ($users as $user) {
            $user->notify(new NotifyBirthdayUser());
        }
    }
}
