<?php 

namespace App\Models\Traits;

trait UserACLTrait{
    
    public function permissions(){
        
        $user = $this->profile()->first();
    
        return $user->profiles;

    }
}