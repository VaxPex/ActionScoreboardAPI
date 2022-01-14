# ActionScoreboardAPI
Api for action scoreboard for HixXBase can be used in pmmp 3 or eskobe

# Example
```php
use VaxPex\Scoreboard; // import

// to create scoreboard
Scoreboard::getInstance()->create($player, "thing"); 

if(isset(Scoreboard::getInstance()->scoreboard[$player->getName()])){
  Scoreboard::getInstance()->remove($player);
} // to remove
```
