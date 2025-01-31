<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserF extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    protected $table = 'users';

    protected $primarykey = 'id';

    public function getPlayerBanList()
    {
        $banlist = BanList::get();
        
        $bans = [];
        
        $playerUserLicense = explode(":", $this->identifier);

        foreach ($banlist as $ban) {
            
            $playerBanLicense = explode(":", $ban->license);

             if ($playerBanLicense[1] == $playerUserLicense[1]) {
                $currentTime = now()->timestamp;
                if ($ban->ban_time <= $currentTime && $ban->exp_time >= $currentTime) {
                    $bans[] = $ban;
                }
             }
        }

        return $bans;
    }

    public function getPlayerBanListHistory()
    {
        $banlist = BanList::get();
        
        $bans = [];
        
        $playerUserLicense = explode(":", $this->identifier);

        foreach ($banlist as $ban) {
            
            $playerBanLicense = explode(":", $ban->license);

             if ($playerBanLicense[1] == $playerUserLicense[1]) {
                $currentTime = now()->timestamp;
                if ($ban->ban_time <= $currentTime && $ban->exp_time <= $currentTime) {
                    $bans[] = $ban;
                }
            }
        }

        return $bans;
    }

    public function getSexe()
    {
        if ($this->sex == 'm') {
            return "Homme";
        } else {
            return "Femme";
        }
    }

    public function getJob()
    {
        $job = Job::where('name', $this->job)->first();

        if ($job) {
            return $job->label;
        } else {
            return "Aucun";
        }
    }

    public function getJobGrade()
    {
        $job = Job::where('name', $this->job)->first();

        if ($job) {
            $jobgrade = JobGrade::where('job_name', $job->name)->where('grade', $this->job_grade)->first();

            if ($jobgrade) {
                return $jobgrade->label;
            } else {
                return "Aucun";
            }
        } else {
            return "Aucun";
        }
    }

    public function getGroup()
    {
        $group = Job::where('name', $this->job2)->first();

        if ($group) {
            return $group->label;
        } else {
            return "Aucun";
        }
    }


    public function getGroupGrade()
    {
        $group = Job::where('name', $this->job2)->first();

        if ($group) {
            $groupgrade = JobGrade::where('job_name', $group->name)->where('grade', $this->job2_grade)->first();

            if ($groupgrade) {
                return $groupgrade->label;
            } else {
                return "Aucun";
            }
        } else {
            return "Aucun";
        }
    }

}
