# ActionScoreboardAPI
Api for action scoreboard for HixXBase can be used in pmmp 3 or eskobe

# Example
```php
use VaxPex\Scoreboard; // import

// to create scoreboard
Scoreboard::getInstance()->create("lobby", "thing", $player, "The first Line\nThe second Line"){ 

if(isset(Scoreboard::getInstance()->scoreboard[$player->getName()])){
  Scoreboard::getInstance()->remove($player);
} // to remove
```
