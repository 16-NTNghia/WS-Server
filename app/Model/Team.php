<?php
namespace WorkSpace\Model;

class Team extends Entity
{
   protected $table = 'TEAM';
   protected $primaryKey = 'IDTeam';
   protected $fillable = ['IDLeader', 'TeamName', 'TeamSize', 'TeamDescription', 'IsDeleted'];

   public function leader()
   {
      return $this->belongsTo(User::class, 'IDLeader', 'IDUser');
   }

   public function members()
   {
      return $this->hasMany(TeamMember::class, 'IDTeam', 'IDTeam');
   }

   public function projects()
   {
      return $this->hasMany(Project::class, 'IDTeam', 'IDTeam');
   }
}