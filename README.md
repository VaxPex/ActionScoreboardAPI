# ActionScoreboardAPI
Api for action scoreboard for HixXBase can be used in pmmp 3 or eskobe

# Example
use VaxPex\Scoreboard; // import

```php
Scoreboard::getInstance()->create($player, "thing"); // to create scoreboard
if(isset(Scoreboard::getInstance()->scoreboard[$player->getName()])){
  Scoreboard::getInstance()->remove($player);
} // to remove
```
