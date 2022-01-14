# ActionScoreboardAPI
Api for action scoreboard for HixXBase can be used in pmmp 3 or eskobe

# Example
```php
use VaxPex\Scoreboard; // import

// to create scoreboard
Scoreboard::getInstance()->create("lobby", "thing", $player, "The first Line\nThe second Line"){ 

// to remove
Scoreboard::getInstance()->remove($player);
```
