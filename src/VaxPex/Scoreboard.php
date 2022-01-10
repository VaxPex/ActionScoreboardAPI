<?php

declare(strict_types=1);

namespace VaxPex;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Scoreboard extends PluginBase implements Listener{

	private static Scoreboard $instance;

	public array $scoreboards = []; // not private cuz it can be used in the plugins

	public function onEnable(){
		self::$instance = $this;
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onDisable(){
		foreach($this->getServer()->getOnlinePlayers() as $player){
			$this->remove($player);
		}
	}

	public static function getInstance() : self{
		return self::$instance;
	}

	public function create(string $objectiveName, string $name, Player $player, string $lines){
		if(isset($this->scoreboards[$player->getName()])){
			$player->removeTitles();
		}
		$this->scoreboards[$player->getName()] = $objectiveName;
		$player->sendTitle(str_repeat(" ", str_word_count($lines) * 3) . $name . "\n§r§f " . $lines);
	}

	public function remove(Player $player){
		if(isset($this->scoreboards[$player->getName()])){
			$player->removeTitles();
			unset($this->scoreboards[$player->getName()]);
		}
	}

	//don't touch that event
	public function omQuit(PlayerQuitEvent $event){
		$this->remove($event->getPlayer());
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		if($command->getName() === "test"){
			if($sender instanceof Player){
				$this->create("Example", "Example", $sender, "Hello {$sender->getName()}");
			}
		}
		return true;
	}
}
